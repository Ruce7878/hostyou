<?php
header("Cache-Control: no-cache");
header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
$tema = mysql_fetch_array(mysql_query("SELECT tema FROM users WHERE id='".$id."'"));
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
include('./class.upload.php');

if($row['level']<7){
if($ver!="wml") echo '<div class="d0"><b>Greљka</b></div>';
else echo '<card id="error" title="Greљka"><p align="center">';
echo $fsize1;
echo '<b>Vi nemate pravo pristupa!</b>';
echo $fsize2;
mysql_close($link);
exit;
}

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head>";
if($row["css"]!=""){
$csss=$row["css"];
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$csss\"/>";
}else{
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
}
$ps = check($_GET["ps"]);
$id  =  intval($_GET["id"]);
$ref  =  intval($_GET["ref"]);

if(isset($go)){
$cena = intval($_POST["cena"]);
$raz = intval($_POST["raz"]);
if (!ctype_digit($cena)) die('<b>Cena mora biti upisana u brojevima</b></div></BODY></HTML>');
$handle = new Upload($_FILES['my_field']);  
if ($handle->uploaded) {
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 100;
		
////////////////////
if(!isset($file)) $error = "<font color=\"red\" size=\"3\"><b>Niste odabrali fajl!</b></font><br/>";

$size = filesize($file);
$par = GetImageSize($file);

if($par[2]==1)$foto="$id.gif"; //Загрузка фото в формате gif
if($par[2]==2)$foto="$id.jpg"; //Загрузка фото в формате jpg
if($par[2]==3)$foto="$id.png"; //Загрузка фото в формате png

if($par[2]!=1&&$par[2]!=2&&$par[2]!=3) $error = "<font color=\"red\" size=\"3\"><b>Neprilagodjena velichina fajla</b></font><br/>";
if($size>76800) $error = "<font color=\"red\" size=\"3\"><b>Prevelika velichina fajla!</b></font><br/>";
if(($par[0]>640)||($par[1]>800)) $error = "<font color=\"red\" size=\"3\"><b>Vrsta fajla nije podrzana</b></font><br/>";
///////////////////
$handle->Process('./pod/');
if ($handle->processed) {
	  $kol = rand(0,99999999);
       $time = time();
      $data = date("d M Y [H:i]",time());
	  $imageurl = "pod/$handle->file_dst_name";
      $res = mysql_query("INSERT INTO pod SET uid='".$id."', img='".$imageurl."', raz='".$raz."',time='".time()."',descr='',cena='".check($cena)."'");  
        if($res)
      {       echo "<center>\n";
	   echo "<font color=\"blue\" size=\"4\">Medalja Uploadovana!</font><br/>\n";
	   echo $divide;
	   echo "</center>\n";
      }else{
        echo "<center><font color=\"red\" size=\"4\">Greska!Ili kod vec postoji,ili dimenzije ne odgovaraju.</font></center><br/>";
      }

}
}
}

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"teme/$tema[0]\">";
echo "<title>Uploaduj Medalju</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
echo $fsize1;
echo "<b>Medalja mora biti u Gif, Jpg ili Png formatu!<br/><br/>\n";
echo $fsize2;
echo "<form ENCTYPE=\"multipart/form-data\" action=\"dmedal.php?$ses&amp;do=pokloni&amp;ref=$ref\" method=\"post\">\n";
echo $fsize1;
echo "<b>*Dodaj Medalju*:</b><br/>\n";
echo $fsize2;
echo "Fajl:\n";
//echo "<INPUT NAME=\"file\" TYPE=\"file\" SIZE=\"20\"><br/>\n";
echo "<input type=\"file\" name=\"my_field\" value=\"\" />\n";
echo "<input type=\"hidden\" name=\"action\" value=\"image\" /><br/>\n"; 
echo "Cena:<input type=\"text\" name=\"cena\" value=\"\" emptyok=\"true\" maxlength=\"50\"/><br/>";
echo 'Kategorija: <select name="raz">';
$q=mysql_query("select * from raz_pod");
while($arr=mysql_fetch_array($q)){
echo '<option value="'.$arr['id'].'">'.$arr['title'].'</option>';}
echo "<postfield name=\"cena\" type=\"number\" value=\"$(cena)\"/>";
echo "<br/><input type=\"submit\" name=\"go\" value=\"Dodaj\" name=\"enter\">\n";
echo "</form><br/>\n";
echo $fsize1;
echo $divide;
echo "<a href=\"./medals.php?$ses\">Medalje</a><br/>";
echo "<a href=\"./apanel.php?$ses\">Admin CP</a><br/>";
echo "<a href=\"./cabinet.php?$ses\">Opcije Chata</a><br/>";
echo "<a href=\"./enter.php?$ses\">Hodnik</a><br/>";
echo $fsize1;
echo "</div>\n";
echo "</BODY>\n";
echo "</HTML>\n";
mysql_close ($link);
?>

