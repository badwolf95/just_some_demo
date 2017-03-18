<?php 
/**
 * 基础控制器类
 */
namespace app\ctrl;
use core\imooc;
use core\lib\model;
// 需要继承才能实现模板复制
class indexCtrl extends imooc
{
	public function index(){
		$model = new \app\model\adminModel();
		$title = "twig test ";
		$data = "this is just a test234.";
		$this->assign('title',$title);
		$this->assign('data',$data);
		$this->display('index/index');
/*
		// p('it is the index control');
		$model = new model();
		$sql = "select * from admin";
		$ret = $model->query($sql);
		// p($ret->fetchAll());
		$title = "Viewer";
		// $data = "Hello Viewer";
		$data = "";
		$this->assign('title',$title);
		$this->assign('data',$data);
		$this->display('index/index');
		*/
	}

	public function test(){
		$test = "test";
		$this->assign('test',$test);
		$this->display('index/test');
	}

}