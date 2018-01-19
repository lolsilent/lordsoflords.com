<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/www.faces.php';
require_once 'AdMiN/www.functions.php';

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!empty($_COOKIE['lol_Show'])) {
$max_cmessages=$_COOKIE['lol_Show'];
}
if (!empty($_COOKIE['lol_Refresh'])) {
$refresh_time=$_COOKIE['lol_Refresh'];
}

include_once $clean_header;

if (!empty($_COOKIE['lol_Username']) and !empty($_COOKIE['lol_Charname']) and !empty($_COOKIE['lol_Session'])) {
?>
<center>
<?php 
$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");

$query = "SELECT * FROM `$tbl_members` WHERE (`Username`='".$_COOKIE['lol_Username']."' and `Charname`='".$_COOKIE['lol_Charname']."' and `Onoff`) ORDER BY `id` DESC";

$result = mysqli_query($link, $query) or die("$error_message : Query failed 12");
$row = mysqli_fetch_object ($result) or die("$error_message : Possible mass clicking detected.");
mysqli_free_result ($result);

if ($row->Mute <= $current_time) {
	//duel mes
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/functions.messaging.php');
$gid = message_gid($server); //	2 meadow2
//print '<hr>'.$gid;

$dbm_main = 'messaging';
$tbl_messages = 'messages';
mysqli_select_db($link,$dbm_main) or die(mysqli_error($link).'Database offline.');
$query = "SELECT * FROM `$tbl_messages` WHERE `gid`='$gid' and `rid`='$row->id' and `status`='0' ORDER BY `id` DESC";
if($result = mysqli_query($link, $query)) {
$num_messages = mysqli_num_rows ($result);
mysqli_free_result ($result);
if ($num_messages >= 1) {
	echo "<font size=1>[<a href=\"messages.php\" target=\"lol_main\">$num_messages Message!</a>]</font>";
}
}
mysqli_select_db($link,$db_main) or die(mysqli_error($link).'Database offline.');


$query = "SELECT * FROM `$tbl_duel` WHERE Opponent='$row->Charname' ORDER BY `id` DESC";
$result = mysqli_query($link, $query);
$num_duels = mysqli_num_rows ($result);
mysqli_free_result ($result);
if ($num_duels >= 1) {
	echo "<font size=1>[<a href=\"schedule.php\" target=\"lol_main\">$num_duels Duel</a>]</font>";
}

if (isset($_COOKIE['lol_touring'])) {
$query = "SELECT * FROM $tbl_tournament WHERE Starts>=$current_time ORDER BY Starts asc LIMIT 1";
$result = mysqli_query($link, $query);
$trow = mysqli_fetch_object ($result);
mysqli_free_result ($result);
if (!empty($trow->id)) {
	echo "<font size=1>[<a href=\"tourney.php\" target=\"lol_main\">Match in ".number_format($trow->Starts-$current_time)."</a>]</font>";
}
}
	//duel mes
	//post message
if (!empty($_POST['Message']) and $row->Level >= 100 and $row->Jail-$current_time<0) {

$Message=clean_post($_POST['Message']);

if (!empty($_COOKIE['lol_col_personal'])) {
$Message="~c[".$_COOKIE['lol_col_personal']."]$Message";
}


if (!empty($Message)) {
	if ($row->Freeplay-time() >= 1) {$row->Sex = "[star]$row->Sex";}
$query = "SELECT * FROM `$tbl_board` WHERE (`Charname`='$row->Sex $row->Charname' and Message='$Message') ORDER BY `id` DESC LIMIT 10";
$result = mysqli_query($link, $query);

if(!$cbrow=mysqli_fetch_object($result)){$cbrow = new stdClass;$cbrow->Message='';$cbrow->Race='';}
mysqli_free_result ($result);

if ($cbrow->Message !== $Message and $cbrow->Race !== $row->Race) {

	if($row->Race == 'Crazy'){
$row->Level=rand(100,1000)*1000;
	}

mysqli_query($link, "INSERT INTO `$tbl_board` VALUES('','$row->Guild','','$row->Sex $row->Charname','$row->Race','$row->Level','$Message','$REMOTE_ADDR','$current_time')") or die ("ERROR".mysqli_error($link));
}
}
}
	//post message

?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<?php 
$query = "SELECT * FROM `$tbl_board` WHERE `id` ORDER BY `id` DESC LIMIT 50";
$result = mysqli_query($link, $query) or die ("Query failed");
$i=0;
if (!empty($_COOKIE['lol_ignore'])) {$ignored = explode(",",$_COOKIE['lol_ignore']);} else {$ignored=array();}
while ($brow = mysqli_fetch_object ($result)) {
if (!in_array($brow->Charname,$ignored)) {
$brow->Message=stripslashes($brow->Message);$brow->Message=stripslashes($brow->Message);
if ($i <= $max_cmessages) {
	//detect faces
if (preg_match ("/\[IMG\]/i", "$brow->Message") and preg_match ("/\[\/IMG\]/i", "$brow->Message")){
	$brow->Message= preg_replace("'\[IMG\]'i", "<img src=\"", $brow->Message);
	$brow->Message= preg_replace("'\[\/IMG\]'i", "\" widht=16 height=16 border=0>", $brow->Message);
}
if (preg_match ("/\[.*?\]/i", "$brow->Message")){
	foreach ($faces as $face) {
	if (preg_match ("/[$face]/i", "$brow->Message")){
	$face=strtolower($face);
	$brow->Message= preg_replace("'\[$face\]'i", "<img src=\"$emotions_url/$face.gif\" border=0>", $brow->Message);
	}
	}
}
if (preg_match ("/~c\[.*?\]/i", "$brow->Message")){
$brow->Message=preg_replace("/~c\[/i","<font color=",$brow->Message);
$brow->Message=preg_replace("/\]/",">",$brow->Message);
}
if (preg_match("/^\/s/",$brow->Message)) {
$brow->Message=preg_replace("/^\/s/","<b>",$brow->Message);
}
if (preg_match("/~d/i",$brow->Message)) {
$brow->Message=preg_replace("/~d/i","<b style=\"position:relative;left:".rand(10,200)."px;\">",$brow->Message);
}
if (preg_match ("/^\[star\]/", "$brow->Charname")){
$ignostart="<a href=\"ignore.php?charname=$brow->Charname\" target=\"lol_main\">";
$brow->Charname= preg_replace("'^\[star\]'i", "<img src=\"$emotions_url/star.gif\" border=0>", $brow->Charname);
$brow->Charname="$ignostart$brow->Charname</a>";
} else {
$brow->Charname="<a href=\"ignore.php?charname=$brow->Charname\" target=\"lol_main\">$brow->Charname</a>";
}
	//detect faces
if (!empty($brow->Guild)) {$brow->Guild="[$brow->Guild]";}
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td valign=top>$brow->Guild$brow->Charname<font size=1> $brow->Race ".number_format($brow->Level)."</font> : $brow->Message</td></tr>";
} //see messages
//if ($i > $max_smessages) {mysqli_query($link, "DELETE FROM `$tbl_board` WHERE `id`=$brow->id LIMIT 1");}
$i++;
}//ignore
}//while
mysqli_free_result ($result);

?>
</table>
<meta http-equiv="refresh" content="<?php echo $refresh_time; ?>">
<?php 

} else {
echo $mute_messages;
} //muted


/*_______________-=TheSilenT.CoM=-_________________*/

if($lcresult=mysqli_query($link, "SELECT * FROM `$tbl_board` WHERE `id` ORDER BY `id` DESC LIMIT 100")){
if(mysqli_num_rows($lcresult) >= 50){
$somecontent='';
$i=0;
while($lbobj=mysqli_fetch_object($lcresult)){$i++;if ($i > $max_smessages) {
$lbobj->Message=preg_replace("/~c\[.*?\]/i","",$lbobj->Message);
$somecontent.='<br>'.(!empty($lbobj->Guild)?"[$lbobj->Guild]":'')."$lbobj->Sex $lbobj->Charname <font size=\"1\"> $lbobj->Race ".number_format($lbobj->Level)."</font> ".stripslashes($lbobj->Message);
mysqli_query($link, "DELETE FROM `$tbl_board` WHERE `id`=$lbobj->id LIMIT 1");
}
}
mysqli_free_result($lcresult);

/*
$maxfilesize=50000;
$logdate=date('d-m-Y');
$filename='chat/'.$logdate.'.php';
if(file_exists($filename)){$filesize=filesize($filename);}else{$filesize=0;}

if($filesize>$maxfilesize){$i=0;while($filesize >= $maxfilesize){$i++;
	if ($i == 1){$filename=preg_replace("/.php/i","-$i.php",$filename);
	}else{$filename=preg_replace("/-(\d+).php/i","-$i.php",$filename);}
	if(file_exists($filename)){$filesize=filesize($filename);}else{$filesize=0;}
	//echo $filename." $filesize $i<br>";
}}

//echo $filename." $filesize<br>";

if(file_exists($filename) and !empty($somecontent)) {
$exist=implode('',file($filename));
unlink($filename);
$somecontent=preg_replace("/<!--CHATLOG-->/i","<!--CHATLOG-->$somecontent",$exist);
$open = fopen($filename, 'w+');
$handle = fopen($filename, 'w+');
if(fwrite($handle, $somecontent) == FALSE){
?>Can't write file 1.<?php 
}
fclose($handle);
}elseif(!file_exists($filename) and !empty($somecontent)) {
$somecontent='<?php require_once(\'header.php\');?>Chat log of '.$logdate.'<!--CHATLOG-->'.$somecontent.'<?php require_once(\'footer.php\');?>';
$open = fopen($filename, 'a+');
$handle = fopen($filename, 'a+');
if(fwrite($handle, $somecontent) == FALSE){
?>Can't write file 2.<?php 
}
fclose($handle);
}*/

}}

/*_______________-=TheSilenT.CoM=-_________________*/

mysqli_close ($link);
} else {
echo $error_message;
} //cookies
include_once $clean_footer;
?>