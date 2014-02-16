<?php
echo "hello1";
$con = new mysqli("localhost", "root", "12345", "archived_links");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM archived_links");

echo "<table border='1'>
<tr>
<th>links</th>

</tr>";
$z=0;
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['link'] . "</td>";
  $archived_link_array[$z]=$row['link'];
  $z++;
  //echo "<td>" . $row['LastName'] . "</td>";
  echo "</tr>";
  }
//echo "</table>";
$num_of_links = $z;
echo $num_of_links;
//echo "number of links" . $num__of_links;
echo "</br>";
mysqli_close($con);
//$new_archived_link_array= $archived_link_array;
$num_of_files=iterator_count(new DirectoryIterator('C:\wamp\wamp\www\dir'));
$num_of_files = $num_of_files - 2;
echo "number of files in the folder" . $num_of_files;
echo "</br>";
if ($num_of_links > $num_of_files)
{
$files = glob('C:\wamp\wamp\www\dir\*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
for ($y=0;$y<$z;$y++)
{

	//url_to_text ( $archived_link_array[$z]);
	$url1 =$archived_link_array[$y];
	//echo $url1;
	//$content = file_get_contents('http://web.archive.org/web/20130404020443/http://www.stanleyblock.net/');
	$content = file_get_contents($url1);
	$content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/si', "", $content);
	$regex = array(
	"`^([\t\s]+)`ism"=>'',
	"`^\/\*(.+?)\*\/`ism"=>"",
	"`([\n\A;]+)\/\*(.+?)\*\/`ism"=>"$1",
	"`([\n\A;\s]+)//(.+?)[\n\r]`ism"=>"$1\n",
	"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism"=>"\n"
	);

	$content = preg_replace(array_keys($regex),$regex,$content);
	$content = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $content);
	$content = preg_replace('/&nbsp/', "", $content);
	//$directory= "C:\wamp\wamp\www\dir";
	//chdir('dir');
	$file = "C:\wamp\wamp\www\dir\file" . ((int) microtime(true)) . ".txt";
	//$fp = fopen($directory.$file, "w");
	file_put_contents($file, strip_tags($content));
	//echo strip_tags($content);
	//return $content;
	
}
}
else
{
echo "no new links have been added in the archived database";
}

//$old_num=$z;

//--------------------------------------------------------

/**function dirCount($dir) {
  $x = 0;
  while (($file = readdir($dir)) !== false) 
  {
    if (isImage($file))
	{
		$x = $x + 1;
	}
  }
  return $x;
}*/
 
function getFilesFromDir($dir) { 

  $files = array(); 
  if ($handle = opendir($dir)) { 
    while (false !== ($file = readdir($handle))) { 
        if ($file != "." && $file != "..") { 
            if(is_dir($dir.'/'.$file)) { 
                $dir2 = $dir.'/'.$file; 
                $files[] = getFilesFromDir($dir2); 
            } 
            else { 
              $files[] = $dir.'/'.$file; 
            } 
        } 
    } 
    closedir($handle); 
  } 

  return array_flat($files); 
} 

function array_flat($array) { 

  foreach($array as $a) { 
    if(is_array($a)) { 
      $tmp = array_merge($tmp, array_flat($a)); 
    } 
    else { 
      $tmp[] = $a; 
    } 
  } 

  return $tmp; 
} 

$dir='C:\wamp\wamp\www\dir';
//$dir = 'C:\wamp\wamp\www\dir';
$new_dir=getFilesFromDir($dir);
echo $new_dir[0];
// abhi $num = dircount('C:\wamp\wamp\www\dir');	//getting he number of files in dir let it be new_dir_num
$num=iterator_count(new DirectoryIterator('C:\wamp\wamp\www\dir'));
$num=$num-2;
//$old_dir_num = $num;
//echo $num;
echo "the num" . $num;
echo "</br>";
echo $new_dir[1];
for ($p = 0; $p < $num ;  $p++)
{
	echo $p;
	echo "hello";
	echo $new_dir[$p];
	echo "</br>";
	$file1=fopen("$new_dir[$p]","r") or exit("Unable to open file!");
	while (!feof($file1))
	{
		echo fgetc($file1);
	}
	fclose($file1);
	//$file = file_get_contents('./$new_dir[$p]',true);
	//echo $file;
	echo "</br>";
}
/**
for ($chk=0;$chk<$num;$chk++)
{
	for ($old_chk=0;$old_chk<$old_dir_num;$old_chk++)
	{
		if ($new_dir[$chk] == $old_dir[$old_chk])
		{
			continue;
		}
		else
		{
			$file = file_get_contents('./$new_dir[$chk].txt', true); // contents from text file
			echo $file;//read the file display on the webpage
		}
	}
}
$old_dir=$new_dir;
*/

// fetching the links to be pushed

$con = new mysqli("localhost", "root", "12345", "links");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM link");

echo "<table border='1'>
<tr>
<th>links</th>

</tr>";
$i=0;

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['link'] . "</td>";
  $link_array[$i]=$row['link'];
  $i++;
  //echo "<td>" . $row['LastName'] . "</td>";
  echo "</tr>";
  }
//echo "</table>";

mysqli_close($con);

for ($j=0;$j<$i;$j++)
{
	//echo $link_array[$j];
	Echo "<a href=$link_array[$j]>$link_array[$j]</a>" ;
	//echo $j;
} 
?>