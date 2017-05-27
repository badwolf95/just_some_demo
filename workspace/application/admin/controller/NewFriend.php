<?php
namespace app\admin\controller;
use think\Controller;
use think\Validate;
use think\Db;

class NewFriend extends Common {

	public function index(){
		$newFriendInfo = model('NewFriend')->all();
		$this->assign('newFriendInfo',$newFriendInfo);
		return $this->fetch();
	}
	public function add(){
		if(input('post.')){
			$rules = [
				['user_id','require|number','请输入用户ID|ID必须为数字'],
				['add_user_id','require|number','请输入要添加的好友ID|ID必须为数字'],
			];			
			$validate = new Validate($rules);
			if(!$validate->check(input('post.'))){
				return show(0,$validate->getError());
			}
			//去掉编号增量
			$user_id = input('post.user_id');
			if($user_id>config('IDENTITY_NUM')){
				$user_id -= config('IDENTITY_NUM');
			}else{
				$user_id -= config('IDENTITY_NUM_ORG');
			}
			$add_user_id = input('post.add_user_id');
			if($add_user_id>config('IDENTITY_NUM')){
				$add_user_id -= config('IDENTITY_NUM');
			}else{
				$add_user_id -= config('IDENTITY_NUM_ORG');
			}
			//判断用户是否存在或激活
			$user = model('User')->where('id',$user_id)->find();
			if(!$user || $user['status'] == 0){
				return show(0,'用户不存在或未激活');
			}
			$add_user = model('User')->where('id',$add_user_id)->find();
			if(!$add_user || $add_user['status'] == 0){
				return show(0,'申请添加的用户不存在或未激活');
			}
			//申请是否已存在
			$exists = model('NewFriend')->where(['user_id'=>$user_id,'add_user_id'=>$add_user_id,'status'=>'1'])->select();
			if($exists){
				return show(0,'申请已经提交');
			}
			if($user_id == $add_user_id){
				return show(0,'尊敬的用户，您的智商已欠费，请及时充值，以免影响软件的正常使用');
			}
			//数据有效，入库
			$data['user_id'] = $user_id;
			$data['add_user_id'] = $add_user_id;
			$res = model('NewFriend')->allowField(true)->save($data);
			if($res){
				return show(1,'申请添加成功，等待对方确认');
			}else{
				return show(0,'申请失败');
			}
		}else{
			return $this->fetch();
		}
	}






}