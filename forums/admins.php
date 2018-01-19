<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);

if ($row->level >=4 and $row->mute <= 0) {
$forum_ops=array ('admin', 'cop', 'mod', 'support');
$doings=array ('ban', 'allow', 'admin', 'cop', 'mod', 'support', 'lord', 'lady');

?><p><a href="?">Member Finder</a> | <a href="?action=topics">Manage Topics</a> | <a href="?action=replies">Manage Replies</a> | <a href="?action=logs">Delete Logs</a> | <a href="?action=news">Action News</a> | <a href="?action=cleaner">Inactivity cleaner</a><br>
</p><p>Show current <?php 
foreach ($forum_ops as $val) {
print '<a href="?action='.$val.'">'.ucfirst($val).'s</a> ';
} print '</p>';

if(!empty($_GET['action'])){$action=clean_post($_GET['action']);}
if(empty($action)){
/*_______________-=TheSilenT.CoM=-_________________*/

if (!empty($_GET['do']) and !empty($_GET['mid'])) {
$do=clean_post($_GET['do']);$mid=clean_post($_GET['mid']);

if($sresult=mysqli_query($link, "SELECT * FROM $tbl_members WHERE id='$mid' ORDER BY id desc LIMIT 1")){
if($srow=mysqli_fetch_object ($sresult)) {
mysqli_free_result ($sresult);

switch ($do){
case $doings[0]:$admin_it="mute=$current_time";break;
case $doings[1]:$admin_it="mute=0";break;
case $doings[2]:$admin_it="sex='Admin', level=5";break;
case $doings[3]:$admin_it="sex='Cop', level=3";break;
case $doings[4]:$admin_it="sex='Mod', level=2";break;
case $doings[5]:$admin_it="sex='Support', level=1";break;
case $doings[6]:$admin_it="sex='Lord', level=0";break;
case $doings[7]:$admin_it="sex='Lady', level=0";break;
}
if(!empty($admin_it)){
mysqli_query($link, "UPDATE $tbl_members SET $admin_it WHERE id='$mid' LIMIT 1");
$do=$do.'ed';
mysqli_query($link, "INSERT INTO $tbl_news ($fld_news) values ('','','$row->sex $row->charname $do $srow->sex $srow->charname','$current_time')");
print '<p align=center><b>You casted sex change on '.$srow->sex.' '.$srow->charname.'!</b></p>';
}
}
}
}

if (!empty($_GET['find']) and !empty($_GET['type'])) {$find=clean_post($_GET['find']);$type=clean_post($_GET['type']);}
if (!empty($_POST['find']) and !empty($_POST['type'])) {$find=clean_post($_POST['find']);$type=clean_post($_POST['type']);}

$founder=array('charname','ip','sex');
?><form method="post"><table width=100%><tr><th>Find member by <select name=type><?php 
foreach ($founder as $val){
if(isset($type) && $val == $type){
print '<option selected>'.$val.'</option>';
}else{print '<option>'.$val.'</option>';}
}
?></select><input type=text name=find value="<?php print (!empty($find))?$find:'';?>"><input type=submit value=Find></th></tr></table></form>Partial charname or ip is accepted with at least 2 chars.<br><?php 

if (!empty($find) and !empty($type)) {
if ($type=='ip' or $type=='charname' or $type=='sex') {
if ($type=='charname') {
	if (strlen($find) >= 2) {
	$where_seek="`charname` LIKE CONVERT (_utf8 '%$find%' USING latin1) COLLATE latin1_swedish_ci";
	}else{$where_seek="`charname`=''";}
}else{$where_seek="$type='$find'";}
if($aresult=mysqli_query($link, "SELECT * FROM $tbl_members WHERE ($where_seek) ORDER BY id desc LIMIT 100")){
?><table width=100%><tr><th>Member</th><th>IP</th><th>Active</th><th>Actions</th></tr><?php 
while ($frow=mysqli_fetch_object ($aresult)) {
print '<tr><td><a href="profile.php?member='.$frow->charname.'">'.$frow->sex.' '.$frow->charname.'</a></td><td><a href="?find='.$frow->ip.'&type=ip">'.$frow->ip.'</a></td><td>'.($frow->timer?dater($frow->timer):'No').'</td><td>';
foreach ($doings as $val) {
print '<a href="?do='.$val.'&mid='.$frow->id.'">'.ucfirst($val).'</a> ';
}
?></td></tr><?php 
}
mysqli_free_result ($aresult);
?></table><?php 
}
}
}

if($bresult=mysqli_query($link, "SELECT * FROM $tbl_members WHERE mute>=1 ORDER BY id desc LIMIT 100")){
?><table width=100%><tr><th colspan=4>Banned</th></tr><tr><th>Member</th><th>IP</th><th>Active</th><th>Actions</th></tr><?php 
while ($brow=mysqli_fetch_object ($bresult)) {
print '<tr><td><a href="profile.php?member='.$brow->charname.'">'.$brow->sex.' '.$brow->charname.'</a> in jail for '.dater($brow->mute).'</td><td><a href="?find='.$brow->ip.'&type=ip">'.$brow->ip.'</a></td><td>'.($brow->timer?dater($brow->timer):'no').'</td><td>';
foreach ($doings as $val) {
print '<a href="?do='.$val.'&mid='.$brow->id.'">'.ucfirst($val).'</a> ';
}
?></td></tr><?php 
}
mysqli_free_result ($bresult);
?></table><?php 
}

/*_______________-=TheSilenT.CoM=-_________________*/
}elseif ($action == 'topics') {

if (!empty($_GET['revivet'])) {
$revivet=clean_post($_GET['revivet']);

if($rrr=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE id=$revivet ORDER BY id desc LIMIT 1")){
if($rrrow=mysqli_fetch_object ($rrr)){
mysqli_free_result ($rrr);

if (!empty($_GET['all'])) {
if($ccr=mysqli_query($link, "SELECT * FROM $tbl_contents WHERE tid=$rrrow->id ORDER BY id desc")){
$reps=mysqli_num_rows($ccr);
mysqli_free_result ($ccr);
}else{$reps=0;}
	mysqli_query($link, "UPDATE $tbl_contents SET deleted=0 WHERE tid=$rrrow->id") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
	mysqli_query($link, "UPDATE $tbl_topics SET replies=$reps, deleted=0 WHERE id=$rrrow->id") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
	mysqli_query($link, "UPDATE $tbl_forums SET topics=topics+1,posts=posts+$reps WHERE id=$rrrow->fid LIMIT 1") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
} else {
	mysqli_query($link, "UPDATE $tbl_topics SET replies=0, deleted=0 WHERE id=$rrrow->id") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
	mysqli_query($link, "UPDATE $tbl_forums SET topics=topics+1 WHERE id=$rrrow->fid LIMIT 1") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
}

mysqli_query($link, "INSERT INTO $tbl_news ($fld_news) values ('','','$row->sex $row->charname revived topic id $rrrow->id".(!empty($_GET['all'])?' and all replies!':'!')."','$current_time')") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));

print("Topic $rrrow->id has been revived!");
} else {?>Cannot find topic must be revived already.<?php }}
}

if($tresult=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE (see<=$row->level and deleted>=1) ORDER BY id desc LIMIT $max_posts")){
?><table width=100%><tr><td valign=top><?php 
while ($trow=mysqli_fetch_object ($tresult)) {
print '<a href="?action=topics&revivet='.$trow->id.'">Revive topic '.$trow->id.'</a> <a href="?action=topics&revivet='.$trow->id.'&all=1"> + Replies</a> '.$trow->name.' '.$trow->csex.' '.$trow->ccharname.'<br> '.substr(clean_post($trow->body),0,255).(strlen($trow->body)>255?' . . . . .':'').' '.dater($trow->timer).' ago<hr size=1>';
}
mysqli_free_result ($tresult);

}

} elseif ($action == 'replies') {

if (!empty($_GET['revivec']) and !empty($_GET['tid'])) {
$revivec=clean_post($_GET['revivec']);
$tid=clean_post($_GET['tid']);
if($rrr=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE id=$tid and deleted=0 ORDER BY id desc LIMIT 1")){
if($crow=mysqli_fetch_object ($rrr)){
mysqli_free_result ($rrr);
	mysqli_query($link, "UPDATE $tbl_contents SET deleted=0 WHERE id=$revivec LIMIT 1") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
	mysqli_query($link, "UPDATE $tbl_topics SET replies=replies+1 WHERE id=$crow->id LIMIT 1") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
	mysqli_query($link, "UPDATE $tbl_forums SET posts=posts+1 WHERE id=$crow->fid LIMIT 1") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
mysqli_query($link, "INSERT INTO $tbl_news ($fld_news) values ('','','$row->sex $row->charname revived reply id $crow->id!','$current_time')") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));

print("Reply $revivec has been revived!");

} else { ?>Cannot revive a reply without the main topic being active.<?php }}
}

if($cresult=mysqli_query($link, "SELECT * FROM $tbl_contents WHERE (see<=$row->level and deleted>=1) ORDER BY id desc LIMIT $max_posts")){
?><table width=100%><tr><td valign=top><?php 
while ($trow=mysqli_fetch_object ($cresult)) {
print '<a href="?action=replies&revivec='.$trow->id.'&tid='.$trow->tid.'">Revive reply '.$trow->id.'</a> Topic id '.$trow->tid.' '.$trow->sex.' '.$trow->charname.' <br>'.substr(clean_post($trow->body),0,100).(strlen($trow->body)>100?' . . . . .':'').' '.dater($trow->timer).' ago<hr size=1>';
}
mysqli_free_result ($cresult);
?></td></tr></table><?php 
}


} elseif ($action == 'logs') {

if($lresult=mysqli_query($link, "SELECT * FROM $tbl_logs WHERE id ORDER BY id desc LIMIT $max_posts")){
?><table><tr><td>Post ID</td><td>Deleted by</td><td>Time past</td></tr><?php 
while ($lrow=mysqli_fetch_object ($lresult)) {
print '<tr><td>'.$lrow->deleted.'</td><td>'.$lrow->charname.'</td><td>'.dater($lrow->timer).'</td></tr>';
}
mysqli_free_result ($lresult);
?></table><?php 
}

} elseif ($action == 'news') {

if ($nresult = mysqli_query($link, "SELECT * FROM $tbl_news WHERE nid='' ORDER BY id DESC LIMIT 100")){
?><table><tr><td>Messages</td><td>Time past</td></tr><?php 
while ($nrow = mysqli_fetch_object($nresult)) {
print '<tr><td>'.stripslashes($nrow->news).'</td><td>'.dater($nrow->timer).'</td></tr>';
}
mysqli_free_result($nresult);
?></table><?php 
}

}elseif(in_array($action,$forum_ops)){

if($action == 'admin'){$levels=5;}elseif($action == 'cop'){$levels=3;}elseif($action == 'mod'){$levels=2;}elseif($action == 'support'){$levels=1;}else{$levels=1;}

if($aresult=mysqli_query($link, "SELECT * FROM $tbl_members WHERE (sex='".ucfirst($action)."' or level = '$levels') ORDER BY timer DESC LIMIT 100")){
?><table width=100%><tr><th>Member</th><th>IP</th><th>Active</th><th>Actions</th></tr><?php 
while ($frow=mysqli_fetch_object ($aresult)) {
if(($current_time-$frow->timer) >= 2678400){
mysqli_query($link, "UPDATE $tbl_members SET sex='Lord',level='0' WHERE id='$frow->id' LIMIT 1");
mysqli_query($link, "INSERT INTO $tbl_news ($fld_news) values ('','','$frow->sex $frow->charname was kicked from the high council for inactivity!','$current_time')");
}
print '<tr><td><a href="profile.php?member='.$frow->charname.'">'.$frow->sex.' '.$frow->charname.'</a></td><td><a href="?find='.$frow->ip.'&type=ip">'.$frow->ip.'</a></td><td>'.($frow->timer?dater($frow->timer):'no').'</td><td>';
foreach ($doings as $val) {
print '<a href="?do='.$val.'&mid='.$frow->id.'">'.ucfirst($val).'</a> ';
}
?></td></tr><?php 
}
mysqli_free_result ($aresult);
?></table><?php 
}

} elseif ($action == 'cleaner') {

if($aresult=mysqli_query($link, "SELECT * FROM $tbl_members WHERE timer<=$current_time-25920000 ORDER BY timer DESC LIMIT 100")){
?><table width=100%><tr><th>Member</th><th>IP</th><th>Active</th><th>Actions</th></tr><?php 
while ($frow=mysqli_fetch_object ($aresult)) {
if(($current_time-$frow->timer) >= 25920000){
mysqli_query($link, "DELETE FROM $tbl_members WHERE id='$frow->id' LIMIT 1");
mysqli_query($link, "INSERT INTO $tbl_news ($fld_news) values ('','','$frow->sex $frow->charname was deleted for inactivity!','$current_time')");
}
print '<tr><td><a href="profile.php?member='.$frow->charname.'">'.$frow->sex.' '.$frow->charname.'</a></td><td><a href="?find='.$frow->ip.'&type=ip">'.$frow->ip.'</a></td><td>'.($frow->timer?dater($frow->timer):'no').'</td><td>';
foreach ($doings as $val) {
print '<a href="?do='.$val.'&mid='.$frow->id.'">'.ucfirst($val).'</a> ';
}
?></td></tr><tr><th colspan=4>Deleted accounts!</th></tr><?php 
}
mysqli_free_result ($aresult);
?></table><?php 
}

}elseif($action == 'avatars'){

if($presult=mysqli_query($link, "SELECT id,charname,avatar FROM $tbl_members WHERE avatar!='' ORDER BY id desc LIMIT 1000")){
while($prow=mysqli_fetch_object ($presult)){

if($prow->avatar){
list($width, $height, $type, $attr) = getimagesize($prow->avatar);
if ($width <= 5 or $height <= 5 or $width >= 151 or $height >= 151){
mysqli_query($link, "UPDATE $tbl_members SET avatar='' WHERE id='$prow->id' LIMIT 1");
?>deleted <?php 
}else{?>oke <?php }
echo $prow->charname.' '.$prow->avatar.'<br>';
}
}mysqli_free_result ($presult);
}

}else{
?>Sorry no such command!<?php 
}
}else{print $txt_ban;}
require_once($html_footer);
?>