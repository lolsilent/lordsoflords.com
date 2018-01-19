<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/array.races.php';
include_once $clean_header;

$races_array_keys=array_keys($races_array);
sort($races_array_keys);
$maxi=100;$raced='';
if(empty($_GET['sort'])){$sort='Level';}else{$sort=clean_post($_GET['sort']);
if($sort == 'Level' or $sort == 'Exp' or $sort == 'Gold' or $sort == 'Stash'){$sort="$sort";}else{$sort='Level';}}
if(empty($_GET['i'])){$i=1;}else{$i=clean_post($_GET['i']);}

if(empty($_GET['race'])){$race='';$where='id';$racer='';}else{
if(in_array($_GET['race'],$races_array_keys)){$race=clean_post($_GET['race']);$where="race='$race'";$raced="&amp;race=$race";}else{$where='id';}}
if(!empty($_GET['page'])){$page=round(clean_post($_GET['page']));$where.=" and $sort<$page";}
?>
<table cellpadding=1 cellspacing=1 border=0>
<tr>
<th colspan="7">Top players sorted by <?php print $sort;?>, <?php 
foreach($races_array_keys as $val){
if ($race !== $val) {?> <a href="?sort=<?php print $sort;?>&amp;race=<?php print $val;?>"><?php print $val;?></a><?php }else{print ' '.$val;}
}
?></th>
</tr>
<tr>
<td align="center">#</td><td>Charname</td><td>Race</td><td><a href="?sort=Level<?php print $raced;?>">Level</a></td><td><a href="?sort=Exp<?php print $raced;?>">Exp</a></td><td><a href="?sort=Gold<?php print $raced;?>">Gold</a></td>
</tr>
<?php 
$where.=" and `Sex`!='Admin' and `Sex`!='Cop' and `Sex`!='Mod' and `Sex`!='Support'";

$link = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($link,$db_main);

if($result=mysqli_query($link, "SELECT `id`,`Guild`,`Sex`,`Charname`,`Race`,`Level`,`Exp`,`Gold`,`Stash`,`Time`,`Mute`,`Jail`,`Freeplay`,`Onoff` FROM `$tbl_members` WHERE $where ORDER BY `$sort` DESC LIMIT $maxi")){
while($iobj=mysqli_fetch_object($result)){
	$mute_timer = $iobj->Mute-$current_time;
	$jail_timer = $iobj->Jail-$current_time;

?><tr<?php if(empty($bg)){?> bgcolor="<?php print $col_th;$bg=1;?>"<?php }else{$bg='';}?>><td><?php print ($i);?></td><td nowrap><a href="members.php?info=<?php print $iobj->Charname?>"><?php if(($iobj->Freeplay-$current_time)>1){?><img src="<?php print $emotions_url;?>/star.gif" border="0" alt="Premium member"><?php }print ($iobj->Guild ? "[$iobj->Guild] ":'').$iobj->Sex.' '.$iobj->Charname;?></a><?php print $iobj->Onoff>=1?'<sup><b>Online</b></sup>':'';print $iobj->Mute-$current_time>=1?' <sup title="Def and Muted player!"><b>DM('.($mute_timer >= 1000 ?number_format($mute_timer/1000).'K':number_format($mute_timer)).')</b></sup>':'';print $iobj->Jail-$current_time>=1?' <sup><b>Jailed('.($mute_timer >= 1000 ?number_format($jail_timer/1000).'K':number_format($jail_timer)).')</b></sup>':'';?></td><td><?php print $iobj->Race;?></td><td><?php print number_format($iobj->Level);?></td><td><?php print lint($iobj->Exp);?></td><td><?php print lint($iobj->Gold+$iobj->Stash);?></td></tr>
<?php $i++;$page=$iobj->$sort;
}
mysqli_free_result($result);
}

mysqli_close($link);

if($i<=901 and !empty($page) and $i>=$maxi){?>
<tr><th colspan="6"><a href="?sort=<?php print $sort;?>&amp;i=<?php print $i;?>&amp;page=<?php print $page;?><?php print $raced;?>"><?php print $i.'-'.($i+99);?></a></th></tr>
<?php }?></table><br>Players with a <img src="<?php print $emotions_url;?>/star.gif" border="0" alt="Premium member"> in front of their name are supporting this game with donations.
<br><br>
<b>[ <a href="<?php print $root_url; ?>/historys.php">History ladder</a> ] [ <a href="<?php print $root_url; ?>/charmss.php">Charms ladder</a> [ <a href="<?php print $root_url; ?>/guildss.php">Guilds ladder</a> ]</b><br>
<?php 
include_once $clean_footer;
?>