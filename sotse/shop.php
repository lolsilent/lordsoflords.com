<?php 
#!/usr/local/bin/php
require_once('AdMiN/www.main.php');
require_once('AdMiN/www.functions.php');
include_once($game_header);

if(!empty($_POST['action'])){$costed=0;
foreach($items as $val){
if(!empty($_POST[$val])){
	$amount=clean_post($_POST[$val]);
	if($row->Strength >= $row->Intelligence){$max=$row->Strength;}else{$max=$row->Intelligence;}
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
<form method="post" action="shop.php">
<table cellpadding="1" cellspacing="1" border="0" width="100%"><tr>
<th colspan="4">Shopping</th></tr>
<tr><td>Equipments</td><td>Your power (max <?php echo $row->Strength>=$row->Intelligence?number_format($row->Strength):number_format($row->Intelligence);?>)</td><td>Price per up</td><td>Buy Up</td></tr>
<?php $maxed=0;
foreach($items as $val){
?><tr<?php if(empty($bg)){?> bgcolor="<?php echo $col_th;$bg=1;?>"<?php }else{$bg='';}?>>
<td><?php echo ucfirst($val);?></td>
<td><?php echo number_format($row->$val);?></td><td>$<?php echo number_format(49+($row->Level*$row->$val));?></td>
<td width="100"><?php if($row->$val < $row->Strength or $row->$val < $row->Intelligence){?><input type="text" name="<?php echo $val;?>" maxlength="7"><?php }else{?>Maxed<?php $maxed++;}?></td></tr><?php 
}
if($maxed<count($items)){
?><tr><td colspan="4"><input type="submit" name="action" value="Buy upgrades!"></td></tr><?php 
}else{
?><tr><th colspan="4">All your items are maxed if you wish to buy more upgrades get more Strength or Intelligence next time you level up.</th></tr><?php 
}?>
</table>
</form>
<?php 
include_once($game_footer);
?>