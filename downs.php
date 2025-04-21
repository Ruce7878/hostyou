<?php
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
$ggggg=$row["gzip"];
if($ggggg=="1"){
include("gz.php");
}

$clanski = mysql_fetch_array(mysql_query("SELECT id, posts FROM `users` WHERE id='".$id."'"));
if($clanski[1]<'200'){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>";
echo "<card id=\"vypnut\" title=\"Upozorenje\" ontimer=\"index.php?ref=$ref\"><timer value=\"300\"/>";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Upozorenje</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;

echo "Nemate pravo pristupa! Vi mozete pristupiti samo u sobicu!<br/>";
echo "<b><a href=\"chat.php?$ses&amp;rm=9&amp;ref=$ref\">Sobica za prijem</a></b><br/>";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
exit;
}

if ($ver=="wml"){
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">\n";
echo "<wml>\n<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/>\n";
echo "<meta http-equiv=\"Pragma\" content=\"no-cache\"/></head>\n";
echo "<card id=\"x\" title=\"Download Kategorije\">\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Download Kategorije</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
print $fsize1;
echo"<div class = 'd1'><b>Download Kategorije</b></div><br/>";
$broj = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM downs WHERE tip='1'"));
echo "<img src=\"smile/jar.gif\" alt=\"\"/><a href=\"downs1.php?$ses&amp;ref=$ref&amp;tip=1&amp;rm=$rm\"> Java Aplikacije($broj[0])</a><br/>";

$broj = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM downs WHERE tip='2'"));
echo "<img src=\"smile/simb.gif\" alt=\"\"/><a href=\"downs1.php?$ses&amp;ref=$ref&amp;tip=2&amp;rm=$rm\"> Symbian Aplikacije($broj[0])</a><br/>";

$broj = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM downs WHERE tip='3'"));
echo "<img src=\"smile/music.png\" alt=\"\"/><a href=\"downs1.php?$ses&amp;ref=$ref&amp;tip=3&amp;rm=$rm\"> Mp3 Muzika($broj[0])</a><br/>";

$broj = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM downs WHERE tip='4'"));
echo "<img src=\"smile/3gp.gif\" alt=\"\"/><a href=\"downs1.php?$ses&amp;ref=$ref&amp;tip=4&amp;rm=$rm\">3gp Video($broj[0])</a><br/>";

$broj = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM downs WHERE tip='5'"));
echo "<img src=\"smile/pics.gif\" alt=\"\"/><a href=\"downs1.php?$ses&amp;ref=$ref&amp;tip=5&amp;rm=$rm\"> Slicice($broj[0])</a><br/><br/>";

$files = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM downs"));
echo "<b>Ukupno ($files[0]) Fajle</b><br/>";
print $fsize2;
echo "<div class=\"d1\">";
echo $fsize1;
if($row["level"]>7){
print "<a href=\"duploads.php?action=uploader&amp;$ses&amp;rm=$rm&amp;ref=$ref\">Uploaduj Fajlove</a><br/>";
}
if(isset($rm) && $rm!=""){
print "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>";
}
print "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
print $fsize2;
echo "</div>";
print $fsize1;
print $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
echo "<br/>";
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>