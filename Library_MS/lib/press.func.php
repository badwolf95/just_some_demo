<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

/**添加出版社
 * @param string $press
 * @param string $email
 * @param string $phone
 */
function addpress($press,$email,$phone){
    $sql = "INSERT press(name,email,phone) VALUES('{$press}','{$email}','{$phone}')";
    if(insert($sql)){
        header("location:../press.php");
    }else{
        alertMes('添加失败咯，快去找程序猿','../press.php');
    }
}


/**获取所有出版社信息
 * @return boolean
 */
function getAllPress(){
    $sql = "SELECT * FROM press";
    $result = fetchAll($sql);
    if($result){
        return $result;
    }else{
        return false;
    }
}


/**通过ID获取出版社
 * @param unknown $id
 * @return unknown
 */
function getPressById($id){
    $sql = "SELECT * FROM press WHERE id='{$id}'";
    //var_dump($sql);
    $result = fetchOne($sql);
    return $result;
}

/**修改出版社
 * @param int $id
 * @param string  $press
 * @param string $email
 * @param string $phone
 */
function modifyPress($id,$press,$email,$phone){
    $sql = "UPDATE press SET name='{$press}',email='{$email}',phone='{$phone}' WHERE id='{$id}'";
    if(mysqli_query($_SESSION['link'],$sql)){
        header("location:../press.php");
    }else{
        alertMes('添加失败，请联系攻城狮修改八阿哥','../press.php');
    }
}

function deletePress($id){
    $sql = "DELETE FROM press WHERE id='{$id}'";
    $result = mysqli_query($_SESSION['link'],$sql);
    if($result){
        header("location:../press.php");
    }else{
        alertMes('好咯，又出错了，快去找程序猿','../press.php');
    }
}










