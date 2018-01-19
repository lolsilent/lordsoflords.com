<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
include_once($html_header);
if(!empty($_GET['invoice'])){
require_once($inc_mysql);
require_once($inc_functions);

$invoice = clean_post($_GET['invoice']);

$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);


foreach ($array_dbs as $key => $val) {

mysqli_select_db($link,$val) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

$table = 'lol_paypal';if($key == 'Ysomite'){$table = 'lol2_paypal';}elseif($key == 'Shadow' or $key == 'Shadow2'){$table = 'lol3_paypal';}

if ($result = mysqli_query($link, "SELECT * FROM `$table` WHERE `server`='$invoice' LIMIT 1")) {
if($row = mysqli_fetch_object($result)){

echo "
Invoice Date : $row->day / $row->month / $row->year<br>
Invoice ID: $row->id<br>
Invoice Number: $row->server<br>
Game Account: $row->ip<br>
Game Server: $key<br>
Tax: $0.00<br>
Payment Amount: $ $row->amount.00<br>
";
mysqli_free_result($result);
break;
}
}

}

if(empty($row->server)){
?>Unknown or no invoice number or the payment has been refunded.<?php 
}

mysqli_close($link);
}else{

?>Unknown or no invoice number or the payment has been refunded.<?php 

}
?><br>
<form>Paypal Transaction ID:<input type=text name=invoice><input type=submit></form><?php 
include_once($html_footer);
?>