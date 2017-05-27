<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class ReviewOrg extends Common {

	public function index(){
		$review_info = Db::name('review_org')->alias('r')->join('user u','u.id=r.user_id','left')->field('r.id,r.user_id,r.status,r.create_time,r.update_time,r.operate_time,u.nickname')->select();
		$this->assign('review_info',$review_info);
		return $this->fetch();
	}

	public function review_allow(){
		$id = input('post.id');
		$table = input('post.table');
		$status = input('post.status');

		$status_user = model('User')->where('id',$id)->find();
		if($status_user->status != 1){
			return show(0,'该用户未激活,不能通过');
		}
		
		$res = model($table)->where('user_id',$id)->update(['status'=>$status,'operate_time'=>time()]);
		if($res){
			if($status == '2'){
				return show(1,'该组织申请审核通过');
			}else{
				return show(1,'已拒绝该组织申请');
			}
		}else{
			return show(0,'系统繁忙');
		}
	}



}