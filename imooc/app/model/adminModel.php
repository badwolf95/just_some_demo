<?php
namespace app\model;

class adminModel extends \core\lib\model
{
	public $table = 'admin';

	public function lists(){
		$res = $this->select($this->table,'*');
		return $res;
	}

	public function getOne($id){
		$where['id'] = $id;
		$res = $this->select($this->table,'*',$where);
		return $res;
	}

	public function setOne($id,$data){
		$res = $this->update($this->table,$data,['id'=>$id]);
		return $res;
	}

	public function deleteOne($id){
		$res = $this->delete($this->table,['id'=>$id]);
		return $res;
	}

}