<?php 
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);

if (!empty($_GET['orderby'])) {$orderby=clean_post($_GET['orderby']);if (!in_array($orderby,$order)) {$orderby='last';}} else {$orderby='last';}

?>
<table width=100%><tr><th colspan=6>Sticky and Important posts</th></tr><tr><th colspan=2><a href="?orderby=timer">Topics</a></th><th><a href="?orderby=replies">Replies</a></th><th><a href="?orderby=views">Views</a></th><th><a href="?orderby=last">Last post</a></th></tr>
<?php 
$index_limit=35;$i=1;

if($tresult=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE (sticky >=1 and see<=$row->level and deleted=0) ORDER BY $orderby DESC LIMIT 50")){
while ($trow=mysqli_fetch_object ($tresult)) {
if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor="";}
print '<tr'.$bgcolor.'><td valign=top NOWRAP><b>'.$i.'!</b></td><td valign=top><a href="topic.php?tid='.$trow->id.'">'.substr($trow->name,0,100).'</a></td><td valign=top align=center>'.number_format($trow->replies).'</td><td valign=top align=center>'.number_format($trow->views).'</td><td valign=top><a href="profile.php?member='.$trow->charname.'">'.$trow->sex.' '.$trow->charname.'</a> <font size=1>'.dater($trow->last).' ago</font></td></tr>';$i++;
$index_limit--;
}
mysqli_free_result ($tresult);
}

?><tr><th colspan=6>Newest and Latest posts</th></tr><tr><th colspan=2><a href="?orderby=timer">Topics</a></th><th><a href="?orderby=replies">Replies</a></th><th><a href="?orderby=views">Views</a></th><th><a href="?orderby=last">Last post</a></th></tr><?php 

if($tresult=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE (see<=$row->level and sticky<=0 and deleted=0) ORDER BY $orderby desc LIMIT $index_limit")){
while ($trow=mysqli_fetch_object ($tresult)) {
if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor="";}
print '<tr'.$bgcolor.'><td valign=top NOWRAP>'.$i.'</td><td valign=top><a href="topic.php?tid='.$trow->id.'">'.substr($trow->name,0,50).'</a></td><td valign=top align=center>'.number_format($trow->replies).'</td><td valign=top align=center>'.number_format($trow->views).'</td><td valign=top><a href="profile.php?member='.$trow->charname.'">'.$trow->sex.' '.$trow->charname.'</a> <font size=1>'.dater($trow->last).' ago</font></td></tr>';$i++;
$index_limit--;
}
mysqli_free_result ($tresult);
}

?></table>
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
print 'Total posts since March 2003 : <b>'.number_format($atrow->id+$acrow->id).'<br>';
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