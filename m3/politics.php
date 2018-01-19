<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/www.mysql.php';
include_once $game_header;

$mversion="276030256";
$mversion=number_format($mversion,2);

mysqli_query($link, "DELETE FROM `$tbl_councils` WHERE Time<=$current_time-423000");
mysqli_query($link, "DELETE FROM `$tbl_politics` WHERE Time<=$current_time-423000");

if ($row->Level >= 500) {
	//CAST VOTE
if (!empty($_GET['vote'])) {
$result = mysqli_query($link, "SELECT * FROM `$tbl_councils` WHERE (`id`=".$_GET['vote']." and ip!='$row->ip') ORDER BY `id` DESC LIMIT 1");
if (!empty($result)) {
$vrow = mysqli_fetch_object ($result);
mysqli_free_result ($result);
	$heip=preg_replace("/(\d+)\.(\d+)\.(\d+)\.(\d+)/i","\${1}\${2}\${3}",$vrow->ip);
	$meip=preg_replace("/(\d+)\.(\d+)\.(\d+)\.(\d+)/i","\${1}\${2}\${3}",$row->ip);

	if (!empty($heip) and !empty($meip) and $heip !== $meip and $vrow->ip !== $row->ip and $vrow->Charname !== $row->Charname) {
$valpolitics ="'', '$row->Sex', '$row->Charname', '$vrow->Charname', 1, $current_time, '$row->ip'";
mysqli_query($link, "INSERT INTO $tbl_politics ($fld_politics) values ($valpolitics)") or $existence=1;
if (isset($existence) and !empty($existence)) {
mysqli_query($link, "UPDATE $tbl_politics SET `Sex`='$row->Sex',`Praise`='$vrow->Charname', `Time`=$current_time WHERE (`Charname`='$row->Charname') LIMIT 1");
print("You changed your vote to $vrow->Sex $vrow->Charname for $vrow->Apply.");
} else {
print("You have casted a vote on $vrow->Sex $vrow->Charname for $vrow->Apply.");
}
	} else {print 'Ip match is higher then 75% or you are voting for yourself, your vote has been discarded.';}
} else {echo "Invalid vote casted.";}
}
	//CAST VOTE

if ($row->Sex == 'Cop') {
	$kind_apply='Admin';
} elseif ($row->Sex == 'Mod') {
	$kind_apply='Cop';
} elseif ($row->Sex == 'Support') {
	$kind_apply='Mod';
} else {
	$kind_apply='Support';
}
	//APPLY FOR COUNCIL
if (!empty($_POST['apply']) and $row->Sex !== 'Admin') {
$council_val = "'','$row->Sex','$kind_apply','$row->Charname','0','0','0','0','$current_time','$REMOTE_ADDR'";
mysqli_query($link, "INSERT INTO $tbl_councils ($fld_councils) values ($council_val)") and print ("You have applied for $kind_apply title.") or print("You have already applied for a title.");
}
	//APPLY FOR COUNCIL
if (empty($_GET['help'])) {
$result = mysqli_query($link, "SELECT `id` FROM `$tbl_members` WHERE `id`");
$total_players = mysqli_num_rows($result);
mysqli_free_result ($result);
$maxop[0] = round($total_players/200);	//admins
	if ($maxop[0]<=5) {$maxop[0]=5;}
	if ($maxop[0]>=15) {$maxop[0]=15;}
$maxop[1] = $maxop[0]*1.25;		//cops
$maxop[2] = $maxop[0]*1.50;		//mods
$maxop[3] = $maxop[0]*1.75;		//supports
?>
<table width="100%" cellpadding=0 cellspacing=1 border=0>
<tr><th colspan=3>The High Council of <?php echo $title;?><br>Population of this server is <?php echo number_format($total_players); ?> players.</th></tr>

<?php 
$max=0;$haveop=array(-1,-1,-1,-1);
foreach ($operators as $val) {
?><tr><th colspan=2>Max <?php echo number_format($maxop[$max]).' '.$val;?>'s</th></tr><?php 
$result = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (`Sex`='$val' and `Charname`!='SilenT') ORDER BY `Time` DESC");
$i=1;
while ($arow = mysqli_fetch_object ($result)) {
list ($dlast,$lwhat)=dater($arow->Time);
if (!empty($arow->Guild)) {$arow->Guild="[$arow->Guild]";}
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
$timedout='';
if ((((($current_time-$arow->Time)/60)/60)/24) >= $opinactive[$max]) {
$timedout = " <b><font size=1>inactive for more than $opinactive[$max] days</font></b>";
} elseif ($i >= $maxop[$max]) {
$timedout = " <b><font size=1>$val's are maxed</font></b>";
} else {$timedout='';}
echo "<tr$bgcolor><td>$i.$arow->Guild$arow->Sex $arow->Charname$timedout</td><td>$dlast $lwhat inactive</td></tr>";
$i++;
if (!empty($timedout) and isset($timedout)) {
mysqli_query($link, "UPDATE `$tbl_members` SET `Sex`='Lord' WHERE `id`='$arow->id' LIMIT 1");
$message = clean_post("has been kicked out of the council!");
$message = "<center><b>*$arow->Sex $arow->Charname [$arow->Level] $message*</b></center>";
$valdegade= "'','$message','$current_date'";
mysqli_query($link, "INSERT INTO `$tbl_paper` ($fld_paper) VALUES ($valdegade)") or print("Unable to insert message.");
}
}
mysqli_free_result ($result);
$haveop[$max]+=$i;
$max++;
}
?>
</table>
<a href="<?php echo "$PHP_SELF?help=1"; ?>">Need help about the high councils?</a>
<?php 		//APLIES
$result = mysqli_query($link, "SELECT * FROM `$tbl_councils` WHERE `id` ORDER BY `Time` DESC");
if (!empty($result)) {
?>
<table width="100%" cellpadding=0 cellspacing=1 border=0>
<tr><th colspan=6>The High Council job applications from the last 5 days</th></tr>
<tr><td>Charname</td><td>Applying for</td><td>Admin</td><td>Cop</td><td>Mod</td><td>Support</td></tr><?php 
while ($aprow = mysqli_fetch_object ($result)) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}

if ($aprow->Apply == 'Support') {
$needadmins=1;
$needcops=0;
$needmods=round(($haveop[2]/100)*25);
$needsupport=round(($haveop[3]/100)*75);
}
$iresult = mysqli_query($link, "SELECT `id` FROM `$tbl_politics` WHERE `Sex`='Support' and `Praise`='$aprow->Charname'");
if ($iresult) {$aprow->Support = mysqli_num_rows($iresult);mysqli_free_result ($iresult);}

if ($aprow->Apply == 'Mod') {
$needadmins=1;
$needcops=round(($haveop[1]/100)*25);
$needmods=round(($haveop[2]/100)*75);
$needsupport=0;
}
$iresult = mysqli_query($link, "SELECT `id` FROM `$tbl_politics` WHERE `Sex`='Mod' and `Praise`='$aprow->Charname'");
if ($iresult) {$aprow->Mod = mysqli_num_rows($iresult);mysqli_free_result ($iresult);}

if ($aprow->Apply == 'Cop') {
$needadmins=round(($haveop[0]/100)*25);
$needcops=round(($haveop[1]/100)*75);
$needmods=0;
$needsupport=0;
}
$iresult = mysqli_query($link, "SELECT `id` FROM `$tbl_politics` WHERE `Sex`='Cop' and `Praise`='$aprow->Charname'");
if ($iresult) {$aprow->Cop = mysqli_num_rows($iresult);mysqli_free_result ($iresult);}

if ($aprow->Apply == 'Admin') {
$needadmins=round(($haveop[0]/100)*75);
$needcops=round(($haveop[1]/100)*25);
$needmods=0;
$needsupport=0;
}
$iresult = mysqli_query($link, "SELECT `id` FROM `$tbl_politics` WHERE `Sex`='Admin' and `Praise`='$aprow->Charname'");
if ($iresult) {$aprow->Admin = mysqli_num_rows($iresult);mysqli_free_result ($iresult);}

	//GRANTED TO THE HIGH COUNCIL
if ($aprow->Admin >= $needadmins and $aprow->Cop >= $needcops and $aprow->Mod >= $needmods and $aprow->Support >= $needsupport) {
mysqli_query($link, "UPDATE `$tbl_members` SET `Sex`='$aprow->Apply' WHERE (`Charname`='$aprow->Charname') LIMIT 1");
mysqli_query($link, "DELETE FROM `$tbl_councils` WHERE `Charname`='$aprow->Charname'");
mysqli_query($link, "DELETE FROM `$tbl_politics` WHERE `Praise`='$aprow->Charname'");
$message = "<center><b>$aprow->Sex $aprow->Charname is know a high council $aprow->Apply $aprow->Charname</b></center>";
$valgranted= "'','$message','$current_date'";
mysqli_query($link, "INSERT INTO `$tbl_paper` ($fld_paper) VALUES ($valgranted)") or print("Unable to insert message.");
}
	//GRANTED TO THE HIGH COUNCIL

echo "<tr$bgcolor><td>";
if (in_array($row->Sex,$operators) and $row->Charname !== $aprow->Charname) {
echo "<a href=\"$PHP_SELF?vote=$aprow->id\">Vote for</a> ";
} elseif ($aprow->Charname == $row->Charname) {
echo "<a href=\"$PHP_SELF?cancel=$aprow->id\">Cancel my application </a> ";
if (!empty($_GET['cancel'])) {
mysqli_query($link, "DELETE FROM `$tbl_councils` WHERE `id`=$aprow->id LIMIT 1");
}
}
echo "$aprow->Sex $aprow->Charname</td><td>$aprow->Apply</td><td>$aprow->Admin of $needadmins</td><td>$aprow->Cop of $needcops</td><td>$aprow->Mod of $needmods</td><td>$aprow->Support of $needsupport</td></tr>";

}
mysqli_free_result ($result);
}
		//APLIES
?>
</table>
<?php 
} else {
?>
<table cellpadding=0 cellspacing=1 border=0 width=100%>
<tr><th colspan=6>The High Council rules<br>ONE PLAYER ONLY MAY HAVE ONE COUNCIL!</th></tr>
<tr><th>Title</th><th>Permissions</th><th>Current Sex</th><th>Requirements</th><th>Job</th></tr>
<?php 
include_once 'AdMiN/mute.permissions.php';
foreach ($permissionsss as $key=>$val) {
	if ($key == 'Demon') {break;}
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td valign=top>$key</td><td valign=top>$val[0]</td><td valign=top>$val[1]</td><td valign=top>$val[2]</td><td valign=top>$val[3]</td></tr>";
}
?>
</table>
<?php 
if ($row->Sex !== 'Admin') {
?>
<form method=post>

<input type=submit name=apply value="I agree to follow all rules of the game, I wish to apply for a <?php echo $kind_apply; ?> tittle">

</form>
<?php 
}
}

} else {
?>You need be level 500 to get involved in politics.<?php 
}
include_once $game_footer;
?>