<?php 
	header("Content-Type:text/html;charset=utf-8");
	session_start();
	require_once './config.php';
	require_once './pc.php';
	//其他所有文件的路径都要相对于本入口文件
	//启动引擎
	PC::run($config);

?>