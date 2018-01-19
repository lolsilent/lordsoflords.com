<tr>
<th align=center>Politics</th></tr><tr> <td>
You must be in the top 100 ladder to join The High Council, once you are a member of the Council you may vote for new players who applied for a job in the councils.
One player may only have one High Council!! Depending on the population of the current server you are on, it shows how much Councils are allowed.
<br>
<table cellpadding=0 cellspacing=1 border=1 width=100%>
<tr><th colspan=4>Politic rules</th></tr>
<tr><th>Change to</th><th>Permissions needed of</th><th>Current Sex</th><th>Requirement</th></tr>
<?php 
require_once $inc_dir.'/mute.permissions.php';
foreach ($permissionsss as $key=>$val) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"#234567\"";} else {$bgcolor='';}
echo "<tr$bgcolor><td>$key</td><td>$val[0]</td><td>$val[1]</td><td>$val[2]</td></tr>";
}
?>
</table>
</td></tr>