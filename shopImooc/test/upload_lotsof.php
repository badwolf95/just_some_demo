<?php
/* require_once $_SERVER['DOCUMENT_ROOT']."shopimooc/shopimooc/lib/string.func.php";
echo getUniName(); */
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert Files Test</title>
</head>
<body>
<form action="upload.func.php" method="post" enctype="multipart/form-data">	
	请选择文件：<input type="file" name="myFiles[]"  /><br />	
	请选择文件：<input type="file" name="myFiles[]"  /><br />	
	请选择文件：<input type="file" name="myFiles[]"  /><br />	
	请选择文件：<input type="file" name="myFiles2"  /><br />	
	请选择文件：<input type="file" name="myFiles4"  /><br />	
	
	<input type="submit" value="上传"/>
</form>


</body>
</html>