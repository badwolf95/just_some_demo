<?php
/**获得验证码
 * @param number $width
 * @param number $height
 * @param number $length
 * @param number $pixelNum
 * @param number $lineNum
 * @param number $color_red
 * @param number $color_green
 * @param number $color_blue
 */
function getVerify($width=200,$height=50,$length=4,$pixelNum=200,$lineNum=4,$color_red=0,$color_green=0,$color_blue=255){
    $img = imagecreatetruecolor($width,$height);
    $white = imagecolorallocate($img, 255,255,255);
    imagefilledrectangle($img,0,0, $width-1,$height-1, $white);
    $_SESSION['verify'] = "";
    //获取随机字符
    $chars = "acdefghijkmnprstuwxyABCDEFGHIJKLMNPQRSTUWXY1234567890";
    for($i=0;$i<$length;$i++){
        $size = mt_rand(22,26);
        $angle = mt_rand(-15,15);
        $x = $size/2 + $i*$width/$length;
        $y = mt_rand($height/2+5,$height/2+10);
        $color = imagecolorallocate($img, $color_red,$color_green,$color_blue);
        $fontfile = "../fonts/"."MSYH.TTC";
        $text = substr($chars, mt_rand(0,strlen($chars))-1,1);
        $_SESSION['verify'].=$text;
        imagettftext($img, $size, $angle, $x, $y, $color, $fontfile, $text);
    }
    //设置干扰点
    for($i=0;$i<$pixelNum;$i++){
        $color = imagecolorallocate($img, 0, 0, 255);
        imagesetpixel($img, mt_rand(1,198), mt_rand(1,48), $color);
    }
    //设置干扰线
    for($i=0;$i<$lineNum;$i++){
        $color = imagecolorallocate($img, 0, 0, mt_rand(180,255));
        imageline($img, mt_rand(0,199), mt_rand(0,49), mt_rand(0,199), mt_rand(0,49), $color);
    }
    //输出后销毁
    header("Content-type:image/gif");
    imagegif($img);
    imagedestroy($img);
}

/**注册时测试验证码是否正确
 * @param unknown $remoteVerify
 */
function remoteCheckVerify($remoteVerify){
    $verify = strtolower($remoteVerify);
    $verify_session = strtolower($_SESSION['verify']);
    echo ($verify==$verify_session)?"true":"false";
}
















