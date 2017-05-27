<?php
/* Smarty version 3.1.29, created on 2016-05-28 06:51:47
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\admin\login.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57494003dbed50_44022756',
  'file_dependency' => 
  array (
    '2e0e8eff45762ae73dae6e6e14b97d80fd84d070' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\admin\\login.html',
      1 => 1464418307,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57494003dbed50_44022756 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="tpl/admin/ORG/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tpl/admin/css/main.css">
    <!--[if lt IE 9]>
      <?php echo '<script'; ?>
 src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
      <?php echo '<script'; ?>
 src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
  </head>
  <body>

<div class="page-header">
  <h1>新闻发布系统 <small>--管理员登录</small></h1>
</div>
<div class="my_form_center">
	<form role="form" action="admin.php?controller=admin&method=login" method="post">
	  <div class="form-group">
	    <label for="exampleInputEmail1">USER：</label>
	    <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="请输入您的用户名" name="username" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">PSW:</label>
	    <input type="password" class="form-control input-lg" id="exampleInputPassword1" placeholder="请输入您的密码" name="password">
	  </div>
	  <div class="checkbox">
	    <label>
	      <input type="checkbox"> 记住密码
	    </label>
	  </div>
	  <button type="submit" class="btn btn-primary btn-lg">Login</button>
	</form>	
</div>







	<!-- ********************************* -->
    <?php echo '<script'; ?>
 src="tpl/admin/ORG/jquery-2.2.3.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="tpl/admin/ORG/bootstrap-3.3.6-dist/js/bootstrap.min.js"><?php echo '</script'; ?>
>
  </body>
</html><?php }
}
