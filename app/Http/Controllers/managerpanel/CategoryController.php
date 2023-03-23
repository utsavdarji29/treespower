<?php

namespace App\Http\Controllers\managerpanel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Admin;
use App\Models\User;
use App\Models\Job;
use App\Models\Manager;
use Validator;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    private $pagination = 20;

    public function manage() {
        $data = Category::query()->paginate($this->pagination);
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
            'Category' => Category::count(),
            'Users' => User::count(),
            'Managers' => Manager::count(),
            'To do' => Job::where('status',1)->count(),
            'In progress' => Job::where('status',2)->count(),
            'Done' => Job::where('status',3)->count(),
            'Task' => Job::where('status',1)->count() + Job::where('status',2)->count() + Job::where('status',3)->count(),
        );
        return view('managerpanel.managecategory', compact('data','managerName','managerimage','data1','manager'));
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
        $qry = Category::query(); 
        if(trim($input["search"])!="") {
            $search = $input["search"];
            $qry->where([
                ["category_title", "like", "%{$search}%"],
            ]);
        }
        $data = $qry->paginate($this->pagination);
        $data->appends($input);
        return view('managerpanel.managecategory', compact('data','data1','managerName','managerimage','manager'));
    }
     public function add() 
    {    
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
        $data = array('type'=>'add');
        return view('managerpanel.addcategory', compact('data','managerName','managerimage','data1','manager'));
    }

    public function save(Request $request) {
        $input = $request->all();
       /* $getEmail = User::where('email', '=', $input['email'])->get();
        if (count($getEmail) > 0) { 
            
            $data = array('type'=>'add', 'input'=>$input);
            return view('adminpanel.adduser', compact('data'))->withErrors(['Email Already Found in Our System.']);
            exit();            
        }*/

        $validator=Validator::make($input,$this->getRules('Add',$input),$this->messages());

        if($validator->fails())
        {
            $data = array('type'=>'add','input'=>$input,'error'=>$validator->messages());
            return view('managerpanel.addcategory', compact('data'));
            exit();
        }
        
        $category = Category::create($input);
        if($category->id>0) {
            return redirect()->route('managerpanel.category.manage')->with('success', 'Created successfully.');
        } else {
            return redirect()->route('managerpanel.category.add')->withErrors(['Error creating record. Please try again.']);
        }
    }

    public function edit($id) {
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
        $input = Category::where('id', '=', $id)->get();
        $data = array('type'=>'edit', 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts);
        return view('managerpanel.addcategory', compact('data','managerName','managerimage','data1','manager'));
    }

    public function update(Request $request) {
        $input = $request->all();
        $id = $input['id'];
       
        $update["category_title"] = $input['category_title'];

        $category = Category::where('id', '=', $id)->update($update);

        return redirect()->route('managerpanel.category.manage')->with('success', 'Updated successfully.');

    }

    public function delete($id) {
        Category::where('id','=',$id)->delete();
        return redirect()->route('managerpanel.category.manage')->with('success', 'Deleted successfully.');
    }

    private function getRules($type, $input) {
        $return = array();
        $return['category_title'] = 'required|max:30';
       
        return $return;
    }

    private function messages() {
        return [
            'category_title.required'  => $this->getRequiredMessage('category_title'),
            'category_title.max'  => $this->getGreaterMessage('category_title', 30),
        ];
    }

    private function getRequiredMessage($string) {
        return 'The ' . $string . ' field is required.';
    }

    private function getGreaterMessage($string, $maxchar) {
        return 'The ' . $string . ' may not be greater than ' . $maxchar . ' characters.';
    }
}
