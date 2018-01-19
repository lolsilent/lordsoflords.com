<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);

if (!empty($forum_sid) and !empty($_GET['member']) and !empty($row->ev)) {
$member=clean_post($_GET['member']);

if($presult=mysqli_query($link, "SELECT * FROM $tbl_members WHERE (charname='$member') ORDER BY id desc LIMIT 1")){
if($prow=mysqli_fetch_object ($presult)){
mysqli_free_result ($presult);

if (!empty($prow->avatar)) {
list($width, $height, $type, $attr) = getimagesize($prow->avatar);
if ($width <= 5 or $height <= 5){
mysqli_query($link, "UPDATE $tbl_members SET avatar='' WHERE id='$prow->id' LIMIT 1");$prow->avatar='';
}
}

print '<table align=center><tr><th colspan=2>'.$prow->sex.' '.$prow->charname.'</th><th rowspan=25>'.(!empty($prow->avatar)?'<img src="'.$prow->avatar.'" border=0>':'').(!empty($prow->signature)?'<br>'.postit($prow->signature):'').'</th></tr><tr><td>Logged in for </td><td>'.dater($prow->session).'</td></tr><tr><td>Last activity</td><td>'.dater($prow->timer).' ago</td></tr><tr><td>Total posts</td><td>'.number_format($prow->posts).'</td></tr><tr><td>Posting since</td><td>'.$prow->since.'</td></tr>';

if ($prow->posts and $prow->last) {
?><tr><td><a href="?member=<?php print $prow->charname;?>&last=1" title="See the last few posts">Last posted</a></td><td><?php 
print dater($prow->last).' ago</td></tr>';
}


if ($prow->ec) {
if ($prow->email) {print '<tr><td>Email</td><td><a href="mailto:'.$prow->email.'">'.$prow->email.'</a></td></tr>';}
if ($prow->msn) {print '<tr><td>Msn</td><td><a href="mailto:'.$prow->msn.'">'.$prow->msn.'</a></td></tr>';}
if ($prow->icq) {print '<tr><td>Icq</td><td>'.$prow->icq.'</td></tr>';}
if ($prow->aim) {print '<tr><td>Aim</td><td>'.$prow->aim.'</td></tr>';}
if ($prow->yahoo) {print '<tr><td>Yahoo</td><td>'.$prow->yahoo.'</td></tr>';}
}

?></table><?php 


if (!empty($_GET['last'])) {
?><table cellpadding=2 cellspacing=2 border=1 width=100% bordercolor=<?php print $col_th;?>><?php 

if($tresult=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE (see<=$row->level and deleted=0 and charname='$prow->charname') ORDER BY id DESC LIMIT 10")){
?><tr><th>Last 5 topics</th></tr><?php 
while ($trow=mysqli_fetch_object ($tresult)) {
print '<tr><td valign=top>'.postit($trow->body).'</td></tr>';
}
mysqli_free_result ($tresult);
}

if($rresult=mysqli_query($link, "SELECT * FROM $tbl_contents WHERE (see<=$row->level and deleted=0 and charname='$prow->charname') ORDER BY id DESC LIMIT 5")) {
?><tr><th>Last 5 replies</th></tr><?php 
while ($rrow=mysqli_fetch_object ($rresult)) {
print '<tr><td valign=top>'.postit($rrow->body).'</td></tr>';
}
mysqli_free_result ($rresult);
}

?></table><?php 
}


}
}
} else {print '<b>You must login.</b>';}
require_once($html_footer);
?>