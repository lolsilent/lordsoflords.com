<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';

if(empty($player_ip)){$player_ip=$_SERVER['REMOTE_ADDR'];}


if(!empty($_POST['Username'])){$Username=clean_post($_POST['Username']);}else{$Username='';}
if(!empty($_POST['Password'])){$Password=clean_post($_POST['Password']);}else{$Password='';}

if (!empty($Username) and !empty($Password)) {
	//start login process and connect to mysql
require_once 'AdMiN/www.mysql.php';
$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");

if($query = "SELECT * FROM `$tbl_members` WHERE (`Username`='$Username') ORDER BY `id` DESC LIMIT 1"){
if($result = mysqli_query($link, $query)){
if($row = mysqli_fetch_object ($result)){
mysqli_free_result ($result);
			//LOCK ACCOUNT
if ($row->Loginfail >= 10000) {
include_once("$html_header");
mysqli_close($link);
?>Account has been locked too many fail attemps, ask an admin to unlock this account.<?php 
include_once("$html_footer");
exit;
}
			//LOCK ACCOUNT
	$Password=crypt($Password,$row->Username);
if ($row->Password == $Password and $Username == $row->Username) {

mysqli_query($link, "UPDATE `$tbl_members` SET Onoff=1, `Time`=$current_time, ip='$player_ip' WHERE `id`=$row->id LIMIT 1") or die ("Update failed 1".mysqli_error($link));

setcookie ("lol_Username", "$row->Username",time()+60*60*60) or die("$error_message");
setcookie ("lol_Session", "$current_time",time()+60*60*60) or die("$error_message");
setcookie ("lol_Charname", "$row->Charname",time()+60*60*60) or die("$error_message");
} else {

mysqli_query($link, "UPDATE `$tbl_members` SET Loginfail=Loginfail+1, Loginfailip='$player_ip' WHERE `id`=$row->id LIMIT 1") or die ("Update failed 2");
mysqli_close($link);

include_once("$html_header");
?>Login failed make sure that your username and password are case correct!<?php 
include_once("$html_footer");
exit;
}
	//layout
if (!empty($_POST['layout'])) {
$layout = clean_post($_POST['layout']);
setcookie ("lol_layout", "$layout",time()+84600*360) or die("$error_message");
if ($layout == 1) {
include_once("login1.inc.php");
} elseif ($layout == 2) {
include_once("login2.inc.php");
} elseif ($layout == 3) {
include_once("login3.inc.php");
} elseif ($layout == 4) {
include_once("login4.inc.php");
} elseif ($layout == 5) {
include_once("login5.inc.php");
} else {
echo $error_message;
}
} else {
setcookie ("lol_layout", "",time()-84600*360) or die("$error_message");
include_once("login.inc.php");
$layout='Default';
}
	//layout
}else{mysqli_close($link);

include_once("$html_header");
?>Login failed make sure that your username and password are case correct!!<?php 
include_once("$html_footer");
exit;}
}else{mysqli_close($link);

include_once("$html_header");
?>Login failed make sure that your username and password are case correct!!!<?php 
include_once("$html_footer");
exit;}
}else{mysqli_close($link);

include_once("$html_header");
?>Login failed make sure that your username and password are case correct!!!!<?php 
include_once("$html_footer");
exit;}


if($logres= mysqli_query($link, "SELECT * FROM lol_zlogs WHERE `Charname`='$row->Charname' and file='".$_SERVER['PHP_SELF']."' LIMIT 1")){
$i=0;if($logrow = mysqli_fetch_object ($logres)){mysqli_free_result ($logres);
$dmlog=date("d M");
if (!preg_match("/^$dmlog.*?/i",$logrow->date)){$i=1;}}else{$i=1;}

if($i<1){mysqli_query($link, "INSERT INTO `lol_zlogs` ($fld_logs) values ('','$row->Charname','layout$layout exp$row->Exp gold$row->Gold','".$_SERVER['PHP_SELF']."','$current_date','$player_ip')");}
}
mysqli_close ($link);
} else {
include_once("$html_header");
login_form();
?>
<b><a href="retrieve.php">Forget your password?</a></b><hr>

<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/playersonline.php');

include_once("$html_footer");
}

function login_form() {
global $lol;
?>
<form method=post enctype="application/x-www-form-urlencoded" target="_top">
<table border=0 cellpadding=0 cellspacing=1 width="50%">
<tr>
<th colspan=2>Account Information</th>
</tr>
<tr>
<td width="50%">Username</td><td width="50%"><input type=text size=25 name="Username" maxlength=10></td>
</tr>
<tr>
<td>Password</td><td><input type=password size=25 name="Password" maxlength=50> </td>
</tr>
<tr>
<td>Layout</td><td><select name=layout>
<option value="">Default</option>
<?php 
if (isset($_COOKIE['layout']) and !empty($_COOKIE['layout'])) {
if ($_COOKIE['layout'] == 1) {
	$sel1=' selected';$sel2='';$sel3='';$sel4='';$sel5='';
} elseif ($_COOKIE['layout'] == 2) {
	$sel1='';$sel2=' selected';$sel3='';$sel4='';$sel5='';
} elseif ($_COOKIE['layout'] == 3) {
	$sel1='';$sel2='';$sel3=' selected';$sel4='';$sel5='';
} elseif ($_COOKIE['layout'] == 4) {
	$sel1='';$sel2='';$sel3='';$sel4=' selected';$sel5='';
} elseif ($_COOKIE['layout'] == 5) {
	$sel1='';$sel2='';$sel3='';$sel4='';$sel5=' selected';
}
?>
<option value="1"<?php echo $sel1; ?>>Advanced</option>
<option value="2"<?php echo $sel2; ?>>Expert</option>
<option value="3"<?php echo $sel3; ?>>Grouped Menu</option>
<option value="4"<?php echo $sel4; ?>>Chat only</option>
<option value="5"<?php echo $sel5; ?>>Menu right</option>
<?php 
} else {
?>
<option value="1">Advanced</option>
<option value="2">Expert</option>
<option value="3">Grouped Menu</option>
<option value="4">Chat only</option>
<option value="5">Menu right</option>
<?php 
}
?>
</select>
</td>
</tr>
<tr>
<th colspan=2> <input type=submit value="Enter Lol!" Submit name=Action></th>
</tr>
</table>
</form>
<?php 
}
?>