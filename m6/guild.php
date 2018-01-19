<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/array.guilds.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/array.races.php';
require_once 'AdMiN/www.clan.php';
include_once $game_header;

if ($row->Level >= 250) {
	//NEW MEMBER OR JOIN
if (!empty($_POST['password']) and !empty($_POST['abguildname']) and empty($row->Guild)) {
$password=crypt($_POST['password'],$_POST['abguildname']);

if (!empty($_POST['guildname']) and !empty($_POST['special'])) {
		$special=clean_post($_POST['special']);
		$guildname=clean_post($_POST['guildname']);
		$abguildname=clean_post($_POST['abguildname']);
if (empty($special) or empty($guildname) or empty($abguildname) or $special == '!' or $guildname == '!' or $abguildname == '!' or $abguildname == $_POST['password'] or !preg_match ("/^[a-z0-9]*$/i", "$abguildname") or !preg_match ("/^[a-z 0-9]*$/i", "$guildname")) {
$output = "Invalid fields or same fields! Please try again Use only Letters and Numbers please!.";
} else {
$gvalue = "'', '$row->Sex', '$row->Charname', '$password', '$abguildname', '$guildname', '$special', 0, 0, 0, 0, $current_time";
mysqli_query($link, "INSERT INTO $tbl_guilds ($fld_guilds) values ($gvalue)") and $output = "Guild [$abguildname] $guildname created!" or $output = "Guild name or abbreviation already in use or you already created a guild.".mysqli_error($link);
if (!preg_match("/^Guild name or .*?$/i",$output)) {
$to_update .= ", Guild='$abguildname'";
}
} // else invalid
} else {

	$result = mysqli_query($link, "SELECT * FROM $tbl_guilds WHERE (Guild='$abguildname' and Password='$password') ORDER BY `id` DESC LIMIT 1");
	if (!empty($result)) {
	$grow = mysqli_fetch_object ($result) or print(mysqli_error($link));
	mysqli_free_result ($result);
if ($password == $grow->Password) {
	$output = "You have joined [$grow->Guild] $grow->Name. $grow->Sex $grow->Charname welcomes you.";
$to_update .= ", Guild='$abguildname'";
} else {
	$output = "Password or Abbreviation incorrect.";
}
	} else {
	$output = "Password or Abbreviation incorrect.";
	}

}

if (!empty($output)) {
echo "<b>$output</b>";
include_once $game_footer;
exit;
}
}
	//NEW MEMBER OR JOIN


if (!empty($row->Guild) and isset($row->Guild)) {

$guresult = mysqli_query($link, "SELECT * FROM $tbl_guilds WHERE (Guild='$row->Guild') ORDER BY `id` DESC LIMIT 1");
if (!empty($guresult)) {
$grow = mysqli_fetch_object ($guresult);
mysqli_free_result ($guresult);
}

if(empty($grow->Guild) or empty($guresult)) {
print("The Guild [$row->Guild] doesn't exist anymore. Please visit guild page again to join or create a new guild.");
$to_update .= ", `Guild`=''";
include_once $game_footer;
exit;
}
?>
<form method=post>
<table width=100% border=0 cellpadding=0 cellspacing=1>
<tr><th colspan=2><?php 
if ($grow->Charname == $row->Charname and $grow->Guild == $row->Guild) {

	//{LEAVE REMOVE GUILD MEMBER
if (!empty($_GET['remove']) or !empty($_GET['rcharname']) or !empty($_POST['leaving'])) {
$lgresult = mysqli_query($link, "SELECT * FROM $tbl_tourwinner WHERE Winner='$row->Guild' ORDER BY `id` DESC LIMIT 1") or die(mysqli_error($link));
if (!empty($lgresult)) {
mysqli_free_result ($lgresult);
	if (!empty($_GET['remove']) and !empty($_GET['rcharname']) and empty($lgrow->Winner)) {
$remid=$_GET['remove'];
$recharname=$_GET['rcharname'];
mysqli_query($link, "UPDATE `$tbl_members` SET Guild='' WHERE (`id`=$remid and `Charname`='$recharname') LIMIT 1") or die(mysqli_error($link));
?>You have removed <b><?php echo $recharname;?></b> from your guild.<?php 
	} elseif (!empty($_POST['leaving']) and empty($lgrow->Winner)) {
$to_update .= ", Guild=''";
?>You have left <?php echo "$grow->Special [$grow->Guild] $grow->Name"; ?> Guild.<?php 
	}
} else {
?>Nobody may leave a guild when they are celebrating for their victorious moments.<?php 
}
?><th></tr></table><?php 
include_once $game_footer;
exit;
}
	//LEAVE REMOVE GUILD MEMBER}

echo "You are the leader of $grow->Special [$grow->Guild] $grow->Name";
	//TOURNAMENT
	if (!empty($_GET['tournament'])) {
		if ($_GET['tournament'] == 'join') {
		$val_tor=1;
		echo "<br>Your guild has joined the tournament.";
		} else {
		$val_tor=0;
		echo "<br>Your guild left the tournament.";
		}
mysqli_query($link, "UPDATE $tbl_guilds SET Tournament=$val_tor WHERE `id`=$grow->id LIMIT 1") or die(mysqli_error($link));
	} elseif (empty($_GET['tournament'])) {

if (!$grow->Tournament) {
echo "<br>[<a href=\"$PHP_SELF?tournament=join\">Join the Tournament</a>]";
} else {
echo "<br>[<a href=\"$PHP_SELF?tournament=leave\">Leave the tournament</a>]";
}

	} else {
	echo "<br>";
	}
	//TOURNAMENT
	//CHANGE PASSWORD
if (!empty($_GET['change']) and empty($output)) {
	if (!empty($_POST['cpassword']) and !empty($_POST['ccpassword'])) {
		if ($_POST['cpassword'] == $_POST['ccpassword']) {
$password=crypt($_POST['cpassword'],$row->Guild);
mysqli_query($link, "UPDATE $tbl_guilds SET Password='$password' WHERE `id`=$grow->id LIMIT 1") and print("<script>alert('Password has been changed to ".$_POST['cpassword']."!')</script>");
		} else {
		?>New passwords doesn't match please try again.<?php 
		}
	} else {
?><table width=500><tr><td>New password</td><td width=25%><input type=password name="cpassword" maxlength=10></td><td>Confirm password</td><td width=25%><input type=password name="ccpassword" maxlength=10></td><td><input type=submit name=action value="GO!"></td></tr></table></form><form method=post><?php 
	}
} else {
echo " [<a href=\"$PHP_SELF?change=1\">Change guild password</a>]";
}
	//CHANGE PASSWORD
} else {
if (!empty($_POST['leaving'])) {
$to_update .= ", Guild=''";
print("You have left $grow->Special [$grow->Guild] $grow->Name Guild</th></tr></table>");
include_once $game_footer;
exit;
} else {
echo "You are a member of $grow->Special [$grow->Guild] $grow->Name";
}
}
if ($grow->Tournament) {echo "<br>Your guild is playing the tournament";}
?></th></tr><tr>
<td colspan=2 align=center>Tournaments Won : <?php echo number_format($grow->Won);?> Lost : <?php echo number_format($grow->Lost);?> Tied : <?php echo number_format($grow->Tied);?></td>
</tr><tr><th colspan=2>Members in the guild</th></tr><?php 

$result = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (Guild='$grow->Guild' and Guild!='') ORDER BY Level desc LIMIT 25");
if (!empty($result)) {
$clanpower = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$ipss=array();
$num=1;
while ($mrow = mysqli_fetch_object ($result)) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td>$num. <a href=\"$PHP_SELF?cstats=$mrow->id\">[$mrow->Guild] $mrow->Sex $mrow->Charname</a></td><td>";
if ($row->Charname == $grow->Charname and $grow->Charname !== $mrow->Charname) {echo "<a href=\"$PHP_SELF?remove=$mrow->id&rcharname=$mrow->Charname\">Remove</a>";}
if ($mrow->Charname == $grow->Charname) {echo "<b>Leader</b>";$leader=1;}
echo " [".number_format($mrow->Level)."]</td></tr>";
	$cmstats=clanstats($mrow,$races_array);
if (!in_array($mrow->ip,$ipss) and $num <= 5) {
$i=0;
foreach ($cmstats as $val) {
$clanpower[$i]+=$val;
$i++;
}
array_push($ipss,$mrow->ip);
}
if (!empty($_GET['cstats'])) {
	if ($_GET['cstats'] == $mrow->id) {
$i=0;
foreach ($cmstats as $val) {
$val=floor($val);
$cmstats[$i]=number_format($val);
$i++;
}
$member_power = "<table width=100%><tr>
<td valign=top width=20%>Stats<br>Weapon damage<br>Attack spell<br>Heal spell<br>Magic Shield<br>Defence<br>Attack Rating<br>Magic Rating </td>
<td valign=top align=right width=20%> Min<br>$cmstats[0]<br>$cmstats[2]<br>$cmstats[4]<br>$cmstats[6]<br>$cmstats[8] <br>$cmstats[21]<br>$cmstats[22]</td>
<td valign=top align=right width=20%> Max<br>$cmstats[1]<br>$cmstats[3]<br>$cmstats[5]<br>$cmstats[7]<br>$cmstats[9] <br>$cmstats[10]<br>$cmstats[11]</td>
</tr></table>";
?><tr><td colspan=2><?php echo $member_power;?></td></tr><?php 


	}
}
$num++;
} //END while
mysqli_free_result ($result);
} //result

$total_gpower=array_sum($clanpower);
$i=0;
foreach ($clanpower as $val) {
$clanpower[$i]=number_format($val);
$i++;
}
$total_clan_power = "
<table width=100%><tr><th colspan=3>The combined power of the $limit_clan most experienced members are fighting in the tournament for us.</th></tr>
<tr><td valign=top width=20%>Clan power<br>Weapon damage<br>Attack spell<br>Heal spell<br>Magic Shield<br>Defence<br>Attack Rating<br>Magic Rating </td>
<td valign=top align=right width=20%> Min<br>$clanpower[0]<br>$clanpower[2]<br>$clanpower[4]<br>$clanpower[6]<br>$clanpower[8] <br>$clanpower[21]<br>$clanpower[22]</td>
<td valign=top align=right width=20%> Max<br>$clanpower[1]<br>$clanpower[3]<br>$clanpower[5]<br>$clanpower[7]<br>$clanpower[9] <br>$clanpower[10]<br>$clanpower[11]</td>
</tr><tr><th colspan=3>Total clan power : ".number_format($total_gpower)."</th></tr></table>
";
?>
<tr><td colspan=2><?php echo $total_clan_power;?></td></tr>
<tr><td colspan=2><input type=submit name=leaving value="Leave [<?php echo $row->Guild; ?>] Guild"></td></tr>
</table>
</form>
<?php 
} elseif (empty($row->Guild)) {
?>
<table width=100% border=0 cellpadding=0 cellspacing=1><form method=post>
<?php 
if (!empty($_GET['create']) and empty($output)) {
?>
<tr><th colspan=2>Guild creation<br>You may only create one guild per player, please only use Letters and Numbers.</th></tr>
<tr><td width=50%>Guild Name</td><td><input type=text name=guildname size=15 maxlength=25></td></tr>
<tr><td width=50%>Abbreviation<br><font size=1>Short name in 2 or 3 characters for your guild name</font></td><td><input type=text name=abguildname size=15 maxlength=3></td></tr>
<tr><td>Special ability of your guild</td><td><select name=special><?php foreach ($array_guilds as $key=>$val) {echo "<option>$key</option>";}?></select></td></tr>
<tr><td>Password<br><font size=1>Password is required for new members to join</font></td><td><input type=password name=password size=15 maxlength=10></td></tr>
<tr><td colspan=2><input type=submit name=action value="Create a new guild"></td></tr>
<?php 
} elseif (!empty($_GET['join']) and empty($output)) {
?>
<tr><th colspan=2>Joining a guild<br>You may join and leave a guild whenever you like</th></tr>
<tr><td width=50%>Abbreviation</td><td><input type=text name=abguildname size=3 maxlength=10></td></tr>
<tr><td>Password<br><font size=1>Password is given by your guild leader</font></td><td><input type=password name=password size=15 maxlength=10></td></tr>
<tr><td colspan=2><input type=submit name=action value="Join a guild"></td></tr>
<?php 
} else {
?>
<th>Guilds</th></tr>
<?php 
foreach ($array_guilds as $key=>$val) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td><b>$key</b><br>$val[3]</td></tr>";
}
?>
<tr><th align=center><b>[ <a href="<?php echo $PHP_SELF;?>?create=1">Create a guild</a> | <a href="<?php echo $PHP_SELF;?>?join=1">Join a guild</a> ]</b></th></tr>
<?php 
}
?>
</form></table>
<?php 
} //empty row guild

} else {
?>
You must be at least level 250 to start or join a guild.
<?php 
}

include_once $game_footer;
?>