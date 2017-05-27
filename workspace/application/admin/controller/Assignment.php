<?php
namespace app\admin\controller;
use think\Controller;
use think\Validate;
use think\Db;

class Assignment extends Common {

	public function index(){
		if($pagesize = input('param.pagesize')){
			session('pagesize',$pagesize);
		}else{
			$pagesize = session('pagesize')?session('pagesize'):config('MY_PAGESIZE');
		}
		if(input('param.select')){
			$select = input('param.select');
		}else{
			$select = '';
		}
		$map = [];
		$time ='year';
		if($select != ''){
			switch($select){
				case 'create_time':$time = 'today';break;
				case 'status' : $map['status'] = '2';break;
				case 'createby' : $map['user_id'] = '1000';break;
				default : $map['id'] = ['gt','0'];
			}
		}
		$information = model('Assignment')->whereTime('create_time',$time)->where($map)->order('create_time','desc')->paginate($pagesize);
		
		
		$page = $information->render();
		$this->assign('page',$page);
		$this->assign('Assignment',$information);
		return $this->fetch();
	}

	public function add(){
		if(input('post.')){
			//验证各字段
			$rules = [
				['types','require|in:1,2,3','请选择任务对象|任务对象非法'],
				['members','requireIf:types,2|requireIf:types,3','请输入用户的五位ID|用输入组织的四位ID'],
				['content','require|length:30,900','请填写任务内容|内容范围在10到300个汉字之间']
			];
			$validate = new Validate($rules);
			if(!$validate->check(input('post.'))){
				return show(0,$validate->getError());
			}
			$type = input('post.types');
			$member = input('post.members');
			$content = input('post.content');
			//全体成员
			if(1 == $type){
				$user_id_all_obj = model('User')->where('status','1')->field('id')->select();
				$user_id_all = ',';
				$receive_user_num = 0;
				//拼接ID
				foreach($user_id_all_obj as $user_id){
					$user_id_all .= $user_id->id.',';
					$receive_user_num++;
				}
				$data['receive_user_num'] = $receive_user_num;
				$data['receive_user_id'] = $user_id_all;
			//普通成员、组织单位
			}else{
				$members_fade = explode(',',$member);
				$error = [];
				//减去相应的ID增值
				$identity_num = $type==2?config('IDENTITY_NUM'):config('IDENTITY_NUM_ORG');
				foreach($members_fade as $member){
					//如果是普通成员
					if($member>$identity_num && $type==2){
						$members[] = $member - $identity_num;
					//如果是组织单位
					}elseif($type==3 && $member<config('IDENTITY_NUM') && $member>config('IDENTITY_NUM_ORG')){
						$members[] = $member - $identity_num;
					//编号有误
					}else{
						$error[] = $member;
					}
				}
				if(!empty($error)){
					$error_str = implode(',',$error);
					return show('以下ID有误：'.$error_str);
				}
				$member_str = ','.implode(',',$members).',';
				$data['receive_user_id'] = $member_str;
				$data['receive_user_num'] = count($members);
			}
			$data['content'] = $content;
			$data['user_id'] = config("SUPER_ADMIN_ID");
			//判断是否完全相同的已存在
			if(model('Information')->where($data)->find()){
				return show(0,'已经发送过相同的任务');
			}
			//可以发送
			$data['create_time'] = time();
			$res = model('Assignment')->insert($data);
			if($res){
				return show(1,'发布成功');
			}else{
				return show(0,'发布失败');
			}
		}else{
			return $this->fetch();
		}
	}



}