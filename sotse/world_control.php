<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/array.locations.php';
if (empty($_POST['Difficulty'])) {
if (empty($_COOKIE['lol_mon_level'])) {$Difficulty=1;} else {if ($_COOKIE['lol_mon_level'] <= 0) {$Difficulty=1;} else {$Difficulty=$_COOKIE['lol_mon_level'];}}
} else {
	$Difficulty=$_POST['Difficulty'];
if (!empty($_POST['Plus'])) {$Plus=$_POST['Plus'];if ($Difficulty > 100) {$Difficulty+=$Difficulty/100;} else {$Difficulty++;}}
if (!empty($_POST['Min'])) {$Min=$_POST['Min'];if ($Difficulty > 100) {$Difficulty-=$Difficulty/100;} else {$Difficulty--;}}
if ($Difficulty <= 0) {$Difficulty=1;}
$Difficulty=round($Difficulty);
setcookie ("lol_mon_level", "$Difficulty",time()+60*60*600);
}
if (!empty($_POST['new_loc'])) {
	$new_loc=$_POST['new_loc'];
setcookie ("lol_Location", "$new_loc",time()+60*60*5000);
$file_monsters=strtolower($new_loc);
$file_monsters=preg_replace("' \[.*?$'","",$file_monsters);
$file_monsters=preg_replace("' '","_",$file_monsters);
$i=preg_replace("'^.*? \['","",$new_loc);
$i=preg_replace("'\].*?$'","",$i);
} else {
if (isset($_COOKIE['lol_Location'])) {
$file_monsters=strtolower($_COOKIE['lol_Location']);
$file_monsters=preg_replace("' \[.*?$'","",$file_monsters);
$file_monsters=preg_replace("' '","_",$file_monsters);
$i=preg_replace("'^.*? \['","",$_COOKIE['lol_Location']);
$i=preg_replace("'\].*?$'","",$i);
}
}
if (empty($file_monsters)) {
$file_monsters='town';
$i=1;
}
require "AdMiN/world.$file_monsters.php";

include_once("$clean_header");
?>
<form action="world.php" method=post target="lol_main">
<table cellpadding=0 cellspacing="0" border=0 width=100%>
<tr>
<td width="60%" valign=top><select name="Monster">
<?php 
foreach ($monsters_array as $value) {
echo "<option>$i - $value - ".number_format((($i)+(100+((1+$i)*(1+$i))*$i)*($Difficulty)))."</option>";
$i++;
}
?>
</select></td><td width="10%" valign=top><input type=submit name=Action value="Fight!"></td><input type=hidden name="Difficulty" value="<?php print $Difficulty; ?>"></form><form method=post><td width=10% valign=top><input type=text name="Difficulty" value="<?php print $Difficulty; ?>"></td><td width="10%" valign=top><input type=submit name=Action value="Level"></td><td width=5% valign=top><input type=submit name="Plus" value="+"></td><td width=5% valign=top><input type=submit name="Min" value="-"></td></form></tr></table>

<?php 
include_once("$clean_footer");
?>