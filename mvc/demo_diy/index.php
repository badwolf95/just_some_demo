<?php 
	header("Content-Type:text/html;charset=utf-8");
	session_start();
	require_once './config.php';
	require_once './pc_index.php';
	//启动引擎
	PC::run($config);

?>