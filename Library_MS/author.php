<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

//$authors = getAllAuthor(); 
$pageNum = 0;
$pageSize = 0;
$page = 0;
$allNum = 0;

if(@$_GET['search']){
    $name = "%".$_GET['search']."%";
    $authors = search('author',"name like '{$name}'",$pageNum,$pageSize,$page, $allNum);
}else{
    $authors = getPageCont('author',$pageNum,$pageSize,$page,$allNum);
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
			<div class="right_top">作者列表</div>
			<div class="right_cont">
				<div class="search">
					<form action="author.php" method="get">
						<input type="text" name="search" id="search" placeholder="请输入作者"/>
						<input type="submit" value="search" id="submit_btn" />
					</form>
				</div>
				<div class="add"><a href="admin/addauthor.php">新增作者</a></div>

					<table cellspacing="0" cellpadding="0">
						<tr>
							<th width="10%">编号</th>
							<th width="10%">作者</th>
							<th width="10%">邮箱</th>
							<th width="15%">联系电话</th>
							<th width="30%">管理</th>
						</tr>
						<?php 
						if($authors):
						$i=1+$pageSize*($page-1);foreach($authors as $author):?>
						<tr>
							<td width="10%" ><span class="index"><?php echo $i;?></span></td>
							<td width="10%"><?php echo $author['name'];?></td>
							<td width="10%" ><?php echo $author['email'];?></td>
							<td width="15%"><?php echo $author['phone'];?></td>
							<td width="30%">
								<a href="books.php?search=<?php echo $author['id'];?>&enquire=author" class="edit">作品集</a>
								<a href="admin/modifyAuthor.php?id=<?php echo $author['id'];?>" class="delete">编辑</a>
								<a href="javascript:deleteAuthor(<?php echo $author['id'];?>)" class="delete">删除</a>
							</td>
						</tr>
						<?php $i++;endforeach;endif;?>
						<?php if(@$author==null):?>
						<tr>
							<td colspan="5"> 
							没有相关结果，请减少关键词重新查找....
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
	function deleteAuthor(id){
		if(confirm('你确定要删除么...我滴个乖乖')){
			window.location = "admin/doAdminAction.php?act=deleteAuthor&&id="+id;
		}
	}
	document.getElementById('search').focus();


</script>
</html>