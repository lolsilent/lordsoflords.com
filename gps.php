<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_mysql);
require_once($html_header);

$min_chars_n=3;
$min_chars_i=6;

$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

?><table width=100%><tr><th>Global Player Seeker (GPS)</th></tr><tr><td>

<form method=post>
<table width=100% cellpadding=0 cellspacing=1 border=0>
<tr><td>Partial / Charname:</td><td><input type=text name=charname></td><td>Partial / Ip:</td><td><input type=text name=fip></td><td><input type=submit name=Warning value="Find them!"></td></tr>
</table>
</form>
<?php 


if (!empty($_POST['fip'])){$fip = $_POST['fip'];}else{$fip='';}
if (!empty($_GET['fip'])){$fip = $_GET['fip'];}

if (!empty($_POST['charname'])){$charname = $_POST['charname'];}else{$charname='';}
if (!empty($_GET['charname'])){$charname = $_GET['charname'];}

//SEARCH MORE
	if (strlen($fip) >= $min_chars_i or strlen($charname) >= $min_chars_n) {
$array_dbs['lolnet']='lolnet';


print '<table width=100% cellpadding=0 cellspacing=1 border=1>';
foreach ($array_dbs as $key => $val) {
mysqli_select_db($link,$val) or die(mysqli_error($link));


if ($key == 'Eidolon' or $key == 'Meadow' or $key == 'Meadow2' or $key == 'M3' or $key == 'SotSE' or $key == 'Xedon') {
$tc_level = 'Level';
$tc_sex = 'Sex';
$tc_charname = 'Charname';
}else{
$tc_level = 'level';
$tc_sex = 'sex';
$tc_charname = 'charname';
}

if ($key == 'Ysomite') {
$tbl_members 	= 'lol2_members';
}elseif ($key == 'Shadow' or $key == 'Shadow2') {
$tbl_members 	= 'lol3_members';
}else{
$tbl_members 	= 'lol_members';
}
if (!empty($fip) or !empty($charname)) {

if (!empty($fip)) {
	if (strlen($fip) >= $min_chars_i) {
			$where_seek="`ip` LIKE CONVERT (_utf8 '%$fip%' USING latin1) COLLATE latin1_swedish_ci";
		}else{$stop=1;}
}elseif (!empty($charname)) {
	if (strlen($charname) >= $min_chars_n) {
			$where_seek="`$tc_charname` LIKE CONVERT (_utf8 '%$charname%' USING latin1) COLLATE latin1_swedish_ci";
		}else{$stop=1;}
}

if (!isset($stop) && isset($where_seek)) {
if($find_result = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE ($where_seek) ORDER BY `Level` DESC LIMIT 100")){
print '<tr><th>'.$key.'</th>'.(mysqli_num_rows($find_result)>=1?'<th>level</th><th>ip</th>':'<th colspan=4>CLEAN</th>').'</tr>';
$i=0;
while ($mrow = mysqli_fetch_object ($find_result)) {
	if (isset($mrow->$tc_charname) && preg_match("/^silent$/i",$mrow->$tc_charname)) {
		$mrow->ip='010101010101';
	}
print '<tr><td>'.(isset($mrow->$tc_sex)?$mrow->$tc_sex:'').' '.(isset($mrow->$tc_charname)?$mrow->$tc_charname:'').'</td><td>'.(isset($mrow->$tc_level)?number_format($mrow->$tc_level):'').'</td><td>'.(isset($mrow->ip)?substr($mrow->ip,0,-6):'').'??? ???</td></tr>';
//print '<tr><td colspan=4';print_r($mrow);print '</td></tr>';
$i++;
}
mysqli_free_result ($find_result);

}else{?><!--Nothing found!--><?php }
}else{
print 'You are not allowed here.';
}
}

}//foreach
?></table><?php 

}else{print 'To find your friends or for game HCM to find cheaters.<br>Please use at least '.$min_chars_i.' characters for ip and '.$min_chars_n.' characters for names.';}

//SEARCH MORE

mysqli_close($link);
?></td></tr></table><?php 
require_once($html_footer);
?>