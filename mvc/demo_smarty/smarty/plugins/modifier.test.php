<?php
//自定义变量调节器
//函数名必须为smarty_modifier_函数名(可以有多个参数)
	function smarty_modifier_test($utime,$format){
		$time = date($format,$utime);
		return $time;
	}
?>