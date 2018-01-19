<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/www.faces.php';
include_once("$html_header");
?>Free text based online RPG game, fight monsters, explore worlds, chat or duel other online players.<br>
<b>More than 20 races, fast fighting, no email required to sign up, it's easy, it's fast, it's free!</b>.<br><?php 

$link = mysqli_connect($db_host, $db_user, $db_password) or die("Unable to connect to database");
mysqli_select_db($link,"$db_main") or die("Unable to select database");


//ACTIVATE PLAYER TESTACTIVATE PLAYER TESTACTIVATE PLAYER**************
//mysqli_query($link, "UPDATE LOW_PRIORITY `$tbl_members` SET `Onoff`='1',`Time`='$current_time' WHERE `id`>='".rand(1,60000)."' LIMIT 5");
//mysqli_query($link, "UPDATE LOW_PRIORITY `$tbl_members` SET `Gold`='0' WHERE `Gold`<'0' LIMIT 10");
//ACTIVATE PLAYER TESTACTIVATE PLAYER TESTACTIVATE PLAYER**************


if($result = mysqli_query($link, "SELECT `id` FROM `$tbl_members` WHERE `id`")){
?><br>Their are <b><?php echo number_format(mysqli_num_rows($result)); ?></b> warriors and wizards that kept their character alive and kicking.<br><?php 
mysqli_free_result ($result);
}

if($result = mysqli_query($link, "SELECT `Sex`,`Charname` FROM `$tbl_members` WHERE `id` ORDER BY `id` DESC LIMIT 1")){
if($nrow = mysqli_fetch_object ($result)){
mysqli_free_result ($result);
print 'We welcome our newest adventurer <b><a href="members.php?info='.$nrow->Charname.'">'.$nrow->Sex.' '.$nrow->Charname.'</a></b><br>';
}
}

?><table width="100%" cellpadding=0 cellspacing=1 border=0 align=center>
<tr><th colspan=7>Top online exp players</th></tr>
<tr><th>#</th><th>Charname</th><th>Race</th><th align=right>Level</th><th align=right>Exp</th><th align=right>Gold</th><th align=right>Active</th></tr>
<?php 
if($result = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (`Onoff` and `Sex`!='Admin') ORDER BY `Level` DESC LIMIT 100000")){
$i=1;
while ($row = mysqli_fetch_object ($result)) {

if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
print '<tr'.$bgcolor.'><td>'.$i.'</td><td><a href="members.php?info='.$row->Charname.'">';

	//Premium member
print (($row->Freeplay-$current_time) > 1)?'<img src="'.$emotions_url.'/star.gif" border=0 alt="Premium member">':'';

print $row->Sex.' '.$row->Charname.'</a>';

	//Mute
if ($row->Mute >= $current_time) {
	$mute_timer = $row->Mute-$current_time;
print '<sup title="Def and Muted player!"><b>DM('.($mute_timer >= 1000 ?number_format($mute_timer/1000).'K':number_format($mute_timer)).')</b></sup>';
}

	//Logoff 1000
if (($current_time-$row->Time) > 1000) {
	print '<sup>Forced logout</sup>';
mysqli_query($link, "UPDATE LOW_PRIORITY `$tbl_members` SET `Onoff`='0',`Time`='$current_time' WHERE `id`='$row->id' LIMIT 1");
}

print '</td><td>'.ucfirst($row->Race).'</td><td align=right>'.number_format($row->Level).'</td><td align=right>'.lint($row->Exp).'</td><td align=right>'.lint($row->Gold).'</td><td align=right>'.number_format($current_time-$row->Time).'</td></tr>';

$i++;
}
mysqli_free_result ($result);
}


?>
<tr><th colspan=7>Their are now <?php print number_format($i-1); ?> visible players online!</th></tr>
</table>
<?php 
//battles took place //date `total` and `timer`=days on id 1!!
if($fresult=mysqli_query($link, "SELECT * FROM `$tbl_index` WHERE `id` ORDER BY `id` DESC LIMIT 50")){
if(mysqli_num_rows($fresult) >= 1){

if($mfresult=mysqli_query($link, "SELECT * FROM `$tbl_index` WHERE `id` ORDER BY `fights` DESC LIMIT 1")){
$most_fobj=mysqli_fetch_object($mfresult);mysqli_free_result($mfresult);}

?><br><br><table cellpadding="1" cellspacing="1" border="0" width="100%"><tr><th>Battles</th></tr><?php 
$i=0;$oldtotal=0;$tdays=0;$sumbattles=0;while($fobj=mysqli_fetch_object($fresult)){$i++;
if($fobj->date == 'total'){$oldtotal=$fobj->fights;$tdays+=$fobj->timer;}else{$sumbattles+=$fobj->fights;$tdays++;}

if($fobj->date !== 'total' and $i<=7){?><tr<?php if(empty($bg)){?> bgcolor="<?php print $col_th;$bg=1;?>"<?php }else{$bg='';}?>><td><?php if(date('m d Y')==$fobj->date){?>Today<?php }else{print $fobj->date;}print ' with '.number_format($fobj->fights);?> battles!</td></tr><?php }

if($i>7 and $fobj->date !== 'total' and $fobj->fights < $most_fobj->fights){
	mysqli_query($link, "DELETE FROM `$tbl_index` WHERE `id`=$fobj->id and `date`!='total' LIMIT 1");
	mysqli_query($link, "UPDATE `$tbl_index` SET `fights`=`fights`+$fobj->fights WHERE `date`='total',`timer`=`timer`+1 LIMIT 1");
}

}mysqli_free_result($fresult);
?><tr><th>With a grandtotal <?php echo number_format($oldtotal+$sumbattles);?> battles in <?php echo lint($tdays).' day'; print $tdays>1?'s':'';?>!<br>Most slaughtering happened on <?php print $most_fobj->date.' with '.number_format($most_fobj->fights);?> battles.</th></tr></table><?php }}
mysqli_close($link);
?>
<b>
If you like this game please tell your friends. Easy to remember url <br>
<a href="https://lordsoflords.com" target="_top">https://lordsoflords.com</a>
</b>
<br>
And don't forget to bookmark :o)...
<br>

<?php 
include_once("$html_footer");
?>