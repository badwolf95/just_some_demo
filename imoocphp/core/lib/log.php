<?php
namespace core\lib;
use \core\lib\config;

class log
{
	/**
	 * 1、确定日志存储方式
	 *
	 * 2、写日志
	 */
	public static $class;

	/**
	 * 实例化相关驱动类
	 * @return [type] [description]
	 */
	public static function init(){
		// 获取配置的存储方式
		$driver = config::get('log','DRIVER');
		// 实例化该存储方式对应的驱动类
		$class = '\core\lib\driver\log\\'.$driver;
		self::$class = new $class();
	}
	/**
	 * 执行驱动类中的方法写日志
	 * @param  [type] $message [description]
	 * @param  string $file    [description]
	 * @return [type]          [description]
	 */
	public static function log($message,$file='log'){
		self::$class->log($message,$file);
	}

}