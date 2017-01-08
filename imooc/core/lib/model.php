<?php 
/**
 * 数据库处理类（模型层）
 */
namespace core\lib;
use core\lib\config;

class model extends \medoo
{
	public function __construct(){
		$option = config::get('database');
		parent::__construct($option);
		/*$dbconf = config::get('database');
		try{
			parent::__construct($dbconf['DSN'],$dbconf['USERNAME'],$dbconf['PASSWD']);
		}catch(\PDOException $e){
			p($e->getMessage());
		}*/
	}
}