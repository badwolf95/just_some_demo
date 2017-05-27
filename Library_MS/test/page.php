<?php
require_once '../include.php';

$pageNum = 0;
getPageCont('admin',$pageNum);
showPage($pageNum);

function getPageCont($table='admin',&$pageNum){
    $sql = "SELECT * FROM {$table}";
    $result = mysqli_query($_SESSION['link'],$sql);
    $allNum = mysqli_num_rows($result);
    if(@$_GET['pageSize']){
        @$_SESSION['pageSize'] = $_GET['pageSize'];
    }
    if(@$_SESSION['pageSize']){
        @$pageSize = $_SESSION['pageSize'];
    }else{
        $pageSize = 5;
    }
    $pageNum = ceil($allNum/$pageSize);
    
    if(@$_GET['page']<=0||!is_numeric($_GET['page'])){
        $_GET['page'] = 1;
    }elseif($_GET['page']>$pageNum){
        $_GET['page'] = $pageNum;
    }
    @$page = $_GET['page']?$_GET['page']:1;
    $offset = $pageSize * ($page-1);
    $sql2 = "SELECT * FROM {$table} limit {$offset},$pageSize ORDER BY id DESC";
    $rows = fetchAll($sql2);
    
    foreach($rows as $row){
        echo "id:".$row['id'];
        echo "<br/>admin:".$row['name'];
        echo "<br/>email:".$row['email'];
        echo "<br/>phone:".$row['phone'];
        echo "<hr />";
    }

}

function showPage($pageNum){
    $url = $_SERVER['PHP_SELF'];
    @$page = $_GET['page']?$_GET['page']:1;
    $show = "<span>共{$pageNum}页-这里是第{$page}页&nbsp;&nbsp;";
    $goto = "<form method='GET' action='{$url}'><span>跳转到第<input type='text' value='' name='page' class='goto'/>页 </span></form>";
    $showNum = "<form method='GET' action='{$url}'><span>每页显示<input type='text' value='' name='pageSize' class='pagecont'/>条记录</span></form><br/><br/>";
    
    $sep = "&nbsp;&nbsp;";
    $index = $page==1?"<span>首页</span>":"<a class='page_goto' href='{$url}?page=1'>首页</a>";
    $pre = $page==1?"<span>上一页</span>":"<a class='page_goto' href='{$url}?page=".($page-1)."'>上一页</a>";
    $next = $page==$pageNum?"<span>下一页</span>":"<a class='page_goto' href='{$url}?page=".($page+1)."'>下一页</a>";
    $last = $page==$pageNum?"<span>末页</span>":"<a class='page_goto' href='{$url}?page={$pageNum}'>末页</a>";
    
    for($i=1;$i<=$pageNum;$i++){
        if($page==$i){
            $pages[$i] = "<span>{$i}</span>";
        }else{
            $pages[$i] = "<a class='page_btn' href='{$url}?page={$i}'>{$i}</a>";
        }
    }
    
    echo $show.$goto.$showNum.$index.$sep.$pre.$sep;
    foreach($pages as $page){
        echo $page;
        echo $sep;
    }
    echo $sep.$next.$sep.$last;
}






