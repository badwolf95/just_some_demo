<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;

class Friends extends Common {

	public function index(){

		// $user_id = $this->_user->id;
		// $user_f = model('Friends')->where('user_id',$user_id)->find();
		
		// $user_friends = explode(',',$user_f->friends_id);
	
		// $my_friends = [];
		// $my_friends_info = [];
		// foreach($user_friends as $ufriends){
		// 	$my_friends[] = model('User')->where('id',$ufriends)->find();
		// 	if($user_f){

		// 		$my_friends_info = model('UserInfo')->where('user_id',$ufriends)->find();
		// 	}
		// }
		// $this->assign('my_friends',$my_friends);
		// if($user_f){
		// 	$this->assign('my_friends_info',$my_friends_info);
		// }
		
		return $this->fetch();
	}

	public function search(){

		if(input('post.')){
			$id = input('post.id');
			$user_id = 0;
			if($id == null){
				return show(0,'你倒是写个数啊亲'.$id);
			}
			if($id<=config('IDENTITY_NUM')){
				$user_id = $id - config('IDENTITY_NUM_ORG');
			}else{
				$user_id = $id - config('IDENTITY_NUM');
			}
			if($user_id == $this->_user->id){
				return show(0,'你找自己是想干嘛？');
			}
			$map = [];
			$map['id'] = $user_id;
			$map['status'] = 1;
			$res = model('User')->where($map)->find();
			if(!$res){
				return show(0,'用户不存在或未激活');
			}else{
				return show(1,'找到咯，等我显示');
			}
		}else{
			$id = input('param.id');
			$user_id = 0;
			if($id<=config('IDENTITY_NUM')){
				$user_id = $id - config('IDENTITY_NUM_ORG');
			}else{
				$user_id = $id - config('IDENTITY_NUM');
			}
			$map = [];
			$map['id'] = $user_id;
			$user = model('User')->where($map)->find();
			unset($map['id']);
			$map['user_id'] = $user_id;
			$userinfo = model('UserInfo')->where($map)->find();
			$this->assign('user',$user);
			$this->assign('userinfo',$userinfo);
			return $this->fetch();
		}
	}

	public function show_card(){

		$id = input('param.id');
		$user = model('User')->where('id',$id)->find();
		$userinfo = model('UserInfo')->where('user_id',$id)->find();
		$this->assign('userinfo',$userinfo);
		$this->assign('user',$user);
		return $this->fetch();
	}

	public function addFriends(){

		$id = input('post.id');
		$user_id = $this->_user->id;
		if(!is_numeric($id)){
			return show(0,'非法用户ID');
		}
		$data = [];
		$data['user_id'] = $user_id;
		$data['add_user_id'] = $id;
		$data['status'] = '1';
		$data['create_time'] = $data['update_time'] = time();
		$res = model('NewFriend')->insert($data);
		if($res){
			return show(1,'申请已成功发送,等待对方处理');
		}else{
			return show(0,'添加失败，快去叫程序猿来改BUG');
		}
	}

	public function allowFriend(){

		$id = input('post.id');
		$map = [];
		$map['id'] = $id;
		$map['add_user_id'] = $this->_user->id;
		$update = [];
		$update['status'] = '3';
		$res = model('NewFriend')->where($map)->update($update);
		$newObj = model('NewFriend')->where($map)->find();
		$new_id = $newObj->user_id;
		$map = [];
		$map['user_id'] = $this->_user->id;
		$data = [];
		$data['user_id'] = $this->_user->id;
		$data['friends_id'] = $new_id.',';
		if(!($friend = model('Friends')->where($map)->find())){
			$data['friends_id'] = ','.$data['friends_id'];
			$data['create_time'] = $data['update_time'] = time();
			$res2 = model('Friends')->insert($data);
		}else{
			$friends_id = $friend->friends_id;
			$data['friends_id'] = $friends_id.$data['friends_id'];
			$res2 = model('Friends')->where($map)->update($data);
		}
		if($res && $res2){
			return show(1,'');
		}else{
			return show(0,'');
		}
	}
	
	public function denyFriend(){

		$id = input('post.id');
		$map = [];
		$map['id'] = $id;
		$map['add_user_id'] = $this->_user->id;
		$update = [];
		$update['status'] = '4';
		$res = model('NewFriend')->where($map)->update($update);
		if($res){
			return show(1,'');
		}else{
			return show(0,'');
		}
	}

}