<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);

$dir='logs';
$files=array();
if ($handle = opendir($dir)) {
$i=0;while (false !== ($file = readdir($handle))) {$i++;
if (preg_match("/(\d{2})-(\d{2})-(\d{4}).*?/",$file)) {
$files[filemtime($dir.'/'.$file)]=$file;
}
if($i>=1100){break;}
}
closedir($handle);
}


if(!empty($files)){
?><table cellpadding="1" cellspacing="0" border="0" width="100%"><tr><?php 
ksort($files);
$tfiles=count($files);
$del=0;$i=0;foreach ($files as $key=>$file){$i++;
if ($tfiles >= 995 and ($tfiles-$del) >= 995){
unlink($file);$del++;
}
if($i == 1 or substr($file,0,2) == '01'){if(strlen($file) <= 15){if(!empty($otd)){?></td><?php $otd=0;}?><td valign="top"><?php $otd=1;}}
?><a href="<?php print $dir.'/'.$file;?>"><?php echo preg_replace("/.php/i","",$file);?></a><br><?php 
if ($tfiles == $i){?></td><?php }
}
?></tr></table><b><br><?php print $tfiles.' log files kept.<br></b>';
}else{?>No logs available.<?php }

//LOGGING
if($tres=mysqli_query($link, "SELECT * FROM `$tbl_topics` WHERE `see`<=1 and `deleted`=1 ORDER BY `id` ASC LIMIT 100")){
if(mysqli_num_rows($tres) >= 1){

$file_dis = array("/ /i","/\//i");


while($trow=mysqli_fetch_object($tres)){
	$lastpost='';
$somecontent='<?php 
#!/usr/local/bin/php
require_once(\'../AdMiN/www.main.php\');
require_once(\'../\'.$inc_mysql);
include_once($html_header);
?>

<a href="/forums/logs.php">Return to logs homE</a><hr size=1><b>'.$trow->name.' - '.$trow->sex.' '.$trow->charname.'</b><br>'.postit($trow->body);
	$replies=0;
	if($cres=mysqli_query($link, "SELECT * FROM `$tbl_contents` WHERE `tid`=$trow->id ORDER BY `id` ASC")){
	while($crow=mysqli_fetch_object($cres)){$replies++;
$somecontent.='<br><b> - '.$crow->sex.' '.$crow->charname.' - '.$crow->date.'</b><br>'.postit($crow->body);
		$lastpost=substr($crow->date,0,11);
mysqli_query($link, "DELETE FROM `$tbl_contents` WHERE `id`=$crow->id LIMIT 1");
	}
	mysqli_free_result($cres);
	}
mysqli_query($link, "DELETE FROM `$tbl_topics` WHERE `id`=$trow->id LIMIT 1");
mysqli_query($link, "UPDATE `$tbl_forums` SET `topics`=`topics`-1,`posts`=`posts`-$trow->replies WHERE `id`=$trow->fid LIMIT 1");

$somecontent.='<hr size=1><a href="/forums/logs.php">Return to logs homE</a><?php include_once($html_footer);?>';

$logdate=date('d-m-Y');
$filename='logs/'.$logdate.'-by_'.$trow->sex.'_'.$trow->charname.'_with_'.$replies.'_replies_last_posted_'.$lastpost.'.php';
writer($filename,'w+',$somecontent);

}
mysqli_free_result($tres);

}}
//LOGGING

require_once($html_footer);
?>
