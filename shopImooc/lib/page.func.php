<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shopImooc/shopImooc/include.php';
/**这个函数封装的不是太完美，但也实现了按钮和内容分离，记得看那个组合配套使用哦。
 * 
 */

/**需要这样组合使用哦
 * @var integer $pageNum
 */
/* 
 * $pageNum = 0;
 * $pageCont = getPageCont('imooc_admin',$pageNum);
 * showPage($file_path, $pageNum);
 * 下面这两句是用来按顺序显示编号的，记得加在foreach上，只要在需要输出编号的地方echo $i;就行了
 * @$page = $_REQUEST['page']?(int)$_REQUEST['page']:1;
    $i=1+$_SESSION['pageSize']*($page-1);    
 */



/**获得该分页显示的内容
 * @param string $table
 * @param number $pageSize
 */
function getPageCont($table,&$pageNum,$where=null,$order=null,$page=1){
    $where = ($where==null)?null:"where $where";
    $order = $order?$order.",":null;
    /* echo "getPageCont:where=";
    var_dump($where); */
    $sql_all = "select * from {$table} {$where}";
    $totalNum = getResultNum($sql_all);    
    //通过SESSION来存储页面条数
    @$pageSize = $_POST['pageSize'];
    if(@$_SESSION['pageSize']==""){
        $_SESSION['pageSize']=7;
    }
    if($pageSize==null){       //先判断是否为空，否则后面的判断是否为数字的容易逻辑混乱出错。
        @$_SESSION['pageSize']=$_SESSION['pageSize'];
    }elseif($pageSize>$totalNum){
        $_SESSION['pageSize']=$totalNum;
    }elseif($pageSize<=0||!is_numeric($pageSize)){
        $_SESSION['pageSize']=1;             
    }else{
        $_SESSION['pageSize']=$pageSize;
    }
    @$pageNum = ceil($totalNum/$_SESSION['pageSize']);
    @$page = $_REQUEST['page']?(int)$_REQUEST['page']:1;//为啥会报错，妹的
    if($page<1||$page==""||!is_numeric($page)){
        $page=1;
    }elseif($page>$pageNum){
        $page=$pageNum;
    }
    $offset = ($page-1)*$_SESSION['pageSize'];
    $sql_part = "select * from {$table} {$where} order by {$order}id desc limit {$offset},{$_SESSION['pageSize']}";
    $pageCont = fetchAll($sql_part);
    return $pageCont;
}   



/**显示分页按钮
 * @param unknown $pageCont
 * @param unknown $pageNum
 * @param number $page
 */
function showPage($file_path,$pageNum,$keyword=null,$order=null,$where=null,$cId=null,$page=1,$sep="&nbsp;"){
    $url = $_SERVER['PHP_SELF'];
    $keyword = $keyword?"&keywords=".$keyword:null;
    if($order==null){
        $where = ($where==null)?null:"&where=".$where;
    }else{
        $where = ($where==null)?"&order=".$order:"&where=".$where."&order=".$order;
    }
    if($cId==null){
        $where = ($where==null)?null:$where;
    }else{
        $where = ($where==null)?"&cId=".$cId:$where."&cId=".$cId;
    }
   /*  echo "showPage:where=";
    var_dump($where); */
    
    @$page = $_REQUEST['page'];//为啥会报错，妹的
    if($page<1||$page==""||!is_numeric($page)){
        $page=1;
    }elseif($page>$pageNum){
        $page=$pageNum;
    }
    $className = "pageBtn";
    $spanName = "pageBtn_span";
    $inputText = "inputText";
    $inputBtn = "inputBtn";
    $inline_block = "inline-block";
    $index = $page==1?"<br/><br/><span class='{$spanName}'>首页</span>":"<br/><br/><a class='{$className}' href='{$url}?page=1{$keyword}{$where}'>首页</a>";
    $last = $page==$pageNum?"<span class='{$spanName}'>尾页</span>":"<a class='{$className}' href='{$url}?page={$pageNum}{$keyword}{$where}'>尾页</a>";
    //这里的“。（）。”写法有点怪有点腻害，学着点
    $prev = $page==1?"<span class='{$spanName}'>上一页</span>":"<a class='{$className}' href='{$url}?page=".($page-1)."{$keyword}{$where}'>上一页</a>";
    $next = $page==$pageNum?"<span class='{$spanName}'>下一页</span>":"<a class='{$className}' href='{$url}?page=".($page+1)."{$keyword}{$where}'>下一页</a>";
    $total = "<span class='{$spanName}'>一共有{$pageNum}页，当前是第{$page}页。</span>";
    $pageGoto = "<span class='{$spanName}'>跳转到<form action='{$url}?page=".($page)."{$keyword}{$where}' method='post' class='{$inline_block}'><input  class='{$inputText}' type='text' name='page'/>页<input type='submit' value='确定' class='{$inputBtn}'/></form></span>";
    $listNum = "<span class='{$spanName}'>每页显示<form action='{$url}?page=".($page)."{$keyword}{$where}' method='post' class='{$inline_block}'><input class='{$inputText}' type='text' name='pageSize' placeholder='{$_SESSION["pageSize"]}' />条记录<input type='submit' value='确定' class='{$inputBtn}'/></form> </span>";
    /**要输出相应内容应该这样咯
     * @var integer $pageNum
     */
    /* foreach ($pageCont as $arr): 
        echo "编号：".$arr['id']."<br />";
        echo "用户：".$arr['username']."<hr />";
    endforeach;   
     */
    $p = "";
    for($i=1;$i<=$pageNum;$i++){
        if($page == $i){
            @$p .= "<span class='{$spanName}'> [{$i}]</span>";
        }else{
            @$p .= "<a class='{$className}' href='{$url}?page={$i}'>{$i}</a>";
        }       
    }
    echo $total.$sep.$listNum.$sep.$pageGoto.$sep.$index.$sep.$prev.$sep.$p.$sep.$next.$sep.$last;
    
}
 

