<?php 
function next_level() {
global $row;
$next_level = ((($row->Level/10)*500)+$row->Level)*($row->Level*$row->Level)+449;
return $next_level;
}

function myfriend ($exp,$gold,$friend) {
global $tbl_members,$row;
$mquery = "SELECT * FROM $tbl_members WHERE Charname='$friend' ORDER BY id desc LIMIT 1";
$mresult = mysqli_query($link, $mquery) or die ("Query failed");
if ($mresult) {
$mrow = mysqli_fetch_object ($mresult);
mysqli_free_result ($mresult);
$exp/=10;$gold/=10;
if ($exp > $mrow->Exp) {
$exp = $mrow->Exp/100;
if ($exp < $mrow->Level) {$exp=$mrow->Level;}
}
if ($gold > $mrow->Gold) {
$gold = $mrow->Gold/100;
if ($gold < $mrow->Gold) {$gold=$mrow->Gold;}
}

if($row->Friend !== $mrow->Friend){
mysqli_query($link, "UPDATE LOW_PRIORITY $tbl_members SET Exp=Exp+$exp, Gold=Gold+$gold WHERE Charname='$friend' LIMIT 1") or die(mysqli_error($link));
}

}

}

function battlestats($row,$races_array) {
global $tbl_charms;
$bonus=array(0,0,0,0,0,0);
$query = "SELECT * FROM $tbl_charms WHERE (Charname='$row->Charname') ORDER BY id desc limit 5";
$result = mysqli_query($link, $query);
$num=0;
while ($cmrow = mysqli_fetch_object ($result)) {
if ($cmrow->Time > time()) {
$bonus[0]+=$cmrow->Strength;
$bonus[1]+=$cmrow->Dexterity;
$bonus[2]+=$cmrow->Agility;
$bonus[3]+=$cmrow->Intelligence;
$bonus[4]+=$cmrow->Concentration;
$bonus[5]+=$cmrow->Contravention;
}
}
mysqli_free_result ($result);

if (array_sum($bonus) >= 1) {
$row->Strength+=($row->Strength/100)*$bonus[0];
$row->Dexterity+=($row->Dexterity/100)*$bonus[1];
$row->Agility+=($row->Agility/100)*$bonus[2];
$row->Intelligence+=($row->Intelligence/100)*$bonus[3];
$row->Concentration+=($row->Concentration/100)*$bonus[4];
$row->Contravention+=($row->Contravention/100)*$bonus[5];
}

if (!in_array($row->Race,array_keys($races_array))) {$row->Race='Human';}

$tot_stats= $row->Strength+$row->Dexterity+$row->Agility+$row->Intelligence+$row->Concentration+$row->Contravention; if ($tot_stats <= 0) {$tot_stats=100;}
$base_attack= ($row->Strength/$tot_stats)*$races_array["$row->Race"][1];
$load= ($row->Armor+$row->Helmet+$row->Shield+$row->Belt+$row->Pants+$row->Hand+$row->Feet);
$base_defend= ($row->Agility/$tot_stats)*$races_array["$row->Race"][2]+($load);
$base_magic= ($row->Intelligence/$tot_stats)*$races_array["$row->Race"][3];
$os[0]	= $row->Strength*(1+$base_attack+$row->Hand+$row->Weapon);
$os[1]	= $os[0]*2.555555;
$os[2]	= $row->Intelligence*(1+$row->Ring+$base_magic+$row->Attackspell);
$os[3]	= $os[2]*2.555555;
$os[4]	= $row->Intelligence*(1+$row->Amulet+$base_magic+$row->Healspell);
$os[5]	= $os[4]*2.555555;
$os[6]	= $row->Contravention*(1+$row->Ring+$row->Amulet+$base_magic);
$os[7]	= $os[6]*2.555555;
$os[8]	= $row->Agility*(1+$row->Shield+$base_defend);
$os[9]	= $os[8]*2.555555;
$os[10]	= $row->Dexterity*(1+$base_attack+$row->Feet+$row->Level+$races_array["$row->Race"][2]);
$os[11]	= $row->Concentration*(1+$base_magic+$row->Belt+$row->Level+$races_array["$row->Race"][3]);
$os[12]	= $row->Life;
$os[13]	= $row->Exp;
$os[14]	= $row->Gold;
$os[15]	= $row->Charname;
$os[16]	= $row->Life;
$os[17]	= "";
$os[18]	= "";
$os[19]	= "";
$os[20]	= (1+($row->Agility/$tot_stats))*$races_array["$row->Race"][4];
$os[21]	= $os[10]/2.5;
$os[22]	= $os[11]/2.5;
$os[23]	= $row->Level;
return $os;
}
//battlestats

$divs = array (1.5, 1.6, 1.7, 1.8, 1.9,2.0, 2.1, 2.2, 2.3, 2.4,2.5, 2.6, 2.7, 2.8, 2.9,3.0, 3.1, 3.2, 3.3, 3.4,3.5);

//weapon
function weapon($def,$opp,$wll,$divs) {
print "<font color=\"#FF0000\">";
$randdiv = array_rand ($divs, 2);
$def_ar = ($def[10]+$def[21])/$divs[$randdiv[0]];
$opp_ar = ($opp[10]+$opp[21])/$divs[$randdiv[1]];

if ($def_ar < $def[21]) {$def_ar=$def[21];} elseif ($def_ar > $def[10]) {$def_ar=$def[10];}
if ($opp_ar < $opp[21]) {$opp_ar=$opp[21];} elseif ($opp_ar > $opp[10]) {$opp_ar=$opp[10];}

if ($def_ar >= $opp_ar) {
$def_damage = ($def[0]+$def[1])/$divs[$randdiv[0]];
$opp_defense = ($opp[8]+$opp[9])/$divs[$randdiv[1]];

	$def_damage-=$opp_defense;
	if ($def_damage <= 0) {
		print "$wll[1] strike got blocked!";
	} else {
		$opp[12]-=$def_damage;
		$def_damage = number_format($def_damage, 0, '', '.');
		$opp_defense = number_format($opp_defense, 0, '', '.');
print "$wll[0] hit $wll[5] for $def_damage! <font size=-1>$wll[3] blocked for $opp_defense.</font>";
	}
} else {
	print "$wll[0] missed! ";
}
print "</font><br>";
return $opp[12];
}
//weapon

//magic
function magic($def,$opp,$wll,$divs) {
print "<font color=\"#8888FF\">";
$randdiv = array_rand ($divs, 2);
$def_mr = ($def[11]+$def[22])/$divs[$randdiv[0]];
$opp_mr = ($opp[11]+$opp[22])/$divs[$randdiv[1]];

if ($def_mr < $def[22]) {$def_mr=$def[22];} elseif ($def_mr > $def[11]) {$def_mr=$def[11];}
if ($opp_mr < $opp[22]) {$opp_mr=$opp[22];} elseif ($opp_mr > $opp[11]) {$opp_mr=$opp[11];}

if ($def_mr >= $opp_mr) {
$randdiv = array_rand ($divs, 2);
$def_spell = ($def[2]+$def[3])/$divs[$randdiv[0]];
$m_shield = ($opp[6]+$opp[7])/$divs[$randdiv[1]];

	$def_spell-=$m_shield;
	if ($def_spell <= 0) {
		print "$wll[1] spell got blocked! ";
	} else {
		$opp[12]-=$def_spell;
		$def_spell = number_format($def_spell, 0, '', '.');
		$m_shield = number_format($m_shield, 0, '', '.');
print "$wll[0] cast for $def_spell!<font size=-1>$wll[4] magic shield took $m_shield.</font>";
	}
} else {
	print "$wll[1] spell fizzles!";
}
print "</font><br>";
return $opp[12];
}
//magic

//heal
function heal($def,$opp,$wll,$divs) {
print "<font color=\"#88FF88\">";
$randdiv = array_rand ($divs, 2);
$def_mr = ($def[11]+$def[22])/$divs[$randdiv[0]];
$opp_mr = ($opp[11]+$opp[22])/$divs[$randdiv[1]];

if ($def_mr < $def[22]) {$def_mr=$def[22];} elseif ($def_mr > $def[11]) {$def_mr=$def[11];}
if ($opp_mr < $opp[22]) {$opp_mr=$opp[22];} elseif ($opp_mr > $opp[11]) {$opp_mr=$opp[11];}

if ($def_mr >= $opp_mr) {
$randdiv = array_rand ($divs, 2);
$def_heal=($def[4]+$def[5])/$divs[$randdiv[0]];
$contraven=($opp[6]+$opp[7])/$divs[$randdiv[1]];
	$def_heal-=$contraven;
if ($def_heal<= 0) {
		print "$wll[1] heal spell got contravented! ";
	} else {
		$def[12]+= $def_heal;
		$def_heal = number_format($def_heal, 0, '', '.');
		$contraven = number_format($contraven, 0, '', '.');
		if ($def[12] <= $def[16]) {
print "$wll[0] heal for $def_heal!<font size=-1>$wll[3] contravented for $contraven.</font>";
		} else {
			print "$wll[0] heal totally!"; $def[12] = $def[16];
		}
	}
} else {
	print "$wll[1] heal spell fizzles!";
}
print "</font><br>";
return $opp[12];
}
//heal

?>