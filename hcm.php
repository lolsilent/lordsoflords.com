<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_mysql);
require_once($html_header);

$bestof = 100;
$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

?><table width=100%><tr><th colspan=2>The High Council Members(HCM)<br>Thanks to the HCM players this game there should be far less foul language, spammers and scammers!</th></tr><tr><th>Player</th><th>Level</th></tr><?php 

$i=0;
foreach ($array_dbs as $key=>$val) {
$no=1;
$table_name = preg_replace("/_.*?$/i","",$val);
$table_name = preg_replace("/1/i","",$table_name);
$table_name = $table_name.'_members';
mysqli_select_db($link,$val);

print '<tr><th colspan=4>The HCM of '.$key.'</th></tr>';

$presult = mysqli_query($link, "SELECT * FROM `$table_name` WHERE (`sex`='Admin' or `sex`='Cop' or `sex`='Mod' or `sex`='Support') and `id`>'1' ORDER BY `Level` DESC LIMIT $bestof");

		if($i<= 4){
if($presult){
while ($srow = mysqli_fetch_object($presult)){
print '<tr><td>'.$no.'. '.$srow->Sex.' '.$srow->Charname.'</td><td>'.number_format($srow->Level).'</td></tr>';
$no++;}
mysqli_free_result($presult);
}
		}else{
if($key == 'Ysomite'){
$presult = mysqli_query($link, "SELECT * FROM `lol2_members` WHERE (`sex`='Admin' or `sex`='Cop' or `sex`='Mod' or `sex`='Support') and `id`>'1' ORDER BY `level` DESC LIMIT $bestof");
if($presult){
while ($srow = mysqli_fetch_object($presult)){
print '<tr><td>'.$no.'. '.$srow->charname.'</td><td>?</td></tr>';
$no++;}
mysqli_free_result($presult);
}
}else{
$presult = mysqli_query($link, "SELECT * FROM `$table_name` WHERE (`sex`='Admin' or `sex`='Cop' or `sex`='Mod' or `sex`='Support') and `id`>'1' ORDER BY `level` DESC LIMIT $bestof");
if($presult){
while ($srow = mysqli_fetch_object($presult)){
print '<tr><td>'.$no.'. '.$srow->sex.' '.$srow->charname.'</td><td>'.number_format($srow->level).'</td></tr>';
$no++;}
mysqli_free_result($presult);
}
}
		}

$i++;
}

?></table><?php 




mysqli_close($link);
require_once($html_footer);
?>