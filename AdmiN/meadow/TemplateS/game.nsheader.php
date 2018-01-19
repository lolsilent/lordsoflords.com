<?php 
#!/usr/local/bin/php
setcookie ("lol_Session", "$current_time",time()+60*60*60) or die("Cookie Error $error_message");
$_COOKIE['lol_Session']=$current_time;

// and preg_match("/^$ref_url/i", $_SERVER['HTTP_REFERER'])
if (!empty($_COOKIE['lol_Username']) and !empty($_COOKIE['lol_Charname']) and !empty($_COOKIE['lol_Session'])) {

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once './AdMiN/www.mysql.php';
$link = mysqli_connect($db_host, $db_user, $db_password) or die("$error_message : Unable to connect to database");
mysqli_select_db($link, "$db_main") or die( "$error_message : Unable to select database");

$query = "SELECT * FROM `$tbl_members` WHERE (`Username`='".$_COOKIE['lol_Username']."' and `Charname`='".$_COOKIE['lol_Charname']."' and `Onoff`) ORDER BY `id` DESC";
$result = mysqli_query($link, $query) or die("$error_message : Query failed 12");
$row = mysqli_fetch_object ($result) or die("$error_message : Fetch failed 12");
mysqli_free_result ($result);
$freeplay=$row->Freeplay-time();
$max_gold=($row->Level+($row->Level/5))*$max_gold;
?><html>
<head>
<?php 
echo<<<EOT
<style type="text/css">
<!--
body, html, form, table {
	margin:0;
	color:$col_text;
	background:$col_bg;
	font-family: $font_family;
	font-weight: normal;
	font-size: $font_size;
	border:none;
	scrollbar-face-color: $col_bg;
	scrollbar-shadow-color: $col_bg;
	scrollbar-highlight-color: $col_form;
	scrollbar-3dlight-color: $col_bg;
	scrollbar-darkshadow-color: $col_bg;
	scrollbar-track-color: $col_form;
	scrollbar-arrow-color: $col_form;
	}

a {text-decoration: none; color:$col_link;}
a:hover {text-decoration: underline; color:$col_hover}

body { color:$col_text; background: $col_bg; font-family: $font_family; font-weight: normal; font-size: $font_size;}

table {border-color:$col_table;}
tr {font-family: $font_family; text-decoration: none;font-size: $font_size;}
th {color:$col_text; background-color: $col_th; font-weight: bold;}
td {text-decoration: none; font-size: $font_size;}
hr {color:$col_th;size:1;}
input {color:$col_text; background-color:$col_form; border-color:$col_th; }
select {width:100%; color:$col_text; background-color:$col_form; border-color:$col_table;}
textarea {height:150; width:100%; color:$col_text; background-color:$col_form; border-color:$col_th;}
-->
</style>
EOT;
?>
<title><?php echo $title; ?></title>
</head>
<body bgcolor=<?php echo $col_bg;?> text=<?php echo $col_text;?> rightmargin=0 leftmargin=0 topmargin=0 bottommargin=0>
<center>
<?php 
		//HEADER
if ($_COOKIE['lol_Charname'] == $row->Charname and $_COOKIE['lol_Username'] == $row->Username) {
echo "<table width=100% cellpadding=0 cellspacing=1 border=0><tr bgcolor=$col_th>
<td valign=top>Level : ".number_format($row->Level)."</td> <td valign=top>Exp : ".number_format($row->Exp)."</td> <td valign=top>Gold : ".number_format($row->Gold)."</td><td valign=top>Life : ".number_format($row->Life)."</td>";
if ($freeplay >= 1) {
echo "<td valign=top>Freeplay : ".number_format($freeplay)."</td>";
}
echo "</tr></table>";

//mysqli_query($link, "UPDATE `$tbl_members` SET `Time`=$current_time WHERE `id`=$row->id LIMIT 1") or die("$error_message".mysqli_error($link));
} else {
include_once("$html_header");
echo"$error_message.1";
include_once("$html_footer");
exit;
}


} else {
include_once("$html_header");
echo"$error_message. 2<br>";

if (empty($_COOKIE['lol_Username'])){
print 'Username Cookie Error.<br>';
}
if (empty($_COOKIE['lol_Charname'])){
print 'Charname Cookie Error.<br>';
}
if (empty($_COOKIE['lol_Session'])) {
print 'Session Cookie Error.<br>';
}

include_once("$html_footer");
exit;
}
?>