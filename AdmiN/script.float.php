<?php 
#!/usr/local/bin/php
validate_referer();

if (empty($fx)) {
$fx=10;
}
if (empty($fy)) {
$fy=175;
}

if (preg_match("@meadow@si",$_SERVER['HTTP_REFERER']) or preg_match("@eidolon@si",$_SERVER['HTTP_REFERER']) or preg_match("@xedon@si",$_SERVER['HTTP_REFERER'])) {
$fx=3;
$fy=183;
}
?>
/*
Floating Menu script- Roy Whittle (https://javascript-fx.com/)
Script featured on/available at https://dynamicdrive.com/
This notice must stay intact for use
*/

//Enter "frombottom" or "fromtop"
var verticalpos="fromtop"

if (!document.layers)
document.write('</div>')

function JSFX_FloatTopDiv()
{
	var startX = <?php print $fx;?>;
	startY = <?php print $fy;?>;
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;
	function ml(id)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		if(d.layers)el.style=el;
		el.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el.x = startX;
		if (verticalpos=="fromtop")
		el.y = startY;
		else{
		el.y = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		el.y -= startY;
		}
		return el;
	}
	window.stayTopLeft=function()
	{
		if (verticalpos=="fromtop"){
		var pY = ns ? pageYOffset : document.body.scrollTop;
		ftlObj.y += (pY + startY - ftlObj.y)/8;
		}
		else{
		var pY = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		ftlObj.y += (pY - startY - ftlObj.y)/8;
		}
		ftlObj.sP(ftlObj.x, ftlObj.y);
		setTimeout("stayTopLeft()", 25);
	}
	ftlObj = ml("floatmenu");
	stayTopLeft();
}
JSFX_FloatTopDiv();