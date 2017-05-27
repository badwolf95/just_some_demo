<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

/**添加借阅历史
 * @param int $studentNum
 * @param int $bookNum
 */
function addHistory($studentNum,$password,$bookNum){
    $password = md5($password);
    $sql = "SELECT * FROM student WHERE stu_index='{$studentNum}'";
    $sql2 = "SELECT * FROM books WHERE id='{$bookNum}'";
    $sql3 = "SELECT * FROM users WHERE password='{$password}'";
    if(fetchOne($sql)&&fetchOne($sql2)&&fetchOne($sql3)){
        if(borrowBook($bookNum)){
            $borrowTime = time();
            $sql = "UPDATE books SET out_time=out_time+1 WHERE id='{$bookNum}'";
          //var_dump($sql);
          // var_dump(mysqli_query($_SESSION['link'],$sql));
           //exit;
            mysqli_query($_SESSION['link'],$sql);
            $sql = "INSERT barinfo(stu_index,book_index,borrowTime) VALUES('{$studentNum}','{$bookNum}','{$borrowTime}')";
            if(insert($sql)){
                header("location:../history.php"); 
            }else{
                alertMes('借阅失败,请找程序猿解决', '../history.php');
            }
        }else{
            alertMes('借阅失败,请找程序猿解决','../history.php');
        }
    }else{
        alertMes('借阅失败,确认学号、索书号、密码都正确', '../history.php');
    }
}

/**
 * 获取所有借阅信息
 */
function getAllHistoty(){
    $sql = "SELECT * FROM barinfo";
    return fetchAll($sql);
}

/**通过ID获取历史记录
 * @param int $id
 */
function getHistoryById($id){
    $sql = "SELECT * FROM barinfo WHERE id='{$id}'";
    return fetchOne($sql);
}

/**修改借阅记录
 * @param int $id
 * @param int $studentNum
 * @param int $bookNum
 */
function  modifyHistory($id,$studentNum,$bookNum){
    $borrowTime = time();
    $sql = "UPDATE barinfo SET stu_index='{$studentNum}',book_index='{$bookNum}' WHERE id='{$id}'";
    if(mysqli_query($_SESSION['link'], $sql)){
        header("location:../history.php");
    }else{
        alertMes('修改失败，请联系攻城狮处理八阿哥', '../history.php');
    }
}

/**还书
 * @param int $id
 */
function returnBook($id){
    $sql = "SELECT * FROM barinfo WHERE id='{$id}'";
    $history = fetchOne($sql);
    $bookId = $history['book_index'];
    if(book_return($bookId)){ 
        $returnTime = time();
        $sql = "UPDATE barinfo SET returnTime='{$returnTime}' WHERE id='{$id}'";
        if(mysqli_query($_SESSION['link'],$sql)){
            alertMes('还书成功O(∩_∩)O~', '../history.php');
        }else{
            alertMes('出问题咯，请联系程序猿处理BUG','../history.php');
        }
    }else{
        alertMes("还书失败咯，联系程序猿找找BUG", '../history.php');
    }
}






