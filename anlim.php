<?
include("gz.php");

header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");


if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"stop\" title=\"Ludara\">\n";
echo "<p align =\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Ludara</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<b>Paznja!</b><br/><br/>\n";
echo "U ovoj sobi moderatori ne mogu banovati ili kickovati clanove!<br/>\n";
echo "Administracija ne snosi nikakvu odgovornost za desavanja u ovoj sobi!<br/>\n";
echo "Ne preporucujemo ulazak ljudima sa slabijim nervima!<br/><br/>\n";
echo "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Ulaz</a><br/>\n";
echo "ili<br/>\n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush();
?>