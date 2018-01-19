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

if ($row->Level >= 250) {
if (empty($Gold)) {$Gold=0;} else {
$Gold = preg_replace("/\./i","",$Gold);
$Gold = preg_replace("/,/i","",$Gold);
$Gold=round($Gold,-3);
if ($Gold < 0) {$Gold=0;}
 }
 if (empty($Credits)) {$Credits=0;} else {
$Credits = preg_replace("/\./i","",$Credits);
$Credits = preg_replace("/,/i","",$Credits);
$Credits=round($Credits,-1);
if ($Credits < 0) {$Credits=0;}
}

if (!empty($cname) and !empty($sell)) {

$query = "SELECT * FROM `$tbl_charms` WHERE (`id`=$sell and `Charname`='$row->Charname') ORDER BY `id` ASC LIMIT 1";
$result = mysqli_query($link, $query);
$cmrow = mysqli_fetch_object ($result);
mysqli_free_result ($result);

$on_market=0;
$query = "SELECT * FROM $tbl_market WHERE (`Charname`='$row->Charname') ORDER BY `id` ASC";
$result = mysqli_query($link, $query);
while ($omrow = mysqli_fetch_object ($result)) {
$on_market++;
}
mysqli_free_result ($result);

if (!empty($cmrow->id) and $cmrow->id == $sell and $cmrow->Charname == $row->Charname and $on_market < 5) {
if ($Gold > 1 or $Credits > 1 and $cmrow->Charname == $row->Charname and $on_market < 5) {
$sell_charm	= "'', '$cmrow->id','$cmrow->Charname', '$cmrow->Name', '$cmrow->Strength', '$cmrow->Dexterity', '$cmrow->Agility', '$cmrow->Intelligence', '$cmrow->Concentration', '$cmrow->Contravention', '$Gold', '$Credits', '', '0', '$current_time'";
mysqli_query($link, "INSERT INTO $tbl_market($fld_market) VALUES ($sell_charm)") and print("Placed your <b>$cname</b> charm on the market.<br>") or print("Can't sell <b>$cname</b> charm.");

mysqli_query($link, "INSERT INTO `lol_zlogs` ($fld_logs) values ('','$row->Charname','CHARM ON MARKET $cmrow->id','$PHP_SELF','$current_date','$REMOTE_ADDR')");
} else {
?>
Charm already placed on the market or you reach max of 5 charms on the market.
<?php 
}
?>
<table cellpadding=0 cellspacing=1 border=0 width=100%><tr><th colspan=2>Place this charm on the market to for an auction</th></tr>
<tr><td valign=top align=center colspan=2>
<?php 
echo "<b>$cmrow->Name</b><br>";
if ($cmrow->Strength) {echo "+$cmrow->Strength % Strength<br>";}
if ($cmrow->Dexterity) {echo "+$cmrow->Dexterity % Dexterity<br>";}
if ($cmrow->Agility) {echo "+$cmrow->Agility % Agility<br>";}
if ($cmrow->Intelligence) {echo "+$cmrow->Intelligence % Intelligence<br>";}
if ($cmrow->Concentration) {echo "+$cmrow->Concentration % Concentration<br>";}
if ($cmrow->Contravention) {echo "+$cmrow->Contravention % Contravention<br>";}
?>
</td></tr>
<tr><th valign=top align=center>Starting price for gold
</th><th valign=top align=center>Starting price for credits
</th></tr>
<form method=post>
<tr><td valign=top align=center><input type=text name=Gold value="<?php echo number_format($Gold);?>">
</td><td valign=top align=center><input type=text name=Credits value="<?php echo number_format($Credits);?>">
</td></tr>
<tr><td valign=top align=center colspan=2><input type=submit name=do value='Place this on the market'>
</td></tr>
</table>
</form>
A charm that can't be sold within 5 days will be destroyed, if it's not retracted.<br>
Retract will be disabled when there are 5 or more bidders.<br>
Sell will be enabled when there are 5 or more bidders.<br>
<b>A retracted charm always needs to be recharged within 10.000 seconds unless it's indestructible!</b><br>
Charms can be placed on the market for a minimum of 10 credits and/or 1.000 gold.
<?php 
} else {
?>
Charm already placed on the market or you reach max of 5 charms on the market.
<?php 
}
} else {
?>
Already place your charm on the market or double clicked, please check the market.
<?php 
} // id is not empty
} else {
?>You need to be level 250 or higher to sell your charms.<?php 
} //level >= 1k

include_once $game_footer;
?>