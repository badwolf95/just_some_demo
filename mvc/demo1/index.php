<?php
	require_once 'function.php';

	$controlAllow = array('test','index');
	$methodAllow = array('test','index','show');
	//$control = daddslashes($_GET['control']);
	$control = (in_array($_GET['control'],$controlAllow))?daddslashes($_GET['control']):'index';
	//$method = daddslashes($_GET['method']);
	$method = (in_array($_GET['method'],$methodAllow)?daddslashes($_GET['method']):'index');

	C($control,$method);


?>