<?php 
#!/usr/local/bin/php
validate_referer();
?>
function resourcer(xdocid){

var t = document.getElementById(xdocid).innerHTML;
var xdocidv = xdocid+"r";

if (document.getElementById(xdocidv)){
var s = document.getElementById(xdocidv).value;
t = t.replace(/[^0-9]/g, "");
s = s.replace(/[^0-9]/g, "");

a = t-s;

a=addCommas(a);


//document.getElementById(xdocid).innerHTML=t+" "+s+" "+a;
document.getElementById(xdocid).innerHTML=a;
}
}

function addCommas(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}



function scanres(){
var xpref="xxr";
for(i=1;i<=100;++i){
		var xpid=xpref+i;
		if (document.getElementById(xpid)){
			resourcer(xpid);
		}
}
}

scanres();