<?php 
$search = array (
"'>'i","'<'i","'='i",
"'fuck'i","'script'i","'asshole'i",
"'nigger'i","'retard'i",
"'asshole'i","'bastard'i",
"'penis'i","'dick'i",
);


$replace = array (
"","","",
"","","",
"","",
"","",
);

function check_fields($in) {
echo "<hr>";
$flds = explode(",",$in);
foreach($flds as $val) {
echo $val;
}
echo count($flds);
}

$search=array("'fuck'i","'nigger'i","'vagina'i","'pussy'i","'penis'i");
$replace=array("","","","","","","","","","",);
function clean_post($in){
	global $search,$replace;
$in=preg_replace($search,$replace,$in);
$in=htmlentities("$in",ENT_QUOTES);
$in=strip_tags($in);
$in=trim($in);
$in=addslashes($in);
return $in;
}

function clean_input($in){
	global $search,$replace;
$in=preg_replace($search,$replace,$in);
$in=strip_tags($in);
$in=trim($in);
$in=addslashes($in);
if(ctype_alnum($in) and strlen($in)>=4){
return $in;
}else{
$in=NULL; return $in;
}
}



function dead_meat($table_names) {
global $row,$tbl_graves,$tbl_members,$tbl_history,$current_date,$lol;

$dead = array ('has seen the last light and lies beneath the earth.', 'was killed in action while fighting the evil.', 'ended his life with honor.', 'took his last breath in battle.');
$randed = array_rand($dead);
if ($row->Level >= 100) {
$value= "
'',
'<b>$row->Sex $row->Charname $row->Race [$row->Level]</b> $dead[$randed]',
'$current_date'
";
mysqli_query($link, "INSERT INTO $tbl_graves ($fld_graves) VALUES ($value)");
}
}



function print_options() {
global $row,$tbl_members;
echo "<select name=\"Players\">";
$query = "SELECT Sex,Charname,Level FROM $tbl_members WHERE (Charname!='$row->Charname' and Onoff and ip!='$row->ip') ORDER BY Level desc";
$result = mysqli_query($link, $query) or die ("Query failed");
while ($mrow = mysqli_fetch_object ($result)) {
echo "<option value=\"$mrow->Charname\">$mrow->Sex $mrow->Charname [$mrow->Level]</option>";
}
mysqli_free_result ($result);
echo "</select>";
}

function lint($in) {
if ($in >= 1000000) {
$mms=0;
while ($in > 1000000 and $in >= 1000000) {
$in /= 1000000;
$mms++;
}
$in=number_format($in);$in="$in".'M'."$mms";
return $in;
} else {
return number_format($in);
}
}


function dater($tim) {
if ($tim > 0) {
global $current_time;
$time_on=$current_time-$tim;
if ($time_on >= 86400*365) {
$time_on=($current_time-$tim)/(86400*365);
$time_what='year';
} elseif ($time_on >= 86400*30) {
$time_on=($current_time-$tim)/(86400*30);
$time_what='month';
} elseif ($time_on >= 86400*7) {
$time_on=($current_time-$tim)/(86400*7);
$time_what='week';
} elseif ($time_on >= 86400) {
$time_on=($current_time-$tim)/86400;
$time_what='day';
} elseif ($time_on >= 3600) {
$time_on=($current_time-$tim)/3600;
$time_what='hour';
} elseif ($time_on >= 60) {
$time_on=($current_time-$tim)/60;
$time_what='minute';
} else {
$time_what='second';
}
$time_on=number_format($time_on,2);
if ($time_on >= 1.5) {$time_what="$time_what's";}
} else {
return array("","");
}
return array("$time_on","$time_what");
}


function get_sap() {
global $sap;
$sapa = rand(1,9);
$sapb = $sap[array_rand ($sap, 1)];
$sapc = rand(1,9);
if ($sapa<=$sapc) {$sapa=$sapc+1;}
if ($sapb == '/') {$sapa*=2;$sapc=2;}
return array($sapa,"$sapb",$sapc);
}


function sap_me($asap,$isap) {
preg_match ("/(.*) (.*) (.*)/i", $asap, $sapi);
//echo "$asap | $isap | $sapi[1] | $sapi[2] | $sapi[3] ";
if ($isap ==($sapi[1]+$sapi[3]) and $sapi[2] == '+') {
return ('OKE');
} elseif ($isap ==($sapi[1]-$sapi[3]) and $sapi[2] == '-') {
return ('OKE');
} elseif ($isap ==($sapi[1]*$sapi[3]) and $sapi[2] == '*') {
return ('OKE');
} elseif ($isap ==($sapi[1]/$sapi[3]) and $sapi[2] == '/') {
return ('OKE');
}
}


function lottery_ticket() {
$strings = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
$numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
$randed_strings=array_rand($strings,5);
$randed_numbers=array_rand($numbers,10);
return ($strings[$randed_strings[1]].$strings[$randed_strings[2]].$numbers[$randed_numbers[1]].$numbers[$randed_numbers[2]].$numbers[$randed_numbers[3]].$numbers[$randed_numbers[4]].$numbers[$randed_numbers[5]].$numbers[$randed_numbers[6]].$numbers[$randed_numbers[7]].$numbers[$randed_numbers[8]]);
}

?>