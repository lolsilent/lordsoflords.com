<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.validate.php';

validate_referer();

if (isset($_GET['xtimer'])) {
include_once 'AdMiN/script.xtimer.php';
}

if (isset($_GET['float'])) {
include_once 'AdMiN/script.float.php';
}
?>