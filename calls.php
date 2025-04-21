<?
include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

if($go==""){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"calls\" title=\"Poziv\">\n";
echo "<p>\n";
echo $fsize1;
echo "Unesite broj:<br/>\n";
echo "+\n";
echo $fsize2;
echo "<input name=\"number\" maxlength=\"15\" format=\"*N\"/><br/>\n";
echo $fsize1;
echo "<anchor>Pozovite<go href=\"calls.php?go=ok&amp;$ses&amp;ref=$ref\" method=\"post\">\n";
echo "<postfield name=\"number\" value=\"$(number)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
echo $fsize1;
echo $divide;
echo "<a href=\"cabinet.php?$ses&amp;ref=$ref\">Licni Kabinet</a><br/>\n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
echo "</p>\n";
echo "</card>\n";
echo "</wml>\n";
mysql_close ($link);
exit;
}

if($go=="ok") {
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"ok\" title=\"Pozovi\">\n";
echo "<p>\n";
echo $fsize1;
echo "<b><a href=\"wtai://wp/mc;+$number\">Pozovi(+$number)</a></b><br/>";
echo $divide;
echo "<a href=\"cabinet.php?$ses&amp;ref=$ref\">Licni Kabinet</a><br/>\n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
include("gzip.php");
echo "</p>\n";
echo "</card>\n";
echo "</wml>\n";
mysql_close ($link);
exit;
}
?>