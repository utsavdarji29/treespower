<?php

namespace App\Http\Controllers\managerpanel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Manager;
use App\Models\Admin;
use App\Models\Job;
use Validator;
use Illuminate\Pagination\Paginator;

class ManagerController extends Controller
{
     private $pagination = 20;

    public function manage() 
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
            'Admins' => Admin::count(),
            'Users' => User::where('manager_id','=',$loginUserId)->count(),
            'Managers' => Manager::count(),
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );
        $data = Manager::where('id', '=', $loginUserId)->paginate($this->pagination);
        return view('managerpanel.managemanager', compact('data1','data','managerName','managerimage','manager'));
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
        $data1 = array(
            'Admins' => Admin::count(),
            'Users' => User::where('manager_id','=',$loginUserId)->count(),
            'Managers' => Manager::count(),
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );

        $input = $request->all();
        $qry = Manager::query(); 
        if(trim($input["search"])!="") {
            $search = $input["search"];
            $qry->where([
                ["first_name", "like", "%{$search}%"],
            ]);
            $qry->orwhere([
                ["email", "like", "%{$search}%"],
            ]);
        }
        $data = $qry->paginate($this->pagination);
        $data->appends($input);
        return view('managerpanel.managemanager', compact('data','data1','managerimage','managerName','manager'));
    }

    public function add() 
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

        $data = array('type'=>'add','data1'=>$data1);
        return view('managerpanel.addmanager', compact('data','managerName','managerimage','data1','manager'));
    }

    public function save(Request $request) 
    {
        $input = $request->all();

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

        $validator=Validator::make($input,$this->getRules('Add',$input),$this->messages());

        if($validator->fails())
        {
            $data = array('type'=>'add','input'=>$input,'error'=>$validator->messages());
            return view('managerpanel.addmanager', compact('data','managerName','managerimage','data1','manager'));
            exit();
        }

        $filename = "";
        if(isset($input["managerImage"])) 
        {
            $imagePath = request('managerImage');// $input["userImage"];
            $filename = rand(0000,9999).$imagePath->getClientOriginalName();
            $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = rand(0000,9999)."managerpic.".$extension;
            $upload_dir_path = public_path()."/uploads/managerImages";
            $imagePath->move($upload_dir_path, $filename );            
        }
      
        $input['managerImage'] = $filename;
        $input['password'] = bcrypt($input['password']);
        
        $user = Manager::create($input);
        if($user->id>0) {
            return redirect()->route('managerpanel.manager.manage')->with('success', 'Created successfully.');
        } else {
            return redirect()->route('managerpanel.manager.add')->withErrors(['Error creating record. Please try again.']);
        }
    }

    public function edit($id) 
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
            'Admins' => Admin::count(),
            'Users' => User::count(),
            'Managers' => Manager::count(),
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );

        $how_hear_abouts = array();//How_hear_about::where("is_active", "=", "1")->pluck('name', 'id');
        $input = Manager::where('id', '=', $id)->get();
        $data = array('type'=>'edit', 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts);
        return view('managerpanel.addmanager', compact('data','data1','managerimage','managerName','manager'));
    }

    public function update(Request $request) 
    {
        $input = $request->all();
        $id = $input['id'];
        $update = array();

        if(isset($input["managerImage"])) {
            $imagePath = request('managerImage');// $input["userImage"];
            $filename = rand(0000,9999).$imagePath->getClientOriginalName();
            $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = rand(0000,9999)."managerpic.".$extension;
            $upload_dir_path = public_path()."/uploads/managerImages";
            $imagePath->move($upload_dir_path, $filename ); 
            $update['managerImage'] = $filename;
        }

        $update["first_name"] = $input['first_name'];
        $update["last_name"] = $input['last_name'];
        $update["email"] = $input['email'];
        $update["phone"] = $input['phone'];
        if(isset($input["password"])) 
        {
            $update['password'] = bcrypt($input['password']);
        }

        $user = Manager::where('id', '=', $id)->update($update);

        return redirect()->route('managerpanel.dashboard')->with('success', 'Updated successfully.');

    }

    public function delete($id) {
        Manager::where('id','=',$id)->delete();
        return redirect()->route('managerpanel.manager.manage')->with('success', 'Deleted successfully.');
    }
    
    private function getRules($type, $input) {
        $return = array();
        $return['first_name'] = 'required|max:30';
        $return['last_name'] = 'required|max:30';
        if($type=="Edit") {
            $return['email'] = 'required|email|max:100';
        } else {
            $return['email'] = 'required|email|unique:users,email|max:100';
            $return['password'] = 'required|min:6|max:20';
        }
        return $return;
    }

    private function messages() {
        return [
            'first_name.required'  => $this->getRequiredMessage('first_name'),
            'first_name.max'  => $this->getGreaterMessage('first_name', 30),
            'last_name.required'  => $this->getRequiredMessage('last_name'),
            'last_name.max'  => $this->getGreaterMessage('last_name', 30),
        ];
    }

    private function getRequiredMessage($string) {
        return 'The ' . $string . ' field is required.';
    }

    private function getGreaterMessage($string, $maxchar) {
        return 'The ' . $string . ' may not be greater than ' . $maxchar . ' characters.';
    }
}
