<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;
?>
<table cellpadding=0 cellspacing=1 border=0 width=100%>
<tr><th>These are your friends</th></tr><tr><td>
<?php 
$query = "SELECT * FROM `$tbl_members` WHERE `Friend`='$row->Charname' ORDER BY `Time` DESC";
$result = mysqli_query($link, $query);
while ($frow = mysqli_fetch_object ($result)) {
list ($dlast,$lwhat)=dater($frow->Time);
echo "$frow->Sex $frow->Charname [$frow->Level] was last active $dlast $lwhat ago.<br>";
}
mysqli_free_result ($result);
?>
</td></tr></table>
Bring all your friends to this url to signup and you will get 10% of the exp and gold he won in duels or kills, but the amount cannot be greater than yours and less than your level.<br><b>
<?php 
echo "<a href=\"$root_url/signup.php?friend=$row->Charname\">$root_url/signup.php?friend=$row->Charname</a></b><p>";
include_once $game_footer;
?>