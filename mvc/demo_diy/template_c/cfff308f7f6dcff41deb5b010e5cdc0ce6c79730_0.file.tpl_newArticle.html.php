<?php
/* Smarty version 3.1.29, created on 2016-05-31 10:02:14
  from "E:\Coding\wamp\www\mvc\demo_diy\tpl\admin\tpl\tpl_newArticle.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574d612640dfe5_41608927',
  'file_dependency' => 
  array (
    'cfff308f7f6dcff41deb5b010e5cdc0ce6c79730' => 
    array (
      0 => 'E:\\Coding\\wamp\\www\\mvc\\demo_diy\\tpl\\admin\\tpl\\tpl_newArticle.html',
      1 => 1464687603,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_574d612640dfe5_41608927 ($_smarty_tpl) {
?>



<div class="page-header">
  <h1>New Article(&)<small></small></h1>
</div>



	<form action="admin.php?controller=admin&method=newsManage" method="post" >
		<div class="input-group input-group-lg">
		  <span class="input-group-addon" id="sizing-addon1">&</span>
		  <input type="text" class="form-control" placeholder="Title" aria-describedby="sizing-addon1" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
" name="title">
		</div>
        <br/>
        <div class="input-group input-group-lg">
		  <span class="input-group-addon" id="sizing-addon1">+</span>
		  <input type="text" class="form-control" placeholder="Author" aria-describedby="sizing-addon1" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['author'];?>
" name="author">
		</div>
		<br/>
		<div class="input-group input-group-lg">
		  <span class="input-group-addon" id="sizing-addon1"># </span>
		  <input type="text" class="form-control" placeholder="From" aria-describedby="sizing-addon1" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['from'];?>
" name="from">
		</div>
		<br/>
        <!-- 加载编辑器的容器 -->
        <textarea id="editor" placeholder="这里输入内容" autofocus name="content"> 
            <?php if ($_smarty_tpl->tpl_vars['news']->value['content'] == '') {?>
            //编辑器的配置暂时有BUG，使用快捷键才能实现
            //至于图片，暂时也不要啦
            <?php } else { ?>
            <?php echo $_smarty_tpl->tpl_vars['news']->value['content'];?>

            <?php }?>

         </textarea> 
        <br/>
        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['id'];?>
" name="id">
        <button type="submit" class="btn btn-default btn-lg center-block">Submit</button>
    </form>


    <link rel="stylesheet" type="text/css" href="./tpl/admin/ORG/simditor-1.0.5/styles/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="./tpl/admin/ORG/simditor-1.0.5/styles/simditor.css" />
    
    <?php echo '<script'; ?>
 type="text/javascript" src="./tpl/admin/ORG/jquery-2.2.3.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./tpl/admin/ORG/simditor-1.0.5/scripts/js/module.js">
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./tpl/admin/ORG/simditor-1.0.5/scripts/js/uploader.js">
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./tpl/admin/ORG/simditor-1.0.5/scripts/js/simditor.js"><?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
>
    
    var editor = new Simditor({
    
      textarea: $('#editor'),
      placeholder: '请在此进行创作',
      defaultImage: './tpl/admin/ORG/simditor-1.0.5/images/image.png',
      params: {},
      upload: {
              url: '',
              params: null,
              fileKey: 'upload_file',
              connectionCount: 3,
              leaveConfirm: 'Uploading is in progress, are you sure to leave this page?'},
      tabIndent: true,
      toolbar: true,
      toolbarFloat: true,
      toolbarFloatOffset: 0,
      toolbarHidden: false,
      pasteImage: true,
      cleanPaste: false,
      /*allowedStyles:{
                span: ['color', 'font-size'],
                b: ['#000'],
                i: ['#000'],
                strong: ['#000'],
                strike: ['color'],
                u: ['color'],
                p: ['margin-left', 'text-align'],
                h1: ['margin-left', 'text-align'],
                h2: ['margin-left', 'text-align'],
                h3: ['margin-left', 'text-align'],
                h4: ['margin-left', 'text-align']
      }*/
    })
          
    <?php echo '</script'; ?>
>

<?php }
}
