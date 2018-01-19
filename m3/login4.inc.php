<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
   "https://w3.org/TR/html4/frameset.dtd">
<html><head><title><?php echo $title; ?> Default</title></head>


<frameset rows="35,*" border=0 bordercolor="#000000" framespacing=0 frameborder=0 noborder>
<frame name="lol_control" src="<?php echo $root_url; ?>/chat_control.php" scrolling=no noborder>
<frame name="lol_chit" src="<?php echo $root_url; ?>/chat.php" scrolling=auto noborder>
</frameset>


<noframes>
<BODY>
This site uses frames. Please get a browser that supports frames.
</BODY>
</noframes>
</html>