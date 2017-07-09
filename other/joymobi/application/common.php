<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/**
 * 发送模板消息
 * 返回的为json对象，解析成数组返回
 * @param $touser	接收者（用户）的 openid
 * @param $template_id	所需下发的模板消息的id
 * @param $page	点击模板卡片后的跳转页面，仅限本小程序内的页面。支持带参数,（示例index?foo=bar）。该字段不填则模板无跳转
 * @param $form_id	表单提交场景下，为 submit 事件带上的 formId；支付场景下，为本次支付的 prepay_id
 * @param $data	模板内容，不填则下发空模板
 * @param $emphasis_keyword	模板需要放大的关键词，不填则默认无放大
 * @param string $color	模板内容字体的颜色，不填默认黑色
 * @return mixed
 */
function sendTempMessage($touser,$template_id,$page,$form_id,$data='',$emphasis_keyword='',$color='#000'){
	$kv = db('key_value')->where('key','access_token')->find();
	$url = config('TEMPLATE_SEND_MESSAGE').$kv['value'];
	$mes = [
		'touser'	=>	$touser,
		'template_id'	=>	$template_id,
		'page'		=>	$page,
		'form_id'	=>	$form_id,
		'data'		=>	$data,
		'color'		=>	$color,
		'$emphasis_keyword'	=>	$emphasis_keyword
	];
//	dump(json_encode($mes));
	return http_post($url,$mes);
}

// 计算退款金额
function getRefundAmount($amount){
    return $amount<100?:ceil($amount*0.99);
}


// 获取格式化结束剩余时间
function getEndRestTime($time){
	$rest = $time - time();
	$hours = floor($rest / 3600);
	$seconds = floor(($rest - 3600*$hours)/60);
	$res = $hours."小时".$seconds."分钟";
	return $res;
}

// 格式化时间
function getFormatTime($time)
{
	return date('Y年m月d日 H:i',$time);
}

// 获取发布的服务或求助的状态
function getPostStatus($status)
{
    switch($status){
        case 1:
            return '审核通过';
        case 2:
            return '审核中';
        default:
            return '状态异常';
    }
}

// 订单状态映射
function getDealStatus($status)
{
	switch($status) {
		case 1:
			return '已完成';
		case 2:
			return '未支付';
		case 3:
			return '待接单';
		case 4:
			return '已取消';
		case 5:
			return '进行中';
		case 6:
			return '已过期';
		case 7:
			return '拒绝接单';
		case 8:
			return '拒绝取消';
		default:
			return '状态错误';
	}
}

// 微信支付签名算法
function getSign($data)
{
	// 第一步：对参数按照key=value的格式，并按照参数名ASCII字典序排序
	ksort($data);
	$stringA = [];
	foreach ($data as $k => $v) {
		// *****************************************这里要注意，为空的值不参与，但为 0 的需要参与***********
		if($v==0 || !empty($v)){
			$stringA[] = $k."=".$v;
		}
	}
	$stringA = implode('&',$stringA);
	// 第二步：拼接API密钥(商户key)
	$stringSignTemp = $stringA.'&key='.config('API_SECRET_KEY');
	// 转成大写
	$sign = strtoupper(md5($stringSignTemp));
	return $sign;
}

// 生成退款单号
function getRefundNumber()
{
	return "rf".date("YmdHis").rand(100,999).rand(100,999);
}

// 生成订单号
function getOrderNumber()
{
	return date("YmdHis").rand(100,999).rand(100,999);
}

// 生成随机字符串
function getRandomString()
{
	return addMd5(rand().time());
}

// 对客户端统一返回格式
function result($status,$data=[])
{
	header('Content-type:text/html;charset=utf-8');
	$show = [
		'status' => $status,
		'data' => $data,
	];
	exit(json_encode($show));
}

// 对数据进行加密
function addMd5($data)
{
	$salt = md5(time()."joymobi_main_add_md5.");
	$data = md5(time().$data).$salt;
	return md5(md5($data));
}

// 获取性别 
function getGender($gender)
{
	return $gender==1?"男":"女";
}

// https双向认证请求
function curl_post_ssl($url, $vars, $second=30,$aHeader=array())
{
	$vars = arrayToXml($vars);
	$ch = curl_init();
	//超时时间
	curl_setopt($ch,CURLOPT_TIMEOUT,$second);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	//这里设置代理，如果有的话
	//curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
	//curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	// 设置为IPV4
	curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
	//以下两种方式需选择一种
	//第一种方法，cert 与 key 分别属于两个.pem文件
	//默认格式为PEM，可以注释
	//curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
	curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/../wxcert/apiclient_cert.pem');	// getcwd()的地址为入口文件index.php所在目录
	//默认格式为PEM，可以注释
	//curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
	curl_setopt($ch,CURLOPT_SSLKEY,getcwd().'/../wxcert/apiclient_key.pem');
	//第二种方式，两个文件合成一个.pem文件
	//curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');
	if( count($aHeader) >= 1 ){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
	}
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
	$data = curl_exec($ch);
	if($data){
		curl_close($ch);
		return xmlToArray($data);
	}
	else {
		$error = curl_errno($ch);
		echo "call faild, errorCode:$error\n";
		curl_close($ch);
		return false;
	}
}

// 发起POST请求（未加工直接发送）——主要用在用户登陆中session的获取上
function http($url,$data)
{
	$data = http_build_query($data);
	$opts = [
		'http' => [
			'method' => 'POST',
			'header'=> "Content-type: application/x-www-form-urlencoded;" .
			"Content-Length: " . strlen($data) . "rn",
			'content' => $data
		]
	];
	$context = stream_context_create($opts);
	$html = file_get_contents($url, false, $context);
	return $html;
}


// 发起GET请求————用在了模板发送中获取access_token上面
function http_get($url)
{
	$opts = [
			'http' => [
					'method' => 'GET',
					'header'=> "Content-type: application/x-www-form-urlencoded;"
			]
	];
	$context = stream_context_create($opts);
	$html = file_get_contents($url, false, $context);
	return $html;
}

// 发起http_post请求(json格式)——用在了模板的发送上面
function http_post($url,$data)
{
	// 转成XML格式
	$xmlData = json_encode($data);
	$header[] = "Content-type:text/json";
	$ch = curl_init ($url);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
	$response = curl_exec($ch);
	if(curl_errno($ch)){
		print curl_error($ch);
	}
	curl_close($ch);
	// 将返回的json格式转成数组
	return json_decode($response,true);
}

// 发起http_xml请求————主要用在支付相关的操作上面
function http_xml($url,$data)
{	
	// 转成XML格式
	$xmlData = arrayToXml($data);
	$header[] = "Content-type:text/xml";        //定义content-type为xml,注意是数组
	$ch = curl_init ($url);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
	$response = curl_exec($ch);
	if(curl_errno($ch)){
	    print curl_error($ch);
	}
	curl_close($ch);
	// 将返回的xml转成数组
	return xmlToArray($response);
}

// 数组转XML
function arrayToXml($arr){
	$xml = "<xml>";
	foreach ($arr as $k => $v) {
		if(is_numeric($v)){
			$xml .= "<".$k.">".$v."</".$k.">";
		}else{
			$xml .= "<".$k."><![CDATA[".$v."]]></".$k.">";
		}
	}
	$xml .= "</xml>";
	return $xml;
}

// XML转数组
function xmlToArray($xml){
	// 禁止引用外部xml实体
	libxml_disable_entity_loader(true);
	$values = simplexml_load_string($xml,'SimpleXMLElement',LIBXML_NOCDATA);
	$values = json_decode(json_encode($values),true);
	return $values;
}

/**
 * 计算两点地理坐标之间的距离
 * @param  Decimal $longitude1 起点经度
 * @param  Decimal $latitude1  起点纬度
 * @param  Decimal $longitude2 终点经度
 * @param  Decimal $latitude2  终点纬度
 * @param  Int     $unit       单位 1:米 2:公里
 * @param  Int     $decimal    精度 保留小数位数
 * @return Decimal
 */
function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=2){

	$EARTH_RADIUS = 6370.996; // 地球半径系数
	$PI = 3.1415926;

	$radLat1 = $latitude1 * $PI / 180.0;
	$radLat2 = $latitude2 * $PI / 180.0;

	$radLng1 = $longitude1 * $PI / 180.0;
	$radLng2 = $longitude2 * $PI /180.0;

	$a = $radLat1 - $radLat2;
	$b = $radLng1 - $radLng2;

	$distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
	$distance = $distance * $EARTH_RADIUS * 1000;

	if($unit==2){
		$distance = $distance / 1000;
	}

	return round($distance, $decimal);

}