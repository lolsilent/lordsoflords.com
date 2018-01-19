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


$bonus=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$row->Charname') ORDER BY `id` ASC limit 5";
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

$bonus[6]+=$cmrow->a1;
$bonus[7]+=$cmrow->a2;
$bonus[8]+=$cmrow->a3;

$bonus[9]+=$cmrow->a4;
$bonus[10]+=$cmrow->a5;
$bonus[11]+=$cmrow->a6;

$bonus[12]+=$cmrow->a7;
$bonus[13]+=$cmrow->a8;
$bonus[14]+=$cmrow->a9;
}
}
mysqli_free_result ($result);

if (array_sum($bonus) >= 1) {
$row->Strength+=($row->Strength/100)*$bonus[0];
$row->Dexterity+=($row->Dexterity/100)*$bonus[1];
$row->Agility+=($row->Agility/100)*$bonus[2];
$row->Intelligence+=($row->Intelligence/100)*$bonus[3];
$row->Concentration+=($row->Concentration/100)*$bonus[4];
$row->Contravention+=($row->Contravention/100)*$bonus[5];
}


if (!in_array($row->Race,array_keys($races_array))) {$row->Race='Human';}
$tot_stats= $row->Strength+$row->Dexterity+$row->Agility+$row->Intelligence+$row->Concentration+$row->Contravention;
$base_attack= ($row->Strength/$tot_stats)*$races_array["$row->Race"][1];
$load= ($row->Armor+$row->Helmet+$row->Shield+$row->Belt+$row->Pants+$row->Hand+$row->Feet);
$base_defend= ($row->Agility/$tot_stats)*$races_array["$row->Race"][2]+($load);
$base_magic= ($row->Intelligence/$tot_stats)*$races_array["$row->Race"][3];



$ds[0]	= $row->Strength*(1+$base_attack+$row->Hand+$row->Weapon);
$ds[0] = $ds[0] * (1+($bonus[6]/100));
$ds[1]	= $ds[0]*2.555555;
$ds[2]	= $row->Intelligence*(1+$row->Ring+$base_magic+$row->Attackspell);
$ds[2] = $ds[2] * (1+($bonus[7]/100));
$ds[3]	= $ds[2]*2.555555;
$ds[4]	= $row->Intelligence*(1+$row->Amulet+$base_magic+$row->Healspell);
$ds[4] = $ds[4] * (1+($bonus[8]/100));
$ds[5]	= $ds[4]*2.555555;
$ds[6]	= $row->Contravention*(1+$row->Ring+$row->Amulet+$base_magic);
$ds[6] = $ds[6] * (1+($bonus[9]/100));
$ds[7]	= $ds[6]*2.555555;
$ds[8]	= $row->Agility*(1+$row->Shield+$base_defend);
$ds[8] = $ds[8] * (1+($bonus[10]/100));
$ds[9]	= $ds[8]*2.555555;
$ds[10]	= $row->Dexterity*(1+$base_attack+$row->Feet+$row->Level+$races_array["$row->Race"][2]);
$ds[10] = $ds[10] * (1+($bonus[11]/100));
$ds[11]	= $row->Concentration*(1+$base_magic+$row->Belt+$row->Level+$races_array["$row->Race"][3]);
$ds[11] = $ds[11] * (1+($bonus[12]/100));
$ds[12]	= $row->Life;
$ds[12] = $ds[12] * (1+($bonus[13]/100));
$ds[13]	= $row->Exp;
$ds[14]	= $row->Gold;
$ds[15]	= $row->Charname;
$ds[16]	= $row->Life;
$ds[17]	= "";
$ds[18]	= "";
$ds[19]	= "";
$ds[20]	= (1+($row->Agility/$tot_stats))*$races_array["$row->Race"][4];
//print 'POWER z'.$ds[20];
$ds[20] = $ds[20] * (1+($bonus[14]/100));
//print 'POWER z'.$ds[20];
$ds[21]	= $ds[10]/2.5;
$ds[22]	= $ds[11]/2.5;
$ds[23]	= $row->Level;
$ds[24]	= $races_array["$row->Race"][0]; // 12/02/17 04:28:44 added
$ds[25]	= $races_array["$row->Race"][1];
$ds[26]	= $races_array["$row->Race"][2];
$ds[27]	= $races_array["$row->Race"][3];
$ds[28]	= $races_array["$row->Race"][4];

$next_level = next_level();
if ($row->Exp > $next_level) {
$leveup=1;
}



?>
<table cellpadding=0 cellspacing=1 border=0 width=100%><tr>
<th width=25%>Stats</th><th>Natural</th><th>Bonus</th><th>Charmed</th></tr>
<tr> <td valign="top">Strength<br>Dexterity<br>Agility<br>Intelligence<br>Concentration<br>Contravention</td>
<td align=right valign="top">
<?php 
echo number_format($row->Strength, 0, '', '.')."<br>".number_format($row->Dexterity, 0, '', '.')."<br>".number_format($row->Agility, 0, '', '.')."<br>".number_format($row->Intelligence, 0, '', '.')."<br>".number_format($row->Concentration, 0, '', '.')."<br>".number_format($row->Contravention, 0, '', '.')."</td>";

$bonus=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
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

$bonus[6]+=$cmrow->a1;
$bonus[7]+=$cmrow->a2;
$bonus[8]+=$cmrow->a3;

$bonus[9]+=$cmrow->a4;
$bonus[10]+=$cmrow->a5;
$bonus[11]+=$cmrow->a6;

$bonus[12]+=$cmrow->a7;
$bonus[13]+=$cmrow->a8;
$bonus[14]+=$cmrow->a9;
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
$i=0;
foreach ($bonus as $val) {
echo "+$val%<br>";
$i++;
if ($i >= 6) {break;}
}
echo "</td>";

echo "<td align=right valign=top>".number_format($row->Strength, 0, '', '.')."<br>".number_format($row->Dexterity, 0, '', '.')."<br>".number_format($row->Agility, 0, '', '.')."<br>".number_format($row->Intelligence, 0, '', '.')."<br>".number_format($row->Concentration, 0, '', '.')."<br>".number_format($row->Contravention, 0, '', '.');


$dsa=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$num=0;
foreach ($ds as $val) {
if (is_numeric($ds[$num])) {
$dsb[$num] = number_format($ds[$num], 0, '', '.');
}else{
$dsb[$num] = $ds[$num];
}
//$dsa[$num] = number_format(($ds[$num]*(1+($bonus[$num+6]/100))), 0, '', '.');
$num++;
}
$dsa[0] = number_format($ds[0] * (1+($bonus[6]/100)));
$dsa[1] = number_format($ds[1] * (1+($bonus[6]/100)));
$dsa[2] = number_format($ds[2] * (1+($bonus[7]/100)));
$dsa[3] = number_format($ds[3] * (1+($bonus[7]/100)));
$dsa[4] = number_format($ds[4] * (1+($bonus[8]/100)));
$dsa[5] = number_format($ds[5] * (1+($bonus[8]/100)));
$dsa[6] = number_format($ds[6] * (1+($bonus[9]/100)));
$dsa[7] = number_format($ds[7] * (1+($bonus[9]/100)));
$dsa[8] = number_format($ds[8] * (1+($bonus[10]/100)));
$dsa[9] = number_format($ds[9] * (1+($bonus[10]/100)));
$dsa[10] = number_format($ds[10] * (1+($bonus[11]/100)));
$dsa[11] = number_format($ds[11] * (1+($bonus[11]/100)));
$dsa[12] = number_format($ds[12] * (1+($bonus[12]/100)));
$dsa[13] = number_format($ds[13] * (1+($bonus[12]/100)));

$sr=number_format($ds[11]+$ds[22]+$ds[10]+$ds[21]+$ds[24]);
$sd=number_format($ds[2]+$ds[3]+$ds[0]+$ds[1]);
$ss=number_format($ds[6]+$ds[7]+$ds[8]+$ds[9]);
?>
</td></tr></table>
<table cellpadding=0 cellspacing=1 border=0 width=100%><tr>
<th colspan=3>Natural Battlefields Stats for <?php echo "$row->Sex $row->Charname"; ?></th></tr>
<tr>
<td valign="top"><?php echo $row->Race; ?> Stats<br>Weapon damage<br>Attack spell<br>Heal spell<br>Magic Shield<br>Defence<br>Attack rating<br>Magic rating<br>Special damage<br>Special rating<br>Special shield</td>
<td align=right valign="top"><?php 
	echo "
	Min<br> $dsb[0]<br>$dsb[2]<br>$dsb[4]<br>$dsb[6]<br>$dsb[8]<br>$dsb[21]<br>$dsb[22]</td>
<td align=right valign=top> 
	Max<br>$dsb[1]<br>$dsb[3]<br>$dsb[5]<br>$dsb[7]<br>$dsb[9]<br>$dsb[10]<br>$dsb[11]<br>$sd<br>$sr<br>$ss</td>

</tr></table>
";


/*
print number_format($def[11]);print ' <br> ';
print number_format($def[22]);print ' <br> ';
print number_format($def[10]);print ' <br> ';
print number_format($def[21]);print ' <br> ';
print number_format($def[24]);print ' <br> ';
print ' <br> ';
print number_format($def[11]+$def[22]+$def[10]+$def[21]+$def[24]).'rating';
print ' <br> <br> ';
print number_format($def[2]);print ' <br> ';
print number_format($def[3]);print ' <br> ';
print number_format($def[0]);print ' <br> ';
print number_format($def[1]);print ' <br> <br> ';
print number_format($def[2]+$def[3]+$def[0]+$def[1]).'damage';
print ' <br><br> ';
print number_format($def[6]);print ' <br> ';
print number_format($def[7]);print ' <br> ';
print number_format($def[8]);print ' <br> ';
print number_format($def[9]);print ' <br> <br> ';
print number_format($def[6]+$def[7]+$def[8]+$def[9]).'shield';
print ' <br><br> ';
print number_format($mon[11]+$mon[22]+$mon[10]+$mon[21]+$mon[24]);
print '<hr>';
*/


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