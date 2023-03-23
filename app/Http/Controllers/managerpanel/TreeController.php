<?php

namespace App\Http\Controllers\managerpanel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Manager;
use App\Models\Admin;
use App\Models\Job;
use App\Models\Tree;
use App\Models\Treeimage;
use Validator;
use Illuminate\Pagination\Paginator;
use DB;

class TreeController extends Controller
{
     private $pagination = 10;

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
        $data = Tree::query()->orderby('updated_at','desc')->paginate($this->pagination);
        return view('managerpanel.managetree', compact('data1','data','managerName','managerimage','manager'));
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
        $qry = Tree::query(); 

        if(trim($input["search"])!="") 
        {
            $search = $input["search"];
            $qry->where([
                ["address", "like", "%{$search}%"],
            ]);
            $qry->orwhere([
                ["treeid", "like", "%{$search}%"],
            ]);
            $qry->orwhere([
                ["location", "like", "%{$search}%"],
            ]);
        }
        $data = $qry->paginate($this->pagination);
        $data->appends($input);
        return view('managerpanel.managetree', compact('data','data1','managerimage','managerName','manager'));
    }

    /*public function add() 
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
    }*/

    /*public function save(Request $request) 
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
    }*/

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
        $images = Treeimage::where('tree_id', '=', $id)->where('status','=',0)->get();
        $input = Tree::where('id','=', $id)->get();
        $data = array('type'=>'edit', 'input'=>$input, 'how_hear_abouts'=>$how_hear_abouts);
        return view('managerpanel.addtree', compact('data','images','data1','managerimage','managerName','manager'));
    }

    public function update(Request $request) 
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
       $input = $request->all();
        $id = $input['id'];
        $validator = Validator::make( $input, $this->getRules('Edit', $input), $this->messages()); 
        
        if ($validator->fails()) { 
            $data = array('type'=>'Edit', 'input'=>$input, 'error'=>$validator->messages());
            return view('managerpanel.addtree', compact('data','data1','managerimage','managerName','manager'));
            exit();            
        }
        $update = array();

        $loginUserId = AUTH::user()->id;
        $manager = Manager::where('id','=',$loginUserId)->get();
        
        if (count($manager)>0) 
        {
            $managerName = $manager[0]->first_name." ".$manager[0]->last_name;
            
        }
        $update["updated_id"] = $managerName;

        $update["address"] = $input['address'];
        $update["location"] = $input['location'];
        $update["species"] = $input['species'];
        $update["height"] = $input['height'];
        $update["trunk_diameter"] = $input['trunk_diameter'];
        $data = $input['date_planted'];
        $timestemp = strtotime($data);
        $update["date_planted"] = date("m/d/Y",$timestemp);
        $date2 = date('m/d/Y');

        $diff = abs(strtotime($date2) - strtotime($data));
        $years = floor($diff / (365*60*60*24));

        if ($input['date_planted'] == '') {
            $age_range = "0 to 10 years";
        }
        elseif ($years >= 0 && $years <= 10) {
            $age_range = "0 to 10 years";
        }
        elseif ($years >= 11 && $years <= 30) {
            $age_range = "11 to 30 years";
        }
        elseif ($years >= 31 && $years <= 50) {
            $age_range = "31 to 50 years";
        }
        elseif ($years >= 51 && $years <= 80) {
            $age_range = "51 to 80 years";
        }
        elseif ($years >= 81 && $years <= 100) {
            $age_range = "81 to 10 years0";
        }
        elseif ($years > 100){
            $age_range = "Above 100 years";
        }
        else{
            $age_range = "0 to 10 years";
        }
        
        //$update["defects"] = $input['defects'];
        $update["comments"] = $input['comments']; 
        $update["age_range"] = $age_range;
        $update["vitality"] = $input['vitality'];
        $update["soil_type"] = $input['soil_type']; 
        date_default_timezone_set('Asia/Singapore'); 
        $t_date = date("Y-m-d h:i:s");

        $update['updatedDate'] = $t_date;
        
        $tree = Tree::where('id', '=', $id)->update($update);
        
        if(isset($request['treeImage']) && count($request['treeImage']) > 0)
        {            
            for($g=0; $g <= count($request['treeImage']); $g++)
            {   
                if(isset($request['treeImage'][$g])) 
                {                    
                    $imagePath = $request['treeImage'][$g];
                    $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
                    $filename = rand(0000,9999)."treesImage.".$extension;
                    $upload_dir_path = public_path()."/uploads/Tree_Images";
                    $imagePath->move($upload_dir_path, $filename );
                    $addtreeimage['treeImage'] = $filename;
                    $addtreeimage['tree_id'] = $id;
                    $addtreeimage['treeimage_date'] = date('Y-m-d');
                    $addtreeimage['status'] = 0;
                    $treeimage = Treeimage::create($addtreeimage);
                }
            }
        }
        $curl = curl_init();
        
        $link = 'http://treespower.com.sg/treespower/viewtree/'.$id;
        $qrlink = urlencode($link);

        curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://treespower.com.sg/treespower/public/qrDemo/index.php?contentId='.$qrlink,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 60,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            
            curl_close($curl);
            $result = json_decode($response, true);
            // echo "<pre>"; print_r($result); echo "</pre>"; exit();
            $success = isset($result['success']) ? $result['success'] : 1;  
            if($success == 1) 
            {
                $update["qrImage"] = $result['fileName'];
               
            }
        $treeqr = Tree::where('id', '=', $id)->update($update);
        return redirect()->route('managerpanel.tree.manage')->with('success', 'Tree Updated successfully.');

    }
 public function delete($id)
    {
        $upload_dir_path = public_path()."/uploads/Tree_images";
        $this->removeimage($upload_dir_path, $id);

        Tree::where('id','=',$id)->delete();
        return redirect()->route('managerpanel.tree.manage')->with('success', 'Tree Deleted successfully.');
    }

    private function removeimage($imagepath, $id) {
        $treeimage = Treeimage::where('id', '=', $id)->get();
        if($treeimage[0]->treeImage!=null && $treeimage[0]->treeImage!="") {
            if(file_exists($imagepath.'\\'.$treeimage[0]->treeImage)) {
                unlink($imagepath.'\\'.$treeimage[0]->treeImage);
            }
        }
        return true;
    }

    /*public function deletetreeimage($id)
    {
       $upload_dir_path = public_path()."/uploads/Tree_images";
        $this->removetreeimage($upload_dir_path, $id);

        Treeimage::where('id','=',$id)->delete();

        return redirect()->route('managerpanel.tree.manage')->with('success', 'Tree Image Deleted successfully.');
    }*/

     public function deletetreeimage($id)
    {
        $upload_dir_path = public_path()."/uploads/Tree_images";
        $this->removetreeimage($upload_dir_path, $id);

        $treeImages = Treeimage::where('id','=',$id)->get();
        if(count($treeImages) > 0)
        {
            //$update['treeImage'] = '';
            $update['status'] = 1;

            $treeimage = Treeimage::where('id','=',$id)->update($update);

            $treei = DB::table('treeimages')
                ->select('treeimages.*','trees.id as tid')
                ->join('trees','treeimages.tree_id','trees.id')
                ->where('treeimages.status','=',1)
                ->where('treeimages.id',$id)
                ->get();

            if($treei)
            {
                $loginUserId = AUTH::user()->id;
                $manager = Manager::where('id','=',$loginUserId)->get();
                
                if (count($manager)>0) 
                {
                    $managerName = $manager[0]->first_name." ".$manager[0]->last_name;
                    
                }
                date_default_timezone_set('Asia/Singapore'); 
                $t_date = date("Y-m-d h:i:s");
                $update1["updated_id"] = $managerName;
                

                $update1['updatedDate'] = $t_date;
                $treeiu = Tree::query()->where('id','=',$treei[0]->tree_id)->update($update1);


            }
        }
           
        return redirect()->route('managerpanel.tree.manage')->with('success', 'Tree Image Deleted successfully.');
    }
    private function removetreeimage($imagepath, $id)
    {
        $postimg = Treeimage::where('id', '=', $id)->get();
        if($postimg[0]->treeImage!=null && $postimg[0]->treeImage!="")
        {       
            if(file_exists($imagepath.'/'.$postimg[0]->treeImage))
            {
                unlink($imagepath.'/'.$postimg[0]->treeImage);
            }
        }
        return true;
    }

    public function view($id) 
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
        $tree = Tree::where('id', '=', $id)->get();

        $treeimage = Treeimage::where('tree_id','=',$id)->where('status','=',0)->get();

        return view('managerpanel.viewtree', compact('tree','treeimage','managerimage','managerName','manager'));
    }

    private function getRules($type, $input) {
        $return = array();
        $return['address'] = 'required|max:30';
        
        
        return $return;
    }

    private function messages() {
        return [
            'address.required'  => $this->getRequiredMessage('address'),
            'address.max'  => $this->getGreaterMessage('address', 30),
            
        ];
    }

    private function getRequiredMessage($string) {
        return 'The ' . $string . ' field is required.';
    }

    private function getGreaterMessage($string, $maxchar) {
        return 'The ' . $string . ' may not be greater than ' . $maxchar . ' characters.';
    }
}