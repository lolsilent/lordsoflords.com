<?php 
require_once 'AdMiN/www.main.php';
include_once("$html_header");

if (isset ($lol)) {
echo "<textarea cols=25 rows=25>";
	while (list ($name, $value) = each ($lol)) {
echo "$name = $value\n";
	}
echo "</textarea>";
} else {
echo "No proof left.";
}

include_once("$html_footer");
exit;

?>