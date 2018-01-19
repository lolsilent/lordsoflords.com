<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/www.mysql.php';
include_once "$game_header";
if ($row->Sex !== 'Criminal') {
if (!empty($Sex) and !empty($Action)) {
	require_once 'AdMiN/www.titles.php';
if ($row->Sex !== $Sex) {
	if (in_array($row->Sex,$male) or in_array($row->Sex,$female)) {
if ($Sex == 'Lord') {
$to_update .= ", `Sex`='$Sex'";
echo "The medicine man build a thing between your legs.";
} elseif ($Sex == 'Lady') {
$to_update .= ", `Sex`='$Sex'";
echo "Ouch! That hurts the medicine man cuts of your thing!! AAAhh.";
}
}
	}
}
?>
<form method=post>
<table cellpadding=0 cellspacing=1 border=0 width=100%> <tr><th colspan=2><?php echo $title; ?> Medicine man</th></tr>
<tr><td width=50%>Sex change</td><td><select name=Sex><option>Lord</option><option>Lady</option></select></td></tr>
<tr><td colspan=2><input type=submit name=Action value="Go to the operation room!"></td></tr>
</table>
</form>
You found an Easter egg in the game. Not for chars with a special sex.
<?php 
} else {
?>
Sorry we don't give free treatment to criminals.
<?php 
}
include_once $game_footer;
?>