<?php

/**function strip_script($string) {
    // Prevent inline scripting
    $string = preg_replace("/<script[^>]*>.*<*script[^>]*>/i", "", $string);
    // Prevent linking to source files
    $string = preg_replace("/<script[^>]*>/i", "", $string);

    //styles
    $string = preg_replace("/<style[^>]*>.*<*style[^>]*>/i", "", $string);
    // Prevent linking to source files
    $string = preg_replace("/<style[^>]*>/i", "", $string);
    return $string;
}*/

/**function clear_text($s) {
    $do = true;
    while ($do) {
        $start = stripos($s,'<script');
        $stop = stripos($s,'</script>');
        if ((is_numeric($start))&&(is_numeric($stop))) {
            $s = substr($s,0,$start).substr($s,($stop+strlen('</script>')));
        } else {
            $do = false;
        }
    }
    return trim($s);
}*/
$url1 = $_POST["url"];
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

$file = "TEXT.txt";
file_put_contents($file, strip_tags($content));
echo strip_tags($content);
//echo "----------------------------------------------";

function strip_word_html($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><br>') 
    { 
        mb_regex_encoding('UTF-8'); 
        //replace MS special characters first 
        $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u'); 
        $replace = array('\'', '\'', '"', '"', '-'); 
        $text = preg_replace($search, $replace, $text); 
        //make sure _all_ html entities are converted to the plain ascii equivalents - it appears 
        //in some MS headers, some html entities are encoded and some aren't 
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8'); 
        //try to strip out any C style comments first, since these, embedded in html comments, seem to 
        //prevent strip_tags from removing html comments (MS Word introduced combination) 
        if(mb_stripos($text, '/*') !== FALSE){ 
            $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm'); 
        } 
        //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be 
        //'<1' becomes '< 1'(note: somewhat application specific) 
        $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text); 
        $text = strip_tags($text, $allowed_tags); 
        //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one 
        $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text); 
        //strip out inline css and simplify style tags 
        $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu'); 
        $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>'); 
        $text = preg_replace($search, $replace, $text); 
        //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears 
        //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains 
        //some MS Style Definitions - this last bit gets rid of any leftover comments */ 
        $num_matches = preg_match_all("/\<!--/u", $text, $matches); 
        if($num_matches){ 
              $text = preg_replace('/\<!--(.)*--\>/isu', '', $text); 
        } 
        return $text; 
    } 
	
/**function clean_jscode($script_str) {
    $script_str = htmlspecialchars_decode($script_str);
    $search_arr = array('<script', '</script>');
    $script_str = str_ireplace($search_arr, $search_arr, $script_str);
    $split_arr = explode('<script', $script_str);
    $remove_jscode_arr = array();
    foreach($split_arr as $key => $val) 
	{
        $newarr = explode('</script>', $split_arr[$key]);
        $remove_jscode_arr[] = ($key == 0) ? $newarr[0] : $newarr[1];
    }
    return implode('', $remove_jscode_arr);
}*/

//echo preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $content);

//$new_content=clean_jscode($script_str);

//$new_content=clear_text($content);



//$string = preg_replace("/<script[^>]*>.*?< *script[^>]*>/i", "", $content);
//$content_new=strip_script($content);

$new_content=strip_word_html($content , $allowed_tags = '<b><i><sup><sub><em><strong><u><br>');
//echo $new_content;

?> 
