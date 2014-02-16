<?

function url_to_text ($url)
{
$url1 = $url;
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
chdir('dir');
$file = "file" . ((int) microtime(true)) . ".txt";
file_put_contents($file, strip_tags($content));
return strip_tags($content);
//return $content;
}

$con = new mysqli("localhost", "root", "12345", "archived_links");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM link");

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

mysqli_close($con);

for ($y=0;$y<$z;$y++)
{
	
}

//--------------------------------------------------------
function dirCount($dir) {
  $x = 0;
  while (($file = readdir($dir)) !== false) 
  {
    if (isImage($file))
	{
		$x = $x + 1;
	}
  }
  return $x;
}
 
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

$new_dir=getFilesFromDir($dir);
$num = dircount('C:\wamp\wamp\www\dir');	//getting he number of files in dir let it be new_dir_num

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
$old_dir_num = $num;
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