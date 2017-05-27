<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

/**搜索功能，模糊查询
 * @param string $table
 * @param string $where
 * @param int $pageNum
 * @param int $pageSize
 * @param int $page
 * @param int $allNum
 */
function search($table,$where=null,&$pageNum=0,&$pageSize=1,&$page=1,&$allNum){
    
    addNewLog("查找：".$table."/".addslashes($where));
    
    $where = $where==null?null:"WHERE $where";
    $sql = "SELECT * FROM {$table} {$where}";
    //var_dump($sql);
    //$result = fetchAll($sql);
    $result = mysqli_query($_SESSION['link'],$sql);
    @$allNum = mysqli_num_rows($result);
    //var_dump($allNum);
    if(@$_GET['pageSize']){
        $pageSize = $_GET['pageSize'];
        $_SESSION['pageSize'] = $pageSize;
    }elseif(@$_SESSION['pageSize']){
       $pageSize = $_SESSION['pageSize'];
    }else{
       $pageSize = 5;
    }
    $pageNum = ceil($allNum/$pageSize);
    $page = @$_GET['page']?$_GET['page']:1;
    $offset = $pageSize*($page-1);
    
    $sql = "SELECT * FROM {$table} {$where} ORDER BY id DESC limit {$offset},{$pageSize} ";
    $result = fetchAll($sql);
   
    return $result;
}





