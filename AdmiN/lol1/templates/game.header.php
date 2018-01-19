<?php 
#!/usr/local/bin/php

try {
if(empty($_SERVER['HTTP_REFERER'])){header("Location: $root_url");}
if(!empty($_GET['sid']) and empty($sid)){$sid=clean_post($_GET['sid']);}
if(!empty($_POST['sid']) and empty($sid)){$sid=clean_post($_POST['sid']);}
if(empty($sid)){header("Location: $root_url/login.php");exit;}

require_once($inc_mysql);
$link = mysqli_connect($db_host,$db_user,$db_password) or die();// or some_error($sid.'DB connection error'.mysqli_error($link));
mysqli_select_db($link,$db_main) or some_error(__FILE__.'db selection error'.mysqli_error($link));
if($result=mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE `sid`='$sid' and `timer`>=($current_time-600) LIMIT 1")){
if($row=mysqli_fetch_object($result)){
mysqli_free_result($result);

$fp=$row->fp-$current_time;
if($fp<0){$fp=0;}

$update_it="`timer`=$current_time";
}else{mysqli_close($link);header("Location: $root_url/login.php");exit;}}else{mysqli_close($link);header("Location: $root_url/login.php");exit;}


header("Expires: Mon,1 Jan 2001 01:01:01 GMT");
header("Last-modified: ".gmdate("D, d M Y H:i:s") ." GMT");
header("Cache-Control: no-store,no-cache,must-revalidate");
header("Cache-Control: post-check=0,pre-check=0",false);
header("Pragma: no-cache");

if(isset($_COOKIE['pc']) and !empty($_COOKIE['pc'])){$pc=clean_post($_COOKIE['pc']);}else{$pc='';}

if(isset($_COOKIE['bg']) and !empty($_COOKIE['bg'])){$col_bg=clean_post($_COOKIE['bg']);}
if(isset($_COOKIE['text']) and !empty($_COOKIE['text'])){$col_text=clean_post($_COOKIE['text']);}
if(isset($_COOKIE['alink']) and !empty($_COOKIE['alink'])){$col_link=clean_post($_COOKIE['alink']);}
if(isset($_COOKIE['th']) and !empty($_COOKIE['th'])){$col_th=clean_post($_COOKIE['th']);}
if(isset($_COOKIE['form']) and !empty($_COOKIE['form'])){$col_form=clean_post($_COOKIE['form']);}
if(isset($_COOKIE['family']) and !empty($_COOKIE['family'])){$font_family=clean_post($_COOKIE['family']);}
if(isset($_COOKIE['fsize']) and !empty($_COOKIE['fsize'])){$font_size=clean_post($_COOKIE['fsize']);}
?><html><head>
<title><?php print $title;?> MMORPG</title>
<?php include_once($html_style);?></head>
<body bgcolor="<?php print $col_bg;?>" text="<?php print $col_text;?>" link="<?php print $col_link;?>" vlink="<?php print $col_link;?>" alink="<?php print $col_link;?>"><center>

<?php 
if($row->jail>=$current_time or empty($row->charname)){
?><hr><b>You have been jailed for violating our rules, jail time <?php print dater($row->jail);?>!<br>
The game will automatically proceed when your Jail time is done.<br>
Please go to the <a href="/forums/">forums</a> for help if you need help!<br>
<meta http-equiv="refresh" content="<?php print ($row->jail-$current_time)+5;?>"></b><hr><?php 

if($row->jail-$current_time > 50){
?><script>alert("You have been jailed for violating our rules, jail time <?php print number_format($row->jail-$current_time);?> seconds! \n\n Please go to the forums for help!. \n\n Violation of the rules may get your account deleted. \n\n Possible mass clicking detected. \n\n If this doesn't apply for your chars, where are very sorry for what has happend to you. \n\n Just click away this screen and relogin to play.\n\n\n\n\n\n\n\n\n\n")</script><?php 
}

include_once($game_footer);exit;
}


//2-29-2008 07:59:27 topbar
if (!empty($_GET['topbar_a'])) {
setcookie("topbar", "1", $current_time+5000000);
$_COOKIE['topbar']=1;
}elseif (!empty($_GET['topbar_b'])) {
setcookie("topbar", "", $current_time-5000000);
$_COOKIE['topbar']='';
}

if (!empty($_COOKIE['topbar'])) {

$next_level = ((($row->level/10)*500)+$row->level)*($row->level*$row->level)+449;
$prlevel=$row->level-1;
$prev_level = ((($prlevel/10)*500)+$prlevel)*($prlevel*$prlevel)+449;
$xp_required=($next_level-$prev_level);
$xp_having=($next_level-$row->xp);
$p_exp = number_format(($xp_required/$xp_having)*100,3);
if ($p_exp <= 0) {$p_exp=0;}
?>
<table cellpadding="1" cellspacing="1" border="0" width="100%"><tr><th><a href="?sid=<?php print $sid;?>&topbar_b=1">Level <?php print lint($row->level);?></a></th><th><?php print ($p_exp<100)?'Level up '.$p_exp.'% XP':'Level up!';?></th><th>$<?php print lint($row->gold);?></th><?php if($fp>1){?><th><?php print lint($fp);?> FP</th><?php }?></tr></table>
<?php 
}else{
?>
<table cellpadding="1" cellspacing="1" border="0" width="100%"><tr><th><a href="?sid=<?php print $sid;?>&topbar_a=1">Level <?php print lint($row->level);?></a></th><th>Life <?php print lint($row->life);?></th><th><?php print lint($row->xp);?> XP</th><th>$<?php print lint($row->gold);?></th><?php if($fp>1){?><th><?php print lint($fp);?> FP</th><?php }?></tr></table>
<?php 
}
?>

<?php 
if($fp<=0 and $row->level>=3){
?><table cellpadding="1" cellspacing="1" border="0" width="100%"><tr><td align="center">
<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/AdmiN/www.adsense.php';
?>
<br><font size="1"><a href="support.php?sid=<?php print $sid;?>">Don't show up the banners and help the development of <?php print $title;?>.</a></font></td></tr></table><?php 
}


if($row->str <= 0){$row->str=1;}
if($row->dex <= 0){$row->dex=1;}
if($row->agi <= 0){$row->agi=1;}
if($row->intel <= 0){$row->intel=1;}
if($row->conc <= 0){$row->conc=1;}
if($row->cont <= 0){$row->cont=1;}


}
catch (Exception $e) {
print("<p>File is being update, worked on or server error! Please try later.</p>");
}
?>