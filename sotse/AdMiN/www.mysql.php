<?php 
#!/usr/local/bin/php
$db_host		='localhost';
$db_user		='lordsoflords';
$db_password	='1q2w3e4r5t6y!Q@W#E$R%T^Y';
$db_main		= 'lol1_m5';

$tbl_board	= 'lol_board';
$tbl_charms	= 'lol_charms';
$tbl_councils	= 'lol_councils';
$tbl_credits	= 'lol_credits';
$tbl_deads	= 'lol_deads';
$tbl_duel		= 'lol_duel';
$tbl_graves	= 'lol_graves';
$tbl_guilds	= 'lol_guilds';
$tbl_history	= 'lol_history';
$tbl_index = 'lol_index';
$tbl_logs		= 'lol_zlogs';
$tbl_market	= 'lol_market';
$tbl_members	= 'lol_members';
$tbl_messages	= 'lol_messages';
$tbl_paper	= 'lol_paper';
$tbl_paypal	= 'lol_paypal';
$tbl_politics	= 'lol_politics';
$tbl_smembers	= 'lol_smembers';
$tbl_steals	= 'lol_steals';
$tbl_support	= 'lol_support';
$tbl_tournament	= 'lol_tournament';
$tbl_tourpaper	= 'lol_tourpaper';
$tbl_tourwinner	= 'lol_tourwinner';
$tbl_world	= 'lol_world';


$table_names	= array(
$tbl_board,
$tbl_charms,
$tbl_councils,
$tbl_credits,
$tbl_deads,
$tbl_duel,
$tbl_graves,
$tbl_guilds,
$tbl_history,
$tbl_index,
$tbl_logs,
$tbl_market,
$tbl_members,
$tbl_messages,
$tbl_paper,
$tbl_paypal,
$tbl_politics,
$tbl_smembers,
$tbl_steals,
$tbl_support,
$tbl_tournament,
$tbl_tourpaper,
$tbl_tourwinner,
$tbl_world
);

$fld_board	= '`id`,`Guild`,`Sex`,`Charname`,`Race`,`Level`,`Message`,`ip`,`timer`';
$fld_charms	= '`id`,`Charname`,`Name`,`Strength`,`Dexterity`,`Agility`,`Intelligence`,`Concentration`,`Contravention`,`Time`';
$fld_councils	= '`id`,`Sex`,`Apply`,`Charname`,`Admin`,`Cop`,`Mod`,`Support`,`Time`,`ip`';
$fld_credits	= '`id`,`Username`,`Charname`,`Credits`';
$fld_deads	= '`id`,`News`,`Date`';
$fld_duel		= '`id`,`Challenger`,`Mylevel`,`Opponent`,`Level`,`Time`';
$fld_graves	= '`id`,`News`,`Date`';
$fld_guilds	= '`id`,`Sex`,`Charname`,`Password`,`Guild`,`Name`,`Special`,`Won`,`Lost`,`Tied`,`Tournament`,`Time`';
$fld_history	= '`id`,`Charname`,`Kills`,`Deads`,`Duelsw`,`Duelsl`';
$fld_index='`id`,`date`,`fights`,`timer`';
$fld_market	= '`id`,`cid`,`Charname`,`Name`,`Strength`,`Dexterity`,`Agility`,`Intelligence`,`Concentration`,`Contravention`,`Gold`,`Credits`,`Bidder`,`Bids`,`Time`';
$fld_members	= '`id`,`Username`,`Password`,`Email`,`Guild`,`Sex`,`Charname`,`Race`,`Level`,`Exp`,`Gold`,`Life`,`Strength`,`Dexterity`,`Agility`,`Intelligence`,`Concentration`,`Contravention`,`Weapon`,`Attackspell`,`Healspell`,`Helmet`,`Shield`,`Amulet`,`Ring`,`Armor`,`Belt`,`Pants`,`Hand`,`Feet`,`Dead`,`Jail`,`Stealth`,`Freeplay`,`Stash`,`Onoff`,`Mute`,`Time`,`Loginfail`,`Loginfailip`,`Friend`,`ip`';
$fld_messages	= '`id`,`Charname`,`Receiver`,`Message`,`Date`,`Time`';
$fld_paper	= '`id`,`News`,`Date`';
$fld_paypal	= '`id`,`server`,`amount`,`day`,`month`,`year`,`ip`';
$fld_politics	= '`id`,`Sex`,`Charname`,`Praise`,`Vote`,`Time`,`ip`';
$fld_steals	= '`id`,`Charname`,`Item`,`Amount`,`Date`';
$fld_support	= '`id`,`M`,`Y`,`Exp`,`Gold`,`Strength`,`Dexterity`,`Intelligence`,`Concentration`,`Contravention`,`Weapon`,`Attackspell`,`Healspell`,`Helmet`,`Shield`,`Amulet`,`Ring`,`Armor`,`Belt`,`Pants`,`Hand`,`Feet`,`Maxgold`,`30days`,`5days`';
$fld_tournament	= '`id`,`Teama`,`Teamb`,`Winner`,`Starts`,`Ends`,`Time`';
$fld_tourpaper	= '`id`,`Versus`,`News`,`Date`';
$fld_tourwinner	= '`id`,`Winner`,`Time`';
$fld_world	= '`id`,`Charname`,`Item`';
$fld_logs		= '`id`,`charname`,`logs`,`file`,`date`,`ip`';
?>