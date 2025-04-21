<?
include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
///////////////////////////////////////////
$gde="Flash games -dusk drive";
include("gde.php");
///////////////////////////////////////////
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"enter\" title=\"Flash games\">";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Flash games</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<div class=\"d1\">";
echo $fsize1;
echo "<div class=\"d1\">";
echo "<b><u>Dusk drive</u></b><br/>";
echo "</div>";
?>
<embed width="800" height="512" base="http://external.kongregate-games.com/gamez/0022/3733/live/" src="http://external.kongregate-games.com/gamez/0022/3733/live/embeddable_223733.swf" type="application/x-shockwave-flash"></embed><br/>
<?
echo "<div class=\"d1\">";
echo "<b><u>Besplatne flesh igrice -chetujte i igrajte se-prilagođeno za računare</u></b><br/>";
echo "</div>";
echo $fsize2;
echo "</div>";
echo $fsize1;
echo "<div class=\"d1\">";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a> |";
echo "<a href=\"flesh.php?$ses&amp;ref=$ref\">Flesh igrice</a>";
echo "</div>";
echo $fsize2;
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
?>