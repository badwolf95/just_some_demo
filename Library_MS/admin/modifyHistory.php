<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

$id = $_GET['id'];
$history = getHistoryById($id);

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
			<div class="right_top">修改借阅信息</div>
			<div class="right_cont">
			<form action="doAdminAction.php?act=modifyHistory&id=<?php echo $history['id'];?>" method="post" >
				<label for="">学生学号</label>
				<input type="text" name="studentNum" value="<?php echo $history['stu_index'];?>"  id="book">
				<br />

				<label for="num">索书号</label>
				<input type="text" name="bookNum" value="<?php echo $history['book_index'];?>"  id="num">
				<br />
				<input type="submit" value="submit" id="submit">
			</form>
			</div>
		</div>
	</div>
	<footer>&copy;badwolf</footer>
</body>
<script>
document.getElementById('book').focus();
</script>
</html>