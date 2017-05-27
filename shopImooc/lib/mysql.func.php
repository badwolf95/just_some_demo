<?php
/**完成数据库连接
 * @return resource
 */
function connect(){
    $link = mysql_connect(DB_HOST,DB_USER,DB_PWD) or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
    mysql_set_charset(DB_CHARSET);
    mysql_select_db(DB_DBNAME)or die("指定数据库打开失败！");
    return $link;
}
/**完成记录插入的操作
 * @param string $table
 * @param array $array
 * @return number
 */
function insert($table,$array){
    $keys = join(",",array_keys($array));
    $vals = "'".join("','",array_values($array))."'";
    $sql = "insert {$table}($keys) values($vals)";
    //var_dump($sql);
    mysql_query($sql);
    return mysql_insert_id();
}
/**记录更新操作
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number
 */
function update($table,$array,$where=null){
    foreach($array as $key=>$val){
        if(@$str==null){
            $sep="";
        }else{
            $sep=",";
        }
        @$str.=$sep.$key."='".$val."'";
    }
    //调用时参数要写全，update要写对，where前面的空格别忘了
    $sql = "update {$table} set {$str}".($where==null?null:" where ".$where);   
    //echo $sql;
    mysql_query($sql);
    return mysql_affected_rows();
}

/**删除记录操作
 * @param string $table
 * @param string $where
 * @return number
 */
function delete($table,$where=null){
    $where=$where==null?null:'where '.$where;
    $sql = "delete from {$table} {$where}";//SQL语句错误率挺高，要多注意
    mysql_query($sql);
    return mysql_affected_rows();
}

/**返回一条结果
 * @param string $sql
 * @param string $result_type
 */
function fetchOne($sql,$result_type=MYSQL_ASSOC){
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result,$result_type);
    return $row;
}
/**获取全部结果
 * @param string $sql
 * @param string $result_type
 */
function fetchAll($sql,$result_type=MYSQL_ASSOC){
	$result=mysql_query($sql);
	while(@$row=mysql_fetch_array($result,$result_type)){
		$rows[]=$row;
	}
	return @$rows;
}
/**获取结果集条数
 * @param string $sql
 * @return number
 */
function getResultNum($sql){
	$result=mysql_query($sql);
	return @mysql_num_rows($result);
}










