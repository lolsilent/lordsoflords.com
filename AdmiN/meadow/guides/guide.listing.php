<?php 
if (isset($_GET['listing'])) {
while (is_array($_GET) && list($key, $val) = each($_GET)) {
	switch ($val) {
case "weapons":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;
foreach ($Weapons as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "armors":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Armors as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "shields":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Shields as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "rings":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Rings as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "amulets":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Amulets as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "helmets":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Helmets as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "belts":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Belts as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "pants":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Pants as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "hands":
require_once $inc_dir."/Items/array.hands.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Hands as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "healspells":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Healspells as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "attackspells":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Attackspells as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "feets":
require_once $inc_dir."/Items/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($Feets as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

case "monsters":
require_once $inc_dir."/array.$val.php";
$val=ucfirst($val);
echo "<tr><th colspan=2>$val list</th></tr>";
$i=1;foreach ($monsters_array as $val) {
echo<<<EOT
<tr><td>$i</td><td>$val</td></tr>
EOT;
$i++;
}
break;

	}
}
}
?>