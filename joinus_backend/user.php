<?php 
header("Content-Type:text/html;charset=utf-8");
session_start();
if(!$_SESSION['admin']){
	echo "<script>alert('请先登录');window.location.href='login.php';</script>";
}
$link = mysqli_connect('localhost','root','online@mysql113','joinus') or die('数据库连接失败');
mysqli_set_charset($link,'UTF8');


$sql = "select * from admin";
$result = mysqli_query($link,$sql);
while($r = mysqli_fetch_assoc($result)){
	$res[] = $r;
}
// var_dump($res);








?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>报名网后台</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/commen.css" />
		<link rel="stylesheet" type="text/css" href="css/user.css"/>
		<script type="text/javascript" src="js/base.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">
			$(function(){
				// 修改密码
				$('.revise-pass').click(function(){
					var id = $(this).attr('attr-id');
					$("#admin_id_hidden").val(id);
					b('#screen').lock();
					b('#revise').css('display','block').center();
				});
				$('#alter').click(function(){
					var oldone = $('#old_pwd').val();
					var newone = $('#new_pwd').val();
					var preone = $('#pre_pwd').val();
					if(newone != preone){
						alert('两次输入密码不一致');
					}else{
						var id = $("#admin_id_hidden").val();
						var url = 'function/admin.pwd.php';
						var data = {};
						data['id']		= id;
						data['oldone'] 	= oldone;
						data['newone']	= newone;
						data['preone']	= preone;
						$.post(url,data,function(res){
							if(1 == res.status){
								alert(res.message);
							}else{
								alert(res.message);
							}

						},"JSON");

						b('#screen').unlock();
						b('#revise').css('display','none');
						window.location.reload(true);
					}
				});
				$('#alter_cancle').click(function(){
					b('#screen').unlock();
					b('#revise').css('display','none');
					window.location.reload(true);
				});
				// 添加管理员
				$('#add-admin').click(function(){
					b('#screen').lock();
					b('#add-user').css('display','block').center();
				});
				$('#register').click(function(){
					var username = $("#add_user_form #username").val();
					var password = $("#add_user_form #password").val();
					var re_password = $("#add_user_form #re_password").val();
					if(!password || !re_password){
						alert("密码不能为空");
					}else if(!username){
						alert("账号不能为空");
					}else if(password != re_password){
						alert("两次输入密码不一致");
					}else{
						data = {};
						data['username'] = username;
						data['password'] = password;
						var url = "function/admin.add.php";
						$.post(url,data,function(res){
							if(1 != res.status){
								alert(res.message);
							}
						},"JSON");
					}


					b('#screen').unlock();
					b('#add-user').css('display','none');
					window.location.reload(true);
				});
				$("#reg_cancle").click(function(){
					b('#screen').unlock();
					b('#add-user').css('display','none');
					window.location.reload(true);
				});

				$("#admin_manage #delete_admin").click(function(){
					if(confirm('你确定要删除么')){
						var id = $(this).attr('attr-id');
						window.location.href = 'function/admin.del.php?id=' + id;
					}
				});
			});
		</script>
	</head>
	<body>
		<div id="screen"></div>
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
						<li><a href="index.php" id="view">概览</a></li>
						<li><a href="#" id="manage">账户管理</a></li>
						<li><a href="./function/logout.func.php" id="logout">退出</a></li>
					</ul>
				</div>
				
				<div class="section col-lg-10">
					<form action="" id="admin_manage">
						<input type="button" id="add-admin" value="添加管理员" />
						<div class="general-view">
							<table class="table-bordered table-hover table-condensed">
								<tr>
									<th>账号</th>
									<th>修改密码</th>
									<th>删除</th>
								</tr>
								<?php 
								foreach($res as $r):
								?>
								<tr>
									<td><?php echo $r['username']; ?></td>
									<td><input type="button" name="" class="revise-pass" attr-id="<?php echo $r['id']; ?>" value="修改密码" /></td>
									<td><input type="button" name="" id="delete_admin" attr-id="<?php echo $r['id']; ?>" value="删除管理员" /></td>
								</tr>
							<?php endforeach; ?>
							</table>
					</form>
					
				</div>
			</div>
		</div>
		<div id="add-user">
			<form action="function/admin.add.php" class="form-horizontal" method="post" id="add_user_form">
				<label for="name" class="col-md-3 control-label">管理员账号：</label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="username" name="username" value=""/>
				</div>
				<label for="reg-pass" class="col-md-3 control-label">密码：</label>
				<div class="col-md-9">
					<input type="password" class="form-control" id="password" name="password" value=""/>
				</div>
				<label for="re-reg-pass" class="col-md-3 control-label">重复密码：</label>
				<div class="col-md-9">
					<input type="password" class="form-control" id="re_password" name="re_password" value=""/>
				</div>
				<div class="control">
					<input type="button" value="取消" class="btn btn-default" id="reg_cancle"/>
					<input type="button" value="注册并返回" class="btn btn-default" id="register"/>
				</div>
			</form>
		</div>
		<div id="revise">
			<form action="" class="form-horizontal">
				<input type="hidden" id="admin_id_hidden" value="">
				<label for="old" class="col-md-3 control-label">旧密码：</label>
				<div class="col-md-9">
					<input type="password" name="old_pwd" class="form-control" id="old_pwd" value=""/>
				</div>
				<label for="new" class="col-md-3 control-label">新密码：</label>
				<div class="col-md-9">
					<input type="password" name="new_pwd" class="form-control" id="new_pwd" value=""/>
				</div>
				<label for="re-pass" class="col-md-3 control-label">重复新密码：</label>
				<div class="col-md-9">
					<input type="password" name="pre_pwd" class="form-control" id="pre_pwd" value=""/>
				</div>
				<div class="control">
					<input type="button" value="取消" class="btn btn-default" id="alter_cancle"/>
					<input type="button" value="修改并返回" class="btn btn-default" id="alter"/>
				</div>
			</form>
		</div>
	</body>
</html>
