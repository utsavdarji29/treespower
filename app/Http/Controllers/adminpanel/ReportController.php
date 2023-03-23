<?php

namespace App\Http\Controllers\adminpanel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tree;
use App\Models\Treeimage;
use App\Models\Admin;
use App\Models\User;
use App\Models\Manager;
use App\Models\Job;
use App\Models\Treereport;
use Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
class ReportController extends Controller 
{
    private $pagination = 10;

    public function manage() 
    {
        $adminName = "";
        $adminimage = "";
        $loginUserId = AUTH::user()->id;
        $admin = Admin::where('id','=',$loginUserId)->get();
        
        if (count($admin)>0) 
        {
            $adminName = $admin[0]->first_name." ".$admin[0]->last_name;
            if ($admin[0]->userImage != "" && $admin[0]->userImage != null) 
            {
                if(file_exists(public_path()."/uploads/userImages/".$admin[0]->userImage))
                {
                    $adminimage = asset('uploads/userImages/'.$admin[0]->userImage);
                }
            }
        }
        $data1 = array(
            'Admins' => Admin::count(),
            'Users' => User::count(),
            'Managers' => Manager::count(),
            'Tree' => Tree::count(),
        );
        $manager = Manager::query()->get();
        $new = Treereport::query()
                    ->select('treereports.*','users.first_name','users.last_name')
                    ->join('users','treereports.user_id','users.id')
                    ->where('status','=','New')
                    ->orderby('date','asc')
                    ->paginate($this->pagination);
    
        $checked = Treereport::query()
                        ->select('treereports.*','users.first_name','users.last_name','managers.first_name as fname','managers.last_name as lname')
                        ->join('users','treereports.user_id','users.id')
                        ->leftjoin('managers','treereports.checked_by','managers.id')
                        ->where('status','=','Checked')
                        ->orderby('date','asc')
                        ->paginate($this->pagination);
      
        $image = Treeimage::query()->where('status','=',0)->get();
        return view('adminpanel.managereport', compact('new','checked','data1','adminName','manager','admin','image','adminimage'));
    }

    public function updateReportAll(Request $request)  
    {  
        $ids = $request->ids;  
        $taskStatus = $request->taskStatus;
        $catIds = explode(',',$ids);
        if($taskStatus == 'New'){
            $update['status'] = 'New';
        }
        if($taskStatus == 'Checked'){
            $update['status'] = 'Checked';
        }
        $del=0;
        for($cat=0; $cat<count($catIds); $cat++){
            Treereport::where('id',$catIds[$cat])->update($update);
            $del++;     
        }
        
        echo $del;
        
    }

    public function view($id) 
    {
        $adminName = "";
        $adminimage = "";
        $loginUserId = AUTH::user()->id;
        $admin = Admin::where('id','=',$loginUserId)->get();
        
        if (count($admin)>0) 
        {
            $adminName = $admin[0]->first_name." ".$admin[0]->last_name;
            if ($admin[0]->userImage != "" && $admin[0]->userImage != null) 
            {
                if(file_exists(public_path()."/uploads/userImages/".$admin[0]->userImage))
                {
                    $adminimage = asset('uploads/userImages/'.$admin[0]->userImage);
                }
            }
        }
        $report = Treereport::where('id', '=', $id)->get();
        $checkedbymanager = Manager::where('id','=',$report[0]->checked_by)->get();

        $checkedbymanagernm = $checkedbymanager[0]->first_name.' '.$checkedbymanager[0]->last_name;

        return view('adminpanel.viewreport', compact('report','adminName','admin','adminimage','checkedbymanagernm'));
    }

    public function search(Request $request)
    {

        $adminName = "";
        $adminimage = "";
        $loginUserId = AUTH::user()->id;
        $admin = Admin::where('id','=',$loginUserId)->get();
        
        if (count($admin)>0) 
        {
            $adminName = $admin[0]->first_name." ".$admin[0]->last_name;
            if ($admin[0]->userImage != "" && $admin[0]->userImage != null) 
            {
                if(file_exists(public_path()."/uploads/userImages/".$admin[0]->userImage))
                {
                    $adminimage = asset('uploads/userImages/'.$admin[0]->userImage);
                }
            }
        }

        $data1 = array(
            'Admins' => Admin::count(),
            'Users' => User::count(),
            'Managers' => Manager::count(),
        );

        $manager = Manager::query()->get();
        $data = Treereport::query()->orderby('id','desc')->paginate($this->pagination);
        $job = Treereport::query()->where('status','New')->where('status','Checked')->get();

        $input = $request->all();
        $qry = Treereport::query()
                    ->select('treereports.*','users.first_name','users.last_name')
                    ->join('users','treereports.user_id','users.id')
                    ->where('status','=','New'); 
        //$qry = Job::whereBetween('job_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status',1); 
        
        if(trim($input["search"])!="") 
        {
            $search = $input["search"];

            if (strpos($search, 'W') !== false) {
                $selected_week_start_day = date("Y-m-d", strtotime($input["search"]));
                $create_carbon_week = new Carbon($selected_week_start_day);
                $weekStartDate = $create_carbon_week->startOfWeek()->format('Y-m-d');
                $weekEndDate = $create_carbon_week->endOfWeek()->format('Y-m-d');

                $qry = Treereport::whereBetween('date', [$weekStartDate, $weekEndDate])->where('status','New');
            }
            else{
                $qry->where([
                    ["date", "like", "%{$search}%"],
                ]);
            }
        }

        $new = $qry->paginate($this->pagination);
        $new->appends($input);

        $input = $request->all();
        $qry1 = Treereport::query()
                    ->select('treereports.*','users.first_name','users.last_name')
                    ->join('users','treereports.user_id','users.id')
                    ->where('status','=','Checked');
        //$qry1 = Job::whereBetween('job_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status',2);
        $report_date = "";
        if(trim($input["search"])!="") 
        {
            $report_date = $search = $input["search"];
            
            if (strpos($search, 'W') !== false) {
                $selected_week_start_day = date("Y-m-d", strtotime($input["search"]));
                $create_carbon_week = new Carbon($selected_week_start_day);
                $weekStartDate = $create_carbon_week->startOfWeek()->format('Y-m-d');
                $weekEndDate = $create_carbon_week->endOfWeek()->format('Y-m-d');

                $qry1 = Treereport::whereBetween('date', [$weekStartDate, $weekEndDate])->where('status','Checked');
            }
            else{
                $qry1->where([
                    ["date", "like", "%{$search}%"],
                ]);
            }
        }
        $checked = $qry1->paginate($this->pagination);
        $checked->appends($input);


        return view('adminpanel.managereport', compact('data','adminName','data1','manager','admin','new','checked','adminimage'));

    }

    public function searchtreereport(Request $request)
    {
        $adminName = "";
        $adminimage = "";
        $loginUserId = AUTH::user()->id;
        $admin = Admin::where('id','=',$loginUserId)->get();
        
        if (count($admin)>0) 
        {
            $adminName = $admin[0]->first_name." ".$admin[0]->last_name;
            if ($admin[0]->userImage != "" && $admin[0]->userImage != null) 
            {
                if(file_exists(public_path()."/uploads/userImages/".$admin[0]->userImage))
                {
                    $adminimage = asset('uploads/userImages/'.$admin[0]->userImage);
                }
            }
        }

        $data1 = array(
            'Admins' => Admin::count(),
            'Users' => User::count(),
            'Managers' => Manager::count(),
        );

        $manager = Manager::query()->get();
        $input = $request->all();

        //$data = Treereport::query()->orderby('id','desc')->paginate($this->pagination);
        //$job = Treereport::query()->where('status','New')->where('status','Checked')->get();

        $qry = Treereport::query()
                    ->join('users','treereports.user_id','users.id')
                    ->select('treereports.*','users.first_name','users.last_name')
                    ->where('treereports.status','=','New'); 

        if(trim($input["search"])!="") 
        {
            $search = $input["search"];
            $qry->where([
                ["users.first_name", "like", "%{$search}%"],
            ]);
            $qry->orwhere([
                ["users.last_name", "like", "%{$search}%"],
            ]);
        }

        $new = $qry->paginate($this->pagination);
        $new->appends($input);

        $input = $request->all();
        $qry1 = Treereport::query()
                    ->select('treereports.*','users.first_name','users.last_name')
                    ->join('users','treereports.user_id','users.id')
                    ->where('treereports.status','=','Checked'); 

        if(trim($input["search"])!="") 
        {
            $search = $input["search"];
            $qry1->where([
                ["users.first_name", "like", "%{$search}%"],
            ]);
            $qry1->orwhere([
                ["users.last_name", "like", "%{$search}%"],
            ]);
        }

        $checked = $qry1->paginate($this->pagination);

        $checked->appends($input);

        return view('adminpanel.managereport', compact('new','checked','adminName','data1','manager','admin','adminimage'));

    }

    public function searchtreereportlocation(Request $request)
    {
        $adminName = "";
        $adminimage = "";
        $loginUserId = AUTH::user()->id;
        $admin = Admin::where('id','=',$loginUserId)->get();
        
        if (count($admin)>0) 
        {
            $adminName = $admin[0]->first_name." ".$admin[0]->last_name;
            if ($admin[0]->userImage != "" && $admin[0]->userImage != null) 
            {
                if(file_exists(public_path()."/uploads/userImages/".$admin[0]->userImage))
                {
                    $adminimage = asset('uploads/userImages/'.$admin[0]->userImage);
                }
            }
        }

        $data1 = array(
            'Admins' => Admin::count(),
            'Users' => User::count(),
            'Managers' => Manager::count(),
        );

        $manager = Manager::query()->get();
        $input = $request->all();

        //$data = Treereport::query()->orderby('id','desc')->paginate($this->pagination);
        //$job = Treereport::query()->where('status','New')->where('status','Checked')->get();

        $qry = Treereport::query()
                    ->select('treereports.*','users.first_name','users.last_name')
                    ->join('users','treereports.user_id','users.id')
                    ->where('treereports.status','=','New'); 

        if(trim($input["search"])!="") 
        {
            $search = $input["search"];
            $qry->where([
                ["treereports.location", "like", "%{$search}%"],
            ]);
        }

        $new = $qry->paginate($this->pagination);
        $new->appends($input);

        $input = $request->all();
        $qry1 = Treereport::query()
                    ->select('treereports.*','users.first_name','users.last_name')
                    ->join('users','treereports.user_id','users.id')
                    ->where('treereports.status','=','Checked'); 

        if(trim($input["search"])!="") 
        {
            $search = $input["search"];
            $qry1->where([
                ["treereports.location", "like", "%{$search}%"],
            ]);
        }

        $checked = $qry1->paginate($this->pagination);

        $checked->appends($input);

        return view('adminpanel.managereport', compact('new','checked','adminName','data1','manager','admin','adminimage'));

    }

    public function delete($id) 
    {
        Treereport::where('id','=',$id)->delete();

        return redirect()->route('adminpanel.report.manage')->with('success', 'Deleted successfully.');
    }
   

}