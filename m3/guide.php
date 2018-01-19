<?php 
#!/usr/local/bin/php
require_once "AdMiN/www.main.php";
include_once("$html_header");

$guide_topics = array (
'index'=>'guide home',
'chatting'=>'chatting',
'charms'=>'charms',
'races'=>'races',
'guilds'=>'guilds/clans',
'politics'=>'politics',
'titles'=>'noble titles',
'stats'=>'stats',
'inventory'=>'inventory',
'support'=>'support',
'formulas'=>'formulas'
);
?>

<table width=100% cellpadding=0 cellspacing=1 border=1>
<tr><th align=center>The complete guide, listing and formulas for <?php echo $title; ?>.<br>
Last updated 8-7-2003 23:17
</th></tr>
<tr><td>
<?php 
foreach ($guide_topics as $key=>$val) {
echo '<a href="?see='.$key.'">'.ucfirst($val).'</a> | ';
}
?>
</td></tr><tr><td><?php 
foreach ($items as $val) {
	$val=preg_replace("/s$/i","",$val);//remove pantss to pants
echo '<a href="?see=listing&listing='.strtolower($val).'s">'.ucfirst($val).'s</a> | ';
}
?>
<a href="?see=listing&listing=monsters">Town Monsters</a></td></tr></table>

<?php 
if (empty($_GET['see'])) {
$see='index';
} else {
	$guide_topics_keys=array_keys($guide_topics);
	array_push($guide_topics_keys,'listing');
if (!in_array($_GET['see'],$guide_topics_keys)) {$see='index';} else {$see=$_GET['see'];}
}
?><table width=100% cellpadding=0 cellspacing=1 border=1><?php 
include_once "guides/guide.$see.php";
?></table><?php 

include_once("$html_footer");
?>