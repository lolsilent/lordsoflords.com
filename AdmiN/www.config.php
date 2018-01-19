<?php 
#!/usr/local/bin/php
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.standard.php');
$title = 'Free online text based RPG game LORDS OF LORDS';

$html_footer = $_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.footer.php';
$html_header = $_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.header.php';
$inc_ffunctions= $_SERVER['DOCUMENT_ROOT'].'/AdmiN/forums/www.functions.php';

$inc_functions= $_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.functions.php';
$inc_emotions= $_SERVER['DOCUMENT_ROOT'].'/AdmiN/array.emotions.php';
$inc_mysql= $_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.mysql.php';

//$array_servers = array('meadow','meadow2','eidolon','xedon','duel','devlab','evolve','euro','noauto','shadow','shadow2','tourney','history');
$array_servers = array('duel','devlab','evolve','euro','noauto','tourney');
?>