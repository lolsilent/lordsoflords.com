<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/array.races.php';
require_once 'AdMiN/www.battle.php';
require_once 'AdMiN/www.titles.php';
include_once $game_header;

if (!empty($_GET['cancelall'])) {
if ($_GET['cancelall'] <= 1) {
mysqli_query($link, "DELETE FROM `$tbl_duel` WHERE Challenger='$row->Charname'");
} else {
mysqli_query($link, "DELETE FROM `$tbl_duel` WHERE Opponent='$row->Charname'");
}
}

if (!empty($_GET['del'])) {
$del=$_GET['del'];
mysqli_query($link, "DELETE FROM `$tbl_duel` WHERE `id`='$del' and (`Challenger`='$row->Charname' or Opponent='$row->Charname') LIMIT 1");
}

if (empty($_GET['accept'])) {

$query = "SELECT * FROM `$tbl_duel` WHERE (`Challenger`='$row->Charname' or Opponent='$row->Charname') ORDER BY `id` DESC LIMIT 100";
$result = mysqli_query($link, $query) or die ("Query failed");
?>

<table border=0 cellpadding=0 cellspacing=1 width=100%>
<tr>
<th colspan=3>Duel schedule</th>
</tr>

<?php 
$num=0;$myduels='';$getduels='';
while ($duel_row = mysqli_fetch_object ($result)) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
if ($row->Charname == $duel_row->Challenger) {
$duel_row->Opponent=$duel_row->Opponent;
$myduels .= "<tr$bgcolor><td>You have challenged <b>$duel_row->Opponent [".number_format($duel_row->Level)."]</b>.</td><td align=center colspan=2><a href=\"?del=$duel_row->id\">Cancel</a></td></tr>";
$num++;
} elseif ($row->Charname == $duel_row->Opponent) {
$duel_row->Challenger=$duel_row->Challenger;
$getduels .= "<tr$bgcolor><td><b><a href=\"members.php?info=$duel_row->Challenger\">$duel_row->Challenger</a> [".number_format($duel_row->Mylevel)."]</b> has challenged you.</td><td align=center><a href=\"?accept=$duel_row->id\">Accept</a></td><td align=center><a href=\"?del=$duel_row->id\">Reject</a></td></tr>";
$num++;
}
}
mysqli_free_result ($result);

if (!$num) {
?><tr><td>Nothing scheduled at this moment go to Challenge to challenge somebody.</td></tr><?php 
} else {
?>
<tr><th align=center colspan=3><?php if ($myduels) {?>[<a href="?cancelall=1">Cancel all my challenges</a>]<?php }?> <?php if ($getduels) {?>[<a href="?cancelall=2">Cancel all who challenged you</a>]<?php }?></th></tr>
<?php 
if ($getduels) {
echo $getduels;
}

if ($myduels) {
echo $myduels;
}
}

print '</table>Be careful the level is recorded when your opponent has challenged you or you challenged your opponent.<br>You can win or lose 5% of your exp and gold!<br>';

		} elseif (!empty($_GET['accept'])) {	//DUEL STARTS

$accept=$_GET['accept'];

$dquery = "SELECT * FROM `$tbl_duel` WHERE `id`='$accept' and Opponent='$row->Charname' ORDER BY `id` DESC LIMIT 1";
$dresult = mysqli_query($link, $dquery) or die("Stop it!");
if (!empty($dresult)) {
if ($drow = mysqli_fetch_object ($dresult)) {
	mysqli_free_result ($dresult);
	mysqli_query($link, "DELETE FROM `$tbl_duel` WHERE `id`=$drow->id LIMIT 1") or die("Stop it!");

$oquery = "SELECT * FROM `$tbl_members` WHERE `Charname`='$drow->Challenger' ORDER BY `id` DESC";
$oresult = mysqli_query($link, $oquery) or die ("Query failed");
$oprow = mysqli_fetch_object ($oresult);
mysqli_free_result ($oresult);

if ($row->Charname != $drow->Opponent or $oprow->Charname != $drow->Challenger) {mysqli_close($link);exit;}

$def=battlestats($row,$races_array);
$opp=battlestats($oprow,$races_array);

echo '<table border=0 width=100%><tr>
<th colspan=5>'.$row->Sex.' '.$row->Charname.' vs '.$oprow->Sex.' '.$oprow->Charname.'</th></tr>
<tr>
<td valign=top width=20%> <br>Weapon damage<br>Attack spell<br>Heal spell<br>Magic Shield<br>Defence<br>Attack Rating<br>Magic Rating </td>
<td valign=top align=right width=20%> Min<br>'.number_format($def[0]).'<br>'.number_format($def[2]).'<br>'.number_format($def[4]).'<br>'.number_format($def[6]).'<br>'.number_format($def[8]).' <br>'.number_format($def[21]).'<br>'.number_format($def[22]).'</td>
<td valign=top align=right width=20%> Max<br>'.number_format($def[1]).'<br>'.number_format($def[3]).'<br>'.number_format($def[5]).'<br>'.number_format($def[7]).'<br>'.number_format($def[9]).' <br>'.number_format($def[10]).'<br>'.number_format($def[11]).'</td>
<td valign=top align=right width=20%> Min<br>'.number_format($opp[0]).'<br>'.number_format($opp[2]).'<br>'.number_format($opp[4]).'<br>'.number_format($opp[6]).'<br>'.number_format($opp[8]).' <br>'.number_format($opp[21]).'<br>'.number_format($opp[22]).'</td>
<td valign=top align=right width=20%> Max<br>'.number_format($opp[1]).'<br>'.number_format($opp[3]).'<br>'.number_format($opp[5]).'<br>'.number_format($opp[7]).'<br>'.number_format($opp[9]).' <br>'.number_format($opp[10]).'<br>'.number_format($opp[11]).'</td>
</tr></table>';

if (!empty($def[0]) and !empty($opp[0])) {
$def[17]="You";
$def[18]="Your";
$def[19]="you";

if (in_array($oprow->Sex, $female)) {
$opp[17]="She";
$opp[18]="Her";
$opp[19]="her";
} else {
$opp[17]="He";
$opp[18]="His";
$opp[19]="him";
}

$wdef=array($opp[17],$opp[18],$def[15],$def[17],$def[18],$def[19]);
$wopp=array($def[17],$def[18],$opp[15],$opp[17],$opp[18],$opp[19]);
$battles=0;
while ($def[12] >=0 and $opp[12] >=0) {
if ($def[1] > $def[3]) {
if ($def[12] >=0 and $opp[12] >=0) {$opp[12]=weapon($def,$opp,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$def[12]=weapon($opp,$def,$wdef,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$opp[12]=magic($def,$opp,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$def[12]=magic($opp,$def,$wdef,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$opp[12]=heal($def,$opp,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$def[12]=heal($opp,$def,$wdef,$divs);} else {break;}
} else {
if ($def[12] >=0 and $opp[12] >=0) {$opp[12]=magic($def,$opp,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$def[12]=magic($opp,$def,$wdef,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$opp[12]=weapon($def,$opp,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$def[12]=weapon($opp,$def,$wdef,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$opp[12]=heal($def,$opp,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $opp[12] >=0) {$def[12]=heal($opp,$def,$wdef,$divs);} else {break;}
}
$battles++;
if ($battles >= 25) {break;}
}

$news='';
echo "<p><b>";
if ($opp[12] <= 0) {
$opp[21]=$opp[13]/20;if ($opp[21] <= 0) {$opp[21]=0;}
$opp[22]=$opp[14]/20;if ($opp[22] <= 0) {$opp[22]=0;}
if ($oprow->Charname !== $row->Charname) {
mysqli_query($link, "UPDATE `$tbl_members` SET Exp=Exp-$opp[21],`Gold`=`Gold`-$opp[22] WHERE `Charname`='$oprow->Charname' LIMIT 1");
mysqli_query($link, "UPDATE $tbl_history SET Duelsl=Duelsl+1 WHERE `Charname`='$oprow->Charname' LIMIT 1");

$gods_take_xp = floor(($opp[21]/100)*5);
$opp[21] -= $gods_take_xp;
$gods_take_gold = floor(($opp[22]/100)*5);
$opp[22] -= $gods_take_gold;
if ($opp[21] <= 0) {$opp[21]=0;}
if ($opp[21] <= 0) {$opp[22]=0;}

mysqli_query($link, "UPDATE `$tbl_members` SET `Exp`=`EXP`+$opp[21],`Gold`=`Gold`+$opp[22] WHERE `Charname`='$row->Charname' LIMIT 1");
mysqli_query($link, "UPDATE $tbl_history SET Duelsw=Duelsw+1 WHERE `Charname`='$row->Charname' LIMIT 1");

$news .= "You have slain $oprow->Sex $opp[15] [$opp[23]].";
$news .= '<br>The gods have taken '.number_format($gods_take_xp).' Exp and '.number_format($gods_take_gold).' Gold.<br>';

$opp[21] = number_format($opp[21], 0, '', '.');
$opp[22] = number_format($opp[22], 0, '', '.');
$newsa = "You win $opp[21] exp and $opp[22] gold from <b>$oprow->Sex $opp[15] [$opp[23]]</b>.";
}
} elseif ($def[12] <= 0) {
$def[21]=$def[13]/20;if ($def[21] <= 0) {$def[21]=0;}
$def[22]=$def[14]/20;if ($def[22] <= 0) {$def[22]=0;}
if ($oprow->Charname !== $row->Charname) {

mysqli_query($link, "UPDATE `$tbl_members` SET Exp=Exp-$def[21],`Gold`=`Gold`-$def[22] WHERE `Charname`='$row->Charname' LIMIT 1");
mysqli_query($link, "UPDATE $tbl_history SET Duelsl=Duelsl+1 WHERE `Charname`='$row->Charname' LIMIT 1");


$gods_take_xp = floor(($def[21]/100)*5);
$def[21] -= $gods_take_xp;
$gods_take_gold = floor(($def[22]/100)*5);
$def[22] -= $gods_take_gold;
if ($def[21] <= 0) {$def[21]=0;}
if ($def[21] <= 0) {$def[22]=0;}

mysqli_query($link, "UPDATE `$tbl_members` SET `Exp`=`EXP`+$def[21],`Gold`=`Gold`+$def[22] WHERE `Charname`='$oprow->Charname' LIMIT 1");
mysqli_query($link, "UPDATE $tbl_history SET Duelsw=Duelsw+1 WHERE `Charname`='$oprow->Charname' LIMIT 1");

$news .= "You have been slain by $oprow->Sex $opp[15] [$opp[23]].";
$news .= '<br>The gods have taken '.number_format($gods_take_xp).' Exp and '.number_format($gods_take_gold).' Gold.<br>';

$def[21] = number_format($def[21], 0, '', '.');
$def[22] = number_format($def[22], 0, '', '.');
$newsa = "You lose $def[21] exp and $def[22] gold to <b>$oprow->Sex $opp[15] [$opp[23]]</b>.";
}
} else {
$news = "The battle tied.";
$newsa = "";
}
mysqli_query($link, "INSERT INTO `$tbl_index` ($fld_index) VALUES('','".date('m d Y')."',1,$current_time)") or mysqli_query($link, "UPDATE `$tbl_index` SET `fights`=`fights`+1 WHERE (`date`='".date('m d Y')."') LIMIT 1");
echo "$news $newsa</b>";
$query = "SELECT * FROM `$tbl_duel` WHERE (`Challenger`='$row->Charname' or Opponent='$row->Charname') ORDER BY `id` DESC";
$wip=array("'You'","'have'","'win'","'lose'");
$wap=array("<b>$row->Sex $row->Charname [$def[23]]</b>","has","won","lost");
$newsa=preg_replace($wip,$wap,$newsa);
if ($newsa) {
$deads= "
'',
'$newsa',
'$current_date'
";
mysqli_query($link, "INSERT INTO $tbl_deads ($fld_deads) VALUES ($deads)") or print("Unable to insert deads.");
}
mysqli_query($link, "DELETE FROM $tbl_smembers WHERE (`Charname`='$row->Charname')");
mysqli_query($link, "DELETE FROM $tbl_smembers WHERE (`Charname`='$oprow->Charname')");
} else {
print $Opp.' is not logged on. ';
}
} else {
?>You double clicked the button or this duel was already dueled please refresh page or try again.<?php 
}
}

}	//DUEL ENDS

include_once $game_footer;
?>