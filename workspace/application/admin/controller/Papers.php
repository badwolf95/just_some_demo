<?php
namespace app\admin\controller;
use think\Controller;
use think\Validate;

class Papers extends Common {

	public function index(){

		if($pagesize = input('param.pagesize')){
			session('pagesize',$pagesize);
		}else{
			$pagesize = session('pagesize')?session('pagesize'):config('MY_PAGESIZE');
		}
		if(input('param.select')){
			$select = input('param.select');
		}else{
			$select = '';
		}
		$map = [];
		$time ='year';
		if($select != ''){
			switch($select){
				case 'create_time':$time = 'today';break;
				case 'status' : $map['status'] = '2';break;
				case 'createby' : $map['user_id'] = '1000';break;
				default : $map['id'] = ['gt','0'];
			}
		}
		$information = model('Papers')->whereTime('create_time',$time)->where($map)->order('create_time','desc')->paginate($pagesize);
		
		
		$page = $information->render();
		$this->assign('page',$page);
		$this->assign('Papers',$information);
		return $this->fetch();
	}


	public function add(){

		if(input('post.')){
			$rules = [
				['title','require|length:0,80','请填写标题|标题长度为25字内'],
				['content','require','请填写内容']
			];
			$validate = new Validate($rules);
			if($validate->check(input('post.'))){
				$data['title'] = input('post.title');
				$data['content'] = input('post.content');
				$data['create_time'] = $data['update_time'] = time();
				$data['user_id'] = '1000';
				$res = model('Papers')->insert($data);
				if($res){
					return show(1,'添加成功');
				}else{
					return show(0,'添加失败');
				}
			}else{
				return show(0,$validate->getError());
			}
		}else{
			return $this->fetch();
		}
	}


}