<?php
require_once '../include.php';
@$act = $_REQUEST['act'];
@$id = $_REQUEST['id'];
@$page = $_REQUEST['page'];
/* $username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email']; */
$getInfo = $_POST;
if($act=="logout"){
    logout();
}elseif($act=="login_manager"){
    login_manager();
}elseif($act=="addAdmin"){
    addAdmin();
}elseif($act=="modifyAdmin"){
    header("location:modifyAdmin.php?id=".$id);
}elseif($act=="alterAdmin"){   
    alterAdmin($id,$getInfo);
}elseif($act=="deleteAdmin"){
   deleteAdmin($id);
}elseif($act=="addCate"){
    addCate();
}elseif($act=="modifyCate"){
    header("location:modifyCate.php?id=".$id);
}elseif($act=="alterCate"){
    alterCate($id,$getInfo); 
}elseif($act=="deleteCate"){
    deleteCate($id);
}elseif($act=="addPro"){
    addPro(); 
}elseif($act=="modifyPro"){
    alterPro($id);
}elseif($act=="delPro"){
    delPro($id,$page);
}elseif($act=="regist"){
    regist();
}elseif($act=="addUser"){
    addUser(); 
}elseif($act=="modifyUser"){
    alterUser($id); 
}elseif($act=="delUser"){
    delUser($id);
}elseif($act=="login_user"){
    login_user(); 
}elseif($act=="logout_user"){
    logout_user();
}elseif($act=="addWaterText"){
    doAddWaterText($id); 
}elseif($act=="addWaterPic"){
    doAddWaterPic($id); 
}




