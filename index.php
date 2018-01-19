<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_mysql);
require_once($html_header);



$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);
mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

if($result=mysqli_query($link, "SELECT * FROM $tbl_servers WHERE `server`='total' ORDER BY `id` DESC LIMIT 1")){
if($row=mysqli_fetch_object($result)){
mysqli_free_result($result);
}else{$row->players=0;$row->alive=0;}}

?><table width=100%><tr><th colspan=6>Welcome to Lords of Lords</th></tr><tr><th>Games</th><th>Quick Links</th><th>Births</th><th>Alive</th><th>Online</th><th>Buried</th></tr><?php 
$tot_players=0;
$tot_alive=0;
$tot_online=0;
$tot_kills=0;
foreach ($array_dbs as $key=>$val) {

$table_name = preg_replace("/_.*?$/i","",$val);
$table_name = preg_replace("/1/i","",$table_name);
$table_name = $table_name.'_members';
mysqli_select_db($link,$val);

$alive=0;
if($mresult = mysqli_query($link, "SELECT `id` FROM `$table_name` WHERE `id` ORDER BY `id` DESC")){
if($srow = mysqli_fetch_object($mresult)){$alive = mysqli_num_rows($mresult);mysqli_free_result($mresult);

if($iresult = mysqli_query($link, "SELECT `fights` FROM `lol_index` WHERE `id` ORDER BY `id` DESC LIMIT 9")){
while($irow = mysqli_fetch_object($iresult)){
	$tot_kills+=$irow->fights;
}
	mysqli_free_result($iresult);
	}

$online=0;
if($oresult = mysqli_query($link, "SELECT `id` FROM `$table_name` WHERE `time`>=$current_time-1000 ORDER BY `id` DESC")){
if($online = mysqli_num_rows($oresult)){mysqli_free_result($oresult);}
}else{if($oresult = mysqli_query($link, "SELECT `id` FROM `$table_name` WHERE `timer`>=$current_time-1000 ORDER BY `id` DESC")){
if($online = mysqli_num_rows($oresult)){mysqli_free_result($oresult);}
}}

$tot_players+=$srow->id;
$tot_alive+=$alive;
$tot_online+=$online;

$base_url='https://lordsoflords.com/';

if($online >= 3 or isset($_GET['more'])){
if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor='';}
?><tr<?php print $bgcolor;?>><td nowrap><a href="<?php print $base_url.strtolower($key);?>/"><?php print $key;?></a> <?php print '</td><td nowrap><font size=-1>';
if($key == 'History'){//nothing
?><a href="<?php print $base_url.strtolower($key);?>/signup.php">signup</a> <a href="<?php print $base_url.strtolower($key);?>/login.php">login</a> <a href="<?php print $base_url.strtolower($key);?>/ladder.php">ladder</a><?php 
}elseif($key == 'Evolve' or $key == 'Duel' or $key == 'Devlab' or $key == 'Euro'){
?><a href="<?php print $base_url.strtolower($key);?>/signup.php">signup</a> <a href="<?php print $base_url.strtolower($key);?>/login.php">login</a> <a href="<?php print $base_url.strtolower($key);?>/ladder.php">ladder</a><?php 
}elseif($key !== 'Shadow' and $key !== 'Shadow2'){
?><a href="<?php print $base_url.strtolower($key);?>/signup.php">signup</a> <a href="<?php print $base_url.strtolower($key);?>/login.php">login</a> <a href="<?php print $base_url.strtolower($key);?>/ladder.php">ladder</a><?php 
}else{
?><a href="<?php print $base_url.strtolower($key);?>/index.php?open=signup">signup</a> <a href="<?php print $base_url.strtolower($key);?>/index.php?open=login">login</a> <a href="<?php print $base_url.strtolower($key);?>/index.php?open=ladder">ladder</a><?php 
if($key !== 'Shadow' and $key !== 'Shadow2'){?> <a href="<?php print $base_url.strtolower($key);?>/index.php?open=guilds">guilds</a><?php }
}
?></font></td><td align=right><?php print number_format($srow->id);?></td><td align=right><?php print number_format($alive);?></td><td align=right><?php print number_format($online);?></td><td align=right><?php print number_format($srow->id-$alive);?></td></tr><?php 
}

}}}
?></table><?php 


?>
<center><b>More than <?php print number_format($tot_kills);?> victims where slaughtered in the past 8 days and counting.<br>You have arrived at the right place to massacre your opponents<a href="?more">!</a></b></center>


<table width="100%" border="0"><tr><th colspan=2>First time here?</th></tr><tr><td colspan=2>
To start fast select a world, signup then login and you in the game.<br>
First timers and beginners of the game are advised to visit a world with online players, they can help you.<br>
</td></tr><tr><td valign=top>

<table width="100%" border="0">

<?php if (isset($_GET['description'])) {?>
<tr><dl><dt><a href="/meadow/">Meadow</a></dt><dd>
This is a Hardcore Server when you die here you restart at level 1!
Welcome to Meadow were the Gods of immortal has left your adventure begins here.
</dd></dl></tr>

<tr><dl><dt><a href="/meadow2/">Meadow2</a></dt><dd>
There are usually friendly players in the game to help you with your questions.
</dd></dl></tr>

<tr><dl><dt><a href="/m3/">m3</a></dt><dd>
m3 = Meadow 3 launched on 09 Nov 2009 
</dd></dl></tr>

<tr><dl><dt><a href="/eidolon/">Eidolon</a></dt><dd>
Same as Meadow2 but usually allot more quit.
</dd></dl></tr>
<tr><dl><dt><a href="/xedon/">Xedon</a></dt><dd>
This is a outlaw server! Here everything is allowed! No Admins! No Cops! No nothing! Enter at your own risk!
You hate rules, you are evil, you are a cheater, you hate the HCM, you are on the island called Xedon where the HCM does not exist!
</dd></dl></tr>
<tr><dl><dt><a href="/duel/">Duel</a></dt><dd>
Players Versus Player only.<br>
Chat can randomly drop inventory items, Gold, Xp and Super Life.<br>
</dd></dl></tr>


<tr><dl><dt><a href="/devlab/">Devlab</a></dt><dd>
The development laboratories of Lords of Lords.<br>
All players have a max life span of 100 days.<br>
Killing spree increases when it nears the new round!<br>
Newest stuff will be introduced and tested here first.<br>
</dd></dl></tr>

<tr><dl><dt><a href="/evolve/">Evolve</a></dt><dd>
The latest release of this game.
</dd></dl></tr>
<tr><dl><dt><a href="/euro/">Euro</a></dt><dd>
Was an European server converted from Meadow code to Evolve code.
</dd></dl></tr>
<tr><dl><dt><a href="/tourney/">Tourney</a></dt><dd>
Experimental with time turn based fighting system.
</dd></dl></tr>
<tr><dl><dt><a href="/history/">History</a></dt><dd>
How this game began, take a look into the past.
</dd></dl></tr>
<tr><dl><dt><a href="https://lordsoflords.net">.net</a></dt><dd>
Control your own server / world at lordsoflords.net.
</dd></dl></tr>

<tr><dl><dt><a href="/noauto/">Noauto</a></dt><dd>
Experimental No bots or auto players.<br>
Win prices here:<br>
First to level 100 Mil <br>
First Person: = 500 credz <br>
Second person: = 100 credz <br>
<br>
First to level 1 Bil <br>
First Person: = 1000 credz <br>
Second Person: = 500 credz <br>
Third person: = 100 credz <br>
<br>
First to level 5 Bil <br>
First Person: = 3 GCS <br>
Second Person: = 2 GCS <br>
Third person: = 1 GC <br>
Price allocation in any server.
</dd></dl></tr>
<?php }?>

<tr><dl><dt><a href="?description">Short description of all worlds</a></dt><dd>
Show a short description of all available variations in servers.
</dd></dl></tr>


<tr><dl><dt>What is Lords of Lords?</dt><dd>
Lords of Lords is a free online text based RPG game to be played with any internet browser.
</dd></dl></tr>

<tr><dl><dt>About Lords of Lords.</dt><dd>
No downloads required, can be played on any computer with a browser and internet connection.
</dd></dl></tr>

<tr><dl><dt><a href="/chatpeek.php?open=chatpeek&peek=m3">Chatpeek</a>.</dt><dd>
Take a look in the chat box.
</dd></dl></tr>


	</table>
</td><td align=center valign=center class=navy><h2><a href="https://lordsoflords.com/m6/signup.php">Sign up here!<br>Join M6 noW</a></h2>
</td></tr>
</table>
Still need help? Go to our <a href="https://lordsoflords.com/forums/">forums</a> and ask everything there.
<br>
<br>
<?php 
$ads_now = time();
$ads_start = gmmktime(0, 0, 0, 12, 5, 2009).' ';
$ads_end = gmmktime(0, 0, 0, 5, 6, 2010);

if ($ads_now >= $ads_start && $ads_now <= $ads_end) {
?>
We at PokerListings, the <a href="https://pokerlistings.com">online poker</a> resource guide would like to congratulate Lords of Lords for this amazing collection of RPG games and massive content base they provide with the games. One tip is to look through the <a href="https://lordsoflords.com/devlab/guides.php">guides</a> to get a good overview of the many possibilities you have within the games.
<br>
<br>
<?php 
}


?>
<a href="screenshots.php">Screenshots here!</a><br>
<?php 
mysqli_close($link);
require_once($html_footer);
?>