<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
require_once 'AdMiN/www.functions.php';
require_once 'AdMiN/array.races.php';
include_once("$html_header");

$info='';
if(!empty($_GET['info']) and empty($info)){$info=clean_post($_GET['info']);}
if(!empty($_POST['info']) and empty($info)){$info=clean_post($_POST['info']);}

$link = mysqli_connect($db_host,$db_user,$db_password);
mysqli_select_db($link,$db_main);

if($iresult=mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `Charname`='$info' LIMIT 1")){
if($iobj=mysqli_fetch_object($iresult)){
mysqli_free_result($iresult);

if($hresult=mysqli_query($link, "SELECT * FROM `$tbl_history` WHERE `Charname`='$iobj->Charname' LIMIT 1")){
if($hobj=mysqli_fetch_object($hresult)){
mysqli_free_result($hresult);



?><table width="100%">
<tr><th colspan="2">Player information and statisticS</th></tr>
<tr><td>
Clan<br>
Race<br>
Sex<br>
Charname<hr>
Level<br>
Life<br>
Xp<br>
Gold<br>
Stash<hr>
Monsters killed<br>
Deads by monster<br>
Duels won<br>
Duels lost<br>
Total fights<br>
Total duels<hr>
Last activity<hr>
</td><td>
<?php 
list ($la,$lb) = dater($iobj->Time);

print (!empty($iobj->Clan)?"[$iobj->Clan]":'none').'<br>'.$iobj->Race.'<br>'.$iobj->Sex.'<br>'.$iobj->Charname.(($iobj->Freeplay-$current_time)>1?'<img src="'.$emotions_url.'/star.gif" border="0" alt="Premium member">':'').'<hr>'.number_format($iobj->Level).'<br>'.number_format($iobj->Life).'<br>'.number_format($iobj->Exp).'<br>'.number_format($iobj->Gold).'<br>'.number_format($iobj->Stash).'<hr>'.number_format($hobj->Kills).'<br>'.number_format($hobj->Deads).'<br>'.number_format($hobj->Duelsw).'<br>'.number_format($hobj->Duelsl).'<br>'.number_format($hobj->Kills+$hobj->Deads).'<br>'.number_format($hobj->Duelsw+$hobj->Duelsl).'<hr>'.($iobj->Time>1?$la.' '.$lb.' ago':'none').'<hr>';
?></td><tr><td colspan="2">
<?php 
if($iobj->Strength>$iobj->Intelligence ){
?>More muscles than brains and slams into combat.<?php 
}elseif($iobj->Strength<$iobj->Intelligence){
?>Very intelligent and chooses the mystical power in combat.<?php 
}else{
?>Fights with hand and magic.<?php 
}
?> <?php 
if($iobj->Dexterity >$iobj->Concentration ){
?>Aims very well with a melee weapon.<?php 
}elseif($iobj->Dexterity<$iobj->Concentration){
?>Spells are not fizzling here.<?php 
}else{
?>Cool minded aimer.<?php 
}
?> <?php 
if($iobj->Agility>$iobj->Contravention ){
?>Defense is stronger than his magic shield.<?php 
}elseif($iobj->Agility<$iobj->Contravention){
?>Magic shield is stronger than his defense.<?php 
}else{
?>Defending agains a weapon or spell should be no problem.<?php 
}
?> <?php 
if($iobj->Weapon>$iobj->Attackspell){
?>Prefers using a weapon in combat.<?php 
}elseif($iobj->Weapon<$iobj->Attackspell){
?>Prefers using a spell in combat.<?php 
}else{
?>Uses whatever is at hand.<?php 
}

?>
</td></tr></table><?php 

$stats_array = array ('Strength', 'Dexterity', 'Agility', 'Intelligence', 'Concentration', 'Contravention');

require_once 'AdMiN/array.races.php';
require_once 'AdMiN/www.battle.php';
require_once 'AdMiN/www.functions.php';

if (!in_array($iobj->Race,array_keys($races_array))) {$iobj->Race='Human';}
$tot_stats= $iobj->Strength+$iobj->Dexterity+$iobj->Agility+$iobj->Intelligence+$iobj->Concentration+$iobj->Contravention;
$base_attack= ($iobj->Strength/$tot_stats)*$races_array["$iobj->Race"][1];
$load= ($iobj->Armor+$iobj->Helmet+$iobj->Shield+$iobj->Belt+$iobj->Pants+$iobj->Hand+$iobj->Feet);
$base_defend= ($iobj->Agility/$tot_stats)*$races_array["$iobj->Race"][2]+($load);
$base_magic= ($iobj->Intelligence/$tot_stats)*$races_array["$iobj->Race"][3];

$ds[0]	= $iobj->Strength*(1+$base_attack+$iobj->Hand+$iobj->Weapon);
$ds[1]	= $ds[0]*2.555555;
$ds[2]	= $iobj->Intelligence*(1+$iobj->Ring+$base_magic+$iobj->Attackspell);
$ds[3]	= $ds[2]*2.555555;
$ds[4]	= $iobj->Intelligence*(1+$iobj->Amulet+$base_magic+$iobj->Healspell);
$ds[5]	= $ds[4]*2.555555;
$ds[6]	= $iobj->Contravention*(1+$iobj->Ring+$iobj->Amulet+$base_magic);
$ds[7]	= $ds[6]*2.555555;
$ds[8]	= $iobj->Agility*(1+$iobj->Shield+$base_defend);
$ds[9]	= $ds[8]*2.555555;
$ds[10]	= $iobj->Dexterity*(1+$base_attack+$iobj->Feet+$iobj->Level+$races_array["$iobj->Race"][2]);
$ds[11]	= $iobj->Concentration*(1+$base_magic+$iobj->Belt+$iobj->Level+$races_array["$iobj->Race"][3]);
$ds[12]	= $ds[10]/2.5;
$ds[13]	= $ds[11]/2.5;

$next_level = ((($iobj->Level/10)*500)+$iobj->Level)*($iobj->Level*$iobj->Level)+449;
if ($iobj->Exp > $next_level) {
$leveup=1;
}

$num=0;
foreach ($ds as $val) {
$ds[$num] = number_format($ds[$num], 0, '', '.');
$num++;
}

$bonus=array(0,0,0,0,0,0);
$query = "SELECT * FROM `$tbl_charms` WHERE (`Charname`='$iobj->Charname') ORDER BY `id` DESC";
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
$iobj->Strength+=round(($iobj->Strength/100)*$bonus[0]);
$iobj->Dexterity+=round(($iobj->Dexterity/100)*$bonus[1]);
$iobj->Agility+=round(($iobj->Agility/100)*$bonus[2]);
$iobj->Intelligence+=round(($iobj->Intelligence/100)*$bonus[3]);
$iobj->Concentration+=round(($iobj->Concentration/100)*$bonus[4]);
$iobj->Contravention+=round(($iobj->Contravention/100)*$bonus[5]);
}
?>
<table cellpadding=0 cellspacing=1 border=0 width=100%><tr>
<th colspan=3>Natural Battlefields Stats for <?php echo "$iobj->Sex $iobj->Charname"; ?></th></tr>
<tr>
<td valign="top"><?php echo $iobj->Race; ?> Stats<br>Weapon damage<br>Attack spell<br>Heal spell<br>Magic Shield<br>Defence<br>Attack rating<br>Magic rating</td>
<td align=right valign="top"> Min<br><?php echo "$ds[0]<br>$ds[2]<br>$ds[4]<br>$ds[6]<br>$ds[8]<br>$ds[12]<br>$ds[13]</td>
<td align=right valign=top> Max<br>$ds[1]<br>$ds[3]<br>$ds[5]<br>$ds[7]<br>$ds[9]<br>$ds[10]<br>$ds[11]</td>
</tr></table>
";


}else{?>Player didn't start playing yet.<?php }}}else{?>Can't find player.<?php }}

include_once("$html_footer");
?>