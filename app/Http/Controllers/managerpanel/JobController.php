<?php

namespace App\Http\Controllers\managerpanel;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use App\Models\Jobimage;
use App\Models\Manager;
use App\Models\Tree;
use Validator;
use Illuminate\Pagination\Paginator;
use DB; 
use Carbon\Carbon;

class JobController extends Controller
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
        $data = Job::where('manager_id','=',$loginUserId)->paginate($this->pagination);
       
        $Todo = DB::table('jobs')
                ->select('jobs.*','managers.first_name','users.first_name as firstName')
                ->join('managers','jobs.manager_id','managers.id')
                ->join('users','jobs.user_id','users.id')
                ->where('jobs.status',1)
                ->where('jobs.manager_id','=',$loginUserId)
                ->orderby('job_date','ASC')
                ->orderby('start_time','ASC')
                ->paginate($this->pagination);

        foreach ($Todo as $t) 
        {
            $loginuser_name = "";
            $user_id=explode(',', $t->user_id);
            for($g=0; $g<count($user_id); $g++)
            {
                $loginname = User::where('id', '=', $user_id[$g])->get();
                if (count($loginname) > 0) 
                {
                    $loginuser_name.=",".$loginname[0]->first_name;
                }
            }
            $t->loginuser_name = trim($loginuser_name,",");
        }
        
        $Inprogress = DB::table('jobs')
                ->select('jobs.*','managers.first_name','users.first_name as firstName')
                ->join('managers','jobs.manager_id','managers.id')
                ->join('users','jobs.user_id','users.id')
                ->where('jobs.status',2)
                ->where('jobs.manager_id','=',$loginUserId)
                ->orderby('job_date','ASC')
                ->orderby('start_time','ASC')
                ->paginate($this->pagination);
        foreach ($Inprogress as $i) 
        {
            $loginuser_name = "";
            $user_id=explode(',', $i->user_id);
            for($g=0; $g<count($user_id); $g++)
            {
                $loginname = User::where('id', '=', $user_id[$g])->get();
                if (count($loginname) > 0) 
                {
                    $loginuser_name.=",".$loginname[0]->first_name;
                }
            }
            $i->loginuser_name = trim($loginuser_name,",");
        }
   
        $Done = DB::table('jobs')
                ->select('jobs.*','managers.first_name','users.first_name as firstName')
                ->join('managers','jobs.manager_id','managers.id')
                ->join('users','jobs.user_id','users.id')
                ->where('jobs.status',3)
                ->where('jobs.manager_id','=',$loginUserId)
                ->orderby('job_date','ASC')
                ->orderby('start_time','ASC')
                ->paginate($this->pagination);
        foreach ($Done as $do) 
        {
            $loginuser_name = "";
            $user_id=explode(',', $do->user_id);
            for($g=0; $g<count($user_id); $g++)
            {
                $loginname = User::where('id', '=', $user_id[$g])->get();
                if (count($loginname) > 0) 
                {
                    $loginuser_name.=",".$loginname[0]->first_name;
                }
            }
            $do->loginuser_name = trim($loginuser_name,",");
        }
        $manager = Manager::where('id','=',$loginUserId)->get();
        $user = User::query()->get();
        return view('managerpanel.managejob', compact('data','managerName','managerimage','task','todo','inprogress','done','Todo','Inprogress','Done','manager','user'));
    }

    public function search(Request $request) 
    {
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
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
        $task = Job::where('manager_id','=',$loginUserId)->count();
        $todo = Job::where('manager_id','=',$loginUserId)->where('status','=',1)->count();
        $inprogress = Job::where('manager_id','=',$loginUserId)->where('status','=',2)->count();
        $done = Job::where('manager_id','=',$loginUserId)->where('status','=',3)->count();
        $data = Job::query()->orderby('id','desc')->paginate($this->pagination);
        $manager = Manager::where('id','=',$loginUserId)->get();
        $user = User::query()->get();

        $input = $request->all();
        $qry = Job::query()
                    ->select('jobs.*','managers.first_name','users.first_name as firstName')
                    ->join('managers','jobs.manager_id','managers.id')
                    ->join('users','jobs.user_id','users.id')
                    ->where('jobs.manager_id','=',$loginUserId)
                    ->where('status',1); 
    
        if(trim($input["search"])!="") {
            $search = $input["search"];
            
            if (strpos($search, 'W') !== false) {
                $selected_week_start_day = date("Y-m-d", strtotime($input["search"]));
                $create_carbon_week = new Carbon($selected_week_start_day);
                $weekStartDate = $create_carbon_week->startOfWeek()->format('Y-m-d');
                $weekEndDate = $create_carbon_week->endOfWeek()->format('Y-m-d');

                $qry = Job::whereBetween('job_date', [$weekStartDate, $weekEndDate])->where('status',1);
            }
            else{
                $qry->where([
                    ["job_date", "like", "%{$search}%"],
                ]);
            }
        }
        
        $Todo = $qry->paginate($this->pagination);
        $Todo->appends($input);

        $input = $request->all();
        $qry1 = Job::query()
                    ->select('jobs.*','managers.first_name','users.first_name as firstName')
                    ->join('managers','jobs.manager_id','managers.id')
                    ->join('users','jobs.user_id','users.id')
                    ->where('jobs.manager_id','=',$loginUserId)
                    ->where('status',2); 
        
        if(trim($input["search"])!="") 
        {
            $job_date = $search = $input["search"];
            
            if (strpos($search, 'W') !== false) {
                $selected_week_start_day = date("Y-m-d", strtotime($input["search"]));
                $create_carbon_week = new Carbon($selected_week_start_day);
                $weekStartDate = $create_carbon_week->startOfWeek()->format('Y-m-d');
                $weekEndDate = $create_carbon_week->endOfWeek()->format('Y-m-d');

                $qry1 = Job::whereBetween('job_date', [$weekStartDate, $weekEndDate])->where('status',2);
            }
            else{
                $qry1->where([
                    ["job_date", "like", "%{$search}%"],
                ]);
            }
        }
        $Inprogress = $qry1->paginate($this->pagination);
        $Inprogress->appends($input);

        $input = $request->all();
        $qry2 = Job::query()
                        ->select('jobs.*','managers.first_name','users.first_name as firstName')
                        ->join('managers','jobs.manager_id','managers.id')
                        ->join('users','jobs.user_id','users.id')
                        ->where('jobs.manager_id','=',$loginUserId)
                        ->where('status',3); 

        if(trim($input["search"])!="") 
        {
            $search = $input["search"];
            
            if (strpos($search, 'W') !== false) {
                $selected_week_start_day = date("Y-m-d", strtotime($input["search"]));
                $create_carbon_week = new Carbon($selected_week_start_day);
                $weekStartDate = $create_carbon_week->startOfWeek()->format('Y-m-d');
                $weekEndDate = $create_carbon_week->endOfWeek()->format('Y-m-d');

                $qry2 = Job::whereBetween('job_date', [$weekStartDate, $weekEndDate])->where('status',3);
            }
            else{
                $qry2->where([
                    ["job_date", "like", "%{$search}%"],
                ]);
            }
        }
        $Done = $qry2->paginate($this->pagination);
        $Done->appends($input);

        return view('managerpanel.managejob', compact('data','managerName','managerimage','manager','task','todo','inprogress','done','Todo','Inprogress','Done','manager','user'));
    }

    public function searchtreeoperator(Request $request)
    {
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
        $task = Job::where('manager_id','=',$loginUserId)->count();
        $todo = Job::where('manager_id','=',$loginUserId)->where('status','=',1)->count();
        $inprogress = Job::where('manager_id','=',$loginUserId)->where('status','=',2)->count();
        $done = Job::where('manager_id','=',$loginUserId)->where('status','=',3)->count();
       
        $user = User::query()->get();
        $manager = Manager::where('id','=',$loginUserId)->get();
        $data = Job::query()->orderby('id','desc')->paginate($this->pagination);
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

        $qry = Job::query()
                    ->select('jobs.*','managers.first_name','users.first_name as firstName')
                    ->join('managers','jobs.manager_id','managers.id')
                    ->join('users','jobs.user_id','users.id')
                    ->where('jobs.manager_id','=',$loginUserId)
                    ->where('jobs.status',1); 

        if(trim($input["searchusername"])!="") 
        {
            $searchusername = $input["searchusername"];
            $qry->where([
                ["users.first_name", "like", "%{$searchusername}%"],
            ]);
        }

        $Todo = $qry->paginate($this->pagination);
        $Todo->appends($input);

        $qry1 = Job::query()
                    ->select('jobs.*','managers.first_name','users.first_name as firstName')
                    ->join('managers','jobs.manager_id','managers.id')
                    ->join('users','jobs.user_id','users.id')
                    ->where('jobs.manager_id','=',$loginUserId)
                    ->where('jobs.status','=',2); 

        if(trim($input["searchusername"])!="") 
        {
            $searchusername = $input["searchusername"];
            $qry1->where([
                ["users.first_name", "like", "%{$searchusername}%"],
            ]);
        }

        $Inprogress = $qry1->paginate($this->pagination);
        $Inprogress->appends($input);

        $qry2 = Job::query()
                    ->select('jobs.*','managers.first_name','users.first_name as firstName')
                    ->join('managers','jobs.manager_id','managers.id')
                    ->join('users','jobs.user_id','users.id')
                    ->where('jobs.manager_id','=',$loginUserId)
                    ->where('jobs.status','=',3); 

        if(trim($input["searchusername"])!="") 
        {
            $searchusername = $input["searchusername"];
            $qry2->where([
                ["users.first_name", "like", "%{$searchusername}%"],
            ]);
        }

        $Done = $qry2->paginate($this->pagination);
        $Done->appends($input);


        return view('managerpanel.managejob', compact('data','managerName','managerimage','manager','task','todo','inprogress','done','Todo','Inprogress','Done','manager','user'));

    }

    public function searchjoblocation(Request $request)
    {
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
        $task = Job::where('manager_id','=',$loginUserId)->count();
        $todo = Job::where('manager_id','=',$loginUserId)->where('status','=',1)->count();
        $inprogress = Job::where('manager_id','=',$loginUserId)->where('status','=',2)->count();
        $done = Job::where('manager_id','=',$loginUserId)->where('status','=',3)->count();
       
        $user = User::query()->get();
        $manager = Manager::where('id','=',$loginUserId)->get();
        $data = Job::query()->orderby('id','desc')->paginate($this->pagination);
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

        $qry = Job::query()
                    ->select('jobs.*','managers.first_name','users.first_name as firstName')
                    ->join('managers','jobs.manager_id','managers.id')
                    ->join('users','jobs.user_id','users.id')
                    ->where('jobs.manager_id','=',$loginUserId)
                    ->where('jobs.status','=',1); 

        if(trim($input["searchlocation"])!="") 
        {
            $searchlocation = $input["searchlocation"];
          
            $qry->where([
                ["jobs.address", "like", "%{$searchlocation}%"],
            ]);
        }

        $Todo = $qry->paginate($this->pagination);
        $Todo->appends($input);

        $qry1 = Job::query()
                    ->select('jobs.*','managers.first_name','users.first_name as firstName')
                    ->join('managers','jobs.manager_id','managers.id')
                    ->join('users','jobs.user_id','users.id')
                    ->where('jobs.manager_id','=',$loginUserId)
                    ->where('jobs.status','=',2); 

        if(trim($input["searchlocation"])!="") 
        {
            $searchlocation = $input["searchlocation"];
            
            $qry1->where([
                ["jobs.address", "like", "%{$searchlocation}%"],
            ]);
        }

        $Inprogress = $qry1->paginate($this->pagination);
        $Inprogress->appends($input);

        $qry2 = Job::query()
                    ->select('jobs.*','managers.first_name','users.first_name as firstName')
                    ->join('managers','jobs.manager_id','managers.id')
                    ->join('users','jobs.user_id','users.id')
                    ->where('jobs.manager_id','=',$loginUserId)
                    ->where('jobs.status','=',3); 

        if(trim($input["searchlocation"])!="") 
        {
            $searchlocation = $input["searchlocation"];
           
            $qry2->where([
                ["jobs.address", "like", "%{$searchlocation}%"],
            ]);
        }

        $Done = $qry2->paginate($this->pagination);
        $Done->appends($input);


        return view('managerpanel.managejob', compact('data','managerName','managerimage','manager','task','todo','inprogress','done','Todo','Inprogress','Done','manager','user'));

    }

    public function add($id) 
    {       
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
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
        $data1 = array(
            'Admin' => Admin::where('id','=',$loginUserId)->get(),
            'Admins' => Admin::count(),
            'Users' => User::count(),
            'Managers' => Manager::count(),
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );
        $manager1 = Manager::query()->get();
        
        $user = User::query()->get();
        $input = Job::where('tree_id', '=', $id)->get();
        $address = Tree::where('id','=', $id)->get();
        $location = Tree::where('id','=',$id)->get();
    
       
        $data = array('type'=>'add','manager1' => $manager1,'user' => $user, 'input'=>$input,'treeId' => $id,'address' => $address,'location' => $location);

        return view('managerpanel.addjob', compact('data','input','manager1','user','managerName','managerimage','manager','address','input','location'));
    }

    public function ajaxgetuser(Request $request){
         $data=User::select('user_id','id')->where('manager_id',$request->id)->take(100)->get();
        return response()->json($data);
    }

    public function save(Request $request) {
        $input = $request->all();
        $id = $input['treeId'];

        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
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
        $data1 = array(
            'Admin' => Admin::where('id','=',$loginUserId)->get(),
            'Admins' => Admin::count(),
            'Users' => User::count(),
            'Managers' => Manager::count(),
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );
        $manager1 = Manager::query()->get();
       
        $location = Tree::where('id','=',$id)->get();
        $validators=Validator::make($input,$this->getRules('Add',$input),$this->messages());
        $manager = Manager::where('id','=',$loginUserId)->get();
        $user = User::query()->get();
        $address = Tree::where('id','=', $id)->get();
        
        if($validators->fails())
        {
            $data = array('type'=>'add','manager' => $manager,'user'=> $user,'location' => $location, 'input'=>$input,'error'=>$validators->messages());
            return view('managerpanel.addjob', compact('data','manager','user','managerName','managerimage','address','location'));
            exit();
        }

        $validationRule = ['user_id' => 'required','job_date'=>'required','start_time'=>'required','end_time'=>'required'];
        $validationMsg = ['user_id.required' => 'Tree Name is required', 'job_date.required' => 'Select Task Date', 'start_time.required' => 'Select Start Time', 'end_time.required' => 'Select End Time'];

        $validator = Validator::make(['user_id' => $input['user_id'], 'job_date' => $input['job_date'], 'start_time' => $input['start_time'], 'end_time' => $input['end_time']], $validationRule, $validationMsg);

        /*$validator->after(function ($validator) use ($input) 
        {*/
            $start = $input['start_time'];
            $end = $input['end_time']; 
            $user = $input['user_id'];
            $user = User::query()->get();
            $address = Tree::where('id','=', $id)->get();
            $date = $input['job_date'];
            $checkName = Job::query()
                        ->where('user_id', $input['user_id'])
                        ->where('job_date', $input['job_date'])
                        ->get();
            $allowTask = 1;
            if(count($checkName) > 0){
                foreach($checkName as $tsk){

                    if($input['start_time'] >= $tsk->start_time && $input['start_time'] <= $tsk->end_time){
                        $allowTask = 0;
                        //=exit;
                    }
                    if($input['end_time'] >= $tsk->start_time && $input['end_time'] <= $tsk->end_time){
                        $allowTask = 0;
                        //exit;
                    }

                    if ($allowTask == 0) 
                    {
                        $validator->errors()->add('user_id', 'Tree operator is not available, please choose another tree operator');
                        $tree_id = $input['treeId'];                        
                        $data = array('type'=>'add','manager' => $manager,'address' => $address, 'user'=> $user,'location' => $location, 'input'=>$input,'error'=>$validator->messages(), 'treeId' => $tree_id, 'user_id' => $input['user_id']);
                        return view('managerpanel.addjob', compact('data','manager','user','managerName','managerimage','address','location','validators'));
                        /*return redirect()->route('managerpanel.job.add',[$tree_id])->withErrors(['Tree operator is not available, please choose another tree operator']);*/
                    }
                }
            }
        /*});*/
        
        $input['manager_id'] = $input['manager_id'];
        $input['user_id'] = $input['user_id'];
        $input['description'] = $input['description'];
        $input['start_time'] = $input['start_time'];
        $input['end_time'] = $input['end_time'];
        $input['tree_id'] = $input['treeId'];
        $input['status'] = 1;
                
        $job = Job::create($input);        
        
        if($job->id>0) {
            return redirect()->route('managerpanel.job.manage')->with('success', 'Created successfully.');
        } else {
            return redirect()->route('managerpanel.job.add')->withErrors(['Error creating record. Please try again.']);
        }
    }
    public function edit($id) {
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
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
        $data1 = array(
            'Admin' => Admin::where('id','=',$loginUserId)->get(),
            'Admins' => Admin::count(),
            'Users' => User::count(),
            'Managers' => Manager::count(),
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );
        $how_hear_abouts = array();
        
        $manager1 = Manager::query()->get();
       
        $user = User::query()->get();
        $input = Job::where('id', '=', $id)->get();
        $address = Tree::where('id','=', $id)->get();
        $location = Tree::where('id','=',$id)->get();
        foreach ($input as $d) 
        {
            $user_id = $d->user_id;
            $getUser = User::where('id', '=', $user_id)->get();
            if (count($getUser) > 0) 
            {
                $d->getUserName = $getUser[0]->first_name;
            }
        }


        $data = array('type'=>'edit', 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts,'manager1' => $manager1,'user' => $user,'address' => $address,'location' => $location);
        return view('managerpanel.addjob', compact('data','data1','manager1','user','managerName','managerimage','manager','address','location'));
    }

    public function update(Request $request) {
        $input = $request->all();
        $id = $input['id'];
        $loginUserId = AUTH::user()->id;
        $address = Tree::where('id','=', $id)->get();

        $validator = Validator::make( $input, $this->getRules('Edit', $input), $this->messages()); 
        $manager = Manager::where('id','=',$loginUserId)->get();
        $user = User::query()->get();
        $location = Tree::where('id','=',$id)->get();

        if ($validator->fails())
        {
            $data = array('type'=>'Edit','manager'=>$manager,'user'=>$user,'location' => $location,'input'=>$input,'error'=>$validator->messages());
            return view('managerpanel.addchapter', compact('data','address','location','user'));
            exit();
        }

        $validationRule = ['user_id' => 'required','job_date'=>'required','start_time'=>'required','end_time'=>'required'];
        $validationMsg = ['user_id.required' => 'Tree Name is required', 'job_date.required' => 'Select Task Date', 'start_time.required' => 'Select Start Time', 'end_time.required' => 'Select End Time'];

        $validator = Validator::make(['user_id' => $input['user_id'], 'job_date' => $input['job_date'], 'start_time' => $input['start_time'], 'end_time' => $input['end_time']], $validationRule, $validationMsg);

        $start = $input['start_time'];
        $end = $input['end_time']; 
        $user = $input['user_id'];
        $date = $input['job_date'];
        $checkName = Job::query()
                    ->where('user_id', $input['user_id'])
                    ->where('job_date', $input['job_date'])
                    ->get();
        $allowTask = 1;
        if(count($checkName) > 0){
            foreach($checkName as $tsk){

                if($input['start_time'] >= $tsk->start_time && $input['start_time'] <= $tsk->end_time){
                    $allowTask = 0;
                    //exit;
                }
                if($input['end_time'] >= $tsk->start_time && $input['end_time'] <= $tsk->end_time){
                    $allowTask = 0;
                    //exit;
                }

                if ($allowTask == 0) 
                {
                    $validator->errors()->add('user_id', 'Tree operator is not available, please choose another tree operator');
                    $tree_id = $input['treeId'];
                    return redirect()->route('managerpanel.job.edit',[$id])->withErrors(['Tree operator is not available, please choose another tree operator']);
                }
            }
        }
        
        
        $update["updateid"] = $loginUserId;
        $update["user_id"] = $input['user_id'];
        $update["job_title"] = $input['job_title'];
        $update["description"] = $input['description'];
        $update["job_date"] = $input['job_date'];
        $update["start_time"] = $input['start_time'];
        $update["end_time"] = $input['end_time'];
       // $update["category_id"] = $input['category_id'];
       // $update["tags"] = $input['tags'];
       // $update["address"] = $input['address'];
        //$update["latitude"] = $input['latitude'];
        //$update["longitude"] = $input['longitude'];
        $update["status"] = $input['status'];
        
        $job = Job::where('id', '=', $id)->update($update);

        return redirect()->route('managerpanel.job.manage')->with('success', 'Updated successfully.');

    }

    public function delete($id) {
        Job::where('id','=',$id)->delete();
        return redirect()->route('managerpanel.job.manage')->with('success', 'Deleted successfully.');
    }

    public function view($id) 
    {
        //$data = Job::where('id', '=', $id)->get();
    
        $managerName = "";
        $managerimage = "";
        $loginUserId = AUTH::user()->id;
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

        $assignUser = DB::table('jobs')
            ->select('jobs.*','users.first_name as firstName','trees.location','managers.first_name')
            ->leftjoin('users','jobs.user_id','users.id')
            ->leftjoin('trees','jobs.tree_id','trees.id')
            ->leftjoin('managers','jobs.manager_id','managers.id')
            ->where('jobs.id',$id)
            ->where('jobs.manager_id','=',$loginUserId)
            ->get();
        //$address = Tree::where('id','=', $id)->get();

        $jobimage = Jobimage::where('job_id','=',$id)->get();

        return view('managerpanel.viewjob', compact('assignUser','jobimage','managerimage','managerName','manager'));
    }

    public function updateAll(Request $request)  
    {  
        $loginUserId = AUTH::user()->id;
        
            
        $ids = $request->ids;  
        $taskStatus = $request->taskStatus;
        $catIds = explode(',',$ids);
        if($taskStatus == 'New'){
            $update["updateid"] = $loginUserId;
            $update['status'] = 1;
        }
        if($taskStatus == 'Inprocess'){
            $update["updateid"] = $loginUserId;
            $update['status'] = 2;
        }
        if($taskStatus == 'Done'){
            $update["updateid"] = $loginUserId;
            $update['status'] = 3;
        }
        
        $del=0;
        for($cat=0; $cat<count($catIds); $cat++){
            Job::where('id',$catIds[$cat])->update($update);
            $del++;     
        }
        
        echo $del;
        
    }
    
    private function getRules($type, $input) {
        $return = array();
        
        return $return;
    }

    private function messages() {
        return [
            
        ];
    }

    private function getRequiredMessage($string) {
        return 'The ' . $string . ' field is required.';
    }

    private function getGreaterMessage($string, $maxchar) {
        return 'The ' . $string . ' may not be greater than ' . $maxchar . ' characters.';
    }

    
}
