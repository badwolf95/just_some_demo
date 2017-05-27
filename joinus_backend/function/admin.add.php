<?php 
header("Content-Type:text/html;charset=utf-8");

$username = $_POST['username'];
$password = $_POST['password'];

if(!$username || !$password){
	$mes = "账号或密码不能为空";
}

$username = addslashes($username);
$password = md5($password);

$link = mysqli_connect('localhost','root','online@mysql113','joinus') or die("数据库连接失败");
mysqli_set_charset($link,"UTF8");

$data = array(
	'username' => $username,
	'password' => $password,
);
$key = array();
$value = array();
foreach($data as $k=>$v){
	$key[] = $k;
	$value[] = $v;
}
$key = implode(',',$key);
$value = "'".implode("','",$value)."'";

$sql = "insert admin({$key}) values({$value});";
$res = mysqli_query($link,$sql);
mysqli_close($link);
if(!$res){
	$mes = "添加失败，快联系程序猿来抢修";
}
if(@$mes){
	$data = array(
		'status'	=>	'0',
		'message' 	=>	$mes,
		'data' 		=>	'',
	);
}else{
	$data = array (
		'status'	=>	'1',
		'message'	=>	'',
		'data'		=>	'',
	);
}
return print_r(json_encode($data));




?>