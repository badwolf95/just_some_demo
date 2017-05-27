<?php 

/**
 * 文件大小转换
 * @param  [type] $size [description]
 * @return [type]       [description]
 */
function transByte($size){
	
	$type = array('B','KB','MB','GB','TB','PB');
	$i = 0;
	while($size>1024){
		$size /= 1024;
		$i++;
	}
	return round($size,2).$type[$i];
}
/**
 * 创建文件
 * @param  string $filename 
 * @return string           
 */
function createFile($fileName){
	
	if($mes = checkFileName($fileName) === true){
		if(@touch($fileName)){
			$mes = "文件创建成功";
		}else{
			$mes = "文件创建失败，请输入正确的文件类型";
		}
	}
	return $mes;
}
/**
 * 弹出提示框并跳转
 * @param  string $mes 
 * @param  strign $url 
 * @return       
 */
function alertMes($mes,$url){
	echo "<script type='text/javascript'>alert('{$mes}');location.href='{$url}';</script>";

}
/**
 * 执行文件重命名
 * @param  [type] $oldName [description]
 * @param  [type] $newName [description]
 * @return [type]          [description]
 */
function doRename($oldName,$newName){

	$path = dirname($newName);
	//die($oldName.$newName);
	if(($mes = checkFileName($newName)) === true){
		//die($oldName.'/'.$newName);
		$newName = $path."/".$newName;
		if(rename($oldName,$newName)){
			$mes = "文件重命名成功";
		}else{
			$mes = "文件重命名失败";
		}
	}else{
		return $mes;
	}
	return $mes;
}

/**
 * 检查文件名格式与重名情况
 * @param  [type] $fileName [description]
 * @return [type]           [description]
 */
function checkFileName($fileName){
	$pattern = "/[\/,*,<,>,?,\|]/";
	if(!preg_match($pattern,basename($fileName))){
		if(!file_exists($fileName)){
			return true;
		}else{
			$mes = "文件名已存在，请重新命名";
		}
	}else{
		$mes = "文件名不能包含非法字符如?:\/<>*等";
	}
	return $mes;
}

/**
 * 删除文件
 * @param  [type] $file [description]
 * @return [type]       [description]
 */
function delFile($file){
	if(unlink($file)){
		$mes = "文件删除成功";
	}else{
		$mes = "文件删除失败";
	}
	return $mes;
}

function downloadFile($file){
	header("content-disposition:attachment;filename=".basename($file));
	header("content-length:".filesize($file));
	readfile($file);
}


?>