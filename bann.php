<?
include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

$us=$row["user"];

if($row["level"] < 5) {
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\">\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Greska!!!</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Nemate pravo pristupa!\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
exit;
}

$panelce = mysql_fetch_array(mysql_query("SELECT panel FROM setting"));
if($panelce[0]==0){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"15\"/>";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Greska!!!</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=enter.php?$ses$takep\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<b>Nemate prava pristupa!!!Mislili ste ako nikog nema da mozete raditi sta hocete? E pa NEMOZE :).</b><br/>\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
exit;
}
///////////////////////////////////////////
$gde="Mod CP";
include("gde.php");
///////////////////////////////////////////
$panelce1 = mysql_fetch_array(mysql_query("SELECT panel FROM setting"));
if($panelce1[0]==1){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
if(!isset($rm) || $rm==""){
if ($row["level"]>5)echo "<card id=\"Ok\" title=\"Banovanje\" ontimer=\"apanel.php?$ses&amp;ref=$ref\"><timer value=\"20\" />\n";
else echo "<card id=\"Ok\" title=\"Banovanje\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"20\" />\n";
} else {
echo "<card id=\"Ok\" title=\"Banovanje\" ontimer=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\"><timer value=\"20\" />\n";
}
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Banovanje</title>";
if(!isset($rm) || $rm==""){
if ($row["level"]>6) echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=enter.php?$ses&amp;ref=$ref\">";
else echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=enter.php?$ses&amp;ref=$ref\">";
}else{
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">";
}
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
}
echo $fsize1;
$koji = mysql_fetch_array(mysql_query("SELECT user, level FROM users WHERE id='".$nk."' LIMIT 1"));
if($koji[1]<$row["level"]){
echo "<b>$koji[0]</b> je banovan!<br/>\n";
mysql_query ("UPDATE users SET banned = '1' WHERE id='".$nk."'");
$room="room".$rm;
mysql_query("delete from $room WHERE usid= '".$nk."'");
mysql_query ("DELETE FROM zapiski WHERE idwho='".$nk."' OR idtowhom='".$nk."'");
$adm = mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = mysql_fetch_array ($adm);
$administration = $z["user"];
$administration = check($administration);
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = time();
$txt = "".$us." je banovao <b>".$koji[0]."</b> zbog krsenja pravila!";
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$administration."', message='".$txt."', id='".$time."', towhom='', hid='0', usid='1', komu=''");
for ($num = 0; $num <= 22; $num++){
$soba = "room".$num;
mysql_query ("Delete from $soba WHERE usid = '".$nk."'");
}
$data = date("(H:i jF)");
$open=fopen("log/bannlist.dat","a+");
flock ($open,LOCK_EX);
fwrite($open,"#$koji[0]#room: $broom|$data|who: $us|$REMOTE_ADDR|$HTTP_USER_AGENT\n");
fflush($open);
flock ($open,LOCK_UN);
fclose($open);
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je banovao <b>$koji[0]</b> zbog krsenja pravila!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
} else {
$levelselect = mysql_query ("Select name from levels where level='".$koji[1]."'");
$levels = mysql_fetch_array($levelselect);
$levname = $levels["name"];
echo $fsize1;
echo "Ne mozete banovati <b>".$levname."</b>! <b>$koji[0]</b> ima veci level od Vas!\n";
echo $fsize2;
}
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
?>