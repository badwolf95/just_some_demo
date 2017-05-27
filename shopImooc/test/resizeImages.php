<?php
$filename = "des_big.jpg";
list($src_w,$src_h,$imagetype) = getimagesize($filename);
$mime = image_type_to_mime_type($imagetype);
//echo $mine;//image/jpeg
//生成两个字符串用来表示：imagecreatefrom***,image***;
$createFun = str_replace("/", "createfrom", $mime);
$outFun = str_replace("/", null, $mime);
$src_image = $createFun($filename);
$dst_50_img = imagecreatetruecolor(50, 50);
$dst_220_img = imagecreatetruecolor(220,220);
$dst_350_img = imagecreatetruecolor(350,350);
$dst_800_img = imagecreatetruecolor(800,800);
imagecopyresampled($dst_50_img, $src_image, 0,0,0,0, 50, 50, $src_w, $src_h);
imagecopyresampled($dst_220_img, $src_image, 0,0,0,0, 220, 220, $src_w, $src_h);
imagecopyresampled($dst_350_img, $src_image, 0,0,0,0, 350, 350, $src_w, $src_h);
imagecopyresampled($dst_800_img, $src_image, 0,0,0,0, 800, 800, $src_w, $src_h);


$outFun($dst_50_img,"upload/dst_50/".$filename);
$outFun($dst_220_img,"upload/dst_220/".$filename);
$outFun($dst_350_img,"upload/dst_350/".$filename);
$outFun($dst_800_img,"upload/dst_800/".$filename);

imagedestroy($src_image);
imagedestroy($dst_50_img);
imagedestroy($dst_220_img);
imagedestroy($dst_350_img);
imagedestroy($dst_800_img);