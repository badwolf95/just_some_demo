<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理</title>
	<link rel="stylesheet" href="../styles/index.css"/>
	<link rel="stylesheet" href="styles/admin.css">
</head>
<body>
	<header>
		<a href="index.php" id="index">Library_MS</a>
		<div class="right">
			<span id="user"> </span>
			<a href="../doAction.php?act=logout" id="logout">logout</a>
		</div>
	</header>
	<div class="main">
		<div class="main_left">
			<ul>
				<li><a href="../books.php">馆藏图书信息</a></li>
				<li><a href="../history.php">图书借阅历史</a></li>
				<li><a href="../student.php">学生信息管理</a></li>
				<li><a href="../user.php">用户列表</a></li>
				<li><a href="../admin.php">管理员列表</a></li>
				<li><a href="../author.php">作者列表</a></li>
				<li><a href="../press.php">出版社列表</a></li>
			</ul>
		</div>
		<div class="main_right">
			<div class="right_top">新增借阅</div>
			<div class="right_cont">
			<form action="doAdminAction.php?act=addHistory" method="post" >
				<label for="">学号</label>
				<input type="text" value="<?php echo @$_SESSION['username'];?>" name="studentNum" id="book">
				<br />
				<label for="">密码</label>
				<input type="password" placeholder="此学号对应的密码" name="password" id="book">
				<br />

				<label for="num">索书号</label>
				<input type="text" name="bookNum" placeholder="索书号" id="num">
				<br />
				<input type="submit" value="submit" id="submit">
			</form>
			</div>
		</div>
	</div>
	<footer>&copy;badwolf</footer>
</body>
</html>