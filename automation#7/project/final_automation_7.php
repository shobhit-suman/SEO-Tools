<?php
echo "<marquee>code with internal linking part has some bug still working with that</marquee>";
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
		$child_name[$row][$col]= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
		$count=$count+1;
		
	}
	$total_number_of_child[$row]=$count-1;
	$total_child=$count-1;
	//echo $total_number_of_child[$row];
	//$count=0;
	echo '</tr>' . "\n";
}
echo '</table>' . "\n";
$total_number_of_keywords=$row-1;
//echo $total_number_of_keywords;

/**for ($p=0;$p<$highestRow;$p++)
{
	for ($q=0;$q<$highestColumnIndex;$q++)
	{
		//echo $child_name[$p][$q];
	}
}*/


$zero=0;


for ($k=0;$k<$total_number_of_keywords;$k++)
{
	echo "</br>";
	$link_name = $child_name[$k+1][$zero];
	$fp[$k] = fopen("$link_name.html", 'w');
	
	//fwrite($fp[$k], '"<a href=http://google.co.in>23</a>"');
	fclose($fp[$k]);
}
/**
for ($m=0;$m<$total_number_of_keywords;$m++)
{
	$link_name = $child_name[$m+1][$zero];
	$fp1[$m] = fopen("$link_name.html", 'w');
	for ($l=0;$l<$total_child;$l++)
	{
		fwrite($fp1[$l], '"<a href=C:\wamp\wamp\www\"child_name[$m+1][$l+1]">"$child_name[$m+1][$l+1]"</a>"');
	}
	//fwrite($fp[$k], '"<a href=http://google.co.in>23</a>"');
	fclose($fp[$m]);
}*/

?>
