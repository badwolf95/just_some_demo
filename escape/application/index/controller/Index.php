<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function home()
    {
    	$res = model('Article')->select();
    	$this->assign('article',$res);
    	return $this->fetch();
    }

    public function article($get)
    {
    	$where = [];
    	$where['id'] = $get;
    	$res = model('Article')->where($where)->find();
    	$this->assign('res',$res);
    	return $this->fetch();
    }

    public function about()
    {
    	$where = [];
    	$where['id'] = 5;
    	$res = model('Article')->where($where)->find();
    	$this->assign('res',$res);
    	return $this->fetch();
    }
}
