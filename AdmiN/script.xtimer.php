<?php 
#!/usr/local/bin/php
validate_referer();
?>
function counter(docid,inner){

var t = document.getElementById(docid).innerHTML;

var tm=t.split("\:");
h=tm[0];
m=tm[1];
s=tm[2];

if (inner == 1) {
ss=s+(m*60)+(h*3600);

if (h>=1 && m<=0 && s<=0){
	h--;
	m=60;
}

if (m>=1 && s<=0){
	m--;
	s=60;
}

ss--;
s--;
}

if (inner == 2) {

ss=s+(m*60)+(h*3600);

if (m>=59){
	h++;
	m=0;
}

if (s>=59){
	m++;
	s=-1;
}

ss++;
s++;
}

h=""+h+"";
m=""+m+"";
s=""+s+"";

if(h.length<2 && h<10){h="0"+h;}
if(m.length<2 && m<10){m="0"+m;}
if(s.length<2 || s<10){s="0"+s;}

if (ss > 1) {
	document.getElementById(docid).innerHTML=h+":"+m+":"+s;
	setTimeout("counter(\""+docid+"\",\""+inner+"\")",999);
} else {
	document.getElementById(docid).innerHTML="00:00:00";
}

}

function scandoc(){
var pref="xxt";
for(i=1;i<=100;++i){
		var pid=pref+i;
		if (document.getElementById(pid)){
			counter(pid,1);
		}
}

var pref="zzt";
for(i=1;i<=100;++i){
		var pid=pref+i;
		if (document.getElementById(pid)){
			counter(pid,2);
		}
}
}

scandoc();