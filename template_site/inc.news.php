<?php 
#!/usr/local/bin/php
require_once 'AdmiN/www.mysql.php';

if (empty($_GET['year'])) {
 $year=date("Y");
} else {
$year=$_GET['year'];
if ($year >= date("Y")) {$year=date("Y");}
}
?>
<tr><th bgcolor="#000000" colspan=2>Game News</th></tr>
<?php 
if (!empty($_GET['submit'])) {
?>
<form method=post>
<tr><td colspan=2 align=center><textarea name=news rows=10 cols=60></textarea>
<br>
<input type=password name=password value="Password">
<input type=submit name=submit value="Submit news!"></td></tr>

</form>
<?php 
}

$link = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($link, "$db_main");

if (!empty($_POST['news']) and !empty($_POST['password'])) {

function clean_post($in) {
$in=trim($in);
$in=addslashes($in); //Quote meta characters
return $in;
}

$news=clean_post($_POST['news']);
if (!empty($news) and $_POST['password'] == '1793admin1793'){
$insert_val = "
'',
'".date("m")."',
'".date("d")."',
'".date("Y")."',
'".date("H")."',
'".date("i")."',
'$news',
$current_time
";

mysqli_query($link, "INSERT INTO $tbl_news ($fld_news) values ($insert_val)") || print(mysqli_error($link));
} else {print "Hahaha $news haha";}
}

$result = mysqli_query($link, "SELECT * FROM $tbl_news WHERE (nyear='$year' and id) ORDER BY id desc");
while ($nrow = mysqli_fetch_object ($result)) {
$nrow->news=stripslashes($nrow->news);
if ($nrow->nhour == 0) {$nrow->nhour='00';}
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"#345678\"";} else {$bgcolor='';}
print<<<EOT
<tr>
<td valign=top nowrap$bgcolor>$nrow->nday-$nrow->nmonth-$nrow->nyear $nrow->nhour:$nrow->nminutes</td>
<td valign=top$bgcolor>
$nrow->news
</td></tr>
EOT;
}
mysqli_free_result ($result);
mysqli_close ($link);
?>

<tr>
<td valign=top colspan=2>
<a href="?open=before">Things I have done in 2002</a><?php 
for($i=2003;$i<=date('Y')-1;$i++){print ', <a href="?open=news&year='.$i.'">'.$i.'</a>';
}
?><a href="?open=news&submit=1">.</a>
</td>
</tr>