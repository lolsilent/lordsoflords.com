<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';

$layouts = array(
'menu on the left side with chat',
'menu on the right side with chat',

'menu on the left side without chat',
'menu on the right side without chat',

'menu on the left side chat up',
'menu on the right side chat up',

'menu on the left control chat up',
'menu on the right control chat up',

'menu on the left side without chat control up',
'menu on the right side without chat control up',
);

if (!empty($_COOKIE['layoutf'])) {
	$layoutf=clean_post($_COOKIE['layoutf']);
	if (!in_array($layoutf,$layouts)) {$layoutf=$layouts[0];}
}

if (!empty($_GET['layoutf'])) {
	$layoutf=clean_post($_GET['layoutf']);
	if (in_array($layoutf,$layouts)) {
		setcookie ("layoutf", "$layoutf",$current_time+5000000) or die("$error_message");
	}else{
		$layoutf='';
	}
}else{
	$layoutf='';
}

if ($layoutf == $layouts[0]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="101,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
<frameset rows="*,35,<?php echo $chat_size;?>%" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
<frameset rows="35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_control" src="chat_control.php" scrolling=no noborder>
<frame name="lol_chit" src="chat.php" scrolling=auto noborder>
</frameset>
</frameset>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}elseif ($layoutf == $layouts[1]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="*,101" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frameset rows="*,35,<?php echo $chat_size;?>%" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
<frameset rows="35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_control" src="chat_control.php" scrolling=no noborder>
<frame name="lol_chit" src="chat.php" scrolling=auto noborder>
</frameset>
</frameset>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}elseif ($layoutf == $layouts[2]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="101,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
<frameset rows="*,35" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
</frameset>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}elseif ($layoutf == $layouts[3]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="*,101" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frameset rows="*,35" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
</frameset>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}elseif ($layoutf == $layouts[4]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="101,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
<frameset rows="<?php echo $chat_size;?>%,35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frameset rows="*,35" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_chit" src="chat.php" scrolling=auto noborder>
<frame name="lol_control" src="chat_control.php" scrolling=no noborder>
</frameset>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
</frameset>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}elseif ($layoutf == $layouts[5]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="*,101" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frameset rows="<?php echo $chat_size;?>%,35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frameset rows="*,35" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_chit" src="chat.php" scrolling=auto noborder>
<frame name="lol_control" src="chat_control.php" scrolling=no noborder>
</frameset>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
</frameset>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}elseif ($layoutf == $layouts[6]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="101,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
<frameset rows="35,<?php echo $chat_size;?>%,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
<frameset rows="35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_control" src="chat_control.php" scrolling=no noborder>
<frame name="lol_chit" src="chat.php" scrolling=auto noborder>
</frameset>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
</frameset>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}elseif ($layoutf == $layouts[7]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="*,101" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frameset rows="35,<?php echo $chat_size;?>%,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
<frameset rows="35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_control" src="chat_control.php" scrolling=no noborder>
<frame name="lol_chit" src="chat.php" scrolling=auto noborder>
</frameset>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
</frameset>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}elseif ($layoutf == $layouts[8]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="101,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
<frameset rows="35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
</frameset>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}elseif ($layoutf == $layouts[9]) {?>
<html><head><title><?php echo $title; ?></title></head>
<frameset cols="*,101" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frameset rows="35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_fcontrol" src="world_control.php" scrolling=no noborder>
<frame name="lol_main" src="main.php" scrolling=auto noborder>
</frameset>
<frame name="lol_side" src="menu.php" scrolling=auto noborder>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>
<?php 
exit;
}

include_once($game_header);

?><table width="100%"><tr><th>Please select an layout that fits you</th></tr><tr><td><?php 
foreach ($layouts as $val) {
print '<a href="layout.php?layoutf='.$val.'" target="_top">'.ucfirst($val).'.</a><br>';
}
?></td></tr></table><?php 
include_once($game_footer);
?>