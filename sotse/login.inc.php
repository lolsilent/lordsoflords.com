<html><head><title><?php echo $title; ?> Default</title></head>
<frameset cols="101,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_side" src="<?php echo $root_url; ?>/menu.php" scrolling=auto noborder>
<frameset rows="*,35,<?php echo $chat_size;?>%" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_main" src="<?php echo $root_url; ?>/main.php" scrolling=auto noborder>
<frame name="lol_fcontrol" src="<?php echo $root_url; ?>/world_control.php" scrolling=no noborder>
<frameset rows="35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_control" src="<?php echo $root_url; ?>/chat_control.php" scrolling=no noborder>
<frame name="lol_chit" src="<?php echo $root_url; ?>/chat.php" scrolling=auto noborder>
</frameset>
</frameset>
</frameset>
<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>