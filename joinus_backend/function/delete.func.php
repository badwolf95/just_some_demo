<?php 
header("Content-Type:text/html;charset=utf-8");

$datas = $_POST;
// print_r($data);
$link = mysqli_connect('localhost','root','online@mysql113','joinus') or die('数据库连接失败');
mysqli_set_charset($link,'UTF8');

if(!$datas || !is_array($datas)){
	$data = array(
		'status'	=>	'0',
		'message'	=>	'没啥能删的你删啥',
		'data'		=>	'',
	);
	return print_r(json_encode($data));
}


$res = array();
foreach($datas as $data){
	$r = del($link,$data);
	if(!$r){
		$res[] = $data;
	}
}
mysqli_close($link);

if(empty($res)){
	$data = array(
		'status'	=>	'1',
		'message'	=>	'删除成功',
		'data'		=>	'',	
	);
	return print_r(json_encode($data));
}else{
	$data = array(
		'status'	=>	'0',
		'message'	=>	'删除失败',
		'data'		=>	'',
	);
	return print_r(json_encode($data));

}

function del($link,$id){
	$sql = "delete from enroll_from where id='{$id}'";
	$res = mysqli_query($link,$sql);
	return $res;
}


?>