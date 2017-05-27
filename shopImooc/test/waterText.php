<?php 
$filename = "des_big.jpg";
addWaterText($filename,'imooc.com',14,30,10,70,255,0,0);
function addWaterText($filename,$text = "imooc",$size = 16,$angle = 0,$x=0,$y=10,$colorRed=0,$colorGreen=0,$colorBlue=0,$alpha=0,$fontfile = "../fonts/MSYH.TTC"){    
    $fileInfo = getimagesize($filename);
    $mime = $fileInfo['mime'];
    $createFun = str_replace("/", "createfrom" , $mime);
    $outFun = str_replace("/",null,$mime);
    $image = $createFun($filename);   
    $color = imagecolorallocatealpha($image, $colorRed ,$colorGreen, $colorBlue,$alpha);   
    //X,Y的坐标是指文本中首个字母左下角的位置
    imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    header("content-type:$mime");
    $outFun($image,$filename);
    imagedestroy($image);
}




