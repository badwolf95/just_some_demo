<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/include.php';
/**新增图片
 * @param unknown $arr
 * @return number
 */
function addAlbum($arr){
    return insert('imooc_album',$arr);
}

/**通过id查找相册
 * @param int $id
 */
function getPicById($id){
    $sql = "select * from imooc_album where pid={$id}";
    return fetchAll($sql);
}

function delPicById($id){
    $arrs = getPicById($id);
    foreach($arrs as $pic){
        if(file_exists($pic['albumPath'])){
            unlink($pic['albumPath']);
            $filename = end(explode("/", $pic['albumPath']));
            echo $filename;
            var_dump($filename);
            unlink("upload/dst_50/".$filename);
            unlink("upload/dst_220/".$filename);
            unlink("upload/dst_350/".$filename);
            unlink("upload/dst_800/".$filename);
        }
    }
}







