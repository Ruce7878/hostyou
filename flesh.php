<?php  include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
///////////////////////////////////////////
$gde="Flesh igrice";
include("gde.php");
///////////////////////////////////////////
if ($ver=="wml"){
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">\n";
echo "<wml>\n<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/>\n";
echo "<meta http-equiv=\"Pragma\" content=\"no-cache\"/></head>\n";
echo "<card id=\"x\" title=\"Online Igrice\">\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Online Igrice</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
print $fsize1;
echo "<b>Uskoro jos igrica!!!</b><br/><br/>";
//echo "<a href=\"pos.php?$ses&amp;ref=$ref&amp;rm=$rm\"><b><i>**Sobe sa Igrama**</i></b></a><br/>";
//echo "<a href=\"digitron.php?$ses&amp;ref=$ref&amp;rm=$rm\">Ljubavni Digitron</a><br/>";
//echo "<a href=\"games.php?$ses&amp;ref=$ref&amp;rm=$rm\">Pogodi Broj</a><br/>";
//echo "<a href=\"jackpot.php?$ses&amp;ref=$ref&amp;rm=$rm\">Jack Pot</a><br/>";
//echo "<a href=\"milioner.php?$ses&amp;ref=$ref&amp;rm=$rm\">Milioner Kviz</a><br/>";
//echo "<a href=\"kockice.php?$ses&amp;ref=$ref&amp;rm=$rm\">Kockice</a><br/>";
//echo "<a href=\"sibice.php?$ses&amp;ref=$ref&amp;rm=$rm\">Sibicarenje</a><br/>";
//echo "<a href=\"hat.php?go=pocetak&amp;$ses&amp;ref=$ref\">Harry Potter Kapa</a><br/>";
//echo "<a href=\"plemena/index.php?action=main&amp;$ses&amp;ref=$ref\"> Rat Plemena Version 2.0. </a><br/>";
//echo "<a href=\"nfs.php?action=meni&amp;$ses&amp;ref=$ref\"> Need For Speed</a><br/>";
echo "<a href=\"racer.php?action=main&amp;$ses&amp;ref=$ref\">Coaster racer</a><br/>";
echo "<a href=\"duskdrive.php?action=main&amp;$ses&amp;ref=$ref\">Dusk drive</a><br/>";
print $divide;
if(isset($rm) && $rm!=""){
print "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">chat soba</a><br/>";
}
print "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
print $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>