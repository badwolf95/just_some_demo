<?php 
require_once 'dir.function.php';
require_once 'file.function.php';
header("Content-Type:text/html;charset=utf-8");
$path = "file";
@$path = ($_REQUEST['path'])?$_REQUEST['path']:$path;
$info = getDirInfo($path);
@$dirname = $_REQUEST['dirname'];
//var_dump($info);
$i = 1;

//接受文件操作信息
@$act = $_REQUEST['act'];
//echo $act;
if(@$_REQUEST['createFile']){
	@$fileName = $_REQUEST['createFile'];
}elseif(@$_REQUEST['filename']){
	$fileName = $_REQUEST['filename'];
}
//echo $fileName;
@$file = "file/".$fileName;
$href = "index.php";
if($act == "create"){
 	$mes = createFile($file);
	alertMes($mes,$href);
}elseif($act == 'showContent'){
	//查看文件内容
	$content = file_get_contents($file);
	//内容为空的话判断长度更直接
	if(strlen($content)){
		//echo "<textarea readonly='readonly' cols='170' rows='30'>{$content}</textarea>";
		//highlight_string($content);
		//highlight_file($file);
		$newContent = highlight_string($content,true);
		$str = <<<EOF
		<table width='100%' bgcolor='#e8e8e8' cellspacing='0' cellpadding='5' style="text-align:left;">
			<tr>
				<td>{$newContent}</td>
			</tr>
		</table>
EOF;
	echo $str;
	}else{
		alertMes("文件没有内容，请先编辑再查看",$href);
	}
}elseif("editContent" == $act){
	$content = file_get_contents($file);
	$str = <<<EOF
	<form action="index.php?act=doEdit&filename={$fileName}" method="post">
		<textarea name="editContent"  cols="170"	 rows="20">{$content}</textarea>
		<input type="submit" value="提交修改" />
	</form>
EOF;
	echo $str;
}elseif("doEdit" == $act){
	$editContent = $_POST['editContent'];
	if(file_put_contents($file,$editContent)){
		$mes = "修改成功";
	}else{
		$mes = "修改失败";
	}
	alertMes($mes,$href);
}elseif("rename" == $act){
	$str = <<<EOF
	<form action="index.php" method="post">
		请输入新文件名：
		<input type="text" name="newName" placeholder="{$fileName}"/>
		<input type="hidden" name="act" value="doRename" />
		<input type="hidden" name="filename" value="
			$fileName" />
		<input type="submit" value="重命名" />
	</form>
EOF;
	echo $str;
}elseif("doRename" == $act){

	$newName = $_POST['newName'];
	$oldName = $file;
	//echo $fileName;
	$mes = doRename($oldName,$newName);
	alertMes($mes,$href);
}elseif("delFile" == $act){
	$mes = delFile($file);
	alertMes($mes, $href);
}elseif("download" == $act){
	downloadFile($file);
}elseif("copyDir" == $act){
	$str = <<< EOF
		<form action="index.php?act=doCopyDir">
		要将文件复制到文件夹：
			<input type="text" name="dstDir" value="$dirname" />
			<input type="hidden" name="srcDir" value="$dirname" />
			<input type="submit" value="确定复制" />
		</form>
EOF;
	echo $str;
}elseif("doCopyDir" == $act){
	$dstDir = $_REQUEST['dstDir'];
	$srcDir = $_REQUEST['srcDir'];
	if(doCopyDir($srcDir, $dstDir.basename())){
		$mes = "复制成功";
	}else{
		$mes = "复制失败";
	}
	//alertMes($mes,$href);
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>WEB_manager</title>
	<link rel="stylesheet" href="cikonss.css" />
	<script src="jquery-ui/js/jquery-1.10.2.js"></script>
	<script src="jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
	<script src="jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
	<link rel="stylesheet" href="jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css"  type="text/css"/>

<style type="text/css">
	body,p,div,ul,ol,table,dl,dd,dt{
		margin:0;
		padding: 0;
	}
	a{
		text-decoration: none;
	}	ul,li{
		list-style: none;
		float: left;
	}
	table{
		width:100%;
		clear:both;
		border:1px solid #999;
		text-align:center;
	}
	.small{
		width:25px;
		height:25px;
	}
	.hidden{
		display:none;
	}
	
</style>
<script>
	function show(act){
		if(document.getElementById(act).style.display=='none'){
			document.getElementById(act).style.display="block";
		}else{
			document.getElementById(act).style.display="none";
		}

	}

	function showDetail(t,filename){
		$("#showImg").attr("src",filename);
		$("#showDetail").dialog({
			height:"auto",
			width:"auto",
			position:{my:"center",at:"center",collision:"fit"},
			modal:false,
			draggable:true,
			resizable:true,
			title:t,
			show:"slide",
			hide:"explode"
		});
	}

	function showDel(filename){
		if(confirm("确定要删除么?")){
			location.href = "index.php?act=delFile&filename="+filename;
		}
	}
	function goBack(back){
		location.href = 'index.php?path='+back;
	}
</script>
</head>
<body>
<div id="showDetail"  style="display:none"><img src="" id="showImg" alt=""/></div>
<h1>慕课网-在线文件管理器</h1>
<div id="top">
	<ul id="navi">
		<li><a href="index.php" title="主目录"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-home"></span></span></a></li>

		<li><a href="#"  onclick="show('createFile')" title="新建文件" ><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-file"></span></span></a></li>

		<li><a href="#"  onclick="" title="新建文件夹"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-folder"></span></span></a></li>

		<li><a href="#" onclick=""title="上传文件"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-upload"></span></span></a></li>
		
		<?php 
		$back = ($path=='file')?'file':dirname($path);
		?>
		<li><a href="#" title="返回上级目录" onclick="goBack('<?php echo $back; ?>')"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-arrowLeft"></span></span></a></li>
	</ul>
</div>

<br><br><br><br>
<div class="hidden" id="createFile">
	<form action="index.php">
			文件名：
			<input type="text" name="createFile" />
			<input type="hidden" name="act" value="create">
			<input type="submit" value="创建文件" />
		</form>
</div>

<br>
<table>
	
	
	<tr>
		<th>序号</th>
		<th>名称</th>
		<th>类型</th>
		<th>大小</th>
		<th>可读</th>
		<th>可写</th>
		<th>可执行</th>
		<th>创建时间</th>
		<th>修改时间</th>
		<th>访问时间</th>
		<th>操作</th>
	</tr>
	<?php 
	if(!empty($info['file'])):
		//print_r($info['file']);
		
		foreach($info['file'] as $file):
		$file_path = $path.'/'.$file;
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $file; ?></td>
		<td>
			<?php $src = filetype($file_path) == 'file'?"images/file_ico.png":"folder_ico.png";?>
			<img src="<?php echo $src;?>" alt="file" title="file">
		</td>
		<td><?php 
		$size = filesize($file_path);
		$size = transByte($size);
		echo $size;
		?>
		</td>

		<td><?php 
		$src = is_readable($file_path)?"correct.png":'error.png';?>
		<img src="images/<?php echo $src; ?>" alt="可读" title="可读" width='30' height='30'/>
		</td>

		<td><?php 
		$src = is_writeable($file_path)?"correct.png":'error.png';?>
		<img src="images/<?php echo $src; ?>" alt="可读" title="可写" width='30' height='30'/>
		</td>

		<td><?php 
		$src = is_executable($file_path)?"correct.png":'error.png';?>
		<img src="images/<?php echo $src; ?>" alt="可读" title="可执行" width='30' height='30'/>
		</td>
		<td><?php echo date("Y-m-d H:i:s",filectime($file_path)); ?></td>
		<td><?php echo date("Y-m-d H:i:s",filemtime($file_path)); ?></td>
		<td><?php echo date("Y-m-d H:i:s",fileatime($file_path)); ?></td>
		<td>
		<?php 
		$fileType = strtolower(end(explode('.',$file)));
		$allowType = array('jpg','png','gif','jpeg');
		if(in_array($fileType,$allowType)){
		?>

		<a href="#" onclick="showDetail('<?php echo $file; ?>','<?php echo $file_path; ?>')" ><img class="small" src="images/show.png"  alt="查看" title="查看"/></a>|
		<?php 
		}else{
		?>
		<a href="index.php?act=showContent&filename=<?php echo $file; ?>" ><img class="small" src="images/show.png"  alt="查看" title="查看"/></a>|
		<?php
		}
		?>
		
		
		<a href="index.php?act=editContent&filename=<?php echo $file; ?>"><img class="small" src="images/edit.png"  alt="" title="修改"/></a>|
		<a href="index.php?act=rename&filename=<?php echo $file; ?>"><img class="small" src="images/rename.png"  alt="" title="重命名"/></a>|
		<a href=""><img class="small" src="images/copy.png"  alt="" title="复制"/></a>|
		<a href=""><img class="small" src="images/cut.png"  alt="" title="剪切"/></a>|
		<a href="#"  onclick="showDel('<?php echo $file; ?>')"><img class="small" src="images/delete.png"  alt="" title="删除"/></a>|
		<a href="index.php?act=download&filename=<?php echo $file; ?>"><img class="small"  src="images/download.png"  alt="" title="下载"/></a>
		</td>	

	</tr>
	<?php $i++;endforeach;endif; ?>

	<!-- ******************************** -->
	<!-- ******************************** -->
	<!-- ******************************** -->
	<?php 
	if(!empty($info['dir'])):
		foreach($info['dir'] as $file):
		$file_path = $path.'/'.$file;
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo "<a href='index.php?path=$file_path' alt='$file_path'>",$file,"</a>"; ?></td>
		<td>
			<?php $src = filetype($file_path) == 'file'?"images/file_ico.png":"images/folder_ico.png";?>
			<img src="<?php echo $src;?>" alt="file" title="file">
		</td>
		<td><?php 
		$sum = 0;
		$size = dirsize($file_path);
		$size = transByte($size);
		echo $size;
		?>
		</td>

		<td><?php 
		$src = is_readable($file_path)?"correct.png":'error.png';?>
		<img src="images/<?php echo $src; ?>" alt="可读" title="可读" width='30' height='30'/>
		</td>

		<td><?php 
		$src = is_writeable($file_path)?"correct.png":'error.png';?>
		<img src="images/<?php echo $src; ?>" alt="可读" title="可写" width='30' height='30'/>
		</td>

		<td><?php 
		$src = is_executable($file_path)?"correct.png":'error.png';?>
		<img src="images/<?php echo $src; ?>" alt="可读" title="可执行" width='30' height='30'/>
		</td>
		<td><?php echo date("Y-m-d H:i:s",filectime($file_path)); ?></td>
		<td><?php echo date("Y-m-d H:i:s",filemtime($file_path)); ?></td>
		<td><?php echo date("Y-m-d H:i:s",fileatime($file_path)); ?></td>
		<td>
		<?php 
		$fileType = strtolower(end(explode('.',$file)));
		$allowType = array('jpg','png','gif','jpeg');
		if(in_array($fileType,$allowType)){
		?>

		<a href="#" onclick="showDetail('<?php echo $file; ?>','<?php echo $file_path; ?>')" ><img class="small" src="images/show.png"  alt="查看" title="查看"/></a>|
		<?php 
		}else{
		?>
		<a href="index.php?path=<?php echo $file_path;?>" ><img class="small" src="images/show.png"  alt="查看" title="查看"/></a>|
		<?php
		}
		?>
		
		
		<a href="index.php?act=rename&filename=<?php echo $file; ?>"><img class="small" src="images/rename.png"  alt="" title="重命名"/></a>|
		<a href="index.php?act=copyDir&dirname=<?php echo $file_path; ?>"><img class="small" src="images/copy.png"  alt="" title="复制"/></a>|
		<a href=""><img class="small" src="images/cut.png"  alt="" title="剪切"/></a>|
		<a href="#"  onclick="showDel('<?php echo $file; ?>')"><img class="small" src="images/delete.png"  alt="" title="删除"/></a>|
		<a href="index.php?act=download&filename=<?php echo $file; ?>"><img class="small"  src="images/download.png"  alt="" title="下载"/></a>
		</td>	

	</tr>
	<?php $i++;endforeach;endif;?>

	
	
</table>


</body>
</html>