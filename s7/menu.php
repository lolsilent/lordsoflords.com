<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
include_once $clean_header;

$alignable = array('left','right','center','top','bottom');

$align='center';
$valign='top';

if (!empty($_COOKIE['align'])) {
	$align=clean_post($_COOKIE['align']);
	if (!in_array($align,$alignable)) {$align='center';}
}

if (!empty($_COOKIE['valign'])) {
	$valign=clean_post($_COOKIE['valign']);
	if (!in_array($valign,$alignable)) {$align='top';}
}

if (!empty($_GET['align'])) {
	$align=clean_post($_GET['align']);
	if (in_array($align,$alignable)) {
		setcookie ("align", "$align",$current_time+5000000) or die("$error_message");
	}
}

if (!empty($_GET['valign'])) {
	$valign=clean_post($_GET['valign']);
	if (in_array($valign,$alignable)) {
		setcookie ("valign", "$valign",$current_time+5000000) or die("$error_message");
	}
}

?>
<table width=100% height=100% border=0 cellpadding=0 cellspacing=0>
<tr><td height=35><img src="<?php print($images_url);?>/frametop.gif" border=0></td></tr>
<tr><td align="<?php print $align;?>" valign="<?php print $valign;?>" background="<?php print($images_url);?>/frame.gif"><b>
<?php 
foreach ($gamefiles as $file) {
if ($file == 'br') {echo "<br>";} else {
if ($file == "logout") {$target="_top";} else {$target="lol_main";}
print "<a href=\"$root_url/$file.php\" target=\"$target\">"; $file=ucfirst($file); echo"$file</a><br>";
}
}
?>
<a href="layout.php" target="lol_main">Layout</a><br>

<a href="menu.php?align=left" title="Align left">.</a>
<a href="menu.php?align=center" title="Align center">.</a>
<a href="menu.php?align=right" title="Align right">.</a>
<br>
<a href="menu.php?valign=top" title="Vertical Align top">.</a>
<a href="menu.php?valign=center" title="Vertical Align center">.</a>
<a href="menu.php?valign=bottom" title="Vertical Align bottom">.</a>

<a href="<?php echo $root_url; ?>/hospital.php" target="lol_main">.</a>
</td></tr>
<tr><td height=35><a href="<?php echo $root_url; ?>/" target="lol_main"><img src="<?php print($images_url);?>/framebot.gif" border=0></a></td></tr>
</table>
<?php 
include_once $clean_footer;
?>