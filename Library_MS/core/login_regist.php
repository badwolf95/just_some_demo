<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';
/**
 * 登录数据处理
 */
function doLogin(){
    $username = strtolower($_POST['username']);
    $username = addslashes($username);
    $password = md5($_POST['password']);
   // echo $username."/".$password."/".md5($password);exit;
    //$password = $_POST['password'];
    $verify = strtolower($_POST['verify']);
    $verify_session = strtolower($_SESSION['verify']);
    @$autoLogin = $_POST['autoLogin'];
    $userType =  $_POST['userType'];
    
    
    if($verify == $verify_session){
        if($userType=="admin"){
            $sql = "select * from admin where name='{$username}' and password='{$password}';";
            if(checkAdmin($sql)){
                addVisited();
                addNewLog("管理员登录");
                $_SESSION['ADMINname'] = $username;
                if($autoLogin){
                    setcookie('ADMINname',$username,time()+24*3600);
                }
                header("location:index.php?username={$username}");
            }else{
                echo "<script>alert('管理员或密码错误');window.location='login.php';</script>";
            }
        }elseif($userType=="user"){
            $sql = "select * from users where name='{$username}' and password='{$password}';";
            if(checkUser($sql)){
                $_SESSION['username'] = $username;
                addVisited();
                addNewLog("用户登录");
                if($autoLogin){
                    setcookie('username',$username,time()+24*3600);
                }
                header("location:index.php?username={$username}");
            }else{
                echo "<script>alert('用户名或密码错误');window.location='login.php';</script>";
            }
        }
    }else{
        echo "<script>alert('验证码错误咯');window.location='login.php';</script>";
        
    }
}

/**用户注销退出
 * 
 */
function doLogout(){
    addNewLog("退出");
    setcookie('username','',time()-1);
    $_SESSION['username']='';
    session_destroy();
    mysqli_close($_SESSION['link']);
    header('location:login.php');
}

function doRegister($username,$password){
    if(is_numeric($username)){
        addUser($username,$password,'','',1);
    }else{
        $i=0;
        addNewLog("非法注册|网站遭到攻击",addslashes($username));
        while($i<9999999){
            //echo "<script>alert('别酱紫好嘛大神')</script>";
            //echo "<script>window.open('http://www.imooc.com','_blank');</script>"; 
            echo "神!!!别酱紫好嘛大神!!!别酱紫好嘛大神!!!别酱紫好嘛大神!!!别酱紫好嘛大神!!!别酱紫好嘛大神!!!别酱紫好嘛大神!!!别酱紫好嘛大神!!!";$i++;
            //header("location:http://www.google.com");
        }
    }
}





