<?php
/* Smarty version 3.1.29, created on 2016-05-30 10:33:14
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\index\newsDetail.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574c16ea391ed1_98881164',
  'file_dependency' => 
  array (
    'c259a4396f07c8894a45c1a74a5c6e3a6dbf2320' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\index\\newsDetail.html',
      1 => 1464604393,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./tpl/tpl_head.html' => 1,
    'file:./tpl/tpl_newsDetail.html' => 1,
    'file:./tpl/tpl_footer.html' => 1,
  ),
),false)) {
function content_574c16ea391ed1_98881164 ($_smarty_tpl) {
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./tpl/tpl_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./tpl/tpl_newsDetail.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('news'=>$_smarty_tpl->tpl_vars['news']->value), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./tpl/tpl_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
