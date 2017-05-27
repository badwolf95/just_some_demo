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

function getGroup($link,$where){
	$where = '%'.$where.'%';
	$sql = "select * from enroll_from where theGroup like '{$where}';";
	$res = mysqli_query($link,$sql);
	while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
		$rows[] = $row;
	}
	return @$rows;
}

@$theGroup = substr(addslashes($_REQUEST['thegroup']),0,6);
$res = show($link,$theGroup);
$group = getGroup($link,$theGroup);


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>报名网后台</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/commen.css" />
		<link rel="stylesheet" type="text/css" href="css/detail.css"/>
		<script type="text/javascript" src="js/base.js"></script>
		<script type="text/javascript" src="js/drag.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">
			b(function(){
				// 查看个人简介
				$('#table-open #open-resume').click(function(){
					var resume = $(this).attr('attr-res');
					$('#resume #resume-show').html(resume);
					b('#resume').css('display','block').drag($('h4').first());
				});
				$('#close-resume').click(function(){
					b('#resume').css('display','none');
				});
				// 编辑个人信息
				$('#table-open #open-edit').click(function(){
					var vo = $(this).attr('attr-vo');
					var value = eval("("+vo+")") ;
					$("#edit #id").val(value.id);
					$("#edit #group").val(value.theGroup);
					$("#edit #name").val(value.name);
					$("#edit #sex").val(value.gender);
					$("#edit #major").val(value.college);
					$("#edit #QQ").val(value.qqNumber);
					$("#edit #phone").val(value.mobilePhone);
					$("#edit #describe").val(value.resume);

					b('#screen').lock();
					b('#edit').css('display','block').center();
				});
				$('#close-edit').click(function(){
					b('#screen').unlock();
					b('#edit').css('display','none');
					window.location.reload(true);                                                
				});
				$('#edit_cancel').click(function(){
					b('#screen').unlock();
					b('#edit').css('display','none');
					window.location.reload(true);                                                
				});
				// 添加报名信息
				$('#open-add-resume').click(function(){
					
					b('#screen').lock();
					b('#add-resume').css('display','block').center();
				});
				$('#close-add-resume').click(function(){
					b('#screen').unlock();
					b('#add-resume').css('display','none');
					window.location.reload(true);                                                
				});
				$('#add_cancel').click(function(){
					b('#screen').unlock();
					b('#add-resume').css('display','none');
					window.location.reload(true);                                                
				});
				// 全选
				$('#all-choose').click(function(){
					var inputs = document.getElementsByTagName('input');
					var checkboxs = [];
					for(var i = 0; i < inputs.length; ++i){
						if(inputs[i].type == 'checkbox'){
							checkboxs.push(inputs[i]);
						}
					}
					for(var i = 0; i < checkboxs.length; ++i){
						checkboxs[i].checked = false;
					}
				});
				//删除
				$("#delete").click(function(){
					if(confirm("确定要删除么")){
						var checkeds = $("#form_detail :checkbox").serializeArray();
						var data = {};
						var i = 0;
						
						$(checkeds).each(function(){
							data[i] = this.name;
							i++;
						});
						var url = "function/delete.func.php";
						$.post(url,data,function(res){
							if(1 == res.status){
								location.reload();
								alert(res.message);
							}else{
								alert(res.message);
							}
							
						},"JSON");	
					}
				});

				//Excel导出
				$("#excel_output").click(function(){
					var data = {};
					var url = 'function/excel_detail.func.php';
					$.post(url,data,function(res){
						var href = '/detail.xlsx';
						$("#download_output").attr('href',href);
						$("#download_click").click();
					});

				});

			});
		</script>
	</head>
	<body>
		<div id="screen"></div>
		<div id="group" value="<?php echo substr($theGroup,0,6); ?>"></div>
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
					<ul class="list-unstyled" >
						<li><a href="index.php" id="view">概览</a></li>
						<li><a href="user.php" id="manage">账户管理</a></li>
						<li><a href="login.php" id="logout">退出</a></li>
					</ul>
				</div>
				
				<div class="section col-lg-10">
					<form action="" id="form_detail">
						<div id="row" class="count"><?php echo $theGroup;?>组报名详情 ( 共接受报名：<?php echo $res;?> 份 )</div>
						<button><a href="index.php">返回概览</a></button>
						<input type="button" id="open-add-resume" value="添加"/>
						<input type="button" id="delete" value="删除"/>
						<input type="button" class="to-excel" id="excel_output" value="导出到Excel"/>
						<a href="" id="download_output" style="display:none" ><span id="download_click"></span></a>
						<table class="table-bordered table-hover table-condensed" id="table-open">
							<tr>
								<th>选择 / <button type="button" id="all-choose">取消全选</button></th>

								<th>姓名</th>
								<th>性别</th>
								<th>学院年级</th>
								<th>QQ</th>
								<th>手机号码</th>
								<th>个人简介</th>
								<th>编辑</th>
							</tr>
						<?php 
						if($group):foreach($group as $vo):
						?>
							<tr>
								<td><input  type="checkbox" name="<?php echo $vo['id']; ?>" id=""checked="" value="" class="choose"/></td>
								<td><?php echo $vo['name']; ?></td>
								<td><?php echo $vo['gender']; ?></td>
								<td><?php echo $vo['college'] ?></td>
								<td><?php echo $vo['qqNumber']; ?></td>
								<td><?php echo $vo['mobilePhone']; ?></td>
								<td><button type="button" class="open-resume" id="open-resume"  attr-res="<?php echo $vo['resume'];?>">查看个人简介</button></td>
								<td><button type="button" class="open-edit" id="open-edit"  attr-vo='<?php print_r(json_encode($vo));?>'>编辑</button></td>
							</tr>
						<?php endforeach;endif; ?>
						<?php if(!$group){
							echo "<tr><td colspan='8'>暂时没人报名，再等等吧</td></tr>";
						}
						?>
						
						</table>
					</form>
				</div>
			</div>
		</div>
		
		<div id="resume">
			<button type="button" id="close-resume">关闭</button>
			<h4>小明</h4>
			<div class="describe" ><textarea name="" id="resume-show" readonly="readonly"></textarea></div>
		</div>

		<div id="edit">
			<form action="function/edit.func.php" class="form-horizontal" method="post">
				<input type="hidden" name="id" id="id" value="" />

				<label for="group" class="col-md-3 control-label">组别</label>
				<div class="col-md-9">
					<input type="text" name="group" class="form-control" id="group" value=""/>
				</div>

				<label for="name" class="col-md-3 control-label">姓名</label>
				<div class="col-md-9">
					<input type="text" name="name" class="form-control" id="name" value=""/>
				</div>
				<label for="sex" class="col-md-3 control-label">性别</label>
				<div class="col-md-9">
					<input type="text" name="gender" class="form-control" id="sex" value=""/>
				</div>
				<label for="major" class="col-md-3 control-label">学院年纪</label>
				<div class="col-md-9">
					<input type="text" name="college" class="form-control" id="major" value=""/>
				</div>
				<label for="QQ" class="col-md-3 control-label">QQ</label>
				<div class="col-md-9">
					<input type="text" name="qq" class="form-control" id="QQ" value=""/>
				</div>
				<label for="phone" class="col-md-3 control-label">联系电话</label>
				<div class="col-md-9">
					<input type="text" name="phone" class="form-control" id="phone" value=""/>
				</div>
				<label for="describe" class="col-md-3 control-label">个人简介</label>
				<div class="col-md-9">
					<textarea name="resume" class="form-control" id="describe"></textarea>
				</div>
				<div class="control">
					<input type="button" id="edit_cancel" class="btn btn-default" value="取消">
					<input type="submit" id="close-edit" class="btn btn-default" value="修改并返回"/>
				</div>
			</form>
		</div>


		<div id="add-resume">
			<form action="function/add.func.php" class="form-horizontal" method="post">
				<label for="group" class="col-md-3 control-label">组别</label>
				<div class="col-md-9">
					<input type="text" name="group" class="form-control" id="group" value="<?php echo $theGroup,'组'; ?>"/>
				</div>

				<label for="name" class="col-md-3 control-label">姓名</label>
				<div class="col-md-9">
					<input type="text" name="name" class="form-control" id="name" value=""/>
				</div>
				<label for="sex" class="col-md-3 control-label">性别</label>
				<div class="col-md-9">
					<input type="text" name="gender" class="form-control" id="sex" value=""/>
				</div>
				<label for="major" class="col-md-3 control-label">学院年纪</label>
				<div class="col-md-9">
					<input type="text" name="college" class="form-control" id="major" value=""/>
				</div>
				<label for="QQ" class="col-md-3 control-label">QQ</label>
				<div class="col-md-9">
					<input type="text" name="qq" class="form-control" id="QQ" value=""/>
				</div>
				<label for="phone" class="col-md-3 control-label">联系电话</label>
				<div class="col-md-9">
					<input type="text" name="phone" class="form-control" id="phone" value=""/>
				</div>
				<label for="describe" class="col-md-3 control-label">个人简介</label>
				<div class="col-md-9">
					<textarea name="resume" class="form-control" id="describe"></textarea>
				</div>
				<div class="control">
					<input type="button" id="add_cancel" class="btn btn-default" value="取消">
					<input type="submit" id="close-add-resume" class="btn btn-default" value="添加并返回"/>
				</div>
			</form>
		</div>

	</body>
</html>
