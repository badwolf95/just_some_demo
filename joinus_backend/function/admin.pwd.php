<?php 
header("Content-Type:text/html;charset=utf-8");

$link = mysqli_connect('localhost','root','online@mysql113','joinus') or die('数据库连接失败');
mysqli_set_charset($link,'UTF8');

$data = $_POST;
$data['oldone'] = md5($data['oldone']);
$id = $_POST['id'];
$sql = "select * from admin where id='{$id}';";
$r = mysqli_query($link,$sql);
$res = mysqli_fetch_array($r,MYSQLI_ASSOC);
if($data['oldone'] != $res['password']){
	$d = array(
		'status'	=>	'0',
		'message'	=>	'原密码错误',
		'data'		=>	'',
	);
	return print_r(json_encode($d));
}else{
	$newone = md5($data['newone']);
	$sql = "update admin set password='{$newone}' where id='{$id}'";
	if(mysqli_query($link,$sql)){
		$d = array(
			'status'	=>	'1',
			'message'	=>	'密码修改成功',
			'data'		=>	'',
		);
		return print_r(json_encode($d));
	}else{
		$d = array(
			'status'	=> '0',
			'message'	=>	'密码修改失败',
			'data'		=>	'',
		);
		return print_r(json_encode($d));
	}
}






?>