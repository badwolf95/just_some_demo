<?php 
require_once '../include.php';
$id = $_REQUEST['id'];
$sql = "select username,email from imooc_admin where id={$id}";
$getInfo = fetchOne($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>修改用户信息</title>
</head>
<body>
<center style="width:1000px; margin:0 auto;">
	<h3>修改用户信息</h3>
	<form method="post" action="doAdminAction.php?act=alterAdmin&&id=<?php echo $id;?>">
    	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
    		<tr>
    			<th>更改用户名:</th>
    			<td><input type="text" name="username" value="<?php echo $getInfo['username'];?>"/></td>
    		</tr>
    		<tr>
    			<th>更改密码：</th>
    			<td><input type="password" name="password" /></td>
    		</tr>
    		<tr>
    			<th>更改邮箱：</th>
    			<td><input type="text" name="email" value="<?php echo $getInfo['email'];?>"/></td>
    		</tr>
    		<tr>
    			<th></th>
    			<td><input type="submit" value="修改"/></td>
    		</tr>
    	</table>
    </form>	
</center>

</body>
</html>