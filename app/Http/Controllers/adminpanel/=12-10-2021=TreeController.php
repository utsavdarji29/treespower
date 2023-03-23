<?php

namespace App\Http\Controllers\adminpanel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tree;
use App\Models\Treeimage;
use App\Models\Admin;
use App\Models\User;
use App\Models\Manager;
use App\Models\Job;
use Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Pagination\Paginator;

class TreeController extends Controller 
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
            'Tree' => Tree::count(),
        );
        $manager = Manager::query()->get();
        $data = Tree::query()->orderby('id','desc')->get();//->paginate($this->pagination);
        $image = Treeimage::query()->get();
        return view('adminpanel.managetree', compact('data','data1','adminName','manager','admin','image','adminimage'));
    }
    public static function getTreeImages($treeid) 
    {
        $image = Treeimage::query()->where('tree_id',$treeid)->get();

        return $image;
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
        );
        $data = array('type'=>'add','adminName' => $adminName,'data1'=>$data1);
        return view('adminpanel.addtree', compact('data','data1','adminName','admin','adminimage'));
    }

    public function save(Request $request) 
    {
        $adminName = "";
        $adminimage = "";
        $loginUserId = AUTH::user()->id;
        $admin = Admin::where('id','=',$loginUserId)->get();
        $input = $request->all();
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
        );
        $validator = Validator::make( $input, $this->getRules('Add', $input), $this->messages());
        if ($validator->fails()) {
            $data = array('type'=>'add', 'input'=>$input, 'error'=>$validator->messages());
            return view('adminpanel.addtree', compact('data','adminName','admin','adminimage'));
            exit();            
        }
        
        $addtrees["address"] = $input['address'];
        $addtrees["location"] = $input['location'];
        $addtrees["species"] = $input['species'];
        $addtrees["height"] = $input['height'];
        $addtrees["trunk_diameter"] = $input['trunk_diameter'];
        $addtrees["defects"] = $input['defects'];
        $addtrees["comments"] = $input['comments']; 
        //$addtrees["manager_comments"] = $input['manager_comments']; 
        $addtrees["age_range"] = $input['age_range'];
        $addtrees["vitality"] = $input['vitality'];
        $addtrees["soil_type"] = $input['soil_type'];  
        $addtrees["treeid"] = $input['treeid'];  
        $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://treespower.com.sg/treespower/public/qrDemo/index.php?contentId='.$input['address'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result = json_decode($response, true);
 
            $success = $result['success'];  
            if($success == 1) 
            {
                $addtrees["qrImage"] = $result['fileName'];
               
            }
        $tree = Tree::create($addtrees);
        if($tree->id>0) {
            /*$treeId = $tree->id;
             
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://treespower.com.sg/treespower/public/qrDemo/index.php?contentId='.$treeId,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result = json_decode($response, true);
 
            $success = $result['success'];  
            if($success == 1) 
            {
                $update["qrImage"] = $result['fileName'];
                $user = Tree::where('id', '=', $treeId)->update($update);
            }*/
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
                        $addtreeimage['tree_id'] = $tree->id;
                        $addtreeimage['treeimage_date'] = date('Y-m-d');
                        $treeimage = Treeimage::create($addtreeimage);
                    }
                }
            }
            
            return redirect()->route('adminpanel.tree.manage')->with('success', 'Tree Created successfully.');
        } else {
            return redirect()->route('adminpanel.tree.add')->withErrors(['Error creating record. Please try again.']);
        }
    }


    public function addall() 
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
        );
        $data = array('type'=>'add','adminName' => $adminName,'data1'=>$data1);       
        return view('adminpanel.addtreeall', compact('data','adminName','admin','data1','adminimage'));
    }
    public function saveall(Request $request) 
    {
        $input = $request->all();
        
        if(isset($input["excel"])){
            $imagePath = $input["excel"];
            $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
        }

        if (($handle = fopen ($imagePath, 'r' )) !== FALSE) 
        {
            $flag = true;
            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) 
            {
               if($flag) { $flag = false; continue; }

                    echo "<br>".$treeid = $data [0];
                    echo "<br>".$address = $data [1];
                    echo "<br>".$location = $data [2];
                    echo "<br>".$species = $data [3];
                    echo "<br>".$height = $data [4];
                    echo "<br>".$trunk_diameter = $data [5];
                    echo "<br>".$defects = $data [6];
                    echo "<br>".$comments = $data [7];
                    echo "<br>".$age_range = $data [8];
                    echo "<br>".$vitality = $data [9];
                    echo "<br>".$soil_type = $data [10];
                    echo "<br>".$filename = $data [11];
                
                $getTree = Tree::where('treeid',$treeid)->get();
                if (count($getTree) > 0) 
                {
                    $addTree['treeid'] = $treeid;
                    $addTree['address'] = $address;
                    $addTree['location'] = $location;
                    $addTree['species'] = $species;
                    $addTree['height'] = $height;
                    $addTree['trunk_diameter'] = $trunk_diameter;
                    $addTree['defects'] = $defects;
                    $addTree['comments'] = $comments;
                    $addTree['age_range'] = $age_range;
                    $addTree['vitality'] = $vitality;
                    $addTree['soil_type'] = $soil_type;
                    

                    $tree = Tree::where('treeid',$treeid)->update($addTree);

                    $id = $getTree[0]->id;
                    //Treeimage::where('tree_id',$id)->delete();

                    $allImg = explode(',',$filename);
                        
                    for($g=0; $g < count($allImg); $g++)
                    {   
                        $getImage = Treeimage::query()
                                        ->where('tree_id','=',$id)
                                        ->where('treeImage','=',$allImg[$g])
                                        ->get();
                                        
                        if (count($getImage) <= 0) 
                        {
                            $addtreeimage['treeImage'] = $allImg[$g];
                            $addtreeimage['tree_id'] = $id;
                            $addtreeimage['treeimage_date'] = date('Y-m-d');
                            $treeimage = Treeimage::create($addtreeimage);
                        }
                    }
                }
                else 
                {
                    $addTree['treeid'] = $treeid;
                    $addTree['address'] = $address;
                    $addTree['location'] = $location;
                    $addTree['species'] = $species;
                    $addTree['height'] = $height;
                    $addTree['trunk_diameter'] = $trunk_diameter;
                    $addTree['defects'] = $defects;
                    $addTree['comments'] = $comments;
                    $addTree['age_range'] = $age_range;
                    $addTree['vitality'] = $vitality;
                    $addTree['soil_type'] = $soil_type;
                    

                    $tree = Tree::create($addTree);
                

                    if($tree->id>0) 
                    {
                        $allImg = explode(',',$filename);
                        for($g=0; $g < count($allImg); $g++)
                        {   
                            $addtreeimage['treeImage'] = $allImg[$g];
                            $addtreeimage['tree_id'] = $tree->id;
                            $addtreeimage['treeimage_date'] = date('Y-m-d');
                            $treeimage = Treeimage::create($addtreeimage);
                        }
                    }
                }
               
            }
            fclose ( $handle );
        }
         return redirect()->route('adminpanel.tree.manage')->with('success', 'Tree Created successfully.');
     
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
            'Admin' => Admin::where('id','=',$loginUserId)->get(),
            'Admins' => Admin::count(),
        );
        $images = Treeimage::where('tree_id', '=', $id)->get();
        $input = Tree::where('id','=', $id)->get();
        $data = array('type'=>'edit','input'=>$input);
        return view('adminpanel.addtree', compact('data','images','data1','adminName','admin','adminimage'));
    }

    public function update(Request $request) 
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
        );
        $input = $request->all();
        $id = $input['id'];

        $validator = Validator::make( $input, $this->getRules('Edit', $input), $this->messages()); 
        
        if ($validator->fails()) { 
            $data = array('type'=>'Edit', 'input'=>$input, 'error'=>$validator->messages());
            return view('adminpanel.addtree', compact('data','data1','adminName','admin','adminimage'));
            exit();            
        }
        $update = array();

     
        $update["address"] = $input['address'];
        $update["location"] = $input['location'];
        $update["species"] = $input['species'];
        $update["height"] = $input['height'];
        $update["trunk_diameter"] = $input['trunk_diameter'];
        $update["defects"] = $input['defects'];
        $update["comments"] = $input['comments']; 
        $update["age_range"] = $input['age_range'];
        $update["vitality"] = $input['vitality'];
        $update["soil_type"] = $input['soil_type']; 
        $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://treespower.com.sg/treespower/public/qrDemo/index.php?contentId='.$id,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result = json_decode($response, true);
 
            $success = $result['success'];  
            if($success == 1) 
            {
                $update["qrImage"] = $result['fileName'];
               
            }
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
                    $treeimage = Treeimage::create($addtreeimage);
                }
            }
        }
        return redirect()->route('adminpanel.tree.manage')->with('success', 'Tree Updated successfully.');

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

        return view('adminpanel.managetree', compact('data','adminName','data1','manager','admin','adminimage'));

    }

    public function delete($id)
    {
        $upload_dir_path = public_path()."/uploads/Tree_images";
       // $this->removeimage($upload_dir_path, $id);

        Tree::where('id','=',$id)->delete();
        return redirect()->route('adminpanel.tree.manage')->with('success', 'Tree Deleted successfully.');
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

    public function deletetreeimage($id)
    {
       $upload_dir_path = public_path()."/uploads/Tree_images";
        $this->removetreeimage($upload_dir_path, $id);

        Treeimage::where('id','=',$id)->delete();

        return redirect()->route('adminpanel.tree.manage')->with('success', 'Tree Image Deleted successfully.');
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
        $tree = Tree::where('id', '=', $id)->get();

        $treeimage = Treeimage::where('tree_id','=',$id)->get();

        return view('adminpanel.viewtree', compact('tree','treeimage','adminName','admin','adminimage'));
    }

    public function qrcode($id)
    {
        $data = Tree::where('id', '=', $id)->get();
        return view('adminpanel.qrcode',compact('data'));
    }

    private function getRules($type, $input) {
        $return = array();
        //$return['address'] = 'required';
        if($type=="Add") 
        {
            $return['treeid'] = 'required|unique:trees';
        } 
        return $return;
    }

    private function messages() {
        return [
            'treeid.required'  => $this->getRequiredMessage('treeid'),
            
        ];
    }

    private function getRequiredMessage($string) {
        return 'The ' . $string . ' field is required.';
    }

    private function getGreaterMessage($string, $maxchar) {
        return 'The ' . $string . ' may not be greater than ' . $maxchar . ' characters.';
    }
    public function exportCSV(Request $request)
    {
        $input = $request->all();

        if($input['file'] != '')
        {
            $filenm = str_replace(",", "-", $input['filename']);
            $save_folder_path = public_path() . '/adminpanel/csvfiles/' . $filenm;
            $txt = urldecode($input['file']);                        
            $myfile = fopen($save_folder_path, "w") or die("Unable to open file!");
            fwrite($myfile, $txt);
            fclose($myfile);
            echo "done";
        }
        else
        {
            echo "else";
        }
    }

    public function exportViewCSV(Request $request)
    {
        $input = $request->all();

        if($input['file'] != '')
        {
            $filenm = str_replace(",", "-", $input['filename']);
            $save_folder_path = public_path() . '/adminpanel/csvfiles/' . $filenm;
            $txt = urldecode($input['file']);                        
            $myfile = fopen($save_folder_path, "w") or die("Unable to open file!");
            fwrite($myfile, $txt);
            fclose($myfile);
            echo "done";
        }
        else
        {
            echo "else";
        }
    }
}