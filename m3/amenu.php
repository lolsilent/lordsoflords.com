<?php 
#!/usr/local/bin/php
require_once 'AdMiN/www.main.php';
include_once $clean_header;

$gamefiles	= array(
'Info'		=>array ('main', 'paper', 'deads', 'steals', 'graves', 'matches'),
'Team'	 	=>array('guild', 'challenge', 'schedule', 'transfer', 'messages'),
'War'		=>array('fight', 'world', 'tourney', 'steal'),
'Finance'		=>array('stash', 'shop','market'),
'Player'		=>array('stats', 'charms', 'inventory', 'nobility', 'politics', 'trial'),
'Miscs'		=>array('save', 'prefz', 'support', 'town', 'ladders', 'forums', 'logout'),
);

?>
<style type="text/css">
.menutitle{
cursor:pointer;
margin-bottom: 5px;
background-color:#ECECFF;
color:#000000;
width:75px;
padding:2px;
text-align:center;
font-weight:bold;
border:1px solid #000000;
}

.submenu{
margin-bottom: 0.5em;
}
</style>

<script type="text/javascript">

/***********************************************
* Switch Menu script- by Martial B of https://getElementById.com/
* Modified by Dynamic Drive for format & NS4/IE4 compatibility
* Visit https://dynamicdrive.com/ for full source code
***********************************************/

if (document.getElementById){ //DynamicDrive.com change
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}

function SwitchMenu(obj){
	if(document.getElementById){
	var el = document.getElementById(obj);
	var ar = document.getElementById("masterdiv").getElementsByTagName("span"); //DynamicDrive.com change
		if(el.style.display != "block"){ //DynamicDrive.com change
			for (var i=0; i<ar.length; i++){
				if (ar[i].className=="submenu") //DynamicDrive.com change
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
}

</script>

<table width=100 border=0 cellpadding=0 cellspacing=0>
<tr><td><img src="<?php print($images_url);?>/frametop.gif" border=0></td></tr>
<tr><td align=center valign=top background="<?php print($images_url);?>/frame.gif"><b>
<!-- Keep all menus within masterdiv-->
<img src="<?php echo $emotions_url; ?>/star.gif"><br>
<div id="masterdiv">


<?php 
$i=1;
foreach ($gamefiles as $key=>$gfiles) {
echo<<<EOT
	<div class="menutitle" onclick="SwitchMenu('sub$i')">$key</div>
	<span class="submenu" id="sub$i">
EOT;
foreach ($gfiles as $file) {
if ($file == "logout") {$target="_top";} else {$target="lol_main";}
$pfile=ucfirst($file);
echo<<<EOT
		<a href="$root_url/$file.php" target="$target">$pfile</a><br>
EOT;
}
echo<<<EOT
	</span>
EOT;
$i++;
}
?>


	<img src="<?php echo $emotions_url; ?>/star.gif" style="cursor:pointer;" onclick="SwitchMenu('sub<?php echo $i;?>')"><br>
	<span class="submenu" id="sub<?php echo $i;?>">
<a href="<?php echo $root_url; ?>/hospital.php" target="lol_main">.</a>
	</span>

</div>

</td></tr>
<tr><td><a href="<?php echo $root_url; ?>/theone.php" target="lol_main"><img src="<?php print($images_url);?>/framebot.gif" border=0></a></td></tr>
</table>
<?php 
include_once $clean_footer;
?>