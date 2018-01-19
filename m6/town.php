<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

if ($row->Sex == 'Admin') {
$tquery = "SELECT * FROM `$tbl_members` WHERE (Onoff) ORDER BY ip desc";
}else{
$tquery = "SELECT * FROM `$tbl_members` WHERE (`Onoff`) ORDER BY `Exp` DESC";
}
$tresult = mysqli_query($link, $tquery) or die ("Query failed");
$online = mysqli_num_rows($tresult);
?>
<table width="100%" cellpadding=0 cellspacing=1 border=0 align=center>
<tr><th colspan=8>Top online exp players</th></tr>
<tr><th>#</th><th>Charname</th><?php if ($row->Sex == 'Admin') {print '<th>IP</th>';}?><th>Race</th><th align=right>Level</th><th align=right>Exp</th><th align=right>Gold</th><th align=right>Active</th></tr>
<?php 
$i=1;
while ($trow = mysqli_fetch_object ($tresult)) {
if ($trow->Sex !== 'Admin') {

if (($trow->Freeplay-$current_time) > 0) {
	$trow->Sex="<img src=\"$emotions_url/star.gif\" border=0 alt=\"Premium member\">$trow->Sex";
}
if (time()-$trow->Time > 8640000 or $trow->Exp < 0) {
	$trow->Charname="$trow->Charname <a name=Deleted>Deleted</a>";
	dead_meat($table_names);
}
if (($current_time-$trow->Time) > $max_login) {
	$trow->Charname="$trow->Charname <a name=logout>Forced logout</a>";
mysqli_query($link, "UPDATE LOW_PRIORITY $tbl_members SET Onoff=0,`Time`=$current_time WHERE `id`=$trow->id LIMIT 1");
}
	//Mute
if ($trow->Mute >= $current_time) {
$trow->Charname="$trow->Charname <a>Defmuted(".number_format($trow->Mute-$current_time).")</a>";
}
if ($trow->Jail-$current_time>0) {
$trow->Charname="$trow->Charname <a>Jailed(".number_format($trow->Jail-$current_time).")</a>";
if ($trow->Jail-$current_time>=10000) {
mysqli_query($link, "UPDATE LOW_PRIORITY $tbl_members SET Onoff=0,`Time`=$current_time,`Sex`='Criminal',Gold=0 WHERE `id`=$trow->id LIMIT 1") and print("<a>Criminal</a>");
}
}
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
print "<tr$bgcolor><td>$i</td><td><font color=\"#FFF123\">$trow->Sex $trow->Charname";
if ($row->Sex == 'Admin') {print '<td>'.$trow->ip.'</td>';}
print "</td><td>$trow->Race</td><td align=right>".lint($trow->Level)."</td><td align=right>".lint($trow->Exp)."</td><td align=right>".lint($trow->Gold)."</td><td align=right>".number_format($current_time-$trow->Time)."</td></tr>";
$i++;
}
}
mysqli_free_result ($tresult);

?>
<tr><th colspan=7>Now <?php echo $online; ?> players in town!</th></tr>
</table>
<?php 
include_once $game_footer;
?>