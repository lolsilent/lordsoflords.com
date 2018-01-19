<?php 
require_once 'AdMiN/www.main.php';
require_once 'AdMiN/array.races.php';
require_once "AdMiN/www.functions.php";
include_once("$html_header");
if(empty($player_ip)){$player_ip=$_SERVER['REMOTE_ADDR'];}

if (!empty($_POST['action']) and !empty($_POST['timer']) and !empty($_POST['username']) and !empty($_POST['password']) and !empty($_POST['charname']) and !empty($_POST['sex']) and !empty($_POST['asap']) and isset($_POST['isap'])) {

$fields=0;

if(!empty($_POST['username'])){$username=clean_input($_POST['username']);$username and $fields++;}else{$username='';}
if(!empty($_POST['password'])){$password=clean_post($_POST['password']);if(strlen($password)>=4){$fields++;}}else{$password='';}
if(!empty($_POST['sex'])){$sex=clean_input($_POST['sex']);if ($sex=='Lord' or $sex=='Lady'){$fields++;}}else{$Sex='';}
if(!empty($_POST['charname'])){$charname=clean_input($_POST['charname']);$charname=ucfirst(strtolower($charname));$charname and $fields++;}else{$charname='';}
if(!empty($_POST['friend'])){$friend=clean_input($_POST['friend']);}else{$friend='';}
if(!empty($_POST['race'])){$race=clean_post($_POST['race']);if (in_array($race,array_keys($races_array))) { $fields++; }}else{$race='';}
if(!empty($_POST['asap'])){$asap=clean_post($_POST['asap']);}else{$asap='';}
if(!empty($_POST['isap'])){$isap=clean_post($_POST['isap']);$fields++;}else{$isap='';}

if ($fields == 6) {
	//detect same fields
$same_fields="";
if ($username == $password) {
$same_fields="$same_fields Username matches Password<br>";$fields=0;
}
if ($username == strtolower($charname)) {
$same_fields="$same_fields Username matches Charname<br>";$fields=0;
}
if (strtolower($charname) == $password) {
$same_fields="$same_fields Charname matches Password<br>";$fields=0;
}

if (!empty($same_fields)) {
echo<<<EOT
<font color=#FF0000><b>
WARNING : $same_fields
<br>
Account signup aborted!
<br>
</b></font>
EOT;
}
	//detect same fields
}
if ($fields >= 5) {

if ($sex !== 'Lord' AND $sex !== 'Lady'){$sex = 'Lord';}

	//SAP
$saping = sap_me($_POST['asap'],$_POST['isap']);
if ($saping == 'OKE') {
	if ($_POST['timer'] > $current_time) {
require_once "./AdMiN/www.mysql.php";
$link = mysqli_connect($db_host, $db_user, $db_password);
mysqli_select_db($link, "$db_main");

	//CHECKING FOR A FRIEND
if (!empty($friend)) {
if($result = mysqli_query($link, "SELECT * FROM `$tbl_members` WHERE (`Charname`='$friend') ORDER BY `id` DESC LIMIT 1")){
if($prow = mysqli_fetch_object ($result)){
mysqli_free_result ($result);
	$friend=$prow->Charname;
}
}
}
	//CHECKING FOR A FRIEND



$password=crypt($password,$username);
$value = "
NULL,'$username','$password','','','$sex','$charname','$race',
1,50,250,100,25,15,10,25,15,10,
1,1,1,1,1,1,1,1,1,1,1,1,
0,
0,
0,
0,
1000,
0,0,
$current_time,
0,0,
'$friend',
'$player_ip'
";

mysqli_query($link, "INSERT INTO `$tbl_members` values ($value)")
	and
	$preparing="prepared"
	or
	print("Sorry your chosen Username '$username' or Charname '$charname' is already taken please choose another one.");
if (isset($preparing) and !empty($preparing)) {
	if ($preparing == "prepared") {
$history="'', '$charname', '0', '0', '0', '0', '0'";
mysqli_query($link, "INSERT INTO $tbl_history values ($history)");
	print ("<table><tr><td>
	Hi <b>$sex $charname</b>,<br>
	<br>
	Your account has been created successfully.<br>
	ATTENTION : Your account details could have changed a little.<br>
	Account details :<br>
	Username : <b>$username</b><br>
	Password : <b>**********</b><br>
	Sex : <b>$sex</b><br>
	Charname : <b>$charname</b><br>
	Race : <b>$race</b><br>
	<br>
	If you forget your username or password fast, then you can give up an email address for username and password retrieval in the game.<br>
	After you have logged in go to preferences to add and change your site and account details.<br>
	<br>
	Good luck!.<br>
	Cheers,<br>$admin_name<br>
	$player_ip
	</td></tr></table>");
	}
}
mysqli_close ($link);
} else {
?>Signup timed out because you took longer than 300 seconds to signup, please try again.<?php 
}
} else {
echo "Your statement of <b>$asap = $isap</b> is not correct.";
}
} else {
?>Some fields are missing or incorrect, please go back with your browser try again.<?php 
}
} else {
?>
<b>You must use only letters and numbers with a minimum of four characters.<br>no fields must be the same.</b>
<form method=post target="_top">
<input type=hidden name=timer value="<?php echo ($current_time+300); ?>">
<?php if (!empty($_GET['friend'])) { ?><input type=hidden name=friend value="<?php echo $_GET['friend']; ?>"><?php }?>
<table cellpadding=2 cellspacing=2 border=0>
<tr>
<th colspan=2>
Personal Account Information
</th>
</tr>
<tr>
<td width=50%>
Username
<br><font size=1>maxlength is 10 chars, minimum of 4 chars
</td>
<td>
<input type=text name=username maxlength=10>
</td>
</tr>
<tr>
<td width=50%>
Password
<br><font size=1>maxlength is 10 chars, minimum of 4 chars
</td>
<td>
<input type=password name=password maxlength=10>
</td>
</tr>
<tr>
<th colspan=2>
Game Account Information
</th>
</tr>
<tr>
<td width=50%>
Sex
</td>
<td>
<select name=sex>
<option>Lord</option>
<option>Lady</option>
</select>
</td>
</tr>
<tr>
<td width=50%>
Charname
<br><font size=1>maxlength is 10 chars, minimum of 4 chars
</td>
<td>
<input type=text name=charname value="" maxlength=10>
</td>
</tr>
<tr>
<td valign=top>
Race
<br><font size=1>Select a race
</td><td>
<select name=race>
<?php 
$i=0;
foreach ($races_array as $key=>$val) {
if ($key == 'Human') {
echo "<option selected>".ucfirst($key)."</option>";
} else {
echo "<option>".ucfirst($key)."</option>";
}
}
?>
</select>
</td>
</tr>
<tr>
<th colspan=2>
Simple Automatism Protection
</th>
</tr>
<tr>
<td width=50%>
<?php 
list ($sapa,$sapb,$sapc) = get_sap();
?>
<input type=hidden name=asap value="<?php echo "$sapa $sapb $sapc"; ?>">
How much is <b><?php echo "$sapa$sapb$sapc"; ?></b>?
<br><font size=1>too difficult? refresh page try again
</td>
<td>
<input type=text name=isap value="">
</td>
</tr>
<tr>
<th colspan=2 align=center>
<input type=submit name=action value="Signup now">
</th>
</tr>
</table>
</form>
<?php 
}
require_once($_SERVER['DOCUMENT_ROOT'].'/AdmiN/playersonline.php');
include_once("$html_footer");
?>
