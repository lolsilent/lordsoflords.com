<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
include_once("$html_header");
$link = mysqli_connect($db_host, $db_user, $db_password) or die("Unable to connect to database");
mysqli_select_db($link, "$db_main") or die( "Unable to select database");
?>
<form method="post">
<table width="100%" cellpadding=0 cellspacing=1 border=0 align=center>
<tr><th colspan=2>Make a donation to a player in the game.</th></tr>
<tr><td width=50%>A online player</td><td>
<select name="oplayer">
<option value="" selected>Online players</option>
<?php 
if($ores = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (`Onoff`>=1 and `Sex`!='Admin') ORDER BY `Level` asc LIMIT 100")){
while ($orow = mysqli_fetch_object ($ores)) {
echo '<option value="'.$orow->Charname.'">'.$orow->Charname.'</option>';
}mysqli_free_result ($ores);}
?>
</select>
</td></tr>
<tr><td>Other player</td><td><input type=text name=player value=""></td></tr>
<tr><td colspan=2><input type=submit name=action value="Give this player a present!"></td></tr>
</table>
</form>

<?php 
if(!empty($_POST['player']) or !empty($_POST['oplayer'])){
if(empty($_POST['player']) and !empty($_POST['oplayer'])){$player=$_POST['oplayer'];}
if(!empty($_POST['player']) and empty($_POST['oplayer'])){$player=$_POST['player'];}

if($mres=mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `Charname`='$player' LIMIT 1")){
if($mrow = mysqli_fetch_object ($mres)){
mysqli_free_result ($mres);
?><br><br><br><br><br><b><a href="<?php echo "https://paypal.com/cgi-bin/webscr?cmd=_xclick&business=paypal@thesilent.com&undefined_quantity=1&item_name=$title : Buy credits for $mrow->Sex $mrow->Charname&item_number=Game:Lol1,Server:$server,Charname:$mrow->Charname&amount=3&no_shipping=1&return=$root_url/thanks.php&cancel_return=$root_url/thanks2.php&notify_url=https://thesilent.com/paypal/index.php&lc=US";?>">Proceed to buy credits for <?php echo "$mrow->Sex $mrow->Charname";?></a>
</b><br><br><br><br><br><?php 
}else{?>Can't find player.<?php }}}
?>
Verified Paypal accounts or use <a href="https://thesilent.com/allopass/">Allopass Phone or SMS</a>.
<?php 
mysqli_close($link);
include_once("$html_footer");
?>