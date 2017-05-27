<?php
/* Smarty version 3.1.29, created on 2016-05-29 09:05:17
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\admin\articleList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574ab0cdd1a045_21133595',
  'file_dependency' => 
  array (
    '6343583ed882270da1446aee176ea915921747a8' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\admin\\articleList.html',
      1 => 1464512519,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:tpl/admin/tpl/tpl_main_left.html' => 1,
    'file:tpl/admin/tpl/tpl_articleList.html' => 1,
    'file:tpl/admin/tpl/tpl_footer.html' => 1,
  ),
),false)) {
function content_574ab0cdd1a045_21133595 ($_smarty_tpl) {
?>
<!-- 在模板中包含其他模板，必须为其他模板注册变量 -->

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:tpl/admin/tpl/tpl_main_left.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('username'=>$_smarty_tpl->tpl_vars['username']->value['name']), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:tpl/admin/tpl/tpl_articleList.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('news'=>$_smarty_tpl->tpl_vars['news']->value), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:tpl/admin/tpl/tpl_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
