<?php  include("gz.php");
header("Cache-Control: no-cache");
header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Upload</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";

$action = $_GET["action"];
/////////////////////////////////////////////////////////
if($action=="uploader" && $row["level"]>=6)
{
$ima = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM smilies WHERE code='".$kod."'"));
if ($upload="upload"&&$file_name){
if (!eregi("\.(jpg|jpeg|gif|png|sis|3gp|3gpp|mp3|jar|jad)$",$file_name)){
print "<b>Ovaj tip fajla nije podrzan!!!</b>";
}else{
if (eregi("\.(php.jpg|php.jpeg|php.png|php.gif|php.jar|php.jad|php.sis|php.3gp|php.3gpp|php.mp3)$",$file_name)){
print "<b>Tvoj pokusaj uploada php fajla i hakovanje ovog portala je blokirano :) Administratori su obaveshteni ovome! :)</b><br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$ccc = mysql_fetch_array(mysql_query("select user from users WHERE id='11'"));
$adm = mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = mysql_fetch_array ($adm);
$administration = $z["user"];
$administration = check($administration);
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$tema = "Pokusaj Hakovanja";
$mss="<b>$napisao[0] je pokusao da uploaduje fajl  za hakovanje u Download kategorije !!!!</b>";
mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$us."', idwho ='".$id."', message = '".$mss."', towhom = '".$ccc[0]."', idtowhom = '11', time = '".$time."', readd = '0', topic = '".$tema."', date='".$data."', insend='0'");
die('<b>Greska pri uploadu</b></small></div></body></html>');
}
$file_name = preg_replace(
             '/[^a-zA-Z0-9\.\$\%\'\`\-\@\{\}\~\!\#\(\)\&\_\^]/'
             ,'',str_replace(array(' ','%20',"'","php"),array('_','_', "","imahackeridiotwhotriedtouploadaphpfile"),$file_name));
if(strlen($file_name)>200){ print "<b>Ime fajle je predugacko!!!</b>";
}else{
if (empty($file)) {
print "<b>Morate odabrati fajl za upload!!!</b>";
}else{
if (empty($kod)) {
print "<b>Morate upisati kod fajla!!!</b>";
}else{
if ($ima[0]>0) {
print "<b>Ovakav kod vec postoji!!!</b>";
}else{
$gta=$_GET["file_name"];
/*$pop = GetImageSize($file);
if($pop[2]==1)$file_name="$file_name.gif"; 
if($pop[2]==2)$file_name="$file_name.jpg"; 
if($pop[2]==3)$file_name="$file_name.png";*/

if (file_exists("downs/$file_name") || $gta)
			{
			echo "Fajl sa ovakvim nazivom vec postoji!!!";
			echo "<br /><small><a href=\"duploads.php?action=uploader&amp;$ses&amp;ref=$ref\">Uploaduj(xhtml)</a><br/></small>";
                  print "</div></body></html>";
			exit();
			}
/*if($pop[2]!=1&&$pop[2]!=2&&$pop[2]!=3){
echo "<b>NEISPRAVAN FAJL UBACITE ISPRAVAN FAJL MOZDA SE I UPLOADUJE :D<br/> Nece moci ove noci :D NEUSPELI POKUSAJ!!!</b><br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$ccc = mysql_fetch_array(mysql_query("select user from users WHERE id='11'"));
$adm = mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = mysql_fetch_array ($adm);
$administration = $z["user"];
$administration = check($administration);
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Pokusaj Hakovanja";
$mss="<b>$napisao[0] je pokusao da uploaduje fajl  za hakovanje u Download kategorije !!!!</b>";
mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$us."', idwho ='".$id."', message = '".$mss."', towhom = '".$ccc[0]."', idtowhom = '11', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."', insend='0'");
			echo "<br /><small><a href=\"duploads.php?action=uploader&amp;$ses&amp;ref=$ref\">Uploaduj(xhtml)</a><br/></small>";
            echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
            echo "</div></body></html>";
			exit();
			}*/                      
copy("$file", "downs/$file_name") or
die("Neuspesno kopiranje fajle!!!");
$adds = mysql_query("INSERT INTO downs SET code='".$kod."', url='downs/".$file_name."', tip='".$tip."'");
    if ($adds) {
          echo "Fajla $file_name uspesno uploadovan!!!<br/>";

         } else {

              echo "Pokusajte ponovo!!!<br/>";
           }


echo "Fajl je uspesno ubacen u listu!!!";
}
}
}
}
}
}
?>
<?php
echo "<form align=\"center\" action=\"duploads.php?action=uploader&amp;$ses&amp;ref=$ref\" method=\"post\" ENCTYPE=\"multipart/form-data\">
Izaberite Fajl:<input type=\"file\" name=\"file\" size=\"30\"/><br/>
Kod:<input name=\"kod\" size=\"30\"/><br/>
Tip:<select name=\"tip\" value=\"1\">
<option value=\"1\">Java Aplikacije</option>
<option value=\"2\">Symbian Aplikacije</option>
<option value=\"3\">Mp3 Muzika</option>
<option value=\"4\">3gp Video</option>
<option value=\"5\">Slicice</option>
</select><br/>
<input type=\"submit\" value=\"Uploaduj!\"/><br/><br/>";
echo "<a href=\"downs.php?$ses&amp;rm=$rm&amp;ref=$ref\">Download Kategorije</a><br/>";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
}
$ggggg=$row["gzip"];
if($ggggg=="1"){
include("gzip.php");
}
/////////////////////////////////////////////////////////
echo "</form></div></body></html>";
?>