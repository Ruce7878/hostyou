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

if($row["level"] < 10) {
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
echo "Nemate prava pristupa!\n";
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
$gde="Admin CP";
include("gde.php");
///////////////////////////////////////////
$panelce1 = mysql_fetch_array(mysql_query("SELECT panel FROM setting"));
if($panelce1[0]==1){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
if(!isset($rm) || $rm==""){
if ($row["level"]>6)echo "<card id=\"Ok\" title=\"Brisi Korisnika\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"10\" />\n";
else echo "<card id=\"Ok\" title=\"Brisi Korisnika\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"10\" />\n";
}else{
echo "<card id=\"Ok\" title=\"Brisi Korisnika\" ontimer=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\"><timer value=\"10\" />\n";
}
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Brisi Korisnika</title>";
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
$select = mysql_query ("Select id,user,pass,name,birth,sex,city,mail,infa,icq,posts,credits,gposts,status,date,op,onl,safe,mob,user_ip,user_soft,img,nastroi,visit,room,byeotv,number,level,mysmile,votefoto,para,myavatar,version,gpluses,pwt1,inbox1,pwt2,inbox2,gde,gdetime,milioner,hostname,osx,valid,privat,anagrams,operamini,stitban,css,latuser, opera,vesala from users where id='".$nk."'");
echo $fsize1;
$inf = mysql_fetch_array ($select);
$usid=$inf["id"];
$nick = $inf["user"];
$pass = $inf["pass"];
$name = $inf["name"];
$birth = $inf["birth"];
$sex = $inf["sex"];
$city = $inf["city"];
$mail = $inf["mail"];
$site = $inf["site"];
$infa = $inf["infa"];
$icq = $inf["icq"];
$posts = $inf["posts"];
$credits = $inf["credits"];
$gposts = $inf["gposts"];
$status = $inf["status"];
$date = $inf["date"];
$op = $inf["op"];
$onl = $inf["gdetime"];
$mob = $inf["mob"];
$us_ip = $inf["user_ip"];
$us_soft = $inf["user_soft"];
$img = $inf["img"];
$nastroi = $inf["nastroi"];
$visit = $inf["visit"];
$room = $inf["room"];
$byeotv = $inf["byeotv"];
$number = $inf["number"];
$level=$inf["level"];
$latuser=$inf["latuser"];
$fr = $inf["friends"];
$mysmile = $inf["mysmile"];
$votefoto = $inf["votefoto"];
$ign=$inf["ignor"];
$para=$inf["para"];
$bee=$inf["site"];
$myavatar=$inf["myavatar"];
$version=$inf["version"];
$safe=$inf["safe"];
$bind4=$row['bind4'];
$gpluses=$inf['gpluses'];
$pwt1=$inf['pwt1'];
$inbox1=$inf['inbox1'];
$pwt2=$inf['pwt2'];
$inbox2=$inf['inbox2'];
$milioner=$inf['milioner'];
$gde1 = $inf["gde"];
$hostname = $inf["hostname"];
$osx = $inf["osx"];
$valid = $inf["valid"];
$privat = $inf["privat"];
$znak=$inf["znak"];
$anagrams = $inf['anagrams'];
$css = $inf["css"];
$operamini=$inf["operamini"];
$stitban=$inf["stitban"];
$vesala=$inf["vesala"];
$opera=$inf["opera"];
if (mysql_query ("Insert into obrisani set id ='".$nk."',user='".$nick."', pass='".$pass."', name='".$name."', sex='".$sex."', posts='".$posts."', birth='".$birth."', city='".$city."', mail='".$mail."', date='".$date."', infa='".$infa."', op='".$op."', mob='".$mob."', number='".$number."', avtootvet='".$avtootvet."', onl='".$onl."', safe='".$safe."', user_ip='".$us_ip."', user_soft='".$us_soft."', opera='".$opera."' , level='".$level."', gpluses='".$gpluses."', latuser='".$latuser."', valid='".$valid."', pwt1='".$pwt1."', inbox1='".$inbox1."', pwt2='".$pwt2."', inbox2='".$inbox2."'"));
{
echo "Profil Uspesno Sacuvan!<br/>";
}
$browsers = mysql_fetch_array(mysql_query ("SELECT user, level FROM users WHERE id='".$nk."'"));
if($browsers[1]<$row["level"] && $browsers[1]!="8" && $browsers[1]!="7"){
if(mysql_query ("Delete from users where id ='".$nk."'")&&
mysql_query ("Delete from friends where id ='".$nk."' OR usid='".$nk."'")&&
mysql_query ("Delete from ignor where usid ='".$nk."'")&&
mysql_query ("DELETE FROM zapiski WHERE idwho='".$nk."' OR idtowhom='".$nk."'"))
{
echo "$browsers[0] je obrisan!<br/>\n";
$adm = mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = mysql_fetch_array ($adm);
$administration = $z["user"];
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = time();
$room = "room".$rm;
$txt = "".$us." je obrisao <b>".$browsers[0]."</b>, zbog krsenja pravila!";
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$administration."', message='".$txt."', id='".$time."', towhom='', hid='0', usid='1', komu=''");
for ($num = 0; $num <= 22; $num++){
$soba = "room".$num;
mysql_query ("Delete from $soba WHERE usid = '".$nk."'");
}
$data = date("(H:i jF)");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao clana <b>$browsers[0]</b> zbog krsenja pravila!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
} else {
echo "Greska!!!<br/>\n";
}
} else {
$levelselect = mysql_query ("Select name from levels where level='".$browsers[1]."'");
$levels = mysql_fetch_array($levelselect);
$levname = $levels["name"];
echo "Ne mozete banovati <b>".$levname."</b>! <b>$nk</b> ima veci level od Vas!\n";
}
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush();
?>