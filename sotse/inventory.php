<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

require_once 'Items/array.weapons.php';
require_once 'Items/array.attackspells.php';
require_once 'Items/array.healspells.php';
require_once 'Items/array.helmets.php';
require_once 'Items/array.shields.php';
require_once 'Items/array.amulets.php';
require_once 'Items/array.rings.php';
require_once 'Items/array.armors.php';
require_once 'Items/array.belts.php';
require_once 'Items/array.pants.php';
require_once 'Items/array.hands.php';
require_once 'Items/array.feets.php';
$current=array();
if ($_COOKIE['lol_Charname'] == $row->Charname) {
foreach ($items as $val) {
array_push($current,$row->$val);
}
}

echo<<<EOT
<table cellpadding=0 cellspacing=1 border=0 width=100%><tr><th colspan=4>Inventory</th></tr><tr><td>Equipment</td><td>Power</td><td>Classname</td><td align=right>Classpower</td></tr>
EOT;

$num=0;
foreach ($items as $val) {
$nim=$current[$num]/98;
$nim=round($nim, 3);
if ($num == 0) {
$max=count ($Weapons); if ($nim >= $max) {$nim=$max-1;}$whot="$Weapons[$nim]";
} elseif ($num == 1) {
$max=count ($Attackspells); if ($nim >= $max) {$nim=$max-1;}$whot="$Attackspells[$nim]";
} elseif ($num == 2) {
$max=count ($Healspells); if ($nim >= $max) {$nim=$max-1;}$whot="$Healspells[$nim]";
} elseif ($num == 3) {
$max=count ($Helmets); if ($nim >= $max) {$nim=$max-1;}$whot="$Helmets[$nim]";
} elseif ($num == 4) {
$max=count ($Shields); if ($nim >= $max) {$nim=$max-1;}$whot="$Shields[$nim]";
} elseif ($num == 5) {
$max=count ($Amulets); if ($nim >= $max) {$nim=$max-1;}$whot="$Amulets[$nim]";
} elseif ($num == 6) {
$max=count ($Rings); if ($nim >= $max) {$nim=$max-1;}$whot="$Rings[$nim]";
} elseif ($num == 7) {
$max=count ($Armors); if ($nim >= $max) {$nim=$max-1;}$whot="$Armors[$nim]";
} elseif ($num == 8) {
$max=count ($Belts); if ($nim >= $max) {$nim=$max-1;}$whot="$Belts[$nim]";
} elseif ($num == 9) {
$max=count ($Pants); if ($nim >= $max) {$nim=$max-1;}$whot="$Pants[$nim]";
} elseif ($num == 10) {
$max=count ($Hands); if ($nim >= $max) {$nim=$max-1;}$whot="$Hands[$nim]";
} elseif ($num == 11) {
$max=count ($Feets); if ($nim >= $max) {$nim=$max-1;}$whot="$Feets[$nim]";
} else {
$whot = "Elements of Dark Shadows";
}

echo "<tr bgcolor=\"$col_table\"><td>$val</td><td>$current[$num]</td><td>$whot</td><td align=right>$nim</td></tr>";

$num++;
}
?>
</tr></table>
<?php 
include_once $game_footer;
?>