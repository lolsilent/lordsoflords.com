<?php 
#!/usr/local/bin/php

function clean_shit($in) {
$in=strip_tags($in);
$in=htmlentities("$in", ENT_QUOTES);
$in=htmlspecialchars("$in", ENT_QUOTES);
$in=trim($in);
$in=addslashes($in);
}

if (isset($_POST) AND !empty($_POST)) {
foreach ($_POST as $key => $val) {
	$$key = clean_shit($val);
}
}
if (isset($_GET) AND !empty($_GET)) {
foreach ($_GET as $key => $val) {
	$$key = clean_shit($val);
}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.standard.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.functions.php');

$root_url='https://lordsoflords.com/forums';

$title='Lords of Lords Forums';

$html_header=$_SERVER['DOCUMENT_ROOT'].'/AdmiN/forums/templates.header.php';
$html_footer=$_SERVER['DOCUMENT_ROOT'].'/AdmiN/forums/templates.footer.php';
$inc_functions=$_SERVER['DOCUMENT_ROOT'].'/AdmiN/forums/www.functions.php';

$inc_sfunctions=$_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.functions.php';
$inc_emotions= $_SERVER['DOCUMENT_ROOT'].'/AdmiN/array.emotions.php';

$inc_mysql= 'AdMiN/www.mysql.php';


$max_posts=1000;
$max_characters=10000;
$posting_level = 100;//exceed max characters

$files=array('index', 'forums', 'search', 'ladder', 'signup', 'login', 'logout', 'settings', 'help');
$level=array ('Member', 'Support', 'Mod', 'Cop', 'admin');
$order=array('timer','replies','views','last');

$txt_ban ='You have been jailed, banned, muted or you are trying to accessing an unauthorized area.';
?>