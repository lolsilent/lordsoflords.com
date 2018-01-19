<?php 
#!/usr/local/bin/php


$allow_HTTP_REFERER =array(
			"https://thesilent.com/",
			"https://thesilent.com/",
			"https://lordsoflords.com/",
			"https://lordsoflords.com/",
			"https://localhost/",
			);

$allow_SERVER_ADDR =array(
			'75.125.201.106',
			'127.0.0.1',
			);

function validate_referer () {global $allow_SERVER_ADDR,$allow_HTTP_REFERER;
if (empty($_SERVER['HTTP_REFERER'])) {header("Location: https://thesilent.com");exit;}
if (!in_array($_SERVER['SERVER_ADDR'],$allow_SERVER_ADDR)) {header("Location: https://thesilent.com");exit;}
foreach ($allow_HTTP_REFERER as $val) {
$val = addslashes($val);
if (!preg_match("@^$val@si",$_SERVER['HTTP_REFERER'])) {$nogo=1;}
}
if (empty($nogo)) {header("Location: https://thesilent.com");exit;}
}
?>