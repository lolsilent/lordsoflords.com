<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
include_once $clean_header;
if (!empty($_COOKIE['lol_Username']) and !empty($_COOKIE['lol_Charname']) and !empty($_COOKIE['lol_Session'])) {
$before_chat="<b>When you reach level 100 or above you have to re login for chat ability.</b>";

$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");

$query = "SELECT * FROM `$tbl_members` WHERE (`Username`='".$_COOKIE['lol_Username']."' and `Charname`='".$_COOKIE['lol_Charname']."' and `Onoff`) ORDER BY `id` DESC Limit 1";
$result = mysqli_query($link, $query) or die ($before_chat);
$row = mysqli_fetch_object ($result) or die ($before_chat);
mysqli_free_result ($result);
mysqli_close($link);
if ($row->Level >= 100) {
?>
<form name="chat" method="post" target="lol_chit" action="chat.php">
<table width=100% border=0 cellpadding=1 cellspacing=0>
<tr><td width=70%><input type=text name="Message" size=35 maxlength=255 onFocus="document.chat.Message.value='';document.chat.Message.select()"></td>
<td width=10%><input type=submit name="Action" value="Post"></td>
</form>
<?php if (in_array($row->Sex,$operators) and $row->Sex !=='Support') {
$iswidth=5;
?>
<form method=post target="lol_main" action="admin.php"><td width=5%><input type=submit name="Action" value="<?php echo $row->Sex; ?>"</td></form>
<?php 
} else {
$iswidth=10;
}
?>
<form method=post><td width=<?php echo $iswidth;?>%><input type=submit name="Action" value="Clear" onmouseover="document.chat.Message.value='';document.chat.Message.select()"></td></form>
<form method=post target="lol_chit" action="chat_global.php"><td width=5%><input type=submit name="Action" value="Global" onClick="window.parent.frames['lol_control'].location='<?php echo $root_url;?>/chat_control_global.php'"></td></form></tr></table>
<?php 
} else {
echo $before_chat;
}

} else {?><b>Cookie set failure!</b><?php }
include_once $clean_footer;
?>