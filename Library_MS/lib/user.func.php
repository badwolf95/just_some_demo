<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';


/**检查用户名是否存在
 * @param obj $sql
 */
function checkUser($sql){
    return fetchOne($sql);
}

/**注册时动态检查用户名是否存在
 * @return boolean
 */
function remoteCheckUser($username){
    $sql = "select * from users WHERE name='{$username}'";
    echo (fetchOne($sql))?"false":"true";
}

/**添加用户
 * @param string $user
 * @param string $password
 * @param string $email
 * @param string $phone
 */
function addUser($user,$password,$email,$phone,$regist=0){
    $password = md5($password);
    $sql = "INSERT users(name,password,email,phone) VALUES('{$user}','{$password}','{$email}','{$phone}')";
    if((!$regist)&&insert($sql)){
        header("location:../user.php");
    }elseif($regist&&insert($sql)){
        addUserNum();
        addNewLog("用户注册",$user);
        alertMes("注册成功","login.php");
    }else{
        alertMes('插入失败咯,自己看看源码解决吧','../user.php');
    }
}


/**获取所有用户
 * 
 */
function getAllUser(){
    $sql = "SELECT * FROM users";
    $result = fetchAll($sql);
    return $result;    
}

/**修改用户信息
 * @param int $id
 * @param stirng $user
 * @param string $password
 * @param string $email
 * @param string $phone
 */
function modifyUser($id,$user,$password,$email,$phone){
    $sql = "UPDATE users SET name='{$user}',password='{$password}',email='{$email}',phone='{$phone}' WHERE id='{$id}'";
    if(mysqli_query($_SESSION['link'],$sql)){
        header("location:../user.php");
    }else{
        alertMes('出错咯，早点睡吧别弄了反正也解决不了','../user.php');
    }
}


/**通过ID获取用户
 * @param unknown $id
 * @return unknown
 */
function getUserById($id){
    $sql = "SELECT * FROM users WHERE id='{$id}'";
    $result = fetchOne($sql);
    return $result;    
}

function deleteUser($id){
    $sql = "DELETE FROM users WHERE id='{$id}'";
    $result = mysqli_query($_SESSION['link'],$sql);
    if($result){
        header("location:../user.php");
    }else{
        alertMes('删除失败，洗洗睡吧','../user.php');
    }
    
}










