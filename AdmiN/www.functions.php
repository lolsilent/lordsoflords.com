<?php 
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

function clean_int($in){
$in=preg_replace(array('@,@','@\.@','@\-@'),array('','',''),$in);
if(is_numeric($in) and $in>=1){
return $in;
}else{
return NULL;
}
}

function lint($in){
$in=number_format($in);
$in=preg_replace("/,/","",$in);
if(strlen($in)>12){
return number_format(substr($in,0,12)).' Z'.round(strlen($in)-12);
}else{
return number_format($in);
}
}

function dater($secs){
global $current_time;
$s='';$i=0;
if ($current_time-$secs < 0){
$secs=round($secs-$current_time);
}else{
$secs=round($current_time-$secs);
}
if($secs>= 86400){
$n=(int)($secs/86400);$s.=number_format($n).'D ';$secs %= 86400;
}if($secs>= 3600){
$n=(int)($secs/3600);$s .=($n<10?'0'.$n:$n).':';$secs %= 3600;
}if($secs>= 60){
$n=(int)($secs/60);$s .=($n<10?'0'.$n:$n).':';$secs %= 60;
}if($secs>=1){
$s .=($secs<10?'0'.$secs:$secs);
}if($secs<=0){
$s .='00';
}
return trim($s);
}

function get_sap(){
	global $sap;
$sapa=rand(1,9);
$sapb=$sap[array_rand($sap,1)];
$sapc=rand(1,9);
if($sapa<=$sapc){$sapa=$sapc+1;}
if($sapb == '/'){$sapa*=2;$sapc=2;}
return array($sapa,"$sapb",$sapc);
}

function sap_me($asap,$isap){
preg_match("/(.*) (.*) (.*)/i",$asap,$sapi);
//print "$asap | $isap | $sapi[1] | $sapi[2] | $sapi[3] ";
if($isap == ($sapi[1]+$sapi[3]) and $sapi[2] == '+'){
return('OKE');
}elseif($isap == ($sapi[1]-$sapi[3]) and $sapi[2] == '-'){
return('OKE');
}elseif($isap == ($sapi[1]*$sapi[3]) and $sapi[2] == '*'){
return('OKE');
}elseif($isap == ($sapi[1]/$sapi[3]) and $sapi[2] == '/'){
return('OKE');
}
}


function preg_extract($string,$start,$end){
return trim(preg_replace("/$end/si","",preg_replace("/$start/si","",$string)));
}

function writer($file,$mode,$somecontent){
$file=preg_replace("/ /i","_",$file);
$write_error='';
		if($handle = fopen($file, $mode)){
			if(fwrite($handle, $somecontent) == FALSE){$write_error .= 'Can not write.';}
			fclose($handle);
		}else{$write_error .= 'Can not open.';}

if(!empty($write_error)){
	global $server,$error_email;
	mail($error_email, "WRITER $server ERROR $file", "$write_error \n $file \n $mode \n $somecontent", "From: someerror@{$_SERVER['SERVER_NAME']}", "-fsomeerror@{$_SERVER['SERVER_NAME']}");
}
}

function clockit ($s) {
	//$s= 3661;print $s.' ';
	$c='';

	if ($s >= 3600) {
	$n=(int)($s/3600);
	$c.=($n<=9?'0'.$n:$n);
	$s %= 3600;
	}else {$c.='00';}
		$c .= ':';
	if ($s >= 60) {
	$n=(int)($s/60);
	$c.=($n<=9?'0'.$n:$n);
	$s %= 60;	
	}else {$c.='00';}
		$c .= ':';
	if ($s <= 9) {
	$c .= '0'.$s;
	}else {$c .= $s;}
	return $c;
}
?>