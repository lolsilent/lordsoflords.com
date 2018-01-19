<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;
if ($row->Mute <= $current_time) {

	//challenged
$challenged=array();
$query = "SELECT * FROM `$tbl_duel` WHERE (`Challenger`='$row->Charname') ORDER BY `id` DESC";
$result = mysqli_query($link, $query) or die ("Query failed");
$chal_all='';
while ($crow = mysqli_fetch_object ($result)) {
array_push ($challenged,$crow->Opponent);
}
mysqli_free_result ($result);
	//challenged

$query = "SELECT `Sex`,`Charname`,`Level`,`ip` FROM `$tbl_members` WHERE (`Onoff` and `Charname`!='$row->Charname' and `ip`!='$row->ip' and `Level` >= ($row->Level/10)) ORDER BY `Level` DESC";
$result = mysqli_query($link, $query) or die ("Query failed");
$not_challenged='';
$Players='';
$Action='';
if (!empty($_POST['Players'])) {$Players=clean_post($_POST['Players']);}if (!empty($_POST['Action'])) {$Action=clean_post($_POST['Action']);}

while ($prow = mysqli_fetch_object ($result)) {
	$prow->ip=preg_replace("/(\d+)\.(\d+)\.(\d+)\.(\d+)/i","\${1}\${2}\${3}",$prow->ip);
	$row->ip=preg_replace("/(\d+)\.(\d+)\.(\d+)\.(\d+)/i","\${1}\${2}\${3}",$row->ip);
	if ($prow->ip !== $row->ip) {
if (!in_array($prow->Charname,$challenged)) {
if (!empty($Action) and !empty($Players)) {
	if ($Action == 'Challenge' and $Players == $prow->Charname) {
$duel = "'','$row->Charname','$row->Level','$prow->Charname','$prow->Level','$current_time'";
	$Players='';
	} elseif ($Action == 'Everybody') {
$duel = "'','$row->Charname','$row->Level','$prow->Charname','$prow->Level','$current_time'";
	} elseif ($Action == 'All Low Level' and $row->Level > $prow->Level) {
	array_push ($challenged,$prow->Charname);
$duel = "'','$row->Charname','$row->Level','$prow->Charname','$prow->Level','$current_time'";
	}
if (!empty($duel)) {mysqli_query($link, "INSERT INTO `$tbl_duel` ($fld_duel) values ($duel)") and $chal_all="$chal_all $prow->Sex $prow->Charname<br>";}
}
if ($prow->Charname !== $Players and $Action !== 'Everybody' and !in_array($prow->Charname,$challenged)) {
$not_challenged .="<option value=\"$prow->Charname\">$prow->Sex $prow->Charname [".number_format($prow->Level)."]</option>";
}
}//challenged
	}
}//while
mysqli_free_result ($result);

?>
<form method=post>
<table border=0 cellpadding=0 cellspacing=1 width=100%>
<tr>
<th colspan=3>Players that you can challenge</th></tr><tr><th colspan=3>
<?php 
if (!empty($not_challenged)) {
?>
<select name="Players">
<?php echo $not_challenged;?>
</select></th></tr><tr><td><input type=submit name=Action value="Challenge"></td><td><input type=submit name=Action value="Everybody"></td><td><input type=submit name=Action value="All Low Level">
<?php 
} else {
print "No players left or you already challenged them all..";
}
?>
</td></tr>
</table>
</form>
<?php 
if (!empty($chal_all)) {
echo "You have challenged:<br><b>$chal_all</b>";
}
?>
You can win or lose 5% of your exp and gold! <br>
<?php 
} else {
echo $mute_messages;
} //muted
include_once $game_footer;
?>