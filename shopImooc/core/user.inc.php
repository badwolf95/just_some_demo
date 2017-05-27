<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shopimooc/shopimooc/include.php';


/**新用户注册
 * 
 */
function regist(){
    $userInfo = $_POST;
    $userInfo['password'] = md5($userInfo['password']);
    $faceInfo = uploadfiles();
    //var_dump($faceInfo);
    @$userInfo['face']=$faceInfo[0]['destination'];
    $userInfo['regTime'] = time();
    //var_dump($userInfo);
    if(insert('imooc_user',$userInfo)){
        alertMes("注册成功", '../home_index.php');
    }else{
        alertMes("注册失败鸟，有BUG","../home_index.php");
    }
}

/**添加管理员
 * 
 */
function addUser(){
    $userInfo = $_POST;
    $faceInfo = uploadfiles();
    $userInfo['password'] = md5($userInfo['password']);
    @$userInfo['face'] = $faceInfo[0]['destination'];
    $userInfo['regTime'] = time();
    if(insert('imooc_user',$userInfo)){
        alertMes("添加用户成功",'listUser.php');
    }else{
        alertMes("添加用户失败鸟",'listUser.php');
    }  
}

/**获取所有用户
 * @return unknown
 */
function getAllUser(){
    $sql = "select * from imooc_user";
    $result = fetchAll($sql);
    return $result;
}

/**修改用户信息
 * @param int $id
 */
function alterUser($id){
    $userInfo = $_POST;
    $faceInfo = uploadfiles();
    $userInfo['password'] = md5($userInfo['password']);
    if(@update('imooc_user', $userInfo,"id={$id}")){
        alertMes("修改成功",'listUser.php');
    }else{
        alertMes("修改失败",'listUser.php');
    }
}

/**删除用户
 * @param unknown $id
 */
function delUser($id){
    if(delete('imooc_user',"id={$id}")){
        alertMes("删除成功", 'listUser.php');
    }else{
        alertMes("删除失败", 'listUser.php');
    }
}


/**通过id获取用户信息
 * @param int $id
 */
function getUserById($id){
    $sql = "select * from imooc_user where id={$id}";
    $result = fetchOne($sql);
    return $result;
}

function login_user(){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $verify = $_POST['verification'];
    $verify_s = strtolower($_SESSION['verify']);
    @$autoFlag = strtolower($_POST['autoLogin']);
   
    if($verify == $verify_s){
        @$user = checkUser($username,$password);
        if(@$user){
           $_SESSION['username'] = $user['username'];
           $_SESSION['userId'] = $user['id'];
           if($autoFlag){
               setcookie('username',$user['username'],time()+7*24*3600);
               setcookie('userId',$user['id'],time()+7*24*3600);
           }
           header("location:../home_index.php");
        }
    }else{
        alertMes("验证码错误，看清楚再写啊妹纸", '../login.php');
    }
}

/**检查用户是否存在
 * @param string $username
 * @param string $password
 * @return boolean
 */
function checkUser($username,$password){
    //防止SQL注入三种方法
    
    //第一，在php配置文件ini中，查找magic_quotes_gpc = Off,将off改为on，则打开相关功能，可防
    //第二，addslashes($string)使用反斜线引用特殊字符
    //$username = addslashes($username);
    
    //第三，mysql_escape_string($unescaped_string);使用反斜线引用特殊字符
    $username = mysql_escape_string($username);
    $sql = "select * from imooc_user where username='{$username}' and password='{$password}'";
    
    $result=fetchOne($sql);
    if($result){
        return $result;
    }else{
        alertMes("登录失败鸟,用户名或密码错误，检查好了再登录哦", '../login.php');
    }
}

/**用户退出
 * 
 */
function logout_user(){
    $_SESSION = array();
    if(isset($_COOKIE['userId'])){
        setcookie(session_name(),'',time()-1);
    }
    session_destroy();    
    alertMes("退出成功鸟，再贱",'../home_index.php');
}






