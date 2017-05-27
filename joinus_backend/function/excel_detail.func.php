<?php 

$link = mysqli_connect('localhost','root','online@mysql113','joinus') or die("数据库连接失败");
mysqli_set_charset($link,"UTF8");

$sql = "select * from enroll_from order by theGroup desc,id desc";
$res = mysqli_query($link,$sql);

$data = array();
while($r = mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$data[]  = $r;
}


$dir = dirname(dirname(__FILE__));
require_once $dir.'/PHPExcel/PHPExcel.php';

$excelObj = new PHPExcel();
$sheetObj = $excelObj -> getActiveSheet();
$sheetObj -> setTitle('详情');
$sheetObj -> setCellValue('B2','姓名')-> setCellValue('C2','性别')-> setCellValue('D2','学院年级')-> setCellValue('E2','QQ')-> setCellValue('F2','联系电话')-> setCellValue('G2','组别')-> setCellValue('H2','简介');
$s = array('A','B','C','D','E','F','G','H');
$kk = array('id','name','gender','college','qqNumber','mobilePhone','theGroup','resume');
$j = 3;
foreach($data as $d){
	for($i=1;$i<8;$i++){
		$key = $s[$i].$j;
		$val = $d[$kk[$i]];
		$sheetObj -> setCellValue($key,$val);
	}
	$j++;
}

$file = $dir.'/detail.xlsx';
if(file_exists('/detail.xlsx')){
	unlink('/detail.xlsx');
}
$objWriter = PHPExcel_IOFactory::createWriter($excelObj,'Excel2007');
$objWriter -> save($dir.'/detail.xlsx');
return $file;

