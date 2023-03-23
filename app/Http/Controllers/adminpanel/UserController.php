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

class UserController extends Controller
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
            'Users' => Manager::query()->where('user_type','Manager')->count() + Admin::query()->where('user_type','Admin')->count() + User::query()->where('user_type','TreeOperator')->count(),
            'Managers' => Manager::count(),
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );

        $manager = Manager::query()->get();

        $admin1 = Admin::query()->where('user_type','Admin')->where('id','!=',9)->orderby('id','desc')->paginate($this->pagination);

        $manager = Manager::query()->where('user_type','Manager')->orderby('id','desc')->paginate($this->pagination);
        $user = User::query()->where('user_type','TreeOperator')->orderby('id','desc')->paginate($this->pagination);

        /*for ($a=0; $a < count($admin); $a++) 
        { 
            $data[] = array(
                    'id' => $admin[$a]->id,
                    'first_name' => $admin[$a]->first_name,
                    'last_name' => $admin[$a]->last_name,
                    'email' => $admin[$a]->email,
                    'user_type' => $admin[$a]->user_type,
                    'userImage' => $admin[$a]->userImage,
            );
        }

        for ($a=0; $a < count($manager); $a++) 
        { 
            $data[] = array(
                    'id' => $manager[$a]->id,
                    'first_name' => $manager[$a]->first_name,
                    'last_name' => $manager[$a]->last_name,
                    'email' => $manager[$a]->email,
                    'user_type' => $manager[$a]->user_type,
                    'managerImage' => $manager[$a]->managerImage,
            );
        }

        for ($a=0; $a < count($user); $a++) 
        { 
            $data[] = array(
                    'id' => $manager[$a]->id,
                    'first_name' => $manager[$a]->first_name,
                    'last_name' => $manager[$a]->last_name,
                    'email' => $manager[$a]->email,
                    'user_type' => $manager[$a]->user_type,
                    'userImage' => $manager[$a]->userImage,
            );
        }*/
        return view('adminpanel.manageuser', compact('data1','adminName','manager','admin1','admin','manager','user','adminimage'));

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

        $manager = Manager::query()->get();

        $input = $request->all();

        $qry = User::query()->where('user_type','TreeOperator'); 

        if(trim($input["search"])!="") 
        {
            $search = $input["search"];
            $qry->where([
                ["first_name", "like", "%{$search}%"],
            ]);

            $qry->orwhere([
                ["email", "like", "%{$search}%"],
            ]);
        }

        $user = $qry->paginate($this->pagination);

        $user->appends($input);

        $qry = Admin::query()->where('user_type','Admin')->where('id','!=',9); 

        if(trim($input["search"])!="") 
        {
            $search = $input["search"];
            $qry->where([
                ["first_name", "like", "%{$search}%"],
            ]);

            $qry->orwhere([
                ["email", "like", "%{$search}%"],
            ]);
        }

        $admin1 = $qry->paginate($this->pagination);

        $admin1->appends($input);

        $qry = Manager::query()->where('user_type','Manager'); 

        if(trim($input["search"])!="") 
        {
            $search = $input["search"];
            $qry->where([
                ["first_name", "like", "%{$search}%"],
            ]);

            $qry->orwhere([
                ["email", "like", "%{$search}%"],
            ]);
        }

        $manager = $qry->paginate($this->pagination);

        $manager->appends($input);

        return view('adminpanel.manageuser', compact('adminName','data1','manager','admin','adminimage','admin1','user','manager'));

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

        return view('adminpanel.adduser', compact('data','data1','manager','adminName','admin','adminimage'));
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|min:6',
            'first_name' => 'required|unique:users',
            'last_name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
        ]);
        $input = $request->all();
       
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
        $input['password'] = bcrypt($input['password']);
        $input['user_type'] = "TreeOperator";

        $user = User::create($input);
        if($user->id>0) 
        {
            return redirect()->route('adminpanel.user.manage')->withErrors('success', 'Created successfully.');
        } 
        else 
        {
            return redirect()->route('adminpanel.user.add')->withErrors(['wrongInputs','Error creating record. Please try again.']);
        }
       
    }

    public function save11(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|min:6',
            'first_name' => 'required|unique:users',
            'last_name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
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

        

        $manager = Manager::query()->get();

        //$validator=Validator::make($input,$this->getRules('Add',$input),$this->messages());
            // $validationRule = ['first_name' => 'required','last_name'=>'required'];
            // $validationMsg = ['first_name.required' => 'First Name is required', 'last_name.required' => 'Last Name is required'];

            // $validator = Validator::make(['first_name' => $input['first_name'], 'last_name' => $input['last_name']], $validationRule, $validationMsg);

            //     $validator->after(function ($validator) use ($input) {
            //         $checkName = User::where('first_name', $input['first_name'])->where('last_name', $input['last_name'])->get();
            //         $checkName1 = User::where('email', $input['email'])->get();
            //         if (count($checkName) > 0) {
            //             $validator->errors()->add('first_name', 'User already exists, please enter another user.');
            //         }
            //         if (count($checkName1) > 0) {
            //             $validator->errors()->add('email', 'Email already exists, please enter another email.');
            //         }
            //     });

        

        // if($validator->fails())
        // {
        //     $data = array('type'=>'add','manager' => $manager,'input'=>$input,'adminName' => $adminName,'data1'=>$data1,'error'=>$validator->messages());
        //     return view('adminpanel.adduser', compact('data','adminName','data1','manager','admin','adminimage'));
        //     exit();
        // }

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
        $input['password'] = bcrypt($input['password']);
        $input['user_type'] = "TreeOperator";

        $user = User::create($input);
        if($user->id>0)
        {
            return redirect()->route('adminpanel.user.manage')->withErrors('success', 'Created successfully.');
           // return redirect()->route('adminpanel.user.manage')->with('success', 'Created successfully.');
        } 
        else 
        {
            return redirect()->route('adminpanel.user.add')->withErrors(['Error creating record. Please try again.']);
        }
        /*if($input['user_type'] == "Admin")
        {
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
            $input['password'] = bcrypt($input['password']);

            $user = Admin::create($input);
            if($user->id>0)
            {
                return redirect()->route('adminpanel.user.manage')->with('success', 'Created successfully.');
            } 
            else 
            {
                return redirect()->route('adminpanel.user.add')->withErrors(['Error creating record. Please try again.']);
            }
        }
        if($input['user_type'] == "Manager")
        {
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

            $user = Manager::create($input);

            if($user->id>0)
            {
                return redirect()->route('adminpanel.user.manage')->with('success', 'Created successfully.');
            } 
            else 
            {
                return redirect()->route('adminpanel.user.add')->withErrors(['Error creating record. Please try again.']);
            }
        }
        if($input['user_type'] == "TreeOperator")
        {
            $filename = "";
            if(isset($input["userImage"])) {
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
            }
        }*/
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

        $loginUserId = AUTH::user()->id;

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

        $input = User::where('id', '=', $id)->get();
        /*$admin = Admin::query()->where('id', '=', $id)->where('user_type','Admin')->get();

        $manager = Manager::query()->where('id', '=', $id)->where('user_type','Manager')->get();

        for ($a=0; $a < count($admin); $a++) 
        { 
            $input[] = array(
                    'id' => $admin[$a]->id,
                    'first_name' => $admin[$a]->first_name,
                    'last_name' => $admin[$a]->last_name,
                    'email' => $admin[$a]->email,
                    'user_type' => $admin[$a]->user_type,
                    'userImage' => $admin[$a]->userImage,
            );
        }

        for ($a=0; $a < count($manager); $a++) 
        { 
            $input[] = array(
                    'id' => $manager[$a]->id,
                    'first_name' => $manager[$a]->first_name,
                    'last_name' => $manager[$a]->last_name,
                    'email' => $manager[$a]->email,
                    'user_type' => $manager[$a]->user_type,
                    'managerImage' => $manager[$a]->managerImage,
            );
        }*/
        $data = array('type'=>'edit','manager' => $manager, 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts);

        return view('adminpanel.adduser', compact('data','manager','adminName','data1','input','admin','adminimage'));

    }



    public function update(Request $request)
    {

        $input = $request->all();
        $id = $input['id'];

        //echo "<br>";
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

        $validator = Validator::make( $input, $this->getRules('Edit', $input), $this->messages()); 

        
        if ($validator->fails()) 
        { 
            $how_hear_abouts = array();
            $data = array('type'=>'Edit', 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts, 'error'=>$validator->messages());

            return view('adminpanel.adduser', compact('data','admin','adminimage','adminName'));
            exit();
        }

        $update = array();

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
        if(isset($input["password"])) 
        {
            $update['password'] = bcrypt($input['password']);
        }
        $update["first_name"] = $input['first_name'];
        $update["last_name"] = $input['last_name'];
        $update["email"] = $input['email'];
        $update["phone"] = $input['phone'];
        $update["user_type"] = "TreeOperator";

        $user = User::where('id', '=', $id)->update($update);

        return redirect()->route('adminpanel.user.manage')->with('success', 'Updated successfully.');
        /*if($input['user_type'] == "Admin")
        {
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

            $update["user_type"] = $input['user_type'];
            $update["first_name"] = $input['first_name'];
            $update["last_name"] = $input['last_name'];
            $update["email"] = $input['email'];
            $update["phone"] = $input['phone'];

            $user = Admin::where('id', '=', $id)->update($update);

            return redirect()->route('adminpanel.user.manage')->with('success', 'Updated successfully.');
        }
        else if($input['user_type'] == "Manager")
        {
            if(isset($input["managerImage"])) 
            {
                $imagePath = request('managerImage');// $input["userImage"];
                $filename = rand(0000,9999).$imagePath->getClientOriginalName();
                $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = rand(0000,9999)."managerpic.".$extension;
                $upload_dir_path = public_path()."/uploads/managerImages";
                $imagePath->move($upload_dir_path, $filename ); 
                $update['managerImage'] = $filename;
            }

            $update["user_type"] = $input['user_type'];
            $update["first_name"] = $input['first_name'];
            $update["last_name"] = $input['last_name'];
            $update["email"] = $input['email'];
            $update["phone"] = $input['phone'];

            $user = Manager::where('id', '=', $id)->update($update);
            
            return redirect()->route('adminpanel.user.manage')->with('success', 'Updated successfully.');
        }*/
    }

    public function delete($id) 
    {
        User::where('id','=',$id)->delete();

        return redirect()->route('adminpanel.user.manage')->with('success', 'Deleted successfully.');
    }

    private function getRules($type, $input)
    {

        $return = array();
        $return['first_name'] = 'required|max:30';
        $return['last_name'] = 'required|max:30';
        $return['password'] = 'required|min:6|max:20';
        if($type=="Edit") 
        {
            $return['email'] = 'required|email|max:100';
        } 
        else 
        {
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