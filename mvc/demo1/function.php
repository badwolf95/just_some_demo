<?php

	function C($name,$method){
		require_once 'Lib/Controller/'.$name.'Controller.class.php';
		eval('$objC = new '.$name.'Controller();$objC->'.$method.'();');
	}

	function M($name){
		require_once 'Lib/Model/'.$name.'Model.class.php';
		eval('$objM = new '.$name.'Model();');
		return $objM;
	}
	function V($name){
		require_once 'Lib/View/'.$name.'View.class.php';
		eval('$objV = new '.$name.'View();');
		return $objV;
	}

	function daddslashes($str){
		return (get_magic_quotes_gpc())?$str:addslashes($str);
	}

	


?>