<?php
include('libs/phpqrcode/qrlib.php'); 

/**
 * First part into two array with image data and other data
 */
$contentId = urldecode($_GET['contentId']);
/*$contentId = urldecode($_GET['contentId']);
$contentArr = explode("@@IMAGEDATA@@", $contentId);
// Content
$content = explode("@@@@", $contentArr[0]);
// Image Data
$imageData_treeImageArr = explode("@@O@@", $contentArr[1]);
$imageData_treeImage = explode("@@@@", $imageData_treeImageArr[0]);
$imageData_treeId = $imageData_treeImageArr[1];
$imageData_treeDate = $imageData_treeImageArr[2];
$treeImages = "";
if(count($imageData_treeImage)>0) {
    $counter = 0;
    foreach($imageData_treeImage as $k => $v) {
        if(trim($v)!="") {
            $counter++;
            $treeImages .= "Image-" . $counter . ": " . $v ."\n";
        }
    }
}*/
// echo "<pre>"; print_r($content); echo "</pre>";

	$tempDir = "QrImage/";
	//$tempDir1 = "demoFiles/";
    
    /*$codeContents = 'Tree Report'."\n";
    $codeContents .= 'Tree Id: '.$content[10]."\n";
    $codeContents .= 'Address: '.$content[0]."\n";
    $codeContents .= 'Location: '.$content[1]."\n";
    $codeContents .= 'Species: '.$content[2]."\n";
    $codeContents .= 'Height: '.$content[3]."\n";
    $codeContents .= 'Trunk Diameter: '.$content[4]."\n";
    $codeContents .= 'Defects: '.$content[5]."\n";
    $codeContents .= 'Comments: '.$content[6]."\n"; 
    $codeContents .= 'Age Range: '.$content[7]."\n";
    $codeContents .= 'Vitality: '.$content[8]."\n";
    $codeContents .= 'Soil Type: '.$content[9]."\n"; 
    if($treeImages!="") {
        $codeContents .= "Tree images: \n"; 
        $codeContents .= "Id: " . $imageData_treeId . "\n";
        $codeContents .= "Date: " . $imageData_treeDate . "\n";
        $codeContents .= $treeImages;
    }
*/
    // if(count($content[11]) >0) 
    // {
    //     for($i=0; $i < count($content[11]); $i++)
    //     {
    //         $codeContents .= 'Tree Image: '.$content[11][$i]."\n"; 
    //     }
    // } 
    // else 
    // {
    //     $codeContents .= 'Tree Image: '."\n"; 
    // }
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    
    $fileName = "treeQRimg".date("Ymdhis").'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) 
    {
        QRcode::png($contentId, $pngAbsoluteFilePath);
        
        $message = "QR Generate Successfully";   
        $result = array('success'=>'1', 'message'=> $message, 'fileName'=> $fileName,'qrLink'=> urldecode($contentId));// 'qrString'=> $codeContents);
    } 
    else 
    {
        $error = "Something went wrong";
        $result = array('success'=>'0', 'message'=> $error);
    }
    // displaying
   // echo '<img src="'.$urlRelativeFilePath.'" />';
    $result = json_encode($result);
    echo $result;

