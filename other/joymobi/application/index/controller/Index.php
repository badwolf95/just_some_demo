<?php
namespace app\index\controller;
use think\Controller;
 
class Index extends Controller
{
	public function index()
    {
        return $this->fetch();
    }

	/**
	 * 通过确认服务，获取新的formId
	 * 更新service表中的相应服务的form_id
	 * @throws \think\Exception
	 */
	public function updateOrderFormId()
	{
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		$where = ['id'=> $p['service_id']];
		$update = [
			'form_id'	=>	$p['form_id'],
			'form_id_valid'	=>	1
		];
		$res = db('service')->where($where)->update($update);
		return $res?result(1,'更新成功'):result(0,'更新失败');
	}

	/**
	 * 1、获取 我购买的
	 * 2、获取 我出售的
	 * 3、获取 formid已经失效的服务
	 * 4、要返回的数据
	 */
	public function getMySvDealList()
	{
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		// 1、获取 我购买的
		$where = [
			'appeal_user_id'	=>	$user['id']
		];
		$buyOrder = db('deal_service')
				->alias('ds')
				->where($where)
				->join('service sv','ds.service_id = sv.id')
				->join('users ur','ds.service_user_id = ur.id')
				->field('ds.id as id,
						 ds.unit,
						 ds.count,
						 ds.price,
						 ds.discount_price,
						 ds.overall,
						 ds.status,
						 ds.end_time,
						 ur.nickname,
						 ur.avatar_url,
						 sv.title,
						 sv.images')
				->order('ds.id desc')
				->select();
		// 获取订单状态
		foreach($buyOrder as $k=>$v){
			if($buyOrder[$k]['status']==3 && $buyOrder[$k]['end_time']<time()){
				$res = db('deal_service')->where('id',$buyOrder[$k]['id'])->update(['status'=>6]);
				$buyOrder[$k]['status'] = $res?6:3;
			}
			$buyOrder[$k]['status'] = getDealStatus($buyOrder[$k]['status']);
			$buyOrder[$k]['amount'] = $buyOrder[$k]['overall'] - $buyOrder[$k]['discount_price'];
			// 只获取该服务的第一张封面
			$images = explode(',',$buyOrder[$k]['images']);
			$buyOrder[$k]['images'] = is_array($images)?$images[0]:'';
		}

		// 2、获取 我出售的
		$where = [
			'service_user_id'	=>	$user['id']
		];
		$saleOrder = db('deal_service')
				->alias('ds')
				->where($where)
				->join('service sv','ds.service_id = sv.id')
				->join('users ur','ds.service_user_id = ur.id')
				->field('ds.id as id,
						 ds.unit,
						 ds.count,
						 ds.price,
						 ds.discount_price,
						 ds.overall,
						 ds.status,
						 ds.end_time,
						 ur.nickname,
						 ur.avatar_url,
						 sv.title,
						 sv.images')
				->order('ds.id desc')
				->select();
		// 获取订单状态
		foreach($saleOrder as $k=>$v) {
			if($saleOrder[$k]['status']==3 && $saleOrder[$k]['end_time']<time()){
				$res = db('deal_service')->where('id',$saleOrder[$k]['id'])->update(['status'=>6]);
				$saleOrder[$k]['status'] = $res?6:3;
			}
			$saleOrder[$k]['status'] = getDealStatus($saleOrder[$k]['status']);
			$saleOrder[$k]['amount'] = $saleOrder[$k]['overall'] - $saleOrder[$k]['discount_price'];
			// 只获取该服务的第一张封面
			$images = explode(',',$saleOrder[$k]['images']);
			$saleOrder[$k]['images'] = is_array($images)?$images[0]:'';
		}

		// 3、获取 formid已经失效的服务
		$where = [
			'user_id'	=>	$user['id'],
			'form_id_valid'	=>	0
		];
		$order = db('service')->where($where)->field('id,title')->select();
		foreach($order as $k=>$v){
			$order[$k]['title'] = mb_substr($order[$k]['title'], 0,14).'...';
		}
		// 4、要返回的数据
		$data = [
				'buyOrder'	=>	$buyOrder,
				'saleOrder'	=>	$saleOrder,
				'order'	=>	$order
		];
		if($buyOrder && $saleOrder){
			return result(1,$data);
		}else{
			return result(0,$data);
		}
	}



	/**
	 * 获取access_token
	 * 微信模板推送中需要使用的
	 * access_token 是全局唯一接口调用凭据
	 * 开发者调用各接口时都需使用 access_token
	 * access_token 的有效期目前为2个小时，需定时刷新
	 * 重复获取将导致上次获取的 access_token 失效
	 */
	public function getAccessToken(){
		$url = config('TEMPLATE_GET_ACCESS_TOKEN').'&appid='.config('APPID').'&secret='.config('SECRET');
		// 加上true强制转换成数组
		$token = json_decode(http_get($url),true);
		if(isset($token['access_token'])){
			$expires_in = date("Y-m-d H:i:s ##",time()+$token['expires_in']).$token['expires_in'];
			// 数据准备
			$data = [
					'key' 			=>  'access_token',
					'value'			=> 	$token['access_token'],
					'expires_in'	=>	$expires_in
			];
			$where = ['key'=>'access_token'];
			$kv = db('key_value')->where($where)->find();
			if($kv){
				$res = db('key_value')->where($where)->update($data);
			}else{
				$res = db('key_value')->where($where)->insert($data);
			}
			return $res?'获取成功':'获取失败';
		}else{
			dump($token);
		}
	}


    /**
     * 用户登陆
     * 获取用户信息，然后向微信发起请求获取用户的session_key和openid
     * 更新用户表数据
     * 新建session发给用户作为标识
     * @return string 用户标识
     */
    public function login(){
    	$postInfo = input('post.');
    	$code = $postInfo['code'];
    	$userInfo = $postInfo['userInfo'];
    	// 获取session_key和openid
    	$data = [
    		'js_code'=> $code,
    		'appid'=> config('APPID'),
    		'secret'=> config('SECRET'),
    		'grant_type'=> config('GRANT_TYPE')
    	]; 
    	$res = http(config('SESSIONURL'),$data);
    	$res = json_decode($res);
    	// 可能出现的假code导致失败
    	if(isset($res->errcode) || !isset($res->openid)){
    		return result(0,['error'=>'fake code']);
    	}
    	// 生成session
    	$session = addMd5($res->openid);
    	session('user',$session);
    	session('expire',3600*2);
    	// 是否是新用户，是的话得新建
    	$users = model('Users');
		$userOne = $users->where('openid',$res->openid)->find();
        $update = [
            'session_key'  => $res->session_key,
            'session'      => $session,
            'nickname'     => $userInfo['nickName'],
            'avatar_url'   => $userInfo['avatarUrl'],
            'gender'       => $userInfo['gender'],
            'city'         => $userInfo['city'],
            'province'     => $userInfo['province'],
            'last_login_time'   => time()
        ];
		if($userOne){
			// 写入数据库
	    	$where = ['id'=>$userOne->id];
    		$flag = $users->save($update,$where);
		}else{
			// 写入数据库
            $update['openid'] = $res->openid;
	    	$flag = $users->data($update)->save();
		}    	
    	$out = [
    		'session' => session('user'),
    	];
    	return $flag?result(1,$out):result(0,$out);
    }

	/**
	 * 检查session是否存在
	 */
    public function checkSession()
    {
        $post = input('post.');
        $user = model('Users')->where('session',$post['session'])->find();
        return $user?result(1):result(0);
    }




}
