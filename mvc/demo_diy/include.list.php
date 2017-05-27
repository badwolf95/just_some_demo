<?php 
	$files = array(
		//'config.php',
		'function/function.php',
		'libs/db/mysqli.class.php',
		'libs/core/VIEW.class.php',
		'libs/core/DB.class.php',
		'libs/view/smarty/Smarty.class.php'
	);

	
	//循环包含各个文件
	foreach($files as $file){
		//相对于全局变量的所在文件位置
		global $dir;
		require_once $dir.$file;
	}
?>