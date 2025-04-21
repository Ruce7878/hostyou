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
$gde="Inbox";
include("gde.php");
///////////////////////////////////////////
switch($mod) {
case 'delall':
if (isset($go)){

if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"deleted\" title=\"Pisma\" ontimer=\"chatmail.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Pisma</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=chatmail.php?$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Sva Vasa pisma su obrisana!\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
mysql_close ($link);
exit;
}
if (!ctype_digit($im)) { header("Location: index.php"); die; }
$r = mysql_query ("Select idtowhom,idwho from zapiski WHERE klu4 = '".$im."' ");
$a = mysql_fetch_array($r);
if ((mysql_affected_rows() != 0)&&(($a["idtowhom"]==$id)||($a["idwho"]==$id))){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
if (isset($ininc)) echo "<card id=\"deleted\" title=\"Pisma\" ontimer=\"inbox.php?s=$s&amp;$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
else echo "<card id=\"deleted\" title=\"Pisma\" ontimer=\"outbox.php?s=$s&amp;$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Pisma</title>";
if (isset($ininc)) echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=inbox.php?s=$s&amp;$ses&amp;ref=$ref\">";
else echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=outbox.php?s=$s&amp;$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Pismo je uspesno obrisano!\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
mysql_close ($link);
} else {
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"chatmail.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Greska!!!</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=chatmail.php?$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Greska!!!";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
mysql_close ($link);
}
break;

case 'delusermsg':
settype($usid, 'integer');
$select = mysql_query ("select id,user from users where id = '".$usid."'");
$rows = mysql_fetch_array ($select);
$user = $rows["user"];

if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
if (isset($ininc)) echo "<card id=\"deleted\" title=\"Obrisano\" ontimer=\"inbox.php?s=$s&amp;$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
else echo "<card id=\"deleted\" title=\"Obrisano\" ontimer=\"outbox.php?s=$s&amp;$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Obrisano</title>";
if (isset($ininc)) echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=inbox.php?s=$s&amp;$ses&amp;ref=$ref\">";
else echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=outbox.php?s=$s&amp;$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Sva Vasa pisma od <b>".$user."</b> su obrisana!\n";
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
break;
}
?>