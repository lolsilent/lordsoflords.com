<?php 
#!/usr/local/bin/php

function clean_shit($in) {
$in=strip_tags($in);
$in=htmlentities("$in", ENT_QUOTES);
$in=htmlspecialchars("$in", ENT_QUOTES);
$in=trim($in);
$in=addslashes($in);
}

if (isset($_POST) AND !empty($_POST)) {
foreach ($_POST as $key => $val) {
	$$key = clean_shit($val);
}
}
if (isset($_GET) AND !empty($_GET)) {
foreach ($_GET as $key => $val) {
	$$key = clean_shit($val);
}
}

$root_url		= 'https://lordsoflords.com/m3';
$ref_url		= 'https:\/\/lordsoflords.com\/m3';
$images_url = 'https://lordsoflords.com/images/lol';
$emotions_url	= 'https://lordsoflords.com/images/emotions';

$server		= "m3";
$admin_name	= 'Admin SilenT';

$btcpass='BTC1q2w3e4r5t6y!Q@W#E$R%T^Y';
$ltcpass='LTC1q2w3e4r5t6y!Q@W#E$R%T^Y';

$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];
$PHP_SELF=$_SERVER['PHP_SELF'];

$title		= 'Lords of Lords';
$title_descrip	= " $server server : Free online text based rpg game";
$title_info	= 'The sword of the sixth element';

$version		= 1.990;
$current_time	= set_time();
$current_date	= date("d M H:i");

$items		=array('Weapon', 'Attackspell', 'Healspell','Helmet', 'Shield','Amulet','Ring', 'Armor','Belt', 'Pants', 'Hand', 'Feet');

$html_header	= './TemplateS/templates.header.php';
$html_footer	= './TemplateS/templates.footer.php';
$html_style	= './TemplateS/game.style.php';
$game_header	= './TemplateS/game.header.php';
$game_nsheader	= './TemplateS/game.nsheader.php';
$game_footer	= './TemplateS/game.footer.php';
$clean_header	= './TemplateS/clean.header.php';
$clean_footer	= './TemplateS/clean.footer.php';

$files		= array( 'index', 'signup', 'login', 'ladder', 'guilds', 'faq', 'rules', 'guide', 'forum', 'servers');

$gamefiles	= array( 'main', 'paper', 'deads', 'steals', 'graves', 'br','guild', 'challenge', 'schedule', 'br', 'stats', 'fight', 'world', 'shop', 'inventory', 'br', 'transfer', 'messages', 'stash', 'charms', 'market', 'br', 'steal', 'nobility', 'support', 'politics', 'br', 'town', 'ladders', 'guide', 'forums', 'save', 'logout');

$operators 	= array('Admin', 'Cop', 'Mod', 'Support');
$opinactive	= array(20,15,10,5);

$sap 		= array ('+','-','*','/');

$match_time	=500;
$need_guilds	=4;
$limit_clan	=10;
$out_of_tour	=10;

$max_gold	=1000000000;
$db_ladder_max	=100;
$inactive_days	=100;
$top_players	=25;
$max_messages	=25;
$max_smessages	=25;
$refresh_time	=50;
$max_cmessages	=5;
$max_news	=100;
$duel_days	=3;
$max_login	=1000;
$chat_size	=20;
if (!empty($_COOKIE['chat_size'])) {
$chat_size=$_COOKIE['chat_size'];
}

require_once './TemplateS/game.colors.php';

function set_time(){
list($usec, $sec) = explode(" ",microtime());
return ((float)$usec + (float)$sec);
}

$error_message = "
<table border=5 align=center width=100%>
<tr bgcolor=#000000><th><b><font color=#FFFFFF size=+2>You have been logged out, possible reasons : <b></th></tr>
<tr><td>
<b>Mass clicking</b><br>
Clicking on a link or button more than once in a second.<br>
<b>Inactive</b><br>
Being inactive for $max_login second.<br>
<b>Cookie</b><br>
An cookie was unable to be set/changed make sure your browser is set to allow $root_url to set/change cookies.<br>
<b>Error</b><br>
Maybe the site is being updated or something went wrong try to relogin or refresh this page.<br>
<br>
Sorry for this inconvenience,<br>
$admin_name
</td></tr></table>Error id :
";

$mute_messages="You have been muted from the chat board and messages for spamming, begging, or doing or saying something what we don't like. Please behave yourself next time.";
?>