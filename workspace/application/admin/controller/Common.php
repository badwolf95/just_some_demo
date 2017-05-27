<?php
namespace app\admin\controller;
use think\Controller;
use think\Validate;
use think\Request;

class Common extends Controller{

	public function __construct(){
		//这里必须加上父类的初始化函数，否则报错
		parent::__construct();
		if(null == session('Admin_one')){
			return $this->redirect('/admin/start_end/login');
		}
	}





	public function changeStatus(){
		$id = input('post.id');
		$status = input('post.status');
		$table = input('post.table');
		if(1 == $status){
			$update = 0;
		}else{
			$update = 1;
		}
		$res = model($table)->where('id',$id)->setField('status',$update);
		if($res){
			$data['id'] = $id;
			$data['status'] = $status;
			return show(1,'修改成功',$data);
		}else{
			return show(0,'修改失败');
		}
	}

	public function delete(){
		$id = input('post.id');
		$data['id'] = $id;
		$table = input('post.table');
		if($id && is_numeric($id)){
			$res = model($table)->where('id',$id)->delete();
		}
		if($res){
			return show(1,'删除成功',$data);
		}else{
			return show(0,'删除失败');
		}

	}

	public function delete_many(){
		$data = input('post.');
		$table = $data['table'];
		if($data['ids'][0] != ''){
			$ids = $data['ids'];
		}else{
			return show(0,'请先选择');
		}
		$err = [];
		foreach($ids as $id){
			$res = model($table)->where('id',$id)->delete();
			if(!$res){
				$err[] = $id;
			}
		}
		if($err){
			return show(0,'部分未删除成功，请重试');
		}else{
			return show(1,'操作成功');
		}
	}


	public function hidden(){
		$data = input('post.');
		if($data['ids'][0] != ''){
			$ids = $data['ids'];
		}else{
			return show(0,'请先选择');	
		}
		$table = $data['table'];
		$data = [];
		$data['status'] = '2';
		$data['update_time'] = time();
		$err = [];
		foreach($ids as $id){
			$res = model($table)->where('id',$id)->update($data);
			if(!$res){
				$err[] = $id;
			}
		}
		if($err){
			$err_id = implode(',',$err);
			return show(0,'操作繁忙');
		}else{
			return show(1,'设置成功');
		}
	}

	public function forbidden(){
		$data = input('post.');
		$table = $data['table'];
		if($data['ids'][0] != ''){
			$ids = $data['ids'];
		}else{
			return show(0,'请先选择');
		}
		foreach($ids as $id){
			$user_id_fade = model($table)->where('id',$id)->value('user_id');
			if($user_id_fade == 1000){
				return show(0,'管理员账号不能在这里禁用');	
			}else{
				if($user_id_fade > config('IDENTITY_NUM')){
					$user_id = $user_id_fade - config('IDENTITY_NUM');
				}else{
					$user_id = $user_id_fade - config('IDENTITY_NUM_ORG');
				}
				$update['status'] = '2';
				$update['update_time'] = time();
				$res = model('User')->where('id',$user_id)->update($update);
				if($res){
					return show(1,'操作成功');
				}else{
					return show(0,'操作失败');
				}
			}
		}
	}

}