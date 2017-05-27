<?php
	require_once './smarty/Smarty.class.php';
	$smarty = new smarty();
	$smarty->left_delimiter = "{";
	$smarty->right_delimiter = "}";
	$smarty->template_dir = "tpl";
	$smarty->compile_dir = "template_c";
	$smarty->cache_dir = "cache";
	//$smarty->caching = "true";
	//$smarty->cache_lifttime = 120;
	
	//注册变量并调用模板
	$smarty->assign('utime',time());
	$smarty->display('./tpl/modifier.tpl');

?>