<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_mysql);
require_once($inc_ffunctions);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);

if (empty($LIMIT)) {$LIMIT=50;}
$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

$kut_zooi = array(
/*
'Meadow' 	=> array('lol1_meadow','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'Meadow2' 	=> array('lol1_meadow2','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'm3' 	=> array('lol1_m3','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'Xedon' 		=> array('lol1_xedon','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'Eidolon' 		=> array('lol1_eidolon','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),

'Duel' 			=> array('lol1_duel','lol_board','id,star,clan,sex,charname,race,level,message,ip,timer'),
'Devlab' 		=> array('lol1_devlab','lol_board','id,star,clan,sex,charname,race,level,message,ip,timer'),
'Evolve'		=> array('lol_evolve','lol_board','id,star,clan,sex,charname,race,level,message,ip,timer'),

'Noauto'		=> array('lol_noauto','lol_board','id,star,clan,sex,charname,race,level,message,ip,timer'),

'Euro'			=> array('lol1_euro','lol_board','id,star,clan,sex,charname,race,level,message,ip,timer'),

//'Ysomite' 		=> array('lol2_ysomite','lol2_board','id,creator,crintel,news,date'),

'Shadow' 		=> array('lol3_shadow','lol3_board','id,star,sex,charname,class,level,receiver,news,gamename,ip'),
'Shadow2' 	=> array('lol3_shadow2','lol3_board','id,star,sex,charname,class,level,receiver,news,gamename,ip'),

'Global' 		=> array('silent_chat','chat_content','id,channel,star,guild,sex,charname,level,receiver,content,gamename,ip'),

//'PJ' 			=> array('paypaljackpot_com','jackpot_board','id,channel,star,guild,sex,nickname,gold,receiver,content,gamename,ip'),
//'Megod' 	=> array('megod_megod','god_chat','id,timer,sex,charname,level,receiver,channel,message'),
*/
'm3' 	=> array('lol1_m3','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'm6' 	=> array('lol1_m6','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'sotse' 	=> array('lol1_m5','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
);

$kut_zooi_keys=array_keys($kut_zooi);
?><table width="100%"><tr><th>Chat peeking</th></tr><tr><td><?php 
$i=0;foreach ($kut_zooi_keys as $val) {$i++;
print ' <a href="?open=chatpeek&peek='.$val.'">'.$val.'</a>';
if($i<=8){

	?><sup><font size=-1><a href="/chat_logs.php?logs=<?php print strtolower($val);?>">logs</a></font></sup> <?php 

	}
}
?><br><?php 

if (empty($_GET['peek'])) {?><b>Please select a server to peek in the chat.</b><br><?php } else {
$peek=clean_post($_GET['peek']);

foreach ($kut_zooi as $key=>$val) {
if ($peek == $key) {
mysqli_select_db($link,$val[0]);

if ($result = mysqli_query($link, "SELECT * FROM $val[1] WHERE `id` ORDER BY `id` DESC LIMIT $LIMIT")) {
$color='#fffff';
while ($row = mysqli_fetch_object($result)) {
if ($color == $col_hover) {$color='#fffff';} else {$color=$col_hover;}
print '<font color="'.$color.'">';
foreach ($row as $ikey=>$ival) {

if($ikey == 'star' and $ival >= 1){
?><img src="https://lordsoflords.com/images/emotions/star.gif" border="0"><?php 
}elseif($ikey == 'Guild' or $ikey == 'clan'){
echo !empty($ival)?'['.$ival.'] ':'';
}elseif ($ikey !== 'id' and $ikey !== 'ip' and $ikey !== 'star' and $ikey !== 'timer' and $ikey !== 'Time' and $ikey !== 'gamename' and $ikey !== 'receiver') {
if(preg_match("/\[star\]/i",$ival)){
$ival=preg_replace("/\[star\]/i","<img src=\"https://lordsoflords.com/images/emotions/star.gif\" border=\"0\">",$ival);
}
if(preg_match("/~c\[.*?\]/i",$ival)){$ival=preg_replace("/~c\[.*?\]/i","",$ival);}

if ($ikey == 'Message' or $ikey == 'message') {
	$ival=preg_replace("/</i","&lt;",$ival);
	print postit($ival).' ';
}else{
	print $ival.' ';
}

}elseif($ikey == 'timer' or $ikey == 'Time'){
if($ival >= 1) {
	print '<sup>('.dater($ival).' old)</sup>';
}else{
	print '<sup>(very old)</sup>';
}
}
if ($ikey == 'gamename'){
print '<sup>'.($ival).'</sup>';
}

}//foreach
print '</font><br>';
 $ikeys=1;
} //while
mysqli_free_result($result); } //results
}
} //foreach
}

/*
//CLICKBANK ADS ADS ADS ADS ADS ADS
$ads = array (

"Psp Blender Is The #1 Psp Download Site Online. Psp Movie, Game, Downloads and more." => "https://freejim.pspblend.hop.clickbank.net/?tid=PSP",
"Ultra Hot** Satellite Tv Titanium & Goohay! Now Available On CB* *Satellite Tv Titanium*" => "https://freejim.ipodpsp.hop.clickbank.net/?tid=SAT",
"Top Music Downloads - High Conversion. Best Conversion Ratio, Highest Earnings Guaranteed! " => "https://freejim.mp3center.hop.clickbank.net/?tid=MUS",
"Brand New Mp3 Site, Warning Huge Payouts. The Best For Ppc, Mp3 Movies Tv Shows , Custom Title! Google/Yahoo Tracking!" => "https://freejim.udc01.hop.clickbank.net/?tid=MP3",
"Psp Downloads. * Hot & Renewed! 4 New Psp Websites!" => "https://freejim.pspserv.hop.clickbank.net/?tid=PSPD",

"Unlimited Free Movie Downloads." => "https://freejim.moviecity.hop.clickbank.net/?tid=MOV",
"World Of Warcraft Joanas 1-70 Horde Guide. Joanas 1-70 Horde Power Leveling Guide For World Of Warcraft." => "https://freejim.joanaguide.hop.clickbank.net/?tid=WOWJ",
"World Of Warcraft Guide Kopps 1-70. The Best Alliance Guide For Getting To 70 Fast! Interactive Coordinates, Maps, 1-60 & 60-70.
" => "https://freejim.wowseller.hop.clickbank.net/?tid=WOWK",
"Poker Tournament Manager Software. This Program Has The Tools You Need To Manage Any Poker Tournament: Including Poker Clock, Payouts, Blinds, And So Much More! " => "https://freejim.ptmcbank.hop.clickbank.net/?tid=POKER",
"Poker Edge - Poker Software. The Leading Product In The Hottest Poker Market! " => "https://freejim.pokeredge.hop.clickbank.net/?tid=POKE",

"Holdem Pirate Poker Software. Promote The Most Desired Product On The Market. Complete Poker Tool Software." => "https://freejim.holdemhawk.hop.clickbank.net/?tid=POKES",
"Affiliate Project X - Game. Over. Learn Why. Before Your Competition Does." => "https://freejim.projectx.hop.clickbank.net/?tid=PX",
"Car Auctions. #1 Auto Auctions and Bargains site." => "https://freejim.bargain01.hop.clickbank.net/?tid=CAR",

);

$ads_max = count($ads);
$randed = rand(1,$ads_max);
$i=0;
foreach ($ads as $key=>$val) {$i++;
if ($i == $randed) {
print '<a href="'.$val.'">'.$key.'</a><br>';
break;
}
}
//ADS ADS ADS ADS ADS ADS

*/
?>
</td></tr></table>
<?php 
mysqli_close($link);

require_once($html_footer);
?>