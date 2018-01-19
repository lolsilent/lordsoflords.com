<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $game_header;

if(!empty($_POST['action'])){$action=clean_post($_POST['action']);}else{$action='';}
if(!empty($_POST['recipient'])){$recipient=clean_post($_POST['recipient']);}else{$recipient='';}
if(!empty($_POST['crecipient'])){$crecipient=clean_post($_POST['crecipient']);}else{$crecipient='';}
if(!empty($_POST['gold'])){$gold=clean_post($_POST['gold']);$gold=round($gold);}else{$gold=0;}
if(!empty($_POST['credits'])){$credits=(int) $_POST['credits'];$credits=round($credits);}else{$credits=0;}

		if (!empty($_POST['confirm'])) {//CONFIRM
	
if (!empty($gold) and !empty($recipient) and !empty($action) and $crecipient == $recipient) {
if ($recipient !== $row->Charname and $gold <= $row->Gold and $gold >= 1) {
mysqli_query($link, "UPDATE `$tbl_members` SET `Gold`=`Gold`-$gold WHERE `Charname`='$row->Charname' LIMIT 1");
mysqli_query($link, "UPDATE `$tbl_smembers` SET `Gold`=`Gold`-$gold WHERE `Charname`='$row->Charname' LIMIT 10");
mysqli_query($link, "UPDATE `$tbl_members` SET `Gold`=`Gold`+$gold WHERE `Charname`='$recipient' LIMIT 1");
if (empty($credits)) {
	echo 'You just gave away '.number_format($gold).' gold to '.$recipient.'!';
}
if($gold > ($row->Level*$row->Level) and empty($credits)){
mysqli_query($link, "INSERT INTO `$tbl_paper` ($fld_paper) VALUES ('','$row->Sex $row->Charname gives $recipient ".number_format($gold)." gold.','$current_date')");
}}}
//end money transfer

		}//CONFIRM
error_reporting(0);

$crow = new stdClass;
$crow->Credits=0;if($cresult = mysqli_query($link, "SELECT * FROM `$tbl_credits` WHERE `Username`='$row->Username' and `Charname`='$row->Charname' LIMIT 1")){
if($crow = mysqli_fetch_object ($cresult)){
mysqli_free_result ($cresult);
			if (!empty($_POST['confirm'])) {//CONFIRM
if (!empty($credits) and !empty($recipient) and !empty($action) and $crecipient == $recipient) {
if ($recipient !== $row->Charname and $credits <= $crow->Credits and $credits >= 1) {
$status='';
if($mres=mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `Charname`='$recipient'")){$status.='a';
if($mrow = mysqli_fetch_object ($mres)){$status.='b';
mysqli_free_result ($mres);

mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`-$credits WHERE `Charname`='$row->Charname'");
if($rcreds=mysqli_query($link, "SELECT * FROM `$tbl_credits` WHERE `Charname`='$mrow->Charname'")){$status.='c';
if($rcrow = mysqli_fetch_object ($rcreds)){$status.='d';
mysqli_free_result($rcreds);
mysqli_query($link, "UPDATE `$tbl_credits` SET `Credits`=`Credits`+$credits WHERE `Charname`='$mrow->Charname'");
}else{$status.='e';
mysqli_query($link, "INSERT INTO `$tbl_credits` ($fld_credits) values ('', '$mrow->Username', '$mrow->Charname', $credits)");
}}
$status=strlen($status);
mysqli_query($link, "INSERT INTO `$tbl_logs` ($fld_logs) values ('','$row->Charname','$credits credits to $recipient STATUS:$status','$PHP_SELF','$current_date','$REMOTE_ADDR')");
mysqli_query($link, "INSERT INTO `$tbl_paper` ($fld_paper) VALUES ('','$row->Sex $row->Charname gave $mrow->Sex $mrow->Charname ".number_format($credits)." credits.','$current_date')");
echo 'You just gave away ';
if (!empty($gold)) {
print number_format($gold).' gold and ';
}
print number_format($credits).' credits to '.$recipient.'!';
$crow->Credits-=$credits;
}}
//echo $status;
}}
		}//CONFIRM
}else{
	$crow = new stdClass;
	$crow->Credits=0;
	}}


?>
<form method=post enctype="application/x-www-form-urlencoded">
<table border=0 cellpadding=0 cellspacing=1 width=100%>
<tr><th colspan=2>Transfer</th></tr>
<tr><td width="25%">Gold</td><td width="75%"><input type=text name=gold maxlength=25 value="<?php print ($gold>=1)?$gold:'';?>"></td></tr>
<?php if ($crow->Credits >= 1) {?>
<tr><td width="25%">Credits <?php echo number_format($crow->Credits);?></td><td width="75%"><input type=text name=credits maxlength=5 value="<?php print ($credits>=1)?$credits:'';?>"></td></tr>
<?php }?>
<tr><td>Recipient</td><td><select name=recipient>
<?php 
if(!empty($_POST['alfa'])){$alfa=$_POST['alfa'];if(strlen($alfa) < 2){$alfa='';}}else{$alfa='';}
if (empty($alfa)) {

if($ores = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (`Onoff`>=1 and `Charname`!='$row->Charname') LIMIT 100")){
while ($orow = mysqli_fetch_object ($ores)) {
if($recipient == $orow->Charname){
echo '<option value="'.$orow->Charname.'" selected>'.$orow->Sex.' '.$orow->Charname.'</option>';
}else{
echo '<option value="'.$orow->Charname.'">'.$orow->Sex.' '.$orow->Charname.'</option>';
}
}
mysqli_free_result ($ores);
}

}else{

if($presult = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `Charname`!='$row->Charname' and `Charname` LIKE CONVERT (_utf8 '%$alfa%' USING latin1) COLLATE latin1_swedish_ci ORDER BY Charname ASC LIMIT 100")){
while ($prow = mysqli_fetch_object ($presult)) {
if($recipient == $prow->Charname){
echo '<option value="'.$prow->Charname.'" selected>'.$prow->Sex.' '.$prow->Charname.'</option>';
}else{
echo '<option value="'.$prow->Charname.'">'.$prow->Sex.' '.$prow->Charname.'</option>';
}
}
mysqli_free_result ($presult);
}

}
?>
</select></td></tr>
<tr><td width="25%">Find player</td><td width="75%"><input type=text name=alfa value="<?php print (!empty($alfa))?$alfa:'';?>" maxlength=10></td></tr>
<?php 
if (empty($_POST['confirm'])) {
	if(!empty($recipient) and !empty($action)) {
if (!empty($gold) or !empty($credits)) {
print '<input type=hidden name=crecipient value="'.$recipient.'"><tr><td>Confirm transfer to '.$recipient.'</td><td><input type=checkbox name=confirm value=confirm></td></tr>';
}
	}
}
?><tr><td> </td><th><input type=submit value="Transfer" name=action></th></tr>
</table>
</form>
<?php 
include_once $game_footer;
?>