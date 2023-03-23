<?php

if(!empty($_GET['file'])){

    $fileName = basename($_GET['file']);
    $filenm=str_replace(",","-", $fileName);
    $filePath = 'public/adminpanel/csvfiles/'.$filenm;
        
    header('Content-Type: application/x-www-form-urlencoded');
    header('Content-Transfer-Encoding: Binary');
    header("Content-disposition: attachment; filename=\"".$filenm."\"");
    readfile($filenm);
    exit;
}
?>