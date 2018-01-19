<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/www.mysql.php';
include_once $game_header;
if (empty($see)) {$see=0;}
?>
<table cellpadding=0 cellspacing=1 border=0 width=100%> <tr><th colspan=2><?php echo $title; ?> Tournaments</th></tr><tr><th colspan=2><center>Last <?php echo $out_of_tour; ?> winners
<?php 
$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");
	//{CELEBRATE
$limit_out_of_tour=$out_of_tour*2;
$winresult = mysqli_query($link, "SELECT * FROM $tbl_tourwinner WHERE `id` ORDER BY `id` DESC LIMIT $limit_out_of_tour");
$a=0;
while ($winrow = mysqli_fetch_object ($winresult)) {
$a++;
if ($a > $out_of_tour) {
mysqli_query($link, "DELETE LOW_PRIORITY FROM $tbl_tourwinner WHERE `id`=$winrow->id LIMIT 1");
} else {
echo " [$winrow->Winner]";
}
}
mysqli_free_result ($winresult);
	//CELEBRATE}
?>
</th></tr><tr><td>Date</td><td>News</td></tr>
<?php 
$query = "SELECT * FROM $tbl_tourpaper WHERE `id` ORDER BY `id` DESC";
$result = mysqli_query($link, $query) or die ("Query failed");
$i=0;$bgcolor=0;
while ($mrow = mysqli_fetch_object ($result)) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td valign=top><font size=-2><a href=\"$PHP_SELF?see=$mrow->id\">$mrow->Date</a></td><td>";if ($see !== $mrow->id) {echo "<a href=\"$PHP_SELF?see=$mrow->id\">$mrow->Versus</a>";} else {echo '<center>'.$mrow->News.'</center>';}echo "</td></tr>";
if ($i >= $max_news) {
mysqli_query($link, "DELETE LOW_PRIORITY FROM $tbl_tourpaper WHERE id<=$mrow->id");break;
}

$i++;
}
mysqli_free_result ($result);

?></table><?php 
include_once $game_footer;
?>