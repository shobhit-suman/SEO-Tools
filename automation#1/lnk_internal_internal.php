<?php
    // retrieve link destinations
	echo "welcome";
    function get_a_href($url)
	{
		$url = htmlentities(strip_tags($url));
		$ExplodeUrlInArray = explode('/',$url);
		$DomainName = $ExplodeUrlInArray[2];
		$file = @file_get_contents($url);
		$h1count = preg_match_all('/(href=["|\'])(.*?)(["|\'])/i',$file,$patterns);
		$linksInArray = $patterns[2];
		$CountOfLinks = count($linksInArray);
		$InternalLinkCount = 0;
		$ExternalLinkCount = 0;
		$count = 0;
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
		'InternalLinks'=>$InternalDomainsInArray);
		return $LinksResultsInArray;
    }
    
	if(isset($_POST['submit']) && $_POST['submit'] == 'submit')
    {
		$url = $_POST['url'];
		$linksInArray = get_a_href($url);
		$CountOfExternalLink = count($linksInArray['ExternalLinks']);
		$CountOfInternalLink = count($linksInArray['InternalLinks']);
		echo "<h1>Linking structure</h1>";
		if(!empty($linksInArray['ExternalLinks']))
		{
			echo "External Links found: (".$CountOfExternalLink.")<ul>";
			foreach($linksInArray['ExternalLinks'] as $key => $val)
			{
				$val = preg_replace("/</","<",$val);
				echo "<li>" . htmlentities($val) . "</li>";
				$new_url[$count]=(htmlentities($val));
				$count++;
				//get_a_href($new_url);
				//echo "the new url is".$new_url;
				//$new_url=NULL;
				
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
			}
			echo "</ul>";
		}
		else
		{
			echo "<div class=\"error\">No Internal Links found</div>";
		}
	}
		echo $count;
		echo "the third external link is" . $new_url[3];
		$dimaag= get_a_href($new_url[3]);
		$CountOfExternalLink1 = count($dimaag['ExternalLinks']);
		$CountOfInternalLink1 = count($imaag['InternalLinks']);
		echo "<h1>Linking structure</h1>";
		if(!empty($dimaag['ExternalLinks']))
		{
			echo "External Links found: (".$CountOfExternalLink1.")<ul>";
			foreach($dimaag['ExternalLinks'] as $key => $val)
			{
				$val = preg_replace("/</","<",$val);
				echo "<li>" . htmlentities($val) . "</li>";
				//$new_url[$count]=(htmlentities($val));
				//$count++;
				//get_a_href($new_url);
				//echo "the new url is".$new_url;
				//$new_url=NULL;
				
			}
			echo "</ul>";
		}
		else
		{
			echo "<div class=\"error\">No External Links found</div>";
		}
		if(!empty($dimaag['InternalLinks']))
		{
			echo "Internal Links found: (".$CountOfInternalLink1.")<ul>";
			foreach($dimaag['InternalLinks'] as $key => $val)
			{
				$val = preg_replace("/</","<",$val);
				echo "<li>" . htmlentities($val) . "</li>";
			}
			echo "</ul>";
		}
		else
		{
			echo "<div class=\"error\">No Internal Links found</div>";
		}
	
		//echo "kya hau" . $dimaag;
		/** for ($i=0;$i<$Count;$i++)
		{
			echo  $new_url[$i];
			$linksInArray = get_a_href($new_url[$i]);
			$CountOfExternalLink[i] = count($linksInArray['ExternalLinks']);
			$CountOfInternalLink[i] = count($linksInArray['InternalLinks']);
			echo "<h1>Linking structure</h1>";
			if(!empty($linksInArray['ExternalLinks']))
			{
				echo "External Links found: (".$CountOfExternalLink[i].")<ul>";
				foreach($linksInArray['ExternalLinks'] as $key => $val)
				{
					$val = preg_replace("/</","<",$val);
					echo "<li>" . htmlentities($val) . "</li>";
					//$new_url[$count]=(htmlentities($val));
					//$count++;
					//get_a_href($new_url);
					//echo "the new url is".$new_url;
					//$new_url=NULL;
				}
				echo "</ul>";
			}
			else
			{
				echo "<div class=\"error\">No External Links found</div>";
			}
			if(!empty($linksInArray['InternalLinks']))
			{
				echo "Internal Links found: (".$CountOfInternalLink[i].")<ul>";
				foreach($linksInArray['InternalLinks'] as $key => $val)
				{
					$val = preg_replace("/</","<",$val);
					echo "<li>" . htmlentities($val) . "</li>";
				}
				echo "</ul>";
			}
			else
			{
				echo "<div class=\"error\">No Internal Links found</div>";
			}
			//echo "\n"; 
		
		} */
?>