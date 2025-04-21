<?
include("gz.php");
header("Cache-Control: no-cache");
header("Content-type:text/vnd.wap.wml; charset=utf-8");
require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);

echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"statistik\" title=\"Dodaj Stihove\">\n";
echo "<p align=\"center\">\n";

switch($mod) {

case 'addanekdot':
if ($row["translit"]==1)$anek = trun_to_rus($anek);
## Антифлуд ##
$r6 = mysql_query("SELECT message FROM anekdot WHERE who = '".$us."' order by klu4 desc LIMIT 1");
$a6 = mysql_fetch_array($r6);
## Автоантифлуд ##
///Проверка на антифлуд в файле//
if ($anek=="") {
echo $fsize1;
echo "Stihovi!<br/>\n";
echo "Sve stihove pregledaju Moderatori!<br/>\n";
echo $fsize2;
break;}
if ($anek==" ") {
echo $fsize1;
echo "Stihovi!<br/>\n";
echo "Sve stihove pregledaju Moderatori!<br/>\n";
echo $fsize2;
break;}
if ($anek=="  ") {
echo $fsize1;
echo "Stihovi!<br/>\n";
echo "Sve stihove pregledaju Moderatori!<br/>\n";
echo $fsize2;
break;}
if (file_exists("anekdotus/anekdotus.txt")) {
$filea=file("anekdotus/anekdotus.txt");
for($i=0;$i<count($filea);$i++) {
$arana=explode("::",$filea[$i]);
if ($anek==trim($arana[0])) {
echo $fsize1;
echo "Ovakav stih vec postoji u bazi!<br/>\n";
echo $divide;
if ((isset($rm))&&($rm!="")&&(!isset($pwd))){
echo "<a href=\"chat.php?id=$id&amp;ps=$ps&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>\n";
}else{
if($mod) echo "<a href=\"addanekdot.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Dodaj Jos</a><br/>\n";
}
echo "<a href=\"enter.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Hodnik</a><br/>\n";
echo $fsize2;
echo "</p></card></wml>";
mysql_close ($link);
exit;
}
}
}
/////////////////////////////////
if ($a6["message"] == $anek){
echo $fsize1;
echo "Ovakav stih vec postoji u bazi!<br/>\n";
echo $fsize2;
}else{
$msg = $anek;
if ($row["level"]<5) require("antirekl.php");
$anek = str_replace(chr("13"), " ", $anek);
$anek = str_replace(chr("10"), " ", $anek);
$anek = trim(" $anek ");
$anek = ereg_replace(" +"," ",$anek);
$anek=substr($anek,0,10000);
$anek = str_replace("\n", " ", $anek);
$anek = str_replace("$", "$$", $anek);
$anek = str_replace("", "", $anek);
$anek = str_replace("", "", $anek);
$anek = str_replace("", "", $anek);
$anek = str_replace("", "", $anek);
$anek = str_replace("", "", $anek);
$anek = str_replace("", "", $anek);
$anek = HtmlSpecialChars($anek);
$anek=addslashes($anek);
$open=fopen("anekdotus/anekdotus.txt","a+");
flock ($open,LOCK_EX);
fwrite($open,"$anek::$id\n");
fflush($open);
flock ($open,LOCK_UN);
fclose($open);
echo $fsize1;
echo "<u>Stih je uspesno dodat!</u><br/>\n";
echo "Posle provere od strane Moderatora bice na Chatu!<br/><br/>\n";
echo $fsize2;
}
break;


default:
echo $fsize1;
echo "Ostavite svoj trag! Dodajte Stih!<br/><br/>\n";
echo "Pre objavljivanja svi stihovi ce biti pregledani!<br/><br/>\n";
echo "Stih:<br/>\n";
echo $fsize2;
echo "<input name=\"anek\" maxlength=\"2500\" title=\"quest\"/><br/>\n";
echo $fsize1;
echo $fsize2;
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"addanekdot.php?mod=addanekdot&amp;id=$id&amp;ps=$ps&amp;ref=$ref\" method=\"post\">\n";
echo "<postfield name=\"anek\" value=\"$(anek)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/><br/>\n";
break;
}

echo $fsize1;
if ((isset($rm))&&($rm!="")&&(!isset($pwd))){
echo "<a href=\"chat.php?id=$id&amp;ps=$ps&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>\n";
}else{
if($mod) echo "<a href=\"addanekdot.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Dodaj Jos</a><br/>\n";
}
echo "<a href=\"enter.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Hodnik</a><br/>\n";
echo $fsize2;
include("gzip.php");
echo "</p></card></wml>";
mysql_close ($link);
?>