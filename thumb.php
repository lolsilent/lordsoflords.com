<?php 
if(!empty($_GET['img']) and !empty($_GET['h']) and !empty($_GET['w'])){
require_once 'AdmiN/www.config.php';
require_once 'AdmiN/www.functions.php';
$image_path = clean_post($_GET['img']);
$image_h = clean_post($_GET['h']);
$image_w = clean_post($_GET['w']);

if(preg_match('/^http:\/\/.*?$/i',$image_path)){
# Load image
$img = null;
$ext = strtolower(end(explode('.', $image_path)));
if ($ext == 'jpg' || $ext == 'jpeg') {
 $img = @imagecreatefromjpeg($image_path);
} else if ($ext == 'png') {
 $img = @imagecreatefrompng($image_path);
# Only if your version of GD includes GIF support
} else if ($ext == 'gif') {
 $img = @imagecreatefrompng($image_path);
}

# If an image was successfully loaded, test the image for size
if ($img) {

 # Get image size and scale ratio
 $width = imagesx($img);
 $height = imagesy($img);
 $scale = min($image_w/$width, $image_h/$height);

 # If the image is larger than the max shrink it
 if ($scale < 1) {
  $new_width = floor($scale*$width);
  $new_height = floor($scale*$height);

  # Create a new temporary image
  $tmp_img = imagecreatetruecolor($new_width, $new_height);

  # Copy and resize old image into new image
  imagecopyresized($tmp_img, $img, 0, 0, 0, 0,
       $new_width, $new_height, $width, $height);
  imagedestroy($img);
  $img = $tmp_img;
 }
}

# Create error image if necessary
if (!$img) {
 $img = imagecreate($image_w, $image_h);
 imagecolorallocate($img,0,0,0);
 $c = imagecolorallocate($img,70,70,70);
 imageline($img,0,0,$image_w,$image_h,$c);
 imageline($img,$image_w,0,0,$image_h,$c);
}

# Display the image
header("Content-type: image/jpeg");
imagejpeg($img);
}
}else{header("Location: https://thesilent.com");}
?>