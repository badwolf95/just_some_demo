<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

$authors = getAllAuthor();
$presses = getAllPress();

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
			<div class="right_top">新增图书</div>
			<div class="right_cont">
			<form action="doAdminAction.php?act=addBooks" method="post" >
				<label for="book">书名</label>
				<input type="text" name="bookName" placeholder="请输入书名" id="book">
				<br />
				<label for="author">作者</label>
				<select name="author_id" id="author">
					<option value="0">请选择</option>
				<?php foreach($authors as $author):?>
					<option value="<?php echo $author['id'];?>"><?php echo $author['name'];?></option>
				<?php endforeach;?>
				</select>
				<br />
				<label for="press">出版社</label>	
				<select name="press_id" id="press">
					<option value="0">请选择</option>
					<?php foreach($presses as $press):?>
					<option value="<?php echo $press['id'];?>"><?php echo $press['name'];?></option>
					<?php endforeach;?>
				</select>
				<br />
				<label for="num">入库数量</label>
				<input type="text" name="quantity" value="1" id="num">
				<br />
				<input type="submit" value="submit" id="submit">
			</form>
			</div>
		</div>
	</div>
	<footer>&copy;badwolf</footer>
</body>
</html>