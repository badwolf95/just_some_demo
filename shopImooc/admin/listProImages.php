<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'shopimooc/shopimooc/include.php';

$productions = getAllPro(); 
//var_dump($productions);
if(!$productions){   
    alertMes("没有商品请先添加",'addPro.php');
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />

</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
    <div class="details_operation clearfix">
        
        <div class="fr">
            <div class="text">
                <span>搜索商品：</span>
                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
            </div>
        </div>
    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th width="5%">编号</th>
                <th width="20%">商品名称</th>
                <th width="60%">商品图片</th>
                <th	width="15%">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($productions as $pro):?>
           <tr> 
            <!--这里的id和for里面的c1 需要循环出来-->
                <td><input type="checkbox" id="" class="check" value="<?php echo $pro['id'];?>"><label for="c1" class="label"><?php echo $pro['id'];?></label></td>
                <td><?php echo $pro['pName'];?></td>
                <td>
                <?php $pics = getPicById($pro['id']);
                if($pics){foreach($pics as $pic):?>
               	<img src="<?php echo $pic['albumPath'];?>" width="100px" height="100px"alt="" />
                <?php endforeach;}?>
                </td>   
                <td align="center">
    				<input type="button" value="添加文字水印" class="btn" onclick="addWaterText(<?php echo $pro['id'];?>)">
    				<input type="button" value="添加图片水印" class="btn" onclick="addWaterPic(<?php echo $pro['id'];?>)">
                    
                </td>
                </tr>
            <?php endforeach;?>
       		<tr>
       		<td colspan="8" ></td>
       		</tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">

function addWaterText(id,addFlag){
	if(confirm("你确定要添加‘imooc.com‘文字水印么？添加了后不能撤销哦")){
		window.location = "doAdminAction.php?act=addWaterText&id="+id;
	}
}
function addWaterPic(id){	
	if(confirm("你确定要添加‘imooc.com‘图片水印么？添加了后不能撤销哦")){
		window.location = "doAdminAction.php?act=addWaterPic&id="+id; 
	}
}
</script>
</body>
</html>