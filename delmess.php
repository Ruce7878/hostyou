<?
include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

if($row["level"] < 4){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\">\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Greska!!!</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Nemate prava pristupa!\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
exit;
}
///////////////////////////////////////////
$gde="Mod CP";
include("gde.php");
///////////////////////////////////////////
if($rm==10) $takep="&amp;ref=$ref&amp;pwd=$pwd";
else $takep="&amp;ref=$ref";

$room="room".$rm;
/////////////////////////////////////////////////////////////////////
$soba = mysql_fetch_array(mysql_query("SELECT rm,name FROM rooms WHERE rm='".$rm."'"));
$nik = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$poruka = mysql_fetch_array(mysql_query("SELECT message FROM $room WHERE klu4 = '".$klu4."'"));
$text="$nik[0] je obrisao post: <u>$poruka[0]</u> u sobi: <b>$soba[1]</b>";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='7'");
/////////////////////////////////////////////////////////////////////
settype($klu4, 'integer');
if(mysql_query("delete from $room WHERE klu4 = '".$klu4."'")){
$msg = "Poruka je uspesno obrisana!";
} else {
$msg = "Greska!!!";
}
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"deleted\" title=\"Obrisano\" ontimer=\"chat.php?$ses&amp;rm=$rm$takep\"><timer value=\"10\"/>\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Obrisano</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=chat.php?$ses&amp;rm=$rm$takep\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "$msg\n";
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
?>