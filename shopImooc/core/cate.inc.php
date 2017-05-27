<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/include.php';


/**添加分类咯
 * 
 */
function addCate(){
    $cateArr = $_POST;
    if(insert('imooc_cate', $cateArr)){
        alertMes('添加成功鸟', '../admin/listCate.php');
    }else{
        alertMes('failure','../admin/listCate.php');
    }
}

/**获取所有分类
 * @return array 结果集
 */
function getAllCate(){
    $sql = "select * from imooc_cate";
    $result = fetchAll($sql);
    return $result;
}

/**修改分类信息
 * @param int $id
 * @param arr $getInfo
 */
function alterCate($id,$getInfo){   
    if(update('imooc_cate', $getInfo,"id={$id}")){
        alertMes('Alter Succeed', 'listCate.php');
    }else{
        alertMes('Alter Failed', 'listCate.php');
    } 
}


/**删除分类
 * @param int $id
 */
function deleteCate($id){
    if(getProByCid($id)){
       alertMes("请先删除该分类下的商品->",'listCate.php'); 
    }else{
        if(delete('imooc_cate',"id={$id}")){
            alertMes('删除成功鸟','listCate.php');
        }else{
            alertMes('删除失败，有BUG','listCate.php');
        }
    }
}

/**根据分类名获取id
 * @param string $cName
 */
function getCateByCid($cId){
    $sql = "select * from imooc_cate where id={$cId}";
    return fetchOne($sql);

}






