<tr>
<th>Welcome to Lords of Lords</th>
</tr>

<tr><td>

<table width=100% cellpadding=1 cellspacing=1 border=0>

<?php 
#!/usr/local/bin/php


//SERVERDOWN
$server_down=array();
//SERVERDOWN


$tot_players=0;
$tot_alive=0;
$tot_online=0;

require_once 'AdmiN/www.mysql.php';
$link = mysqli_connect($db_host, $db_user, $db_password) or die('Connection failed.');
$battles=0;
foreach ($array_dbs as $key=>$val) {

if ($val == 'title') {print '<tr bgcolor="#345678"><td>'.$key.'</td><td> </td><td align="right" NOWRAP>Players</td><td align="right" NOWRAP>Alive</td><td align="right" NOWRAP>Online</td></tr>';} else {
$table_name = preg_replace("/_.*?$/i","",$val);
$table_name = preg_replace("/1/i","",$table_name);
$table_name = $table_name.'_members';
mysqli_select_db($link,$val, $link);

if($fresult=mysqli_query($link, "SELECT * FROM `lol_index` WHERE `date`='".date('m d Y')."' ORDER BY `id` DESC LIMIT 1")){
if($fobj=mysqli_fetch_object($fresult)){
$battles+=$fobj->fights;
mysqli_free_result($fresult);
}
}

$result = mysqli_query($link, "SELECT id FROM $table_name WHERE id ORDER BY id DESC", $link);
if ($result and !in_array($key,$server_down)) {
$alive = mysqli_num_rows($result);
$srow = mysqli_fetch_object($result);
mysqli_free_result ($result);

if($oresult = mysqli_query($link, "SELECT id FROM $table_name WHERE Time>=$current_time-1000 ORDER BY id DESC", $link)){
$online = mysqli_num_rows($oresult);
mysqli_free_result ($oresult);
}else{
if($oresult = mysqli_query($link, "SELECT id FROM $table_name WHERE timer>=$current_time-1000 ORDER BY id DESC", $link)){
$online = mysqli_num_rows($oresult);
mysqli_free_result ($oresult);
}else{$online=0;}}

?>
<tr><td NOWRAP><a href="<?php print $root_url.'/'.strtolower($key);?>" title="Travel to <?php print $key;?>!"><?php print $key;?></a></td><td><font size=1><?php 
if($key == 'History' or $key == 'Evolve'){//nothing
}elseif($key !== 'Duel' and $key !== 'Shadow' and $key !== 'Shadow2'){
?> <a href="/<?php print strtolower($key);?>/">index</a> <a href="/<?php print strtolower($key);?>/signup.php">signup</a> <a href="/<?php print strtolower($key);?>/login.php">login</a> <a href="/<?php print strtolower($key);?>/ladder.php">ladder</a><?php 
if($key !== 'Ysomite'){?> <a href="/<?php print strtolower($key);?>/guilds.php">guilds</a><?php }
}else{
?> <a href="/<?php print strtolower($key);?>/index.php?open=index">index</a> <a href="/<?php print strtolower($key);?>/index.php?open=signup">signup</a> <a href="/<?php print strtolower($key);?>/index.php?open=login">login</a> <a href="/<?php print strtolower($key);?>/index.php?open=ladder">ladder</a><?php 
if($key !== 'Shadow' and $key !== 'Shadow2'){?> <a href="/<?php print strtolower($key);?>/index.php?open=guilds">guilds</a><?php }
}
?></font></td>
<td align="right" NOWRAP><?php print number_format($srow->id);?></td>
<td align="right" NOWRAP><?php print number_format($alive);?></td>
<td align="right" NOWRAP><?php print number_format($online);?></td>
<?php 
$tot_players+=$srow->id;
$tot_alive+=$alive;
$tot_online+=$online;
} else {
print "<tr><td bgcolor=\"#FF0000\" colspan=\"6\">$key is down for maintenance.</td></tr>";
}
}

} //foreach

mysqli_close($link);
?>
</table>

<br>
From the beginning <b><?php print number_format($tot_players);?></b> warriors and wizards has tried our adventure!
<br>
Only <b> <?php print number_format($tot_alive);?></b> of them are still alive, how long can you handle the evil!
<br>
Within this <?php print date('G');?> hours and <?php print date('i');?> minutes there has been <b><?php echo number_format($battles);?></b> monsters killed and duels fought out.
<br>
At this moment there are <b><?php print number_format($tot_online);?></b> lords or ladies in our worlds.<br>
<br>

<br>
<b>H</b>elp me! <b>W</b>here should I go to? <b>H</b>ow do I start quick!
<br>
<br>
<b>N</b>ew here? Beginners should try this easy game <a href="<?php print $root_url;?>/meadow2" target="_top">MeadowII</a> main server of LoL1.
<br>
<b>F</b>or more advanced game playing you should try <a href="<?php print $root_url;?>/shadow2" target="_top">ShadowII</a> main server of LoL3.
<br>
<a href="<?php print $root_url;?>/evolve" target="_top"><b>E</b>volve</a> is the latest release of this game.<br>
<p>

</td></tr>