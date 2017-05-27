<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

$id = $_GET['id'];
$student = getStudentById($id);
//var_dump($student);

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
			<div class="right_top">更新学生信息</div>
			<div class="right_cont">
			<form action="doAdminAction.php?act=modifyStudent&id=<?php echo $student['id'];?>" method="post" >
				<label for="book">更改学号</label>
				<input type="text" name="studentNum"  value="<?php echo $student['stu_index'];?>" id="book">
				<br />
				<label for="book">更改姓名</label>
				<input type="text" name="studentName" value="<?php echo $student['name'];?>" id="book">
				<br />
				<label for="">更换性别</label>
				<input type="radio" id="男" name="sex" value="男" <?php echo ($student['sex']=='男')?"checked='checked'":null?>	/><label for="男" class="sex">男</label>
				<input type="radio" id="女" name="sex" value="女" <?php echo ($student['sex']=='女')?"checked='checked'":null?>/><label for="女" class="sex">女</label>
				<input type="radio" id="保密" name="sex" value="保密" <?php echo ($student['sex']=='保密')?"checked='checked'":null?> /><label for="保密" class="sex">保密</label>
				<br />
				<label for="num">更改年龄</label>
				<input type="text" name="age" value="<?php echo $student['age'];?>" id="num">
				<br />
				<label for="book">更换学院</label>
				<input type="text" name="school" value="<?php echo $student['academy'];?>" id="book">
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