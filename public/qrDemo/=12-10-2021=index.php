<?php
include('libs/phpqrcode/qrlib.php'); 

$contentId = $_GET['contentId'];
// $contentId1 = $_GET['contentId1'];
// $contentId2 = $_GET['contentId2'];
// $contentId3 = $_GET['contentId3'];

	$tempDir = "QrImage/";
	//$tempDir1 = "demoFiles/";
    
    $codeContents = $contentId;//date("Ymdhis");
    // $codeContents1 = $contentId1;
    // $codeContents2 = $contentId2;
    // $codeContents3 = $contentId3;
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    
    $fileName = "treeQRimg".date("Ymdhis").'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) 
    {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
        
        $message = "QR Generate Successfully";   
        $result = array('success'=>'1', 'message'=> $message, 'fileName'=> $fileName, 'qrString'=> $codeContents);//, 'qrString1'=> $codeContents1, 'qrString2'=> $codeContents2, 'qrString3'=> $codeContents3);
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

