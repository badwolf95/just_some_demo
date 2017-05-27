<?php 
session_start();
@$admin = $_SESSION['admin'];
if($admin && is_array($admin)){
	echo "<script>alert('已经登陆');window.location.href='../index.php';</script>";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>报名网后台管理系统</title>
		<link rel="stylesheet" type="text/css" href="css/login.css"/>
	</head>
	<body>
		<div id="login">
			<form action="/function/login.func.php" method="post">
				<h2>欢迎登陆报名网后台管理系统</h2>
				<hr />
				<div class="user">账户：<input type="text" name="username"/></div>
				<div class="passworld" >密码：<input type="password" name="password"/></div>
				<input type="submit" id="submit" value="登录" />
			</form>
		</div>
	</body>
</html>
