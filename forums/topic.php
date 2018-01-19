<?php 
#!/usr/local/bin/php
ob_start("callback");

require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);
$sss = array($title, "free online text-based massive multiplayer online role playing game (MMORPG) forums", "free, online, text, based, massive, multiplayer, online role, playing, game, MMORPG, MPORPG, gaming, forum, forums");

if (!empty($_GET['tid'])) {$tid=clean_post($_GET['tid']);} else {$tid='';}

if(empty($tid)) {
	//NOTOPIC
?><b>Topic not found loading all topic index.</b><br><?php 
if($tresult=mysqli_query($link, "SELECT `id`,`name` FROM `$tbl_topics` WHERE (`id`and `see`<='$row->level' and `deleted`='0') ORDER BY `id` DESC LIMIT 5000")){
while($trow=mysqli_fetch_object ($tresult)){
echo $trow->id.' - <a href="?tid='.$trow->id.'">'.$trow->name.'</a><br>';
}
mysqli_free_result ($tresult);
}
	//NOTOPIC
}else{

if($tresult=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE (id=$tid and see<=$row->level and deleted=0) ORDER BY id DESC LIMIT 1")){
if($trow=mysqli_fetch_object ($tresult)){
mysqli_free_result ($tresult);

		$title=$trow->name;

?><table border=1 width=100% bordercolor=<?php print $col_th;?>><?php 

if($fresult=mysqli_query($link, "SELECT * FROM $tbl_forums WHERE (id='$trow->fid' and see<=$row->level) LIMIT 1")){
if($frow=mysqli_fetch_object ($fresult)) {
print '<tr><th colspan=2 align=left><img src="/images/emotions/star.gif" border=0><a href="/forums/forums.php">Forums</a><img src="/images/emotions/star.gif" border=0><a href="forum.php?fid='.$trow->fid.'">'.$frow->name.'<img src="/images/emotions/star.gif" border=0></th></tr>';
}
}

if($mresult=mysqli_query($link, "SELECT * FROM $tbl_members WHERE charname='$trow->ccharname' ORDER BY id DESC LIMIT 1")){
if($mrow=mysqli_fetch_object ($mresult)){
mysqli_free_result ($mresult);
}}

print '<tr><th colspan=2><font size=+2>'.$trow->name.($trow->sticky?'</font> <font color='.$col_link.'><sup>sticky</sup':'').'</font></th></tr><tr><td valign=top width=125 NOWRAP>';
print (!empty($mrow))?'<a href="profile.php?member='.$mrow->charname.'">'.$mrow->sex.' '.$mrow->charname.'</a>':'Death poster';
print (!empty($mrow->avatar))?'<br><img src="'.$mrow->avatar.'" border=0>':'';
print '<br>'.dater($trow->first).' ago';if ($row->charname==$trow->ccharname or $row->level >=4) {print '<br>[';print '<a href="edit.php?action=edit&kind=topic&did='.$trow->id.'&fid='.$frow->id.'">edit</a> <a href="edit.php?action=delete&kind=topic&did='.$trow->id.'&fid='.$frow->id.'">delete</a>]<br><font size=1>'.$trow->ip.'</font>';}
print (!empty($mrow))?'<font size=1><br>Made '.number_format($mrow->posts).' posts since '.$mrow->since.'</font>':'';
print '<br>[<a href="blog.php?fbid='.(!empty($mrow->id)?$mrow->id:'').'">My Blog</a>]</td><td valign=top>'.postit((!empty($trow->body)?$trow->body:''));
print (!empty($mrow->signature))?'<hr size=1><i><font size=-1>'.postit($mrow->signature).'</font></i>':'';
print '</td></tr>';
mysqli_query($link, "UPDATE $tbl_topics SET views=views+1 WHERE (id=$trow->id and see<=$row->level and deleted=0) LIMIT 1");


if ($trow->replies >= 1) {
if($nreply=mysqli_query($link, "SELECT id FROM $tbl_contents WHERE (tid=$trow->id and see<=$row->level and deleted=0) ORDER BY id ASC")) {
if($total_replies = mysqli_num_rows($nreply)){mysqli_free_result ($nreply);}}

if (!empty($_GET['last_id'])) {$last_id=clean_post($_GET['last_id']);$where_id="`id`>='$last_id'";} else {$where_id='`id`';}
if($rresult=mysqli_query($link, "SELECT * FROM $tbl_contents WHERE ($where_id and `tid`='$trow->id' and `see`<='$row->level' and `deleted`='0') ORDER BY `id` ASC LIMIT $max_posts")) {
$replies = mysqli_num_rows($rresult);
while ($rrow=mysqli_fetch_object ($rresult)) {

if($rmresult=mysqli_query($link, "SELECT `id`,`sex`,`charname`,`since`,`posts`,`avatar`,`signature` FROM `$tbl_members` WHERE `charname`='$rrow->charname' ORDER BY `id` DESC LIMIT 1")){
if($rmrow=mysqli_fetch_object ($rmresult)){
mysqli_free_result ($rmresult);
$member_id = $rmrow->id;
}else{
$member_id = 'DEAD';
}
}

print '<tr><td valign=top width=125 NOWRAP>';
print (!empty($rmrow))?'<a href="profile.php?member='.$rmrow->charname.'">'.$rmrow->sex.' '.$rmrow->charname.'</a>':'Death poster';
print (!empty($rmrow->avatar))?'<br><img src="'.$rmrow->avatar.'" border=0>':'';
print '<br>'.dater($rrow->timer).' ago'; if ($row->charname==$rrow->charname or $row->level >=4) {print '<br>[';print '<a href="edit.php?action=edit&kind=reply&did='.$rrow->id.'&fid='.$frow->id.'">edit</a> <a href="edit.php?action=delete&kind=reply&did='.$rrow->id.'&fid='.$frow->id.'">delete</a>]<br><font size=1>'.$rrow->ip.'</font>';}
print (!empty($rmrow))?'<font size=1><br>Made '.number_format($rmrow->posts).' posts since '.$rmrow->since.'</font>':'';
print '<br>[<a href="blog.php?fbid='.$member_id.'">My Blog</a>]</td><td valign=top>'.postit($rrow->body);
print (!empty($rmrow->signature))?'<hr size=1><i><font size=-1>'.postit($rmrow->signature).'</font></i>':'';
print '</td></tr>';

$lastid=$rrow->id+1;
}
mysqli_free_result ($rresult);
if($total_replies > $max_posts){
	print '<tr><th colspan=2>';
	if(!empty($last_id)){
		print '<a href="?fid='.$trow->fid.'&tid='.$trow->id.'">First</a>';
	}
	if($replies == $max_posts){
		print ' <a href="?fid='.$trow->fid.'&tid='.$trow->id.'&last_id='.$lastid.'">Next</a>';
if($lres=mysqli_query($link, "SELECT `id` FROM `$tbl_contents` WHERE ($where_id and `tid`='$trow->id' and `see`<='$row->level' and `deleted`='0') ORDER BY id DESC LIMIT 1")) {
	if($lcrow=mysqli_fetch_object ($lres)){mysqli_free_result ($lres);
print ' <a href="?fid='.$trow->fid.'&tid='.$trow->id.'&last_id='.($lcrow->id-$max_posts).'">Last</a>';
	}
	}
	}
	print '</th></tr>';
}

if($total_replies <> $trow->replies){
mysqli_query($link, "UPDATE `$tbl_topics` SET `replies`='$total_replies' WHERE `id`='$trow->id' LIMIT 1");
}

}
}
?></table><?php 


if($row->ev >= 1 and $row->mute <= 1 and $row->level >= $frow->level){?>

<form method=post action="post.php?tid=<?php print $tid;?>&fid=<?php print $frow->id;?>" name=post><table width=100%><tr><th colspan=2>Post your reply!</th></tr>
<tr><td valign=top width=125>Message</td><td><textarea name=message cols=75 rows=15 style="width:100%"></textarea></td></tr>
<tr><th colspan=2><input type=submit name=action value="Post reply"></th></tr></table></form>
<?php 
}else{?><table width=100%><tr><th>You are not allowed to post here.</th></tr></table><?php }

}else{?><b>We are very sorry for this inconvenience, this topic does not exist or has been deleted.</b><?php }
}
}
require_once($html_footer);


function callback($buffer) {
global $sss,$title,$tid;
if(!empty($tid)){
 return (str_replace($sss, $title, $buffer));
}else{return $buffer;}
}


ob_end_flush();
?>