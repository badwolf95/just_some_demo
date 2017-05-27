<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shopimooc/shopimooc/include.php';

/**处理操作，添加文字水印
 * @param unknown $id
 */
function doAddWaterText($id){
    $proInfo = getProById($id);
    //var_dump($proInfo);
    $pics = getPicById($proInfo['id']);
    //var_dump($pics);
    if($pics){
        foreach($pics as $pic){
            $filename = $pic['albumPath'];
            //var_dump($filename);
            addWaterText($filename);
        } 
        alertMes("添加成功", 'listProImages.php');  
    }else{
        alertMes("没有图片，添加失败", 'listProImages.php');
    }
}


/**处理操作，添加图片水印
 * @param unknown $id
 */
function doAddWaterPic($id){
    $proInfo = getProById($id);
    $pics = getPicById($proInfo['id']);
    if($pics){
        foreach($pics as $pic){
            $filename = $pic['albumPath'];
            addWaterPic('upload/logo.jpg', $filename);
        }
        alertMes("添加成功", 'listProImages.php');
    }else{
        alertMes("没有图片，添加失败", 'listProImages.php');
    }
    
}