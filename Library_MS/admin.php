<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

//$admins = getAllAdmin(); 
$pageNum = 0;
$pageSize = 1;
$page = 0;
$allNum = 0;
if(@$_GET['search']){
    $name = "%".addslashes($_GET['search'])."%";
    $admins = search('admin',"name like '{$name}'",$pageNum,$pageSize,$page,$allNum); 
}else{    
    $admins = getPageCont('admin',$pageNum,$pageSize,$page,$allNum);
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
			<div class="right_top">管理员列表</div>
			<div class="right_cont">
				<div class="search">
					<form action="<?php $_SERVER['PHP_SELF'];?>" method="get">
						<input type="text" name="search" id="search" placeholder="请输入管理员昵称"/>
						<input type="submit" value="search" id="submit_btn" />
					</form>
				</div>
				<div class="add"><a href="admin/addadmin.php">新增管理员</a></div>
					<table cellspacing="0" cellpadding="0">
						<tr>
							<th width="10%">编号</th>
							<th width="10%">管理员</th>
							<th width="10%">邮箱</th>
							<th width="15%">联系电话</th>
							<th width="30%">管理</th>
						</tr>
						<?php 
						if($admins):$i=1+($page-1)*$pageSize;foreach($admins as $admin):?>
						<tr>
							<td width="10%" ><span class="index"><?php echo $i;?></span></td>
							<td width="10%"><?php echo $admin['name'];?></td>
							<td width="10%" ><?php echo $admin['email'];?></td>
							<td width="15%"><?php echo $admin['phone'];?></td>
							<td width="30%">
								<a href="admin/modifyAdmin.php?id=<?php echo $admin['id'];?>" class="delete">编辑</a>
								<a href="javascript:deleteAdmin(<?php echo $admin['id'];?>)" class="delete" >删除</a>
							</td>
						</tr>
						<?php $i++;endforeach;endif;?>
						<?php if($admins==null):?>
						<tr>
							<td colspan="5">没有符合条件的结果，减少搜索关键字再试试</td>
						</tr>
						<?php endif;?>
						<tr>
							<td colspan="7">
							<br/><br/>
							<?php showPage($pageNum,$page,$pageSize,$allNum);?>
							<br/><br/>
							</td>
						</tr>
					</table>
			
			</div>
		</div>
	</div>
	<footer>&copy;badwolf</footer>
	</body>
	<script type="text/javascript">
	function deleteAdmin(id){
		if(confirm('你确定要删除么')){
			window.location="admin/doAdminAction.php?act=deleteAdmin&&id="+id;
		}
	}	
	document.getElementById('search').focus();
	</script>

</html>