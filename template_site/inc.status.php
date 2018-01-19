<tr>
<th bgcolor="#000000">Lords of Lords Hardware status monitor</th>
</tr>

<tr><td><!--Load averages the average of 5, 10 and 15 minutes--><?php 
if (!empty($_SERVER['HTTP_REFERER'])) {$uri=$_SERVER['HTTP_REFERER'];} else {$uri='';}
if (strpos($uri, $root_url) !== '') {
/*_______________-=TheSilenT.CoM=-_________________*/
function preg_extract($string,$start,$end){
return trim(preg_replace("/$end/si","",preg_replace("/$start/si","",$string)));
}

$topray=array();

$read='';
$fp = popen ("top -i -n 1 -b", "r");
$read .= fread($fp, 1500);
pclose ($fp);
$read = preg_replace("/,/i","",$read);

if(strlen($read) >= 300){

$topray['Uptime']=preg_extract($read,'^.*?up ',' (\d+).user.*?$');
$topray['Load averages']=preg_extract($read,'^.*?load average: ','\n.*?$');
$topray['Users']=preg_extract($read,"^.*?up.*?".$topray['Uptime']." ",' user.*?$');
$topray['Processes total']=preg_extract($read,"^.*?".$topray['Load averages']."",' processes.*?$');
$topray['Processes running']=preg_extract($read,'^.*?sleeping ',' running.*?$');
$topray['Processes sleeping']=preg_extract($read,'^.*?processes: ',' sleeping.*?$');
$topray['Processes stopped']=preg_extract($read,'^.*?zombie ',' stopped.*?$');
$topray['Processes zombie']=preg_extract($read,'^.*?running ',' zombie.*?$');

$cpun=array('User','Nice','System','Irq','Softirq','Iowait','Idle');
$cput=trim(preg_extract($read,'^.*?total ','cpu00.*?$'));
$cput=explode("%",$cput);
$cpua=preg_extract($read,'^.*?cpu00 ','cpu01.*?$');
$cpua=explode("%",$cpua);
$cpub=preg_extract($read,'^.*?cpu01 ','cpu02.*?$');
$cpub=explode("%",$cpub);
$cpuc=preg_extract($read,'^.*?cpu02 ','cpu03.*?$');
$cpuc=explode("%",$cpuc);
$cpud=preg_extract($read,'^.*?cpu03 ','Mem.*?$');
$cpud=explode("%",$cpud);

$topray['Memory total']=number_format(preg_extract($read,'^.*?Mem: ','k av .*?$'));
$topray['Memory used']=number_format(preg_extract($read,'^.*?k av ','k used .*?$'));
$topray['Memory free']=number_format(preg_extract($read,'^.*?k used ','k free .*?$'));
$topray['Memory shared']=number_format(preg_extract($read,'^.*?k free ','k shrd.*?$'));
$topray['Memory buffer']=number_format(preg_extract($read,'^.*?k shrd ','k buff.*?$'));
$topray['Swap total']=number_format(preg_extract($read,'^.*?Swap: ','k av .*?$'));
$topray['Swap used']=number_format(preg_extract($read,'^.*?Swap.*?k av ','k used .*?$'));
$topray['Swap free']=number_format(preg_extract($read,'^.*?Swap.*?k used ','k free .*?$'));
$topray['Swap cached']=number_format(preg_extract($read,'^.*?Swap.*?k free ','k cached.*?$'));

?><table cellpadding="2" cellspacing="2" border="0" width="100%"><tr><th colspan="2">Server status monitor</th></tr><?php 
foreach($topray as $key=>$val){?><tr><td><?php echo $key;?></td><td><?php echo $val;?></td></tr><?php }
?><tr><td>Http processes</td><td><?php system ("ps -auxww | grep -c http");?></td></tr><tr><td>MySQL processes</td><td><?php 
system ("ps -auxww | grep -c mysql");
?></td></tr></table><table cellpadding="2" cellspacing="2" border="0" align="center"><tr><th colspan="8">CPU States</th></tr><?php 
echo '<tr><td> </td><td>'.$cpun[0].'</td><td>'.$cpun[1].'</td><td>'.$cpun[2].'</td><td>'.$cpun[3].'</td><td>'.$cpun[4].'</td><td>'.$cpun[5].'</td><td>'.$cpun[6].'</td><tr>';
echo '<tr><td>#1</td><td>'.number_format($cpua[0],2).'%</td><td>'.number_format($cpua[1],2).'%</td><td>'.number_format($cpua[2],2).'%</td><td>'.number_format($cpua[3],2).'%</td><td>'.number_format($cpua[4],2).'%</td><td>'.number_format($cpua[5],2).'%</td><td>'.number_format($cpua[6],2).'%</td><tr>';
echo '<tr><td>#2</td><td>'.number_format($cpub[0],2).'%</td><td>'.number_format($cpub[1],2).'%</td><td>'.number_format($cpub[2],2).'%</td><td>'.number_format($cpub[3],2).'%</td><td>'.number_format($cpub[4],2).'%</td><td>'.number_format($cpub[5],2).'%</td><td>'.number_format($cpub[6],2).'%</td><tr>';
echo '<tr><td>#3</td><td>'.number_format($cpuc[0],2).'%</td><td>'.number_format($cpuc[1],2).'%</td><td>'.number_format($cpuc[2],2).'%</td><td>'.number_format($cpuc[3],2).'%</td><td>'.number_format($cpuc[4],2).'%</td><td>'.number_format($cpuc[5],2).'%</td><td>'.number_format($cpuc[6],2).'%</td><tr>';
echo '<tr><td>#4</td><td>'.number_format($cpud[0],2).'%</td><td>'.number_format($cpud[1],2).'%</td><td>'.number_format($cpud[2],2).'%</td><td>'.number_format($cpud[3],2).'%</td><td>'.number_format($cpud[4],2).'%</td><td>'.number_format($cpud[5],2).'%</td><td>'.number_format($cpud[6],2).'%</td><tr>';
echo '<tr><td>total</td><td>'.number_format($cput[0],2).'%</td><td>'.number_format($cput[1],2).'%</td><td>'.number_format($cput[2],2).'%</td><td>'.number_format($cput[3],2).'%</td><td>'.number_format($cput[4],2).'%</td><td>'.number_format($cput[5],2).'%</td><td>'.number_format($cput[6],2).'%</td><tr>';
?></table><?php 
}else{?>This operating system is currently not supported.<?php }
/*_______________-=TheSilenT.CoM=-_________________*/
} else {
print<<<EOT
<font size=+5><center><a href="https://lordsoflords.com" target="_top">Lordsoflords.coM Servers</font><p>Click here to enteR</a>
EOT;
} //end oke
?>
</center></td></tr>