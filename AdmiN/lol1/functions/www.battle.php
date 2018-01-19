<?php 
#!/usr/local/bin/php

function myfriend($xp,$gold,$friend){
global $link,$tbl_members,$row;

if($fresult=mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `charname`='$friend' LIMIT 100")){
if($fobj=mysqli_fetch_object($fresult)){
mysqli_free_result($fresult);
$xp/=100;$gold/=100;
if($xp>$fobj->xp or $xp<$fobj->level){$xp=$fobj->level;}
if($gold>$fobj->gold or $gold<$fobj->level){$gold=$fobj->level;}

if($row->friend !== $fobj->friend){
mysqli_query($link, "UPDATE `$tbl_members` SET `xp`=`xp`+$xp,`gold`=`gold`+$gold WHERE `id`=$fobj->id LIMIT 1");
}

}}

}

function battlestats($row){
global $link,$races_array,$tbl_charms,$current_time;

$bonus=array(0,0,0,0,0,0);
if($cmresult=mysqli_query($link, "SELECT * FROM `$tbl_charms` WHERE `charname`='$row->charname' and `timer`>=$current_time LIMIT 5")){
if(mysqli_num_rows($cmresult)){
while($cmobj=mysqli_fetch_object($cmresult)){
if($cmobj->timer>time()){
if($cmobj->str){$bonus[0]+=$cmobj->str;}
if($cmobj->dex){$bonus[1]+=$cmobj->dex;}
if($cmobj->agi){$bonus[2]+=$cmobj->agi;}
if($cmobj->intel){$bonus[3]+=$cmobj->intel;}
if($cmobj->conc){$bonus[4]+=$cmobj->conc;}
if($cmobj->cont){$bonus[5]+=$cmobj->cont;}
}
}
mysqli_free_result($cmresult);
}
}

if(array_sum($bonus)>=1){
if($bonus[0]){$row->str+=($row->str/100)*$bonus[0];}
if($bonus[1]){$row->dex+=($row->dex/100)*$bonus[1];}
if($bonus[2]){$row->agi+=($row->agi/100)*$bonus[2];}
if($bonus[3]){$row->intel+=($row->intel/100)*$bonus[3];}
if($bonus[4]){$row->conc+=($row->conc/100)*$bonus[4];}
if($bonus[5]){$row->cont+=($row->cont/100)*$bonus[5];}
}

if(!in_array($row->race,array_keys($races_array))){$row->race='Human';}

$tot_stats=$row->str+$row->dex+$row->agi+$row->intel+$row->conc+$row->cont;
$base_attack=($row->str/$tot_stats)*$races_array[$row->race][0];
$base_defend=($row->agi/$tot_stats)*$races_array[$row->race][1]+($row->armor+$row->helm+$row->shield+$row->belt+$row->pants+$row->hand+$row->feet);
$base_magic=($row->intel/$tot_stats)*$races_array[$row->race][2];
if($tot_stats<=0){$tot_stats=100;}
if($base_attack<=0){$base_attack=5;}
if($base_defend<=0){$base_defend=5;}
if($base_magic<=0){$base_magic=5;}

$row->min_wd=round($row->str*(1+$base_attack+$row->hand+$row->weapon));
$row->max_wd=round($row->min_wd*2.55);
$row->min_spell=round($row->intel*(1+$row->ring+$base_magic+$row->spell));
$row->max_spell=round($row->min_spell*2.55);
$row->min_heal=round($row->intel*(1+$row->amulet+$base_magic+$row->heal));
$row->max_heal=round($row->min_heal*2.55);
$row->min_shield=round($row->cont*(1+$row->ring+$row->amulet+$base_magic));
$row->max_shield=round($row->min_shield*2.55);
$row->min_defense=round($row->agi*(1+$row->shield+$base_defend));
$row->max_defense=round($row->min_defense*2.55);
$row->max_ar=round($row->dex*(1+$base_attack+$row->feet+$row->level+$races_array[$row->race][1]));
$row->min_ar=round($row->max_ar/2.55);
$row->max_mr=round($row->conc*(1+$base_magic+$row->belt+$row->level+$races_array[$row->race][2]));
$row->min_mr=round($row->max_mr/2.55);
$row->thievery=round((1+($row->agi/$tot_stats))*$races_array[$row->race][3],2);

return $row;
}
//battlestats

//weapon
function weapon($row,$mon){
?><font color="#FF3333"><?php 

$row->max_ar/=(rand(100,255)/100);
$mon->max_ar/=(rand(100,255)/100);

if($row->max_ar<$row->min_ar){$row->max_ar=$row->min_ar;}
if($mon->max_ar<$mon->min_ar){$mon->max_ar=$mon->min_ar;}

if($row->max_ar>=$mon->max_ar){
$row->max_wd/=(rand(100,255)/100);
$mon->max_defense/=(rand(100,255)/100);
if($row->max_wd<$row->min_wd){$row->max_wd=$row->min_wd;}
if($mon->max_defense<$mon->min_defense){$mon->max_defense=$mon->min_defense;}

if($row->max_wd<=0){
print $mon->sex.' '.$mon->charname;?> blocks the strike!<?php 
}else{
$mon->life-=($row->max_wd-$mon->max_defense);
print $row->sex.' '.$row->charname;?> hits for <?php print lint($row->max_wd);?>! <?php print $mon->sex.' '.$mon->charname;?> blocks for <?php print lint($mon->max_defense).'.';
}
}else{
print $row->sex.' '.$row->charname;?> misses!<?php 
}
?></font><br><?php 
return $mon->life;
}
//weapon

//magic
function magic($row,$mon){
?><font color="#8888FF"><?php 

$row->max_mr/=(rand(100,255)/100);
$mon->max_mr/=(rand(100,255)/100);

if($row->max_mr<$row->min_mr){$row->max_mr=$row->min_mr;}
if($mon->max_mr<$mon->min_mr){$mon->max_mr=$mon->min_mr;}

if($row->max_mr>=$mon->max_mr){
$row->max_spell/=(rand(100,255)/100);
$mon->max_shield/=(rand(100,255)/100);
if($row->max_spell<$row->min_spell){$row->max_spell=$row->min_spell;}
if($mon->max_shield<$mon->min_shield){$mon->max_shield=$mon->min_shield;}

if($row->max_spell<=0){
print $mon->sex.' '.$mon->charname;?> contravents the spell!<?php 
}else{
$mon->life-=($row->max_spell-$mon->max_shield);
print $row->sex.' '.$row->charname;?> cast for <?php print lint($row->max_spell);?>! <?php print $mon->sex.' '.$mon->charname;?> contravents for <?php print lint($mon->max_shield).'.';
}
}else{
print $row->sex.' '.$row->charname;?> spell fizzles!<?php 
}
?></font><br><?php 
return $mon->life;
}
//magic

//heal
function heal($row,$mon){
?><font color="#88FF88"><?php 

$row->max_mr/=(rand(100,255)/100);
$mon->max_mr/=(rand(100,255)/100);

if($row->max_mr<$row->min_mr){$row->max_mr=$row->min_mr;}
if($mon->max_mr<$mon->min_mr){$mon->max_mr=$mon->min_mr;}

if($row->max_mr>=$mon->max_mr){
$row->max_heal/=(rand(100,255)/100);
$mon->max_shield/=(rand(100,255)/100);
if($row->max_heal<$row->min_heal){$row->max_heal=$row->min_heal;}
if($mon->max_shield<$mon->min_shield){$mon->max_shield=$mon->min_shield;}

if($row->max_heal<=0){
print $mon->sex.' '.$mon->charname;?> contravents the healspell!<?php 
}else{
$mon->life-=($row->max_heal-$mon->max_shield);
print $row->sex.' '.$row->charname;?> cast for <?php print lint($row->max_heal);?>! <?php print $mon->sex.' '.$mon->charname;?> contravents for <?php print lint($mon->max_shield).'.';
}
}else{
print $row->sex.' '.$row->charname;?> spell fizzles!<?php 
}
?></font><br><?php 
return $mon->life;
}
//heal

//PET
function pet($row,$mon){
$tbl_pets='lol_pets';

if($petres=mysqli_query($link, "SELECT * FROM `$tbl_pets` WHERE `charname`='$row->charname' ORDER BY `id` ASC LIMIT 1")){
if(mysqli_numrows($petres) >= 1){
if($petobj=mysqli_fetch_object($petres)){
mysqli_free_result($petres);
?><font color="#CCCCCC"><?php 
$pet_damage = $petobj->level*($petobj->str+$petobj->dex+$petobj->agi);
$pet_magic = $petobj->level*($petobj->intel+$petobj->conc+$petobj->cont);

if($petobj->hunger >= 3 or $petobj->mood >= 3){
if($pet_damage >= $pet_magic and $pet_damage > $mon->min_defense){
	$mon->life -= ($pet_damage-$mon->min_defense); print $petobj->petname.' hits for '.lint($pet_damage-$mon->min_defense).' damage.';
}elseif($pet_damage < $pet_magic and $pet_magic > $mon->min_shield){
	$mon->life -= ($pet_magic-$mon->min_shield);print $petobj->petname.' cast for '.lint($pet_magic-$mon->min_shield).' damage.';
}else{
?>Your pet is too weak to do anything.<?php 
}
}else{?>Your pet is not in the mood or to hungry to do anything at this moment.<?php }
?></font><br><?php 
}
}
}

return $mon->life;
}
//PET
?>