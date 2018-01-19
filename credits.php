<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_functions);
require_once($html_header);
?>

			<table width=100%><tr><th>Lords of Lords Credits calculator</th></tr><tr><td>

<form method=post>
Buy $<input type=text name=donate value=0 size=10 maxlength=10><br>
Have <input type=text name=have_credits value=0 size=10 maxlength=10> credits<br>
<input type=submit name=action value="Calculate"><br>
</form>

			</td></tr></table>
<br>
<b>What are credits?</b><br>
Credits are in game real money purchased by donating to this game to support the game developments, payment for server, bandwidths, advertising campaigns, the webmaster and making this game available for free to the whole Lords of Lords community.<br>
<br>
Credits can be purchased instantly in game, if you don't have a verified Paypal account the transaction can be halted. Massive buying and strange buying behavior without prior notice to the webmaster will result in temporarily Jail.<br>

<?php 

if (empty($_POST['donate'])) {$donate=0;} else {$donate=clean_int($_POST['donate']);

if ($donate > 2) {
 $apercent=$donate/100;
 if ($apercent > 5) {
 $apercent=5;
 }
 $extra_amount=$donate/(10-$apercent);
}

if (empty($extra_amount)) {
 $extra_amount=0;
}

$special_days = array('01 02'=>'day of the', '11 02'=>'Silent married day', '13 12'=>'Silent birthday', '30 10'=>'Sisi birthday', '25 12'=>'Christmas', '26 12'=>'Christmas', '01 01'=>'Happy new year');
$special_days_keys=array_keys($special_days);
$special_day = date("d m");
if (in_array($special_day,$special_days_keys)) {
$special_bonus=($donate/10);
$special_txt="<b>+ ".number_format($special_bonus*100)." $special_days[$special_day] extra bonus credits</b><br>";
} else {
$special_txt='';
$special_bonus=0;
}

$credits_amount=round(($donate+$extra_amount+$special_bonus)*100,0);
$have_credits=clean_post($_POST['have_credits']);

//SEND buyer a message
print '<br>You already have '.number_format($have_credits).' Credits.<br>
<b> + '.number_format($donate*100).' Credits<br>
+ '.number_format($extra_amount*100).' Bonus Credits</b><br>
'.$special_txt.' Now you have '.number_format($credits_amount+$have_credits).' Credits<br>
<br>
Thanks allot';

}

require_once($html_footer);?>