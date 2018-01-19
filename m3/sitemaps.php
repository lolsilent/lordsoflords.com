<?php 
#!/usr/local/bin/php



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
	print $file.'<iframe width=100% height=100% src="'.$file.'"></iframe>';
}
}

}


?>