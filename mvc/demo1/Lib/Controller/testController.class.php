<?php
	//require_once '../function.php';

	class testController{
	
		function show(){
			$testModel = M('test');
			$data = $testModel->get();
			$testView = V('test');
			$testView->display($data);
		}
	};
?>