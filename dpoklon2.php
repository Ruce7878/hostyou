<?php
##################################################################################################
##	                Script name  :  WapChat                                                     ##
##	                    Version  :  3.2 (23.01.2007)                                            ##
##                      Made by  :  uNrEaL                                                      ##
##	                     E-mail  :  haoschat1@gmail.com	                                        ##
##                         Site  :  http://haoswap.net                                          ##
## Ova skripa je zashticena zakonom,svaka zloupotreba podlozna je tuzbi!  						##
##Da bi ste je koristili,morate imati dozvolu vlasnike skripte!!!                				##
##################################################################################################
header("Cache-Control: no-cache");
header("Content-Type:text/html; charset=UTF-8");

require("inc.php");

if (isset($rm)) $takep="&amp;rm=$rm&amp;ref=$ref";
else $takep="&amp;ref=$ref";

$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

if(isset ($rm)) $takep="&amp;rm=$rm&amp;ref=$ref";
else $takep="&amp;ref=$ref";

if($row['level']<7){
if($ver!="wml") echo '<div class="d0"><b>Greška</b></div>';
else echo '<card id="error" title="Greška"><p align="center">';
echo $fsize1;
echo '<b>Vi nemate pravo pristupa!</b>';
echo $fsize2;
mysql_close($link);
exit;
}

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"/>
<meta http-equiv="Cache-Control" content="no-cache" forua="true"/>

<title>Logo Upload</title></head>
<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#800080">
';

$ps = check($_GET["ps"]);
$id  =  intval($_GET["id"]);

if(isset($_POST['go'])){
$cena = intval($_POST["cena"]);
$raz = intval($_POST["raz"]);
if (!ctype_digit($cena)) die('<b>Cena mora biti upisana u brojevima</b></div></BODY></HTML>');
if(!isset($_FILES['file'])){
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">";
echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>";
echo "<title>Greska!</title>";
echo "</head>";
echo "<body bgcolor=\"#F7EDCE\" link=\"blue\" vlink=\"blue\" text=\"black\">";
echo "<div align=\"center\">";
echo "<font color=\"red\" size=\"3\"><b>Niste izabrali fajl!</b></font>";
echo "<br/>---<br/>";
echo "<a href=\"upload.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">*&#8592; Nazad*</a>";
echo "</div>";
echo "</BODY>\n"; 
echo "</HTML>\n";
exit;
}
$size = filesize($_FILES['file']['tmp_name']);
$par = getimagesize($_FILES['file']['tmp_name']);
if(($par[2]!==2)&&($par[2]!==1)){
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">";
echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>";
echo "<title>Greska!</title>";
echo "</head>";
echo "<body bgcolor=\"#F7EDCE\" link=\"blue\" vlink=\"blue\" text=\"black\">";
echo "<div align=\"center\">";
echo "<font color=\"red\" size=\"3\"><b>Vas fajl nije u gif formatu!</b></font>";
echo "<br/>---<br/>";
echo "<a href=\"upload.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">&#8592; Nazad</a>";
echo "</div>";
echo "</BODY>\n"; 
echo "</HTML>\n";
exit;
}

if($size>51200){
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">";
echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>";
echo "<title>Greska!</title>";
echo "</head>";
echo "<body bgcolor=\"#F7EDCE\" link=\"blue\" vlink=\"blue\" text=\"black\">";
echo "<div align=\"center\">";
echo "<font color=\"red\" size=\"3\"><b>Slika je isuvise velika, max velicina slike u kb ne sme prevazici 50kb!</b></font>";
echo "<br/>---<br/>";
echo "<a href=\"upload.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">*&#8592; Nazad*</a>";
echo "</div>";
echo "</BODY>\n"; 
echo "</HTML>\n";
exit;
}

if(($par[0]>250)||($par[1]>250)){
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">";
echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>";
echo "<title>Greska!</title>";
echo "</head>";
echo "<body bgcolor=\"#F7EDCE\" link=\"blue\" vlink=\"blue\" text=\"black\">";
echo "<div align=\"center\">";
echo "<font color=\"red\" size=\"3\"><b>Nepravilne dimenzije slike!</b></font>";
echo "<br/>---<br/>";
echo "<a href=\"upload.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">&#8592; Nazad</a>";
echo "</div>";
echo "</BODY>\n"; 
echo "</HTML>\n";
exit;
}

$foto="./pod/".$_FILES["file"]["name"].".gif";
if (file_exists("pod/".$_FILES["file"]["name"]))
{
unlink ("pod/".$_FILES["file"]["name"]);
} 
Copy($_FILES['file']['tmp_name'], "pod/".$_FILES["file"]["name"].".gif"); 
//@mysql_query ("Update setting set predsoblje='".$foto."' where klu4=1");
@mysql_query("INSERT INTO pod SET uid='".$id."', img='".$foto."', raz='".$raz."',time='".time()."',descr='',cena='".check($cena)."'");  

print "<center><font color=\"blue\" size=\"4\">Poklon je uspeshno postavljen!</font><br/>";
echo "<a href=\"enter.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">&#8592; Nazad</a></center><br/>";
}


echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"teme/".$row["tema"]."\">";
echo "<title>Dodaj poklon</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
echo $fsize1;
echo "<b>Poklon animacija koju postavljate mora biti maksimalnih dimenzija 250x250 i velichine 50kb.<br/><br/>\n";
echo $fsize2;
echo "<form ENCTYPE=\"multipart/form-data\" action=\"dpoklon2.php?$ses&amp;do=pokloni&amp;ref=$ref\" method=\"post\">\n";
echo $fsize1;
echo "<b>*Dodaj poklon*:</b><br/>\n";
echo $fsize2;
echo "Fajl:\n";
//echo "<INPUT NAME=\"file\" TYPE=\"file\" SIZE=\"20\"><br/>\n";
echo "<input type=\"file\" name=\"file\" value=\"\" />\n";
echo "<input type=\"hidden\" name=\"action\" value=\"image\" /><br/>\n"; 
echo "Cena:<input type=\"text\" name=\"cena\" value=\"\" emptyok=\"true\" maxlength=\"50\"/><br/>";
echo 'Kategorija: <select name="raz">';
$q=mysql_query("select * from raz_pod");
while($arr=mysql_fetch_array($q)){
echo '<option value="'.$arr['id'].'">'.$arr['title'].'</option>';}
echo "<postfield name=\"cena\" value=\"$(cena)\"/>";
echo "<br/><input type=\"submit\" name=\"go\" value=\"Dodaj\" name=\"enter\">\n";
echo "</form><br/>\n";
echo $fsize1;
echo $divide;
echo "<a href=\"./pokloni.php?$ses\">Pokloni</a><br/>";
echo "<a href=\"./apanel.php?$ses\">Admin_CP</a><br/>";
echo "<a href=\"./cabinet.php?$ses\">Portal Meni</a><br/>";
echo "<a href=\"./enter.php?$ses\">Predsoblje</a><br/>";
echo $fsize1;
echo "</div>\n";
echo "</BODY>\n";
echo "</HTML>\n";
mysql_close ($link);

