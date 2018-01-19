<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);
$max_topics =25;
if (!empty($_GET['fid'])) {$fid=clean_post($_GET['fid']);

if($pres=mysqli_query($link, "SELECT * FROM $tbl_forums WHERE (id=$fid and see<=$row->level) LIMIT 1")) {
if($frow=mysqli_fetch_object ($pres)){mysqli_free_result ($pres);

if (!empty($_GET['orderby'])) {$orderby=clean_post($_GET['orderby']);if (!in_array($orderby,$order)) {$orderby='last';}} else {$orderby='last';}
if (!empty($_GET['last_id'])) {$last_id=clean_post($_GET['last_id']);$where_id="$orderby<='$last_id'";} else {$where_id='id';}

if($tresult=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE ($where_id and fid=$fid and see<=$row->level and deleted=0) ORDER BY $orderby DESC LIMIT $max_topics")) {
$topics = mysqli_num_rows($tresult);
if($topics >= 1){
?><table width=100%><tr><th colspan=2><a href="?orderby=timer&fid=<?php print $fid;?>">Topics</a></th><th><a href="?orderby=replies&fid=<?php print $fid;?>">Replies</a></th><th><a href="?orderby=views&fid=<?php print $fid;?>">Views</a></th><th><a href="?orderby=last&fid=<?php print $fid;?>">Last post</a></th><th>Author</th></tr><?php 
$i=1;while ($trow=mysqli_fetch_object ($tresult)) {
if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor="";}

print '<tr'.$bgcolor.'><td valign=top nowrap>';
print ($row->id == 1 and $row->level >= 4)?'<a href="'.$root_url.'/edit.php?action=delete&kind=topic&did='.$trow->id.'&fid='.$trow->fid.'" title="Delete this topic!">X</a> ':'';
print ($trow->sticky)?'<b>'.$i.'!</b>':$i;
print '</td><td valign=top><a href="topic.php?fid='.$trow->fid.'&tid='.$trow->id.'">';
print substr($trow->name,0,50).'</a></td><td valign=top align=center>'.number_format($trow->replies).'</td><td valign=top align=center>'.number_format($trow->views).'</td><td valign=top><a href="profile.php?member='.$trow->charname.'">'.$trow->sex.' '.$trow->charname.'</a> <font size=1>'.dater($trow->last).' ago</font></td><td><a href="profile.php?member='.$trow->charname.'">'.$trow->csex.' '.$trow->ccharname.'</a> <font size=1>'.dater($trow->first).'</font></td>';

print '</tr>';
$i++;
$lastid=($trow->$orderby);
}
mysqli_free_result ($tresult);
if(!empty($lastid) and $topics == $max_topics){
	print '<tr><th colspan=6>';
	if(!empty($last_id)){
		print '<a href="?fid='.$fid.'&orderby='.$orderby.'">First</a>';
	}
	print ' <a href="?fid='.$fid.'&last_id='.$lastid.'&orderby='.$orderby.'">Next</a>';
//last failed
	print '</th></tr>';
}
?></table><?php 

if($frow->topics <> $topics){
if($tres=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE (fid=$fid and deleted=0)")) {
if($total_topics = mysqli_num_rows($tres)){mysqli_free_result ($tres);
mysqli_query($link, "UPDATE $tbl_forums SET topics=$total_topics WHERE id=$frow->id LIMIT 1");
}}}

}else{?><p><b>No visible topics here right now!</b></p><?php }


if($row->ev >= 1 and $row->mute <= 1 and $row->level >= $frow->level){?>
<hr>
<form method=post name="message_form" action="post.php?fid=<?php print $fid;?>" name=post><table width=100%><tr><th colspan=2>Create a new topic!</th></tr>
<tr><td>Topic name</td><td><input type=text name=name maxlength=100 size=98></td></tr>
<tr><td valign=top>Message<br><br>
Characters left<br><input disabled readonly type="text" name="counter" size="5" maxlength="5" value="<?php print ($max_characters);?>">

</td><td><textarea name=message cols=75 rows=15 onKeyDown="count(document.message_form.message,document.message_form.counter,<?php print $max_characters;?>')"
onKeyUp="count(document.message_form.message,document.message_form.counter,<?php print $max_characters;?>)"></textarea></td></tr>
<tr><th colspan=2><input type=submit name=action value="Create topic"></th></tr></table></form>

<script language="javascript">
<!--
function count(field,counter,maxlimit) {
if (field.value.length > maxlimit)
field.value = field.value.substring(0, maxlimit);
else
counter.value = maxlimit - field.value.length;
}
//-->
</script>

<?php 
}else{?><table width=100%><tr><th>You are not allowed to post here.</th></tr></table><?php }

}//query check
}else{?><table width=100%><tr><th>Sorry this forum has been deleted or moved.</th></tr></table><?php }
}//forum check

}//_get check

require_once($html_footer);
?>