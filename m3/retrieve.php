<?php 

#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once("$html_header");

if (!empty($_POST['email']) and !empty($_POST['username'])) {
$email		= clean_post($_POST['email']);
$username	= clean_post($_POST['username']);

require_once 'AdMiN/www.mysql.php';
$link = mysqli_connect($db_host, $db_user, $db_password) or die("$error_message : Unable to connect to database");
mysqli_select_db($link, "$db_main") or die( "$error_message : Unable to select database");
if ($result = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (`Username`='$username') ORDER BY `id` DESC LIMIT 1")) {
if ($row = mysqli_fetch_object ($result)) {
mysqli_free_result ($result);

$row->Email=clean_post($row->Email);

if ($email == $row->Email and $username == $row->Username) {
$new_pass=lottery_ticket();
$message="
Hi $row->Charname,

You have requested password for:
Username :
$row->Username
NEW Password NEW !!!:
$new_pass

After you have logged in you can change your password :
$root_url/login.php

Cheers,
$admin_name

If you didn't request this then someone else did your account info is only send to you and is secure if this happens often better change your email.
";
$new_pass=crypt($new_pass,$row->Username);
mysqli_query($link, "UPDATE `$tbl_members` SET Password='$new_pass' WHERE `id`=$row->id LIMIT 1");
$row->Email=strtolower($row->Email);

$to = $row->Email;
$subject = "$title new password";

$message = wordwrap($message, 70, "\r\n");

$headers = array("From: password@lordsoflords.com",
"Reply-To: password@lordsoflords.com",
"X-Mailer: PHP/" . PHP_VERSION);
$headers = implode("\r\n", $headers);
//print "$to, $subject, $message, $headers";


//mail ($to, $subject, $message, $headers) or die("Mail error1.");


mail("$row->Email", "$title new password", "$message", "From: password@lordsoflords.com", "-fpassword@lordsoflords.com") or die("Mail error2.");


//mail("admin@thesilent.com", "$title new password", $message,"From: password@lordsoflords.com", "-fpassword@lordsoflords.com") or die("Mail error.");

echo "An emails has been send to $row->Email containing a new password.";
} else {
?>Sorry username or email mismatch!<?php 
}
}
}
mysqli_close ($link);

} //!empty _POST
?>
<form method=post>
<table width=80% cellpadding=0 cellspacing=0 border=0>
<tr><th colspan=2>
Request password by email
</th></tr>
<tr><td width=50%>
Username<br><font size=1>
</td><td>
<input type=text name=username value="" maxlength=50>
</td></tr>
<tr><td width=50%>
Email<br><font size=1>
</td><td>
<input type=text name=email value="" maxlength=50>
</td></tr>
<tr><td colspan=2>
<input type=submit name=action value="Send me the email">
</td></tr>
</table>
</from>
An email will be send to you with username and password, only if you have set an email!
<?php 
include_once("$html_footer");
?>
