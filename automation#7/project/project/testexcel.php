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




//$objReader = PHPExcel_IOFactory::createReader('Excel2007');
//$objReader->setReadDataOnly(true);

//$objPHPExcel = $objReader->load("updatedfile.xlsx");
$objWorksheet = $objPHPExcel->getActiveSheet();

$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

echo '<table>' . "\n";
for ($row = 0; $row < $highestRow; ++$row) 
{
	$count=0;
	echo '<tr>' . "\n";
	//echo $highestColumnIndex;
	//$keywords[$row]= . $objWorksheet->getCellByColumnAndRow($col, $row)->getValue() .;
	for ($col = 0; $col < $highestColumnIndex; ++$col) 
	{
		echo '<td>' . $objWorksheet->getCellByColumnAndRow($col, $row)->getValue() . '</td>' . "\n";
		$excel_sheet[$row][$col]= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
		$count=$count+1;
		
	}
	$total_number_of_child[$row]=$count-1;
	echo $total_number_of_child[$row];
	//$count=0;
	echo '</tr>' . "\n";
}
echo '</table>' . "\n";
$total_number_of_keywords=$row-1;
echo $total_number_of_keywords;

for ($p=0;$p<$highestRow;$p++)
{
	for ($q=0;$q<$highestColumnIndex;$q++)
	{
		echo $excel_sheet[$p][$q];
	}
}

?>
