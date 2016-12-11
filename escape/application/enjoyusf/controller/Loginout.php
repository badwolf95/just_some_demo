<?php
namespace app\enjoyusf\controller;
use think\Controller;

class Loginout extends Controller {

	public function login(){
		if(request()->isPost()){
			$username = input('post.username');
			$password = input('post.password');
			if(empty($username)){
				return show(0,'用户名不能为空');
			}
			if(empty($password)){
				return show(0,'密码不能为空');
			}
			$password = addMd5($password);
			$where = [];
			$where['username'] = $username;
			$where['password'] = $password;
			$res = model('User')->where($where)->find();
			if($res){
				session('Badman',$res);
				$data = [];
				$data['lastlogin_time'] = time();
				if(model('User')->where($where)->update($data)){
					return show(1,'登陆成功');
				}else{
					return show(0,'登陆上啦，but时间有点小问题');
				}

			}else{
				return show(0,'用户名或密码错误');
			}

		}else{
			if(session('Badman')){
				return $this->redirect('/enjoyusf/index/index');
			}else{
				$this->view->engine->layout(false);
				return $this->fetch('login/login');
			}
		}
	}

	public function logout()
	{
		session('Badman',null);
		$this->redirect('/index/index');
	}


}