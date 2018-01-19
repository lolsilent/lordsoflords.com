<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);
?><table width=100%><tr><th>Account Activation Confirmed</th></tr><tr><td><?php 
if (!empty($_GET['key']) and !empty($_GET['member'])) {
$key=clean_post($_GET['key']);$member=clean_post($_GET['member']);
if($cresult=mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `charname`='$member' and `ev`='0' ORDER BY `id` asc LIMIT 1")){
if($cmrow=mysqli_fetch_object ($cresult)){
mysqli_free_result ($cresult);

setcookie("forum_sid", "$cmrow->sid", $current_time+(84600*30));

$inkey=crypt($cmrow->email,$cmrow->username);
if ($member==$cmrow->charname and $key==$inkey) {
//, `level`='1' 30-7-2008 20:42:29
mysqli_query($link, "UPDATE `$tbl_members` SET `ev`='1' WHERE `id`='$cmrow->id' LIMIT 1");
print 'Hi '.$cmrow->sex.' '.$cmrow->charname;?>,<br>Your account has been activated for posting!<br>
<br>
Please take a minute to read our the rules for posting!<br>
<br>
Please be aware that your account will be deleted after 300 days of inactivity.<br>
<br>
Have fun and good posting!<br>
<br>
Thank you for your time,<br>
Admin SilenT<?php 

} else {?>Sorry key or member mismatch<?php }
}
}

} else {?>Something must have gone wrong please copy and paste the link from your email and try again.<?php }
?></td></tr></table><?php 
require_once($html_footer);
?>