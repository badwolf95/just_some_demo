<?php
/**
 * 简单工厂模式之DB工厂
 * 统一接口更规范
 */
class DB{

	public static $db;
	/**
	 * 工厂类对象的初始化
	 * @param  string $dbtype   [description]
	 * @param  array $dbconfig [description]
	 * @return [type]           [description]
	 */
	public static function init($dbtype,$dbconfig){
		//静态成员和const常量需要用self来调用，否则用$this
		self::$db = new $dbtype;
		self::$db -> connect($dbconfig);
	}

	public static function query($sql){
		return self::$db -> query($sql);
	}

	public static function insert($table,$arr){
		return self::$db -> insert($table,$arr);
	}

	public static function update($table,$arr,$where){
		return self::$db -> update($table,$arr,$where);
	}

	public static function delete($table,$where){
		return self::$db -> delete($table,$where);
	}

	public static function fetchAll($sql){
		$query = self::$db -> query($sql);
		return self::$db -> fetchAll($query);
	}

	public static function fetchOne($sql){
		$query = self::$db -> query($sql);
		return self::$db -> fetchOne($query);
	}

	public static function findResult($query,$row=0,$field=0){
		return self::$db -> findResult($query,$row,$field);
	}

	public static function close(){
		return self::$db -> close();
	}

}
?>