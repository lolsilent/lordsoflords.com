<?php 
#!/usr/local/bin/php
require_once('AdMiN/www.main.php');
require_once('AdMiN/www.functions.php');
include_once($game_header);

require_once 'Items/array.weapons.php';
require_once 'Items/array.attackspells.php';
require_once 'Items/array.healspells.php';
require_once 'Items/array.helmets.php';
require_once 'Items/array.shields.php';
require_once 'Items/array.amulets.php';
require_once 'Items/array.rings.php';
require_once 'Items/array.armors.php';
require_once 'Items/array.belts.php';
require_once 'Items/array.pants.php';
require_once 'Items/array.hands.php';
require_once 'Items/array.feets.php';
$current=array();
if ($_COOKIE['lol_Charname'] == $row->Charname) {
foreach ($items as $val) {
array_push($current,$row->$val);
}
}

if(isset($_POST) AND !empty($_POST)){
	$costed=0;
foreach($items as $val){
if(!empty($_POST[$val])){
	$amount=clean_post($_POST[$val]);
	$amount=1+floor($row->Level/5);
	$max=1;
	if($row->Strength >= $row->Intelligence){$max=$row->Strength;}else{$max=$row->Intelligence;}
	if ($amount >= $max) {$amount=floor($max/10);}
	
if(($row->$val+$amount) >= $max){$amount=$max-$row->$val;}
if($row->$val >= $max or $amount < 1){continue;}
	$total_price=(49+($row->Level*$row->$val))*$amount;

if($row->Gold >= $total_price and $amount >= 1 and $row->Gold >= 1){
	echo 'Buy '.number_format($amount).' '.$val.' upgrade'.($amount>1?"s":"").' for '.number_format($total_price).' gold.<br>';
	$row->Gold -=$total_price;
	$costed+=$total_price;
	$row->$val+=$amount;
	$to_update .= ", `$val`=".$row->$val;
}else{print 'Not enough gold!';}

}

}

if($costed >= 1){
print 'Total upgrade costs '.lint($costed).' gold.';
$to_update .= ", `Gold`='$row->Gold'";
}

}

?>

<table cellpadding="1" cellspacing="1" border="0" width="100%"><tr>
<th colspan="5">Shopping</th></tr>
<tr><td>Equipments</td><td></td></td></td><td>Your power (max <?php echo $row->Strength>=$row->Intelligence?number_format($row->Strength):number_format($row->Intelligence);?>)</td><td>Price per up</td><td>Buy Up</td></tr>
<?php 
$maxed=0;

$num=0;
foreach ($items as $val) {
$nim=$current[$num]/98;
$nim=round($nim, 3);
if ($num == 0) {
$max=count ($Weapons); if ($nim >= $max) {$nim=$max-1;}$whot="$Weapons[$nim]";
} elseif ($num == 1) {
$max=count ($Attackspells); if ($nim >= $max) {$nim=$max-1;}$whot="$Attackspells[$nim]";
} elseif ($num == 2) {
$max=count ($Healspells); if ($nim >= $max) {$nim=$max-1;}$whot="$Healspells[$nim]";
} elseif ($num == 3) {
$max=count ($Helmets); if ($nim >= $max) {$nim=$max-1;}$whot="$Helmets[$nim]";
} elseif ($num == 4) {
$max=count ($Shields); if ($nim >= $max) {$nim=$max-1;}$whot="$Shields[$nim]";
} elseif ($num == 5) {
$max=count ($Amulets); if ($nim >= $max) {$nim=$max-1;}$whot="$Amulets[$nim]";
} elseif ($num == 6) {
$max=count ($Rings); if ($nim >= $max) {$nim=$max-1;}$whot="$Rings[$nim]";
} elseif ($num == 7) {
$max=count ($Armors); if ($nim >= $max) {$nim=$max-1;}$whot="$Armors[$nim]";
} elseif ($num == 8) {
$max=count ($Belts); if ($nim >= $max) {$nim=$max-1;}$whot="$Belts[$nim]";
} elseif ($num == 9) {
$max=count ($Pants); if ($nim >= $max) {$nim=$max-1;}$whot="$Pants[$nim]";
} elseif ($num == 10) {
$max=count ($Hands); if ($nim >= $max) {$nim=$max-1;}$whot="$Hands[$nim]";
} elseif ($num == 11) {
$max=count ($Feets); if ($nim >= $max) {$nim=$max-1;}$whot="$Feets[$nim]";
} else {
$whot = "Elements of Dark Shadows";
}




$amount=1+floor($row->Level/5);

	$max=1;
	if($row->Strength >= $row->Intelligence){$max=$row->Strength;}else{$max=$row->Intelligence;}
	if ($amount >= $max) {$amount=floor($max/10);}

?><form method="post" action="shop.php"><tr<?php if(empty($bg)){?> bgcolor="<?php echo $col_th;$bg=1;?>"<?php }else{$bg='';}?>>
<td><?php echo ucfirst($val);?></td><td><?php print $whot;?></td>
<td><?php echo number_format($row->$val);?></td><td>$<?php echo number_format(49+($row->Level*$row->$val));?></td>
<td width="100"><?php if($row->$val < $row->Strength or $row->$val < $row->Intelligence){?><input type="submit" name="<?php echo $val;?>" value="UPGRADE <?php print (floor($amount));?>" maxlength="7"><?php }else{?>Maxed<?php $maxed++;}?></td></tr></form><?php 

$num++;
}
if($maxed<count($items)){

}else{

}
?>
</table>

<?php 
include_once($game_footer);
?>