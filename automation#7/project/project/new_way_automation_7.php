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
$objWorksheet = $objPHPExcel->getActiveSheet();
$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

echo '<table>' . "\n";
for ($row = 0; $row < $highestRow; ++$row) 
{
	$count=0;
	echo '<tr>' . "\n";
	for ($col = 0; $col < $highestColumnIndex; ++$col) 
	{
		echo '<td>' . $objWorksheet->getCellByColumnAndRow($col, $row)->getValue() . '</td>' . "\n";
		$child_name[$row][$col]= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
		$count=$count+1;
		
	}
	echo '</tr>' . "\n";
}
echo '</table>' . "\n";
$total_number_of_keywords=$row-1;

$zero=0;
/**echo "-----------------------------";
for ($check=0;$check<$total_number_of_keywords;$check++)
{
	//echo $child_name[$check+1][0];
}*/

for ($k=0;$k<$total_number_of_keywords;$k++)
{
	if ( $child_name[$k+1][$zero]== NULL)
	{
		continue;
	}
	echo "</br>";
	$link_name[$k] = $child_name[$k+1][$zero];
	$fp[$k] = fopen("$link_name[$k].html", 'w');
	fclose($fp[$k]);
}

//echo $child_name[2][$zero];
//echo "hi" . $child_name[2][1];
//echo $total_number_of_keywords;
for ($m=0;$m<$total_number_of_keywords-1;$m++)
{
	
	$link_name[$m] = $child_name[$m+2][2];
	$fp1[$m] = fopen("$link_name[$m].html", 'w+');
	echo $child_name[$m+2][0];
	echo "---------";
	if ($child_name[$m+2][0]== NULL)
	{
		$child_link[$m]=$child_name[$m+2][1];
		$fp2[$m] = fopen("$child_link[$m].html", 'w+');
		fwrite($fp2[$m], '<h1>'.$child_name[$m][1].'</h1>');
	}
	else
	{
		$child_name[$m+2][$zero]=$child_name[$m+2][$zero].'.html';
		fwrite($fp1[$m], '<a href=C:/wamp/wamp/www/project/'.$child_name[$m+2][$zero].'>'.$child_name[$m+2][$zero].'</a>');
		fwrite($fp1[$m], '<br>');
	}
}
	/**if ($child_name[$m+2][1] == 0)
	{
		fwrite($fp1[$m], '<h1>'.$link_name[$m].'</h1>');
	}
	else 
	{
		for ($l=0;$l<$child_name[$m+2][1];$l++) //total number of child
		{
			$child_name[$m+2][$l+2]=$child_name[$m+2][$l+2].'.html';
			fwrite($fp1[$m], '<a href=C:/wamp/wamp/www/project/'.$child_name[$m+2][$l+2].'>'.$child_name[$m+2][$l+2].'</a>');
			fwrite($fp1[$m], '<br>');
		}
	}
	fclose($fp1[$m]);
} */
?>
