<?php 
/**
 * 负责和数据库打交道
 */
class adminModel{

	//private $table = "admin";
	public $table = "admin";

	/**
	 * 查询是否存在相关用户
	 * @param  [type] $username [description]
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	public function fetchUserObj($username,$password){
		//$tableName = getTabelName();
		//$sql = "select * from '{$tableName}' where username='{username}' and password='{$password}'";
		$sql  ="select * from ".$this->table." where name='".$username."' and password='".$password."'";
		if($obj = DB::fetchOne($sql)){
			return $obj;
			//var_dump($obj);
		}else{
			return false;
		}
	}

	/**
	 * 关闭数据库连接
	 * @return [type] [description]
	 */
	public function closeDB(){
		return DB::close();
	}


}
?>