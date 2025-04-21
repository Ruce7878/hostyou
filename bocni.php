<?php  
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php"); 
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

///////////////////////////////////////////
$gde="Bockanje";
include("gde.php");
////////////////////////////////////////////
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
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"enter\" title=\"Bockanje\">";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Bockanje</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
$uid = $row['id'];
$action = $_GET["action"];
$who = $_GET["who"];

function getnick_uid($uid) {
  $not = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$uid."'"));
  return $not[0];
}

if($action=="send"){
$who=$_GET["who"];
$msg=$_POST["msg"];
echo $fsize1;
$whonick = getnick_uid($who);
$byuid = $row['id'];
$tm = time();
$res = mysql_query("INSERT INTO bockanje SET byuid='".$byuid."', touid='".$who."', timesent='".$tm."'");
if($res)
{
$bockanje=mysql_fetch_array(mysql_query("SELECT * FROM bockanje WHERE touid='".$uid."' AND unread='1' ORDER BY id LIMIT 0,1"));
mysql_query("UPDATE bockanje SET unread='0' WHERE id='".$bockanje[0]."'");
echo "Uspesno ste bocnuli $whonick!<br/><br/>";
}else{
echo "Ne mozete bocnuti $whonick<br/><br/>";
}
echo $fsize2;
}else if($action=="ukloni"){    
$nik=$_GET["who"];
echo $fsize1;
$bockanje=mysql_fetch_array(mysql_query("SELECT * FROM bockanje WHERE touid='".$uid."' AND unread='1' ORDER BY id LIMIT 0,1"));
$res=mysql_query("UPDATE bockanje SET unread='0' WHERE id='".$bockanje[0]."'");
if($res){ 
echo"Uspesno obrisano!<br/><br/>"; 
}else{ 
echo"Greska"; 
}     
echo $fsize2;
}
if($action!="")
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
echo $fsize1;
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>