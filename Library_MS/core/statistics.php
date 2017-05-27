<?php

/**网站访问量加一
 * 
 */
function addVisited(){
    $sql = "UPDATE statistics SET visited=visited+1";
    mysqli_query($_SESSION['link'],$sql);
}


/**注册用户数量加一
 * 
 */
function addUserNum(){
    $sql = "UPDATE statistics SET registers=registers+1";
    mysqli_query($_SESSION['link'],$sql);
}




