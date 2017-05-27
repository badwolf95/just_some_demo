<?php
/**
 * 简单工厂类之视图引擎工厂
 * 统一接口
 */
class VIEW{

	public static $view;
	/**
	 * 初始化工厂类对象
	 * @param  [type] $viewType [description]
	 * @param  [type] $config   [description]
	 * @return [type]           [description]
	 */
	public static function init($viewType,$config){
		self::$view = new $viewType;
		foreach($config as $key=>$val){
			self::$view -> $key = $val;
		} 
	}

	public static function assign($data){
		foreach($data as $key=>$val){
			self::$view -> assign($key,$val);
		}
	}

	public static function display($template){
		self::$view -> display($template);
	}
}
?>