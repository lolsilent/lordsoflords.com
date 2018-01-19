<?php 
#!/usr/local/bin/php
$domains=array('www.xbros.com', 'www.xbros.net', 'www.thesilent.com', 'www.lordsoflords.com', 'xbros.com', 'xbros.net', 'thesilent.com', 'lordsoflords.com');

require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.mysql.php';
?>
<html><head><style type="text/css"><!--
body { color:#FFFFFF; background: #000000; font-family: Verdana, Arial, Monaco; font-weight: normal; font-size: 10pt;}

a {text-decoration: none; color:#CCCCCC;}
a:hover {text-decoration: underline; color:#EEE111}

table {border-color:#000000;}
tr {font-family: Verdana, Arial, Monaco; text-decoration: bold;font-size: 10pt;}
th {color:#000000; background-color: #CCCDDD; font-weight: bold;}
td {text-decoration: none; font-size: 10pt;}

input {width:100%; height:25; color:#000000; background-color:#EEE123; border-color:#000000; }
select {width:100%; color:#000000; background-color:#EEE123; border-color:#000000;}
textarea {width:100%; height:50%; color:#000000; background-color:#EEE123; border-color:#000000;}
--></style>
<title><?php echo $title; ?></title>
</head>
<body bgcolor=#000000 text=#FFFFFF rightmargin=0 leftmargin=0 topmargin=0 bottommargin=0>
<?php 
if (in_array($_SERVER['SERVER_NAME'],$domains)) {

$link = mysqli_connect($db_host, $db_user, $db_password) or print("Unable to connect to database");
mysqli_select_db($link, "$db_main") or print( "Unable to select database");
?>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr bgcolor=#000000>
<td><font size=1>
Players<br><font color=#FFF123>
<?php 
$result = mysqli_query($link, "SELECT id FROM $tbl_members WHERE `id` ORDER BY `id` DESC limit 1");
$prow = mysqli_fetch_object ($result);
echo number_format($prow->id);
mysqli_free_result ($result);
?>
</font><br>
Alive<br><font color=#FFF123>
<?php 
$result = mysqli_query($link, "SELECT id FROM $tbl_members WHERE `id` ORDER BY `id` DESC");
$alive=mysqli_num_rows($result);
echo number_format($alive);
mysqli_free_result ($result);
?>
</font><br>
Online<br><font color=#FFF123>
<?php 
$result = mysqli_query($link, "SELECT Onoff FROM $tbl_members WHERE Onoff ORDER BY `id` DESC");
echo number_format(mysqli_num_rows($result));
mysqli_free_result ($result);
?>
</font><br>
Buried<br><font color=#FFF123>
<?php echo number_format($prow->id-$alive);?>
</font></td>
</tr>
</table>
<?php 
mysqli_close ($link);
} else {
echo<<<EOT
<font size=+5><center><a href="https://lordsoflords.com" target="_top">Lordsoflords.coM Servers</font><p>Click here to enteR</a>
EOT;
}	//end oke

include_once $clean_footer;
?>