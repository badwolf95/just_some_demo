<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Request;
use think\Loader;
Loader::import('PHPMailer.class',EXTEND_PATH,'.phpmailer.php');





function show($status,$mes,$data=[]){
	header('Content-type:text/html;charset=utf-8');
	$show = [
		'status'	=>	$status,
		'message'	=>	$mes,
		'data'		=>	$data,
	];
	exit(json_encode($show));
}

function addMd5($str){
	$suffix = config('MD5_SUFFIX');
	return md5(md5($str.$suffix));
}

function addMd5_token($email,$password){
	return md5(md5($email.$password.time().config('EMAIL_TOKEN_SUFFIX')));
}

function getTempTime($time){
	if($time!=0){
		return date('Y-m-d H:i:s',$time);
	}else{
		return '';
	}
}

function getUserStatus($user_id){
	if($user_id>config('IDENTITY_NUM')){
		$user_id -= config('IDENTITY_NUM');
	}else{
		$user_id -= config('IDENTITY_NUM');
	}
	$res = model('User')->where('id',$user_id)->value('status');
	if($res == 2){
		return '(账号已禁用)';
	}
}

function getSummary($cont){
	return mb_substr($cont,0,200,'utf-8');
}

function getFackId($id,$type){
	if(1 == $type){
		return ($id + config('IDENTITY_NUM'));
	}elseif(2 == $type){
		return ($id + config('IDENTITY_NUM_ORG'));
	}	
}


/**
 * 发送邮件
 */
function sendEmail($email,$token){

	try {
		$mail = new \PHPMailer(true); //New instance, with exceptions enabled
		$url = request()->domain().'/index/index/register_confirm/email/'.$email.'/token/'.$token;
		$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
			<html>
			  <head>
			    <title>Email test</title>
			    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			  </head>
			  <body>
				<p>
					欢迎使用workspace，请点击以下链接进行账号激活：
					<a href="'.$url.'">'.$url.'</a>
				</p>
			  </body>
			</html>';
		$mail->IsSMTP();                           // tell the class to use SMTP
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Port       = 25;                    // set the SMTP server port
		$mail->Host       = config('SMTP_SERVICE'); // SMTP server
		$mail->Username   = config('SMTP_USERNAME');     // SMTP server username
		$mail->Password   = config('SMTP_PASSWORD');            // SMTP server password
		// $mail->IsSendmail();  // tell the class to use Sendmail
		$mail->AddReplyTo(config('SMTP_USERNAME'),config('SMTP_REPLY_NAME'));
		$mail->From       = config('SMTP_USERNAME');
		$mail->FromName   = config('SMTP_REPLY_NAME');
		$to = $email;
		$mail->AddAddress($to);
		$mail->Subject  = "WORKSPACE账号激活";
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap   = 80; // set word wrap
		$mail->MsgHTML($body);
		$mail->IsHTML(true); // send as HTML
		$mail->Send();
		return true;
	} catch (phpmailerException $e) {
		// return $e->errorMessage();
		return false;
	}
}