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
			
		}else{
			if(session('Badman')){
				return $this->fetch('index/index');
			}else{
				$this->view->engine->layout(false);
				return $this->fetch('login/login');
			}
		}
	}



}