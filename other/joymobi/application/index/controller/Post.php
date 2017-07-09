<?php
namespace app\index\controller;
use think\Controller;

class Post extends Controller
{

    /**
     * 获取服务详情的原生数据用于编辑
     */
    public function getPostOneRawInfo()
    {
        // 1、校验数据
        $p = input('post.');
        $user = db('users')->where('session',$p['session'])->find();
        if(!$user){
            return result(0,'用户不存在');
        }
        // 2、获取服务订单信息
        $where = [
            'id'        =>  $p['id'],
            'user_id'   =>  $user['id']
        ];
        $info = db('service')->where($where)->find();
        $info['images'] = explode(',',$info['images']);
        return $info?result(1,$info):result(0,'获取失败');
    }


	/**
	 * 发布服务
	 * 传来表单值 data: []
	 * formId
	 * showServiceType 为服务类型
     * 根据type不同来区分服务和求助：1服务、2求助
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
		    'type'      => $post['type'],
			'form_id' 	=> $post['form_id'],
			'user_id' 	=> $user->id,
			'status' 	=> 1,
			'title' 	=> $post['title'],
			'summary'	=> $post['summary'],
			'attention'	=> $post['attention']??'',
			'location' 	=> $post['location'],
			'location_name' => $post['location_name'],
			'latitude' 	=> $post['latitude'],
			'longitude' => $post['longitude'],
			'images'	=> $post['images'],
			'style' 	=> $post['showServiceType'],
            'phone'     => $post['phone'],
			'price' 	=> round($post['price'],2),
			'unit_id' 	=> $post['unit_id']??0,
			'service_id' => $post['service_id']??0,
			'scale_id' 	=> $post['scale_id']??0,
            'appeal_id' => $post['appeal_id']??0,
            'dead_time'	=>	$post['date_value']??date('Y-m-d H:i:s'),
		];
		if($post['id']!=null){
		    return model('Service')->save($data,['id'=>$post['id']])?result(1):result(0);
        }else{
            return model('Service')->data($data)->save()?result(1):result(0);
        }
	}
}
