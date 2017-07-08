<?php
namespace app\index\controller;
use think\Controller;
 
class Upload extends Controller
{
	/**
	 * 上传文件
	 * 通过session找到用户
	 *上传文件到指定位置
	 * 成功则入库并返回图片ID
	 * @return [type] [description]
	 */
	public function image()
	{
		// 用户ID
		$post = input('post.');
		$user = model('Users')->where('session',$post['session'])->find();
		if(!$user){
			return result(0);
		}
		// 文件上传
		$file = request()->file('image');
		$info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads',true,false);
		if($info){
			$data = [
				'user_id' => $user->id,
				'path' => $info->getSaveName()
			];
			$images = model('Images');
			$res = $images->data($data)->save();
			return $res?$images->path:0;
		}else{
			$out = $file->getError();
			return result(0,$out);
		}
	}

	/**
	 * 删除图片
	 * 接收session和要删除图片的id
	 * 根据session找到存在的用户
	 * 再根据用户和图片的两个id定位到图片
	 * 删除图片文件
	 * 删除数据库记录
	 * @return bool 成功与否
	 */
	public function deleteImage()
	{
		$post = input('post.');
		$user = model('Users')->where('session',$post['session'])->find();
		$where['user_id'] = $user->id;
		$where['path'] = $post['path'];
		$image = model('Images')->where($where)->find();
		// 图片文件路径，FILE_PATH定义在入口文件，表示上传文件的根目录
		$path = FILE_PATH . $image->path;
		// 删除文件
		unlink($path);
		// 删除数据库记录
		$res = model('Images')->where($where)->delete();
		return $res?result(1):result(0);
	}


}