<?php 
/**
 * 路由类
 */
namespace core\lib;
use \core\lib\config;

class route
{

	public $ctrl;
	public $action;

	public function __construct(){

		$path = $_SERVER['REDIRECT_URL'];
		if(isset($path) && $path!='/'){
			$patharr = explode('/',trim($path,'/'));
			if(isset($patharr[0])){
				$this->ctrl = $patharr[0];
			}
			if(isset($patharr[1])){
				$this->action = $patharr[1];
			}else{
				$this->action = config::get('route','ACTION');
			}

			$count = count($patharr);
			$i = 2;
			while($i<$count){
				if(isset($patharr[$i+1])){
					$_GET[$patharr[$i]] = $patharr[$i+1];
				}
				$i += 2;
			}
		}else{
			$this->ctrl = config::get('route','CTRL');
			$this->action = config::get('route','ACTION');
		}
		// p(config::get('CTRL','route'));
	}
}