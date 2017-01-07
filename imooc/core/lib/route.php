<?php 

namespace core\lib;

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
				$this->action = 'index';
			}

			$count = count($patharr);
			$i = 2;
			while($i<$count){
				if(isset($patharr[$i+1])){
					$_GET[$patharr[$i]] = $patharr[$i+1];
				}
				$i += 2;
			}
			// p($_GET);
		}else{
			$this->ctrl = 'index';
			$this->action = 'index';
		}
	}
}