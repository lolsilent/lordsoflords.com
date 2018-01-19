<center><b>Lords of Lords Credits calculator</b><br></center>
<?php 
#!/usr/local/bin/php

if (empty($_POST['payment_gross'])) {
$payment_gross=0;
} else {
$payment_gross=$_POST['payment_gross'];


//get bonusses and calcite total
if ($payment_gross > 2) {
 $apercent=$payment_gross/100;
 if ($apercent > 5) {
 $apercent=5;
 }
 $extra_amount=$payment_gross/(10-$apercent);
}

if (empty($extra_amount)) {
 $extra_amount=0;
}

$special_days = array('01 02'=>'day of the', '11 02'=>'Silent married day', '13 12'=>'Silent birthday', '30 10'=>'Sisi birthday', '25 12'=>'Christmas', '26 12'=>'Christmas', '01 01'=>'Happy new year');
$special_days_keys=array_keys($special_days);
$special_day = date("d m");
if (in_array($special_day,$special_days_keys)) {
$special_bonus=($payment_gross/10);
$special_txt="<b>+ ".number_format($special_bonus*100)." $special_days[$special_day] extra bonus credits</b><br>";
} else {
$special_txt='';
$special_bonus=0;
}

$credits_amount=round(($payment_gross+$extra_amount+$special_bonus)*100,0);
$have_credits=$_POST['have_credits'];

//SEND buyer a message
print "
You already have ".number_format($have_credits)." Credits.<br>
<b> + ".number_format($payment_gross*100)." Credits<br>
+ ".number_format($extra_amount*100)." Bonus Credits</b><br>
$special_txt Now you have ".number_format($credits_amount+$have_credits)." Credits<br>
<br>
Thanks allot
<br>".($credits_amount+$have_credits).' '.number_format($credits_amount)." - ".round($payment_gross*100,0)." - ".round($extra_amount*100,0)." - ".round($special_bonus*100,0)." - ".round($apercent,0)." $have_credits";

}
?>
<form method=post>
Buy $<input type=text name=payment_gross value=0 size=10><br>
Have <input type=text name=have_credits value=0 size=10> credits<br>
<input type=submit name=action value="Calculate"><br>
</form>

<?php 
//mail("test@thesilent.com", "test servername test", "1", "From:notify@{$_SERVER['SERVER_NAME']}\r\n", "-fnotify@{$_SERVER['SERVER_NAME']}\r\n");
?>