<?php
require_once '../include.php';

@$admin = $_POST['admin'];
@$author = $_POST['author'];
@$press = $_POST['press'];
@$user = $_POST['user'];
@$studentNum = $_POST['studentNum'];
@$studentName = $_POST['studentName'];
@$bookNum = $_POST['bookNum'];
@$bookName = $_POST['bookName'];

@$password = $_POST['password'];
@$email = $_POST['email'];
@$phone = $_POST['phone'];
@$age = $_POST['age'];
@$sex = $_POST['sex'];
@$academy = $_POST['school'];
@$quantity = $_POST['quantity'];
@$author_id = $_POST['author_id'];
@$press_id = $_POST['press_id'];

@$id = $_GET['id'];
@$act = $_GET['act'];

if(@$_SESSION['ADMINname']){
    switch($act){
        case 'addadmin':
            addNewLog("添加管理员:".$admin);
            addadmin($admin,$password,$email,$phone);
           // alertMes("管理员有啥好的，吃力不讨好，快看书去别闹", "../index.php");
            break;
        case 'deleteAdmin':
            addNewLog("删除管理员:".$id);
            deleteAdmin($id);
            //alertMes("快看书去别闹", "../index.php");
            break;
        case 'modifyAdmin':
            addNewLog("修改管理员信息:".$id."/".$admin);
            modifyAdmin($id,$admin,$password,$email,$phone);
            //alertMes("快看书去别闹", "../index.php");
            break;
        case 'addauthor':
            addNewLog("添加作者:".$author);
            addauthor($author,$email,$phone);
            break;
        case 'modifyAuthor':
            addNewLog("修改作者信息:".$id."/".$author);
            modifyAuthor($id,$author,$email,$phone);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deleteAuthor':
            addNewLog("删除作者:".$id);
            deleteAuthor($id);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addpress':
            addNewLog("添加出版社:".$press);
            addpress($press,$email,$phone);
            break;
        case 'modifyPress':
            modifyPress($id,$press,$email,$phone);
            addNewLog("修改出版社信息:".$id."/".$press);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deletePress':
            deletePress($id);
            addNewLog("删除出版社:".$id);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addUser':
            addUser($user,$password,$email,$phone);
            addNewLog("添加用户:".$user);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'modifyUser':
            modifyUser($id,$user,$password,$email,$phone);
            addNewLog("修改用户信息:".$id."/".$user);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deleteUser':
            deleteUser($id);
            addNewLog("删除用户:".$id);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addStudent':
            addNewLog("添加学生信息:".$studentNum."/".$studentName);
            addStudent($studentNum,$studentName,$sex,$age,$academy);
            break;
        case 'modifyStudent':
            addNewLog("修改学生信息:".$studentNum."/".$studentName);
            modifyStudent($id,$studentNum,$studentName,$sex,$age,$academy);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deleteStudent':
            addNewLog("删除学生信息:".$id);
            deleteStudent($id);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addBooks':
            addNewLog("添加图书:".$bookName."/数量:".$quantity);
            addBooks($bookName,$author_id,$press_id,$quantity);
            break;
        case 'modifyBooks':
            addNewLog("修改图书信息:".$id."/".$bookName);
            modifyBooks($id,$bookName,$author_id,$press_id,$quantity);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deleteBook':
            deleteBook($id);
            addNewLog("删除图书:".$id);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addHistory':
            addNewLog("借阅图书:".$studentNum."/".$bookNum);
            addHistory($studentNum,$password,$bookNum);
            break;
        case 'modifyHistory':
            addNewLog("修改借阅历史:".$id."/".$studentNum."/".$bookNum);
            //alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            modifyHistory($id,$studentNum,$bookNum);
            break;
        case 'returnBook':
            addNewLog("还书:".$id);
            returnBook($id);
            //alertMes("通知书的主人去跟管理员确认下就行，统一让管理员处理", "../index.php");
            break;
            
        default:break;
    }
}elseif($_SESSION['username']){
    switch($act){
        case 'addadmin':
            //addadmin($admin,$password,$email,$phone);
            addNewLog("尝试添加管理员");
            alertMes("管理员有啥好的，吃力不讨好，快看书去别闹", "../index.php");
            break;
        case 'deleteAdmin':
            //deleteAdmin($id);
            addNewLog("尝试删除管理员");
            alertMes("快看书去别闹", "../index.php");
            break;
        case 'modifyAdmin':
            //modifyAdmin($id,$admin,$password,$email,$phone);
            addNewLog("尝试修改管理员信息");
            alertMes("快看书去别闹", "../index.php");
            break;
        case 'addauthor':
            addNewLog("添加作者:".$author);
            addauthor($author,$email,$phone);
            break;
        case 'modifyAuthor':
            //modifyAuthor($id,$author,$email,$phone);
            addNewLog("尝试修改作者信息");
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deleteAuthor':
            //deleteAuthor($id);
            addNewLog("尝试删除作者");
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addpress':
            addNewLog("添加出版社:".$press);
            addpress($press,$email,$phone);
            break;
        case 'modifyPress':
            //modifyPress($id,$press,$email,$phone);
            addNewLog("尝试修改出版社信息:".$id."/".$press);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deletePress':
            //deletePress($id);
            addNewLog("尝试删除出版社:".$id);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addUser':
            //addUser($user,$password,$email,$phone);
            addNewLog("尝试添加用户:".$user);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'modifyUser':
            //modifyUser($id,$user,$password,$email,$phone);
            addNewLog("尝试修改用户信息:".$id."/".$user);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deleteUser':
            //deleteUser($id);
            addNewLog("尝试删除用户:".$id);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addStudent':
            addNewLog("添加学生信息:".$studentNum."/".$studentName);
            addStudent($studentNum,$studentName,$sex,$age,$academy);
            break;
        case 'modifyStudent':
            //modifyStudent($id,$studentNum,$studentName,$sex,$age,$academy);
            addNewLog("尝试修改学生信息:".$studentNum."/".$studentName);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deleteStudent':
            //deleteStudent($id);
            addNewLog("尝试删除学生信息:".$id);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addBooks':
            addNewLog("添加图书:".$bookName."/数量:".$quantity);
            addBooks($bookName,$author_id,$press_id,$quantity);
            break;
        case 'modifyBooks':
            //modifyBooks($id,$bookName,$author_id,$press_id,$quantity);
            addNewLog("尝试修改图书信息:".$id."/".$bookName);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'deleteBook':
            //deleteBook($id);
            addNewLog("尝试删除图书:".$id);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            break;
        case 'addHistory':
            addNewLog("借阅图书:".$studentNum."/".$bookNum);
            addHistory($studentNum,$password,$bookNum);
            break;
        case 'modifyHistory':
            addNewLog("尝试修改借阅历史:".$id."/".$studentNum."/".$bookNum);
            alertMes("信息错了么，重新添加吧，等管理员来删除", "../index.php");
            //modifyHistory($id,$studentNum,$bookNum);
            break;
        case 'returnBook':
            //returnBook($id);
            addNewLog("尝试还书:".$id);
            alertMes("通知书的主人去跟管理员确认下就行，统一让管理员处理", "../index.php");
            break;
    
        default:break;
    }
}


