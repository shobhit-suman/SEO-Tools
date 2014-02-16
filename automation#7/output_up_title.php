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
	//$total_number_of_child=$count-1;
	//$total_child[$row]=$count-1;
	//echo $total_number_of_child[$row];
	//$count=0;
	echo '</tr>' . "\n";
}
//$total_child=$total_number_of_child;
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
echo "-----------------------------";
for ($check=0;$check<$total_number_of_keywords;$check++)
{
	echo $child_name[$check+1][1];
}




for ($k=0;$k<$total_number_of_keywords;$k++)
{
	echo "</br>";
	$link_name[$k] = $child_name[$k+1][$zero];
	//echo $child_name[$k+1][$zero];
	$fp[$k] = fopen("$link_name[$k].html", 'w');
	
	//fwrite($fp[$k], '<a href=http://google.co.in>http://google.co.in</a>');
	fclose($fp[$k]);
}
//echo $child_name[1][0];
echo $child_name[2][$zero];
echo "hi" . $child_name[2][1];
echo $total_number_of_keywords;
for ($m=0;$m<$total_number_of_keywords-1;$m++)
{
	//echo "hahaha" . $child_name[$m+1][$zero];
	$link_name[$m] = $child_name[$m+2][$zero];
	
	//echo $link_name[$m];
	$fp1[$m] = fopen("$link_name[$m].html", 'w+');
	for ($l=0;$l<$child_name[$m+2][1];$l++) //total number of child
	{
		$child_name[$m+2][$l+2]=$child_name[$m+2][$l+2].'.html';
		fwrite($fp1[$m], '<a href=C:/wamp/wamp/www/project/'.$child_name[$m+2][$l+2].'>'.$child_name[$m+2][$l+2].'</a>');
		fwrite($fp1[$m], '<br>');
	}
	//fwrite($fp[$k], '"<a href=http://google.co.in>23</a>"');
	fclose($fp1[$m]);

}
?>
