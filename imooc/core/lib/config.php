<?php
namespace core\lib;

class config
{
	public static $config = array();

	/**
	 * 获取整个文件配置或单个配置项的值
	 * @param  string $file \core\config下的相关配置文件
	 * @param  string $name 该文件下的配置项
	 * @return [type]       返回整个配置数组或单个配置项的值
	 */
	public static function get($file,$name=''){
		// 配置文件没有加载过则进行加载
		if(!isset(self::$config[$file])){
			$configFile = IMOOC.'/core/config/'.$file.'.php';
			// 配置文件存在
			if(is_file($configFile)){
				$conf = include $configFile;
				// 保存起来免得每次都加载
				self::$config[$file] = $conf;
			}else{
				throw new \Exception('找不到配置文件'.$configFile);
			}
		}
		// 如果没有具体的配置项则返回整个配置文件
		if(''==$name){
			return self::$config[$file];
		}else{
			if(isset(self::$config[$file][$name])){
				return self::$config[$file][$name];
			}else{
				throw new \Exception($file.'文件中没有相关配置项'.$name);
			}
		}
	}


}