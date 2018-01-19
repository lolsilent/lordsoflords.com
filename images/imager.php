<?php 
#!/usr/local/bin/php
$w=468;
$h=60;

if(!empty($_GET['text'])){
$text=$_GET['text'];
header("Content-type: image/jpeg");
$im=imagecreatefromjpeg("https://lordsoflords.com/images/lol2007e.jpg");
$color=imagecolorallocate($im,255,255,255);
$px=(imagesx($im)-7.5*strlen($text))/2;
imagestring($im,3,$px,2,$text,$color);

$color = imagecolorallocate($im,rand(25,75),rand(25,75),rand(25,75));
$current_date=date('M d Y H:i:s');
imagestring($im, 5, ($w/2), $h-($h/10), "LORDSOFLORDS.COM", $color);
imagestring($im, 3, 0, $h-($h/10), $current_date, $color);



imagejpeg($im);
imagedestroy($im);
}
?>