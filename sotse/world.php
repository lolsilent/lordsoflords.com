<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/www.main.php';
include_once($game_header);

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
					$gchance=round(mic_time(), 0);
if (empty($Difficulty)) {$Difficulty=1;} else {if ($Difficulty <= 1) {$Difficulty=1;}}

if($wresult = mysqli_query($link, "SELECT * FROM $tbl_world WHERE `Charname`='$row->Charname' ORDER BY `id` DESC")){
if($wrow = mysqli_fetch_object ($wresult)){
mysqli_free_result ($wresult);
}}

if (!empty($wrow->Charname) and empty($_POST['freebie'])) {
?>
<form method=post>
<input type=submit name=freebie value="Click here to upgrade <?php echo $wrow->Item; ?> free now!">
<input type=submit name=freebie value="No upgrade">
</form>
<?php 
} elseif (!empty($wrow->Charname) and !empty($_POST['freebie'])) {
if ($_POST['freebie'] !== "No upgrade") {
mysqli_query($link, "UPDATE `$tbl_members` SET `$wrow->Item`=`$wrow->Item`+1 WHERE `id`='$row->id' LIMIT 1");
?>Upgrade succesfully.<?php 
} else {
?>Nothing upgraded.<?php 
}
mysqli_query($link, "DELETE FROM `$tbl_world` WHERE `Charname`='$row->Charname' LIMIT 5");
} else {
require_once 'AdMiN/array.races.php';
require_once 'AdMiN/www.battle.php';
require_once 'AdMiN/array.locations.php';

$next_level = next_level();
if (empty($Monster)) {$Monster='';}


$monster_level=preg_replace("/ - .*?$/i", "", $Monster);if ($monster_level <= 1) {$monster_level=10;}

if (!empty($_POST['Monster']) and !empty($_POST['Action'])) {
$Monster=$_POST['Monster'];
$Action=$_POST['Action'];
$Monster=preg_replace("/,/i", "", $Monster);

$mon=array();
for ($i=0; $i <= 16; $i++) {
$calcite=(100+((1+$i)*(1+$i))*$i)*($Difficulty);
array_push($mon, $calcite);
}

$mnum = array ("'^.*? \- '","' \- .*?$'");$mnuma = array ("","");
$mon[15]=preg_replace($mnum, $mnuma, $Monster); //monster name
$mnum = array ("'^.*? \- '","'^.*? \- '");$mnuma = array ("","");
$mon[13]=preg_replace($mnum, $mnuma, $Monster); // monster exp

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
$mon[17]="";
$mon[18]="";
$mon[19]="";
$mon[20]="";
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
					$ochance=round(mic_time(), 0);
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
while ($def[12] >=0 and $mon[12] >=0 and $battles < 3) {
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
$lose_rand=rand(200,995);
if ($mon[12] <= 0) {
$mon[21]=($mon[13]/5)*(1+$def[20]);
$mon[22]=($mon[14]/5)*(1+$def[20]);
$randdiv = array_rand ($divs, 2);
$mon[21] = ($lose_rand+$mon[0]+$mon[21])/$divs[$randdiv[0]];
$mon[22] = ($lose_rand+$mon[2]+$mon[22])/$divs[$randdiv[0]];
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

/*
if ($freeplay <= 0) {
if ($row->Level >= 10000 and $mon[22] >= 1000000) {
$mon[22] /= strlen($mon[22]);
}
if ($row->Level >= 10000 and $mon[21] >= 1000000) {
$mon[21] /= strlen($mon[21]);
}
}
*/

if ($mon[21] <= 0) {$mon[21]=0;}if ($mon[22] <= 0) {$mon[22]=0;}
if ($mon[21] > 0 or $mon[22] > 0) {
mysqli_query($link, "UPDATE `$tbl_members` SET `Exp`=`EXP`+$mon[21],`Gold`=`Gold`+$mon[22] WHERE (`id`='$row->id' and `Charname`='$row->Charname') LIMIT 1");
			if (!empty($row->Friend)) {
myfriend ($mon[21],$mon[22],$row->Friend);
			}
}
mysqli_query($link, "UPDATE `$tbl_history` SET `Kills`=`Kills`+1 WHERE (`Charname`='$row->Charname') LIMIT 1");

$news = 'You have slain '.$mon[15].'. You win '.number_format($mon[21]).' exp and '.number_format($mon[22]).' gold.'.$fbonus;
	//item find
$but_micro = microtime();
$but_micro = substr("$but_micro", -1);
round($but_micro, 1);

$chance_calcite=($def[23])-($monster_level+$Difficulty);

if ($but_micro == 5 and $chance_calcite <= $but_micro) {
$item_rand=array_rand($items);
$item_found="$items[$item_rand]";
}
	//item find
} elseif ($def[12] <= 0) {
mysqli_query($link, "UPDATE `$tbl_members` SET `Exp`=`Exp`/1.01,`Gold`=`Gold`/1.01 WHERE (`id`='$row->id' and `Charname`='$row->Charname') LIMIT 1");
mysqli_query($link, "UPDATE `$tbl_history` SET `Deads`=`Deads`+1 WHERE (`Charname`='$row->Charname') LIMIT 1");

$news = 'You have been slain by '.$mon[15].'. You lose '.number_format($row->Exp/100).' exp and '.number_format($row->Gold/100).' gold.';
mysqli_query($link, "INSERT INTO `lol_zlogs` ($fld_logs) values ('','$row->Charname','Lost a percentage of $row->Exp exp','$PHP_SELF','$current_date','$REMOTE_ADDR')");
} else {
$news = 'The battle tied.';
$newsa = "";
}
mysqli_query($link, "INSERT INTO `$tbl_index` ($fld_index) VALUES('','".date('m d Y')."',1,$current_time)") or mysqli_query($link, "UPDATE `$tbl_index` SET `fights`=`fights`+1 WHERE (`date`='".date('m d Y')."') LIMIT 1");
print "<b>$news</b><br>";
?>
Next level <?php echo number_format($next_level); ?> exp.
<?php 
if (!empty($item_found)) {
$world_val="
'',
'$row->Charname',
'$item_found'
";
?>
<br>You found a <b><?php echo $item_found; ?></b> upgrade on his body!.
<form method=post>
<input type=submit name=freebie value="Click here to upgrade now!">
<input type=submit name=freebie value="No upgrade">
</form>
<?php 
mysqli_query($link, "INSERT INTO $tbl_world ($fld_world) values ($world_val)") or print("Unable to create freebie item. Please contact the Admin.");
} //end itemfound
}

?>
<form method=post target="lol_fcontrol" action="world_control.php">
<table width=100%>
<?php 
	//locations
if (empty($Action)) {$Action='';}
if ($Action !== 'Fight!') {

echo "<tr><th colspan=2>Battle field locations. [required level]</th></tr>";
$i=0;
foreach ($array_location as $key=>$val) {

if ($row->Level >= $val) {
echo "<tr><td colspan=2><input type=submit name=\"new_loc\" value=\"$key [$val]\"></td></tr>";
$i++;
}

}
}	//locations
if (empty($_COOKIE['lol_Location'])) {
$_COOKIE['lol_Location']="Town[1]";
}
?>
</table>
</form>
<?php 
					$dchance=round(mic_time(), 0);
if (empty($mon[12])) {$mon[12]=0;}
if ($monster_level >= 100 and $mon[12] <= 0 and !empty($Action)) {

if($cresult = mysqli_query($link, "SELECT `id` FROM `$tbl_charms` WHERE `Charname`='$row->Charname' LIMIT 10")){
$num_charms = mysqli_num_rows($cresult);
if ($num_charms < 5) {
	$tchance=substr(sec_time(), -1);
	$pchance=substr(round(mic_time(), 0), -2);

if ($tchance == 5 and $pchance <= 50 and $pchance >= 25) {

$names = array ('da', 'ra', 'de', 'at', 'ma', 'shi','da', 'ra', 'de', 'at', 'ma', 'shi');
if ($tchance>5 or $tchance<2) {$tchance = 5;}
if ($pchance < 1) {$pchance=5;}

$randed=array_rand($names,$tchance);

$charmname = '';
for ($i=0;$i<$tchance;$i++) {
$charmname="$charmname".$names[$randed[$i]];
}

$time_left=time()+(1000*$pchance);

if ($gchance == 55 and $ochance == 55 and $dchance == 55) {
$time_left=time()+(1000000);
if ($tchance <> 5) {
$charm= "'','$row->Charname','Heavenly charm',100,100,100,100,100,100,'$time_left'";
} else {
$charm= "'','$row->Charname','Gods charm',127,127,127,127,127,127,'$time_left'";
}
} else {
$cschance=substr(round(mic_time(), 0), -1);if ($cschance <= 1 or $cschance >= 9) {$cschance=1;}echo"<script>alert('You found a charm!')</script>";
switch ($cschance) {
case $cschance == 1 : $charm= "'','$row->Charname','".ucfirst($charmname)."',0,".rand(1,$pchance*$cschance).",0,0,".rand(1,$pchance*$cschance).",0,'$time_left'";break;
case $cschance == 2 : $charm= "'','$row->Charname','".ucfirst($charmname)."',".rand(1,$pchance*$cschance).",0,0,".rand(1,$pchance*$cschance).",0,0,'$time_left'";break;
case $cschance == 3 : $charm= "'','$row->Charname','".ucfirst($charmname)."',0,0,0,".rand(1,$pchance).",".rand(1,$pchance).",".rand(1,$pchance).",'$time_left'";break;
case $cschance == 4 : $charm= "'','$row->Charname','".ucfirst($charmname)."',0,".rand(1,$pchance).",".rand(1,$pchance).",0,".rand(1,$pchance).",".rand(1,$pchance).",'$time_left'";break;
case $cschance == 5 : $charm= "'','$row->Charname','".ucfirst($charmname)."',".rand(1,$pchance).",".rand(1,$pchance).",0,".rand(1,$pchance).",".rand(1,$pchance).",0,'$time_left'";break;
case $cschance == 6 : $charm= "'','$row->Charname','".ucfirst($charmname)."',".rand(1,$pchance).",".rand(1,$pchance).",".rand(1,$pchance).",".rand(1,$pchance).",".rand(1,$pchance).",".rand(1,$pchance).",'$time_left'";break;
case $cschance == 7 : $charm= "'','$row->Charname','".ucfirst($charmname)."',".rand(1,$pchance).",".rand(1,$pchance).",".rand(1,$pchance).",0,0,0,'$time_left'";break;
case $cschance == 8 : $charm= "'','$row->Charname','".ucfirst($charmname)."',0,0,".rand(1,$pchance*$cschance).",0,0,".rand(1,$pchance*$cschance).",'$time_left'";break;
}
}
mysqli_query($link, "INSERT INTO `$tbl_charms` ($fld_charms) VALUES ($charm)") and print("<b>You found a stats charm.</b><br>");
}
}
echo 'You have '.$num_charms.' charms in your inventory you can hold max 5 charms.';
}
}//end charms

if ($row->Exp > $next_level) {
echo '<b>Congratulations you have leveled up for reaching '.number_format($next_level).' exp</b>';
include_once('stats.inc.php');
}

} //end else world freebie
include_once($game_footer);

function mic_time(){
list($usec, $sec) = explode(" ",microtime());
return substr(((float)$usec + (float)$sec), -2);
}
function sec_time(){
return round(substr(microtime(), -2), 1);
}
?>