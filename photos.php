<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_ffunctions);
require_once($html_header);

?><table width=100%><tr><th colspan=2>Player and photos and bioS</th></tr><?php 
$link = mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

//mysqli_query($link, "DELETE FROM $tbl_bio WHERE id=123 LIMIT 1");

if(!empty($_GET['gid'])) {
$gid=clean_post($_GET['gid']);$whereid="`id`='$gid'";
}else{$whereid="`id`";$gid=0;}

if($gresult = mysqli_query($link, "SELECT * FROM `$tbl_bio` WHERE $whereid AND `oke` ORDER BY `id` DESC LIMIT 1")){

if($grow = mysqli_fetch_object ($gresult)) {mysqli_free_result ($gresult);
?><tr><td valign="top" width="*"><img src="https://lordsoflords.com/photos/<?php print $grow->id;?>.jpg" border="0" alt="Game Player"><br><?php 
$grow->info=stripslashes($grow->info);
$grow->info=preg_replace("/\n/","<br>",$grow->info);
print postit($grow->info);
}
}

if($bresult = mysqli_query($link, "SELECT * FROM `$tbl_bio` WHERE `id` AND `oke` ORDER BY `id` DESC LIMIT 100")){
?></tr><tr><th><a href="/uploader.php">Add yours herE</a></th><tr><td><?php 
while ($brow = mysqli_fetch_object ($bresult)) {
?><a href="?gid=<?php print $brow->id?>"><img src="https://lordsoflords.com/photos/<?php print $brow->id;?>.jpg" height=75 width=75 border="0" title="Click on thumbnail for actual photo size and bio."></a> <?php 
}
mysqli_free_result ($bresult);
?></td></tr><?php 
}

?></table><?php 

mysqli_close ($link);
require_once($html_footer);
?>