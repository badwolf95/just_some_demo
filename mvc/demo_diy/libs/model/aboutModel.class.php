<?php 
class aboutModel{
	/**
	 * 从文件中读取相关信息
	 * @return [type] [description]
	 */
	public function getAbout(){
		return file_get_contents('./tpl/index/tpl/about.txt');
	}

}
?>