<?php 
#!/usr/local/bin/php
$base_url='';
?><html><head><title>Lords of Lords<?php print (isset($server)?' '.$server:'');?></title><meta name="description" content="Lords of Lords is a free online text-based massive role playing game (RPG) that can be played anywhere on whatever computer or system that has a browser and web access. Only nice people are welcome no bad peoples!"><meta name="keywords" content="free online RPG, text based RPG, lords of lords, browser rpg"><link rel="stylesheet" type="text/css" href="/script.php?css"><link rel="shortcut icon" path="/favicon.ico"></head><body><center><table width=100%><tr><th><a href="<?php print $base_url;?>/index.php" title="Homepage!">Home</a></th><th><a href="<?php print $base_url;?>/news.php" title="Latest news.">News</a></th><th><a href="<?php print $base_url;?>/stats.php" title="Server statistics.">Stats</a></th><th><a href="<?php print $base_url;?>/server.php" title="Server health!">Server</a></th><th><a href="<?php print $base_url;?>/forums/" title="Game forums.">Forums</a></th><th><a href="https://lordsoflords.net">.NET</a></th></tr></table>

<a href="<?php print $base_url;?>/"><img src="/images/lordsoflords2.jpg" width="436" height="46" border="0" title="Free online text-based RPG games" alt="Free online text-based RPG games"></a><span class=served><?php print (isset($server)?' '.$server:'');?></span><br>

<table width=100%><tr><td valign=top width=100 align=center><?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.nav-static.php');
?></td><td align=center valign=top>