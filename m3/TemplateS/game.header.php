<?php 
#!/usr/local/bin/php

setcookie ("lol_Session", "$current_time",time()+60*60*60) or die("$error_message : 555 Cookie failure");

// and preg_match("/^$ref_url/i", $_SERVER['HTTP_REFERER'])
if (!empty($_COOKIE['lol_Username']) and !empty($_COOKIE['lol_Charname']) and !empty($_COOKIE['lol_Session'])) {

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once './AdMiN/www.mysql.php';
$link = mysqli_connect($db_host, $db_user, $db_password) or die("$error_message : Unable to connect to database");
mysqli_select_db($link, "$db_main") or die( "$error_message : Unable to select database");

$query = "SELECT * FROM `$tbl_members` WHERE (`Username`='".$_COOKIE['lol_Username']."' and `Charname`='".$_COOKIE['lol_Charname']."' and `Onoff`) ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($link, $query) or die("$error_message : Query failed 12");
if ($row = mysqli_fetch_object ($result)) {
	if($row->Jail-$current_time >= 100){
?><script>alert("You have been jailed for violating our rules, jail time <?php print number_format($row->Jail-$current_time);?> seconds! \n\n Please go to the forums for help!. \n\n Violation of the rules may get your account deleted. \n\n Possible mass clicking detected. \n\n If this doesn't apply for your chars, where are very sorry for what has happend to you. \n\n Just click away this screen and relogin to play.\n\n\n\n\n\n\n\n\n\n");
 top.location = "<?php print $root_url?>";</script><?php 
	}
mysqli_free_result ($result);
}else{
 print ("<script>alert(\"You have been logged out or something else happened. \\n\\n Violation of the rules may get your account deleted. \\n\\n Possible mass clicking detected. \\n\\n If this doesn't apply for your chars, where are very sorry for what has happend to you. \\n\\n Just click away this screen and relogin to play.\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\");
 document.location = \"$root_url\";</script>");
 require_once('/home/lordsoflords/public_html/TemplateS/game.footer.php');
 exit;
}
$freeplay=$row->Freeplay-time();
$max_gold=($row->Level+($row->Level/5))*$max_gold;
?><html>
<head>
<?php 
include_once("$html_style");
?>
<title><?php echo $title; ?></title>
</head>
<body bgcolor=<?php echo $col_bg;?> text=<?php echo $col_text;?> rightmargin=0 leftmargin=0 topmargin=0 bottommargin=0>
<center>
<?php 


//MULTI BLOCK
/*
$ipquery = "SELECT * FROM `$tbl_members` WHERE (`ip`='$row->ip' and Onoff) ORDER BY `id` DESC";
$ipresult = mysqli_query($link, "ipquery);
$iponline = mysqli_num_rows($ipresult);
mysqli_free_result ($ipresult);

if($iponline > 2){
?>Too many players logged in on this ip please logout some of your chars, max 2 chars per ip allowed!<?php 
//mysqli_query($link, "UPDATE `$tbl_members` SET `Onoff`=0 WHERE `ip`='$row->ip' LIMIT 10");
include_once($game_footer);exit;
}
*/
//MULTI BLOCK


		//HEADER
if ($_COOKIE['lol_Username'] == $row->Username and $_COOKIE['lol_Charname'] == $row->Charname) {

echo "<table width=100% cellpadding=0 cellspacing=1 border=0><tr bgcolor=$col_th>
<td valign=top>Level : ".lint($row->Level)."</td> <td valign=top>Exp : ".number_format($row->Exp)."</td> <td valign=top>Gold : ".number_format($row->Gold)."</td>";
if ($freeplay >= 1) {
echo "<td valign=top>Freeplay : ".number_format($freeplay)."</td>";
}
echo "</tr></table>";

	//max gold, stash and keep player alive
$to_update="`Time`=$current_time";
if (rand(1,10000) == 5000) {$to_update.=",Onoff=2";}
	//max gold, stash and keep player alive

if ($freeplay <= 0 and $row->Level >= 3) {


print '<br><font size=-2><a href="'.$root_url.'/support.php">Don\'t show up the banners and help the webmaster.</a></font><br>';

}

	//JAIL
if($row->Jail>=$current_time){
?><hr><b>You have been jailed for violating our rules, jail time <?php print number_format($row->Jail-$current_time);?>!<br>Please go to the forums for help!<meta http-equiv="refresh" content="<?php print ($row->Jail-$current_time)+5;?>"></b><hr><?php 

if($row->Jail-$current_time >= 100){
?><script>alert("You have been jailed for violating our rules, jail time <?php print number_format($row->Jail-$current_time);?> seconds! \n\n Please go to the forums for help!. \n\n Violation of the rules may get your account deleted. \n\n Possible mass clicking detected. \n\n If this doesn't apply for your chars, where are very sorry for what has happend to you. \n\n Just click away this screen and relogin to play.\n\n\n\n\n\n\n\n\n\n");
 top.location = "<?php print $root_url?>";</script><?php 
}

include_once($game_footer);exit;
}
	//JAIL


} else {
include_once("$html_header");
echo"$error_message 1";
include_once("$html_footer");
exit;
}


} else {
include_once("$html_header");
echo"$error_message 22<br>";

if (empty($_COOKIE['lol_Username'])){
print 'Username Cookie Error.<br>';
}
if (empty($_COOKIE['lol_Charname'])){
print 'Charname Cookie Error.<br>';
}
if (empty($_COOKIE['lol_Session'])) {
print 'Session Cookie Error.<br>';
}

include_once("$html_footer");
exit;
}
?>