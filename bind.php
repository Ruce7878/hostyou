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
$bind1=$row['bind1'];
$bind2=$row['bind2'];
$bind3=$row['bind3'];
$bind4=$row['bind4'];
///////////////////////////////////////////
$gde="Podesavanja";
include("gde.php");
///////////////////////////////////////////
if(!isset($go)){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"bind\" title=\"Dugmad\">\n";
echo "<p>\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Dugmad</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">";
echo "<form method=\"POST\" action=\"bind.php?$ses&amp;go=rew&amp;ref=$ref\" name=\"auth\">\n";
}
echo $fsize1;
echo "<b>Napisi:</b><br/>";
echo $fsize2;
echo "<input size=\"1\" name=\"bind1\" maxlength=\"1\" format=\"*N\" value=\"$bind1\"/><br/>";
echo $fsize1;
echo "<b>Refresh:</b><br/>";
echo $fsize2;
echo "<input size=\"1\" name=\"bind2\" maxlength=\"1\" format=\"*N\" value=\"$bind2\"/><br/>";
echo $fsize1;
echo "<b>Istorija:</b><br/>";
echo $fsize2;
echo "<input size=\"1\" name=\"bind3\" maxlength=\"1\" format=\"*N\" value=\"$bind3\"/><br/>";
echo $fsize1;
echo "<b>Hodnik:</b><br/>";
echo $fsize2;
echo "<input size=\"1\" name=\"bind4\" maxlength=\"1\" format=\"*N\" value=\"$bind4\"/><br/>";
echo $fsize1;
echo $divide;
echo $fsize2;
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"bind.php?$ses&amp;go=rew&amp;ref=$ref\" method=\"post\">\n";
echo "<postfield name=\"bind1\" value=\"$(bind1)\"/>\n";
echo "<postfield name=\"bind2\" value=\"$(bind2)\"/>\n";
echo "<postfield name=\"bind3\" value=\"$(bind3)\"/>\n";
echo "<postfield name=\"bind4\" value=\"$(bind4)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo "<br/>\n";
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
         if (!ctype_digit($bind1)) { header("Location: index.php"); die; }
		 if (!ctype_digit($bind2)) { header("Location: index.php"); die; }
		 if (!ctype_digit($bind3)) { header("Location: index.php"); die; }
		 if (!ctype_digit($bind4)) { header("Location: index.php"); die; }
	     if (!isset($error)) {$result = mysql_query ("Select * users where id = '".$id."'");
         if (mysql_affected_rows() == 0) {$error = "database error...";
         }else{
$ins_str = "Update users set bind1 = '".$bind1."',bind2 = '".$bind2."',bind3 = '".$bind3."',bind4 = '".$bind4."' where id ='".$id."'";
         }
if (mysql_query ($ins_str)) {
$msg = "Podesavanje dugmadi je izmenjeno!";
}else{
$error = " ".mysql_error()." ";
}
}
mysql_close($link);

if (isset($error)) {
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"bind.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<do type=\"prev\" label=\"Back\"><prev/></do>\n";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Greska!!!</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=bind.php?$ses&amp;ref=$ref\">";
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
echo "<card id=\"ok\" title=\"Dugmad\" ontimer=\"cabinet.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Dugmad</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=cabinet.php?$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "$msg\n";
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
?>