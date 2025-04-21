<?php  
include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php"); 
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

/////////////////////////////////////////////////////////////////////////
$nocna = mysql_fetch_array(mysql_query("SELECT lockforum FROM setting"));
if ($nocna[0]==0){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>";
echo "<card id=\"ban\" title=\"Greska!!!\" ontimer=\"enter.php?ver=$ver&amp;ref=$ref\"><timer value=\"30\"/>";
echo "<p align=\"center\">";
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
echo "<title>STOP!!!</title>";
echo "<div align=\"center\">";
}
echo "<small>";
echo "Nocni ulasci na ovu opciju chata nisu dozvoljeni!<br/>";
echo "</small>";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n"; 
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
exit;
}

//////////////////////////////////////////////////
if ($ver=="wml"){
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">\n";
echo "<wml>\n<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/>\n";
echo "<meta http-equiv=\"Pragma\" content=\"no-cache\"/></head>\n";
echo "<card id=\"x\" title=\"Forum\">\n";
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
echo "<title>Forum!</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}

$posts = mysql_fetch_array(mysql_query("SELECT id, posts FROM `users` WHERE id='".$id."'"));
if($posts[1]<'1000'){
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
echo "<b>Nemate prava pristupa dok ne sakupite 1000 postova!!!</b><br/>";
$admer = mysql_query("UPDATE users SET gde='room11' WHERE id='".$id."' LIMIT 1;");
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
exit;
}

if($action=="cat"){
$cid=$_GET["cid"];
$kategorija = mysql_fetch_array(mysql_query("SELECT id, name, position, permision FROM forums WHERE id='".$cid."'"));
$kateg=htmlspecialchars("$kategorija[1]");
echo $fsize1;
echo "<b>$kateg</b><br/>";
echo $divide;
echo $fsize2;
if($kategorija[3]<=$row["level"]){
///////////////////////////////////////////
$gde="*#*#*#*$kateg";
include("gde.php");
///////////////////////////////////////////
echo $fsize1;
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=new&amp;cid=$cid\">Nova Tema</a><br/><br/>";
if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM topics WHERE fid='".$cid."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, uid, name, view, answer FROM topics WHERE fid='".$cid."' ORDER BY last DESC LIMIT $limit_start, $items_per_page";
	$items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
	$imeime=htmlspecialchars("$item[2]");
	$postovi1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE tid='".$item[0]."'"));
	echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=topic&amp;tid=$item[0]\"><b>$imeime</b>($postovi1[0])</a>";
	
	echo "<br/>";
    }
    }
	if($num_pages>1){
	echo "<br/>";
	}
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=cat&amp;cid=$cid&amp;page=$ppage\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=cat&amp;cid=$cid&amp;page=$npage\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
	
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=new&amp;cid=$cid\">Nova Tema</a><br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Nemate pravo pristupa!<br/>";
echo $fsize2;
}
}else if($action=="new"){
$cid=$_GET["cid"];
$kategorija = mysql_fetch_array(mysql_query("SELECT id, name, position, permision FROM forums WHERE id='".$cid."'"));
$kateg=htmlspecialchars("$kategorija[1]");
echo $fsize1;
echo "<b>Nova Tema</b><br/>";
echo $divide;
echo $fsize2;
if($kategorija[3]<=$row["level"]){
///////////////////////////////////////////
$gde="*#*#*#*Otvara Temu";
include("gde.php");
///////////////////////////////////////////
if ($ver=="wml"){
echo $fsize1;
echo "Naziv Teme:<br/>";
echo $fsize2;
echo "<input name=\"naziv\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "Tekst Teme:<br/>";
echo $fsize2;
echo "<input name=\"tekst\" maxlength=\"500\"/><br/>";
echo $fsize1;
echo "<anchor>Dodaj<go href=\"forum.php?$ses&amp;ref=$ref&amp;action=new1&amp;cid=$cid\" method=\"post\">";
echo "<postfield name=\"naziv\" value=\"$(naziv)\"/>";
echo "<postfield name=\"tekst\" value=\"$(tekst)\"/>";
echo "</go></anchor><br/>";
echo $fsize2;
}else{
echo "<form method=\"post\" action=\"forum.php?$ses&amp;ref=$ref&amp;action=new1&amp;cid=$cid\" name=\"auth\">\n";
echo $fsize1;
echo "Naziv Teme:<br/>";
echo $fsize2;
echo "<input name=\"naziv\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "Tekst Teme:<br/>";
echo $fsize2;
echo "<input name=\"tekst\" maxlength=\"500\"/><br/>";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"/></form><br/>\n";
}
echo $fsize1;
echo "<br/><a href=\"forum.php?$ses&amp;ref=$ref&amp;action=cat&amp;cid=$cid\">$kateg</a><br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Nemate pravo pristupa!<br/>";
echo $fsize2;
}
}else if($action=="new1"){
$cid=$_GET["cid"];
$naziv=$_POST["naziv"];
$tekst=$_POST["tekst"];
//----------- Blokada otvaranja teme ------------------------//
$tekst = check($tekst);
//---------------- 25.12.2017 Tihiokean -------------------//
$kategorija = mysql_fetch_array(mysql_query("SELECT id, name, position, permision FROM forums WHERE id='".$cid."'"));
$kateg=htmlspecialchars("$kategorija[1]");
echo $fsize1;
echo "<b>Nova Tema</b><br/>";
echo $divide;
echo $fsize2;
if($kategorija[3]<=$row["level"]){
///////////////////////////////////////////
$gde="*#*#*#*Otvara Temu";
include("gde.php");
///////////////////////////////////////////
echo $fsize1;
if($naziv!="" && $tekst!=""){
$nazvano = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM topics WHERE fid='".$cid."' AND name='".$naziv."'"));
if($nazvano[0]==0){
$insertni=mysql_query("INSERT INTO topics SET uid='".$id."', fid='".$cid."', name='".$naziv."', text='".$tekst."', time='".time()."', last='".time()."'");
if($insertni){
echo "Tema je uspesno dodata!<br/>";
$temena = mysql_fetch_array(mysql_query("SELECT id, name FROM topics WHERE fid='".$cid."' AND name='".$naziv."'"));
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=topic&amp;tid=$temena[0]\">$temena[1]</a><br/>";
}else{
echo "Greska na bazi!<br/>";
}
}else{
echo "Tema sa ovakvim nazivom vec postoji!<br/>";
}
}else{
echo "Morate uneti Naziv i Tekst teme!<br/>";
}
echo "<br/><a href=\"forum.php?$ses&amp;ref=$ref&amp;action=cat&amp;cid=$cid\">$kateg</a><br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Nemate pravo pristupa!<br/>";
echo $fsize2;
}
}else if($action=="newpost"){
$tid=$_GET["tid"];
$teman = mysql_fetch_array(mysql_query("SELECT uid, fid, name, text, time, last FROM topics WHERE id='".$tid."'"));
$kategorija = mysql_fetch_array(mysql_query("SELECT id, name, position, permision FROM forums WHERE id='".$teman[1]."'"));
if($teman){
$naznaz=htmlspecialchars("$teman[2]");
echo $fsize1;
echo "<b>$naznaz</b><br/>";
echo $divide;
echo $fsize2;
if($kategorija[3]<=$row["level"]){
///////////////////////////////////////////
$gde="*#*#*#*Odgovara";
include("gde.php");
///////////////////////////////////////////
if ($ver=="wml"){
echo $fsize1;
echo "Odgovor:<br/>";
echo $fsize2;
echo "<input name=\"odgovor\" maxlength=\"500\"/><br/>";
echo $fsize1;
echo "<anchor>Dodaj<go href=\"forum.php?$ses&amp;ref=$ref&amp;action=newpost1&amp;tid=$tid\" method=\"post\">";
echo "<postfield name=\"odgovor\" value=\"$(odgovor)\"/>";
echo "</go></anchor>";
echo $fsize2;
}else{
echo "<form method=\"post\" action=\"forum.php?$ses&amp;ref=$ref&amp;action=newpost1&amp;tid=$tid\" name=\"auth\">\n";
echo $fsize1;
echo "Odgovor:<br/>";
echo $fsize2;
echo "<input name=\"odgovor\" maxlength=\"500\"/><br/>";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"/></form>\n";
}
echo $fsize1;
echo "<br/><a href=\"forum.php?$ses&amp;ref=$ref&amp;action=cat&amp;cid=$cid\">$kateg</a><br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Nemate pravo pristupa!<br/>";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Nepostojeca tema!<br/>";
echo $fsize2;
}
}else if($action=="newpost1"){
$fid=$_GET["fid"];
$page=$_GET["page"];
$odgovor=$_POST["odgovor"];
//----------- Blokada pisanja posta ------------------------//
$odgovor = check($odgovor);
//---------------- 25.12.2017 Tihiokean -------------------//
$teman = mysql_fetch_array(mysql_query("SELECT uid, fid, name, text, time, last FROM topics WHERE id='".$tid."'"));
if($teman){
$kategorija = mysql_fetch_array(mysql_query("SELECT id, name, position, permision FROM forums WHERE id='".$teman[1]."'"));
$katkat=htmlspecialchars("$teman[2]");
$katarka=htmlspecialchars("$kategorija[1]");
echo $fsize1;
echo "<b>$katkat</b><br/>";
echo $divide;
echo $fsize2;
if($kategorija[3]<=$row["level"]){
///////////////////////////////////////////
$gde="*#*#*#*Odgovara";
include("gde.php");
///////////////////////////////////////////
echo $fsize1;
$zadnja = mysql_fetch_array(mysql_query("SELECT MAX(time) FROM posts WHERE tid='".$tid."' AND uid='".$id."'"));
$zadnja1=$zadnja[0]+30;
$sada=time();
if($zadnja1<$sada){
if($odgovor!=""){
$insertni=mysql_query("INSERT INTO posts SET uid='".$id."', fid='".$teman[1]."', tid='".$tid."', text='".$odgovor."', time='".time()."'");
if($insertni){
echo "Odgovor je uspesno dodat!<br/>";
$insertni1=mysql_query("UPDATE topics SET last='".time()."' WHERE id='".$tid."'");
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=topic&amp;tid=$tid&amp;page=$page\">$katkat</a><br/>";
}else{
echo "Greska na bazi!<br/>";
}
}else{
echo "Morate uneti Odgovor!<br/>";
}
}else{
echo "Morate sacekati!<br/>";
}
echo "<br/><a href=\"forum.php?$ses&amp;ref=$ref&amp;action=cat&amp;cid=$teman[1]\">$katarka</a><br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Nemate pravo pristupa!<br/>";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Nepostojeca tema!<br/>";
echo $fsize2;
}
}else if($action=="topic"){
$tid=$_GET["tid"];
$naziv=$_POST["naziv"];
$tekst=$_POST["tekst"];
$teman = mysql_fetch_array(mysql_query("SELECT uid, fid, name, text, time, last FROM topics WHERE id='".$tid."'"));
if($teman){
$kategorija = mysql_fetch_array(mysql_query("SELECT id, name, position, permision, category FROM forums WHERE id='".$teman[1]."'"));
$nastema=htmlspecialchars("$teman[2]");
echo $fsize1;
echo "<b>$nastema</b><br/>";
echo $divide;
echo $fsize2;
if($kategorija[3]<=$row["level"]){
///////////////////////////////////////////
$gde="*#*#*#*Pregleda Temu";
include("gde.php");
///////////////////////////////////////////
echo $fsize1;
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=newpost&amp;tid=$tid\">Odgovori</a><br/>";
echo $fsize2;
if($ver=="wml"){
echo "</p>";
echo "<p align=\"left\">";
}else{
echo "</div>";
echo "<div align=\"left\">";
}
echo $fsize1;
$prvoime = mysql_fetch_array(mysql_query("SELECT user,color,specolor FROM users WHERE id='".$teman[0]."'"));
$prvoime[0] = EdykaColor($prvoime[0],$prvoime[1],$prvoime[2]);
$prvipost=htmlspecialchars("$teman[3]");
if(!empty($prvoime[1])) $prvoime[0] = '<font color="#'.$prvoime[1].'">'.$prvoime[0].'</font>';
echo "<b><a href=\"info.php?$ses&amp;ref=$ref&amp;nk=$teman[0]\">$prvoime[0]</a>: ";
echo "$teman[3]</b>";
if($row["level"]>10){
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=deltop&amp;tid=$tid\">[X]</a>";
}
$prvovreme=date("d-m-Y H:i:s", $teman[4]);
echo "<br/>$prvovreme<br/><br/>";
if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE tid='".$tid."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, uid, fid, tid, text, time FROM posts WHERE tid='".$tid."' ORDER BY id ASC LIMIT $limit_start, $items_per_page";
	$items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
	$imeime=htmlspecialchars("$item[4]");
	$imeime=getsmilies($imeime, $item[1]);
	$imeime=zamena($imeime);
	$tenzija = mysql_fetch_array(mysql_query("SELECT user,color,specolor FROM users WHERE id='".$item[1]."'"));
        $tenzija[0] = EdykaColor($tenzija[0],$tenzija[1],$tenzija[2]);
        if(!empty($tenzija[1])) $tenzija[0] = '<font color="#'.$tenzija[1].'">'.$tenzija[0].'</font>';
	echo "<a href=\"info.php?$ses&amp;ref=$ref&amp;nk=$item[1]\">$tenzija[0]</a>: ";
	echo "$imeime ";
	if($row["level"]>3){
	echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=delpost&amp;pid=$item[0]\">[X]</a>";
	}
	$drugovreme=date("d-m-Y H:i:s", $item[5]);
	echo "<br/>$drugovreme";
	echo "<br/><br/>";
    }
    }
echo $fsize2;
if($ver=="wml"){
echo "</p>";
echo "<p align=\"center\">";
}else{
echo "</div>";
echo "<div align=\"center\">";
}
echo $fsize1;
	if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=topic&amp;tid=$tid&amp;page=$ppage\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=topic&amp;tid=$tid&amp;page=$npage\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/><br/>";
	if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"forum.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
        $rets .= "<postfield name=\"action\" value=\"$action\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"tid\" value=\"$tid\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"forum.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"action\" value=\"$action\"/>";
		$rets .= "<input type=\"hidden\" name=\"tid\" value=\"$tid\"/>";
        $rets .= "</form>";
        }
        echo $rets;
}
echo $fsize2;
if ($ver=="wml"){
echo "<br/><input name=\"odgovor\" maxlength=\"500\"/><br/>";
echo $fsize1;
echo "<anchor>Brzi Odgovor<go href=\"forum.php?$ses&amp;ref=$ref&amp;action=newpost1&amp;tid=$tid&amp;page=$page\" method=\"post\">";
echo "<postfield name=\"odgovor\" value=\"$(odgovor)\"/>";
echo "</go></anchor><br/>";
echo $fsize2;
}else{
echo "<br/><form method=\"post\" action=\"forum.php?$ses&amp;ref=$ref&amp;action=newpost1&amp;tid=$tid&amp;page=$page\" name=\"auth\">\n";
echo "<input name=\"odgovor\" maxlength=\"500\"/><br/>";
echo "<input type=\"submit\" value=\"Brzi Odgovor\" name=\"enter\"/></form><br/>";
}
echo $fsize1;
$katar=htmlspecialchars($kategorija[1]);
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=cat&amp;cid=$kategorija[0]\">$katar</a><br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Nemate pravo pristupa!<br/>";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Nepostojeca tema!<br/>";
echo $fsize2;
}
}else if($action=="delpost"){
$pid=$_GET["pid"];
echo $fsize1;
echo "<b>Brisanje Postova</b><br/>";
echo $divide;
echo $fsize2;
echo $fsize1;
$teman = mysql_fetch_array(mysql_query("SELECT fid, tid FROM posts WHERE id='".$pid."'"));
if($teman[0]>0){
$kateg = mysql_fetch_array(mysql_query("SELECT permision FROM forums WHERE id='".$teman[0]."'"));
if($kateg[0]<=$row["level"] && $row["level"]>3){
///////////////////////////////////////////
$gde="*#*#*#*Brise Post";
include("gde.php");
///////////////////////////////////////////
$dede = mysql_query("DELETE FROM posts WHERE id='".$pid."'");
if($dede){
echo "Post je uspesno obrisan!<br/>";
}else{
echo "Greska na bazi!<br/>";
}
}else{
echo "Nemate pravo pristupa!<br/>";
}
}else{
echo "Nepostojeci post!<br/>";
}
echo $fsize2;
}else if($action=="deltop"){
$tid=$_GET["tid"];
echo $fsize1;
echo "<b>Brisanje Tema</b><br/>";
echo $divide;
echo $fsize2;
echo $fsize1;
$teman = mysql_fetch_array(mysql_query("SELECT fid FROM topics WHERE id='".$tid."'"));
if($teman[0]>0){
$kateg = mysql_fetch_array(mysql_query("SELECT permision FROM forums WHERE id='".$teman[0]."'"));
if($kateg[0]<=$row["level"] && $row["level"]>5){
///////////////////////////////////////////
$gde="*#*#*#*Brise Temu";
include("gde.php");
///////////////////////////////////////////
$dede = mysql_query("DELETE FROM topics WHERE id='".$tid."'");
if($dede){
$dede1 = mysql_query("DELETE FROM posts WHERE tid='".$tid."'");
echo "Tema je uspesno obrisana!<br/>";
}else{
echo "Greska na bazi!<br/>";
}
}else{
echo "Nemate pravo pristupa!<br/>";
}
}else{
echo "Nepostojeca tema!<br/>";
}
echo $fsize2;
}else if($action=="admincp"){
echo $fsize1;
echo "<b>Admin CP</b><br/>";
echo $divide;
echo $fsize2;
if($row["level"]>10){
///////////////////////////////////////////
$gde="Admin CP";
include("gde.php");
///////////////////////////////////////////
if($mod=="newforum"){
	if ($ver=="wml"){
	echo $fsize1;
	echo "Naziv Foruma:<br/>";
	echo $fsize2;
	echo "<input name=\"naziv\" maxlength=\"100\"/><br/>";
	echo $fsize1;
	echo "Dopustanje Foruma(0-8):<br/>";
	echo $fsize2;
	echo "<input name=\"dopustanje\" maxlength=\"10\"/><br/>";
	echo $fsize1;
	echo "Pozicija Foruma(1-50):<br/>";
	echo $fsize2;
	echo "<input name=\"pozicija\" maxlength=\"10\"/><br/>";
	echo $fsize1;
	echo "Kategorija Foruma:<br/>";
	echo $fsize2;
	echo "<select name=\"kate\">";
	$selsel = mysql_query("SELECT id, naziv FROM category ORDER BY pozicija ASC, id DESC");
    while ($item = mysql_fetch_array($selsel)){
	$naza=htmlspecialchars("$item[1]");
	echo "<option value=\"$item[0]\">$naza</option>\n";
	}
	echo "</select><br/>";
	echo $fsize1;
	echo "<anchor>Dodaj<go href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=newforum1\" method=\"post\">";
	echo "<postfield name=\"naziv\" value=\"$(naziv)\"/>";
	echo "<postfield name=\"dopustanje\" value=\"$(dopustanje)\"/>";
	echo "<postfield name=\"pozicija\" value=\"$(pozicija)\"/>";
	echo "<postfield name=\"kate\" value=\"$(kate)\"/>";
	echo "</go></anchor><br/>";
	echo $fsize2;
	}else{
	echo "<form method=\"post\" action=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=newforum1\" name=\"auth\">\n";
	echo $fsize1;
	echo "Naziv Foruma:<br/>";
	echo $fsize2;
	echo "<input name=\"naziv\" maxlength=\"100\"/><br/>";
	echo $fsize1;
	echo "Dopustanje Foruma(0-8):<br/>";
	echo $fsize2;
	echo "<input name=\"dopustanje\" maxlength=\"10\"/><br/>";
	echo $fsize1;
	echo "Pozicija Foruma(1-50):<br/>";
	echo $fsize2;
	echo "<input name=\"pozicija\" maxlength=\"10\"/><br/>";
	echo $fsize1;
	echo "Kategorija Foruma:<br/>";
	echo $fsize2;
	echo "<select name=\"kate\">";
	$selsel = mysql_query("SELECT id, naziv FROM category ORDER BY pozicija ASC, id DESC");
    while ($item = mysql_fetch_array($selsel)){
	$naza=htmlspecialchars("$item[1]");
	echo "<option value=\"$item[0]\">$naza</option>\n";
	}
	echo "</select><br/>";
	echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"/></form><br/>";
	}
}else if($mod=="newcat"){
	if ($ver=="wml"){
	echo $fsize1;
	echo "Naziv Kategorije:<br/>";
	echo $fsize2;
	echo "<input name=\"naziv\" maxlength=\"100\"/><br/>";
	echo $fsize1;
	echo "Pozicija Kategorije:<br/>";
	echo $fsize2;
	echo "<input name=\"pozicija\" maxlength=\"10\"/><br/>";
	echo $fsize1;
	echo "<anchor>Dodaj<go href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=newcat1\" method=\"post\">";
	echo "<postfield name=\"naziv\" value=\"$(naziv)\"/>";
	echo "<postfield name=\"pozicija\" value=\"$(pozicija)\"/>";
	echo "</go></anchor><br/>";
	echo $fsize2;
	}else{
	echo "<form method=\"post\" action=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=newcat1\" name=\"auth\">\n";
	echo $fsize1;
	echo "Naziv Kategorije:<br/>";
	echo $fsize2;
	echo "<input name=\"naziv\" maxlength=\"100\"/><br/>";
	echo $fsize1;
	echo "Pozicija Kategorije:<br/>";
	echo $fsize2;
	echo "<input name=\"pozicija\" maxlength=\"10\"/><br/>";
	echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"/></form><br/>";
	}
}else if($mod=="delforum"){
echo $fsize1;
$sql = "SELECT id, name, position, permision FROM forums WHERE permision<='".$row["level"]."' ORDER BY position ASC, id DESC";
	$items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
	$naslovna=htmlspecialchars("$item[1]");
	//$teme = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM topics WHERE fid='".$item[0]."'"));
	//$postovi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE fid='".$item[0]."'"));
	echo "$naslovna ";
	echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=delforum1&amp;cid=$item[0]\">[X]</a>";
	echo "<br/>";
    }
    }
echo $fsize2;
}else if($mod=="delforum1"){
echo $fsize1;
$cid=$_GET["cid"];
$postoji = mysql_fetch_array(mysql_query("SELECT id, permision FROM forums WHERE id='".$cid."'"));
if($postoji[0]>0){
if($postoji[1]<=$row["level"]){
$deldeldel = mysql_query("DELETE FROM forums WHERE id='".$cid."'");
if($deldeldel){
$deldeldel1 = mysql_query("DELETE FROM topics WHERE fid='".$cid."'");
$deldeldel2 = mysql_query("DELETE FROM posts WHERE fid='".$cid."'");
echo "Forum je uspesno obrisan!<br/>";
}else{
echo "Greska na bazi!<br/>";
}
}else{
echo "Nemate pravo pristupa!<br/>";
}
}else{
echo "Nepostojeci forum!<br/>";
}
echo $fsize2;
}else if($mod=="delcat"){
echo $fsize1;
$sql = "SELECT id, naziv FROM category ORDER BY pozicija ASC, id DESC";
	$items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
	$naslovna=htmlspecialchars("$item[1]");
	echo "$naslovna ";
	echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=delcat1&amp;cid=$item[0]\">[X]</a>";
	echo "<br/>";
    }
    }
echo $fsize2;
}else if($mod=="delcat1"){
echo $fsize1;
$cid=$_GET["cid"];
$postoji = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM category WHERE id='".$cid."'"));
if($row["level"]>10){
if($postoji[0]>0){
$deldeldel = mysql_query("DELETE FROM category WHERE id='".$cid."'");
if($deldeldel){
$selsel = mysql_query("SELECT id FROM forums WHERE category='".$cid."'");
while ($item = mysql_fetch_array($selsel)){
$deldeldel1 = mysql_query("DELETE FROM topics WHERE fid='".$item[0]."'");
$deldeldel2 = mysql_query("DELETE FROM posts WHERE fid='".$item[0]."'");
$deldeldel3 = mysql_query("DELETE FROM forums WHERE category='".$item[0]."'");
}
echo "Kategorija je uspesno obrisana!<br/>";
}else{
echo "Greska na bazi!<br/>";
}
}else{
echo "Nepostojeca Kategorija!<br/>";
}
}else{
echo "Nemate pravo pristupa!<br/>";
}
echo $fsize2;
}else if($mod=="editforum"){
echo $fsize1;
$sql = "SELECT id, name, position, permision FROM forums WHERE permision<='".$row["level"]."' ORDER BY position ASC, id DESC";
	$items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
	$naslovna=htmlspecialchars("$item[1]");
	//$teme = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM topics WHERE fid='".$item[0]."'"));
	//$postovi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE fid='".$item[0]."'"));
	echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=editforum1&amp;cid=$item[0]\">$naslovna</a>";
	echo "<br/>";
    }
    }
echo $fsize2;
}else if($mod=="editforum1"){
$cid=$_GET["cid"];
	$editni = mysql_fetch_array(mysql_query("SELECT id, name, position, permision, category FROM forums WHERE id='".$cid."'"));
	if($editni[0]>0){
	if($editni[3]<=$row["level"]){
	$naza=htmlspecialchars("$editni[1]");
	if ($ver=="wml"){
	echo $fsize1;
	echo "Naziv Foruma:<br/>";
	echo $fsize2;
	echo "<input name=\"naziv\" maxlength=\"100\" value=\"$naza\"/><br/>";
	echo $fsize1;
	echo "Dopustanje Foruma(0-8):<br/>";
	echo $fsize2;
	echo "<input name=\"dopustanje\" maxlength=\"10\" value=\"$editni[3]\"/><br/>";
	echo $fsize1;
	echo "Pozicija Foruma(1-50):<br/>";
	echo $fsize2;
	echo "<input name=\"pozicija\" maxlength=\"10\" value=\"$editni[2]\"/><br/>";
	echo $fsize1;
	echo "Kategorija Foruma:<br/>";
	echo $fsize2;
	echo "<select name=\"kate\">";
	$selsel = mysql_query("SELECT id, naziv FROM category ORDER BY pozicija ASC, id DESC");
    while ($item = mysql_fetch_array($selsel)){
	$naza=htmlspecialchars("$item[1]");
	echo "<option value=\"$item[0]\">$naza</option>\n";
	}
	echo "</select><br/>";
	echo $fsize1;
	echo "<anchor>Izmeni<go href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;cid=$cid&amp;mod=editforum2\" method=\"post\">";
	echo "<postfield name=\"naziv\" value=\"$(naziv)\"/>";
	echo "<postfield name=\"dopustanje\" value=\"$(dopustanje)\"/>";
	echo "<postfield name=\"pozicija\" value=\"$(pozicija)\"/>";
	echo "<postfield name=\"kate\" value=\"$(kate)\"/>";
	echo "</go></anchor><br/>";
	echo $fsize2;
	}else{
	echo "<form method=\"post\" action=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;cid=$cid&amp;mod=editforum2\" name=\"auth\">\n";
	echo $fsize1;
	echo "Naziv Foruma:<br/>";
	echo $fsize2;
	echo "<input name=\"naziv\" maxlength=\"100\" value=\"$naza\"/><br/>";
	echo $fsize1;
	echo "Dopustanje Foruma(0-8):<br/>";
	echo $fsize2;
	echo "<input name=\"dopustanje\" maxlength=\"10\" value=\"$editni[3]\"/><br/>";
	echo $fsize1;
	echo "Pozicija Foruma(1-50):<br/>";
	echo $fsize2;
	echo "<input name=\"pozicija\" maxlength=\"10\" value=\"$editni[2]\"/><br/>";
	echo $fsize1;
	echo "Kategorija Foruma:<br/>";
	echo $fsize2;
	echo "<select name=\"kate\">";
	$selsel = mysql_query("SELECT id, naziv FROM category ORDER BY pozicija ASC, id DESC");
    while ($item = mysql_fetch_array($selsel)){
	$naza=htmlspecialchars("$item[1]");
	echo "<option value=\"$item[0]\">$naza</option>\n";
	}
	echo "</select><br/>";
	echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"/></form><br/>";
	}
	}else{
	echo $fsize1;
	echo "Nemate pravo pristupa!<br/>";
	echo $fsize2;
    }
	}else{
	echo $fsize1;
	echo "Nepostojeci forum!<br/>";
	echo $fsize2;
	}
}else if($mod=="editforum2"){
$cid=$_GET["cid"];
$naziv=$_POST["naziv"];
$dopustanje=$_POST["dopustanje"];
$kate=$_POST["kate"];
$pozicija=$_POST["pozicija"];
	$editni = mysql_fetch_array(mysql_query("SELECT id, name, position, permision FROM forums WHERE id='".$cid."'"));
	if($editni[0]>0){
	if($editni[3]<=$row["level"]){
	if($naziv!=""){
	if($dopustanje!="" && $dopustanje>=0 && $dopustanje<=$row["level"]){
	if($pozicija!="" && $pozicija>0 && $pozicija<50){
	$bbb=mysql_query("UPDATE forums SET name='".$naziv."', position='".$pozicija."', permision='".$dopustanje."', category='".$kate."' WHERE id='".$cid."'");
	if($bbb){
	echo $fsize1;
	echo "Forum je uspesno izmenjen!<br/>";
	echo $fsize2;
	}else{
	echo $fsize1;
	echo "Greska na bazi!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Pozicija nije ispravna!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Dopustanje mora biti u rasponu od 0-8!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Morate uneti Naziv Foruma!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Nemate pravo pristupa!<br/>";
	echo $fsize2;
    }
	}else{
	echo $fsize1;
	echo "Nepostojeci forum!<br/>";
	echo $fsize2;
	}
}else if($mod=="newforum1"){
$cid=$_GET["cid"];
$naziv=$_POST["naziv"];
$dopustanje=$_POST["dopustanje"];
$kate=$_POST["kate"];
$pozicija=$_POST["pozicija"];
	$editni = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM forums WHERE name='".$naziv."'"));
	$editni1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM forums"));
	if($editni1[0]<200){
	if($editni[0]==0){
	if($naziv!=""){
	if($dopustanje!="" && $dopustanje>=0 && $dopustanje<=$row["level"]){
	if($pozicija!="" && $pozicija>0 && $pozicija<50){
	$bbb=mysql_query("INSERT INTO forums SET name='".$naziv."', position='".$pozicija."', permision='".$dopustanje."', category='".$kate."'");
	if($bbb){
	echo $fsize1;
	echo "Forum je uspesno dodat!<br/>";
	echo $fsize2;
	}else{
	echo $fsize1;
	echo "Greska na bazi!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Pozicija nije ispravna!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Dopustanje mora biti u rasponu od 0-8!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Morate uneti Naziv Foruma!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Forum sa ovakvim nazivom vec postoji!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Mozete dodati maximalno 20 foruma!<br/>";
	echo $fsize2;
	}
}else if($mod=="newcat1"){
$cid=$_GET["cid"];
$naziv=$_POST["naziv"];
$pozicija=$_POST["pozicija"];
	$editni = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM category WHERE naziv='".$naziv."'"));
	$editni1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM category"));
	if($editni1[0]<20){
	if($editni[0]==0){
	if($naziv!=""){
	if($pozicija!="" && $pozicija>0 && $pozicija<50){
	$bbb=mysql_query("INSERT INTO category SET naziv='".$naziv."', pozicija='".$pozicija."'");
	if($bbb){
	echo $fsize1;
	echo "Kategorija je uspesno dodata!<br/>";
	echo $fsize2;
	}else{
	echo $fsize1;
	echo "Greska na bazi!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Pozicija nije ispravna!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Morate uneti Naziv Kategorije!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Kategorija sa ovakvim nazivom vec postoji!<br/>";
	echo $fsize2;
	}
	}else{
	echo $fsize1;
	echo "Mozete dodati maximalno 20 kategorija!<br/>";
	echo $fsize2;
	}
}else{
echo $fsize1;
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=newforum\">Dodaj Forum</a><br/>";
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=delforum\">Obrisi Forum</a><br/>";
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=editforum\">Izmeni Forum</a><br/>";
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=newcat\">Dodaj Kategoriju</a><br/>";
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp&amp;mod=delcat\">Obrisi Kategoriju</a><br/>";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Nemate pravo pristupa!<br/>";
echo $fsize2;
}
}else if($action=="category"){
$cid=$_GET["cid"];
$catfor = mysql_fetch_array(mysql_query("SELECT id, naziv FROM category WHERE id='".$cid."'"));
if($catfor[0]>0){
$kekeke=htmlspecialchars("$catfor[1]");
///////////////////////////////////////////
$gde="*#*#*#*$kekeke";
include("gde.php");
///////////////////////////////////////////
echo $fsize1;
echo "<b>$kekeke</b><br/>";
echo $divide;
echo $fsize2;
echo $fsize1;
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM forums WHERE permision<='".$row["level"]."' AND category='".$cid."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, name, position, permision FROM forums WHERE permision<='".$row["level"]."' AND category='".$cid."' ORDER BY position ASC, id DESC LIMIT $limit_start, $items_per_page";
	$items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
	/////////////////////////////////////////////////////////////////////////
$pos1 = mysql_fetch_array(mysql_query("SELECT id, uid, name FROM topics WHERE fid='".$item[0]."' ORDER BY last DESC LIMIT 0,1"));
$pos2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE tid='".$pos1[0]."'"));
if($pos2[0]>0){
$pos3 = mysql_fetch_array(mysql_query("SELECT uid FROM posts WHERE tid='".$pos1[0]."' AND fid='".$item[0]."' ORDER BY id DESC LIMIT 0,1"));
$pos4 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$pos3[0]."'"));
$kojije=$pos3[0];
}else{
$pos4 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$pos1[1]."'"));
$kojije=$pos1[1];
}
$items_per_page= 10;
$num_pages = ceil($pos2[0]/$items_per_page);
$imeime=htmlspecialchars("$pos1[2]");
/////////////////////////////////////////////////////////////
	$naslovna=htmlspecialchars("$item[1]");
	$teme = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM topics WHERE fid='".$item[0]."'"));
	$postovi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE fid='".$item[0]."'"));
	echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=cat&amp;cid=$item[0]\"><b>$naslovna</b>($teme[0]/$postovi[0])</a>";
	echo "<br/><a href=\"forum.php?$ses&amp;ref=$ref&amp;action=topic&amp;tid=$pos1[0]&amp;page=$num_pages\">$imeime</a>";

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$pos4[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$pos4[0] = EdykaColor($pos4[0],$zs1["color"],$zs1["specolor"]);


	echo ", od <a href=\"info.php?$ses&amp;ref=$ref&amp;nk=$kojije\">$pos4[0]</a><br/>";
	echo "<br/>";
    }
    }else{
	echo "Kategorija je prazna!<br/>";
	}

echo $fsize2;
}else{
echo $fsize1;
echo "Pogresna Kategorija Foruma!<br/>";
echo $fsize2;
}
}else{
///////////////////////////////////////////
$gde="*#*#*#*Lista Foruma";
include("gde.php");
///////////////////////////////////////////
$setting = @mysql_query ("Select * from setting where klu4='1'");
$set = mysql_fetch_array ($setting);
$raz=$set["razglas"];
$raz1=$set["razglas1"];
if($raz==1){
echo $fsize1;
include("razglas1.php");
echo $fsize2;
include("razglas2.php");
}


echo $divide;
$r = mysql_query ("select count(readd) as num from zapiski WHERE (idtowhom = '".$id."')and(readd = '0')and(ininc = '1');");
$a = mysql_fetch_array($r);
$inb = $a["num"];
$cmc = mysql_query ("select count(id) as num from obavestenja");
$cmac = mysql_fetch_array($cmc);
$cmtot = $cmac["num"];
if($inb != "0") {echo "<img src=\"smile/new1.gif\" alt=\"icon\"/><b>imate novo pisamce <a href=\"inbox.php?$ses&amp;ref=$ref\">(".$inb.")</a></b><br/>\n";
}


echo $fsize1;
echo "<br/><b>Lista Foruma</b><br/>";

echo $divide;
echo $fsize2;
echo $fsize1;
	if($page=="" || $page<=0)$page=1;
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM category"));
    $num_items = $noi[0]; //changable
    $items_per_page= 20;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, naziv, pozicija FROM category ORDER BY pozicija ASC, id DESC LIMIT $limit_start, $items_per_page";
	$items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
	$fora = mysql_fetch_array(mysql_query("SELECT id FROM forums WHERE category='".$item[0]."'"));
	$naslovna=htmlspecialchars("$item[1]");
	echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=category&amp;cid=$item[0]\"><b>$naslovna</b></a>";
	echo "<br/>";
    }
    }
	$temet = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM topics"));
	$postovit = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts"));
	echo "<br/>Ukupno Tema: <b>$temet[0]</b><br/>";
	echo "Ukupno Postova: <b>$postovit[0]</b><br/>";
	if($row["level"]>10){
	echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=admincp\">Admin CP</a><br/>";
	}
echo $fsize2;
}
echo $fsize1;
echo $divide;
if($action=="cat"){
$kategorija = mysql_fetch_array(mysql_query("SELECT category FROM forums WHERE id='".$cid."'"));
$kategorija1 = mysql_fetch_array(mysql_query("SELECT naziv FROM category WHERE id='".$kategorija[0]."'"));
$kateg=htmlspecialchars("$kategorija1[0]");
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=category&amp;cid=$kategorija[0]\">$kateg</a><br/>";
}else if($action=="topic"){
//$kategorija2 = mysql_fetch_array(mysql_query("SELECT category FROM forums WHERE id='".$kategorija[4]."'"));
$kategorija3 = mysql_fetch_array(mysql_query("SELECT naziv FROM category WHERE id='".$kategorija[4]."'"));
$kateg=htmlspecialchars("$kategorija3[0]");
echo "$kategorija2[0]";
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=category&amp;cid=$kategorija[4]\">$kateg</a><br/>";
}
if($action!="")echo "<a href=\"forum.php?$ses&amp;ref=$ref\">Lista Foruma</a><br/>";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>