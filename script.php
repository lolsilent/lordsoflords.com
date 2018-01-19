<?php 
#!/usr/local/bin/php

require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/function.validate_referer.php');
validate_referer();

if (isset($_GET['float'])) {
include_once $_SERVER['DOCUMENT_ROOT'].'/AdmiN/script.float.php';
}

if (isset($_GET['snow'])) {
include_once $_SERVER['DOCUMENT_ROOT'].'/AdmiN/script.snow.php';
}

if (isset($_GET['xtimer'])) {
include_once $_SERVER['DOCUMENT_ROOT'].'/AdmiN/script.xtimer.php';
}

if (isset($_GET['resourcer'])) {
include_once $_SERVER['DOCUMENT_ROOT'].'/AdmiN/script.resourcer.php';
}

if (isset($_GET['css'])) {
include_once $_SERVER['DOCUMENT_ROOT'].'/AdmiN/script.css.php';
}


?>