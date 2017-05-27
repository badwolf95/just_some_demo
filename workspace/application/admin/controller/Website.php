<?php
namespace app\admin\controller;
use think\Controller;

class Website extends Common {

	public function index(){
		$info = model('Website')->find();
		$info->update_time = date("Y-m-d H:i:s",$info->update_time);
		$this->assign('web',$info);
		return $this->fetch();
	}

	public function edit(){
		$exists = model('Website')->find();
		$data = input('post.');
		if(!$exists){
			$res = model('Website')->allowField(['website_name','copyright','reason'])->save($data);
		}else{
			$data['id']= $exists['id'];
			$res = model('Website')->allowField(['id','website_name','copyright','reason'])->isUpdate()->save($data);
		}
		if($res){
			return show(1,'修改成功');
		}else{
			return show(0,'修改失败');
		}
	}

	
}