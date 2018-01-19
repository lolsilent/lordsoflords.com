<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_mysql);
require_once($html_header);

$bestof = 3;
$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

?><table width=100%><tr><th colspan=7>The oldest and the youngest chars of this game!</th></tr><tr><th>Old/New</th><th>World</th><th>Signup ID</th><th>Sex</th><th>Charname</th><th>Level</th><th>Race</th></tr><?php 



$i=0;
foreach ($array_dbs as $key=>$val){
mysqli_select_db($link,$val);


if($i<=4){
if ($cresult = mysqli_query($link, "SELECT * FROM `lol_members` WHERE `id`>'1' ORDER BY `id` ASC LIMIT 1")) {
if ($crow = mysqli_fetch_object($cresult)) {
print '<tr bgcolor='.$col_th.'><td>Oldest</td><td>'.$key.'</td><td>'.$crow->id.'</td><td>'.$crow->Sex.'</td><td>'.$crow->Charname.'</td><td>'.number_format($crow->Level).'</td><td>'.$crow->Race.'</td></tr>';
mysqli_free_result($cresult);
}
}
if ($cresult = mysqli_query($link, "SELECT * FROM `lol_members` WHERE `id`>'1' ORDER BY `id` DESC LIMIT 1")) {
if ($crow = mysqli_fetch_object($cresult)) {
print '<tr><td>Latest</td><td>'.$key.'</td><td>'.$crow->id.'</td><td>'.$crow->Sex.'</td><td>'.$crow->Charname.'</td><td>'.number_format($crow->Level).'</td><td>'.$crow->Race.'</td></tr>';
mysqli_free_result($cresult);
}
}
}elseif($i>=4 and $i<=9){
if ($cresult = mysqli_query($link, "SELECT * FROM `lol_members` WHERE `id`>'1' ORDER BY `id` ASC LIMIT 1")) {
if ($crow = mysqli_fetch_object($cresult)) {
print '<tr bgcolor='.$col_th.'><td>Oldest</td><td>'.$key.'</td><td>'.$crow->id.'</td><td>'.$crow->sex.'</td><td>'.$crow->charname.'</td><td>'.number_format($crow->level).'</td><td>'.$crow->race.'</td></tr>';
mysqli_free_result($cresult);
}
}
if ($cresult = mysqli_query($link, "SELECT * FROM `lol_members` WHERE `id`>'1' ORDER BY `id` DESC LIMIT 1")) {
if ($crow = mysqli_fetch_object($cresult)) {
print '<tr><td>Latest</td><td>'.$key.'</td><td>'.$crow->id.'</td><td>'.$crow->sex.'</td><td>'.$crow->charname.'</td><td>'.number_format($crow->level).'</td><td>'.$crow->race.'</td></tr>';
mysqli_free_result($cresult);
}
}
}elseif($i>=10 and $i<=10){
if ($cresult = mysqli_query($link, "SELECT * FROM `lol2_members` WHERE `id`>'1' ORDER BY `id` ASC LIMIT 1")) {
if ($crow = mysqli_fetch_object($cresult)) {
print '<tr bgcolor='.$col_th.'><td>Oldest</td><td>'.$key.'</td><td>'.$crow->id.'</td><td> . </td><td>'.$crow->charname.'</td><td> . </td><td>'.$crow->race.'</td></tr>';
mysqli_free_result($cresult);
}
}
if ($cresult = mysqli_query($link, "SELECT * FROM `lol2_members` WHERE `id`>'1' ORDER BY `id` DESC LIMIT 1")) {
if ($crow = mysqli_fetch_object($cresult)) {
print '<tr><td>Latest</td><td>'.$key.'</td><td>'.$crow->id.'</td><td> . </td><td>'.$crow->charname.'</td><td> . </td><td>'.$crow->race.'</td></tr>';
mysqli_free_result($cresult);
}
}
}elseif($i>=11 and $i<=12){
if ($cresult = mysqli_query($link, "SELECT * FROM `lol3_members` WHERE `id`>'1' ORDER BY `id` ASC LIMIT 1")) {
if ($crow = mysqli_fetch_object($cresult)) {
print '<tr bgcolor='.$col_th.'><td>Oldest</td><td>'.$key.'</td><td>'.$crow->id.'</td><td>'.$crow->sex.'</td><td>'.$crow->charname.'</td><td>'.number_format($crow->level).'</td><td>'.$crow->class.'</td></tr>';
mysqli_free_result($cresult);
}
}
if ($cresult = mysqli_query($link, "SELECT * FROM `lol3_members` WHERE `id`>'1' ORDER BY `id` DESC LIMIT 1")) {
if ($crow = mysqli_fetch_object($cresult)) {
print '<tr><td>Latest</td><td>'.$key.'</td><td>'.$crow->id.'</td><td>'.$crow->sex.'</td><td>'.$crow->charname.'</td><td>'.number_format($crow->level).'</td><td>'.$crow->class.'</td></tr>';
mysqli_free_result($cresult);
}
}
}

$i++;
}



?></table>Oldest accounts are the oldest player chars that are still alive and not ever been killed yet. The latest are the just new arrived players in that world.<?php 


mysqli_close($link);
require_once($html_footer);
?>