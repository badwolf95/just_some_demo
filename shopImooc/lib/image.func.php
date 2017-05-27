<?php

require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/include.php';

/**生成验证码
 * @param string $sess_name
 * @param number $type
 * @param number $length
 * @param number $pixel
 * @param number $line
 * @param number $width
 * @param number $height
 */
function verifyImage($sess_name='verify',$type=3,$length=4,$pixel=50,$line=2,$width=160,$height=40){
   
    //通过GD库做验证码
    //创建画布
    
    $image=imagecreatetruecolor($width,$height);
    $white=imagecolorallocate($image,255,255,255);
    $black=imagecolorallocate($image,0,0,0);
    //用填充矩形填充画布
    imagefilledrectangle($image,1,1,$width-2,$height-2,$white);        
    $chars = buildRandomString($type,$length);
    
    $_SESSION[$sess_name]=$chars;
    $fontfiles=array("FZSTK.TTF","MSYH.TTC","MSYHL.TTC","SIMKAI.TTF","SIMSUN.TTC","SIMYOU.TTF");
    for($i=0;$i<$length;$i++){
        $size=mt_rand(18,22);
        $angle=mt_rand(-15,15);
        $x=5+$i*($width/$length);
        $y=mt_rand(25,35);
        $color = imagecolorallocate($image, mt_rand(0,80), mt_rand(90,200), mt_rand(90,200));
        $fontfile="../fonts/".$fontfiles[mt_rand(0,count($fontfiles)-1)];
        $text=substr($chars,$i,1);   
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text); 
    }
    //设置点和线干扰
   
    for($i=0;$i<$pixel;$i++){
        $color = imagecolorallocate($image, mt_rand(0,80), mt_rand(90,200), mt_rand(90,200));
        imagesetpixel($image, mt_rand(0,$width-1), mt_rand(0,$height-1), $color);
    }
     
    for($i=0;$i<$line;$i++){
        $color=imagecolorallocate($image, mt_rand(0,80), mt_rand(90,180), mt_rand(90,200));
        imageline($image, mt_rand(0,$width-1), mt_rand(0,$height-1), mt_rand(0,$width-1), mt_rand(0,$height-1), $color);
    }
    
    //显示并销毁  
    header("content-type:image/gif");//是冒号不是等号
    imagegif($image);
    imagedestroy($image);
}


/**对图片进行缩放
 * @param string $filename
 * @param string $store_path
 * @param num $scale
 * @param num $dst_w
 * @param num $dst_h
 * @param bool $isReverseImage
 * @return string
 */
function thumb($filename,$store_path="upload",$scale = 0.5,$dst_w=null,$dst_h=null,$isReverseImage = false){
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
    //下面这个名字就不要再改了，后面删除时才能一起删除
    $dst_name = end(explode("/", $filename));
    if(!file_exists($store_path)){
        mkdir($store_path,0777,true);
    }
    $destination = $store_path."/".$dst_name;
    @$outFun($dst_image,$destination);
    imagedestroy($src_image);
    imagedestroy($dst_image);
    //是否保存源文件
    if(!$isReverseImage){
        unlink($filename);
    }
    return $destination;
}

/**添加文字水印
 * @param string $filename
 * @param string $text
 * @param number $size
 * @param number $angle
 * @param number $x
 * @param number $y
 * @param number $colorRed
 * @param number $colorGreen
 * @param number $colorBlue
 * @param number $alpha
 * @param string $fontfile
 */
function addWaterText($filename,$text = "imooc",$size = 16,$angle = 0,$x=0,$y=16,$colorRed=0,$colorGreen=0,$colorBlue=0,$alpha=0,$fontfile = "../fonts/MSYH.TTC"){
    $fileInfo = getimagesize($filename);
    $mime = $fileInfo['mime'];
    $createFun = str_replace("/", "createfrom" , $mime);
    $outFun = str_replace("/",null,$mime);
    $image = $createFun($filename);
    $color = imagecolorallocatealpha($image, $colorRed ,$colorGreen, $colorBlue,$alpha);
    //X,Y的坐标是指文本中首个字母左下角的位置
    imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    //header("content-type:$mime");
    $outFun($image,$filename);
    imagedestroy($image);
}

/**添加图片水印
 * @param string $src_img
 * @param string $dst_img
 */
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

    //header("content-type:$dstMime");
    $outDstFun($dst_im,$dst_img);//应当输出的是创建的画布，而不是源图片
    imagedestroy($dst_im);
}







