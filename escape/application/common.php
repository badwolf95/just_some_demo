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


// 返回格式
function show($status,$mes,$data=[]){
	header('Content-type:text/html;charset=utf-8');
	$show = [
		'status' => $status,
		'message' => $mes,
		'data' => $data,
	];
	exit(json_encode($show));
}
//kindeditor需要的特殊返回数组
function showKind($status,$data){

	header("Content-Type:Application/json;charset=utf-8");
	if(0 == $status){
		$res = array(
			'error' => 0,
			'url'	=> $data,
		);
	}else{
		$res = array(
			'error'	=>	1,
			'message' => $data,
		);
	}
	exit(json_encode($res));
}


// 加密
function addMd5($val)
{
	$val = $val."This_is_my_blog_,_what_is_called_fight_2_escape!";
	return md5(md5(md5($val)));
}

// 获取时间
function getTime($time){
	return date("Y-m-d H:i:s",$time);
}
function getTimeSimple($time)
{
	return date("Y-m-d",$time);
}