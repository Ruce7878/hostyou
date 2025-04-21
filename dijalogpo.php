<?
include("gz.php");

header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");
require("inc.php"); 
$link = connect_db();

list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

///////////////////////////////////////////
$gde="Poslata Pisma";
include("gde.php");
///////////////////////////////////////////
if(!isset($err)) $err="";
if(!isset($go)){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"enter\" title=\"Dijalog\">";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"../".$row["css"]."\">";
echo "<title>Dijalog</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
$me = $id;
if($me=="$id"){
echo $fsize1;
$nk=$_GET["nk"];
$kojeje = mysql_fetch_array(mysql_query("SELECT user,id FROM users WHERE id='".$nk."'"));
$dijalog = mysql_fetch_array(mysql_query("SELECT user,id FROM users WHERE id='".$id."'"));
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$kojeje[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$kojeje[0] = EdykaColor($kojeje[0],$zs1["color"],$zs1["specolor"]);
$pols2 = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$dijalog[0]."'");
$zs1 = @mysql_fetch_array ($pols2);
$dijalog[0] = EdykaColor($dijalog[0],$zs1["color"],$zs1["specolor"]);
echo "<b>Poslata pisma za $kojeje[0]</b><br/>";
echo $divide;
echo $fsize2;
//$brojcano = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM zapiski WHERE (idwho='".$dijalog[1]."' AND idtowhom='".$kojeje[1]."') OR (idwho='".$kojeje[1]."' AND idtowhom='".$dijalog[1]."')"));
$brojcano = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM zapiski WHERE (idwho='".$dijalog[1]."' AND idtowhom='".$kojeje[1]."')"));
$start=(($page-1)*5);
if($brojcano[0]<=5){$page=1;}
if($start>$brojcano[0]){$start=$brojcano[0]-1;}
$vreme=time();
$stranice=$brojcano[0]/5;
//$q = mysql_query("SELECT * FROM zapiski WHERE (idwho='".$dijalog[1]."' AND idtowhom='".$kojeje[1]."') OR (idwho='".$kojeje[1]."' AND idtowhom='".$dijalog[1]."') ORDER BY time DESC LIMIT $start, 5");
$q = mysql_query("SELECT * FROM zapiski WHERE (idwho='".$dijalog[1]."' AND idtowhom='".$kojeje[1]."') ORDER BY time DESC LIMIT $start, 5");
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
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$kojeje2[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$kojeje2[0] = EdykaColor($kojeje2[0],$zs1["color"],$zs1["specolor"]);
echo "Za <b>$kojeje2[0]</b>,\n";
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$kojeje1[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$kojeje1[0] = EdykaColor($kojeje1[0],$zs1["color"],$zs1["specolor"]);
echo "od <b>$kojeje1[0]</b><br/>\n";
//echo "Tema: $topic<br/>\n";
echo "Datum: $date<br/>\n";
echo "Poruka: $message<br/>\n";
echo $divide;
}
if($page>1){
$ppage = $page-1;
echo "<a href=\"dijalogpo.php?$ses&amp;page=$ppage$takep&amp;nk=$nk\">&#171;Nazad</a> ";
}
if($page<$stranice){
$npage = $page+1;
echo "<a href=\"dijalogpo.php?$ses&amp;page=$npage$takep&amp;nk=$nk\">Napred&#187;</a>";
}
echo "<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete citati tudja pisma!<br/>";
echo $fsize2;
}
echo $fsize1;
echo $divide;
echo "<a href=\"inbox.php?s=$s&amp;$ses&amp;ref=$ref\">Inbox</a><br/>\n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
mysql_close ($link);
exit;
}
?>