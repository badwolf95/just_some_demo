<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

/**添加图书
 * @param string $bookName
 * @param int $author_id
 * @param int $press_id
 * @param int $quantity
 */
function addBooks($bookName,$author_id,$press_id,$quantity){
    $pubTime = time();
    $student = getStudentByStuId($_SESSION['username']);
    //$owner = $student['name'];
    //var_dump($student);exit;
    if($student){
        $sql = "INSERT books(bookname,author_id,press_id,pubTime,quantity,quantity_left,owner,reader) VALUES('{$bookName}','{$author_id}','{$press_id}','{$pubTime}','{$quantity}','{$quantity}','{$_SESSION['username']}','')";
        //var_dump($sql);
        if(insert($sql)){
            header("location:../books.php");
        }else{
            alertMes('看着办吧，反正我搞不定了', '../books.php');
        }
    }elseif($_SESSION['ADMINname']){
        $sql = "INSERT books(bookname,author_id,press_id,pubTime,quantity,quantity_left,owner,reader) VALUES('{$bookName}','{$author_id}','{$press_id}','{$pubTime}','{$quantity}','{$quantity}','{$_SESSION['ADMINname']}','')";
        //var_dump($sql);
        if(insert($sql)){
            header("location:../books.php");
        }else{
            alertMes('看着办吧，反正我搞不定了', '../books.php');
        }
    }else{
        alertMes("请先添加个人信+息，3Q","addstudent.php");
    }
}

/**获取所有书本
 * 
 */
function getAllBooks(){
    $sql = "SELECT * FROM books";
    $result = fetchAll($sql);
    return $result;
    
}

/**通过ID获取图书信息
 * @param unknown $id
 */
function getBookById($id){
    $sql = "SELECT * FROM books WHERE id='{$id}'";
    return fetchOne($sql);
}

/**更新图书信息
 * @param int $id
 * @param string $bookName
 * @param int $author_id
 * @param int $press_id
 * @param int $quantity
 */
function modifyBooks($id,$bookName,$author_id,$press_id,$quantity){
    $sql = "UPDATE books SET bookname='{$bookName}',author_id='{$author_id}',press_id='{$press_id}',quantity='{$quantity}' WHERE id='{$id}'";
    if(mysqli_query($_SESSION['link'],$sql)){
        header("location:../books.php");
    }else{
        alertMes('更新失败咯，真开心', '../books.php');
    }
}

/**删除图书
 * @param int $id
 */
function deleteBook($id){
    $sql = "DELETE FROM books WHERE id='{$id}'";
    if(mysqli_query($_SESSION['link'], $sql)){
        header("location:../books.php");
    }else{
        alertMes('有问题找程序猿', '../books.php');
    }
}

function borrowBook($id){
    $sql = "SELECT * FROM books WHERE id='{$id}'";
    $book = fetchOne($sql);
    if($book['quantity_left']<=0){
        alertMes('这本书已经被借光啦，下次早点咯', '../history.php');
    }else{
        $book['quantity_left'] = $book['quantity_left']-1;
        $num = $book['quantity_left'];
        $sql = "UPDATE books SET quantity_left='{$num}',reader='{$_SESSION['username']}'  WHERE id='{$id}'";
        if(mysqli_query($_SESSION['link'], $sql)){
            return true;
        }else{
            return false;        
        }
    }
}

/**还书，数量加一
 * @param unknown $id
 * @return boolean
 */
function book_return($id){
    $sql = "SELECT * FROM books WHERE id='{$id}'";
    $book = fetchOne($sql);
    $book['quantity_left'] = $book['quantity_left']+1;
    $num = $book['quantity_left'];
    $sql = "UPDATE books SET quantity_left='{$num}' WHERE id='{$id}'";
    if(mysqli_query($_SESSION['link'],$sql)){
        return true;
    }else{
        return false;
    }
}





