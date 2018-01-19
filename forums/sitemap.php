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
	print '<a href="'.$file.'">'.$file.'</a>';?><br><iframe src="<?php print $file?>" width=100% height=250 border=1></iframe><br><?php 
}
}
}
?>