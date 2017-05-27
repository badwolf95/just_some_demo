<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;

class Information extends Common {

	public function index(){

		return $this->fetch();
	}

}