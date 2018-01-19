<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/www.mysql.php';
include_once $clean_header;

if (!empty($_GET)) {
	foreach ($_GET as $key => $val) {
		if (!empty($val)) {
			$$key=clean_post($val);
		}
	}
}

if (empty($_GET['sort'])) {
	$sort="Strength";
}


?>
<table align=center>
<tr><th colspan=9>Best 50 <?php echo $sort; ?> Charms. <br>[<a href="<?php echo $PHP_SELF; ?>?whatkind=gods charm">God charms</a>] [<a href="<?php echo $PHP_SELF; ?>?whatkind=heavenly charm">Heavenly charms</a>]</th></tr>
<tr><td>#</td><td>Charm name</td><td>Owner</td>
<?php 
$stats = array ('Strength' => 'Strength',
'Dexterity' => 'Dexterity',
'Agility' => 'Agility',
'Intelligence' => 'Intelligence',
'Concentration' => 'Concentration',
'Contravention' => 'Contravention',
'a1' => 'Weapon damage',
'a2' => 'Attack spell',
'a3' => 'Heal spell',
'a4' => 'Magic Shield',
'a5' => 'Defence',
'a6' => 'Attack rating',
'a7' => 'Magic rating',
'a8' => 'Life',
'a9' => 'Power Z');
foreach ($stats as $key => $val) {
echo "<td><a href=\"$PHP_SELF?sort=$key\">".substr("$val",0,4)."</a></td>";
}
?>
</tr>
<?php 
$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");
if (empty($whatkind)) {
$query = "SELECT * FROM `$tbl_charms` WHERE `id` and `name`!='Gods charm' and `name`!='Heavenly charm' ORDER BY $sort desc LIMIT 50";
} elseif ($whatkind == 'gods charm') {
$query = "SELECT * FROM `$tbl_charms` WHERE `name`='Gods charm' ORDER BY $sort desc LIMIT 100";
} elseif ($whatkind == 'heavenly charm') {
$query = "SELECT * FROM `$tbl_charms` WHERE `name`='Heavenly charm' ORDER BY $sort desc LIMIT 100";
} else {
$query = "SELECT * FROM `$tbl_charms` WHERE `id` and `name`!='Gods charm' and `name`!='Heavenly charm' ORDER BY $sort desc LIMIT 50";
}
$result = mysqli_query($link, $query) or die ("Query failed");
$num=1;
while ($row = mysqli_fetch_object ($result)) {
if (empty($color)) {$color=" bgcolor=\"$col_th\"";} else {$color="";}
echo "<tr$color><td>$num</td><td>$row->Name</td><td>$row->Charname</td><td>$row->Strength</td><td>$row->Dexterity</td><td>$row->Agility</td><td>$row->Intelligence</td><td>$row->Concentration</td><td>$row->Contravention</td><td>$row->a1</td><td>$row->a2</td><td>$row->a3</td><td>$row->a4</td><td>$row->a5</td><td>$row->a6</td><td>$row->a7</td><td>$row->a8</td><td>$row->a9</td></tr>";
$num++;
}
mysqli_free_result ($result);
mysqli_close($link);
?>
</table>
<b>[ <a href="<?php echo $root_url; ?>/ladders.php">Player ladder</a> ] [ <a href="<?php echo $root_url; ?>/historys.php">History ladder</a> ] [ <a href="<?php echo $root_url; ?>/guildss.php">Guilds ladder</a> ]</b><br>
<?php 
include_once $clean_footer;
?>