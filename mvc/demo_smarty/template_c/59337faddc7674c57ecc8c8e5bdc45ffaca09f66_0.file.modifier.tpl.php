<?php
/* Smarty version 3.1.29, created on 2016-05-23 08:25:32
  from "E:\Coding\wamp\www\mvc\demo_smarty\tpl\modifier.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5742be7c221ef1_68744523',
  'file_dependency' => 
  array (
    '59337faddc7674c57ecc8c8e5bdc45ffaca09f66' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_smarty\\tpl\\modifier.tpl',
      1 => 1463991930,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5742be7c221ef1_68744523 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_test')) require_once 'E:\\Coding\\wamp\\www\\mvc\\demo_smarty\\smarty\\plugins\\modifier.test.php';
echo smarty_modifier_test($_smarty_tpl->tpl_vars['utime']->value,"Y-m-d H:i:s");
}
}
