<?php
echo "<h1><center> SITE'S INNER LINKING STRUCTURE </h1>";
//function to Give the domain of any URL starts here
function get_domain($url)
{
	$sourceUrl = parse_url($url);
	$sourceUrl = $sourceUrl['host'];
	return $sourceUrl;
}
//function to Give the domain of any URL ends here------------//

$url1= $_POST['url']; //URL recieved from func.html page
$OriginalDomain = get_domain($url1); //getting domain of URL entered
//$page = 0; 
//$URL = "http://google.com/"; 
$link=$url1;
//function get_links($link) 

$html = file_get_contents($link);

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

$count = 0; 
for ($j=0;$j<$i;$j++)
{
	//$str2[$j] = substr($Links[$j], 6);
	//$str3[$j] = substr("$str2[$j]", 0, -1); //str3 is array with all the links of a website
	//echo $str3[$j];
	$UrlDomain = get_domain($str2[$j]);
	//echo "URL domains are as follows: ";
	//echo "<BR>";
	//echo $UrlDomain;
	//echo "<BR>";
	if ($UrlDomain == $OriginalDomain)
	{
		$InnerPages[$count]= $str2[$j];
		$count++;
	}
	$$UrlDomain = NULL;
	
	//echo "<BR>\n";
}
echo "<b>total number of links in the website are</b>:	" . $i;
echo "<BR>";
echo "<b>total number of inner pages in the website are</b>: " . $count;
echo "<BR>";
echo "<BR>";
for ($num=0;$num<$count;$num++)
{
	$seq = 0;
	$seq=$num+1;
	echo "$seq".".)	". $InnerPages[$num];
	echo "<BR>";
}
//}
// retrieve link destinations
function get_a_href($url2)
{
//echo "link came is" . $url2 . "this is the one";
$url2 = htmlentities(strip_tags($url2));

$ExplodeUrlInArray = explode('/',$url2);

$DomainName = $ExplodeUrlInArray[2];

$file = @file_get_contents($url2);

$h1count = preg_match_all('/(href=["|\'])(.*?)(["|\'])/i',$file,$patterns);

$linksInArray = $patterns[2];

$CountOfLinks = count($linksInArray);

$InternalLinkCount = 0;

$ExternalLinkCount = 0;

for($Counter=0;$Counter<$CountOfLinks;$Counter++)

{
	if($linksInArray[$Counter] == "" || $linksInArray[$Counter] == "#")
		continue;
	preg_match('/javascript:/', $linksInArray[$Counter],$CheckJavascriptLink);
	if($CheckJavascriptLink != NULL)
		continue;
	$Link = $linksInArray[$Counter];
	preg_match('/\?/', $linksInArray[$Counter],$CheckForArgumentsInUrl);
	if($CheckForArgumentsInUrl != NULL)
	{
		$ExplodeLink = explode('?',$linksInArray[$Counter]);
		$Link = $ExplodeLink[0];
	}
	preg_match('/'.$DomainName.'/',$Link,$Check);
	if($Check == NULL)
	{
		preg_match('/http:\/\//',$Link,$ExternalLinkCheck);
		if($ExternalLinkCheck == NULL)
		{
			$InternalDomainsInArray[$InternalLinkCount] = $Link;
			$InternalLinkCount++;
		}
		else
		{
			$ExternalDomainsInArray[$ExternalLinkCount] = $Link;
			$ExternalLinkCount++;
		}
	}
	else
	{
		$InternalDomainsInArray[$InternalLinkCount] = $Link;
		$InternalLinkCount++;
	}
}
$LinksResultsInArray = array(
'ExternalLinks'=>$ExternalDomainsInArray,
'InternalLinks'=>$InternalDomainsInArray
);
return $LinksResultsInArray;
}

function DisplayLinkInternalExternal($url3)
{
$DomainofInnerPage = get_domain($url3); 
//echo "the url3 is" . $url3;
$InternalLinkcount=0;
$ExternalLinkcount=0;
if(isset($_POST['submit']) && $_POST['submit'] == 'submit')
{
	$url3 = $url3;
	$linksInArray = get_a_href($url3);
	$CountOfExternalLink = count($linksInArray['ExternalLinks']);
	$CountOfInternalLink = count($linksInArray['InternalLinks']);
	echo "<h2>Linking structure for $url3 </h2>";
	if(!empty($linksInArray['ExternalLinks']))
	{
		echo "External Links found: (".$CountOfExternalLink.")<ul>";
		foreach($linksInArray['ExternalLinks'] as $key => $val)
		{
			$val = preg_replace("/</","<",$val);
			echo "<li>" . htmlentities($val) . "</li>";
			$ExternalLinksArray[$ExternalLinkcount] = htmlentities($val);
			$DomainofExternalLinksArray[$ExternalLinkcount] = get_domain($ExternalLinksArray[$ExternalLinkcount]);
			$ExternalLinkcount++;
		}
		echo "</ul>";
	}
	else
	{
		echo "<div class=\"error\">No External Links found</div>";

	}
	if(!empty($linksInArray['InternalLinks']))
	{
		echo "Internal Links found: (".$CountOfInternalLink.")<ul>";
		foreach($linksInArray['InternalLinks'] as $key => $val)
		{
			$val = preg_replace("/</","<",$val);
			echo "<li>" . htmlentities($val) . "</li>";
			$InternalLinksArray[$InternalLinkcount] = htmlentities($val);
			$DomainofInternalLinksArray[$InternalLinkcount] = get_domain($InternalLinksArray[$InternalLinkcount]);
			$InternalLinkcount++;
		}

		echo "</ul>";
	}
	else
	{
		echo "<div class=\"error\">No Internal Links found</div>";
	}
	$r=0;
	$p=0;
	for ($w=0;$w<$InternalLinkcount;$w++)
	{
		if ($DomainofInternalLinksArray[$w] == $DomainofInnerPage)
		{
			$InternalLinksFromSameDomain[$p]=$InternalLinksArray[$w];
			$p++;
		}
		else
		{
			$InternalLinksFromDiffDomain[$r]=$InternalLinksArray[$w];
			$r++;
		}
	}
	$e=0;
	$f=0;
	for ($v=0;$v<$ExternalLinkcount;$v++)
	{
		if ($DomainofExternalLinksArray[$v] == $DomainofInnerPage)
		{
			$ExternalLinksFromSameDomain[$f]=$ExternalLinksArray[$v];
			$f++;
		}
		else
		{
			$ExternalLinksFromDiffDomain[$e]=$ExternalLinksArray[$v];
			$e++;
		}
	}
	//printing the links
	echo "<BR>";
	echo "<B>Internal Links From Same Domain are:	</b>" . $p;
	echo "<BR>";

	for ($g=0;$g<$p;$g++)
	{
		$seq1 = $g+1;
		echo "$seq1". ".)	". $InternalLinksFromSameDomain[$g];
		echo "<BR>";
	}
	echo "<BR>";
	echo "<B>Internal Links From Different Domain are:	</B>" . $r;
	echo "<BR>";
	for ($h=0;$h<$r;$h++)
	{
		$seq2 = $h+1;
		echo "$seq2" . ".)	" . $InternalLinksFromDiffDomain[$h];
		echo "<BR>";
	}
	echo "<BR>";
	echo "<B>External Links From Same Domain are:	</B>" . $f;
	echo "<BR>";
	
	for ($o=0;$o<$f;$o++)
	{
		$seq3 = $o+1;
		echo "seq3". ".)	" . $ExternalLinksFromSameDomain[$o];
		echo "<BR>";
	}
	
	echo "<BR>";
	echo "<B>External Links From Different Domain are:	</B>" . $e;
	echo "<BR>";
	for ($c=0;$c<$e;$c++)
	{
		$seq4 = $c+1;
		echo "$seq4".".)	" . $ExternalLinksFromDiffDomain[$c];
		echo "<BR>";
	}
}
}
for ($k=0;$k<$count;$k++)
{
DisplayLinkInternalExternal($InnerPages[$k]);
}
?>