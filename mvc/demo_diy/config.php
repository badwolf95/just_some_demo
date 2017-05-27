<?php 
	$config = array(
		//数据库连接配置
		'dbConfig' => array(
			//$dbhost,$dbuser,$dbpsw,$dbname
			'dbhost' => 'localhost',
			'dbuser' => 'root',
			'dbpsw'  => '',
			'dbname' => 'news',
			'dbcharset' => 'set names utf8'
		),
		//smarty初始化配置
		'smartyConfig' => array(
			'left_delimiter' => '{',
			'right_delimiter' => '}',
			'template_dir' => 'tpl',
			'compile_dir' => 'template_c',
			'cache_dir' => 'cache'
		)


	);
?>