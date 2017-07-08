<?php
namespace app\index\controller;
use think\Controller;
use think\Request;

class Service extends Controller
{

	/**
	 * 拒绝接单，通知需求方
	 * 状态变为接单
	 * @param $openid
	 * @param $form_id
	 * @return mixed
	 */
	public function sendTempMessage_RejectTakingOrder($openid,$form_id)
	{
		$touser = $openid;
		$template_id = 'u_Eqp-J1uKqs_6O57O3cIxAztGYjWZ-zx1fC8UyM1to';
		$page	= '/pages/index/index';
		$form_id = $form_id;
		$data = [
				'keyword1'=>['value'=>'服务方拒绝接单'],
				'keyword2'=>['value'=>'退款正在处理，请注意查收']
		];
		return sendTempMessage($touser,$template_id,$page,$form_id,$data);
	}

	/**
	 * 已接单，通知需求方
	 * 状态变为进行中
	 * @param $openid
	 * @param $form_id
	 * @return mixed
	 * @throws \think\Exception
	 */
	public function sendTempMessage_OnGoing($openid,$form_id)
	{
		$touser = $openid;
		$template_id = 'u_Eqp-J1uKqs_6O57O3cIxAztGYjWZ-zx1fC8UyM1to';
		$page	= '/pages/index/index';
		$form_id = $form_id;
		$data = [
				'keyword1'=>['value'=>'服务方已接单，请及时联系对方开始服务'],
				'keyword2'=>['value'=>'过期将自动付款']
		];
		return sendTempMessage($touser,$template_id,$page,$form_id,$data);
	}


	/**
	 * 下单成功后，通知服务方接单
	 * @param $openid: 用户的OPENID
	 * @param $form_id: 可用的form_id
	 * @return mixed
	 * @throws \think\Exception
	 */
	public function sendTempMessage_WaitForTaking($openid,$form_id)
	{
		$touser = $openid;
		$template_id = 'u_Eqp-J1uKqs_6O57O3cIxAztGYjWZ-zx1fC8UyM1to';
		$page	= '/pages/index/index';
		$form_id = $form_id;
		$data = [
				'keyword1'=>['value'=>'你有新订单，请在六小时内确认是否接单'],
				'keyword2'=>['value'=>'过期将作废']
		];
		$res = sendTempMessage($touser,$template_id,$page,$form_id,$data);
		// 订单生成时，在service表中这个字段需要更新
		db('service')->where('form_id',$form_id)->update(['form_id_valid'=>0]);
		return $res;
	}


	public function confirmCompleteOrder()
	{
		// 1、校验数据
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		$deal_id = $p['deal_id'];
		$where = [
				'id'	=>	$deal_id
		];
		$deal = db('deal_service')->where($where)->find();
		if(!$deal){
			return result(0,'订单不存在');
		}
		if($deal['service_user_id']==$user['id']){
			$update = ['complete_service'	=>	1];
			$complete = $deal['complete_appeal'];
		}else if($deal['appeal_user_id']==$user['id']){
			$update = ['complete_appeal'	=>	1];
			$complete = $deal['complete_service'];
		}else{
			return result(0,'操作非法');
		}
		// 2、更新订单状态
		$res = db('deal_service')->where($where)->update($update);
		if(!$res){
			return result(0,'订单确认处理失败');
		}else{
			// 3、判断双方是否已经确认，如果没有则返回，否则进行结算处理
			if($complete==1){
				// 4、对方也已经确认，现在可以结算

			}else{
				return result(1,'订单确认成功');
			}
		}
	}

	/**
	 * 确认取消订单
	 * @throws \think\Exception
	 */
	public function confirmCancelTakeOrder()
	{
		// 1、校验数据
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		$deal_id = $p['deal_id'];
		$where = [
				'id'	=>	$deal_id,
				'service_user_id'	=>	$user['id']
		];
		$deal = db('deal_service')->where($where)->find();
		if(!$deal){
			return result(0,'操作非法');
		}
		// 2、找到需求方的formid，用来发送模板通知
		$appealer = db('users')->where('id',$deal['appeal_user_id'])->find();
		// 3、记录下之前的formId来发送通知，同时用新的更新它
		$oldFormId = $deal['form_id'];
		$update = [
				'status'	=>	7,
				'form_id'	=>	$p['form_id']
		];
		// 4、更新状态，成功则发送模板通知给需求方
		$res = db('deal_service')->where($where)->update($update);
		if(!$res){
			return result(0,'拒绝接单处理失败');
		}else{
			$sendResMes = $this->sendTempMessage_RejectTakingOrder($appealer['openid'],$oldFormId);
		}
		$refundResMes = $this->dealRefundAll($p['session'],$p['deal_id'],7);
		return $res?result(1,['订单拒绝成功',$sendResMes,$refundResMes]):result(0,['订单拒绝失败',$sendResMes,$refundResMes]);
	}

	/**
	 * 确认接单
	 * 1、校验数据
	 * 2、找到需求方的formid，用来发送模板通知
	 * 3、记录下之前的formId来发送通知，同时用新的更新它
	 * 4、更新状态，成功则发送模板通知给需求方
	 * @throws \think\Exception
	 */
	public function confirmTakeOrder()
	{
		// 1、校验数据
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		$deal_id = $p['deal_id'];
		$where = [
			'id'	=>	$deal_id,
			'service_user_id'	=>	$user['id']
		];
		$deal = db('deal_service')->where($where)->find();
		if(!$deal){
			return result(0,'操作非法');
		}
		// 2、找到需求方的formid，用来发送模板通知
		$appealer = db('users')->where('id',$deal['appeal_user_id'])->find();
		// 3、记录下之前的formId来发送通知，同时用新的更新它
		$oldFormId = $deal['form_id'];
		$update = [
			'status'	=>	5,
			'form_id'	=>	$p['form_id']
		];
		// 4、更新状态，成功则发送模板通知给需求方
		$res = db('deal_service')->where($where)->update($update);
		if(!$res){
			return result(0,'接单处理失败');
		}else{
			$sendResMes = $this->sendTempMessage_OnGoing($appealer['openid'],$oldFormId);
		}
		return $res?result(1,['订单接收成功',$sendResMes]):result(0,['订单接收失败',$sendResMes]);
	}


	/**
	 * 处理给优惠操作
	 * 数据合法后，先进行写入，等成交时再做最后的打款处理
	 * @throws \think\Exception
	 */
	public function serviceDiscount(){
		// 校验数据
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		$deal_id = $p['deal_id'];
		$deal = db('deal_service')->where('id',$deal_id)->find();
		if(!$deal){
			return result(0,'订单不存在');
		}
		// 处理优惠折扣
		if(!is_numeric($p['changePrice'])){
			return result(0,'折扣数量错误');
		}
		// 查看是否超过限额
		$discount = round($p['changePrice'],2)+$deal['discount_price'];
		if($discount > $deal['overall']){
			return result(0,'超过限额');
		}
		$update = ['discount_price' => $discount];
		$res = db('deal_service')->where('id',$deal_id)->update($update);
		return $res?result(1,'打折成功'):result(0,'打折失败');
	}


	/**
	 * 补差价
	 * 处理差价
	 * 获取新订单号码
	 * 与微信进行通信后返回给前台相关数据
	 */
	public function serviceIncPrice(){
		// 校验数据
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		$deal_id = $p['deal_id'];
		$deal = db('deal_service')->where('id',$deal_id)->find();
		if(!$deal){
			return result(0,'订单不存在');
		}
		// 处理差价
		$increase = round($p['changePrice'],2);
		// 获取新订单号码
		$order_number = getOrderNumber();
		// 与微信进行通信后返回给前台相关数据
		return $this->getPrepayResult($deal['id'],$order_number,$increase,$user['openid'],'1','周末邦-服务补差价');
	}


	/**
	 * 取消订单
	 * @throws \think\Exception
	 */
	public function cancelDeal()
	{
		$p = input('post.');
		return $this->dealRefundAll($p['session'],$p['deal_id'],4);
	}


	public function dealRefundAll($session,$deal_id,$status)
	{
		// 校验数据
		$user = db('users')->where('session',$session)->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		$deal = db('deal_service')->where('id',$deal_id)->find();
		if(!$deal || !($deal['service_user_id']==$user['id'] || $deal['appeal_user_id']==$user['id'])){
			return result(0,'订单不存在');
		}
		// 进行全额退款处理
		$where = [];
		$where['deal_id'] = $deal_id;
		$where['pay_confirm'] = 1;
		$where['refund_fee'] = 0;
		$pay_log = db('pay_log')->where($where)->select();
		$res = [];
		$flag = true;
		$refund_fee = 0;
		foreach($pay_log as $k => $v){
			$result = $this->dealRefund($pay_log[$k]['order_number'],$pay_log[$k]['amount']);
			$res[] = $result;
			if($result == true){
				$refund_fee += $pay_log[$k]['amount'];
			}else{
				$flag = false;
			}
		}
		// 校验成功则更新订单状态和退款信息
		$update = [
				'status'	=> $status,
				'refund_fee' => $refund_fee,
				'refund_result' => implode(',',$res)
		];
		$r = db('deal_service')->where('id',$deal_id)->update($update);
		if(!$r){
			return result(0,'退款-更新数据库失败');
		}else if(false == $flag){
			return result(0,'退款-部分退款正在处理');
		}
		$data['status'] = getDealStatus($status);
		return result(1,'退款成功');
	}

	/**
	 * 微信退款处理
	 * @param $order_number
	 * @param $amount
	 * @return bool|string
	 * @throws \think\Exception
	 */
	public function dealRefund($order_number,$amount){
		$amount *= 100;
		// 生成退款单号
		$out_refund_no = getRefundNumber();
		// 金额大于 1元的 收取百分之一的手续费
		$refund_fee	  = $amount<100?:floor($amount*0.99);
		// 数据准备
		$request = [
			'appid'		=>	config('APPID'),
			'mch_id'	=>	config('MCH_ID'),
			'nonce_str'	=>	getRandomString(),
			'out_trade_no'	=>	$order_number,
			'out_refund_no'	=>	$out_refund_no,
			'total_fee'	=>	$amount,
			'refund_fee'=>	$refund_fee,
			'op_user_id'=>	config('MCH_ID')
		];
		// 进行签名
		$sign = getSign($request);
		$request['sign'] = $sign;
		// 发起请求，数据格式会转为xml并转成数组输出
		$res = curl_post_ssl(config('PAY_REFUND_URL'),$request);
//		dump($res);
		// 进行签名校验，不能包含sign本身
		$sign = $res['sign']??'';
		unset($res['sign']);
		$mySign = getSign($res);
		if($sign == $mySign){
			// 校验成功则更新订单状态和退款信息
			$update = [
				'refund_fee' => $refund_fee,
				'out_refund_no'=>$out_refund_no
			];
			$r = db('pay_log')->where('order_number',$order_number)->update($update);
			if(!$r){
				return '退款-更新数据库失败';
			}
			return true;
		}else{
			return '退款-微信返回的签名校验失败';
		}
	}


	/**
	 * 获取服务订单详情
	 * 1、数据处理
	 * 2、进行多表关联查询
	 * 3、返回数据前对数据进行加工
	 * @return mixed
	 */
	public function getSvDealInfo()
	{
		// 1、数据处理
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		$deal_id = $p['deal_id'];
		$deal = db('deal_service')->where('id',$deal_id)->find();
		if(!$deal){
			return result(0,'订单不存在');
		}
		if($user){
			// 2、进行多表关联查询，包括订单、服务、用户
			$where = [];
			$where['ds.id'] = $deal_id;
			$res = db('deal_service')
					->alias('ds')
					->where($where)
					->join('service sv','ds.service_id = sv.id')
					->join('users ur','ds.service_user_id = ur.id')
					->field('ds.id as id,
							 ds.service_user_id,
							 ds.appeal_user_id,
							 ds.appeal_name,
							 ds.appeal_phone,
							 ds.appeal_address,
							 ds.start_time,
							 ds.end_time,
							 ds.unit,
							 ds.count,
							 ds.price,
							 ds.overall,
							 ds.increase_price,
							 ds.discount_price,
							 ds.create_time,
							 ds.order_number,
							 ds.status,
							 ds.complete_service,
							 ds.complete_appeal,
							 ur.avatar_url,
							 ur.nickname,
							 sv.title,
							 sv.images')
					->find();
			if(!$res){
				return result(0,'获取订单详情失败');
			}else{
				// 3、返回数据前对数据进行加工
				// 判断当前用户是服务方还是需求方，定下操作值operator和确认完成标志位complete
				if($res['service_user_id']==$user['id']){
					// 服务方
					$role = 1;
					$res['complete'] = $res['complete_service'];
				}else if($res['appeal_user_id']==$user['id']){
					// 需求方
					$role = 2;
					$res['complete'] = $res['complete_appeal'];
				}else{
					return result(0,'非法操作');
				}
				unset($res['complete_service']);
				unset($res['complete_appeal']);
				$res['role'] = $role;
				// 获取订单状态
				$res['status_text'] = getDealStatus($res['status']);
				// 格式化时间
				$res['create_time'] = getFormatTime($res['create_time']);
				$res['start_time'] = getFormatTime($res['start_time']);
				// 获取服务剩余接单时间
				$res['end_time'] = $res['status']==3?getEndRestTime($res['end_time']):'0时0分';
				// 只获取该服务的第一张封面
				$images = explode(',',$res['images']);
				$res['images'] = is_array($images)?$images[0]:'';
				return result(1,$res);
			}
		}else{
			return result(0,'获取订单参数不正确');
		}
	}


	/**
	 * 补差价后更新订单状态
	 * 传过来的是prepareToPay返回的package字段，需要截取掉前面的'prepay_id='，长度为10
	 * 根据prepay_id获取到相应的订单号，此时获得的是数组
	 * 找到订单后更新“差价”和“总价”
	 * 差价应该再做一次处理，保留两位小数
	 * @throws \think\Exception
	 */
	public function updateOrderStatus(){
		// 校验数据
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		$prepay_id = $p['prepay_id']??false;
		if($user && $prepay_id){
			// 传过来的是prepareToPay返回的package字段，需要截取掉前面的'prepay_id='，长度为10
			$prepay_id = substr($prepay_id,10);
			// 根据prepay_id获取到相应的订单号，此时获得的是数组
			$deal_id = db('pay_log')->where('prepay_id',$prepay_id)->column('deal_id'); // 数组
			// 找到订单后更新“差价”和“总价”
			$deal = db('deal_service')->where('id',$deal_id[0])->find();
			// 差价应该再做一次处理，保留两位小数
			$increase = round($p['increase_price'],2);
			$update = [
				'increase_price' => $deal['increase_price'] + $increase,
				'overall' 		=> $deal['overall'] + $increase,
				'update_time'	=>	time()
			];
			$res = db('deal_service')->where('id',$deal_id[0])->update($update);
			return $res?result(1,'状态更新成功'):result(0,'状态更新失败');
		}
	}




	/**
	 * 根据prepay_id获取订单ID，同时给服务方发送模板通知
	 * 传过来的是prepareToPay返回的package字段，需要截取掉前面的'prepay_id='，长度为10
	 * 字段都存在且正确的话，找到相应的订单信息，并返回订单ID
	 * @return mixed
	 */
	public function getOrderIdByPrepayId()
	{
		$p = input('post.');
		$user = db('users')->where('session',$p['session'])->find();
		$prepay_id = $p['prepay_id']??false;
		if($prepay_id && $user){
			$prepay_id = substr($prepay_id,10);
			$where = [];
			$where['prepay_id'] = $prepay_id;
			$payLog = db('pay_log')->where($where)->find();
			// 发送模板消息通知
			// 准备数据openid和formid
			$deal = db('deal_service')->where('id',$payLog['deal_id'])->find();
			$service = db('service')->where('id',$deal['service_id'])->find();
			$servicer = db('users')->where('id',$service['user_id'])->find();
			$sendRes = $this->sendTempMessage_WaitForTaking($servicer['openid'],$service['form_id']);
//			$sendResMes = $sendRes?'模板发送成功':'模板发送失败';
			return $payLog?result(1,['deal_id'=>$payLog['deal_id'],'sendResMes'=>$sendRes]):result(0,['订单不存在',$sendRes]);
		}else{
			return result(0,'prepay_id为空');
		}
	}


	/**
	 * 支付结果通用通知接收处理
	 * （支付相关的都是用XML格式）
	 * 主要是进行签名校验，然后更新数据库中的订单状态
	 * @return xml 返回给微信客户端的信息
	 */
	public function getPayResult()
	{
		// XML数据必须用这个来接收才行
		$input_xml = file_get_contents( 'php://input' );
		if(empty($input_xml)){
			return result(0,'数据为空');
		}
		// 将XML转成数组来处理
		$info = xmlToArray($input_xml);
		// 接收通知记录日志
		$data = [
			'order_number'=>$info['out_trade_no'],
			'total_fee'	=>	$info['total_fee'],
			'input_xml'	=>  $input_xml,
			'deal_time'	=>	date('Y-m-d H:i:s')
		];
		$id = db('pay_return_log')->insertGetId($data);
		// 下面进行数据的校验，成功后更新数据库数据
		// 两个都成功才是成功
		if($info['return_code']=='SUCCESS' && $info['result_code']=='SUCCESS'){
			// 签名校验
			$sign = $info['sign'];
			unset($info['sign']);
			$mySign = getSign($info);
			// 签名成功且APPID一致
			if($sign == $mySign && $info['appid']==config('APPID')){
				// 根据订单号找到订单ID
				$where = [];
				$where['order_number'] = $info['out_trade_no'];
				$where['pay_confirm']  = 0;
				$order = db('pay_log')->where($where)->find();
				// 判断金额是否一致，单位为分
				if(!empty($order) && ($order['amount']*100 == $info['total_fee'])){
					// 更新订单状态，事务操作
					// 事务成功标志
//					$result = true;
//					Db::startTrans();
//					try{
					$update_deal = [];
					$update_deal['status']			= 3;
					$update_deal['update_time']		= time();
					$res_ds = db('deal_service')->where('id',$order['deal_id'])->update($update_deal);
					$update_log = [];
					$update_log['transaction_id'] 	= $info['transaction_id'];
					$update_log['pay_confirm'] 		= 1;
					$update_log['update_time']		= time();
					$res_pl = db('pay_log')->where($where)->update($update_log);
//						Db::commit();
//					}catch(\Exception $e){
//						// 事务回滚
//						$result = false;
//						Db::rollback();
//					}
					// 更新成功后返回SUCCESS给微信进行确认，格式为XML
					if($res_ds && $res_pl){
						$ret = [
								'return_code'	=>	'SUCCESS',
								'return_msg'	=>	''
						];
						return arrayToXml($ret);
					}
				}
			}
		}
	}


	/**
	 * 统一下单预处理接口
	 * 先检查用户与订单合法性
	 * 然后准备与微信服务器的交互数据
	 * 接着进行交互
	 * 最后将返回的结果入库并返回给客户端
	 * @return array [description]
	 */
	public function prepareToPay()
	{	
		// 检查用户与订单是否存在
		$post = input('post.');
		$user = db('users')->where('session',$post['session'])->find();
		if(!$user){
			return result(0,'用户不存在');
		}
		$where = [];
		$where['id'] 		= $post['service_id'];
		$where['user_id'] 	= $post['service_user_id'];
		$where['price'] 	= $post['price'];
		$where['status']	= 1;
		$service = db('service')->where($where)->find();
		if(!$service){
			return result(0,'该服务不存在');
		}
		// 联系人信息预处理
		$info = $post['appeal_info'];
		$appeal_name = $info['userName']??'';
		$appeal_phone = $info['telNumber']??'';
		$appeal_address = $info['provinceName'].$info['cityName'].$info['countyName'].$info['detailInfo'];
		// 日期预处理
		$start_time = strtotime($post['start_time']);
		$end_time = strtotime("+10 hours");
		// 准备订单数据
		$order_number = getOrderNumber();
		$data = [
			'form_id'			=>	$post['formId'],
			'order_number'		=>	$order_number,
			'service_id'		=>	$post['service_id'],
			'service_user_id'	=>	$post['service_user_id'],
			'appeal_user_id'	=>	$user['id'],
			'status'			=>	2,
			'price'				=>	$post['price'],
			'unit'				=>	$post['unit'],
			'count'				=>	$post['count'],
			'overall'			=>	$post['overall'],
			'appeal_name'		=>	$appeal_name,
			'appeal_phone'		=>	$appeal_phone,
			'appeal_address'	=>	$appeal_address,
			'message'			=> 	$post['message'],
			'start_time'		=>	$start_time,
			'end_time'			=>	$end_time,
			'create_time'		=>	time(),
			'update_time'		=>	time()
		];
		$deal_id = db('deal_service')->insertGetId($data);
		if(!$deal_id){
			return result(0,'数据库操作失败');
		}
		// 发起预支付请求并返回给客户端相关支付数据
		return $this->getPrepayResult($deal_id,$order_number,$post['overall'],$user['openid'],'1','周末邦-学习服务');
	}

	/**
	 * 向微信官方发起预支付请求
	 * 需要先准备所需数据
	 * 然后对数据进行签名
	 * 之后发起请求
	 * 数据数组会转换成XML格式发送，并将返回的XML转换成数组
	 * 接着需要对返回的数据做签名校验，注意不能包含其中的sign字段
	 * 验证成功后将所需数据更新入库
	 * 接着，客户端需要向微信服务端发起支付请求
	 * 由于客户端需要发送签名字段
	 *
	 * @param $deal_id		订单ID
	 * @param $order_number 订单号
	 * @param $total_fee	付款金额（元）
	 * @param $openid		发起支付的用户ID
	 * @param string $body	交易记录说明
	 * @throws \think\Exception
	 */
	public function getPrepayResult($deal_id,$order_number,$amount,$openid,$type='1',$body='周末邦-服务'){
//		$server_addr = Request::instance()->server('SERVER_ADDR');
		$remote_addr = Request::instance()->server('REMOTE_ADDR');
		$data = [
				'appid'		=>	config('APPID'),
				'mch_id'	=>	config('MCH_ID'),
				'nonce_str'	=>	getRandomString(),
				'body'		=>	$body,
				'out_trade_no'	=>	$order_number,
				'total_fee'	=>	$amount*100,
				'spbill_create_ip'	=> $remote_addr,
				'notify_url'=>	config('NOTIFY_URL'),
				'trade_type'=>	'JSAPI',
				'openid'	=>	$openid
		];
		// 进行签名
		$sign = getSign($data);
		$data['sign'] = $sign;
		// 发起请求，数据格式会转为xml并转成数组输出
		$res = http_xml(config('PAY_UNIFIEDORDER'),$data);
		// 进行签名校验，不能包含sign本身
		$sign = $res['sign']??'';
		unset($res['sign']);
		$mySign = getSign($res);
//		dump($res);
		if($sign == $mySign){
			// 校验成功则将prepay_id和用户ip入库到pay_log并返回给客户端prepay_id
			$insert = [
					'deal_id'	=> $deal_id,
					'order_number'	=>	$order_number,
					'amount'	=>	$amount,
					'type'		=>	$type,
					'prepay_id' => $res['prepay_id'],
					'appeal_user_ip'=>$remote_addr,
					'create_time'	=>	time(),
					'update_time'	=>	time()
			];
			$r = db('pay_log')->insert($insert);
			if(!$r){
				return result(0,'pay_log入库失败');
			}
			// 小程序调起微信支付所需要的字段和签名
			// 此处有坑，小程序文档写的没有appId，微信支付的文档才是对的，否则签名失败
			$payment = [
					'appId'			=> config('APPID'),
					'timeStamp'		=>	(string)time(),		// 这里的时间需要转换成字符串才行
					'nonceStr'		=>	getRandomString(),
					'package'		=>	'prepay_id='.$res['prepay_id'],  // 官方要求的格式
					'signType'		=> 	'MD5'
			];
			$payment['paySign'] = getSign($payment);
			unset($payment['appId']);	// 不要传送APPID
			return result(1,$payment);
		}else{
			return result(0,'微信返回的签名校验失败');
		}
	}




	/**
	 * 根部ID获取单个服务详情
	 * @return array 经过处理的服务详情
	 */
	public function getOne()
	{
		$post = input('post.');
		$user = db('users')->where('session',$post['session'])->find();
		if(!$user){
			return result(0);
		}
		$info = db('service')
				->alias('s')
				->where('status',1)
				->where('s.id',$post['id'])
				->join('users u','s.user_id = u.id')
				->join('type_unit tu','s.unit_id = tu.id')
				->join('type_service tsv','s.service_id = tsv.id')
				->field('s.id as service_id,
						 user_id,nickname,gender,
						 avatar_url as avatar,
						 title,summary,attention,location,location_name,
						 images,style,price,
						 tu.name as unit_name,
						 tsv.name as service_name,
						 scale_id')
				->select();
		$info = $info?$info[0]:[];
		$info['images'] = explode(',',$info['images']);
		$info['style_name'] = $info['style']==1?'当面服务':'在线服务';
		// 处理服务范围
		if($info['scale_id']>0){
			$info['scale_name'] = db('type_scale')->where('id',$info['scale_id'])->value('name');

		}
		// 处理得分
		$info['average'] = db('score')->where('user_id',$user['id'])->value('average');
		unset($info['scale_id']);
		unset($info['form_id']);
		unset($info['status']);
		unset($info['create_time']);
		unset($info['update_time']);
		return $info?result(1,$info):result(0);
	}


	/**
	 * 获取部分服务详情
	 * 1、验证身份
	 * 2、获取该用户的地理位置
	 * 3、筛选其附近的服务
	 * 4、对数据进行加工
	 * @return array 卡片服务详情
	 */
	public function getPart()
	{
		// 1、验证身份
		$post = input('post.');
		// 2、获取该用户的地理位置
		$longitude = $post['longitude'];
		$latitude = $post['latitude'];
		$page = $post['page']?$post['page']:0;
		$count = $post['count']?$post['count']:10;
		$service_id = $post['service_id']?$post['service_id']:1;
		$user = db('users')->where('session',$post['session'])->find();
		if(!$user){
			return result(0);
		}
		// 3、筛选其附近的服务
		$where = [];
		$where['status'] = 1;
		if($service_id == 1){
			$where['service_id'] = ['>=',$service_id];
		}else{
			$where['service_id'] = $service_id;
		}
		$info = db('service')
				->alias('s')
				->where($where)
				->join('users u','s.user_id = u.id')
				->join('type_unit tu','s.unit_id = tu.id')
				->field('s.id as id,
					u.nickname,
					u.avatar_url as avatar,
					title,
					summary,
					price,
					images,
					longitude as lon,
					latitude as lat,
					tu.name as unit')
				->order('id desc')
				->limit($page*$count,$count)
				->select();
		if(!$info){
			return result(2);
		}
		// 4、对数据进行加工
		foreach ($info as $k => $v) {
			// 简介长度截取，首先替换各种换行符，然后截取20哥字符串返回
			$str = str_replace(PHP_EOL, '', $info[$k]['summary']);
			$info[$k]['summary'] = mb_substr($str, 0,20).'...';
			// 图片字符串改成数组
			$info[$k]['images'] = explode(',', $v['images']);
			// 计算距离值
			if($longitude==0 && $latitude==0){
				$distance = -1;
			}else{
				$distance = getDistance($longitude,$latitude,$v['lon'],$v['lat']);
			}
			$info[$k]['distance'] = $distance;
			// 去掉无用的数据
			unset($info[$k]['lon']);
			unset($info[$k]['lat']);
		}
		return $info?result(1,$info):result(0);
	}
}
