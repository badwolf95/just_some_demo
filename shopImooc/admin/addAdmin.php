<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加管理员咯</title>
</head>
<body>
<center style="width:1000px; margin:0 auto;">
	<h3>添加新管理员</h3>
	<form method="post" action="doAdminAction.php?act=addAdmin">
    	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
    		<tr>
    			<th>管理员:</th>
    			<td><input type="text" name="username" /></td>
    		</tr>
    		<tr>
    			<th>密码：</th>
    			<td><input type="password" name="password"/></td>
    		</tr>
    		<tr>
    			<th>邮箱：</th>
    			<td><input type="text" name="email" /></td>
    		</tr>
    		<tr>
    			<th></th>
    			<td><input type="submit" value="添加"/></td>
    		</tr>
    	</table>
    </form>	
</center>

</body>
</html>