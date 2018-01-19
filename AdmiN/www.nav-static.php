<?php 
$base_url='';
$array_servers = array('duel','devlab','evolve','euro','noauto','tourney');
if (!isset($server)) {
	$server='';
}
$t_servers = array(
'meadow'=>array('index','signup','login','ladder','guilds','faq','rules','guide','donate'),
'meadowII'=>array('index','signup','login','ladder','guilds','faq','rules','guide','donate'),
'm3'=>array('index','signup','login','ladder','guilds','faq','rules','guide','donate'),
'm6'=>array('index','signup','login','ladder','guilds','faq','rules','guide','donate'),
'sotse'=>array('index','signup','login','ladder','guilds','faq','rules','guide','donate'),
'eidolon'=>array('index','signup','login','ladder','guilds','faq','rules','guide','donate'),
'xedon'=>array('index','signup','login','ladder','guilds','faq','rules','guide','donate'),
'',
'duel'=>array('index','signup','login','ladder','clans','guides','donate','','paper','duels','graves','matches','chats','logs'),
'devlab'=>array('index','signup','login','ladder','clans','guides','donate','','paper','duels','graves','matches','chats','logs'),
'evolve'=>array('index','signup','login','ladder','clans','guides','donate','','paper','duels','graves','matches','chats','logs'),
'euro'=>array('index','signup','login','ladder','clans','guides','donate','','paper','duels','graves','matches','chats','logs'),
'noauto'=>array('index','signup','login','ladder','clans','guides','donate','','paper','duels','graves','matches','chats','logs'),
'',
'ysomite'=>array('index','signup','login','ladder','guide'),
'',
'shadow'=>array('index','signup','login','ladder','guide'),
'shadowII'=>array('index','signup','login','ladder','guide'),
'',
'tourney'=>array('index','signup','login','ladder'),
'history'=>array('index','signup','login','ladder'),
'rpgtext'=>array('index','signup','login','classes','ladder','screenshots','items','stuff'),
);
?>
<table width=100%><tr><th>Worlds</th></tr><tr><td valign=top class=navy>
<?php 

/*_______________-=TheSilenT.CoM=-_________________*/
$active_servers = array('m3','m6','sotse');
/*_______________-=TheSilenT.CoM=-_________________*/

foreach ($t_servers as $key => $val) {
if (in_array($key,$active_servers) or strtolower($server) == strtolower($key)) {
	$wkey = preg_replace("/II/","2",$key);
	if (empty($val)) {
print '<br>';
	}else{

if (isset($server) and strtolower($server) == strtolower($key)) {
		print ucfirst($wkey);
	}else{
print '<a href="'.$base_url.'/'.$wkey.'/" title="Open '.ucfirst($wkey).'!">'.ucfirst($wkey).'</a>';
	}

if ($key == 'm3' and date("Y") == 2009) {
	print ' <sup>NEW</sup>';
}
if ($key == 'sotse' and date("Y") == 2014) {
	print ' <sup>NEW</sup>';
}
if ($key == 'm6' and date("Y") == 2017) {
	print ' <sup>NEW</sup>';
}
print '<br>';

if (isset($server) and strtolower($server) == strtolower($key)) {
	print '<ul id="inav">';
	foreach ($val as $ival) {
		if (empty($ival)) {
			print '<li> </li>';
		}else{
			$selfer="/$wkey/$ival.php";
if ($_SERVER['PHP_SELF'] == $selfer and !preg_match("/^shadow/i",$key)) {
	print '<li>'.ucfirst($ival).'</li>';
}else{
if (preg_match("/^shadow/i",$key)) {
print '<li><a href="'.$base_url.'/'.$wkey.'/index.php?open='.$ival.'">'.ucfirst($ival).'</a></li>';
}else{
print '<li><a href="'.$base_url.'/'.$wkey.'/'.$ival.'.php">'.ucfirst($ival).'</a></li>';
}
}
		}
	}//foreachs
	print '</ul>';
}
	}
}//inactive??
}//foreach
?>
<br>
<a href="https://lordsoflords.net" title="Go to lordsoflords.net!">.NET</a></td></tr><?php /*<tr><th>LogiN</th></tr><tr><td valign=top class=navy>

<form method=post enctype="application/x-www-form-urlencoded" target="_top" action="<?php print $base_url;?>/login.php"><input type=text size=10 name="username" value="<?php print isset($_COOKIE['username'])?$_COOKIE['username']:'username';?>" maxlength=10 class=fillup>
<input type=password size=10 name="password" maxlength=50 value="<?php print isset($_COOKIE['username'])?'':'';?>" class=fillup>
<select name="iserver" class=fillup><?php foreach ($array_servers as $val) {
$selected='';
if (isset($_COOKIE['iserver'])) {
	if ($_COOKIE['iserver'] == $val) {
		$selected =' selected';
	}
}
	print '<option value="'.$val.'"'.$selected.'>'.ucfirst($val).'</option>';}?></select><input type=submit value="Play!" class=fillup name=Action>
</form>
</td></tr>*/?><tr><th><b>Tools</b></th></tr><tr><td valign=top class=navy width=120>
<a href="<?php print $base_url;?>/chatpeek.php" title="Peek in the chat.">Chat peek</a><br>

<a href="<?php print $base_url;?>/hof.php" title="The world ladder, Hall of Fame, The best of the best.">Hall of Fame</a><br>
<a href="<?php print $base_url;?>/first.php" title="The oldest and the youngest chars of this game!">First</a><br>
<a href="<?php print $base_url;?>/hcm.php" title="The High Council Members(HCM) of Lords of Lords">High Council</a><br>
<br>

<a href="<?php print $base_url;?>/credits.php" title="Credits calculator.">Credits</a><br>
<a href="<?php print $base_url;?>/gps.php" title="Global Player Seeker.">GPS</a><br>
<a href="<?php print $base_url;?>/gts.php" title="Global Teleportation Service.">GTS</a><br>
<br>

<a href="<?php print $base_url;?>/linkus.php" title="Banners for making a link to us!">Linkus</a><br>
<a href="<?php print $base_url;?>/cookies.php" title="Cookie information, delete your cookies.">Cookies</a><br>
</td></tr></table>
<?php 
/*
if ($_SERVER['REMOTE_ADDR'] == '82.168.14.99') {
print $_SERVER['PHP_SELF'].'--'.$selfer;
}
*/
?>