<?php

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
$page=$_GET["page"];
if ($ver=="wml"){
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">\n";
echo "<wml>\n<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/>\n";
echo "<meta http-equiv=\"Pragma\" content=\"no-cache\"/></head>\n";
echo "<card id=\"naziv\" title=\"Foto Albumi\">\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Foto Albumi</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
///////////////////////////////////////////
$gde="Foto Albumi";
include("gde.php");
///////////////////////////////////////////
if($action==""){
echo $fsize1;
echo "<b>Foto Albumi</b><br/>";
echo $divide;
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=top&amp;ref=$ref\">Top Albumi</a><br/>";
$male = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album WHERE sex='M'"));
$female = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album WHERE sex='Z'"));
$ukupno=$male[0]+$female[0];
$male1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE sex='M'"));
$female1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE sex='Z'"));
$ukupno1=$male1[0]+$female1[0];
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=male&amp;ref=$ref\">Muski Albumi($male[0])</a><br/>";
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=female&amp;ref=$ref\">Zenski Albumi($female[0])</a><br/><br/>";
$broj = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM album"));
if($broj[0]>0){
echo "<u>Najnoviji Album:</u><br/>";
$novi = mysql_fetch_array(mysql_query("SELECT uid, name, about, type, time, count, view FROM album WHERE id='".$broj[0]."'"));
$korisnik = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$novi[0]."'"));
$naslov=htmlspecialchars("$novi[1]");
$opis=htmlspecialchars("$novi[2]");
echo "<b><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$broj[0]&amp;ref=$ref\">$naslov($novi[5])</a></b><br/>";
echo "$opis<br/>";
echo "Autor: <a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$novi[0]&amp;ref=$ref\">$korisnik[0]</a><br/>";
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$broj[0]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$novi[0]."' AND ok='1' OR usid='".$id."' AND id='".$novi[0]."' AND ok='1'"));
if($novi[3]==0 || ($novi[3]==1 && $dopustanje[0]>0) || ($novi[3]==2 && $prijatelji[0]>0) || $id==$novi[0]){
$slsl = mysql_fetch_array(mysql_query("SELECT id FROM album_pic WHERE album='".$broj[0]."' ORDER BY RAND() LIMIT 1"));
if($slsl){
echo "<img src=\"resize.php?gname=$slsl[0]&amp;maxsize=900\" alt=\"*\"/><br/>";
}
}
echo "<br/>";
}

echo "Ukupno Albuma: <b>$ukupno</b><br/>";
echo "Ukupno Slika: <b>$ukupno1</b><br/>";
echo $fsize2;
}else if($action=="new"){
echo $fsize1;
echo "<b>Novi Album</b><br/>";
echo $divide;
  if($ver=="wml"){
  echo "Naziv:<br/><input name=\"naziv\" maxlength=\"20\"/><br/>";
  echo "Opis:<br/><input name=\"opis\" maxlength=\"50\"/><br/>";
  echo "Tip:<br/>";
  echo "<select name=\"tip\">";
  echo "<option value=\"0\">Javni</option>";
  echo "<option value=\"1\">Privatni</option>";
  echo "<option value=\"2\">Prijatelji</option>";
  echo "</select><br/><br/>";
  echo "<anchor>Napravi";
  echo "<go href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=new1&amp;ref=$ref\" method=\"post\">";
  echo "<postfield name=\"naziv\" value=\"$(naziv)\"/>";
  echo "<postfield name=\"opis\" value=\"$(opis)\"/>";
  echo "<postfield name=\"tip\" value=\"$(tip)\"/>";
  echo "</go></anchor><br/>";
  }else{
  echo "<form method=\"post\" action=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=new1&amp;ref=$ref\" name=\"auth\">\n";
  echo "Naziv:<br/><input name=\"naziv\" maxlength=\"20\"/><br/>";
  echo "Opis:<br/><input name=\"opis\" maxlength=\"50\"/><br/>";
  echo "Tip:<br/>";
  echo "<select name=\"tip\">";
  echo "<option value=\"0\">Javni</option>";
  echo "<option value=\"1\">Privatni</option>";
  echo "<option value=\"2\">Prijatelji</option>";
  echo "</select><br/><br/>";
  echo "<input type=\"submit\" value=\"Napravi\" name=\"enter\"></form>";
  }
echo $fsize2;
}else if($action=="new1"){
echo $fsize1;
echo "<b>Novi Album</b><br/>";
echo $divide;
$naziv=$_POST["naziv"];
$opis=$_POST["opis"];
$tip=$_POST["tip"];
if($naziv==""){echo "Morate uneti naziv albuma!<br/>"; $er=1;}
if($opis==""){echo "Morate uneti opis albuma!<br/>"; $er=1;}
if(!$er){
$brojcano = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album WHERE uid='".$id."'"));
if($brojcano[0]<10){
$imali = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album WHERE uid='".$id."' AND name='".$naziv."'"));
if($imali[0]==0){
$unos = mysql_query("INSERT INTO album SET uid='".$id."', name='".$naziv."', about='".$opis."', type='".$tip."', time='".time()."', sex='".$row[sex]."'");
if($unos){
echo "Album je uspesno kreiran!<br/>";
}else{
echo "Greska!<br/>";
}
}else{
echo "Morate izabrati drugi naziv!<br/>";
}
}else{
echo "Ne mozete napraviti vise albuma!<br/>";
}
}
echo $fsize2;
}else if($action=="view"){
echo $fsize1;
$album=$_GET["album"];
$nazivni = mysql_fetch_array(mysql_query("SELECT uid, name, about, type, time, count, view FROM album WHERE id='".$album."'"));
$naslov=htmlspecialchars("$nazivni[1]");
$opis=htmlspecialchars("$nazivni[2]");
if(!$nazivni){
echo "<b>Pogresan Album</b><br/>";
echo $divide;
echo "Odabrali ste pogresan album!<br/>";
}else{
if($id!=$nazivni[0]){
$plus=$nazivni[6]+1;
$upadaj = mysql_query("UPDATE album SET view='".$plus."' WHERE id='".$album."'");
}
echo "<b>$naslov</b><br/>";
echo $divide;
echo "<b>Opis:</b> $opis<br/>";
if($nazivni[3]==0){$tip="Javni";}
else if($nazivni[3]==1){$tip="Privatni";}
else if($nazivni[3]==2){$tip="Prijatelji";}
echo "<b>Tip:</b> $tip<br/>";
$vreme=date("d/m/Y - H:m", $nazivni[4]);
echo "<b>Kreirano:</b> $vreme<br/>";
$slicice = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE album='".$album."'"));
echo "<b>Slika:</b> $slicice[0]<br/>";
echo "<b>Pregleda:</b> $nazivni[6]<br/>";
$korisnik = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nazivni[0]."'"));
echo "<b>Autor:</b><a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$nazivni[0]&amp;ref=$ref\">$korisnik[0]</a><br/>";
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$album."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$nazivni[0]."' AND ok='1' OR usid='".$id."' AND id='".$nazivni[0]."' AND ok='1'"));
if($nazivni[3]==0 || ($nazivni[3]==1 && $dopustanje[0]>0) || ($nazivni[3]==2 && $prijatelji[0]>0) || $id==$nazivni[0] || $row["level"]>9){
$slsl = mysql_fetch_array(mysql_query("SELECT id FROM album_pic WHERE album='".$album."' ORDER BY RAND() LIMIT 1"));

if($slsl){
echo "<img src=\"resize.php?gname=$slsl[0]&amp;maxsize=200\" alt=\"*\"/>";
}
echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
}
if($id==$nazivni[0]){
echo "<a href=\"ualbum.php?$ses&amp;ref=$ref&amp;album=$album\">Dodaj Sliku</a><br/>";
if($nazivni[3]==1){
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=dopustanja&amp;album=$album&amp;ref=$ref\">Dopustanja</a><br/>";
}
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=obrisi&amp;album=$album&amp;ref=$ref\">Obrisi Album</a><br/>";
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=izmeni&amp;album=$album&amp;ref=$ref\">Izmeni Album</a><br/>";
}
}
echo $fsize2;
}else if($action=="view1"){
echo $fsize1;
$album=$_GET["album"];
$nazivni = mysql_fetch_array(mysql_query("SELECT uid, name, about, type, time, count, view FROM album WHERE id='".$album."'"));
$naslov=htmlspecialchars("$nazivni[1]");
$opis=htmlspecialchars("$nazivni[2]");
if(!$nazivni){
echo "<b>Pogresan Album</b><br/>";
echo $divide;
echo "Odabrali ste pogresan album!<br/>";
}else{
if($id!=$nazivni[0]){
$plus=$nazivni[6]+1;
$upadaj = mysql_query("UPDATE album SET view='".$plus."' WHERE id='".$album."'");
}
echo "<b>$naslov</b><br/>";
echo $divide;
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$album."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$nazivni[0]."' AND ok='1' OR usid='".$id."' AND id='".$nazivni[0]."' AND ok='1'"));
if($nazivni[3]==0 || ($nazivni[3]==1 && $dopustanje[0]>0) || ($nazivni[3]==2 && $prijatelji[0]>0) || $id==$nazivni[0] || $row["level"]>7){
 if($page=="" || $page<=0)$page=1;
 $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE album='".$album."'"));
 $num_items = $noi[0]; //changable
 $items_per_page= 3;
 $num_pages = ceil($num_items/$items_per_page);
 if(($page>$num_pages)&&$page!=1)$page= $num_pages;
 $limit_start = ($page-1)*$items_per_page;

 $sql = "SELECT id, file, time, count, view, sex, comments FROM album_pic WHERE album='".$album."' ORDER BY id DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
	echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=picture&amp;picture=$item[0]&amp;ref=$ref\">";
	echo "<img src=\"resize.php?gname=$item[0]&amp;maxsize=900\" alt=\"*\"/><br/>";
	$glasovi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_vote WHERE pid='".$item[0]."'"));
	$glasno = mysql_fetch_array(mysql_query("SELECT SUM(vote) FROM album_vote WHERE pid='".$item[0]."'"));
	$ocena=$glasno[0]/$glasovi[0];
	$ocena=round($ocena, 2);
	echo "<b>Ocena:</b> $ocena</a><br/><br/>";
	//echo "<b>Komentara:</b> $item[6]<br/>";
	//echo "<b>Pregleda:</b> $item[4]<br/><br/>";
	}
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;page=$ppage&amp;ref=$ref&amp;album=$album\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;page=$npage&amp;ref=$ref&amp;album=$album\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"albums.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"action\" value=\"$action\"/>";
		$rets .= "<postfield name=\"album\" value=\"$album\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"albums.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
		$rets .= "<input type=\"hidden\" name=\"album\" value=\"$album\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$album&amp;ref=$ref\">Detalji Albuma</a><br/>";
if($id==$nazivni[0]){
echo "<a href=\"ualbum.php?$ses&amp;ref=$ref&amp;album=$album\">Dodaj Sliku</a><br/>";
}
}else{
echo "Nemate pravo pristupa!<br/>";
}
}
echo $fsize2;
}else if($action=="picture"){
echo $fsize1;
$picture=$_GET["picture"];
$nazivni = mysql_fetch_array(mysql_query("SELECT uid, album, file, time, count, view, sex, comments FROM album_pic WHERE id='".$picture."'"));
$album = mysql_fetch_array(mysql_query("SELECT uid, name, about, type, count, view FROM album WHERE id='".$nazivni[1]."'"));
$naslov=htmlspecialchars("$album[1]");
$opis=htmlspecialchars("$album[2]");
if(!$nazivni){
echo "<b>Pogresna Slika</b><br/>";
echo $divide;
echo "Odabrali ste pogresnu sliku!<br/>";
}
else if(!$album){
echo "<b>Pogresan Album</b><br/>";
echo $divide;
echo "Odabrali ste pogresan album!<br/>";
}else{
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$nazivni[1]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$nazivni[0]."' AND ok='1' OR usid='".$id."' AND id='".$nazivni[0]."' AND ok='1'"));
if($album[3]==0 || ($album[3]==1 && $dopustanje[0]>0) || ($album[3]==2 && $prijatelji[0]>0) || $id==$nazivni[0] || $row["level"]>7){
if($id!=$nazivni[0]){
$plus=$nazivni[5]+1;
$upadaj = mysql_query("UPDATE album_pic SET view='".$plus."' WHERE id='".$picture."'");
}
echo "<b>$naslov</b><br/>";
echo $divide;
$slsl = mysql_fetch_array(mysql_query("SELECT id FROM album_pic WHERE id='".$picture."'"));
if($slsl){
echo "<img src=\"resize.php?gname=$slsl[0]&amp;maxsize=900\" alt=\"*\"/><br/>";
$veca = mysql_fetch_array(mysql_query("SELECT MIN(id) FROM album_pic WHERE id>'".$picture."' AND album='".$nazivni[1]."'"));
$manja = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM album_pic WHERE id<'".$picture."' AND album='".$nazivni[1]."'"));
  if($veca[0]>0){
 echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=picture&amp;picture=$veca[0]&amp;ref=$ref\">&#171;&#171;&#171;</a> | ";
 }
 if($manja[0]>0){
 echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=picture&amp;picture=$manja[0]&amp;ref=$ref\">&#187;&#187;&#187;</a>";
 }
 echo "<br/>";
	$glasovi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_vote WHERE pid='".$picture."'"));
	$glasno = mysql_fetch_array(mysql_query("SELECT SUM(vote) FROM album_vote WHERE pid='".$picture."'"));
	$ocena=$glasno[0]/$glasovi[0];
	$ocena=round($ocena, 2);
	echo "<b>Ocena:</b> $ocena<br/>";
	echo "<b>Pregleda:</b> $nazivni[5]<br/>";
	echo "<b>Komentara:</b> $nazivni[7]<br/>";
	$vreme=date("d/m/Y - H:m", $nazivni[3]);
	echo "<b>Kreirano:</b> $vreme<br/>";
	$korisnik = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nazivni[0]."'"));
    echo "<b>Autor:</b><a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$nazivni[0]&amp;ref=$ref\">$korisnik[0]</a><br/><br/>";
echo "<a href=\"resize.php?gname=$slsl[0]&amp;maxsize=900\">Download</a><br/>";
if($id==$nazivni[0] || $row["level"]>7){
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=delpic&amp;picture=$picture&amp;ref=$ref\">Obrisi</a><br/>";
}
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=comments&amp;picture=$picture&amp;ref=$ref\">Komentari($nazivni[7])</a><br/>";
$glasao = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_vote WHERE pid='".$picture."' AND uid='".$id."'"));
if($glasao[0]==0 && $id!=$nazivni[0]){
if($ver!="wml"){
echo "<form method=\"post\" action=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=vote&amp;picture=$picture&amp;ref=$ref\" name=\"auth\">\n";
}
echo "<br/><select name=\"vote\">";
echo "<option value=\"1\">1</option>";
echo "<option value=\"2\">2</option>";
echo "<option value=\"3\">3</option>";
echo "<option value=\"4\">4</option>";
echo "<option value=\"5\">5</option>";
echo "</select><br/>";
if($ver=="wml"){
echo "<anchor>Glasaj<go href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=vote&amp;ref=$ref\" method=\"post\">";
echo "<postfield name=\"picture\" value=\"$picture\"/>";
echo "<postfield name=\"vote\" value=\"$(vote)\"/>";
echo "</go></anchor><br/>";
}else{
echo "<input type=\"hidden\" name=\"picture\" value=\"$picture\"/>";
echo "<input type=\"submit\" value=\"Glasaj\" name=\"enter\"></form>";
}
}else{
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=vote1&amp;picture=$picture&amp;ref=$ref\">Ko je glasao?</a><br/>";
}

}
echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$nazivni[1]&amp;ref=$ref\">Pogledaj Album</a><br/>";
}else{
echo "<b>Pogresna Slika</b><br/>";
echo $divide;
echo "Nemate pravo pristupa!<br/>";
echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$nazivni[1]&amp;ref=$ref\">Detalji Albuma</a><br/>";
}
}
echo $fsize2;
}else if($action=="vote"){
echo $fsize1;
$picture=$_POST["picture"];
$vote=$_POST["vote"];
$nazivni = mysql_fetch_array(mysql_query("SELECT uid, album, file, time, count, view, sex FROM album_pic WHERE id='".$picture."'"));
if(!$nazivni){
echo "<b>Pogresna Slika</b><br/>";
echo $divide;
echo "Odabrali ste pogresnu sliku!<br/>";
}else{
$glasao = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_vote WHERE pid='".$picture."' AND uid='".$id."'"));
echo "<b>Glasanje</b><br/>";
echo $divide;
if($glasao[0]==0){
$insert = mysql_query("INSERT INTO album_vote SET pid='".$picture."', uid='".$id."', vote='".$vote."'");
if($insert){
$upbre=$nazivni[4]+1;
	$glasovi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_vote WHERE pid='".$picture."'"));
	$glasno = mysql_fetch_array(mysql_query("SELECT SUM(vote) FROM album_vote WHERE pid='".$picture."'"));
	$ocena=$glasno[0]/$glasovi[0];
	$ocena=round($ocena, 2);
	$insert1 = mysql_query("UPDATE album_pic SET count='".$upbre."', vote='".$ocena."' WHERE id='".$picture."'");
echo "Uspesno ste glasali za sliku!<br/>";
}else{
echo "Greska!!!<br/>";
}
}else{
echo "Vec ste glasali za ovu sliku!<br/>";
}
}
echo $fsize2;
}else if($action=="vote1"){
echo $fsize1;
$picture=$_GET["picture"];
$nazivni = mysql_fetch_array(mysql_query("SELECT uid, album, file, time, count, view, sex, comments FROM album_pic WHERE id='".$picture."'"));
$album = mysql_fetch_array(mysql_query("SELECT uid, name, about, type, count, view FROM album WHERE id='".$nazivni[1]."'"));
$naslov=htmlspecialchars("$album[1]");
$opis=htmlspecialchars("$album[2]");
if(!$nazivni){
echo "<b>Pogresna Slika</b><br/>";
echo $divide;
echo "Odabrali ste pogresnu sliku!<br/>";
}else if(!$album){
echo "<b>Pogresan Album</b><br/>";
echo $divide;
echo "Odabrali ste pogresan album!<br/>";
}else{
echo "<b>Lista Glasanja</b><br/>";
echo $divide;
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$nazivni[1]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$nazivni[0]."' AND ok='1' OR usid='".$id."' AND id='".$nazivni[0]."' AND ok='1'"));
if($album[3]==0 || ($album[3]==1 && $dopustanje[0]>0) || ($album[3]==2 && $prijatelji[0]>0) || $id==$album[0] || $row["level"]>7){
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_vote WHERE pid='".$picture."'"));
	$num_items = $noi[0]; //changable
	$items_per_page= 10;
	$num_pages = ceil($num_items/$items_per_page);
	if(($page>$num_pages)&&$page!=1)$page= $num_pages;
	$limit_start = ($page-1)*$items_per_page;

	$sql = "SELECT pid, uid, vote FROM album_vote WHERE pid='".$picture."' ORDER BY id DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
	echo "<img src=\"resize.php?gname=$picture&amp;maxsize=900\" alt=\"*\"/><br/>";
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
	$korisnik = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[1]."'"));
	echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[1]&amp;ref=$ref\">$korisnik[0]</a>-$item[2]<br/>";
	}
	echo "<br/>";
	}else{
	echo "<br/>Niko nije glasao!<br/>";
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=vote1&amp;page=$ppage&amp;ref=$ref&amp;picture=$picture\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=vote1&amp;page=$npage&amp;ref=$ref&amp;picture=$picture\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"albums.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"action\" value=\"$action\"/>";
		$rets .= "<postfield name=\"picture\" value=\"$picture\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"albums.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
		$rets .= "<input type=\"hidden\" name=\"picture\" value=\"$picture\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
	echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=picture&amp;picture=$picture&amp;ref=$ref\">Pogledaj Sliku</a><br/>";
	echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$nazivni[1]&amp;ref=$ref\">Pogledaj Album</a><br/>";
}else{
echo "Nemate prava pristupa!<br/>";
}
}

echo $fsize2;
}else if($action=="delpic"){
echo $fsize1;
$picture=$_GET["picture"];
$nazivni = mysql_fetch_array(mysql_query("SELECT uid, album, file, time, count, view, sex, comments FROM album_pic WHERE id='".$picture."'"));
$counter = mysql_fetch_array(mysql_query("SELECT count FROM album WHERE id='".$nazivni[1]."'"));
$counter2=$counter[0]-1;
if(!$nazivni){
echo "<b>Pogresna Slika</b><br/>";
echo $divide;
echo "Odabrali ste pogresnu sliku!<br/>";
}else{
echo "<b>Brisanje Slike</b><br/>";
echo $divide;
if($id==$nazivni[0]  || $row["level"]>7){
$del = mysql_query("DELETE FROM album_pic WHERE id='".$picture."'");
if($del){
$del1 = mysql_query("DELETE FROM album_vote WHERE pid='".$picture."'");
$del2 = mysql_query("DELETE FROM album_com WHERE pid='".$picture."'");
$del3 = mysql_query("UPDATE album SET count='".$counter2."' WHERE id='".$nazivni[1]."'");
echo "Slika je uspesno obrisana!";
}else{
echo "Greska!!!";
}
}else{
echo "Ovo nije Vasa slika!";
}
}
echo $fsize2;
}else if($action=="top"){
echo $fsize1;
echo "<b>TOP Albumi</b><br/>";
echo $divide;
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album WHERE count>'0'"));
	$num_items = $noi[0]; //changable
	$items_per_page= 5;
	$num_pages = ceil($num_items/$items_per_page);
	if(($page>$num_pages)&&$page!=1)$page= $num_pages;
	$limit_start = ($page-1)*$items_per_page;

	$sql = "SELECT album FROM album_pic GROUP BY album ORDER BY vote DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
	//echo "<img src=\"resize.php?gname=$picture&amp;maxsize=100\" alt=\"*\"/><br/>";
	//$korisnik = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[1]."'"));
	//echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[1]&amp;ref=$ref\">$korisnik[0]</a>-$item[2]<br/>";
	$albumce = mysql_fetch_array(mysql_query("SELECT uid, name, about, type, time, count, view, sex FROM album WHERE id='".$item[0]."'"));
	$naslov=htmlspecialchars("$albumce[1]");
    $opis=htmlspecialchars("$albumce[2]");
	$slicice = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE album='".$item[0]."'"));
//echo "<b>Opis:</b> $opis<br/>";
//if($nazivni[3]==0){$tip="Javni";}
//else if($nazivni[3]==1){$tip="Privatni";}
//else if($nazivni[3]==2){$tip="Prijatelji";}
//echo "<b>Tip:</b> $tip<br/>";
//$vreme=date("d/m/Y - H:m", $nazivni[4]);
//echo "<b>Kreirano:</b> $vreme<br/>";
//echo "<b>Slika:</b> $slicice[0]<br/>";
//echo "<b>Pregleda:</b> $nazivni[6]<br/>";
///$korisnik = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nazivni[0]."'"));
//echo "<b>Autor:</b><a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$nazivni[0]&amp;ref=$ref\">$korisnik[0]</a><br/>";
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$item[0]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$albumce[0]."' AND ok='1' OR usid='".$id."' AND id='".$albumce[0]."' AND ok='1'"));
echo "<b><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$item[0]&amp;ref=$ref\">";
if($albumce[3]==0 || ($albumce[3]==1 && $dopustanje[0]>0) || ($albumce[3]==2 && $prijatelji[0]>0) || $id==$albumce[0] || $row["level"]>7){
$slsl = mysql_fetch_array(mysql_query("SELECT id FROM album_pic WHERE album='".$item[0]."' ORDER BY RAND() LIMIT 1"));

if($slsl){
echo "<img src=\"resize.php?gname=$slsl[0]&amp;maxsize=900\" alt=\"*\"/><br/>";
}
//echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
}
echo "$naslov($slicice[0])</a></b><br/><br/>";
	}
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=top&amp;page=$ppage&amp;ref=$ref\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=top&amp;page=$npage&amp;ref=$ref\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"albums.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"action\" value=\"$action\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"albums.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
echo $fsize2;
}else if($action=="male"){
echo $fsize1;
echo "<b>Muski Albumia</b><br/>";
echo $divide;
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album WHERE sex='M'"));
	$num_items = $noi[0]; //changable
	$items_per_page= 5;
	$num_pages = ceil($num_items/$items_per_page);
	if(($page>$num_pages)&&$page!=1)$page= $num_pages;
	$limit_start = ($page-1)*$items_per_page;

	$sql = "SELECT id, uid, name, about, type, time, count FROM album  WHERE sex='M' ORDER BY id DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
	$naslov=htmlspecialchars("$item[2]");
    $opis=htmlspecialchars("$item[3]");
	$slicice = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE album='".$item[0]."'"));
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$item[0]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$item[1]."' AND ok='1' OR usid='".$id."' AND id='".$item[1]."' AND ok='1'"));
echo "<b><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$item[0]&amp;ref=$ref\">";
if($item[4]==0 || ($item[4]==1 && $dopustanje[0]>0) || ($item[4]==2 && $prijatelji[0]>0) || $id==$item[1] || $row["level"]>7){
$slsl = mysql_fetch_array(mysql_query("SELECT id FROM album_pic WHERE album='".$item[0]."' ORDER BY RAND() LIMIT 1"));

if($slsl){
echo "<img src=\"resize.php?gname=$slsl[0]&amp;maxsize=900\" alt=\"*\"/><br/>";
}
//echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
}
echo "$naslov($slicice[0])</a></b><br/><br/>";
	}
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=male&amp;page=$ppage&amp;ref=$ref\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=male&amp;page=$npage&amp;ref=$ref\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"albums.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"action\" value=\"$action\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"albums.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
echo $fsize2;
}else if($action=="female"){
echo $fsize1;
echo "<b>Zenski Albumi</b><br/>";
echo $divide;
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album WHERE sex='Z'"));
	$num_items = $noi[0]; //changable
	$items_per_page= 5;
	$num_pages = ceil($num_items/$items_per_page);
	if(($page>$num_pages)&&$page!=1)$page= $num_pages;
	$limit_start = ($page-1)*$items_per_page;

	$sql = "SELECT id, uid, name, about, type, time, count FROM album  WHERE sex='Z' ORDER BY id DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
	$naslov=htmlspecialchars("$item[2]");
    $opis=htmlspecialchars("$item[3]");
	$slicice = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE album='".$item[0]."'"));
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$item[0]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$item[1]."' AND ok='1' OR usid='".$id."' AND id='".$item[1]."' AND ok='1'"));
echo "<b><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$item[0]&amp;ref=$ref\">";
if($item[4]==0 || ($item[4]==1 && $dopustanje[0]>0) || ($item[4]==2 && $prijatelji[0]>0) || $id==$item[1] || $row["level"]>7){
$slsl = mysql_fetch_array(mysql_query("SELECT id FROM album_pic WHERE album='".$item[0]."' ORDER BY RAND() LIMIT 1"));

if($slsl){
echo "<img src=\"resize.php?gname=$slsl[0]&amp;maxsize=900\" alt=\"*\"/><br/>";
}
//echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
}
echo "$naslov($slicice[0])</a></b><br/><br/>";
	}
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=female&amp;page=$ppage&amp;ref=$ref\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=female&amp;page=$npage&amp;ref=$ref\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"albums.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"action\" value=\"$action\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"albums.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
echo $fsize2;
}else if($action=="dopustanja"){
echo $fsize1;
$album=$_GET["album"];
echo "<b>Lista Dopustanja</b><br/>";
echo $divide;
$albumce = mysql_fetch_array(mysql_query("SELECT uid, type FROM album WHERE id='".$album."'"));
if($id==$albumce[0]){
if($albumce[1]==1){
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE album='".$album."'"));
	$num_items = $noi[0]; //changable
	$items_per_page= 10;
	$num_pages = ceil($num_items/$items_per_page);
	if(($page>$num_pages)&&$page!=1)$page= $num_pages;
	$limit_start = ($page-1)*$items_per_page;

	$sql = "SELECT id, uid FROM album_dop  WHERE album='".$album."' ORDER BY uid ASC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$prijatelji = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[1]."'"));
echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[1]&amp;ref=$ref\">$prijatelji[0]</a> ";
 echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=deldop&amp;korisnik=$item[0]&amp;ref=$ref&amp;album=$album\">[X]</a><br/>";
	}
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=dopustanja&amp;page=$ppage&amp;ref=$ref&amp;album=$album\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=dopustanja&amp;page=$npage&amp;ref=$ref&amp;album=$album\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"albums.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"action\" value=\"$action\"/>";
		$rets .= "<postfield name=\"album\" value=\"$album\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"albums.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
		$rets .= "<input type=\"hidden\" name=\"album\" value=\"$album\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=dop1&amp;ref=$ref&amp;album=$album\">Daj Dopustanje</a> ";
}else{
echo "Ovaj album nije privatni!<br/>";
}
}else{
echo "Ovo nije Vas album!<br/>";
}
echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
echo $fsize2;
}else if($action=="dop1"){
echo $fsize1;
$album=$_GET["album"];
echo "<b>Dajvanje Dopustanja</b><br/>";
echo $divide;
$albumce = mysql_fetch_array(mysql_query("SELECT uid, type FROM album WHERE id='".$album."'"));
if($id==$albumce[0]){
if($albumce[1]==1){
if($ver=="wml"){
  echo "Nick ili Id Korisnika:<br/><input name=\"korisnik\" maxlength=\"30\" value=\"\"/><br/>";
  echo "<anchor>Dodaj!";
  echo "<go href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=dop2&amp;ref=$ref&amp;album=$album\" method=\"post\">";
  echo "<postfield name=\"korisnik\" value=\"$(korisnik)\"/>";
  echo "</go></anchor><br/>";
  }else{
  echo "<form method=\"post\" action=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=dop2&amp;ref=$ref&amp;album=$album\" name=\"auth\">\n";
  echo "Nick ili Id Korisnika:<br/><input name=\"korisnik\" maxlength=\"30\" value=\"$ime\"/><br/>";
echo "<input type=\"submit\" value=\"Dodaj!\" name=\"enter\"></form>";
  }
}else{
echo "Ovaj album nije privatni!<br/>";
}
}else{
echo "Ovo nije Vas album!<br/>";
}
echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
echo $fsize2;
}else if($action=="dop2"){
echo $fsize1;
$album=$_GET["album"];
$korisnik=$_POST["korisnik"];
echo "<b>Davanje Dopustanja</b><br/>";
echo $divide;
$albumce = mysql_fetch_array(mysql_query("SELECT uid, type FROM album WHERE id='".$album."'"));
if($id==$albumce[0]){
if($albumce[1]==1){
if($korisnik!=""){
$err=1;
$korisnik1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE id='".$korisnik."'"));
if($korisnik1[0]>0){
$korisnik=$korisnik;
$err=0;
}else{
$korisnik = strtolower($korisnik);
$korisnik2 = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE latuser='".$korisnik."'"));
if($korisnik2[0]>0){
$korisnik=$korisnik2[0];
$err=0;
}
}
if($err==0){
if($id!=$korisnik){
$usbre = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE album='".$album."' AND uid='".$korisnik."'"));
if($usbre[0]==0){
$insert = mysql_query("INSERT INTO album_dop SET uid='".$korisnik."', album='".$album."'");
if($insert){
echo "Dopustanje je uspesno dodato!<br/>";
}else{
echo "Greska!!!<br/>";
}
}else{
echo "Ovaj korisnik vec ima dopustanje!<br/>";
}
}else{
echo "Vec imate dopustanje!<br/>";
}
}else{
echo "Korisnik nije pronadjen!<br/>";
}
}else{
echo "Morate uneti Nick ili Id Korisnika!<br/>";
}
}else{
echo "Ovaj album nije privatni!<br/>";
}
}else{
echo "Ovo nije Vas album!<br/>";
}
echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
echo $fsize2;
}else if($action=="deldop"){
echo $fsize1;
$album=$_GET["album"];
$korisnik=$_GET["korisnik"];
echo "<b>Brisanje Dopustanja</b><br/>";
echo $divide;
$albumce = mysql_fetch_array(mysql_query("SELECT uid, type FROM album WHERE id='".$album."'"));
if($id==$albumce[0]){
if($albumce[1]==1){
$usbre = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE id='".$korisnik."'"));
if($usbre[0]>0){
$insert = mysql_query("DELETE FROM album_dop WHERE id='".$korisnik."'");
if($insert){
echo "Dopustanje je uspesno obrisano!<br/>";
}else{
echo "Greska!!!<br/>";
}
}else{
echo "Ovaj korisnik nema dopustanje!<br/>";
}
}else{
echo "Ovaj album nije privatni!<br/>";
}
}else{
echo "Ovo nije Vas album!<br/>";
}
echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
echo $fsize2;
}else if($action=="myalbums"){
echo $fsize1;
echo "<b>Moji Albumi</b><br/>";
echo $divide;
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album WHERE uid='".$id."'"));
	$num_items = $noi[0]; //changable
	$items_per_page= 5;
	$num_pages = ceil($num_items/$items_per_page);
	if(($page>$num_pages)&&$page!=1)$page= $num_pages;
	$limit_start = ($page-1)*$items_per_page;

	$sql = "SELECT id, uid, name, about, type, time, count FROM album  WHERE uid='".$id."' ORDER BY id DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
	$naslov=htmlspecialchars("$item[2]");
    $opis=htmlspecialchars("$item[3]");
	$slicice = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE album='".$item[0]."'"));
//$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$item[0]."'"));
//$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$item[1]."' AND ok='1' OR usid='".$id."' AND id='".$item[1]."' AND ok='1'"));
echo "<b><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$item[0]&amp;ref=$ref\">";
$slsl = mysql_fetch_array(mysql_query("SELECT id FROM album_pic WHERE album='".$item[0]."' ORDER BY RAND() LIMIT 1"));
if($slsl){
echo "<img src=\"resize.php?gname=$slsl[0]&amp;maxsize=900\" alt=\"*\"/><br/>";
}
//echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
echo "$naslov($slicice[0])</a></b> ";
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=obrisi&amp;album=$item[0]&amp;ref=$ref\">[X]</a> ";
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=izmeni&amp;album=$item[0]&amp;ref=$ref\">[E]</a><br/><br/>";
	}
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=myalbums&amp;page=$ppage&amp;ref=$ref\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=myalbums&amp;page=$npage&amp;ref=$ref\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"albums.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"action\" value=\"$action\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"albums.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
echo $fsize2;
}else if($action=="obrisi"){
echo $fsize1;
$album=$_GET["album"];
$ok=$_GET["ok"];
echo "<b>Brisanje Albuma</b><br/>";
echo $divide;
$albumce = mysql_fetch_array(mysql_query("SELECT uid, name FROM album WHERE id='".$album."'"));
$naslov=htmlspecialchars("$albumce[1]");
if($id==$albumce[0]){
if($ok=="1"){
$dell = mysql_query("DELETE FROM album WHERE id='".$album."'");
if($dell){
$maxxx = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM album_pic WHERE album='".$album."'"));
$dell1 = mysql_query("DELETE FROM album_dop WHERE album='".$album."'");
for($i=0; $i<=$maxxx[0]; $i++){
$maxxx1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE album='".$album."' AND id='".$i."'"));
if($maxxx1){
$dell2 = mysql_query("DELETE FROM album_com WHERE pid='".$i."'");
$dell3 = mysql_query("DELETE FROM album_vote WHERE pid='".$i."'");
$dell = mysql_query("DELETE FROM album_pic WHERE album='".$album."'");
}
}
echo "Album je uspesno obrisan!<br/>";
}else{
echo "Greska!!!<br/>";
}
}else{
echo "Zelite li da obrisete album <b>$naslov</b>?<br/>";
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=obrisi&amp;album=$album&amp;ref=$ref&amp;ok=1\">DA</a> ";
echo " <a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$album&amp;ref=$ref\">NE</a><br/><br/>";
}
}else{
echo "Ovo nije Vas album!<br/>";
}
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
echo $fsize2;
}else if($action=="izmeni"){
echo $fsize1;
$album=$_GET["album"];
echo "<b>Menjanje Albuma</b><br/>";
echo $divide;
$albumce = mysql_fetch_array(mysql_query("SELECT uid, name, about, type FROM album WHERE id='".$album."'"));
$naslov=htmlspecialchars("$albumce[1]");
$opis=htmlspecialchars("$albumce[2]");
if($id==$albumce[0]){
if($ver=="wml"){
  echo "Naziv:<br/><input name=\"naziv\" maxlength=\"20\" value=\"$naslov\" /><br/>";
  echo "Opis:<br/><input name=\"opis\" maxlength=\"50\" value=\"$opis\"/><br/>";
  echo "Tip:<br/>";
  echo "<select name=\"tip\" value=\"$albumce[3]\">";
  echo "<option value=\"0\">Javni</option>";
  echo "<option value=\"1\">Privatni</option>";
  echo "<option value=\"2\">Prijatelji</option>";
  echo "</select><br/><br/>";
  echo "<anchor>Izmeni";
  echo "<go href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=izmeni1&amp;ref=$ref\" method=\"post\">";
  echo "<postfield name=\"naziv\" value=\"$(naziv)\"/>";
  echo "<postfield name=\"opis\" value=\"$(opis)\"/>";
  echo "<postfield name=\"tip\" value=\"$(tip)\"/>";
  echo "<postfield name=\"album\" value=\"$album\"/>";
  echo "</go></anchor><br/>";
  }else{
  echo "<form method=\"post\" action=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=izmeni1&amp;ref=$ref\" name=\"auth\">\n";
  echo "Naziv:<br/><input name=\"naziv\" maxlength=\"20\" value=\"$naslov\" /><br/>";
  echo "Opis:<br/><input name=\"opis\" maxlength=\"50\" value=\"$opis\"/><br/>";
  echo "Tip:<br/>";
  echo "<select name=\"tip\" value=\"$albumce[3]\">";
  echo "<option value=\"0\">Javni</option>";
  echo "<option value=\"1\">Privatni</option>";
  echo "<option value=\"2\">Prijatelji</option>";
  echo "</select><br/><br/>";
  echo "<input type=\"hidden\" value=\"$album\" name=\"album\">";
  echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"></form>";
  }
}else{
echo "Ovo nije Vas album!<br/>";
}
echo $fsize2;
}else if($action=="izmeni1"){
echo $fsize1;
$album=$_POST["album"];
$naziv=$_POST["naziv"];
$opis=$_POST["opis"];
$tip=$_POST["tip"];
echo "<b>Menjanje Albuma</b><br/>";
echo $divide;
$albumce = mysql_fetch_array(mysql_query("SELECT uid, name, about, type FROM album WHERE id='".$album."'"));
if($id==$albumce[0]){
if($naziv!="" && $opis!=""){
$update = mysql_query("UPDATE album SET name='".$naziv."', about='".$opis."', type='".$tip."' WHERE id='".$album."'");
if($update){
echo "Album je uspesno izmenjen!<br/>";
}else{
echo "Greska!!!<br/>";
}
}else{
echo "Morate uneti naziv i opis albuma!<br/>";
}
}else{
echo "Ovo nije Vas album!<br/>";
}
echo $fsize2;
}else if($action=="comments"){
echo $fsize1;
$picture=$_GET["picture"];
$nazivni = mysql_fetch_array(mysql_query("SELECT uid, album, file, time, count, view, sex, comments FROM album_pic WHERE id='".$picture."'"));
$album = mysql_fetch_array(mysql_query("SELECT uid, name, about, type, count, view FROM album WHERE id='".$nazivni[1]."'"));
$naslov=htmlspecialchars("$album[1]");
$opis=htmlspecialchars("$album[2]");
if(!$nazivni){
echo "<b>Pogresna Slika</b><br/>";
echo $divide;
echo "Odabrali ste pogresnu sliku!<br/>";
}else if(!$album){
echo "<b>Pogresan Album</b><br/>";
echo $divide;
echo "Odabrali ste pogresan album!<br/>";
}else{
echo "<b>Lista Komentara</b><br/>";
echo $divide;
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$nazivni[1]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$nazivni[0]."' AND ok='1' OR usid='".$id."' AND id='".$nazivni[0]."' AND ok='1'"));
if($album[3]==0 || ($album[3]==1 && $dopustanje[0]>0) || ($album[3]==2 && $prijatelji[0]>0) || $id==$album[0] || $row["level"]>7){
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_com WHERE pid='".$picture."'"));
	$num_items = $noi[0]; //changable
	$items_per_page= 5;
	$num_pages = ceil($num_items/$items_per_page);
	if(($page>$num_pages)&&$page!=1)$page= $num_pages;
	$limit_start = ($page-1)*$items_per_page;

	$sql = "SELECT id, uid, pid, comment, time FROM album_com WHERE pid='".$picture."' ORDER BY id DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
	echo "<img src=\"resize.php?gname=$picture&amp;maxsize=900\" alt=\"*\"/><br/>";
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
	$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[1]."'"));
	$timesss=date("d-m-Y H:i", $item[4]);
	$msg=$item[3];
    $msg=getsmilies($msg, $item[1]);
	echo "<b><a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[1]&amp;ref=$ref\">$napisao[0]:</a></b> ";
	   $msg=zamena($msg);
	   echo "$msg";
	   if($row["level"]>7 || $nazivni[0]==$id){
	   echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=delcom&amp;ref=$ref&amp;com=$item[0]\">[X]</a> ";
	   }
	   echo "<br/>$timesss<br/>$divide";
	}
	echo "<br/>";
	}else{
	echo "<br/>Niko nije komentarisao!<br/>";
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=comments&amp;page=$ppage&amp;ref=$ref&amp;picture=$picture\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=comments&amp;page=$npage&amp;ref=$ref&amp;picture=$picture\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"albums.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"action\" value=\"$action\"/>";
		$rets .= "<postfield name=\"picture\" value=\"$picture\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"albums.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
		$rets .= "<input type=\"hidden\" name=\"picture\" value=\"$picture\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
	echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=comments1&amp;picture=$picture&amp;ref=$ref\">Dodaj Komentar</a><br/>";
	echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=picture&amp;picture=$picture&amp;ref=$ref\">Pogledaj Sliku</a><br/>";
	echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$nazivni[1]&amp;ref=$ref\">Pogledaj Album</a><br/>";
}else{
echo "Nemate prava pristupa!<br/>";
}
}
echo $fsize2;
}else if($action=="comments1"){
echo $fsize1;
$picture=$_GET["picture"];
$nazivni = mysql_fetch_array(mysql_query("SELECT uid, album, file, time, count, view, sex, comments FROM album_pic WHERE id='".$picture."'"));
$album = mysql_fetch_array(mysql_query("SELECT uid, name, about, type, count, view FROM album WHERE id='".$nazivni[1]."'"));
$naslov=htmlspecialchars("$album[1]");
$opis=htmlspecialchars("$album[2]");
if(!$nazivni){
echo "<b>Pogresna Slika</b><br/>";
echo $divide;
echo "Odabrali ste pogresnu sliku!<br/>";
}else if(!$album){
echo "<b>Pogresan Album</b><br/>";
echo $divide;
echo "Odabrali ste pogresan album!<br/>";
}else{
echo "<b>Dodaj Komentar</b><br/>";
echo $divide;
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$nazivni[1]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$nazivni[0]."' AND ok='1' OR usid='".$id."' AND id='".$nazivni[0]."' AND ok='1'"));
if($album[3]==0 || ($album[3]==1 && $dopustanje[0]>0) || ($album[3]==2 && $prijatelji[0]>0) || $id==$album[0] || $row["level"]>7){
if($ver=="xhtml"){
echo "<form method=\"POST\" action=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=comments2&amp;picture=$picture&amp;ref=$ref\" name=\"auth\">\n";
}
	echo "Komentar:<br/>";
    echo "<input name=\"text\" maxlength=\"300\"/><br/>";
    if ($ver=="wml"){
	echo "<anchor>Dodaj";
	echo "<go href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=comments2&amp;picture=$picture&amp;ref=$ref\" method=\"post\">";
	echo "<postfield name=\"text\" value=\"$(text)\"/>";
	echo "</go></anchor><br/><br/>";
	}else{
	echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/><br/>\n";
	echo "</form>";
	}
	echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=picture&amp;picture=$picture&amp;ref=$ref\">Pogledaj Sliku</a><br/>";
	echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$nazivni[1]&amp;ref=$ref\">Pogledaj Album</a><br/>";
}else{
echo "Nemate prava pristupa!<br/>";
}
}
echo $fsize2;
}else if($action=="comments2"){
echo $fsize1;
$picture=$_GET["picture"];
$text=$_POST["text"];
$nazivni = mysql_fetch_array(mysql_query("SELECT uid, album, file, time, count, view, sex, comments FROM album_pic WHERE id='".$picture."'"));
$album = mysql_fetch_array(mysql_query("SELECT uid, name, about, type, count, view FROM album WHERE id='".$nazivni[1]."'"));
$naslov=htmlspecialchars("$album[1]");
$opis=htmlspecialchars("$album[2]");
if(!$nazivni){
echo "<b>Pogresna Slika</b><br/>";
echo $divide;
echo "Odabrali ste pogresnu sliku!<br/>";
}else if(!$album){
echo "<b>Pogresan Album</b><br/>";
echo $divide;
echo "Odabrali ste pogresan album!<br/>";
}else{
echo "<b>Dodaj Komentar</b><br/>";
echo $divide;
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$nazivni[1]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$nazivni[0]."' AND ok='1' OR usid='".$id."' AND id='".$nazivni[0]."' AND ok='1'"));
if($album[3]==0 || ($album[3]==1 && $dopustanje[0]>0) || ($album[3]==2 && $prijatelji[0]>0) || $id==$album[0] || $row["level"]>7){
if($text!=""){
$dodaj = mysql_query("INSERT INTO album_com SET uid='".$id."', pid='".$picture."', comment='".$text."', time='".time()."'");
if($dodaj){
echo "Komentar je uspesno dodat!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nazivni[0]."'"));
$adm = mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = mysql_fetch_array ($adm);
$administration = $z["user"];
$administration = check($administration);
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Komentar $napisao[0]";

$message = "Clan <b>$napisao[0]</b> dodao je komentar za vasu sliku $nazivni[2]!<br/><b>Komentar:</b>$text";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$nazivni[0]."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
$com=$nazivni[7]+1;
$dodaj11 = mysql_query("UPDATE album_pic SET comments='".$com."' WHERE id='".$picture."'");
}else{
echo "Greska!!!<br/>";
}
	echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=picture&amp;picture=$picture&amp;ref=$ref\">Pogledaj Sliku</a><br/>";
	echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$nazivni[1]&amp;ref=$ref\">Pogledaj Album</a><br/>";
}else{
echo "Morate uneti komentar!<br/>";
}
}else{
echo "Nemate prava pristupa!<br/>";
}
}
echo $fsize2;
}else if($action=="delcom"){
echo $fsize1;
$com=$_GET["com"];
$nazivni = mysql_fetch_array(mysql_query("SELECT pid FROM album_com WHERE id='".$com."'"));
$slika = mysql_fetch_array(mysql_query("SELECT uid, comments FROM album_pic WHERE id='".$nazivni[0]."'"));
if(!$nazivni){
echo "<b>Pogresan Komentar</b><br/>";
echo $divide;
echo "Odabrali ste pogresan komentar!<br/>";
}else if(!$slika){
echo "<b>Pogresna Slika</b><br/>";
echo $divide;
echo "Odabrali ste pogresnu sliku!<br/>";
}else{
echo "<b>Brisi Komentar</b><br/>";
echo $divide;

if($row["level"]>7 || $id==$slika[0]){
$dodaj = mysql_query("DELETE FROM album_com WHERE id='".$com."'");
if($dodaj){
$commmm=$slika[1]-1;
$dodaj1 = mysql_query("UPDATE album_pic SET comments='".$commmm."'WHERE id='".$nazivni[0]."'");
echo "Komentar je uspesno obrisan!<br/>";
}else{
echo "Greska!!!<br/>";
}
	echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=picture&amp;picture=$nazivni[0]&amp;ref=$ref\">Pogledaj Sliku</a><br/>";
	//echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$nazivni[1]&amp;ref=$ref\">Pogledaj Album</a><br/>";
}else{
echo "Ne mozete brisati komentar!<br/>";
}
}
echo $fsize2;
}else if($action=="viewuser"){
$who=$_GET["who"];
$ususus = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
echo $fsize1;
echo "<b>$ususus[0] Albumi</b><br/>";
echo $divide;
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album WHERE uid='".$who."'"));
	$num_items = $noi[0]; //changable
	$items_per_page= 5;
	$num_pages = ceil($num_items/$items_per_page);
	if(($page>$num_pages)&&$page!=1)$page= $num_pages;
	$limit_start = ($page-1)*$items_per_page;

	$sql = "SELECT id, uid, name, about, type, time, count FROM album  WHERE uid='".$who."' ORDER BY id DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
	$naslov=htmlspecialchars("$item[2]");
    $opis=htmlspecialchars("$item[3]");
	$slicice = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_pic WHERE album='".$item[0]."'"));
$dopustanje = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM album_dop WHERE uid='".$id."' AND album='".$item[0]."'"));
$prijatelji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$id."' AND usid='".$item[1]."' AND ok='1' OR usid='".$id."' AND id='".$item[1]."' AND ok='1'"));
echo "<b><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view&amp;album=$item[0]&amp;ref=$ref&amp;who=$who\">";
if($item[4]==0 || ($item[4]==1 && $dopustanje[0]>0) || ($item[4]==2 && $prijatelji[0]>0) || $id==$item[1] || $row["level"]>7){
$slsl = mysql_fetch_array(mysql_query("SELECT id FROM album_pic WHERE album='".$item[0]."' ORDER BY RAND() LIMIT 1"));

if($slsl){
echo "<img src=\"resize.php?gname=$slsl[0]&amp;maxsize=900\" alt=\"*\"/><br/>";
}
//echo "<br/><a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=view1&amp;album=$album&amp;ref=$ref\">Pregledaj Album</a><br/>";
}
echo "$naslov($slicice[0])</a></b><br/><br/>";
	}
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=viewuser&amp;page=$ppage&amp;ref=$ref&amp;who=$who\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=viewuser&amp;page=$npage&amp;ref=$ref&amp;who=$who\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"albums.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"action\" value=\"$action\"/>";
		$rets .= "<postfield name=\"who\" value=\"$who\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"albums.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
		$rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
echo $fsize2;
}
/////////////////////////////////////////////////////////////////////////////////////
echo $fsize1;
echo $divide;
if($action==""){
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=myalbums&amp;ref=$ref\">Moji Albumi</a><br/>";
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=new&amp;ref=$ref\">Dodaj Album</a><br/>";
}else{
if($who && $who!=""){
$ususus = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$who&amp;ref=$ref\">$ususus[0] profil</a><br/>";
}
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">Foto Albumi</a><br/>";
}
print "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
print $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>