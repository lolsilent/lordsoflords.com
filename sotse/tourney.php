<font size=+2 color=red><b>BUG FOUND SCRIPTS HAS BEEN DISABLED FOR TESTING</b></font><?php exit;
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/array.guilds.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/array.races.php';
require_once 'AdMiN/www.clan.php';

if (!empty($_GET['touring'])) {
if ($_GET['touring'] == 1) {
setcookie ("lol_touring", "1",time()+60*60*5) or die("$error_message : Cookie failure");$_COOKIE['lol_touring']=1;
} else {
setcookie ("lol_touring", "1",time()-60*60*5000) or die("$error_message : Cookie failure");$_COOKIE['lol_touring']='';
}
}
include_once $game_header;

$result = mysqli_query($link, "SELECT * FROM $tbl_tournament WHERE `id`=1 ORDER BY `id` DESC LIMIT 1") or die(mysqli_error($link));
$tourrow = mysqli_fetch_object ($result);
mysqli_free_result ($result);
$tourstart=$tourrow->Time-$current_time;
if ($tourstart < 0) {$tourstart=0;$next_match='';} else {$next_match="<br>Next match starts in ".number_format($tourstart)." seconds";}
?>
<table width=100% border=0 cellpadding=0 cellspacing=1>
<?php 
if (!empty($row->Guild)) {
$result = mysqli_query($link, "SELECT * FROM $tbl_guilds WHERE (Guild='$row->Guild') ORDER BY `id` DESC LIMIT 1") or die('10');
if (!empty($result)) {
$grow = mysqli_fetch_object ($result);
mysqli_free_result ($result);

$result = mysqli_query($link, "SELECT id FROM $tbl_tournament WHERE id");
$total_tournaments = mysqli_num_rows($result);
mysqli_free_result ($result);

if ($total_tournaments <= 1) {
	//NOT STARTED
$allguilds=array();
$result = mysqli_query($link, "SELECT * FROM $tbl_guilds WHERE (id and Tournament=1) ORDER BY `id` ASC");
$total_guilds_tour = mysqli_num_rows($result);
if ($total_guilds_tour >= $need_guilds) {

$winguilds=array();
$winresult = mysqli_query($link, "SELECT * FROM $tbl_tourwinner WHERE `id` ORDER BY `id` DESC LIMIT 10");
$counted=0;
while ($winrow = mysqli_fetch_object ($winresult)) {
if ($counted <= $out_of_tour) {
array_push($winguilds, $winrow->Winner);
} else {
mysqli_query($link, "DELETE LOW_PRIORITY FROM $tbl_tourwinner WHERE `id`=$winrow->id LIMIT 1");
}
$counted++;
}
mysqli_free_result ($winresult);

while ($grow = mysqli_fetch_object ($result)) {
$total_members=0;
$mtresult = mysqli_query($link, "SELECT id FROM $tbl_members WHERE Guild='$grow->Guild' LIMIT 3");
$total_members = mysqli_num_rows($mtresult);
mysqli_free_result ($mtresult);
if ($total_members >= 1) {
if (!in_array($grow->Guild,$winguilds)) {
array_push($allguilds, $grow->Guild);
}
} else {
mysqli_query($link, "DELETE LOW_PRIORITY FROM $tbl_guilds WHERE `id`=$grow->id LIMIT 1");
}
}
} else {
?><tr><th>Waiting for more Guilds to join the tournament need at least <?php echo $need_guilds; ?> guilds to start a tournament we have <?php echo $total_guilds_tour; ?> Guilds now.</th></tr></table><?php 
include_once $game_footer;
exit;
}
mysqli_free_result ($result);
$allguilds=array_unique($allguilds);
shuffle($allguilds);

$start=$match_time;$i=1;
foreach ($allguilds as $val) {
if (empty($teama)) {$teama=$val;} else {$teamb=$val;}
if ($i==2 and !empty($teama) and !empty($teamb)) {
$safe_tour = "'', '$teama', '$teamb', '', ".($current_time+$start).", 0, $current_time";
mysqli_query($link, "INSERT INTO $tbl_tournament ($fld_tournament) values ($safe_tour)");
mysqli_query($link, "UPDATE $tbl_tournament SET Starts=1 WHERE `id`=1 LIMIT 1");
$i=0;$start+=$match_time;$teama='';$teamb='';}$i++;
}
?><tr><th><b>Please stand by scheduling tournament matches for <?php echo $total_guilds_tour; ?> guilds.</b></th></tr><?php 

$safe_ptour = "'', '<center><b>THE TOURNAMENT HAS STARTED A NEW SEASON', 'Everything has been prepared good luck to all the guilds of $title!', '$current_date'";
mysqli_query($link, "INSERT INTO $tbl_tourpaper ($fld_tourpaper) values ($safe_ptour)") or die(mysqli_error($link));

	//NOT STARTED
} elseif (($tourrow->Time-$current_time) <= 0 and $tourrow->Starts >= 0 and $total_tournaments >= 2) {
	//START STARTED
?><tr><th colspan=5>Tournament Round <?php echo $tourrow->Starts.$next_match; ?></th></tr>
<tr><td>#</td><td>Matching Guilds</td><td>Match in</td><td>Winner</td></tr><?php 
$result = mysqli_query($link, "SELECT * FROM $tbl_tournament WHERE id!=1 ORDER BY `id` ASC");
if (!empty($result)) {
$remaining_matches = mysqli_num_rows($result);
$match_num=1;$match_done=1;
while ($trow = mysqli_fetch_object ($result)) {
$starting=$trow->Starts-$current_time;if ($starting<=0) {$starting=0;}
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"$col_th\"";} else {$bgcolor='';}
if (!empty($trow->Winner)) {$winneris="[$trow->Winner]";} else {$winneris='';}
echo "<tr$bgcolor><td>$match_num</td><td><b>[$trow->Teama] versus [$trow->Teamb]</td><td>".number_format($starting)." seconds</td><td>$winneris";

	//TEAMCHECK
$teamaoke=0;$teamboke=0;
$tresults = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE Guild='$trow->Teama' ORDER BY `id` ASC");
if (!empty($tresults)) {
$teamaoke = mysqli_num_rows($tresults);
mysqli_free_result ($tresults);
			//echo "TEST $teamaoke Team a oke";
}
$tresults = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE Guild='$trow->Teamb' ORDER BY `id` ASC");
if (!empty($tresults)) {
$teamboke = mysqli_num_rows($tresults);
mysqli_free_result ($tresults);
			//echo "TEST $teamboke Team a oke";
}
	//TEAMCHECK
	//echo "$starting<=0 and empty($trow->Winner) and $teamaoke >= 1 and $teamboke >= 1";
$match_num++;
if ($starting<=0 and empty($trow->Winner) and $teamaoke >= 1 and $teamboke >= 1) {
	//GUILDS ROW
$garesult = mysqli_query($link, "SELECT * FROM $tbl_guilds WHERE (Guild='$trow->Teama') ORDER BY `id` DESC LIMIT 1");
$garow = mysqli_fetch_object ($garesult);
mysqli_free_result ($garesult);
$gbresult = mysqli_query($link, "SELECT * FROM $tbl_guilds WHERE (Guild='$trow->Teamb') ORDER BY `id` DESC LIMIT 1");
$gbrow = mysqli_fetch_object ($gbresult);
mysqli_free_result ($gbresult);
	//GUILDS ROW
	//STATS

$mresult = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (Guild='$trow->Teama') ORDER BY Level desc LIMIT 10");
$teama_power = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
while ($mrow = mysqli_fetch_object ($mresult)) {
$cmstats=clanstats($mrow);
$i=0;foreach ($cmstats as $val) {$teama_power[$i]+=$val;$i++;}
	//echo lint(array_sum($cmstats))."| $mrow->id | $cmstats[1]<br>";
} //END while
mysqli_free_result ($mresult);
?><p><?php 
$mresult = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (Guild='$trow->Teamb') ORDER BY Level desc LIMIT 10");
$teamb_power = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
while ($mrow = mysqli_fetch_object ($mresult)) {
$cmstats=clanstats($mrow);
$i=0;foreach ($cmstats as $val) {$teamb_power[$i]+=$val;$i++;}
	//echo lint(array_sum($cmstats))."| $mrow->id | $cmstats[1]<br>";
} //END while
mysqli_free_result ($mresult);


if (in_array($garow->Special,$array_guilds)) {$garow->Special='Honor Castle';}
if (in_array($gbrow->Special,$array_guilds)) {$gbrow->Special='Honor Castle';}
array_push($teama_power, $trow->Teama, $trow->Teamb,$garow->Special);
array_push($teamb_power, $trow->Teamb, $trow->Teama,$gbrow->Special);

$teama_power[10]*=$array_guilds["$teama_power[30]"][0];
$teama_power[21]*=$array_guilds["$teama_power[30]"][0];
$teama_power[11]*=$array_guilds["$teama_power[30]"][1];
$teama_power[22]*=$array_guilds["$teama_power[30]"][1];
$teama_power[12]*=$array_guilds["$teama_power[30]"][2];

$teamb_power[10]*=$array_guilds["$teamb_power[30]"][0];
$teamb_power[21]*=$array_guilds["$teamb_power[30]"][0];
$teamb_power[11]*=$array_guilds["$teamb_power[30]"][1];
$teamb_power[22]*=$array_guilds["$teamb_power[30]"][1];
$teamb_power[12]*=$array_guilds["$teamb_power[30]"][2];

$teama_gpower=array_sum($teama_power);
$i=0;foreach ($teama_power as $val) {$pteama_power[$i]=number_format($val);$i++;}

$teamb_gpower=array_sum($teamb_power);
$i=0;foreach ($teamb_power as $val) {$pteamb_power[$i]=number_format($val);$i++;}

$ppp1 = array(
"Weapon Damage",
"Attack Spell",
"Heal Spell",
"Magic Shield",
"Defence",
"Attack Rating",
"Magic Rating",
"Life");
$ppp2 = array(
"$pteama_power[0]",
"$pteama_power[2]",
"$pteama_power[4]",
"$pteama_power[6]",
"$pteama_power[8]",
"$pteama_power[21]",
"$pteama_power[22]",
"$pteama_power[12]");
$ppp3 = array(
"$pteama_power[1]",
"$pteama_power[3]",
"$pteama_power[5]",
"$pteama_power[7]",
"$pteama_power[9]",
"$pteama_power[10]",
"$pteama_power[11]","");
$ppp4 = array(
"$pteamb_power[0]",
"$pteamb_power[2]",
"$pteamb_power[4]",
"$pteamb_power[6]",
"$pteamb_power[8]",
"$pteamb_power[21]",
"$pteamb_power[22]",
"$pteamb_power[12]");
$ppp5 = array(
"$pteamb_power[1]",
"$pteamb_power[3]",
"$pteamb_power[5]",
"$pteamb_power[7]",
"$pteamb_power[9]",
"$pteamb_power[10]",
"$pteamb_power[11]","");

$total_aclan_power = "
<table width=100% cellpadding=0 cellspacing=0 border=1><tr><th colspan=5>[$trow->Teama] versus [$trow->Teamb]</th></tr>
<tr><td valign=top>Stats</td><td>Min</td><td>Max</td><td>Min</td><td>Min</td></tr>
";
$i=0;
foreach ($ppp1 as $val) {
$total_aclan_power = "$total_aclan_power<tr><td>$ppp1[$i]</td><td>$ppp2[$i]</td><td>$ppp3[$i]</td><td>$ppp4[$i]</td><td>$ppp5[$i]</td></tr>";
$i++;}
$total_aclan_power = "$total_aclan_power<tr><th>Total </th><th colspan=2>".number_format($teama_gpower)."</th><th colspan=2>".number_format($teamb_gpower)."</th></tr></table>
";
	//STATS
	//BATTLE ON
$battles=1;$txt_out='';
if ($teama_power[0] and $teamb_power[0]) {
while ($teama_power[12] >=0 and $teamb_power[12] >=0) {
if ($teama_power[1] > $teama_power[3]) {
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teamb_power[12], $txtwep)=weapon($teama_power,$teamb_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teama_power[12], $txtwep)=weapon($teamb_power,$teama_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teamb_power[12], $txtwep)=magic($teama_power,$teamb_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teama_power[12], $txtwep)=magic($teamb_power,$teama_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teamb_power[12], $txtwep)=heal($teama_power,$teamb_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teama_power[12], $txtwep)=heal($teamb_power,$teama_power);} else {break;}
	$txt_out="$txt_out$txtwep";
} else {
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teamb_power[12], $txtwep)=magic($teama_power,$teamb_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teama_power[12], $txtwep)=magic($teamb_power,$teama_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teamb_power[12], $txtwep)=weapon($teama_power,$teamb_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teama_power[12], $txtwep)=weapon($teamb_power,$teama_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teamb_power[12], $txtwep)=heal($teama_power,$teamb_power);} else {break;}
	$txt_out="$txt_out$txtwep";
if ($teama_power[12] >=0 and $teamb_power[12] >=0) {
	list ($teama_power[12], $txtwep)=heal($teamb_power,$teama_power);} else {break;}
	$txt_out="$txt_out$txtwep";
}
$battles++;
if ($battles >= 100) {break;}
}
}

if ($teama_power[12] <= 0 and $teamb_power[12] >0) {
$outcome = "[$teama_power[29]] won from [$teama_power[28]]!";
mysqli_query($link, "UPDATE $tbl_guilds SET Won=Won+1 WHERE `id`=$gbrow->id LIMIT 1") or $FAILEDFUCKER=1;
mysqli_query($link, "UPDATE $tbl_guilds SET Lost=Lost+1 WHERE `id`=$garow->id LIMIT 1") or $FAILEDFUCKER=1;
$won_by=$teama_power[29];
} elseif ($teamb_power[12] <= 0 and $teama_power[12] >0) {
$outcome = "[$teamb_power[29]] won from [$teamb_power[28]]!";
mysqli_query($link, "UPDATE $tbl_guilds SET Won=Won+1 WHERE `id`=$garow->id LIMIT 1") or $FAILEDFUCKER=1;
mysqli_query($link, "UPDATE $tbl_guilds SET Lost=Lost+1 WHERE `id`=$gbrow->id LIMIT 1") or $FAILEDFUCKER=1;
$won_by=$teamb_power[29];
} else {

$outcome = "[$teamb_power[29]] versus [$teamb_power[28]] tied.";
mysqli_query($link, "UPDATE $tbl_guilds SET Tied=Tied+1 WHERE `id`=$gbrow->id LIMIT 1") or $FAILEDFUCKER=1;
mysqli_query($link, "UPDATE $tbl_guilds SET Tied=Tied+1 WHERE `id`=$garow->id LIMIT 1") or $FAILEDFUCKER=1;

$tiresult = mysqli_query($link, "SELECT * FROM $tbl_tourpaper WHERE `id` ORDER BY `id` DESC LIMIT 10");
if (!empty($tiresult)) {
$already_tied=0;
while ($titrow = mysqli_fetch_object ($tiresult)) {
if (preg_match("/\b$teamb_power[29]\b/i", "$titrow->Versus") and preg_match("/\b$teamb_power[29]\b/i", "$titrow->Versus")) {$already_tied++;}
}
mysqli_free_result ($tiresult);
$outcome="$outcome";
}//resilt tied
if ($already_tied >= 2) {
	if ($teama_power[12] > $teamb_power[12]) {
$outcome = "[$teama_power[29]] won from [$teama_power[28]] with life vote!";
mysqli_query($link, "UPDATE $tbl_guilds SET Won=Won+1 WHERE `id`=$gbrow->id LIMIT 1") or $FAILEDFUCKER=1;
mysqli_query($link, "UPDATE $tbl_guilds SET Lost=Lost+1 WHERE `id`=$garow->id LIMIT 1") or $FAILEDFUCKER=1;
$won_by=$teama_power[29];
	} else {
$outcome = "[$teamb_power[29]] won from [$teamb_power[28]] with life vote!";
mysqli_query($link, "UPDATE $tbl_guilds SET Won=Won+1 WHERE `id`=$garow->id LIMIT 1") or $FAILEDFUCKER=1;
mysqli_query($link, "UPDATE $tbl_guilds SET Lost=Lost+1 WHERE `id`=$gbrow->id LIMIT 1") or $FAILEDFUCKER=1;
$won_by=$teamb_power[29];
	}

	}
}//else

if ($remaining_matches <= 1) {
$round_news="<b>Final match $outcome</b>";
} else {
$round_news="Round $tourrow->Starts match $outcome";
}
$safe_ptour = "'', '$round_news', '$total_aclan_power$txt_out<p><b>Fought for $battles rounds<br>$outcome</b>', '$current_date'";
mysqli_query($link, "INSERT INTO $tbl_tourpaper ($fld_tourpaper) values ($safe_ptour)") or $FAILEDFUCKER=1;
if (!empty($won_by)) {
mysqli_query($link, "UPDATE $tbl_tournament SET Winner='$won_by', Ends=1 WHERE `id`=$trow->id LIMIT 1") or $FAILEDFUCKER=1; $won_by='';
}
if (!empty($FAILEDFUCKER)) {
mysqli_query($link, "DELETE LOW_PRIORITY FROM $tbl_tournament WHERE `id`=$trow->id LIMIT 1");
}

echo "$outcome";
	//BATTLE ON
if (empty($outcome)) {
mysqli_query($link, "UPDATE $tbl_tournament SET Starts=0 WHERE `id`=1 LIMIT 1");
}
} elseif(!empty($trow->Winner)) {
$match_done++;
	//Winner for the next round
if ($match_done == $match_num and $match_done == $total_tournaments) {

/*_______________-=TheSilenT.CoM=-_________________*/

$winnersare = array();
$wresult = mysqli_query($link, "SELECT * FROM $tbl_tournament WHERE id!=1 ORDER BY `id` ASC");
$match_num=1;$match_done=1;
while ($wtrow = mysqli_fetch_object ($wresult)) {
array_push($winnersare, $wtrow->Winner);
}
mysqli_free_result ($wresult);
$winnersare = array_unique($winnersare);
mysqli_query($link, "DELETE LOW_PRIORITY FROM $tbl_tournament WHERE id>1");
if (count($winnersare) >= 2) {
$start=$match_time;$i=1;$made_round='';
foreach ($winnersare as $val) {
if (empty($teama)) {$teama=$val;} else {$teamb=$val;}
if ($i==2 and !empty($teama) and !empty($teamb)) {
$safe_tour = "'', '$teama', '$teamb', '', ".($current_time+$start).", 0, $current_time";
mysqli_query($link, "INSERT INTO $tbl_tournament ($fld_tournament) values ($safe_tour)") or die(mysqli_error($link));
$i=0;$start+=$match_time;$teama='';$teamb='';}$i++;
$made_round="$made_round [$val]";
}
if (!empty($made_round)) {
mysqli_query($link, "UPDATE $tbl_tournament SET Starts=Starts+1 WHERE `id`=1 LIMIT 1") or die(mysqli_error($link));
$safe_ptour = "'', '<center><b>End of round $tourrow->Starts','$made_round are going to the next round.', '$current_date'";
mysqli_query($link, "INSERT INTO $tbl_tourpaper ($fld_tourpaper) values ($safe_ptour)") or die(mysqli_error($link));
}// made it!!!
} else {
	$win_exp=0;
	$win_gold=0;
	$awarded_winners='';
$mwresult = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (Guild='$winnersare[0]') ORDER BY Level desc LIMIT 10");
while ($mwrow = mysqli_fetch_object ($mwresult)) {
	$win_exp=$win_exp+($mwrow->Exp/100);
	$win_gold=$win_gold+($mwrow->Gold/100)+($mwrow->Stash/100);
	$awarded_winners="$awarded_winners<br>[$mwrow->Guild] $mwrow->Sex $mwrow->Charname";
mysqli_query($link, "UPDATE `$tbl_members` SET `Exp`=`EXP`+($mwrow->Exp/100), `Gold`=`Gold`+($mwrow->Gold/100), Stash=Stash+($mwrow->Stash/100) WHERE `id`=$mwrow->id LIMIT 1") or die("Error id : $mwrow->id".mysqli_error($link));
}
mysqli_free_result ($mwresult);

$winner_tour = "<center><b>WINNER OF THE TOURNAMENT IS [$winnersare[0]]</b>";
$winnings_tour = "The guild members received a total of ".number_format($win_exp)." exp and ".number_format($win_gold)." gold for their victorious tournament. $awarded_winners";
$safe_tour = "'', '$winner_tour', '$winnings_tour', '$current_date'";
mysqli_query($link, "INSERT INTO $tbl_tourpaper ($fld_tourpaper) values ($safe_tour)") or die(mysqli_error($link));
$tour_winner = "'','$winnersare[0]',$current_time";
mysqli_query($link, "INSERT INTO $tbl_tourwinner ($fld_tourwinner) values ($tour_winner)") or die(mysqli_error($link));

}//counted array

/*_______________-=TheSilenT.CoM=-_________________*/

}//all done go for next round
	//echo " - $match_done - $match_num- $total_tournaments $trow->Winner ";
	//Winner for the next round
} elseif ($teamaoke <= 0 and $teamboke >= 1) {
	mysqli_query($link, "UPDATE $tbl_tournament SET Winner='$trow->Teamb', Ends=1 WHERE `id`=$trow->id LIMIT 1") or die("ID 250".mysqli_error($link));
	echo "[$trow->Teamb] won from [$trow->Teama]";
} elseif ($teamaoke >= 1 and $teamboke <= 0) {
	mysqli_query($link, "UPDATE $tbl_tournament SET Winner='$trow->Teama', Ends=1 WHERE `id`=$trow->id LIMIT 1") or die("ID 251".mysqli_error($link));
	echo "[$trow->Teama] won from [$trow->Teamb]";
} elseif ($teamaoke <= 0 and $teamboke <= 0) {
	mysqli_query($link, "DELETE LOW_PRIORITY FROM $tbl_tournament WHERE `id`=$trow->id") or die("ID 252".mysqli_error($link));
	echo "Match [$trow->Teama] vs [$trow->Teamb] disqualified!";
}//starting

} // while
mysqli_free_result ($result);
}//results
	//START STARTED
} //start or not


} else {
mysqli_query($link, "UPDATE LOW_PRIORITY $tbl_members SET Guild='' WHERE `id`=$row->id LIMIT 1") or die(mysqli_error($link));
} //have results
?></td></tr><?php 
} else {
?>
<tr><td>
You can join the competitive tournament of <?php echo $title;?> after your have create or joined a clan. Winning a tournament will increase all your team guild members experience by 1%.
</td></tr>
<?php 
}//empty guild
?>
</table>
<?php 
if (!empty($winner_tour)) {echo $winner_tour.'<br>'.$winnings_tour;}
if (!empty($made_round)) {echo "$made_round are going to the next round!";}
if (empty($_COOKIE['lol_touring'])) {
?><a href="<?php echo $PHP_SELF;?>?touring=1">[Enable tournament timer]</a><?php 
} elseif (!empty($_COOKIE['lol_touring'])) {
?><a href="<?php echo $PHP_SELF;?>?touring=2">[Disable tournament timer]</a><?php 
}

include_once $game_footer;
?>