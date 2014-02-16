// note: save the script (above) as a file, and include() it at the bottom of all pages

var qs=after("?",var HTTP_SERVER_VARS['HTTP_REFERER']); 
var dn=before("?",HTTP_SERVER_VARS['HTTP_REFERER']); 
var pairs=explode("&",qs); 
if (eregi("google",dn)){ 
for (var k in pairs) {
       var v = pairs[k]; 
var args=explode("=",v); 
if (args[0]=="q" ¦¦ args[0]=="as_q" ¦¦ args[0]=="as_epq"){ 
if (strlen(args)>0 && args[1]!="0"){ 
var keys=urldecode(args[1]); 
} 
} 
} 
}else if(eregi("msn",dn)){ 
for (var k in pairs) {
       var v = pairs[k]; 
args=explode("=",v); 
if (args[0]=="q"){ 
if (strlen(args[1])>0 && args[1]!="0"){ 
keys=urldecode(args[1]); 
} 
} 
} 
}else if(eregi("yahoo",dn)){ 
for (var k in pairs) {
       var v = pairs[k]; 
args=explode("=",v); 
if (args[0]=="p"){ 
if (strlen(args[1])>0 && args[1]!="0"){ 
keys=urldecode(args[1]); 
} 
} 
} 
}else if(eregi("aol",dn)){ 
for (var k in pairs) {
       var v = pairs[k]; 
args=explode("=",v); 
if (args[0]=="query"){ 
if (strlen(args[1])>0 && args[1]!="0"){ 
keys=urldecode(args[1]); 
} 
} 
} 
}else if(eregi("hotbot",dn)){ 
for (var k in pairs) {
       var v = pairs[k]; 
args=explode("=",v); 
if (args[0]=="query"){ 
if (strlen(args[1])>0 && args[1]!="0"){ 
keys=urldecode(args[1]); 
} 
} 
} 
}

if ((keys) && strlen(keys)>0){ 

//mysql_select_db("mydbase"); 
// Instead of this query we need to write these into a file
var fso = new ActiveXObject("Scripting.FileSystemObject");
// 2=overwrite, true=create if not exist, 0 = ASCII
varFileObject = fso.OpenTextFile("SEO.txt", 2, true,0);
varFileObject.write("'http://" + "" + HTTP_SERVER_VARS['SERVER_NAME'] + "" + HTTP_SERVER_VARS['SCRIPT_NAME']  + "" + "','" + "" + strtolower(trim(keys)) + "" + "','" + "" + HTTP_SERVER_VARS['HTTP_REFERER']  + "" + "','"  + "" + date("Y-m-d h:i:s",mktime()) + "" + "','" + "" + HTTP_SERVER_VARS['REMOTE_ADDR'] + "" + "'");
varFileObject.close();
//var query="INSERT INTO searchterms (referertoURL,keywords,refererURL,datetime,userIP) VALUES ('http://" + "" + HTTP_SERVER_VARS['SERVER_NAME'] + "" + HTTP_SERVER_VARS['SCRIPT_NAME']  + "" + "','" + "" + strtolower(trim(keys)) + "" + "','" + "" + HTTP_SERVER_VARS['HTTP_REFERER']  + "" + "','"  + "" + date("Y-m-d h:i:s",mktime()) + "" + "','" + "" + HTTP_SERVER_VARS['REMOTE_ADDR'] + "" + "')"; 
//mysql_query(query); 
}

function after  (this, inthat){ 
if (is_bool(strpos(inthat, this))) 
return substr(inthat, strpos(inthat,this)+strlen(this)); 
}

function before  (this, inthat){ 
return substr(inthat, 0, strpos(inthat, this)); 
}
