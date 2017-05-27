<?php 

$dir = dirname(__FILE__);
require_once $dir.'/phpexcel/phpexcel.php';

$excelObj = new PHPExcel();
$sheetObj = $excelObj->getActiveSheet();
$sheetObj->setTitle('demo');
$sheetObj->setCellValue('A1','姓名')->setCellValue('B1','分数');
$sheetObj->setCellValue('A2','小明')->setCellValue('B2','90');
$sheetObj->setCellValue('A3','小白')->setCellValue('B3','60');
$sheetObj->setCellValue('A4','小红')->setCellValue('B4','40');
$sheetObj->setCellValue('A5','小红')->setCellValue('B5','40');
$sheetObj->setCellValue('A6','小红')->setCellValue('B6','40');


$objWriter = PHPExcel_IOFactory::createWriter($excelObj,'Excel2007');
$objWriter -> save($dir.'/de3.xlsx');