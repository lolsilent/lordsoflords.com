<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);

$fields=0;
if (!empty($_POST['username'])) {$username=clean_input($_POST['username']);$fields++;} else {$username='';}
if (!empty($_POST['password'])) {$password=clean_post($_POST['password']);$fields++;} else {$password='';}
if (!empty($_POST['sex'])) {$sex='Lady';}else{$sex='Lord';}
if (!empty($_POST['charname'])) {$charname=clean_input($_POST['charname']);if(!empty($charname)){$fields++;}} else {$charname='';}
if(!empty($_POST['email'])){$email=clean_post($_POST['email']);$fields++;}else{$email='';}

if(!empty($_POST['asap'])){$asap=clean_post($_POST['asap']);}else{$asap='';}
if(!empty($_POST['isap'])){$isap=clean_post($_POST['isap']);$fields++;}else{$isap='';}

if($fields >= 4 AND !empty($_POST['asap']) and isset($_POST['isap'])){
$saping = sap_me($_POST['asap'],$_POST['isap']);
if ($saping == 'OKE') {
$password=crypt($password,$username);
$forum_sid=md5($current_time);
$value="'','$forum_sid','$username','$password','$sex','$charname','$email','0','0','','','','','','','0','0','0','$current_time','$current_time','$current_date','0','$ip'";

if (mysqli_query($link, "INSERT INTO $tbl_members ($fld_members) values ($value)")) {
print '<table width=100%><tr><td>
<p>Hi '.$sex.' '.$charname.',</p>
Please take a minute to read our the rules for posting!<br>
<br>
An email is on your way containing an activating link.<br>
<br>
Please be aware that your account will be deleted after 300 days of inactivity.<br>
<br>
Have fun and good posting!<br>
<br>
Thank you for your time,<br>
Admin SilenT
</td></tr></table>';

$key=crypt($email,$username);
$message="Welcome $sex $charname,

Thank you creating an forum account.
To enable yourself to post messages you must visit the url below:

$root_url/confirm.php?key=$key&member=$charname

If the link doesn't work please copy and paste the url.

Thank you for your time,
Admin SilenT
";

mail("$email", "Lords of Lords forums account activator", $message,
 "From: forum@{$_SERVER['SERVER_NAME']}", "-fforum@{$_SERVER['SERVER_NAME']}");
}else{?>Sorry that username or charname is already taken please choose another one.<?php }
}else{print 'Error id 123.';}//saping
}else{?>
<form method=post>
<table align=center>
<tr><th colspan=2>Login Information<br><font size=-1>can't be seen by other players and is case sensitive</font></th></tr>
<tr><td>Username<br><font size=-1>Maxlength is 15 chars, minimum of 4 chars
Please use only alphabetic and numeric characters. </font></td><td width=50%><input type=text name=username maxlength=15 value="<?php print $username;?>"></td></tr>
<tr><td>Password<br><font size=-1>Maxlength is 15 chars, minimum of 4 chars
Please use only alphabetic and numeric characters. </font></td><td><input type=password name=password maxlength=15></td></tr>
<tr><th colspan=2>Forum Information<br><font size=-1>Is visible to all players and is case sensitive </font></th></tr>
<tr><td>Sex</td><td><select name=sex><option value="" selected>Lord</option><option value="1">Lady</option></select></td></tr>
<tr><td>Charname<br><font size=-1>Maxlength is 15 chars, minimum of 4 chars
Please use only alphabetic and numeric characters. </font></td><td><input type=text name=charname maxlength=15 value="<?php print $charname;?>"></td></tr>
<tr><td>Email<br><font size=-1>Must be an valid email address, needed for account activation.</font></td><td><input type=text name=email maxlength=50 value="<?php print $email;?>"></td></tr>

<tr>
<th colspan=2>
Simple Automatism Protection
</th>
</tr>
<tr>
<td width=50%>
<?php 
list ($sapa,$sapb,$sapc) = get_sap();
?>
<input type=hidden name=asap value="<?php echo "$sapa $sapb $sapc"; ?>">
How much is <b><?php echo "$sapa$sapb$sapc"; ?></b>?
<br><font size=1>too difficult? refresh page try again
</td>
<td>
<input type=text name=isap value="">
</td>
</tr>

<tr><th colspan=2><input type=submit name=action value="Create account"></th></tr>
</table>
</form>
<?php 
}
require_once($html_footer);?>