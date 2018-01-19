<?php 
//if ($row->Level < 1000000) {
if($freeplay >= 1 or $row->Level > 1000) {
?>
<form method=post action="stats.php" target="lol_main">
What do you wish to learn?
<table width=50% align=center border=1>
<tr><td align=center width=50%>Mass level up</td>
<td align=center>Level up once</td></tr>
<tr><td align=center width=50%><center>
<input type=submit name="Stats" value="Strength"><br>
<input type=submit name="Stats" value="Dexterity"><br>
<input type=submit name="Stats" value="Agility"><br>
<input type=submit name="Stats" value="Intelligence"><br>
<input type=submit name="Stats" value="Concentration"><br>
<input type=submit name="Stats" value="Contravention"><br>
</td>
<td align=center><center>
<input type=submit name="cStats" value="Strength"><br>
<input type=submit name="cStats" value="Dexterity"><br>
<input type=submit name="cStats" value="Agility"><br>
<input type=submit name="cStats" value="Intelligence"><br>
<input type=submit name="cStats" value="Concentration"><br>
<input type=submit name="cStats" value="Contravention"><br>
</td></tr>
</table>
</form>
<?php }else{?>
<form method=post action="stats.php" target="lol_main">
What do you wish to learn?
<table width=50% align=center border=1>
<tr><th>Stats</th><th>You have</th><th>Information</th></tr>
<tr><td align=center><input type=submit name="cStats" value="Strength"></td><td><?php print number_format($row->Strength);?></td><td>Increase weapon damage and wearing heavier armor. </td></tr>
<tr><td align=center><input type=submit name="cStats" value="Dexterity"></td><td><?php print number_format($row->Dexterity);?></td><td>Increase attack rating and chance of hitting your opponent </td></tr>
<tr><td align=center><input type=submit name="cStats" value="Agility"></td><td><?php print number_format($row->Agility);?></td><td>Decrease incoming damage and increase thievery power for exp and gold</td></tr>
<tr><td align=center><input type=submit name="cStats" value="Intelligence"></td><td><?php print number_format($row->Intelligence);?></td><td>Increase your own attack spell power and increase spell level that can be learned. Amulets and Rings also have Intelligence as requirement.</td></tr>
<tr><td align=center><input type=submit name="cStats" value="Concentration"></td><td><?php print number_format($row->Concentration);?></td><td>Increase magic rating and chance of an successful spell casting. </td></tr>
<tr><td align=center><input type=submit name="cStats" value="Contravention"></td><td><?php print number_format($row->Contravention);?></td><td>Increases magic shield that will decrease incoming magic damage.</td></tr>
</table>
</form>
<?php 
}
//}
?>