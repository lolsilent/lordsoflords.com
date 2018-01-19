<?php 
#!/usr/local/bin/php
function postit($in) {
	global $search,$replace,$emotions,$emotions_url;
if (!isset($emotions)) {
require_once('/home/lordsoflords/public_html/AdmiN/array.emotions.php');
}
$hi=array (
'@\n@si',
'@\[quote\](.*?)\[/quote\]@si',
'@\[img\](http:\/\/.*?)\[/img\]@si',
'@\[url\](http:\/\/.*?)\[/url\]@si',
'@\[url=(http:\/\/.*?)\](.*?)\[/url\]@si',
'@\[email\](.*?\@.*?\..*?)\[/email\]@si',
'@\[c=(.*?)\](.*?)\[/c\]@si',
);

$ha=array (
'<br>',
'<blockquote><hr>\1<hr></blockquote>',
'<img src="\1" border=0>',
'<a href="\1" target="_blank">\1</a>',
'<a href="\1" target="_blank">\2</a>',
'<a href="mailto:\1\">\1</a>',
'<font color="\1">\2</font>',
);
$in=preg_replace($hi, $ha, $in);
$in=preg_replace($search, $replace, $in);


if(preg_match("/\[.*?\]/i",$in)){
foreach($emotions as $face){
if(in_array($face,$emotions)){
$face=strtolower($face);
$in=preg_replace("'\[$face\]'i","<img src=\"$emotions_url/$face.gif\" border=\"0\">",$in);
}}}

return stripslashes($in);
}

?>