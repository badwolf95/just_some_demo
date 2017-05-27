<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

//$press = getAllPress();
$pageNum = 0;
$pageSize = 0;
$page = 0;
$allNum = 0;
if(@$_GET['search']){
    $name = "%".addslashes($_GET['search'])."%";
    $press = search('press', "name like '{$name}'",$pageNum,$pageSize,$page,$allNum);
}else{
    $press = getPageCont('press',$pageNum,$pageSize,$page,$allNum);
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
			<span id="user"> </span>
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
			<div class="right_top">出版社列表</div>
			<div class="right_cont">
				<div class="search">
					<form action="press.php" method="get">
						<input type="text" name="search" id="search" placeholder="请输入出版社"/>
						<input type="submit" value="search" id="submit_btn" />
					</form>
				</div>
				<div class="add"><a href="admin/addpress.php">新增出版社</a></div>
				
					<table cellspacing="0" cellpadding="0">
						<tr>
							<th width="10%">编号</th>
							<th width="10%">出版社</th>
							<th width="10%">邮箱</th>
							<th width="15%">联系电话</th>
							<th width="30%">管理</th>
						</tr>
						<?php 
						if($press):
						$i=1+$pageSize*($page-1);foreach($press as $press):?>
						<tr>
							<td width="10%" ><span class="index"><?php echo $i;?></span></td>
							<td width="20%"><?php echo $press['name'];?></td>
							<td width="10%" ><?php echo $press['email'];?></td>
							<td width="15%"><?php echo $press['phone'];?></td>
							<td width="20%">
								<a href="books.php?search=<?php echo $press['id']?>&enquire=press" class="edit">出版记录</a>
								<a href="admin/modifyPress.php?id=<?php echo $press['id'];?>" class="delete">编辑</a>
								<a href="javascript:deletePress(<?php echo $press['id'];?>)" class="delete">删除</a>
							</td>
						</tr>
						<?php $i++;endforeach;endif;?>
						<?php if($press==null):?>
						<tr>
							<td colspan="5">
							没有相关资料，请减少关键词重新查找......
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
function deletePress(id){
	if(confirm('添加很辛苦的哦，你真的要删除么')){
		window.location = "admin/doAdminAction.php?act=deletePress&&id="+id;
	}	
}
document.getElementById('search').focus();


</script>
</html>