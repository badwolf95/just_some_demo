<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/include.php';
/**添加商品
 * 
 */
function addPro(){
    $arrs = $_POST;
    
    //var_dump($arrs);
    $arrs['pubTime'] = time();
    //var_dump($arrs);
    $id = insert('imooc_pro', $arrs);
    //上传图片
    $files = uploadfiles();
    //生成缩略图
    foreach($files as $files){
        thumb(@$files['destination'],"upload/dst_50",0,50,50,true);
        thumb(@$files['destination'],"upload/dst_220",0,220,220,true);
        thumb(@$files['destination'],"upload/dst_350",0,350,350,true);
        thumb(@$files['destination'],"upload/dst_800",0,800,800,true);   
        //图片信息入库
        @$album['pid'] = $id;
        $album['albumPath'] = $files['destination'];
        addAlbum($album); 
        //header("location:../admin/listPro.php");
    }  
    alertMes("Add Succeed!","../admin/listPro.php");
}

/**通过id获取商品信息
 * @param unknown $id
 */
function getProById($id){
    $sql = "select * from imooc_pro where id={$id}";
    return fetchOne($sql);
}
/**通过分类号cid获取商品
 * @param unknown $cId
 */
function getProByCid($cId){
    $sql = "select * from imooc_pro where cId={$cId}";
    return fetchAll($sql);
}

/**修改商品信息
 * @param int $id
 */
function alterPro($id){
    $arr = $_POST;
    $arr['pubTime'] = time();
    if(!update('imooc_pro',$arr,"id={$id}")){
        alertMes("Update failed.", 'listPro.php');
    }
    $picFiles = uploadfiles();
    if($picFiles){
        foreach($picFiles as $file){
            thumb($file['destination'],'upload/dst_50',0,50,50,true);
            thumb($file['destination'],'upload/dst_220',0,220,220,true);
            thumb($file['destination'],'upload/dst_350',0,350,350,true);
            thumb($file['destination'],'upload/dst_800',0,800,800,true);
            $album['albumPath'] = $file['destination'];
            @$album['pid'] = $id;
            addAlbum($album);
        }
        alertMes("Alter Production Succeed.",'../admin/listPro.php');
    }else{
        header("location:../admin/listPro.php");
    }
}

/**删除商品
 * @param int $id
 * @param int $page
 */
function delPro($id,$page){
    //传进来page，删除完后直接跳转到删除时的页面
    if(delete('imooc_pro',"id={$id}")){
        delPicById($id);
        alertMes("Delete Production Succeed.","../admin/listPro.php?page={$page}");
    }else{
        delPicById($id);
        alertmes("Delete Failed.","../admin/listPro.php?page={$page}");
    }
}

/**获取所有商品信息
 * 
 */
function getAllPro(){
    $sql = "select * from imooc_pro";
    return fetchAll($sql);
}









