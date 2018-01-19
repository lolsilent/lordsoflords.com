<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

if ($freeplay >= 1) {
	$charm_recharge=1000000;
	$charm_upload=50000;
} else {
	$charm_recharge=500000;
	$charm_upload=10000;
}

if (!empty($_POST)) {
	foreach ($_POST as $key => $val) {
		if (!empty($val)) {
			$$key=clean_post($val);
		}
	}
}

if (!empty($_GET)) {
	foreach ($_GET as $key => $val) {
		if (!empty($val)) {
			$$key=clean_post($val);
		}
	}
}

if (!empty($rid) and !empty($cname) and !empty($rprice)) {
$rprice = preg_replace("/\./i","",$rprice);
$rprice = preg_replace("/,/i","",$rprice);
$rprice=round($rprice);
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$row->Charname' and `id`=$rid) ORDER BY `id` ASC";
$result = mysqli_query($link, $query) or die("Query failed");
$cmrow = mysqli_fetch_object ($result) or die("Object failed");
mysqli_free_result ($result);

$reprice = charm_price ();

if ($rprice > 0 and $rprice <= $row->Gold and $reprice == $rprice) {
$to_update .= ", `Gold`=`Gold`-$reprice";$recharged=1;
if ($recharged) {
mysqli_query($link, "UPDATE `$tbl_charms` SET `Time`=".(time()+$charm_recharge)." WHERE (`id`='$rid' and `Charname`='$row->Charname' and `Name`='$cname') LIMIT 1");
}
echo "Recharged the charm to ".number_format($charm_recharge)." seconds";
} else {
if (round($reprice/1000) == $rprice and $rprice <= $row->Gold) {
$to_update .= ", `Gold`=`Gold`-$rprice";$recharged=1;
if ($recharged) {

mysqli_query($link, "UPDATE `$tbl_charms` SET `Time`=$cmrow->Time+$charm_upload WHERE (`id`='$rid' and `Charname`='$row->Charname' and `Name`='$cname') LIMIT 1");
}
echo "Charged the charm with ".number_format($charm_upload)." seconds";
} else {
?>
Not enough gold.
<?php 
}
}
}

if (!empty($did) and !empty($cname)) {
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$row->Charname' and `id`=$did) ORDER BY `id` ASC";
$result = mysqli_query($link, $query) or die("Query failed");
$cmrow = mysqli_fetch_object ($result) or die("Object failed");
mysqli_free_result ($result);
if ($row->Charname == $cmrow->Charname and $did == $cmrow->id) {
$update_did="`Time`=$current_time+$charm_upload";

if ($cmrow->Strength) {$update_did="$update_did, Strength=Strength-1";}
if ($cmrow->Dexterity) {$update_did="$update_did, Dexterity=Dexterity-1";}
if ($cmrow->Agility) {$update_did="$update_did, Agility=Agility-1";}
if ($cmrow->Intelligence) {$update_did="$update_did, Intelligence=Intelligence-1";}
if ($cmrow->Concentration) {$update_did="$update_did, Concentration=Concentration-1";}
if ($cmrow->Contravention) {$update_did="$update_did, Contravention=Contravention-1";}

mysqli_query($link, "UPDATE `$tbl_charms` SET $update_did WHERE (`id`='$cmrow->id' and `Charname`='$row->Charname' and `Name`='$cname') LIMIT 1") or print(mysqli_error($link));
}
}


?>
<table cellpadding=0 cellspacing=1 border=0 width=100%><tr>
<th colspan=5>Stats Charms - <a href="charmss.php">Best Charms ladder</a></th></tr><tr bgcolor="<?php echo $col_th; ?>"><td width=20%>Charm #1</td><td width=20%>Charm #2</td><td width=20%>Charm #3</td><td width=20%>Charm #4</td><td width=20%>Charm #5</td></tr>
<?php 
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$row->Charname') ORDER BY `id` ASC";
$result = mysqli_query($link, $query);
$num=0;

$stats = array ('Strength','Dexterity','Agility','Intelligence','Concentration','Contravention','Weapon damage', 'Attack spell', 'Heal spell', 'Magic Shield', 'Defence','Attack rating','Magic rating','Life','Power Z');

while ($cmrow = mysqli_fetch_object ($result)) {
echo "<td align=center valign=top><b>$cmrow->Name</b><br>Charm $cmrow->id<br>";
if ($cmrow->Strength) {echo "+$cmrow->Strength % Strength<br>";}
if ($cmrow->Dexterity) {echo "+$cmrow->Dexterity % Dexterity<br>";}
if ($cmrow->Agility) {echo "+$cmrow->Agility % Agility<br>";}
if ($cmrow->Intelligence) {echo "+$cmrow->Intelligence % Intelligence<br>";}
if ($cmrow->Concentration) {echo "+$cmrow->Concentration % Concentration<br>";}
if ($cmrow->Contravention) {echo "+$cmrow->Contravention % Contravention<br>";}
if ($cmrow->a1) {echo "+$cmrow->a1 % $stats[6]<br>";}
if ($cmrow->a2) {echo "+$cmrow->a2 % $stats[7]<br>";}
if ($cmrow->a3) {echo "+$cmrow->a3 % $stats[8]<br>";}

if ($cmrow->a4) {echo "+$cmrow->a4 % $stats[9]<br>";}
if ($cmrow->a5) {echo "+$cmrow->a5 % $stats[10]<br>";}
if ($cmrow->a6) {echo "+$cmrow->a6 % $stats[11]<br>";}

if ($cmrow->a7) {echo "+$cmrow->a7 % $stats[12]<br>";}
if ($cmrow->a8) {echo "+$cmrow->a8 % $stats[13]<br>";}
if ($cmrow->a9) {echo "+$cmrow->a9 % $stats[14]<br>";}

if ($cmrow->Name !== 'Gods charm' and $cmrow->Name !== 'Heavenly charm') {
echo "<br><a href=\"docharms.php?sell=$cmrow->id&cname=$cmrow->Name\">Sell charm</a><br>";
}

if ($cmrow->Time > time() and $num <= 4) {


$time_left = $cmrow->Time-time();
if ($time_left >= 0) {echo number_format($time_left)." seconds";} else {echo "<font color=red>INACTIVE</font>";}

$reprice = charm_price ();
if (($cmrow->Time-time()) <= 100000) {
echo "<br><a href=\"$PHP_SELF?rid=$cmrow->id&cname=$cmrow->Name&rprice=".number_format($reprice)."\">Recharge to ".number_format($charm_recharge)." seconds for ".number_format($reprice)."gold.</a><br>";
}
echo "<br><a href=\"$PHP_SELF?rid=$cmrow->id&cname=$cmrow->Name&rprice=".number_format($reprice/1000)."\">Add ".number_format($charm_upload)." seconds for ".number_format($reprice/1000)."gold.</a>";
//if ($row->Level >= 1000) {echo "<br><a href=\"market_sell.php?sell=$cmrow->id&cname=$cmrow->Name\">Place on market</a>";}

} else {
if ($cmrow->Name !== 'Gods charm' and $cmrow->Name !== 'Heavenly charm' and $cmrow->Time <= time()) {
echo "<br><font color=red>INACTIVE<br><a href=\"$PHP_SELF?did=$cmrow->id&cname=$cmrow->Name\">Decharge charm</a></font><br>";

echo "<br><a href=\"docharms.php?sell=$cmrow->id&cname=$cmrow->Name\">Sell charm</a>";
} else {
echo "<br><font color=red>INACTIVE NEED TO BE RECHARGED OR REMOVE AN ACTIVE CHARM</font><br>";
$reprice = charm_price ();
echo "<br><a href=\"$PHP_SELF?rid=$cmrow->id&cname=$cmrow->Name&rprice=".number_format($reprice)."\">Recharge to ".number_format($charm_recharge)." seconds for ".number_format($reprice)."gold.</a>";
}
}
$num++;
echo "<br><a href=\"docharms.php?transfer=$cmrow->id&cname=$cmrow->Name\">Transfer charm</a></b>";

echo "</td>";
if ($num == 5) {print '</tr><tr>';}
if ($num == 10) {print '</tr><tr>';}
if ($num == 15) {print '</tr><tr>';}
if ($num == 20) {print '</tr><tr>';}
if ($num == 25) {print '</tr><tr>';}
}
mysqli_free_result ($result);
if ($num <= 5) {
for ($i=(1+$num);$i<=5;$i++) {
echo "<td align=center>None</td>";
}
}
?>
</table>
Charms can only be found in the world after killing monsters level 100 or above at any level!<br>
If a charm is decharged it will lose 1 point of each stats point.
<?php 
include_once $game_footer;

function charm_price () {
global $cmrow,$row,$max_gold;
$reprice=((((1+$cmrow->Strength)*(1+$cmrow->Intelligence))*((1+$cmrow->Dexterity)*(1+$cmrow->Concentration))*
((1+$cmrow->Agility)+(1+$cmrow->Contravention)))*$row->Level)*50;
if ($reprice>$max_gold) {$reprice=$max_gold/10;}
return round($reprice,0);
}
?>