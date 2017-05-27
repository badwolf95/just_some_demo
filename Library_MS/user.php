<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

//$users = getAllUser();

$pageNum = 0;
$pageSize = 0;
$page = 0;
$allNum = 0;

if(@$_GET['search']){
    $name = "%".addslashes($_GET['search'])."%";
    $users = search('users', "name like '{$name}'",$pageNum,$pageSize,$page,$allNum);
}else{
    $users = getPageCont('users',$pageNum,$pageSize,$page,$allNum);
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
			<div class="right_top">用户列表</div>
			<div class="right_cont">
				<div class="search">
					<form action="user.php" method="get">
						<input type="text" name="search" id="search" placeholder="请输入用户名"/>
						<input type="submit" value="search" id="submit_btn" />
					</form>
				</div>
				<div class="add"><a href="admin/adduser.php">新增用户</a></div>
				
					<table cellspacing="0" cellpadding="0">
						<tr>
							<th width="10%">编号</th>
							<th width="10%">用户名</th>
							<!-- <th width="10%">邮箱</th>
							<th width="15%">联系电话</th> -->
							<th width="30%">管理</th>
						</tr>
						<?php if($users):
						$i=1+$pageSize*($page-1);foreach($users as $user):
						?>
						<tr>
							<td width="10%" ><span class="index"><?php echo $i;?></span></td>
							<td width="10%"><?php echo $user['name'];?></td>
							<!--  <td width="10%" ><?php //echo $user['email'];?></td>
							<td width="15%"><?php //echo $user['phone'];?></td>-->
							<td width="30%">
								<a href="student.php?search=<?php echo$user['name'];?>" class="edit">详细信息</a>
								<a href="admin/modifyUser.php?id=<?php echo $user['id'];?>" class="delete">编辑</a>
								<a href="javascript:deleteUser(<?php echo $user['id'];?>)" class="delete">删除</a>
							</td>
						</tr>
						<?php $i++;endforeach;endif;?>
						<?php if($users==null):?>
						<tr>
							<td colspan="5">
							没有相关信息哦，请减少关键词再次查询或者添加新信息....
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

function deleteUser(id){
	if(confirm('你确定要删除吗')){
		window.location = "admin/doAdminAction.php?act=deleteUser&&id="+id;	
	}
}

</script>


</html>