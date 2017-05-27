<?php
namespace app\admin\controller;
use think\Validate;
use think\Db;

class User extends Common{

	public function index($type=1){
		
			$users = model('User')->alias('u')->where('type','eq',$type)->join('user_info i','u.id = i.user_id','left')->order('u.update_time','desc')->select();
			$this->assign('users',$users);
			if(1 == $type){
				return $this->fetch('user/index');
			}else{
				return $this->fetch('user/index_org');
			}
	
	}

	public function add($type=1){
		if($_POST){
			$rules = [
				['email','require|email|unique:user','请填写邮箱|邮箱格式不正确|邮箱已注册'],
				['type','in:1,2','不要修改类型O(∩_∩)O~'],
				['password','require|length:6,16','请输入密码|密码长度应为6-16位'],
				['re_password','require|confirm:password','请确认密码|两次输入的密码不相同'],
			];
			$validate = new Validate($rules);
			if(!$validate->check(input('post.'))){
				return show(0,$validate->getError());
			}
			$data = input('post.');
			$data['password'] = addMd5($data['password']);
			$res = model('User')->allowField(['email','type','password'])->save($data);
			if($res){
				$r = model('UserInfo')->save(['user_id'=>$res]);
				if($r){
					return show(1,'添加成功');
				}else{
					return shwo(0,'用户添加失败');
				}
			}else{
				return show(0,'添加失败');
			}
		}else{
			return $this->fetch((1==$type?'user/add':'user/add_org'));
		}
	}

	public function edit($type=1){
		$id = input('param.id');
		$type = input('param.type');
		if($id){
			$user = model('User')->where('id',$id)->find();
			$this->assign('user',$user);
			$user_info = model('UserInfo')->where('user_id',$id)->find();
			$this->assign('user_info',$user_info);
			return $this->fetch((1==$type?'user/edit':'user/edit_org'));
		}elseif(input('post.')){
			$data = input('post.');
			$rules = [
				['phone','length:11','手机号格式错误',2],
			];
			$validate = new Validate($rules);
			if(!$validate->check($data)){
				return show(0,$validate->getError());
			}	
			Db::startTrans();
			try{
				db('user')->where('id',$data['user_id'])->update(['type'=>$data['type']]);
				unset($data['type']);
				db('user_info')->where('user_id',$data['user_id'])->update($data);
				Db::commit();
				return show(1,'修改成功');
			}catch(\Exception $e){
				Db::rollback();
				return show(0,$e->getMessage());
			} 
		}else{
			$this->redirect((1==$type?'/admin/user':'/admin/user/index/type/2'));
		}
	}

	public function passwordReset(){
		$id = input('post.id');
		$table = input('post.table');
		$user = model($table)->where('id',$id)->find();
		$user->password = addMd5(config('RESET_PASSWORD'));
		if($user->save()){
			return show(1,'密码已经重置，默认密码为123456');
		}else{
			return show(0,'密码重置失败');
		}
	}

}