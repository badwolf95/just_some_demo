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
     * 发送反馈内容
     */
    public function postFeedback()
    {
        // 1、校验数据
        $p = input('post.');
        $user = db('users')->where('session',$p['session'])->find();
        if(!$user){
            return result(0,'用户不存在');
        }
        // 2、意见数据入库
        $images = implode(',',$p['images']);
        $insert = [
            'user_id'  =>  $user['id'],
            'content'   =>  $p['content'],
            'images'    =>  $images,
            'create_time'   =>  time()
        ];
        $res = db('feedback')->insert($insert);
        return result(1,'反馈成功');
    }

    /**
     * 获取我的收藏列表
     */
    public function getMyCollectedList()
    {
        // 1、校验数据
        $p = input('post.');
        $user = db('users')->where('session',$p['session'])->find();
        if(!$user){
            return result(0,'用户不存在');
        }
        // 2、收藏列表
        $res = db('collected')
            ->alias('c')
            ->where('c.user_id',$user['id'])
            ->join('service s','c.service_id=s.id')
            ->join('type_unit tu','s.unit_id=tu.id')
            ->field('c.create_time,s.id,s.status,s.title,s.images,s.price,tu.name as unit_name')
            ->order('c.id desc')
            ->select();
        foreach($res as $k=>$v){
            if($res[$k]['status']==0){
                unset($res[$k]);
            }else{
                $images = explode(',',$res[$k]['images']);
                $res[$k]['images'] = $images[0]??'';
                $res[$k]['create_time'] = date('Y-m-d',$res[$k]['create_time']);
            }
        }

        return result(1,$res);
    }


    /**
     * 评论列表
     */
    public function getMyCommentList()
    {
        // 1、校验数据
        $p = input('post.');
        $user = db('users')->where('session',$p['session'])->find();
        if(!$user){
            return result(0,'用户不存在');
        }

        // 2、获取我发表的
        $where = [
            'c.user_id'   =>  $user['id'],
            'c.status'    =>  1
        ];
        $from_me = db('comment')
            ->alias('c')
            ->where($where)
            ->join('service s','c.service_id = s.id')
            ->join('users u','c.to_id=u.id')
            ->field('u.nickname,u.avatar_url,
                          s.title,c.deal_id,c.create_time,c.score,c.content,c.images')
            ->order('c.id desc')
            ->select();
        // 加工数据
        foreach($from_me as $k=>$v){
            // 图片字符串转成数组
            $images = explode(',',$from_me[$k]['images']);
            if(empty($images[0])){
                $images = [];
            }
            $from_me[$k]['images'] = $images;
            // 创建日期
            $from_me[$k]['create_time'] = date('Y-m-d',$from_me[$k]['create_time']);
        }

        // 3、获取我收到的
        $where = [
            'c.to_id'   =>  $user['id'],
            'c.status'    =>  1
        ];
        $to_me = db('comment')
            ->alias('c')
            ->where($where)
            ->join('service s','c.service_id = s.id')
            ->join('users u','c.user_id=u.id')
            ->field('u.nickname,u.avatar_url,
                          s.title,c.deal_id,c.create_time,c.score,c.content,c.images,c.anonymous')
            ->order('c.id desc')
            ->select();
        // 加工数据
        foreach($to_me as $k=>$v){
            // 匿名则不显示用户名
            if($to_me[$k]['anonymous']==1){
                $to_me[$k]['nickname'] = '';
            }
            // 图片字符串转成数组
            $images = explode(',',$to_me[$k]['images']);
            if(empty($images[0])){
                $images = [];
            }
            $to_me[$k]['images'] = $images;
            // 创建日期
            $to_me[$k]['create_time'] = date('Y-m-d',$to_me[$k]['create_time']);
        }
        // 4、返回最后结果
        $res['from_me'] = $from_me;
        $res['count_from'] = count($from_me);
        $res['to_me']   = $to_me;
        $res['count_to'] = count($to_me);
        return result(1,$res);
    }

    /**
     * 通过ID删除已发布的服务或求助
     */
    public function confirmDeletePostById()
    {
        // 1、校验数据
        $p = input('post.');
        $user = db('users')->where('session',$p['session'])->find();
        if(!$user){
            return result(0,'用户不存在');
        }
        $where = [
            'id'        =>  $p['id'],
            'user_id'   =>  $user['id'],
        ];
        $post = db('service')->where($where)->find();
        if(!$post){
            return result(0,'订单不存在');
        }
        $update = ['status'=>0];
        $res = db('service')->where('id',$p['id'])->update($update);
        return $res?result(1,'删除成功'):result(0,'删除失败');
    }

    /**
     * 获取我得发布列表
     */
    public function getMyPostList()
    {
        // 1、校验数据
        $p = input('post.');
        $user = db('users')->where('session',$p['session'])->find();
        if(!$user){
            return result(0,'用户不存在');
        }
        // 2、分别获取我发布的服务和求助列表
        // 首先获取服务
        $where = [
            'user_id'   =>  $user['id'],
            'type'      =>  1,
            'status'    =>  1,
        ];
        $service = db('service')
            ->alias('s')
            ->where($where)
            ->join('type_unit tu','s.unit_id=tu.id')
            ->field('s.id,status,title,images,price,tu.name as unit_name')
            ->order('s.id desc')
            ->select();
        foreach($service as $k=>$v){
            $images = explode(',',$service[$k]['images']);
            $service[$k]['images'] = $images[0]??'';
            $service[$k]['status_mes'] = getPostStatus($service[$k]['status']);
        }
        // 其次获取求助
        $where = [
            'user_id'   =>  $user['id'],
            'type'      =>  2,
            'status'    =>  1,
        ];
        $appeal = db('service')
            ->where($where)
            ->field('id,status,title,images,price')
            ->order('id desc')
            ->select();
        foreach($appeal as $k=>$v) {
            $images = explode(',', $appeal[$k]['images']);
            $appeal[$k]['images'] = $images[0]??'';
            $appeal[$k]['status_mes'] = getPostStatus($appeal[$k]['status']);

        }
        // 3、返回获取的结果
        $res = [
            'service'   =>  $service,
            'appeal'    =>  $appeal
        ];
        return result(1,$res);
    }




	/**
	 * 通过确认服务，获取新的formId
	 * 更新service表中的相应服务的form_id
	 * @throws \think\Exception
	 */
	public function updateOrderFormId()
	{
	    // 1、校验数据
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		// 2、更新数据
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
		$type = $p['type'];
		// 1、获取 我购买的
		$where = [
			'appeal_user_id'	=>	$user['id'],
            'type'              =>  $type
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
			'service_user_id'	=>	$user['id'],
            'type'              =>  $type
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
			'form_id_valid'	=>	0,
            'type'      =>  $type
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
     * 更新用户表数据（如果是新用户则新增到评分表）
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
	    	// 新增到评分表中
            $data = [
                'user_id'   =>  $users->id,
                'overall'   =>  5.0,
                'average'   =>  5.0,
                'count'     =>  1,
                'create_time'   => time(),
                'update_time'   =>  time()
            ];
            $res_sc = db('score')->insert($data);
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
