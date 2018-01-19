<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);
if (!empty($forum_sid)) {
array_push($search, "'java'", "'javascript'", "'document'", "'forms'", "'value'", "'style'", "';'");
array_push($replace, "", "", "", "", "", "");
$output='';

if(!empty($_GET['reset'])){
foreach ($_COOKIE as $key=>$val){if($key !== 'forum_sid'){setcookie($key, '', time()-5000000);}}
}

if(!empty($_POST['faction'])){
if(!empty($_POST['pcc'])){$pcc=clean_post($_POST['pcc']);
	if($pcc !== $pc){$pc=$pcc;setcookie("pc", $pcc, time()+5000000);
$output.='Changed personal color:'.$pcc.'<br>';}}
if(!empty($_POST['bg'])){$bg=clean_post($_POST['bg']);
	if($bg !== $col_bg){setcookie("bg", $bg, time()+5000000);
$output.='Changed background color :'.$bg.'<br>';}}
if(!empty($_POST['text'])){$text=clean_post($_POST['text']);
	if($text !== $col_text){setcookie("text", $text, time()+5000000);
$output.='Changed text color :'.$text.'<br>';}}
if(!empty($_POST['alink'])){$alink=clean_post($_POST['alink']);
	if($alink !== $col_link){setcookie("alink", $alink, time()+5000000);
$output.='Changed link color :'.$alink.'<br>';}}
if(!empty($_POST['th'])){$th=clean_post($_POST['th']);
	if($th !== $col_th){setcookie("th", $th, time()+5000000);
$output.='Changed th color :'.$th.'<br>';}}
if(!empty($_POST['form'])){$form=clean_post($_POST['form']);
	if($form !== $col_form){$form=$col_form;setcookie("form", $form, time()+5000000);
$output.='Changed form color :'.$form.'<br>';}}
if(!empty($_POST['family'])){$family=clean_post($_POST['family']);
	if($family !== $font_family){$family=$font_family;setcookie("family", $family, time()+5000000);
$output.='Changed font family :'.$family.'<br>';}}
if(!empty($_POST['fsize'])){$fsize=clean_post($_POST['fsize']);
	if($fsize !== $font_size){$fsize=$font_size;setcookie("fsize", $fsize, time()+5000000);
$output.='Changed font size :'.$fsize.'<br>';}}
}
?>
<table width="100%" border=0 cellpadding=0 cellspacing=0>
<tr><th colspan=2>Account Preferences</th></tr>
<?php 

$row->email=stripslashes($row->email);

if (!empty($_POST['passworda']) and !empty($_POST['passwordb'])) {$passworda=clean_post($_POST['passworda']);$passwordb=clean_post($_POST['passwordb']);
if ($passworda==$passwordb and $passworda !==$row->password) {
$passworda=crypt($passworda,$row->username);
$update_it .=", password='$passworda'";
$output.='Changed password to :'.$passwordb.'<br>';}}

if (!empty($_POST['email'])) {$email=clean_post($_POST['email']);if ($email !==$row->email) {
$update_it .=", email='$email', ev='0'";
$key=crypt($email,$row->username);
$message="Hi $row->sex $row->charname,

Your email change request is successful.

Your account will be reactivated after you have visited the url below:

$root_url/confirm.php?key=$key&member=$row->charname

Thank you for your time,
Admin SilenT
";
mail("$email", "$row->sex $row->charname lol forum email change", $message,
 "From: forum@{$_SERVER['SERVER_NAME']}", "-fforum@{$_SERVER['SERVER_NAME']}");
$output.='Changed email to :'.$email.'<br>';}}

if (!empty($_POST['msn'])) {$msn=clean_post($_POST['msn']);if ($msn !==$row->msn) {
$msn=clean_post($msn);$update_it .=", msn='$msn'";
$output.='Changed msn to :'.$msn.'<br>';}}

if (!empty($_POST['icq'])) {$icq=clean_post($_POST['icq']);if ($icq !==$row->icq) {
$icq=clean_post($icq);$update_it .=", icq='$icq'";
$output.='Changed icq to :'.$icq.'<br>';}}

if (!empty($_POST['aim'])) {$aim=clean_post($_POST['aim']);if ($aim !==$row->aim) {
$aim=clean_post($aim);$update_it .=", aim='$aim'";
$output.='Changed aim to :'.$aim.'<br>';}}

if (!empty($_POST['yahoo'])) {$yahoo=clean_post($_POST['yahoo']);if ($yahoo !==$row->yahoo) {
$yahoo=clean_post($yahoo);$update_it .=", yahoo='$yahoo'";
$output.='Changed yahoo to :'.$yahoo.'<br>';}}

if (!empty($_POST['avatar'])) {$avatar=clean_post($_POST['avatar']);if ($avatar !==$row->avatar) {
$avatar=clean_post($avatar);

list($width, $height, $type, $attr) = getimagesize("$avatar");
if ($width <= 125 and $height <= 125 and $width >= 5 and $height >= 5) {
$update_it .=", avatar='$avatar'";
$output.='Image '.$width.' x '.$height.' is approved, changed avatar to :'.$avatar.'<br>';
} else {$output.='Avatar size '.$width.' x '.$height.' is to big! Removed!.<br>';$update_it .=", avatar=''";}
}}

if (!empty($_POST['signature'])) {$signature=clean_post($_POST['signature']);if ($signature !==$row->signature) {
$signature=clean_post($signature);$update_it .=", signature='$signature'";
$output.='Changed signature to :'.$signature.'<br>';}}

if (!empty($_POST['ec'])) {$ec=clean_post($_POST['ec']);if ($ec=='Yes') {$ec=1;} else {$ec=0;} if ($ec <> $row->ec) {
$ec=clean_post($ec);$update_it .=", ec='$ec'";
$output.='Changed Show contact details<br>';
}}

if(!empty($output)){
print '<table><tr><td>'.$output.'</td></tr></table>';
}else{
?>
<form method=post><table width=100% align=center>
<tr><td>New password</td><td><input type=password name=passworda value="" maxlength=50></td></tr>
<tr><td>Verify password</td><td><input type=password name=passwordb value="" maxlength=50></td></tr>
<tr><td>Email <font size=-1>Must be reactivated to post</td><td><input type=text name=email value="<?php print $row->email;?>" maxlength=50></td></tr>
<tr><td>MSN</td><td><input type=text name=msn value="<?php print $row->msn;?>" maxlength=50></td></tr>
<tr><td>ICQ</td><td><input type=text name=icq value="<?php print $row->icq;?>" maxlength=50></td></tr>
<tr><td>AIM</td><td><input type=text name=aim value="<?php print $row->aim;?>" maxlength=50></td></tr>
<tr><td>Y!</td><td><input type=text name=yahoo value="<?php print $row->yahoo;?>" maxlength=50></td></tr>
<tr><td>Avatar <font size=-1>Not bigger than 125 width x 125 height, 255 chars max, full url only no tags example:https://thesilent.com/images/thesilent/silents.jpg!</font></td><td><input type=text name=avatar value="<?php print $row->avatar;?>" maxlength=255></td></tr>
<tr><td>Signature <font size=-1>See help for images, not bigger than 240 width x 120 height and 255 chars max, images must be put in tags example:[img]https://thesilent.com/images/thesilent/silents.jpg[/img]</font></td><td><input type=text name=signature value="<?php print $row->signature;?>" maxlength=255></td></tr>
<tr><td>Show all contact details</td><td><select name=ec>
<?php if ($row->ec) {?><option>No</option><option selected>Yes</option><?php } else {?><option selected>No</option><option>Yes</option><?php }?></select></td></tr>
<tr><th colspan=2><input type=submit name=action value="Modify Account Preferences!"></th></tr>
</table><table width=100% align=center>
<tr><th colspan=2>Site and Color Settings <a href="?reset=1">reset all</a></th></tr>
<tr><td>Personal Color<font color="<?php print ($pc)?$pc:'';?>"> EXAMPLE</font> color</td><td><input type=text name=pcc value="<?php print isset($_COOKIE['pc'])?$_COOKIE['pc']:'';?>" maxlength=10></td></tr>
<tr><td>Background Color<font color="<?php print ($col_bg)?$col_bg:'';?>"> EXAMPLE</font> color</td><td><input type=text name=bg value="<?php print isset($_COOKIE['bg'])?$_COOKIE['bg']:'';?>" maxlength=10></td></tr>
<tr><td>Text Color<font color="<?php print ($col_text)?$col_text:'';?>"> EXAMPLE</font> color</td><td><input type=text name=text value="<?php print isset($_COOKIE['text'])?$_COOKIE['text']:'';?>" maxlength=10></td></tr>
<tr><td>Link Color<font color="<?php print ($col_link)?$col_link:'';?>"> EXAMPLE</font> color</td><td><input type=text name=alink value="<?php print isset($_COOKIE['link'])?$_COOKIE['link']:'';?>" maxlength=10></td></tr>
<tr><td>Table Color<font color="<?php print ($col_th)?$col_th:'';?>"> EXAMPLE</font> color</td><td><input type=text name=th value="<?php print isset($_COOKIE['th'])?$_COOKIE['th']:'';?>" maxlength=10></td></tr>
<tr><td>Form Color<font color="<?php print ($col_form)?$col_form:'';?>"> EXAMPLE</font> color</td><td><input type=text name=form value="<?php print isset($_COOKIE['form'])?$_COOKIE['form']:'';?>" maxlength=10></td></tr>
<tr><td>Font<font face="<?php print ($font_family)?$font_family:'';?>"> EXAMPLE</font> font family</td><td><input type=text name=form value="<?php print isset($_COOKIE['family'])?$_COOKIE['family']:'';?>" maxlength=10></td></tr>
<tr><td>Font<font style="size:<?php print ($font_size)?$font_size:'';?>;"> EXAMPLE</font> font size</td><td><input type=text name=form value="<?php print isset($_COOKIE['fsize'])?$_COOKIE['fsize']:'';?>" maxlength=10></td></tr>

<tr><th colspan=2><input type=submit name=faction value="Change Site And Color Settings!"></th></tr>
</table></form>
<?php 
}
} else {
?>Please login to change your account information and site colors.<?php 
}
require_once($html_footer);
?>