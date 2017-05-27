<?php
	require_once './smarty/Smarty.class.php';
	header("Content-Type:text/html;charset=utf8");
	//smarty 五配置两方法
	$smarty = new smarty();
	//以下为五配置
	$smarty->left_delimiter = "{";
	$smarty->right_delimiter = "}";
	$smarty->template_dir = "tpl";
	$smarty->compile_dir = "template_c";
	$smarty->cache_dir = "cache";
	//以下为两方法，通常无需配置仅为了解
	//$smarty->caching = true;
	//$smarty->cache_lifttime = 120;
	//
	

	/*基本的注册使用*/
	$smarty->assign('test','This is just a smarty demo!');
	$arr = array('title'=>'smarty学习','name'=>'小明');
	$arr2 = array('1'=>array('title'=>'smarty学习','name'=>'小明'));
	$smarty->assign('arr',$arr);
	$smarty->assign('arr2',$arr2);
	$smarty->assign('time',time());
	$smarty->assign('url',"http://www.imooc.com?control=aaa&method=bbb");
	$smarty->assign('nl2br','不开森
		不开森
		不开森');

	/*多维数组的注册*/
	$arr3 = array(
		array(
			'title'=>'imooc',
			'name'=>'小明',
			'sex'=>'男'
		),
		array(
			'title'=>'IMOOC',
			'name'=>'老王',
			'sex'=>'女'
		),
		array(
			'title'=>'',
			'name'=>'',
			'sex'=>''
			)
	);

	$arr4 = array();

	$smarty->assign('arr3',$arr3);
	$smarty->assign('arr4',$arr4);
	$smarty->assign('score','91');

	/*类的对象的注册*/
	class fruit{
		function grow($arr){
			return $arr[0]."已经".$arr[1];
		}
	}
	$fruit = new fruit();
	$smarty->assign('fruit',$fruit);

	/*PHP内置函数的使用*/
	$abc = "abcdefgh";
	$smarty->assign('abc',$abc);
	$date = time();
	$smarty->assign('date',$date);

	/*函数注册*/
	function test($param){
		print_r($param);
		//exit;
		echo "<br/>";
		$p1 = $param['p1'];
		$p2 = $param['p2'];
		return $param['p1']."上天了啊，快看".$param['p2']."也上天了";
	}

	$smarty->registerPlugin('function','f_test','test');

	//$smarty->display('./tpl/test.tpl');
	$smarty->display('./tpl/include.tpl');


?>