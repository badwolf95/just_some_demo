<?php
/**
 * 文件系统驱动
 */
namespace core\lib\driver\log;
use \core\lib\config;

class file
{
	public $path;
	/**
	 * 初始化确定要处理的文件所在位置
	 */
	public function __construct(){
		$path = config::get('log','OPTIONS');
		$this->path = $path['PATH'];
	}
	/**
	 * 写日志
	 * @param  [type] $message [description]
	 * @param  string $file    [description]
	 * @return [type]          [description]
	 */
	public function log($message,$file='log'){
		// 确定文件存储位置
		if(!is_dir($this->path)){
			mkdir($this->path,'0755',true);
		}
		// 写入日志
		$filename = $this->path.'/listen/'.date('YmdH').$file.'.txt';
		$message = date('Y-m-d H:i:s')."\t\t".json_encode($message).PHP_EOL;
		// FILE_APPEND：在文末追加内容而不是覆盖
		return file_put_contents($filename,$message,FILE_APPEND);
	}
}