<?php
require_once 'include.php';

@$act = $_REQUEST['act'];
@$username = addslashes($_POST['username']);
@$password =$_POST['password'];
@$remoteVerify = $_GET['verify'];

switch($act){
    case 'login':doLogin();break;
    case 'logout':doLogout();break; 
    case 'register':doRegister($username,$password);break; 
    case 'checkUser':remoteCheckUser($username);break;
    case 'checkVerify':remoteCheckVerify($remoteVerify);break;
    default:break;
} 
