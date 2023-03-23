<?php

namespace App\Http\Controllers\managerpanel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Job;
use App\Models\Tree;
use App\Models\Treereport;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function index() {
        /*$data = array(
            'User' => User::query()->count(),
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );*/
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
        
        $data = DB::table('users')
            ->select('users.*')
            ->join('managers','users.manager_id','managers.id')
            ->where('manager_id','=',$loginUserId)
            ->count();
        $task = Job::where('manager_id','=',$loginUserId)->count();
        $todo = Job::where('manager_id','=',$loginUserId)->where('status','=',1)->count();
        $inprogress = Job::where('manager_id','=',$loginUserId)->where('status','=',2)->count();
        $done = Job::where('manager_id','=',$loginUserId)->where('status','=',3)->count();
        $New = Treereport::where('status','New')->count();
        $Checked = Treereport::where('status','Checked')->count();
        $Report = Treereport::where('status','New')->count() + Treereport::where('status','Checked')->count();
        $age1 = Tree::where('age_range','=','0 to 10 years')->get();
        $age2 = Tree::where('age_range','=','11 to 30 years')->get();
        $age3 = Tree::where('age_range','=','31 years to 50 years')->get();
        $age4 = Tree::where('age_range','=','51 years to 80 years')->get();
        $age5 = Tree::where('age_range','=','81 years to 100 years')->get();
        $age6 = Tree::where('age_range','=','Above 100 years')->get();
       /* echo $agecount1 = count($age1);       
        echo $agecount2 = count($age2);
        echo $agecount3 = count($age3);
        echo $agecount4 = count($age4);
        echo $agecount5 = count($age5);
        echo $agecount6 = count($age6);*/

        $agecount1 = count($age1);       
        $agecount2 = count($age2);
        $agecount3 = count($age3);
        $agecount4 = count($age4);
        $agecount5 = count($age5);
        $agecount6 = count($age6);
        
        $tree_height1 = Tree::where('height','<=',10)->where('height','>=',0)->get();
        $tree_height2 = Tree::where('height','<=',30)->where('height','>=',10.01)->get();
        $tree_height3 = Tree::where('height','<=',50)->where('height','>=',30.01)->get();
        $tree_height4 = Tree::where('height','<=',70)->where('height','>=',50.01)->get();
        $tree_height5 = Tree::where('height','>=',70.01)->get();

        /*echo $treeheight1 = count($tree_height1);       
        echo $treeheight2 = count($tree_height2);
        echo $treeheight3 = count($tree_height3);
        echo $treeheight4 = count($tree_height4);
        echo $treeheight5 = count($tree_height5);*/

        $treeheight1 = count($tree_height1);       
        $treeheight2 = count($tree_height2);
        $treeheight3 = count($tree_height3);
        $treeheight4 = count($tree_height4);
        $treeheight5 = count($tree_height5);

        return view('managerpanel.dashboard',compact('data','task','todo','inprogress','done','managerName','managerimage','manager','agecount1','agecount2','agecount3','agecount4','agecount5','agecount6','treeheight1','treeheight2','treeheight3','treeheight4','treeheight5','New','Checked','Report'));
    }
}
