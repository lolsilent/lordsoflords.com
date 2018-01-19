<?php 
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
if (!empty($sell) and !empty($cname)) {
	 //sell
?>
 <form method=post>
 <table width="100%" cellpadding=0 cellspacing=1 border=0 align=center>
 <tr><th>Sell this charm</th></tr>
 <tr><td align=center>
 <?php 
$price=charm_price ($sell);
if (!empty($sell) and !empty($price) and !empty($cname) and !empty($action)) {
mysqli_query($link, "DELETE FROM `$tbl_charms` WHERE (`Charname`='$row->Charname' and `id`=$sell) LIMIT 1") and $soldcharm=("You sold your charm for ".number_format($price)." gold.") or print("No such charm found in your inventory.");
if (!empty($soldcharm)) {
$to_update .= ", `Gold`=`Gold`+$price";
}
} else {
?>
</td></tr><tr><td><input type=submit name=action value="Sell it now!">
<input type=hidden name=sell value="<?php echo $sell; ?>">
<input type=hidden name=cname value="<?php echo $cname; ?>">
<?php 
}
?>
</td></tr></table></form>
<?php 
 	//sell
} elseif (!empty($transfer) and !empty($cname)) {
 	//transfer
$Players='';
if (!empty($transfer) and !empty($action) and !empty($cname) and !empty($_POST['Players'])) {
$Players=$_POST['Players'];
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$Players') ORDER BY `id` ASC";
$result = mysqli_query($link, $query);
$playerslots=mysqli_num_rows($result);
mysqli_free_result ($result);
if ($playerslots<5) {
mysqli_query($link, "UPDATE `$tbl_charms` SET `Charname`='$Players' WHERE (`Charname`='$row->Charname' and `Name`='$cname' and `id`=$transfer) LIMIT 1") and print("Transfered charm to <b>$Players</b>.") or print("Charm lost during transaction, or <b>$Players</b> charmslots is full.");
mysqli_query($link, "DELETE FROM `$tbl_market` WHERE (`cid`='$transfer' and `Charname`='$row->Charname') LIMIT 1");
//log charm
if ($cname == 'Gods charm' or $cname='Heavenly charm') {
mysqli_query($link, "INSERT INTO `lol_zlogs` ($fld_logs) values ('','$row->Charname','id=$transfer $cname to $Players','$PHP_SELF','$current_date','$REMOTE_ADDR')");
}
//logcharm

} else {
echo "<b>$Players</b> charmslots is full, canceled transfer.";
}
} else {
 ?>
 <form method=post>
 <table width="100%" cellpadding=0 cellspacing=1 border=0 align=center>
 <tr><th colspan=2>Transfer this charm</th></tr>
 <tr><td colspan=2 align=center>
 <?php 
 $price=charm_price ($transfer);
 ?>
 </td></tr><tr><th>To</th><th width=50%><select name=Players>
 <?php 
$price=charm_price ($transfer);
$query = "SELECT `Sex`,`Charname`,`Level` FROM `$tbl_members` WHERE (`Onoff` and `Charname`!='$row->Charname') ORDER BY Level desc";
$result = mysqli_query($link, $query) or die ("Query failed");
while ($onrow = mysqli_fetch_object ($result)) {
	echo "<option value=\"$onrow->Charname\">$onrow->Sex $onrow->Charname [$onrow->Level]</option>";
}
mysqli_free_result ($result);
 ?>
 </select></th></tr><tr><th colspan=2><input type=submit name=action value="Transfer this charm"></td></tr></table>
 <input type=hidden name=transfer value="<?php echo $transfer; ?>">
 <input type=hidden name=cname value="<?php echo $cname; ?>">
 </form>
 <?php 
}
 	//transfer
} else {
?>
what do you want?
<?php 
}
include_once $game_footer;

function charm_price ($what_id) {
global $link,$tbl_charms,$row,$max_gold;
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$row->Charname' and `id`=$what_id) ORDER BY `id` ASC";
$result = mysqli_query($link, $query);
$cmrow = mysqli_fetch_object ($result);
if (isset($cmrow) and !empty($cmrow)) {
echo "<b>$cmrow->Name</b><br>";
if ($cmrow->Strength) {echo "+$cmrow->Strength % Strength<br>";}
if ($cmrow->Dexterity) {echo "+$cmrow->Dexterity % Dexterity<br>";}
if ($cmrow->Agility) {echo "+$cmrow->Agility % Agility<br>";}
if ($cmrow->Intelligence) {echo "+$cmrow->Intelligence % Intelligence<br>";}
if ($cmrow->Concentration) {echo "+$cmrow->Concentration % Concentration<br>";}
if ($cmrow->Contravention) {echo "+$cmrow->Contravention % Contravention<br>";}
$time_left = $cmrow->Time-time();
if ($time_left >= 0) {echo number_format($time_left)." seconds<br>";} else {echo "<font color=red>INACTIVE</font><br>";}

$reprice=((((1+$cmrow->Strength)*(1+$cmrow->Intelligence))*((1+$cmrow->Dexterity)*(1+$cmrow->Concentration))*
((1+$cmrow->Agility)+(1+$cmrow->Contravention)))*$row->Level)*25;
if ($reprice>$max_gold) {$reprice=$max_gold/10;}
echo "Charm value ".number_format($reprice)." gold.<br>";

return $reprice;
}
}
?>