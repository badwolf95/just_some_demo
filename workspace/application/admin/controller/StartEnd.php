<?php
namespace app\admin\controller;
use think\Controller;

class StartEnd extends Controller
{
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
			$map['username'] = $username;
			$map['password'] = $password;
			$admin_one = model('Admin')->where($map)->find();
			if(!$admin_one){
				return show(0,'用户名或密码错误');
			}else{
				session('Admin_one',$admin_one);
				return show(1,'登陆成功');
				$this->fetch('/index/index');
			}
		}else{
			if(session('Admin_one')){
				return $this->fetch('/index/index');
			}
			$this->view->engine->layout(false);
			return $this->fetch('/login/login');
		}
	}

	public function logout(){
		//此处后期优化下
		session('Admin_one',null);
		return $this->redirect('/admin/start_end/login');
	}

}