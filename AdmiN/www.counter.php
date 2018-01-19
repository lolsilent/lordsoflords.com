<?php 
#!/usr/local/bin/php


/*_______________-=TheSilenT.CoM=-_________________*/
/*
if (!isset($db_host)) {
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.mysql.php');
}

if (isset($db_host)) {
$current_date=date('d M Y H:i:s');
$current_time=time();
$db_main = 'counter';
$tbl_counter = 'counter';


if(isset($_SERVER["HTTP_REFERER"])){
	$referer=addslashes($_SERVER["HTTP_REFERER"]);}else{$referer='';}
if(isset($_SERVER["REQUEST_URI"])){
	$uri=addslashes($_SERVER["REQUEST_URI"]);}else{$uri='';}
if(isset($_SERVER["REMOTE_ADDR"])){
	$addr=addslashes($_SERVER["REMOTE_ADDR"]);}else{$addr='';}

if (!empty($uri)) {
	$uri = preg_replace("/\?sid.*?$/si","",$uri);
	$referer = preg_replace("/\?sid.*?$/si","",$referer);
$link = mysqli_connect($db_host, $db_user, $db_password) or die(mysqli_error($link));
mysqli_select_db($link,$db_main) or die(mysqli_error($link));

if($conresults=mysqli_query($link, "SELECT * FROM `$tbl_counter` WHERE (`url`='$uri') ORDER BY `id` DESC LIMIT 1")){
if($conrow = mysqli_fetch_object ($conresults)){
mysqli_free_result ($conresults);

mysqli_query($link, "UPDATE `$tbl_counter` SET `hits`=`hits`+1,`last`='$current_date' WHERE (`url`='$uri') LIMIT 1");
if($addr !== $conrow->ip){
mysqli_query($link, "UPDATE `$tbl_counter` SET `visitors`=`visitors`+1,`last`='$current_date',`ip`='$addr' WHERE (`url`='$uri' and `ip`!='$addr') LIMIT 1");
}

if ($_SERVER['REMOTE_ADDR'] == '92.70.105.126') {
	print '<table><tr><td class=navy>Uniques : '.number_format($conrow->visitors).'</td><td class=navy>Hits : '.number_format($conrow->hits).'</td><td class=navy>First hit : '.$conrow->first.'</td><td class=navy>Last hit : '.$conrow->last.'</td><td class=navy>Last ip:'.substr($conrow->ip, 0, 8).'...</td>'.$conrow->referer.' - '.$conrow->url.'<td></td></tr></table>';
}

}else{mysqli_query($link, "INSERT INTO `$tbl_counter` values (NULL,'$referer','$uri',1,1,'$addr','$current_date','$current_date','$current_time')") or die(mysqli_error($link));}
}else{mysqli_query($link, "INSERT INTO `$tbl_counter` values (NULL,'$referer','$uri',1,1,'$addr','$current_date','$current_date','$current_time')") or die(mysqli_error($link));}

mysqli_close ($link);
}
}
*/
/*_______________-=TheSilenT.CoM=-_________________*/

?>