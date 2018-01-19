<?php 
#!/usr/local/bin/php
$db_host		='localhost';
$db_user		='lordsoflords';
$db_password	='1q2w3e4r5t6y!Q@W#E$R%T^Y';
$db_main = 'lordsoflords_com';


$tbl_bio = 'lofl_bio';
$tbl_gts = 'lofl_gts';
$tbl_guides = 'lofl_guides';
$tbl_news = 'lofl_news';
$tbl_servers = 'lofl_servers';

$table_names=array($tbl_bio,$tbl_gts,$tbl_guides,$tbl_news,$tbl_servers);

$fld_bio = '`id`,`oke`,`info`,`timer`';
$fld_gts = '`id`,`logs`,`timer`';
$fld_guides = '`id`,`version`,`cat`,`sub`,`date`,`news`,`timer`';
$fld_news = '`id`,`nid`,`date`,`news`,`timer`';
$fld_servers = '`id`,`server`,`players`,`alive`,`sdate`,`timer`';

$array_dbs = array(
/*
'Meadow' => 'lol1_meadow',
'Meadow2' => 'lol1_meadow2',

'Eidolon' => 'lol1_eidolon',
'Xedon' => 'lol1_xedon',

'Duel' => 'lol1_duel',
'Devlab' => 'lol1_devlab',
'Euro' => 'lol1_euro',
'Evolve' => 'lol_evolve',

'Noauto' => 'lol_noauto',

'History' => 'lol1_history',
'Tourney' => 'lol_tournament',
'Ysomite' => 'lol2_ysomite',
'Shadow' => 'lol3_shadow',
'Shadow2' => 'lol3_shadow2',
*/

'm3' => 'lol1_m3',
'SotSE' => 'lol1_m5',
'm6' => 'lol1_m6',
);
?>