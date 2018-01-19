<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);
?><center><?php 

$fields=0;
if(!empty($_POST['username'])){$username=clean_input($_POST['username']);$username and $fields++;}else{$username='';}
if(!empty($_POST['email'])){$email=clean_post($_POST['email']);$fields++;}else{$email='';}

if($fields==2){
	if (preg_match("/.+@.+\..+/", "$email")) {

if($mresult=mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (`username`='$username' and `email`='$email') LIMIT 1")){
$mrow=mysqli_fetch_object($mresult);
mysqli_free_result($mresult);

if($username == $mrow->username and $email == $mrow->email){

$mrow->email=stripslashes($mrow->email);

$new_pass=substr(md5(crypt($current_time)),0,10);
$message="
Hi $mrow->sex $mrow->charname,

you have requested password for:
username :
$mrow->username
NEW password NEW !!!:
$new_pass

After you have logged in you can change your password :
https://lordsoflords.com/forums/

Cheers,
Admin SilenT

If you didn't request this then someone else did your account info is only send to you and is secure if this happens often better change your email.
";
$new_pass=crypt($new_pass,$mrow->username);
mysqli_query($link, "UPDATE `$tbl_members` SET `password`='$new_pass' WHERE `id`='$mrow->id' LIMIT 1") or die('Oops1');
$mrow->email=strtolower($mrow->email);
mail("$mrow->email","Lords of Lords forums new password","$message",
 "From: password@lordsoflords.com", "-fpassword@lordsoflords.com") or die('Oops2');

print "An emails has been send to $mrow->email containing a new password.";
}else{?>Sorry no such combination of Username and/or Email!<?php }
}else{?>Sorry no such combination of Username and/or Email!.<?php }

	}else{?>Your input of the email address doesn't look like a real email address, action has been canceled.<br><?php }
}
?>
<form method="post">
<table cellpadding="1" cellspacing="1" border="0" width="300">
<tr><th colspan="2">
Request a new password by email
</th></tr>
<tr><td width="50%">
Username
</td><td>
<input type="text" name="username" value="" maxlength="10">
</td></tr>
<tr><td width="50%">
Email
</td><td>
<input type="text" name="email" value="" maxlength="50">
</td></tr>
<tr><th colspan="2">
<input type="submit" name="action" value="Send an email">
</th></tr>
</table>
</form>
A new password will be created and your account will be unlocked if it was locked.</center>
<?php 
require_once($html_footer);
?>