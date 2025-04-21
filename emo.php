<?
include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

$us=$row["user"];

if(!isset($go)){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"emo\" title=\"Emocije\">\n";
echo "<p>\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Emocije</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">";
echo "<form action=\"emo.php?$ses&amp;go=rew&amp;ref=$ref\" method=\"post\" title=\"Emocije\">\n";
}
echo $fsize1;
echo "<b>Napredna Podesavanja:</b><br/>";
echo $divide;
echo "<b>Glas Slova:</b><br/>";
echo $fsize2;
echo "<input name=\"avtootvet\" maxlength=\"100\" value=\"".$row["avtootvet"]."\"/><br/>";
echo $fsize1;
echo $divide;
echo "<b>Emocije:</b><br/>";
echo $fsize2;
echo "<select name=\"selemoc\">";
if($row["selemoc"]=="1") {
echo"<option value=\"1\">Ukljucene</option>";
echo"<option value=\"0\">Iskljucene</option>";
}else{
echo"<option value=\"0\">Iskljucene</option>";
echo"<option value=\"1\">Ukljucene</option>";
}
echo "</select><br/>";
echo $fsize1;
echo "<b>Licne emocije:</b><br/>";
echo $divide;
echo $fsize2;
echo "<select name=\"emocmenu\">";
if($row["emocmenu"]=="1") {
echo"<option value=\"1\">Ukljucene</option>";
echo"<option value=\"0\">Iskljucene</option>";
}else{
echo"<option value=\"0\">Iskljucene</option>";
echo"<option value=\"1\">Ukljucene</option>";
}
echo "</select><br/>";
echo $fsize1;
echo "Licna Emocija:<br/>";
echo $fsize2;
for($i = 1; $i <= 10; $i++) {
$emoc = "emoc".$i;
$emocname = $row["emoc".$i];
echo $fsize1;
echo $i.")\n";
echo $fsize2;
echo "<input name=\"$emoc\" maxlength=\"12\" value=\"$emocname\"/><br/>";
}
echo $fsize1;
echo $divide;
echo $fsize2;
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"emo.php?$ses&amp;go=rew&amp;ref=$ref\" method=\"post\">\n";
echo "<postfield name=\"avtootvet\" value=\"$(avtootvet)\"/>\n";
echo "<postfield name=\"selemoc\" value=\"$(selemoc)\"/>\n";
echo "<postfield name=\"emocmenu\" value=\"$(emocmenu)\"/>\n";
echo "<postfield name=\"emoc1\" value=\"$(emoc1)\"/>\n";
echo "<postfield name=\"emoc2\" value=\"$(emoc2)\"/>\n";
echo "<postfield name=\"emoc3\" value=\"$(emoc3)\"/>\n";
echo "<postfield name=\"emoc4\" value=\"$(emoc4)\"/>\n";
echo "<postfield name=\"emoc5\" value=\"$(emoc5)\"/>\n";
echo "<postfield name=\"emoc6\" value=\"$(emoc6)\"/>\n";
echo "<postfield name=\"emoc7\" value=\"$(emoc7)\"/>\n";
echo "<postfield name=\"emoc8\" value=\"$(emoc8)\"/>\n";
echo "<postfield name=\"emoc9\" value=\"$(emoc9)\"/>\n";
echo "<postfield name=\"emoc10\" value=\"$(emoc10)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=submit value=\"Izmeni\"/></form>\n";
}
echo $fsize1;
echo $divide;
echo "<a href=\"cabinet.php?$ses&amp;ref=$ref\">Licni Kabinet</a><br/>\n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
mysql_close ($link);
exit;
}

         $avtootvet = check($avtootvet);
		 $avtootvet = substr($avtootvet,0,100);
		 $emoc1 = check($emoc1);
         $emoc2 = check($emoc2);
         $emoc3 = check($emoc3);
         $emoc4 = check($emoc4);
         $emoc5 = check($emoc5);
         $emoc6 = check($emoc6);
		 $emoc7 = check($emoc7);
         $emoc8 = check($emoc8);
         $emoc9 = check($emoc9);
         $emoc10 = check($emoc10);

$emp="Greska!";
if(!preg_match("!^[0-9]+$!i",$emocmenu)){$error = $emp;}
elseif(!preg_match("!^[0-9]+$!i",$selemoc)){$error = $emp;}

if (!isset($error)) {
if (mysql_query ("Update users set avtootvet = '".$avtootvet."', selemoc = '".$selemoc."', emocmenu = '".$emocmenu."', emoc1 = '".$emoc1."', emoc2 = '".$emoc2."', emoc3 = '".$emoc3."', emoc4 = '".$emoc4."', emoc5 = '".$emoc5."', emoc6 = '".$emoc6."', emoc7 = '".$emoc7."', emoc8 = '".$emoc8."', emoc9 = '".$emoc9."', emoc10 = '".$emoc10."' where id ='".$id."'")){
$msg = "Vase emocije su uspesno izmenjene!";
} else {
$error = " ".mysql_error()." ";
}
}
mysql_close($link);

if (isset($error)) {
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"emo.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<do type=\"prev\" label=\"Back\"><prev/></do>\n";
echo "<p>\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Greska!!!</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=emo.php?$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "$error\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
exit;
}
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"ok\" title=\"Emocije\" ontimer=\"cabinet.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<p>\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Emocije</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=cabinet.php?$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "$msg\n";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
?>