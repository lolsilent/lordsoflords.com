<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once("$game_nsheader");
error_reporting(0);
$paypal_email = 'paypal@thesilent.com';


$dupe=$row->Level/250;
if ($dupe <= 1) {
	$dupe=1;
}
$dupe=round($dupe,0);
$max_gold_price=149+$dupe;
if ($max_gold_price > 500) {
	$max_gold_price=500;
}
$max_gold_price=round($max_gold_price,0);
$stuff=array('Exp', 'Gold', 'Strength', 'Dexterity', 'Agility', 'Intelligence', 'Concentration', 'Contravention', 'Weapon', 'Attackspell', 'Healspell', 'Helmet', 'Shield', 'Amulet', 'Ring', 'Armor', 'Belt', 'Pants', 'Hand', 'Feet');

$query = "SELECT * FROM `$tbl_credits` WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') ORDER BY `id` DESC";
$result = mysqli_query($link, $query) or die("$error_message : Query failed");
$crow = mysqli_fetch_object ($result) or $crow->Credits=0;
mysqli_free_result ($result);

if (isset($_POST['action']) and !empty($_POST['action']) and $crow->Credits > 0) {

$action=$_POST['action'];

$item_name = preg_replace("'^Buy 'i","",$action);
if (in_array($item_name,$stuff) or preg_match("/.*? days/i",$item_name) or preg_match("/maxgold/i",$item_name) or $item_name == 'Gods Charm' or $item_name == 'Heavenly Charm') {

echo "<hr><b>$action";
if (in_array($item_name,$stuff)) {
foreach ($stuff as $val) {
if ($item_name == $val) {
if ($val == 'Exp') {
	$amount=$dupe*5000000; $buy_cost=99+$dupe;

} elseif ($val == 'Gold') {
	$amount=$dupe*5000000; $buy_cost=49+$dupe;
} elseif ($val == 'Strength' or $val == 'Intelligence' or $val == 'Weapon' or $val == 'Attackspell') {
	$amount=$dupe+4; $buy_cost=24+$dupe;
} elseif ($val == 'Dexterity' or $val == 'Concentration' or $val == 'Ring' or $val == 'Amulet' or $val == 'Hand' or $val == 'Feet') {
	$amount=$dupe+4; $buy_cost=19+$dupe;
} elseif ($val == 'Agility' or $val == 'Contravention') {
	$amount=$dupe+9; $buy_cost=14+$dupe;
} else {
	$amount=$dupe+9; $buy_cost=9+$dupe;
}
if ($buy_cost > 500) {
	$buy_cost=500;
}

if ($crow->Credits >= $buy_cost) {
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`-$buy_cost WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') LIMIT 1") and $oke_oke=1;
if (isset($oke_oke)) {
mysqli_query($link, "UPDATE `$tbl_members` SET $val=$val+$amount WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') LIMIT 1") and print("<br>applied succesfully") or print("<br>unknown error");
}
} else {
echo "<br>Not enough credits";
}
break;
}
} //forech
} elseif (preg_match("/.*? days/i",$item_name)) {
		//starplayer
$star_days = preg_replace("' days$'i","",$item_name);
if ($star_days == 5) {$star_price=100;} else {$star_price=500;}
if ($crow->Credits >= $star_price) {
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`-$star_price WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') LIMIT 1") and $oke_oke=1;
if (isset($oke_oke)) {
$star_days *= 86400;
$star_days=round($star_days,0);
mysqli_query($link, "UPDATE `$tbl_members` SET Freeplay=$current_time+$star_days WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') LIMIT 1") and print("<br>applied succesfully") or print("<br>unknown error");
}
}
$buy_cost=$star_price;
		//star player
} elseif (preg_match("/maxgold/i",$item_name) and $crow->Credits >= $max_gold_price) {
		//maxgold
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`-$max_gold_price WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') LIMIT 1") and $oke_oke=1;
if (isset($oke_oke)) {
mysqli_query($link, "UPDATE `$tbl_members` SET `Gold`='$max_gold' WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') LIMIT 1") and print("<br>applied succesfully") or print("<br>unknown error");
}
$buy_cost=$max_gold_price;
		//maxgold
} elseif ($item_name == 'Gods Charm') {
		//gods charms
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$row->Charname') ORDER BY `id` ASC";
$result = mysqli_query($link, $query);
$count_charm = mysqli_num_rows($result);
while ($rmrow = mysqli_fetch_object ($result)) {
if ($rmrow->Name == 'Gods charm') {
$already_have=1;
break;
}
}
mysqli_free_result ($result);
if (!isset($already_have) and $count_charm <= 4) {
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`-2500 WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') LIMIT 1") and $oke_oke=1;
if (isset($oke_oke)) {
$time_left=time()+(1000000);
$charm= "'','$row->Charname','Gods charm',255,255,255,255,255,255, 255,255,255, 255,255,255, 255,255,255,$time_left";
mysqli_query($link, "INSERT INTO `$tbl_charms` ($fld_charms) VALUES ($charm)") and print("<br>applied succesfully") or print("<br>unknown error");
}
} else {
echo "<font color=red> Your charm slots are full please destroy a charm first or you already have a Gods charm, only one Gods charm per character is allowed. If you want more try your luck with finding one. </font>";
}
		//gods charm
} elseif ($item_name == 'Heavenly Charm') {
		//heavenly charms
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$row->Charname') ORDER BY `id` ASC";
$result = mysqli_query($link, $query);
$count_charm = mysqli_num_rows($result);
while ($rmrow = mysqli_fetch_object ($result)) {
if ($rmrow->Name == 'Heavenly charm') {
$already_have=1;
break;
}
}
mysqli_free_result ($result);
if (!isset($already_have) and $count_charm <= 4) {
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`-2000 WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') LIMIT 1") and $oke_oke=1;
if (isset($oke_oke)) {
$time_left=time()+(1000000);
$charm= "'','$row->Charname','Heavenly charm',200,200,200,200,200,200, 200,200,200, 200,200,200, 200,200,200,$time_left";
mysqli_query($link, "INSERT INTO `$tbl_charms` ($fld_charms) VALUES ($charm)") and print("<br>applied succesfully") or print("<br>unknown error");
}
} else {
echo "<font color=red> Your charm slots are full please destroy a charm first or you already have a Heavenly charm, only one Heavenly charm per character is allowed. If you want more try your luck with finding one. </font>";
}
		//heavenly charm
} else {
echo "<br>Unknown action";
}
echo "</b><hr>";
	//log bough items
if (isset($buy_cost)) {
$current_month=date('m');
$current_year=date('Y');
$item_name=preg_replace("' '","",$item_name);


$query = "SELECT * FROM $tbl_support WHERE(M='$current_month' and Y='$current_year') ORDER BY `id` ASC LIMIT 1";
$result = mysqli_query($link, $query);
$support_row = mysqli_num_rows($result);
mysqli_free_result ($result);
if (!$support_row) {
$insert_supp	= "'', '$current_month', '$current_year', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0";
mysqli_query($link, "INSERT INTO $tbl_support ($fld_support) VALUES ($insert_supp)") or print(mysqli_error($link));
}

mysqli_query($link, "UPDATE $tbl_support SET $item_name=$item_name+1 WHERE (M='$current_month' and Y='$current_year') LIMIT 1");
	}
} //if inarray or pregmatch

$query = "SELECT * FROM `$tbl_credits` WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') ORDER BY `id` DESC";
$result = mysqli_query($link, $query) or die("$error_message : Query failed");
$crow = mysqli_fetch_object ($result) or $crow->Credits=0;
mysqli_free_result ($result);

$query = "SELECT * FROM `$tbl_members` WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') ORDER BY `id` DESC";
$result = mysqli_query($link, $query) or die("$error_message : Query failed");
$row = mysqli_fetch_object ($result);
mysqli_free_result ($result);

} //if action
?>
<a href="https://lordsoflords.com/support.php" target="lol_main">Support this game by seeing or visiting my sponsors or donate with Paypal.</a>
<hr>
<table width=100% border=0 cellpadding=0 cellspacing=1>
<tr><td valign=top colspan=5>
You can also support <b><?php echo $title;?></b> by buying stuff for your char with Paypal.<br>
<b>Watch out with gold and max gold buying allot of it will be deleted when you can't hold it. You can carry max <?php echo number_format($max_gold); ?> gold.</b>
<br>
Here is how it works : $3.00 will give you 300 credits, you can spend it on all these items below at your own choice. The more you buy at once the more bonus credits you receive.<br>
The amount and price will increase foreach each 250 levels. Max price for all items is set to 500 credits.
</td></tr>

<tr><th colspan=5>You have <?php echo number_format($crow->Credits, 0, '', '.'); ?> credits.
<br>Buy some credits with <a href="<?php echo "https://paypal.com/cgi-bin/webscr?cmd=_xclick&business=".$paypal_email."&undefined_quantity=1&item_name=$title : Buy 300 credits for $row->Sex $row->Charname&item_number=Game:Lol1,Server:$server,Charname:$row->Charname&amount=3&no_shipping=1&return=$root_url/thanks.php&cancel_return=$root_url/thanks2.php&notify_url=https://thesilent.com/paypal/index.php";?>&lc=US" target="_blank">Paypal Transactions</a>.
</th></tr>


<form method=post>
<tr bgcolor=#555000><td valign=top >Item kind</td><td valign=top >You have</td><td valign=top >Amount</td><td valign=top >Cost</td><td valign=top >Buy this</td></tr>
<?php 
$color = "$col_table";
foreach ($stuff as $val) {
if ($color == "$col_th") {
$color="$col_table";
} else {
$color="$col_th";
}
if ($val == 'Exp') {
	$amount=$dupe*5000000; $cost=99+$dupe;
} elseif ($val == 'Gold') {
	$amount=$dupe*5000000; $cost=49+$dupe;
} elseif ($val == 'Strength' or $val == 'Intelligence' or $val == 'Weapon' or $val == 'Attackspell') {
	$amount=$dupe+4; $cost=24+$dupe;
} elseif ($val == 'Dexterity' or $val == 'Concentration' or $val == 'Ring' or $val == 'Amulet' or $val == 'Hand' or $val == 'Feet') {
	$amount=$dupe+4; $cost=19+$dupe;
} elseif ($val == 'Agility' or $val == 'Contravention') {
	$amount=$dupe+9; $cost=14+$dupe;
} else {
	$amount=$dupe+9; $cost=9+$dupe;
}
if ($cost > 500) {
	$cost=500;
}
echo "<tr bgcolor=$color><td valign=top >$val</td>"."<td valign=top >".number_format($row->$val, 0, '', '.')."</td><td valign=top >".number_format($amount, 0, '', '.')."</td><td valign=top >".number_format($cost, 0, '', '.')."</td><td valign=top >";
if ($crow->Credits >= $cost) {
echo "<input type=submit name=action value=\"Buy $val\" style=\"width:100%;\">";
} else {
echo "Not enough credits";
}
echo "</td></tr>";
}
$row->Freeplay-=time();
if ($row->Freeplay <= 0) {
	$row->Freeplay=0;
}

?>

<tr bgcolor=#555000><td valign=top colspan=3>Max out gold for your level.<td valign=top ><?php echo number_format($max_gold_price, 0, '', '.'); ?></td><td valign=top >
<?php 
if ($crow->Credits >= $max_gold_price) {
echo "<input type=submit name=action value=\"Buy Maxgold\" style=\"width:100%;\">";
} else {
echo "Not enough credits";
}
?>
</td></tr>
<?php 
if ($row->Freeplay <= 1000) {
?>
<tr><th colspan=5>With Freeplay you get : <br>
Get alloot % exp after each monster kill! <br>
Stealth recovers faster <br>
Shop more and cheaper<br>
Get a <img src="<?php echo $emotions_url; ?>/star.gif" border=0 alt="Premium game supporter"> in front of your name.<br>
No banners<br>
Faster apply level up stats <br>
Steal players stats and inventory items in Steal.<br>
You have <?php echo number_format($row->Freeplay, 0, '', '.'); ?> seconds remaining.</th></tr>
<tr><td valign=top colspan=2><b>WATCH OUT!</b> This function will reset freeplay to <?php echo number_format(30*86400, 0, '', '.'); ?> seconds. This is equal to 30 days. </td><td valign=top ><?php echo number_format(30*86400, 0, '', '.'); ?> seconds</td><td valign=top ><?php echo number_format(500, 0, '', '.'); ?></td><td valign=top >
<?php 
if ($crow->Credits >= 500) {
echo "<input type=submit name=action value=\"Buy 30 days\" style=\"width:100%;\">";
} else {
echo "Not enough credits";
}
?>
</td></tr>

<tr bgcolor=<?php echo $col_th; ?>><td valign=top colspan=2><b>WATCH OUT!</b>This function will reset freeplay to <?php echo number_format(5*86400, 0, '', '.'); ?> seconds. This is equal to 5 days.</td><td valign=top ><?php echo number_format(5*86400, 0, '', '.'); ?> seconds</td><td valign=top ><?php echo number_format(100, 0, '', '.'); ?></td><td valign=top >
<?php 
if ($crow->Credits >= 100) {
echo "<input type=submit name=action value=\"Buy 5 days\" style=\"width:100%;\">";
} else {
echo "Not enough credits";
}
echo "</td></tr>";
} else {
echo "<tr bgcolor=$col_th><td colspan=5>You have plenty free play seconds left, when free play goes under 1.000 second you may buy some more.</td></tr>";
}


$number_of_charms=0;
if ($query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$row->Charname') ORDER BY `id` ASC") {
if ($result = mysqli_query($link, $query)) {
while ($rmrow = mysqli_fetch_object ($result)) {

/*if ($rmrow->Name == 'Gods charm') {
$already_have_god=1;
}
if ($rmrow->Name == 'Heavenly charm') {
$already_have_heaven=1;
}
*/
$number_of_charms++;
}
mysqli_free_result ($result);
}
}

	//Gods charm
//if (!isset($already_have_god) and $number_of_charms <= 4) {
if ($number_of_charms <= 4) {
?><tr><td colspan=3 align=center><b>Indestructible and Rechargeable Gods Charm</b><br>
+255 % all charm stats<br>
1.000.000 seconds!<br>

</td><td valign=top>2.500</td><td valign=top>
<?php 
if ($crow->Credits >= 2500) {
echo "<input type=submit name=action value=\"Buy Gods Charm\" style=\"width:100%;\">";
} else {
echo "Not enough credits";
}
echo "</td></tr>";
} else {
echo "<tr><th colspan=5>You charm slots are full, can't buy Gods charm that gives 120% to all stats..</th></tr>";
}
	//Heavenly Charm
//if (!isset($already_have_heaven) and $number_of_charms <= 4) {
if ($number_of_charms <= 4) {
?><tr><td colspan=3 align=center><b>Indestructible and Rechargeable Heavenly Charm</b><br>
+200 % all charm stats<br>
1.000.000 seconds!<br>

</td><td valign=top>2.000</td><td valign=top>
<?php 
if ($crow->Credits >= 2000) {
echo "<input type=submit name=action value=\"Buy Heavenly Charm\" style=\"width:100%;\">";
} else {
echo "Not enough credits";
}
echo "</td></tr>";
} else {
echo "<tr><th colspan=5>You charm slots are full, can't buy Heavenly charm that gives 100% to all stats..</th></tr>";
}
?>

<tr><td valign=top colspan=5>
<p>
Verified Paypal payments only please or the program won't accept your payment. <br>
<br>
<b>Echecks?</b> Send to <b><?php echo $paypal_email;?></b> with information below in it. When you do this, it can take up to 5+ days to receive your credits, depending how long it takes to clear your echeck.
<br>
My contact information can be found in the forums, if you plan to contact me about problem with your account please include the line below:
<hr>
<?php 
echo<<<EOT
>>Game:Lol1,Server:$server,Charname:$row->Charname<<
EOT;
?>
<hr>

Thank you for your time,<br>
<b>Admin Silent</b><br>
</td></tr>
</table>
</form>

<?php 
include_once $game_footer;
?>