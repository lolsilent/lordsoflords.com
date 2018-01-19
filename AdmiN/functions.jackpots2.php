<?php 
#!/usr/local/bin/php
/*
###_______________-=TheSilenT.CoM=-_______________###
Project name	: Project name
Script name	: Script name
Version		: 1.00
Release date	: 3-5-2008 03:27:49
Last Update	: 3-5-2008 03:27:49
Email		: admin@thesilent.com
Homepage	: https://thesilent.com
Created by	: TheSilent
Last modified by	: TheSilent
###_______________COPYRIGHT NOTICE_______________###
# Redistributing this software in part or in whole strictly prohibited.
# You may use and modified my software as you wish. 
# If you want to make money from my work please ask first. 
# By using this free software you agree not to blame me for any
# liability that might arise from it's use.
# In all cases this copyright notice and the comments above must remain intact.
# Copyright (c) 2001 TheSilenT.CoM. All Rights Reserved.
###_______________COPYRIGHT NOTICE_______________###
*/

$dbj_main = 'jackpots';
$tbl_jackpots= 'lol_jackpots';
$fld_jackpots= '`id`,`gid`,`wid`,`type`,`number`,`amount`,`dater`,`timer`';

$tbl_rolls= 'lol_rolls';
$fld_rolls= '`id`,`gid`,`mid`, `results`,`dater`,`timer`';


if (!empty($current_time)) {
	$current_time = time();
}
if (!empty($current_date)) {
	$current_date = date('d M Y H:m:s');
}

$rolls=array();
$answers=array();



/*_______________-=TheSilenT.CoM=-_________________*/

function jackpot_rollem () {
global $rolls, $answers,$winchances;

foreach ($winchances as $val) {
	$rolls[] = round(rand(1,$val));
	$answers[] = round(rand(1,$val));
}
}


/*_______________-=TheSilenT.CoM=-_________________*/


function jackpot_gid($in) {

if (empty($in)) {
	$gid = 0;//	0 fatality SANDBOX
}elseif($in == 'Meadow'){
	$gid = 1; // 1 meadow
}elseif($in == 'MeadowII'){
	$gid = 2; //	2 MeadowII
}elseif($in == 'Eidolon'){
	$gid = 3; //	3 eidolon
}elseif($in == 'Xedon'){
	$gid = 4; //	4 xedon

}elseif($in == 'Duel'){
	$gid = 5; //	5 duel
}elseif($in == 'Devlab'){
	$gid = 6; //	6 devlab
}elseif($in == 'Evolve'){
	$gid = 7; //	7 evolve
}elseif($in == 'Euro'){
	$gid = 8; //	8 euro
}elseif($in == 'Tourney'){
	$gid = 9; //	9 tourney

}elseif($in == 'Ysomite'){
	$gid = 10; //	10 ysomite

}elseif($in == 'Shadow'){
	$gid = 11; //	11 shadow
}elseif($in == 'ShadowII'){
	$gid = 12; //	12 ShadowII

}elseif($in == 'net'){
	$gid = 13; //	13 net

}elseif($in == 'History'){
	$gid = 14; //	14 history
}elseif($in == 'rpgtext'){
	$gid = 15; //	15 rpgtext
}elseif($in == 'warunit'){
	$gid = 16; //	16 warunit
}elseif($in == 'megod'){
	$gid = 17; //	17 megod
}elseif($in == 'mobunit'){
	$gid = 18; //	18 mobunit
}elseif($in == 'project'){
	$gid = 19; //	19 project x5
}elseif($in == 'wargame'){
	$gid = 20; //	20 wargame
}elseif($in == 'newconflict'){
	$gid = 21; //	21 newconflict
}elseif($in == 'skillgames'){
	$gid = 22; //	22 skillgames
}elseif($in == 'jackpot'){
	$gid = 23; //	23 jackpot
}elseif($in == 'humanimals'){
	$gid = 24; //	24 humanimals
}elseif($in == 'forums'){
	$gid = 25; //	25 forums
}elseif($in == 'thesilent'){
	$gid = 26; //	26 thesilent
}else{
	$gid=0;
}
return $gid;
}
/*_______________-=TheSilenT.CoM=-_________________*/
function jackpot_last() {
global $gid,$tbl_rolls;

$mquery="SELECT * FROM `$tbl_rolls` WHERE (`gid`='$gid','mid') ORDER BY `id` DESC LIMIT 1";
if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
if ($mrow=mysqli_fetch_object($mresult)) {
return $mrow->timer;
}
mysqli_free_result($mresult);
}
}
return 0;
}
/*_______________-=TheSilenT.CoM=-_________________*/
function jackpot_see() {
global $gid,$tbl_rolls,$col_th;

//$fld_rolls= '`id`,`gid`,`mid``results`,`dater`,`timer`';
$mquery="SELECT * FROM `$tbl_rolls` WHERE (`gid`='$gid') ORDER BY `id` DESC LIMIT 200";

$i=0;
if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
	print '<table width=100%><tr><th colspan=3>Jackpot Results</th></tr>';
	while ($mrow=mysqli_fetch_object($mresult)){$i++;
		print '<tr';if(empty($bg)){?> bgcolor="<?php print $col_th;$bg=1;?>"<?php }else{$bg='';}print'><td>'.$mrow->dater.'</td><td>'.$mrow->results.'</td></tr>';
	if ($i>= 100) {
		mysqli_query($link, "DELETE FROM `$tbl_rolls` WHERE `id`='$mrow->id' LIMIT 1");
	}
	}
	mysqli_free_result($mresult);
	print '</tr></table>';
} else {
print '<p>No results yet.</p>';
}
}

}
/*_______________-=TheSilenT.CoM=-_________________*/
function jackpot_prices($number,$roll,$answer) {
global $row,$cobj,$gid,$tbl_jackpots,$fld_jackpots,$cost_price,$gametype,$gameno,$current_time,$current_date,$update_it,$to_credits,$change_credits;
	print '<tr>';

//$tbl_jackpots= 'lol_jackpots';
//$fld_jackpots= '`id`,`gid`,`wid`,`type`,`number`,`amount`,`dater`,`timer`';
$to_return = '';
for ($i=1;$i<=3;$i++) {
$mquery="SELECT * FROM `$tbl_jackpots` WHERE (`gid`='$gid' AND `type`='$i' AND `number`='$number') ORDER BY `id` DESC LIMIT 5";
if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
	while ($mrow=mysqli_fetch_object($mresult)){
		print '<td align=center>$'.number_format($mrow->amount);
		if ($gametype == $i and $gameno == $number and $row->$cost_price[$i][2] >= $cost_price[$i][0]) {
			
			if ($roll == $answer) {
				$to_return .= '<br><b>'.$row->sex.' '.$row->charname.' wins the '.$cost_price[$i][1].' Jackpot!<br>With a grand total of '.number_format($mrow->amount).' '.$cost_price[$i][1].' and pays 10% tax.</b>';
$mrow->amount=($mrow->amount/100)*90;
				if ($mrow->type == 3) {
$to_credits = "`credits`=".($cobj->credits+$mrow->amount);
$change_credits += $mrow->amount;
				}else{
$update_it .= ", `".$cost_price[$i][2]."`=".($row->$cost_price[$i][2]+$mrow->amount);
				}
$row->$cost_price[$i][2] +=$cost_price[$i][0];

				mysqli_query($link, "UPDATE `$tbl_jackpots` SET `amount`='".$cost_price[$i][0]."' WHERE (`id`='$mrow->id') LIMIT 1") or print(mysqli_error($link));
			} else {
				$to_return .= '<br>Played '.$cost_price[$i][1].' Jackpot for '.number_format($cost_price[$i][0]).' '.$cost_price[$i][1].'.';

				if ($mrow->type == 3) {
$to_credits = "`credits`=".($cobj->credits-$cost_price[$i][0]);
$change_credits -= $cost_price[$i][0];
				}else{
$update_it .= ", `".$cost_price[$i][2]."`=".($row->$cost_price[$i][2]-$cost_price[$i][0]);
				}
$row->$cost_price[$i][2] -=$cost_price[$i][0];

				mysqli_query($link, "UPDATE `$tbl_jackpots` SET `amount`=`amount`+'".$cost_price[$i][0]."' WHERE (`id`='$mrow->id') LIMIT 1") or print(mysqli_error($link));
			}
		}
		print '</td>';
	}
	mysqli_free_result($mresult);
} else {
	print '<td align=center>$0!</td>';
	mysqli_query($link, "INSERT INTO `$tbl_jackpots` ($fld_jackpots) VALUES ('NULL', '$gid', '','$i', '$number', '".$cost_price[$i][0]."','$current_date','$current_time')") or print(mysqli_error($link));
}
}else {
	print '<td align=center>$0!!</td>';
	mysqli_query($link, "INSERT INTO `$tbl_jackpots` ($fld_jackpots) VALUES ('NULL', '$gid', '','$i', '$number', '".$cost_price[$i][0]."','$current_date','$current_time')") or print(mysqli_error($link));
}
}//for

	print '<tr>';
return $to_return;
}
/*_______________-=TheSilenT.CoM=-_________________*/

?>