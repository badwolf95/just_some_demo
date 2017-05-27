<?php
//自定义block插件
//
//以下为模板中调用的格式
//{test2 realy='true' max=15}
//{$str}
//{/test2}
//$params是将第一行的realy和max等参数打包成数组封装起来的值
//$cont的值是中间的$str的值
	function smarty_block_test2($params,$cont){
		$realy = $params['realy'];
		$max = $params['max'];
		if($realy=='true'){
			$cont = str_replace('，',',',$cont);
			$cont = str_replace('。','.',$cont);
		}
		$cont = substr($cont,0,$max);
		return $cont;
	}

?>