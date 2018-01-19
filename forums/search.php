<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);

 $words='';
if (!empty($_GET['words'])) {$words=clean_post($_GET['words']);}
if (!empty($_POST['words'])) {$words=clean_post($_POST['words']);}

?><hr><table width=100%><tr><td><form method=post action="/forums/search.php"><input type=text name="words"> <input type=submit name=saction value="Forum Search"></form></td></tr></table><hr><?php 

if (!empty($words)) {
?><table width=100%><?php 

//PAGED
$paging='';
	$rowsPerPage = 25;
	$pageNum = 1;
	if(isset($_GET['page'])) {
		$pageNum = $_GET['page'];
	}
	$offset = ($pageNum - 1) * $rowsPerPage;

$query="SELECT * FROM $tbl_topics WHERE (id and see<=$row->level and deleted=0 and `name` LIKE CONVERT (_utf8 '%$words%' USING latin1) COLLATE latin1_swedish_ci and `body` LIKE CONVERT (_utf8 '%$words%' USING latin1) COLLATE latin1_swedish_ci ) ORDER BY id desc LIMIT $offset, $rowsPerPage";


// how many rows we have in database
$squery = "SELECT COUNT(`id`) AS numrows FROM `$tbl_topics` WHERE (id and see<=$row->level and deleted=0 and `name` LIKE CONVERT (_utf8 '%$words%' USING latin1) COLLATE latin1_swedish_ci and `body` LIKE CONVERT (_utf8 '%$words%' USING latin1) COLLATE latin1_swedish_ci ) ORDER BY id desc LIMIT 1000";
if ($sresult = mysqli_query($link, "link, $squery)) {
	if ($srow = mysqli_fetch_array($sresult, MYSQLI_ASSOC)) {
		$numrows = $srow['numrows'];

// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$self = '?words='.$words;
$nav = '';

for($page = 1; $page <= $maxPage; $page++) {
 if ($page == $pageNum) {
  $nav .= " $page "; // no need to create a link to current page
 } else {
  $nav .= " <a href=\"$self&page=$page\">$page</a> ";
 } 

}

if ($pageNum > 1){
 $page = $pageNum - 1;
 $prev = " <a href=\"$self&page=$page\">&lt;</a> ";

 $first = " <a href=\"$self&page=1\">&lt;&lt;</a> ";
} else{
 $prev = '&nbsp;'; // we're on page one, don't print previous link
 $first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage){
 $page = $pageNum + 1;
 $next = " <a href=\"$self&page=$page\">&gt;</a> ";

 $last = " <a href=\"$self&page=$maxPage\">&gt;&gt;</a> ";
} else{
 $next = '&nbsp;'; // we're on the last page, don't print next link
 $last = '&nbsp;'; // nor the last page link
}

// print the navigation link
$paging = '<p>'.$first . $prev . $nav . $next . $last.'</p>';
	}
}
print '<tr><th colspan=2>'.$paging.'</th></tr>';
//PAGED

if ($result=mysqli_query($link, $query)) {
	if (mysqli_num_rows($result) >=1 ) {
$i=0;while ($srow=mysqli_fetch_object ($result)) {
$srow->body=strip_tags($srow->body);
	//if (strpos($srow->name,$words) or strpos($srow->charname,$words) or strpos($srow->body,$words)) {
	$i++;
$srow->body=preg_replace ("/$words/i", "<u><b>$words</b></u>", $srow->body);

if (empty($bgcolor)) {$bgcolor=' bgcolor="'.$col_th.'"';} else {$bgcolor="";}

print '<tr'.$bgcolor.'><td valign=top NOWRAP><a href="profile.php?member='.$srow->charname.'">'.$srow->sex.' '.$srow->charname.'</a> <br>'.dater($srow->timer).' ago';
	if ($row->charname==$srow->ccharname or $row->level >=4) {
		print '<br>[<a href="edit.php?teid='.$srow->id.'&fid='.$srow->fid.'">edit</a> <a href="edit.php?tdid='.$srow->id.'&fid='.$srow->fid.'&action='.$srow->fid.'">delete</a>]<br><font size=1>'.$srow->ip.'</font>';
		}
print '</td><td valign=top><a href="topic.php?topic.php?fid='.$srow->fid.'&tid='.$srow->id.'">'.$srow->name.'</a><br><br>'.substr($srow->body,0,550).' . . .</td></tr>';

}
}
mysqli_free_result ($result);
}
print '<tr><th colspan=2>'.$paging.'</th></tr>';
?></table><?php 
}

require_once($html_footer);
?>