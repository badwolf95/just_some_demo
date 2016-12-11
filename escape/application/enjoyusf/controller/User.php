<?php
namespace app\enjoyusf\controller;
use think\Controller;

class User extends Base {

	public function index()
	{
		$res = model('User')->select();
		$this->assign('user',$res);
		
		return $this->fetch();
	}

	public function add()
	{
		if(request()->isPost()){
			$username = input('post.username');
			$password = input('post.password');
			if(empty($username)){
				return show(0,'傻逼，你的名字呢');
			}
			if(empty($password)){
				return show(0,'傻逼，写好你的密码');
			}
			$password = addMd5($password);
			$data = [];
			$data['username'] = $username;
			$data['password'] = $password;
			return model('User')->save($data)?show(1,'好咯，哥帮你加上了'):show(0,'额，出了个bug，尴尬');
		}else{
			return $this->fetch();
		}
	}
}