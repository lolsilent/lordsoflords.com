<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_ffunctions);
require_once($inc_emotions);
require_once($html_header);
?><table width=100%><tr><th>Game news</th></tr><?php 
$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

if ($result = mysqli_query($link, "SELECT * FROM `$tbl_news` WHERE !`nid` ORDER BY `id` DESC LIMIT 25")){
while ($row = mysqli_fetch_object($result)) {
print '<tr><th>'.$row->date.' ('.dater($row->timer).' ago)<tr><td>'.postit($row->news).'</td></tr>';
}
mysqli_free_result($result);
}
mysqli_close($link);
?></table><?php 
require_once($html_footer);
?>