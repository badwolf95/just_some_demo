<?php
namespace app\enjoyusf\controller;
use think\Controller;
use think\Validate;
use think\File;

class Article extends Base {

	public function index()
	{
		return $this->fetch();
	}

	public function fileUpload()
	{
		$file = request()->file('thumb');
		if($file){
			$file_info = $file->move(ROOT_PATH.'public'.DS.'uploads');
			if($file_info){
				$data = '/uploads/'.$file_info->getSaveName();
				return show(1,'上传成功',$data);
			}else{
				return show(0,'封面上传失败,具体原因如下：'.$file_info->getError());
			}
		}else{
			return show(0,'上传失败');
		}
	}

	public function kindUpload()
	{
		//异步上传中，如果不知道文件名的话，这样处理
		$files = request()->file();
		foreach($files as $file){
	        // 移动到框架应用根目录/public/uploads/ 目录下
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	        if($info){
	            // 成功上传后 获取上传信息
	            $data = '/uploads/'.$info->getSaveName();
				return showKind(0,$data);
	        }else{
	            // 上传失败获取错误信息
	            return showKind(1,'封面上传失败,具体原因如下：'.$info->getError());
	        }
	    }
	}

	public function add()
	{
		if(request()->isPost()){
			$rules = [
				['title','require|length:0,90','标题别忘了|标题有点长了，30个字以内'],
				['summary','require|length:10,400','写点简介呗|简介少了或者多了,120个字就好'],
				['content','require','咋不写点捏']
			];
			$validate = new Validate($rules);
			if($validate->check(input('post.'))){
				$user = session('Badman');
				$data = [];
				$data['user_id'] = $user->id;
				$data['title'] = input('post.title');
				$data['summary'] = input('post.summary');
				$data['thumb'] = input('post.thumb');
				$data['content'] = input('post.content');
				//图片
				
				$res = model('Article')->insert($data);
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