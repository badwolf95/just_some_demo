<?php 
class adminController{
	//用来
	public $auth = "";

	public function __construct(){
		//判断当前是否已经登录->交给auth实现
		//如果没有登录，而且不是在登录页面，则跳转
		$authObj = M('auth');
		$this->auth = $authObj -> getAuth();
		if(empty($this->auth)&&PC::$method!='login'){
			$this->showMes('请先登录','login');
		}else{
			//统一注册变量username来处处显示用户名
			$data = array('username'=>$this->auth);
			VIEW::assign($data);
		}
	}
	/**
	 * 登录操作
	 * @return [type] [description]
	 */
	public function login(){
		//var_dump($_POST);
		//var_dump($this->auth);
		//先判断是否已经登录
		if(isset($this->auth)&&(!empty($this->auth))){
			$this->showMes(null,'index');
			exit;
		}
		if($_POST){
			//有值才继续判断
			//测试echo  "success";
			//admin和数据库打交道
			//auth来执行相关的操作，如验证等
			//将一系列的操作继续拆分出去
			$this -> checkLogin();

		}else{
			//否则跳转回登录页
			//不加这个判断会有BUG
			$this->showMes('请先登录','login');

		}

	}
	/**
	 * 实现超链接 跳转
	 * @return [type] [description]
	 */
	public function gotourl(){
		if($_GET['tpl']){
			VIEW::display('./tpl/admin/'.$_GET['tpl'].".html");
		}else{
			VIEW::display('./tpl/admin/index.html');
		}
	}
	/**
	 * 显示信息并跳转
	 * @param  [type] $mes [description]
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function showMes($mes,$url=null){
		if($mes!=null){
			echo "<script>alert('{$mes}');</script>";
		}
		if($url!=null){
			VIEW::display('./tpl/admin/'.$url.'.html');
		}
	}
	/**
	 * 只跳转，比起shouMes不容易出错，不是直接显示模板
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function guide(/*$mes=null,*/$url=null){
		if($url!=null){
			header("location:".$url);
		}
		/*if($mes!=null){
			echo "<script>alert('{$mes}');</script>";
		}*/
	}
	/**
	 * 登录验证
	 * @return [type] [description]
	 */
	public function checkLogin(){
		$authObj = M('auth');
		if($authObj->loginSubmit()){
			//这里只能用$_SESSION['auth']，因为$this->auth还没再次初始化，为空
			$data = array('username'=>$_SESSION['auth']);
			VIEW::assign($data);
			//$this->showMes('登陆成功',null);
			$this->guide("admin.php?controller=admin&method=gotourl&tpl=index");
		}else{
			$this->showMes('登录失败，请核对用户名和密码再登录','login');
		}
	}
	/**
	 * 登出操作
	 * @return [type] [description]
	 */
	public function logout(){
		$auth = M('auth');
		$auth -> authLogout();
		//$this -> showMes('退出成功',null);
		$this -> guide("admin.php?controller=admin&method=login");
	}
	/**
	 * 新闻添加或编辑操作
	 * @return [type] [description]
	 */
	public function newsManage(){
		//如果没有POST数据，说明是显示界面,否则为添加/修改处理
		//如果没有GET到 ID ，说明是添加，否则修改
		if(empty($_POST)){
			//通过ID获取文章信息，没有则为空->封装到news模板中
			$newsObj = M('news');
			$news = $newsObj -> getNewsInfo();
			//然后注册变量，再显示视图
			$data = array('news'=>$news);
			//var_dump($data);
			VIEW::assign($data);
			VIEW::display('./tpl/admin/newArticle.html');
		}else{
			//接收数据，安全处理，数据入库->
			//封装到news模板中
			$newsObj = M('news');
			$num = $newsObj -> editNews();
			if('1'==$num){
				//$this->showMes('修改成功','articleList');
				$this->guide('admin.php?controller=admin&method=newsList');
			}elseif('2'==$num){
				//$this->showMes('修改失败鸟','newArticle');
				$this->guide('admin.php?controller=admin&method=newsManage');
			}else{
				//这里有个问题，返回后不能自动填写刚才提交的信息，因为showMes函数的原因，待会儿再改，先MARK
				/*************************************************************************************************************************************************************/
				//$this->showMes('请填写全部信息','newArticle');
				$this->guide("admin.php?controller=admin&method=newsManage");
			}
			
		}
	}
	/**
	 * 新闻列表的显示
	 * @return [type] [description]
	 */
	public function newsList(){
		//从数据库取出所有文章信息->news模板
		//对文章变量进行注册
		//模板显示
		$newsObj = M('news');
		$news = $newsObj -> getAllNews();

		//如果结果为空，应置为空数组，与结果不为空时格式一样，smarty才能正确判断注册的结果集
		if(null==$news){
			$news = array();
		}

		$news = array('news'=>$news);
		//var_dump($news);
		VIEW::assign($news);
		VIEW::display('./tpl/admin/articleList.html');
		
		
	}
	/**
	 * 新闻删除操作
	 * @return [type] [description]
	 */
	public function delete(){
		$newsObj = M('news');
		if(!$newsObj->deleteNews()){
			$this->showMes('删除失败',null);
		}
		$this->guide("admin.php?controller=admin&method=newsList");
	}


}

?>