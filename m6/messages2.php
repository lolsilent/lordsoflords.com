<?php 
#!/usr/local/bin/php
require_once('AdMiN/www.main.php');
require_once('AdMiN/www.functions.php');
require_once($game_header);
if ($row->Mute <= $current_time) {
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/functions.messaging.php');
/*
###_______________-=TheSilenT.CoM=-_______________###
Project name	: Messaging Funcion
Script name	: Script name
Version		: 1.00
Release date	: 2-15-2008 03:32:55
Last Update	: 2-15-2008 03:32:55
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

//RECIPIENTS SERVER DEPENDEND
if(isset($_GET['create'])){

$alfa='';
$recipient='';

if(!empty($_POST['alfa'])){
	$alfa=message_clean($_POST['alfa']);
	if(strlen($alfa) < 2){
		$alfa='';
	}
}
if(!empty($_POST['recipient'])){
	$recipient=message_clean($_POST['recipient']);
}

$recipient_select = '';

if (!empty($alfa)) {

if($presult = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `Charname`!='$row->Charname' and `Charname` LIKE CONVERT (_utf8 '%$alfa%' USING latin1) COLLATE latin1_swedish_ci ORDER BY Charname ASC LIMIT 100")){
if(mysqli_num_rows($presult) > 1) {
$recipient_select = '<select name=recipient>';
	while ($prow = mysqli_fetch_object ($presult)) {
if ($recipient == $prow->id) {
$recipient_select .= '<option value="'.$prow->id.'" selected>'.$prow->Sex.' '.$prow->Charname.'</option>';
}else{
$recipient_select .= '<option value="'.$prow->id.'">'.$prow->Sex.' '.$prow->Charname.'</option>';
}
	}
$recipient_select .= '</select>';
}
mysqli_free_result ($presult);
}

}


}
//RECIPIENTS SERVER DEPENDED

if (empty($server)) {
	$gid = 0;//	0 fatality SANDBOX
}elseif($server == 'Meadow'){
	$gid = 1; // 1 meadow
}elseif($server == 'MeadowII'){
	$gid = 2; //	2 meadow2
}elseif($server == 'Eidolon'){
	$gid = 3; //	3 eidolon
}elseif($server == 'Xedon'){
	$gid = 4; //	4 xedon
}elseif($server == 'Duel'){
	$gid = 5; //	5 duel
}elseif($server == 'Devlab'){
	$gid = 6; //	6 devlab
}elseif($server == 'Evolve'){
	$gid = 7; //	7 evolve
}elseif($server == 'Euro'){
	$gid = 8; //	8 euro
}elseif($server == 'Ysomite'){
	$gid = 9; //	9 ysomite
}elseif($server == 'Shadow'){
	$gid = 10; //	10 shadow
}elseif($server == 'Shadow2'){
	$gid = 11; //	11 shadow2
}elseif($server == 'Tourney'){
	$gid = 12; //	12 tourney
}elseif($server == 'History'){
	$gid = 13; //	13 history
}elseif($server == 'net'){
	$gid = 14; //	14 net

}elseif($server == 'rpgtext'){
	$gid = 15; //	15 rpgtext
}elseif($server == 'warunit'){
	$gid = 16; //	16 warunit
}elseif($server == 'megod'){
	$gid = 17; //	17 megod
}elseif($server == 'mobunit'){
	$gid = 18; //	18 mobunit
}elseif($server == 'project'){
	$gid = 19; //	19 project x5
}elseif($server == 'wargame'){
	$gid = 20; //	20 wargame
}elseif($server == 'newconflict'){
	$gid = 21; //	21 newconflict
}elseif($server == 'skillgames'){
	$gid = 22; //	22 skillgames
}elseif($server == 'jackpot'){
	$gid = 23; //	23 jackpot
}elseif($server == 'humanimals'){
	$gid = 24; //	24 humanimals
}elseif($server == 'forums'){
	$gid = 25; //	25 forums
}elseif($server == 'thesilent'){
	$gid = 26; //	26 thesilent
}else{
	$gid=0;
}
//print '<hr>'.$gid;
$dbm_main = 'messaging';
$tbl_messages = 'messages';
$fld_messages = '`id`,`gid`,`mid`,`rid`,`body`,`importance`,`status`,`dater`,`delay_timer`,`timer`';

$message_days = 30; //days to keep messages
$message_days_secs = $message_days*86400;//days to keep messages UNIX
$message_limit = 100; //max number of messages to keep/display

$delay_timer = 5; //wait seconds before the second message is allowed to send

$current_time = time();
$current_date = date('d M Y H:m:s');

$message_functions = array('inbox', 'outbox', 'deleted');
$status_array = array(
'inbox' => 0,
'outbox' => 0,
'deleted' => 2,
);

//REMOVE OLD MESSAGES
if($mresult=mysqli_query($link, "SELECT `id` FROM `$tbl_messages` WHERE (`timer`>'$current_time'+'$message_days_secs') ORDER BY `id` DESC LIMIT 1")){

if (mysqli_num_rows($mresult) >= 1) {
mysqli_query($link, "DELETE FROM `$tbl_messages` WHERE (`timer`>'$current_time'+'$message_days_secs') LIMIT 1000");
}
mysqli_free_result ($mresult);

}
//REMOVE OLD MESSAGES

//require_once($_SERVER['DOCUMENT_ROOT'].'/fatality/aaa.functions.php');

//TESTTESTTESTTESTTESTTESTTESTTEST


/*if (!isset($link)) {
require_once($_SERVER['DOCUMENT_ROOT'].'/fatality/aaa.mysql.php');
$link = mysqli_connect($db_host,$db_user,$db_password) or die(mysqli_error($link).'Database offline.');
}*/
mysqli_select_db($link,$dbm_main) or die(mysqli_error($link).'Database offline.');


print '<table cellpadding=2 cellspacing=2 border=0 width=100%><tr><th colspan=2>Messaging Service</th></tr><tr><td width=125 valign=top>
<a href="?create">Create Message</a><br><br>';

foreach ($message_functions as $val) {
	if (in_array($val,$status_array)) {
		message_amount($val);
	}
}

print '</td><td valign=top>';

if(isset($_GET['forward'])){
	message_forward($row->id);
}elseif(isset($_GET['reply'])){
	message_reply($row->id);
}elseif(isset($_GET['create'])){
	message_create($row->id);
}elseif(isset($_GET['outbox'])){
	message_outbox($row->id);
}elseif(isset($_GET['deleted'])){
	message_deleted($row->id);
}else{
	message_inbox($row->id);
}
print '</td></tr></table>';

//if (isset($link)) {mysqli_close($link);}

//TESTTESTTESTTESTTESTTESTTESTTEST


/*
FUNCTIONS :
message_amount
message_inbox
message_outbox
message_deleted

message_remove
message_create
message_reply
message_forward
message_alert
message_report
message_post
message_clean
message_dater
*/

/*
MYSQL FIELDS
`id`
`gid` game id
	0 fatality SANDBOX
	1 meadow
	2 meadow 2
	3 eidolon
	4 xedon
	5 duel
	6 devlab
	7 evolve
	8 euro
	9 ysomite
	10 shadow
	11 shadow2
	12 tourney
	13 history
	14 net

	15 rpgtext
	16 warunit
	17 megod
	18 mobunit
	19 project x5
	20 wargame
	21 newconflict
	22 skillgames
	23 jackpot
	24 humanimals
	25 forums
	26 thesilent
	
	
`mid` member id
`rid` recipient id
`body`
`importance`
	0 standard
	1 support message
	2 mod message
	3 cop message
	4 admin message
	5 supermin message
	6 site news message
`status`
	0 inbox
	0 outbox
	2 deleted
	3 removed
	4 send
	5 reply
	6 forward

`dater` datestamp
`delay_timer` datestamp
`timer` timestamp
*/
if ($row->Level <= 100) {
print '<hr>The sender and the receiver of the message can delete any inbox and outbox message.<br>
If a message on your inbox or outbox is gone then the receiver or the sender has deleted the message.<br>
Nobody has access to your deleted messages but you.';
}
mysqli_select_db($link,$db_main) or die(mysqli_error($link).'Database offline.');
} else {
echo $mute_messages;
} //muted
require_once($game_footer);
?>