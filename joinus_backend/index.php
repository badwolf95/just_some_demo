<?php 
header('Content-Type:text/html;charset=utf-8');
session_start();
@$admin = $_SESSION['admin'];
if(!$admin || !is_array($admin)){
	echo "<script>alert('请先登陆');window.location.href='../login.php';</script>";
}

$link = mysqli_connect('localhost','root','online@mysql113','joinus') or die('数据库连接失败');
mysqli_set_charset($link,'UTF8');

function show($link,$where){
	$where = '%'.$where.'%';
	$sql = "select count(*) as num from enroll_from where theGroup like '{$where}';";
	$res = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $row['num'];
}
function showGender($link,$group,$gender){
	$where = '%'.$group.'%';
	$sql = "select count(*) as num from enroll_from where theGroup like '{$where}' and gender='{$gender}';";
	$res = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
	return $row['num'];
}
$row  = show($link,'');
$row0 = show($link,'前端');
$row1 = show($link,'视觉');
$row2 = show($link,'移动');
$row3 = show($link,'办公');
$row4 = show($link,'运营');
$row5 = show($link,'视频');
$row6 = show($link,'后端');

$row_boy0 = showGender($link,'前端','男');
$row_boy1 = showGender($link,'视觉','男');
$row_boy2 = showGender($link,'移动','男');
$row_boy3 = showGender($link,'办公','男');
$row_boy4 = showGender($link,'运营','男');
$row_boy5 = showGender($link,'视频','男');
$row_boy6 = showGender($link,'后端','男');

$row_girl0 = showGender($link,'前端','女');
$row_girl1 = showGender($link,'视觉','女');
$row_girl2 = showGender($link,'移动','女');
$row_girl3 = showGender($link,'办公','女');
$row_girl4 = showGender($link,'运营','女');
$row_girl5 = showGender($link,'视频','女');
$row_girl6 = showGender($link,'后端','女');


echo $row_boy6;


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>报名网后台</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/commen.css" />
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#excel_output_1").click(function(){
					var row = $("#index_excel_data #row");
					var dataObj = $("#index_excel_data tr th");
					var dataObj2 = $("#index_excel_data tr td");
					var data = {};
					var data2 = {};
					var rows = {};
					var i=0,j=0;
					$(row).each(function(){
						rows[i] = this.innerHTML;
					});
					$(dataObj).each(function(){
						data[i] = this.innerHTML;
						i++;
					});
					$(dataObj2).each(function(){
						data2[j] = this.innerHTML;
						j++;
					});

					
					var url = 'function/excel.func.php';
					var data3 = {};
					data3['row'] = rows[0];
					data3['data'] = data;
					data3['data2']= data2;
					$.post(url,data3,function(res){
						
						$('#download_output').attr('href','show.xlsx');
						$('#download_click').click();

					});
					// console.log(data);
					// console.log(data2);
				});
			});
		</script>
	</head>
	<body>
		<div id="header" class="container-fluid">
			<div class="row">
				<div class="col-lg-12 head">
					报名网后台管理系统
				</div>
			</div>
		</div>
		<div id="content" class="container-fluid">
			<div class="row">
				<div class="nav col-lg-2">
					<ul class="list-unstyled" style="color: white;">
						<li><a href="index.php
						" id="view">概览</a></li>
						<li><a href="user.php
						" id="manage">账户管理</a></li>
						<li><a href="function/logout.func.php
						" id="logout">退出</a></li>
					</ul>
				</div>
				
				<div class="section col-lg-10">
					<form action="" id="index_excel_data">
						<div id="row" class="count">目前网站共有部门： 7 个 ， 共接受报名：<?php echo $row;?> 份</div>
						<input type="button" class="to-excel" id="excel_output_1" value="导出到Excel"/>
						<a href="" id="download_output" style="display:none" ><span id="download_click"></span></a>
						<div class="general-view">
							<table class="table-bordered table-hover table-condensed">
								<tr>
									<th>部门</th>
									<th>男</th>
									<th>女</th>
									<th>总计接受</th>
									<th>操作</th>
								</tr>
								<tr>
									<td>前端组</td>
									<td><?php echo $row_boy0; ?></td>
									<td><?php echo $row_girl0; ?></td>
									<td><?php echo $row0; ?></td>
									<td><a href="detail.php?thegroup=前端
									"><input type="button" value="查看详情" /></a></td>
								</tr>
								<tr>
									<td>视觉设计组</td>
									<td><?php echo $row_boy1; ?></td>
									<td><?php echo $row_girl1; ?></td>
									<td><?php echo $row1; ?></td>
									<td><a href="detail.php?thegroup=视觉
									"><input type="button" value="查看详情" /></a></td>
								</tr>
								<tr>
									<td>移动互联组</td>
									<td><?php echo $row_boy2; ?></td>
									<td><?php echo $row_girl2; ?></td>
									<td><?php echo $row2; ?></td>
									<td><a href="detail.php?thegroup=移动
									"><input type="button" value="查看详情" /></a></td>
								</tr>
								<tr>
									<td>办公组</td>
									<td><?php echo $row_boy3; ?></td>
									<td><?php echo $row_girl3; ?></td>
									<td><?php echo $row3; ?></td>
									<td><a href="detail.php?thegroup=办公
									"><input type="button" value="查看详情" /></a></td>
								</tr>
								<tr>
									<td>运营组</td>
									<td><?php echo $row_boy4; ?></td>
									<td><?php echo $row_girl4; ?></td>
									<td><?php echo $row4; ?></td>
									<td><a href="detail.php?thegroup=运营
									"><input type="button" value="查看详情" /></a></td>
								</tr>
								<tr>
									<td>视频组</td>
									<td><?php echo $row_boy5; ?></td>
									<td><?php echo $row_girl5; ?></td>
									<td><?php echo $row5; ?></td>
									<td><a href="detail.php?thegroup=视频
									"><input type="button" value="查看详情" /></a></td>
								</tr>
								<tr>
									<td>后端组</td>
									<td><?php echo $row_boy6; ?></td>
									<td><?php echo $row_girl6; ?></td>
									<td><?php echo $row6; ?></td>
									<td><a href="detail.php?thegroup=后端
									"><input type="button" value="查看详情" /></a></td>
								</tr>
							</table>
						</div>
					</form>
				
				</div>
			</div>
		</div>
	</body>
</html>
