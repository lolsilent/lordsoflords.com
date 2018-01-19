<?php 
require_once "AdMiN/www.titles.php";
?>
<tr> <th align=center>Noble Titles</th></tr>
<tr> <td>Noble Titles get updated when you click on Nobility in the game.
Once you have dropped out of the ladder your title will be kept until you have reached an higher title or within range of getting an other title. To stay/come in the ladder your exp must be greater than level*1.000.000. If you went to vacation for longer than 5 days you need to login to come back on the ladder.
<br>
</td></tr>

<tr><td>

<table width=100% cellpadding=0 cellspacing=1 border=1>
<tr><td width=20%>Ladder position</td><td>Ladies</td><td>Lords</td></tr>
<?php 
$i=0;$a=1;
foreach ($female as $val) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"#234567\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td>$a</td><td>$val</td><td>$male[$i]</td></tr>";
$i++;
if ($i == 15) {break;}
$a++;
}
?>
</table></td></tr>