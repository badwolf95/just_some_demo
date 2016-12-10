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
		'status' = $status,
		'message' = $mes,
		'data' = $data,
	];
	exit(json_encode($show));
}