<?php 
/* 
 * mrlemonade ~ 
 */ 
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

// Usage 
$dir = 'C:\wamp\wamp\www\dir'; 
$foo = getFilesFromDir($dir); 
$old_dir=$foo;
//echo $foo[0];
//echo $foo[1];
//print_r($foo); 

//running the script after every 60 min

$interval=60; //minutes
set_time_limit(0);
while (true)
{
$now=time();
include("time.php");

sleep($interval*60-(time()-$now));
}
?>