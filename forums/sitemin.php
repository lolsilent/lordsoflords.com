<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_functions);
require	'AdMiN/www.mysql.php';
require_once($html_header);
if ($row->level >=4 and $row->mute <= 0) {
$did='';
?><p><a href="?">News Submitter</a> | <a href="?action=photos">Photo validator</a><?php print ($row->id == 1)?' | <a href="?action=calcite">Calcite</a>':'';?></p>Please always talk with other Admins before you do something here!<br><?php 

if(!empty($_GET['action'])){$action=clean_post($_GET['action']);}
if(empty($action)){

?>Nobody is allowed to submit thing here or get your account banned.
<form method="POST">
<table width=100% border=1 bordercolor=<?php print $col_th;?>>
<tr><th valign="top" nowrap>Site News!</th></tr>
<tr><td><textarea name="news" cols=75 rows=15></textarea></td></tr>
<tr><th align="center"><input type="submit"></th></tr>
</table>
</form>
<?php 
if(!empty($_POST['news'])){
$news=clean_post($_POST['news']);
if(!empty($news) and $row->id == 1){
require '../AdmiN/www.mysql.php';
mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);
mysqli_query($link, "INSERT INTO $tbl_news ($fld_news) values ('','','$row->sex $row->charname $current_date','$news','$current_time')");
print $news.' has been send.';
$did='posted news on the main site.';
}else{?>You have been jailed for five days! (Just kidding!)<?php }}

} elseif ($action == 'photos') {

?>Please only allow real photos with right descriptions thank you.<?php 
require '../AdmiN/www.mysql.php';
mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);
if($bresult = mysqli_query($link, "SELECT * FROM $tbl_bio WHERE (id and oke<=0) ORDER BY id desc LIMIT 10")){
while ($frow = mysqli_fetch_object ($bresult)) {
?><table width=100% border=1 bordercolor=<?php print $col_th;?>><tr><td valign=top><img src="/photos/<?php print $frow->id;?>.jpg" title="Photo id : <?php print $frow->id;?>" border=0><br><a href="?action=photos&delete=<?php print $frow->id;?>">delete</a> <a href="?action=photos&aprove=<?php print $frow->id;?>">aprove</a></td><td valign="top"><?php print preg_replace("/\n/","<br>",$frow->info);?></td></tr></table><?php 

if(!empty($_GET['delete'])){if ($_GET['delete'] == $frow->id){
mysqli_query($link, "DELETE FROM $tbl_bio WHERE id=$frow->id LIMIT 1");
$filer = '/home/lordsolords/public_html/photos/'.$frow->id.'.jpg';
if (file_exists($filer)) {
unlink($filer);
}
$did='disapproved photo number '.$frow->id;break;
}}
if (!empty($_GET['aprove'])){if ($_GET['aprove'] == $frow->id){
mysqli_query($link, "UPDATE $tbl_bio SET oke=1 WHERE id=$frow->id LIMIT 1");
$did='approved photo number '.$frow->id;break;
}}

} //end while
mysqli_free_result ($bresult);

}else{?>No photos.<?php }

}elseif($action == 'calcite' and $row->id == 1){

set_time_limit(100);
if($fresult=mysqli_query($link, "SELECT * FROM $tbl_forums WHERE (category<=0) ORDER BY topics ASC LIMIT 100")){
	while ($frow=mysqli_fetch_object ($fresult)) {
	$ftot_top=0;$ftot_pos=0;
		if($tresult=mysqli_query($link, "SELECT id,fid FROM $tbl_topics WHERE (fid=$frow->id and deleted=0) ORDER BY id ASC")){
			$ftot_top+=mysqli_num_rows($tresult);
			while ($trow=mysqli_fetch_object ($tresult)) {
if($cresult=mysqli_query($link, "SELECT id FROM $tbl_contents WHERE (tid=$trow->id and deleted=0)")){
$ftot_pos+=mysqli_num_rows($cresult);
mysqli_free_result ($cresult);
				}
			}
		mysqli_free_result ($tresult);
		}
	$upit='';
	if($frow->topics <> $ftot_top){
		$upit .= "topics=$ftot_top";
	}
	if($frow->posts <> $ftot_pos){
		$upit .= (!empty($upit)?', ':'')."posts=$ftot_pos";
	}
if(!empty($upit)){
mysqli_query($link, "UPDATE $tbl_forums SET $upit WHERE id=$frow->id LIMIT 1") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
print $frow->name.' - '.$frow->topics.' '.$frow->posts.' - '.$ftot_top.' '.$ftot_pos.' - '.$upit.'<br>';
}
	}
mysqli_free_result ($fresult);
}

} else {
?>Sorry no such command!<?php 
}

require	'AdMiN/www.mysql.php';
mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);
if(!empty($did)){
mysqli_query($link, "INSERT INTO $tbl_news ($fld_news) values ('','','$row->sex $row->charname $did','$current_time')") or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__.mysqli_error($link));
print ucfirst($did);
}

}else{print $txt_ban;}
require_once($html_footer);
?>