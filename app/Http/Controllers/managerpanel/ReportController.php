<?php

namespace App\Http\Controllers\managerpanel;

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
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
        $task = Job::where('manager_id','=',$loginUserId)->count();
        $todo = Job::where('manager_id','=',$loginUserId)->where('status','=',1)->count();
        $inprogress = Job::where('manager_id','=',$loginUserId)->where('status','=',2)->count();
        $done = Job::where('manager_id','=',$loginUserId)->where('status','=',3)->count();
        $manager = Manager::where('id','=',$loginUserId)->get();
        if (count($manager)>0) 
        {
            $managerName = $manager[0]->first_name." ".$manager[0]->last_name;
            if ($manager[0]->managerImage != "" && $manager[0]->managerImage != null) 
            {
                if(file_exists(public_path()."/uploads/managerImages/".$manager[0]->managerImage))
                {
                    $managerimage = asset('uploads/managerImages/'.$manager[0]->managerImage);
                }
            }
        }
        $manager = Manager::where('id','=',$loginUserId)->get();
        $new1 = Treereport::query()
                    ->select('treereports.*','users.first_name','users.last_name','jobs.id as jId','jobs.manager_id')
                    ->join('users','treereports.user_id','users.id')
                    ->leftjoin('jobs','treereports.task_id','jobs.id')
                    ->where('jobs.manager_id',$loginUserId)
                    ->where('treereports.status','=','New')
                    ->where('treereports.tree_id','=','');
                    /*->orderby('date','asc');*/
    
        $new2 =  Treereport::query()
                    ->select('treereports.*','users.first_name','users.last_name','jobs.id as jId','jobs.manager_id')
                    ->join('users','treereports.user_id','users.id')
                    ->leftjoin('jobs','treereports.task_id','jobs.id')
                    ->where('treereports.status','=','New')
                    ->where('treereports.task_id','=','');
                    /*->orderby('date','asc')
                    ->union($new1)
                    ->paginate($this->pagination);*/

        $new = $new2->unionAll($new1)
                          ->orderby('date','asc')
                          ->paginate($this->pagination);

        $checked1 = Treereport::query()
                        ->select('treereports.*','users.first_name','users.last_name','managers.first_name as fname','managers.last_name as lname','jobs.id as jId','jobs.manager_id')
                        ->join('users','treereports.user_id','users.id')
                        ->leftjoin('managers','treereports.checked_by','managers.id')
                        ->leftjoin('jobs','treereports.task_id','jobs.id')
                        ->where('jobs.manager_id',$loginUserId)
                        ->where('treereports.status','=','Checked')
                        ->where('treereports.tree_id','=','');

                        /*->orderby('date','asc')*/

        $checked2 = Treereport::query()
                        ->select('treereports.*','users.first_name','users.last_name','managers.first_name as fname','managers.last_name as lname','jobs.id as jId','jobs.manager_id')
                        ->join('users','treereports.user_id','users.id')
                        ->leftjoin('managers','treereports.checked_by','managers.id')
                        ->leftjoin('jobs','treereports.task_id','jobs.id')
                        ->where('treereports.status','=','Checked')
                        ->where('treereports.task_id','=','');

                        /*->orderby('date','asc')
                        ->union($checked1)
                        ->paginate($this->pagination)*/

        $checked = $checked2->unionAll($checked1)
                          ->orderby('date','asc')
                          ->paginate($this->pagination);

        return view('managerpanel.managereport', compact('new','checked','manager','managerName','managerimage'));
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
            $loginUserId = AUTH::user()->id;
            $update['status'] = 'Checked';
            $update['checked_by'] = $loginUserId;
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
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
        $task = Job::where('manager_id','=',$loginUserId)->count();
        $todo = Job::where('manager_id','=',$loginUserId)->where('status','=',1)->count();
        $inprogress = Job::where('manager_id','=',$loginUserId)->where('status','=',2)->count();
        $done = Job::where('manager_id','=',$loginUserId)->where('status','=',3)->count();
        $manager = Manager::where('id','=',$loginUserId)->get();

        if (count($manager)>0) 
        {
            $managerName = $manager[0]->first_name." ".$manager[0]->last_name;
            if ($manager[0]->managerImage != "" && $manager[0]->managerImage != null) 
            {
                if(file_exists(public_path()."/uploads/managerImages/".$manager[0]->managerImage))
                {
                    $managerimage = asset('uploads/managerImages/'.$manager[0]->managerImage);
                }
            }
        }
        $manager = Manager::where('id','=',$loginUserId)->get();
        $report = Treereport::where('id', '=', $id)->get();

        if ($report[0]->checked_by != '0') {
        	$checkedbymanager = Manager::where('id','=',$report[0]->checked_by)->get();
        	$checkedbymanagernm = $checkedbymanager[0]->first_name.' '.$checkedbymanager[0]->last_name;
        }
        else{
        	$checkedbymanagernm = "";
        }

        if($report[0]->checked_by == 0){
            $update['checked_by'] = $loginUserId;
            $update['status'] = "Checked";
            Treereport::where('id',$id)->update($update);
        }

        return view('managerpanel.viewreport', compact('report','manager','managerName','managerimage','checkedbymanagernm'));
    }

    public function search(Request $request)
    {
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
        $task = Job::where('manager_id','=',$loginUserId)->count();
        $todo = Job::where('manager_id','=',$loginUserId)->where('status','=',1)->count();
        $inprogress = Job::where('manager_id','=',$loginUserId)->where('status','=',2)->count();
        $done = Job::where('manager_id','=',$loginUserId)->where('status','=',3)->count();
        $manager = Manager::where('id','=',$loginUserId)->get();
        if (count($manager)>0) 
        {
            $managerName = $manager[0]->first_name." ".$manager[0]->last_name;
            if ($manager[0]->managerImage != "" && $manager[0]->managerImage != null) 
            {
                if(file_exists(public_path()."/uploads/managerImages/".$manager[0]->managerImage))
                {
                    $managerimage = asset('uploads/managerImages/'.$manager[0]->managerImage);
                }
            }
        }
        $manager = Manager::where('id','=',$loginUserId)->get();
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

                $qry->whereBetween('date', [$weekStartDate, $weekEndDate]);//->where('status','New');
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

                $qry1->whereBetween('date', [$weekStartDate, $weekEndDate]);//->where('status','Checked');
            }
            else{
                $qry1->where([
                    ["date", "like", "%{$search}%"],
                ]);
            }
        }
        $checked = $qry1->paginate($this->pagination);
        // $new = $qry1->paginate($this->pagination);
        
        $checked->appends($input);


        return view('managerpanel.managereport', compact('new','data','managerName','managerimage','manager','new','checked'));

    }

    public function searchtreereport(Request $request)
    {

        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
        $task = Job::where('manager_id','=',$loginUserId)->count();
        $todo = Job::where('manager_id','=',$loginUserId)->where('status','=',1)->count();
        $inprogress = Job::where('manager_id','=',$loginUserId)->where('status','=',2)->count();
        $done = Job::where('manager_id','=',$loginUserId)->where('status','=',3)->count();
        $manager = Manager::where('id','=',$loginUserId)->get();
        if (count($manager)>0) 
        {
            $managerName = $manager[0]->first_name." ".$manager[0]->last_name;
            if ($manager[0]->managerImage != "" && $manager[0]->managerImage != null) 
            {
                if(file_exists(public_path()."/uploads/managerImages/".$manager[0]->managerImage))
                {
                    $managerimage = asset('uploads/managerImages/'.$manager[0]->managerImage);
                }
            }
        }
        $manager = Manager::where('id','=',$loginUserId)->get();
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
            $qry->where(function($q) use($search){
                $q->where("users.first_name", "like", "%{$search}%")
                ->orWhere("users.last_name", "like", "%{$search}%");
            });

            // $qry->where([
            //     ["users.first_name", "like", "%{$search}%"],
            // ]);
            // $qry->orwhere([
            //     ["users.last_name", "like", "%{$search}%"],
            // ]);
        }
        // if(trim($input["search"])!="") 
        // {
        //     $search = $input["search"];
           
        //     $qry->orwhere([
        //         ["users.last_name", "like", "%{$search}%"],
        //     ]);
        // }

        $new = $qry->paginate($this->pagination);
        $new->appends($input);

        $input2 = $request->all();
        $qry1 = Treereport::query()
                    ->select('treereports.*','users.first_name','users.last_name')
                    ->join('users','treereports.user_id','users.id')
                    ->where('treereports.status','=','Checked'); 

        if(trim($input2["search"])!="") 
        {
            $search = $input2["search"];
            // $qry1->where([
            //     ["users.first_name", "like", "%{$search}%"],
            // ]);
            $qry1->where(function($q) use($search){
                $q->where("users.first_name", "like", "%{$search}%")
                ->orWhere("users.last_name", "like", "%{$search}%");
            });
        }
        if(trim($input2["search"])!="") 
        {
            // $search = $input2["search"];
            
            // $qry1->orwhere([
            //      ["users.last_name", "like", "%{$search}%"],
            //  ]);
        }

        $checked = $qry1->paginate($this->pagination);

        $checked->appends($input2);

        return view('managerpanel.managereport', compact('new','checked','managerName','managerimage','manager'));

    }

    public function searchtreereportlocation(Request $request)
    {
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
        $task = Job::where('manager_id','=',$loginUserId)->count();
        $todo = Job::where('manager_id','=',$loginUserId)->where('status','=',1)->count();
        $inprogress = Job::where('manager_id','=',$loginUserId)->where('status','=',2)->count();
        $done = Job::where('manager_id','=',$loginUserId)->where('status','=',3)->count();
        $manager = Manager::where('id','=',$loginUserId)->get();
        if (count($manager)>0) 
        {
            $managerName = $manager[0]->first_name." ".$manager[0]->last_name;
            if ($manager[0]->managerImage != "" && $manager[0]->managerImage != null) 
            {
                if(file_exists(public_path()."/uploads/managerImages/".$manager[0]->managerImage))
                {
                    $managerimage = asset('uploads/managerImages/'.$manager[0]->managerImage);
                }
            }
        }
        $manager = Manager::where('id','=',$loginUserId)->get();
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

        return view('managerpanel.managereport', compact('new','checked','managerName','managerimage','manager'));

    }

    public function delete($id) 
    {
        Treereport::where('id','=',$id)->delete();

        return redirect()->route('managerpanel.report.manage')->with('success', 'Deleted successfully.');
    }

}