<?php 
header("Content-Type:text/html;charset=utf-8");

@$id = $_POST['id'];
@$name = $_POST['name'];
@$gender = $_POST['gender'];
@$college = $_POST['college'];
@$qq = $_POST['qq'];
@$phone = $_POST['phone'];
@$group = $_POST['group'];
@$resume = $_POST['resume'];

$link = mysqli_connect('localhost','root','online@mysql113','joinus') or die('数据库连接失败');
mysqli_set_charset($link,'UTF8');

$sql = "update enroll_from set name='{$name}',gender='{$gender}',college='{$college}',qqNumber='{$qq}',mobilephone='{$phone}',theGroup='{$group}',resume='{$resume}' where id='{$id}'";
$res = mysqli_query($link,$sql);
if($res){
	echo "<script type='text/javascript'>alert('修改成功');window.location.href='../detail.php?thegroup={$group}';</script>";
}else{
	echo "<script type=''>alert('修改失败,请联系程序猿抢修');window.location.href='../detail.php';</script>";
}



?>