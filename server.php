<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($html_header);
?><table width=100%><tr><td><!--Load averages the average of 5, 10 and 15 minutes--><?php 

function preg_extract($string,$start,$end){
return trim(preg_replace("/$end/si","",preg_replace("/$start/si","",$string)));
}

/*
top - 00:11:48 up 1:39 1 user load average: 26.56 176.39 223.86 Tasks: 154 total 1 running 150 sleeping 1 stopped 2 zombie Cpu(s): 92.8%us 1.3%sy 0.0%ni 5.7%id 0.2%wa 0.0%hi 0.0%si 0.0%st Mem: 2074084k total 792816k used 1281268k free 107728k buffers Swap: 4128664k total 0k used 4128664k free 532608k cached PID USER PR NI VIRT RES SHR S %CPU %MEM TIME+ COMMAND 13223 nobody 15 0 2332 928 688 R 2.0 0.0 0:00.01 top 
*/
$topray=array();

$read='';
$fp = popen ("top -i -n 1 -b", "r");
$read .= fread($fp, 1500);
pclose ($fp);
$read = preg_replace("/,/i","",$read);

if(strlen($read) >= 300){
//print $read;

/*
top - 02:12:40 up 5 days 23:15 1 user load average: 0.26 0.17 0.10
Tasks: 253 total 1 running 252 sleeping 0 stopped 0 zombie
Cpu(s): 0.2%us 0.2%sy 0.2%ni 99.3%id 0.1%wa 0.0%hi 0.0%si 0.0%st
Mem: 32849920k total 6469932k used 26379988k free 264672k buffers
Swap: 16374780k total  0k used 16374780k free 4494076k cached

 PID USER  PR NI VIRT RES SHR S %CPU %MEM TIME+ COMMAND   
28945 thesilen 20 0 15164 1200 812 R 1.9 0.0 0:00.04 top    

*/

$topray['Uptime']=preg_extract($read,'^.*?up ',' (\d+).user.*?$');
$topray['Load averages']=preg_extract($read,'^.*?load average: ','\n.*?$');
$topray['Users']=preg_extract($read,"^.*?up.*?".$topray['Uptime']." ",' user.*?$');
$topray['Processes total']=preg_extract($read,"^.*?Tasks: ",' total.*?$');
$topray['Processes running']=preg_extract($read,'^.*?total ',' running.*?$');
$topray['Processes sleeping']=preg_extract($read,'^.*?running ',' sleeping.*?$');
$topray['Processes stopped']=preg_extract($read,'^.*?sleeping ',' stopped.*?$');
$topray['Processes zombie']=preg_extract($read,'^.*?stopped ',' zombie.*?$');

$topray['CPU us']=preg_extract($read,'^.*?Cpu\(s\): ','us.*?$');
$topray['CPU sy']=preg_extract($read,'^.*?\%us','sy.*?$');
$topray['CPU ni']=preg_extract($read,'^.*?sy','ni.*?$');
$topray['CPU id']=preg_extract($read,'^.*?\%ni','id.*?$');
$topray['CPU wa']=preg_extract($read,'^.*?id','wa.*?$');
$topray['CPU hi']=preg_extract($read,'^.*?wa','hi.*?$');
$topray['CPU si']=preg_extract($read,'^.*?hi','si.*?$');
$topray['CPU st']=preg_extract($read,'^.*?si','st.*?$');

$topray['Memory total']=number_format(preg_extract($read,'^.*?Mem: ','k .*?$'));
$topray['Memory used']=number_format(preg_extract($read,'^.*?k total ','k used .*?$'));
$topray['Memory free']=number_format(preg_extract($read,'^.*?k used ','k free .*?$'));
$topray['Memory buffer']=number_format(preg_extract($read,'^.*?k free ','k buff.*?$'));
$topray['Swap total']=number_format(preg_extract($read,'^.*?Swap: ','k total .*?$'));
$topray['Swap used']=number_format(preg_extract($read,'^.*?Swap.*?k total ','k used .*?$'));
$topray['Swap free']=number_format(preg_extract($read,'^.*?Swap.*?k used ','k free .*?$'));
$topray['Swap cached']=number_format(preg_extract($read,'^.*?Swap.*?k free ','k cached.*?$'));

?><table cellpadding="2" cellspacing="2" border="0" width="100%"><tr><th colspan="2">Server status monitor</th></tr><?php 
foreach($topray as $key=>$val){?><tr><td><?php print $key;?></td><td><?php print $val;?></td></tr><?php }
?></table>
<?php 
}else{?>This operating system is currently not supported.<?php }
?>
</center></td></tr></table>
<?php require_once($html_footer);?>
