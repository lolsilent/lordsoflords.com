<?php 
#!/usr/local/bin/php
require_once 'AdmiN/www.mysql.php';
$message_add="Send your visitors to $root_url/fansitein.php?site=[Site ID] to increase ins.";
?>

<tr>
<th bgcolor="#000000">Lords of Lords Fan/Guild/Clan sites</th>
</tr>

<tr><td>
<?php 
$link = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($link, "$db_main");
if (!empty($_POST['url']) and !empty($_POST['title'])) {

function clean_post($in) {
$in=strip_tags($in);
$in=htmlspecialchars("$in", ENT_QUOTES);
$in=trim($in);
$in=addslashes($in); //Quote meta characters
return $in;
}

$url=clean_post($_POST['url']);
$title=clean_post($_POST['title']);
if (preg_match ("/^http:\/\/.*?\..*?/i", "$url") and strlen($url) >=12 and $url !== $title and !empty($url) and !empty($title)){
if (empty($_POST['description'])) {$description='';} else {$description=clean_post($_POST['description']);};
if (empty($_POST['sex'])) {$sex='';} else {$sex=clean_post($_POST['sex']);};
if (empty($_POST['charname'])) {$charname='';} else {$charname=clean_post($_POST['charname']);};
$insert_val = "'', 0, 0, 0, '$title', '$description', '$url', '$sex', '$charname', '$current_date','".$_SERVER['REMOTE_ADDR']."'";

mail("fansite@thesilent.com", "New fansite", "New fansite added.",
 "From: fansite@{$_SERVER['SERVER_NAME']}", "-ffansite@{$_SERVER['SERVER_NAME']}");

mysqli_query($link, "INSERT INTO $tbl_fans ($fld_fans) values ($insert_val)") and print("Thank you for submitting your site : $message_add") or print("The Url that you are trying to submit already exist.");
} else {
print "Sorry your submitted Url is invalid, or you have somefield missing.";
}
}
$result = mysqli_query($link, "SELECT * FROM $tbl_fans WHERE (id and validated) ORDER BY ins desc LIMIT 100");
?>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<?php 
$i=1;
while ($frow = mysqli_fetch_object ($result)) {
if (empty($bgcolor)) {$bgcolor=" bgcolor=\"#345678\"";} else {$bgcolor='';}
print "
<tr$bgcolor><td>
<b>$i</b> . <a href=\"fansiteout.php?site=$frow->id\" target=\"_top\">$frow->title</a><br>
"; if (!empty($frow->description)) { print "$frow->description<br>";}print "<font size=1>Ins : ".number_format($frow->ins)." Outs : ".number_format($frow->outs)." Site ID : $frow->id Added on : $frow->add_date"; if (!empty($frow->charname)) { print " Added by : $frow->sex $frow->charname";}print "<br>
</td></tr>
";
$i++;

if (!empty($_GET['delete']) and !empty($_GET['password'])) {
if ($_GET['delete'] == $frow->id and $_GET['password'] == '1793admin1793') {
mysqli_query($link, "DELETE FROM $tbl_fans WHERE id=$frow->id LIMIT 1") and print("<b>Deleted $frow->id</b>");
}
}

} //end while
mysqli_free_result ($result);

if (!empty($_GET['tovalidate'])) {
$result = mysqli_query($link, "SELECT * FROM $tbl_fans WHERE (id and validated<=0) ORDER BY ins desc LIMIT 100");
while ($frow = mysqli_fetch_object ($result)) {
print "
<tr$bgcolor><td>
<b>$frow->id to be validated</b> . <a href=\"fansiteout.php?site=$frow->id\" target=\"_top\">$frow->title</a><br>
"; if (!empty($frow->description)) { print "$frow->description<br>";}print "<font size=1>Ins : ".number_format($frow->ins)." Outs : ".number_format($frow->outs)." Site ID : $frow->id Added on : $frow->add_date"; if (!empty($frow->charname)) { print " Added by : $frow->sex $frow->charname";}print "<br>
</td></tr>
";
if (!empty($_GET['delete']) and !empty($_GET['password'])) {
if ($_GET['delete'] == $frow->id and $_GET['password'] == '1793admin1793') {
mysqli_query($link, "DELETE FROM $tbl_fans WHERE id=$frow->id LIMIT 1") and print("<b>Deleted $frow->id</b>");
}
}
} //end while
mysqli_free_result ($result);
}

mysqli_close ($link);
?>
</table>
<a name=#add><form method=post>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><th colspan=2>Add your site here</th></tr>
<tr><td width=50%>Title of your site<a>*</a></td><td><input type=text name=title size=25 maxlenght=25 value=""></td></tr>
<tr><td>Url of your site<a>*</a></td><td><input type=text name=url size=25 maxlenght=25 value="https://"></td></tr>
<tr><td>Short description of your site</td><td><input type=text name=description size=25 maxlenght=200 value=""></td></tr>
<tr><td>Sex of your charname</td><td><input type=text name=sex size=25 maxlenght=25 value=""></td></tr>
<tr><td>Your charname</td><td><input type=text name=charname size=25 maxlenght=25 value=""></td></tr>
<tr><td colspan=2 align=center><input type=submit name=action value="Go!"></td></tr>
</table></form>
*</a>required<br>
<p>
<?php print $message_add;?>
<br><font size=1>
<?php print $_SERVER['REMOTE_ADDR'];?>
</td></tr>