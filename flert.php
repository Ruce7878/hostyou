<?
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
echo "<wml>";
echo "<card id=\"profile\" title=\"Flert\">\n";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head>";
if($row["css"]!=""){
$csss=$row["css"];
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$csss\"/>";
}else{
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
}
echo "<title>Flert</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
{$select = @mysql_query ("Select * from users where id='".$nk."'");
echo $fsize1;
echo "Pozovi na kaficu!? [<a href=\"flertw.php?$ses&amp;ref=$ref&amp;who=$nk&amp;mod=kafa\">Pozovi</a>] <img src=\"/flertt/pozivzakafu.gif\" alt=\"icon\" /><br/>\n";
echo "Pozovi na klopu!? [<a href=\"flertw.php?$ses&amp;ref=$ref&amp;who=$nk&amp;mod=klopa\">Pozovi</a>] <img src=\"/flertt/pozivzaklopu.gif\" alt=\"icon\" /><br/>\n";
echo "Poljubi me! [<a href=\"flertw.php?$ses&amp;ref=$ref&amp;who=$nk&amp;mod=poljubac\">Poljubi</a>] <img src=\"/flertt/kiss.gif\" alt=\"icon\" /><br/>\n";
echo "Izjavi ljubav! [<a href=\"flertw.php?$ses&amp;ref=$ref&amp;who=$nk&amp;mod=ljubav\">Izjavi</a>] <img src=\"/flertt/ljubav.gif\" alt=\"icon\" /><br/>\n";
echo "Pozovi na sex!? [<a href=\"flertw.php?$ses&amp;ref=$ref&amp;who=$nk&amp;mod=sex\">Pozovi</a>] <img src=\"/flertt/jebb.gif\" alt=\"icon\" /><br/>\n";
echo "Pozovi na pice! [<a href=\"flertw.php?$ses&amp;ref=$ref&amp;who=$nk&amp;mod=pivo\">Pozovi</a>] <img src=\"/flertt/pice.jpg\" alt=\"icon\" /><br/>\n";
echo "Banuj clana! [<a href=\"flertw.php?$ses&amp;ref=$ref&amp;who=$nk&amp;mod=ban\">Banuj</a>] <img src=\"/flertt/ban.png\" alt=\"icon\" /><br/>\n";
echo "Shokiraj clana! [<a href=\"flertw.php?$ses&amp;ref=$ref&amp;who=$nk&amp;mod=shok\">Shokiraj</a>] <img src=\"/flertt/shok.png\" alt=\"icon\" /><br/>\n";
echo $divide;
echo "<div class=\"d1\">";
echo "<br/><a href=\"enter.php?$ses$takep\">Hodnik</a><br/>\n";
echo "</div>";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else if ($ver=="xhtml") echo "</div></body></html>";
mysql_close ($link);
exit;
}
?>