<?php 
class authModel{

	private $auth = "";

	public function __construct(){
		//有session则赋给auth
		if(isset($_SESSION['auth'])&&(!empty($_SESSION['auth']))){
			$this->auth = $_SESSION['auth'];
		}
	}
	/**
	 * 登录验证
	 * @return [type] [description]
	 */
	public function loginSubmit(){
		if(empty($_POST['username'])||empty($_POST['password'])){
				return false;
			}
			//防注入
			$username = doaddslashes($_POST['username']);
			$password = doaddslashes($_POST['password']);
		//接下来判断用户是否存在
		if($this->auth = $this->checkUserExists($username,$password)){
			//var_dump($this->auth);
			$_SESSION['auth'] = $this->auth;
			return true;
		}else{
			return false;
		}
	}
	/**
	 * 检查用户是否存在
	 * @param  [type] $username [description]
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	public function checkUserExists($username,$password){
		$adminModel = M('admin');
		if($userObj =  $adminModel->fetchUserObj($username,$password)){
			return $userObj;
		}else{
			return false;
		}
	}
	
	/**
	 * 私有变量获取
	 * @return [type] [description]
	 */
	public function getAuth(){
		return $this->auth;
	}

	/*public function setAuth($auth){
		$this->auth = $auth;
	}*/
	/**
	 * 用户登出
	 * @return [type] [description]
	 */
	public function authLogout(){
		$db = M('admin');
		$db -> closeDB();
		unset($_SESSION['auth']);
		//$this->setAuth('');
		$this->auth = '';


	}
}
?>