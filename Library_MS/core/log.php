<?php

/**添加用户操作日志
 * @param unknown $what
 * @param unknown $username
 */
function addNewLog($what,$username=null){
    if($username==null){
        $username = (@$_SESSION['username'])?(@$_SESSION['username']):"";  
        if($username==""){$username=($_SESSION['ADMINname'])?$_SESSION['ADMINname']:"未知";}
    }
    $time = date("Y-m-d H:i:s",time());
    $ip = getUserIp();
    $sql = "INSERT log(who,whattime,what,ip) VALUES('{$username}','{$time}','{$what}','{$ip}')";
    //var_dump($sql);exit;
    mysqli_query($_SESSION['link'],$sql);
}


function getUserIp(){
    if (@$HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"])
    {
        $ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
    }
    elseif (@$HTTP_SERVER_VARS["HTTP_CLIENT_IP"])
    {
        $ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
    }
    elseif (@$HTTP_SERVER_VARS["REMOTE_ADDR"])
    {
        $ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
    }
    elseif (getenv("HTTP_X_FORWARDED_FOR"))
    {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    }
    elseif (getenv("HTTP_CLIENT_IP"))
    {
        $ip = getenv("HTTP_CLIENT_IP");
    }
    elseif (getenv("REMOTE_ADDR"))
    {
        $ip = getenv("REMOTE_ADDR");
    }
    else
    {
        $ip = "Unknown";
    }
   return $ip ;
}








