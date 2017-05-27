<?php

$src_img = "logo.jpg";
$dst_img = "des_big.jpg";
addWaterPic($src_img,$dst_img);
function addWaterPic($src_img,$dst_img){
    $srcInfo = getimagesize($src_img);
    $dstInfo = getimagesize($dst_img);
    $src_w = $srcInfo[0];
    $src_h = $srcInfo[1];
    $dst_w = $dstInfo[0];
    $dst_h = $dstInfo[1];
    $srcMime = $srcInfo['mime'];
    $dstMime = $dstInfo['mime'];
    $createSrcFun = str_replace("/","createfrom",$srcMime);
    $createDstFun = str_replace("/","createfrom",$dstMime);
    $outDstFun = str_replace("/",null,$dstMime);
    $src_im = $createSrcFun($src_img);
    $dst_im = $createDstFun($dst_img);
    imagecopymerge($dst_im, $src_im, $dst_w-$src_w,$dst_h-$src_h,0,0, $src_w, $src_h, 60);
    
    header("content-type:$dstMime");
    $outDstFun($dst_im,$dst_img);//应当输出的是创建的画布，而不是源图片
    imagedestroy($dst_im);
}