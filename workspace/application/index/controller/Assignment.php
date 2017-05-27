<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;

class Assignment extends Common {

	public function index(){

		return $this->fetch();
	}

}