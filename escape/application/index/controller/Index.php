<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{

    public function index()
    {
        model('Count')->where('id','>',0)->setInc('visited');
        return $this->fetch();
    }

    public function home()
    {
        $data = [];
        $data['ip'] = $this->getIP();
        $data['visited_time'] = time();
        model('Who')->insert($data);
        model('Count')->where('id','>',0)->setInc('home');
    	$res = model('Article')->where('id','>',5)->select();
    	$this->assign('article',$res);
    	return $this->fetch();
    }

    public function article($get)
    {
        model('Count')->where('id','>',0)->setInc('reading');
    	$where = [];
    	$where['id'] = $get;
    	$res = model('Article')->where($where)->find();
    	$this->assign('res',$res);
    	return $this->fetch();
    }

    public function about()
    {
        model('Count')->where('id','>',0)->setInc('about');
    	$where = [];
    	$where['id'] = 5;
    	$res = model('Article')->where($where)->find();
    	$this->assign('res',$res);
    	return $this->fetch();
    }

    function getIP()
    {
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }

}
