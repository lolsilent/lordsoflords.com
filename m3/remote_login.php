<?php 
require_once 'AdMiN/www.main.php';
if (!empty($Action)) {

if (empty($Username) or empty($Password)) {
include_once("$html_header");
print "Incorrect password or username.<br>";
login_form();
include_once("$html_footer");
exit;
} else {
	//start login process and connect to mysql
require_once 'AdMiN/www.mysql.php';
$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");
$query = "SELECT * FROM `$tbl_members` WHERE (`Username`='$Username') ORDER BY `id` DESC";
$result = mysqli_query($link, $query) or die ("Query failed");
$row = mysqli_fetch_object ($result) or die ("Query failed 1");
mysqli_free_result ($result);

if ($row->Password == $Password and $Username == $row->Username) {
if ($row->Onoff < 2) {$force=1;} else {$force=$row->Onoff;}
mysqli_query($link, "UPDATE `$tbl_members` SET Onoff=$force, `Time`=$current_time, ip='$REMOTE_ADDR' WHERE `id`=$row->id LIMIT 1") or die ("Update failed");

setcookie ("lol_Username", "$row->Username",time()+60*60*5) or die("$error_message");
setcookie ("lol_Session", "$current_time",time()+60*60*5) or die("$error_message");
setcookie ("lol_Charname", "$row->Charname",time()+60*60*5) or die("$error_message");
} else {
	die ("Login failed make sure that your username and password are case correct!");
}
	//layout
if (!empty($layout)) {
setcookie ("lol_layout", "$layout",time()+84600*360) or die("$error_message");
if ($layout == 1) {
include_once("login1.inc.php");
} elseif ($layout == 2) {
include_once("login2.inc.php");
} else {
echo $error_message;
}
} else {
setcookie ("lol_layout", "",time()-84600*360) or die("$error_message");
include_once("login.inc.php");
}
	//layout
}
mysqli_close ($link);
} else {
include_once("$html_header");
login_form();
?>
<b><a href="retrieve.php">Forget your password?</a></b><hr>
Please insert a email address after you logon by clicking on [Change Password or Email], I get too many emails of players losing their passwords I don't do it anymore after this message has been placed! And now passwords are encrypted so I don't know it too!
<table cellpadding=0 cellspacing=1 border=0 width=100%>
<tr>
<th>You agree to have read and understand Privacy Policy, Conditions of Use and Rules below.</th>
</tr>
<tr><td>
<b>GAME RULES</b>
<ul>
<li>NEVER EVER GIVE OUT YOUR PASSWORD, NOT EVEN TO AN GAME ADMIN!</li>
<li>FOUND A BUG? DON'T ABUSE BUT REPORT OR EMAIL ADMIN!</li>
</ul>
<b>CHAT RULES</b>
<ul>
<li>DON'T SPAM OR GET MUTED FOREVER!</li>
<li>DON'T ASK FOR FREE GOLD MORE THAN ONCE WITHIN 25 MESSAGES!</li>
<li>DON'T ASK FOR A CHALLENGE MORE THAN ONCE WITHIN 10 MESSAGES!</li>
<li>DON'T EVER ASK FOR FREE CREDITS!</li>
<li>DON'T EVER SEND MESSAGE TO OTHER PLAYERS ASKING FOR GOLD OR CREDITS!</li>
</ul>
<b>All who don't follow CHAT RULES will be muted forever, or you pay 1.000 credits to buy your self out again! So be warned!</b>
</td></tr>
</table>
<?php 
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
	$sel1=' selected';$sel2='';
} elseif ($_COOKIE['layout'] == 2) {
	$sel1='';$sel2=' selected';
}
?>
<option value="1"<?php echo $sel1; ?>>Advanced</option>
<option value="2"<?php echo $sel2; ?>>Expert</option>
<?php 
} else {
?>
<option value="1">Advanced</option>
<option value="2">Expert</option>
<?php 
}
?>
</select>
</select></td>
</tr>
<tr>
<th colspan=2> <input type=submit value="Enter Lol!" Submit name=Action></th>
</tr>
</table>
</form>
<?php 
}
?>