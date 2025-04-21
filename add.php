<?php
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
if(isset($HTTP_GET_VARS['rm'])) {$rm = $HTTP_GET_VARS['rm'];}
if (!ctype_digit($rm)) { header("Location: index.php"); die; }
$rm = mysql_escape_string($rm);

if($rm==10) $takep="&amp;ref=$ref&amp;pwd=$pwd";
else $takep="&amp;ref=$ref";

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Napisi</title>";
echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache\"/>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
echo "<form method=\"post\" action=\"chat.php?$ses&amp;rm=$rm$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Pre nego sto napises nesto ukljuci mozak:<img src='smilies/618-95625.gif'> <br/>\n";

echo $fsize2;
echo "<input type=\"text\" name=\"$ref\" maxlength=\"300\" value=\"\"/><br/>";
echo "<input type=\"hidden\" name=\"ssseee\" value=\"$ref\"/>\n";
if ($rm!=23){
if ($row["level"]>=4){
echo $fsize1;
echo "Izgled:<br/>\n";
echo $fsize2;
echo "<select name=\"shrift\">\n";
echo "<option value=\"0\">Normalno</option>\n";
echo "<option value=\"1\">Iskoseno</option>\n";
}
if ($row["level"]>=4) {echo "<option value=\"2\">Podvuceno</option>\n";}
if ($row["level"]>=4) {echo "<option value=\"3\">Iskoseno/Podvuceno</option>\n";}
if ($row["level"]>=7) {echo "<option value=\"4\">Podebljano</option>\n";}
if ($row["level"]>=7) {echo "<option value=\"5\">Podebljano/Podvuceno</option>\n";}
if ($row["level"]>=7) {echo "<option value=\"6\">Veliko</option>\n";}
if ($row["level"]>=4) {echo "</select><br/>\n";}
}
if ($ver == "xhtml") {
echo '<select name="cveti_shrift">
<option value="0">Bez Boje</option>
<option value="1">Crna</option>
<option value="2">Plava</option>
<option value="3">Crvena</option>
<option value="5">Svetlo Zelena</option>
<option value="6">Sveto Plava</option>
<option value="7">Zelena</option>
<option value="8">Siva</option>
<option value="9">Roza</option>
<option value="10">Ljubicasta</option>
<option value="11">Zuta</option>
<option value="13">Bela</option>
<option value="14">Braon</option>
</select><br/>';
}

////////////////////////////YouTube Pocetak///////////////////////////////////////////////////////////////////////////
$posts = mysql_fetch_array(mysql_query("SELECT id, posts FROM `users` WHERE id='".$id."'"));
if ($ver == "xhtml") {
//echo "Youtube:<br/>\n";
echo '<select name="youtube">
<option value="0">Youtube</option>
<option value="1">Dodaj Youtube</option>
</select><br/>';
}
/////////////////////////////YouTube Kraj//////////////////////////////////////////////////////////////////////////

echo "<input type=\"submit\" value=\"Napisi\" name=\"enter\"/></form>\n";
echo $divide;
if ($rm==23) echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\" title=\"Nazad\"><input type=\"submit\" value=\"Nazad\"/></a>";
else echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\" title=\"Chat meni\"><input type=\"submit\" value=\"Chat Soba\"/></a>";
if($ggggg=="1"){
include("gzip.php");
}
echo "</div>";
echo "</body>\n";
echo "</html>\n";
mysql_close ($link);
ob_end_flush();
?>