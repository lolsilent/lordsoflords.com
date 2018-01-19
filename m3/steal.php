<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

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

$max_steal=1000000;
$max_steal*=$row->Level;


$stealth=$row->Stealth-$current_time;

/*
if($row->Charname == 'SilenT' and $row->id == 1){$stealth=$row->Stealth-$row->Stealth-10;}
*/
if ($row->Freeplay>=1) {$stealth/=2;}
echo '
<form method=post>
<table border=0 cellpadding=0 cellspacing=1 width=100%>
<tr>
<th colspan=2>Steal from the sleepers</th>
</tr>';

if ($stealth < 0) {
if (isset($action)) {
	require_once 'AdMiN/array.races.php';
mysqli_query($link, "UPDATE `$tbl_members` SET Stealth=$current_time+3600 WHERE `id`=$row->id LIMIT 1");
$Opp=preg_replace("'^.*? '","",$Opp);
$Opp=preg_replace("' \[Level.*?$'","",$Opp);

$query = "SELECT * FROM `$tbl_members` WHERE (Level >= 100 and `Level` <= $row->Level and Exp>100000 and ($current_time-Time) >= 2592000 and `Charname`='$Opp') ORDER BY Level desc";
$result = mysqli_query($link, $query) or die ("Query failed");
$orow = mysqli_fetch_object ($result);
mysqli_free_result ($result);

if ($row->Level >= $orow->Level) {
if (!in_array($row->Race,array_keys($races_array))) {$row->Race='Human';}

$thiefpower = isset($races_array[$row->Race][4]) ? $races_array[$row->Race][4] : 1;
$thiefpowero = isset($races_array[$orow->Race][4]) ? $races_array[$row->Race][4] : 1;

$athief	= $row->Agility*$thiefpower;
$dthief	= $orow->Agility*$thiefpowero;
$thief = $athief-$dthief;
$thief/=100; if ($thief >= 50) {$thief=50;} if ($thief <= 0) {$thief=1;}
$thief=100-($thiefpower+$thief);


if ($orow->Charname == $Opp) {
if ($action == "Steal Exp and Gold") {

$safe_exp = $orow->Exp/$thief; if ($safe_exp > $max_steal) {$safe_exp=$max_steal;}
$safe_gold = $orow->Gold/$thief; if ($safe_gold > $max_steal) {$safe_gold=$max_steal;}
if ($safe_exp >= $orow->Exp) {$safe_exp=$orow->Exp;}
 if ($safe_gold >= $orow->Gold) {$safe_gold=$orow->Gold;}
$safe_exp=round($safe_exp,-2); if ($safe_exp <= 0) {$safe_exp=0;}
$safe_gold=round($safe_gold,-2); if ($safe_gold <= 0) {$safe_gold=0;}

mysqli_query($link, "UPDATE `$tbl_members` SET Exp=Exp-$safe_exp,`Gold`=`Gold`-$safe_gold WHERE `Charname`='$orow->Charname' LIMIT 1")
and $oke_oke=1 or print("<tr><td>An angel from heaven prevented that $Opp would lost his gold.</td></tr>");

if (isset($oke_oke)) {
mysqli_query($link, "UPDATE `$tbl_members` SET `Exp`=`EXP`+$safe_exp,`Gold`=`Gold`+$safe_gold WHERE (`Charname`='$row->Charname' and Username='$row->Username') LIMIT 1");
print("<tr><td>You just stole ".number_format($safe_exp, 0, '', '.')." exp and ".number_format($safe_gold, 0, '', '.')." gold from $Opp.</td></tr>");
}
} else {
$item_name=preg_replace("'^Steal '","",$action);
if ($freeplay > 0) {
$stats=array('Strength', 'Dexterity', 'Agility', 'Intelligence', 'Concentration', 'Contravention');
$stats_items=array_merge($stats,$items);
$steal_what=array_rand($stats_items);

if ($orow->$stats_items[$steal_what] > 1) {
$safe_item = $orow->$stats_items[$steal_what]/$thief; if ($safe_item > $max_steal) {$safe_item=$max_steal;}
$safe_item=round($safe_item,0); if ($safe_item <= 1) {$safe_item=1;}

mysqli_query($link, "UPDATE `$tbl_members` SET $stats_items[$steal_what]=$stats_items[$steal_what]-$safe_item WHERE `Charname`='$orow->Charname' LIMIT 1") and $oke_oke=1 or print("<tr><td>An angel from heaven prevented that $Opp would lost his gold.</td></tr>");

if (isset($oke_oke)) {
mysqli_query($link, "UPDATE `$tbl_members` SET $stats_items[$steal_what]=$stats_items[$steal_what]+$safe_item WHERE `Charname`='$row->Charname' LIMIT 1");
print("<tr><td>You stole <b>".number_format($safe_item)."</b> of his ".number_format($orow->$stats_items[$steal_what])." $stats_items[$steal_what]. You had ".number_format($row->$stats_items[$steal_what])." now you have ".number_format($row->$stats_items[$steal_what]+$safe_item)." $stats_items[$steal_what]. </td></tr>");
}
$steal_val	= "'', '$row->Charname', '$stats_items[$steal_what] from <b>$orow->Sex $orow->Charname [".number_format($orow->Level)."]</b>', '$safe_item', '$current_date'";
mysqli_query($link, "INSERT INTO $tbl_steals ($fld_steals) values ($steal_val)");
} else {
echo "<tr><td>Bad luck he doesn't have any <b>$stats_items[$steal_what]</b> left. Better luck next time.</td></tr>";
}

} else {
echo "Freeplay is required to steel $item_name.";
}
} // if exp else item
} // if in_name == orow name
} //my`Level` <= oplevel
} else {
$query = "SELECT * FROM `$tbl_members` WHERE (Level >= 100 and `Level` <= $row->Level and Exp>100000 and ($current_time-Time) >= 2592000) ORDER BY Level desc LIMIT 100";
$result = mysqli_query($link, $query) or die ("Query failed");
$online=array();
while ($irow = mysqli_fetch_object ($result)) {
	if ($irow->Level <= $row->Level and $irow->Level >= 100 and ($current_time-$irow->Time) >= 2592000) {
array_push($online, "$irow->Sex $irow->Charname [Level : $irow->Level] [Exp : ".number_format($irow->Exp, 0, '', '.')."] [Gold : ".number_format($irow->Gold, 0, '', '.')."] [Race : $irow->Race]");
mysqli_query($link, "DELETE FROM $tbl_smembers WHERE Username='$irow->Username'");
	}
}
mysqli_free_result ($result);
if (!empty($online[0])) {
echo "<tr bgcolor=$col_table><td><select name=Opp>";
foreach ($online as $on) {
echo "<option>$on</option>";
}
echo "</select></td></tr>";
echo "<tr><td><table width=100%><tr><td width=50%><input type=submit name=action value=\"Steal Exp and Gold\"></td>";
if ($freeplay > 0) {
echo "<td><input type=submit name=action value=\"Steal Stats or Items\"></td>";
}
echo "</table></td></tr>";
} else {
echo "<tr bgcolor=$col_table><td>There is nothing left to steal from.</td></tr>";
}
}
} else {
?>
<tr><td>You need to recover your Stealth.Take a rest for <?php echo number_format($stealth); ?> seconds.</td></tr>
<?php 
}
?>
</table></form>
<br>
This is a place where you can steal exp and gold from other players that haven't logged in for 30 days or longer.
You may only steal from players that are equal or lower to your Level. Be sure to steal from a good Character because you may only steal once in an hour.
For each level you can steal 1.000.000. How much you steal once depends on your thievery power vs opponents thievery power.<p>
<?php 
echo "You can steal max ".number_format($max_steal, 0, '', '.')." gold and exp once.";
include_once $game_footer;
?>