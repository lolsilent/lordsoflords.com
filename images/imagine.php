<?php 
if(!empty($_GET['w'])){$w=$_GET['w'];if($w>=1000){$w=50;}}else{$w=100;}
if(!empty($_GET['h'])){$h=$_GET['h'];if($h>=1000){$h=50;}}else{$h=100;}

header ("Content-type: image/png");
$image = @imagecreatetruecolor($w, $h);
$color = imagecolorallocate($image,rand(25,75),rand(25,75),rand(25,75));
$current_date=date('M d Y H:i:s');
imagestringup($image, 5, ($w/2), $h-($h/10), "LORDSOFLORDS.COM", $color);
imagestringup($image, 3, 0, $h-($h/10), $current_date, $color);

for($i=(($w+$h)/15);$i<=(($w+$h)/10);$i++){
$color = imagecolorallocate($image,rand(25,100),rand(25,100),rand(25,100));
imagerectangle($image,rand($w/10,$w/1.1),rand($h/10,$h/1.1),rand($w/10,$w/1.1),rand($h/10,$h/1.1),$color);
}

imagepng($image);
imagedestroy($image);
?>