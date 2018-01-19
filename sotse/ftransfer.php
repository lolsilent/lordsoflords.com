<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

if (!empty($_POST['Players'])) {
$Players=$_POST['Players'];
$bresult=mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (`Charname`='$Players') ORDER BY `id` DESC LIMIT 1");
if (!empty($bresult)) {
$brow = mysqli_fetch_object ($bresult);
mysqli_free_result ($bresult);

if ($row->Level >= 100 and ($row->Freeplay-time()) > 5000 and $Players == $brow->Charname and $row->Freeplay > $brow->Freeplay and $brow->Charname != $row->Charname) {
$to_update .= ", Freeplay='$brow->Freeplay'";
mysqli_query($link, "UPDATE `$tbl_members` SET Freeplay='$row->Freeplay' WHERE `id`=$brow->id LIMIT 1");
echo "Freeplay has been exchanged successfully!";
mysqli_query($link, "INSERT INTO $tbl_logs ($fld_logs) values ('','$row->Charname','FP exchanged with $brow->Charname','".$_SERVER['PHP_SELF']."','$current_date','".$_SERVER['REMOTE_ADDR']."')");
} else {
?>Something went wrong please make sure the Charname correct, they are case sensitive!<br>You must be over level 100 and the minimum freeplay is 5,000. The sender must have a higher FP value to prevent FP stealing!<?php 
}
} else {?>Charname was not found! A typo maybe?<?php }
}
?>
<form method=post enctype="application/x-www-form-urlencoded">
<table border=0 cellpadding=0 cellspacing=1 width=100%>
<tr>
<th colspan=2>Freeplay Exchanger</th>
</tr><tr><td width="50%">
Exchange Freeplay with</td><td width="50%"><select name="Players"><?php 
$mresult = mysqli_query($link, "SELECT Sex,Charname,Level FROM $tbl_members WHERE (`Charname`!='$row->Charname' and Onoff) ORDER BY Level desc") or die ("Query failed");
if (!empty($mresult)) {
while ($mrow = mysqli_fetch_object ($mresult)) {
echo "<option value=\"$mrow->Charname\">$mrow->Sex $mrow->Charname [$mrow->Level]</option>";
}
mysqli_free_result ($mresult);
}
?></select></td></tr>
<tr><td colspan=2><input type=submit name=action value="Do it!"></td></tr>
</table>
Freeplay cannot be transferred it can only be exchanged with one of your other chars. BE CAREFUL if you want it back from the other char because the minimum amount is 5.000 seconds and the other player must be over level 100. This is to prevent creating a new char and transfer the 5.000 start freeplay to your stronger char. The sender must have a higher FP value to prevent FP stealing!<br>
<?php 
include_once("www.prefpages.php");
include_once $game_footer;
?>