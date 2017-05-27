<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

/**获取本页的内容
 * @param string $table
 * @param int $pageNum
 */
function getPageCont($table='admin',&$pageNum,&$pageSize=0,&$page=5,&$allNum=0){
    $sql = "SELECT * FROM {$table}";
    $result = mysqli_query($_SESSION['link'],$sql);
    $allNum = mysqli_num_rows($result);
    if(@$_GET['pageSize']){
        if($_GET['pageSize']<0||!is_numeric($_GET['pageSize'])){
            @$_SESSION['pageSize'] = 1;
        }elseif($_GET['pageSize']>$allNum){
            $_SESSION['pageSize']=$allNum;
        }else{
            @$_SESSION['pageSize'] = $_GET['pageSize'];
        }
    }
    if(@$_SESSION['pageSize']){
        @$pageSize = $_SESSION['pageSize'];
    }else{
        $pageSize = 5;
    }
    $pageNum = ceil($allNum/$pageSize);

    if(@$_GET['page']<=0||!is_numeric($_GET['page'])){
        $page = 1;
    }elseif($_GET['page']>$pageNum){
        $page = $pageNum;
    }else{  
        $page = $_GET['page'];
    }
    
    $offset = $pageSize * ($page-1);
    $sql2 = "SELECT * FROM {$table} ORDER BY id DESC limit {$offset},$pageSize ";
    $rows = fetchAll($sql2);
    return $rows;
}

/**显示分页按钮
 * @param int $pageNum
 */
function showPage($pageNum,$page,$pageSize,$allNum){
    @$where = $_GET['search']?"search={$_GET['search']}":null;
    if($where!=null){
        $where = @$_GET['enquire']?$where."&enquire={$_GET['enquire']}":$where;
    }
    $url = $_SERVER['PHP_SELF'];
    $show = "<span>共{$allNum}条记录&nbsp;&nbsp;&nbsp;</span>";
    $goto = "<form method='get' action='{$url}?{$where}' class='inlineForm' ><span>跳转到第</span><input type='text' placeholder='{$page}' name='page' class='goto'/><span>页 </span></form>&nbsp;&nbsp;&nbsp;";
    $showNum = "<form method='get' action='{$url}?{$where}' class='inlineForm' ><span>每页显示<input type='text' placeholder='{$pageSize}' name='pageSize' class='pagecont'/>条记录</span></form><br/><br/>";

    $sep = "&nbsp;&nbsp;";
    $index = $page==1?"<span>首页</span>":"<a class='page_goto' href='{$url}?page=1&{$where}'>首页</a>";
    $pre = $page==1?"<span>上一页</span>":"<a class='page_goto' href='{$url}?page=".($page-1)."&{$where}'>上一页</a>";
    $next = $page==$pageNum?"<span>下一页</span>":"<a class='page_goto' href='{$url}?page=".($page+1)."&{$where}'>下一页</a>";
    $last = $page==$pageNum?"<span>末页</span>":"<a class='page_goto' href='{$url}?page={$pageNum}&{$where}'>末页</a>";

    for($i=1;$i<=$pageNum;$i++){
        if($page==$i){
            $pages[$i-1] = "<span>{$i}</span>";
        }else{
            $pages[$i-1] = "<a class='page_btn' href='{$url}?page={$i}&{$where}'>{$i}</a>";
        }
    }
    if(@$pages){
        echo $show.$goto.$showNum.$index.$sep.$pre.$sep;
        foreach(@$pages as $page){
            echo $page;
            echo $sep;
        }
        echo $next.$sep.$last;
    }
}

