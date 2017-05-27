<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

/**检验管理员是否存在
 * @param string $sql
 */
function checkAdmin($sql){
    return fetchOne($sql);
} 

/**添加管理员
 * @param unknown $admin
 * @param unknown $password
 * @param unknown $email
 * @param unknown $phone
 */
function addadmin($admin,$password,$email,$phone){
    if($admin==null||$password==null||$email==null||$phone==null){
        alertMes('不能有空哦.','addadmin.php');
    }else{
        @$username = strtolower($username);
        $password = md5($password);
        $sql = "INSERT admin(name,password,email,phone) VALUES('{$admin}','{$password}','{$email}','{$phone}');";
        if(insert($sql)){
            alertMes('插入成功！','../admin.php');
        }else{
            alertMes('插入失败！','addadmin.php');
        }
    }
}   


/**获取所有管理员
 * @return unknown
 */
function getAllAdmin(){
    $sql = "SELECT * FROM admin";
    $result = fetchAll($sql);
    return $result; 
}

/**删除管理员
 * @param string $id
 */
function deleteAdmin($id){
    $sql = "DELETE FROM admin WHERE id='{$id}';";
    //var_dump($sql);
    if(delete($sql)){
        alertMes('删除成功','../admin.php');
    }else{
        alertMes('删除失败','../admin.php');
    }
}


/**通过ID获取用户
 * @param unknown $id
 */
function getAdminById($id){
    $sql = "SELECT * FROM admin WHERE id='{$id}'";
    return fetchOne($sql);
}

function modifyAdmin($id,$admin,$password,$email,$phone){
    $password = md5($password);
    $sql = "UPDATE admin SET name='{$admin}',password='{$password}',email='{$email}',phone='{$phone}' WHERE id='{$id}'";
    $result = mysqli_query($_SESSION['link'],$sql);
    if($result){
        alertMes('修改成功','../admin.php');
    }else{
        alertMes('修改失败',"modifyAdmin.php?id='{$id}'");
    }
}














