<?php 
#!/usr/local/bin/php
/*
###_______________-=TheSilenT.CoM=-_______________###
Project name	: Messaging Funcion
Script name	: Script name
Version		: 1.00
Release date	: 2-15-2008 03:32:55
Last Update	: 2-15-2008 03:32:55
Email		: admin@thesilent.com
Homepage	: https://thesilent.com
Created by	: TheSilent
Last modified by	: TheSilent
###_______________COPYRIGHT NOTICE_______________###
# Redistributing this software in part or in whole strictly prohibited.
# You may use and modified my software as you wish. 
# If you want to make money from my work please ask first. 
# By using this free software you agree not to blame me for any
# liability that might arise from it's use.
# In all cases this copyright notice and the comments above must remain intact.
# Copyright (c) 2001 TheSilenT.CoM. All Rights Reserved.
###_______________COPYRIGHT NOTICE_______________###
*/


function admin_donations() {
	print 'function disabled.';
	exit;
	global $link,$tbl_paypal;
if($presult=mysqli_query($link,"SELECT * FROM `$tbl_paypal` WHERE (`month`='".date("m")."' and `year`='".date("Y")."') ORDER BY `amount` DESC LIMIT 100")){
if(mysqli_num_rows($presult) >= 1){?><table cellpadding="1" cellspacing="1" border="0" width="100%">
<tr><th colspan="2">This month we thank these players who donated to the game</th></tr><?php 
$amount=0;$i=0;
while($pobj=mysqli_fetch_object($presult)){
?><tr<?php if(empty($bg)){?> bgcolor="<?php echo $col_th;$bg=1;?>"<?php }else{$bg='';}?>><td><?php echo $pobj->ip;?></td><td>$<?php echo number_format($pobj->amount,2);?></td></tr><?php 
$amount+=$pobj->amount;$i++;
}
mysqli_free_result($presult);
?><tr><td><?php echo number_format($i);?> players donated </td><td>$<?php echo number_format($amount,2);?></td></tr></table><?php 
}}
}
/*_______________-=TheSilenT.CoM=-_________________*/
function admin_rename(){}

/*_______________-=TheSilenT.CoM=-_________________*/

function admin_reset(){}
/*_______________-=TheSilenT.CoM=-_________________*/

function admin_finder() {
	global $link,$row,$tbl_members,$current_time,$tbl_paper,$current_date,$col_th,$pt;

if (!empty($_POST['ip'])){$ip = clean_post($_POST['ip']);}else{$ip='';}
if (!empty($_GET['ip'])){$ip = clean_post($_GET['ip']);}

if (!empty($_POST['mid'])){$mid = clean_post($_POST['mid']);}else{$mid='';}
if (!empty($_GET['mid'])){$mid = clean_post($_GET['mid']);}

if (!empty($_POST['charname'])){$charname = clean_post($_POST['charname']);}else{$charname='';}
if (!empty($_GET['charname'])){$charname = clean_post($_GET['charname']);}

if (!empty($_POST['max_punishment'])){$max_punishment = clean_post($_POST['max_punishment'])*60;}else{$max_punishment='';}
if (!empty($_GET['max_punishment'])){$max_punishment = clean_post($_GET['max_punishment'])*60;}

if (empty($max_punishment)) {
if ($row->Sex == 'Admin') {
$max_punishment=10000000;
} elseif ($row->Sex == 'Cop') {
$max_punishment=50000;
} elseif ($row->Sex == 'Mod') {
$max_punishment=25000;
} elseif ($row->Sex == 'Queen') {
$max_punishment=5000;
} elseif ($row->Sex == 'King') {
$max_punishment=5000;
}
}

if ($max_punishment < 30) {$max_punishment=30;}
?>
<form method=post action="?">
<table width=100% cellpadding=0 cellspacing=1 border=0><tr><th colspan=4>Admin Super Player Punisher</th></tr>
<tr><td width=25%>Partial / Charname:</td><td width=25%><input type=text name=charname value="<?php print !empty($charname)?$charname:'';?>" maxlength=32></td><td width=25%>Partial / Ip:</td><td width=25%><input type=text name=ip value="<?php print !empty($ip)?$ip:'';?>" maxlength=64></td></tr>
<tr><td width=25%>Punishment in Minutes</td><td width=25%><input type=text name="max_punishment" value="<?php print !empty($max_punishment)?round($max_punishment/60):'';?>" maxlength=16></td><td width=25%> </td><td width=25%> </td></tr>
<tr><td colspan=4><input type=submit name=Warning value="Find them!"></td></tr>
</table>
</form>
<?php 




if (!empty($mid) or !empty($ip) or !empty($charname)) {

if (!empty($ip)) {
	if (strlen($ip) >= 2) {
			$where_seek="`ip` LIKE CONVERT (_utf8 '%$ip%' USING latin1) COLLATE latin1_swedish_ci";
		}else{$where_seek="`ip` = ''";}
}elseif (!empty($charname)) {
	if (strlen($charname) >= 2) {
			$where_seek="`Charname` LIKE CONVERT (_utf8 '%$charname%' USING latin1) COLLATE latin1_swedish_ci";
		}else{$where_seek="`Charname` = ''";}
}elseif (!empty($mid)) {
			$where_seek="`id`='$mid'";
}

$queryshit = "SELECT `id`, `Sex`, `Charname`, `Level`, `ip` FROM `$tbl_members` WHERE ($where_seek) ORDER BY `Level` DESC LIMIT 100";
if($find_result = mysqli_query($link, $queryshit)){
?><table width=100% cellpadding=0 cellspacing=1 border=0><tr><th>ID</th><th>Charname</th><th>IP</th><th>Actions</th></tr><?php 
$i=0;
//$names='';
while ($mrow = mysqli_fetch_object ($find_result)) {
print '<tr';
if(empty($bg)){print ' bgcolor="'.$col_th.'"';$bg=1;}else{$bg='';}
print '><td>'.$mrow->id.'</td><td>'.$mrow->Sex.' '.$mrow->Charname.'</td><td><a href="?ip='.$mrow->ip.'&pt='.$pt.'">'.$mrow->ip.'</a></td> <td><a href="?action=mute&pid='.$mrow->id.'&ip='.$ip.'&charname='.$charname.'&pt='.$pt.'">Mute</a>
<a href="?action=unmute&pid='.$mrow->id.'&ip='.$ip.'&charname='.$charname.'&pt='.$pt.'">Unmute</a>';
if ($row->Sex == 'Cop' or $row->Sex == 'Admin') {
	print ' <a href="?action=jail&pid='.$mrow->id.'&ip='.$ip.'&charname='.$charname.'&pt='.$pt.'">Jail</a> <a href="?action=bail&pid='.$mrow->id.'&ip='.$ip.'&charname='.$charname.'&pt='.$pt.'">Bail</a> <a href="?action=suspect&pid='.$mrow->id.'&ip='.$ip.'&charname='.$charname.'&pt='.$pt.'">Suspect</a>';
}
print '</td></tr>';

if (!empty($_GET['action']) and !empty($_GET['pid'])){
	if($_GET['pid'] == $mrow->id){
$mute_jail_time=($current_time+$max_punishment);
		if($_GET['action'] == 'mute') {
$news = '<font color=red><b>'.$row->Sex.' '.$row->Charname.' muted '.$mrow->Sex.' '.$mrow->Charname.' for '.number_format($max_punishment/60,2).' minutes!</b></font>';
mysqli_query($link,"UPDATE `$tbl_members` SET `Mute`='$mute_jail_time' WHERE `id`='$mrow->id' LIMIT 1") or print (mysqli_error());
mysqli_query($link,"INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error());			
		}elseif($_GET['action'] == 'unmute') {
$news = '<b>'.$row->Sex.' '.$row->Charname.'</b> unmuted '.$mrow->Sex.' '.$mrow->Charname.'!';
mysqli_query($link,"UPDATE `$tbl_members` SET `Mute`='0' WHERE `id`='$mrow->id' LIMIT 1") or print (mysqli_error());
mysqli_query($link,"INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error());			
		}elseif($_GET['action'] == 'jail') {
			 if ($row->Sex == 'Cop' or $row->Sex == 'Admin') {
$news = '<font color=red><b>'.$row->Sex.' '.$row->Charname.' jailed '.$mrow->Sex.' '.$mrow->Charname.' for a life!</b></font>';
mysqli_query($link,"UPDATE `$tbl_members` SET `Jail`='$mute_jail_time' WHERE `id`='$mrow->id' LIMIT 1") or print (mysqli_error());
mysqli_query($link,"INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error());
			}
		}elseif($_GET['action'] == 'bail') {
			if ($row->Sex == 'Cop' or $row->Sex == 'Admin') {
$news = '<b>'.$row->Sex.' '.$row->Charname.'</b> bailed <b>'.$mrow->Sex.' '.$mrow->Charname.'</b> out of Jail!';
mysqli_query($link,"UPDATE `$tbl_members` SET `Jail`='0' WHERE `id`='$mrow->id' LIMIT 1") or print (mysqli_error());
mysqli_query($link,"INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error());		
			}
		}elseif($_GET['action'] == 'suspect') {
			if ($row->Sex == 'Cop' or $row->Sex == 'Admin') {
$news = '<font color=pink>'.$row->Sex.' '.$row->Charname.' suspects <b>'.$mrow->Sex.' '.$mrow->Charname.'</b> of a crime!</font>';
mysqli_query($link,"INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error());
			}
		}


$_GET['action']='';
$_GET['pid']='';
	}
}


$i++;
//$names .= $mrow->Charname.'<br>';
}
mysqli_free_result ($find_result);
?></table><?php 
//print $names;
}else{?>Nothing found!<?php }
}

if (!empty($news)) {print $news;}else{
print '<hr>Here you have the power to track down a players ip address and all accounts with the same ip address.<br>
<br>
Click on a action to execute on the player.<br>
Jail, Bail and Suspect for Admins only.<br>
Mute and Unmute for all HCM members.<br>
<br>
Partial charname or ip is accepted with at least 2 chars.<br>
Your standard punishment is set on '.number_format($max_punishment).' seconds equals '.number_format($max_punishment/60).' minutes equals '.number_format($max_punishment/86400).' days.';
}

}

/*_______________-=TheSilenT.CoM=-_________________*/

function admin_sex(){
	global $link,$row,$tbl_members,$current_time,$tbl_paper,$current_date,$col_th,$_POST,$_GET;
$link_start = '?sex';
if (!empty($_POST['charname'])){$charname = clean_post($_POST['charname']);}else{$charname='';}
if (!empty($_GET['charname'])){$charname = clean_post($_GET['charname']);}

?>
<form method=post action="<?php print $link_start;?>">
<table width=100% cellpadding=0 cellspacing=1 border=0><tr><th colspan=4>Admin Sex Machine</th></tr>
<tr><td width=25%>Partial / Charname:</td><td width=50%><input type=text name=charname maxlength=32></td><td width=25%><input type=submit name=Warning value="Find them!"></td></tr>
</table>
</form>
<?php 

$allowed_sex=array('Beggar', 'Untrust','Danger','Demon','Lord','Lady','Support','Mod','Cop','Admin','Helper','Stealer');

if (!empty($charname)) {
	if (strlen($charname) >= 2) {
			$where_seek="`Charname` LIKE CONVERT (_utf8 '%$charname%' USING latin1) COLLATE latin1_swedish_ci";
		}else{$where_seek="`Charname` = ''";}


if($find_result = mysqli_query($link,"SELECT `id`, `Sex`, `Charname`, `Level`, `ip` FROM `$tbl_members` WHERE ($where_seek) ORDER BY `Level` DESC LIMIT 100")){
?><table width=100% cellpadding=0 cellspacing=1 border=0><tr><th>Sex</th><th>Charname</th><th>Actions</th></tr><?php 
$i=0;
//$names='';
while ($mrow = mysqli_fetch_object ($find_result)) {
print '<tr';
if(empty($bg)){print ' bgcolor="'.$col_th.'"';$bg=1;}else{$bg='';}
print '><td>'.$mrow->Sex.'</td><td>'.$mrow->Charname.'</td><td>';
foreach ($allowed_sex as $val) {
print '<a href="'.$link_start.'&pid='.$mrow->id.'&charname='.$charname.'&action='.$val.'">'.$val.'</a> ';
}
print '</td></tr>';

if (!empty($_GET['action']) and !empty($_GET['pid'])){
	if($_GET['pid'] == $mrow->id){
		if(in_array($_GET['action'],$allowed_sex)) {
			$sexed = clean_post($_GET['action']);
$news = '<b>'.$row->Sex.' '.$row->Charname.'</b> casted sex change on <b>'.$mrow->Sex.' '.$mrow->Charname.'</b> is now known as <b>'.$sexed.' '.$mrow->Charname.'</b>!';
mysqli_query($link,"UPDATE `$tbl_members` SET `Sex`='$sexed' WHERE `id`='$mrow->id' LIMIT 1") or print (mysqli_error());
mysqli_query($link,"INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error());			
$_GET['action']='';
$_GET['pid']='';
		}
	}
}


$i++;
//$names .= $mrow->Charname.'<br>';
}
mysqli_free_result ($find_result);
?></table><?php 
//print $names;
}else{?>Nothing found!<?php }
}

if (!empty($news)) {print $news;}else{
print '<hr>Here you have the power to track down a players ip address and all accounts with the same ip address.<br>
<br>
Click on a action to execute on the player.<br>
<br>
Partial charname or ip is accepted with at least 2 chars.<br>';
}

}

/*_______________-=TheSilenT.CoM=-_________________*/

function admin_lock(){
	global $link,$row,$tbl_members,$tbl_paper,$current_date,$col_th;
$link_start ='?lock';

$lquery = "SELECT * FROM `$tbl_members` WHERE (`Loginfail` >= 10) ORDER BY Loginfail desc";
if($lresult = mysqli_query($link,$lquery)) {
?>
<table border=0><tr><th colspan="4">Accounts with failed login attempts and locked accounts</th></tr>
<tr><td>Charname</td><td>Failip tracker</td><td>Attempts</td><td>Actions</td></tr><?php 
while ($mrow = mysqli_fetch_object ($lresult)) {
	if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo '<tr'.$bgcolor.'><td>'.$mrow->Sex.' '.$mrow->Charname.'</td><td><a href="?ip='.$mrow->Loginfailip.'">'.$mrow->Loginfailip.'</a></td><td>'.$mrow->Loginfail.'</td><td><a href="'.$link_start.'&pid='.$mrow->id.'">Unlock</a></td></tr>';

if (!empty($_GET['pid'])) {
	if($_GET['pid'] == $mrow->id) {
$_GET['pid']='';
mysqli_query($link,"UPDATE `$tbl_members` SET `Loginfail`='0' WHERE `id`='$mrow->id' LIMIT 1") or print(mysqli_error());

			if ($mrow->Loginfail >= 10) {
$news = '<b>'.$row->Sex.' '.$row->Charname.'</b> unlocked <b>'.$mrow->Sex.' '.$mrow->Charname.'</b> account!';
mysqli_query($link,"INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error());			
			}

		}
}

}
mysqli_free_result ($lresult);
?></table><?php 
}

if (!empty($news)) {print $news;}
	//lock account
}

/*_______________-=TheSilenT.CoM=-_________________*/

function admin_mute(){
	global $link,$tbl_members,$current_time,$col_th;
?>
<table border=0 cellpadding=0 cellspacing=1 width=100%>
<tr><th colspan=3>Defmute</th></tr>
<tr><th>#</th><th>Charname</th><th>Time</th></tr>
<?php 
$i=1;
$query = "SELECT `Sex`, `Charname`, `Mute` FROM `$tbl_members` WHERE (`Mute` > $current_time) ORDER BY Mute desc";
if ($result = mysqli_query($link,$query)) {
while ($imrow = mysqli_fetch_object ($result)) {
	if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo '<tr'.$bgcolor.'><td>'.$i.'</td><td>'.$imrow->Sex.' '.$imrow->Charname.'</td><td>'.number_format($imrow->Mute-$current_time).'</td></tr>';
$i++;
}
mysqli_free_result ($result);
}
?>
</table>
<?php 
}

/*_______________-=TheSilenT.CoM=-_________________*/

function admin_jail(){
	global $link,$tbl_members,$current_time,$col_th;
?>
<table border=0 cellpadding=0 cellspacing=1 width=100%>
<tr><th colspan=3>Jail registers</th></tr>
<tr><td>#</td><td>Name</td><td>Days</td></tr>
<?php 
$i=1;
$query = "SELECT `Sex`, `Charname`, `Mute`,`Jail` FROM `$tbl_members` WHERE (`Jail` > $current_time) ORDER BY Jail desc";
if($result = mysqli_query($link,$query)){
while ($muterow = mysqli_fetch_object ($result)) {
	if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo '<tr'.$bgcolor.'><td>'.$i.'</td><td>'.$muterow->Sex.' '.$muterow->Charname.'</td><td>'.number_format($muterow->Jail-time()).'</td></tr>';
$i++;
}
mysqli_free_result ($result);
}
?>
</table><?php 
}

/*_______________-=TheSilenT.CoM=-_________________*/
function admin_logs(){
	global $link,$row,$tbl_logs,$col_th,$tbl_paper,$tbl_deads,$tbl_graves,$tbl_board,$tbl_messages;
$link_start ='?logs';

$loggings = array ('paper', 'deads', 'graves', 'loging and actions', 'chat', 'messages');

if (!empty($_POST['limited'])){$limited = clean_post($_POST['limited']);}else{$limited=25;}
if (!empty($_GET['limited'])){$limited = clean_post($_GET['limited']);}

if (!empty($_POST['log'])){$log = clean_post($_POST['log']);}else{$log=$loggings[3];}
if (!empty($_GET['log'])){$log = clean_post($_GET['log']);}

if (!empty($_POST['charnameonly'])){$charnameonly = clean_post($_POST['charnameonly']);}else{$charnameonly='';}
if (!empty($_GET['charnameonly'])){$charnameonly = clean_post($_GET['charnameonly']);}

if (!empty($_POST['iponly'])){$iponly = clean_post($_POST['iponly']);}else{$iponly='';}
if (!empty($_GET['iponly'])){$iponly = clean_post($_GET['iponly']);}

if (!empty($_POST['fileonly'])){$fileonly = clean_post($_POST['fileonly']);}else{$fileonly='';}
if (!empty($_GET['fileonly'])){$fileonly = clean_post($_GET['fileonly']);}

if (!empty($_POST['last_id'])){$last_id = clean_post($_POST['last_id']);}else{$last_id='';}
if (!empty($_GET['last_id'])){$last_id = clean_post($_GET['last_id']);}

?>
<form method=post action="<?php print $link_start;?>">
<table width=100% cellpadding=0 cellspacing=1 border=0>
<tr><th colspan=4>Game logs</th></tr>
<tr><td width=25%>Log files </td><td width=25%><select name=log>
<?php 
foreach ($loggings as $val) {
if ($log == $val) {
	echo "<option selected>$val</option>";
} else {
	echo "<option>$val</option>";
}
}
?>
</select></td><td width=25%>Lines </td><td width=25%><input type=text name="limited" value="<?php echo $limited; ?>"></td></tr>
<tr><td width=25%>Single charname</td><td><input type=text name="charnameonly" value="<?php echo $charnameonly; ?>"></td><td width=25%>Single ip only </td><td><input type=text name="iponly" value="<?php echo $iponly; ?>"></td></tr>
<tr><td width=25%>Single file only </td><td width=25%><input type=text name="fileonly" value="<?php echo $fileonly; ?>"></td><td colspan=2><input type=submit name="Show me" value="Show me"></td></tr></table>
</form>
<?php 
$limited=round($limited);


if (!empty($log) and !empty($limited)) {
if ($limited <= 1 or $limited >= 1000) {$limited=1000;}
if (!empty($last_id)) {$where_id="id<=$last_id";} else {$where_id='id';}
if ($log == $loggings[0]) {
	$lquery = "SELECT * FROM `$tbl_paper` WHERE ($where_id) ORDER BY `id` DESC LIMIT $limited";
} elseif ($log == $loggings[1]) {
	$lquery = "SELECT * FROM `$tbl_deads` WHERE ($where_id) ORDER BY `id` DESC LIMIT $limited";
} elseif ($log == $loggings[2]) {
	$lquery = "SELECT * FROM `$tbl_graves` WHERE ($where_id) ORDER BY `id` DESC LIMIT $limited";
} elseif ($log == $loggings[3]) {
if (!empty($charnameonly)) {$where_id="$where_id and `Charname`='$charnameonly'";}
if (!empty($iponly)) {$where_id="$where_id and `ip`='$iponly'";}
if (!empty($fileonly)) {$where_id="$where_id and `file`='$fileonly'";}
	$lquery = "SELECT * FROM `$tbl_logs` WHERE ($where_id) ORDER BY `id` DESC LIMIT $limited";
} elseif ($log == $loggings[4]) {
if (!empty($charnameonly)) {$where_id="$where_id and `Charname`='$charnameonly'";}
if (!empty($iponly)) {$where_id="$where_id and `ip`='$iponly'";}
	$lquery = "SELECT * FROM `$tbl_board` WHERE ($where_id) ORDER BY `id` DESC LIMIT $limited";
} elseif ($log == $loggings[5]) {
//LOGS 2-20-2008 06:48:30 new message system update
	global $server,$db_main;

require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/functions.messaging.php');
$gid = message_gid($server); //	2 meadow2
$dbm_main = 'messaging';
$tbl_messages = 'messages';
$fld_messages = '`id`,`gid`,`mid`,`rid`,`body`,`importance`,`status`,`dater`,`delay_timer`,`timer`';
mysqli_select_db($dbm_main) or die(mysqli_error().'Database offline.');

$lquery = "SELECT * FROM `$tbl_messages` WHERE ($where_id AND `gid`='$gid') ORDER BY `timer` DESC LIMIT $limited";
}

if ($logresult = mysqli_query($link,$lquery)) {
	if (!empty($logresult)) {
	?><table width=100% cellpadding=0 cellspacing=1 border=0><?php 
	$bgcolor=0;$i=1;
		while ($drow = mysqli_fetch_object ($logresult)) {
			if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
				if (empty($notsetkeys)) {
					echo "<tr$bgcolor><td>#</td>";
					foreach ($drow as $key=>$val) {
						echo "<td>$key</td>";
					}
					echo"</tr>";
					$notsetkeys=1;
				}
				echo "<tr$bgcolor><td>$i</td>";
				foreach ($drow as $key=>$val) {
					if ($key == 'mid' or $key == 'rid') {
						echo '<td><a href="?mid='.$val.'">'.$val.'</a></td>';
					} else {
						echo '<td>'.$val.'</td>';
					}
				}
				echo"</tr>";$i++;
				$lastid=$drow->id;
		}
		mysqli_free_result ($logresult);
		print '<a href="'.$link_start.'&limited='.$limited.'&log='.$log.'&last_id='.$lastid.'"><b>NEXT '.$limited.'</b></a>';
	?></table><?php 

	}
}

if ($log == $loggings[5]) {
mysqli_select_db($db_main) or die(mysqli_error().'Database offline.');
}
//LOGS new message system update

}

}
/*_______________-=TheSilenT.CoM=-_________________*/
?>