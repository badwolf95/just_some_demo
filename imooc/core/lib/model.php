<?php 
/**
 * 数据库处理类（模型层）
 */
namespace core\lib;

class model extends \PDO
{
	public function __construct(){
		$dsn = 'mysql:host=localhost;dbname=imooctest';
		$username = 'root';
		$passwd = '';
		try{
			parent::__construct($dsn, $username, $passwd);
		}catch(\PDOException $e){
			p($e->getMessage());
		}
	}
}