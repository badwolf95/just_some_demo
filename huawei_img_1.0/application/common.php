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
 * 接口调用后统一返回格式
 * @param  integer $status  [description]
 * @param  [type]  $data    [description]
 * @param  string  $message [description]
 * @return [type]           [description]
 */
function show($status=0,$data=[],$message=''){
	$res = [
		'status'	=>	$status,
		'data'		=>	$data,
		'message'	=>	$message
	];
	return json($res);
}

/**
 * 密码加密
 * @param  string $str 需要加密的字符串
 * @return string      加密后的字符串
 */
function getPwd($str){
	return md5(md5($str).config('ENCRYPT_SALT'));
}

/**
 * session等随机字符串加密
 */
function encrypt($str){
	return md5(sha1(crypt($str,config('ENCRYPT_SALT').time()).rand()));
}