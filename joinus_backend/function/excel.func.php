<?php 

$dir = dirname(dirname(__FILE__));

require_once $dir.'/phpexcel/phpexcel.php';

$excelObj = new PHPExcel();
$sheetObj = $excelObj->getActiveSheet();
$sheetObj->setTitle('demo');

$row = $_POST['row'];

$head = $_POST['data'];
$body = $_POST['data2'];
// print_r($head);
// print_r($body);
$sheetObj->setCellValue('B1',$row);

$s = array('B','C','D','E','F','G','H');
for($i=0,$j=2;$i<count($head)-1;$i++){
	$key[$i] = $s[$i].$j;
	$val[$i] = $head[$i];
	$sheetObj->setCellValue($key[$i],$val[$i]);
}
for($i=0,$j=3,$k=0;$k<count($body);$i++,$k++){
	if($i == 4){continue;}
	if($i == 5){$i=0;$j++;}
	$key[$i] = $s[$i].$j;
	$val[$i] = $body[$k];
	$sheetObj->setCellValue($key[$i],$val[$i]);
}



$objWriter = PHPExcel_IOFactory::createWriter($excelObj,'Excel2007');
if(file_exists('/show.xlsx')){
	unlink('/show.xlsx');
}


$objWriter -> save($dir.'/show.xlsx');
return $dir.'/show.xlsx';
