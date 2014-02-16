<?php 

// note: save the script (above) as a file, and include() it at the bottom of all pages

$qs=after("?",$HTTP_SERVER_VARS['HTTP_REFERER']); 
$dn=before("?",$HTTP_SERVER_VARS['HTTP_REFERER']); 
$pairs=explode("&",$qs); 
if (eregi("google",$dn)){ 
foreach ($pairs as $k=>$v){ 
$args=explode("=",$v); 
if ($args[0]=="q" жж $args[0]=="as_q" жж $args[0]=="as_epq"){ 
if (strlen($args)>0 && $args[1]!="0"){ 
$keys=urldecode($args[1]); 
} 
} 
} 
}elseif(eregi("msn",$dn)){ 
foreach ($pairs as $k=>$v){ 
$args=explode("=",$v); 
if ($args[0]=="q"){ 
if (strlen($args[1])>0 && $args[1]!="0"){ 
$keys=urldecode($args[1]); 
} 
} 
} 
}elseif(eregi("yahoo",$dn)){ 
foreach ($pairs as $k=>$v){ 
$args=explode("=",$v); 
if ($args[0]=="p"){ 
if (strlen($args[1])>0 && $args[1]!="0"){ 
$keys=urldecode($args[1]); 
} 
} 
} 
}elseif(eregi("aol",$dn)){ 
foreach ($pairs as $k=>$v){ 
$args=explode("=",$v); 
if ($args[0]=="query"){ 
if (strlen($args[1])>0 && $args[1]!="0"){ 
$keys=urldecode($args[1]); 
} 
} 
} 
}elseif(eregi("hotbot",$dn)){ 
foreach ($pairs as $k=>$v){ 
$args=explode("=",$v); 
if ($args[0]=="query"){ 
if (strlen($args[1])>0 && $args[1]!="0"){ 
$keys=urldecode($args[1]); 
} 
} 
} 
}

if (isSet($keys) && strlen($keys)>0){ 
mysql_select_db("mydbase"); 
$query="INSERT INTO searchterms (referertoURL,keywords,refererURL,datetime,userIP) VALUES ('http://".$HTTP_SERVER_VARS['SERVER_NAME'].$HTTP_SERVER_VARS['SCRIPT_NAME'] ."','".strtolower(trim($keys))."','".$HTTP_SERVER_VARS['HTTP_REFERER'] ."','" .date("Y-m-d h:i:s",mktime())."','".$HTTP_SERVER_VARS['REMOTE_ADDR']."')"; 
mysql_query($query); 
}

function after ($this, $inthat){ 
if (!is_bool(strpos($inthat, $this))) 
return substr($inthat, strpos($inthat,$this)+strlen($this)); 
}

function before ($this, $inthat){ 
return substr($inthat, 0, strpos($inthat, $this)); 
}

?>