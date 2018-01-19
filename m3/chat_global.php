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
} else {
if (empty($refresh_time)) {$refresh_time=10;}
}

include_once $clean_header;

if (!empty($_POST)) {
	foreach ($_POST as $key => $val) {
		if (!empty($val)) {
			$$key=clean_post($val);
		}
	}
}

if (!empty($_GET)) {
	foreach ($_GET as $key => $val) {
		if (!empty($val)) {
			$$key=clean_post($val);
		}
	}
}

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
/*_______________-=TheSilenT.CoM=-_________________*/

$db_maina	= 'silent_chat';

$tbl_content	= 'chat_content';
$fld_content	= 'id, channel, star, guild, sex, charname, level, receiver, content, gamename, ip,timer';

mysqli_select_db($link, "$db_maina") or die( "Unable to select database");
	//post message
if (!empty($Message) and $row->Level >= 100 and $row->Jail-$current_time<0) {
if (!empty($_COOKIE['lol_col_personal'])) {
$Message="~c[".$_COOKIE['lol_col_personal']."]$Message";
}
$Message=clean_post($Message);
if (!empty($Message)) {

if (preg_match("/^\/w[.*?].*?/",$Message)) {
$to=preg_replace("/^\/w[/","",$Message);
$to=preg_replace("/].*?$/","",$to);
$Message=preg_replace("/^\/w[.*?]/","",$Message);
} else {
$to='';
}

if ($row->Sex == $operators[3]) {
$star=2;
} elseif ($row->Sex == $operators[2]) {
$star=3;
} elseif ($row->Sex == $operators[1]) {
$star=4;
} elseif ($row->Sex == $operators[0]) {
$star=5;
} else {
if ($row->Freeplay-time() >= 1) {$star=1;} else {$star=0;}
}


$query = "SELECT * FROM $tbl_content WHERE (`Charname`='$row->Charname' and content='$Message') ORDER BY `id` DESC";
$result = mysqli_query($link, $query);
$cbrow = mysqli_fetch_object ($result);
mysqli_free_result ($result);
if ($cbrow->content !== $Message and $cbrow->charname !== $row->Charname) {
$value = "'', '', '$star', '$row->Guild', '$row->Sex', '$row->Charname', '$row->Level', '$to', '$Message', '$server', '$REMOTE_ADDR','$current_time'";
mysqli_query($link, "INSERT INTO $tbl_content ($fld_content) values ($value)") or print("Unable to post your message");
}
}
}
	//post message
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<?php 
$query = "SELECT * FROM $tbl_content WHERE `id` ORDER BY `id` DESC LIMIT 55";
$result = mysqli_query($link, $query) or die ("Query failed");
$i=0;
if (!empty($_COOKIE['lol_ignore'])) {$ignored = explode(",",$_COOKIE['lol_ignore']);} else {$ignored=array();}
while ($brow = mysqli_fetch_object ($result)) {
if (!in_array($brow->charname,$ignored)) {
	$brow->content=stripslashes($brow->content);
	$brow->content=stripslashes($brow->content);
if ($i <= $max_cmessages) {
	//detect faces
if (preg_match ("/\[IMG\]/i", "$brow->content") and preg_match ("/\[\/IMG\]/i", "$brow->content")){
	$brow->content= preg_replace("'\[IMG\]'i", "<img src=\"", $brow->content);
	$brow->content= preg_replace("'\[\/IMG\]'i", "\" widht=16 height=16 border=0>", $brow->content);
}
if (preg_match ("/\[.*?\]/i", "$brow->content")){
	foreach ($faces as $face) {
	if (preg_match ("/[$face]/i", "$brow->content")){
	$face=strtolower($face);
	$brow->content= preg_replace("'\[$face\]'i", "<img src=\"$emotions_url/$face.gif\" border=0>", $brow->content);
	}
	}
}
if (preg_match ("/~c\[.*?\]/i", "$brow->content")){
$brow->content=preg_replace("/~c\[/i","<font color=",$brow->content);
$brow->content=preg_replace("/\]/",">",$brow->content);
}
if (preg_match("/^\/s/",$brow->content)) {
$brow->content=preg_replace("/^\/s/","<b>",$brow->content);
}
if (preg_match("/~d/i",$brow->content)) {
$brow->content=preg_replace("/~d/i","<b style=\"position:relative;left:".rand(10,200)."px;\">",$brow->content);
}
	//detect faces
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}

if ($brow->star == 5) {
$star = "<img src=\"$emotions_url/star5.gif\" border=0>";
} elseif ($brow->star == 4) {
$star = "<img src=\"$emotions_url/star4.gif\" border=0>";
} elseif ($brow->star == 3) {
$star = "<img src=\"$emotions_url/star3.gif\" border=0>";
} elseif ($brow->star == 2) {
$star = "<img src=\"$emotions_url/star2.gif\" border=0>";
} elseif ($brow->star == 1) {
$star = "<img src=\"$emotions_url/star.gif\" border=0>";
} else {
$star = "";
}

if (!empty($brow->guild)) {$brow->guild="[$brow->guild]";}

echo "<tr$bgcolor><td valign=top>$star$brow->guild<a href=\"ignore.php?charname=$brow->charname\" target=\"lol_main\">$brow->charname</a><font size=1> ".number_format($brow->level)." $brow->gamename</font> : $brow->content</td></tr>";
} //see messages
if ($i > 50) {
mysqli_query($link, "DELETE FROM $tbl_content WHERE `id`=$brow->id LIMIT 1");
}
$i++;
}//ignore
}//while
mysqli_free_result ($result);

?>
</table>
<meta http-equiv="refresh" content="<?php echo $refresh_time; ?>">
<?php 

/*_______________-=TheSilenT.CoM=-_________________*/

} else {
echo $mute_messages;
} //muted
mysqli_close ($link);
} else {
echo $error_message;
} //cookies
include_once $clean_footer;
?>