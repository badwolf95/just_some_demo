<?php 
require_once '../include.php';


/**下面这个是用来获得表内内容的****所有
 * @param string $table
 * @param number $pageSize
 */
$arr = getAllAdmin();
if(!$arr){
    alertMes('还没有用户请先添加->', 'addAdmin.php');
}


/**下面这个是用来获得表内内容的****部分
 * @param string $table
 * @param number $pageSize
 */
$pageNum=0;
$pageCont = getPageCont('imooc_admin',$pageNum);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css"/>
</head>

<body>
<div class="details">
<div class="details_operation clearfix">
    <div class="bui_select">
        <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addAdmin()">
    </div>
        
</div>
<!--表格-->
<table class="table" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th width="15%">编号</th>
            <th width="20%">用户名称</th>
            <th width="20%">用户邮箱</th>
            <th width="20%">是否激活</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>  
        <tr>
        <?php 
        //按顺序显示编号
        @$page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
        $i=1+$_SESSION['pageSize']*($page-1);        
        foreach ($pageCont as $arrs): ?>
            <!--这里的id和for里面的c1 需要循环出来-->
                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"></label><?php echo $i;?></td>
                <td><?php echo $arrs['username'];?></td>
                <td><?php echo $arrs['email'];?></td>
                <td><?php echo $arrs['active'];?></td>
                <td align="center">
                <!-- 以下两种方法都可以实现跳转，第二种可以提前提示 -->
                	<a href="doAdminAction.php?act=modifyAdmin&&id=<?php echo $arrs['id'];?>"><input type="button" value="修改" class="btn" ></a>
                	<input type="button" value="删除" class="btn" onclick="delAdmin(<?php echo $arrs['id'];?>)" >
                </td>
            </tr>  
        
        <?php $i++; endforeach;?>
        	<tr>
        		<td colspan="5"><?php showPage('../admin/listAdmin.php',$pageNum);?></td>
        	</tr>
    </tbody>
    </table>
</div>
</body>
<script type="text/javascript">
	function addAdmin(){
		window.location="addAdmin.php";
	}	
	function delAdmin(id){
		if(confirm('你确定要删除吗')){
			window.location="doAdminAction.php?act=deleteAdmin&&id="+id;
		}
}
</script>
</html>