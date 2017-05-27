<?php 
/**
 * 启动引擎
 * 个人的PC_index类来调用之前的各种类和函数进行初始化
 * 
 */
//全局变量，在函数外定义，函数内或其他文件要使用前先声明：global $static;
$dir = $_SERVER['DOCUMENT_ROOT'];
$dir = $dir.'/mvc/demo_diy/';
require_once $dir.'include.list.php';

class PC{

	public static $controller;
	public static $method;
	public static $config;

	//初始化数据库类
	public static function init_db(){
		DB::init('mysqli_mine',self::$config['dbConfig']);
	}
	//初始化smarty类
	public static function init_View(){
		VIEW::init('smarty',self::$config['smartyConfig']);
	}
	//初始化model值
	public static function init_method(){
		//注意是isset，没有下划线
		self::$method = isset($_GET['method'])?doaddslashes($_GET['method']):'index';
	}
	//初始化controller值
	public static function init_Controller(){
		self::$controller = isset($_GET['controller'])?doaddslashes($_GET['controller']):'index';
	}
	//统一执行以上各个配置
	//需要从配置文件传入所需配置数据的数组
	public static function run($config){
		self::$config = $config;
		self::init_db();
		self::init_View();
		self::init_Controller();
		self::init_method();
		C(self::$controller,self::$method);
	}


}
?>