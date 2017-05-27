<?php
/* Smarty version 3.1.29, created on 2016-05-30 13:20:22
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\index\tpl\tpl_newsList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574c3e16547b35_00908959',
  'file_dependency' => 
  array (
    'a1543392f82b130a95c321da6a7937fd4e86fcfd' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\index\\tpl\\tpl_newsList.html',
      1 => 1464614371,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_574c3e16547b35_00908959 ($_smarty_tpl) {
?>


<div class="page-header">
  <h1>  News List <small>Just Enjoy Yourself.</small></h1>
</div>



<div class="wrap">
	<div class="my_panel_left">


	<!-- 在这里foreach -->
	<?php
$_from = $_smarty_tpl->tpl_vars['news']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_val_0_saved_item = isset($_smarty_tpl->tpl_vars['val']) ? $_smarty_tpl->tpl_vars['val'] : false;
$__foreach_val_0_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['val'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['val']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
$__foreach_val_0_saved_local_item = $_smarty_tpl->tpl_vars['val'];
?>
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title" id="my_head_lg">
		    	<a href="index.php?controller=index&method=showNewsDetail&id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
">
		    	<?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a>
		    </h3>
		  </div>
		  <div class="panel-body">
		    <?php echo $_smarty_tpl->tpl_vars['val']->value['content'];?>
...........
		  </div>
		  <div class="panel-footer">
			<span class="label label-success">Author</span><?php echo $_smarty_tpl->tpl_vars['val']->value['author'];?>
&nbsp;&nbsp;&nbsp;
			<span class="label label-default">From</span><?php echo $_smarty_tpl->tpl_vars['val']->value['from'];?>
&nbsp;&nbsp;&nbsp;
			<div class="pullright"><span class="label label-warning ">Time</span><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['val']->value['pubtime']);?>
</div>
		  	  
		  </div>
			
		</div>
	<?php
$_smarty_tpl->tpl_vars['val'] = $__foreach_val_0_saved_local_item;
}
if (!$_smarty_tpl->tpl_vars['val']->_loop) {
?>
		<div class="panel panel-primary">
		  <div class="panel-body">
			还没有文章，请先添加
		  </div>
		  
		</div>

	<?php
}
if ($__foreach_val_0_saved_item) {
$_smarty_tpl->tpl_vars['val'] = $__foreach_val_0_saved_item;
}
if ($__foreach_val_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_val_0_saved_key;
}
?>


	</div>
		<div class="my_panel_right">
				<div class="panel panel-success">
		  <div class="panel-heading">
		    <h3 class="panel-title">
				<span class="label label-success my_label_lg">公告栏</span>
		    </h3>
		  </div>
		  <div class="panel-body">
		    <?php echo $_smarty_tpl->tpl_vars['about']->value;?>

		  </div>
		</div>
	</div>
</div>



<?php }
}
