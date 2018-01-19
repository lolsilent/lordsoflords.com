<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once($game_header);



//if ($row->id == 1 and $row->ip == '83.83.247.33' and $row->Sex == 'Admin'){
if ($row->ip == '83.83.247.33' and $row->Sex == 'Admin'){
$names='';
?>
<form method=post action="admin_super.php">
<table width=100% cellpadding=0 cellspacing=1 border=0><tr><th colspan=4>Player Finder</th></tr>
<tr><td width=25%>Partial / Charname:</td><td width=25%><input type=text name=charname></td><td width=25%>Partial / Ip:</td><td width=25%><input type=text name=ip></td></tr>
<tr><td colspan=4><input type=submit name=Warning value="Find them!"></td></tr>
</table>
</form>
<?php 


if (!empty($_POST['ip'])){$ip = $_POST['ip'];}else{$ip='';}
if (!empty($_GET['ip'])){$ip = $_GET['ip'];}

if (!empty($_POST['charname'])){$charname = $_POST['charname'];}else{$charname='';}
if (!empty($_GET['charname'])){$charname = $_GET['charname'];}

if (!empty($ip) or !empty($charname)) {

if (!empty($ip)) {
	if (strlen($ip) >= 2) {
			$where_seek="`ip` LIKE CONVERT (_utf8 '%$ip%' USING latin1) COLLATE latin1_swedish_ci";
		}else{$where_seek="`ip` = ''";}
}elseif (!empty($charname)) {
	if (strlen($charname) >= 2) {
			$where_seek="`Charname` LIKE CONVERT (_utf8 '%$charname%' USING latin1) COLLATE latin1_swedish_ci";
		}else{$where_seek="`Charname` = ''";}
}

if($find_result = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE ($where_seek) ORDER BY `Level` DESC LIMIT 100")){
?><table width=100% cellpadding=0 cellspacing=1 border=1><tr><th>Jail/Id</th><th>Player</th><th>Level</th><th>Ip</th></tr><?php 
$i=0;
while ($mrow = mysqli_fetch_object ($find_result)) {
print '<tr><td><a href="?action=jail&pid='.$mrow->id.'&ip='.$ip.'&charname='.$charname.'">Jail</a> '.$mrow->id.' <a href="?naction=jail&pid='.$mrow->id.'&ip='.$ip.'&charname='.$charname.'">Bail</a> <a href="?saction=jail&pid='.$mrow->id.'&ip='.$ip.'&charname='.$charname.'">Suspect</a></td><td>'.$mrow->Sex.' '.$mrow->Charname.'</a></td><td>'.$mrow->Level.'</td><td><a href="?ip='.$mrow->ip.'">'.$mrow->ip.'</a></td></tr>';
$i++;
}
mysqli_free_result ($find_result);
?></table><?php 
}else{?>Nothing found!<?php }
}

if (!empty($_GET['action']) and !empty($_GET['pid'])){
if (!empty($_GET['pid'])){$pid = $_GET['pid'];}else{$pid='';}
if (!empty($pid)){
if($presult = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `id`='$pid' ORDER BY `id` DESC LIMIT 1")){
if($prow = mysqli_fetch_object ($presult)) {
$jail_time=($current_time+100000000);
$news = '<b>'.$row->Sex.' '.$row->Charname.'</b> Jailed '.$prow->Sex.' '.$prow->Charname.' for a life!';
mysqli_query($link, "UPDATE `$tbl_members` SET `Jail`='$jail_time' WHERE `id`='$pid' LIMIT 1") or print (mysqli_error($link));
mysqli_query($link, "INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error($link));
print $news;
}else{?>Can not fetch player.<?php }
}else{?>Sql query not found.<?php }
}
}

if (!empty($_GET['naction']) and !empty($_GET['pid'])){
if (!empty($_GET['pid'])){$pid = $_GET['pid'];}else{$pid='';}
if (!empty($pid)){
if($presult = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `id`='$pid' ORDER BY `id` DESC LIMIT 1")){
if($prow = mysqli_fetch_object ($presult)) {
$news = '<b>'.$row->Sex.' '.$row->Charname.'</b> Bailed '.$prow->Sex.' '.$prow->Charname.' for a life!';
mysqli_query($link, "UPDATE `$tbl_members` SET `Jail`='0' WHERE `id`='$pid' LIMIT 1") or print (mysqli_error($link));
mysqli_query($link, "INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error($link));
print $news;
}else{?>Can not fetch player.<?php }
}else{?>Sql query not found.<?php }
}
}

if (!empty($_GET['saction']) and !empty($_GET['pid'])){
if (!empty($_GET['pid'])){$pid = $_GET['pid'];}else{$pid='';}
if (!empty($pid)){
if($presult = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `id`='$pid' ORDER BY `id` DESC LIMIT 1")){
if($prow = mysqli_fetch_object ($presult)) {
$news = '<b>'.$row->Sex.' '.$row->Charname.'</b> Suspects '.$prow->Sex.' '.$prow->Charname.' of a crime!';
mysqli_query($link, "INSERT INTO `$tbl_paper` values('','$news','$current_date')") or print (mysqli_error($link));
print $news;
}else{?>Can not fetch player.<?php }
}else{?>Sql query not found.<?php }
}
}


//SEARCH MORE

$array_dbs = array(

'Meadow' => 'lol1_meadow',
'Meadow2' => 'lol1_meadow2',
'Eidolon' => 'lol1_eidolon',
'Xedon' => 'lol1_xedon',

'Duel' => 'lol1_duel',
'Devlab' => 'lol1_devlab',
'Euro' => 'lol1_euro',
'Evolve' => 'lol_evolve',

'Noauto' => 'lol_noauto',

'History' => 'lol1_history',
'Tourney' => 'lol_tournament',
'Ysomite' => 'lol2_ysomite',
'Shadow' => 'lol3_shadow',
'Shadow2' => 'lol3_shadow2',

'lolnet' => 'lolnet',
);

foreach ($array_dbs as $key => $val) {
mysqli_select_db($link,$val) or die(mysqli_error($link));


if ($key == 'Duel' or $key == 'Devlab' or $key == 'Evolve' or $key == 'Tourney' or $key == 'Euro' or $key == 'Net' or $key == 'Noauto' or $key=='lolnet') {
$tc_level = 'level';
$tc_sex = 'sex';
$tc_charname = 'charname';
}else{
$tc_level = 'Level';
$tc_sex = 'Sex';
$tc_charname = 'Charname';
}

if (!empty($ip) or !empty($charname)) {

if (!empty($ip)) {
	if (strlen($ip) >= 2) {
			$where_seek="`ip` LIKE CONVERT (_utf8 '%$ip%' USING latin1) COLLATE latin1_swedish_ci";
		}else{$where_seek="`ip` = ''";}
}elseif (!empty($charname)) {
	if (strlen($charname) >= 2) {
			$where_seek="`$tc_charname` LIKE CONVERT (_utf8 '%$charname%' USING latin1) COLLATE latin1_swedish_ci";
		}else{$where_seek="`$tc_charname` = ''";}
}

if($find_result = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE ($where_seek) ORDER BY `Level` DESC LIMIT 100")){
print '<table width=100% cellpadding=0 cellspacing=1 border=1><tr><th>'.$key.'</th><th>charname</th><th>level</th><th>ip</th></tr>';
$i=0;
while ($mrow = mysqli_fetch_object ($find_result)) {
print '<tr><td>'.$mrow->id.'</td><td>'.$mrow->tc_sex.' '.$mrow->$tc_charname.'</td><td>'.$mrow->$tc_level.'</td><td><a href="?ip='.$mrow->ip.'">'.$mrow->ip.'</a></td></tr>';
$i++;$names .= $key.' '.$mrow->tc_sex.' '.$mrow->$tc_charname.' '.$mrow->$tc_level.' '.substr($mrow->ip,0,-5).'?????<br>';
}
mysqli_free_result ($find_result);
?></table><?php 
}else{?>Nothing found!<?php }
}

}//foreach
print $names;
mysqli_select_db($link,$db_main) or die(mysqli_error($link));
//SEARCH MORE


}//silent only
include_once($game_footer);
?>