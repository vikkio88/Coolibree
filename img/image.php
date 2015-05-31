<?php

//this script will create a captcha image with some variable taken "here and there" (<- muahahua)
session_start();
$uno= $_SERVER['REMOTE_ADDR'];
$due= $_SERVER['HTTP_USER_AGENT'];
$tre=microtime().time();
$tre.=$tre.$due.$uno;
$tre=md5($tre);
$code=substr($tre,0,5);

$salt="salt";//this salt must beh the same than ../comment.php script

$hash1 = md5($salt.$code);

setcookie("capt", $hash1, time()+1000, "/"/*, ".server"*/);
//$_SESSION['capt'] = $hash1;

$im = imagecreate(140, 30);
$bg = imagecolorallocate($im, 35, 30, 30);

$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
$font = './vanish.ttf';
$textcolor = imagecolorallocate($im, 0, 100, 255);
// Add some shadow to the text
imagettftext($im, 24, 0, 15, 24, $grey, $font, $code);
imagettftext($im, 23, 0, 17, 22, $grey, $font, $code);

// Add the text
imagettftext($im, 24, 0, 18, 26, $black, $font, $code);





//imagestring($im, 5, 20, 10, $code, $textcolor);
// output the image
header("Content-type: image/jpeg");
imagejpeg($im);
?>
