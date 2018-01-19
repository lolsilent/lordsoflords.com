<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/array.monsters.php';

if (!empty($_POST['Difficulty'])) {
	$Difficulty=$_POST['Difficulty'];
}

if (empty($Difficulty)) {
if (empty($_COOKIE['lol_mon_level'])) {$Difficulty=1;} else {if ($_COOKIE['lol_mon_level'] <= 0) {$Difficulty=1;} else {$Difficulty=$_COOKIE['lol_mon_level'];}}
} else {
if (!empty($_POST['Plus'])) {if ($Difficulty > 100) {$Difficulty+=$Difficulty/100;} else {$Difficulty++;}}
if (!empty($_POST['Min'])) {if ($Difficulty > 100) {$Difficulty-=$Difficulty/100;} else {$Difficulty--;}}
if ($Difficulty <= 0) {$Difficulty=1;}
$Difficulty=round($Difficulty);
setcookie ("lol_mon_level", "$Difficulty",time()+60*60*600);
}
include_once $clean_header;
?>
<form action="fight.php" method=post target="lol_main">
<table cellpadding=0 cellspacing="0" border=0 width=100%>
<tr>
<td width="60%" valign=top>
<select name="Monster">
<?php 
$i=1;
$max_monster = count($monsters_array)-1;
if ($Difficulty>=$max_monster) {
$monsterDifficulty=$max_monster;
} else {
$monsterDifficulty=$Difficulty;
}
foreach ($monsters_array as $value) {
if ($i <= $monsterDifficulty+9) {
echo "<option>$i - $value - ".number_format((96+((1+$i)*(1+$i))*$i)*($Difficulty))."</option>";
} else {break;}
$i++;
}
?>
</select></td><td width="15%" valign=top><input type=submit name=Action value="Fight!"></td><input type=hidden name="Difficulty" value="<?php print $Difficulty; ?>"></form><form method=post><td width=10% valign=top><input type=text name="Difficulty" value="<?php print $Difficulty; ?>"></td><td width="5%" valign=top><input type=submit name="Action" value="Level"></td><td width=5% valign=top><input type=submit name="Plus" value="+"></td><td width=5% valign=top><input type=submit name="Min" value="-"></td></form></tr></table>

<?php 
include_once $clean_footer;
?>