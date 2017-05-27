<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Common
{
	public function __construct(){
		parent::__construct();
	}

    public function index()
    {
        return $this->fetch();
    }
}
