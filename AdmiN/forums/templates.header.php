<?php 
#!/usr/local/bin/php

if(isset($_COOKIE['forum_sid']) and !empty($_COOKIE['forum_sid'])){$forum_sid=clean_post($_COOKIE['forum_sid']);}else{$forum_sid='';}
if(isset($_COOKIE['pc']) and !empty($_COOKIE['pc'])){$pc=clean_post($_COOKIE['pc']);}else{$pc='';}

if(isset($_COOKIE['bg']) and !empty($_COOKIE['bg'])){$col_bg=clean_post($_COOKIE['bg']);}
if(isset($_COOKIE['text']) and !empty($_COOKIE['text'])){$col_text=clean_post($_COOKIE['text']);}
if(isset($_COOKIE['alink']) and !empty($_COOKIE['alink'])){$col_link=clean_post($_COOKIE['alink']);}
if(isset($_COOKIE['th']) and !empty($_COOKIE['th'])){$col_th=clean_post($_COOKIE['th']);}
if(isset($_COOKIE['form']) and !empty($_COOKIE['form'])){$col_form=clean_post($_COOKIE['form']);}
if(isset($_COOKIE['family']) and !empty($_COOKIE['family'])){$font_family=clean_post($_COOKIE['family']);}
if(isset($_COOKIE['fsize']) and !empty($_COOKIE['fsize'])){$font_size=clean_post($_COOKIE['fsize']);}

$xxt=1;
$zzt=1;

?><html><head><title>LORDS of LORDS forums</title>
<meta NAME="Description" CONTENT="Lords of Lords is a free online text-based massive role playing game (RPG) that can be played anywhere on whatever computer or system that has a browser and web access. Only nice people are welcome no bad peoples!">
<meta NAME="keywords" CONTENT="free, online, text, based, massive, role, playing, game, MMORPG, MPORPG, gaming, lords of lords, rpg, browser">
<link rel="stylesheet" type="text/css" href="/script.php?css">
<link rel="shortcut icon" path="https://lordsoflords.com/favicon.ico">
</head><body><a name="#top"></a>

<?php 
if (!empty($_COOKIE['forumlogo'])) {
?>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr>
	<td width=609>

<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td colspan=2><a href="/index.php" title="Return to homepage of Lords of Lords"><img src="/images/2008r1.jpg" border="0" alt="Return to homepage of Lords of Lords"></a></td></tr>
<tr><td width=141><img src="/images/2008r2forums.jpg" border="0" alt="text based RPG games"></td><td width=468 background="/images/2008r3.jpg"><img src="/images/2008r3.jpg" border="0" alt="text based RPG games"></td></tr>
<tr><td colspan=2><img src="/images/2008r4.jpg" border="0" alt="text based RPG games"></td></tr>
</table>
		
		</td>
	<td background="/images/2008b.jpg"><img src="/images/2008b.jpg" border="0" alt="text based RPG games"></td>
	<td width=113><img src="/images/2008l.jpg" border="0" alt="text based RPG games"></td>
</tr>
</table>
<?php 
}
?>

<table width=100% cellpadding=2 cellspacing=2 border=0>
<tr><td valign=top>
<?php $link=mysqli_connect($db_host,$db_user,$db_password) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);mysqli_select_db($link,$db_main) or some_error(__FILE__.'-'.__LINE__.'-'.__FUNCTION__.'-'.__CLASS__.'-'.__METHOD__);

if(!empty($forum_sid) and empty($_POST['username']) and empty($_POST['password'])){
$query="SELECT * FROM `$tbl_members` WHERE `sid`='$forum_sid' ORDER BY `id` DESC LIMIT 1";
}elseif (!empty($_POST['username']) and !empty($_POST['password'])){
$username=$_POST['username'];$password=crypt($_POST['password'],$username);
$query="SELECT * FROM `$tbl_members` WHERE `username`='$username' and `password`='$password' ORDER BY `id` DESC LIMIT 1";
mysqli_query($link, "UPDATE `$tbl_members` SET `session`='$current_time' WHERE `username`='$username' and `password`='$password' LIMIT 1");
}


if(!empty($query)) {
if($result=mysqli_query($link, $query)){
if($row=mysqli_fetch_object($result)){
setcookie("forum_sid", "$row->sid", $current_time+(84600*30));
$forum_sid=$row->sid;
mysqli_free_result ($result);
$update_it="timer='$current_time'";
print '<table width=100%><tr><form method=post action="/forums/search.php"><th align=left>Hi '.$row->sex.' '.$row->charname;
print (!$row->ev)?', please confirm your email address to enable posting':', <a href="/forums/settings.php">settings</a>, <a href="/forums/blog.php">blog</a>';
print ($row->level >=4)?', <a href="/forums/admins.php">forum control</a>, <a href="/forums/sitemin.php">site control</a>':'';
print (!empty($pc))?', <font color="'.$pc.'">personal color</font>':'';
?>. </th><th align=right><input type=text name="words"> <input type=submit name=saction value="Search"></th></form></tr></table><?php 
}
}
}

if(!isset($row) && empty($row)) {
$row = new stdClass;	
$forum_sid='';$row->level=0;$row->id=0;$row->charname='';$row->ev='';$row->mute=1;
?><table width=100%><tr><form method=post><th align=left valign=top>Welcome to the Lords of Lords forums.</th><th>Username <input type=text name=username size=8 maxlength=15> Password <input size=8 type=password name=password maxlength=15> <input type=submit name=action value="Login"></th></form></tr></table>
<?php }?><table width=100%><tr><td><a href="/"><img src="/images/com/new_tops.jpg" title="<?php print $current_date.' - '.$current_clock;?>" border=0></a></td><td align=right><a href="/forums/index.php" title="Latest postings.">Index</a> | <a href="/forums/forums.php" title="Forums index.">Forums</a> | <a href="/forums/blogs.php" title="Blogs index.">Blogs</a> | <a href="/forums/polls.php" title="Polls index.">Polls</a> | <?php if(!empty($forum_sid)){?><a href="/forums/logout.php" title="Login the forum.">Logout</a> | <?php }else{?><a href="/forums/signup.php" title="Create a forum account.">Signup</a> | <?php }?> <a href="/forums/ladder.php" title="Posting ladder.">Ladder</a> | <a href="/forums/help.php" title="Help.">Help</a> | <a href="/forums/logs.php" title="Deleted topics from the forums.">Logs</a> | <a href="/" title="Go back to lords of lords homepage.">Worlds</a></td></tr></table>

<?php 

//mysqli_query($link, "UPDATE `$tbl_members` SET `level`='1' WHERE `level`<'1' and `ev`='1' LIMIT 1");
?>