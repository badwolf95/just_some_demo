<?php
	$dir = dirname(__FILE__);
	//echo $dir;
	require_once './smarty/Smarty.class.php';
	//配置smarty
	$smarty = new smarty();
	$smarty->left_delimiter = "{";
	$smarty->right_delimiter = "}";
	$smarty->template_dir = "tpl";
	$smarty->compile_dir = "template_c";
	$smarty->cache_dir = "cache";
	//$smarty->caching = "true";
	//$smarty->cache_lifttime = 120;
	//选择要展示的模板
	$smarty->display('./tpl/area.tpl');


?>