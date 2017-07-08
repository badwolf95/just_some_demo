<?php
namespace app\index\controller;
use think\Controller;

class Post extends Controller
{

	/**
	 * 发布服务
	 * 传来表单值 data: []
	 * formId
	 * showServiceType 为服务类型
	 * 其中图片为已经上传成功的ID值
	 * @return bool 成功或失败
	 */
	public function service()
	{	
		// 接收数据
		$postData = input("post.");
		$post = $postData['data'];
		// 将图片的ID数组转换成字符串
		$post['images'] = implode(',', $post['images']);
		// 查找用户
		$where['session'] = $post['session'];
		$user = model('Users')->where($where)->find();
		if(!$user){
			return result(0);
		}
		// 格式化数据
		$data = [
			'form_id' 	=> $post['form_id'],
			'user_id' 	=> $user->id,
			'status' 	=> 1,
			'title' 	=> $post['title'],
			'summary'	=> $post['summary'],
			'attention'	=> $post['attention'],
			'location' 	=> $post['location'],
			'location_name' => $post['location_name'],
			'latitude' 	=> $post['latitude'],
			'longitude' => $post['longitude'],
			'images'	=> $post['images'],
			'style' 	=> $post['showServiceType'],
			'price' 	=> round($post['price'],2),
			'unit_id' 	=> $post['unit_id'],
			'service_id' => $post['service_id'],
			'scale_id' 	=> $post['scale_id'],
		];
		return model('Service')->data($data)->save()?result(1):result(0);
	}

	public function appeal()
	{
		$postData = input('post.');
		$post = $postData['data'];
		if(!empty($post['images'])){
			$post['images'] = implode(',', $post['images']);
		}
		$user = model('Users')->where('session',$post['session'])->find();
		if(!$user){
			return result(0);
		}
		$data = [
			'form_id'		=>	$post['form_id'],
			'user_id'		=>	$user->id,
			'status'	=>	1,
			'title'	=>	$post['title'],
			'summary'	=>	$post['summary'],
			'location'	=>	$post['location'],
			'location_name'	=>	$post['location_name'],
			'latitude'	=>	$post['latitude'],
			'longitude'	=>	$post['longitude'],
			'images'	=>	$post['images'],
			'price'	=>	round($post['price'],2),
			'appeal_id'	=>	$post['type_id'],
			'dead_time'	=>	$post['date_value'],
		];
		return model('Appeal')->data($data)->save()?result(1):result(0);
	}
}
