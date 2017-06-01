<?php
namespace app\index\controller;

use think\Controller;
use think\File;

class Index extends controller
{
    /**
     * 主界面
     * @return [type]
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 搜索IP
     * 将IP进行加工，和存储时同一个格式
     * 然后通过redis获取到相应的值
     * @return [type]
     */
    public function search()
    {
    	$ip = input('post.ip');
        $redis = new \Redis();
        $res = $redis->connect('127.0.0.1',6379);
    	// 根据ip查询后返回结果
        $ipRes = $this->checkIPFormat($ip);
        if($ipRes === false){
            return json('请输入正确的IP地址');
        }
        // var_dump($ipRes);
        $res = $this->getIpKeyValue($ipRes);
        // var_dump($res);
        $info = $redis->zRangeByScore('ip'.$res[0],$res[1],'+inf',array('limit' => array(0, 1)));
        // var_dump($info);
    	return json($info);
    }


    /**
     * 导入IP，因为ip分成两个文档，要手动改变下文件名，分两次请求
     * @return [type]
     */
    public function importIpAddressFromFile()
    {
        // 逐行读取文件写入redis
    	$file = fopen('static/ip.txt','r');
    	$ip = [];
    	$i = 0;
        $redis = new \Redis();
        $res = $redis->connect('127.0.0.1',6379);
        if(!$res){
            return json(0);
        }
        while(!feof($file)){
            $info = fgets($file);
            // 连续的空格合并成一个
            $info = preg_replace("/[\s]+/is"," ",$info);
            // 根据空格分组，最多三组，也就划分出了IP起始地址和IP所在地
            $info = explode(" ",$info,3);
            // 思路： 将IP分割成四段A:B:C:D，A作为索引号，加入redis的zset:$A
            // 然后将BCD换算成真值256*256*B+256*C+D，作为zset中的score值
            // 再将地址信息作为zset中的val值
            // 起始地址都要录入
            // 查询时，将该地址做同样的转换得到值E
            // 然后利用zset的查询zRevRangeByScore，查询获取到第一个比E值大的val值即是索要地址，如果没有查询到，则可能是该地址横跨多个A值，在A+1中执行同样的查询获取即可
            // var_dump($i);
            // var_dump($info);
            $res = $this->getIpKeyValue($info[1]);
            // var_dump($res);
            $j = 0;
            $r1 = $redis->zAdd('ip'.$res[0],$res[1],$info[2]);
            // $res = $this->getIpKeyValue($info[1]);
            // $r2 = $redis->zAdd("ipA:{$res[0]}",$res[1],$info[2]);

    		$ip[] = $r1;
    	}
    	fclose($file);
    	$res = $ip;
    	return json($ip);
    }


    /**
     * 对IP进行加工
     * 分为A值
     * 和256*256*B+256*C+D的值
     * @param  [type]
     * @return [type]
     */
    public function getIpKeyValue($ip)
    {
        $kv = explode('.',$ip);
        $res = [];
        $res[] = $kv[0];
        $res[] = 256*256*$kv[1]+256*$kv[2]+$kv[3];
        return $res;
    }

    /**
     * 检查IP的格式是否正确
     * 正确的话返回处理后的IP地址
     * 否则返回false
     * @param  [type]
     * @return [type]
     */
    public function checkIPFormat($ip)
    {
        $ip = preg_replace("/[\s]+/is","",$ip);
        $kv = explode('.',$ip);
        $i = 0;
        foreach($kv as $v){
            $i++;
            if($v<0 || $v>255){
                return false;
            }
        }
        if($i<4){
            return false;
        }
        return $ip;
    }
}