<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);

$blogs = array();
if ($bresult = mysqli_query($link, "SELECT `mid` FROM `$tbl_blog` WHERE `id` ORDER BY `id` DESC LIMIT 10000")){
while ($brow = mysqli_fetch_object($bresult)) {
$blogs[]=$brow->mid;
}
mysqli_free_result($bresult);
}

$blogs=array_count_values($blogs);

foreach ($blogs as $key=>$val){

if($mresult=mysqli_query($link, "SELECT `sex`,`charname` FROM $tbl_members WHERE `id`='$key' ORDER BY `id` DESC LIMIT 1")){
if($mrow=mysqli_fetch_object ($mresult)){
mysqli_free_result ($mresult);

echo '<a href="blog.php?fbid='.$key.'">'.$mrow->sex.' '.$mrow->charname.' made '.$val.' logs</a><br>';
}
}

}
?>
<table width=100%>
<tr><th>Since December 2005</th></tr>
<tr><td valign=top>
Total <?php echo count($blogs);?> members made a total of <?php echo array_sum($blogs);?> logs since December 2005.
</td></tr></table>
<?php 
require_once($html_footer);
?>