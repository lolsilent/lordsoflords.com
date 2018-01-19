<?php 
#!/usr/local/bin/php
function next_level(){
global $row;
return ((($row->level/10)*500)+$row->level)*($row->level*$row->level)+449;
}

function chatit($in) {
	global $emotions,$emotions_url;
$hi=array (
'@\[img\](http:\/\/.*?)\[/img\]@si',
'@\[c=(.*?)\](.*?)\[/c\]@si',
);

$ha=array (
'<img src="\1" width="16" height="16">',
'<font color="\1">\2</font>',
);
$in=preg_replace($hi, $ha, $in);

if(preg_match("/\[.*?\]/i",$in)){
foreach($emotions as $face){
if(in_array($face,$emotions)){
$face=strtolower($face);
$in=preg_replace("'\[$face\]'i","<img src=\"$emotions_url/$face.gif\" border=\"0\">",$in);
}}}

return stripslashes($in);
}
?>