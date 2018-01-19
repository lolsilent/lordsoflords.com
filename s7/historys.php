<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';

include_once $clean_header;
if (empty($sort)) {
	$sort="Duelsw";
}

$numm=1;

$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");
$query = "SELECT * FROM $tbl_history WHERE `id` ORDER BY $sort DESC LIMIT 50";
$result = mysqli_query($link, $query) or die ("Query failed");
echo<<<EOT
<table align=center>
<tr><th colspan=6>Top players sorted by $sort.</th></tr>
<tr>
<td>No</td><td align=right>Charname</td>
<td align=right><a href="$PHP_SELF?sort=Duelsw">Duels won</a></td>
<td align=right><a href="$PHP_SELF?sort=Duelsl">Duels lost</a></td>
<td align=right><a href="$PHP_SELF?sort=Kills">Kills</a></td>
<td align=right><a href="$PHP_SELF?sort=Deads">Deads</a></td>
</tr>
EOT;
$bgcolor=0;
while ($row = mysqli_fetch_object ($result)) {

$row->Duelsw = number_format($row->Duelsw, 0, '', '.');
$row->Duelsl = number_format($row->Duelsl, 0, '', '.');
$row->Kills= number_format($row->Kills, 0, '', '.');
$row->Deads= number_format($row->Deads, 0, '', '.');

if ($bgcolor) {
$bgcolor=0; $color="$col_table";
} else {
$bgcolor++; $color="$col_th";
}
echo<<<EOT
<tr bgcolor="$color">
<td>$numm</td><td align=right>$row->Charname</td><td align=right>$row->Duelsw</td><td align=right>$row->Duelsl</td><td align=right>$row->Kills</td><td align=right>$row->Deads</td>
</tr>
EOT;
$numm++;
}
mysqli_free_result ($result);
?>
</table>
<b>[ <a href="<?php echo $root_url; ?>/ladders.php">Player ladder</a> ] [ <a href="<?php echo $root_url; ?>/charmss.php">Charms ladder</a> ] [ <a href="<?php echo $root_url; ?>/guildss.php">Guilds ladder</a> ]</b><br>
<?php 
include_once $game_footer;
?>