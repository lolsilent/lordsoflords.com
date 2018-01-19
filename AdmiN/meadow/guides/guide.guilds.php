<?php 
require_once $inc_dir.'/array.guilds.php';
?>
<tr>
<th valign=top>Guilds/Clans</th>
</tr>
<tr>
<td valign=top>
To join or create a Guild you be Level 1.000 or over it. Once you have created a Guild you automatically join your own Guild, a password is required for other players to join your guild.
When you are the leader you may remove members and kick guild members when you think they don't belong in your guild.
The top 10 players sorted by Level will fight the tournament for your guild. Choose wisely which Guild/Clan you want to join.
</td>
</tr>
<?php 
foreach ($array_guilds as $key=>$val) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td><b>$key<br>$val[0]*Guild Attack Rating<br>$val[1]*Guild Magic Rating<br>$val[2]*Guild Life</b><br>$val[3]</td></tr>";
}
?>
