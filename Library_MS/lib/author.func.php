<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

/**添加作者
 * @param string $author
 * @param string $email
 * @param string $phone
 */
function addauthor($author,$email,$phone){
    $sql = "INSERT author(name,email,phone) VALUES('{$author}','{$email}','{$phone}')";
    if(insert($sql)){
        header("location:../author.php");
    }else{
        alertMes('添加失败，请联系程序猿处理BUG','addauthor.php');
    } 
}

/**获取所有作者
 * 
 */
function getAllAuthor(){
    $sql = "SELECT * FROM author";
    $result = fetchAll($sql);
    //var_dump($result);
    return $result;
}

/**通过ID获取作者信息
 * @param int $id
 */
function getAuthorById($id){
    $sql = "SELECT * FROM author WHERE id={$id}";
    $result = fetchOne($sql);
    return $result;
}

/**更新作者信息
 * @param int $id
 * @param string $author
 * @param string $email
 * @param string $phone
 */
function modifyAuthor($id,$author,$email,$phone){
    $sql = "UPDATE author SET name='{$author}',email='{$email}' ,phone='{$phone}' WHERE id='{$id}'";
    var_dump($sql);
    if(mysqli_query($_SESSION['link'],$sql)){
        header("location:../author.php");
    }else{
        alertMes('更新失败，请联系程序猿debug','../author.php');
    }
}

/**删除作者
 * @param int $id
 */
function deleteAuthor($id){
    $sql = "DELETE FROM author WHERE id='{$id}'";
    if(mysqli_query($_SESSION['link'],$sql)){
        header("location:../author.php");
    }else{
        alertMes('删除失败咯，找程序猿','../author.php');
    }
}








