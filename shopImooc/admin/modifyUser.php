<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shopimooc/shopimooc/include.php';

$userId = $_REQUEST['id'];
$user = getUserById($userId); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>更新用户信息</title>
</head>
<body>
<center style="width:1000px; margin:0 auto;">
	<h3>更新用户信息</h3>
	<form method="post" action="doAdminAction.php?act=modifyUser&id=<?php echo $userId;?>">
    	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
    		<tr>
    			<th>编辑用户名:</th>
    			<td><input type="text" name="username" value="<?php echo $user['username'];?>"/></td>
    		</tr>
    		<tr>
    			<th>更改密码：</th>
    			<td><input type="password" name="password"/></td>
    		</tr>
    		<tr>
    			<th>更换邮箱：</th>
    			<td><input type="text" name="email" value="<?php echo $user['email'];?>"/></td>
    		</tr>
    		<tr>
    			<th>改正性别：</th>
    			<td>
    				<input type="radio" name="sex" value="男" id="male" <?php echo ($user['sex']=='男')?"checked='checked'":null;?>/><lable for="male">男</lable>
    				<input type="radio" name="sex" value="女" id="female" <?php echo ($user['sex']=='女')?"checked='checked'":null;?>"/><lable for="female">女</lable>
    				<input type="radio" name="sex" value="保密" id="secret" <?php echo ($user['sex']=='保密')?"checked='checked'":null;?>"/><lable for="secret">保密</lable>
    			</td>
    		</tr>
    		<tr>
    			<th>换个头像：</th>
    			<td><input type="file" name="face" /></td>
    		</tr>
    		<tr>
    			<th></th>
    			<td><input type="submit" value="更改"/></td>
    		</tr>
    	</table>
    </form>	
</center>

</body>
</html>