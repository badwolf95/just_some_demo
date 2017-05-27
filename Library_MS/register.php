
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="styles/login.css"/>
</head>
<body>
	<header>
		<span class="header_logo">用户注册</span>
	</header>
	<div class="main">
		<div class="login">
			<form method="post" action="doAction.php?act=register"  id="register-form">
    			<input type="text" id="username" name="username" placeholder="注册-学号"/><br/>
    			<input type="password" id="password" name="password" placeholder="注册-密码" /><br/>
    			<input type="password" id="confirm-password" name="confirm-password" placeholder="确认-密码" /><br/>
    			
    			<input type="text" id="verify" name="verify" placeholder="点击验证码更换"/>
    			<img src="core/getVerify.php?" alt="verify_img" title="点击验证码刷新" id="verify_img" onclick="changeImg()"><br/>
    		
    			<br/>
    			<input type="submit" value="注册" id="submit">
    			<br />
    			<a href="login.php" class="goto_reg">goto-Login</a>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	function changeImg(){
		var img = document.getElementById('verify_img');
		img.src = "core/getVerify.php?"+Math.ceil(10*Math.random());
	}
	</script>
	<script type="text/javascript" src="js/jquery-1.10.0.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#register-form").validate({
				rules:{
					username:{
						required:true,
						rangelength:[8,8],
						range:[08143240,08143300],
						digits:true,
						remote:{
							url:"doAction.php?act=checkUser",
							type:"post",
							data:{
								loginTime:function(){
									return new Date;
								}
							}
						} 
					},
					password:{
						required:true,
						minlength:6,
						maxlength:16
					},
					"confirm-password":{
						equalTo:"#password"
					},
					verify:{
						required:true,
						rangelength:[4,4],
						remote:"doAction.php?act=checkVerify"
					}
				},
				messages:{
					username:{
						required:"必须填写用户名",
						rangelength:"必须为8位学号",
						range:"请输入正确的学号",
						remote:"该学号已经注册，请联系管理员处理",
						digits:"请输入正确的学号"
					},
					password:{
						required:"必须填写密码",
						minlength:"不能少于6位",
						maxlength:"不能多于16位"
					},
					"confirm-password":{
						equalTo:"两次输入密码不一致，请确认",
					},
					verify:{
						required:"请输入验证码",
						rangelength:"是4位啊老板",
						remote:"请核对验证码"
					}
				}
			});
		});
	</script>
</body>
</html>