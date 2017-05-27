<?php
namespace app\admin\controller;
use think\Controller;
use think\Validate;
use think\Request;

class Admin extends Common{

	public function index(){
		$admins = model('Admin')->order('update_time','desc')->select();
		$this->assign('admins',$admins);

		return $this->fetch();
	}

	public function add(){
		if($_POST){
			$rules = [
				['username','require|max:30|unique:admin','用户名不能为空|用户名最长为30个字母|用户名已存在'],
				['email','email','邮箱格式不正确',2],
				['password','require|length:6,16','密码不能为空|密码长度应为6-16位'],
				['re_password','require|confirm:password','请确认密码|两次输入密码不一致'],
			];
			$validate = new Validate($rules);
			if(!$validate->check(input('post.'))){
				return show(0,$validate->getError());
			}
			$data = input('post.');
			$data['password'] = addMd5($data['password']);
			if(!model('Admin')->allowField(true)->save($data)){
				return show(0,'添加失败');
			}else{
				return show(1,'添加成功');
			}
		}else{
			return $this->fetch();
		}
	}
	public function edit($id=0){
		if($id && is_numeric($id)){
			$admin = model('Admin')->find($id);
			$this->assign('admin',$admin);
			return $this->fetch();
		}elseif($_POST){
			$rules = [
				['post_id','require','非法操作'],
				['username','require|max:30','用户名不能为空|用户名最长为30个字母',],
				['email','email','邮箱格式不正确',2],
				['password','length:6,16','密码长度应为6-16位',2],
				['re_password','requireWith:password|confirm:password','请确认密码|两次输入密码不一致'],
			];
			$validate = new Validate($rules);
			if(!$validate->check(input('post.'))){
				return show(0,$validate->getError());
			}
			$data = input('post.');
			$data['id'] = $data['post_id'];
			if($data['password']){
				$data['password'] = addMd5($data['password']);
				$res = model('Admin')->isUpdate()->allowField(true)->save($data);
			}else{
				$res = model('Admin')->isUpdate()->allowField(['id','username','email'])->save($data);
			}
			if($res){
				return show(1,'修改成功');
			}else{
				return show(0,'修改失败');
			}

		}else{
			$this->redirect('/admin/admin');
		}
	}

	


	
}