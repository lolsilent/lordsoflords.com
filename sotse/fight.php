<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/array.races.php';
require_once 'AdMiN/www.battle.php';
include_once($game_header);

$next_level = next_level();



if (!empty($_POST['Monster']) and !empty($_POST['Action']) and !empty($_POST['Difficulty'])) {

$Difficulty=$_POST['Difficulty'];if($Difficulty<1){$Difficulty=1;}
$Monster=$_POST['Monster'];
$Action=$_POST['Action'];

$monster_level=preg_replace("/ - .*?$/i", "", $Monster);if ($monster_level < 1) {$monster_level=1;}
$Monster=preg_replace("/,/i", "", $Monster);

$mon=array();
for ($i=0; $i <= 16; $i++) {
$calcite=(100+((1+$i)*(1+$i))*$i)*($Difficulty);
array_push($mon, $calcite);
}

$mnum = array ("'^.*? \- '","' \- .*?$'");$mnuma = array ("","");
$mon[15]=preg_replace($mnum, $mnuma, $Monster); //monster name

$mon[13]=(96+((1+$monster_level)*(1+$monster_level))*$monster_level)*($Difficulty); // monster exp

$mon[0]=($mon[13]+$mon[0])/15;
$mon[1]=($mon[13]+$mon[1])/5;
$mon[2]=($mon[13]+$mon[2])/15;
$mon[3]=($mon[13]+$mon[3])/3;
$mon[4]=($mon[13]+$mon[4])/15;
$mon[5]=($mon[13]+$mon[5])/4;
$mon[6]=($mon[13]+$mon[6])/15;
$mon[7]=($mon[13]+$mon[7])/6;
$mon[8]=($mon[13]+$mon[8])/15;
$mon[9]=($mon[13]+$mon[9])/7;
$mon[10]=($mon[13]+$mon[10])/25;
$mon[11]=($mon[13]+$mon[11])/25;
$mon[12]=($mon[13]+$mon[12])/5;
$mon[14]=$mon[13]/3;
$mon[17]='';
$mon[18]='';
$mon[19]='';
$mon[20]='';
$mon[21]=$mon[10]/2.5;
$mon[22]=$mon[11]/2.5;

$def=battlestats($row,$races_array);


echo '<table border=0 width=100%><tr><th colspan=6>'.$row->Sex.' '.$row->Charname.' vs <a name=monster>'.$mon[15].'</a></th></tr>
<tr><td valign=top width=20%> <br>Weapon damage<br>Attack spell<br>Heal spell<br>Magic Shield<br>Defence<br>Attack Rating<br>Magic Rating </td>
<td valign=top align=right width=20%> Min<br>'.number_format($def[0]).'<br>'.number_format($def[2]).'<br>'.number_format($def[4]).'<br>'.number_format($def[6]).'<br>'.number_format($def[8]).' <br>'.number_format($def[21]).'<br>'.number_format($def[22]).'</td>
<td valign=top align=right width=20%> Max<br>'.number_format($def[1]).'<br>'.number_format($def[3]).'<br>'.number_format($def[5]).'<br>'.number_format($def[7]).'<br>'.number_format($def[9]).' <br>'.number_format($def[10]).'<br>'.number_format($def[11]).'</td>
<td align=right valign=top width=20%><a name=monster>Min<br>'.number_format($mon[0]).'<br>'.number_format($mon[2]).'<br>'.number_format($mon[4]).'<br>'.number_format($mon[6]).'<br>'.number_format($mon[8]).'<br>'.number_format($mon[21]).'<br>'.number_format($mon[22]).'</a></td><td align=right valign=top width=20%><a name=monster>Max<br>'.number_format($mon[1]).'<br>'.number_format($mon[3]).'<br>'.number_format($mon[5]).'<br>'.number_format($mon[7]).'<br>'.number_format($mon[9]).'<br>'.number_format($mon[10]).'<br>'.number_format($mon[11]).'</a></td></tr></table>
<table border=0 width=100%>
<tr><th colspan=4>Monster Stats</th></tr>
<tr><td>Level : '.number_format($monster_level).'</td><td>Life : '.number_format($mon[12]).'</td><td>Exp : '.number_format($mon[13]).'</td><td>Gold : '.number_format($mon[14]).'</td></tr>
</table>';


if ($def[0] and $mon[0]) {
$def[17]=substr($def[15], 0, 4);
$def[17]="You";
$def[18]="Your";
$def[19]="you";

$mon[17]=substr($mon[15], 0, 4);
if (preg_match("/^[AEOIU]/i",$mon[17])) {
$mon[17]="She";
$mon[18]="Her";
$mon[19]="her";
} else {
$mon[17]="He";
$mon[18]="His";
$mon[19]="him";
}

$wdef=array($mon[17],$mon[18],$def[15],$def[17],$def[18],$def[19]);
$wopp=array($def[17],$def[18],$mon[15],$mon[17],$mon[18],$mon[19]);
$num=0;
$randdiv = array_rand ($divs, 2);
$mon[10] = ($mon[10]+$mon[21])/$divs[$randdiv[0]];
$mon[11] = ($mon[11]+$mon[22])/$divs[$randdiv[1]];
$randdiv = array_rand ($divs, 2);
$def[10] = ($def[10]+$def[21])/$divs[$randdiv[0]];
$def[11] = ($def[11]+$def[22])/$divs[$randdiv[1]];

$battles=0;
while ($def[12] >=0 and $mon[12] >=0 and $battles < 5) {
$battles++;echo "<b>Round $battles</b><br>";
if ($def[1] > $def[3]) {
if ($def[12] >=0 and $mon[12] >=0) {$mon[12]=weapon($def,$mon,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$def[12]=weapon($mon,$def,$wdef,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$mon[12]=magic($def,$mon,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$def[12]=magic($mon,$def,$wdef,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$mon[12]=heal($def,$mon,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$def[12]=heal($mon,$def,$wdef,$divs);} else {break;}
} else {
if ($def[12] >=0 and $mon[12] >=0) {$mon[12]=magic($def,$mon,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$def[12]=magic($mon,$def,$wdef,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$mon[12]=weapon($def,$mon,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$def[12]=weapon($mon,$def,$wdef,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$mon[12]=heal($def,$mon,$wopp,$divs);} else {break;}
if ($def[12] >=0 and $mon[12] >=0) {$def[12]=heal($mon,$def,$wdef,$divs);} else {break;}
}
} //while
}

if ($mon[12] <= 0) {
$mon[21]=($mon[13]/5)*(1+$def[20]);
$mon[22]=($mon[14]/5)*(1+$def[20]);
$randdiv = array_rand ($divs, 2);
$mon[21] = ($mon[0]+$mon[21])/$divs[$randdiv[0]];
$mon[22] = ($mon[2]+$mon[22])/$divs[$randdiv[0]];
$mon[13]=round($mon[13],-1);
$mon[14]=round($mon[14],-1);
$mon[21]=round($mon[21],-1);
$mon[22]=round($mon[22],-1);
if ($mon[21] >= $mon[13]) {
$mon[21]=$mon[13];
}
if ($mon[22] >= $mon[14]) {
$mon[22]=$mon[14];
}

if ($freeplay >= 1) {
	$fbonus=rand(1,25);
	$mon[21]=$mon[21]*$fbonus;
	$mon[22]=$mon[22]*$fbonus;
	$fbonus='<br>Your freeplay bonus was '.number_format($fbonus*100).'%!.';
} else {
	$fbonus='';
}

//KILLING SPREE
$spree=rand(5,10);
print '<br><b>Killing spree of '.$spree.'!</b><br>';
$mon[21]*=$spree;$mon[22]*=$spree;
//KILLING SPREE



if ($mon[21] <= 0) {$mon[21]=0;}if ($mon[22] <= 0) {$mon[22]=0;}
if ($mon[21] > 0 or $mon[22] > 0) {
$safe_exp=$row->Exp+$mon[21];if ($safe_exp < 0) {$safe_exp=$row->Exp;}
$safe_gold=$row->Gold+$mon[22];if ($safe_gold < 0) {$safe_gold=$row->Gold;}
	$to_update .= ", `Exp`='$safe_exp', `Gold`='$safe_gold'";
			if (!empty($row->Friend)) {
//myfriend ($mon[21],$mon[22],$row->Friend);
			}
}
mysqli_query($link, "UPDATE `$tbl_history` SET `Kills`=`Kills`+1 WHERE (`Charname`='$row->Charname') LIMIT 1");

$news = 'You have slain '.$mon[15].'. You win '.number_format($mon[21]).' exp and '.number_format($mon[22]).' gold.'.$fbonus;
} elseif ($def[12] <= 0) {
$to_update .= ", `Exp`=`Exp`/1.01, `Gold`=`Gold`/1.01";
mysqli_query($link, "UPDATE `$tbl_history` SET `Deads`=`Deads`+1 WHERE (`Charname`='$row->Charname') LIMIT 1");

$news = 'You have been slain by '.$mon[15].'. You lose '.number_format($row->Exp/100).' exp and '.number_format($row->Gold/100).' gold.';
mysqli_query($link, "INSERT INTO `lol_zlogs` ($fld_logs) values ('','$row->Charname','Lost a percentage of $row->Exp exp','$PHP_SELF','$current_date','$REMOTE_ADDR')");
} else {
$news = 'The battle tied.';
}
mysqli_query($link, "INSERT INTO `$tbl_index` ($fld_index) VALUES('','".date('m d Y')."',1,$current_time)") or mysqli_query($link, "UPDATE `$tbl_index` SET `fights`=`fights`+1 WHERE (`date`='".date('m d Y')."') LIMIT 1");
print "<b>$news</b><br>";
?>
Next level <?php echo number_format($next_level); ?> exp.
<?php 

} else {
?>
<script type="text/javascript">
<!--
window.parent.frames['lol_fcontrol'].location.replace('fight_control.php');
document.write('Select a monster from the list and click fight!');
-->
</script>
<noscript>
<a href="fight_control.php" target="lol_fcontrol">Click here to open fight controls!</a>
</noscript>
<?php 
}

if ($row->Exp > $next_level) {
echo '<b>Congratulations you have leveled up for reaching '.number_format($next_level).' exp</b>';
include_once('stats.inc.php');
}
include_once($game_footer);
?>