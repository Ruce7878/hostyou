<?php
header("Cache-Control: no-cache");
header("Content-Type:text/html; charset=UTF-8");
 /* $file_name = $_FILES['file']['name'];
$file =$_FILES['file']['tmp_name']; */
require_once "inc.php";
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require_once "version.php";

$mod = check($mod);
switch($mod) {

case 'photo':
if (isset($go)) {
if (!isset($file)) $error = "<font color=\"red\" size=\"3\"><b>Не указан файл!</b></font><br/>";

$size = filesize($file);
$par = GetImageSize($file);
//$id2 = $id."_".mt_rand(111111,999999);
/* if ($par[2] == 1) $foto="$id.gif"; //Загрузка фото в формате gif
if ($par[2] == 2) $foto="$id.jpg"; //Загрузка фото в формате jpg
if ($par[2] == 3) $foto="$id.png"; //Загрузка фото в формате png */

$img = $file;
if($par[2]==1){
$foto="$id.gif"; $sl = imagecreatefromgif($img);
} 
if($par[2]==2){
$foto="$id.jpg";  $sl = imagecreatefromjpeg($img);
}
if($par[2]==3){
$foto="$id.png"; $sl = imagecreatefrompng($img);
}	
	

if ($par[2] != 1 and $par[2] != 2 and $par[2] != 3) 
$error = "<font color=\"red\" size=\"3\"><b>Недопустимое расширение файла!</b></font><br/>";
if ($size > 505000) $error = "<font color=\"red\" size=\"3\"><b>Слишком большой размер файла!</b></font><br/>";
if (($par[0] > 800) or ($par[1] > 600)) $error = "<font color=\"red\" size=\"3\"><b>Неправильное разрешение фотографии!</b></font><br/>";

if ($error) {

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
      <html xmlns=\"http://www.w3.org/1999/xhtml\">
	  <head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/$css.css\"/>
	  <title>Фото в анкету</title>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>
      <div align=\"center\">";

echo $fsize1;
echo $error;
echo "<br/><a href=\"foto.php?$ses&amp;mod=photo\">&#8592; Назад</a>";
echo $fsize2;
include_once 'foot.php';
exit;
}

if (file_exists("photos/$foto")) {
unlink ("photos/$foto");
$sex = $row['sex'];$id = $row['id'];
}
/* Copy($file, "photos/".basename($foto)); */
//---------------------------------------------------
    $ime = $foto;
  //$img = "$superdat"; // Link na fajl
	$font = "font/arial.ttf"; // Link na tip fonta
	$font_size = 24; // Velicina fonta
	$degree = 0; // Ugao rotacije teksta
	$text = $text_na_sliku; // Tekst na sliku
	$y = $par[1] - 10; // Rastojanje od vrha slike
	$x = $par[0] - 150; // Pomeranje po horizontali, s leva
	/* $pic = imagecreatefromjpeg($img); // Kreiramo sliku */
	$pic = $sl;
	$color = imagecolorallocate($pic, 255, 0, 0); // Boja teksta
	
	imagettftext($pic, $font_size, $degree, $x, $y, $color, $font, $text); // Unosenje teksta na sliku
	if($par[2]==2){
    imagegif($pic, "photos/".basename($ime));} // Premestanje slike na odrediste		
    if($par[2]==2){
    imagejpeg($pic, "gallery/".basename($ime));} // Premestanje slike na odrediste
	if($par[2]==2){
    imagepng($pic, "gallery/".basename($ime));} // Premestanje slike na odrediste		
	
	imagedestroy($pic); // Oslobadjanje memorije i zatvaranje slike

//---------------------------------------------------
mysql_query ("Update users set img='".$foto."', votefoto='0' where id ='".$id."'");
mysql_query ("Delete from golos where user ='".$id."'");
/* mysql_query ("Insert Into gallery Set user='".$id."', file='".$foto."', sex='".$sex."', upload=1, time='".time()."'"); */
}
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
      <html xmlns=\"http://www.w3.org/1999/xhtml\">
	  <head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/$css.css\"/>
	  <title>Добавить фото</title>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>
      <div align=\"center\">";

echo $fsize1;
echo '<b>ВНИМАНИЕ!!!</b><br/>
      <u>При загрузки нового фото обнуляется колличество голосов за твоё фото. Чтобы голоса начали засчитываться за новое.</u><br/>
      <br/><div class="d1">Загружаемая фотка обязательно должна быть в формате Gif, Jpg или Png разрешением не более <u>800х600</u> и размером не более <u>500кб.</u> Если ты хочешь заменить свою фотку то просто загрузи новую, а старая автоматически удалится.</div>';
echo $fsize2;
echo "<font color=\"blue\" size=\"3\">".$row["user"]."</font><br/>\n";
if (@$row["img"] != "") {
$row["img"] = UrlEncode($row["img"]);
echo "<img align=\"center\" src=\"./photos/".$row["img"]."\"/><br/>\n";
}
echo "<form ENCTYPE=\"multipart/form-data\" action=\"foto.php?$ses&amp;mod=photo\" method=\"post\">\n";
echo $fsize1;
echo '<b>Прикрепить фотку:</b><br/>';
echo $fsize2;
echo "<input name=\"file\" type=\"file\" size=\"20\"><br/>\n
      <input type=\"submit\" class=\"ibutton\" name=\"go\" value=\"Отправить\"/>\n
      </form><br/>\n";
echo $fsize1;
echo "<br/><div class='d1'><a href=\"enter.php?$ses&amp;ref=$rand\">Прихожая</a></div>";
echo $fsize1;
include_once 'foot.php';
mysql_close ($link);
break;

case 'avatars':
if (isset($go)) {
if (!isset($file)) $error = "<font color=\"red\" size=\"3\"><b>Не указан файл!</b></font><br/>";

$size = filesize($file);
$par = GetImageSize($file);

 if ($par[2] == 1) $foto="$id.gif"; //Загрузка фото в формате gif
if ($par[2] == 2) $foto="$id.jpg"; //Загрузка фото в формате jpg
if ($par[2] == 3) $foto="$id.png"; //Загрузка фото в формате png 


if ($par[2] != 1 and $par[2] != 2 and $par[2] != 3) 
$error = "<font color=\"red\" size=\"3\"><b>Недопустимое расширение файла!</b></font><br/>";
if ($size > 25060) $error = "<font color=\"red\" size=\"3\"><b>Слишком большой размер файла!</b></font><br/>";
if (($par[0] > 174) or ($par[1] > 174)) $error = "<font color=\"red\" size=\"3\"><b>Неправильное разрешение аватара!</b></font><br/>";

if ($error) {

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
      <html xmlns=\"http://www.w3.org/1999/xhtml\">
	  <head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/$css.css\"/>
	  <title>Аватар в анкету</title>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>
      <div align=\"center\">";

echo $fsize1;
echo $error;
echo "<br/><a href=\"foto.php?$ses&amp;mod=avatars\">&#8592; Назад</a>";
echo $fsize2;
include_once 'foot.php';
exit;
}

if (file_exists("loadavatars/$foto")) {
unlink ("loadavatars/$foto");
}
Copy($file, "loadavatars/".basename($foto));
mysql_query ("Update users set myavatar='".$foto."' where id ='".$id."'");
}

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
      <html xmlns=\"http://www.w3.org/1999/xhtml\">
	  <head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/$css.css\"/>
	  <title>Добавить аватар</title>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>
      <div align=\"center\">
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";

echo $fsize1;
echo "<br/><div class='d1'>Загружаемый аватар обязательно должен быть в формате Gif, Jpg или Png разрешением не более <u>174х174</u> и размером не более <u>25кб.</u> Если ты хочешь заменить свой аватар то просто загрузи новый, а старый автоматически удалится.</div>\n";
echo $fsize2;
echo "<font color=\"blue\" size=\"3\">".$row["user"]."</font><br/>\n";
if (@$row["myavatar"] != "") {
$row["img"] = UrlEncode($row["myavatar"]);
echo "<img align=\"center\" src=\"./loadavatars/".$row["myavatar"]."\"><br/>\n";
}
echo "<form ENCTYPE=\"multipart/form-data\" action=\"foto.php?$ses&amp;mod=avatars\" method=\"post\">\n";
echo $fsize1;
echo '<b>Прикрепить аватар:</b><br/>';
echo $fsize2;
echo "<INPUT NAME=\"file\" TYPE=\"file\" SIZE=\"20\"><br/>\n
      <input type=\"submit\" class=\"ibutton\" name=\"go\" value=\"Отправить\">\n
      </form><br/>\n";
echo $fsize1;
echo "<br/><div class='d1'><a href=\"enter.php?$ses&amp;ref=$rand\">Прихожая</a></div>";
echo $fsize1;
include_once 'foot.php';
mysql_close ($link);
break;

case 'smiles':
if (isset($go)) {
if (!isset($file)) $error = "<font color=\"red\" size=\"3\"><b>Не указан файл!</b></font><br/>";

$size = filesize($file);
$par = GetImageSize($file);

if ($par[2] == 1) $foto="$id.gif"; //Загрузка фото в формате gif
if ($par[2] == 2) $foto="$id.jpg"; //Загрузка фото в формате jpg
if ($par[2] == 3) $foto="$id.png"; //Загрузка фото в формате png

if ($par[2] != 1 and $par[2] != 2 and $par[2] != 3) 
$error = "<font color=\"red\" size=\"3\"><b>Недопустимое расширение файла!</b></font><br/>";
if ($size > 25060) $error = "<font color=\"red\" size=\"3\"><b>Слишком большой размер файла!</b></font><br/>";
if (($par[0] > 100) or ($par[1] > 100)) $error = "<font color=\"red\" size=\"3\"><b>Неправильное разрешение фотографии!</b></font><br/>";

if ($error) {
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
      <html xmlns=\"http://www.w3.org/1999/xhtml\">
	  <head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/$css.css\"/>
	  <title>Личный смайл</title>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>
      <div align=\"center\">";

echo $fsize1;
echo $error;
echo "<br/><a href=\"foto.php?$ses&amp;mod=smiles\">&#8592; Назад</a>";
echo $fsize2;
include_once 'foot.php';
exit;
}

if (file_exists("loadsmile/$foto")) {
unlink ("loadsmile/$foto");
}
Copy($file, "loadsmile/".basename($foto));
mysql_query ("Update users set mysmile='".$foto."' where id ='".$id."'");
}
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
      <html xmlns=\"http://www.w3.org/1999/xhtml\">
	  <head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/$css.css\"/>
	  <title>Добавить Личный смайл</title>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>
      <div align=\"center\">";

echo $fsize1;
echo "<br/><div class='d1'>Загружаемый смайл обязательно должнен быть в формате Gif, Jpg или Png разрешением не более <u>100х100</u> и размером не более <u>25кб.</u> Если ты хочешь заменить свой смайл то просто загрузи новый, а старый автоматически удалится.</div>\n";
echo $fsize2;
echo "<font color=\"blue\" size=\"3\">".$row["user"]."</font><br/>\n";
if (@$row["mysmile"] != "") {
$row["mysmile"] = UrlEncode($row["mysmile"]);
echo "<img align=\"center\" src=\"./loadsmile/".$row["mysmile"]."\"><br/>\n";
}
echo "<form ENCTYPE=\"multipart/form-data\" action=\"foto.php?$ses&amp;mod=smiles\" method=\"post\">\n";
echo $fsize1;
echo '<b>Прикрепить смайл:</b><br/>';
echo $fsize2;
echo "<INPUT NAME=\"file\" TYPE=\"file\" SIZE=\"20\"><br/>\n
      <input type=\"submit\" class=\"ibutton\" name=\"go\" value=\"Отправить\">\n
      </form><br/>\n";
echo $fsize1;
echo "<br/><div class='d1'><a href=\"enter.php?$ses&amp;ref=$rand\">Прихожая</a></div>";
echo $fsize1;
include_once 'foot.php';
mysql_close ($link);
break;

case 'logoclan':
$mid = intval($mid);
$cl = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='$mid'"));
$q = mysql_query("select * from `clans` where id='$mid'");
$arr = mysql_fetch_array($q);
if ($row['clan_lev'] < 2 and $arr['lider'] != $id) {
include_once 'obolochka.php';
echo 'Нет прав, или это не твоя группа!<br/>';
break;
}

if (isset($go)) {
if (!isset($file)) $error = "<font color=\"red\" size=\"3\"><b>Не указан файл!</b></font><br/>";

$size = filesize($file);
$par = GetImageSize($file);

if ($par[2] == 1) $foto="$mid.gif"; //Загрузка фото в формате gif
if ($par[2] == 2) $foto="$mid.jpg"; //Загрузка фото в формате jpg
if ($par[2] == 3) $foto="$mid.png"; //Загрузка фото в формате png

if ($par[2] != 1 and $par[2] != 2 and $par[2] != 3) $error = "<font color=\"red\" size=\"3\"><b>Недопустимое расширение файла!</b></font><br/>";
if ($size > 25060) $error = "<font color=\"red\" size=\"3\"><b>Слишком большой размер файла!</b></font><br/>";
if (($par[0] > 100) or ($par[1] > 100)) $error = "<font color=\"red\" size=\"3\"><b>Неправильное разрешение Логотипа!</b></font><br/>";

if ($error) {
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
      <html xmlns=\"http://www.w3.org/1999/xhtml\">
	  <head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/$css.css\"/>
	  <title>Логотип</title>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>
      <div align=\"center\">";

echo $fsize1;
echo $error;
echo "<br/><a href=\"foto.php?$ses&amp;mod=logoclan&amp;mid=$mid\">&#8592; Назад</a>";
echo $fsize2;
include_once 'foot.php';
exit;
}

if (file_exists("logoclan/$foto")) {
unlink ("logoclan/$foto");
}
Copy($file, "logoclan/".basename($foto));
mysql_query ("Update clans set logo='".$foto."' where id ='".$mid."'");
}
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
      <html xmlns=\"http://www.w3.org/1999/xhtml\">
	  <head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/$css.css\"/>
	  <title>Логотип</title>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>
      <div align=\"center\">";

echo $fsize1;
echo "<br/><div class='d1'>Загружаемый логотип обязательно должнен быть в формате Gif, Jpg или Png разрешением не более <u>100х100</u> и размером не более <u>25кб.</u> Если ты хочешь заменить логотип то просто загрузи новый, а старый автоматически удалится.</div>\n";
echo $fsize2;
$mid = intval($mid);
$q = mysql_query("select * from clans where id='".$mid."';");
$data = mysql_fetch_array($q);
$name = $data['name'];
$logot = $data['logo'];
echo "<font color=\"blue\" size=\"5\">Логотип</font><br/>\n";
if (@$logot != "") {
$logot = UrlEncode($logot);
echo "<img align=\"center\" src=\"logoclan/".$logot."\"><br/>\n";
}
echo "<form ENCTYPE=\"multipart/form-data\" action=\"foto.php?$ses&amp;mod=logoclan&amp;mid=$mid\" method=\"post\">\n";
echo $fsize1;
echo '<b>Прикрепить смайл:</b><br/>';
echo $fsize2;
echo "<INPUT NAME=\"file\" TYPE=\"file\" SIZE=\"20\"><br/>\n
      <input type=\"submit\" class=\"ibutton\" name=\"go\" value=\"Отправить\">\n
      </form><br/>\n";
echo $fsize1;
echo "<br/><div class='d1'><a href=\"enter.php?$ses\">Прихожая</a></div>";
echo $fsize1;
include_once 'foot.php';
mysql_close ($link);
break;
}

?>