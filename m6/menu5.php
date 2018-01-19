<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';

include_once $clean_header;
?><font size=1>
<a href="<?php echo $root_url; ?>/hospital.php" target="lol_main">.</a>
<?php 
foreach ($gamefiles as $file) {
if ($file !== 'br') {
if ($file == "logout") {$target="_top";} else {$target="lol_main";}
print "<a href=\"$root_url/$file.php\" target=\"$target\">"; $file=ucfirst($file); echo"$file</a> ";
}
}
?>
<a href="<?php echo $root_url; ?>/ladders.php" target="lol_main">Ladders</a> <a href="<?php echo $root_url; ?>/forum.php" target="lol_main">Forums</a> <a href="<?php echo $root_url; ?>/guide.php" target="lol_main">Guide</a> <a href="<?php echo $root_url; ?>/theone.php" target="lol_main">.</a>
</font>
<?php 
include_once $clean_footer;
?>