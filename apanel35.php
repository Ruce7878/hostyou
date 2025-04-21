<?php
##################################################################################################
##	               BY VIRUS                                    ##
##	                    Version  :  3.2 (23.01.2007)                                            ##
##                      Made by  :  Медиум                                                      ##
##	                     E-mail  :  virus@inbox.com	                                        ##
##                          ICQ  :  299-411-279                                                 ##
##                         Site  :  http://pilewap.com                               ##
## По вопросам приобритения скрипта или обновлений для него обращатьтся на вышеуказанные данные.##
## Распространение скрипта другими лицами запрешено. Скрипт защищён законом об авторском праве. ##                                  ##################################################################################################
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");
require("inc.php");
if (isset($rm)) $takep="&amp;rm=$rm&amp;ref=$ref";
else $takep="&amp;ref=$ref";
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
$ggggg=$row["gzip"];
if($ggggg=="1"){
include("gz.php");
}
if(isset ($rm)) $takep="&amp;rm=$rm&amp;ref=$ref";
else $takep="&amp;ref=$ref";
if($row["level"] < 7) {
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"15\"/>";
echo "<p align=\"center\">\n";
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
echo "<title>Greska!!!</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=enter.php?$ses$takep\">";
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
if($row["panel"] < 1) {
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"15\"/>";
echo "<p align=\"center\">\n";
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
echo "<title>Greska!!!</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=enter.php?$ses$takep\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
if($row["level"] < 7) {
echo $fsize1;
echo "Nemate prava pristupa dok vam se ne odobri ulaz u panel!\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
exit;
}}
$us=$row["user"];   
$login=$row["user"];              
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];
///////////////////////////////////////////
$gde="Admin CP";
include("gde.php");
///////////////////////////////////////////
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"apanel\" title=\"Admin Panel\">\n";
echo "<p align=\"center\" mode=\"wrap\">\n";
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
echo "<title>Admin Panel</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
$time=date ("H:i"); 
switch($go) {
default:
$sifra = mysql_fetch_array(mysql_query("SELECT sifra FROM setting"));
if ($passw != $sifra[0]) {
if ($ver=="xhtml"){
echo "<form method=\"post\" action=\"apanel.php?$ses&amp;ref=$ref\">";
}
echo "Lozinka panela:<br/>
      <input name=\"passw\" type=\"password\" maxlength=\"15\" title=\"passw\"/><br/>";
	  if ($ver=="xhtml"){
echo "<input type=\"submit\" class=\"ibutton\" value=\"OK\"/></form>";
	  }
	  if ($ver=="wml"){
	  echo "<anchor title=\"go\">Ok<go href=\"apanel.php?$ses&amp;ref=$ref\" method=\"post\">\n";
      echo "<postfield name=\"passw\" value=\"$(passw)\"/>\n";
      echo "</go></anchor>\n";
	  }
echo "<div class=\"d1\">";
echo "<br/><a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
echo "</div>";
	  if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
exit;
}



if ($ver=="wml"){
echo "</p>\n";
echo "<p align=\"left\" mode=\"wrap\">\n";
}else{
echo "</div>";
echo "<div align=\"left\">";
}
echo $fsize1;
echo "<div class=\"d1\">";
echo "($time) Pozdrav, uvazeni gospodine $us!<br/><br/>\n";
echo "</div>";

echo "Objave: ";
echo "<a href=\"apanel.php?$ses&amp;go=upisivanje$takep\">Hodnik</a> | ";
echo "<a href=\"apanel.php?$ses&amp;go=upisivanje2$takep\">Index</a><br/>\n";
///if ($row["id"]==10){
//}else{
echo "<a href=\"apanel.php?$ses&amp;go=kljuc$takep\">Ukljucivanje zastite chata</a><br/>\n";

if($row["level"]>=7){
echo "<b><a href=\"apanel.php?$ses&amp;go=view&amp;nick=$id\">Izmena sopstvenog nika</a></b><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=ipzabrana$takep\">Dodaj IP zabranu</a><br/>\n";
}

echo "<a href=\"apanel.php?$ses&amp;go=dodatneopcije$takep\">Dodatne opcije</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editrooms$takep\">Izmeni/Obrisi Sobe</a><br/>\n";   
echo "<a href=\"apanel.php?$ses&amp;go=natpisus$takep\">Tekst u sobi</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editposroom$takep\">Izmeni Poziciju Soba</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=addroom$takep\">Dodaj Sobu</a><br/>\n";
if($row["level"]>=9){
echo "<a href=\"apanel.php?$ses&amp;go=sifra$takep\">Izmena sifre panela</a><br/>\n";}
if($row["level"]>8){
echo "<a href=\"apanel.php?$ses&amp;go=bots$takep\">Izmeni Botove/Registraciju</a><br/>\n";

echo "<a href=\"apanel.php?$ses&amp;go=editlogo$takep\">Izmeni Logo</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editpoeni$takep\">Poeni dobrodoslice</a><br/>\n";

echo "<a href=\"apanel.php?$ses&amp;go=gornji$takep\">Gornji Link</a><br/>\n";
}
if($row["level"]>=8){
echo "<a href=\"apanel.php?$ses&amp;go=link$takep\">Linkovi</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=gallery$takep\">Opcije Galerije</a><br/>\n";
}
if($row["level"]>=8){
echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">Izmeni Statuse</a><br/>\n";

echo "<a href=\"apanel.php?$ses&amp;go=dopustanje1$takep\">Dopustanja</a><br/>\n";}
echo "<a href=\"forum.php?$ses&amp;action=admincp$takep\">Podesavanje Foruma</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=razglas$takep\">Podesavanje Razglasa</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=kljuc$takep\">Zakljucavanja </a><br/>\n";
echo $divide;
//if($row["level"]>=9){
//echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">SKINI ZASTITU</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">VIDI PASS</a><br/>\n";
//}
if($row["level"]>=9){
echo "<a href=\"openlog.php?$ses$takep&amp;n=1\">Aktivnost Admina</a><br/>\n"; 
echo "<a href=\"openlogm.php?$ses$takep&amp;n=1\">Aktivnost Moda</a><br/>\n"; 
echo "<a href=\"openlogr.php?$ses$takep&amp;n=1\">Aktivnost Kancelarije</a><br/>\n"; 
echo "<a href=\"openlogi.php?$ses$takep&amp;n=1\">Aktivnost Intimne</a><br/>\n";
}
echo $divide;
//echo "<a href=\"anekuslist.php?$ses&amp;ref=$ref\">Proveriti Stih</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=addanekdot1$takep\">Dodaj Stih</a><br/>\n";   
echo "<a href=\"apanel.php?$ses&amp;go=addshutki$takep\">Dodaj Anegdotu</a><br/>\n";  
if($row["level"]>=8){  
echo "<a href=\"apanel.php?$ses&amp;go=zamena$takep\">Dodaj Zamenu</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=cenzura$takep\">Dodaj zabranu (cenzuru)</a><br/>\n";
}
echo "<a href=\"ugifts.php?action=uploader&amp;$ses&amp;rm=$rm&amp;ref=$ref\">Dodaj Poklon</a><br/>\n";   
echo "<a href=\"apanel.php?$ses&amp;go=addvopr$takep\">Dodaj Pitanje</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=addanagram$takep\">Dodaj Anagram</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=tell$takep\">Objava(Sve Sobe)</a><br/>\n";  
echo "<a href=\"apanel.php?$ses&amp;go=mnews$takep\">Dodaj Novost</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dnews$takep\">Obrisi Novosti</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=mmeet$takep\">Dodaj Info</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dmeet$takep\">Obrisi Info</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=mobav$takep\">Dodaj Obavestenje</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dobav$takep\">Obrisi Obavestenje</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=mobi$takep\">Dodaj Razglas</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dobi$takep\">Obrisi Razglas</a><br/>"; 
echo $divide;
//if($row["level"]>=8){
//echo $divide; 
//echo "<a href=\"apanel.php?$ses&amp;go=import_fraz$takep\">Brisanje Podatka</a><br/>\n"; 
//echo "<a href=\"apanel.php?$ses&amp;go=import_frazi$takep\">Brisanje Fraza</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=import_vopros$takep\">Brisanje Pitanja</a><br/>\n"; 
echo "<a href=\"apanel.php?$ses&amp;go=import_anekdot$takep\">Brisanje Anegdote</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=import_shutki$takep\">Brisanje Zezalice</a><br/>\n";
//}
echo "<a href=\"apanel.php?$ses&amp;go=unban$takep\">LISTA BANOVANIH</a><br/>\n";
if($row["level"]>=8){
echo "<a href=\"apanel.php?$ses&amp;go=clbanip$takep\">Lista Browser+IP</a><br/>\n";
}
if($row["level"]>=9){
echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;page=1\">Mod Log</a><br/>\n";
}
echo "<a href=\"apanel.php?$ses&amp;go=unpin$takep\">Lista Kickovanih</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=fullign$takep\">Ciscenje Ignora</a><br/>\n";    
//echo "<a href=\"apanel.php?$ses&amp;go=clearzap$takep\">Ocisti Zapise</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=clroom$takep\">Čišćenje soba(nenajavljeno)</a><br/>\n";
if($row["level"]>=9){
echo "<a href=\"apanel.php?$ses&amp;go=clroomtime$takep\">Ciscenje Svih Soba</a><br/>\n";
}
if($row["level"]>=9){
echo "<a href=\"apanel.php?$ses&amp;go=clearlogs$takep\">Ciscenje Logova</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=delpp2$takep\">Ciscenje Inboxa(SVE)</a><br/>\n";
}
if($row["level"]>=9){
echo "<a href=\"apanel.php?$ses&amp;go=delpp$takep\">Ciscenje Inboxa</a><br/>\n";
}
if($row["level"]>6){
echo "<a href=\"apanel.php?$ses&amp;go=pp2all&amp;model=1$takep\">Pismo za sve chatere</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=pp2all&amp;model=2$takep\">Pismo za administraciju</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=pp2all&amp;model=3$takep\">Pismo za sve muske chatere</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=pp2all&amp;model=4$takep\">Pismo za sve zenske chatere</a><br/>\n";
echo "<a href=\"browser.php?$ses&amp;ref=$ref\">Pretraga browser-a</a><br/>\n";
}
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=msvadbi$takep\">Dodaj svadbu</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dsvadbi$takep\">Udalji svadbu</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=razvod$takep\">Razvesti</a><br/>";
$obrisani=mysql_fetch_array(mysql_query("SELECT COUNT(id) from users_delete"));
echo "<a href=\"statistik.php?$ses&amp;mod=obrisani&amp;ref=$ref\">Obrisani chateri(".$obrisani[0].")</a><br/>";
echo $fsize2;
break;
///
case 'upisivanje':
echo $fsize1;
$logologo = mysql_fetch_array(mysql_query("SELECT objava FROM setting"));
echo "Admin objava:<br/>\n";

if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=objava&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"logo\" maxlength=\"255\" title=\"logo\" value=\"$logologo[0]\"/><br/>\n";  
if ($ver=="wml"){

echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=objava&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"logo\" value=\"$(logo)\"/>\n";  
echo "</go></anchor>\n"; 

echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}


echo $fsize2;
break;
case 'upisivanje2':
echo $fsize1;
$logologo = mysql_fetch_array(mysql_query("SELECT index FROM setting"));
echo "Index objava:<br/>\n";

if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=objavai&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"logo\" maxlength=\"255\" title=\"logo\" value=\"$logologo[0]\"/><br/>\n";  
if ($ver=="wml"){

echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=objavai&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"logo\" value=\"$(logo)\"/>\n";  
echo "</go></anchor>\n"; 

echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}

echo $fsize2;
break;
case 'objavai':
$logo=$_POST["logo"];
if($row["level"]>6){
if($logo || $logo!=""){
mysql_query ("UPDATE setting SET pocetak='".$logo."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je objavio na admin razglas!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Objava dodata!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti text!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati text!<br/>\n";
echo $fsize2;
}
break;
case 'kljuc':
echo $fsize1;
$setting = @mysql_query ("Select * from xix_zastita");
$set = mysql_fetch_array ($setting);
if(empty($action)) {

$dopu = mysql_fetch_array(mysql_query("SELECT nocna FROM xix_zastita"));
if($dopu[0]==1){
echo "<a href=\"apanel.php?$ses&amp;go=kljucsve1$takep\">Iskljuci zastitu registracije</a><br/>\n";
}else{
echo "<div class=\"d1\">";
echo "<a href=\"apanel.php?$ses&amp;go=kljucsve2$takep\">Ukljuci Zastitu registracije</a><br/>\n";
echo "</div>";
}
echo $divide;
//echo "<a href=\"apanel.php?$ses&amp;go=kljucsve$takep\">Zakljucaj sve opcije</a><br/>---<br/>\n";
echo "Aktivnosti u opcijama:<br/>";
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=kljuc$takep\" name=\"auth\">\n";
echo "Registracija kompjuterom:<br/>\n";
echo "<select name=\"regkomp\">\n";
if($set["regkomp"] == 0){
echo "<option value=\"0\">Da</option>\n";
echo "<option value=\"1\">Ne</option>\n";
} else {
echo "<option value=\"1\">Ne</option>\n";
echo "<option value=\"0\">Da</option>\n";
}           
echo "</select><br/>\n";
echo "Forum:<br/>\n";
echo "<select name=\"forum\">\n";
if($set["forum"] == 0){
echo "<option value=\"0\">Da</option>\n";
echo "<option value=\"1\">Ne</option>\n";
} else {
echo "<option value=\"1\">Ne</option>\n";
echo "<option value=\"0\">Da</option>\n";
}           
echo "</select><br/>\n";

echo "Stihovi:<br/>\n";
echo "<select name=\"stihovi\">\n";
if($set["stihovi"] == 0){
echo "<option value=\"0\">Da</option>\n";
echo "<option value=\"1\">Ne</option>\n";
} else {
echo "<option value=\"1\">Ne</option>\n";
echo "<option value=\"0\">Da</option>\n";
}           
echo "</select><br/>\n";
echo "Anketa:<br/>\n";
echo "<select name=\"anketa\">\n";
if($set["anketa"] == 0){
echo "<option value=\"0\">Da</option>\n";
echo "<option value=\"1\">Ne</option>\n";
} else {
echo "<option value=\"1\">Ne</option>\n";
echo "<option value=\"0\">Da</option>\n";
}           
echo "</select><br/>\n";
echo "Komentari:<br/>\n";
echo "<select name=\"komentari\">\n";
if($set["komentari"] == 0){
echo "<option value=\"0\">Da</option>\n";
echo "<option value=\"1\">Ne</option>\n";
} else {
echo "<option value=\"1\">Ne</option>\n";
echo "<option value=\"0\">Da</option>\n";
}           
echo "</select><br/>\n";
echo "Glasacka kutija:<br/>\n";
echo "<select name=\"kutija\">\n";
if($set["kutija"] == 0){
echo "<option value=\"0\">Da</option>\n";
echo "<option value=\"1\">Ne</option>\n";
} else {
echo "<option value=\"1\">Ne</option>\n";
echo "<option value=\"0\">Da</option>\n";
}           
echo"</select><br/>\n";
echo "Knjiga utisaka:<br/>\n";
echo "<select name=\"utisci\">\n";
if($set["utisci"] == 0){
echo "<option value=\"0\">Da</option>\n";
echo "<option value=\"1\">Ne</option>\n";
} else {
echo "<option value=\"1\">Ne</option>\n";
echo "<option value=\"0\">Da</option>\n";
}           
echo "</select><br/>\n";
echo "<br/>";
if ($ver=="wml"){
echo "<anchor title=\"go\">Sacuvaj<go href=\"apanel.php?$ses&amp;go=kljuc$takep\" method=\"post\">\n";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"regkomp\" value=\"$(regkomp)\"/>\n";
echo "<postfield name=\"forum\" value=\"$(forum)\"/>\n";
echo "<postfield name=\"stihovi\" value=\"$(stihovi)\"/>\n";

echo "<postfield name=\"anketa\" value=\"$(anketa)\"/>\n";
echo "<postfield name=\"komentari\" value=\"$(komentari)\"/>\n";
echo "<postfield name=\"kutija\" value=\"$(kutija)\"/>\n";
echo "<postfield name=\"utisci\" value=\"$(utisci)\"/>\n";
echo "</go></anchor>\n";
echo "<br/>\n";
}else{
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>";
echo "<input type=\"submit\" value=\"Sacuvaj\" name=\"enter\"><br/>\n";
}
} else {
//if(@mysql_query("Insert into xix_zastita set regkomp='".$regkomp."',forum='".$forum."',stihovi='".$stihovi."', where id='1';")){
mysql_query ("UPDATE xix_zastita set regkomp='".$regkomp."',forum='".$forum."',stihovi='".$stihovi."',anketa='".$anketa."',komentari='".$komentari."',kutija='".$kutija."',utisci='".$utisci."'");
echo "<b>Uspesno obavljeno</b><br/>";
//}
}
echo $fsize2;
break;

case 'kljucsve1':
if($row["level"]>=7){

mysql_query ("UPDATE xix_zastita set nocna='0', regkomp='0',forum='0',stihovi='0',anketa='0',komentari='0',kutija='0',utisci='0'");
if (mysql_error() == false){
echo $fsize1;
echo "Uspesno obavljeno!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
}else{
echo $fsize1;
echo "Ne mozete definisati izmene!<br/>";
echo $fsize2;
}
break;
case 'kljucsve2':
if($row["level"]>=8){
$dopu=$_GET["dopu"];
$nk=$_GET["nk"];
mysql_query ("UPDATE xix_zastita set nocna='1', regkomp='1',forum='1',stihovi='1',anketa='1',komentari='1',kutija='1',utisci='1'");
if (mysql_error() == false){
echo $fsize1;
echo "Uspesno obavljeno!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
}else{
echo $fsize1;
echo "Ne mozete definisati izmene!<br/>";
echo $fsize2;
}
break;
///
case 'ipzabrana':
$banadr=trim(htmlspecialchars(stripslashes($banadr)));
if(empty($banadr)) $error=$error."<u>*Nema ip adrese*!</u><br/>";
if(empty($action)) {
echo $fsize1;
echo "<a href=\"apanel.php?$ses&amp;go=dipzabrana$takep\">Ukloni IP zabranu</a><br/>\n";
echo "Banujte niz adresa koje pocinju odredjenom grupom brojeva tipa: 25.787 ili celu ip adresu:<br/>";
echo $fsize2;
if ($ver=="wml"){
echo $fsize1;
echo "Unesi IP adresu:<br/>\n";
echo "<input name=\"banadr\"/><br/>";
echo "<b>Ako unosite deo adrese stavite 0,ako unosite celu 1</b><br/>\n";
echo "<input name=\"tip\"/><br/>";   
echo "<anchor>*Dodaj*<go href=\"apanel.php?$ses&amp;go=ipzabrana$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"banadr\" value=\"$(banadr)\"/>";
echo "<postfield name=\"tip\" value=\"$(tip)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo $fsize1; 
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=ipzabrana$takep\" name=\"auth\">\n";
echo "Unesi IP adresu:<br/>\n";
echo "<input name=\"banadr\"/><br/>";
echo "<b>Ako unosite deo adrese stavite 0,ako unosite celu 1</b><br/>\n";
echo "<input name=\"tip\"/><br/>"; 
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>";
echo "<input type=\"submit\" value=\"*Dodaj*\" name=\"enter\"><br/>\n";
echo $fsize2; 
}
} else {
if(empty($error)) {
if($banadr!=$last_news['banadr']) {
if(mysql_query("insert into ipspecialban values(0,'".$banadr."','".$tip."');")) {
echo $fsize1;
echo "<b>Uspesno dodato!</b><br/>";
echo $fsize2;
} else {
echo $fsize1;
echo "<b>Greska pri dodavanju!</b><br/>";
echo $fsize2;
}
} else {
echo $fsize1;
echo "<b>Takva adresa vec postoji!</b><br/>";
echo $fsize2;
}
} else {
echo $fsize1;
echo $error;
echo $fsize2;
}
}
break;
case 'dipzabrana':
$q = mysql_query("select klu4,banadr from ipspecialban order by klu4 desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema banovane adrese!!!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "[<a href=\"apanel.php?action=del&amp;$ses&amp;go=dipzabrana&amp;mid=".$arr['klu4']."$takep\">x</a>] ".$arr['banadr']."<br/>";
echo $fsize2;
}
} else {
if(mysql_query("delete from ipspecialban where klu4='".$mid."' limit 1;")){
echo $fsize1;
echo "<b>Uspesno obrisano!</b><br/>";
echo $fsize2;
}
}
}
break;
case 'odobrenje':
if($row["level"]==9){
$dopu=$_GET["dopu"];
$nk=$_GET["nk"];
mysql_query ("UPDATE users SET odobrenje= '".$dopu."' WHERE id='".$nk."'");
if (mysql_error() == false){
echo $fsize1;
echo "Odobrenje je definisano!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
}else{
echo $fsize1;
echo "Ne mozete definisati izmene!<br/>";
echo $fsize2;
}
break;
case 'panel':
if($row["level"]==9){
$dopu=$_GET["dopu"];
$nk=$_GET["nk"];
mysql_query ("UPDATE users SET panel= '".$dopu."' WHERE id='".$nk."'");
if (mysql_error() == false){
echo $fsize1;
echo "Odobrenje je definisano!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
}else{
echo $fsize1;
echo "Ne mozete definisati izmene!<br/>";
echo $fsize2;
}
break;
case 'sifra':
if(empty($act)) {
echo $fsize1;
echo "Nova sifra admin panela:<br/>(maksimalno 5 simbola)<br/>";
echo $fsize2;
if ($ver=="xhtml") {
echo "<form method=\"POST\" action=\"apanel.php?act=update&amp;$ses&amp;go=sifra$takep\" name=\"auth\">\n";
echo "<input name=\"pos\" format=\"text\"/><br/>";
} else echo "<input name=\"pos$ref\" format=\"text\"/><br/>";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor>*Izmeni*<go href=\"apanel.php?act=update&amp;$ses&amp;go=sifra$takep\" method=\"post\">";
echo "<postfield name=\"pos\" value=\"$(pos$ref)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"*Izmeni*\" name=\"enter\"><br/>\n";
}
} else {
if(@mysql_query("UPDATE setting SET sifra='".$pos."'")){
echo "<b>*Uspesno obavljeno*</b><br/>";
}
}
break;
case 'delucinak':
echo $fsize1;
echo "Da li zelite da resetujete Ucinak?<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=delucinak1$takep\">Da</a> / \n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Ne</a>\n";
echo $fsize2;
break;
case 'delucinak1':
if($row["level"]==8){
mysql_query ("DELETE FROM ucinak");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je resetovao ucinak<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Uspesno obavljeno!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete resetovati ucinak!<br/>\n";
echo $fsize2;
}
break;
case 'dodatneopcije':
echo "<a href=\"apanel.php?$ses&amp;go=kategorija$takep\">Dodaj kategoriju za smajlice</a><br/>";
if($row["level"]>=9){
echo "<a href=\"apanel.php?$ses&amp;go=listadel$takep\">Brisanje liste pregleda profila</a><br/>";

echo "<a href=\"apanel.php?$ses&amp;go=brisanje$takep\">Brisanje podataka</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=plemena$takep\">Upravljanje plemenima</a><br/>";
}
break;
case 'brisanje':
echo "Brisanje podataka:<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=brisanjeanagrama$takep\">Resetovanje Anagram odgovora</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=brisanjekviz$takep\">Resetovanje Kviz odgovora</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=brisanjeok$takep\">Brisanje neaktivnih</a><br/>";
break;
case 'brisanjeok':
echo "Da li ste sigurni da zelite da obrisete neaktivne chatere?:<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=brisanjen$takep\">Da, zelim da obrisem neaktivne chatere!</a><br/>\n";
break;
case 'brisanjen':
$time_limit = 9*7*24*60*60;
$danasnji=time()-$time_limit;
//$userm = mysql_query ("SELECT COUNT(*) FROM users WHERE gdetime<'".$danasnji."' AND posts='0'");
mysql_query ("DELETE FROM users WHERE gdetime<'".$danasnji."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao neaktivne chatere od pre 3 meseca.<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Uspesno obavljeno!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
break;
case 'brisanjeanagrama':
mysql_query ("UPDATE users SET anakredit='0'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je resetovao anagram odgovore.<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Uspesno obavljeno!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
break;
case 'brisanjekviz':
mysql_query ("UPDATE users SET credits='0'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je resetovao kviz odgovore.<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Uspesno obavljeno!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
break;
case 'plemena':
$plemena = mysql_fetch_array(mysql_query("SELECT plemena FROM setting"));
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=otvorizatvori&amp;$ses$takep\" name=\"auth\">\n";
echo "Plemena su aktivna:\n";
echo "<select name=\"ukljucena\">\n";
if($plemena[0]==0){
echo "<option value=\"0\">Da</option>\n";
echo "<option value=\"1\">Ne</option>\n";
}else{
echo "<option value=\"1\">Ne</option>\n";
echo "<option value=\"0\">Da</option>\n";
}
echo "</select>\n";
if ($ver=="wml"){
echo "<anchor title=\"go\">OK<go href=\"apanel.php?go=otvorizatvori&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"ukljucena\" value=\"$(ukljucena)\"/>\n";
echo "</go></anchor>\n"; 
}else{
echo "<input type=\"submit\" value=\"OK\" name=\"enter\"></form><br/>\n";
}
echo "<br/>Da li zelite da resetujete plemena?<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=resetovanje$takep\">Da</a> / \n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Ne</a><br/>\n";
break;
case 'resetovanje':
echo $fsize1;
if($row["level"]>=7){
echo $fsize1;
echo "Plemena su resetovana!<br/>\n";
echo $fsize2;
 $res = mysql_query("DELETE FROM triburile_cascunzatoare");
 $res = mysql_query("DELETE FROM triburile_ccatapulta");
 $res = mysql_query("DELETE FROM triburile_poluge");
 $res = mysql_query("DELETE FROM triburile_retatac_spioni");
 $res = mysql_query("DELETE FROM triburile_robovi");
 
 $res = mysql_query("DELETE FROM triburile");
 $res = mysql_query("DELETE FROM triburile_aparatori");
 $res = mysql_query("DELETE FROM triburile_atac");
 $res = mysql_query("DELETE FROM triburile_atac_spioni");
 $res = mysql_query("DELETE FROM triburile_ccnobila");
 $res = mysql_query("DELETE FROM triburile_cmagazie");
 $res = mysql_query("DELETE FROM triburile_cnivel");
 $res = mysql_query("DELETE FROM triburile_cuceriri");
 $res = mysql_query("DELETE FROM triburile_czid");
 $res = mysql_query("DELETE FROM triburile_forums");
 $res = mysql_query("DELETE FROM triburile_invitatii");
 $res = mysql_query("DELETE FROM triburile_luptatori");
 $res = mysql_query("DELETE FROM triburile_muncitori");
 $res = mysql_query("DELETE FROM triburile_nobili");
 $res = mysql_query("DELETE FROM triburile_posts");
 $res = mysql_query("DELETE FROM triburile_raport");
 $res = mysql_query("DELETE FROM triburile_reatac");
 $res = mysql_query("DELETE FROM triburile_retarg");
 $res = mysql_query("DELETE FROM triburile_retatac");
 $res = mysql_query("DELETE FROM triburile_retsprijin");
 $res = mysql_query("DELETE FROM triburile_sprijin");
 $res = mysql_query("DELETE FROM triburile_targ");
 $res = mysql_query("DELETE FROM triburile_topics");
 $res = mysql_query("DELETE FROM triburile_trib");
 $res = mysql_query("DELETE FROM triburile_trimres");
  if($res)
  {
  echo "Novi krug takmicenja je otvoren!";
  }else{
  echo "Greska kod definisanja!";
  }
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> resetovao plemena!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete resetovati plemena!<br/>\n";
echo $fsize2;
}
echo $fsize2;
break;
case 'listadel':
if($row["level"]>=8){
echo $fsize1;
echo "Lista pregleda profila je obrisana<br/>\n";
echo $fsize2;
if(isset($rm)){
echo $fsize1;
echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
echo $fsize2;
}
mysql_query ("DELETE FROM lastview");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao listu pregleda profila!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete brisati listu pregleda!<br/>\n";
echo $fsize2;
}
break;
case 'kategorija':
$naziv=trim(htmlspecialchars(stripslashes($naziv)));
if(empty($naziv)) $error=$error."<u>Unesite naziv!</u><br/>";
if(empty($tip)) $error=$error."<u>Unesite tip!</u><br/>";
if(empty($action)) {

	if ($ver=="wml"){
	echo $fsize1;
	echo "Naziv Kategorije:<br/>";
	echo $fsize2;
	echo "<input name=\"naziv\" maxlength=\"100\"/><br/>";
	echo $fsize1;
	echo "Zauzeti brojevi za tip smajlica - ";
    echo "<select name=\"tip\">";

	$selsel = mysql_query("SELECT tip, naziv FROM smilies_kategorija ORDER BY tip");

    while ($item = mysql_fetch_array($selsel)){

	$naza=htmlspecialchars("$item[1]");
	$tip=htmlspecialchars("$item[0]");

	echo "<option value=\"$item[0]\">$tip - $naza</option>\n";

	}

	echo "</select><br/>";
	
	
	echo "Unesite naredni broj za tip smajlica:<br/>";
	echo $fsize2;
	echo "<input name=\"tip\" maxlength=\"10\"/><br/>";
	echo $fsize1;
	echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=kategorija$takep\" method=\"post\">";
	echo "<postfield name=\"action\" value=\"add\"/>";
	echo "<postfield name=\"naziv\" value=\"$(naziv)\"/>";
	echo "<postfield name=\"tip\" value=\"$(tip)\"/>";
	echo "</go></anchor><br/>";
	echo $fsize2;
	}else{
	echo "<form method=\"post\" action=\"apanel.php?$ses&amp;go=kategorija$takep\" name=\"auth\">\n";
	echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
	echo $fsize1;
	echo "Naziv Kategorije:<br/>";
	echo $fsize2;
	echo "<input name=\"naziv\" maxlength=\"100\"/><br/>";
	echo $fsize1;
	echo "Zauzeti brojevi za tip smajlica - ";
	echo "<select name=\"tip\">";

	$selsel = mysql_query("SELECT tip, naziv FROM smilies_kategorija ORDER BY id");

    while ($item = mysql_fetch_array($selsel)){

	$naza=htmlspecialchars("$item[1]");
	$tip=htmlspecialchars("$item[0]");

	echo "<option value=\"$item[0]\">$tip - $naza</option>\n";

	}

	echo "</select><br/>";
	echo "Unesite naredni broj za tip smajlica:<br/>";
	echo $fsize2;
	echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
	echo "<input name=\"tip\" maxlength=\"10\"/><br/>";
	echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"/></form><br/>";
	}
	
} else { 
if(empty($error)) {
if($naziv!=$last_news['naziv']) {
if(mysql_query("INSERT INTO smilies_kategorija SET naziv='".$naziv."', tip='".$tip."'")) { 
print $fsize1;
print "Kategorija je dodata!<br/>";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao kategoriju za smajlice!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else { 
print $fsize1;
print "Greska!!!<br/>"; 
print $fsize2;
} 
} else {
print $fsize1;
print "Takva kategorija vec postoji!<br/>"; 
}
print $fsize2;
} else { 
print $fsize1;
print $error; 
print $fsize2;
} 
}	
	
break;
case 'cenzura':
if($row["level"]>=8){
if(empty($zabrana)) $error=$error."<u>Unesite zabrana!</u><br/>";
if(empty($action)) {
echo "<a href=\"apanel.php?$ses&amp;go=cenzuradel$takep\">Ukloni cenzurisanu rec reklame</a><br/>\n";
if ($ver=="wml"){
print $fsize1;
print "Zabrana:<br/>";
print $fsize2;
print "<input name=\"zabrana\"/><br/>";
print $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=cenzura$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"zabrana\" value=\"$(zabrana)\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=cenzura$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
print $fsize1;
print "Zabrana:<br/>";
print $fsize2;
print "<input name=\"zabrana\"/><br/>";
print $fsize1;
print $fsize2;
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else { 
if(empty($error)) {
if(mysql_query("INSERT INTO zabrana SET zabrana='".$zabrana."'")) { 
print $fsize1;
print "Zabrana je dodata!<br/>";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao zabranu adrese<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else { 
print $fsize1;
print "Greska!!!<br/>"; 
print $fsize2;
} 
print $fsize2;
} else { 
print $fsize1;
print $error; 
print $fsize2;
} 
}
}else{
print $fsize1;
print "Ne mozete dodavati zabranu!<br/>"; 
print $fsize2;
}
break;
case 'cenzuradel':
$q = mysql_query("select id,zabrana from zabrana order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema cenzurisanih reci!!!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "[<a href=\"apanel.php?action=del&amp;$ses&amp;go=cenzuradel&amp;mid=".$arr['id']."$takep\">x</a>] ".$arr['zabrana']."<br/>";
echo $fsize2;
}
} else {
if(mysql_query("delete from zabrana where id='".$mid."' limit 1;")){
echo $fsize1;
echo "<b>Uspesno obrisano!</b><br/>";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao cenzurisanu rec<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize2;
}
}
}
break;
/////////////////////natpis u sobama
case 'natpisus':
if(empty($act)) {
echo $fsize1;
echo "Teskt u sobi:<br/>(ako necete da bude teksta u sobi, ostavite prazno polje i kliknite na izmeni)<br/>";
echo $fsize2;
if ($ver=="xhtml") {
echo "<form method=\"POST\" action=\"apanel.php?act=update&amp;$ses&amp;go=natpisus$takep\" name=\"auth\">\n";
echo "<input name=\"pos\" format=\"text\"/><br/>";
} else echo "<input name=\"pos$ref\" format=\"text\"/><br/>";
echo $fsize1;
echo "Soba:<br/>";
echo $fsize2;
echo "<select name=\"name\">";
$q = @mysql_query("select rm, name from rooms");
while ($dbdata = @mysql_fetch_array($q)) {
$rm=$dbdata["rm"];
$val1=$dbdata["name"];
echo "<option value=\"".$rm."\">".$val1."</option>";
}
echo "</select><br/>";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor>*Izmeni*<go href=\"apanel.php?act=update&amp;$ses&amp;go=natpisus$takep\" method=\"post\">";
echo "<postfield name=\"name\" value=\"$(name)\"/>";
echo "<postfield name=\"pos\" value=\"$(pos$ref)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"*Izmeni*\" name=\"enter\"><br/>\n";
}
} else {
//if (!ctype_digit($pos)) {header("Location: index.php"); die;}
//if (!ctype_digit($name)) {header("Location: index.php"); die;}
if(@mysql_query("update rooms set text='".$pos."' where rm='".$name."';")){
echo "<b>*Naslov u sobi izmenjen*</b><br/>";
}
}
break;
/////////////////////
case 'objava':
$logo=$_POST["logo"];
if($row["level"]>6){
if($logo || $logo!=""){
mysql_query ("UPDATE setting SET objava='".$logo."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je objavio na admin razglas!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Objava dodata!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti text!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati logo!<br/>\n";
echo $fsize2;
}
break;
case 'addanagram':
echo $fsize1;
echo "Pitanje:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=goaddanagram&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"vopros\" maxlength=\"255\" title=\"quest\"/><br/>\n";  
echo $fsize1;
echo "Odgovor:<br/>\n";
echo $fsize2;
echo "<input name=\"answ\" maxlength=\"60\" title=\"answ\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=goaddanagram&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"vopros\" value=\"$(vopros)\"/>\n";  
echo "<postfield name=\"answ\" value=\"$(answ)\"/>\n";  
echo "</go></anchor>\n"; 
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;
case 'goaddanagram':
if ($row["translit"]==1){
}
$tran=strtr($answ,array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","Z"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ш"=>"w","щ"=>"w","ц"=>"c","ч"=>"4","ь"=>".","ъ"=>".","ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Z"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ш"=>"W","Щ"=>"W","Ц"=>"C","Ч"=>"4","Ь"=>".","Ъ"=>".","Ы"=>"Y","Э"=>"E","Ю"=>"Yu","Я"=>"Ya"));
$counterss = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM anagram"));
mysql_query ("Insert into anagram set vopros='".$vopros."', answer='".$answ."',  tran='".$tran."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao pitanje za anagram!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Pitanje je dodato!<br/>\n";
echo "Ukupno pitanja: $counterss[0] !!!<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=addanagram$takep\">Dodaj Anagram</a><br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()." ";
}
break;
case 'mnews':
$content=trim(htmlspecialchars(stripslashes($content)));
$date=date("j.m.Y");
if(empty($content)) $error=$error."<u>Unesite novost!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
print $fsize1;
print "Novost:<br/>";
print $fsize2;
print "<input name=\"content\"/><br/>";
print $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mnews$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"content\" value=\"$(content)\"/>";
print "<postfield name=\"date\" value=\"$date\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mnews$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Novost:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\"/><br/>\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"hidden\" name=\"date\" value=\"$date\"/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else { 
if(empty($error)) {
if($content!=$last_news['content']) {
if(mysql_query("insert into news values(0,'$login','$content','$date');")) { 
print $fsize1;
print "Novost je dodata!<br/>";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao novost!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else { 
print $fsize1;
print "Greska!!!<br/>"; 
print $fsize2;
} 
} else {
print $fsize1;
print "Takva novost vec postoji!<br/>"; 
}
print $fsize2;
} else { 
print $fsize1;
print $error; 
print $fsize2;
} 
}
break;
case 'mnews1':
$content=trim(htmlspecialchars(stripslashes($content)));
$date=date("j.m.Y");
if(empty($content)) $error=$error."<u>Unesite text!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
print $fsize1;
print "Naslov:<br/>";
print $fsize2;
print "<input name=\"content\"/><br/>";
print $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mnews1$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"content\" value=\"$(content)\"/>";
print "<postfield name=\"date\" value=\"$date\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mnews1$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Naslov:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\"/><br/>\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"hidden\" name=\"date\" value=\"$date\"/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else { 
if(empty($error)) {
if($content!=$last_news['content']) {
if(mysql_query("insert into ispovest values(0,'$login','$content','$date');")) { 
print $fsize1;
print "Ispovest je dodata!<br/>";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao ispovest!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else { 
print $fsize1;
print "Greska!!!<br/>"; 
print $fsize2;
} 
} else {
print $fsize1;
print "Takav text vec postoji!<br/>"; 
}
print $fsize2;
} else { 
print $fsize1;
print $error; 
print $fsize2;
} 
}
break;
case 'zamena':
if($row["level"]>=8){
if(empty($zamena)) $error=$error."<u>Unesite zamenu!</u><br/>";
if(empty($zabrana)) $error=$error."<u>Unesite zabrana!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
print $fsize1;
print "Zabrana:<br/>";
print $fsize2;
print "<input name=\"zabrana\"/><br/>";
print $fsize1;
print "Zamena:<br/>";
print $fsize2;
print "<input name=\"zamena\"/><br/>";
print $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=zamena$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"zabrana\" value=\"$(zabrana)\"/>";
print "<postfield name=\"zamena\" value=\"$(zamena)\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=zamena$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
print $fsize1;
print "Zabrana:<br/>";
print $fsize2;
print "<input name=\"zabrana\"/><br/>";
print $fsize1;
print "Zamena:<br/>";
print $fsize2;
print "<input name=\"zamena\"/><br/>";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else { 
if(empty($error)) {
if(mysql_query("INSERT INTO zamena SET zabrana='".$zabrana."', zamena='".$zamena."'")) { 
print $fsize1;
print "Zabrana je dodata!<br/>";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao zabranu reci!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else { 
print $fsize1;
print "Greska!!!<br/>"; 
print $fsize2;
} 
print $fsize2;
} else { 
print $fsize1;
print $error; 
print $fsize2;
} 
}
}else{
print $fsize1;
print "Ne mozete dodavati zabranu!<br/>"; 
print $fsize2;
}
break;
case 'addroom':
if($row["level"]>=7){
if(empty($naziv)) $error=$error."<u>Unesite naziv sobe!</u><br/>";
if(empty($naslov)) $error=$error."<u>Unesite naslov sobe!</u><br/>";
if($broj<0) $error=$error."<u>Unesite broj sobe!</u><br/>";
if(empty($pozicija) || ($pozicija<0 || $pozicija>12) || !ctype_digit($pozicija)) $error=$error."<u>Unesite poziciju sobe!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
print $fsize1;
print "Naziv Sobe:<br/>";
print $fsize2;
print "<input name=\"naziv\"/><br/>";
print $fsize1;
print "Naslov Sobe:<br/>";
print $fsize2;
print "<input name=\"naslov\"/><br/>";
print $fsize1;
print "Pozicija Sobe:<br/>";
print $fsize2;
print "<input name=\"pozicija\"/><br/>";
print $fsize1;
print "Broj Sobe:<br/>";
print $fsize2;
print "<select name=\"broj\">";
for($i = 0; $i <= 15; $i++) {
$so = mysql_fetch_array(mysql_query("SELECT * FROM rooms WHERE rm='".$i."'"));
if(!$so){
print "<option value=\"$i\">$i</option>\n";
}
}
print "</select><br/>";
print $fsize1;
print "0-Kviz, 7-Admin, 8-Mod, 10-Intima, 11-CaffeBar<br/><br/>";
print $fsize2;
print $fsize1;
print "Mesto Sobe:<br/>";
print $fsize2;
print "<select name=\"mesto\">";
print "<option value=\"0\">Hodnik</option>\n";
print "<option value=\"1\">Dvorana</option>\n";
print "</select><br/>";
print $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=addroom$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"naziv\" value=\"$(naziv)\"/>";
print "<postfield name=\"naslov\" value=\"$(naslov)\"/>";
print "<postfield name=\"broj\" value=\"$(broj)\"/>";
print "<postfield name=\"pozicija\" value=\"$(pozicija)\"/>";
print "<postfield name=\"mesto\" value=\"$(mesto)\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=addroom$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
print $fsize1;
print "Naziv Sobe:<br/>";
print $fsize2;
print "<input name=\"naziv\"/><br/>";
print $fsize1;
print "Naslov Sobe:<br/>";
print $fsize2;
print "<input name=\"naslov\"/><br/>";
print $fsize1;
print "Pozicija Sobe:<br/>";
print $fsize2;
print "<input name=\"pozicija\"/><br/>";
print $fsize1;
print "Broj Sobe:<br/>";
print $fsize2;
print "<select name=\"broj\">";
for($i = 0; $i <= 15; $i++) {
$so = mysql_fetch_array(mysql_query("SELECT * FROM rooms WHERE rm='".$i."'"));
if(!$so){
print "<option value=\"$i\">$i</option>\n";
}
}
print "</select><br/>";
print $fsize1;
print "0-Kviz, 8-Admin, 10-Intima, 11-CaffeBar<br/><br/>";
print $fsize2;
print $fsize1;
print "Mesto Sobe:<br/>";
print $fsize2;
print "<select name=\"mesto\">";
print "<option value=\"0\">Hodnik</option>\n";
print "<option value=\"1\">Dvorana</option>\n";
print "</select><br/>";
print $fsize1;
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else { 
if(empty($error)) {
if(mysql_query("INSERT INTO rooms SET rm='".$broj."', name='".$naziv."', topic='".$naslov."', pozicija='".$pozicija."', tip='".$mesto."'")) { 
print $fsize1;
print "Soba je dodata!<br/>";
print $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao sobu <b>$naziv!</b><br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else { 
print $fsize1;
print "Greska!!!<br/>"; 
print $fsize2;
}  
} else { 
print $fsize1;
print $error; 
print $fsize2;
} 
}
}else{
print $fsize1;
print "Ne mozete dodavati sobu!<br/>"; 
print $fsize2;
}
break;
case 'dnews':
$q = mysql_query("select id,content from news order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema novosti!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<b>".$arr['id'].".</b> ".$arr['content']."<a href=\"apanel.php?action=del&amp;$ses&amp;go=dnews&amp;mid=".$arr['id']."$takep\">[X]</a><br/>";  
echo $fsize2;
}
} else {
if(mysql_query("delete from news where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "Novost je obrisana!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao novost!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}
}
}
break;
case 'dnews2':
$q = mysql_query("select id,content from ispovest order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema novosti!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<b>".$arr['id'].".</b> ".$arr['content']."<a href=\"apanel.php?action=del&amp;$ses&amp;go=dnews2&amp;mid=".$arr['id']."$takep\">[X]</a><br/>";  
echo $fsize2;
}
} else {
if(mysql_query("delete from ispovest where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "Ispovest je obrisana je obrisana!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao ispovest!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}
}
}
break;
case 'dshout':
if(mysql_query("TRUNCATE table `shoutbox`")){ 
echo $fsize1;
echo "Razglas je obrisan!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao novi razglas!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}
break;
case 'mmeet':
$title=trim(htmlspecialchars(stripslashes($title)));
$content=trim(htmlspecialchars(stripslashes($content)));
$organizatory=trim(htmlspecialchars(stripslashes($organizatory)));
if(empty($title)) $error=$error."<u>Naziv nije naveden!</u><br/>";
if(empty($content)) $error=$error."<u>Sadrzaj nije naveden!</u><br/>";
if(empty($organizatory)) $error=$error."<u>Organizator nije naveden!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input name=\"title\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input name=\"content\" maxlength=\"1000\"/><br/>";
echo $fsize1;
echo "Organizator:<br/>";
echo $fsize2;
echo "<input name=\"organizatory\" maxlength=\"100\"/><br/>";
echo $fsize1;				
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mmeet$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"title\" value=\"$(title)\"/>";
echo "<postfield name=\"content\" value=\"$(content)\"/>";
echo "<postfield name=\"organizatory\" value=\"$(organizatory)\"/>";
echo "</go></anchor>";
echo $fsize2;	
echo "<br/>";
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mmeet$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"title\" maxlength=\"100\"/><br/>\n";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\" maxlength=\"1000\"/><br/>\n";
echo $fsize1;
echo "Organizator:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"organizatory\" maxlength=\"100\"/><br/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
}else{ 
if(empty($error)) {
if($title!=$last_meet['title']) {
if(mysql_query("insert into vstrechi values(0,'".$login."','".$title."','".$content."','".$organizatory."');")) { 
echo $fsize1;
echo "Objava je dodata!<br/>"; 
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao objavu <b>$title</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else { 
echo $fsize1;
echo "Greska!!!<br/>"; 
echo $fsize2;
} 
} else { 
echo $fsize1;
echo "Takva objava vec postoji!<br/>"; 
echo $fsize2;
}
} else { 
echo $fsize1;
echo $error; 
echo $fsize2;
} 
}
break;
case 'dmeet':
$q = mysql_query("select id,title from vstrechi order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema objava!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dmeet&amp;mid=".$arr['id']."$takep\">".$arr['title']."</a><br/>";  
echo $fsize2;
}
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT title FROM vstrechi WHERE id='".$mid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao objavu <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("delete from vstrechi where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "Objava je obrisana!<br/>";
echo $fsize2;
}
}
}
break;
case 'spy':
/*
$a=mysql_query("select user,pass from users where id='".$nk."' LIMIT 1;");
if(mysql_affected_rows()==0){
echo '<b>Nema takav chater</b><br/>';
break;
}
$as=mysql_fetch_array($a);
$uspass=$as['pass'];
echo '<b>Spijunaza :)</b><br/>';
$spy_code=spy_code;
echo "<a href=\"enter.php?id=$nk&amp;ps=$uspass&amp;py=$spy_code\">Udji pod nik $as[user]</a><br/>";
*/
break;
case 'mobav':
$title=trim(htmlspecialchars(stripslashes($title)));
$content=trim(htmlspecialchars(stripslashes($content)));
$organizatory=trim(htmlspecialchars(stripslashes($organizatory)));
if(empty($title)) $error=$error."<u>Naziv nije naveden!</u><br/>";
if(empty($content)) $error=$error."<u>Sadrzaj nije naveden!</u><br/>";
if(empty($organizatory)) $error=$error."<u>Organizator nije naveden!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input name=\"title\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input name=\"content\" maxlength=\"1000\"/><br/>";
echo $fsize1;
echo "Organizator:<br/>";
echo $fsize2;
echo "<input name=\"organizatory\" maxlength=\"100\"/><br/>";
echo $fsize1;				
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mobav$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"title\" value=\"$(title)\"/>";
echo "<postfield name=\"content\" value=\"$(content)\"/>";
echo "<postfield name=\"organizatory\" value=\"$(organizatory)\"/>";
echo "</go></anchor>";
echo $fsize2;	
echo "<br/>";
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mobav$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"title\" maxlength=\"100\"><br/>\n";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\" maxlength=\"1000\"/><br/>\n";
echo $fsize1;
echo "Organizator:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"organizatory\" maxlength=\"100\"/><br/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
}else{ 
if(empty($error)) {
if($title!=$last_meet['title']) {
if(mysql_query("insert into obavestenja values(0,'".$login."','".$title."','".$content."','".$organizatory."');")) { 
echo $fsize1;
echo "Obavestenje je dodato!<br/>"; 
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao obavestenje <b>$title</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else { 
echo $fsize1;
echo "Greska!!!<br/>"; 
echo $fsize2;
} 
} else { 
echo $fsize1;
echo "Takvo obavestenje vec postoji!<br/>"; 
echo $fsize2;
}
} else { 
echo $fsize1;
echo $error; 
echo $fsize2;
} 
}
break;
case 'dobav':
$q = mysql_query("select id,title from obavestenja order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema obavestenja!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dobav&amp;mid=".$arr['id']."$takep\">".$arr['title']."</a><br/>";  
echo $fsize2;
}
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT title FROM vstrechi WHERE id='".$mid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao obavestenje <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("delete from obavestenja where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "Obavestenje je obrisano!<br/>";
echo $fsize2;
}
}
}
break;
case 'mobi':
$title=trim(htmlspecialchars(stripslashes($title)));
$content=trim(htmlspecialchars(stripslashes($content)));
$login=trim(htmlspecialchars(stripslashes($login)));
if(empty($title)) $error=$error."<u>Naziv nije naveden!</u><br/>";
if(empty($content)) $error=$error."<u>Sadrzaj nije naveden!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input name=\"title\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input name=\"content\" maxlength=\"1000\"/><br/>";
echo $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mobi$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"title\" value=\"$(title)\"/>";
echo "<postfield name=\"content\" value=\"$(content)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mobi$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"title\" maxlength=\"100\"/><br/>\n";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\" maxlength=\"1000\"/><br/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else { 
if(empty($error)) {
if($title!=$last_obiav['title']) {
if(mysql_query("insert into obiav values(0,'".$login."','".$title."','".$content."');")) {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao razglas <b>$title</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
///////////////////////////////////////////////////////////////////// 
echo $fsize1;
echo "Razglas je dodat!<br/>"; 
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!</b><br/>"; 
echo $fsize2;
} 
} else { 
echo $fsize1;
echo "Takav razglas vec postoji!<br/>";
echo $fsize2;
}
} else { 
echo $fsize1;
echo $error; 
echo $fsize2;
} 
}
break;
case 'dobi':
$q = mysql_query("select * from obiav order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema razglasa!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dobi&amp;mid=".$arr['id']."$takep\">".$arr['title']."</a><br/>"; 
echo $fsize2;
}
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT title FROM obiav WHERE id='".$mid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao razglas <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("delete from obiav where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "Razglas je obrisan!<br/>";
echo $fsize2;
}
}
}
break;
case 'view':
if (!ctype_digit($nick)) {
$nick = mysql_escape_string($nick);
$nick=trim($nick);    
if($nick=="")$nick=0;
$latuser=strtolower($nick);
$ruser = rus_to_k($nick);
if($ruser==$nick){
$select = mysql_query ("Select id,user,pass,posts,status,level,glavni,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,img from users where latuser = '".$latuser."'"); 
} else {
$select = mysql_query ("select id,user,pass,posts,status,level,glavni,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,img from users where ruser = '".$ruser."'");
}
} else {
if (!ctype_digit($nick)) {header("Location: index.php"); die;}
$select = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,img from users where id = '".$nick."'"); 
}
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Chater nije pronadjen!<br/>\n"; 
echo $fsize2;
break;
}
$inf = mysql_fetch_array ($select);
$usid = $inf["id"];  
$us_ip = $inf["user_ip"];
$us_soft = $inf["user_soft"];
$level2=$inf["level"];
if($level2 > $row["level"]){
echo $fsize1;
echo "Pristup dozvoljen samo Super Adminima!<br/>\n";
echo $fsize2;
break;
}
$nk=$nick;
if ($nk==7) die('Vi nemate prava pristupa!');
echo $fsize1;
echo "<b>Nick: </b>\n"; 
echo "$inf[user]<br/>\n";
echo "<b>ID: </b>\n"; 
echo "$usid<br/>\n";
echo "<b>Browser: </b>\n";
echo "$us_soft<br/>\n";
echo "<b>IP: </b>\n"; 
echo "$us_ip<br/><br/>\n";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?go=upd&amp;$ses$takep\" name=\"auth\">\n";
echo $fsize1;
echo "<b>Novi Nick:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"upnick\" maxlength=\"12\" value=\"$inf[user]\" title=\"nick\"/><br/>\n"; 
if($row["level"]>=8){
echo $fsize1;
echo "<b>Password:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"upass\" maxlength=\"20\" value=\"$inf[pass]\" title=\"upass\"/><br/>\n";
}else{
echo "<input type=\"hidden\" name=\"upass\" value=\"$inf[pass]\"/>\n";	
}
echo $fsize1;
echo "<b>Postovi:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"posts\" value=\"$inf[posts]\" title=\"posts\"/><br/>\n";
echo $fsize1;
echo "<b>Balans Igre:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"gposts\" value=\"$inf[gposts]\" title=\"posts\"/><br/>\n"; 
echo $fsize1;
echo "<b>Kviz Odgovora:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"credits\" value=\"$inf[credits]\" title=\"posts\"/><br/>\n"; 
echo $fsize1;
echo "<b>Kupljenih Odgovora:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"byeotv\" value=\"$inf[byeotv]\" title=\"posts\"/><br/>\n";
echo $fsize1;
echo "<b>Kredit Mafije:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"mafcredits\" value=\"$inf[mafcredits]\" title=\"posts\"/><br/>\n";  
echo $fsize1;
echo "<b>Glasova za FOTO:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"votefoto\" value=\"$inf[votefoto]\" title=\"votefoto\"/><br/>\n"; 
echo $fsize1;
echo "<b>Status:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"status\" maxlength=\"12\" value=\"$inf[status]\" title=\"status\"/><br/>\n";
echo $fsize1;
echo "<b>Nevidljivost:</b><br/>\n"; 
echo $fsize2;
echo "<select name=\"inv\">\n";
if ($inf["inv"] == 0)echo "<option value=\"0\">Iskljucena</option>\n";
elseif ($inf["inv"] == 1)echo "<option value=\"1\">Ukljucena</option>\n";
elseif ($inf["inv"] == 2)echo "<option value=\"2\">Potpuni Ignor</option>\n";
if ($inf["inv"]!=0) echo "<option value=\"0\">Iskljucena</option>\n";
if ($inf["inv"]!=1) echo "<option value=\"1\">Ukljucena</option>\n";
if ($inf["inv"]!=2) echo "<option value=\"2\">Potpuni Ignor</option>\n";
echo "</select><br/>\n";
echo $fsize1;
echo "<b>Level:</b><br/>\n"; 
echo $fsize2;
echo "<select name=\"level\">\n";
if($inf["level"] != 0) {
$i = $inf["level"];
$levelselect = @mysql_query ("Select name from levels where level='".$i."'");
$levels = @mysql_fetch_array($levelselect);
$levelname=$levels["name"];;     
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
if (($inf["level"]!=8)&&($row["level"]>=8)){
for($i = 0; $i <= 8; $i++) {
$levelselect = @mysql_query ("Select name from levels where level='".$i."'");
$levels = @mysql_fetch_array($levelselect);
$levelname=$levels["name"];;     
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
} else if($row["level"]>=8){
for($i = 0; $i <= 7; $i++) {
$levelselect = @mysql_query ("Select name from levels where level='".$i."'");
$levels = @mysql_fetch_array($levelselect);
$levelname=$levels["name"];;     
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
}else if(($row["level"]==7) && ($inf["level"]==7)){
}else{
for($i = 0; $i <= 6; $i++) {
$levelselect = @mysql_query ("Select name from levels where level='".$i."'");
$levels = @mysql_fetch_array($levelselect);
$levelname=$levels["name"];;     
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
}
echo "</select><br/>\n";
if ($ver=="wml"){ 
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=upd&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"upid\" value=\"$usid\"/>\n";
echo "<postfield name=\"upnick\" value=\"$(upnick)\"/>\n";
echo "<postfield name=\"upass\" value=\"$(upass)\"/>\n";
echo "<postfield name=\"posts\" value=\"$(posts)\"/>\n";
echo "<postfield name=\"gposts\" value=\"$(gposts)\"/>\n";
echo "<postfield name=\"credits\" value=\"$(credits)\"/>\n";
echo "<postfield name=\"mafcredits\" value=\"$(mafcredits)\"/>\n";
echo "<postfield name=\"votefoto\" value=\"$(votefoto)\"/>\n";
echo "<postfield name=\"byeotv\" value=\"$(byeotv)\"/>\n";
echo "<postfield name=\"status\" value=\"$(status)\"/>\n"; 
echo "<postfield name=\"inv\" value=\"$(inv)\"/>\n";
echo "<postfield name=\"level\" value=\"$(level)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";   
}else{
echo "<input type=\"hidden\" name=\"upid\" value=\"$usid\"/>\n";
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo $divide;
$dopus = mysql_fetch_array(mysql_query("SELECT glavni FROM users WHERE id='".$usid."'"));
if($row["level"]>=9){
echo "<a href=\"apanel.php?go=urednik&amp;$ses&amp;usid=$usid$takep\">Dodeli urednicki status</a><br/>";

echo "<a href=\"apanel.php?go=urednikne&amp;$ses&amp;usid=$usid$takep\">Skini urednicki status</a><br/>";
}

//if ($inf["img"]!=""){
//echo $fsize1;
//echo $divide;
//echo "<a href=\"apanel.php?go=delfoto&amp;$ses&amp;usid=$usid$takep\">Obrisi Sliku</a><br/>";
//echo $fsize2;
//}
break;
case 'urednik':
echo $fsize1; 
mysql_query ("UPDATE users SET level= '7', glavni='1' WHERE id='".$usid."'");
echo "Status je dodeljen<br/>\n"; 
echo $fsize2;
break;
case 'urednikne':
echo $fsize1; 
mysql_query ("UPDATE users SET level= '0', glavni='0' WHERE id='".$usid."'");
echo "Status je skinut<br/>\n"; 
echo $fsize2;
break;
case 'delfoto':
echo $fsize1; 
if (!ctype_digit($usid)) {header("Location: index.php"); die;}
$select2 = mysql_query ("Select img from users where id = '".$usid."'"); 
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Chater nije pronadjen!<br/>\n"; 
echo $fsize2;
break;
}
$inf2 = mysql_fetch_array ($select);
$myfotos = $inf2["img"];
$ras=explode(".", $myfotos);
$types=$ras[1];
if (!file_exists("photos/".$usid.".".$types."")){
echo "Chater nema sliku!<br/>\n";
}else{
if (!ctype_digit($usid)) { header("Location: index.php"); die; }
if(@mysql_query ("Update users set img ='' where id ='".$usid."';")){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$usid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao sliku clana <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
unlink ("photos/".$usid.".".$types."");
echo "Slika je obrisana!<br/>";
}else{
echo "Greska!!!<br/>";
}
}
echo $fsize2;
break;
case 'upd':
if($level > $row["level"]){
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$upid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je pokusao nepravilno da izmeni clana <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
echo $fsize1;
echo "Nemate prava za ovu izmenu!Duvaj :)<br/>\n";
echo $fsize2;
break;
}
$upnick=trim($upnick); 
if($upnick==""){          
echo $fsize1;
echo "error<br/>\n";
echo $fsize2;
break;
} 
if (!ctype_digit($upid)) {header("Location: index.php"); die;}
$a = mysql_query("SELECT user,level FROM users WHERE id ='".$upid."'");
$b = mysql_fetch_array ($a);
$prl = $b["level"];   
$nick = $b["user"];
$latuser=strtolower($upnick);
$ruser = rus_to_k($upnick);
if($ruser==$upnick){
mysql_query ("Select id from users where (latuser = '".$latuser."')and(user != '".$nick."')"); 
} else {
mysql_query ("select id from users where (ruser = '".$ruser."')and(user != '".$nick."')");
}
if (mysql_affected_rows() != 0) {
echo $fsize1;
echo "Chater nije pronadjen!<br/>\n";
echo $fsize2;
break;    
}
$upnick = check($upnick); 
$upass = check($upass); 
$ruser = check($ruser); 
$latuser = check($latuser); 
$status = check($status); 
$credits = check($credits); 
$mafcredits = check($mafcredits); 
$gposts = check($gposts);
$upnick = mysql_escape_string($upnick);
$upass = mysql_escape_string($upass);
$ruser = mysql_escape_string($ruser);
$latuser = mysql_escape_string($latuser);
$status = mysql_escape_string($status);
$credits = mysql_escape_string($credits);
$mafcredits = mysql_escape_string($mafcredits);
$gposts = mysql_escape_string($gposts);
if (!ctype_digit($posts)) {header("Location: index.php"); die;}
if (!ctype_digit($votefoto)) {header("Location: index.php"); die;}
if (!ctype_digit($byeotv)) {header("Location: index.php"); die;}
if (!ctype_digit($inv)) {header("Location: index.php"); die;}
if (!ctype_digit($level)) {header("Location: index.php"); die;}
if (!ctype_digit($upid)) {header("Location: index.php"); die;}
if ($ruser==$upnick) $ins_str = "Update users set user='".$upnick."', pass='".$upass."', posts='".$posts."', gposts='".$gposts."', credits='".$credits."', mafcredits='".$mafcredits."', votefoto='".$votefoto."', byeotv='".$byeotv."', status='".$status."', inv='".$inv."', level='".$level."', ruser = '', latuser = '".$latuser."' where id ='".$upid."'";
else $ins_str = "Update users set user='".$upnick."', pass='".$upass."', posts='".$posts."',gposts='".$gposts."',credits='".$credits."',mafcredits='".$mafcredits."',  votefoto='".$votefoto."', byeotv='".$byeotv."', status='".$status."', inv='".$inv."', level='".$level."', ruser = '".$ruser."', latuser = '' where id ='".$upid."'";
if (mysql_query ($ins_str)) {
if ($prl != $level){
$levelselect = @mysql_query ("Select name from levels where level='".$level."'");
$levels = @mysql_fetch_array($levelselect);
$ur=$levels["name"];
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$upid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio status clana <b>".$objava[0]."</b> u <b>$ur</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
for ($i=7; $i<=8; $i++){
$st = time();           
$today=date ("H:i");
$levelselect = @mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = @mysql_fetch_array($levelselect);
$lev=$levels["name"];
$mes = "<b>$lev $us dodelio je chateru $upnick status $ur!</b>";     
$rnd = rand(0,99999999);
@mysql_query ("Insert into room{$i} set klu4= '".$rnd."', time='".$today."', who='".$administration."', message='".$mes."', id='".$st."', towhom='', hid='0', usid='1', komu=''");
}
$levelselect = @mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = @mysql_fetch_array($levelselect);
$lev=$levels["name"];
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Pozz!!!";
$message = "Pozz <b>".$upnick."</b>!!! Zaslizili ste da Vam ".$lev." <b>".$us."</b> poveca status! Sada ste <b>".$ur."!</b>.";
@mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$upnick."', idtowhom = '".$upid."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
}else{
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$upid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je izmenio clana <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
}
echo $fsize1;
echo "Profil je izmenjen!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo " ".mysql_error()." ";
}
break;
case 'addanekdot1':
echo $fsize1;
echo "Translit stiha<br/>\n";
echo "Ne zaboravite autora (autor NIK)<br/>\n";
echo "Stih<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=goaddanekdot1&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"anek\" maxlength=\"2500\" title=\"quest\"/><br/>\n";  
echo $fsize1;
echo $divide;
echo $fsize2;
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=goaddanekdot1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"anek\" value=\"$(anek)\"/>\n";  
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;
case 'addshutki':
echo $fsize1;
echo "Anegdota:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=goaddshutki&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"anek\" maxlength=\"255\" title=\"quest\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=goaddshutki&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"anek\" value=\"$(anek)\"/>\n";  
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;
case 'goaddanekdot1':
if ($row["translit"]==1)$anek = trun_to_rus($anek);
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
$r = mysql_query("select * from anekdot1");
$k = mysql_affected_rows()+1;
mysql_query ("Insert into anekdot1 set klu4= '".$k."', message='".$anek."'");
if (mysql_error() == false){
echo $fsize1;
echo "Stih je dodat!<br/>\n";
echo "Ukupno stihova: $k !!!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
break;
case 'dopustanje':
if($row["level"]>=8){
$dopu=$_GET["dopu"];
$nk=$_GET["nk"];
mysql_query ("UPDATE users SET dopustanje= '".$dopu."', dopustanjet='".time()."' WHERE id='".$nk."'");
if (mysql_error() == false){
echo $fsize1;
echo "Dopustanje je dodato!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
}else{
echo $fsize1;
echo "Ne mozete davati dopustanja!<br/>";
echo $fsize2;
}
break;
case 'spijuniranje':
if($row["level"]>=8){
$dopu=$_GET["dopu"];
$nk=$_GET["nk"];
mysql_query ("UPDATE users SET spijun= '".$dopu."' WHERE id='".$nk."'");
if (mysql_error() == false){
echo $fsize1;
echo "Spijuniranje je definisano!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
}else{
echo $fsize1;
echo "Ne mozete definisati spijuniranje!<br/>";
echo $fsize2;
}
break;
case 'zastita1':
if($row["level"]>=7){
$dopu=$_GET["dopu"];
mysql_query ("UPDATE setting SET zastita='".$dopu."'");
if (mysql_error() == false){
echo $fsize1;
echo "Zastita je definisana!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
}else{
echo $fsize1;
echo "Ne mozete definisati zastitu!<br/>";
echo $fsize2;
}
break;
case 'dopustanje1':
if($row["level"]>=8){
if($ver=="xhtml"){
echo "<form action=\"apanel.php?$ses&amp;go=dopustanje2$takep&amp;dopu=1\" method=\"post\">\n";
echo $fsize1;
$r = mysql_query("SELECT id,user FROM users WHERE level>'3' AND level<'8' AND dopustanje!=1 ORDER BY user ASC");
if (mysql_affected_rows() == 0) {
echo "Nema moderatora!<br/>\n";
}else{
$a = mysql_fetch_array($r);
while ($a !== false){
$nk = $a["id"];
$nick = $a["user"];
echo "<input type=\"checkbox\" name=\"chkboxarray[]\" value=\"$nk\"/> ";
echo "<a href=\"info.php?$ses&amp;nk=$nk&amp;ref=$ref\">".$nick."</a><br/>\n";
$a = mysql_fetch_array($r);
}
}
echo $fsize2;
echo "<input type=\"submit\" value=\"Dodaj\"/></form>\n";
echo $fsize1;
echo "<br/><a href=\"apanel.php?$ses&amp;go=dopustanjedel$takep\">Obrisi Dopustanja</a><br/>\n";
echo $fsize2;
}else{
echo $fsize1;
echo "Ova opcija nije dostupna u WML verziji!<br/>";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete davati dopustanja!<br/>";
echo $fsize2;
}
break;
case 'dopustanje2':
if($row["level"]>=8){
$dopu=$_GET["dopu"];
$chkboxarray=$_POST["chkboxarray"];
foreach($chkboxarray as $checkbox){
mysql_query("UPDATE users SET dopustanje= '1', dopustanjet='".time()."' WHERE id='".$checkbox."'");
}
echo $fsize1;
echo "Dopustanja su uspesno dodata!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete davati dopustanja!<br/>";
echo $fsize2;
}
break;
case 'dopustanjedel':
if($row["level"]>=8){
mysql_query("UPDATE users SET dopustanje= '0' WHERE dopustanje='1'");
echo $fsize1;
echo "Dopustanja su uspesno obrisana!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete davati dopustanja!<br/>";
echo $fsize2;
}
break;
case 'pwtread':
$read=$_GET["read"];
if($row["level"]>=8){
mysql_query("UPDATE setting SET pwtread='".$read."'");
echo $fsize1;
if($read==1){
$kom="ukljuceno";
}else{
$kom="iskljuceno";
}
echo "Citanje PWT je $kom!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete koristiti ovu opciju!<br/>";
echo $fsize2;
}
break;
case 'goaddshutki':
if ($row["translit"]==1)$anek = trun_to_rus($anek);
$anek = str_replace(chr("13"), " ", $anek);
$anek = str_replace(chr("10"), " ", $anek);
$anek = trim(" $anek ");
$anek = ereg_replace(" +"," ",$anek);
$anek=substr($anek,0,400);
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
$r = mysql_query("select * from shutki");
$k = mysql_affected_rows()+1;
mysql_query ("Insert into shutki set klu4= '".$k."', message='".$anek."'");
if (mysql_error() == false){
echo $fsize1;
echo "Anegdota je dodata!<br/>\n";
echo "Broj anegdota: $k !!!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo " ".mysql_error()."";
}
break;
case 'zastita':
$r = mysql_query("SELECT user FROM users WHERE id='".$nk."'");
$k = mysql_affected_rows();
if($row["level"]>=7 && $level<$row["level"]){
if($k>0){
mysql_query ("UPDATE users SET safe= '0' WHERE id='".$nk."'");
if (mysql_error() == false){
echo $fsize1;
echo "Zastita je skinuta!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Korisnik nije pronadjen!<br/>";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete skidati zastitu!<br/>";
echo $fsize2;
}
break;
case 'modmod':
$nicker = mysql_fetch_array(mysql_query("SELECT user, level FROM users WHERE id='".$nk."'"));
if($row["level"]==7){$max=7;}
if($row["level"]>=8){$max=9;}
if($lev<=$row["level"] && $lev>$nicker[1] && $max>$lev){
mysql_query ("UPDATE users SET level='".$lev."' WHERE id='".$nk."'");
if (mysql_error() == false){
echo $fsize1;
echo "Status je uspesno promenjen!";
echo $fsize2;
/////////////////////////////////////////////////////////////////////////
$nickers = mysql_fetch_array(mysql_query("SELECT id, user, level FROM users WHERE id='".$nk."'"));
$levelselect = @mysql_query ("Select name from levels where level='".$lev."'");
$adminss =mysql_fetch_array(mysql_query ("Select user from users where id='1'"));
$levels = @mysql_fetch_array($levelselect);
$ur=$levels["name"];
for ($i=0; $i<=23; $i++){
$st = time();           
$today=date ("H:i");
$levelselect = @mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = @mysql_fetch_array($levelselect);
$lev=$levels["name"];
$mes = "<b>$lev $us dodelio je $nickers[1] status $ur!</b>";     
$rnd = rand(0,99999999);
@mysql_query ("Insert into room{$i} set klu4= '".$rnd."', time='".$today."', who='".$adminss[0]."', message='".$mes."', id='".$st."', towhom='', hid='0', usid='1', komu=''");
}
$levelselect = @mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = @mysql_fetch_array($levelselect);
$lev=$levels["name"];
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Pozz!!!";
$message = "Pozz <b>".$nickers[1]."</b>!!! Zaslizili ste da Vam ".$lev." <b>".$us."</b> poveca status! Sada ste <b>".$ur."!</b>.";
@mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$adminss[0]."', idwho ='1', message = '".$message."', towhom = '".$nickers[1]."', idtowhom = '".$nickers[0]."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je izmenio status clana <b>".$objava[0]."</b> u <b>$ur</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo " ".mysql_error()."";
}
}else{
echo "Ne mozete menjati status!";
}
break;
case 'addvopr':
echo $fsize1;
echo "Pitanje:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=goaddvopr&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"vopros\" maxlength=\"255\" title=\"quest\"/><br/>\n";  
echo $fsize1;
echo "Odgovor:<br/>\n";
echo $fsize2;
echo "<input name=\"answ\" maxlength=\"60\" title=\"answ\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=goaddvopr&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"vopros\" value=\"$(vopros)\"/>\n";  
echo "<postfield name=\"answ\" value=\"$(answ)\"/>\n";  
echo "</go></anchor>\n"; 
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;
case 'editlogo':
echo $fsize1;
echo "<div class=\"d1\">";
echo "Logo index:<br/>";
echo "</div>";
$logologo = mysql_fetch_array(mysql_query("SELECT logo2 FROM setting"));
echo "<img src=\"$logologo[0]\" alt=\"$ime\" /><br/><br/>";
echo "<a href=\"uploadlogoi.php?action=uploader&amp;$ses&amp;rm=$rm&amp;ref=$ref\">Uploduj logo</a><br/>\n";
echo "Logo hodnik:<br/>";
$logologo = mysql_fetch_array(mysql_query("SELECT logo FROM setting"));
echo "<img src=\"$logologo[0]\" alt=\"$ime\" /><br/><br/>";
echo "<a href=\"uploadlogo.php?action=uploader&amp;$ses&amp;rm=$rm&amp;ref=$ref\">Uploduj logo</a><br/>\n";
echo "Novi Logo:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=editlogo1&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"logo\" maxlength=\"255\" title=\"logo\" value=\"$logologo[0]\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=editlogo1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"logo\" value=\"$(logo)\"/>\n";  
echo "</go></anchor>\n"; 
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;
case 'editpoeni':
echo $fsize1;
echo "Tranutni broj poena za dobrodoslicu:<br/>";
$logologo = mysql_fetch_array(mysql_query("SELECT poeni FROM setting"));
echo "Upisi kolicinu:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=editpoeni1&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"logo\" maxlength=\"255\" title=\"logo\" value=\"$logologo[0]\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=editpoeni1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"logo\" value=\"$(logo)\"/>\n";  
echo "</go></anchor>\n"; 
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;
case 'valid':
$to=$_GET["to"];
if($row["level"]>=6){
if($to!=""){
mysql_query ("UPDATE users SET valid='1' WHERE id='".$to."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je potvrdio registraciju clana sa ID: $to!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Registracija je potvrdjena!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti id!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete potvrdjivati registraciju!<br/>\n";
echo $fsize2;
}
break;
case 'valid1':
$to=$_GET["to"];
if($row["level"]>6){
if($to!=""){
mysql_query ("DELETE FROM users WHERE id='".$to."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je odbio registraciju clana sa ID: $to!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Registracija je odbijena!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti id!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete potvrdjivati registraciju!<br/>\n";
echo $fsize2;
}
break;
case 'editlogo1':
$logo=$_POST["logo"];
if($row["level"]>6){
if($logo || $logo!=""){
mysql_query ("UPDATE setting SET logo='".$logo."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio logo!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Logo je izmenjen!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Novi Logo!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati logo!<br/>\n";
echo $fsize2;
}
break;
case 'editpoeni1':
$logo=$_POST["logo"];
if($row["level"]>6){
if($logo || $logo!=""){
mysql_query ("UPDATE setting SET poeni='".$logo."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio broj poena!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Poeni izmenjeni!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti nove poene!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati poene!<br/>\n";
echo $fsize2;
}
break;
case 'gallery':
$gallery = mysql_fetch_array(mysql_query("SELECT gallery, gtext, gtitle FROM setting"));
$naslov=htmlspecialchars("$gallery[2]");
$tekst=htmlspecialchars("$gallery[1]");
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=gallery1&amp;$ses$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Naslov:<br/>\n";
echo $fsize2;
echo "<input name=\"naslov\" maxlength=\"255\" title=\"naslov\" value=\"$gallery[2]\"/><br/>\n";
echo $fsize1;
echo "Tekst:<br/>\n";
echo $fsize2;
echo "<input name=\"tekst\" maxlength=\"255\" title=\"tekst\" value=\"$gallery[1]\"/><br/>\n";
echo $fsize1;
echo "Ukljucena:<br/>\n";
echo $fsize2;
echo "<select name=\"ukljucena\">\n";
if($gallery[0]==0){
echo "<option value=\"0\">Ne</option>\n";
echo "<option value=\"1\">Da</option>\n";
}else{
echo "<option value=\"1\">Da</option>\n";
echo "<option value=\"0\">Ne</option>\n";
}
echo "</select><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=gallery1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"naslov\" value=\"$(naslov)\"/>\n";  
echo "<postfield name=\"tekst\" value=\"$(tekst)\"/>\n";
echo "<postfield name=\"ukljucena\" value=\"$(ukljucena)\"/>\n";
echo "</go></anchor>\n"; 
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;
case 'gallery1':
$naslov=$_POST["naslov"];
$tekst=$_POST["tekst"];
$ukljucena=$_POST["ukljucena"];
if($row["level"]>=8){
if($naslov || $naslov!=""){
if($tekst || $tekst!=""){
mysql_query ("UPDATE setting SET gallery='".$ukljucena."', gtext='".$tekst."', gtitle='".$naslov."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio podesavanja galerije!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Podesavanja Galerije su izmenjena!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Tekst!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Naslov!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati podesavanje galerije!<br/>\n";
echo $fsize2;
}
break;
case 'razglas':
$gallery = mysql_fetch_array(mysql_query("SELECT razglas, razglas1 FROM setting"));
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=razglas1&amp;$ses$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Razglas Administracije:<br/>\n";
echo $fsize2;
echo "<select name=\"razglas\">\n";
if($gallery[0]==0){
echo "<option value=\"0\">Iskljucen</option>\n";
echo "<option value=\"1\">Ukljucen</option>\n";
}else{
echo "<option value=\"1\">Ukljucen</option>\n";
echo "<option value=\"0\">Iskljucen</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Bilbord za Vas:<br/>\n";
echo $fsize2;
echo "<select name=\"razglas1\">\n";
if($gallery[1]==0){
echo "<option value=\"0\">Iskljucen</option>\n";
echo "<option value=\"1\">Ukljucen</option>\n";
}else{
echo "<option value=\"1\">Ukljucen</option>\n";
echo "<option value=\"0\">Iskljucen</option>\n";
}
echo "</select><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=razglas1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"razglas\" value=\"$(razglas)\"/>\n";  
echo "<postfield name=\"razglas1\" value=\"$(razglas1)\"/>\n";
echo "</go></anchor>\n"; 
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;
case 'razglas1':
$razglas=$_POST["razglas"];
$razglas1=$_POST["razglas1"];
if($row["level"]>=8){
mysql_query ("UPDATE setting SET razglas='".$razglas."', razglas1='".$razglas1."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio podesavanja razglasa!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Podesavanja razglasa su izmenjena!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati podesavanje razglasa!<br/>\n";
echo $fsize2;
}
break;
case 'gornji':
$gallery = mysql_fetch_array(mysql_query("SELECT gornji, gornjilink, linklink FROM setting"));
//$naslov=htmlspecialchars("$gallery[2]");
//$tekst=htmlspecialchars("$gallery[1]");
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=gornji1&amp;$ses$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Naslov:<br/>\n";
echo $fsize2;
echo "<input name=\"naslov\" maxlength=\"255\" title=\"naslov\" value=\"$gallery[0]\"/><br/>\n";
echo $fsize1;
echo "Link:<br/>\n";
echo $fsize2;
echo "<input name=\"link\" maxlength=\"255\" title=\"link\" value=\"$gallery[1]\"/><br/>\n";
echo $fsize1;
echo "Ukljucena:<br/>\n";
echo $fsize2;
echo "<select name=\"ukljucena\">\n";
if($gallery[2]==0){
echo "<option value=\"0\">Ne</option>\n";
echo "<option value=\"1\">Da</option>\n";
}else{
echo "<option value=\"1\">Da</option>\n";
echo "<option value=\"0\">Ne</option>\n";
}
echo "</select><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=gornji1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"naslov\" value=\"$(naslov)\"/>\n";  
echo "<postfield name=\"link\" value=\"$(link)\"/>\n";
echo "<postfield name=\"ukljucena\" value=\"$(ukljucena)\"/>\n";
echo "</go></anchor>\n"; 
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;
case 'gornji1':
$naslov=$_POST["naslov"];
$link=$_POST["link"];
$ukljucena=$_POST["ukljucena"];
if($row["level"]>=8){
if($naslov || $naslov!=""){
if($link || $link!=""){
mysql_query ("UPDATE setting SET gornji='".$naslov."', gornjilink='".$link."', linklink='".$ukljucena."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio podesavanja gornjeg linka!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Podesavanja gornjeg linka su izmenjena!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Link!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Naslov!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati podesavanje linkova!<br/>\n";
echo $fsize2;
}
break;
case 'goaddvopr':
if ($row["translit"]==1){
}
$tran=strtr($answ,array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","Z"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ш"=>"w","щ"=>"w","ц"=>"c","ч"=>"4","ь"=>".","ъ"=>".","ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Z"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ш"=>"W","Щ"=>"W","Ц"=>"C","Ч"=>"4","Ь"=>".","Ъ"=>".","Ы"=>"Y","Э"=>"E","Ю"=>"Yu","Я"=>"Ya"));
$counterss = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM bots"));
mysql_query ("Insert into bots set vopros='".$vopros."', answer='".$answ."',  tran='".$tran."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao pitanje za kviz!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Pitanje je dodato!<br/>\n";
echo "Ukupno pitanja: $counterss[0] !!!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()." ";
}
break;
case 'tell':
echo $fsize1;
echo "Objava(Sve Sobe):<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=gotell&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"txt\" maxlength=\"1255\" title=\"text\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Napisi<go href=\"apanel.php?go=gotell&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"txt\" value=\"$(txt)\"/>\n";   
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Napisi\" name=\"enter\"><br/>\n";
}
break;
case 'gotell':
if ($row["translit"]==1)$txt = trun_to_rus($txt);
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = time();
for ($num = 0; $num <= 22; $num++){  
$room = "room".$num; 
$txt = "<b>$txt</b>";
if (!ctype_digit($id)) {header("Location: index.php"); die;}
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$us."', message='".$txt."', id='".$time."', towhom='', hid='0', usid='".$id."', komu=''");           }
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je napisao objavu u svim sobama!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Objava je napisana u svim sobama!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
break;
case 'fullign':
$r = mysql_query ("SELECT * from users WHERE inv = '2' ");
$a = mysql_fetch_array($r);
while ($a !== false){
$pid = $a["id"];
if (!ctype_digit($pid)) {header("Location: index.php"); die;}
mysql_query("UPDATE users set inv = '0' WHERE id = '".$pid."'");
$a = mysql_fetch_array($r);
}
echo $fsize1;
echo "Ignor Lista je ociscena!<br/>\n";
echo $fsize2;
break;
case 'clearzap':
$time = time()-604800;                                                  
mysql_query ("DELETE from zapiski WHERE time<$time");
echo $fsize1;
echo "Lista Zapisa je ociscena!<br/>\n";
echo $fsize2;
break;
case 'clbanip':
if($row["level"]>=8){
$q = mysql_query("select klu4,ip,soft, user, tip, hostname from bannlist order by klu4 desc;");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
if($arr[4]=='1' || $arr[4]=='3'){
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, Browser: ".$arr['soft']."</a><br/>";
}else if($arr[4]=='0'){
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, Browser: ".$arr['soft'].", IP: ".$arr['ip']."</a><br/>";	
}else if($arr[4]=='4'){
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, Operater: ".$arr['hostname'].", IP: ".$arr['ip']."</a><br/>";	
}else{
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, IP: ".$arr['ip']."</a><br/>";	
}
echo $divide;
echo $fsize2;
}
if (mysql_affected_rows() != 0){
echo $fsize1;
echo "<a href=\"apanel.php?$ses&amp;go=clbanip&amp;act=unbannall$takep\">Skini Sve Banove</a><br/>";
echo $fsize2;
} else { 
echo $fsize1;
echo "Browser+IP Lista je prazna!<br/>";
echo $fsize2;
}
} else if ($act=="unbannall") {
mysql_query ("DELETE from bannlist");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo sve Browser+IP banove!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Svi Browser+IP banovi su skinuti!<br/>\n";
echo $fsize2;
} else {
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM bannlist WHERE klu4='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo IP+Browser Ban clanu <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("delete from bannlist where klu4='".$nk."'")){ 
echo $fsize1;
echo "Browser+IP ban je skinut!<br/>";
echo $divide;
echo " <a href=\"apanel.php?$ses&amp;go=clbanip$takep\">Skini Jos Banova</a><br/>";
echo $fsize2;
}
}
}else{
echo $fsize1;
echo "Ne mozete skidati IP+Browser Banove!<br/>";
echo $fsize2;
}
break;
case 'clroomtime':
echo $fsize1;
echo "Sobe ce biti ociscene za 3 minuta!<br/>\n";
echo $fsize2;
if(isset($rm)) echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
$fp=fopen("log/clear.dat", "w");
fclose($fp);
$f=fopen("log/clear.dat","a+");
flock($f,LOCK_EX);
$cleardata = time() + 180;
fwrite($f,$cleardata);
fflush($f);
flock($f,LOCK_UN);
fclose($f);
$rnd = rand(0,99999999);
$mes = "<b>Obavestenje! Sve sobe ce biti ociscene za 3 minuta!</b>";
$today=date("H:i");
$time = getmicrotime();
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je najavljeno ocistio sve sobe!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
for ($num = 0; $num <= 23; $num++){
$ranec = "room".$num;
mysql_query ("Insert into $ranec set klu4= '".$rnd."', time='".$today."', who='".$row["user"]."', message='".$mes."', id='".$time."', towhom='', hid='".$row["id"]."', usid='".$row["id"]."', komu=''");
mysql_query("ANALYZE TABLE $ranec");
}
break;
case 'delpp':
if($row["level"]>=7){
echo $fsize1;
echo "Sva procitana pisma su obrisana!<br/>\n";
echo $fsize2;
if(isset($rm)){
echo $fsize1;
echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
echo $fsize2;
}
mysql_query ("DELETE FROM zapiski WHERE readd='1'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao sva procitana pisma!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete brisati pisma!<br/>\n";
echo $fsize2;
}
break;
case 'delpp2':
if($row["level"]>=8){
echo $fsize1;
echo "Sva pisma su obrisana!<br/>\n";
echo $fsize2;
if(isset($rm)){
echo $fsize1;
echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
echo $fsize2;
}
mysql_query ("TRUNCATE TABLE zapiski");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao sva pisma!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete brisati sva pisma!<br/>\n";
echo $fsize2;
}
break;
case 'pp2all':
if($row["level"]>6){
//echo $fsize1;
//echo "Tema:<br/>\n";
//echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?go=pp2allsent&amp;$ses$takep&amp;model=$model\" name=\"auth\">\n";
//echo "<input name=\"tema\" maxlength=\"30\" value=\"$name\" title=\"tema\"/><br/>\n";
$tema=time();
echo $fsize1;
echo "Text Pisma:<br/>\n";
echo $fsize2;
echo "<input name=\"text\" maxlength=\"1000\" value=\"$name\" title=\"text\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Posalji PP2ALL<go href=\"apanel.php?go=pp2allsent&amp;$ses$takep&amp;model=$model\" method=\"post\">\n";
echo "<postfield name=\"tema\" value=\"$tema\"/>\n";   
echo "<postfield name=\"text\" value=\"$(text)\"/>\n";   
echo "</go></anchor>\n";  
echo $fsize2;
echo "<br/>\n";	
}else{
echo "<input type=\"hidden\" value=\"$tema\" name=\"tema\">\n";
echo "<input type=\"submit\" value=\"Posalji PP2ALL\" name=\"enter\"><br/>\n";
}
}else{
echo $fsize1;
echo "Ne mozete slati PP2ALL!<br/>\n";
echo $fsize2;
}
break;
case 'pp2allsent':
if($row["level"]>6){
$model=$_GET["model"];
if($tema==""){$tema= time();}
else if($text==""){$msg= "Unesite Text Pisma!<br/>";}
else{$msg="Pisma su poslata!<br/>";
$maximalno = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM users"));
$i=0;
for($i; $i<$maximalno[0]; $i++)
{
if($model==1){
$naziv = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$i."'"));
}else if($model==2){
$naziv = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$i."' AND level>3"));
}else if($model==3){
$naziv = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$i."' AND sex='M'"));
}else if($model==4){
$naziv = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$i."' AND sex='Z'"));
}
if($naziv[0]){
$kol = rand(0,99999999);
$time = time();
$data = date("H:i(d-M)"); 	
mysql_query("INSERT INTO zapiski SET klu4='".$kol."', who ='".$us."', idwho ='".$id."', message = '".$text."', towhom = '".$naziv[0]."', idtowhom = '".$i."', time = '".$time."', readd = '0', topic = 'Znak chat', date='".$data."'");
}
}
}
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je poslao PP2ALL!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo $msg;
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete slati PP2ALL!<br/>\n";
echo $fsize2;
}
break;
case 'clrm':
$room = "room".$rm;
$res = @mysql_query ("Select id from $room order by id desc");
$lines = mysql_fetch_array ($res);
$kl = $lines["id"];
if (@mysql_query ("Delete from $room where id = '".$kl."'")){
echo $fsize1;
echo "Soba je ociscena!<br/>\n";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT name FROM rooms WHERE rm='".$rm."'"));
$text="$levelnamesa[0] <b>$namenski</b> je ocistio sobu <b>$objava[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
break;
case 'fullignmake':
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
$select = @mysql_query ("Select * from users where id='".$nk."'");
$inf = mysql_fetch_array ($select); 
$level = $inf["level"];
$fignik = $inf["user"];
$figid = $inf["id"];
if (($level>3)){
echo $fsize1;
echo "Ne mozete staviti Moderatore ili Administratore u potpuni Ignor!<br/>\n";
echo $fsize2;
break;
}        
if (!ctype_digit($figid)) {header("Location: index.php"); die;}
mysql_query ("UPDATE users SET inv = '2' WHERE id = '".$figid."'");
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = time();
$room = "room".$rm;
$txt = "".$us." je stavio clana <b>".$fignik."</b> u Potpuni Ignor, zbog krsenja pravila!";
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$administration."', message='".$txt."', id='".$time."', towhom='', hid='0', usid='1', komu=''");
echo $fsize1;
echo "$fignik je stavljen u Potpuni Ignor!<br/>\n";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je stavio <b>".$fignik."</b> u potpuni ignor!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
break;
case 'modlog':
if ($row["level"]>=7){
$tip=$_GET["tip"];
if($tip>0){
echo $fsize1;
if($tip==1){$naslov="Mod Log";}
else if($tip==2){$naslov="Admin Log";}
else if($tip==3){$naslov="Mod Soba";}
else if($tip==4){$naslov="Admin Soba";}
else if($tip==5){$naslov="Intimna Soba";}
else if($tip==6){$naslov="Clanovi Log";}
else if($tip==7){$naslov="Pogresno logovanje";}
else if($tip==10){$naslov="Upad u nik chatera";}
echo "<b>$naslov</b><br/>";
echo $divide;
echo $fsize2;
$brojcano = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='".$tip."'"));
$start=(($page-1)*5);
if($brojcano[0]<=5){$page=1;}
if($start>$brojcano[0]){$start=$brojcano[0]-1;}
$vreme=time();
$stranice=$brojcano[0]/5;
$q = mysql_query("SELECT text, time FROM modlog WHERE type='".$tip."' ORDER BY id DESC LIMIT $start, 5");
echo $fsize1;
$st5=$start+5;
if($st5>$brojcano[0]){$st5=$brojcano[0];}
$star=$start+1;
echo "Prikazuje $star-$st5 od $brojcano[0]<br/>";
echo $divide;
while($arr=mysql_fetch_array($q)) {
echo "$arr[0]<br/>Vreme: ".date("d-m-Y H:i",$arr[1])."<br/>";
echo $divide;
}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"apanel.php?$ses&amp;go=modlog&amp;page=$ppage$takep&amp;tip=$tip\">&#171;Nazad</a> ";
    }
    if($page<$stranice)
    {
      $npage = $page+1;
      echo "<a href=\"apanel.php?$ses&amp;go=modlog&amp;page=$npage$takep&amp;tip=$tip\">Napred&#187;</a>";
    }
    echo "<br/>";
	if ($row["level"]>=8){
	echo "<a href=\"apanel.php?$ses&amp;go=delmodlog$takep\">Obrisi Sve Logove</a><br/>";
	}
	echo $fsize2;
	}else{
	echo $fsize1;
	echo "<b>Mod Log</b><br/>";
	echo $divide;
	$soba6 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='6'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=6&amp;page=1\">Clanovi Log($soba6[0])</a>";
	if($row["level"]>=8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=6&amp;go=modbris$takep\">x</a> ]\n";
    }
    echo "<br/>";
	$soba1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='1'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=1&amp;page=1\">Mod Log($soba1[0])</a>";
	if($row["level"]>=8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=1&amp;go=modbris$takep\">x</a> ]\n";
    }
    echo "<br/>";
	$soba2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='2'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=2&amp;page=1\">Admin Log($soba2[0])</a>";
	if($row["level"]>=8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=2&amp;go=modbris$takep\">x</a> ]\n";
    }
    echo "<br/>";
	$soba3 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='3'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=3&amp;page=1\">Mod Soba($soba3[0])</a>";
	if($row["level"]>=8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=3&amp;go=modbris$takep\">x</a> ]\n";
    }
    echo "<br/>";
	$soba4 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='4'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=4&amp;page=1\">Admin Soba($soba4[0])</a>";
	if($row["level"]>=8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=4&amp;go=modbris$takep\">x</a> ]\n";
    }
    echo "<br/>";
	$soba5 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='5'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=5&amp;page=1\">Intimna Soba($soba5[0])</a>";
	if($row["level"]>=8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=5&amp;go=modbris$takep\">x</a> ]\n";
    }
    echo "<br/>";
	$soba5 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='7'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=7&amp;page=1\">Pogresno logovanje($soba5[0])</a>";
	if($row["level"]>=8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=7&amp;go=modbris$takep\">x</a> ]\n";
    }
    echo "<br/>";
	
	$soba5 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='8'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=8&amp;page=1\">Obrisani postovi($soba5[0])</a>";
	if($row["level"]>=8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=8&amp;go=modbris$takep\">x</a> ]\n";
    }
    echo "<br/>";
	if($row["level"]>=8){
	$soba5 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='9'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=9&amp;page=1\">Reklame ($soba5[0])</a>";
	//if($row["level"]>=8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=9&amp;go=modbris$takep\">x</a> ]\n";
    }
    echo "<br/>";
	if($row["level"]==8){
	$soba10 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='10'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=10&amp;page=1\">Upad u nik ($soba10[0])</a>";}
	if($row["level"]==8){
    echo " [ <a href=\"apanel.php?$ses&amp;to=10&amp;go=modbris$takep\">x</a> ]\n";
    }
	echo $fsize2;
	}
}else{
echo $fsize1;
echo "Ne mozete videti Mod Log!<br/>";
echo $fsize2;
}
break;
case 'modbris':
$to=$_GET["to"];
if($row["level"]>=8){
if($to!=""){
mysql_query ("DELETE FROM modlog WHERE type='".$to."'");
if (mysql_error() == false){
echo $fsize1;
echo "Log je ociscen!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti id!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete cistiti log!<br/>\n";
echo $fsize2;
}
break;
case 'citajpp':
if ($row["level"]>=7){
echo $fsize1;
$kojeje = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
echo "<b>$kojeje[0] Pisma</b><br/>";
echo $divide;
echo $fsize2;
$brojcano = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM zapiski WHERE idwho='".$nk."' OR idtowhom='".$nk."'"));
$start=(($page-1)*5);
if($brojcano[0]<=5){$page=1;}
if($start>$brojcano[0]){$start=$brojcano[0]-1;}
$vreme=time();
$stranice=$brojcano[0]/5;
$q = mysql_query("SELECT * FROM zapiski WHERE idwho='".$nk."' OR idtowhom='".$nk."' ORDER BY time DESC LIMIT $start, 5");
echo $fsize1;
$st5=$start+5;
if($st5>$brojcano[0]){$st5=$brojcano[0];}
$star=$start+1;
echo "Prikazuje $star-$st5 od $brojcano[0]<br/>";
echo $divide;
while($arr=mysql_fetch_array($q)) {
$who = $arr ["who"];
$idwho = $arr ["idwho"];
$message = $arr ["message"]; 
$towhom = $arr ["towhom"];
$idtowhom = $arr ["idtowhom"];
$topic = $arr ["topic"];
$date = $arr ["date"];
$read = $arr ["readd"];
$kojeje1 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$idwho."'"));
$kojeje2 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$idtowhom."'"));
echo "Za <b>$kojeje2[0]</b>,\n";
echo "od <b>$kojeje1[0]</b><br/>\n";
//echo "Tema: $topic<br/>\n";
echo "Datum: $date<br/>\n";
echo "Poruka: $message<br/>\n";
echo $divide;
}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"apanel.php?$ses&amp;go=citajpp&amp;page=$ppage$takep&amp;nk=$nk\">&#171;Nazad</a> ";
    }
    if($page<$stranice)
    {
      $npage = $page+1;
      echo "<a href=\"apanel.php?$ses&amp;go=citajpp&amp;page=$npage$takep&amp;nk=$nk\">Napred&#187;</a>";
    }
    echo "<br/>";
	echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete citati tudja pisma!<br/>";
echo $fsize2;
}
break;
case 'friends':
if ($row["level"]>=7){
echo $fsize1;
$nk=$_GET["nk"];
$kojeje = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
echo "<b>$kojeje[0] Prijatelji</b><br/>";
echo $divide;
echo $fsize2;
	if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$nk."' AND ok='1' OR usid='".$nk."' AND ok='1'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    
    $sql = "SELECT id, usid FROM friends WHERE id='".$nk."' AND ok='1' OR usid='".$nk."' AND ok='1' ORDER BY klu4 DESC LIMIT $limit_start, $items_per_page ";
    print $fsize2;
	echo "</p>";
    echo "<p>";
    print $fsize1;
    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
if($item[0]==$nk){
$kojeje1 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[1]."'"));
$isis=$item[1];
}else{
$kojeje1 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));
$isis=$item[0];
}
echo "<a href=\"info.php?$ses&amp;nk=$isis&amp;ref=$ref\">$kojeje1[0]</a><br/>";
    }
    }
    print $fsize2;
    echo "</p>";
    echo "<p align=\"center\">";
    print $fsize1;
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"apanel.php?$ses&amp;go=friends&amp;nk=$nk$takep&amp;page=$ppage&amp;rm=$rm\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"apanel.php?$ses&amp;go=friends&amp;nk=$nk$takep&amp;page=$npage&amp;rm=$rm\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
	//echo "$noi[0] prijatelja<br/>";
	echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete citati tudja pismaa!<br/>";
echo $fsize2;
}
break;
case 'delmodlog':
if($row["level"]>=8){
mysql_query("truncate table `modlog`");
echo $fsize1;
echo "Mod Log je obrisan!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao Mod Log!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete obrisati Mod Log!<br/>";
echo $fsize2;
}
break;
case 'clbanniks':
$fp=fopen("log/bannlist.dat", "w");
fclose($fp);
@mysql_query ("update users set banned = '0' where banned = '1' ");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo sve banove!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Svi Banovi su skinuti!<br/>\n";
echo $fsize2;
break;
case 'clpinniks':
$fp=fopen("log/pinlist.dat", "w");
fclose($fp);
@mysql_query ("UPDATE users SET kik = '0', whokik = '', whykik = ''  where kik!='0'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo sve kickove!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Svi Kickovi su skinuti!<br/>\n";
echo $fsize2;
break;
case 'clearlogs':
//$fp=fopen("log/intim.dat", "w");
//fclose($fp);
//$fp=fopen("log/admroom.dat", "w");
//fclose($fp);
//$fp=fopen("log/admlog.dat", "w");
//fclose($fp);
//$fp=fopen("log/stlog.dat", "w");
fclose($fp);
$fp=fopen("log/bannlist.dat", "w");
fclose($fp);
$fp=fopen("log/banniplist.dat", "w");
fclose($fp);
$fp=fopen("log/pinlist.dat", "w");
fclose($fp);
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je ocistio logove!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Svi logovi su ocisceni!<br/>\n";
echo $fsize2;
break;
case 'unban':
$q = mysql_query("select id,user from users where banned='1' order by id desc;");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=unbann&amp;$ses&amp;go=unban&amp;nk=".$arr['id']."$takep\">".$arr['user']."</a><br/>";
echo $fsize2;
}
if (mysql_affected_rows() != 0){
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=clbanniks$takep\">Skini Sve Banove</a><br/>";
echo $fsize2;
} else { 
echo $fsize1;
echo "Lista Banovanih clanova je prazna!<br/>";
echo $fsize2;
}
} else {
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
if(mysql_query("update users set banned = '0' where id='".$nk."'")){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$clanclan = mysql_fetch_array(mysql_query("SELECT name FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo ban clanu<b>$clanclan[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Ban je skinut!<br/>";
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=unban$takep\">Skini Jos Banova</a><br/>";
echo $fsize2;
}
}
break;
case 'delrazglas':
if($row["level"]>=8){
$q = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM shoutbox WHERE id='".$kod."'"));
if ($q[0]==0) {
echo $fsize1;
echo "Ovaj razglas ne postoji!<br/>\n";
echo $fsize2;
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$clanclan = mysql_fetch_array(mysql_query("SELECT message FROM shoutbox WHERE id='".$kod."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao razglas <b>$clanclan[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='12'");
///////////////////////////////////////////////////////////////////// 
if(mysql_query("DELETE FROM shoutbox WHERE id='".$kod."'")){
echo $fsize1;
echo "Razglas je obrisan!<br/>";
echo $fsize2;
}
}
}else{
echo $fsize1;
echo "Ne mozete brisati Razglas!";
echo $fsize2;
}
break;
case 'unpin':
$q = mysql_query("select id,user from users where kik!='0' order by id desc;");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=unbann&amp;$ses&amp;go=unpin&amp;nk=".$arr['id']."$takep\">".$arr['user']."</a><br/>";
echo $fsize2;
}
if (mysql_affected_rows() == 0){
echo $fsize1;
echo "Lista Kickovanih je prazna!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=clpinniks$takep\">Skini Sve Kickove</a><br/>";
echo $fsize2;
}
} else {
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
if(mysql_query("UPDATE users SET kik = '0', whokik = '', whykik = ''  where id='".$nk."'")){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$clanclan = mysql_fetch_array(mysql_query("SELECT name FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo kick clanu<b>$clanclan[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
print $fsize1;
echo "Kick je skinut!<br/>";
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=unpin$takep\">Skini Jos Kickova</a><br/>";
echo $fsize2;
}
}
break;
case 'delrooms':
if($row["level"]>=8){
$q = mysql_query("SELECT name FROM rooms WHERE rm='".$rms."'");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Ova soba ne postoji!<br/>\n";
echo $fsize2;
} else {
$nazivni=mysql_fetch_array($q);
if(mysql_query("DELETE FROM rooms WHERE rm='".$rms."'")){ 
echo $fsize1;
echo "Soba je obrisana!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao sobu <b>$nazivni[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}
}
}else{
echo $fsize1;
echo "Ne mozete brisati sobu!";
echo $fsize2;
}
break;
case 'editrooms':
$q = mysql_query("select rm,name from rooms");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=rnm&amp;$ses&amp;go=editrooms&amp;rms=".$arr['rm']."$takep\">".$arr['rm'].". ".$arr['name']."</a><br/>";
if($row["level"]>=8){
echo "<small><a href=\"apanel.php?$ses&amp;go=delrooms&amp;rms=".$arr['rm']."$takep\">[Obrisi]</a></small><br/><br/>";
}
echo $fsize2;
}
} elseif ($act=="dornm") {
if (!ctype_digit($rms)) {header("Location: index.php"); die;}
$q = mysql_query("select name from rooms where rm='".$rms."'");
$arrrr=mysql_fetch_array($q);
$namerrr=$arrrr["name"];
$roomname = check($roomname);
$roomname = mysql_escape_string($roomname);
mysql_query ("update rooms set name='".$roomname."' where rm='".$rms."'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je izmenio naziv sobe <b>$namerrr</b> u <b>$roomname</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Soba je uspesno izmenjena!<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editrooms$takep\">Lista Soba</a><br/>";
echo $fsize2;
} else {
if (!ctype_digit($rms)) {header("Location: index.php"); die;}
$q = mysql_query("select name from rooms where rm='".$rms."'");
$arr=mysql_fetch_array($q);
$name=$arr["name"];
echo $fsize1;
echo "Naziv Sobe:<br/>\n";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?act=dornm&amp;$ses&amp;go=editrooms&amp;rms=$rms$takep\" name=\"auth\">\n";
echo "<input name=\"roomname\" maxlength=\"200\" value=\"$name\" title=\"roomname\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?act=dornm&amp;$ses&amp;go=editrooms&amp;rms=$rms$takep\" method=\"post\">\n";
echo "<postfield name=\"roomname\" value=\"$(roomname)\"/>\n";   
echo "</go></anchor>\n";  
echo $fsize2;
echo "<br/>\n";	
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=editrooms$takep\">Lista Soba</a><br/>";
echo $fsize2;
}
break;
case 'editposroom':
if(empty($act)) {
echo $fsize1;
echo "Soba:<br/>";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?act=update&amp;$ses&amp;go=editposroom$takep\" name=\"auth\">\n";
echo "<select name=\"name\">";
$q = @mysql_query("select * from rooms;");
while ($dbdata = @mysql_fetch_array($q)) {
$rm=$dbdata["rm"];
$val1=$dbdata["name"];
echo "<option value=\"".$rm."\">".$val1."</option>"; 
}
echo "</select><br/>";
echo $fsize1;
echo "Pozicija:<br/>";
echo $fsize2;
echo "<input size=\"4\" name=\"pos\" format=\"*N\"/><br/>";
if ($ver=="wml"){ 
echo $fsize1;
echo "<anchor>Izmeni<go href=\"apanel.php?act=update&amp;$ses&amp;go=editposroom$takep\" method=\"post\">";
echo "<postfield name=\"name\" value=\"$(name)\"/>";
echo "<postfield name=\"pos\" value=\"$(pos)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
} else {
if (!ctype_digit($pos)) {header("Location: index.php"); die;}
if (!ctype_digit($name)) {header("Location: index.php"); die;}
if(@mysql_query("update rooms set pozicija='".$pos."' where rm='".$name."';")){
$q = mysql_query("select name from rooms where rm='".$name."'");
$arrrr=mysql_fetch_array($q);
$namerrr=$arrrr["name"];
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio poziciju sobe <b>$namerrr</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
///////////////////////////////////////////////////////////////////// 
echo $fsize1;
echo "Pozicija sobe je izmenjena!<br/>";
echo $fsize2;
}
}
break;
case 'bots':
$setting = @mysql_query ("Select * from setting where klu4=1");
$set = mysql_fetch_array ($setting);
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updbots$takep\" name=\"auth\">\n";
echo $fsize1;
echo "<div class=\"d1\">";
echo "<b>Opcije Registracije</b><br/>\n";
echo "</div>";
echo "Registracija:<br/>\n";
echo $fsize2;
echo "<select name=\"reg\">\n";
if($set["reg"] == 0){
echo "<option value=\"0\">Zakljucana</option>\n";
echo "<option value=\"1\">Otkljucana</option>\n";
} else {
echo "<option value=\"1\">Otkljucana</option>\n";
echo "<option value=\"0\">Zakljucana</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo "Anonymouse(Opera...):<br/>\n";
echo $fsize2;
echo "<select name=\"banban\">\n";
if($set["banban"] == 0){
echo "<option value=\"0\">Zakljucano</option>\n";
echo "<option value=\"1\">Otkljucano</option>\n";
} else {
echo "<option value=\"1\">Otkljucano</option>\n";
echo "<option value=\"0\">Zakljucano</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo "Validacija Registracije:<br/>\n";
echo $fsize2;
echo "<select name=\"valid\">\n";
if($set["valid"] == 0){
echo "<option value=\"0\">Iskljuceno</option>\n";
echo "<option value=\"1\">Ukljuceno</option>\n";
} else {
echo "<option value=\"1\">Ukljuceno</option>\n";
echo "<option value=\"0\">Iskljuceno</option>\n";
}           
echo "</select><br/>\n";

echo $fsize1;
echo "Sigurnosna registracija:<br/>\n";
echo $fsize2;
echo "<select name=\"sigurnareg\">\n";
if($set["sigurnareg"] == 0){
echo "<option value=\"0\">Zakljucana</option>\n";
echo "<option value=\"1\">Otkljucana</option>\n";
} else {
echo "<option value=\"1\">Otkljucana</option>\n";
echo "<option value=\"0\">Zakljucana</option>\n";
}           
echo "</select><br/>\n";
//
echo $fsize1;
echo "Vreme cekanja za ip:<br/>\n"; 
echo $fsize2;
echo "<input name=\"iptime\" maxlength=\"10\" value=\"$set[iptime]\" title=\"iptime\"/><br/>\n"; 
//
echo $fsize1;
echo "Vreme cekanja za browser:<br/>\n"; 
echo $fsize2;
echo "<input name=\"softtime\" maxlength=\"10\" value=\"$set[softtime]\" title=\"softtime\"/><br/>\n"; 
//
echo $fsize1;
########
echo "Online trajanje(sec):<br/>\n";
echo $fsize2;
echo "<select name=\"onlinet\">\n";
if($set["onlinet"] === "300"){
echo "<option value=\"300\">300</option>\n";
}
elseif($set["onlinet"] === "600"){
echo "<option value=\"600\">600</option>\n";
}
elseif($set["onlinet"] === "1800"){
echo "<option value=\"1800\">1800</option>\n";
}
elseif($set["onlinet"] === "18000"){
echo "<option value=\"18000\">18000</option>\n";
}
echo "<option value=\"300\">300</option>\n";
echo "<option value=\"600\">600</option>\n";
echo "<option value=\"1800\">1800</option>\n";
echo "<option value=\"18000\">18000</option>\n";
echo "</select><br/>\n";
echo $fsize1;
########
########
echo "Online trajanje 30min:<br/>\n";
echo $fsize2;
echo "<select name=\"onlinett\">\n";
if($set["onlinett"] === "1800"){
echo "<option value=\"1800\">1800</option>\n";
}
elseif($set["onlinett"] === "3600"){
echo "<option value=\"3600\">3600</option>\n";
}
elseif($set["onlinett"] === "7200"){
echo "<option value=\"7200\">7200</option>\n";
}
elseif($set["onlinett"] === "14400"){
echo "<option value=\"14400\">14000</option>\n";
}
echo "<option value=\"1800\">1800</option>\n";
echo "<option value=\"3600\">3600</option>\n";
echo "<option value=\"7200\">7200</option>\n";
echo "<option value=\"14400\">14400</option>\n";
echo "</select><br/>\n";
echo $fsize1;
########
echo $divide;
echo "<div class=\"d1\">";
echo "<b>Opcije Botova</b><br/>\n";
echo "</div>";
echo "Gledati Odgovor:<br/>\n";
echo $fsize2;
echo "<select name=\"vict\">\n";
if($set["vict"] == 0){
echo "<option value=\"0\">Ne</option>\n";
echo "<option value=\"1\">Da</option>\n";
} else {
echo "<option value=\"1\">Da</option>\n";
echo "<option value=\"0\">Ne</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo "Interval Profesora(sec):<br/>\n";
echo $fsize2;
echo "<select name=\"victint\">\n";
if($set["victint"] === "5"){
echo "<option value=\"5\">5</option>\n";
}
elseif($set["victint"] === "30"){
echo "<option value=\"30\">30</option>\n";
}
elseif($set["victint"] === "60"){
echo "<option value=\"60\">60</option>\n";
}
elseif($set["victint"] === "120"){
echo "<option value=\"120\">120</option>\n";
}
echo "<option value=\"5\">5</option>\n";
echo "<option value=\"30\">30</option>\n";
echo "<option value=\"60\">60</option>\n";
echo "<option value=\"120\">120</option>\n";
echo "</select><br/>\n";
echo $fsize1;
echo "Zajebant:<br/>\n";
echo $fsize2;
echo "<select name=\"shut\">\n";
if($set["shut"] == 0){
echo "<option value=\"0\">Zakljucan</option>\n";
echo "<option value=\"1\">Otkljucan</option>\n";
} else {
echo "<option value=\"1\">Otkljucan</option>\n";
echo "<option value=\"0\">Zakljucan</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo "Interval Zajebanta (min):<br/>\n";
echo $fsize2;
echo "<select name=\"shutint\">\n";
if($set["shutint"] === "600"){
echo "<option value=\"600\">10</option>\n";
}
elseif($set["shutint"] === "1800"){
echo "<option value=\"1800\">30</option>\n";
}
elseif($set["shutint"] === "3600"){
echo "<option value=\"3600\">60</option>\n";
}
elseif($set["shutint"] === "7200"){
echo "<option value=\"7200\">120</option>\n";
}
echo "<option value=\"600\">10</option>\n";
echo "<option value=\"1800\">30</option>\n";
echo "<option value=\"3600\">60</option>\n";
echo "<option value=\"7200\">120</option>\n";
echo "</select><br/>\n";
echo $fsize1;
//echo "Soba drugog zajebnta:<br/>\n";
//echo "С\n"; 
//echo $fsize2;
//echo "<input size=\"2\" name=\"roomon\" maxlength=\"2\" value=\"$set[roomon]\" title=\"rmstart\"/>\n";  
//echo $fsize1;
//echo "do:\n"; 
//echo $fsize2;
//echo "<input size=\"2\" name=\"roomoff\" maxlength=\"2\" value=\"$set[roomoff]\" title=\"rmfinish\"/><br/>\n"; 
//echo $fsize1;
echo "Prodavac:<br/>\n";
echo $fsize2;
echo "<select name=\"prod\">\n";
if($set["prod"] == 0){
echo "<option value=\"0\">zakljucan</option>\n";
echo "<option value=\"1\">Otkljucan</option>\n";
} else {
echo "<option value=\"1\">Otkljucan</option>\n";
echo "<option value=\"0\">zakljucan</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo $divide;
echo "<div class=\"d1\">";
echo "<b>Imena Botova</b><br/>\n";
echo "</div>";
echo $fsize2;
$system = @mysql_fetch_array(@mysql_query ("Select user from users where id='1' LIMIT 1;"));
echo $fsize1;
echo "ID-1:\n"; 
echo $fsize2;
echo "<input name=\"system\" maxlength=\"13\" value=\"$system[0]\" title=\"System\"/><br/>\n";
$umnik = @mysql_fetch_array(@mysql_query ("Select user from users where id='2' LIMIT 1;"));
echo $fsize1;
echo "ID-2:\n";
echo $fsize2;
echo "<input name=\"umnik\" maxlength=\"13\" value=\"$umnik[0]\" title=\"Umnik\"/><br/>\n";
$shutnik = @mysql_fetch_array(@mysql_query ("Select user from users where id='3' LIMIT 1;"));
echo $fsize1;
echo "ID-3:\n"; 
echo $fsize2;
echo "<input name=\"shutnik\" maxlength=\"13\" value=\"$shutnik[0]\" title=\"Shutnik\"/><br/>\n";
$prodavec = @mysql_fetch_array(@mysql_query ("Select user from users where id='4' LIMIT 1;"));
echo $fsize1;
echo "ID-4:\n"; 
echo $fsize2;
echo "<input name=\"prodavec\" maxlength=\"13\" value=\"$prodavec[0]\" title=\"Prodavec\"/><br/>\n";
$mafia = @mysql_fetch_array(@mysql_query ("Select user from users where id='5' LIMIT 1;"));
echo $fsize1;
echo "ID-5:\n";
echo $fsize2;
echo "<input name=\"mafia\" maxlength=\"13\" value=\"$mafia[0]\" title=\"Mafia\"/><br/>\n";
$trahtenberg = @mysql_fetch_array(@mysql_query ("Select user from users where id='6' LIMIT 1;"));
echo $fsize1;
echo "ID-6:\n";
echo $fsize2;
echo "<input name=\"trahtenberg\" maxlength=\"13\" value=\"$trahtenberg[0]\" title=\"Trahtenberg\"/><br/>\n";
$robokop = @mysql_fetch_array(@mysql_query ("Select user from users where id='7' LIMIT 1;"));
echo $fsize1;
echo "ID-7:\n";
echo $fsize2;
echo "<input name=\"robokop\" maxlength=\"13\" value=\"$robokop[0]\" title=\"Robokop\"/><br/>\n";
$mat = @mysql_fetch_array(@mysql_query ("Select user from users where id='8' LIMIT 1;"));
echo $fsize1;
echo "ID-8:\n";
echo $fsize2;
echo "<input name=\"mat\" maxlength=\"13\" value=\"$mat[0]\" title=\"Mat\"/><br/>\n";
echo $fsize1;
echo $divide;
echo $fsize2;
if ($ver=="wml"){ 
echo $fsize1;
echo "<anchor title=\"go\">Sacuvaj<go href=\"apanel.php?$ses&amp;go=updbots$takep\" method=\"post\">\n";
echo "<postfield name=\"reg\" value=\"$(reg)\"/>\n";
echo "<postfield name=\"banban\" value=\"$(banban)\"/>\n";
echo "<postfield name=\"vict\" value=\"$(vict)\"/>\n";
echo "<postfield name=\"shut\" value=\"$(shut)\"/>\n";
echo "<postfield name=\"valid\" value=\"$(valid)\"/>\n";
echo "<postfield name=\"prod\" value=\"$(prod)\"/>\n";
echo "<postfield name=\"victint\" value=\"$(victint)\"/>\n";
echo "<postfield name=\"shutint\" value=\"$(shutint)\"/>\n";
echo "<postfield name=\"roomon\" value=\"1000\"/>\n";
echo "<postfield name=\"roomoff\" value=\"1001\"/>\n";
echo "<postfield name=\"system\" value=\"$(system)\"/>\n";
echo "<postfield name=\"umnik\" value=\"$(umnik)\"/>\n";
echo "<postfield name=\"shutnik\" value=\"$(shutnik)\"/>\n";
echo "<postfield name=\"prodavec\" value=\"$(prodavec)\"/>\n";
echo "<postfield name=\"mafia\" value=\"$(mafia)\"/>\n";
echo "<postfield name=\"trahtenberg\" value=\"$(trahtenberg)\"/>\n";
echo "<postfield name=\"robokop\" value=\"$(robokop)\"/>\n";
echo "<postfield name=\"mat\" value=\"$(mat)\"/>\n";
echo "<postfield name=\"sigurnareg\" value=\"$(sigurnareg)\"/>\n";
echo "<postfield name=\"iptime\" value=\"$(iptime)\"/>\n";
echo "<postfield name=\"softtime\" value=\"$(softtime)\"/>\n";
echo "<postfield name=\"onlinet\" value=\"$(onlinet)\"/>\n";
echo "<postfield name=\"onlinett\" value=\"$(onlinett)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Sacuvaj\" name=\"enter\"><br/>\n";
echo "<input type=\"hidden\" name=\"roomon\" value=\"1000\"/>\n";
echo "<input type=\"hidden\" name=\"roomoff\" value=\"1001\"/>\n";
}
break;
case 'updbots':
if (!ctype_digit($onlinet)) {header("Location: index.php"); die;}
if (!ctype_digit($onlinett)) {header("Location: index.php"); die;}
if (!ctype_digit($reg)) {header("Location: index.php"); die;}
if (!ctype_digit($sigurnareg)) {header("Location: index.php"); die;}
if (!ctype_digit($iptime)) {header("Location: index.php"); die;}
if (!ctype_digit($softtime)) {header("Location: index.php"); die;}
if (!ctype_digit($banban)) {header("Location: index.php"); die;}
if (!ctype_digit($valid)) {header("Location: index.php"); die;}
if (!ctype_digit($vict)) {header("Location: index.php"); die;}
if (!ctype_digit($shut)) {header("Location: index.php"); die;}
if (!ctype_digit($prod)) {header("Location: index.php"); die;}
if (!ctype_digit($victint)) {header("Location: index.php"); die;}
if (!ctype_digit($shutint)) {header("Location: index.php"); die;}
if (!ctype_digit($roomon)) {header("Location: index.php"); die;}
if (!ctype_digit($roomoff)) {header("Location: index.php"); die;}
$system = check($system); 
$umnik = check($umnik);
$shutnik = check($shutnik);
$prodavec = check($prodavec);
$mafia = check($mafia);
$trahtenberg = check($trahtenberg);
$robokop = check($robokop);
$mat = check($mat);
$system = mysql_escape_string($system);
$umnik = mysql_escape_string($umnik);
$shutnik = mysql_escape_string($shutnik);
$prodavec = mysql_escape_string($prodavec);
$mafia = mysql_escape_string($mafia);
$trahtenberg = mysql_escape_string($trahtenberg);
$robokop = mysql_escape_string($robokop);
$mat = mysql_escape_string($mat);
if (!isset($error)) {
$result = mysql_query ("Select * setting where klu4 = '1'");
if (mysql_affected_rows() == 0) {
$error = "Greska na bazi!";
} else {
if (mysql_query ("Update setting set reg='".$reg."', iptime='".$iptime."', softtime='".$softtime."', sigurnareg='".$sigurnareg."', banban='".$banban."', valid='".$valid."', vict='".$vict."', shut='".$shut."', prod='".$prod."', victint='".$victint."', shutint='".$shutint."', roomon='".$roomon."', roomoff='".$roomoff."', onlinet='".$onlinet."',onlinett='".$onlinett."' where klu4 ='1'")&&
mysql_query ("Update users set user='".$system."' where id = '1'")&&
mysql_query ("Update users set user='".$umnik."' where id = '2'")&&
mysql_query ("Update users set user='".$shutnik."' where id = '3'")&&
mysql_query ("Update users set user='".$prodavec."' where id = '4'")&&
mysql_query ("Update users set user='".$mafia."' where id = '5'")&&
mysql_query ("Update users set user='".$trahtenberg."' where id = '6'")&&
mysql_query ("Update users set user='".$robokop."' where id = '7'")&&
mysql_query ("Update users set user='".$mat."' where id = '8'")){
$msg = "Podesavanja registracije i botova izmenjeni!";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio podesavanja botova i registracije!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
///////////////////////////////////////////////////////////////////// 
} else {
$msg = "Greska!!!";
}
}
} else {
$error = " ".mysql_error()." ";
}
if (isset($error)) {
echo $fsize1;
echo "$error\n";
echo $fsize2;
} 
echo $fsize1;
echo "$msg<br/>\n";
echo $fsize2;
break;
case 'link':
$setting = @mysql_query ("Select * from setting where klu4=1");
$set = mysql_fetch_array ($setting);
if($set["link1"]==""){$link1="http://";}else{$link1=$set["link1"];}
if($set["link2"]==""){$link2="http://";}else{$link2=$set["link2"];}
if($set["link3"]==""){$link3="http://";}else{$link3=$set["link3"];}
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updlink$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Link 1:<br/>";
echo $fsize2;
echo "<input name=\"link1\" maxlength=\"120\" value=\"".$link1."\" title=\"link1\"/><br/>\n";  
echo $fsize1;
echo "Naziv 1:<br/>";
echo $fsize2;
echo "<input name=\"link1_name\" maxlength=\"40\" value=\"".$set["link1_name"]."\" title=\"link1_name\"/><br/>\n";  
echo $fsize1;
echo "Link 2:<br/>";
echo $fsize2;
echo "<input name=\"link2\" maxlength=\"120\" value=\"".$link2."\" title=\"link2\"/><br/>\n";  
echo $fsize1;
echo "Naziv 2:<br/>";
echo $fsize2;
echo "<input name=\"link2_name\" maxlength=\"40\" value=\"".$set["link2_name"]."\" title=\"link2_name\"/><br/>\n";  
echo $fsize1;
echo "Link 3:<br/>";
echo $fsize2;
echo "<input name=\"link3\" maxlength=\"120\" value=\"".$link3."\" title=\"link3\"/><br/>\n";  
echo $fsize1;
echo "Naziv 3:<br/>";
echo $fsize2;
echo "<input name=\"link3_name\" maxlength=\"40\" value=\"".$set["link3_name"]."\" title=\"link3_name\"/><br/>\n"; 
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?$ses&amp;go=updlink$takep\" method=\"post\">\n";
echo "<postfield name=\"link1\" value=\"$(link1)\"/>\n";
echo "<postfield name=\"link1_name\" value=\"$(link1_name)\"/>\n";
echo "<postfield name=\"link2\" value=\"$(link2)\"/>\n";
echo "<postfield name=\"link2_name\" value=\"$(link2_name)\"/>\n";
echo "<postfield name=\"link3\" value=\"$(link3)\"/>\n";
echo "<postfield name=\"link3_name\" value=\"$(link3_name)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;
case 'updlink':
if($row["level"]>=8){
$link1_name = check($link1_name); 
$link2_name = check($link2_name);
$link3_name = check($link3_name);
$link1_name = mysql_escape_string($link1_name);
$link2_name = mysql_escape_string($link2_name);
$link3_name = mysql_escape_string($link3_name);
if (!isset($error)) {
$result = mysql_query ("Select * setting where klu4 = '1'");
if (mysql_affected_rows() == 0) {
$error = "Greska!!!";
} else {
mysql_query ("Update setting set link1='".$link1."', link2='".$link2."', link3='".$link3."', link1_name='".$link1_name."', link2_name='".$link2_name."', link3_name='".$link3_name."' where klu4 = '1'");
$msg = "Linkovi su uspesno izmenjeni!";
}
} else {
$error = " ".mysql_error()." ";
}
if (isset($error)) {
echo $fsize1;
echo "$error\n";
echo $fsize2;
} 
echo $fsize1;
echo "$msg<br/>\n";
echo $fsize2;
}else{
echo $fsize1;
echo "Nemate pravo pristupa!<br/>\n";
echo $fsize2;
}
break;
case 'editlevels':
$lev = mysql_query("select level,name from levels");
if(empty($act)) {
while($arr=mysql_fetch_array($lev)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=rnm&amp;$ses&amp;go=editlevels&amp;level=".$arr['level']."$takep\">".$arr['level'].". ".$arr['name']."</a><br/>";
echo $fsize2;
}
} elseif ($act=="dornm") {
if (!ctype_digit($level)) {header("Location: index.php"); die;}
$levelname = check($levelname);
$levelname = mysql_escape_string($levelname);
settype($level, 'integer');
$clanclan = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$level."'"));
mysql_query ("update levels set name='".$levelname."' where level='".$level."'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je izmeni status <b>$clanclan[0]</b> u <b>$levelname</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
///////////////////////////////////////////////////////////////////// 
echo $fsize1;
echo "Status je izmenjen!<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">Lista Statusa</a><br/>";
echo $fsize2;
} else {
$lev = mysql_query("select name from levels where level=$level");
$arr=mysql_fetch_array($lev);
$name=$arr["name"];
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?act=dornm&amp;$ses&amp;go=editlevels&amp;level=$level$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Status:<br/>\n";
echo $fsize2;
echo "<input name=\"levelname\" maxlength=\"200\" value=\"$arr[0]\" title=\"levelname\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?act=dornm&amp;$ses&amp;go=editlevels&amp;level=$level$takep\" method=\"post\">\n";
echo "<postfield name=\"levelname\" value=\"$(levelname)\"/>\n";   
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo $fsize1;
echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">Lista Statusa</a><br/>";
echo $fsize2;
}
break;
case 'razvod':
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updrazvod$takep\" method=\"post\">\n";
echo $fsize1;
echo "Nik Muza:<br/>";
echo $fsize2;
echo "<input name=\"zhenih\" maxlength=\"12\"/><br/>";
echo $fsize1;
echo "Nik Zene:<br/>";
echo $fsize2;
echo "<input name=\"nevesta\" maxlength=\"12\"/><br/>";
if ($ver=="wml"){
echo $fsize1;				
echo "<anchor>Razvesti<go href=\"apanel.php?$ses&amp;go=updrazvod$takep\" method=\"post\">";
echo "<postfield name=\"zhenih\" value=\"$(zhenih)\"/>";
echo "<postfield name=\"nevesta\" value=\"$(nevesta)\"/>";
echo "</go></anchor>";
echo $fsize2;	
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"Razvesti\" name=\"enter\"><br/>\n";
}
break;
case 'updrazvod':
$zhenih=trim(htmlspecialchars(stripslashes($zhenih)));
$nevesta=trim(htmlspecialchars(stripslashes($nevesta)));
if(empty($zhenih)) $error=$error."<u>Zenino polje nije popunjeno!</u><br/>";
if(empty($nevesta)) $error=$error."<u>Polje Nevesta nije popunjeno!</u><br/>";
$latuser=strtolower($zhenih);
$ruser = rus_to_k($zhenih);
if($ruser==$zhenih){
$latuser = mysql_escape_string($latuser);
$result = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,para from users where latuser = '".$latuser."' and sex='M'"); 
} else {
$ruser = mysql_escape_string($ruser);
$result = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,para from users where ruser = '".$ruser."'  and sex='M'");
}
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "<u>Momak sa nadimkom <b>".$zhenih."</b> ne postoji.</u><br/>";
echo $fsize2;
break;
}
$raz=mysql_fetch_array($result);
$zhena=$raz['para'];
if ($zhena!=$nevesta){
echo $fsize1;
echo "<b>".$nevesta."</b> nije Zena za <b>".$zhenih."</b>.<br/>";
echo $fsize2;
break;
}
$latuser2=strtolower($nevesta);
$ruser2 = rus_to_k($nevesta);
if($ruser2==$nevesta){
$latuser2 = mysql_escape_string($latruser2);
$result = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,para from users where latuser = '".$latuser2."' and sex='Z'"); 
} else {
$ruser2 = mysql_escape_string($ruser2);
$result = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,para from users where ruser = '".$ruser2."' and sex='Z'");
}
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "<u>Devojka sa nikom <b>".$nevesta."</b> ne postoji.</u><br/>";
echo $fsize2;
break;
}
$raz=mysql_fetch_array($result);
$muj=$raz['para'];
if ($muj!=$zhenih){
echo $fsize1;
echo "<b>".$zhenih."</b> Navalila na muza <b>".$nevesta."</b>.<br/>";
echo $fsize2;
break;
}
if(empty($error)) {
if($zhenih!=$last_svadbi['zhenih']) {
if(mysql_query("Update users set para='' where user ='".$zhenih."'")&&mysql_query("Update users set para='' where user ='".$nevesta."'")) { 
echo $fsize1;
echo "<b>Razvod usmesno obavljen!</b><br/>"; 
echo $fsize2;
} else { 
echo $fsize1;
echo "<b>Problemi sa razvodom</b><br/>"; 
echo $fsize2;
} 
} else { 
echo $fsize1;
echo "<b>Odavno su se razveli!</b><br/>"; 
echo $fsize2;
}
} else { 
echo $fsize1;
echo $error; 
echo $fsize2;
}
break;
case 'msvadbi':
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updsvadbi$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Nik Zene:<br/>";
echo $fsize2;
echo "<input name=\"zhenih\" maxlength=\"12\"/><br/>";
echo $fsize1;
echo "Nik Muza:<br/>";
echo $fsize2;
echo "<input name=\"nevesta\" maxlength=\"12\"/><br/>";
echo $fsize1;
echo "Nesto o nevesti:<br/>";
echo $fsize2;
echo "<input name=\"frzhenih\"/><br/>";
echo $fsize1;
echo "Kuma neveste:<br/>";
echo $fsize2;
echo "<input name=\"frnevesta\"/><br/>";
echo $fsize1;
echo "Dan svadbe:<br/>";
echo $fsize2;
echo "<input size=\"2\" name=\"day\" maxlength=\"2\" format=\"*N\"/>.<input size=\"2\" name=\"month\" maxlength=\"2\" format=\"*N\"/>.<input size=\"4\" name=\"year\" maxlength=\"4\" format=\"*N\"/><br/>"; 
echo $fsize1;
echo "Vreme svadbe:<br/>";
echo $fsize2;
echo "<input size=\"2\" name=\"chs\" maxlength=\"2\" format=\"*N\"/>:<input size=\"2\" name=\"min\" maxlength=\"2\" format=\"*N\"/><br/>";
if ($ver=="wml"){ 
echo $fsize1;				
echo "<anchor>Sacuvaj<go href=\"apanel.php?$ses&amp;go=updsvadbi$takep\" method=\"post\">";
echo "<postfield name=\"zhenih\" value=\"$(zhenih)\"/>";
echo "<postfield name=\"nevesta\" value=\"$(nevesta)\"/>";
echo "<postfield name=\"frzhenih\" value=\"$(frzhenih)\"/>";
echo "<postfield name=\"frnevesta\" value=\"$(frnevesta)\"/>";
echo "<postfield name=\"day\" value=\"$(day)\"/>";
echo "<postfield name=\"month\" value=\"$(month)\"/>";
echo "<postfield name=\"year\" value=\"$(year)\"/>";
echo "<postfield name=\"chs\" value=\"$(chs)\"/>";
echo "<postfield name=\"min\" value=\"$(min)\"/>";
echo "<postfield name=\"organizatory\" value=\"$us\"/>";
echo "</go></anchor>";
echo $fsize2;	
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"Sacuvaj\" name=\"enter\"><br/>\n";
}
break;
case 'updsvadbi':
$zhenih=trim(htmlspecialchars(stripslashes($zhenih)));
$nevesta=trim(htmlspecialchars(stripslashes($nevesta)));
$frzhenih=trim(htmlspecialchars(stripslashes($frzhenih)));
$frnevesta=trim(htmlspecialchars(stripslashes($frnevesta)));
$day=trim(htmlspecialchars(stripslashes($day)));
$month=trim(htmlspecialchars(stripslashes($month)));
$year=trim(htmlspecialchars(stripslashes($year)));
$chs=trim(htmlspecialchars(stripslashes($chs)));
$min=trim(htmlspecialchars(stripslashes($min)));
if(empty($zhenih)) $error=$error."<u>Не заполнено поле Zених!</u><br/>";
if(empty($nevesta)) $error=$error."<u>Не заполнено поле Невеста!</u><br/>";
if(empty($frzhenih)) $error=$error."<u>Не заполнено поле свидетель Zениха!</u><br/>";
if(empty($frnevesta)) $error=$error."<u>Не заполнено поле свидетельница Zевесты!</u><br/>";
if(empty($day)) $error=$error."<u>Не заполнено поле число!</u><br/>";
if(empty($month)) $error=$error."<u>Не заполнено поле месяц!</u><br/>";
if(empty($year)) $error=$error."<u>Не заполнено поле год!</u><br/>";
if(empty($chs)) $error=$error."<u>Не заполнено поле часов!</u><br/>";
if(empty($min)) $error=$error."<u>Не заполнено поле минут!</u><br/>";
$latuser=strtolower($zhenih);
$ruser = rus_to_k($zhenih);
if($ruser==$zhenih){
$latuser = mysql_escape_string($latuser);
$result = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft from users where latuser = '".$latuser."' and sex='M'"); 
} else {
$ruser = mysql_escape_string($ruser);
$result = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft from users where ruser = '".$ruser."'  and sex='M'");
}
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "<u>Par sa nikom <b>".$zhenih."</b> ne postoji.</u><br/>";
echo $fsize2;
break;
}
$latuser2=strtolower($nevesta);
$ruser2 = rus_to_k($nevesta);
if($ruser2==$nevesta){
$latuser2 = mysql_escape_string($latruser2);
$result = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft from users where latuser = '".$latuser2."' and sex='Z'"); 
} else {
$ruser2 = mysql_escape_string($ruser2);
$result = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft from users where ruser = '".$ruser2."' and sex='Z'");
}
if (mysql_affected_rows() == 0) {
echo  $fsize1;
echo  "<u>Malada sa nikom <b>".$nevesta."</b> ne postoji.</u><br/>";
echo  $fsize2;
break;
}
if(empty($error)) {
if($zhenih!=$last_svadbi['zhenih']) {
$days="$day.$month.$year";
$times="$chs:$min";
if(mysql_query("insert into svadbi values(0,'".$zhenih."','".$nevesta."','".$frzhenih."','".$frnevesta."','".$days."','".$times."','".$organizatory."');")&&
mysql_query("Update users set para='".$nevesta."' where user ='".$zhenih."'")&&mysql_query("Update users set para='".$zhenih."' where user ='".$nevesta."'")) { 
 $fsize1;
echo  "<b>Svadba dodata!</b><br/>"; 
echo  $fsize2;
} else { 
echo  $fsize1;
echo  $fsize2;
} 
} else { 
echo  $fsize1;
echo  "<b>Svadba ne moze biti udaljena!</b><br/>"; 
echo  $fsize2;
}
} else { 
echo  $fsize1;
echo  $error; 
echo  $fsize2;
}
break;
case 'dsvadbi':
$q = mysql_query("select id,zhenih,nevesta,date from svadbi order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nije naznacena svadba!!!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dsvadbi&amp;mid=".$arr['id']."$takep\">Svadba ".$arr['zhenih']." &amp; ".$arr['nevesta'].". (".$arr['date'].")</a><br/>";  
echo $fsize2;
}
} else {
settype($mid, 'integer');
if(mysql_query("delete from svadbi where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "<b>Svadva obrisana!</b><br/>";
echo $fsize2;
}
}
}
break;
case 'import_fraz':
mysql_query("truncate table `bot_dialog`");
$file=file("import/bot_dialog.txt");
for($i=0;$i<count($file);$i++) {
mysql_query("insert into `bot_dialog` values(0,'".$file[$i]."');");
$count = count($file);
}
echo $fsize1;
echo "В базу залито $count Фраз для Клазнета знатоков!";
echo $fsize2;
break;
case 'import_frazi':
mysql_query("truncate table `frazi`");
$file=file("import/frazi.txt");
for($i=0;$i<count($file);$i++) {
mysql_query("insert into `frazi` values(0,'".$file[$i]."');");
$count = count($file);
}
echo $fsize1;
echo "В базу залито $count Фраз для Клазнета знатоков!";
echo $fsize2;
break;
case 'import_shutki':
mysql_query("truncate table `shutki`");
$file=file("import/shutki.txt");
for($i=0;$i<count($file);$i++) {
mysql_query("insert into `shutki` values(0,'".trim($file[$i])."');");
$count = count($file);
}
echo $fsize1;
echo "U bazi $count zezalica!";
echo $fsize2;
break;
case 'import_vopros':
//IZMENI OVO// mysql_query("truncate table `bots`");
$file=file("import/vopros.txt");
for($i=0;$i<count($file);$i++) {
$ex=explode("::",$file[$i]);
$tran=strtr(trim($ex[1]),array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","Z"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ш"=>"w","щ"=>"w","ц"=>"c","ч"=>"4","ь"=>".","ъ"=>".","ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Z"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ш"=>"W","Щ"=>"W","Ц"=>"C","Ч"=>"4","Ь"=>".","Ъ"=>".","Ы"=>"Y","Э"=>"E","Ю"=>"Yu","Я"=>"Ya"));
@mysql_query ("Select * from bots");
$k = mysql_affected_rows()+1;
mysql_query ("Insert into bots set number= '".$k."', vopros='".trim($ex[0])."', answer='".trim($ex[1])."',  tran='".$tran."'");
$count = count($file);
}
echo $fsize1;
echo "U bazi $count Pitanja!";
echo $fsize2;
break;
case 'import_anekdot':
mysql_query("truncate table `anekdot`");
$file=file("import/anekdot.txt");
for($i=0;$i<count($file);$i++) {
mysql_query("insert into `anekdot` values(0,'".trim($file[$i])."','6');");
$count = count($file);
}
echo $fsize1;
echo "Ukupnо $count аnegdota!";
echo $fsize2;
break;
case 'delsmiles':
if($row["level"]>=7){
$q = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM smilies WHERE id='".$kod."'"));
if ($q[0]==0) {
echo $fsize1;
echo "Ovaj smajli ne postoji!<br/>\n";
echo $fsize2;
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$clanclan = mysql_fetch_array(mysql_query("SELECT code FROM smilies WHERE id='".$kod."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao smajli <b>$clanclan[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
///////////////////////////////////////////////////////////////////// 
if(mysql_query("DELETE FROM smilies WHERE id='".$kod."'")){
echo $fsize1;
echo "Smajli je obrisan!<br/>";
echo $fsize2;
}
}
}else{
echo $fsize1;
echo "Ne mozete brisati smajli!";
echo $fsize2;
}
break;
}
echo $fsize1;
echo $divide;
if($go) echo "<a href=\"apanel.php?$ses$takep\">Admin CP</a><br/>\n"; 
if (isset ($rm) && $rm!="") echo "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>\n";
echo "<div class=\"d1\">";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo "</div>";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush();
?>