<?php
	//函数插件
	//名称必须为smarty_function_函数名($params)
	function smarty_function_test($params){
		$width = $params['width'];
		$height = $params['height'];
		$area = $width * $height;
		return $area;
	}
	
?>