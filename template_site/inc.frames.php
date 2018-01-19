<table width=100% height=80% cellpadding=0 cellspacing=0 border=0>
<tr><td valign="top" height=55 nowrap colspan=2>
<a href="<?php print $root_url;?>"><img src="<?php print $root_url;?>/images/com/main.gif" border=0></a>
</td></tr>
<tr><td valign="top" width=100 nowrap>
<?php 
$pages = array('index', 'guide', 'signup', 'login', 'ladder');
foreach ($lol_servers as $key=>$val) {
 print "<hr><b><font size=1>$key</font></b><br>";
 foreach ($val as $ikey=>$ival) {
 print "<a href=\"$root_url/index.php?open=frames&ikey=$ikey&iframe=$ival\" target=\"_top\">$ikey</a><br>";
 if ($_GET['ikey'] == $ikey) {
 foreach ($pages as $page) {
 if ($ikey == 'Duel' or $ikey == 'Shadow' or $ikey == 'Shadow2') {
 print " - <font size=1><a href=\"$root_url/index.php?open=frames&ikey=$ikey&iframe=$ival/index.php?open=$page\">$page</a></font><br>";
 } else {
 print " - <font size=1><a href=\"$root_url/index.php?open=frames&ikey=$ikey&iframe=$ival/$page.php\">$page</a></font><br>";
 }

 }
 }
 }
}

if (empty($_GET['iframe'])) {$iframe = "https://lordsoflords.com/forum";}
?>
<hr><b><font size=1>Miscs</font></b><br>
<a href="<?php print "$root_url/index.php?open=frames&ikey=$ikey&iframe=$root_url";?>/forum" target="_top">Forum</a>
</td><td valign="top" width=100%>

 <?php if (empty($_GET['iframe'])) {?>
<a href="https://lordsoflords.com"><img src="https://lordsoflords.com/images/com/map.jpg" border=0></a>
 <?php } else {?>
<iframe marginwidth="0" marginheight="0" frameborder="0" name="iframe" height=100% width=100% src="<?php print $iframe;?>" scrolling="auto"></iframe>
 <?php }?>
</td></tr></table>
<?php if (!empty($_GET['iframe'])) {?>
[<a href="<?php print $iframe;?>" target="_blank">Open this page in a new browser</a>]

[<a href="<?php print $iframe;?>" target="_top">Open this page in the top frame</a>]
<?php }?>
