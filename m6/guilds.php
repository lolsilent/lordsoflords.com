<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/www.functions.php';
include_once("$html_header");

if (!empty($_POST)) {
	foreach ($_POST as $key => $val) {
		if (!empty($val)) {
			$$key=clean_post($val);
		}
	}
}

if (!empty($_GET)) {
	foreach ($_GET as $key => $val) {
		if (!empty($val)) {
			$$key=clean_post($val);
		}
	}
}
?><table width=100% cellpadding=1 cellspacing=1 border=0><tr><th colspan=8>The Most Victorious Guilds</th></tr>
<tr><td align=center><a name=a>No</a></td><td>Guild name</td><td>Guild</td><td>Leader</td><td align=right>Won</td><td align=right>Lost</td><td align=right>Tied</td></tr>
<?php 
$link = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($link,$db_main);

if (!empty($_GET['details'])) {

$details=clean_post($_GET['details']);

if($mresult = mysqli_query($link, "SELECT Sex,Charname,Level FROM $tbl_members WHERE Guild='$details' ORDER BY Level DESC LIMIT 100")){
$i=1;
$bgcolor='';
while ($mrow = mysqli_fetch_object ($mresult)) {
echo '<tr'.$bgcolor.'><td align=center>'.$i.'</td><td colspan=5>'.$mrow->Sex.' '.$mrow->Charname.' ['.number_format($mrow->Level).']</td></tr>';
$i++;
}
mysqli_free_result ($mresult);
} else {mysqli_query($link, "DELETE FROM $tbl_guilds WHERE Guild='$details' LIMIT 1");?>Huh!<?php }
}else{
if($result = mysqli_query($link, "SELECT * FROM $tbl_guilds WHERE `id` ORDER BY Won DESC LIMIT 50")){
$num=1;
while ($grow = mysqli_fetch_object ($result)) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}

echo '<tr'.$bgcolor.'><td align=center>'.$num.'</td><td><a href="?open=guilds&details='.$grow->Guild.'">['.$grow->Guild.'] '.$grow->Name.'</a></td><td>'.$grow->Special.'</td><td>'.$grow->Sex.' '.$grow->Charname.'</td><td align=right>'.number_format($grow->Won).'</td><td align=right>'.number_format($grow->Lost).'</td><td align=right>'.number_format($grow->Tied).'</td></tr>';
$num++;
}
mysqli_free_result ($result);

}
}
mysqli_close($link);
?>
</table>
<?php 
include_once("$html_footer");
?>