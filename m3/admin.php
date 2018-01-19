<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once("$game_header");

$no_acces = 'No authority to cast this magic spell.';
if (in_array($row->Sex,$operators)) {

require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/functions.meadow_admin.php');
/*
FUNCTIONS :
admin_finder
admin_sex
admin_lock

admin_mute
admin_jail
admin_logs

admin_reset
admin_rename
*/

?><table cellpadding=2 cellspacing=2 border=0 width=100%><tr><th colspan=2>Admin Tools for <?php print $server;?></th></tr><tr><td width=125 valign=top>
<a href="?finder">The Punisher</a><br>
<a href="?sex">Sex Machine</a><br>
<a href="?lock">Account Lock</a><br>
<br>
<a href="?mute">Mute List</a><br>
<a href="?jail">Jail List</a><br>
<a href="?logs">Logs</a><br>
<br>
<a href="?donations">Donations</a><br>
<a href="?reset">Server Reset</a><br>
<a href="?rename">Rename</a><br>


</td><td valign=top><?php 

if (isset($_GET['sex'])) {
if ($row->Sex == 'Admin') {admin_sex();}else{print $no_acces;}
}elseif (isset($_GET['lock'])) {
admin_lock();
}elseif (isset($_GET['mute'])) {
admin_mute();
}elseif (isset($_GET['jail'])) {
admin_jail();
}elseif (isset($_GET['logs'])) {
if ($row->Sex == 'Admin') {admin_logs();}else{print $no_acces;}
}elseif (isset($_GET['donations'])) {
if ($row->Sex == 'Admin') {admin_donations();}else{print $no_acces;}
}elseif (isset($_GET['reset'])) {
print $no_acces;
}elseif (isset($_GET['rename'])) {
print $no_acces;
}else{
admin_finder();
}

?></td></tr></table><?php 
}else{
print $no_acces;
}


$messing='Admin Log : ';
foreach ($_POST as $key=>$val) {
	$messing .= clean_post($key).' '.clean_post($val).' ';
}
foreach ($_GET as $key=>$val) {
	$messing .= clean_post($key).' '.clean_post($val).' ';
}
mysqli_query($link, "INSERT INTO `$tbl_logs` ($fld_logs) values ('','$row->Charname','$messing','$PHP_SELF','$current_date','$REMOTE_ADDR')");

include_once("$game_footer");
?>