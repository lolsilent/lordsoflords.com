<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;
?>
<table cellpadding=0 cellspacing=1 border=0 width=100%> <tr><th colspan=2><?php echo $title; ?> Best thief</th></tr>
<tr><td>Date</td><td>News</td></tr>
<?php 
$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");

if($sresult = mysqli_query($link, "SELECT * FROM `$tbl_steals` WHERE `id` ORDER BY `id` DESC LIMIT 110")){
$i=0;while ($srow = mysqli_fetch_object ($sresult)) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td><font size=-2>$srow->Date</td><td><b>$srow->Charname</b> stole <b>".number_format($srow->Amount)."</b> $srow->Item</td></tr>";
if ($i > $max_news) {
mysqli_query($link, "DELETE FROM $tbl_steals WHERE `Amount`<$srow->Amount");break;
}
$i++;
}
mysqli_free_result ($sresult);
}
?></table><?php 
include_once $game_footer;
?>