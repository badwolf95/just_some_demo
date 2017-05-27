<?php
/* Smarty version 3.1.29, created on 2016-05-30 10:01:14
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\index\index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574c0f6a683242_75598599',
  'file_dependency' => 
  array (
    'c3549650fdca0e3c34382d4ec773b9db9e396c94' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\index\\index.html',
      1 => 1464602320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./tpl/tpl_head.html' => 1,
    'file:./tpl/tpl_home.html' => 1,
    'file:./tpl/tpl_footer.html' => 1,
  ),
),false)) {
function content_574c0f6a683242_75598599 ($_smarty_tpl) {
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./tpl/tpl_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./tpl/tpl_home.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:./tpl/tpl_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
