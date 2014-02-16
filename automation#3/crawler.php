<?php
echo "GET Printed";
//function to Give the domain of any URL starts here------------//
function get_domain($url)
{
	$sourceUrl = parse_url($url);
	$sourceUrl = $sourceUrl['host'];
	return $sourceUrl;
}
//function to Give the domain of any URL ends here------------//

//----------function for file_get_content----------//
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
//------------function for file_get_content Ends here-------//
//--------------FUNCTION TO GIVE ALL INNER PAGES STARTS----//
//$CountVisitedUrl = 0;
function gettingInnerPage($url1, $VisitedUrl, $CountVisitedUrl)
{
$OriginalDomain = get_domain($url1); //getting domain of URL entered
$link=$url1;
$html = url_get_contents ($link); 
//$html = file_get_contents($link);
$dom = new DOMDocument();
@$dom->loadHTML($html);
// grab all the on the page
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");

for ($i = 0; $i < $hrefs->length; $i++ )
{
	$href = $hrefs->item($i);
	$url = $href->getAttribute('href');
	//echo $url.'<br />';
		$str2[$i]=$url; //str2 is the array with all the links---
		//echo $str2[$i];
		//echo "<BR>";
}
for ($append=0;$append<$i;$append++)
{
	$FirstChar = substr($str2[$append], 0, 1);
	if ($FirstChar == '/')
	{
		$str2[$append] = "http://" . $OriginalDomain . $str2[$append];
		//echo $str2[$append];
		//echo " <BR> ";
	}
	//echo $str2[$append];
	echo "<BR>";
}

$count = 0; 
//ECHO "THE DOMAIN NAME STARTS";
for ($j=0;$j<$i;$j++)
{
	//str2 is array with all the links of a website
	$UrlDomain = get_domain($str2[$j]);
	if ($UrlDomain == $OriginalDomain)
	{
		$InnerPages[$count]= $str2[$j];
		$count++;
	}
}
//echo $count;
for ($t=0;$t<$count;$t++)
{
	for ($s=0;$s<$CountVisitedUrl;$s++)
	{
		if ($InnerPages[$t] == $VisitedUrl[$s] )
		{
			continue;
		}
		else
		{
			$VisitedUrl[$CountVisitedUrl]=$InnerPages[$t];
			$CountVisitedUrl++;
			echo "<BR>";
			echo $CountVisitedUrl++;
			$VisitedUrl = gettingInnerPage ($InnerPages[$t], $VisitedUrl, $CountVisitedUrl);
		}
	}
}
return $VisitedUrl;
/**echo "hi" . $CountVisitedUrl;
//echo "<b>total number of links in the website are</b>:	" . $i;
echo "<BR>";
echo "<b>total number of inner pages in the website are</b>: " . $CountVisitedUrl;
echo "<BR>";
echo "<BR>";
for ($num=0;$num<$CountVisitedUrl;$num++)
{
	$seq = 0;
	$seq=$num+1;
	echo "$seq".".)	". $VisitedUrl[$num];
	echo "<BR>";
}*/
}

$url1= $_POST['url']; //URL recieved from crawler.html page
$CountVisitedUrl = 0;
$VisitedUrl[$CountVisitedUrl] = $url1; 
$CountVisitedUrl++;
$VisitedUrl=gettingInnerPage($url1, $VisitedUrl, $CountVisitedUrl);
echo "VISITED" . $VisitedUrl;
?>