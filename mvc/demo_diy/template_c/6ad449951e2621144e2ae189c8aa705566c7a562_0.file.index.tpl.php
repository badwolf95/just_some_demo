<?php
/* Smarty version 3.1.29, created on 2016-05-28 05:46:00
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\admin\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574930980b36b2_09150251',
  'file_dependency' => 
  array (
    '6ad449951e2621144e2ae189c8aa705566c7a562' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\admin\\index.tpl',
      1 => 1464414353,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:tpl/admin/tpl/tpl_main_left.html' => 1,
    'file:tpl/admin/tpl/tpl_home.html' => 1,
    'file:tpl/admin/tpl/tpl_footer.html' => 1,
  ),
),false)) {
function content_574930980b36b2_09150251 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:tpl/admin/tpl/tpl_main_left.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:tpl/admin/tpl/tpl_home.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:tpl/admin/tpl/tpl_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
