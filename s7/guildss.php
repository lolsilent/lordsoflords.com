<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/www.functions.php';
include_once $clean_header;

$link = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($link, "$db_main");
?>
<table width=100% cellpadding=1 cellspacing=1 border=0>
<tr>
<th colspan=8>The 50 Most Victorious Guilds</th>
</tr>
<tr>
<td align=center><a name=a>No</a></td><td>Guild name</td><td>Guild</td><td>Leader</td><td align=right>Members</td><td align=right>Won</td><td align=right>Lost</td><td align=right>Tied</td>
</tr>
<?php 
$query = "SELECT * FROM $tbl_guilds WHERE `id` ORDER BY Won DESC LIMIT 50";
$result = mysqli_query($link, $query);
$num=1;
while ($grow = mysqli_fetch_object ($result)) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}

$mtresult = mysqli_query($link, "SELECT id FROM $tbl_members WHERE Guild='$grow->Guild' LIMIT 1000");
$total_members = mysqli_num_rows($mtresult);
mysqli_free_result ($mtresult);
if ($total_members <= 0) {
mysqli_query($link, "DELETE LOW_PRIORITY FROM $tbl_guilds WHERE `id`=$grow->id LIMIT 1");
$grow->Name="$grow->Name <b><font size=1>CLOSED</font></b>";
}
echo"<tr$bgcolor><td align=center>$num</td><td><a href=\"$PHP_SELF?open=guilds&details=$grow->id\">[$grow->Guild] $grow->Name</a></td><td>$grow->Special</td><td>$grow->Sex $grow->Charname</td><td align=right>".number_format($total_members)."</td><td align=right>".number_format($grow->Won)."</td><td align=right>".number_format($grow->Lost)."</td><td align=right>".number_format($grow->Tied)."</td></tr>";
if (!empty($_GET['details'])) {if ($_GET['details'] == $grow->id) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
$mquery = "SELECT * FROM `$tbl_members` WHERE Guild='$grow->Guild' ORDER BY Level DESC LIMIT 100";
$mresult = mysqli_query($link, $mquery);
$i=1;
while ($mrow = mysqli_fetch_object ($mresult)) {
echo "<tr$bgcolor><td align=center>$i</td><td colspan=5>$mrow->Sex $mrow->Charname [".number_format($mrow->Level)."]</td></tr>";
$i++;
}
mysqli_free_result ($mresult);
}}
$num++;
}
mysqli_free_result ($result);
?>
</table>
<b>[ <a href="<?php echo $root_url; ?>/ladders.php">Player ladder</a> ] [ <a href="<?php echo $root_url; ?>/charmss.php">Charms ladder</a> ] [ <a href="<?php echo $root_url; ?>/historys.php">History ladder</a> ]</b><br>
<?php 
include_once $clean_footer;
?>