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
use App\import\ChunkReadFilter;
use Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB;
use Illuminate\Pagination\Paginator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

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
        $image = Treeimage::query()->where('status','=',0)->get();
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

        /* NEVER CHANGE THE ORDER OF BELOW ARRAY ELSE IT WILL AFFECT ON QR CODE */
        $addtrees["address"] = $input['address'];
        $addtrees["location"] = $input['location'];
        $addtrees["species"] = $input['species'];
        $addtrees["height"] = $input['height'];
        $addtrees["trunk_diameter"] = $input['trunk_diameter'];
        $data = $input['date_planted'];
        $timestemp = strtotime($data);
        $addtrees["date_planted"] = date("m/d/Y",$timestemp);
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

        //$addtrees["defects"] = $input['defects'];
        $addtrees["comments"] = $input['comments'];
        $addtrees["age_range"] = $age_range;
        $addtrees["vitality"] = $input['vitality'];
        $addtrees["soil_type"] = $input['soil_type'];
        $addtrees["treeid"] = $input['treeid'];
        
        $tree = Tree::create($addtrees);

        if($tree->id>0) {
            // $addtreeimage2 = array();
            // $addtreeimage2['treeImage'] = array();
            // $addtreeimage2['tree_id'] = $tree->id;
            // $addtreeimage2['treeimage_date'] = date('Y-m-d');
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
                        $addtreeimage['status'] = 0;
                        //$addtreeimage2['treeImage'][] = asset('/uploads/userImages/'.$filename);
                        // $addtreeimage2['tree_id'][] = $tree->id;
                        // $addtreeimage2['treeimage_date'][] = date('Y-m-d');
                        $treeimage = Treeimage::create($addtreeimage);
                    }
                }
            }
            // $addtreeimage['treeImage'] = 2.jpg;
            $curl = curl_init();
            
            /*$imageString = "@@IMAGEDATA@@";
            foreach($addtreeimage2 as $k => $v) {
                if($k=="treeImage") {
                    foreach($v as $v1) {
                        $imageString .= "@@@@".$v1;
                    }
                } else {
                    $imageString .= "@@O@@" . $v;
                }
            }*/

            /*$qrCodeData1 = urlencode(implode('@@@@', $addtrees));
            $qrCode = $qrCodeData1 . $imageString;*/

            $link = 'http://treespower.com.sg/treespower/viewtree/'.$tree->id;
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
                $addtreeqr["qrImage"] = $result['fileName'];
               
            }
            $treeqr = Tree::where('id', '=', $tree->id)->update($addtreeqr);
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
        ini_set('max_execution_time', 0);
        $the_file = $request->file('excel');

        /**  Identify the type of $inputFileName  **/
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($the_file);

        /**  Create a new Reader of the type that has been identified  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Define how many rows we want to read for each "chunk"  **/
        $chunkSize = 10;
        /**  Create a new Instance of our Read Filter  **/
        $chunkFilter = new ChunkReadFilter();

        /**  Tell the Reader that we want to use the Read Filter  **/
        $reader->setReadFilter($chunkFilter);

        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet1 = $spreadsheet->getActiveSheet();
        $highestRow = $sheet1->getHighestRow();

        /**  Loop to read our worksheet in "chunk size" blocks  **/
        for ($startRow = 2; $startRow <= $highestRow; $startRow += $chunkSize) {
            /**  Tell the Read Filter which rows we want this iteration  **/
            $chunkFilter->setRows($startRow, $chunkSize);

            $spreadsheet = $reader->load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $chunk = array_map('array_filter',$sheet->toArray(null, true, true, true));
            $chunk = array_filter($chunk);
            foreach ($chunk as $key => $row) {
               
                if ($key !== 1) {
                    $treeid = $row['A'];
                    $address = $row['B'];
                    $location = $row['A'];
                    $species = $row['D'];
                    $height = $row['E'];
                    $trunk_diameter = $row['F'];
                    $date_planted = date('Y-m-d', strtotime($row['G']));
                    $comments = $row['H'];
                    $age_range = $row['I'];
                    $vitality = $row['J'];
                    $soil_type = $row['K']; //$sheet->getCell('K' . $row)->getValue();

                    $getTree = Tree::where('treeid', $treeid)->get();
                    if (count($getTree) > 0) {
                        $addTree['treeid'] = $treeid;
                        $addTree['address'] = $address;
                        $addTree['location'] = $location;
                        $addTree['species'] = $species;
                        $addTree['height'] = $height;
                        $addTree['trunk_diameter'] = $trunk_diameter;
                        $addTree['date_planted'] = $date_planted;
                        $addTree['comments'] = $comments;
                        $addTree['age_range'] = $age_range;
                        $addTree['vitality'] = $vitality;
                        $addTree['soil_type'] = $soil_type;

                        $tree = Tree::where('treeid', (string)$treeid)->update($addTree);

                        $id = $getTree[0]->id;
                        foreach ($sheet->getDrawingCollection() as $drawing) {
                            $coordinagesData = $drawing->getCoordinates();
                            $coordinagesData = explode("L",$coordinagesData);
                            if (!empty($coordinagesData) && $coordinagesData[1] == $key) {
                                if ($drawing instanceof MemoryDrawing) {
                                    ob_start();
                                    call_user_func(
                                        $drawing->getRenderingFunction(),
                                        $drawing->getImageResource()
                                    );
                                    $imageContents = ob_get_contents();
                                    ob_end_clean();
                                    switch ($drawing->getMimeType()) {
                                        case MemoryDrawing::MIMETYPE_PNG:
                                            $extension = 'png';
                                            break;
                                        case MemoryDrawing::MIMETYPE_GIF:
                                            $extension = 'gif';
                                            break;
                                        case MemoryDrawing::MIMETYPE_JPEG:
                                            $extension = 'jpg';
                                            break;
                                    }
                                } else {
                                    if ($drawing->getPath()) {
                                        // Check if the source is a URL or a file path
                                        if ($drawing->getIsURL()) {
                                            $imageContents = file_get_contents($drawing->getPath());
                                            $filePath = tempnam(sys_get_temp_dir(), 'Drawing');
                                            file_put_contents($filePath, $imageContents);
                                            $mimeType = mime_content_type($filePath);
                                            // You could use the below to find the extension from mime type.
                                            // https://gist.github.com/alexcorvi/df8faecb59e86bee93411f6a7967df2c#gistcomment-2722664
                                            $extension = File::mime2ext($mimeType);
                                            unlink($filePath);
                                        } else {
                                            $zipReader = fopen($drawing->getPath(), 'r');
                                            $imageContents = '';
                                            while (!feof($zipReader)) {
                                                $imageContents .= fread($zipReader, 1024);
                                            }
                                            fclose($zipReader);
                                            $extension = $drawing->getExtension();
                                        }
                                    }
                                }
                                $myFileName = $drawing->getName() . '.' . $extension;
                                $id = $getTree[0]->id;
                                $getImage = Treeimage::query()
                                    ->where('tree_id', '=', $id)
                                    ->where('treeImage', '=', $myFileName)
                                    ->get();

                                if (count($getImage) <= 0) {
                                    $addtreeimage['treeImage'] = $myFileName;
                                    $addtreeimage['tree_id'] = $id;
                                    $addtreeimage['treeimage_date'] = date('Y-m-d');
                                    $addtreeimage['status'] = 0;
                                    $treeimage = Treeimage::create($addtreeimage);
                                    $upload_dir_path = public_path() . "/uploads/Tree_Images";
                                    file_put_contents($upload_dir_path . '/' . $myFileName, $imageContents);
                                }
                            }
                        }
                        $tree_id = $id;
                    } else {
                        $addTree['treeid'] = $treeid;
                        $addTree['address'] = $address;
                        $addTree['location'] = $location;
                        $addTree['species'] = $species;
                        $addTree['height'] = $height;
                        $addTree['trunk_diameter'] = $trunk_diameter;
                        $addTree['date_planted'] = $date_planted;
                        $addTree['comments'] = $comments;
                        $addTree['age_range'] = $age_range;
                        $addTree['vitality'] = $vitality;
                        $addTree['soil_type'] = $soil_type;

                        $tree = Tree::create($addTree);
                        $tree_id = $tree->id;
                        foreach ($sheet->getDrawingCollection() as $drawing) {
                            $coordinagesData = $drawing->getCoordinates();
                            $coordinagesData = explode("L",$coordinagesData);
                            if (!empty($coordinagesData) && $coordinagesData[1] == $key) {
                                if ($drawing instanceof MemoryDrawing) {
                                    ob_start();
                                    call_user_func(
                                        $drawing->getRenderingFunction(),
                                        $drawing->getImageResource()
                                    );
                                    $imageContents = ob_get_contents();
                                    ob_end_clean();
                                    switch ($drawing->getMimeType()) {
                                        case MemoryDrawing::MIMETYPE_PNG:
                                            $extension = 'png';
                                            break;
                                        case MemoryDrawing::MIMETYPE_GIF:
                                            $extension = 'gif';
                                            break;
                                        case MemoryDrawing::MIMETYPE_JPEG:
                                            $extension = 'jpg';
                                            break;
                                    }
                                } else {
                                    if ($drawing->getPath()) {
                                        // Check if the source is a URL or a file path
                                        if ($drawing->getIsURL()) {
                                            $imageContents = file_get_contents($drawing->getPath());
                                            $filePath = tempnam(sys_get_temp_dir(), 'Drawing');
                                            file_put_contents($filePath, $imageContents);
                                            $mimeType = mime_content_type($filePath);
                                            // You could use the below to find the extension from mime type.
                                            // https://gist.github.com/alexcorvi/df8faecb59e86bee93411f6a7967df2c#gistcomment-2722664
                                            $extension = File::mime2ext($mimeType);
                                            unlink($filePath);
                                        } else {
                                            $zipReader = fopen($drawing->getPath(), 'r');
                                            $imageContents = '';
                                            while (!feof($zipReader)) {
                                                $imageContents .= fread($zipReader, 1024);
                                            }
                                            fclose($zipReader);
                                            $extension = $drawing->getExtension();
                                        }
                                    }
                                }
                                $myFileName = $drawing->getName() . '.' . $extension;
                                $id = $tree->id;
                                $getImage = Treeimage::query()
                                    ->where('tree_id', '=', $id)
                                    ->where('treeImage', '=', $myFileName)
                                    ->get();

                                if (count($getImage) <= 0) {
                                    $addtreeimage['treeImage'] = $myFileName;
                                    $addtreeimage['tree_id'] = $tree->id;
                                    $addtreeimage['treeimage_date'] = date('Y-m-d');
                                    $addtreeimage['status'] = 0;
                                    $treeimage = Treeimage::create($addtreeimage);
                                    $tree_id = $tree->id;

                                    $upload_dir_path = public_path() . "/uploads/Tree_Images";
                                    file_put_contents($upload_dir_path . '/' . $myFileName, $imageContents);
                                }
                            }
                        }
                    }
                }
            }
        }
        // $input = $request->all();

        // if(isset($input["excel"])){
        //     $imagePath = $input["excel"];

        //     $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
        // }

        // if (($handle = fopen ($imagePath, 'r' )) !== FALSE) 
        // {
        //     $flag = true;
        //     while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) 
        //     {
        //         dd($data);
        //        if($flag) { $flag = false; continue; }

        //             echo "<br>".$treeid = $data[0];
        //             echo "<br>".$address = $data[1];
        //             echo "<br>".$location = $data[2];
        //             echo "<br>".$species = $data[3];
        //             echo "<br>".$height = $data[4];
        //             echo "<br>".$trunk_diameter = $data[5];
        //             echo "<br>".$date_planted = $data[6];
        //             echo "<br>".$comments = $data[7];
        //             echo "<br>".$age_range = $data[8];
        //             echo "<br>".$vitality = $data[9];
        //             echo "<br>".$soil_type = $data[10];
        //             echo "<br>".$filename = $data[11];
        //             dd($data);
        //         $getTree = Tree::where('treeid',$treeid)->get();

        //         if (count($getTree) > 0) 
        //         {
        //             $addTree['treeid'] = $treeid;
        //             $addTree['address'] = $address;
        //             $addTree['location'] = $location;
        //             $addTree['species'] = $species;
        //             $addTree['height'] = $height;
        //             $addTree['trunk_diameter'] = $trunk_diameter;
        //             $addTree['date_planted'] = $date_planted;
        //             $addTree['comments'] = $comments;
        //             $addTree['age_range'] = $age_range;
        //             $addTree['vitality'] = $vitality;
        //             $addTree['soil_type'] = $soil_type;


        //             $tree = Tree::where('treeid',$treeid)->update($addTree);

        //             $id = $getTree[0]->id;
        //             //Treeimage::where('tree_id',$id)->delete();

        //             $allImg = explode(',',$filename);

        //             for($g=0; $g < count($allImg); $g++)
        //             {   
        //                 $getImage = Treeimage::query()
        //                                 ->where('tree_id','=',$id)
        //                                 ->where('treeImage','=',$allImg[$g])
        //                                 ->get();

        //                 if (count($getImage) <= 0) 
        //                 {
        //                     $addtreeimage['treeImage'] = $allImg[$g];
        //                     $addtreeimage['tree_id'] = $id;
        //                     $addtreeimage['treeimage_date'] = date('Y-m-d');
        //                     $treeimage = Treeimage::create($addtreeimage);
        //                 }
        //             }
        //             $tree_id = $id;
        //         }
        //         else 
        //         {
        //             $addTree['treeid'] = $treeid;
        //             $addTree['address'] = $address;
        //             $addTree['location'] = $location;
        //             $addTree['species'] = $species;
        //             $addTree['height'] = $height;
        //             $addTree['trunk_diameter'] = $trunk_diameter;
        //             $addTree['date_planted'] = $date_planted;
        //             $addTree['comments'] = $comments;
        //             $addTree['age_range'] = $age_range;
        //             $addTree['vitality'] = $vitality;
        //             $addTree['soil_type'] = $soil_type;

        //             $tree = Tree::create($addTree);

        //             if($tree->id>0) 
        //             {
        //                 $allImg = explode(',',$filename);
        //                 for($g=0; $g < count($allImg); $g++)
        //                 {   
        //                     $addtreeimage['treeImage'] = $allImg[$g];
        //                     $addtreeimage['tree_id'] = $tree->id;
        //                     $addtreeimage['treeimage_date'] = date('Y-m-d');
        //                     $addtreeimage['status'] = 0;
        //                     $tree_id = $tree->id;
        //                     $treeimage = Treeimage::create($addtreeimage);
        //                 }
        //             }
        //         }

        //         $curl = curl_init();

        //         $link = 'http://treespower.com.sg/treespower/viewtree/'.$tree_id;
        //         $qrlink = urlencode($link);

        //         curl_setopt_array($curl, array(
        //           CURLOPT_URL => 'http://treespower.com.sg/treespower/public/qrDemo/index.php?contentId='.$qrlink,
        //           CURLOPT_RETURNTRANSFER => true,
        //           CURLOPT_ENCODING => '',
        //           CURLOPT_MAXREDIRS => 60,
        //           CURLOPT_TIMEOUT => 0,
        //           CURLOPT_FOLLOWLOCATION => true,
        //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //           CURLOPT_CUSTOMREQUEST => 'GET',
        //         ));

        //         $response = curl_exec($curl);

        //         curl_close($curl);
        //         $result = json_decode($response, true);

        //         $success = isset($result['success']) ? $result['success'] : 1;
        //         if($success == 1)
        //         {
        //             $addtreeqr["qrImage"] = $result['fileName'];
        //         }
        //         $treeqr = Tree::where('id', '=', $tree_id)->update($addtreeqr);
        //     }
        //     fclose ( $handle );
        // }
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
        $images = Treeimage::where('tree_id', '=', $id)->where('status','=',0)->get();
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

        /* NEVER CHANGE THE ORDER OF BELOW ARRAY ELSE IT WILL AFFECT ON QR CODE */
        $loginUserId = AUTH::user()->id;
        $admin = Admin::where('id','=',$loginUserId)->get();
        
        if (count($admin)>0) 
        {
            $adminName = $admin[0]->first_name." ".$admin[0]->last_name;
           
        }
        $update["updated_id"] = $adminName;
        
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
        //$update["treeid"] = $treeid;  
        //$addtrees["manager_comments"] = $input['manager_comments'];
        
        /*$curl = curl_init();

        $qrCodeData = urlencode(implode('@@@@', $update));
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://treespower.com.sg/treespower/public/qrDemo/index.php?contentId='.$qrCodeData,
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
           
        }*/
     
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
                $addtreeqr["qrImage"] = $result['fileName'];
               
            }
            $treeqr = Tree::where('id', '=', $id)->update($addtreeqr);
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
                $admin = Admin::where('id','=',$loginUserId)->get();
                
                if (count($admin)>0) 
                {
                    $adminName = $admin[0]->first_name." ".$admin[0]->last_name;
                   
                }
                $update1["updated_id"] = $adminName;

                $treeiu = Tree::query()->where('id','=',$treei[0]->tree_id)->update($update1);


            }
        }
           

        //$treei = Treeimage::query()->select('tree_id')->get();
        
        
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

        $treeimage = Treeimage::where('tree_id','=',$id)->where('status','=',0)->get();

        return view('adminpanel.viewtree', compact('tree','treeimage','adminName','admin','adminimage'));
    }

    public function qrcode($id)
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

        $data = Tree::where('id', '=', $id)->get();
        return view('adminpanel.qrcode',compact('data','adminName','admin','adminimage'));
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
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        ini_set ('gd.jpeg_ignore_warning', false);
        
        $treeData = Tree::with('treeImage')->orderby('id','desc')->get()->toArray();
        $finalArrayData = [];
        $fileName = 'treeReport_'.time().'.xls';

        if(!empty($treeData)){
            foreach($treeData as $key => $value){
                $finalArrayData[$key] = [
                    'treeid' => $value['treeid'],
                    'address' => $value['address'],
                    'location' => $value['location'],
                    'species' => $value['species'],
                    'height' => $value['height'],
                    'width' => $value['trunk_diameter'],
                    'date_planted' => date('d-m-Y',strtotime($value['date_planted'])),
                    'comments' => $value['comments'],
                    'age_range' => $value['age_range'],
                    'vitality' => $value['vitality'],
                    'soil_type' => $value['soil_type'],
                ];
                foreach($value['tree_image'] as $treeImage){
                    $finalArrayData[$key]['tree_image'][] = $treeImage['treeImage'];
                }
            }

            $spreadSheet = new Spreadsheet();
            $sheet = $spreadSheet->getActiveSheet();

            $sheet->setCellValue('A1', 'TreeId');
            $sheet->setCellValue('B1', 'Address');
            $sheet->setCellValue('C1', 'Location');
            $sheet->setCellValue('D1', 'Species');
            $sheet->setCellValue('E1', 'Height (meter)');
            $sheet->setCellValue('F1', 'Width (meter)');
            $sheet->setCellValue('G1', 'Date Planted');
            $sheet->setCellValue('H1', 'Comments');
            $sheet->setCellValue('I1', 'Age Range');
            $sheet->setCellValue('J1', 'Vitality');
            $sheet->setCellValue('K1', 'Soil Type');
            $sheet->setCellValue('L1', 'Tree Image');

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('B1')->getFont()->setBold(true);
            $sheet->getStyle('C1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);
            $sheet->getStyle('E1')->getFont()->setBold(true);
            $sheet->getStyle('F1')->getFont()->setBold(true);
            $sheet->getStyle('G1')->getFont()->setBold(true);
            $sheet->getStyle('H1')->getFont()->setBold(true);
            $sheet->getStyle('I1')->getFont()->setBold(true);
            $sheet->getStyle('J1')->getFont()->setBold(true);
            $sheet->getStyle('K1')->getFont()->setBold(true);
            $sheet->getStyle('L1')->getFont()->setBold(true);
            $sheet->getColumnDimension('L')->setWidth(1000); 
            $rows = 2;
            foreach($finalArrayData as $data){
                $imageCount = 0;
                $setOffsetX = 0;

                $sheet->setCellValue('A' . $rows, $data['treeid']);
                $sheet->setCellValue('B' . $rows, $data['address']);
                $sheet->setCellValue('C' . $rows, $data['location']);
                $sheet->setCellValue('D' . $rows, $data['species']);
                $sheet->setCellValue('E' . $rows, $data['height']);
                $sheet->setCellValue('F' . $rows, $data['height']);
                $sheet->setCellValue('G' . $rows, $data['date_planted']);
                $sheet->setCellValue('H' . $rows, $data['comments']);
                $sheet->setCellValue('I' . $rows, $data['age_range']);
                $sheet->setCellValue('J' . $rows, $data['vitality']);
                $sheet->setCellValue('K' . $rows, $data['soil_type']);
                $sheet->setCellValue('L' . $rows, '');
                
                if(isset($data['tree_image']) && !empty($data['tree_image'])){
                    foreach($data['tree_image'] as $treeImage){
                        $sheet->getRowDimension($rows)->setRowHeight(50);
                        if(file_exists(public_path()."/uploads/Tree_Images/".$treeImage) && $treeImage){
                            $drawing = new Drawing();
                            $drawing->setName($treeImage);
                            $drawing->setDescription($treeImage);
                            $drawing->setPath(public_path()."/uploads/Tree_Images/".$treeImage);
                            $drawing->setHeight(36);
                            $drawing->setCoordinates('L'.$rows);
                            if($imageCount != 0){
                                $drawing->setOffsetX($setOffsetX);
                                $drawing->setWidth(100); 
                                $drawing->setHeight(60);   
                            }else{
                                $drawing->setOffsetX(10);   
                                $drawing->setWidth(100); 
                                $drawing->setHeight(60);   
                            }

                            $drawing->setWorksheet($sheet);
                        }
                        $imageCount++;
                        $setOffsetX = $setOffsetX + 300;
                    }
                }
                $rows++;
            }
            $sheet->getDefaultColumnDimension()->setWidth(20);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        }
        // $input = $request->all();

        // if($input['file'] != '')
        // {
        //     $filenm = str_replace(",", "-", $input['filename']);
        //     $save_folder_path = public_path() . '/adminpanel/csvfiles/' . $filenm;
        //     $txt = urldecode($input['file']);                        
        //     $myfile = fopen($save_folder_path, "w") or die("Unable to open file!");
        //     fwrite($myfile, $txt);
        //     fclose($myfile);
        //     // echo "done";

        //     file_put_contents($save_folder_path,$input['file']);

        //     $reader = IOFactory::createReader('Html');

        //     $spreadsheet = $reader->load($save_folder_path);

        //     $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        //     // $writer->save($filenm);

        //     header('Content-Type: application/vnd.ms-excel');
        //     header('Content-Disposition: attachment;filename="Customer_ExportedData.xls"');
        //     header('Cache-Control: max-age=0');
        //     ob_end_clean();
        //     $writer->save($filenm);
        //     exit();

        //     // exit;
        // }
        // else
        // {
        //     echo "else";
        // }
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