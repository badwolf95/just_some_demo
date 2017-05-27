<?php
class mysqli_mine{

	private $mysqli = "";

	/**
	 * 报错函数
	 * @param  string $error 
	 * @return string 返回错误原因并exit
	 */
	function err($error){
		die("操作有误，错误原因为:".$error);
	}
	/**
	 * 数据库连接操作
	 * @param  array $config 配置文件里
	 * @return obj         数据库连接对象
	 */
	function connect($config){
		//该函数使用数组键名作为变量名,使用数组键值作为变量值
		extract($config);
		if(!($this->mysqli = new mysqli($dbhost,$dbuser,$dbpsw,$dbname))){
			$this->err($this->mysqli->error());
		}
		$this->mysqli->query($dbcharset);
		//return $this->connect;
	}
	/**
	 * 执行SQL语句
	 * @param  SQL $sql 
	 * @return SQL返回对象     
	 */
	function query($sql){
		if(!$query = $this->mysqli->query($sql)){
			$this->err($this->mysqli->error."<br/>".$sql);
		}else{
			return $query;
		}
	}
	/**
	 * 获取结果集中的所有结果
	 * @param  obj $query 
	 * @return array       
	 */
	function fetchAll($query){
		while( $one = mysqli_fetch_array($query,MYSQLI_ASSOC)){
			$list[] = $one;
		}
		return isset($list)?$list:"";
	}
	/**
	 * 获取结果集中的一个
	 * @param  obj $query 
	 * @return array        
	 */
	function fetchOne($query){
		$one = mysqli_fetch_array($query,MYSQLI_ASSOC);
		return $one;
	}
	/**
	 * 获取结果集中指定行列的值
	 * @param  [type]  $query [description]
	 * @param  integer $row   [description]
	 * @param  integer $field [description]
	 * @return [type]         [description]
	 */
	function findResult($query,$row=0,$field=0){
		$one = mysqli_result($query,$row,$field);
		return $one;
	}
	/**
	 * 插入操作
	 * @param  string $table [description]
	 * @param  array $arr   [description]
	 * @return [type]        [description]
	 */
	function insert($table,$arr){
		foreach($arr as $key=>$val){
			//转义特殊字符，防注入，但是mysqli貌似没有，所以先放着吧
			$val = mysql_real_escape_string($val);
			$keyArr[] = "`".$key."`";
			$valArr[] = "'".$val."'";
		}
		$keys = implode(",",$keyArr);
		$vals = implode(",",$valArr);
		$sql = "insert ".$table."(".$keys.") values(".$vals.");";
		if($this->mysqli->query($sql)){
			//return mysqli_insert_id(连接对象);
			return $this->mysqli->insert_id;
		}else{
			$this->err($this->mysqli->error."<br/>".$sql);
		}
	}
	/**
	 * 更新操作
	 * @param  string $table 要插入的表名
	 * @param  array $arr   
	 * @param  string $where 
	 * @return [type]        [description]
	 */
	function update($table,$arr,$where){
		foreach($arr as $key=>$val){
			//转义特殊字符，防注入，但是mysqli貌似没有，所以先放着吧
			if($key=='id'){continue;}
			$val = mysql_real_escape_string($val);
			$str[] = "`".$key."`='".$val."'";
		}
		$vals = implode(",",$str);
		$sql = "update ".$table." set ".$vals." where ".$where;
		if($this->mysqli->query($sql)){
			return $this->mysqli->affected_rows;
		}else{
			$this->err($this->mysqli->error."<br/>".$sql);
		}
	}
	/**
	 * 删除操作
	 * @param  string $table 要删除的表名
	 * @param  string $where [description]
	 * @return [type]        [description]
	 */
	function delete($table,$where){
		$sql = "delete from ".$table." where ".$where;
		if($this->mysqli->query($sql)){
			//echo "删除成功";
			return $this->mysqli->affected_rows;
		}else{
			$this->err($this->mysqli->error."<br/>".$sql);
		}
	}
	/**
	 * 关闭数据库连接
	 * @return [type] [description]
	 */
	function close(){
		return $this->mysqli->close();
	}
}
?>