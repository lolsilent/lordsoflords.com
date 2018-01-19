<?php 
#!/usr/local/bin/php
require_once('AdmiN/www.config.php');
require_once($inc_functions);
require_once($html_header);
?>
<p><b>Lords of Lords Cookie Station</b></p>
<?php 
if(!empty($_GET['delete_cookie'])){
	?><b><?php 
$delete_cookie=clean_post($_GET['delete_cookie']);
if(!empty($_COOKIE[$delete_cookie])){
setcookie ("$delete_cookie", "", time() - 3600);
print 'Cookie name : <b>'.$delete_cookie.'</b> deleted.';
}else{?>Cookie does not exist, was already deleted or you have double clicked on the link.<?php }
	?></b><?php 
}
?>

<table width="100%" border="0">

	<tr>
	<dl><dt>What are Cookies?</dt><dd>
Cookies holds information about your computer and is saved to your hard disk in a text file. The information may be needed to play the games or using our site, all of them can be changed and or deleted here or if you do it manually with your browser.<br>
Here you can delete cookies from this particular part of this site.
	</dd>
	</dl>
	</tr>
<tr><dl><dt>Cookies on <?php print $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];?></dt><dd></dd></dl></tr>
<?php 
if (!empty($_COOKIE)){
foreach ($_COOKIE as $key=>$val){
print '<tr><dl><dt>Name: '.$key.' <a href="?delete_cookie='.$key.'" title="Delete this cookie named '.$key.'.">Delete</a></dt><dd>Value: '.$val.'</dd></dl></tr>';
}
}else{
print '<tr><dl><dt>No cookies found</dt><dd>If you plan to register on this site be sure to allow cookies from this site to enter the most parts of this site.</dd></dl></tr>';
}
?>

	</table>

<?php require_once($html_footer);?>