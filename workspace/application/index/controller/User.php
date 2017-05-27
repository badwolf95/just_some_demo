<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class User extends Common {

	public function index(){

		if($user_s = session('user')){
			//基本信息
			$user =  model('User')->where('id',$user_s->id)->find();
			$userinfo = model('UserInfo')->where('user_id',$user_s->id)->find();
			$this->assign('user',$user);
			$this->assign('userinfo',$userinfo);

			//好友申请
			$map = [];
			$map['add_user_id'] = $this->_user->id;
			$map['status'] = '1';
			$new_friends = model('NewFriend')->where($map)->select();
			$friends_apply = [];
			foreach($new_friends as $friend){
				$friends_apply[] = model('User')->where('id',$friend->user_id)->find();
			}
			$this->assign('new_friends',$new_friends);
			$this->assign('friends_apply',$friends_apply);

			return $this->fetch();
		}else{
			return $this->fetch();
		}
	}

	public function setup(){

		if(input('post.')){
			$user_id = $this->_user->id;
			$data = [];
			$data['nickname'] = input('post.nickname');
			$map = [];
			$map['id'] = $user_id;
			$res = model('User')->where($map)->update($data);
			unset($map['id']);
			unset($data['nickname']);
			$map['user_id'] = $this->_user->id;
			$data['grade'] = input('post.grade');
			$data['phone'] = input('post.phone');
			$data['academy'] = input('post.academy');
			$data['organization'] = input('post.organization');
			$data['update_time'] = time();
			if(model('UserInfo')->where($map)->find()){
				$res2 = model('UserInfo')->where($map)->update($data);
			}else{
				$data['user_id'] = $this->_user->id;
				$res2 = model('UserInfo')->insert($data);
			}
			if($res || $res2){
				return show(1,'保存成功');
			}else{
				return show(0,'保存失败');
			}
		}else{
			$id = $this->_user->id;
			$map = [];
			$map['id'] = $id;
			$user = model('User')->where($map)->find();
			unset($map['id']);
			$map['user_id'] = $id;
			$userinfo = model('UserInfo')->where($map)->find();
			$this->assign('user',$user);
			$this->assign('userinfo',$userinfo);
			return $this->fetch();
		}
	}

	

}