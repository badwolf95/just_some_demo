<?php 
header("Content-Type:text/html;charset=utf-8");

$link = mysqli_connect('localhost','root','online@mysql113','joinus') or die('数据库连接失败');
mysqli_set_charset($link,'UTF8');


$id = intval($_GET['id']);
$sql = "delete from admin where id='{$id}';";
$res = mysqli_query($link,$sql);
if($res){
	echo "<script>alert('删除成功');window.location.href = '../user.php';</script>";
}else{
	echo "<script>alert('删除失败');window.location.href = '../user.php';</script>";
}


?>