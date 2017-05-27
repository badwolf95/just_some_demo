<?php 
	//以下MVC三个函数分别用来调用相应层的模板类
	function V($name){
		global $dir;
		require_once $dir.'libs/view/smarty/Smarty.class.php';
		eval("$obj = new ".$name);
		return $obj;
	}

	function M($name){
		global $dir;
		require_once $dir.'libs/model/'.$name.'Model.class.php';
		//eval("$obj = new ".$name."Model();");
		$name = $name."Model";
		$obj = new $name;
		return $obj;
	}

	function C($name,$method){
		global $dir;
		//echo $name.'/'.$method;exit;
		require_once $dir.'libs/controller/'.$name.'Controller.class.php';
		//eval("$obj = new ".$name."Controller();");
		//eval("$obj->".$method."();");
		//下面的Controller后面不需要加()，不然报错
		$name = $name."Controller";
		$obj = new $name;
		$obj -> $method();
		return $obj;
	}


	//这个用来调用第三方类库的相关类
	function ORG($path,$name,$config=array()){
		global $dir;
		require_once $dir.'libs/'.$path.$name.'.class.php';
		$obj = new $name();
		if(!empty($config)){
			foreach($config as $key=>$val){
				$obj -> $key = $val;
			}
		}
		return $obj;
	}

	function doaddslashes($string){
		return get_magic_quotes_gpc()?$string:addslashes($string);
	}
?>