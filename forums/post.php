<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($html_header);
$str_posted='';
if (!empty($forum_sid) and !empty($row->ev) and empty($row->mute)) {

if (!empty($_POST['name'])) {$name=clean_post($_POST['name']);} else {$name='';}
if (!empty($_POST['message'])) {
$message=clean_post($_POST['message']);
$mstrlen=strlen($message);
if ($mstrlen > ($max_characters+$posting_level)) {
print '<b><p>Message too long!</p>Your post may not contain more than '.number_format($max_characters).' characters, your message has '.number_format($mstrlen).' characters. Please go back with your browser and try again.</b>';
$message='';
}
} else {$message='';}
if (!empty($_GET['fid'])) {$fid=clean_post($_GET['fid']);} else {$fid='';}
if (!empty($_GET['tid'])) {$tid=clean_post($_GET['tid']);} else {$tid='';}

if (!empty($fid) and !empty($message) and !empty($row) and $row->last <=$current_time-10) {

if($presult=mysqli_query($link, "SELECT * FROM $tbl_forums WHERE (id=$fid and see<=$row->level and level<=$row->level) ORDER BY id asc LIMIT 1")){
if($frow=mysqli_fetch_object ($presult)){
mysqli_free_result ($presult);

if(!empty($pc) and !preg_match('@(\[c=.*?\])@si',$message)){$message='[c='.$pc.']'.$message.'[/c]';}

if ($_POST['action'] == 'Create topic' and !empty($name)) {
$value="'','$fid',0,'$row->sex','$row->sex','$row->charname','$row->charname','$name','$message','0','0','$current_time','$current_time','$current_time','$frow->see','0','$ip'";

mysqli_query($link, "INSERT INTO $tbl_topics ($fld_topics) values ($value)") and $str_posted.=('Topic created.') or $str_posted.=('Error creating a topic '.mysqli_error($link)) ;
$update_it .=", posts=posts+1,last='$current_time'";
mysqli_query($link, "UPDATE $tbl_forums SET topics=topics+1,last=$current_time,sex='$row->sex',charname='$row->charname' WHERE id=$frow->id LIMIT 1");

} elseif ($_POST['action'] == 'Post reply' and !empty($tid)) {

if($tresult=mysqli_query($link, "SELECT * FROM $tbl_topics WHERE id=$tid ORDER BY id asc LIMIT 1")){
if($trow=mysqli_fetch_object ($tresult)){
mysqli_free_result ($tresult);
$value="'','$tid','$row->sex','$row->charname','$current_date','$message','$current_time','$frow->see','0','$ip'";

mysqli_query($link, "INSERT INTO $tbl_contents ($fld_contents) values ($value)") and $str_posted.=('Reply posted.') or $str_posted.=('Error creating a topic '.mysqli_error($link));
$update_it .=", posts=posts+1,last='$current_time'";
mysqli_query($link, "UPDATE $tbl_forums SET posts=posts+1,last=$current_time,sex='$row->sex',charname='$row->charname' WHERE id=$frow->id LIMIT 1");
mysqli_query($link, "UPDATE $tbl_topics SET replies=replies+1,last=$current_time,sex='$row->sex',charname='$row->charname' WHERE id=$tid LIMIT 1");
}
}

}

}else{$str_posted='You are not allowed to post here.';}
}

}print (!empty($str_posted)?$str_posted:'You may not post multiple posts in a short period of time.');print '<br><a href="'.$_SERVER['HTTP_REFERER'].'">Go back!</a>';

}
require_once($html_footer);
?>