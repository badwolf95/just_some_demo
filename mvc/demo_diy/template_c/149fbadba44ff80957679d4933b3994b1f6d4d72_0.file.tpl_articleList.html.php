<?php
/* Smarty version 3.1.29, created on 2016-05-31 09:42:11
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\admin\tpl\tpl_articleList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574d5c732a8377_58751684',
  'file_dependency' => 
  array (
    '149fbadba44ff80957679d4933b3994b1f6d4d72' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\admin\\tpl\\tpl_articleList.html',
      1 => 1464687729,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_574d5c732a8377_58751684 ($_smarty_tpl) {
?>


<div class="panel panel-primary" >
  <!-- Default panel contents -->
  <div class="panel-heading" id="my_panel_font">Article List</div>
  <!--  <div class="panel-body">
  	
    </div>  -->

  <!-- Table -->
  
   <table class="table table-striped table-bordered table-hover" id="my_table">
   <thead>
     <tr >
       <th style="width: 5%;">ID</th>
       <th style="width: 50%;">Title</th>
       <th style="width: 20%;">Author</th>
       <th style="width: 25%;">Management</th>
     </tr>
   </thead>
   <tbody>
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
     <tr>
       <td><?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
</td>
       <td><a href="index.php?controller=index&method=showNewsDetail&id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></td>
       <td><?php echo $_smarty_tpl->tpl_vars['val']->value['author'];?>
</td>
       <td>
			<div class="btn-group" role="group" aria-label="...">
			  <a href="admin.php?controller=admin&method=newsManage&id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
">
          <button type="button" class="btn btn-default">
			  	  <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
			   </button>
        </a>
        <a href="admin.php?controller=admin&method=delete&id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
">
  			  <button type="button" class="btn btn-default ">
  			   <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
  			  </button>
        </a>
			</div>
		</td>
     </tr>
     <?php
$_smarty_tpl->tpl_vars['val'] = $__foreach_val_0_saved_local_item;
}
if (!$_smarty_tpl->tpl_vars['val']->_loop) {
?>
     <tr>
      <td colspan="4">
        暂时没有文章，请先发布
      </td>
     </tr>
    <?php
}
if ($__foreach_val_0_saved_item) {
$_smarty_tpl->tpl_vars['val'] = $__foreach_val_0_saved_item;
}
if ($__foreach_val_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_val_0_saved_key;
}
?>
     
     <tr>
     	<td colspan="4">
		<nav>
		  <ul class="pager">
		    <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li>
		    <li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>
		  </ul>
		</nav>
     	</td>
     </tr>
   </tbody>
 </table>


</div>
<?php }
}
