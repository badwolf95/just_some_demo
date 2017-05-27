<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shopimooc/shopimooc/include.php';

$users = getAllUser();
if(!$users){
    $users = array();
    echo "<script>alert('没有用户请先添加);</script>";
}
//var_dump($users);
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
        <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addUser()">
    </div>
        
</div>
<!--表格-->
<table class="table" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th width="5%">编号</th>
            <th width="20%">管理员名称</th>
            <th width="15%">管理员邮箱</th>
            <th width="15%">注册时间</th>
            <th width="20%">是否激活</th>
            <th>相关操作</th>
        </tr>
    </thead>
    <tbody>  
        <tr>
        <?php foreach($users as $user):?>
            <!--这里的id和for里面的c1 需要循环出来-->
                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $user['id'];?></label></td>
                <td><?php echo $user['username'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><?php echo date("Y-m-d H:i:s",$user['regTime'])?></td>
                <td><?php echo ($user['activeFlag'])?"已激活":"未激活";?></td>
                <td align="center">
                <!-- 以下两种方法都可以实现跳转，第二种可以提前提示 -->
                	<a href="modifyUser.php?id=<?php echo $user['id'];?>"><input type="button" value="修改" class="btn" ></a>
                	<input type="button" value="删除" class="btn" onclick="delUser(<?php echo $user['id'];?>)" >
                </td>
            </tr>  
 		<?php endforeach;?>
        	<tr>
        		<td colspan="5"></td>
        	</tr>
    </tbody>
    </table>
</div>
</body>
<script type="text/javascript">
function addUser(){
	window.location="addUser.php";
}
function delUser(id){
	if(confirm("你确定要删除吗")){
		window.location="doAdminAction.php?act=delUser&id="+id;
	}	
}
</script>
</html>