<?

header("Cache-Control: no-cache");
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
///////////////////////////////////////////
$gde="Podesavanja";
include("gde.php");
///////////////////////////////////////////
$us=$row["user"];

if(!isset($go)){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"change\" title=\"Podesavanja\">\n";
echo "<p>\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Podesavanja</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">";
echo "<form method=\"POST\" action=\"change.php?$ses&amp;go=rew&amp;ref=$ref\" name=\"auth\">\n";
}
echo $fsize1;
echo "Refresh:<br/>\n";
echo $fsize2;
echo "<select name=\"avr\">\n";
if($row["avr"] === "100")
{
echo "<option value=\"100\">10</option>\n";
}
elseif($row["avr"] === "150")
{
echo "<option value=\"150\">15</option>\n";
}
elseif($row["avr"] === "200")
{
echo "<option value=\"200\">20</option>\n";
}
elseif($row["avr"] === "250")
{
echo "<option value=\"250\">25</option>\n";
}
elseif($row["avr"] === "300")
{
echo "<option value=\"300\">30</option>\n";
}
elseif($row["avr"] === 0) echo "<option value=\"0\">0</option>\n";
echo "<option value=\"0\">0</option>\n";
echo "<option value=\"100\">10</option>\n";
echo "<option value=\"150\">15</option>\n";
echo "<option value=\"200\">20</option>\n";
echo "<option value=\"250\">25</option>\n";
echo "<option value=\"300\">30</option>\n";
echo "</select><br/>\n";
echo $fsize1;
echo "Poruka po strani:<br/>\n";
echo $fsize2;
echo "<select name=\"max\">\n";
if($row["max"] === "5")
{
echo "<option value=\"5\">5</option>\n";
}
elseif($row["max"] === "8")
{
echo "<option value=\"8\">8</option>\n";
}
elseif($row["max"] === "10")
{
echo "<option value=\"10\">10</option>\n";
}
elseif($row["max"] === "12")
{
echo "<option value=\"12\">12</option>\n";
}
elseif($row["max"] === "15")
{
echo "<option value=\"15\">15</option>\n";
}
elseif($row["max"] === "20")
{
echo "<option value=\"20\">20</option>\n";
}
elseif($row["max"] === "25")
{
echo "<option value=\"25\">25</option>\n";
}
elseif($row["max"] === "30")
{
echo "<option value=\"30\">30</option>\n";
}
echo "<option value=\"5\">5</option>\n";
echo "<option value=\"8\">8</option>\n";
echo "<option value=\"10\">10</option>\n";
echo "<option value=\"12\">12</option>\n";
echo "<option value=\"15\">15</option>\n";
echo "<option value=\"20\">20</option>\n";
echo "<option value=\"25\">25</option>\n";
echo "<option value=\"30\">30</option>\n";
echo "</select><br/>\n";
if($row["posts"] >= "25000") {
echo $fsize1;
echo "<u>Ne vidljivost:</u><br/>\n";
echo $fsize2;
echo "<select name=\"invis\">\n";
if ($row["inv"] == 0)echo "<option value=\"0\">Isklj. Nevidljivost</option>\n";
elseif ($row["inv"] == 1)echo "<option value=\"1\">Uklj. Nevidljivost</option>\n";
if ($row["inv"]!=0) echo "<option value=\"0\">Isklj. Nevidljivost</option>\n";
if ($row["inv"]!=1) echo "<option value=\"1\">Uklj. Nevidljivost</option>\n";
echo "</select><br/>\n";
}
echo $fsize1;
echo "Profil u upoznavanjima:<br/>\n";
echo $fsize2;
echo "<select name=\"znak\">\n";
if ($row["znak"]==0){
echo "<option value=\"0\">Ne</option>\n";
echo "<option value=\"1\">Da</option>\n";
}else{                  
echo "<option value=\"1\">Da</option>\n";
echo "<option value=\"0\">Ne</option>\n"; 
}
echo "</select><br/>\n";
echo $fsize1;
echo "Pisi na:<br/>\n";
echo $fsize2;
echo "<select name=\"say\">\n";
if ($row["say"]==1){
echo "<option value=\"1\">Privatno</option>\n";
echo "<option value=\"0\">Javno</option>\n";
} else {
echo "<option value=\"0\">Javno</option>\n";
echo "<option value=\"1\">Privatno</option>\n";
}
echo "</select><br/>\n";
/*if($row["level"]>8) {
echo $fsize1;
echo "PWT CITAC:<br/>\n";
echo $fsize2;
echo "<select name=\"pwtread\">\n";
if ($row["pwtread"]==0){
echo "<option value=\"0\">Iskljuci</option>\n";
echo "<option value=\"1\">Ukljuci</option>\n";
}else{                  
echo "<option value=\"1\">Ukljuci</option>\n";
echo "<option value=\"0\">Iskljuci</option>\n"; 
}
}
echo "</select><br/>\n";*/
echo $fsize1;
echo "Smajliji:<br/>\n";
echo $fsize2;
echo "<select name=\"smls\">\n";
if ($row["smiles"]==0){
echo "<option value=\"0\">Bez Smajlija</option>\n";
echo "<option value=\"2\">Ukljuceni</option>\n";
}else{
echo "<option value=\"2\">Ukljuceni</option>\n";
echo "<option value=\"0\">Bez Smajlija</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Zastita:<br/>\n";
echo $fsize2;
echo "<select name=\"safe\">\n";
if ($row["safe"]==1){
echo "<option value=\"1\">Samo Obavestenje</option>\n";
echo "<option value=\"2\">Ukljuci(Browser)</option>\n";
echo "<option value=\"3\">Ukljuci(Browser+IP)</option>\n";
echo "<option value=\"0\">Iskljucena</option>\n";
}else if ($row["safe"]==2){
echo "<option value=\"2\">Ukljuci(Browser)</option>\n";
echo "<option value=\"3\">Ukljuci(Browser+IP)</option>\n";
echo "<option value=\"1\">Samo Obavestenje</option>\n";
echo "<option value=\"0\">Iskljucena</option>\n";
}else if ($row["safe"]==3){
echo "<option value=\"3\">Ukljuci(Browser+IP)</option>\n";
echo "<option value=\"2\">Ukljuci(Browser)</option>\n";
echo "<option value=\"1\">Samo Obavestenje</option>\n";
echo "<option value=\"0\">Iskljucena</option>\n";
}else{
echo "<option value=\"0\">Iskljucena</option>\n";
echo "<option value=\"1\">Samo Obavestenje</option>\n";
echo "<option value=\"2\">Ukljuci(Browser)</option>\n";
echo "<option value=\"3\">Ukljuci(Browser+IP)</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Slova:<br/>\n";
echo $fsize2;
echo "<select name=\"fsize\">\n";
if ($row["fsize"]=="verysmall"){
echo "<option value=\"verysmall\">Veoma Mala</option>\n";
echo "<option value=\"small\">Mala</option>\n";
echo "<option value=\"medium\">Normalina</option>\n";
echo "<option value=\"big\">Velika</option>\n";
}else if ($row["fsize"]=="small"){
echo "<option value=\"small\">Mala</option>\n";
echo "<option value=\"medium\">Normalina</option>\n";
echo "<option value=\"big\">Velika</option>\n";
echo "<option value=\"verysmall\">Veoma Mala</option>\n";
}else if ($row["fsize"]=="medium"){
echo "<option value=\"medium\">Normalina</option>\n";
echo "<option value=\"big\">Velika</option>\n";
echo "<option value=\"small\">Mala</option>\n";
echo "<option value=\"verysmall\">Veoma Mala</option>\n";
}else if ($row["fsize"]=="big"){
echo "<option value=\"big\">Velika</option>\n";
echo "<option value=\"medium\">Normalina</option>\n";
echo "<option value=\"small\">Mala</option>\n";
echo "<option value=\"verysmall\">Veoma Mala</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Kabinet:<br/>\n";
echo $fsize2;
echo "<select name=\"anketa\">\n";
if($row["anketa"] === "1"){
echo "<option value=\"1\">Ukljucen</option>\n";
echo "<option value=\"0\">Iskljucen</option>\n";
} else {
echo "<option value=\"0\">Iskljucen</option>\n";
echo "<option value=\"1\">Ukljucen</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Profil Slike:<br/>\n";
echo $fsize2;
echo "<select name=\"slika\">\n";
if($row["slika"] === "1"){
echo "<option value=\"1\">Ukljucene</option>\n";
echo "<option value=\"0\">Iskljucene</option>\n";
}else{
echo "<option value=\"0\">Iskljucene</option>\n";
echo "<option value=\"1\">Ukljucene</option>\n";
}
echo "</select><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"change.php?$ses&amp;go=rew&amp;ref=$ref\" method=\"post\">\n";
echo "<postfield name=\"avr\" value=\"$(avr)\"/>\n";
echo "<postfield name=\"max\" value=\"$(max)\"/>\n";
echo "<postfield name=\"say\" value=\"$(say)\"/>\n";
echo "<postfield name=\"trun\" value=\"$(trun)\"/>\n";
echo "<postfield name=\"znak\" value=\"$(znak)\"/>\n";
echo "<postfield name=\"smls\" value=\"$(smls)\"/>\n";
echo "<postfield name=\"safe\" value=\"$(safe)\"/>\n";
echo "<postfield name=\"fsize\" value=\"$(fsize)\"/>\n";
echo "<postfield name=\"anketa\" value=\"$(anketa)\"/>\n";
echo "<postfield name=\"slika\" value=\"$(slika)\"/>\n";
if($row["posts"] >= "25000") {
echo "<postfield name=\"invis\" value=\"$(invis)\"/>\n";
}
echo "</go></anchor>\n";
echo $fsize2;
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo $fsize1;
echo "<br/>\n";
echo $divide;
echo "<a href=\"enter.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
mysql_close ($link);
exit;
}

if($row["posts"] < "0") $status=$row["status"];
if($row["posts"] < "25000") $invis=$row["inv"];
if($invis >= "2") $invis="0";

$emp="Nepravilan format unosa!";
if(!preg_match("!^[0-9]+$!i",$avr)){$error = $emp;}
elseif(!preg_match("!^[0-9]+$!i",$max)){$error = $emp;}
elseif(!preg_match("!^[0-9]+$!i",$say)){$error = $emp;}
//elseif(!preg_match("!^[0-9]+$!i",$trun)){$error = $emp;}
elseif(!preg_match("!^[0-9]+$!i",$smls)){$error = $emp;}
elseif(!preg_match("!^[0-9]+$!i",$safe)){$error = $emp;}
elseif(!preg_match("!^[0-9]+$!i",$anketa)){$error = $emp;}
//elseif(!preg_match("!^[0-9]+$!i",$invis)){$error = $emp;}
//$status = check($status);
$fsize = check($fsize);

if (!isset($error)) {
$result = mysql_query ("Select * users where id = '".$id."'");
if (mysql_affected_rows() == 0){
$error = "database error...";
}else{
$ins_str = "Update users set avr='".$avr."', max='".$max."', say='".$say."', inv='".$invis."', znak='".$znak."', smiles='".$smls."', safe='".$safe."', fsize='".$fsize."', anketa='".$anketa."', slika='".$slika."' where id ='".$id."'";
}
if (mysql_query ($ins_str)) {
$msg = "Podesavanja chata su uspesno izmenjena!";
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
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"change.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<do type=\"prev\" label=\"Back\"><prev/></do>\n";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Greska!!!</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=change.php?$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<b>$error</b>\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
exit;
}
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"ok\" title=\"Podesavanja\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Podesavanja</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=enter.php?$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<b>$msg</b><br/>\n";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
?>
