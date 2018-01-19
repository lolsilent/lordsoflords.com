<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
   "https://w3.org/TR/html4/frameset.dtd">
<?php 
if(!empty($_COOKIE['chat_size'])){
$chat_size = $_COOKIE['chat_size'];
}
?><html><head><title><?php echo $title; ?> Advanced</title></head>
<frameset rows="*,30,25,<?php echo $chat_size;?>%" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>

<frame name="lol_main" src="<?php echo $root_url; ?>/main.php" scrolling=auto noborder>
	<frameset cols="*,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_fcontrol" src="<?php echo $root_url; ?>/world_control.php" scrolling=no noborder>
<frame name="lol_control" src="<?php echo $root_url; ?>/chat_control.php" scrolling=no noborder>
	</frameset>
<frame name="lol_side" src="<?php echo $root_url; ?>/menu1.php" scrolling=no noborder>
<frame name="lol_chit" src="<?php echo $root_url; ?>/chat.php" scrolling=auto noborder>

</frameset>


<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>