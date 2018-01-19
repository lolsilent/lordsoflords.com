<br>[<b><a href="prefz.php">Game and site preferences</a></b>]
[<b><a href="preference.php">Change Password or Email</a></b>]<br>
<?php 
if ($row->Level >= 100 and ($row->Freeplay-time()) > 5000) {
?>
[<b><a href="ftransfer.php">Freeplay exchanger</a></b>]
<?php 
}
?>
[<b><a href="save.php">Load or Save game</a></b>]<br>
[<b><a href="race.php">Race Changer</a></b>]