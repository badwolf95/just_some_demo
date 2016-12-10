<?php
namespace app\enjoyusf\controller;
use think\Controller;

class Base extends Controller {

	public function __construct(){
		parent::__construct();
		if(!session('Badman')){
			return $this->redirect('/enjoyusf/loginout/login');
		}
	}

}