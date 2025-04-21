<?php
header("Content-type: image/gif");
$image=$_GET["image"];
if(!$image){$resize = imagecreatefromgif("author.gif");}
else {
###########################################
#                                         #
#  Image resize script                    #
#  Author:                                #
#  Miladinovic aka MASTERKLAN             #
#  email: miladinovic87@gmail.com         #
#  wap site:  http://wapx.biz             #
#                                         #
###########################################

/////////////// SCRIPT SETTINGS START ////////////
////Image height i set it up to 60 pixels
$resheight = 100;
/////////////// SCRIPT SETTINGS END   ////////////


$rever=strrev($image);
$prv=explode(".", $rever);
$extension=strrev($prv[0]);
$smallext=strtolower($extension);
$size = GetImageSize($image);
$imawidth = $size[0];
$imaheight = $size[1];

if($smallext=="gif")
 {
 $back = imagecreatefromgif("$image");
 }
if($smallext=="jpeg")
 {
 $back = imagecreatefromjpeg("$image");
 }
if($smallext=="jpg")
 {
 $back = imagecreatefromjpeg("$image");
 }
if($smallext=="png")
 {
 $back = imagecreatefrompng("$image");
 }

if($imaheight<=$resheight)
 {
 $resize=$back;
 }

if($imaheight>$resheight)
 {
 $sizey=$resheight; $sizex=$resheight*$imawidth/$imaheight;
 $resize=ImageCreateTrueColor($sizex,$sizey);
 imagecopyresized($resize, $back, 0, 0, 0, 0, $sizex, $sizey, $imawidth, $imaheight);
 }
 }
imagegif($resize);
imagedestroy($resize);
?>