<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/include.php';
/**检查管理员是否存在
 * @param string $sql
 */
function checkAdmin($sql){
    return $result=fetchOne($sql);
}
/**检查管理员是否登录
 * 
 */
function checkLogined(){
    if(@$_SESSION['adminId']=="" && @$_COOKIE['adminId']==""){//这里有个错误，说adminId没有定义，已被忽略
        alertMes('未登录或自动登录已过期\n\n请先登录!', '../login.php');
    }
}

/**注销管理员
 * 
 */
function logout(){
    $_SESSION = array();
    if(isset($_COOKIE['adminId'])){
        setcookie(session_name(),'',time()-1);
    }
    session_destroy();
    alertMes('退出成功，债见', 'login.php');
}


/**管理员登录
 * 
 */
function login_manager(){
    $username=$_POST['username'];
    $username = addslashes($username);//防SQL注入
    $password=md5($_POST['password']);
    //$password=$_POST['password'];
    $verify = strtolower($_POST['verification']);
    $verify_s = strtolower($_SESSION['verify']);
    @$autoFlag = $_POST['autoFlag'];
   
    
    if($verify == $verify_s){    
        $sql = "select * from imooc_admin where username='{$username}' and password='{$password}'";
        $row = checkAdmin($sql);       
        if($row){            
            $_SESSION['adminName']=$row['username'];
            $_SESSION['adminId'] = $row['id'];
            //如果勾选自动登录
            if($autoFlag){
                setcookie('adminId',$row['id'],time()+7*24*3600);
                setcookie('adminName',$row['username'],time()+7*24*3600); 
            }
            alertMes('登陆成功', 'index.php');
        }else{
            alertMes('账号或密码错误','login.php');
        }
    }else{
        alertMes('验证码错误咯，请重新输入 ',"login.php");
    }
}

/**添加管理员
 * @return string
 */
function addAdmin(){
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    if(insert("imooc_admin", $arr)){
        alertMes('Add Successed','../admin/listAdmin.php');
    }else{
        $mes= "添加失败...用户名重复或其他error<br /><a href='../admin/addAdmin.php'>重新添加</a><br /><a href='../admin/listAdmin.php'>查看管理员列表</a>";
    }
    echo $mes;
}

/**获取所有用户
 * 
 */
function getAllAdmin(){
    $sql = "select * from imooc_admin";
    $arr = fetchAll($sql);
    return $arr;
}

/**修改用户信息
 * @param int $id
 * @param array $userInfo
 */
function alterAdmin($id,$getInfo){
    if(update('imooc_admin', $getInfo,"id={$id}")){
        alertMes('修改成功', 'listAdmin.php');
    }else{
        alertMes('修改失败','listAdmin.php'); 
    }
}

/**删除管理员
 * @param int $id
 */
function deleteAdmin($id){    
        if(delete('imooc_admin',"id={$id}")){   \
        //两种跳转方法
            header("location:listAdmin.php");
        }else{      
            alertMes('删除失败','listAdmin.php');
        }    
}



