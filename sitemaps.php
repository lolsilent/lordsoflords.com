<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($html_header);


$files=array();
if ($handle = opendir('.')) {
while (false !== ($file = readdir($handle))) {
if (preg_match("/.*?\.php$/",$file)) {
$files[]=$file;
}
}
closedir($handle);
}


if(!empty($files)){
sort($files);
foreach ($files as $file){
if(!preg_match("@$file$@",$_SERVER['PHP_SELF'])) {
	if($file == 'logout.php'){$logout=1;continue;}
	print '<a href="'.$file.'">'.preg_replace("/\.php$/","",$file).'</a><br>';
}
}

}

require_once($html_footer);
?>