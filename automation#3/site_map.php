<?php

function url_get_contents ($Url) 
{
    /**if (!function_exists('curl_init'))
	{ 
        die('CURL is not installed!');
    }*/
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function get_domain($url)
{
	$sourceUrl = parse_url($url);
	$sourceUrl = $sourceUrl['host'];
	return $sourceUrl;
}

$Url=$_POST['url'];
$OriginalDomain = get_domain($Url);
$html = url_get_contents ($Url); 
$dom = new DOMDocument();
@$dom->loadHTML($html);
// grab all the on the page
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");
echo "echo";
for ($i = 0; $i < $hrefs->length; $i++ )
{
	$href = $hrefs->item($i);
	$url = $href->getAttribute('href');
	//echo $url.'<br />';
		$str2[$i]=$url; //str2 is the array with all the links---
		//echo "$i+1" . ".)	" . $str2[$i];
		//echo "<BR>";
}
for ($append=0;$append<$i;$append++)
{
	$FirstChar = substr($str2[$append], 0, 1);
	if ($FirstChar == '/' || $FirstChar == '#' )
	{
		else if ($FirstChar == '.')
		{
			$str2[$append] = substr($str, 3);
			$str2[$append] = "https://" . $OriginalDomain . $str2[$append];
		}
		$str2[$append] = "https://" . $OriginalDomain . $str2[$append];
		//echo $str2[$append];
		//echo " <BR> ";
	}
	//echo $str2[$append];
	$seq = $append+1; 
	echo "$seq" . ".)	" . $str2[$append];
	echo "<BR>";
}


//----got list of internal pages------------//
?>