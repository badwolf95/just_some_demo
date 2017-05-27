<?php
require_once '../include.php';
$filename = "des_big.jpg";
thumb($filename,"dst_50");
thumb($filename,"dst_220");
thumb($filename,"dst_350");
thumb($filename,"dst_800");

/* function thumb($filename,$store_path="upload",$scale = 0.5,$dst_w=null,$dst_h=null,$isReverseImage = true){
    list($src_w,$src_h,$imagetype) = getimagesize($filename); 
    if(is_null($dst_w)||is_null($dst_h)){
        $dst_w = $src_w * $scale;
        $dst_h = $src_h * $scale;
    }
    $mime = image_type_to_mime_type($imagetype);
    
    $createFun = str_replace("/", "createfrom", $mime);
    $outFun = str_replace("/",null,$mime);
    $src_image = $createFun($filename);
    $dst_image = imagecreatetruecolor($dst_w, $dst_h);
    imagecopyresampled($dst_image, $src_image,0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);
    //$dst_name = getUniName().".".getExt($filename);
    $file = end(explode("/", $filename));
    $dst_name = $file;
    if(!file_exists($store_path)){
        mkdir($store_path,0777,true);
    }
    $destination = $store_path."/".$dst_name;
    $outFun($dst_image,$destination);
    imagedestroy($src_image);
    imagedestroy($dst_image);
    //是否保存源文件
    if(!$isReverseImage){
        unlink($filename);
    }
    return $destination;  
} */