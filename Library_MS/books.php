<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

//$books = getAllBooks();

$pageNum = 0;
$pageSize = 0;
$page = 0;
$allNum = 0;
if(@addslashes($_GET['search'])&&@addslashes($_GET['enquire'])=='author'){
    $authorId = "%".addslashes($_GET['search'])."%";
    $books = search('books', "author_id like '{$authorId}'",$pageNum,$pageSize,$page,$allNum);
}elseif(@addslashes($_GET['search'])&&@addslashes($_GET['enquire'])=='press'){
    $pressId = "%".addslashes($_GET['search'])."%";
    $books = search('books', "press_id like '{$pressId}'",$pageNum,$pageSize,$page,$allNum);
}elseif(@addslashes($_GET['search'])&&@addslashes($_GET['enquire'])==null){
    $name = "%".addslashes($_GET['search'])."%";
    $books = search('books', "bookname like '{$name}'",$pageNum,$pageSize,$page,$allNum);
}else{
    $books = getPageCont('books',$pageNum,$pageSize,$page,$allNum);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理</title>
	<link rel="stylesheet" href="styles/index.css"/>
</head>
<body>
	<header>
	<a href="index.php" id="index">Library_MS</a>
		<div class="right">
			<span id="user"></span>
			<a href="doAction.php?act=logout" id="logout">logout</a>
		</div>
	</header>
	<div class="main">
		<div class="main_left">
			<ul>
				<li><a href="books.php">馆藏图书信息</a></li>
				<li><a href="history.php">图书借阅历史</a></li>
				<li><a href="student.php">学生信息管理</a></li>
				<li><a href="user.php">用户列表</a></li>
				<li><a href="admin.php">管理员列表</a></li>
				<li><a href="author.php">作者列表</a></li>
				<li><a href="press.php">出版社列表</a></li>
			</ul>
		</div>
		<div class="main_right">
			<div class="right_top">馆藏图书信息</div>
			<div class="right_cont">
				<div class="search">
					<form action="books.php" method="get">
						<input type="text" name="search" id="search" placeholder="请输入书名"/>
						<input type="submit" value="search" id="submit_btn" />
					</form>
				</div>
				<div class="add"><a href="admin/addbooks.php">添加图书</a></div>
					<table cellspacing="0" cellpadding="0">
						<tr>
							<th width="10%">索书号</th>
							<th width="20%">书名</th>
							<th width="12%">作者</th>
							<th width="13%">书的主人</th>
							<th width="10%">可借/借阅人</th>
							<th width="15%">入馆日期</th>
							<th width="20%">管理</th>
						</tr>
						<?php if($books):
						foreach($books as $book):?>
						<tr>
							<td width="10%" ><span class="index"><?php echo $book['id'];?></span></td>
							<td width="20%"><?php echo $book['bookname'];?></td>
							<td width="12%" ><?php $author = getAuthorById($book['author_id']); echo $author['name']?$author['name']:"忘了写..";?></td>
							<td width="13%"><?php $student = getStudentByStuId($book['owner']);echo ($student['name'])?$student['name']:"<span style='color:red'>管理员/无主</span>";?></td>
							<td width="10%"><?php $student = getStudentByStuId($book['reader']);echo ($student['name'])?$student['name']:"<span style='color:blue;'>可借</span>"; ?></td>
							<td width="15%"><?php echo date("Y年m月d日 H:i:s",$book['pubTime']);?></td>
							<td width="20%">
								<a href="admin/modifyBook.php?id=<?php echo $book['id'];?>" class="edit">编辑</a>
								<a href="javascript:deleteBook(<?php echo $book['id'];?>)" class="delete">删除</a>
							</td>
						</tr>
						<?php endforeach;endif;?>
						<?php if($books==null):?>
						<tr>
							<td colspan='7'>
							没有相关信息，先去添加图书吧，或者缩小查找范围再试试看...
							</td>
						</tr>
						<?php endif;?>
						<tr>
							<td colspan="7">
							<br/><br/>
								<?php showPage($pageNum, $page, $pageSize, $allNum);?>

							</td>
						</tr>
					</table>
		
			</div>
		</div>
	</div>
	<footer>&copy;badwolf</footer>
</body>
<script type="text/javascript">
document.getElementById('search').focus();
function deleteBook(id){
	if(confirm('你忍心删除么')){
		window.location = "admin/doAdminAction.php?act=deleteBook&&id="+id;
	}
}

</script>
</html>