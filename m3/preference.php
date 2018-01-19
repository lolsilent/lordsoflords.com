<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

array_push($search, "'java'", "'javascript'", "'document'", "'forms'", "'value'", "'style'", "','", "'='", "':'", "';'");
array_push($replace, "", "", "", "", "", "", "", "", "");

	//password
if (!empty($_POST['current']) and !empty($_POST['newa']) and !empty($_POST['newb'])) {
$current=clean_input($_POST['current']);$newa=clean_input($_POST['newa']);$newb=clean_input($_POST['newb']);
if ($newb == $newa) {

if ($_COOKIE['lol_Charname'] == "$row->Charname") {
	$current=crypt($current,$row->Username);
	$newb=crypt($newb,$row->Username);
if ($row->Password == $current) {
if ($newa == $row->Password or $row->Password == $newb) {
echo "New password is the same. Nothing changed";
} else {
$to_update .= ", Password='$newb'";
echo "Password changed to <b>$newa</b>.";
}
} else {
echo "Given current password is incorrect.";
}
}


} else {
echo "Confirmed password is not equal to the new password.";
}
}
	//email
if (!empty($_POST['emaila']) and !empty($_POST['emailb']) and isset($_POST['email'])) {
$email=clean_post($_POST['email']);
$emaila=clean_post($_POST['emaila']);
$emailb=clean_post($_POST['emailb']);
	if (empty($email)) {$email='';}
	$row->Email=stripslashes($row->Email);
if (preg_match("/.+@.+\..+/", "$emaila") and $emaila == $emailb and $emaila !== $row->Email and $email == $row->Email) {
$to_update .= ", Email='$emailb'";
echo "Email changed to <b>$emailb</b>.";
} else {
echo "That new email address is not accepted or same as current please try again.";
}
}
?>
<form method=post>
<table cellpadding=0 cellspacing=1 border=0 width=100%> <tr><th colspan=2>Change password Max length is 10 chars.</th></tr>
<tr><td width="50%">Current password</td><td align=right width="50%"><input type=password name=current maxlength=50></td></tr>
<tr><td>New password<font size=1> min 4 chars</td><td align=right><input type=password name=newa maxlength=10></td></tr>
<tr><td>Confirm password<font size=1> min 4 chars</td><td align=right><input type=password name=newb maxlength=10></td></tr>
<tr><th colspan=2><input type=submit name=Action value="Change password"></th></tr>
</table><form>

<form method=post>
<table cellpadding=0 cellspacing=1 border=0 width=100%> <tr><th colspan=2>Change or set email address Max length is 50 chars.</th></tr>
<tr><td width="50%">Current email</td><td align=right width="50%"><input type=text name=email value="" maxlength=50></td></tr>
<tr><td width="50%">New email</td><td align=right width="50%"><input type=text name=emaila value="" maxlength=50></td></tr>
<tr><td width="50%">Confirm email</td><td align=right width="50%"><input type=text name=emailb value="" maxlength=50></td></tr>
<tr><th colspan=2><input type=submit name=Action value="Set email"></th></tr>
</table><form>

If your email is incorrect you won't be able to retrieve your password when you forget it! This email is used for password recovery only! Didn't set an email yet? Leave the <b>'Current email'</b> field empty.
<br>
<?php 
include_once("www.prefpages.php");
include_once $game_footer;
?>