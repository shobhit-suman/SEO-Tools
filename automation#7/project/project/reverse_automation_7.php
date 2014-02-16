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
//echo "-----------------------------";
for ($check=0;$check<$total_number_of_keywords;$check++)
{
	$keyword[$check] = $child_name[$check+1][0];
	$parent[$check] = $child_name[$check+1][1];
	echo "</br>";
}

$leaf = array_merge(array_diff($keyword, $parent));
//echo "leaf";
$end_of_array_leaf = end($leaf);
$string1= $end_of_array_leaf;
$count=0;
for ($z=0; ;$z++)
{
	echo $leaf[$z];
	$string[$z]=$leaf[$z];
	if ($string[$z] == $string1)
	{
		BREAK;
	}
}
echo "z".$z;
$number_of_leaves=$z;
for ($k=0;$k<$total_number_of_keywords;$k++)
{
	echo "</br>";
	$link_name[$k] = $child_name[$k+1][0];	
	$fp[$k] = fopen("$link_name[$k].html", 'w');
	//fwrite($fp[$k], '<title>'.$link_name[$k].'');
	//fwrite($fp[$k], '<a href=http://google.co.in>http://google.co.in</a>');
	fclose($fp[$k]);
}
$string1="NA";
for ($m=0;$m<$total_number_of_keywords-1;$m++)
{	
		$string[$m]=$child_name[$m+2][1];
		if ($string1 == $string[$m])
		{
			continue;
		}
		else
		{
			$link_name1[$m] = $child_name[$m+2][1];
			$fp1[$m] = fopen("$link_name1[$m].html", 'a');
			$child_name[$m+2][0]=$child_name[$m+2][0].'.html';
			fwrite($fp1[$m], '<a href=C:/wamp/wamp/www/project/'.$child_name[$m+2][0].'>'.$child_name[$m+2][0].'</a>');
			fwrite($fp1[$m], '<br>');
			fwrite($fp1[$m], '<title>'.$link_name1[$m].'</title>');
			fwrite($fp1[$m],'<meta name="description" content="'.$child_name[$m+2][0].'">');
			fwrite($fp1[$m],'<meta name="keyword" content="'.$child_name[$m+2][0].'"/>');
			fclose($fp1[$m]);
		}
}
		//fwrite($fp[$k], '"<a href=http://google.co.in>23</a>"');

		echo "number_of_leaves" . $number_of_leaves;
		for ($y=0;$y<$number_of_leaves+1;$y++)
		{
			$link_name2[$y] = $leaf[$y];
			$fp2[$y] = fopen("$link_name2[$y].html", 'w+');
			//$child_name[$m+2][0]=$child_name[$m+2][0].'.html';
			fwrite($fp2[$y], '<h1>'.$leaf[$y].'</h1>');
			fwrite($fp2[$y], '<title>'.$link_name2[$y].'</title>');
			fwrite($fp2[$y],'<meta name="description" content="'.$child_name[$y+2][0].'">');
			fwrite($fp2[$y],'<meta name="keyword" content="'.$child_name[$y+2][0].'"/>');
			fclose($fp2[$y]);
		}	
?>
