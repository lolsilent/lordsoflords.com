<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/www.titles.php';
include_once $game_header;

echo "<table align=center><tr><th colspan=4>Titles of Nobility is only for top players</th></tr>";

//$allowed_sex=array('Beggar', 'Untrust','Danger','Demon','Lord','Lady','Support','Mod','Cop','Admin','Helper','Stealer');

$inactive=time()-432000;
$query = "SELECT * FROM `$tbl_members` WHERE (Time>$inactive and Exp>Level*1000000 and Sex!='Admin' and Sex!='Cop' and Sex!='Mod' and Sex!='Support' and Sex!='Beggar' and Sex!='Untrust' and Sex!='Danger' and Sex!='Demon' and Sex!='Helper' and Sex!='Stealer') ORDER BY Level desc LIMIT 25";

if ($result = mysqli_query($link, $query)) {
$promoted_array=array();
$num=0;$nim=1;

while ($nprow = mysqli_fetch_object ($result)) {
$safe_sex='';
if (in_array ("$nprow->Sex", $female)) {
foreach ($female as $val) {
if ($nprow->Sex == $val) {
$safe_sex="$female[$num]";
break;
}
}
} elseif (in_array ("$nprow->Sex", $male)) {
foreach ($male as $val) {
if ($nprow->Sex == $val) {
$safe_sex="$male[$num]";
break;
}
}
} else {
echo "<!--!Unknown $nprow->Sex $nprow->Charname!-->";
}
if (isset($safe_sex)) {
$nprow->Freeplay=$nprow->Freeplay-$current_time;
if ($nprow->Freeplay > 0) {$nprow->pCharname="$nprow->Charname<img src=\"$emotions_url/star.gif\" border=0 alt=\"Premium game supporter\">";} else {$nprow->pCharname=$nprow->Charname;}
	if ($safe_sex !== '' and $nprow->Sex !== $safe_sex) {
mysqli_query($link, "UPDATE LOW_PRIORITY $tbl_members SET `Sex`='$safe_sex' WHERE `id`='$nprow->id' LIMIT 1");

$news= "
'',
'<b>$nprow->Sex $nprow->Charname is now known as $safe_sex $nprow->Charname.<b>',
'$current_date'
";
mysqli_query($link, "INSERT INTO `$tbl_paper` ($fld_paper) VALUES ($news)") or print("Unable to insert news.");

array_push ($promoted_array,"<tr bgcolor=\"$col_table\"><td>$nim</td><td>$safe_sex $nprow->pCharname <b><font size=1>NEW!</font></b></td><td align=right>$nprow->Race</td><td align=right>".number_format($nprow->Level)."</td></tr>");
	} else {
array_push ($promoted_array,"<tr bgcolor=\"$col_table\"><td>$nim</td><td>$nprow->Sex $nprow->pCharname</td><td align=right>$nprow->Race</td><td align=right>".number_format($nprow->Level)."</td></tr>");
	}

} else {
array_push ($promoted_array,"<tr bgcolor=\"$col_table\"><td>$nim</td><td>$nprow->Sex $nprow->Charname</td><td align=right>$nprow->Race</td><td align=right>".number_format($nprow->Level)."</td></tr>");
}
$nim++;
if ($num <= 13) {$num++;}
}
mysqli_free_result ($result);

if ($promoted_array) {
	foreach ($promoted_array as $v) {
	print "$v";
	}
}

}
print "</th></table>";

include_once $game_footer;
?>