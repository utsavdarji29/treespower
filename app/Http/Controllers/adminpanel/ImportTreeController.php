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

use Illuminate\Pagination\Paginator;

class ImportTreeController extends Controller 
{
	public function addall() 
    {
         $loginUserId = AUTH::user()->id;
            $admin = Admin::where('id','=',$loginUserId)->get();
            if (count($admin)>0) 
            {
                $adminName = $admin[0]->username;
               
            }
            $data1 = array(
            'Admin' => Admin::where('id','=',$loginUserId)->get(),
            'Admins' => Admin::count(),
        );
        $data = array('type'=>'add','adminName' => $adminName,'data1'=>$data1);       
        return view('adminpanel.addtreeall', compact('data','adminName','admin','data1'));
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
                if (count($getTree) <= 0) 
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
	                //$addTree['treeImage'] = $filename;
	            
	                $trees = Tree::create($addTree);
                }
	                
                //$trees->toObject();
                //$trees->skipRows(1);
                // if($trees->id>0) 
                // {
                    /*if(isset($request['treeImage']) && count($request['treeImage']) > 0)
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
                                $addtreeimage['tree_id'] = $trees->id;
                                $addtreeimage['treeimage_date'] = date('Y-m-d');
                                $treeimage = Treeimage::create($addtreeimage);
                            }
                        }
                    }*/
                //}
            }
            fclose ( $handle );
        }
         return redirect()->route('adminpanel.tree.manage')->with('success', 'Tree Created successfully.');
     
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
    
}