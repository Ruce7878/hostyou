<?
include("gz.php");
header("Cache-Control: no-cache");
header("Content-type:text/vnd.wap.wml; charset=utf-8");
@$protected = $us.$ps.$trun;
if (eregi("'",$protected)) { header("Location: errors.wml"); die; }/// armada protected
require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);

if($row["level"] < 7) {
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"index.php?ref=$ref\"><timer value=\"30\"/>\n";
echo "<p align=\"center\">\n";
echo $fsize1;
echo "Nemate prava pristupa!\n";
echo $fsize2;
echo "</p>\n";
echo "</card>\n";
echo "</wml>\n";
mysql_close ($link);
exit;
}

echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"statistik\" title=\"$nazivsajta\">\n";
echo "<p align=\"center\">";

switch($mod) {


default:
if (file_exists("anekdotus/anekdotus.txt")) {
echo "<small><u>Pesme su na uredjivanju!</u><br/>--==--</small>\n";
echo "</p><p align=\"left\">";
$file=file("anekdotus/anekdotus.txt");
for($i=0;$i<count($file);$i++) {
echo "[<a href=\"anekuslist.php?mod=delstrok&amp;id=$id&amp;ps=$ps&amp;in=$i&amp;ref=$ref\">pokusava</a>]&#187;".$file[$i]."<br/>\n";
}
echo "</p><p align=\"center\">";
break;
}
else {
echo "Nema Pesama!<br/>\n";
break;
}

case 'delstrok':
if (file_exists("anekdotus/anekdotus.txt")) {
if (file_exists("anekdotus/anekdotus2.txt")) {
unlink ("anekdotus/anekdotus2.txt");
}
$file=file("anekdotus/anekdotus.txt");
for($i=0;$i<count($file);$i++) {

if ($i!=$in) { $line=$file[$i];

@$open=fopen("anekdotus/anekdotus2.txt","a+");
@flock ($open,LOCK_EX);
@fwrite($open,"$line");
@fflush($open);
@flock ($open,LOCK_UN);
}
}
@fclose($open);
@unlink ("anekdotus/anekdotus.txt");
@copy ("anekdotus/anekdotus2.txt", "anekdotus/anekdotus.txt");
echo "Pesma uspesno obrisana!<br/>\n";
echo "-~-<br/><a href=\"anekuslist.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Lista</a><br/>\n";
break;
} else {
echo "Nema vise pesama!<br/>\n";
break;
}


case 'delanek':
if (file_exists("anekdotus/anekdotus.txt")) {
unlink ("anekdotus/anekdotus.txt");
echo "Obrisano!<br/>\n";
break;
} else {
echo "Obrisano!<br/>\n";
break;
}

}

echo $fsize1;
echo $divide;
echo "<a href=\"addanekdot.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Dodaj Pesmu</a><br/>\n";
///echo "<a href=\"anekdotus/indexus.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Залить анекдоты в БД</a><br/>\n";
echo "<a href=\"anekuslist.php?mod=delanek&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">Obrisi</a><br/>\n";
echo "<a href=\"apanel.php?id=$id&amp;ps=$ps&amp;ref=$ref\">AdminCP</a><br/>\n";
echo "<a href=\"enter.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
include("gzip.php");
echo "</p></card></wml>";
mysql_close ($link);
?>