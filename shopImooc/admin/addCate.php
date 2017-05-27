<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加分类咯</title>
</head>
<body>
<center style="width:1000px; margin:0 auto;">
	<h3>添加新分类</h3>
	<form method="post" action="doAdminAction.php?act=addCate">
    	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
    		<tr>
    			<th>新分类名:</th>
    			
    			<!--name里面的字段要和数据库里的字段一样，不易出错-->
    			<!--name里面的字段要和数据库里的字段一样，不易出错-->
    			<!--name里面的字段要和数据库里的字段一样，不易出错-->
    			
    			<td><input type="text" name="cName" /></td>
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