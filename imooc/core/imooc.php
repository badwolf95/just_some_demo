<?php
/**
 * 框架核心类
 */
namespace core;

class imooc
{
	public static $classMap = array();
	public $assign;

	// 启动框架
	static public function run(){
		// 路由类
		$route = new \core\lib\route();
		// 控制器名
		$ctrlClass = $route->ctrl;
		// 方法名
		$action = $route->action;
		// 控制器所在文件
		$ctrlFile = APP.'/ctrl/'.$ctrlClass.'Ctrl.php';
		// 控制器实例化时全称
		$ctrlName = '\\'.MODULE.'\ctrl\\'.$ctrlClass.'Ctrl';
		// 控制器文件是否存在
		if(is_file($ctrlFile)){
			// 实例化并执行相关方法
			include $ctrlFile;
			$ctrl = new $ctrlName();
			$ctrl->$action();
		}else{
			throw new \Exception('找不到控制器'.$ctrlClass);
		}
	}
	// 自动加载
	static public function load($class){
		// 该类是否已经引入
		if(isset(self::$classMap[$class])){
			return true;
		}else{
			// 实例化时是反斜线，所以先改回斜线
			$classPath = str_replace('\\','/',$class);
			// 该类所在位置
			$file = IMOOC.'/'.$classPath.'.php';
			// 存在则引入并做记录
			if(is_file($file)){
				include $file;
				self::$classMap[$class] = $class;
			}else{
				return false;
			}
		}
	}
	// 变量注册
	public function assign($name,$value){
		$this->assign[$name] = $value;
	}
	// 显示模板
	public function display($file){
		// 模板路径
		$viewFile = APP.'/view/'.$file.'.html';
		if(is_file($viewFile)){
			// 从数组中将变量导入到当前模板的符号表
			extract($this->assign);
			// 从当前方法中输出视图
			include $viewFile;
		}
	}
}