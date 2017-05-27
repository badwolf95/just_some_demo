<?php
namespace app\index\controller;
use think\Controller;

class Common extends Controller{

	public $_user = '';

	public function __construct(){
		parent::__construct();
		$this->_user = session('user');
		if(!$this->_user){
			return $this->redirect('/index/index');
		}
	}	
}