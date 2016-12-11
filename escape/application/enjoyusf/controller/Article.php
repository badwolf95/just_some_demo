<?php
namespace app\enjoyusf\controller;
use think\Controller;

class Article extends Base {

	public function index()
	{
		return $this->fetch();
	}

	public function add()
	{
		return $this->fetch();
	}
}