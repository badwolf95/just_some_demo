<?php
/* Smarty version 3.1.29, created on 2016-05-23 08:41:16
  from "E:\Coding\wamp\www\mvc\demo_smarty\tpl\block.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5742c22c7175f5_53757868',
  'file_dependency' => 
  array (
    '33ae003d7b54ff1957caac1d1eccd914f2389a73' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_smarty\\tpl\\block.tpl',
      1 => 1463992875,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5742c22c7175f5_53757868 ($_smarty_tpl) {
if (!is_callable('smarty_block_test2')) require_once 'E:\\Coding\\wamp\\www\\mvc\\demo_smarty\\smarty\\plugins\\block.test2.php';
$_smarty_tpl->smarty->_cache['tag_stack'][] = array('test2', array('realy'=>'true','max'=>15)); $_block_repeat=true; echo smarty_block_test2(array('realy'=>'true','max'=>15), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php echo $_smarty_tpl->tpl_vars['str']->value;?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_test2(array('realy'=>'true','max'=>15), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_cache['tag_stack']);
}
}
