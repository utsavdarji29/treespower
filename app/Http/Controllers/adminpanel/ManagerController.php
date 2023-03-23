<?php

namespace App\Http\Controllers\adminpanel;
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
     private $pagination = 10;

    public function manage() {
        $data = Manager::query()->orderby('id','desc')->paginate($this->pagination);
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
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );
        return view('adminpanel.managemanager', compact('data','data1','adminName','admin','adminimage'));
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
        return view('adminpanel.managemanager', compact('data','data1','adminName','admin','adminimage'));
    }

    public function add() 
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
                'Admin' => Admin::where('id','=',$loginUserId)->get(),
                'Admins' => Admin::count(),
                'Users' => User::count(),
                'Managers' => Manager::count(),
                'To do' => Job::where('status',1)->count(),
                'In progress' => Job::where('status',2)->count(),
                'Done' => Job::where('status',3)->count(),
                'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
            );
        $data = array('type'=>'add','adminName' => $adminName,'data1'=>$data1);
        return view('adminpanel.addmanager', compact('data','adminName','data1','admin','adminimage'));
    }

    public function save(Request $request) {

        $this->validate($request,[
            'password' => 'required|min:6',
        ]);
        $input = $request->all();

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

        $validationRule = ['first_name' => 'required','last_name'=>'required'];
            $validationMsg = ['first_name.required' => 'First Name is required', 'last_name.required' => 'Last Name is required'];

            $validator = Validator::make(['first_name' => $input['first_name'], 'last_name' => $input['last_name']], $validationRule, $validationMsg);

                $validator->after(function ($validator) use ($input) {
                    $checkName = Manager::where('first_name', $input['first_name'])->where('last_name', $input['last_name'])->get();
                    $checkName1 = Manager::where('email', $input['email'])->get();
                    if (count($checkName) > 0) {
                        $validator->errors()->add('first_name', 'Manager already exists, please enter another user.');
                    }
                    if (count($checkName1) > 0) {
                        $validator->errors()->add('email', 'Email already exists, please enter another email.');
                    }
                });
        if($validator->fails())
        {
            $data = array('type'=>'add','input'=>$input,'adminName' => $adminName,'data1'=>$data1,'error'=>$validator->messages());
            return view('adminpanel.addmanager', compact('data','adminName','data1','admin','adminimage'));
            exit();
        }

        $filename = "";
        if(isset($input["managerImage"])) {
            $imagePath = request('managerImage');// $input["userImage"];
            $filename = rand(0000,9999).$imagePath->getClientOriginalName();
            $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = rand(0000,9999)."userpic.".$extension;
            $upload_dir_path = public_path()."/uploads/managerImages";
            $imagePath->move($upload_dir_path, $filename );            
        }
        $input['managerImage'] = $filename;
        $input['password'] = bcrypt($input['password']);
        $input['user_type'] = "Manager";
        $manager = Manager::create($input);
        if($manager->id>0) {
            return redirect()->route('adminpanel.user.manage')->with('success', 'Created successfully.');
        } else {
            return redirect()->route('adminpanel.manager.add')->withErrors(['Error creating record. Please try again.']);
        }
    }

    public function edit($id) {
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
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );
        $how_hear_abouts = array();//How_hear_about::where("is_active", "=", "1")->pluck('name', 'id');
        $input = Manager::where('id', '=', $id)->get();
        $data = array('type'=>'edit', 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts);
        return view('adminpanel.addmanager', compact('data','adminName','data1','input','admin','adminimage'));
    }

    public function update(Request $request) {
        $input = $request->all();
        $id = $input['id'];
        //echo "<br>";
        /*$validator = Validator::make( $input, $this->getRules('Edit', $input), $this->messages()); 
        
        if ($validator->fails()) { 
            $how_hear_abouts = array();//How_hear_about::where("is_active", "=", "1")->pluck('name', 'id');
            $data = array('type'=>'Edit', 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts, 'error'=>$validator->messages());
            return view('adminpanel.adduser', compact('data'));
            exit();            
        }*/
        $update = array();

        if(isset($input["managerImage"])) {
            $imagePath = request('managerImage');// $input["userImage"];
            $filename = rand(0000,9999).$imagePath->getClientOriginalName();
            $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = rand(0000,9999)."userpic.".$extension;
            $upload_dir_path = public_path()."/uploads/managerImages";
            $imagePath->move($upload_dir_path, $filename ); 
            $update['managerImage'] = $filename;
        }
        if(isset($input["password"])) 
        {
            $update['password'] = bcrypt($input['password']);
        }
        $update["user_type"] = $input['user_type'];
        $update["first_name"] = $input['first_name'];
        $update["last_name"] = $input['last_name'];
        $update["email"] = $input['email'];
        $update["phone"] = $input['phone'];
        $update["user_type"] = "Manager";

        $manager = Manager::where('id', '=', $id)->update($update);

        return redirect()->route('adminpanel.user.manage')->with('success', 'Updated successfully.');

    }

    public function delete($id) {
        Manager::where('id','=',$id)->delete();
        return redirect()->route('adminpanel.user.manage')->with('success', 'Deleted successfully.');
    }

    private function getRules($type, $input) {
        $return = array();
        $return['first_name'] = 'required|max:30';
        $return['last_name'] = 'required|max:30';
        $return['password'] = 'required|min:6|max:20';
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

?>