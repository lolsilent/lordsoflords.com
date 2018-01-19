<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once("$game_nsheader");
require_once 'AdMiN/array.races.php';
$races_array['Crazy']='';
$races_array['Monkey']='';
$races_array['LoL']='';
ksort ($races_array);
$races_keys = array_keys($races_array);
ksort ($races_keys);
$opcost = 123;

$race=$row->Race;
if (isset($_POST['race'])) {
	$race = clean_post($_POST['race']);
	if (!in_array($race,$races_keys)) {
		$race=$row->Race;
	}
}
print '<form method=post><table><tr><th colspan=2>Race Change cost '.$opcost.' credits.<br>
Would you like to change your character�s race, to try different racial abilities or simply to see if you can look better in the mirror? The Race Change service enables you to change the race of any character within game.</th></tr>';

$query = "SELECT * FROM `$tbl_credits` WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') ORDER BY `id` DESC";
if ($result = mysqli_query($link, $query)) {

if ($crow = mysqli_fetch_object ($result)) {
mysqli_free_result ($result);

if ($crow->Credits >= $opcost) {

if (isset($_POST['confirm'])) {

if ($race !== $row->Race) {
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`-123 WHERE `id`=$crow->id LIMIT 1") and $oke_oke=1;

if (isset($oke_oke)) {
mysqli_query($link, "UPDATE `$tbl_members` SET `Race`='$race' WHERE `id`=$row->id LIMIT 1") and print("<br>Race changed to $race!") or print("<br>unknown error");
}
}else{
print 'You double clicked or already changed your race.';
}

}else{
print '<tr>
<td valign=top>
Current Race '.$row->Race.' change to
</td><td>
<select name=race>';

foreach ($races_array as $key=>$val) {
if ($key == $race) {
echo "<option value=\"".ucfirst($key)."\" selected>".ucfirst($key)."</option>";
} else {
echo "<option value=\"".ucfirst($key)."\">".ucfirst($key)."</option>";
}
}
print '</select>
</td>
</tr>'.(isset($_POST['race'])?'<tr><td>Confirm race change</td><td><input type=checkbox name=confirm value=confirm></td></tr>':'').'
<tr><th colspan=2><input type=submit></th></tr>
';
}
}else{
	print 'This operation requires '.$opcost.' credits.';
}

}else{
	print 'This operation requires '.$opcost.' credits.';
}
}
print '</table></form>';
include_once("www.prefpages.php");
include_once $game_footer;
?>