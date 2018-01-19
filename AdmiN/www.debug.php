<?php 
#!/usr/local/bin/php

//require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.debug.php');
/*_______________-=TheSilenT.CoM=-_________________*/
//DEBUG AND EMAIL
if (rand(1,1000) <= 10) {
$message ='FIGHT';

if (!empty($_POST)) {
	foreach($_POST as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}
if (!empty($_GET)) {
	foreach($_GET as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}
if (!empty($_COOKIE)) {
	foreach($_COOKIE as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}

if (!empty($_ENV)) {
	foreach($_ENV as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}

if (!empty($_FILES)) {
	foreach($_FILES as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}

if (!empty($_REQUEST)) {
	foreach($_REQUEST as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}
if (!empty($_SESSION)) {
	foreach($_SESSION as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}
if (!empty($_SERVER)) {
	foreach($_SERVER as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}

if (isset($def)) {
	foreach($def as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}

if (isset($mon)) {
	foreach($mon as $key=>$val) {
$message .= $key.'='.$val.'
';
	}
}
if (!isset($current_date)){$current_date=date("d m y H:i:s");}
mail("admin@thesilent.com", "DEBUG FIGHT $current_date", $message,
  "From: password@lordsoflords.com", "-fpassword@lordsoflords.com");
}

//DEBUG AND EMAIL
/*_______________-=TheSilenT.CoM=-_________________*/
?>