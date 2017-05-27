<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;

class Papers extends Common {

	public function index(){

		$map = [];
		$map['user_id'] = $this->_user->id;
		$map['status'] = '2';
		$papers = model('Papers')->where($map)->order('listorder asc,update_time desc')->paginate(4);
		$number = model('Papers')->where($map)->count();
		$this->assign('papers',$papers);
		$this->assign('papers_num',$number);
		return $this->fetch();
	}

	public function add(){
		
		$rules = [
			['title','require|length:10,90','请填写标题|标题长度为7到30个汉字'],
			['content','require','请填写内容']
		];
		$validate = new Validate($rules);
		if($validate->check(input('post.'))){
			// dump(session('user'));
			$user = session('user');
			$data['user_id'] = $user->id;
			$data['title'] = input('post.title');
			$data['content'] = input('post.content');
			$data['create_time'] = $data['update_time'] = time();
			if(model('Papers')->insert($data)){
				return show(1,'添加成功');
			}else{
				return show(0,'添加失败');
			}
		}else{
			return show(0,$validate->getError());
		}
	}

	public function delete(){

		$id = input('post.id');
		if($id && is_numeric($id)){
			$map = [];
			$map['user_id'] = $this->_user->id;
			$map['id'] = $id;
			$res = model('Papers')->where($map)->delete();
			if($res){
				return show(1,'删除成功');
			}else{
				return show(0,'删除失败，请联系管理员解决');
			}
		}else{
			return show(0,'删除失败');
		}
	}

}