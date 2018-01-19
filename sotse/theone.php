<?php 
exit;
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

$inactive_days=86400*100;
$inactive_time=$current_time-(84600*100);
$thief_time=1800*2;
$stealth=($row->Stealth-$current_time);

?>
<table width=100%>
<form method=post><tr><th colspan=3>YOU FOUND A SECRET IN THE GAME!<br>THE ONE!<br>WHAT DOES THIS DO?<br>IT WILL MERGE YOUR CHAR WITH A CHOSEN INACTIVE CHAR!<br>This is a more powerful like steal, when the inactive char is stolen then the char will die!</th></tr>
<?php 

if ($stealth < 0) {

if(!empty($_POST['action'])){$action=clean_post($_POST['action']);}else{$action='';}
if(!empty($_POST['inactive'])){$inactive=clean_post($_POST['inactive']);}else{$inactive='';}

if ($row->Stealth-$current_time <= 0 and !empty($inactive) and !empty($action)){
if($oresult=mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (`Time`<= '$inactive_time' and `Level` <= $row->Level/100 and `id`='$inactive') ORDER BY `Time` DESC LIMIT 1")){
if($pobj=mysqli_fetch_object($oresult)){
mysqli_free_result($oresult);
if($pobj->Exp <= 1000){$pobj->Exp=1000;}
if($pobj->Gold <= 1000){$pobj->Gold=1000;}
if($pobj->Stash <= 1000){$pobj->Stash=1000;}

?>
<tr><th colspan=3>Emerging with <?php echo "$pobj->Sex $pobj->Charname";?></th></tr>
<tr><td>Kind</td><td>Yours</td><td><?php echo "$pobj->Sex $pobj->Charname";?>'s</td></tr>
<?php 
$items[]='Strength';$items[]='Dexterity';$items[]='Agility';
$items[]='Intelligence';$items[]='Concentration';$items[]='Contravention';
$items[]='Exp';$items[]='Gold';$items[]='Stash';$items[]='Life';
foreach ($items as $val) {
$pobj->$val+=1;
if ($val =='Strength' or $val =='Exp') {print '<tr><th colspan=3><br></th></tr>';}
?><tr><td><?php echo $val; ?></td><td><?php echo number_format($row->$val); ?></td><td><?php echo number_format($pobj->$val); ?></td></tr>
<?php 
}

print '<tr><th colspan=3><b>Merge completed!</b></th></tr>';
$to_update .= ", `Exp`=`Exp`+$pobj->Exp, `Gold`=`Gold`+$pobj->Gold, `Stash`=`Stash`+$pobj->Stash, `Life`=`Life`+$pobj->Life, `Strength`=`Strength`+$pobj->Strength, `Dexterity`=`Dexterity`+$pobj->Dexterity, `Agility`=`Agility`+$pobj->Agility, `Intelligence`=`Intelligence`+$pobj->Intelligence, `Concentration`=`Concentration`+$pobj->Concentration, `Contravention`=`Contravention`+$pobj->Contravention, `Weapon`=`Weapon`+$pobj->Weapon, `Attackspell`=`Attackspell`+$pobj->Attackspell, `Healspell`=`Healspell`+$pobj->Healspell, `Helmet`=`Helmet`+$pobj->Helmet, `Shield`=`Shield`+$pobj->Shield, `Amulet`=`Amulet`+$pobj->Amulet, `Ring`=`Ring`+$pobj->Ring, `Armor`=`Armor`+$pobj->Armor, `Belt`=`Belt`+$pobj->Belt, `Pants`=`Pants`+$pobj->Pants, `Hand`=`Hand`+$pobj->Hand, `Feet`=`Feet`+$pobj->Feet, `Stealth`=$current_time+$thief_time";

$total_stats = $pobj->Strength+$pobj->Dexterity+$pobj->Agility+$pobj->Intelligence+$pobj->Concentration+$pobj->Contravention;
$total_items = $pobj->Weapon+$pobj->Attackspell+$pobj->Healspell+$pobj->Helmet+$pobj->Shield+$pobj->Amulet+$pobj->Ring+$pobj->Armor+$pobj->Belt+$pobj->Pants+$pobj->Hand+$pobj->Feet;
	print '<tr><td colspan=3><br>Total stats '.lint($total_stats).'.<br>Total items '.lint($total_items).'.<br>Total xp '.lint($pobj->Exp).' EXP.<br>Total Gold $'.lint($pobj->Gold+$pobj->Stash).'.<br></td></tr>';


$graves="'','<center><b>+$pobj->Sex $pobj->Charname [".number_format($pobj->Level)."]</b> <a title=\"Total stats ".lint($total_stats).".
Total items ".lint($total_items).".
Total Exp ".lint($pobj->Exp)." EXP.
Total Gold $".lint($pobj->Gold+$pobj->Stash)." Gold.\">merged</a> on <b>$row->Sex $row->Charname [".number_format($row->Level)."]!+</b><center>','$current_date'";
mysqli_query($link, "INSERT INTO $tbl_graves ($fld_graves) values ($graves)") or die(mysqli_error($link));

$logging="'','$row->Charname','Delete id:$pobj->id $pobj->Sex $pobj->Charname','$PHP_SELF','$current_date','$REMOTE_ADDR'";
mysqli_query($link, "INSERT INTO $tbl_logs ($fld_logs) values ($logging)") or die(mysqli_error($link));


foreach ($table_names as $tables) {
mysqli_query($link, "DELETE FROM `$tables` WHERE `Charname`='$pobj->Charname'");
}

$row->Stealth=$current_time+$thief_time;
}else{?><tr><td colspan=3>Someone just emerged with this player, before you had a chance to do so.</td></tr><?php }
}
} elseif ($row->Stealth-$current_time <= 0 and empty($inactive) and empty($action)){
?>
<tr><td colspan=3>
<form method="post"><table width="100%">
<tr><th colspan="3">Merge with inactives</th></tr>
<tr><td>Inactive for <?php print $inactive_days/86400;?> days</td><td width=150><select name="inactive">
<?php 
$i=0;
if($loresult=mysqli_query($link, "SELECT `id`,`Sex`,`Charname` FROM `$tbl_members` WHERE (`Time`<= '$inactive_time' and `Level` <= $row->Level/100)ORDER BY `Time` DESC LIMIT 100")){
	//(`Time`<= '$inactive_days' and `Level` <= $row->Level/100)
while($lpobj=mysqli_fetch_object($loresult)){$i++;
print '<option value="'.$lpobj->id.'">'.$lpobj->Sex.' '.$lpobj->Charname.'</option>';
}
mysqli_free_result($loresult);
}
if($i<=0){?><option value="0">Nobody</option><?php }
?>
</select></td><td><input type="submit" name="action" value="EMERGE TO BE THE ONE!"></td></tr></table></form></td></tr>
<?php 
}
}

print '</table>';
print $stealth>=1?'You must be in stealth mode to do this. You are going in stealth mode in '.number_format($stealth).' seconds.':'';

?><hr>
Merging takes <?php print lint($thief_time/60);?> minutes to recover.<br>
<hr><?php 

include_once $game_footer;
?>

