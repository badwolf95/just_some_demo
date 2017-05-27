<?php 

/**
 * 获取该目录下的最外层文件
 * @param  string $path 要打开的目录
 * @return array       返回的文件数组
 */
function getDirInfo($path){

	//打开指定目录
	$handle = opendir($path);
	$arr = "";
	//循环读取目录文件
	//不全等于false，意思是文件名如果是 0 的话，不会报错
	while(($item = readdir($handle)) !== false){
		//print_r($item);
		//文件名不为.或.. 也就是当前目录和上一层目录
		if($item != '.' && $item != '..'){
			//是否是文件
			if(is_file($path.'/'.$item)){
				$arr['file'][] = $item;
			}
			//是否是文件夹
			if(is_dir($path.'/'.$item)){
				$arr['dir'][] = $item;
			}
		}
	}
	//关闭目录
	closedir($handle);
	return $arr;
}

// $path = "file";
// var_dump(getDirInfo($path));

/**
 * 获取文件夹大小
 * @param  string $dir [description]
 * @return string      [description]
 */
function dirsize($dir){

	$sum = 0;
	global $sum;
	$handle = opendir($dir);
	$arr = "";
	while(($item = readdir($handle)) !== false){
		if($item != '.' && $item != '..'){
			if(is_file($dir.'/'.$item)){
				$sum += filesize($dir.'/'.$item);
			}
			if(is_dir($dir.'/'.$item)){
				$func = __FUNCTION__;
				$func($dir.'/'.$item);
			}
		}
	}
	closedir($handle);
	return $sum;
}

function doCopyDir($srcDir, $dstDir){
	if(!file_exists($dstDir)){
		mkdir($dstDir,0777,true);
	}
	$handle = opendir($dstDir);
	while( ( $item = readdir($handle)) !== false ){
		if( $item != '.' && $item != '..' ){
			if(is_file($item)){
				copy($srcDir.'/'.$item , $dstDir.'/'.$item);
			}
			if(is_dir($item)){
				$func = __FUNCTION__;
				$func($srcDir.'/'.$item,$dstDir.'/'.$item);
			}
		}
	}
	closedir($handle);
	return true;
}



?>