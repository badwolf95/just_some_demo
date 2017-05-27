<?php
/* Smarty version 3.1.29, created on 2016-05-30 11:25:03
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\index\tpl\tpl_newsDetail.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574c230f9c1fd7_38829210',
  'file_dependency' => 
  array (
    '0417fcbcfb44807ba5ff46ed52b7fc58d37d3f89' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\index\\tpl\\tpl_newsDetail.html',
      1 => 1464607502,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_574c230f9c1fd7_38829210 ($_smarty_tpl) {
?>


<div class="page-header">
  <h1>News Detail <small>Let's Do It!</small></h1>
</div>


<div class="wrap">
	<div class="panel panel-primary">
		<div class="panel-body">
			<h2>
				<span class="label label-primary">Title</span>
				<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>

			</h2>
			<div class="pullright">
				<span class="label label-success">Author</span><?php echo $_smarty_tpl->tpl_vars['news']->value['author'];?>

				<span class="label label-default">From</span><?php echo $_smarty_tpl->tpl_vars['news']->value['from'];?>

				<span class="label label-warning">Time</span><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['news']->value['pubtime']);?>

			</div>
			<hr/>
			<div class="my_content">
				<?php echo $_smarty_tpl->tpl_vars['news']->value['content'];?>

			</div>
		  </div>
	</div>
</div>
















<?php }
}
