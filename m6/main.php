<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
include_once $game_nsheader;
if(empty($player_ip)){$player_ip=$_SERVER['REMOTE_ADDR'];}

if ($row->Loginfail) {

echo '<center><b><font color=red>WARNING: '.$row->Loginfail.' login attempts failures detected!<br>We suggest to change your password when more than 5 attemps are made.<br>Last login fail came from '.$row->Loginfailip.'. Please ask an admin to find out where the attemps came from if you would like to know.</font><p>Information cleared.</b></center>';
if (!empty($to_update)){$to_update .= ", `Loginfail`='0'";}else{$to_update = "`Loginfail`='0'";}

} else {

?><table cellpadding=0 cellspacing=1 border=0 width=100%><?php 
if($hresult = mysqli_query($link, "SELECT * FROM $tbl_history WHERE `Charname`='$row->Charname' ORDER BY `id` DESC")){
if($hrow = mysqli_fetch_object ($hresult)){
mysqli_free_result ($hresult);
if (isset($hrow->Charname)) {
$jail_time=$row->Jail-$current_time;if ($jail_time<=0) {$jail_time=0;}
$mute_time=$row->Mute-$current_time;if ($mute_time<=0) {$mute_time=0;}
$stealth=$row->Stealth-$current_time;if ($stealth<=0) {$stealth=0;}
echo "</tr><tr><th colspan=4>Main Overview of $row->Guild $row->Sex $row->Charname </th></tr><tr><td>Level</td><td>".number_format($row->Level)."</td><td>Exp</td><td>".number_format($row->Exp)."</td>
<tr><td>Race</td><td>".ucfirst($row->Race)."</td><td>Life</td><td>".number_format($row->Life)."</td></tr><tr><td>Stealth mode</td><td>".number_format($stealth)."</td><td>Active</td><td>".number_format($current_time-$row->Time)."</td></tr><tr><td>Monsters Killed</td><td>".number_format($hrow->Kills)."</td><td>Duels Won</td><td>".number_format($hrow->Duelsw)."</td></tr><tr><td>Deads by Monsters</td><td>".number_format($hrow->Deads)."</td><td>Duels Lost</td><td>".number_format($hrow->Duelsl)."</td></tr><tr><td>Total Fights</td><td>".number_format($hrow->Kills+$hrow->Deads)."</td><td>Total Duels</td><td>".number_format($hrow->Duelsw+$hrow->Duelsl)."</td></tr><tr><td>Mute</td><td>".number_format($mute_time)."</td><td>Jail</td><td>".number_format($jail_time)."</td></tr><tr><td>Gold</td><td>".number_format($row->Gold)."</td><td>Stash</td><td>".number_format($row->Stash*10)."</td></tr><tr><td>Last login ip</td><td>$row->Loginfailip</td><td>Current ip</td><td>$player_ip</td></tr>";
?>
<tr><th colspan=2 width=50%><a href="prefz.php">Preference</a></th><th colspan=2 width=50%><a href="friends.php">Friends</a></th></tr>
<?php 
}
}
}

if (empty($hrow->Charname)) {
print 'My '.$row->Sex.' '.$row->Charname.',<br>
<br>
Welcome to <b>'.$title.'</b>.<br>
<br>
Please always remember that this is just a game.<br>
A game is supposed to be fun so please always be nice to each other.<br>
Please do not use any foul language please.<br>
<br>
Thank you for your time and have fun,<br>
'.$admin_name.'<br>
<br>
<br>
<p align=center><b><a href="main.php">To start the game click here!</a></b></p>
';

$history="
'',
'$row->Charname',
'0',
'0',
'0',
'0'
";


mysqli_query($link, "INSERT INTO $tbl_history ($fld_history) VALUES ($history)") or print("Unable to insert main history.");
}
?>

</table>

<?php 
if (empty($row->Email)) {
?>
<p>
<hr>
<b>
WARNING : Your email is empty if you lose your password or account then none can help you!<br>
<a href="preference.php">Please click here and insert and email address.</a><br>
Don't trust the game? Create an new email with a free services.
</b>
<hr>
<p>
<?php 
}

echo<<<EOT
<hr>
<b>Please always include this information when you contact Admin SilenT</b><br>
<a href="mailto:silent@lordsoflords.com?subject=MID:$row->id,Game:Lol1,Server:$server,Username:$row->Username,Charname:$row->Charname">>>MID:$row->id,Game:Lol1,Server:$server,Username:$row->Username,Charname:$row->Charname<<</a>
<hr>
EOT;

/*_______________-=TheSilenT.CoM=-_________________*/

if ($row->Sex == 'Criminal') {
if (!empty($_GET['cleanme'])) {

if($cresult = mysqli_query($link, "SELECT * FROM `$tbl_credits` WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') ORDER BY `id` DESC LIMIT 1")){
if($crow = mysqli_fetch_object ($cresult)){
mysqli_free_result ($cresult);
if ($crow->Credits >= 1000) {
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`-1000 WHERE (`id`=$crow->id and Username='$row->Username' and `Charname`='$row->Charname') LIMIT 1") and $update_creds="UPDATE OKE creds" or $update_creds="FAILED TO UPDATE cred";

$to_updated="$to_updated, `Sex`='Lord'";

mail("criminal@lordsoflords.com", "CRIMINAL $row->Sex $row->Charname!", "CRIMINAL $row->Sex $row->Charname $update_creds $update_mem", "From: criminal@{$_SERVER['SERVER_NAME']}", "-fcriminal@{$_SERVER['SERVER_NAME']}");
?><br>HELP!!! FIRE! FIRE! We have some archives burned down in here.<?php 
}else{?><br>You do not have enough credits!.<?php }
}else{?><br>You do not have enough credits!..<?php }
}else{?><br>You do not have enough credits!...<?php }

} else {
?>
<br>
You are a Criminal! I know some high placed members of this world, if you would wish to clean up your criminal records I might know how do it.
<a href="?cleanme=1">Clean up criminal archief for 1.000 credits.</a>
<?php 
}
} //Criminal
} // no login failures
/*_______________-=TheSilenT.CoM=-_________________*/
include_once $game_footer;
?>