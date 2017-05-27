<?php
require_once '../lib/string.func.php';
header("content-type:text/html;charset=utf-8");

var_dump($_FILES);
$fileName = $_FILES['myFiles']['name'];
$fileType = $_FILES['myFiles']['type'];
$fileTmpName = $_FILES['myFiles']['tmp_name'];
$fileErr = $_FILES['myFiles']['error'];
$fileSize = $_FILES['myFiles']['size'];
$allowExt = array("jpg","png","jpeg","gif");
$maxsize = 1024*1024;
$imgflag = true;
if($fileErr==UPLOAD_ERR_OK){
    $ext = getExt($fileName);
    if(!in_array($ext, $allowExt)){
        exit("非法文件类型");  
    }
    if($fileSize>$maxsize){
        exit("文件过大，请小于2M");
    }
    if($imgflag){
        //判断下是否为真正的图片类型
        if(@!getimagesize($fileTmpName)){            
            exit("这个图片是假的哦");
        }
    }
    $uniString = getUniName();
    $fileName = $uniString.".".$ext;
    $path = "upload";
    if(!file_exists($path)){
        mkdir($path,0777,true);
    }
    $destination = $path."/".$fileName;
    //判断文件是否是由HTTP-POST上传上来的
    if(is_uploaded_file($fileTmpName)){
        if(move_uploaded_file($fileTmpName, $destination)){
            $mes = "文件上传成功";
        }else{
            $mes = "文件移动失败";
        }
    }else{
        $mes = "文件不是通过HTTP POST上传上来的";
    } 
}else{
    switch($fileErr){
        case 1:
            //UPLOAD_ERR_INI_SIZE
            $mes = "上传文件超过配置文件设置的大小";
            break;
        case 2:
            //UPLOAD_ERR_FORM_SIZE
            $mes = "上传文件超过表单设置的大小";
            break;
        case 3:
            //UPLOAD_ERR_PARTIAL
            $mes = "文件部分被上传";
            break;
        case 4:
            //UPLOAD_ERR_NO_FILE
            $mes = "文件没有被上传";
            break;
        case 6:
            //UPLOAD_ERR_NO_TMP_DIR
            $mes = "没有找到临时目录";
            break;
        case 7:
            //UPLOAD_ERR_CANT_WRITE
            $mes = "文件不可写";
            break;
        case 8:
            //UPLOAD_ERR_EXTENSION
            $mes = "由于PHP的拓展程序中断了文件上传";
            break;            
    }
   
    //通过服务器设置
    //file_uploads = on 文件可以通过HTTP POST 上传
    //upload_tmp_dir = "xx" 文件上传临时目录
    //upload_max_filesize = 2M  配置文件中上传文件最大为2M
    //post_max_size = 8M     通过POST表单上传的最大文件大小，默认为8M
    //通过客户端设置
    //<input type="hidden" name="MAX_FILE_SIZE" value="1024"/>大小设置为一兆 
    //<input type="file" name="myFiles" accept="image/jpg,image/png,image/gif" />
    
}
 echo $mes;