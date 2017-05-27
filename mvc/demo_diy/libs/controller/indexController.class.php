<?php 
class indexController{
	/**
	 * 默认显示的首页
	 * @return [type] [description]
	 */
	public function index(){
		VIEW::display('./tpl/index/index.html');
	}
	/**
	 * 用户界面的新闻列表展示
	 * @return [type] [description]
	 */
	public function showNewsList(){
		//取数据->封装到newsModel中
		//注册，显示
		$newsObj = M('news');
		$news = $newsObj -> getNewsList();
		if(null == $news){
			$news = array();
		}
		//var_dump($news);exit;
		VIEW::assign(array('news'=>$news));
		$this->getAbout();
		VIEW::display('./tpl/index/newsList.html');
	}
	/**
	 * 用户界面显示新闻详情
	 * @return [type] [description]
	 */
	public function showNewsDetail(){
		$newsObj = M('news');
		$id = intval($_GET['id']);
		$news = $newsObj -> getNewsById($id);
		if(null == $news){
			$news = array();
		}
		//var_dump($news);exit;
		VIEW::assign(array('news'=>$news));
		VIEW::display('./tpl/index/newsDetail.html');
	}
	/**
	 * 从TXT文件中读取内容
	 * @return [type] [description]
	 */
	private function getAbout(){
		$aboutObj = M('about');
		$about = $aboutObj -> getAbout();
		VIEW::assign(array('about'=>$about));
	}


}
?>