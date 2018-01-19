<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/array.races.php';
require_once 'AdMiN/www.battle.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

$stats_array = array ('Strength', 'Dexterity', 'Agility', 'Intelligence', 'Concentration', 'Contravention');
$next_level = next_level();
if (!empty($_POST['Stats']) or !empty($_POST['cStats'])) {
	//level up
if (!empty($_POST['Stats'])) {$Stats=$_POST['Stats'];} else {$Stats='';}
if (!empty($_POST['cStats'])) {$cStats=$_POST['cStats'];} else {$cStats='';}
if ($row->Exp >= $next_level) {
	if (!empty($Stats) and empty($cStats) and in_array($Stats,$stats_array)) {
	if ($row->Level > 1000) {$amount=$row->Level/1000;} else {$amount=1;}
	if($freeplay > 0 and $row->Level > 100) {$amount*=5;}
	} elseif (empty($Stats) and !empty($cStats) and in_array($cStats,$stats_array)) {
	$amount=1;$Stats=$cStats;
	} else {exit;}
	$amount=round($amount);
	if ($amount<1) {$amount=1;}

mysqli_query($link, "UPDATE `$tbl_members` SET $Stats=$Stats+($amount*5),Level=$row->Level+($amount*1),Life=($row->Level+$amount)*150 WHERE (`id`='$row->id' and `Charname`='$row->Charname') LIMIT 1");print("<b>You leveled up ".number_format($amount)." levels!</b>");
} else {
echo "You need more exp.";
}
	//level up
$query = "SELECT * FROM `$tbl_members` WHERE Username='".$_COOKIE['lol_Username']."' ORDER BY Onoff desc";
$result = mysqli_query($link, $query) or die ("Query failed");
$row = mysqli_fetch_object ($result);
mysqli_free_result ($result);
}
if (!in_array($row->Race,array_keys($races_array))) {$row->Race='Human';}
$tot_stats= $row->Strength+$row->Dexterity+$row->Agility+$row->Intelligence+$row->Concentration+$row->Contravention;
$base_attack= ($row->Strength/$tot_stats)*$races_array["$row->Race"][1];
$load= ($row->Armor+$row->Helmet+$row->Shield+$row->Belt+$row->Pants+$row->Hand+$row->Feet);
$base_defend= ($row->Agility/$tot_stats)*$races_array["$row->Race"][2]+($load);
$base_magic= ($row->Intelligence/$tot_stats)*$races_array["$row->Race"][3];

$ds[0]	= $row->Strength*(1+$base_attack+$row->Hand+$row->Weapon);
$ds[1]	= $ds[0]*2.555555;
$ds[2]	= $row->Intelligence*(1+$row->Ring+$base_magic+$row->Attackspell);
$ds[3]	= $ds[2]*2.555555;
$ds[4]	= $row->Intelligence*(1+$row->Amulet+$base_magic+$row->Healspell);
$ds[5]	= $ds[4]*2.555555;
$ds[6]	= $row->Contravention*(1+$row->Ring+$row->Amulet+$base_magic);
$ds[7]	= $ds[6]*2.555555;
$ds[8]	= $row->Agility*(1+$row->Shield+$base_defend);
$ds[9]	= $ds[8]*2.555555;
$ds[10]	= $row->Dexterity*(1+$base_attack+$row->Feet+$row->Level+$races_array["$row->Race"][2]);
$ds[11]	= $row->Concentration*(1+$base_magic+$row->Belt+$row->Level+$races_array["$row->Race"][3]);
$ds[12]	= $ds[10]/2.5;
$ds[13]	= $ds[11]/2.5;

$next_level = ((($row->Level/10)*500)+$row->Level)*($row->Level*$row->Level)+449;
if ($row->Exp > $next_level) {
$leveup=1;
}

$num=0;
foreach ($ds as $val) {
$ds[$num] = number_format($ds[$num], 0, '', '.');
$num++;
}

?>
<table cellpadding=0 cellspacing=1 border=0 width=100%><tr>
<th width=25%>Stats</th><th>Natural</th><th>Bonus</th><th>Charmed</th></tr>
<tr> <td valign="top">Strength<br>Dexterity<br>Agility<br>Intelligence<br>Concentration<br>Contravention</td>
<td align=right valign="top">
<?php 
echo number_format($row->Strength, 0, '', '.')."<br>".number_format($row->Dexterity, 0, '', '.')."<br>".number_format($row->Agility, 0, '', '.')."<br>".number_format($row->Intelligence, 0, '', '.')."<br>".number_format($row->Concentration, 0, '', '.')."<br>".number_format($row->Contravention, 0, '', '.')."</td>";

$bonus=array(0,0,0,0,0,0);
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$row->Charname') ORDER BY `id` DESC";
$result = mysqli_query($link, $query);
$num=0;
while ($cmrow = mysqli_fetch_object ($result)) {
if ($cmrow->Time > time()) {
$bonus[0]+=$cmrow->Strength;
$bonus[1]+=$cmrow->Dexterity;
$bonus[2]+=$cmrow->Agility;
$bonus[3]+=$cmrow->Intelligence;
$bonus[4]+=$cmrow->Concentration;
$bonus[5]+=$cmrow->Contravention;
}
}
mysqli_free_result ($result);
if (array_sum($bonus) >= 1) {
$row->Strength+=round(($row->Strength/100)*$bonus[0]);
$row->Dexterity+=round(($row->Dexterity/100)*$bonus[1]);
$row->Agility+=round(($row->Agility/100)*$bonus[2]);
$row->Intelligence+=round(($row->Intelligence/100)*$bonus[3]);
$row->Concentration+=round(($row->Concentration/100)*$bonus[4]);
$row->Contravention+=round(($row->Contravention/100)*$bonus[5]);
}
echo "<td align=right>";
foreach ($bonus as $val) {
echo "+$val%<br>";
}
echo "</td>";

echo "<td align=right valign=top>".number_format($row->Strength, 0, '', '.')."<br>".number_format($row->Dexterity, 0, '', '.')."<br>".number_format($row->Agility, 0, '', '.')."<br>".number_format($row->Intelligence, 0, '', '.')."<br>".number_format($row->Concentration, 0, '', '.')."<br>".number_format($row->Contravention, 0, '', '.');
?>
</td></tr></table>
<table cellpadding=0 cellspacing=1 border=0 width=100%><tr>
<th colspan=3>Natural Battlefields Stats for <?php echo "$row->Sex $row->Charname"; ?></th></tr>
<tr>
<td valign="top"><?php echo $row->Race; ?> Stats<br>Weapon damage<br>Attack spell<br>Heal spell<br>Magic Shield<br>Defence<br>Attack rating<br>Magic rating</td>
<td align=right valign="top"> Min<br><?php echo "$ds[0]<br>$ds[2]<br>$ds[4]<br>$ds[6]<br>$ds[8]<br>$ds[12]<br>$ds[13]</td>
<td align=right valign=top> Max<br>$ds[1]<br>$ds[3]<br>$ds[5]<br>$ds[7]<br>$ds[9]<br>$ds[10]<br>$ds[11]</td>
</tr></table>
";

if ($row->Exp > $next_level) {
echo "<b>Congratulations you have leveled up for reaching ".number_format($next_level)." exp</b>";
include_once('stats.inc.php');
} else {
?>
Next level <?php echo number_format($next_level); ?> exp.<br>You need <?php echo number_format($next_level-$row->Exp); ?> exp for the next level.
<?php 
}
include_once $game_footer;
?>