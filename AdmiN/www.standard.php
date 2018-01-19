<?php 
#!/usr/local/bin/php
$sroot_url = $_SERVER['DOCUMENT_ROOT'];
$images_url='/images';
$emotions_url='/images/emotions';

$admin_name='Admin SilenT';
$admin_email='admin@thesilent.com';
$error_email='error@thesilent.com';
$notify_url='https://thesilent.com/paypal/index.php';
$paypal_email='paypal@thesilent.com';

function microtime_float(){list($usec, $sec) = explode(" ", microtime());return ((float)$usec + (float)$sec);}
$current_time=microtime_float();
$current_date = date('d M Y');
$current_clock = date('H:i:s');
$logdate=date('d-m-Y');

$punished_sex=array('BeggaR','UntrusT','DangeR','SpammeR','CriminaL');
$sap=array('+','-','*','/');

$col_bg='#000000';
$col_text='#FFFFFF';
$col_link='#FFF888';
$col_hover='#AAA555';
$col_table='#FFFFFF';
$col_th='#123456';
$col_form='#'.date('Hi').'55';//print date('Hi');
$col_frame="#4567EE";
$font_family='Verdana,Arial,Monaco';
$font_size='10pt';

$ip=$_SERVER['REMOTE_ADDR'];if(empty($ip)){header("Location: $sroot_url");}

//some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);
function some_error($in){
global $error_email,$server,$admin_email,$_POST,$_GET;
$in = $_SERVER['PHP_SELF'];
mail($error_email, "SERVER $server ERROR $in", "$in", "From: $admin_email", "-f$admin_email");
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/some_error.php');
exit;
}
?>