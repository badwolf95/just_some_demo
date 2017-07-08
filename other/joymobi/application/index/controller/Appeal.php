<?php
namespace app\index\controller;
use think\Controller;
use think\Request;

class Appeal extends Controller
{

    /**
     * 根部ID获取单个求助详情
     * @return array 经过处理的服务详情
     */
    public function getOne()
    {
        $post = input('post.');
        $user = db('users')->where('session',$post['session'])->find();
        if(!$user){
            return result(0);
        }
        $info = db('appeal')
            ->alias('s')
            ->where('status',1)
            ->where('s.id',$post['id'])
            ->join('users u','s.user_id = u.id')
            ->join('type_appeal tsv','s.appeal_id = tsv.id')
            ->field('s.id as appeal_id,
                     user_id,nickname,gender,
                     avatar_url as avatar,
                     title,summary,location,location_name,longitude,latitude,
                     images,price,
                     tsv.name as appeal_name')
            ->select();
        $info = $info?$info[0]:[];
        $info['images'] = explode(',',$info['images']);
        // 处理得分
        $info['average'] = db('score')->where('user_id',$user['id'])->value('average');
        unset($info['form_id']);
        unset($info['status']);
        unset($info['create_time']);
        unset($info['update_time']);
        return $info?result(1,$info):result(0);
    }



    /**
     * 获取部分服务详情
     * 1、验证身份
     * 2、获取该用户的地理位置
     * 3、筛选其附近的服务
     * 4、对数据进行加工
     * @return array 卡片服务详情
     */
    public function getPart()
    {
        // 1、验证身份
        $post = input('post.');
        // 2、获取该用户的地理位置
        $longitude = $post['longitude'];
        $latitude = $post['latitude'];
        $page = $post['page']?$post['page']:0;
        $count = $post['count']?$post['count']:10;
        $appeal_id = $post['appeal_id']?$post['appeal_id']:1;
        $user = db('users')->where('session',$post['session'])->find();
        if(!$user){
            return result(0);
        }
        // 3、筛选其附近的服务
        $where = [];
        $where['status'] = 1;
        if($appeal_id == 1){
            $where['appeal_id'] = ['>=',$appeal_id];
        }else{
            $where['appeal_id'] = $appeal_id;
        }
        $info = db('appeal')
            ->alias('a')
            ->where($where)
            ->join('users u','a.user_id = u.id')
            ->field('a.id as id,
					u.nickname,
					u.avatar_url as avatar,
					title,
					summary,
					price,
					images,
					longitude as lon,
					latitude as lat')
            ->order('id desc')
            ->limit($page*$count,$count)
            ->select();
        if(!$info){
            return result(2);
        }
        // 4、对数据进行加工
        foreach ($info as $k => $v) {
            // 简介长度截取，首先替换各种换行符，然后截取20哥字符串返回
            $str = str_replace(PHP_EOL, '', $info[$k]['summary']);
            $info[$k]['summary'] = mb_substr($str, 0,20).'...';
            // 图片字符串改成数组
            $info[$k]['images'] = explode(',', $v['images']);
            // 计算距离值
            if($longitude==0 && $latitude==0){
                $distance = -1;
            }else{
                $distance = getDistance($longitude,$latitude,$v['lon'],$v['lat']);
            }
            $info[$k]['distance'] = $distance;
            // 去掉无用的数据
            unset($info[$k]['lon']);
            unset($info[$k]['lat']);
        }
        return $info?result(1,$info):result(0);
    }
}