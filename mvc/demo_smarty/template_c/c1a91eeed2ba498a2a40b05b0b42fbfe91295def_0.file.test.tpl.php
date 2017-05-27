<?php
/* Smarty version 3.1.29, created on 2016-05-21 13:53:11
  from "E:\Coding\wamp\www\mvc\demo_smarty\tpl\test.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574068476e7f27_22253039',
  'file_dependency' => 
  array (
    'c1a91eeed2ba498a2a40b05b0b42fbfe91295def' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_smarty\\tpl\\test.tpl',
      1 => 1463838783,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_574068476e7f27_22253039 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_capitalize')) require_once 'E:\\Coding\\wamp\\www\\mvc\\demo_smarty\\smarty\\plugins\\modifier.capitalize.php';
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\Coding\\wamp\\www\\mvc\\demo_smarty\\smarty\\plugins\\modifier.date_format.php';
?>


<!-- 首字母大写 -->
<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['test']->value);?>

<!-- 字符串连接 -->
<?php echo ($_smarty_tpl->tpl_vars['test']->value).("hhhhhhhhhhhhh");?>

<!-- 格式化 -->
<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['time']->value);?>

<!-- 为空时设置为默认值 ，可同时设置多个调节-->
<?php echo mb_strtoupper((($tmp = @$_smarty_tpl->tpl_vars['love']->value)===null||$tmp==='' ? "is you" : $tmp), 'UTF-8');?>

<!-- url转码 -->
<?php echo mb_strtolower(rawurlencode($_smarty_tpl->tpl_vars['url']->value), 'UTF-8');?>

<!-- 换行转换 -->
<?php echo nl2br($_smarty_tpl->tpl_vars['nl2br']->value);?>

<!-- 判断语句 -->
<?php if ($_smarty_tpl->tpl_vars['score']->value > 90) {?>
优秀
<?php } elseif ($_smarty_tpl->tpl_vars['score']->value > 80) {?>
良好
<?php } else { ?>
不合格
<?php }?>
<!-- 循环语句 section-->
<?php
$__section_arr_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_arr']) ? $_smarty_tpl->tpl_vars['__smarty_section_arr'] : false;
$__section_arr_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['arr3']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_arr_0_total = $__section_arr_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_arr'] = new Smarty_Variable(array());
if ($__section_arr_0_total != 0) {
for ($__section_arr_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_arr']->value['index'] = 0; $__section_arr_0_iteration <= $__section_arr_0_total; $__section_arr_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_arr']->value['index']++){
?>
<br/>section<br/>
	<?php echo $_smarty_tpl->tpl_vars['arr3']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_arr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_arr']->value['index'] : null)]['title'];?>

	<?php echo $_smarty_tpl->tpl_vars['arr3']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_arr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_arr']->value['index'] : null)]['name'];?>

	<?php echo $_smarty_tpl->tpl_vars['arr3']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_arr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_arr']->value['index'] : null)]['sex'];?>

<br/>
<?php
}
}
if ($__section_arr_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_arr'] = $__section_arr_0_saved;
}
?>
<!-- 循环语句 foreach -->
<?php
$_from = $_smarty_tpl->tpl_vars['arr3']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_arr_0_saved_item = isset($_smarty_tpl->tpl_vars['arr']) ? $_smarty_tpl->tpl_vars['arr'] : false;
$_smarty_tpl->tpl_vars['arr'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['arr']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->_loop = true;
$__foreach_arr_0_saved_local_item = $_smarty_tpl->tpl_vars['arr'];
?>
<br/>foreach<br/>
	<?php echo $_smarty_tpl->tpl_vars['arr']->value['title'];?>

	<?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>

	<br/>
<?php
$_smarty_tpl->tpl_vars['arr'] = $__foreach_arr_0_saved_local_item;
}
if ($__foreach_arr_0_saved_item) {
$_smarty_tpl->tpl_vars['arr'] = $__foreach_arr_0_saved_item;
}
?>

<?php
$_from = $_smarty_tpl->tpl_vars['arr4']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_arr_1_saved_item = isset($_smarty_tpl->tpl_vars['arr']) ? $_smarty_tpl->tpl_vars['arr'] : false;
$_smarty_tpl->tpl_vars['arr'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['arr']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->_loop = true;
$__foreach_arr_1_saved_local_item = $_smarty_tpl->tpl_vars['arr'];
?>
<br/>foreachelse<br/>
	<?php echo $_smarty_tpl->tpl_vars['arr']->value['title'];?>

	<?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>

	<?php echo $_smarty_tpl->tpl_vars['arr']->value['sex'];?>

<?php
$_smarty_tpl->tpl_vars['arr'] = $__foreach_arr_1_saved_local_item;
}
if (!$_smarty_tpl->tpl_vars['arr']->_loop) {
?>
想看啥？没有！
<?php
}
if ($__foreach_arr_1_saved_item) {
$_smarty_tpl->tpl_vars['arr'] = $__foreach_arr_1_saved_item;
}
?>


<br/>
	<?php echo $_smarty_tpl->tpl_vars['imooc']->value;?>

<br/>
<!-- 类对象 -->
<?php echo $_smarty_tpl->tpl_vars['fruit']->value->grow(array('苹果','上天了'));?>


<!-- smarty使用PHP内置函数 -->

<!-- str_replace('d','h',$str); -->
<br/>
<?php echo str_replace('d','h',$_smarty_tpl->tpl_vars['abc']->value);?>

<!-- date('Y-m-d H:i:s') -->
<br/>
<?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['date']->value);?>


<!-- 函数的注册 -->
<br/>
<!-- 函数的话，p1和p2是参数里的键值对的关系索引 -->
<!-- 函数会自动将关系索引的值打包成数组发给函数调用 -->
<?php echo test(array('p1'=>'苹果','p2'=>'菠萝'),$_smarty_tpl);?>





<?php }
}
