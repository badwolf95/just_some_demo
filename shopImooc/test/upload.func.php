<?php

require_once '../lib/string.func.php';
header("content-type:text/html;charset=utf-8");


//uploadFile('myFiles');单文件上传
//多个单文件上传
/* uploadFile('myFiles1');
 uploadFile('myFiles2');
 uploadFile('myFiles3'); */

//var_dump($_FILES);

//多文件上传
/* $files = buildInfo();
var_dump($files); */





/**上传单文件
 * @param array $fileInfo
 * @param int $maxsize
 * @param string $imgflag
 * @param array $allowExt
 * @return string
 */
function uploadFile($fileName,$store_path = "upload",$maxsize=1048576, $imgflag=true, $allowExt=array("jpg","png","jpeg","gif")){    
    $fileInfo = $_FILES[$fileName];
    if($fileInfo['error']==UPLOAD_ERR_OK){
        $ext = getExt($fileInfo['name']);
        if(!in_array($ext, $allowExt)){
            $mes = "非法文件类型";
        }
        if($fileInfo['size']>$maxsize){
            $mes = "文件过大，请小于2M";
        }
        if($imgflag){
            //判断下是否为真正的图片类型
            if(@!getimagesize($fileInfo['tmp_name'])){
                $mes = "这个图片是假的哦";
            }
        }
        $uniString = getUniName();
        $fileName = $uniString.".".$ext;       
        if(!file_exists($store_path)){
            mkdir($store_path,0777,true);
        }
        $destination = $store_path."/".$fileName;
        //判断文件是否是由HTTP-POST上传上来的
        if(is_uploaded_file($fileInfo['tmp_name'])){
            if(move_uploaded_file($fileInfo['tmp_name'], $destination)){
                $mes = "文件上传成功";
            }else{
                $mes = "文件移动失败";
            }
        }else{
            $mes = "文件不是通过HTTP POST上传上来的";
        }
    }else{
        switch($fileInfo['error']){
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
    }
    echo $mes;
}

/**获取上传文件集的array
 * @return array
 */
function buildInfo(){
    $i = 0;
    //var_dump($_FILES);
    foreach($_FILES as $v){
        if(is_string($v['name'])){
            
            //单文件
            $files[$i] = $v;
            $i++;
        }else{
            
            //多文件
            foreach($v['name'] as $key => $val){
                $files[$i]['name'] = $val;
                $files[$i]['size'] = $v['size'][$key];
                $files[$i]['tmp_name'] = $v['tmp_name'][$key];
                $files[$i]['type'] = $v['type'][$key];
                $files[$i]['error'] = $v['error'][$key];
                $i++;
            }
        }
    }
    return @$files;
}
var_dump(buildInfo());
uploadfiles();
/**上传多文件
 * @param string $store_path
 * @param number $maxsize
 * @param string $imgFlag
 * @param array $allowExt
 */
function uploadfiles($store_path = "upload",$maxsize = 10240000000000000000000000,$imgFlag = true,$allowExt = array("jpg","png","gif","mp4")){
    $fileInfo = buildInfo();
    if($fileInfo == null){
        echo "文件上传出错，请报告程序员修改BUG";
        $fileInfo = array();        
    }
    $i = 0;
    foreach($fileInfo as $file){
        if($file['error']===UPLOAD_ERR_OK){                    
            if($file['size']>$maxsize){
                echo "this file'size exceed the limit.<br />";
                continue;
            }            
            $ext = getExt($file['name']);
            if(!in_array($ext, $allowExt)){
                echo  "this file'type is not allow.<br />";
                continue;
            }
            if($imgFlag == true){
                if(!getimagesize($file['tmp_name'])){
                    echo "this file is a fake.Are you kidding me?<br />";
                    continue;
                }
            }
            $fileName = getUniName().".".$ext;          
            if(!file_exists($store_path)){
                mkdir($store_path,0777,true);
            }
            $destination = $store_path."/".$fileName;
            
            if(is_uploaded_file($file['tmp_name'])){
                if(move_uploaded_file($file['tmp_name'], $destination)){
                        echo "文件上传成功<br />";
                        $uploadfile[$i] = $file;
                        $i++;
                }else{
                        echo "文件移动失败鸟<br />";
                        continue;
                }
            }else{
                echo "文件不是通过HTTP-POST方式上传的<br />";
            }
        }else{        
            switch($file['error']){
                case 1:
                    //UPLOAD_ERR_INI_SIZE
                    $mes = "文件大小超过配置文件的设置大小<br />";
                    break;
                case 2:
                    //UPLOAD_ERR_FORM_SIZE
                    $mes = "文件大小超过表单的设置大小<br />";
                    break;
                case 3:
                    //UPLOAD_ERR_PARTIAL
                    $mes = "文件只有部分上传<br />";
                    break;
                case 4:
                    //UPLOAD_ERR_NO_FILE
                    $mes = "文件没有被上传<br />";
                    break;
                case 6:
                    //UPLOAD_ERR_NO_TMP_DIR
                    $mes = "找不到临时目录<br />";
                    break;
                case 7:
                    //UPLOAD_ERR_CANT_WRITE
                    $mes = "文件不可写<br />";
                    break;
                case 8:
                    //UPLOAD_ERR_EXTENSION
                    $mes = "因扩展程序导致文件上传失败<br />";
                    break;
            }
            echo @$mes;
        }
   }
   //var_dump(@$uploadfile);
}











