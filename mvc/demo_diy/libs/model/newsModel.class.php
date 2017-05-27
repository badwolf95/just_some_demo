<?php 
class newsModel{

	private $table = "news";
	/**
	 * 通过ID获取新闻
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getNewsById($id){
		//防注入
		$id = intval($id);
		$sql = "select * from ".$this->table." where id='".$id."'";
		$news = DB::fetchOne($sql);
		return $news;
	}
	/**
	 * 返回新闻对象的正确格式
	 * @return [type] [description]
	 */
	public function getNewsInfo(){
		if(!empty($_GET['id'])&&$_GET['id']!=''){
			$news = $this -> getNewsById($_GET['id']);
		}else{
			global $config;
			$news = array(
				'id'=>'',
				'title'=>'',
				'author'=>'',
				'from'=>'',
				'content'=>'',
				'pubtime'=>''
			);
		}
		return $news;
	}

	/**
	 * 编辑新闻操作
	 * @return [type] [description]
	 */
	public function editNews(){
		//首先获取相应的数据
		$news = $this->getPostInfo();
		if('0'==$news){
			return 0;
		}
		//能POST到id说明是编辑装填，否则就是添加
		if(empty($_POST['id'])||$_POST['id']==''){
			$info = DB::insert($this->table,$news);
		}else{
			$where = "id=".$news['id'];
			$info = DB::update($this->table,$news,$where);
		}
		//根据返回值进行判断
		if($info){
			return 1;//成功
		}else{
			return 2;//失败
		}
	}
	/**
	 * 获取POST过来的信息
	 * @return [type] [description]
	 */
	public function getPostInfo(){
		$id = intval($_POST['id']);
		$title = doaddslashes($_POST['title']);
		$author = doaddslashes($_POST['author']);
		$from  = doaddslashes($_POST['from']);
		@$content = doaddslashes($_POST['content']);
		$pubtime = time();
		if($title==''||$author==''||$from==''||$content==''){
			return 0;//不能为空
		}
		$news = array(
				'id'=>$id,
				'title'=>$title,
				'author'=>$author,
				'from'=>$from,
				'content'=>$content,
				'pubtime'=>$pubtime
		);
		return $news;
	}
	/**
	 * 获取所有新闻信息
	 * @return [type] [description]
	 */
	public function getAllNews(){
		//查库，取数据
		//按发布时间降序排列
		$sql = "select * from ".$this->table." order by pubtime desc";
		$news = DB::fetchAll($sql);
		return $news;
	}
	/**
	 * 返回新闻列表信息
	 * @return [type] [description]
	 */
	public function getNewsList(){
		$news = $this->getAllNews();
		foreach($news as $key=>$val){
			$news[$key]['content'] = mb_substr(strip_tags($news[$key]['content']),0,200);
		}
		return $news;
	}
	/**
	 * 删除新闻
	 * @return [type] [description]
	 */
	public function deleteNews(){
		if(empty($_GET['id'])){
			return false;
		}else{
			$id = intval($_GET['id']);
			$where = "id=".$id;
			//$sql = "delete from ".$this->table." where id=".$id;
			if(DB::delete($this->table,$where)){
				return true;
			}else{
				return false;
			}
		}
	}



}
?>