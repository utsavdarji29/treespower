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

class AdminController extends Controller 
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
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );
        $manager = Manager::query()->get();
        $data = Admin::query()->paginate($this->pagination);
        return view('adminpanel.manageadmin', compact('data','data1','adminName','manager','admin','adminimage'));
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

        $manager = Manager::query()->get();
        $data = array('type'=>'add','manager' => $manager,'adminName' => $adminName,'data1'=>$data1);

        return view('adminpanel.addadmin', compact('data','data1','manager','adminName','admin','adminimage'));
    }
    
    public function save(Request $request)
    {
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
        $validationMsg = ['first_name.required' => 'FirstName is required', 'last_name.required' => 'Lastname is required'];

        $validator = Validator::make(['first_name' => $input['first_name'], 'last_name' => $input['last_name']], $validationRule, $validationMsg);

            $validator->after(function ($validator) use ($input) {
                $checkName = Admin::where('first_name', $input['first_name'])->where('last_name', $input['last_name'])->get();
                $checkName1 = Admin::where('email', $input['email'])->get();
                if (count($checkName) > 0) {
                    $validator->errors()->add('first_name', 'Admin already exists, please enter another.');
                }
                if (count($checkName1) > 0) {
                    $validator->errors()->add('email', 'Email already exists, please enter another email.');
                }
            });

        $manager = Manager::query()->get();

        if($validator->fails())
        {
            $data = array('type'=>'add','manager' => $manager,'input'=>$input,'adminName' => $adminName,'data1'=>$data1,'error'=>$validator->messages());
            return view('adminpanel.addadmin', compact('data','adminName','data1','manager','admin','adminimage'));
            exit();
        }

        /*$filename = "";
        if(isset($input["userImage"]))
        {
            $imagePath = request('userImage');// $input["userImage"];
            $filename = rand(0000,9999).$imagePath->getClientOriginalName();
            $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = rand(0000,9999)."userpic.".$extension;
            $upload_dir_path = public_path()."/uploads/userImages";
            $imagePath->move($upload_dir_path, $filename );
        }
        $input['userImage'] = $filename;
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        if($user->id>0)
        {
            return redirect()->route('adminpanel.user.manage')->with('success', 'Created successfully.');
        } 
        else 
        {
            return redirect()->route('adminpanel.user.add')->withErrors(['Error creating record. Please try again.']);
        }*/
        
           // $input['userImage'] = $filename;
            $filename = "";
            if(isset($input["userImage"]))
            {
                $imagePath = request('userImage');// $input["userImage"];
                $filename = rand(0000,9999).$imagePath->getClientOriginalName();
                $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = rand(0000,9999)."userpic.".$extension;
                $upload_dir_path = public_path()."/uploads/userImages";
                $imagePath->move($upload_dir_path, $filename );
            }
            $input['userImage'] = $filename;
            $input["first_name"] = $input['first_name'];
            $input["last_name"] = $input['last_name'];
            $input["email"] = $input['email'];
            $input["phone"] = $input['phone'];
            $input['password'] = bcrypt($input['password']);
            $input['user_type'] = "Admin";
            $user = Admin::create($input);
            if($user->id>0)
            {
                return redirect()->route('adminpanel.user.manage')->with('success', 'Created successfully.');
            } 
            else 
            {
                return redirect()->route('adminpanel.admin.add')->withErrors(['Error creating record. Please try again.']);
            }
        
        /*if($user->id>0)
        {
            return redirect()->route('adminpanel.user.manage')->with('success', 'Created successfully.');
        } 
        else 
        {
            return redirect()->route('adminpanel.user.add')->withErrors(['Error creating record. Please try again.']);
        }*/
    }
    public function edit($id) 
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
         
        $how_hear_abouts = array();
        $manager = Manager::query()->get();
        $input = Admin::where('id', '=', $id)->get();
        $data = array('type'=>'edit','manager' => $manager, 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts);
        return view('adminpanel.addadmin', compact('data','manager','adminName','data1','input','admin','adminimage'));
    }

    public function update(Request $request) 
    {
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
        $id = $input['id'];
        //echo "<br>";
        $validator = Validator::make( $input, $this->getRules('Edit', $input), $this->messages()); 
        
        if ($validator->fails()) { 
            $how_hear_abouts = array();
            $data = array('type'=>'Edit', 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts, 'error'=>$validator->messages());
            return view('adminpanel.addadmin', compact('data','adminName','data1','input','admin','adminimage'));
            exit();            
        }
        $update = array();
        if(isset($input["password"])) 
        {
            $update['password'] = bcrypt($input['password']);
        }
        if(isset($input["userImage"]))
        {
            $imagePath = request('userImage');// $input["userImage"];
            $filename = rand(0000,9999).$imagePath->getClientOriginalName();
            $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = rand(0000,9999)."userpic.".$extension;
            $upload_dir_path = public_path()."/uploads/userImages";
            $imagePath->move($upload_dir_path, $filename );
            $update['userImage'] = $filename;
        }
        
        $update["first_name"] = $input['first_name'];
        $update["last_name"] = $input['last_name'];
        $update["email"] = $input['email'];
        $update["phone"] = $input['phone'];
        $update["user_type"] = "Admin";

        $admin = Admin::where('id', '=', $id)->update($update);

        return redirect()->route('adminpanel.user.manage')->with('success', 'Updated successfully.');

    }

    public function delete($id) 
    {
        Admin::where('id','=',$id)->delete();

        return redirect()->route('adminpanel.user.manage')->with('success', 'Deleted successfully.');
    }

    private function getRules($type, $input) 
    {
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

    private function messages() 
    {
        return [
            'first_name.required'  => $this->getRequiredMessage('first_name'),
            'first_name.max'  => $this->getGreaterMessage('first_name', 30),
            'last_name.required'  => $this->getRequiredMessage('last_name'),
            'last_name.max'  => $this->getGreaterMessage('last_name', 30),
        ];
    }

    private function getRequiredMessage($string) 
    {
        return 'The ' . $string . ' field is required.';
    }

    private function getGreaterMessage($string, $maxchar) 
    {
        return 'The ' . $string . ' may not be greater than ' . $maxchar . ' characters.';
    }
  
}

?>