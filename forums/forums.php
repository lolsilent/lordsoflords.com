<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);
?><table width=100%><?php 
$ftot_top=0;
$ftot_pos=0;
if($fresult=mysqli_query($link, "SELECT * FROM $tbl_forums WHERE (id and see<=$row->level) ORDER BY id asc LIMIT 100")){
while ($frow=mysqli_fetch_object ($fresult)) {
$ftot_top+=$frow->topics;
$ftot_pos+=$frow->posts;

if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor="";}
if ($frow->category) {
?><tr><th><?php print $frow->name; ?></th><th align=center>Topics</th><th align=center>Posts</th><th align=center>Last post</th></tr><?php 
} else {

print '<tr'.$bgcolor.'><td valign=top><b><a href="forum.php?fid='.$frow->id.'">'.$frow->name.'</a></b><br>'.$frow->decription.'<br>';

if ($frow->see) {
print '<font size=-1>';
if (in_array($level[$frow->see],$level)) {$sex_see=$level[$frow->see];} else {$sex_see="Power admin's";}
print ' [Can be seen by '.ucfirst($sex_see).'\'s or higher.]';
print '</font>';
}
if ($frow->level) {
print ' <font size=-1>';
if (in_array($level[$frow->level],$level)) {$post_allow=$level[$frow->level];} else {$post_allow="Power admin's";}
print ' [Post allowed by '.ucfirst($post_allow).'\'s or higher.]';
print '</font>';
}

print '</td><td align=center valign=top NOWRAP>'.number_format($frow->topics).'</td><td align=center valign=top NOWRAP>'.number_format($frow->topics+$frow->posts).'</td><td valign=top NOWRAP>';if ($frow->last) {print '<a href="profile.php?member='.$frow->charname.'">'.$frow->sex.' '.$frow->charname.'</a><br><font size=1>was here '.dater($frow->last).' ago</font>';} else {print 'Nobody';} print '</td></tr>';
}
}
mysqli_free_result ($fresult);
}
?>
</table>
<hr size=1>
<table width=100%>
<tr><th>Since March 2003</th></tr>
<tr><td valign=top>
<?php 
print (!empty($row->session))?'You are logged in for '.dater($row->session).'.<br>':'';

if($ttresult=mysqli_query($link, "SELECT id FROM $tbl_topics WHERE id and deleted=0 order by id desc")){
$atrow=mysqli_fetch_object ($ttresult);
print 'Total active topics : <b>'.number_format(mysqli_num_rows($ttresult)).'</b> / '.number_format($atrow->id).'<br>';
mysqli_free_result ($ttresult);
}

if($tcresult=mysqli_query($link, "SELECT id FROM $tbl_contents WHERE id and deleted=0 order by id desc")){
$acrow=mysqli_fetch_object ($tcresult);
$posts=mysqli_num_rows($tcresult);
print 'Total active posts since March 2003 : <b>'.number_format($ftot_top+$ftot_pos).'</b> / '.number_format($atrow->id+$acrow->id).'<br>';
mysqli_free_result ($tcresult);
}

if($tmresult=mysqli_query($link, "SELECT id FROM $tbl_members WHERE id order by id desc")){
$marow=mysqli_fetch_object ($tmresult);
print 'Total active members : <b>'.number_format(mysqli_num_rows($tmresult)).'</b> / '.number_format($marow->id).'<br>';
mysqli_free_result ($tmresult);
}

if($nmresult=mysqli_query($link, "SELECT sex,charname FROM $tbl_members WHERE id ORDER BY id desc LIMIT 1")){
$nrow=mysqli_fetch_object ($nmresult);
mysqli_free_result ($nmresult);
print 'We welcome our newest member : <a href="profile.php?member='.$nrow->charname.'">'.$nrow->sex.' '.$nrow->charname.'</a><br>';
}

if($oresult=mysqli_query($link, "SELECT id,sex,charname FROM $tbl_members WHERE timer >=$current_time-600 ORDER BY charname ASC")){
print 'There are <b>'.number_format(mysqli_num_rows($oresult)).'</b> members online<br>';
while ($onrow=mysqli_fetch_object ($oresult)) {
print '<a href="profile.php?member='.$onrow->charname.'">'.$onrow->sex.' '.$onrow->charname.'</a> ';
}
mysqli_free_result ($oresult);
}
?></td></tr></table><?php require_once($html_footer);?>