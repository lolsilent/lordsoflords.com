<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/www.functions.php';

array_push($search, "'java'", "'javascript'", "'document'", "'forms'", "'value'", "'style'", "','", "'='", "':'", "';'");
array_push($replace, "", "", "", "", "", "", "", "", "");
$chatfade='';
if (!empty($_COOKIE['chatfade'])) {
$chatfade=$_COOKIE['chatfade'];
}
if (!empty($_COOKIE['lol_Show'])) {
$max_cmessages=$_COOKIE['lol_Show'];
}
if (!empty($_COOKIE['lol_Refresh'])) {
$refresh_time=$_COOKIE['lol_Refresh'];
}
if (empty($_COOKIE['lol_col_personal'])) {
$personal_color='#FFFFFF';
} else {
$personal_color=$_COOKIE['lol_col_personal'];
}

$output=array();
	//detect post vars
if (!empty($_POST['action'])) {
while (is_array($_POST) && list($key, $val) = each($_POST)) {
$$key = $val;
	switch ($key) {
		case "action":
		if ($chatfade !== $chatfade) {
$chatfade=$fcol_bg;setcookie ("chatfade", "1",time()+60*60*600);
array_push($output, "Chat fade");
		}
		if ($fcol_bg !== $col_bg) {
$fcol_bg=$fcol_bg;setcookie ("col_bg", "$fcol_bg",time()+60*60*600);
array_push($output, "Changed color");
		}
		if ($fcol_text !== $col_text) {
$fcol_text=$fcol_text;setcookie ("col_text", "$fcol_text",time()+60*60*600);
array_push($output, "Changed color");
		}
		if ($fcol_link !== $col_link) {
$fcol_link=$fcol_link;setcookie ("col_link", "$fcol_link",time()+60*60*600);
array_push($output, "Changed color");
		}
		if ($fcol_hover !== $col_hover) {
$fcol_hover=$fcol_hover;setcookie ("col_hover", "$fcol_hover",time()+60*60*600);
array_push($output, "Changed color");
		}
		if ($fcol_table !== $col_table) {
$fcol_table=$fcol_table;setcookie ("col_table", "$fcol_table",time()+60*60*600);
array_push($output, "Changed color");
		}
		if ($fcol_th !== $col_th) {
$fcol_th=$fcol_th;setcookie ("col_th", "$fcol_th",time()+60*60*600);
array_push($output, "Changed color");
		}
		if ($fcol_form !== $col_form) {
$fcol_form=$fcol_form;setcookie ("col_form", "$fcol_form",time()+60*60*600);
array_push($output, "Changed color");
		}
		if ($ffont_family !== $font_family) {
$ffont_family=$ffont_family;setcookie ("font_family", "$ffont_family",time()+60*60*600);
array_push($output, "Changed Font");
		}
		if ($ffont_size !== $font_size) {
$ffont_size=$ffont_size;setcookie ("font_size", "$ffont_size",time()+60*60*600);
array_push($output, "Changed Font Size");
		}
		if ($fpersonal_color !== $personal_color) {
setcookie ("lol_col_personal", "$fpersonal_color",time()+60*60*600);
array_push($output, "Changed personal chat color");
		}
			if ($cchat_size <> $chat_size and $cchat_size >= 20 and $cchat_size <= 80) {
setcookie ("chat_size", "$cchat_size",time()+60*60*600);
array_push($output, "Changed chat frame size, relogin to make the changes to effect");
		}
		if ($cmax_cmessages <> $max_cmessages) {
setcookie ("lol_Show", "$cmax_cmessages",time()+60*60*600);
array_push($output, "Changed chat messages shown");
		}
		if ($crefresh_time <> $refresh_time and $crefresh_time >= 5) {
setcookie ("lol_Refresh", "$crefresh_time",time()+60*60*600);
array_push($output, "Changed chat refresh time");
		}

		break 2;
	}
}
}
	//detect post vars

include_once $game_header;

if (isset($output[0])) {
foreach ($output as $out) {
echo "$out<br>";
}
} else {
?>
<form method=post>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><th colspan=2>Color Settings</th></tr>
<tr><td width=50%>Background Color<font color=<?php echo $col_bg;?>> EXAMPLE</td><td><input type=text name=fcol_bg value="<?php echo $col_bg;?>"></td></tr>
<tr><td width=50%>Text Color<font color=<?php echo $col_text;?>> EXAMPLE</td><td><input type=text name=fcol_text value="<?php echo $col_text;?>"></td></tr>
<tr><td width=50%>Link Color<font color=<?php echo $col_link;?>> EXAMPLE</td><td><input type=text name=fcol_link value="<?php echo $col_link;?>"></td></tr>
<tr><td width=50%>Onlink Color<font color=<?php echo $col_hover;?>> EXAMPLE</td><td><input type=text name=fcol_hover value="<?php echo $col_hover;?>"></td></tr>
<tr><td width=50%>Table Color<font color=<?php echo $col_table;?>> EXAMPLE</td><td><input type=text name=fcol_table value="<?php echo $col_table;?>"></td></tr>
<tr><td width=50%>Table TH Color<font color=<?php echo $col_th;?>> EXAMPLE</td><td><input type=text name=fcol_th value="<?php echo $col_th;?>"></td></tr>
<tr><td width=50%>Form Color<font color=<?php echo $col_form;?>> EXAMPLE</td><td><input type=text name=fcol_form value="<?php echo $col_form;?>"></td></tr>
<tr><th colspan=2>Font Settings</td><td></th></tr>
<tr><td width=50%>Font Family</td><td><input type=text name=ffont_family value="<?php echo $font_family;?>"></td></tr>
<tr><td width=50%>Font Size</td><td><input type=text name=ffont_size value="<?php echo $font_size;?>"></td></tr>
<tr><th colspan=2>Chat Settings</td><td></th></tr>
<tr><td width=50%>Personal chat color <font color=<?php echo $personal_color;?>> EXAMPLE</td><td><input type=text name="fpersonal_color" size=2 maxlength=10 value="<?php echo $personal_color;?>"></td></tr>
<tr><td width=50%>Show Messages</td><td><input type=text name="cmax_cmessages" size=2 maxlength=10 value="<?php echo $max_cmessages;?>"></td></tr>
<tr><td width=50%>Refresh time</td><td><input type=text name="crefresh_time" size=5 maxlength=10 value="<?php echo $refresh_time;?>"></td></tr>
<tr><td width=50%>Chat frame percentage<font size=1> Min is 20% and max is 80%</td><td><input type=text name="cchat_size" size=5 maxlength=10 value="<?php echo $chat_size;?>"></td></tr>
<tr><td colspan=2><input type=submit name=action value="Save Setting"></td></tr>
</table></form>
<br>Refresh your browser or relogin for all colors to take effect.
<?php 
}
include_once("www.prefpages.php");
include_once $game_footer;
?>