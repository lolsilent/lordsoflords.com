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

if (!empty($Action)) {
if ($Action == 'Save current game') {
$query = "SELECT * FROM $tbl_smembers WHERE `Charname`='$row->Charname' ORDER BY `id` DESC";
$result = mysqli_query($link, $query) or die ("Query failed");
$safed = mysqli_num_rows($result);
mysqli_free_result ($result);
if ($safed<5) {
$value="''";
foreach ($row as $key=>$val) {
if ($key !== 'id' and $key !== 'ip') {$value="$value, '$val'";}
}
$value="$value, '$current_date'";
mysqli_query($link, "INSERT INTO $tbl_smembers ($fld_members) values ($value)") and print("Game saved.") or print("Save error! <hr> $value <hr>".mysqli_error($link));
} else {
?>
Max 5 slots of saved games, game was not saved.
<?php 
}
} elseif ($Action == 'Load' and !empty($game)) {
if (!empty($confirm)) {
$query = "SELECT * FROM $tbl_smembers WHERE (`id`='$game' and `Charname`='$row->Charname') ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($link, $query) or die ("Query failed");
$lrow = mysqli_fetch_object ($result);
mysqli_free_result ($result);
if ($lrow->Username == $row->Username and $lrow->Password == $row->Password and $lrow->Charname == $row->Charname) {

$settings = "Level='$lrow->Level', Exp='$lrow->Exp', Gold='$lrow->Gold', Life='$lrow->Life', Strength='$lrow->Strength', Dexterity='$lrow->Dexterity', Agility='$lrow->Agility', Intelligence='$lrow->Intelligence', Concentration='$lrow->Concentration', Contravention='$lrow->Contravention', Weapon='$lrow->Weapon', Attackspell='$lrow->Attackspell', Healspell='$lrow->Healspell', Helmet='$lrow->Helmet', Shield='$lrow->Shield', Amulet='$lrow->Amulet', Ring='$lrow->Ring', Armor='$lrow->Armor', Belt='$lrow->Belt', Pants='$lrow->Pants', Hand='$lrow->Hand', Feet='$lrow->Feet', Dead='$row->Dead', Jail='$lrow->Jail', Stealth='$row->Stealth', Stash='$lrow->Stash', Freeplay='$row->Freeplay'";

mysqli_query($link, "UPDATE LOW_PRIORITY $tbl_members SET $settings WHERE (`id`='$row->id' and `Charname`='$row->Charname')LIMIT 1") and print("Game $game Loaded");
}
} else {
echo "<a href=\"$PHP_SELF?Action=Load&game=$game&confirm=1\">Click here to confirm Loading game $game</a>";
}
} elseif ($Action == 'Delete' and !empty($game)) {
if (!empty($confirm)) {
mysqli_query($link, "DELETE LOW_PRIORITY FROM $tbl_smembers WHERE (`id`=$game and Username='$row->Username' and `Charname`='$row->Charname')LIMIT 1") and print("Game $game Deleted");
} else {
echo "<a href=\"$PHP_SELF?Action=Delete&game=$game&confirm=1\">Click here to confirm Deleting game $game</a>";
}
}
}
?>
<form method=post>
<table width=100% border=1 cellpadding=0 cellspacing=0>
<tr><th colspan=9>Saved Games of <?php echo "$row->Sex $row->Charname";?></th></tr>
<tr><th>#</th><th>Game</th><th>Date safed</th><th>Level</th><th>Exp</th><th>Gold</th><th>Stash</th><th>Load</th><th>Delete</th></tr>
<?php 
$query = "SELECT * FROM $tbl_smembers WHERE `Charname`='$row->Charname' ORDER BY `id` DESC";
$result = mysqli_query($link, $query) or die ("Query failed");
$i=1;
while ($srow = mysqli_fetch_object ($result)) {
echo"<tr><td>$i</td><td>$srow->id</td><td>$srow->ip</td><td>".number_format($srow->Level)."</td><td>".number_format($srow->Exp)."</td><td>".number_format($srow->Gold)."</td><td>".number_format($srow->Stash)."</td><td><a href=\"$PHP_SELF?Action=Load&game=$srow->id\">Load</a></td><td><a href=\"$PHP_SELF?Action=Delete&game=$srow->id\">Delete</a></td></tr>";
$i++;
}
mysqli_free_result ($result);
if ($i <= 5) {
for ($a=$i;$a<=5;$a++) {
echo "<tr><td>$a</td><td align=center colspan=8>Empty</td></tr>";
}
}
?>
<tr><th colspan=9><input type=submit name=Action value="Save current game"></th></tr>
</table>
</form>
All saved games will be deleted when buying a charm, duel or transfer.
Freeplay can not be saved!
<br>
<?php 
include_once("www.prefpages.php");
include_once $game_footer;
?>