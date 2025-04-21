<?

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
if (isset($rm)) $takep2="&amp;rm=$rm&amp;ref=$ref";
else $takep2="&amp;ref=$ref";

if($rm==10) $takep="&amp;pwd=$pwd&amp;ref=$ref";
else if($mod=="privat") $takep="&amp;mod=$mod&amp;ref=$ref";
else $takep="&amp;ref=$ref";
///////////////////////////////////////////
$gde="Inbox";
include("gde.php");
///////////////////////////////////////////
$posts = mysql_fetch_array(mysql_query("SELECT id, posts FROM `users` WHERE id='".$id."'"));
if($posts[1]<'100'){
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

echo "Dok ne sakupite 100 postova mozete pristupiti samo u ";
echo "<a href=\"chat.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;rm=9\"> <b><u>WeLcOmE SoBiCa!!!</u></b></a>";
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
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"chatmail\" title=\"Inbox\">\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Inbox</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<img src=\"images/inbox.jpg\" alt=\"Inbox\"/><br/>\n";
echo "Procitana pisma se automatski brisu posle 5 dana!<br/>";
/////////////////////////////////////////////////////
$tren=time();
$tren1=$tren-(60*60*24*5);
$brisi=mysql_query("DELETE FROM zapiski WHERE time<'".$tren1."' AND readd='1'");
/////////////////////////////////////////////////////
$tren3=$tren-(60*60*24*3);
$brisifoto = mysql_query("DELETE FROM zapiski WHERE time<'".$tren3."' AND readd='1' AND `message` LIKE CONVERT(_utf8 '%fotopp1.php%' USING latin1)");
$brisifoto1 = mysql_query("DELETE FROM zapiski WHERE time<'".$tren1."' AND readd='0' AND `message` LIKE CONVERT(_utf8 '%fotopp1.php%' USING latin1)");
/////////////////////////////////////////////////////
$foton = mysql_fetch_array(mysql_query("SELECT time FROM zapiski WHERE `message` LIKE CONVERT(_utf8 '%fotopp1.php%' USING latin1) ORDER BY time ASC LIMIT 0,1"));
$sql = "SELECT file FROM fotopp WHERE time<'".$foton[0]."'";
$smilies = mysql_query($sql);
while($smilie=mysql_fetch_array($smilies))
{
$slik="fotopp/$smilie[0]";
unlink($slik);
$brisi1=mysql_query("DELETE FROM fotopp WHERE time<'".$foton[0]."'");
}
/////////////////////////////////////////////////////
echo $divide;
echo $fsize2;
$r = mysql_query ("select count(readd) as num from zapiski WHERE (idtowhom = '".$id."')and(readd = '0')and(ininc = '1')");
$a = mysql_fetch_array($r);
$inb = $a["num"];
$r = mysql_query ("select count(readd) as num from zapiski WHERE (idwho = '".$id."')and(readd = '0')and(insend = '1')");
$a = mysql_fetch_array($r);
$out = $a["num"];
echo $fsize1;
echo "<a href=\"inbox.php?$ses$takep2\">Nova Pisma(".$inb.")</a><br/>\n";
echo "<a href=\"outbox.php?$ses$takep2\">Poslata Pisma(".$out.")</a><br/>\n";
$who="";
echo "<a href=\"send.php?$ses&amp;towhom=$who$takep2\">Napisati Pismo</a><br/>\n";
echo "<a href=\"fotopp.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;mess=new\">Foto Pismo</a><br/><br/>\n";
$rr = mysql_fetch_array(mysql_query("select user from users WHERE id='11'"));
echo "<a href=\"send.php?$ses&amp;to=$rr[0]&amp;ref=$ref&amp;hit=1\">Pismo Adminu</a><br/>\n";
echo "<a href=\"friends.php?$ses&amp;action=pp2all&amp;ref=$ref\">PP2FRIENDS</a><br/>";
echo $divide;
echo "<a href=\"friends.php?$ses$takep2\">Lista Prijatelja</a><br/>\n";
echo $divide;
//echo "<a href=\"delmsg.php?$ses&amp;go=all&amp;mod=delall&amp;$takep2\">Obrisi sva pisma</a><br/>\n";
//echo $divide;
if (isset($rm)) echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\">Chat Soba</a><br/>";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
mysql_close ($link);
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>