<?php
require_once '../include.php';
checkLogined();
$sql = "select * from imooc_pro";
$arrs = fetchAll($sql);
if($arrs==null){
    alertMes("Add First,Please.","addPro.php");
}

@$keyword = $_REQUEST['keywords']?$_REQUEST['keywords']:null;
@$cId = $_REQUEST['cId']?$_REQUEST['cId']:null;

if($cId==null){
    @$where = $keyword?"pName like '%{$keyword}%'":null;
}else{
    @$where = $keyword?$where."&pName like '%{$keyword}%'":"cId='".$cId."'"; 
}

@$order = $_REQUEST['order']?$_REQUEST['order']:null;
$pageNum = 0;
$pageCont = getPageCont('imooc_pro', $pageNum,$where,$order);

$cates = getAllCate();


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addPro()"/>
        </div>
        <div class="fr">
            <div class="text">
                <span>商品分类：</span>
                <div class="bui_select">
                 <select id="" class="select" onchange="changeByCate(this.value)">
                 	<option>-请选择-</option>
                        <?php foreach($cates as $cate):?>
                        <option value="<?php echo $cate['id'];?>"><?php echo $cate['cName'];?></option>
                    	<?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="text">
                <span>价格排序：</span>
                <div class="bui_select">
                    <select id="" class="select" onchange="change(this.value)">
                    	<option>-请选择-</option>
                        <option value="iPrice asc" >市场价-升</option>
                        <option value="iPrice desc">市场价-降</option>
                        <option value="iPrice asc" >慕课价-升</option>
                        <option value="iPrice desc">慕课价-降</option>
                    </select>
                </div>
            </div>
            <div class="text">
                
            </div>
            <div class="text">
                <span>上架时间：</span>
                <div class="bui_select">
                 <select id="" class="select" onchange="change(this.value)">
                 	<option>-请选择-</option>
                        <option value="pubTime desc" >最新发布</option>
                        <option value="pubTime asc">历史发布</option>
                    </select>
                </div>
            </div>
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
                <th width="9%">商品分类</th>
                <th width="5%">是否上架</th>
                <th width="10%">上架时间</th>
                <th width="10%">市场价格</th>
                <th width="10%">慕课价格</th>
                <th	width="30%">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($pageCont){
                @$page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
                $i = 1+$_SESSION['pageSize']*($page-1);   
                foreach($pageCont as $pro):?>
            <tr>  
            <!--这里的id和for里面的c1 需要循环出来-->
                <td><input type="checkbox" id="<?php echo $pro['id'];?>" class="check" value="<?php echo $pro['id'];?>"><label for="c1" class="label"><?php echo $i;?></label></td>
                <td><?php echo $pro['pName'];?></td>
                <td><?php 
                        $cate = getCateByCid($pro['cId']);
                        echo $cate['cName'];
                ?></td>                              
                <td><?php 
                if($pro['isShow']){
                    echo "Yes";
                }else{
                    echo "No";
                }
                ?></td>
                <td><?php echo date('Y-m-d h:i:s',$pro['pubTime']);?></td>
                <td><?php echo $pro['iPrice'];?>元</td>
                <td><?php echo $pro['mPrice'];?>元</td>
                <td align="center">
    				<input type="button" value="详情" class="btn" onclick="showDetail(<?php echo $pro['id'];?>,'<?php echo $pro['pName'];?>')">
    				<input type="button" value="修改" class="btn" onclick="editPro(<?php echo $pro['id'];?>)">
    				<input type="button" value="删除" class="btn"onclick="delPro(<?php echo $pro['id'];?>,<?php echo $page;?>)">
                    <div id="showDetail<?php echo $pro['id'];?>" style="display:none;">
                	<table class="table" cellspacing="0" cellpadding="0" >
                		<tr>
                			<td width="20%" align="right">商品名称</td>
                			<td><?php echo $pro['pName'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">商品类别</td>
                			<td><?php echo $pro['pSn'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">商品货号</td>
                			<td><?php echo $pro['cId'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">商品数量</td>
                			<td><?php echo $pro['pNum'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">商品价格</td>
                			<td><?php echo $pro['iPrice'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">幕课网价格</td>
                			<td><?php echo $pro['mPrice'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">商品图片</td>
                			<td>
                			<?php 
                			if($images = getPicById($pro['id'])){ 
                    			foreach($images as $img):
                    			?>
                    			<img width="100" height="100" src="<?php echo $img['albumPath'];?>"/>
                    			<?php endforeach;
                    		}else{
                    		      echo "未上传，点击修改，添加图片";
                    		}?>
                			</td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">是否上架</td>
                			<td><?php echo ($pro['isShow'])?"YES":"NO";?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">是否热卖</td>
                			<td>
                				<?php echo ($pro['isHot'])?"YES":"NO";?>
                			</td>
                		</tr>
                		
                	</table>
                	<span style="display:block;width:800px; ">
                	商品描述<br/>
                	<?php echo $pro['pDesc'];?>
                	</span>
                    	
                	</div>
                </td>
        	</tr>
        	
       	<?php $i++;endforeach;
            }else{
                alertMes("此分类下无商品，请先添加", 'listPro.php');
            }?>
       		<tr>
       		<td colspan="8" ><?php showPage('../admin/listPro.php', $pageNum, $keyword,null,null,$cId);?></td>
       		</tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
function showDetail(id,t){
	$("#showDetail"+id).dialog({
		  height:"auto",
	      width: "auto",
	      position: {my: "center", at: "center",  collision:"fit"},
	      modal:false,//是否模式对话框
	      draggable:true,//是否允许拖拽
	      resizable:true,//是否允许拖动
	      title:"商品名称："+t,//对话框标题
	      show:"slide",
	      hide:"explode"
	});
}
function addPro(){
	window.location="addPro.php";
}

function editPro(id){
	window.location="modifyPro.php?id="+id;
}
function delPro(id,page){
	window.location="doAdminAction.php?act=delPro&id="+id+"&page="+page;
}
function search(){
    if(event.keyCode==13){
    	var val = document.getElementById('search').value;
    	window.location="listPro.php?keywords="+val;
    }
}
function change(val){
	window.location="listPro.php?order="+val;
}
function changeByCate(val){
	window.location="listPro.php?cId="+val;	
}

</script>
</body>
</html>