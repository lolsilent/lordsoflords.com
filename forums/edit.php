<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);

if (isset($_GET)) {
	foreach($_GET as $key=> $val){
		$$key = clean_post($val);
	}
}

if (isset($_POST)) {
	foreach($_POST as $key=> $val){
		$$key = clean_post($val);
	}
}

if($kind == 'topic'){
$edit_table=$tbl_topics;
}elseif($kind == 'reply'){
$edit_table=$tbl_contents;
}

if (!empty($action) and !empty($kind) and !empty($did) and !empty($fid) and !empty($edit_table)) {
if($eresult=mysqli_query($link, "SELECT * FROM $edit_table WHERE (id=$did and see<=$row->level and deleted <= 0) ORDER BY id desc LIMIT 1")){
if($edrow=mysqli_fetch_object ($eresult)){
mysqli_free_result ($eresult);

if($fresult=mysqli_query($link, "SELECT * FROM $tbl_forums WHERE (id='$fid' and see<=$row->level) LIMIT 1")){
if($frow=mysqli_fetch_object ($fresult)) {
print '<table width=100%><tr><th align=left><img src="/images/emotions/star.gif" border=0><a href="/forums/forums.php">Forums</a><img src="/images/emotions/star.gif" border=0><a href="forum.php?fid='.$frow->id.'">'.$frow->name.'</a><img src="/images/emotions/star.gif" border=0><a href="/forums/topic.php?fid='.$frow->id.'&tid='.(!empty($edrow->name)?$edrow->id:$edrow->tid).'">Go back to the topic</a><img src="/images/emotions/star.gif" border=0></th></tr></table>';
}
}

if(!empty($edrow->name)){print '<p><a href="?action=edit&kind='.$kind.'&did='.$did.'&fid='.$fid.'">Edit</a> | <a href="?action=delete&kind='.$kind.'&did='.$did.'&fid='.$fid.'">Delete</a> | <a href="?action=sticky&kind=topic&did='.$did.'&stick=1&fid='.$fid.'">Make Sticky</a> | <a href="?action=sticky&kind=topic&did='.$did.'&unstick=1&fid='.$fid.'">Remove Sticky</a></p>';}

if ($edrow->charname == $row->charname or $row->level >=4) {

if (!empty($_GET['stick']) and $row->level >=4) {
mysqli_query($link, "UPDATE $tbl_topics SET sticky=sticky+1 WHERE id=$did LIMIT 1");
print 'Made the topic to be sticky.';
} elseif (!empty($_GET['unstick']) and $row->level >=4) {
mysqli_query($link, "UPDATE $tbl_topics SET sticky=0 WHERE id=$did LIMIT 1");
print 'Removed sticky from topic.';
}

if($action == 'edit'){
$update_string='';

if (!empty($_POST['body'])) {
$body=preg_replace('@<p align=right><font size=-2>(.*?)</font></p>@si','',$_POST['body']);
$body=clean_post($body);
if ($edrow->body !==$body) {
	$body.="\n\n<p align=right><font size=-2>Edited on $current_date $current_clock by $row->sex $row->charname</font></p>";
	$update_string .="`body`='$body'";
	$body=stripslashes($body);$body=stripslashes($body);
	}
}else{$body=stripslashes($edrow->body);}

if(!empty($edrow->name)){
if (!empty($_POST['name'])) {
$name=clean_post($_POST['name']);
if ($edrow->name !==$name) {
	if(empty($update_string)){
		$update_string .="`name`='$name'";
	}else{
			$update_string .=", `name`='$name'";
	}
	$name=stripslashes($name);
	}
}else{$name=stripslashes($edrow->name);}
}

?><form method=post name=message_form action="<?php print '?action='.$action.'&kind='.$kind.'&did='.$did.'&fid='.$fid;?>">
<table width=100%>
<tr><th colspan=2>Post editing</th></tr>
<?php print !empty($edrow->name)?'<tr><td valign=top nowrap>Topic name</td><td><input name=name value="'.$name.'" size=90></td></tr>':'';?>
<tr><td valign=top>Message<br><br>
Characters left<br><input disabled readonly type="text" name="counter" size="5" maxlength="5" value="<?php print ($max_characters-strlen($body));?>">

</td><td><textarea name=body cols=75 rows=15 onKeyDown="count(document.message_form.body,document.message_form.counter,<?php print $max_characters;?>')"
onKeyUp="count(document.message_form.body,document.message_form.counter,<?php print $max_characters;?>)"><?php print $body;?></textarea></td></tr>
<tr><th colspan=2><input type=submit name=action value="edit"></th></tr>
</table>
</form>
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
if (!empty($update_string)) {
mysqli_query($link, "UPDATE $edit_table SET $update_string WHERE `id`='$edrow->id' LIMIT 1") or print("Error ".mysqli_error($link)) and print("Post changed.");
}
}else{$body=stripslashes($edrow->body);}
?>
<table width=100% border=1><tr><td><table cellpadding=2 cellspacing=2 border=1 width=100% bordercolor=<?php print $col_th;?>><tr><td valign=top>Posted message</td><td><?php print postit($body); ?></td></tr></table></td></tr></table>
<?php 
if($action == 'delete' and $kind == 'topic' and $edrow->deleted == 0){

mysqli_query($link, "UPDATE $tbl_topics SET deleted=1 WHERE id=$edrow->id LIMIT 1");
mysqli_query($link, "UPDATE $tbl_contents SET deleted=1 WHERE tid=$edrow->id");
mysqli_query($link, "UPDATE $tbl_forums SET topics=topics-1,posts=posts-$edrow->replies WHERE id=$edrow->fid LIMIT 1");
mysqli_query($link, "INSERT INTO $tbl_logs values ('', '$row->charname', '$did', '$current_time')");
?>Topic erased.<?php 

}elseif($action == 'delete' and $kind == 'reply' and $edrow->deleted == 0){

mysqli_query($link, "UPDATE $tbl_contents SET deleted=1 WHERE id=$edrow->id LIMIT 1");
mysqli_query($link, "UPDATE $tbl_topics SET replies=replies-1 WHERE id=$edrow->tid LIMIT 1");
mysqli_query($link, "UPDATE $tbl_forums SET posts=posts-1 WHERE id=$fid LIMIT 1");
mysqli_query($link, "INSERT INTO $tbl_logs ($fld_logs) values ('', '$row->charname', '$did', '$current_time')");
?>Post deleted.<?php 
print '<br><a href="'.$_SERVER['HTTP_REFERER'].'">Go back!</a>';

}elseif($action == 'delete' and $edrow->deleted == 1){?>Already deleted!<?php }



}else{?>Nothing to edit here. You have no permissions to access this area.<?php }
}else{?>Nothing to edit here.. The topic has been deleted in the meanwhile.<?php }
}else{?>Nothing to edit here... The topic has been deleted in the meanwhile.<?php }
}else{?>Nothing to edit here....<?php }

require_once($html_footer);
?>