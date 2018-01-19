<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';
if (!empty($_GET['unignore'])) {
if (!empty($_COOKIE['lol_ignore'])) {
$totalignore='';
$ignored = explode(",",$_COOKIE['lol_ignore']);
$ignored = array_unique($ignored);
foreach ($ignored as $val) {
if ($_GET['unignore'] !== $val and $val !== '') {
$totalignore="$totalignore$val,";
}
}

setcookie ("lol_ignore", "$totalignore",time()+84600*360) or die("$error_message");
$_COOKIE['lol_ignore']=$totalignore;
}
}

if (!empty($_GET['charname'])) {
if (empty($_COOKIE['lol_ignore'])) {
$totalignore=$_GET['charname'];
} else {
$ignored = explode(",",$_COOKIE['lol_ignore']);
if (!in_array($_GET['charname'],$ignored)) {
$totalignore=$_COOKIE['lol_ignore'].','.$_GET['charname'];
} else {
$totalignore=$_COOKIE['lol_ignore'];
}
}
setcookie ("lol_ignore", "$totalignore",time()+84600*360) or die("$error_message");
$_COOKIE['lol_ignore']=$totalignore;
}

include_once $game_header;
?>
<table cellpadding=0 cellspacing=1 border=0 width=100%> <tr><th colspan=2>My ignore list</th></tr>
<tr><td>
<?php 
if (!empty($_COOKIE['lol_ignore'])) {$ignored = explode(",",$_COOKIE['lol_ignore']);} else {$ignored=array();}
foreach ($ignored as $val) {
echo "<a href=\"$PHP_SELF?unignore=$val\">$val</a><br>";
}
?>
</td></tr>
</table>
<?php 
if (!empty($_GET['unignore'])) {
echo "Unignore ".$_GET['unignore'];
}

if (!empty($_GET['charname'])) {
echo "Ignoring ".$_GET['charname'];
}
include_once "$clean_footer";
?>