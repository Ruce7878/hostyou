<?php

header('Cache-Control: no-store, no-cache, must-revalidate');
header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
$ggggg=$row["gzip"];
if($ggggg=="1"){
include("gz.php");
}
$user=$row["user"];
$sex = mysql_fetch_array(mysql_query("SELECT sex FROM users WHERE id='".$id."'"));
if (($ver=="wml")||($ver=="xhtml")){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"enter\" title=\"$nazivsajta\">";
echo "<p align=\"center\">";
}else if ($ver=="xhtml"){
 echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">\n";
 echo "<meta name=\"viewport\" content=\"width=device-width, minimum-scale=1.0, maximum-scale=1.0\" />\n";
echo "<meta http-equiv=\"Content-Type\" content=\"application/vnd.wap.xhtml+xml; charset=utf-8\" />\n"; 
echo "<meta name=\"HandheldFriendly\" content=\"true\" />\n"; 
echo "<meta name=\"apple-mobile-web-app-capable\" content=\"yes\" /> \n";
  echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head>";
if($row["css"]!=""){
$csss=$row["css"];
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$csss\"/>";
}else{
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
}
echo "<title>$nazivsajta</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/></head><body>";
echo "<div align=\"center\">";
echo $fsize2;
}
}
echo $divide;
echo $fsize2;
$id=$_GET["id"];
$ps=$_GET["ps"];
$mess=$_GET["mess"];
///////////////////////////////////////////
$gde="Salje Pismo";
include("gde.php");
///////////////////////////////////////////
///////////////////////////////////////////
$posts = mysql_fetch_array(mysql_query("SELECT id, posts FROM `users` WHERE id='".$id."'"));
if($posts[1]<'500'){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>";
echo "<card id=\"vypnut\" title=\"Upozorenje\" ontimer=\"index.php?ref=$ref\"><timer value=\"300\"/>";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Upozorenje</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<b>Dok ne sakupite 500 postova ne mozete koristiti ovu opciju!</b><br/>";
$admer = mysql_query("UPDATE users SET gde='room11' WHERE id='".$id."' LIMIT 1;");
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
exit;
}

if ($upload="upload"&&$superdat_name){
if (eregi("\.(mid|gif|bmp|midi|3gp|mp3|wav|jar|jad|m4a|jpeg|jpg|mpg|rtf|txt|doc|gif|jpg|jpeg|bmp|Gif|Jpeg|mpeg|sis|mmf|nth|thm|amr|png|wbmp|pdf|mp4|avi|zip|rar|7z|sisx)$",$superdat_name)){
if (eregi("\.(php.jpg|php.jad|php.jar|php.gif)$",$superdat_name)){
print "<b>Tvoj pokusaj uploada php fajla i hakovanje ovog portala je blokirano :) Administratori su obaveshteni ovome! :)</b>";
$sqlstaff=mysql_query("SELECT id FROM users WHERE level>=7");
while($kow=mysql_fetch_array($sqlstaff))
{
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$mss="<b>Korisnik je upravo pokusao da uploaduje fajl koji moze biti alat za hakovanje. Obratite se korisniku i odstranite ga. Njegov nick je  ".$user."</b>";
$ccc = mysql_fetch_array(mysql_query("select user from users WHERE id='1661'"));
@mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$us."', idwho ='".$id."', message = '".$mss."', towhom = '".$ccc[0]."', idtowhom = '1661', time = '".$time."', readd = '0', topic = '".$tema."', date='".$data."', insend='0'");

}
$id = intval($_GET["id"]);
$ps = check($_GET["ps"]);
$ver = check($_GET["ver"]);
$uid = $id;
$brws = explode(" ",$HTTP_USER_AGENT);
$uip = getip();
$time = time();
  $newtime = date("H:i",$time);
  $date = strtotime('+0 hours');
$newdate = date('D jS M y',$date);
$master = getnick_uid(getuid_sid($sid));
mysql_query("INSERT INTO log__chat SET action='PogresanUpload', details='<br/><u><b>$master</b></u><br/><b>Ime fajla:</b>$superdat_name<br/> <b>Browser:</b> $brws<br/> <b>IP:</b> $uip<br/>', actdt='".time()."'");
print "<b>Ovaj pokusaj je ubacen u log!</b><br/>";
print "<b>Vrsta fajla nije podrzana! </b>"; 
die('<b>Greska pri uploadu</b></small></div></body></html>');
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 
$superdat_name = preg_replace(
             '/[^a-zA-Z0-9\.\$\%\'\`\-\@\{\}\~\!\#\(\)\&\_\^]/'
             ,'',str_replace(array(' ','%20',"'","php"),array('_','_', "","imahackeridiotwhotriedtouploadaphpfile"),$superdat_name));
if(strlen($superdat_name)>255){ print "<b>Ime fajla je predugacko!</b>";


			echo "<br/><a href=\"fotopp.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;mess=$mess&amp;who=$who\">Uploaduj(xhtml)</a><br/>";
			echo $divide;
            if($mess=="new"){
			echo "<a href=\"send.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;to=$who\">Pismo</a><br/>\n";
			}else{
            echo "<a href=\"read.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;im=$mess&amp;s=1&amp;ref=$ref\">Pismo</a><br/>";
			}
            echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
            echo "</div></body></html>";
			exit();
}else{
if (empty($superdat)) {
			echo "Morate odabrati sliku!!!<br/>";
			echo "<br/><a href=\"fotopp.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;mess=$mess&amp;who=$who\">Uploaduj(xhtml)</a><br/>";
			echo $divide;
            if($mess=="new"){
			echo "<a href=\"send.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;to=$who\">Pismo</a><br/>\n";
			}else{
            echo "<a href=\"read.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;im=$mess&amp;s=1&amp;ref=$ref\">Pismo</a><br/>";
			}
            echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
            echo "</div></body></html>";
			exit();
}else{
$exter = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM fotopp WHERE file='".$superdat_name."' AND time='".time()."'"));
$gta=$_GET["file_name"];
$sizerrr = filesize($superdat);
$parrrrr = GetImageSize($superdat);
if ($sizerrr>900600)
			{
			echo "Velicina slike je prevelika!!!<br/>";
			echo "<br/><a href=\"fotopp.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;mess=$mess&amp;who=$who\">Uploaduj(xhtml)</a><br/>";
			echo $divide;
            if($mess=="new"){
			echo "<a href=\"send.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;to=$who\">Pismo</a><br/>\n";
			}else{
            echo "<a href=\"read.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;im=$mess&amp;s=1&amp;ref=$ref\">Pismo</a><br/>";
			}
            echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
            echo "</div></body></html>";
			exit();
			}
if ($parrrrr[0]>1024 || $parrrrr[1]>1024)
			{
			echo "Rezolucija slike je prevelika!!!<br/>";
			echo "<br/><a href=\"fotopp.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;mess=$mess&amp;who=$who\">Uploaduj(xhtml)</a><br/>";
			echo $divide;
            if($mess=="new"){
			echo "<a href=\"send.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;to=$who\">Pismo</a><br/>\n";
			}else{
            echo "<a href=\"read.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;im=$mess&amp;s=1&amp;ref=$ref\">Pismo</a><br/>";
			}
            echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
            echo "</div></body></html>";
			exit();
			}
if ($exter[0]>0 || $gta)
			{
			echo "Slika sa ovakvim nazivom vec postoji!!!<br/>";
			echo "<br/><a href=\"fotopp.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;mess=$mess&amp;who=$who\">Uploaduj(xhtml)</a><br/>";
			echo $divide;
            if($mess=="new"){
			echo "<a href=\"send.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;to=$who\">Pismo</a><br/>\n";
			}else{
            echo "<a href=\"read.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;im=$mess&amp;s=1&amp;ref=$ref\">Pismo</a><br/>";
			}
            echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
            echo "</div></body></html>";
			exit();
			}
$aaaaaa = mysql_query("INSERT INTO fotopp SET uid='".$id."', mess='".$mess."', time='".time()."', file='$superdat_name'");
copy("$superdat", "fotopp/$superdat_name")
 or
die("Fajl je nemoguce kopirati!!!");
if ($aaaaaa) {
echo "<b>Slika $superdat_name</b> je uspesno uploadovana!<br/><br/>";
//echo "<a href=\"fotopp.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;mess=$mess\">Uploaduj(xhtml)</a><br/>";
if($mess=="new"){
$mojne = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM fotopp WHERE file='".$superdat_name."' AND uid='".$id."'"));
			echo "<a href=\"send.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;to=$who&amp;foto=$mojne[0]\">Pismo</a><br/>\n";
			}else{
			$mojne = mysql_fetch_array(mysql_query("SELECT id FROM fotopp WHERE file='".$superdat_name."' AND mess='".$mess."' AND uid='".$id."'"));
            echo "<a href=\"read.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;im=$mess&amp;s=1&amp;ref=$ref&amp;foto=$mojne[0]\">Pismo</a><br/>";
			}
echo $divide;
//echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
}else{
echo "Pokusajte ponovo!!!<br/><br/>";
echo "<a href=\"fotopp.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;mess=$mess&amp;who=$who\">Uploaduj(xhtml)</a><br/>";
echo $divide;
if($mess=="new"){
			echo "<a href=\"send.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;to=$who\">Pismo</a><br/>\n";
			}else{
            echo "<a href=\"read.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;im=$mess&amp;s=1&amp;ref=$ref\">Pismo</a><br/>";
			}
//echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
}
}
}
}
echo "<br/><a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
echo $fsize2;
}else{
echo "<form align=\"center\" action=\"fotopp.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;mess=$mess&amp;who=$who\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
echo $fsize1;
echo "Slika za upload: <br/><input type=\"file\" name=\"superdat\"/><br/>";
echo "<input type=\"hidden\" name=\"upload\" value=\"upload\"/><br/>";
echo "<input type=\"hidden\" name=\"mess\" value=\"$mess\"/>";
echo "<input type=\"submit\" value=\"Uploaduj!\"/><br/>";
//$gal = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album"));
echo $divide;
if($mess=="new"){
			echo "<a href=\"send.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;to=$who\">Pismo</a><br/>\n";
			}else{
            echo "<a href=\"read.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;im=$mess&amp;s=1&amp;ref=$ref\">Pismo</a><br/>";
			}
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
echo "</form></div></body></html>";
}
?>