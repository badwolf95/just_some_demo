<?php
/* Smarty version 3.1.29, created on 2016-05-30 12:59:25
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\admin\tpl\tpl_main_left.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574c392d7d5e41_84614706',
  'file_dependency' => 
  array (
    '7fdb782d6f189b55739e60db46e96c7fb4ed8e2f' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\admin\\tpl\\tpl_main_left.html',
      1 => 1464613154,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_574c392d7d5e41_84614706 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Badwolf</title>
    <link rel="icon" href="tpl/admin/img/news2.ico" type="image/x-icon"/>
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

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="admin.php"><span class="glyphicon glyphicon-tint" aria-hidden="true"> News_Management_System</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <!-- 下面是管理员名称 -->
        <li>
          <a href="#">
          <span class="glyphicon glyphicon-fire" aria-hidden="true"></span>
          <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a>
        </li>
        <li role="presentation">
          <a href="admin.php?controller=admin&method=logout">
          <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>
          Logout</a>
        </li>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="main_left">
  <ul class="nav nav-pills nav-stacked">
    <li role="presentation" class="active">News Management</li>
    <li role="presentation">
      <a href="admin.php?controller=admin&method=newsManage">
      <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
      New Article</a>
    </li>
    <li role="presentation">
      <a href="admin.php?controller=admin&method=newsList">
       <span class="glyphicon glyphicon-indent-left" aria-hidden="true"></span>
      Article Manege</a>
    </li>
    <li role="presentation">Admin </li>
    <li role="presentation">
      <a href="admin.php?controller=admin&method=logout">
       <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>
     Logout</a></li>
  </ul>
</div>

<div class="main_right">


<!-- <ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Library</a></li>
  <li class="active">Data</li>
</ol>
 -->

<?php }
}
