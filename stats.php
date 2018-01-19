<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_mysql);
require_once($html_header);

$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

$total_servers=count($array_dbs);

if($result = mysqli_query($link, "SELECT * FROM `$tbl_servers` WHERE `server`!='total' ORDER BY `id` DESC LIMIT $total_servers")){
?><table width=100%><tr><th>World</th><th>Births</th><th>Alive</th><th>Buried</th></tr><?php 
while ($srow = mysqli_fetch_object($result)) {
if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor='';}
?><tr<?php print $bgcolor;?>><td><a href="?open=server&cserv=<?php print $srow->server;?>" title="This server log."><?php print $srow->server;?></a></td><td><?php print number_format($srow->players);?></td><td><?php print number_format($srow->alive);?></td><td><?php print number_format($srow->players-$srow->alive);?></td></tr><?php 
} //end while
mysqli_free_result($result);
?></table><?php 
}

/*_______________-=TheSilenT.CoM=-_________________*/

if (empty($days)) {$days=15;} else {if ($days >= 365) {$days=365;}}
$where_cserv="`id` and `server`='total'";$what_serv="all Lords of Lords servers";
if (!empty($_GET['cserv'])) {
$where_cserv="`id` and `server`='".$_GET['cserv']."'";
$what_serv=$_GET['cserv']." server";
?><!--started on 12-7-2003 05:56 last updated 05-23-05 15:21--><?php 
}


if($result = mysqli_query($link, "SELECT * FROM `$tbl_servers` WHERE ($where_cserv) ORDER BY `id` DESC LIMIT $days")){
?><table width=100%><tr><th colspan=7>Last <?php print $days;?> days of <?php print $what_serv;?></th></tr><th>Date</th><th>Births</th><th>+/-</th><th>Alive</th><th>+/-</th><th>Buried</th><th>+/-</th></tr><?php 
$yes_signup=0;
$yes_alive=0;
$yes_dead=0;
$prev_date = '';
while ($lrow = mysqli_fetch_object($result)) {
if($prev_date !== $lrow->sdate) {
if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor='';}
?><tr<?php print $bgcolor;?>>
	<td><?php print $lrow->sdate;?></td>
	<td><?php print number_format($lrow->players);?></td>
	<td><?php print $yes_signup>=1?number_format($yes_signup-$lrow->players):'?';?></td>
	<td><?php print number_format($lrow->alive);?></td>
	<td><?php print $yes_alive>=1?number_format($yes_alive-$lrow->alive):'?';?></td>
	<td><?php print number_format($lrow->players-$lrow->alive);?></td>
	<td><?php print $yes_dead>=1?number_format(($lrow->players-$lrow->alive)-$yes_dead):'?';?></td></tr><?php 
	$yes_signup=$lrow->players;
	$yes_alive=$lrow->alive;
	$yes_dead=$lrow->players-$lrow->alive;
}else{
mysqli_query($link, "DELETE FROM $tbl_servers WHERE id='$lrow->id' LIMIT 1");
print '<!--HOPPA WEG MET DIE ROMMEL-->';
}
$prev_date = $lrow->sdate;
} //end while
mysqli_free_result($result);
?></table><?php 
}

/*_______________-=TheSilenT.CoM=-_________________*/


if($result = mysqli_query($link, "SELECT * FROM `$tbl_servers` WHERE `server`='total' ORDER BY `id` DESC LIMIT 1")){
if($ssrow = mysqli_fetch_object($result)){

if (($current_time-$ssrow->timer) >= 1000) {
 //{SERVERUPDATE
$tot_players=0;
$tot_alive=0;
$tot_online=0;


$creds_email=100;
$tenk_credits=array();
$new_servers=array();

$array_dbs=array_reverse($array_dbs);
foreach ($array_dbs as $key=>$val) {

$table_name = preg_replace("/_.*?$/i","",$val);
$table_name = preg_replace("/1/i","",$table_name);
$credits_table = $table_name.'_credits';
$table_name = $table_name.'_members';
mysqli_select_db($link,$val);

if($result = mysqli_query($link, "SELECT `id` FROM `$table_name` WHERE `id` ORDER BY `id` DESC")){
if($srow = mysqli_fetch_object($result)){
$alive = mysqli_num_rows($result);
mysqli_free_result($result);

$online=0;
if($oresult = mysqli_query($link, "SELECT `id` FROM `$table_name` WHERE `time`>=$current_time-1000 ORDER BY `id` DESC")){
if($online = mysqli_num_rows($oresult)){mysqli_free_result($oresult);}
}else{if($oresult = mysqli_query($link, "SELECT id FROM $table_name WHERE timer>=$current_time-1000 ORDER BY id DESC")){
if($online = mysqli_num_rows($oresult)){mysqli_free_result($oresult);}
}}
$tot_players+=$srow->id;
$tot_alive+=$alive;
$tot_online+=$online;

if($cresult = mysqli_query($link, "SELECT * FROM `$credits_table` WHERE (`credits`>='$creds_email' or `credits`<0) ORDER BY `credits` DESC")){
while ($credrow = mysqli_fetch_object($cresult)) {
		if (strtolower($key) == 'ysomite') {
			$tbl_mem = 'lol2_members';
		}elseif (strtolower($key) == 'shadow' or strtolower($key) == 'shadow2') {
			$tbl_mem = 'lol3_members';
		}else{
			$tbl_mem = 'lol_members';
		}
$dead_alive=0;
if (!empty($credrow->charname)) {

if($memresult = mysqli_query($link, "SELECT * FROM `$tbl_mem` WHERE (`charname`='$credrow->charname') ORDER BY `id` DESC LIMIT 1")){
if ($memrow = mysqli_fetch_object($memresult)) {
mysqli_free_result($memresult);
$dead_alive = 'ALIVE';
}else{$dead_alive = 'DEAD1 DEL.';
mysqli_query($link, "DELETE FROM `$credits_table` WHERE `id`=$credrow->id LIMIT 1") or die(mysqli_error($link));
}
}else{$dead_alive = 'DEAD2';}

array_push($tenk_credits, "$credrow->credits $credrow->charname $key $tbl_mem $dead_alive");
} elseif (!empty($credrow->Charname)) {

if($memresult = mysqli_query($link, "SELECT * FROM `$tbl_mem` WHERE (`charname`='$credrow->Charname') ORDER BY `id` DESC LIMIT 1")){
if ($memrow = mysqli_fetch_object($memresult)) {
mysqli_free_result($memresult);
$dead_alive = 'ALIVE';
}else{$dead_alive = 'DEAD3 DEL';
mysqli_query($link, "DELETE FROM `$credits_table` WHERE `id`=$credrow->id LIMIT 1") or die(mysqli_error($link));
}
}else{$dead_alive = 'DEAD4';}

array_push($tenk_credits, "$credrow->Credits $credrow->Charname $key $tbl_mem $dead_alive");
}
}
mysqli_free_result($cresult);
array_push($tenk_credits, "_____________________________________________");
}

array_push($new_servers, "'','$key','$srow->id','$alive','$current_date','$current_time'");

}}}

/*_______________-=TheSilenT.CoM=-_________________*/

if ($ssrow->sdate !== $current_date) {
mysqli_select_db($link,$db_main);
foreach ($new_servers as $val) {
mysqli_query($link, "INSERT INTO `$tbl_servers` ($fld_servers) values ($val)") or die(mysqli_error($link));
}
mysqli_query($link, "INSERT INTO `$tbl_servers` ($fld_servers) values ('','total','$tot_players','$tot_alive','$current_date','$current_time')") or die(mysqli_error($link));

//EMAIL ME DAILY CREDITS
$mail_me='';
foreach ($tenk_credits as $val) {
$mail_me.="$val\n";
}
//print $mail_me;
mail("credits@thesilent.com", "Credits Statistics", "$mail_me", "From: credits@thesilent.com", "-fcredits@{$_SERVER['SERVER_NAME']}");
} //time for update


/*_______________-=TheSilenT.CoM=-_________________*/


mysqli_query($link, "DELETE FROM $tbl_servers WHERE timer<=".$current_time-(86400*100)."");
}
}else{mysqli_query($link, "INSERT INTO $tbl_servers ($fld_servers) values ('','total','0','0','0','0')") or die(mysqli_error($link));}
}

mysqli_close($link);
require_once($html_footer);
?>