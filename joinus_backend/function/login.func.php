<?php 
header('Content-Type:text/html;charset=utf-8');

$username = addslashes($_POST['username']);
$password = md5($_POST['password']);

$con = mysqli_connect('localhost','root','online@mysql113');
if(!$con){
	die("数据库连接失败");
}
mysqli_select_db($con,'joinus');
mysqli_set_charset($con,'UTF-8');


$sql = "select * from admin where username='{$username}' and password='{$password}'";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_array($res,MYSQLI_ASSOC);

mysqli_free_result($res);
mysqli_close($con);
if($username == $row['username'] && $password == $row['password']){
	session_start();
	$_SESSION['admin'] = $row;
	echo "<script>window.location.href='../index.php';</script>";
}else{
	echo "<script>alert('账号或密码有误');window.location.href='../login.php';</script>";
}


?>