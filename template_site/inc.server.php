<?php 
#!/usr/local/bin/php
?>
<tr>
<th bgcolor="#000000">Lords of Lords Servers</th>
</tr>

<tr><td>
<?php 
if (strpos($_SERVER['HTTP_REFERER'], $root_url) !== '') {
?>

<table width=100% cellpadding=1 cellspacing=1 border=0>
<tr><td><b>Server</b></td><td><b>Players</b></td><td><b>Alive</b></td><td><b>Online</b></td><td><b>Buried</b></td></tr>
<?php 
require_once 'AdmiN/www.mysql.php';
$link = mysqli_connect($db_host, $db_user, $db_password) or die('Connection failed.');
mysqli_select_db($link, "$db_main", $link);
$result = mysqli_query($link, "SELECT * FROM $tbl_servers WHERE server='total' ORDER BY id desc limit 1", $link);
$ssrow = mysqli_fetch_object ($result) or die(mysqli_error($link));

 //delete log older than 150 days
$delete_time = $current_time-(86400*150);
//print $current_time.' '.$delete_time.' '.($current_time-delete_time);
mysqli_query($link, "DELETE FROM $tbl_logdaily WHERE time<'$delete_time'") or die("Log error".mysqli_error($link));

$tot_players=$ssrow->players;
$tot_alive=$ssrow->alive;
$tot_online=$ssrow->online;


$result = mysqli_query($link, "SELECT * FROM $tbl_servers WHERE server!='total' ORDER BY id asc limit 100", $link);
while ($srow = mysqli_fetch_object ($result)) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"#345678\"";} else {$bgcolor='';}
?>
<tr<?php print $bgcolor;?>><td><b><a href="<?php print $_SERVER['PHP_SELF'];?>?open=server&cserv=<?php print $srow->server;?>"><?php print substr($srow->server,0,1);?></a></b><?php print substr($srow->server,1,15);?></td>
<td><?php print number_format($srow->players);?></td>
<td><?php print number_format($srow->alive);?></td>
<td><?php print number_format($srow->online);?></td>
<td><?php print number_format($srow->buried);?></font></td></tr>
<?php 
} //end while
mysqli_free_result ($result);

?>
</tr>
<?php print "<tr><td><a>Totals</a></td><td><a>".number_format($tot_players)."</a></td><td><a>".number_format($tot_alive)."</a></td><td><a>".number_format($tot_online)."</a></td><td><a>".number_format($tot_players-$tot_alive)."</a></td></tr>";
?>
</table>
<p>
<?php 
if (empty($days)) {$days=10;} else {if ($days >= 365) {$days=365;}}
$where_cserv="id and server='total'";$what_serv="all Lords of Lords servers";
if (!empty($_GET['cserv'])) {
$where_cserv="id and server='".$_GET['cserv']."'";
$what_serv=$_GET['cserv']." server";
?><!--started on 12-7-2003 05:56--><?php 
}
?>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><th colspan=5>Last days of <?php print $what_serv;?></th></tr>
<td><b>Date</b></td><td><b>Players</b></td><td><b>Alive</b></td><td><b>Online</b></td><td><b>Buried</b></td>
<?php 
$output=array();
$result = mysqli_query($link, "SELECT * FROM $tbl_logdaily WHERE ($where_cserv) ORDER BY id desc limit $days", $link);
while ($lrow = mysqli_fetch_object ($result)) {
if (!in_array($lrow->cdate,$output)) {array_push($output,$lrow->cdate);
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"#345678\"";} else {$bgcolor='';}
?>
<tr<?php print $bgcolor;?>><td><?php print $lrow->cdate;?></td>
<td><?php print number_format($lrow->players);?></td>
<td><?php print number_format($lrow->alive);?></td>
<td><?php print number_format($lrow->online);?></td>
<td><?php print number_format($lrow->buried);?></font></td></tr>
<?php 
}
} //end while
mysqli_free_result ($result);
?>

</table>
<p>
<a href="https://lordsoflords.com/index.php?open=status">Server Status Monitoring</a>
<?php 
if (($current_time-$ssrow->time) >= $server_update_time) {
 //{SERVERUPDATE
$tot_players=0;
$tot_alive=0;
$tot_online=0;
$new_stats=array();
$new_servers=array();
$day_log=array();

$mail_me='';
$creds_email=1000;
$tenk_credits=array();

foreach ($array_dbs as $key=>$val) {
if ($val !== 'title') {
$table_name = preg_replace("/_.*?$/i","",$val);
$table_name = preg_replace("/1/i","",$table_name);
$credits_table = $table_name.'_credits';
$table_name = $table_name.'_members';
mysqli_select_db($link, "$val", $link);

$result = mysqli_query($link, "SELECT id FROM $table_name WHERE id ORDER BY id DESC", $link);
if ($result) {
$alive = mysqli_num_rows($result);
$srow = mysqli_fetch_object($result);
mysqli_free_result ($result);

if($oresult = mysqli_query($link, "SELECT id FROM $table_name WHERE Time>=$current_time-1000 ORDER BY id DESC", $link)){
$online = mysqli_num_rows($oresult);
mysqli_free_result ($oresult);
}else{
if($oresult = mysqli_query($link, "SELECT id FROM $table_name WHERE timer>=$current_time-1000 ORDER BY id DESC", $link)){
$online = mysqli_num_rows($oresult);
mysqli_free_result ($oresult);
}else{$online=0;}}

$tot_players+=$srow->id;
$tot_alive+=$alive;
$tot_online+=$online;

if($cresult = mysqli_query($link, "SELECT * FROM $credits_table WHERE (credits>=$creds_email or credits<0) ORDER BY id desc", $link)){
while ($credrow = mysqli_fetch_object ($cresult)) {
if (!empty($credrow->charname)) {
array_push($tenk_credits, "$credrow->credits $credrow->charname $key");
} elseif (!empty($credrow->Charname)) {
array_push($tenk_credits, "$credrow->Credits $credrow->Charname $key");
}
}
mysqli_free_result ($cresult);
}

array_push($new_servers, $key);
array_push($new_stats, "players=$srow->id, alive=$alive, buried=($srow->id-$alive),online=$online, sdate='$current_date', time=$current_time");
 //'id, server, players, alive, buried, online, cdate, time
array_push($day_log, "'', '$key', '$srow->id', '$alive', '".($srow->id-$alive)."', '$online', '$current_date', '$current_time'");

} //results?
} //title?
} // foreach


 //UPDATE TOTAL SERVERS
mysqli_select_db($link, "$db_main", $link);
$result = mysqli_query($link, "SELECT * FROM $tbl_servers WHERE id ORDER BY server='total' desc limit 1", $link);
$ssrow = mysqli_fetch_object ($result) or die(mysqli_error($link));
mysqli_free_result ($result);

if ($ssrow->sdate !== $current_date) {
array_push($day_log, "'', 'total', $tot_players, $tot_alive, ".($tot_players-$tot_alive).", $tot_online, '$current_date', $current_time");
 //MAKE A DAILY LOG
 //EMAIL ME DAILY CREDITS
sort($tenk_credits);
foreach ($tenk_credits as $val) {
$mail_me.="$val\n";
}
mail("credits@thesilent.com", "Credits Statistics", "$mail_me", "From: credits@{$_SERVER['SERVER_NAME']}", "-fcredits@{$_SERVER['SERVER_NAME']}");

foreach($day_log as $dlog) {
mysqli_query($link, "INSERT INTO $tbl_logdaily ($fld_logdaily) values ($dlog)", $link) or die("ID LOG 1 $dlog".mysqli_error($link));
}

 //UPDATE TOTALS
mysqli_query($link, "UPDATE $tbl_servers SET players=$tot_players, alive=$tot_alive, buried=($tot_players-$tot_alive),online=$tot_online, sdate='$current_date', time=$current_time WHERE server='total' LIMIT 1", $link) or die(mysqli_error($link));

 //UPDATE ALL SERVER
$i=0;
foreach ($new_stats as $val) {
mysqli_query($link, "UPDATE $tbl_servers SET $val WHERE server='$new_servers[$i]' LIMIT 1", $link) or die("[$i | $val]".mysqli_error($link));
$i++;
}
} else {

mysqli_query($link, "UPDATE $tbl_servers SET players=$tot_players, alive=$tot_alive, buried=($tot_players-$tot_alive),online=$tot_online, sdate='$current_date', time=$current_time WHERE server='total' LIMIT 1", $link) or die(mysqli_error($link));

}// date is not current
mysqli_close($link);


 //SERVERUPDATE}
} //time for update
?>
</td></tr>
<?php 
} else {
print<<<EOT
<font size=+5><center><a href="https://lordsoflords.com" target="_top">Lordsoflords.coM Servers</font><p>Click here to enteR</a>
EOT;
} //end oke
?>