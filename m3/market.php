<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;
if (!empty($_POST)) {
	foreach ($_POST as $key => $val) {
		if (!empty($val)) {
			$$key=clean_post($val);
		}
	}
}

if (!empty($_GET)) {
	foreach ($_GET as $key => $val) {
		if (!empty($val)) {
			$$key=clean_post($val);
		}
	}
}
$charm_time=50000;
if (!empty($cancel)) {
$query = "SELECT * FROM $tbl_market WHERE `id`=$cancel ORDER BY `id` ASC limit 1";
$result = mysqli_query($link, $query);
$mtrow = mysqli_fetch_object ($result);
mysqli_free_result ($result);
if ($mtrow->Bidder == $row->Charname) {
mysqli_query($link, "UPDATE $tbl_market SET Bidder='' WHERE `id`=$cancel LIMIT 1") and print("You have canceled your bid!");
} else {
?>
What's up doc?...
<?php 
}
} elseif (!empty($sell)) {

$query = "SELECT * FROM $tbl_market WHERE `id`=$sell ORDER BY `id` ASC limit 1";
$result = mysqli_query($link, $query);
$mtrow = mysqli_fetch_object ($result);
mysqli_free_result ($result);

$slots=0;
$query = "SELECT * FROM `$tbl_charms` WHERE `Charname`='$mtrow->Bidder' ORDER BY `id` ASC limit 10";
$result = mysqli_query($link, $query);
while ($csrow = mysqli_fetch_object ($result)) {
$slots++;
}
mysqli_free_result ($result);

if ($slots < 5) {
$query = "SELECT * FROM `$tbl_credits` WHERE (`Charname`='$mtrow->Bidder') ORDER BY `id` DESC limit 1";
$result = mysqli_query($link, $query) or die("$error_message : Query failed");
$crow = mysqli_fetch_object ($result) or $crow->Credits=0;
mysqli_free_result ($result);

$query = "SELECT * FROM `$tbl_members` WHERE (`Charname`='$mtrow->Bidder') ORDER BY `id` DESC limit 1";
$result = mysqli_query($link, $query) or die("$error_message : Query failed");
$brow = mysqli_fetch_object ($result);
mysqli_free_result ($result);

if ($mtrow->Gold <= $brow->Gold and $mtrow->Credits <= $crow->Credits) {
$all_gold_oke=0;
$all_credits_oke=0;

if ($mtrow->Gold > 0 and $mtrow->Gold <= $brow->Gold) {
$to_update .= ", `Gold`=`Gold`+$mtrow->Gold";$all_gold_oke++;
mysqli_query($link, "UPDATE `$tbl_members` SET `Gold`=`Gold`-$mtrow->Gold WHERE `Charname`='$brow->Charname' LIMIT 1") and $all_gold_oke++;
mysqli_query($link, "UPDATE `$tbl_smembers` SET `Gold`=`Gold`-$mtrow->Gold WHERE (`Charname`='$brow->Charname') LIMIT 10");
}

if ($mtrow->Credits > 0 and $mtrow->Credits <= $crow->Credits) {
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`+$mtrow->Credits WHERE `Charname`='$row->Charname' LIMIT 1") and $all_credits_oke++ or mysqli_query($link, "INSERT INTO $tbl_credits ($fld_credits) values ('', '$row->Username', '$row->Charname', '$mtrow->Credits')");
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`-$mtrow->Credits WHERE `Charname`='$mtrow->Bidder' LIMIT 1") and $all_credits_oke++;
}

if ($all_gold_oke >= 2 or $all_credits_oke >= 2) {
mysqli_query($link, "UPDATE `$tbl_charms` SET `Charname`='$mtrow->Bidder' WHERE (`id`='$mtrow->cid' and `Charname`='$row->Charname') LIMIT 1") and print("Sold a <b>$mtrow->Name</b> charm on the market for ".number_format($mtrow->Gold)." gold and ".number_format($mtrow->Credits)." Credits.<br>") or print("Can't buy <b>$mtrow->Name</b> charm.");
mysqli_query($link, "DELETE FROM $tbl_market WHERE (`id`=$mtrow->id and `Charname`='$row->Charname') LIMIT 1");

$news= "'','<b>$row->Charname</b> sold a <b>$mtrow->Name</b> charm to <b>$mtrow->Bidder</b> for <b>".number_format($mtrow->Gold)."</b> gold <b>".number_format($mtrow->Credits)."</b> credits.','$current_date'";
mysqli_query($link, "INSERT INTO `$tbl_paper` ($fld_paper) VALUES ($news)") or print("Unable to insert news.");
} else {
echo $mtrow->Bidder;?>
 doesn't have enough gold or credits!
 <?php 
}//oke
} else {
echo $mtrow->Bidder;?>
 doesn't have enough gold or credits!
<?php 
}

} else {
echo $mtrow->Bidder;?>
's charm slots are full.
<?php 
}

} elseif (!empty($bid)) {

$slots=0;
$query = "SELECT * FROM `$tbl_charms` WHERE `Charname`='$row->Charname' ORDER BY `id` ASC limit 10";
$result = mysqli_query($link, $query);
while ($csrow = mysqli_fetch_object ($result)) {
$slots++;
}
mysqli_free_result ($result);

if ($slots < 5) {
$query = "SELECT * FROM $tbl_market WHERE `id`=$bid ORDER BY `id` ASC limit 1";
$result = mysqli_query($link, $query);
$mtrow = mysqli_fetch_object ($result);
mysqli_free_result ($result);

if ($mtrow->id == $bid) {
$update_shit='';
$donhaveit=0;
$say_crap='';

if ($mtrow->Gold > 1) {
if ($row->Gold >= $mtrow->Gold*1.1) {
$say_crap = "You increased gold to ".number_format($mtrow->Gold*1.1)." gold.";
$update_shit="Gold=Gold*1.1";
} else {
$donhaveit++;
}
}
if ($mtrow->Credits > 1) {
$query = "SELECT * FROM `$tbl_credits` WHERE (`Charname`='$row->Charname') ORDER BY `id` DESC limit 1";
$result = mysqli_query($link, $query) or die("$error_message : Query failed");
$crow = mysqli_fetch_object ($result) or $crow->Credits=0;
mysqli_free_result ($result);
if ($crow->Credits >= $mtrow->Credits*1.1) {
$say_crap = "$say_crap<br>You increased credits to ".number_format($mtrow->Credits*1.1)." credits.";
if ($update_shit) {$update_shit="$update_shit,Credits=Credits*1.1";} else {$update_shit="Credits=Credits*1.1";}
} else {
$donhaveit++;
echo "Dont have credits.";
}
}
if ($donhaveit <= 0) {
mysqli_query($link, "UPDATE $tbl_market SET $update_shit,Bidder='$row->Charname',Bids=Bids+1 WHERE `id`=$bid LIMIT 1") and print("$say_crap");
} else {
?>
<br><b>You don't have enough gold or credits!</b>
<?php 
}
}

} else {
?>
Your charm slots are full.
<?php 
}

} elseif (!empty($retract)) {

$query = "SELECT * FROM $tbl_market WHERE `id`=$retract ORDER BY `id` ASC limit 1";
$result = mysqli_query($link, $query);
$mtrow = mysqli_fetch_object ($result);
mysqli_free_result ($result);

$slots=0;
$query = "SELECT * FROM `$tbl_charms` WHERE `Charname`='$row->Charname' ORDER BY `id` ASC limit 10";
$result = mysqli_query($link, $query);
while ($csrow = mysqli_fetch_object ($result)) {
$slots++;
}
mysqli_free_result ($result);

if ($mtrow->id == $retract and $mtrow->Charname == $row->Charname and $slots < 5) {
$ret_charm	= "'', '$mtrow->Charname', '$mtrow->Name', '$mtrow->Strength', '$mtrow->Dexterity', '$mtrow->Agility', '$mtrow->Intelligence', '$mtrow->Concentration', '$mtrow->Contravention', $current_time+10000";
?><b>You have retracted your charm from the market.</b><?php 
mysqli_query($link, "DELETE FROM $tbl_market WHERE (`id`=$mtrow->id and `Charname`='$row->Charname') LIMIT 1");


$ncquery = "SELECT * FROM `$tbl_charms` WHERE `Charname`='$row->Charname' ORDER BY `id` DESC limit 1";
$ncresult = mysqli_query($link, $ncquery);
$cmrow = mysqli_fetch_object ($ncresult);
mysqli_free_result ($ncresult);
mysqli_query($link, "INSERT INTO `lol_zlogs` ($fld_logs) values ('','$row->Charname','NEW CHARM ID ASSIGNED $cmrow->id','$PHP_SELF','$current_date','$REMOTE_ADDR')");

} else {
?>
Your charm slots are full.
<?php 
}

} else {

if (empty($sort)) {
$sort='id';
$sort_txt='';
} else {
$sort_txt="&sort=$sort";
}
?>
<table cellpadding=0 cellspacing=1 border=0 width=100%><tr>
<th colspan=16>Charm market</a></th></tr><tr bgcolor="<?php echo $col_th; ?>">
<td><a href="?sort=id">No:#</a></td><td>Owner</td><td>Charm name</td><td><a href="?sort=Strength">Str</a></td><td><a href="?sort=Dexterity">Dex</a></td><td><a href="?sort=Agility">Agi</a></td><td><a href="?sort=Intelligence">Int</a></td><td><a href="?sort=Concentration">Ccn</a></td><td><a href="?sort=Contravention">Cnt</a></td><td><a href="?sort=Gold">Gold</a></td><td><a href="?sort=Credits">Credits</a></td><td>Bidder</td><td><a href="?sort=Time">Bids</a></td><td><a href="?sort=Time">Time</a></td><td><a href="?desc=1<?php echo $sort_txt; ?>">v</a> Do <a href="?desc=0<?php echo $sort_txt; ?>">^</a></td></tr>
<?php 
if (empty($sid)) {
	$where_is="id";
} else {
	if (!empty($do)) {
	if ($do=='next') {
	$where_is="id<$sid";
	} else {
	$where_is="id>$sid";
	}
	} else {
	$where_is="id";
	}
}
$num=1;

if (!empty($desc)) {$desc='asc';} else { $desc='desc';}

$query = "SELECT * FROM $tbl_market WHERE $where_is ORDER BY $sort $desc limit 50";
$result = mysqli_query($link, $query);

while ($mtrow = mysqli_fetch_object ($result)) {
$last_id=$mtrow->id;
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_form\"";} else {$bgcolor='';}
?>

<tr<?php echo $bgcolor;?>><td><?php echo $num; ?></td><td><?php echo $mtrow->Charname; ?></td><td><?php echo $mtrow->Name; ?></td><td><?php echo number_format($mtrow->Strength); ?><td><?php echo number_format($mtrow->Dexterity); ?><td><?php echo number_format($mtrow->Agility); ?><td><?php echo number_format($mtrow->Intelligence); ?><td><?php echo number_format($mtrow->Concentration); ?><td><?php echo number_format($mtrow->Contravention); ?><td><?php 	if ($mtrow->Gold >= 1e50) {$mtrow->Gold='Allot';} else {echo lint($mtrow->Gold);} ?></td><td><?php echo number_format($mtrow->Credits); ?></td><td><?php echo $mtrow->Bidder; ?></td><td><?php echo number_format($mtrow->Bids); ?></td><td><?php 

$time_on=$current_time-$mtrow->Time;
if ($time_on >= 86400) {
$time_on=($current_time-$mtrow->Time)/86400;
$time_what='D';
} elseif ($time_on >= 3600) {
$time_on=($current_time-$mtrow->Time)/3600;
$time_what='H';
} elseif ($time_on >= 60) {
$time_on=($current_time-$mtrow->Time)/60;
$time_what='M';
} else {
$time_what='S';
}
echo number_format($time_on).$time_what;
?></td><td>
<?php 
if ($time_on >= 6 and $time_what == 'D') {
if ($mtrow->Name == 'Gods charm' or $mtrow->Name == 'Heavenly charm') {
if ($mtrow->Charname == $row->Charname) {
if ($mtrow->Bids) {
echo "<a href=\"?sell=$mtrow->id\">Sell</a>";
}
echo " <a href=\"?retract=$mtrow->id\">Retract</a>";
} else {
echo "<font size=1 color=red>Timeout</font>";
}
} else {
echo "<font size=1 color=red>Deleted</font>";
mysqli_query($link, "DELETE FROM $tbl_market WHERE `id`=$mtrow->id LIMIT 1");
}
} else {
if ($mtrow->Charname == $row->Charname) {

if ($mtrow->Bids) {
echo "<a href=\"?sell=$mtrow->id\">Sell</a>";
}
echo " <a href=\"?retract=$mtrow->id\">Retract</a>";

} else {
echo "<a href=\"?bid=$mtrow->id\">Bid</a>";
if ($mtrow->Bidder == $row->Charname) {echo " <a href=\"?cancel=$mtrow->id\"> Cancel</a>";}
}
} //time not gone
?>
</td>
</tr>
<?php 
$num++;
if ($mtrow->id < $last_id) {$last_id=$mtrow->id;}
}
mysqli_free_result ($result);

?>
</table>
<?php 
if ($num >= 25 or !empty($do)) {
echo "<a href=\"?sid=$last_id&do=previous\"><::previous </a>";
echo "<a href=\"?sid=$last_id&do=next\"> next::></a>";
}

}// bid is not empty
?>
<p>
Bid will increase the price of gold and/or credits by 10%<br>
All charms bought on the market will have <?php echo number_format($charm_time);?> seconds time on it.<br>
If you don't have enough gold or credits you will lose 5% of your gold and exp!
<?php 
include_once $game_footer;
?>