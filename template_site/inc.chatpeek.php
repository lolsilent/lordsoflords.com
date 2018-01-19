<?php 
#!/usr/local/bin/php
if (empty($limit)) {$limit=25;}
require_once 'AdmiN/www.mysql.php';
$link = mysqli_connect($db_host, $db_user, $db_password) or die('Connection failed.');

$kut_zooi = array(
'Meadow' => array('lol1_meadow','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'Meadow2' => array('lol1_meadow2','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'Xedon' => array('lol1_xedon','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'Devlab' => array('lol1_devlab','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'Eidolon' => array('lol1_eidolon','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'Duel' => array('lol1_duel','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
'Ysomite' => array('lol2_ysomite','lol2_board','id,creator,crintel,news,date'),
'Shadow' => array('lol3_shadow','lol3_board','id,star,sex,charname,class,level,receiver,news,gamename,ip'),
'Shadow2' => array('lol3_shadow2','lol3_board','id,star,sex,charname,class,level,receiver,news,gamename,ip'),

'Global' => array('silent_chat','chat_content','id,channel,star,guild,sex,charname,level,receiver,content,gamename,ip'),
//'History' => array('lol1_history','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
//'Euro' => array('lol1_euro','lol_board','id,Guild,Sex,Charname,Race,Level,Message,ip'),
//'PJ' => array('paypaljackpot_com','jackpot_board','id,channel,star,guild,sex,nickname,gold,receiver,content,gamename,ip'),
//'Megod' => array('megod_megod','god_chat','id,timer,sex,charname,level,receiver,channel,message'),

);

$kut_zooi_keys=array_keys($kut_zooi);
?><tr><th>Chat peek</th></tr><tr><td><?php 
$i=0;foreach ($kut_zooi_keys as $val) {$i++;
echo "<a href=\"?open=chatpeek&peek=$val\">$val</a> ";
if($i<=6){?><font size=1> <a href="https://lordsoflords.com/<?php echo strtolower($val);?>/chat/">logs</a></font> <?php }
}
?><br><?php 

if (empty($_GET['peek'])) {?>Please select a server to peek in the chat.<?php } else {
$peek=$_GET['peek'];

foreach ($kut_zooi as $key=>$val) {
if ($peek == $key) {
mysqli_select_db($link,"$val[0]",$link);
$query = "SELECT * FROM $val[1] WHERE id ORDER BY id desc limit $limit";
if ($result = mysqli_query($link, $query)) {
while ($row = mysqli_fetch_object ($result)) {
if (!empty($color)) {$color='';} else {$color='#00FFFF';}
print "<font color=$color>";
foreach ($row as $ikey=>$ival) {
if ($ikey !== 'id' and $ikey !== 'ip' and $ikey !== 'star') {
 $ival = preg_replace("/~.*?\[.*?\]/i","","$ival ");
 print stripslashes($ival);
}
}
print "</font><br>";
 $ikeys=1;
} //while
mysqli_free_result ($result); } //results
}
} //foreach
}

?>
<meta http-equiv="refresh" content="30">
</td></tr>
<?php 
mysqli_close($link);
?>