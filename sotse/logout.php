<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/www.functions.php';

if (isset($_COOKIE['lol_Charname'])) {
$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");

$cookie_username=$_COOKIE['lol_Username'];
$cookie_charname=$_COOKIE['lol_Charname'];

if($result = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `Username`='$cookie_username' and Charname`='$cookie_charname' ORDER BY `Onoff` DESC LIMIT 1")){
if($row = mysqli_fetch_object ($result)){
mysqli_free_result ($result);
if ($cookie_username == $row->Username and $cookie_charname == $row->Charname) {
mysqli_query($link, "UPDATE `$tbl_members` SET `Onoff`='0' WHERE `id`='$row->id' LIMIT 1");

$current_second = date("s");
	//print $current_second;
if($current_second >= 10 and $current_second <= 15 || $current_second >= 30 and $current_second <= 35 || $current_second >= 50 and $current_second <= 55){
	//print $current_second;
foreach ($table_names as $tnames) {
mysqli_query($link, "OPTIMIZE TABLE $tnames");
}
}

}
}
}

setcookie ("lol_Session", "1",time()-5) or die("$error_message");

include_once("$html_header");
?>
Thanks for playing <?php echo $title; ?>. Hope to see you back again. You have been logged out successfully.
<br><br>
If you wish to clean up all cookies from this site <a href="?see=1&cleanup=1">click here to clean up</a> and <a href="?see=1">click here to see them</a>.<br>All setting will be cleaned if you have set colors in prefz you need to reset them again next time.
<?php 
if (!empty($_GET['see'])) {

?><table><tr><th colspan=2>Cookies</th></tr><tr><th>Name</th><th>Value</th></tr><?php 
while (list ($name, $value) = each ($_COOKIE)) {
echo '<tr><td>'.$name.'</td><td>'.$value;
if(!empty($_GET['cleanup'])){
setcookie ("$name", "1",$current_time-50000000) or die("$error_message");
print ' deleted!';
}
print '</td></tr>';
}
?></table><?php 

}else{
	/*
if($presult=mysqli_query($link, "SELECT * FROM `$tbl_paypal` WHERE (`month`='".date("m")."' and `year`='".date("Y")."') ORDER BY `amount` DESC LIMIT 100")){
if(mysqli_num_rows($presult) >= 1){?><table cellpadding="1" cellspacing="1" border="0" width="100%">
<tr><th colspan="2">This month we thank these players who donated to the game</th></tr><?php 
$amount=0;$i=0;
while($pobj=mysqli_fetch_object($presult)){
?><tr<?php if(empty($bg)){?> bgcolor="<?php echo $col_th;$bg=1;?>"<?php }else{$bg='';}?>><td><?php echo $pobj->ip;?></td><td>$<?php echo number_format($pobj->amount,2);?></td></tr><?php 
$amount+=$pobj->amount;$i++;
}
mysqli_free_result($presult);
?><tr><td><?php echo number_format($i);?> players donated </td><td>$<?php echo number_format($amount,2);?></td></tr></table><?php 
}}
*/
}

mysqli_close ($link);
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/playersonline.php');
include_once("$html_footer");
} else {
include_once("$html_header");
echo"You have been logged out and cookies has been cleaned.";
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/playersonline.php');
include_once("$html_footer");
}
?>