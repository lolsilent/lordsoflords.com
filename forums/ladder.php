<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);
?><table width=100%><tr><th colspan=2>Posting ladder</th><th>Posts</th><th>Last post</th><th>Last active</th><th>Since</th></tr><?php 
$query="SELECT * FROM $tbl_members WHERE id ORDER BY posts desc LIMIT 50";
$result=mysqli_query($link, $query) or die ("Query failed");
$i=1;
while ($lrow=mysqli_fetch_object ($result)) {
print '<tr><td>'.$i.'</td><td><a href="profile.php?member='.$lrow->charname.'">'.$lrow->sex.' '.$lrow->charname.'</a></td><td>'.number_format($lrow->posts).'</td><td>'.dater($lrow->last).' ago</td><td>';
print ($lrow->session)?dater($lrow->session).' ago':'Logged off';
print '</td><td>'.$lrow->since.'</td></tr>';$i++;
}
mysqli_free_result ($result);
?></table><?php require_once($html_footer);?>