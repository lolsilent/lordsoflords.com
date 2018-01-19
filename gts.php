<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_ffunctions);
require_once($html_header);

$log_this='';
$array_dbs['lolnet'] ='lolnet';
unset($array_dbs['Ysomite']);
unset($array_dbs['History']);

$tele_charger = 100;
$array_dbs_keys = array_keys($array_dbs);
$tele_charms = array();
$total_credits=0;
$show_logs=25;
$max_teleport_charms=15;

$nothing_here=0;

$f=0;
if (!empty($_POST['u1'])){$u1 = clean_post($_POST['u1']);$f++;}else{$u1='';}
if (!empty($_POST['p1'])){$p1 = clean_post($_POST['p1']);$f++;}else{$p1='';}
if (!empty($_POST['s1'])){$s1 = clean_post($_POST['s1']);$f++;}else{$s1='';}

if (!empty($_POST['u2'])){$u2 = clean_post($_POST['u2']);$f++;}else{$u2='';}
if (!empty($_POST['p2'])){$p2 = clean_post($_POST['p2']);$f++;}else{$p2='';}
if (!empty($_POST['s2'])){$s2 = clean_post($_POST['s2']);$f++;}else{$s2='';}



$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);
mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

?><table width=100%><tr><th>Global Teleportation Service (GTS) <font color=red><sup>BETA</sup></font></th></tr><tr><td>
	
This option will teleport all your Credits, Heavenly Charms and Gods CHarms to the recipient.<br>All teleportations are logged and visible to everybody.<br><br><b><font color=red>If teleporting charms please empty your recipients charm slots or you might not receive your charms.<br>This difficult spell cost <?php print $tele_charger;?> credits to cast!</b></font>


<form method=post enctype="application/x-www-form-urlencoded">
<table border=0 cellpadding=0 cellspacing=1 width="50%">
<tr>
<th colspan=2>From Account Information</th>
</tr>
<tr>
<td width="50%">Username</td><td width="50%"><input type=text size=25 name="u1" value="<?php print !empty($u1)?$u1:'';?>" maxlength=10></td>
</tr>
<tr>
<td>Password</td><td><input type=password size=25 name="p1" value="<?php print !empty($p1)?$p1:'';?>" maxlength=50> </td>
</tr>
<tr>
<td>Server</td><td><select name="s1">
<?php 
foreach ($array_dbs_keys as $key) {
	//if ($key !== 'm6') {
	$selected='';
	if ($s1 == $key) {
		$selected =' selected';
	}
print '<option value="'.$key.'"'.$selected.'>'.$key.'</option>';
	//}
}
?>
</select>
</td>
</tr>
<tr>
<th colspan=2>Recipient Account Information</th>
</tr>
<tr>
<td width="50%">Username</td><td width="50%"><input type=text size=25 name="u2" value="<?php print !empty($u2)?$u2:'';?>" maxlength=10></td>
</tr>
<tr>
<td>Password</td><td><input type=password size=25 name="p2" value="<?php print !empty($p2)?$p2:'';?>" maxlength=50> </td>
</tr>
<tr>
<td>Server</td><td><select name="s2">
<?php 
foreach ($array_dbs_keys as $key) {
	//if ($key !== 'm6') {
	$selected='';
	if ($s2 == $key) {
		$selected =' selected';
	}
print '<option value="'.$key.'"'.$selected.'>'.$key.'</option>';
	//}
}
?>
</select>
</td>
</tr>
<tr>
<th colspan=2> <input type=submit value="Request Teleportation Spell!" Submit name=Action></th>
</tr>
</table>
</form><?php 



//GTS START
//print_r($_POST);
	if ($f >= 6 and in_array($s1,$array_dbs_keys) and in_array($s2,$array_dbs_keys)) {

/*_______________-=TheSilenT.CoM=-_________________*/
function determine_cases($user,$pass,$key){

if ($key == 'Eidolon' or $key == 'Meadow' or $key == 'Meadow2' or $key == 'm3' or $key == 'SotSE' or $key == 'Xedon' or $key == 'm6') {
$tc_username = 'Username';
$tc_password = 'Password';
$tc_charname = 'Charname';
}else{
$tc_username = 'username';
$tc_password = 'password';
$tc_charname = 'charname';
}

if ($key == 'Ysomite') {
$tbl_members 	= 'lol2_members';
$credits_tb		= 'lol2_credits';
$charm_tb			= 'lol2_charms';
}elseif ($key == 'Shadow' or $key == 'Shadow2') {
$tbl_members 	= 'lol3_members';
$credits_tb		= 'lol3_credits';
$charm_tb			= 'lol3_charms';
}else{
$tbl_members 	= 'lol_members';
$credits_tb		= 'lol_credits';
$charm_tb			= 'lol_charms';
}

if ($key !== 'Ysomite') {
$password=crypt($pass,$user);
}

if ($key == 'Ysomite' or $key == 'Shadow' or $key == 'Shadow2' or $key == 'Eidolon' or $key == 'Meadow' or $key == 'Meadow2' or $key == 'm3' or $key == 'SotSE' or $key == 'Xedon' or $key == 'm6') {
$creds_username = 'Username';
$creds_charname = 'Charname';
$creds_credits = 'Credits';
}else{
$creds_username = 'username';
$creds_charname = 'charname';
$creds_credits = 'credits';
}

return array($creds_username,$creds_charname,$creds_credits,$tc_username,$tc_password,$tc_charname,$tbl_members,$password,$credits_tb,$charm_tb);
}
/*_______________-=TheSilenT.CoM=-_________________*/

//RETRIEVE FROM ACCOUNT
$log_this .= '<table><tr><th colspan=3>Global Teleportation Spell</th></tr><tr><td valign=top>Initializing.<br>';
list ($from_cuser,$from_cchar,$from_ccreds,$from_username,$from_password,$from_charname,$from_tbl_members,$p1,$from_table_credits,$from_table_charms) = determine_cases($u1,$p1,$s1);
mysqli_select_db($link,$array_dbs[$s1]) or die(mysqli_error($link));
if($from_result = mysqli_query($link, "SELECT * FROM `$from_tbl_members` WHERE (`$from_username`='$u1' AND `$from_password`='$p1') ORDER BY `id` DESC LIMIT 1")){
if ($from_row = mysqli_fetch_object ($from_result)) {
mysqli_free_result ($from_result);

if (isset($from_row->Jail)) {
if ($from_row->Jail > $current_time) {
$nothing_here++;
$log_this .= 'Aborting teleportation you are jailed.';
}
}

if (isset($from_row->jail)) {
if ($from_row->jail > $current_time) {
$nothing_here++;
$log_this .= 'Aborting teleportation you are jailed.';
}
}

//print_r($from_row);
$log_this .= 'From <b>'.$from_row->$from_charname.'</b> on '.$s1.'<br>';
	if($from_cresult = mysqli_query($link, "SELECT * FROM `$from_table_credits` WHERE (`$from_cuser`='{$from_row->$from_username}' AND `$from_cchar`='{$from_row->$from_charname}') ORDER BY `id` DESC LIMIT 1")){
	if ($from_crow = mysqli_fetch_object ($from_cresult)) {
	$log_this .= 'From credits:'.$from_crow->$from_ccreds.'<br>';
	$total_credits += $from_crow->$from_ccreds;
	mysqli_free_result ($from_cresult);
	//mysqli_query($link, "UPDATE `$from_table_credits` SET `$from_ccreds`=0 WHERE `id`='$from_crow->id' LIMIT 1") or die(mysqli_error($link));
	}
	}

	if($from_mresult = mysqli_query($link, "SELECT * FROM `$from_table_charms` WHERE ((`name`='Gods Charm' or `name`='Heavenly Charm') and `$from_charname`='{$from_row->$from_charname}') ORDER BY `id` DESC LIMIT 5")){
	while ($from_mrow = mysqli_fetch_object ($from_mresult)) {
	$log_this .= 'From charms CID:'.$from_mrow->id.' '.(isset($from_mrow->name)?$from_mrow->name:$from_mrow->Name).'<br>';
	}
	mysqli_free_result ($from_mresult);
	}
}
}
//RETRIEVE FROM ACCOUNT
$log_this .= '<hr>';
//RETRIEVE RECIPIENT ACCOUNT
list ($to_cuser,$to_cchar,$to_ccreds,$to_username,$to_password,$to_charname,$to_tbl_members,$p2,$to_table_credits,$to_table_charms) = determine_cases($u2,$p2,$s2);
mysqli_select_db($link,$array_dbs[$s2]) or die(mysqli_error($link));
if($to_result = mysqli_query($link, "SELECT * FROM `$to_tbl_members` WHERE (`$to_username`='$u2' AND `$to_password`='$p2') ORDER BY `id` DESC LIMIT 1")){
if ($to_row = mysqli_fetch_object ($to_result)) {
mysqli_free_result ($to_result);
//print_r($to_row);
$log_this .= 'To account found:'.$to_row->$to_charname.' on '.$s2.'<br>';
	if($to_cresult = mysqli_query($link, "SELECT * FROM `$to_table_credits` WHERE (`$to_cuser`='{$to_row->$to_username}' AND `$to_cchar`='{$to_row->$to_charname}') ORDER BY `id` DESC LIMIT 1")){
	if ($to_crow = mysqli_fetch_object ($to_cresult)) {
	$log_this .= 'To credits found:'.$to_crow->$to_ccreds.'<br>';
	$total_credits += $to_crow->$to_ccreds;
	mysqli_free_result ($to_cresult);
	//mysqli_query($link, "UPDATE `$to_table_credits` SET `$to_ccreds`=$to_ccreds+{$from_crow->$from_ccreds} WHERE `id`='$to_crow->id' LIMIT 1") or die(mysqli_error($link));
	}else{
	$log_this .= 'No credits.<br>';
	//mysqli_query($link, "INSERT INTO `$to_table_credits` VALUES (NULL,'{$to_row->$to_username}','{$to_row->$to_charname}','{$from_crow->$from_ccreds}')") or die (mysqli_error($link));
	}
	}

	if($to_mresult = mysqli_query($link, "SELECT * FROM `$to_table_charms` WHERE (`$to_charname`='{$to_row->$to_charname}') ORDER BY `id` DESC LIMIT $max_teleport_charms")){
	$have_charms=mysqli_num_rows($to_mresult);
	if ($have_charms >= 1) {
	while ($to_mrow = mysqli_fetch_object ($to_mresult)) {
	$log_this .= 'To charms CID:'.$to_mrow->id.' '.(isset($to_mrow->name)?$to_mrow->name:$to_mrow->Name).'<br>';
	}
	mysqli_free_result ($to_mresult);
	}else{
	$log_this .= 'No charms.<br>';
	}
	}
}else{$nothing_here++;}
}
//RETRIEVE RECIPIENT ACCOUNT

if ($total_credits >= 1 AND $total_credits >= $tele_charger and $nothing_here == 0) {
	$log_this .= '</td><td valign=top>Teleporting.<br>';


/*_______________-=TheSilenT.CoM=-_________________*/
//START TELEPORT RETRIEVE FROM ACCOUNT
//list ($from_cuser,$from_cchar,$from_ccreds,$from_username,$from_password,$from_charname,$from_tbl_members,$p1,$from_table_credits,$from_table_charms) = determine_cases($u1,$p1,$s1);
mysqli_select_db($link,$array_dbs[$s1]) or die(mysqli_error($link));
if($from_result = mysqli_query($link, "SELECT * FROM `$from_tbl_members` WHERE (`$from_username`='$u1' AND `$from_password`='$p1') ORDER BY `id` DESC LIMIT 1")){
if ($from_row = mysqli_fetch_object ($from_result)) {
mysqli_free_result ($from_result);
//print_r($from_row);
//$log_this .= 'From account found:'.$from_row->$from_charname.' on '.$s1.'<br>';
	if($from_cresult = mysqli_query($link, "SELECT * FROM `$from_table_credits` WHERE (`$from_cuser`='{$from_row->$from_username}' AND `$from_cchar`='{$from_row->$from_charname}') ORDER BY `id` DESC LIMIT 1")){
	if ($from_crow = mysqli_fetch_object ($from_cresult)) {
	$log_this .= 'Removing '.$from_crow->$from_ccreds.' credits from '.$from_row->$from_charname.'<br>';
	mysqli_free_result ($from_cresult);
	mysqli_query($link, "UPDATE `$from_table_credits` SET `$from_ccreds`=0 WHERE `id`='$from_crow->id' LIMIT 1") or die(mysqli_error($link));
	}
	}

	if($from_mresult = mysqli_query($link, "SELECT * FROM `$from_table_charms` WHERE ((`name`='Gods Charm' or `name`='Heavenly Charm') and `$from_charname`='{$from_row->$from_charname}') ORDER BY `id` DESC LIMIT 5")){
	while ($from_mrow = mysqli_fetch_object ($from_mresult)) {
	$charm_name=(isset($from_mrow->name)?$from_mrow->name:$from_mrow->Name);
	$tele_charms[$from_mrow->id] = $charm_name;
	$log_this .= 'Removing charms CID:'.$from_mrow->id.' '.$charm_name.' from '.$from_row->$from_charname.'<br>';
	mysqli_query($link, "DELETE FROM `$from_table_charms` WHERE `id`=$from_mrow->id LIMIT 1") or die(mysqli_error($link));
	}
	mysqli_free_result ($from_mresult);
	}
}
}
//START TELEPORT RETRIEVE FROM ACCOUNT
$log_this .= '<hr>';
//START TELEPORT RETRIEVE RECIPIENT ACCOUNT
//list ($to_cuser,$to_cchar,$to_ccreds,$to_username,$to_password,$to_charname,$to_tbl_members,$p2,$to_table_credits,$to_table_charms) = determine_cases($u2,$p2,$s2);
mysqli_select_db($link,$array_dbs[$s2]) or die(mysqli_error($link));
if($to_result = mysqli_query($link, "SELECT * FROM `$to_tbl_members` WHERE (`$to_username`='$u2' AND `$to_password`='$p2') ORDER BY `id` DESC LIMIT 1")){
if ($to_row = mysqli_fetch_object ($to_result)) {
mysqli_free_result ($to_result);
//print_r($to_row);
//$log_this .= 'To account found:'.$to_row->$to_charname.' on '.$s2.'<br>';
if (isset($from_crow->id)) {
	if($to_cresult = mysqli_query($link, "SELECT * FROM `$to_table_credits` WHERE (`$to_cuser`='{$to_row->$to_username}' AND `$to_cchar`='{$to_row->$to_charname}') ORDER BY `id` DESC LIMIT 1")){
$log_this .= 'Transfering '.$from_crow->$from_ccreds.' credits to '.(isset($to_crow->$to_ccreds)?$to_crow->$to_ccreds.' credits':'').' on '.$to_row->$to_charname.' <br>';
	if ($to_crow = mysqli_fetch_object ($to_cresult)) {
	mysqli_free_result ($to_cresult);
	mysqli_query($link, "UPDATE `$to_table_credits` SET `$to_ccreds`=$to_ccreds+{$from_crow->$from_ccreds} WHERE `id`='$to_crow->id' LIMIT 1") or die(mysqli_error($link));
	}else{
	//$log_this .= 'No credits.<br>';
	mysqli_query($link, "INSERT INTO `$to_table_credits` VALUES (NULL,'{$to_row->$to_username}','{$to_row->$to_charname}','{$from_crow->$from_ccreds}')") or die (mysqli_error($link));
	}
	}
}else{
$log_this .= 'No credits to be teleported.<br>';
}//CREDITS
if(count($tele_charms) >= 1) {
	if($to_mresult = mysqli_query($link, "SELECT * FROM `$to_table_charms` WHERE (`$to_charname`='{$to_row->$to_charname}') ORDER BY `id` DESC LIMIT $max_teleport_charms")){
	$have_charms=mysqli_num_rows($to_mresult);
	if ($have_charms >= 1) {
	while ($to_mrow = mysqli_fetch_object ($to_mresult)) {
	$log_this .= 'To charms CID:'.$to_mrow->id.' '.(isset($to_mrow->name)?$to_mrow->name:$to_mrow->Name).'<br>';
	}
	mysqli_free_result ($to_mresult);
	}else{
	$log_this .= 'Charms slots are empty.<br>';
	}

	foreach($tele_charms as $key=>$val) {
		if (strtolower($val) == 'heavenly charm') {
			$charm_iname = 'Heavenly charm';
			$values="100,100,100,100,100,100";
			if ($s2 == "Shadow" or $s2 == "Shadow2") {
				$values .=",100,100,100";
			}
			if ($s2 == "m6") {
			$values="200,200,200,200,200,200, 200,200,200, 200,200,200, 200,200,200";
			}
		}elseif(strtolower($val) == 'gods charm') {
			$charm_iname = 'Gods charm';
			$values="127,127,127,127,127,127";
			if ($s2 == "Shadow" or $s2 == "Shadow2") {
				$values .=",127,127,127";
			}
			if ($s2 == "m6") {
			$values="255,255,255,255,255,255, 255,255,255, 255,255,255, 255,255,255";
			}
		}
		$finder='';
		if ($s2 == 'Duel' or $s2 == 'Devlab' or $s2 == 'Evolve' or $s2 == 'Euro' or $s2 == 'Noauto' or $s2 == 'Tourney' or $s2 == 'lolnet') {
		$finder="'GTS',";
		}

	if ($s2 == 'Meadow' or $s2 == 'Meadow2' or $s2 == 'm3' or $s2 == 'SotSE' or $s2 == 'Eidolon' or $s2 == 'Xedon' or $s2 == 'Shadow' or $s2 == 'Shadow2') {
		$charm_iname = $charm_iname;
		//print $charm_iname.' '.$s2.'AAA';
	}else{
		$charm_iname = $charm_iname;
		//print $charm_iname.' '.$s2.'BBB';
	}
		
mysqli_query($link, "INSERT INTO `$to_table_charms` VALUES (NULL,'{$to_row->$to_charname}',$finder'$charm_iname',$values,$current_time)") or die (mysqli_error($link));
		$log_this .= 'Transfering charm CID:'.$key.' '.$val.'<br>'; 
	}

	}
}//CHARMS
}
}
//START TELEPORT RETRIEVE RECIPIENT ACCOUNT

/*_______________-=TheSilenT.CoM=-_________________*/

$log_this .= '</td><td valign=top>Verifying.<br>';
//CHECKING RETRIEVE FROM ACCOUNT
//list ($from_cuser,$from_cchar,$from_ccreds,$from_username,$from_password,$from_charname,$from_tbl_members,$p1,$from_table_credits,$from_table_charms) = determine_cases($u1,$p1,$s1);
mysqli_select_db($link,$array_dbs[$s1]) or die(mysqli_error($link));
if($from_result = mysqli_query($link, "SELECT * FROM `$from_tbl_members` WHERE (`$from_username`='$u1' AND `$from_password`='$p1') ORDER BY `id` DESC LIMIT 1")){
if ($from_row = mysqli_fetch_object ($from_result)) {
mysqli_free_result ($from_result);
//print_r($from_row);
$log_this .= 'From account found:'.$from_row->$from_charname.' on '.$s1.'<br>';
	if($from_cresult = mysqli_query($link, "SELECT * FROM `$from_table_credits` WHERE (`$from_cuser`='{$from_row->$from_username}' AND `$from_cchar`='{$from_row->$from_charname}') ORDER BY `id` DESC LIMIT 1")){
	if ($from_crow = mysqli_fetch_object ($from_cresult)) {
	$log_this .= 'From credits found:'.$from_crow->$from_ccreds.'<br>';
	mysqli_free_result ($from_cresult);
	//mysqli_query($link, "UPDATE `$from_table_credits` SET `$from_ccreds`=0 WHERE `id`='$from_crow->id' LIMIT 1") or die(mysqli_error($link));
	}
	}

	if($from_mresult = mysqli_query($link, "SELECT * FROM `$from_table_charms` WHERE ((`name`='Gods Charm' or `name`='Heavenly Charm') and `$from_charname`='{$from_row->$from_charname}') ORDER BY `id` DESC LIMIT 5")){
	while ($from_mrow = mysqli_fetch_object ($from_mresult)) {
	$log_this .= 'From charms CID:'.$from_mrow->id.' '.(isset($from_mrow->name)?$from_mrow->name:$from_mrow->Name).'<br>';
	}
	mysqli_free_result ($from_mresult);
	}
}
}
//CHECKING RETRIEVE FROM ACCOUNT
$log_this .= '<hr>';
//CHECKING RETRIEVE RECIPIENT ACCOUNT
//list ($to_cuser,$to_cchar,$to_ccreds,$to_username,$to_password,$to_charname,$to_tbl_members,$p2,$to_table_credits,$to_table_charms) = determine_cases($u2,$p2,$s2);
mysqli_select_db($link,$array_dbs[$s2]) or die(mysqli_error($link));
if($to_result = mysqli_query($link, "SELECT * FROM `$to_tbl_members` WHERE (`$to_username`='$u2' AND `$to_password`='$p2') ORDER BY `id` DESC LIMIT 1")){
if ($to_row = mysqli_fetch_object ($to_result)) {
mysqli_free_result ($to_result);
//print_r($to_row);
$log_this .= 'To account found:'.$to_row->$to_charname.' on '.$s2.'<br>';
	if($to_cresult = mysqli_query($link, "SELECT * FROM `$to_table_credits` WHERE (`$to_cuser`='{$to_row->$to_username}' AND `$to_cchar`='{$to_row->$to_charname}') ORDER BY `id` DESC LIMIT 1")){
	if ($to_crow = mysqli_fetch_object ($to_cresult)) {
	$log_this .= 'To credits found:'.$to_crow->$to_ccreds.'<br>';
	mysqli_free_result ($to_cresult);
	//mysqli_query($link, "UPDATE `$to_table_credits` SET `$to_ccreds`=$to_ccreds+{$from_crow->$from_ccreds} WHERE `id`='$to_crow->id' LIMIT 1") or die(mysqli_error($link));
mysqli_query($link, "UPDATE `$to_table_credits` SET `$to_ccreds`=$to_ccreds-$tele_charger WHERE `id`='$to_crow->id' LIMIT 1") or die(mysqli_error($link));
$log_this .= 'Cost '.$tele_charger.' credits taken.<br>';
	}else{
	$log_this .= 'No credits.<br>';
	//mysqli_query($link, "INSERT INTO `$to_table_credits` VALUES (NULL,'{$to_row->$to_username}','{$to_row->$to_charname}','{$from_crow->$from_ccreds}')") or die (mysqli_error($link));
	}
	}

	if($to_mresult = mysqli_query($link, "SELECT * FROM `$to_table_charms` WHERE (`$to_charname`='{$to_row->$to_charname}') ORDER BY `id` DESC LIMIT $max_teleport_charms")){
	$have_charms=mysqli_num_rows($to_mresult);
	if ($have_charms >= 1) {
	while ($to_mrow = mysqli_fetch_object ($to_mresult)) {
	$log_this .= 'To charms CID:'.$to_mrow->id.' '.(isset($to_mrow->name)?$to_mrow->name:$to_mrow->Name).'<br>';
	}
	mysqli_free_result ($to_mresult);
	}else{
	$log_this .= 'No charms.<br>';
	}
	}
}
}
//CHECKING RETRIEVE RECIPIENT ACCOUNT

}else{
	$log_this .= 'ERROR! Cause of this error might be, not enough credits to cast this spell, sender or recipient credentials error, other yet unknown error.<br>';
}

mysqli_select_db($link,$db_main) or die(mysqli_error($link));

}else{}//ELSE


if (!empty($log_this)) {
mysqli_query($link, "INSERT INTO `$tbl_gts` VALUES (NULL,'$log_this</td></tr></table>','$current_time')") or die (mysqli_error($link));
}

//GTS LOGS
if($gts_result = mysqli_query($link, "SELECT * FROM `$tbl_gts` WHERE (`id`) ORDER BY `id` DESC LIMIT $show_logs")){
print '</table><table><tr><th>GTS logs</th></tr><tr><td>';
while ($grow = mysqli_fetch_object ($gts_result)) {
print '<hr title="'.dater($grow->timer).'">'.$grow->logs;
}
mysqli_free_result ($gts_result);
}
//GTS LOGS


mysqli_close($link);

?></td></tr></table><?php 
require_once($html_footer);
?>