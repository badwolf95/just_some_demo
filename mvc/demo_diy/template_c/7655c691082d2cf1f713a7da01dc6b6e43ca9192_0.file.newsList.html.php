<?php
/* Smarty version 3.1.29, created on 2016-05-30 13:20:22
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\index\newsList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574c3e16429648_99783230',
  'file_dependency' => 
  array (
    '7655c691082d2cf1f713a7da01dc6b6e43ca9192' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\index\\newsList.html',
      1 => 1464614385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./tpl/tpl_head.html' => 1,
    'file:./tpl/tpl_newsList.html' => 1,
    'file:./tpl/tpl_footer.html' => 1,
  ),
),false)) {
function content_574c3e16429648_99783230 ($_smarty_tpl) {
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./tpl/tpl_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./tpl/tpl_newsList.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('news'=>$_smarty_tpl->tpl_vars['news']->value,'about'=>$_smarty_tpl->tpl_vars['about']->value), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./tpl/tpl_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
