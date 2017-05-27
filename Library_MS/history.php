<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

//$historys = getAllHistoty();
//var_dump($history);
$pageNum = 0;
$pageSize = 0;
$page = 0;
$allNum = 0;
if(@$_GET['search']){
    $stu_index = "%".addslashes($_GET['search'])."%";
    $historys = search('barinfo', "stu_index like '{$stu_index}'",$pageNum,$pageSize,$page,$allNum);
}else{
    $historys = getPageCont('barinfo',$pageNum,$pageSize,$page,$allNum);    
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
			<div class="right_top">图书借阅历史</div>
			<div class="right_cont">
				<div class="search">
					<form action="history.php" method="get">
						<input type="text" name="search" id="search" placeholder="请输入学号"/>
						<input type="submit" value="search" id="submit_btn" />
					</form>
				</div>
				<div class="add"><a href="admin/addhistory.php">新增借阅</a></div>
					<table cellspacing="0" cellpadding="0">
						<tr>
							<th width="10%">编号</th>
							<th width="24%">书名</th>
							<th width="10%">借阅人</th>
							<th width="12%">借出日期</th>
							<th width="12%">应还日期</th>
							<th width="12%">归还日期</th>
							<th width="20%">管理</th>
						</tr>
						<?php if($historys):
						$i=1+$pageSize*($page-1);foreach($historys as $history):?>
						<tr>
							<td width="10%" ><span class="index"><?php echo $i;?></span></td>
							<td width="24%"><?php $book=getBookById($history['book_index']);echo $book['bookname']?$book['bookname']:"这本书被删掉了";?></td>
							<td width="10%" ><?php $student = getStudentByStuId($history['stu_index']);echo $student['name'];?></td>
							<td width="12%"><?php echo date("Y-m-d H:i:s",$history['borrowTime']);?></td>
							<td width="12%"><?php $oneMonthLater = strtotime("+30 days",$history['borrowTime']);echo date("Y-m-d H:i:s",$oneMonthLater);?></td>
							<td width="12%"><?php echo $history['returnTime']?date("Y-m-d H:i:s",$history['returnTime']):"<span style='color:red'>未还</span>";?></td>
							<td width="20%">
								<a href="javascript:returnBook(<?php echo $history['id'];?>,<?php echo $history['returnTime']?$history['returnTime']:0;?>)" class="delete">还书</a>
								<a href="javascript:modifyHistory(<?php echo $history['id'];?>,<?php echo $history['returnTime']?$history['returnTime']:0;?>)" class="edit">信息纠错</a>
							</td>
						</tr>
						<?php $i++;endforeach;endif;?>
						<?php if($historys==null):?>
						<tr>
							<td colspan='7'>
							没有相关信息，请减少关键词重新查询或添加借阅......
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
<script>
function returnBook(id,time){
	if(time==0){
    	if(confirm('亲爱滴管理员，你确定书已经到手了吗？')){
    		window.location = "admin/doAdminAction.php?act=returnBook&&id="+id;
    	}
	}else{
		alert('已经还啦，484傻');
	} 
}
function modifyHistory(id,time){
	if(time>0){
		alert('书都还了你还改啥╭(╯^╰)╮');
	}else{
		window.location = "admin/modifyHistory.php?id="+id;
	}
}

</script>
</html>