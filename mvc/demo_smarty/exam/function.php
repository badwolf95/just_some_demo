<?php

	function ORG($path,$name,$params=array()){
		$dir = dirname(__FILE__);
		require_once $dir.'/Libs/ORG/'.$path.$name.'.class.php';
		//eval('$obj = new '.$name.'();');
		$obj = new $name();
		if(!empty($params)){
			foreach($params as $key=>$val){
				//eval("$obj->".$key."='".$val."'");
				$obj->$key = $val;
			}
		}
		return $obj;
	}

	function V($name){
		$dir = dirname(__FILE__);
		require_once $dir.'/Libs/View/'.$name.'View.class.php';
		eval('$obj = new '.$name.'View();');
		return $obj;
	}

	function M($name){
		$dir = dirname(__FILE__);
		require_once $dir.'/Libs/Model/'.$name.'Model.class.php';
		eval('$obj = new '.$name.'Model();');
		return $obj;
	}

	function C($name,$method){
		$dir = dirname(__FILE__);
		require_once $dir.'/Libs/Controller/'.$name.'Controller.class.php';
		eval('$obj = new '.$name.'Controller();$obj->'.$method.'();');
		return $obj;
	}

?>