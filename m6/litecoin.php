<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
require_once '../AdmiN/www.jsonRPCClient.php';
$exchange_modifier=1.85;

include_once($game_header);
try {
/*
print "Disabled due to a bug.";
include_once($game_footer);
exit;
*/
//if ($row->id>1) {print 'Beta testing you are not authorized at this moment.'; exit;}

$output='';
$mycoinadress=array(
'btc' => ('1GQVVww8dxdSsFVGY3iKMJXbMTeKxPXJ13'),
'ltc' => ('LR6A8gLJQQC88MsyG8dHdviMwBv5jcbGv9'),
);
$localmasteraccount=array(
'btc' => ('1DBX7gzEFw7Vgvv1eS98gWDGrUg8doy4S9'),
'ltc' => ('1DBX7gzEFw7Vgvv1eS98gWDGrUg8doy4S9'),
);


/*_______________-=TheSilenT.CoM=-_________________*/
$tbl_tickers='lol_tickers';
$fld_tickers="`id`,`base`,`alt`,`rate`,`timer`";
if($tresult = mysqli_query($link, "SELECT * FROM `$tbl_tickers` WHERE `id` ORDER BY `id` DESC LIMIT 1")){
if($trow = mysqli_fetch_object ($tresult)){
mysqli_free_result ($tresult);

$secs_past = $current_time-$trow->timer;
//print $secs_past." ||| ";
if ($secs_past >= 30) {
$btcebtcusd='https://btc-e.com/api/2/btc_usd/ticker';
$headers = get_headers($btcebtcusd);
if ( ! $headers OR strpos($headers[0], '200 OK') === FALSE) {
	//print 'data api 1 is offline';
}else{
$data = file_get_contents($btcebtcusd);
$btce_btc_usd = json_decode($data, true);
if ($btce_btc_usd['ticker']['last'] >= 1) {
mysqli_query($link, "INSERT INTO `$tbl_tickers` ($fld_tickers) values ('','BTC','USD','".$btce_btc_usd['ticker']['last']."','$current_time')");
}
}


$btceltcusd='https://btc-e.com/api/2/ltc_usd/ticker';
$headers = get_headers($btceltcusd);
if ( ! $headers OR strpos($headers[0], '200 OK') === FALSE) {
	//print 'data api 2 is offline';
}else{
$data = file_get_contents($btceltcusd);
$btce_ltc_usd = json_decode($data, true);
if ($btce_ltc_usd['ticker']['last'] >= 1) {
mysqli_query($link, "INSERT INTO `$tbl_tickers` ($fld_tickers) values ('','LTC','USD','".$btce_ltc_usd['ticker']['last']."','$current_time')");
}
}

/*
$mtgoxbtcusd='https://data.mtgox.com/api/1/BTCUSD/ticker_fast';
$headers = get_headers($mtgoxbtcusd);
if ( ! $headers OR strpos($headers[0], '200 OK') === FALSE) {
	//print 'data api 3 is offline';
}else{
$data = file_get_contents($mtgoxbtcusd);
$mtgox_btc_usd = json_decode($data, true);
mysqli_query($link, "INSERT INTO `$tbl_tickers` ($fld_tickers) values ('','BTC','USD','".$mtgox_btc_usd['return']['last']['value']."','$current_time')");
}
*/

}
}
}
/*_______________-=TheSilenT.CoM=-_________________*/

$finalexchangebtc=0;
$finalexchangeltc=0;
if($tresult = mysqli_query($link, "SELECT * FROM `$tbl_tickers` WHERE `base`='BTC' AND `alt`= 'USD' AND `rate`>=1 ORDER BY `id` DESC LIMIT 10")){
while($trow=mysqli_fetch_object($tresult)){
	if ($finalexchangebtc <= 0) {
	$finalexchangebtc = $trow->rate;
	}
$finalexchangebtc += $trow->rate;
$finalexchangebtc /=$exchange_modifier;
//print "$finalexchangebtc - ";
}
mysqli_free_result ($tresult);
}

if($tresult = mysqli_query($link, "SELECT * FROM `$tbl_tickers` WHERE `base`='LTC' AND `alt`= 'USD' AND `rate`>=1 ORDER BY `id` DESC LIMIT 10")){
while($trow=mysqli_fetch_object($tresult)){
	if ($Finalexchangeltc <= 0) {
	$finalexchangeltc = $trow->rate;
	}
$finalexchangeltc += $trow->rate;
$finalexchangeltc /=$exchange_modifier;
//print "$finalexchangeltc - ";
}
mysqli_free_result ($tresult);
}

/*_______________-=TheSilenT.CoM=-_________________*/

/*_______________-=TheSilenT.CoM=-_________________*/
function send_coins($coinzzz,$address,$amount,$comment) {
$coin_validate = $coinzzz->validateaddress ($address);
if (isset($coin_validate['address']) and isset($coin_validate['ismine'])) {
$tid = $coinzzz->sendtoaddress($address,$amount,$comment, $comment);
return ($amount.' has been send to '.$address.' transaction ID:'.$tid);
}else{
return ('This address is invalid '.$address.' please check again.');
}
}

function withdraw_coins($coinzzz,$account,$address,$amount,$comment) {
$coin_validate = $coinzzz->validateaddress ($address);
if (isset($coin_validate['address']) and isset($coin_validate['ismine'])) {
$tid = $coinzzz->sendfrom($account,$address,$amount,$minconf=1,$comment, $comment);
return ($amount.' has been send to '.$address.' transaction ID:'.$tid);
}else{
return ('This address is invalid '.$address.' please check again.');
}
}
/*_______________-=TheSilenT.CoM=-_________________*/

$crow->Credits=0;

if ($cquery = "SELECT * FROM `$tbl_credits` WHERE (`Username`='$row->Username' and `Charname`='$row->Charname') ORDER BY `id` DESC") {
if($cresult = mysqli_query($link, $query)) {
if ($crow = mysqli_fetch_object ($cresult)) {
mysqli_free_result ($cresult);
}
}
}

if (!isset($crow->Username) AND !isset($crow->Charname)) {
mysqli_query($link, "INSERT INTO `$tbl_credits` ($fld_credits) values ('', '$row->Username', '$row->Charname', 0)");// or print mysqli_error($link);
}

$allowed_currencies = array('btc','ltc');
$tbl_bitcoin = 'lol_bitcoin';

$jsonc = array(
'btc' => array('bitcoinrpc', 'DRccFhy7ZU22kjikhNx4r33nRa1CZKUVuikcC52WPjif', '8332',''),
'ltc' => array('litecoinrpc', 'E8e7DBfgCkXrQvo6eGeJbKpZjRtMT63ScH8QMn3s3mK5', '9332',''),
'ppc' => array('ppcoinrpc', 'Eue9DBfgCkAs3vo6eGeJJsiZjRtMT63ScH8QMnasDmK5', '9902',''),
'nmc' => array('namecoinrpc', 'Eue9DBfgCkXrQvo6eGeJJsiZjRtMT63ScH8QMn3s3mK5', '8336',''),
);

/*_______________-=TheSilenT.CoM=-_________________*/


$currency = 'btc';
$coinbtc = new jsonRPCClient('https://'.$jsonc[$currency][0].':'.$jsonc[$currency][1].'@localhost:'.$jsonc[$currency][2].'/');
//$coinbtc->walletpassphrase($btcpass,300);


$currency = 'ltc';
$coinltc = new jsonRPCClient('https://'.$jsonc[$currency][0].':'.$jsonc[$currency][1].'@localhost:'.$jsonc[$currency][2].'/');
//$coinltc->walletpassphrase($ltcpass,300);

$coinbtc_info = $coinbtc->getinfo();
$coinbtc_accounts = $coinbtc->listaccounts();

$coinltc_info = $coinltc->getinfo();
$coinltc_accounts = $coinltc->listaccounts();
/*
print '<pre>';
print_r($coinbtc_info);
print_r($coinbtc_accounts);


print_r($coinltc_info);
print_r($coinltc_accounts);
print '</pre>';
*/
/*_______________-=TheSilenT.CoM=-_________________*/

if (isset($_POST['btcwithdraw']) AND !empty($_POST['btcwithdraw'])) {
	$waddress = clean_post($_POST['btcwithdraw']);
$coin_validate = $coinbtc->validateaddress ($waddress);
if (isset($coin_validate['address'])) {

mysqli_query($link, "UPDATE `$tbl_bitcoin` SET `btcwithdraw`='$waddress' WHERE `userid`='$row->id' LIMIT 1");

mysqli_query($link, "INSERT INTO `$tbl_logs` ($fld_logs) values ('','$row->Charname','bitcoin log: Changed withdraw adress BTC $waddress','$PHP_SELF','$current_date','$REMOTE_ADDR')");

}else{
return ('This address is invalid '.$waddress.' please check again.');
}
}

/*_______________-=TheSilenT.CoM=-_________________*/

if (isset($_POST['ltcwithdraw']) AND !empty($_POST['ltcwithdraw'])) {
	$waddress = clean_post($_POST['ltcwithdraw']);
$coin_validate = $coinltc->validateaddress ($waddress);
if (isset($coin_validate['address'])) {

mysqli_query($link, "UPDATE `$tbl_bitcoin` SET `ltcwithdraw`='$waddress' WHERE `userid`='$row->id' LIMIT 1");

mysqli_query($link, "INSERT INTO `$tbl_logs` ($fld_logs) values ('','$row->Charname','litecoin log: Changed withdraw adress LTC $waddress','$PHP_SELF','$current_date','$REMOTE_ADDR')");


}else{
return ('This address is invalid '.$waddress.' please check again.');
}
}

/*_______________-=TheSilenT.CoM=-_________________*/


if($bresult = mysqli_query($link, "SELECT * FROM $tbl_bitcoin WHERE `userid`='$row->id' ORDER BY `id` DESC")){
if($brow = mysqli_fetch_object ($bresult)){
mysqli_free_result ($bresult);
if (isset($brow->Charname)) {

/*_______________-=TheSilenT.CoM=-_________________*/
//BITCOINS
/*_______________-=TheSilenT.CoM=-_________________*/

$currency = 'btc';

$amount = $coinbtc->getbalance($row->Charname,6);
if (isset($_POST['btcamount']) AND !empty($_POST['btcamount']) AND is_numeric($_POST['btcamount'])) {
$amount = floatval(clean_post($_POST['btcamount']));
$amounta = clean_post($_POST['btcamount']);
}
$btccredits=($amount*$finalexchangebtc)*100;

if (isset($_POST['btcamount']) AND !empty($_POST['btcamount']) AND is_numeric($_POST['btcamount'])) {
if (is_numeric($amount) AND $amount > 0.001 AND $amount <= $coinbtc->getbalance($row->Charname,6)) {

if (isset($amounta) AND $_POST['action'] == 'Convert to credits') {
$coinbtc->move($row->Charname,$localmasteraccount[$currency],$amount);
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`+$btccredits WHERE `Username`='$row->Username' LIMIT 1");
mysqli_query($link, "INSERT INTO `$tbl_logs` ($fld_logs) values ('','$row->Charname','bitcoin log: convert $amount for $currency','$PHP_SELF','$current_date','$REMOTE_ADDR')");
$output .= '<br><b>Converted '.$amount.' '.$currency.' for '.$btccredits.' credits. <br>Now you have '.number_format($crow->Credits+$btccredits).' credits.</b><br>';
}elseif (isset($amounta) AND $_POST['action'] == 'Withdraw funds') {

//$output .= withdraw_coins($coinbtc,$row->Charname,$brow->btcwithdraw,$amount,$row->Charname);

}

//$output .= send_coins($coinbtc,$mycoinadress[$currency],$amount,$row->Charname);
//$output .= 

}else{
$output .= '<br>:) value must larger than 0.001 and less than your balance...<br>';
}
}

/*_______________-=TheSilenT.CoM=-_________________*/

print '<table width="100%"><tr><td><table cellpadding="1" cellspacing="1" border="0" width="100%"><tr><th colspan=2>'.strtoupper($currency).'</th></tr>
<tr><td>Difficulty</td><td align=right>'.number_format($coinbtc_info['difficulty'],3).'</td></tr>
<tr bgcolor='.$col_th.'><td>Blocks</td><td align=right>'.number_format($coinbtc_info['blocks']).'</td></tr>

<tr bgcolor='.$col_th.'><td>My Balance</td><td align=right> '.number_format($coinbtc->getbalance($row->Charname,6),5).' '.$currency.'</td></tr>
<tr><td>Exchange vs USD</td><td align=right>$'.number_format($finalexchangebtc,5).'</td></tr>
<tr bgcolor='.$col_th.'><td>Exchange vs Credits</td><td align=right>'.number_format($finalexchangebtc*100).' credits</td></tr>
<tr><td>Deposit Address</td><td align=right>'.$brow->bitcoinaddress.'</td></tr>
</table>';
/*<form method=post>
<tr bgcolor=red><td>Withdraw Address</td><td align=right><input type=text name=btcwithdraw value="'.$brow->btcwithdraw.'"><input type=submit value=Change></td></tr></form>';
*/

if ($coinbtc->getbalance($row->Charname,6) > 0) {
$output .= '<form method=post><table><tr><td>Exchange '.strtoupper($currency).'<input type=text name=btcamount value="'.number_format($amount,5).'"> for <b>'.number_format($btccredits).'</b> credits.<input type=submit name=action value="Convert to credits"></td></tr></table></form>';
//$output .= '<form method=post><table><tr><td>Withdraw '.strtoupper($currency).'<input type=text name=btcamount value="'.$amount.'"> <input type=submit name=action value="Withdraw funds"></td></tr></table></form>';
}



$coin_status = array();
$output .= '<table border=1><tr><th colspan=7>Number of confirmations incoming '.strtoupper($currency).' </th></tr><tr><td>0</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr><tr>';
for ($i=0;$i<=6;$i++) {
$coin_status[] = ($coinbtc->getbalance($row->Charname,$i));

$output .= '<td>'.$coinbtc->getbalance($row->Charname,$i).'</td>';
}
$output .= '</tr></table>';
$output .= strtoupper($currency ).' will be added to your balance after 6 confirmations. Withdraw cost 0.01 '.$currency.'.';
/*_______________-=TheSilenT.CoM=-_________________*/
//LITECOINS
/*_______________-=TheSilenT.CoM=-_________________*/

$currency = 'ltc';


$amount = $coinltc->getbalance($row->Charname,6);
if (isset($_POST['ltcamount']) AND !empty($_POST['ltcamount']) AND is_numeric($_POST['ltcamount'])) {
$amount = floatval(clean_post($_POST['ltcamount']));
$amounta = clean_post($_POST['ltcamount']);
}
$ltccredits=($amount*$finalexchangeltc)*100;

if (isset($_POST['ltcamount']) AND !empty($_POST['ltcamount']) AND is_numeric($_POST['ltcamount'])) {
if (is_numeric($amount) AND $amount > 0.01 AND $amount <= $coinltc->getbalance($row->Charname,6)) {

if (isset($amounta) AND $_POST['action'] == 'Convert to credits') {
$coinltc->move($row->Charname,$localmasteraccount[$currency],$amount);
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`+$ltccredits WHERE `Username`='$row->Username' LIMIT 1");
mysqli_query($link, "INSERT INTO `$tbl_logs` ($fld_logs) values ('','$row->Charname','litecoin log: convert $amount for $currency','$PHP_SELF','$current_date','$REMOTE_ADDR')");
$output .= '<br><b>Converted '.$amount.' '.$currency.' for '.$ltccredits.' credits. <br>Now you have '.number_format($crow->Credits+$ltccredits).' credits.</b><br>';
}

//$output .= send_coins($coinbtc,$mycoinadress[$currency],$amount,$row->Charname);
//$output .= withdraw_coins($coinbtc,$row->Charname,$mycoinadress[$currency],$amount,$row->Charname);

}else{
$output .= '<br>:) value must larger than 0.01 and less than your balance...<br>';
}
}

/*_______________-=TheSilenT.CoM=-_________________*/


$ltc_global_balance = $coinltc_info['balance'];
//LXAmbzTBE7SxtBfXDxHvhy9SE6eQZyTaBy
print '</td><td><table cellpadding="1" cellspacing="1" border="0" width="100%"><tr><th colspan=2>'.strtoupper($currency).'</th></tr>
<tr><td>Difficulty</td><td align=right>'.number_format($coinltc_info['difficulty'],3).'</td></tr>
<tr bgcolor='.$col_th.'><td>Blocks</td><td align=right>'.number_format($coinltc_info['blocks']).'</td></tr>

<tr bgcolor='.$col_th.'><td>My Balance</td><td align=right> '.number_format($coinltc->getbalance($row->Charname,6),5).' '.$currency.'</td></tr>
<tr><td>Exchange vs USD</td><td align=right>$'.number_format($finalexchangeltc,5).'</td></tr>
<tr bgcolor='.$col_th.'><td>Exchange vs Credits</td><td align=right>'.number_format($finalexchangeltc*100).' credits</td></tr>
<tr><td>Deposit Address</td><td align=right>'.$brow->litecoinaddress.'</td></tr></table></td></tr>';
/*<form method=post>
<tr bgcolor=red><td>Withdraw Address</td><td align=right><input type=text name=ltcwithdraw value="'.$brow->ltcwithdraw.'"><input type=submit value=Change></td></tr></form></table>';
*/
if ($coinltc->getbalance($row->Charname,6) > 0) {
$output .= '<form method=post><table><tr><td>Exchange '.strtoupper($currency).'<input type=text name=ltcamount value="'.number_format($amount,5).'"> for <b>'.number_format($ltccredits).'</b> credits.<input type=submit name=action value="Convert to credits"></td></tr></table></form>';
//$output .= '<form method=post><table><tr><td>Withdraw '.strtoupper($currency).'<input type=text name=ltcamount value="'.$amount.'"> <input type=submit name=action value="Withdraw funds"></td></tr></table></form>';
}

$coinltc_status = array();
$output .= '<table border=1><tr><th colspan=7>Number of confirmations incoming '.strtoupper($currency).' </th></tr><tr><td>0</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr><tr>';
for ($i=0;$i<=6;$i++) {
$coinltc_status[] = ($coinltc->getbalance($row->Charname,$i));

$output .= '<td>'.$coinltc->getbalance($row->Charname,$i).'</td>';
}
$output .= '</tr></table>';
$output .= strtoupper($currency ).' will be added to your balance after 6 confirmations. Withdraw cost 0.10 '.$currency.'.';
/*_______________-=TheSilenT.CoM=-_________________*/

}


}
}

/*_______________-=TheSilenT.CoM=-_________________*/

if (empty($brow->Charname)) {
$sendbtc = $coinbtc->getnewaddress($row->Charname);
$sendltc = $coinltc->getnewaddress($row->Charname);

$fld_bitcoin = '`id` ,`userid` ,`Username` ,`Charname` ,`bitcoinaddress` ,`btcwithdraw` ,`bitcoins` ,`litecoinaddress` ,`ltcwithdraw` ,`litecoins`';
$bitcoin_vals="
'',
'$row->id',
'$row->Username',
'$row->Charname',
'$sendbtc',
'',
'0',
'$sendltc',
'',
'0'
";


mysqli_query($link, "INSERT INTO `$tbl_bitcoin` ($fld_bitcoin) VALUES ($bitcoin_vals)") or print("Unable to insert table bitcoin.".mysqli_error($link));
print '<b>Bitcoin and Litecoin has been activated for your account if you change your name your btc and ltc will be lost. </b>';
}

/*_______________-=TheSilenT.CoM=-_________________*/
}
catch (Exception $e) {
print("<p>Server error! Please try later.</p>");
}

print $output;
?>
<br><br><b>Get 3% of referred users� GH/s balance to your bonus GH/s account!</b><br>
<a href="https://cex.io/r/0/Jim/0/" title="CEX.io - Bitcoin Commodity Exchange" target="_blank"><img src="https://cex.io/informer/Jim/eaa93ca5104ca54216734c8a1680d026/" width="500" height="35" border="0"></a>
<?php 
include_once($game_footer);
?>