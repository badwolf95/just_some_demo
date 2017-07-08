<?php
namespace app\index\controller;
use think\Controller;
 
class Type extends Controller
{
	/**
	 * 发布服务中所需要的价格单位、服务类型、范围类型
	 * 结果以数组返回
	 */
	public function service()
	{
		$post = input('post.');
		$user = model('Users')->where('session',$post['session'])->find();
		if(!$user){
			return result(0);
		}
		$data = [];
		// 价格单位
		$unit = model('TypeUnit');
		$data['unit_id'] = $unit->column('id');
		$data['unit_array'] = $unit->column('name');
		// 服务类型
		$service = model('TypeService');
		$data['service_id'] = $service->column('id');
		$data['service_array'] = $service->column('name');
		// 范围类型
		$scale = model('TypeScale');
		$data['scale_id'] = $scale->column('id');
		$data['scale_array'] = $scale->column('name');
		return result(1,$data);
	}

	/**
	 * 发布求助中需要的求助类型
	 * 结果以数组返回
	 */
	public function appeal()
	{
		$post = input('post.');
		$user = model('Users')->where('session',$post['session'])->find();
		if(!$user){
			return result(0);
		}
		$data = [];
		// 求助类型
		$appeal = model('TypeAppeal');
		$data['appeal_id'] = $appeal->column('id');
		$data['appeal_array'] = $appeal->column('name');
		return result(1,$data);
	}

	/**
	 * 首页中获取服务类型
	 * 格式与“发布”中的不同
	 */
	public function serviceType()
	{
		$post = input('post.');
		$user = model('Users')->where('session',$post['session'])->find();
		if(!$user){
			return result(0);
		}
		// 服务类型
		$data = db('type_service')
				->field('id,name')
				->order('id asc')
				->select();
		return result(1,$data);
	}

	/**
	 * 首页中获取“求助类型”
	 * 格式与“发布”中的不同
	 */
	public function appealType()
	{
		$post = input('post.');
		$user = model('Users')->where('session',$post['session'])->find();
		if(!$user){
			return result(0);
		}
		// 求助类型
		$data = db('type_appeal')
				->field('id,name')
				->order('id asc')
				->select();
		return result(1,$data);

	}

}