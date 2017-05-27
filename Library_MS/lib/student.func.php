<?php
require_once $_SERVER['DOCUMENT_ROOT'].'include.php';

/**添加学生
 * @param unknown $studentNum
 * @param unknown $studentName
 * @param unknown $sex
 * @param unknown $age
 * @param unknown $academy
 */
function addStudent($studentNum,$studentName,$sex,$age,$academy){
    $sql = "INSERT student(stu_index,name,sex,age,academy) VALUES('{$studentNum}','{$studentName}','{$sex}','{$age}','{$academy}')";
    if(insert($sql)){
        header("location:../student.php");
    }else{
        alertMes('代码有问题，算了别改了一边玩去吧','../student.php');
    }
}

/**
 * 获取所有学生
 */
function getAllStudent(){
    $sql = "SELECT * FROM student";
    $result = fetchAll($sql);
    return $result;
}

/**通过ID获取学生信息
 * @param unknown $id
 */
function getStudentById($id){
    $sql = "SELECT * FROM student WHERE id='{$id}'";
    return fetchOne($sql);
}

/**通过学号获取学生信息
 * @param unknown $stuId
 */
function getStudentByStuId($stuId){
    $sql = "SELECT * FROM student WHERE stu_index='{$stuId}'";
    return fetchOne($sql);
}

/**修改学生信息
 * @param int $id
 * @param string $studentNum
 * @param string $studentName
 * @param num $sex
 * @param string $age
 * @param string $academy
 */
function modifyStudent($id,$studentNum,$studentName,$sex,$age,$academy){
    $sql = "UPDATE student SET stu_index='{$studentNum}',name='{$studentName}',sex='{$sex}',age='{$age}',academy='{$academy}' WHERE id='{$id}'";
    if(mysqli_query($_SESSION['link'],$sql)){
        header("location:../student.php");
    }else{
        alertMes('又出错了，我也不知道咋办','../student.php');
    }
}

/**删除学生用户
 * @param string $id
 */
function deleteStudent($id){
    $sql = "DELETE FROM student WHERE id='{$id}'";
    if(mysqli_query($_SESSION['link'], $sql)){
        header('location:../student.php');
    }else{
        alertMes('程序又出错了，还让不让活了...','../student.php');
    }
}


/**返回借书次数
 * @param unknown $stu_id
 */
function showBorrowTime($stu_id){
    $sql = "SELECT * FROM barinfo WHERE stu_index='{$stu_id}'";
    $result = mysqli_query($_SESSION['link'],$sql);
    return mysqli_affected_rows($_SESSION['link']);
}

function showBadGuy($stuId){
    $sql = "SELECT * FROM barinfo WHERE stu_index='{$stuId}'";
    $result = fetchAll($sql);
    $bad = 0;
    if($result){
        foreach($result as $res){
            $limitTime = strtotime("+30 days",$res['borrowTime']);
            if($res['returnTime']==null&&time()>$limitTime){
                $bad++;
            }elseif($res['returnTime']&&$res['returnTime']>$limitTime){
                $bad++;
            }
        }
    }
    return $bad;
}









