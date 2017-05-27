
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="styles/login.css"/>
</head>
<body>
	<header>
		<span class="header_logo">图书管理-用户登录</span>
	</header>
	<div class="main">
		<div class="login">
			<form method="post" action="doAction.php?act=login">
    			<input type="text" id="username" name="username" placeholder="请输入账户名/邮箱/手机号"/><br/>
    			<input type="password" id="password" name="password" placeholder="请输入密码" /><br/>
    			<input type="text" id="verify" name="verify" placeholder="点击验证码更换"/>
    			<img src="core/getVerify.php?" alt="verify_img" title="点击验证码刷新" id="verify_img" onclick="changeImg()"><br/>
    			<div >
    			
    				<label for="student"class="radio">用户</label>
    				<input type="radio" id="student" name="userType" class="userType" checked="checked" value="user">
    				&nbsp;&nbsp;&nbsp;&nbsp;
    				<!-- <label for="operator"class="radio" >操作员</label>
    				<input type="radio" id="operator" name="userType" class="userType"> -->
    				<label for="admin"class="radio">管理员</label>
    				<input type="radio" id="admin" name="userType" class="userType" value="admin">
    				<br />		
    			</div>
    			<label for="autoLogin" class="autoLogin">以后自动登录-&gt;</label><input type="checkbox" id="autoLogin" name="autoLogin"/>
    			<br/>
    			<input type="submit" value="Login" id="submit">
    			<br />
    			<a href="register.php" class="goto_reg">goto-Register</a>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	function changeImg(){
		var img = document.getElementById('verify_img');
		img.src = "core/getVerify.php?"+Math.ceil(10*Math.random());
	}
	</script>
</body>
</html>