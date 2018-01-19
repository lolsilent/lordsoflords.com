<?php 
if (!empty($_POST['goTO'])) {
$location=$_POST['goTO'];
if ($location !== '----------') {
	header("Location: $location");exit;
} else {
	require_once 'AdMiN/www.main.php';
	include_once $clean_header;
	echo "YOU JUST FOUND A GODS CHARM, AND 1.000.000 CREDITS.";
}
} else {
require_once 'AdMiN/www.main.php';
include_once $clean_header;
?>
<form method="post" action="menu2.php" name="menu" target="lol_main">
<select name="goTO" onchange="this.form.submit()">
<?php 
foreach ($gamefiles as $file) {
	if ($file !== 'br') {
	print "<option value=\"$file.php\">".ucfirst($file)."</option>";
	} else {
	print "<option>----------</option>";
	}
}
?>
<option>----------</option>
<?php 
foreach ($files as $file) {
	print "<option value=\"$file.php\">".ucfirst($file)."</option>";
}
?>
</select>
<noscript><input type="submit" name="Go" value="Go"></noscript>
<?php 
}
include_once $clean_footer;
?>