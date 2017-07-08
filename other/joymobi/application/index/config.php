<?php 	
// 配置文件
return [

	// appid
	'APPID' 	=> 'wx3004b49b4e614d20',
	'SECRET' 	=> '8581eaec760e35ba084bd1e2c758d92e',
	// 用户登陆固定授权类型+请求地址
	'GRANT_TYPE'=> 'authorization_code',
	'SESSIONURL'=> 'https://api.weixin.qq.com/sns/jscode2session?appid=APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code',
	// 微信支付商户号
	'MCH_ID'	=> '1452804602',
	// API秘钥(key)
	'API_SECRET_KEY'		=> 'ea4815ed1ad2c75e1c543f6f48b5ac73',
	// 支付结果的异步接收接口地址
	'NOTIFY_URL'=> 'https://mobi.fight2escape.club/index/service/getPayResult',
	// 微信预支付请求地址
	'PAY_UNIFIEDORDER'	=>	'https://api.mch.weixin.qq.com/pay/unifiedorder',
	// 微信退款请求地址
	'PAY_REFUND_URL'	=>	'https://api.mch.weixin.qq.com/secapi/pay/refund',
	// 模板消息：获取access_token地址
	'TEMPLATE_GET_ACCESS_TOKEN'	=> 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential',
	// 模板消息：发送消息
	'TEMPLATE_SEND_MESSAGE'	=> 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='

];
