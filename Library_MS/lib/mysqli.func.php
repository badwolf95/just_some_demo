<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

/**
 * 连接数据库
 */
function connect(){
    $link = mysqli_connect(HOST,USER,PSW,DB);
    if(mysqli_connect_errno()){
        die('Connect_Error:'.mysqli_connect_error());
    }
    mysqli_set_charset($link,CHARSET);
    return $link;
}

/**添加插入操作
 * @param string $sql
 * @return boolean
 */
function insert($sql){
    if(mysqli_query($_SESSION['link'],$sql)){
        return mysqli_insert_id($_SESSION['link']);
    }else{
        return false;
    }
}

/**获取结果集中的一个
 * @param string $sql
 */
function fetchOne($sql){
    $result = mysqli_query($_SESSION['link'],$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    return $row;
}

/**获取结果集中的所有
 * @param string $sql
 * @return array
 */
function fetchAll($sql){
    $result = mysqli_query($_SESSION['link'],$sql);
    while(@$row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $rows[] = $row;
    }
    return @$rows;
}

/**数据库删除操作
 * @param unknown $sql
 * @return boolean
 */
function delete($sql){
    if(mysqli_query($_SESSION['link'],$sql)){
        return mysqli_affected_rows($_SESSION['link']);
    }else{
        return false;
    }
}











