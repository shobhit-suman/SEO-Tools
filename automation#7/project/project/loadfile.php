<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');
$fileType = 'Excel5';
/** Include PHPExcel_IOFactory */
require_once '../Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("updatedfile.xls");

$key=$_POST["keyword"];
$rank=$_POST["rank"];
$volu=$_POST["volume"];
	for($row=1;$row<=10;$row++)
{



if(!strcmp($objPHPExcel->setActiveSheetIndex(0)
->getCellByColumnAndRow(0,$row)->getValue(),$key))
{
$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow(1,$row,$rank)
->setCellValueByColumnAndRow(2,$row,$volu);
}

}

// Write the file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
$objWriter->save("updatedfile.xls");
?>