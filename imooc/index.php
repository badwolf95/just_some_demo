<?php
/**
 * 入口文件
 * 1、定义常量
 * 2、加载框架库
 * 3、启动框架
 */

// 定义常量
define('IMOOC',realpath('./'));
define('CORE',IMOOC.'/core');
define('APP',IMOOC.'/app');
define('MODULE','app');
define('DEBUG',true);

// 是否显示错误提示
if(DEBUG){
	ini_set('display_errors','On');
}else{
	ini_set('display_errors','Off');
}

// 加载框架库
include CORE.'/common/function.php';
include CORE.'/imooc.php';

// 类自动加载
spl_autoload_register('\core\imooc::load');

// 启动框架
\core\imooc::run();