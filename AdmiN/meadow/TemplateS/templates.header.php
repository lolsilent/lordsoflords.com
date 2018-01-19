<!--Lol V2 started on 6/1/2003 01:05--><html>
<head>
<title>LORDS of LORDS a free online text based role playing game RPG</title>
<meta NAME="Description" CONTENT="Lords of Lords is a free online text-based massive role playing game (RPG) that can be played anywhere on whatever computer or system that has a browser and web access. Only nice people are welcome no bad peoples!">
<meta NAME="keywords" CONTENT="free, online, text, based, massive, role, playing, game, MMORPG, MPORPG, gaming, lords of lords, rpg, browser">
<link rel="stylesheet" type="text/css" href="/script.php?css">
<link rel="shortcut icon" path="/favicon.ico">
</head>
<body>
<center>

<table cellpadding=0 cellspacing=0 border=0 width=800>
<tr><td colspan="3"><img src="/images/lol2007a1.jpg" border="0"><br><a href="https://lordsoflords.com" title="<?php print $title_info;?>"><img src="/images/lol2007a2.jpg" border="0"></a><br><img src="/images/lol2007a3.jpg" border="0"></td></tr>
<tr><td><img src="/images/lol2007b<?php print strtolower($server);?>.jpg" border="0"></td><td width=468 height=60 background="/images/lol2007e.jpg">
<img src="/images/lol2007e.jpg" border="0">
<br>
<img src="/images/lol2007c.jpg" border="0">
</td><td><img src="/images/lol2007d.jpg" border="0"></td></tr>
</table>
<table cellpadding=0 cellspacing=0 border=0 width=800><tr><td valign=top>
<!--HEADER-->

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<td align=center valign=top><center>

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td width=100 align=center valign=top background="/images/lol2007bg.jpg"><center>
	<!--game menu-->
<table width=95 cellpadding=1 cellspacing=1 border=0><tr><th>
<a href="index.php">Index</a><br><a href="signup.php">Signup</a><br><a href="login.php">Login</a><br><br><a href="ladder.php">Ladder</a><br><a href="guilds.php">Guilds</a><br><a href="faq.php">Faq</a><br><br><a href="rules.php">Rules</a><br><a href="guide.php">Guide</a><br><a href="https://lordsoflords.com/forums/">Forum</a><br><br><a href="https://lordsoflords.com">Servers</a><br><a href="donate.php">Donate</a><br>
</th></tr><tr><th>
<form method=post enctype="application/x-www-form-urlencoded" target="_top" action="login.php">
<font size=1>Username<br><input type=text size=10 name="Username" value="<?php if (!empty($_COOKIE['lol_Username'])) {echo $_COOKIE['lol_Username'];}?>" maxlength=10>
<br>Password<br><input type=password size=10 name="Password" maxlength=50><br>
<input type=submit value="Play!" Submit name=Action>
<?php 
if (isset($_COOKIE['layout']) and !empty($_COOKIE['layout'])) {
	if ($_COOKIE['layout'] == 1) {
		echo "Advanced";
	} elseif ($_COOKIE['layout'] == 2) {
		echo "Expert";
	} elseif ($_COOKIE['layout'] == 3) {
		echo "Grouped";
	}
?>
<input type=hidden name=layout value="<?php echo $_COOKIE['layout'];?>">
<?php 
}
?>
</form>
</th></tr>
<tr><th valign=top>
<font size=1><b>Server<br>
<?php echo $server; ?><br>
Server date<br>
<?php echo $current_date; ?>
</th></tr>
</table>
	<!--game menu-->

</td><td valign=top align=center><center>