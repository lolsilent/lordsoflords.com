<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once($inc_mysql);
require_once($inc_functions);
require_once($inc_emotions);
require_once($html_header);

if (!empty($_POST['message'])) {
	$message=clean_post($_POST['message']);
} else {
$message='[quote]quote[/quote]
[img]https://lordsoflords.com/images/com/new_tops.jpg[/img]
[url]https://lordsoflords.com[/url]
[url=https://lordsoflords.com]Free online text based rpg game.[/url]
[email]test@test.com[/email]
[c=red]red[/c] [c=white]white[/c] [c=blue]blue[/c]
[bomber] test [bird] test [cat] text [smile] text [butterfly]';
}
?><form method=post><table width=100%>
<tr><th colspan=2>Forum Help Example Post</th></tr>
<tr>
<td valign=top>Message</td><td><textarea name=message cols=75 rows=15><?php print $message;?></textarea></td></tr>
<tr><th colspan=2><input type=submit name=action value="Test this post"></th></tr>
</table></form>

<table width=100% border=1><tr><td><table cellpadding=2 cellspacing=2 border=1 width=100% bordercolor=<?php print $col_th;?>><tr><td valign=top>Posted message</td><td><?php print postit($message);?></td></tr></table></td></tr></table>

<br>
<a href="login.php">Lost your password?</a>
<?php 
require_once($html_footer);
?>