<?php 
#!/usr/local/bin/php
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.mysql.php');
if(!isset($current_time)){$current_time=time();}
if(!isset($col_th)){$col_th='#123456';}
if(!isset($server)){$server='';}
if($server == 'MeadowII'){$server ='Meadow2';}
if($server == 'ShadowII'){$server ='Shadow2';}
$active_players=3;
?>

<table cellpadding=2 cellspacing=2 border=0 width=450>
<tr><th colspan=2>Games with at least <?php print $active_players;?> active players now!</th></tr>
<tr><th>World</th><th>Players Online</th></tr>

<?php 
$tot_online=0;

$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);
mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

foreach ($array_dbs as $key=>$val) {

$table_name = preg_replace("/_.*?$/i","",$val);
$table_name = preg_replace("/1/i","",$table_name);
$table_name = $table_name.'_members';
mysqli_select_db($link,$val);

$online=0;
if($oresult = mysqli_query($link, "SELECT `id` FROM `$table_name` WHERE `time`>=$current_time-1000 ORDER BY `id` DESC")){
if($online = mysqli_num_rows($oresult)){mysqli_free_result($oresult);}
}else{if($oresult = mysqli_query($link, "SELECT `id` FROM `$table_name` WHERE `timer`>=$current_time-1000 ORDER BY `id` DESC")){
if($online = mysqli_num_rows($oresult)){mysqli_free_result($oresult);}
}}

$tot_online+=$online;

if($online >= $active_players or $server == $key){
if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor='';}
?><tr<?php print $bgcolor;?>><td align=center nowrap><?php if ($server == $key) {print '<b>'.$key.'<b><font size=-1 color=red><sup>You are here!</sup></font>';} else {?><a href="https://lordsoflords.com/<?php print strtolower($key);?>/" tile="Go to this world!"><?php print $key;?></a><?php }?></td><td align=center><b><?php print number_format($online);?></b></td></tr><?php 
}

}


mysqli_close($link);

?><tr><th nowrap colspan=2><a href="https://lordsoflords.com" title="For more game worlds, overview and stats click here.">There are <?php print number_format($tot_online);?> players online.</a></th></tr>
</table>

