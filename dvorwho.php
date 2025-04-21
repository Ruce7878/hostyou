<?

##################################################################################################
##	                Script name  :  WapChat "Region-56"                                         ##
##	                    Version  :  3.2 (23.01.2007)                                            ##
##                      Made by  :  ??????                                                      ##
##	                     E-mail  :  seaquest@mail.ru	                                        ##
##                          ICQ  :  299-411-279                                                 ##
##                         Site  :  http://wap.region-56.ru                                     ##
## ?? ???????? ???????????? ??????? ??? ?????????? ??? ???? ??????????? ?? ????????????? ??????.##
## ??????????????? ??????? ??????? ?????? ?????????. ?????? ??????? ??????? ?? ????????? ?????. ##                                     	
##################################################################################################
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
///////////////////////////////////////////
$gde="Online Lista";
include("gde.php");
///////////////////////////////////////////
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>";
echo "<card id=\"who\" title=\"Online Lista\">";
echo "<p align=\"left\">";
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
echo "<title>Online Lista</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">";
}
echo $fsize1;
echo "<a href=\"pos.php?$ses&amp;ref=$ref\">Dvorana Tajni</a><br/>";
echo $divide;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$roomselect = @mysql_query("SELECT name, rm FROM rooms WHERE rm!='23' AND tip='1' ORDER BY pozicija, rm");
while($rooms = @mysql_fetch_array($roomselect)) {
$roomname=$rooms["name"];
$rms=$rooms["rm"];
$room="room".$rms;
$tm = time()-600;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sobe = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime>'".$tm."' AND gde='".$room."'"));
if ($rms==11){
	echo "[<b><a href=\"klaznet.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname ($sobe[0])</a></b>]<br/>";
}else if ($rms==10){
	if ($row["level"]==8){
	echo "[<b><a href=\"intim.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname ($sobe[0])</a></b>]<br/>";
	}
}else if ($rms==7){
	if ($row["level"]>6){
	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref&amp;modlog=1\">$roomname ($sobe[0])</a></b>]<br/>";
	}
}else if ($rms==9){
	if ($row["level"]>2){
	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname ($sobe[0])</a></b>]<br/>";
	}
}else if ($rms==8){
	if ($row["level"]>3){
	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref&amp;modlog=1\">$roomname ($sobe[0])</a></b>]<br/>";
	}
}else{
	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname ($sobe[0])</a></b>]<br/>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$clanovi = mysql_query("SELECT id, user, inv, level, gde, gdetime FROM users WHERE gdetime>'".$tm."' AND gde='".$room."'");
if ($rms!=10 && $rms!=7 && $rms!=8 && $rms!=9){
for ($k = 0; $k < $sobe[0]; $k++){
$lines = mysql_fetch_array ($clanovi);
if ($lines[2] != 1) echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
else if ($row["level"]==8) echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1](i)</a>";
if (($k+1) != $sobe[0]) print ', ';
}
if($sobe[0]>0)echo "<br/><br/>";
unset($lines);
}else if($rms==10){
if ($row["level"]==8){
for ($k = 0; $k < $sobe[0]; $k++){
$lines = mysql_fetch_array ($clanovi);
if ($lines[2] != 1)echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
else echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
if (($k+1) != $sobe[0]) print ', ';
}
if($sobe[0]>0)echo "<br/><br/>";
unset($lines);
}
}else if($rms==7){
if ($row["level"]>6){
for ($k = 0; $k < $sobe[0]; $k++){
$lines = mysql_fetch_array ($clanovi);
if ($lines[2] != 1)echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
else echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
if (($k+1) != $sobe[0]) print ', ';
}
if($sobe[0]>0)echo "<br/><br/>";
unset($lines);
}
}else if($rms==9){
if ($row["level"]>2){
for ($k = 0; $k < $sobe[0]; $k++){
$lines = mysql_fetch_array ($clanovi);
if ($lines[2] != 1)echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
else echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
if (($k+1) != $sobe[0]) print ', ';
}
if($sobe[0]>0)echo "<br/><br/>";
unset($lines);
}
}else if($rms==8){
if ($row["level"]>3){
for ($k = 0; $k < $sobe[0]; $k++){
$lines = mysql_fetch_array ($clanovi);
if ($lines[2] != 1)echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
else echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
if (($k+1) != $sobe[0]) print ', ';
}
if($sobe[0]>0)echo "<br/><br/>";
unset($lines);
}
}
$ukup=$ukup+$sobe[0];
}
echo $divide;
$roomselect23 = @mysql_query("SELECT name, rm FROM rooms WHERE rm='23' ORDER BY pozicija ASC, rm ASC");
while($rooms23 = @mysql_fetch_array($roomselect23)) {
$roomname23=$rooms23["name"];
$rms23=$rooms23["rm"];
$room23="room".$rms23;
$tm23 = time()-600;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sobe23 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime>'".$tm23."' AND gde='".$room23."'"));
echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms23&amp;ref=$ref\">$roomname23 ($sobe23[0])</a></b>]<br/>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$clanovi23 = mysql_query("SELECT id, user, inv, level, gde, gdetime FROM users WHERE gdetime>'".$tm23."' AND gde='".$room23."'");
for ($k = 0; $k < $sobe23[0]; $k++){
$lines23 = mysql_fetch_array ($clanovi23);
if ($lines23[2] != 1) echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines23[0]&amp;ref=$ref\">$lines23[1]</a>";
else if ($row["level"]==8) echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines23[0]&amp;ref=$ref\">$lines23[1](i)</a>";
if (($k+1) != $sobe23[0]) print ', ';
}
if($sobe23[0]>0)echo "<br/><br/>";
unset($lines23);
}
echo $divide;
///////////////////////////////////////////////////////////////
echo "<b>Ukupno: $ukup</b><br/>";
echo $divide;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>