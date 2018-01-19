<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);

if (empty($row->mute)){

if($row->ev >= 1 and empty($_GET['fbid']) and !empty($row->id) and !empty($row->sex) and !empty($row->charname)){?>
<hr>
<table width=100% border=1 bordercolor=<?php print $col_th;?>>
<?php if(!empty($_GET['ap'])){
	$ap = clean_post($_GET['ap']);
if(!empty($_FILES['userfile'])){
if($_FILES['userfile']['error'] == 0){

$comments = clean_post($_POST['comments']);

mysqli_query($link, "INSERT INTO `$tbl_blog_pic` ($fld_blog_pic) values ('','$comments','$ap')") or die(mysqli_error($link));

if($ftr= mysqli_query($link, "SELECT `id` FROM `$tbl_blog_pic` WHERE `blid`='$ap' ORDER BY `id` DESC LIMIT 10")){
if(mysqli_num_rows($ftr) <= 5){
if($ftrow = mysqli_fetch_object ($ftr)) {

$uploaddir = '/home/lordsoflords/public_html/photos/blog';
$uploadfile = $uploaddir.$ftrow->id.'.jpg';

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

list($width, $height, $type, $attr) = getimagesize($uploadfile);
if($type == 2){
print '<br>Picture width '.$width.', height '.$height.', type '.$image_types[$type].'<br>';
?>File is valid, and was successfully uploaded.<?php 
}else{

mysqli_query($link, "DELETE FROM `$tbl_blog_pic` WHERE `id`='$frow->id' LIMIT 1");
$filer = '/home/lordsoflords/public_html/photos/blog'.$frow->id.'.jpg';
if (file_exists($filer)) {
unlink($filer);
print 'Old pic deleted.';
}

?>Wrong file type.<?php }

}else{?>Please try again server busy.<?php }

}else{?>Technical problems please try again.<?php }
}else{?>Keep it max of 5 pics per Blog please.<?php }
mysqli_free_result ($ftr);
}else{?>Something went wrong.<?php }


}else{?>No or unknown file, please send only JPG file with a max of 100 kb.<?php }
}else{?>
<form enctype="multipart/form-data" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000">
<tr><th valign="top" nowrap>Add a picture</th></tr>
<tr><td align=center><input type="file" name="userfile"><br><font size=-2>Max 100 kb, and 5 pics per Blog.</font></td></tr>
<tr><td align=center valign=top>Comments:<br><textarea name="comments" cols=50 rows=10></textarea></td></tr>
<tr><th align="center"><input type="submit"></th></tr>

<?php }
}else{?>
<form method="POST">
<tr><th valign="top" nowrap><?php print !empty($_GET['coms'])?'Add Comments':'My Blog';?></th></tr>
<tr><td align=center><textarea name="<?php print !empty($_GET['coms'])?'coms':'blog';?>" cols=50 rows=10></textarea></td></tr>
<tr><th align="center"><input type="submit"></th></tr>
<?php }?>
</form>
</table>
<?php 
if(!empty($_POST['blog'])){
$blog=clean_post($_POST['blog']);
mysqli_query($link, "INSERT INTO $tbl_blog ($fld_blog) values ('','$row->id','$row->sex $row->charname $current_date','$blog','$current_time')");
}

}else{?><table width=100%><tr><th>You are not allowed to post here.</th></tr></table><?php }

if (empty($row->id)){
$whereis= "`id`";
}else{
	if (!empty($_GET['coms'])){
	$coms = clean_post($_GET['coms']);
	$whereis= "`id`='$coms'";
	}elseif (!empty($_GET['ap'])){
	$ap = clean_post($_GET['ap']);
	$whereis= "`id`='$ap'";
	}else{
	$whereis= "`mid`='$row->id'";
	}
}

if (!empty($_GET['fbid'])){
$fbid = clean_post($_GET['fbid']);
$whereis= "`mid`='$fbid'";
}

if (!empty($_GET['fbdid'])){
$fbdid = clean_post($_GET['fbdid']);
}
if (!empty($_GET['fbcdid'])){
$fbcdid = clean_post($_GET['fbcdid']);
}

if ($bresult = mysqli_query($link, "SELECT * FROM `$tbl_blog` WHERE $whereis ORDER BY `id` DESC LIMIT 100")){
while ($brow = mysqli_fetch_object($bresult)) {

print '<p align=right><a href="blog.php?fbid='.$brow->mid.'" title="More Blog from this member.">'.$brow->date.'</a> <font size=-1>('.dater($brow->timer).' ago)</font></p>'.postit($brow->blog);

if($iftr= mysqli_query($link, "SELECT * FROM `$tbl_blog_pic` WHERE `blid`='$brow->id' ORDER BY `id` DESC LIMIT 5")){
if(mysqli_num_rows($iftr) >= 1){
while($iftrow = mysqli_fetch_object ($iftr)) {
$ifiler = '/home/lordsoflords/public_html/photos/blog'.$iftrow->id.'.jpg';
	if (file_exists($ifiler) and getimagesize($ifiler)) {
	print empty($iftrow->comments)?'':'<br><b><font color="#FF0000">'.$iftrow->comments.'</font></b><br>';
	print ' <img src="/photos/blog'.$iftrow->id.'.jpg">';
	}else{
	mysqli_query($link, "DELETE FROM `$tbl_blog_pic` WHERE `id`=$iftrow->id LIMIT 1");
	}
if($row->id == $brow->mid){
	if (isset($fbdid) && $fbdid == $brow->id) {
	unlink($ifiler);
	mysqli_query($link, "DELETE FROM `$tbl_blog_pic` WHERE `id`=$iftrow->id LIMIT 1");
	}
}

}
mysqli_free_result ($iftr);
}
}

if($row->id == $brow->mid){
	if (isset($fbdid) && $fbdid == $brow->id) {
mysqli_query($link, "DELETE FROM `$tbl_blog` WHERE `id`='$brow->id' LIMIT 1");
mysqli_query($link, "DELETE FROM `$tbl_blog_comments` WHERE `blid`='$brow->id' LIMIT 1000");

		print '<br><b>Deleted</b> ';
	} else {
print '<br><a href="blog.php?fbdid='.$brow->id.'">Delete</a> | <a href="blog.php?ap='.$brow->id.'">Add Pic</a> | ';}
	}else{
	print '<br>';
	}

if (!empty($forum_sid) and !empty($row->ev) and empty($row->mute)) {
print '<a href="blog.php?coms='.$brow->id.'">Add Comments</a>';
}

//ADMIN BLOG DELETE
if ($row->level >=4) {

if (!empty($_GET['admin_delete_b'])){
$admin_delete_b = clean_post($_GET['admin_delete_b']);
if($admin_delete_b == $brow->id){
mysqli_query($link, "DELETE FROM `$tbl_blog` WHERE `id`='$brow->id' LIMIT 1");
mysqli_query($link, "DELETE FROM `$tbl_blog_comments` WHERE `blid`='$brow->id' LIMIT 1000");
}$admin_delete_b='';
?> Deleted!<?php 
}else{
	print ' | <a href="blog.php?fbid='.(isset($fibid)?$fbid:'').'&admin_delete_b='.$brow->id.'">Admin Delete</a>';
}

}
//ADMIN BLOG DELETE

//comments delete show
if(!empty($_POST['coms']) and empty($row->mute)){
$coms=clean_post($_POST['coms']);
mysqli_query($link, "INSERT INTO $tbl_blog_comments ($fld_blog_comments) values ('','$brow->id','<font color=red>$coms</font><br><font size=-2>$row->sex $row->charname $current_date</font>','$current_time')");
}

if ($bcresult = mysqli_query($link, "SELECT * FROM `$tbl_blog_comments` WHERE `blid`='$brow->id' ORDER BY `id` ASC LIMIT 50")){
	print '<hr><ol>';
while ($bcrow = mysqli_fetch_object($bcresult)) {
print '<li>'.postit($bcrow->comments).' <font size=-2>('.dater($bcrow->timer).' ago)';
if($row->id == $brow->mid){
	if (isset($fbcdid) && $fbcdid == $bcrow->id) {
mysqli_query($link, "DELETE FROM `$tbl_blog_comments` WHERE `id`='$bcrow->id' LIMIT 1");
		print ' Deleted.';
	} else {
print ', <a href="blog.php?fbcdid='.$bcrow->id.'">Delete comment</a>.';}
	}
print '</font></li>';
//ADMIN BLOG COMMENTS DELETE
if ($row->level >=4) {


if (!empty($_GET['admin_delete_bc'])){
$admin_delete_bc = clean_post($_GET['admin_delete_bc']);
if($admin_delete_bc == $bcrow->id){
mysqli_query($link, "DELETE FROM `$tbl_blog_comments` WHERE `id`='$bcrow->id' LIMIT 1000");
}$admin_delete_bc='';
?> Deleted!<?php 
}else{
	print ' <a href="blog.php?fbid='.(isset($fbid)?$fbid:'').'&admin_delete_bc='.$bcrow->id.'">Admin Delete</a>';
}

}
//ADMIN BLOG COMMENTS DELETE
}
mysqli_free_result($bcresult);
	print '</ol>';
}
//comments delete show

}
mysqli_free_result($bresult);
}

}else{?>You may not access this part of the forum with this account!<?php }


require_once($html_footer);
?>