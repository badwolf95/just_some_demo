<?php 
require_once '../include.php';
$id = $_REQUEST['id'];
$sql = "select cName from imooc_cate where id={$id}";
$getInfo = fetchOne($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>修改分类信息</title>
</head>
<body>
<center style="width:1000px; margin:0 auto;">
	<h3>修改分类信息</h3>
	<form method="post" action="doAdminAction.php?act=alterCate&&id=<?php echo $id;?>">
    	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
    		<tr>
    			<th>更改分类名:</th>
    			<td><input type="text" name="cName" value="<?php echo $getInfo['cName'];?>"/></td>
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