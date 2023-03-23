<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Jobimage;
use Validator;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function get_task(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required', 
            'user_token' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $id = $input['user_id'];

        $msg1="Data found";
        $msg2="This User Data Is Not Found";
        $msg3="You are not authorized please login again";

        $verifiedUserId = Controller::checkToken($input['user_id'],$input['user_token']);
        if($verifiedUserId == $id)
		{
			
            $getJobId = Job::where('user_id', $id)->where('status', $request->type)->get();

	        if($getJobId->count())
	        {
                for ($g=0; $g < count($getJobId); $g++) 
                {

                   $taskData[] = array(
                        'task_id' => $getJobId[$g]->id,
                        'tree_id' => $getJobId[$g]->tree_id,
                        'job_title' => $getJobId[$g]->job_title,
                        'location' => $getJobId[$g]->location,
                        'address' => $getJobId[$g]->address,
                        'date' =>  $getJobId[$g]->job_date,
                        'time' => $getJobId[$g]->start_time." ".$getJobId[$g]->end_time,
                        'description' => $getJobId[$g]->description,
                        'tree_lat' => $getJobId[$g]->latitude,
                        'tree_long' => $getJobId[$g]->longitude,
                   );
                }

	        	return response()->json(['status'=>1,'message'=>$msg1, 'result'=>$taskData]);
	        }
	        else
            {
	        	return response()->json(['status'=>0,'message'=>$msg2]);
	        }
		}
        else
        {
            return response()->json(['status'=>0,'message'=>$msg3]);
        }
    }

    public function get_task_detail(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required', 
            'user_token' => 'required',
            'task_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $id = $input['user_id'];

        $msg1="Data found";
        $msg2="something is wrong. Please try again!";
        $msg3 = "You are not authorized please login again";

        $verifiedUserId = Controller::checkToken($input['user_id'],$input['user_token']);
        if($verifiedUserId == $id)
        {
            $getJobId = Job::query()
                            ->select('jobs.*','managers.first_name')
                            ->leftjoin('managers','jobs.manager_id','managers.id')
                            ->where('jobs.id','=',$request->task_id)
                            ->get();

            //$getJobId = Job::where('id', $request->task_id)->get();

            $update['status'] = 2;

            $updateJobId = Job::where('id', $request->task_id)->update($update);

            if($getJobId->count())
            {
                for ($g=0; $g < count($getJobId); $g++) 
                {

                   $taskData = array(
                        'task_id' => $getJobId[$g]->id,
                        'tree_id' => $getJobId[$g]->tree_id,
                        'address' => $getJobId[$g]->address,
                        'date' =>  $getJobId[$g]->job_date,
                        'time' => $getJobId[$g]->start_time." ".$getJobId[$g]->end_time,
                        'description' => $getJobId[$g]->description,
                        'tree_lat' => $getJobId[$g]->latitude,
                        'tree_long' => $getJobId[$g]->longitude,
                        'tasky_type' => $getJobId[$g]->status,
                        'location' => $getJobId[$g]->location,
                        'job_title' => $getJobId[$g]->job_title,
                        'manager_name' => $getJobId[$g]->first_name,
                   );
                }

                return response()->json(['status'=>1,'message'=>$msg1, 'result'=>$taskData]);
            }
            else
            {
                return response()->json(['status'=>0,'message'=>$msg2]);
            }
        }
        else{
                return response()->json(['status'=>0,'message'=>$msg3]);
        }
    }

    public function save_task(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required', 
            'user_token' => 'required',
            'task_id' => 'required',
            'species' => 'required', 
            'age_range' => 'required', 
            'vitality' => 'required',
            'solid_type' => 'required',
            'height' => 'required',
            'trunk_diametr' => 'required',
            'deffects' => 'required',
            'comment' => 'required',
            'image_counter' => 'required',

        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        //-------------------Message------------------------------
        $msg1 = "Task Added Successfully";
        $msg2 = "Task not added";
        $msg3 = "You are not authorized please login again";
        //-------------------Message------------------------------  

        $input = $request->all();
        $id = $input['user_id'];
                        
        $verifiedUserId = Controller::checkToken($input['user_id'],$input['user_token']);
        if($verifiedUserId == $id)
        {
            $update['species'] = $input['species'];
            $update['age_range'] = $input['age_range'];
            $update['vitality'] = $input['vitality'];
            $update['solid_type'] = $input['solid_type'];
            $update['height'] = $input['height'];
            $update['trunk_diametr'] = $input['trunk_diametr'];
            $update['deffects'] = $input['deffects'];
            $update['comment'] = $input['comment'];
            $update['status'] = 3;
            $update1['job_id'] = $input['task_id'];

            if($input['image_counter'] > 0)
            {
                for($g=1; $g <= $input['image_counter']; $g++)
                {
                    if(isset($input['image'.$g])) 
                    {
                        $imagePath = $input['image'.$g];
                        $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
                        $filename = rand(0000,9999)."userpic.".$extension;
                        $upload_dir_path = public_path()."/uploads/userImages";
                        $imagePath->move($upload_dir_path, $filename );
                        $update1['job_image'] = $filename;
                        $jobimage = Jobimage::create($update1);
                    }
                }
            }

            $job = Job::where('id', '=', $request->task_id)->where('user_id',$id)->update($update);

            if($job >= 0)
            {
                return response()->json(['status'=>1,'message'=>$msg1]); 
            }
            else
            {
                return response()->json(['status'=>0,'message'=>$msg2]); 
            }
        }
        else
        {
            return response()->json(['status'=>0,'message'=>$msg3]); 
        }
    }

    public function update_taskStatus(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required', 
            'user_token' => 'required',
            'task_id' => 'required',
            'task_status' => 'required',

        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        //-------------------Message------------------------------
        $msg1 = "Task Status Updated Successfully";
        $msg2 = "Task Status not Update";
        $msg3 = "You are not authorized please login again";
        //-------------------Message------------------------------  

        $input = $request->all();
        $id = $input['user_id'];
        $taskId = explode(',', $input['task_id']);
                        
        $verifiedUserId = Controller::checkToken($input['user_id'],$input['user_token']);
        if($verifiedUserId == $id)
        {
            $update['status'] = $input['task_status'];

            $job = Job::whereIn('id', $taskId)->update($update);

            if($job >= 0)
            {
                return response()->json(['status'=>1,'message'=>$msg1]); 
            }
            else
            {
                return response()->json(['status'=>0,'message'=>$msg2]); 
            }
        }
        else
        {
            return response()->json(['status'=>0,'message'=>$msg3]); 
        }
    }
}
