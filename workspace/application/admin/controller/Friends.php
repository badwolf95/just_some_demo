<?php
namespace app\admin\controller;
use think\Controller;
use think\Validate; 
use think\Db;

class Friends extends Common {

	public function index(){
		$friends = model('Friends')->order('id','desc')->select();
		$this->assign('friends',$friends);
		return $this->fetch();
	}

	public function add(){
		if(input('post.')){
			//基本判断
			$rules = [
				['user_id','require|number','请输入用户ID|ID必须为数字'],
				['friends_id','require|number','请输入要添加的用户ID|ID必须为数字'],
			];
			$validate = new Validate($rules);
			if(!$validate->check(input('post.'))){
				return show(0,$validate->getError());
			}
			//转换ID
			$user_id = input('post.user_id');
			$friends_id = input('post.friends_id');
			$user_id = ($user_id>config('IDENTITY_NUM'))?$user_id-config('IDENTITY_NUM'):$user_id-config('IDENTITY_NUM_ORG');
			$friends_id = ($friends_id>config('IDENTITY_NUM'))?$friends_id-config('IDENTITY_NUM'):$friends_id-config('IDENTITY_NUM_ORG');
			//判断用户是否存在
			$user = model('User')->where(['id'=>$user_id,'status'=>'1'])->find();
			if(!$user){
				return show(0,'用户不存在或未激活');
			}
			$friends = model('User')->where(['id'=>$friends_id,'status'=>'1'])->find();
			if(!$friends){
				return show(0,'要添加的好友ID不存在或未激活');
			}
			//判断是否添加了自己
			if($friends_id == $user_id){
				return show(0,'添加自己干哈');
			}
			//判断是否已经建立好友关系
			$map = [
				'user_id' => $user_id,
				'friends_id'=>['like',','.$friends_id.','],
			];
			$friend_exists = model('Friends')->where($map)->find();
			if($friend_exists){
				return show(0,'好友已存在');
			}
			//通过验证，可以执行
			$data = [];
			$data['user_id'] = $user_id;
			$data['friends_id'] = $friends_id.',';
			$friend = [];
			$friend['user_id'] = $friends_id;
			$friend['friends_id'] = $user_id.',';
			$friends_user = model('Friends')->where('user_id',$user_id)->find();
			$friends_fri = model('Friends')->where('user_id',$friends_id)->find();
			//多表，开启事务
			Db::startTrans();
			try{
				//先正向添加好友
					//不存在，新增，否则更新
				if(!$friends_user){
					$data['friends_id'] = ','.$data['friends_id'];
					$data['create_time'] = time();
					db('friends')->insert($data);
				}else{
					$data['friends_id'] = $friends_user->friends_id.$data['friends_id'];
					$data['update_time'] = time();
					db('friends')->where('user_id',$user_id)->update($data);
				}
				//然后反向添加
					//不存在，新增，否则更新
				if(!$friends_fri){
					$friend['friends_id'] = ','.$friend['friends_id'];
					$friend['create_time'] = time();
					db('friends')->insert($friend);
				}else{
					$friend['friends_id'] = $friends_fri->friends_id.$friends['friends_id'];
					$friend['update_time'] = time();
					db('friends')->where('user_id',$friends_id)->update($friend);
				}
				Db::commit();
				return show(1,'关系建立成功');
			}catch(\Exception $e){
				Db::rollback();
				return show(0,$e->getError());
			}
		}else{
			return $this->fetch();
		}
	}
}