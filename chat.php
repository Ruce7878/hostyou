
<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$pwd = isset($_POST['pwd']) && strlen($_POST['pwd']) ? htmlentities(trim($_POST['pwd'])) : '';
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
$ggggg=$row["gzip"];
if($ggggg=="1"){
include("gz.php");
}
$pwtread = mysql_fetch_array(mysql_query("SELECT pwtread FROM setting"));
if(isset($HTTP_GET_VARS['rm'])) {$rm = $HTTP_GET_VARS['rm'];}
if (!ctype_digit($rm)) { header("Location: index.php"); die; }
$rm = mysql_escape_string($rm);

mysql_query ("Select rm from rooms where rm='".$rm."';");
if (mysql_affected_rows() == 0){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"15\"/>";
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
echo "<title>Greska!!!</title>";
echo "<meta http-equiv=\"Refresh\" content=\"2; url=enter.php?$ses&amp;ref=$ref\"/>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Ova soba ne postoji!";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
exit;
}
$dopu = mysql_fetch_array(mysql_query("SELECT dopustanje, dopustanjet FROM users WHERE id='".$id."'"));
if($row["level"]>3&&$rm==8){$keykey=1;}
else if($row["level"]>6&&$rm==7){$keykey=1;}
else if($dopu[0]==1&&$row["level"]>3&&$rm==7){$keykey=1;}
else if($rm!=8 && $rm!=7){$keykey=1;}
else{$keykey=0;}

if ($keykey==0){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"error\" title=\"Upozorenje\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"15\"/>";
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
echo "<title>Upozorenje</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Nemate prava pristupa u ovu sobu!!!";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
exit;
}


if($id==2&&$rm==4){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"error\" title=\"Upozorenje\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"15\"/>";
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
echo "<title>Upozorenje</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Nemate prava pristupa u ovu sobu!!!";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
exit;
}


if($modlog==1){
if($rm==7){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je posetio Admin Sobu!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='4'");
/////////////////////////////////////////////////////////////////////
}else if($rm==8){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je posetio Mod Sobu!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='3'");
/////////////////////////////////////////////////////////////////////
}if($rm==10){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je posetio Intimnu Sobu! Sifra: <b>$pwd</b><br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='5'");
/////////////////////////////////////////////////////////////////////
}
}
///////////////////////////////////////////
$gde="room$rm";
include("gde.php");
///////////////////////////////////////////
if((time()<$row["kik"])||(time()<$row["kik"]&&$row["whokik"]=="[&#1057;&#1080;&#1089;&#1090;&#1077;&#1084;&#1072;]")){
$re = mysql_query("SELECT name FROM rooms where rm = '9'");
$inam = mysql_fetch_array ($re);
$nam = $inam["name"];
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
echo "<head>";
if($row["css"]!=""){
$csss=$row["css"];
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$csss\"/>";
}else{
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
}
echo "<title>Upozorenje</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
$tleft = $row["kik"] - time();
$whokik = $row["whokik"];
$whykik = $row["whykik"];
echo "<b>".$whokik."</b> kickovani ste sa chata!<br/>Kazna traje jos ".$tleft." (sec)!<br/>";
echo "Razlog: ".$whykik."<br/>";
//echo "Pristupite kasije <a href=\"chat.php?$ses&amp;rm=9&amp;rul=9&amp;ref=$ref\">".$nam."</a>";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
exit;
}
## &#1054;&#1095;&#1080;&#1089;&#1090;&#1082;&#1072; &#1082;&#1086;&#1084;&#1085;&#1072;&#1090; &#1089; &#1087;&#1088;&#1077;&#1076;&#1091;&#1087;&#1088;&#1077;&#1076;Z&#1076;&#1077;&#1085;&#1080;&#1077;&#1084; (&#1076;&#1083;&#1103; &#1084;&#1086;&#1076;&#1077;&#1088;&#1086;&#1074;)
if(file_exists("log/clear.dat")){
$f=fopen("log/clear.dat","r");
$clrdata=file("log/clear.dat");
fclose($f);
if ($clrdata[0]<time()){
unlink("log/clear.dat");
for ($num = 0; $num <=23; $num++){
$room = "room".$num;
$res = mysql_query ("Select id from $room order by id desc");
$kol = mysql_affected_rows();
$lines = mysql_fetch_array($res);
for ($k = 0; $k <= $kol; $k++){
$lines = @mysql_fetch_array ($res);
$kl = $lines["id"];
mysql_query ("Delete from $room where id = '".$kl."'");
}
}
}
}

## &#1040;&#1074;&#1090;&#1086;&#1086;&#1095;&#1080;&#1089;&#1090;&#1082;&#1072; &#1082;&#1086;&#1084;&#1085;&#1072;&#1090;
$r = mysql_query ("SELECT * FROM optim");
$a = mysql_fetch_array ($r);
if ($a["go"]<time()){
$i = time() + 10480000;
mysql_query ("Update optim set go='".$i."' WHERE klu4 = '1'");
$i = time() - 10480000;
for ($num = 0; $num <= 23; $num++){
$roptim = "room".$num;
mysql_query("delete from $roptim WHERE id<'".$i."'");
mysql_query("OPTIMIZE TABLE $roptim");
}
}

$room="room".$rm;
$us=$row["user"];
$max = $row["max"];
$smset = $row["smiles"];
$us_ip = $row["user_ip"];
$us_soft = $row["user_soft"];

if ($rm!=23){
$setting = @mysql_query ("Select * from setting where klu4=1");
$set = mysql_fetch_array ($setting);

require ("birthday.php");

$smthwr = 0;
$bmax = $max*2;
$pwd = (isset($_REQUEST['pwd']) && strlen($_REQUEST['pwd'])) ? htmlspecialchars(trim($_REQUEST['pwd'])) : '';
//$pwd=htmlspecialchars(stripslashes(trim($pwd)));
if (empty($pwd)) $pwd=pub;
//$pwd=htmlspecialchars(stripslashes(trim($pwd)));

if($row["level"]>9 && $pwtread[0]==1){
if ($rm == 10) $res = mysql_query ("Select klu4,time,who,message,messagewosm,messagewoasm,id,towhom,hid,usid,pwd,komu from room10 WHERE ((pwd = '".$pwd."')OR(pwd = '')) order by id desc LIMIT $bmax");
elseif($mod=="privat") $res = mysql_query ("Select klu4,time,who,message,messagewosm,messagewoasm,id,towhom,hid,usid,komu from $room order by id desc LIMIT $bmax");
else $res = mysql_query ("Select klu4,time,who,message,messagewosm,messagewoasm,id,towhom,hid,usid,komu from $room order by id desc LIMIT $bmax");
}else{
if ($rm == 10) $res = mysql_query ("Select klu4,time,who,message,messagewosm,messagewoasm,id,towhom,hid,usid,pwd,komu from room10 WHERE ((pwd = '".$pwd."')OR(pwd = '')) and ((usid = '".$id."')OR(towhom = '".$id."')OR(towhom = '')) order by id desc LIMIT $bmax");
elseif($mod=="privat") $res = mysql_query ("Select klu4,time,who,message,messagewosm,messagewoasm,id,towhom,hid,usid,komu from $room WHERE (usid = '".$id."')OR(towhom = '".$id."') order by id desc LIMIT $bmax");
else $res = mysql_query ("Select klu4,time,who,message,messagewosm,messagewoasm,id,towhom,hid,usid,komu from $room WHERE (usid = '".$id."')OR(towhom = '".$id."')OR(towhom = '') order by id desc LIMIT $bmax");
}

$kol = mysql_affected_rows();



if ($rm == 0){ require("umnik1.php"); $uid = 2;$klu4 = 1;}
if ($rm == 1) {require("ludak1.php"); $uid = 8;$klu4 = 2;}
if ($rm == 2) {require("mkviz1.php"); $uid = 6;$klu4 = 4;}
if ($rm == 3) {require("anagram1.php"); $uid = 6;$klu4 = 3;}
if($rm==13) {require("vesala1.php"); $uid = 7;$klu4 = 1;}


if($ver=="xhtml"){
$msg=$_POST["$ssseee"];
}
	
//--------------------- Blokada pisanje u sobama ----------//
blokada($msg);
//---------------- 25.12.2017 Tihiokean -------------------//
	
if(@$msg){
$msg = trim(" $msg ");
$msg = ereg_replace(" +"," ",$msg);
$msg = substr($msg,0,400);
$msg = str_replace("", " ", $msg);
$msg = str_replace("$", "$$", $msg);
$msg = strtr($msg,array(chr("0")=>"",chr("1")=>"",chr("2")=>"",chr("3")=>"",chr("4")=>"",chr("5")=>"",chr("6")=>"",chr("7")=>"",chr("8")=>"",chr("9")=>"",chr("10")=>"",chr("11")=>"",chr("12")=>"",chr("13")=>"",chr("14")=>"",chr("15")=>"",chr("16")=>"",chr("17")=>"",chr("18")=>"",chr("19")=>"",chr("20")=>"",chr("21")=>"",chr("22")=>"",chr("23")=>"",chr("24")=>"",chr("25")=>"",chr("26")=>"",chr("27")=>"",chr("28")=>"",chr("29")=>"",chr("30")=>"",chr("31")=>""));
##$msg = str_replace("&#1082;","&#1057;?",$msg);
$msg = htmlspecialchars($msg);
$msg = str_replace("\"", "&quot;", $msg);
$msg = str_replace("|", "&#0166;", $msg);
$msg = str_replace("'", "&#8216;", $msg);
$msg = str_replace("\\", "", $msg);
$msg = addslashes($msg);


if (!isset($prvt)) $prvt = 0;

$str1="";
$str2=$msg;

if ($prvt == 0) $towhom = "";
if (!isset($towhom)) $towhom = "";

if ($row["level"]<7) {require("antirekl.php");}

//require("smile.php");
//unset($smiles);
//unset($replaces);

if($row["level"]>7)
$msg = eregi_replace("((http://))((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z;]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((/|\?)[a-z0-9~#%&'_\+=:;\?\.-]*)*)", "<a href=\"\\0\">\\3</a>", $msg);


$msg = $str1.$msg;
if (@$msg_wosm!="") $msg_wosm = $str1.$msg_wosm;
if (@$msg_woasm!="") $msg_woasm = $str1.$msg_woasm;

if(!empty($shrift)){
if (($row["level"]>=4) && ($shrift==1)) $msg = '<i>'.$msg.'</i>';
else if (($row["level"]>=4) && ($shrift==2)) $msg = '<u>'.$msg.'</u>';
else if (($row["level"]>=4) && ($shrift==3)) $msg = '<i><u>'.$msg.'</u></i>';
else if (($row["level"]>=7) && ($shrift==4)) $msg = '<b>'.$msg.'</b>';
else if (($row["level"]>=7) && ($shrift==5)) $msg = '<u><b>'.$msg.'</b></u>';
else if (($row["level"]>=7) && ($shrift==6)) $msg = '<i><u><b>'.$msg.'</b></u></i>';
}
if(!empty($cveti_shrift)) {
if ($cveti_shrift == 0) $msg = ''.$msg.'';
if ($cveti_shrift == 1) $msg = '<font color="#000000">'.$msg.'</font>';
else if ($cveti_shrift == 2) $msg = '<font color="#0000FF">'.$msg.'</font>';
else if ($cveti_shrift == 3) $msg = '<font color="#FF0000">'.$msg.'</font>';
else if ($cveti_shrift == 4) $msg = '<font color="#309d0e">'.$msg.'</font>';
else if ($cveti_shrift == 5) $msg = '<font color="#80FF00">'.$msg.'</font>';
else if ($cveti_shrift == 6) $msg = '<font color="#00FFFF">'.$msg.'</font>';
else if ($cveti_shrift == 7) $msg = '<font color="#FF8000">'.$msg.'</font>';
else if ($cveti_shrift == 8) $msg = '<font color="#C0C0C0">'.$msg.'</font>';
else if ($cveti_shrift == 9) $msg = '<font color="#FF00FF">'.$msg.'</font>';
}

$r = mysql_query("SELECT message FROM $room WHERE usid = '".$id."' order by id desc LIMIT 1");
$a = mysql_fetch_array($r);
if ($a["message"] !== $msg){
$time = getmicrotime();
$ftime = $time - 90;
$r = mysql_query("SELECT count(*) as sum from $room WHERE (usid = '".$id."')and(id > '".$ftime."')");
$a = mysql_fetch_array($r);
$sum = $a["sum"];
if ($sum>=10&&$row["level"]<4){
$ftime = $time + 240;
$sys2 = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$zz2 = @mysql_fetch_array ($sys2);
$sysik = $zz2["user"];
mysql_query("update users set kik = '".$ftime."', whykik = 'Flood', whokik = '".$sysik."' WHERE id = '".$id."'");
}

$today=date ("H:i");
$posts =  $row["posts"];
$posts++;
if($ver=="wml"){
if ($rm == 10) mysql_query ("Update users set posts='".$posts."', onl='".$time."', version='1' where id ='".$id."'");
else mysql_query ("Update users set posts='".$posts."', onl='".$time."', room='".$rm."', version='1' where id ='".$id."'");
}else{
if ($rm == 10) mysql_query ("Update users set posts='".$posts."', onl='".$time."', version='2' where id ='".$id."'");
else mysql_query ("Update users set posts='".$posts."', onl='".$time."', room='".$rm."', version='2' where id ='".$id."'");
}
$hid = $row["inv"];
$kol++;
$rnd = rand(0,99999999);

if($rm==0) {require("umnik2.php");}
if($rm==1) {require("ludak2.php");}
if($rm==2) {require("mkviz2.php");}
if($rm==3) {require("anagram2.php");}
if($rm==13) {require("vesala2.php");}

if($prvt==2 && $row["posts"]>=300){
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$remn = mysql_query("SELECT name FROM rooms where rm = '".$rm."'");
$inamen = mysql_fetch_array ($remn);
$names = $inamen["name"];
$tema = "Soba ".$names."";
@mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$us."', idwho ='".$id."', message = '".$msg."', towhom = '".$user."', idtowhom = '".$towhom."', time = '".$time."', readd = '0', topic = '".$tema."', date='".$data."'");

$kolicinski = mysql_fetch_array(mysql_query("SELECT inbox1 FROM users WHERE id='".$id."'"));
$kolicina=$kolicinski[0]+1;
$kolicinski1 = mysql_query("UPDATE users SET inbox1='".$kolicina."' WHERE id='".$id."'");

$kolicinski22 = mysql_fetch_array(mysql_query("SELECT inbox2 FROM users WHERE id='".$towhom."'"));
$kolicina22=$kolicinski22[0]+1;
$kolicinski122 = mysql_query("UPDATE users SET inbox2='".$kolicina22."' WHERE id='".$towhom."'");
}else{
$msg = $nastr.$msg;
$komu = check($komu);

if (($rm == 0)&&($amsg == $kansw||$amsg == $tran)&&$nom!=5){
@mysql_query ("Insert into room0 set klu4= '".$rnd."', time='".$today."', who='".$us."', message='".$msg."', messagewosm = '".$msg_wosm."', messagewoasm = '".$msg_woasm."', id='".$time."', towhom='".$towhom."', hid='2', usid='".$id."', komu='".$komu."'");
} else if (($rm == 3)&&($amsg == $kansw||$amsg == $tran)&&$nom!=5){
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$us."', message='".$msg."', messagewosm = '".$msg_wosm."', messagewoasm = '".$msg_woasm."', id='".$time."', towhom='".$towhom."', hid='2', usid='".$id."', komu='".$komu."'");
} else if ($rm == 10){
@mysql_query ("Insert into room10 set klu4= '".$rnd."', time='".$today."', who='".$us."', message='".$msg."', messagewosm = '".$msg_wosm."', messagewoasm = '".$msg_woasm."', id='".$time."', towhom='".$towhom."', hid='".$hid."', usid='".$id."', pwd='".$pwd."', komu='".$komu."'");
} else {
@mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$us."', message='".$msg."', messagewosm = '".$msg_wosm."', messagewoasm = '".$msg_woasm."', id='".$time."', towhom='".$towhom."', hid='".$hid."', usid='".$id."', komu='".$komu."'");
}
if($towhom!=""){
$kolicinski334 = mysql_fetch_array(mysql_query("SELECT pwt1 FROM users WHERE id='".$id."'"));
$kolicina334=$kolicinski334[0]+1;
$kolicinski1334 = mysql_query("UPDATE users SET pwt1='".$kolicina334."' WHERE id='".$id."'");

$kolicinski2233 = mysql_fetch_array(mysql_query("SELECT pwt2 FROM users WHERE id='".$towhom."'"));
$kolicina2233=$kolicinski2233[0]+1;
$kolicinski12233 = mysql_query("UPDATE users SET pwt2='".$kolicina2233."' WHERE id='".$towhom."'");
}
}

$usmes["komu"] = $komu;
$usmes["time"] = $today;
$usmes["who"] = $us;
$usmes["usid"] = $id;
$usmes["message"] = stripslashes($msg);
@$usmes["messagewosm"] = stripslashes($msg_wosm);
@$usmes["messagewoasm"] = stripslashes($msg_woasm);
$usmes["id"] = $time;
$usmes["towhom"] = $towhom;
$smthwr = 1;

if($rm==0) {require("umnik3.php");}
if($rm==1) {require("ludak3.php");}
if($rm==2) {require("mkviz3.php");}
if($rm==3) {require("anagram3.php");}
if($rm==13) {require("vesala3.php");}
}
}

##&#1041;&#1086;&#1090; &#1064;&#1091;&#1090;&#1085;&#1080;&#1082;
//if($set["shut"] == 0){
//$interv = $set["shutint"];
//$r1 = $set["roomon"];
//$r2 = $set["roomoff"];
//$printan=0;
//$f=fopen("log/shutnik.dat","a+");
//flock($f,LOCK_EX);
//$andata=file("log/shutnik.dat");
//if ($andata[0]<time()){
//ftruncate($f,0);
//$andata = time() + $interv;
//fwrite($f,$andata);
//fflush($f);
//$printan=1;
//}
//flock($f,LOCK_UN);
//fclose($f);
//if($printan==1){
//$r = mysql_query("select count(klu4) as num from shutki");
//$a = mysql_fetch_array($r);
//$rnd = rand(1,$a["num"]);
//$r = mysql_query ("SELECT message FROM shutki WHERE klu4 = '".$rnd."' LIMIT 1;");
//$b = mysql_fetch_array($r);
//$mes = $b["message"];
//$rnd = rand(0,99999999);
//$today=date ("H:i");
//$time = getmicrotime();
//$shut = @mysql_query ("Select user from users where id='3' LIMIT 1;");
//$zz = @mysql_fetch_array ($shut);
//$shutnik = $zz["user"];
//for ($num = $r1; $num <= $r2; $num++){
//$ranec = "room".$num;
//mysql_query ("Insert into $ranec set klu4= '".$rnd."', time='".$today."', who='".$shutnik."', message='".$mes."', id='".$time."', towhom='', hid='0', usid='3', komu=''");
//mysql_query("ANALYZE TABLE $ranec");
//}
//}
//}

##&#1041;&#1086;&#1090; &#1089;&#1090;&#1080;&#1093;&#1086;&#1074;
$interv=500;
$printans=0;
$f=fopen("log/anekdot1.dat","a+");
flock($f,LOCK_EX);
$andata=file("log/anekdot1.dat");
if ($andata[0]<time())
{
ftruncate($f,0);
$andata = time() + $interv;
fwrite($f,$andata);
fflush($f);
$printans=1;
}
flock($f,LOCK_UN);
fclose($f);
//if($printans==1){
//$r = mysql_query("select count(klu4) as num from anekdot1");
//$a = @mysql_fetch_array($r);
//$rnd = rand(1,$a["num"]);
//$r = mysql_query ("SELECT message,who FROM anekdot1 WHERE klu4 = '".$rnd."' LIMIT 1;");
//$b = @mysql_fetch_array($r);
//$mes = $b["message"];
//$kto = $b["who"];
//$r3 = mysql_query("SELECT user FROM users WHERE id = '".$kto."' LIMIT 1;");
//$a4 = mysql_fetch_array($r3);
//$usanek=$a4["user"];
//$rnd = rand(0,99999999);
//$today=date ("H:i");
//$time = getmicrotime();
//$trah = @mysql_query ("Select user from users where id='9' LIMIT 1;");
//$rr = @mysql_fetch_array ($trah);
//$trahtenberg = $rr["user"];
//$messs = "".$mes." (".$usanek.")";
//mysql_query ("Insert into room7 set klu4= '".$rnd."', time='".$today."', who='".$trahtenberg."', message='".$messs."', id='".$time."', towhom='', hid='0', usid='9', komu=''");
//mysql_query("ANALYZE TABLE room7");
//}



##&#1041;&#1086;&#1090; &#1058;&#1088;&#1072;&#1093;&#1090;&#1077;&#1085;&#1073;&#1077;&#1088;&#1075;
$interv=600;
$printans=0;
$f=fopen("log/anekdot.dat","a+");
flock($f,LOCK_EX);
$andata=file("log/anekdot.dat");
if ($andata[0]<time())
{
ftruncate($f,0);
$andata = time() + $interv;
fwrite($f,$andata);
fflush($f);
$printans=1;
}
flock($f,LOCK_UN);
fclose($f);
/*if($printans==1){
$r = mysql_query("select count(klu4) as num from anekdot");
$a = mysql_fetch_array($r);
$rnd = rand(1,$a["num"]);
$r = mysql_query ("SELECT message,who FROM anekdot WHERE klu4 = '".$rnd."' LIMIT 1;");
$b = mysql_fetch_array($r);
$mes = $b["message"];
$kto = $b["who"];
$r3 = mysql_query("SELECT user FROM users WHERE id = '".$kto."' LIMIT 1;");
$a4 = mysql_fetch_array($r3);
$usanek=$a4["user"];
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = getmicrotime();
$trah = @mysql_query ("Select user from users where id='6' LIMIT 1;");
$rr = @mysql_fetch_array ($trah);
//$trahtenberg = $rr["user"];
//$messs = "".$mes." (".$usanek.")";
mysql_query ("Insert into room12 set klu4= '".$rnd."', time='".$today."', who='".$trahtenberg."', message='".$messs."', id='".$time."', towhom='', hid='0', usid='6', komu=''");
mysql_query("ANALYZE TABLE room12");
}*/
## &#1054;&#1073;&#1097;&#1072;&#1102;&#1097;&#1080;&#1081;&#1089;&#1103; &#1073;&#1086;&#1090; &#1084;&#1072;&#1090;&#1077;&#1088;&#1096;&#1080;&#1085;&#1085;&#1080;&#1082;



##&#1057;&#1090;&#1080;&#1093; &#1087;&#1086; &#1079;&#1072;&#1087;&#1088;&#1086;&#1089;&#1091;
if ($msg=="!stih"||$msg=="!&#1089;&#1090;&#1080;&#1093;"){
$rs = mysql_query("select count(klu4) as num from anekdot1");
$as = mysql_fetch_array($rs);
$rnds = rand(1,$as["num"]);
$rs = mysql_query ("SELECT message FROM anekdot1 WHERE klu4 = '".$rnds."' LIMIT 1;");
$bs = mysql_fetch_array($rs);
$mes = $bs["message"];
$mess = $mes;
$bot9 = @mysql_query ("Select user from users where id='9' LIMIT 1;");
$zz1 = @mysql_fetch_array ($bot9);
$bot91 = $zz1["user"];
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = getmicrotime();
$room="room".$rm;
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$bot91."', message='".$mess."', id='".$time."', towhom='', hid='0', usid='9', komu='".$us."'");
mysql_query("ANALYZE TABLE $room");
}


##&#1040;&#1085;&#1077;&#1082;&#1076;&#1086;&#1090; &#1087;&#1086; &#1079;&#1072;&#1087;&#1088;&#1086;&#1089;&#1091;
if ($msg=="!anekdot"||$msg=="!&#1072;&#1085;&#1077;&#1082;&#1076;&#1086;&#1090;"){
$rs = mysql_query("select count(klu4) as num from anekdot");
$as = mysql_fetch_array($rs);
$rnds = rand(1,$as["num"]);
$rs = mysql_query ("SELECT message FROM anekdot WHERE klu4 = '".$rnds."' LIMIT 1;");
$bs = mysql_fetch_array($rs);
$mes = $bs["message"];
$mess = $mes;
$bot8 = @mysql_query ("Select user from users where id='6' LIMIT 1;");
$zz1 = @mysql_fetch_array ($bot8);
$bot81 = $zz1["user"];
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = getmicrotime();
$room="room".$rm;
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$bot81."', message='".$mess."', id='".$time."', towhom='', hid='0', usid='6', komu='".$us."'");
mysql_query("ANALYZE TABLE $room");
}
unset($msg);

$bind1=$row['bind1'];
$bind2=$row['bind2'];
$bind3=$row['bind3'];
$bind4=$row['bind4'];
$avr = $row["avr"];
$avr2 = $avr/10;
$time=date ("H:i");

if($rm==10) $takep="&amp;pwd=$pwd&amp;ref=$ref";
else if($mod=="privat") $takep="&amp;mod=$mod&amp;ref=$ref";
else $takep="&amp;ref=$ref";

$rem = mysql_query("SELECT topic, text FROM rooms where rm = '".$rm."'");
$iname = mysql_fetch_array ($rem);
$topic = $iname["topic"];
$text = getsmilies($iname["text"],$_GET["id"]);
//if($text!="") $tekst= "<div class=\"d1\"><i><b>$text</b></i></div><br/>";
/////////////forum chempa
echo "<b><u>Poslednji postovi u forumu:</u></b><br/>";
      $lpts =mysql_query("SELECT id, uid, name FROM topics ORDER BY last DESC LIMIT 0,1");
            while ($lpt = mysql_fetch_array($lpts))
    {
      $nops =mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE tid='".$lpt[0]."'"));
      if($lpt[0]==0)
      {
        $pinfo = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$lpt[1]."'"));
        $tluid = $pinfo[0];
      }else{
        $pinfo = mysql_fetch_array(mysql_query("SELECT uid FROM posts WHERE tid='".$lpt[0]."' ORDER BY id DESC LIMIT 0,1"));
        $tluid = $pinfo[0];
      }
		$pos4 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$tluid."'"));
		$items_per_page= 10;
		$num_pages = ceil($nops[0]/$items_per_page);
$imeime=htmlspecialchars("$pos1[2]");
echo "<a href=\"forum.php?$ses&amp;ref=$ref&amp;action=topic&amp;tid=$lpt[0]&amp;page=$num_pages\">$lpt[2]</a>";
echo ", od <a href=\"info.php?$ses&amp;ref=$ref&amp;nk=$tluid\">$pos4[0]</a><br/>";
      }


//echo $divide;
echo "<br/>";
//////////////////////////////////////////////////////////////
//$us = EdykaColor($us,$zs1["color"],$zs1["specolor"]);
if($text!="") $tekst= "<div class=\"d1\"><i> $stri, <b>$us</b>!<br/> <b> $text</b></i></div>";


$agent = htmlentities(addslashes($HTTP_USER_AGENT));

$r = mysql_query ("select count(readd) as num from zapiski WHERE (idtowhom = '".$id."')and(readd = '0')and(ininc = '1')");
$a = mysql_fetch_array($r);
$inb = $a["num"];
?>
<head> 
 
<script type="text/javascript">
  function lifeSite() {
    var start = new Date('october 15, 2022'); // Дата создания сайта
    var end = new Date();
    var life = Math.round((end.getTime() - start.getTime()) / (1000 * 60 * 60 * 24));
    var suffix = new Array("dan", "dana","dana");
    var keys = [2, 0, 1, 1, 1, 2];
    var mod = life % 100;
    var suffix_key = mod > 4 && mod < 20 ? 2 : keys[Math.min(mod%10, 5)];
    document.getElementById("life_site").innerHTML = life + " " + suffix[suffix_key];
  }
</script>

 </head>
<? 
if(intval(date("H")) >= 0 AND intval(date("H")) < 6) $stri = "Laku noc";
if(intval(date("H")) >= 6 AND intval(date("H")) < 12) $stri = "Dobro jutro";
if(intval(date("H")) >= 12 AND intval(date("H")) < 17) $stri = "Dobar dan";
if(intval(date("H")) >= 17) $stri = "Dobro vece";

//$us = EdykaColor($us,$zs1["color"],$zs1["specolor"]);<img src="smilies/328-75352.gif"
if($text!="") $tekst= "<div class=\"d1\"><i> $stri, <b><span style='color:{$row['color']}'>" .$us. "</span></b>!<br/> <b> $text</b></i></div>";

$agent = htmlentities(addslashes($HTTP_USER_AGENT));

$r = mysql_query ("select count(readd) as num from zapiski WHERE (idtowhom = '".$id."')and(readd = '0')and(ininc = '1')");
$a = mysql_fetch_array($r);
$inb = $a["num"];


if(intval(date("H")) >= 0 AND intval(date("H")) < 6) $stri = "Laku noc";
if(intval(date("H")) >= 6 AND intval(date("H")) < 12) $stri = "Dobro jutro";
if(intval(date("H")) >= 12 AND intval(date("H")) < 17) $stri = "Dobar dan";
if(intval(date("H")) >= 17) $stri = "Dobro vece";


//$us = EdykaColor($us,$zs1["color"],$zs1["specolor"]);
if($text!="") $tekst= "<div class=\"d1\"><i> $stri, <b><span style='color:{$row['color']}'>" .$us. "</span></b>!<br/> <b> $text</b></i></div>";

$agent = htmlentities(addslashes($HTTP_USER_AGENT));

$r = mysql_query ("select count(readd) as num from zapiski WHERE (idtowhom = '".$id."')and(readd = '0')and(ininc = '1')");
$a = mysql_fetch_array($r);
$inb = $a["num"];


if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
if ($avr!==0) echo "<card id=\"chat\" title=\"".$topic."-(".$time.")\" ontimer=\"chat.php?$ses&amp;rm=$rm$takep\"><timer value=\"".$avr."\"/>";
else echo "<card id=\"chat\" title=\"".$topic."-(".$time.")\">";
//if ($row["kn_update"]==0) echo "<do type=\"options\" name=\"refresh\" label=\"Osvezi\"><go href=\"chat.php?$ses&amp;rm=$rm$takep\"/></do>";
if ($row["kn_say"]==0){
if (((strpos ($agent,"M3Gate") !== false)||(strpos ($agent,"Opera") !== false)||(strpos ($agent,"emulator") !== false)||(strpos ($agent,"WinWAP") !== false)||(strpos ($agent,"Wapsilon") !== false)||(strpos ($agent,"Mozilla") !== false)||(strpos ($agent,"M3GATE") !== false))){
//echo "<do type=\"options\" name=\"add\" label=\"Napisi\"><go href=\"chat.php?$ses&amp;rm=$rm$takep#add\"/></do>";
}else{
//echo "<do type=\"options\" name=\"add\" label=\"Napisi\"><go href=\"#add\"/></do>";
}
}
//if (($row["kn_privat"]==0)&&($rm!=10)){
//if ($mod=="privat")echo "<do type=\"options\" name=\"privat\" label=\"Filter[P!]\"><go href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\"/></do>";
//else echo "<do type=\"options\" name=\"privat\" label=\"Fillter[P!]\"><go href=\"chat.php?$ses&amp;rm=$rm&amp;mod=privat$takep\"/></do>";
//}
if($row["level"]>9){
if($pwtread[0]==1){
echo "<do type=\"options\" name=\"pwtread\" label=\"Iskljuci PWT\"><go href=\"apanel.php?$ses&amp;go=pwtread$takep&amp;read=0\"/></do>";
}else{
echo "<do type=\"options\" name=\"pwtread\" label=\"Ukljuci PWT\"><go href=\"apanel.php?$ses&amp;go=pwtread$takep&amp;read=1\"/></do>";
}
}
if ($row["kn_letters"]==0) echo "<do type=\"options\" name=\"mes\" label=\"Inbox(".$inb.")\"><go href=\"chatmail.php?$ses&amp;rm=$rm$takep\"/></do>";
//if ($row["kn_whochat"]==0) echo "<do type=\"options\" name=\"who\" label=\"Online\"><go href=\"who.php?$ses&amp;rm=$rm$takep\"/></do>";
$room = "room".$rm;
$tm = time()-8800;
$tm111 = time()-8800;
$r = @mysql_query ("Select who from $room WHERE id > '".$tm."' AND usid>'8' OR id > '".$tm111."' AND usid='1' group by who order by id desc;");
$asnum = mysql_affected_rows();
//if (($row["kn_whoroom"]==0)&&($rm!=10)) echo "<do type=\"options\" name=\"who_room\" label=\"Online(".($asnum).")\"><go href=\"whoroom.php?$ses&amp;rm=$rm$takep\"/></do>";
if (($row["kn_clroom"]==0)&&($row["level"]>5)){
echo "<do type=\"options\" name=\"clear\" label=\"Ocisti Sve Sobe\"><go href=\"apanel.php?$ses&amp;go=clroom&amp;rm=$rm$takep\"/></do>";
echo "<do type=\"options\" name=\"clear\" label=\"Ocisti Sobu\"><go href=\"mpanel.php?$ses&amp;do=clrm&amp;rm=$rm$takep\"/></do>";
}
//if ($row["kn_nood"]==0) echo "<do type=\"options\" name=\"nastroi\" label=\"Raspolozenja\"><go href=\"nood.php?$ses&amp;rm=$rm$takep\"/></do>";
//if ($row["kn_holl"]==0) echo "<do type=\"options\" name=\"enter\" label=\"Hodnik\"><go href=\"enter.php?$ses&amp;rm=$rm$takep\"/></do>";
if ($row["kn_cabinet"]==0) echo "<do type=\"options\" name=\"enter\" label=\"Licni Kabinet\"><go href=\"cabinet.php?$ses&amp;rm=$rm$takep\"/></do>";
//if (($row["kn_stats"]==0)&&($rm==0)) echo "<do type=\"options\" name=\"stats\" label=\"Statistika\"><go href=\"statistik.php?$ses&amp;rm=$rm&amp;mod=10ym&amp;ref=$ref\"/></do>";
//if (($row["kn_kommands"]==0)&&($rm==0)) echo "<do type=\"options\" name=\"kom\" label=\"Komande\"><go href=\"faq.php?$ses&amp;rm=$rm&amp;ref=$ref&amp;mod=vict_kom\"/></do>";
//if (($row["trade"]==0)&&($rm==0)) echo "<do type=\"options\" name=\"trader\" label=\"Kupi Odgovor\"><go href=\"prodavec.php?$ses&amp;rm=$rm$takep\"/></do>";
if (($row["kn_sos"]==0)&&($rm!=11)&&($rm!=11)&&($row["level"]<10))echo "<do type=\"options\" name=\"help\" label=\"Pozovi Moda\"><go href=\"sos.php?$ses&amp;rm=$rm$takep\"/></do>";
if ($rm==10) echo "<do type=\"options\" name=\"klu4\" label=\"Promeni Kljuc\"><go href=\"intim.php?$ses&amp;ref=$ref\"/></do>";
if (($row["level"]>3)&&($rm!=10)&&($row["kn_topic"]==0)) echo "<do type=\"options\" name=\"topic\" label=\"Naziv\"><go href=\"topic.php?$ses&amp;rm=$rm$takep\"/></do>";
echo "<p>";
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

//echo "<title>".$topic." - (".$time.")</title>";


if($inb != "0"){
echo "<title> Inbox (".$inb.") | ".$topic." - (".$time.")</title>\n";
}else echo "<title>".$topic." - (".$time.")</title>";


if ($avr==0) echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>";
else echo "<meta http-equiv=\"Refresh\" content=\"".$avr2."; url=chat.php?$ses&amp;rm=$rm$takep\"/>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">";
}
echo $fsize1;

if($row["level"]>6)
{
$newtod=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE valid=0 AND id>'8'"));
if ($newtod[0]>0){
echo "<img src=\"smile/new2.gif\" alt=\"\"/><a href=\"statistik.php?$ses&amp;mod=valid&amp;ref=$ref\">Validacija(".$newtod[0].")</a><img src=\"smile/new2.gif\" alt=\"\"/><br/>";
}
}
if ($rm==8) 
{
echo "[ <a href=\"reklame.php?$ses&amp;ref=$ref&amp;rm=$rm\">Adrese za Rek.</a> ]</a> |";
$curdate=date("d-m-Y");
$newtoday=mysql_fetch_array(mysql_query("SELECT COUNT(id) from users WHERE date = '".$curdate."'"));
if ($newtoday[0]>0){
echo "[ Novi Chateri:<a href=\"statistik.php?$ses&amp;mod=newtoday&amp;ref=$ref\">(".$newtoday[0].")</a>]<br/>";
}
}
//if($inb != "0") echo "<img src=\"images/pismo.gif\" alt=\"NEW\"/><b>Inbox<a href=\"inbox.php?$ses&amp;rm=$rm&amp;ref=$ref&amp;pwd=$pwd\">(".$inb.")</a></b>$zvukinbox\n";
if($inb != "0") echo "<img src=\"images/pismo.gif\" alt=\"NEW\"/><b>Inbox<a href=\"inbox.php?$ses&amp;rm=$rm&amp;ref=$ref&amp;pwd=$pwd\">(".$inb.")</a></b>$zvukinbox\n";

$us_ip = $row["user_ip"];
$us_soft = $row["user_soft"];
$visit = $row["visit2"];

if(($row["user_soft"]!==$HTTP_USER_AGENT||$row["user_ip"]!==$REMOTE_ADDR)){
mysql_query ("Update users set user_soft='".$HTTP_USER_AGENT."', user_ip = '".$REMOTE_ADDR."' WHERE id = '".$id."';");
if ($row["safe"]==0){
echo "<div class=\"d1\"><b>Upozorenje!</b> Vi ste usli na chat sa razlicitim Browserom ili Ip adresom od poslednjeg logovanja.<br/>Poslednja aktivnost $visit.<br/> Browser od proslog logovanja <b>".$us_soft."</b> i IP: <b>".$us_ip."</b><br/>\n";
echo "Trenutni browser: <b>".$HTTP_USER_AGENT."</b><br/>\n";
echo "Trenutna IP adresa: <b>".$REMOTE_ADDR."</b><br/></div>\n";
}
}
echo $tekst;
if ($ver=="wml"){
$posts = mysql_fetch_array(mysql_query("SELECT id, posts FROM `users` WHERE id='".$id."'"));
if($posts[1]<'300'){
if ($rm==11){ echo "<b>$us,napisi gde si video/la adresu i dobijas postove :)</b><br/>";}
}
if (((strpos ($agent,"M3Gate") !== false)||(strpos ($agent,"Opera") !== false)||(strpos ($agent,"emulator") !== false)||(strpos ($agent,"WinWAP") !== false)||(strpos ($agent,"Wapsilon") !== false)||(strpos ($agent,"M3GATE") !== false))){
echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep#add\" accesskey=\"$bind1\">Napisi</a>|";
$manje = time()-8800;
$gdeko = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$manje."'"));
echo "<a href=\"who.php?$ses&amp;ref=$ref\">Ko je gde(".$gdeko[0].")</a><br/>";
}else{
echo "<a href=\"#add\" accesskey=\"$bind1\">Napisi</a>|";
//echo "<a href=\"who.php?$ses&amp;rm=$rm&amp;ref=$ref$takep\" >Ko je gde?</a><br/>";
$manje = time()-8800;
$gdeko = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$manje."'"));
echo "<a href=\"who.php?$ses&amp;ref=$ref\"> Ko je gde(".$gdeko[0].") </a><br/>";

}
}else{
echo $fsize2;
if(intval(date("H")) >= 0 AND intval(date("H")) < 6) $stri = "Laku noc";
if(intval(date("H")) >= 6 AND intval(date("H")) < 12) $stri = "Dobro jutro";
if(intval(date("H")) >= 12 AND intval(date("H")) < 17) $stri = "Dobar dan";
if(intval(date("H")) >= 17) $stri = "Dobro vece";


//$us = EdykaColor($us,$zs1["color"],$zs1["specolor"]);
//if ($rm==8){ echo "<FONT COLOR=#CC0000><i> $stri, <b>$us</b>!</i></FONT>";}
//if ($rm==7){ echo "<FONT COLOR=#CC0000><i> $stri, <b>$us</b>!</i></FONT>";}
//if ($rm==11){ echo "<FONT COLOR=#CC0000><i> $stri, <b>$us</b>!</i></FONT>";}
//echo "<div class=\"d1\"><i> $stri, <b>$us</b>!</i></div>";

$posts = mysql_fetch_array(mysql_query("SELECT id, posts FROM `users` WHERE id='".$id."'"));
if($posts[1]<'300'){
if ($rm==11){ echo "<div class=\"d1\"><b><span style='color:{$row['color']}'>" .$us. "</span>, napisi gde si video/la adresu i dobijas postove :)</b></div>";}
}



echo $fsize1;
$manje = time()-8800;
$gdeko = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$manje."'"));
?>
<div class="altertekst">
<div class=d11>
<div class=d121>
    <?
echo "
<a href=\"add.php?$ses&amp;rm=$rm$takep\" accesskey=\"$bind1\">Napisi </a>|
<a href=\"who.php?$ses&amp;ref=$ref\"> Ko je gde(".$gdeko[0].") </a>|
<a href=\"chat.php?$ses&amp;rm=$rm$takep\" accesskey=\"$bind2\"> Osvezi </a>|
<a href=\"function.php?$ses&amp;rm=$rm$takep\" accesskey=\"3\"> Funkcije</a>|<a href=\"kiss.php?$ses&amp;rm=$rm$takep\"> Posalji Kiss </a>|<a href=\"poziv.php?$ses&amp;rm=$rm$takep\"> Pozovi chatera </a>";
?>
</div></div>
	<div class=clear></div>
</div>
<?
echo $fsize2;
echo "</div>";

echo $fsize1;
}
if ($ver=="wml"){
echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\" accesskey=\"$bind2\">Osvezi</a>|";
if ($mod=="privat")echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\">Javne</a><br/>";
else echo "<a href=\"chat.php?$ses&amp;rm=$rm&amp;mod=privat$takep\">Privatne</a><br/>";
}else{
echo $fsize2;
//echo "<div class=\"d1\">";
echo $fsize1;
//echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\" accesskey=\"$bind2\">Osvezi</a>|<a href=\"function.php?$ses&amp;rm=$rm$takep\" accesskey=\"3\">Funkcije</a>";
echo $fsize2;
//echo "</div>";
echo $fsize1;
}
@$total=$kol-1;
$mread = 0;

if ($smthwr != 0){
$komu = $usmes["komu"];
$date = $usmes["time"];
$klu4 = $usmes["klu4"];
$name = $usmes["who"];
$usid = $usmes["usid"];

if($rm!="6"){
if ($smset=="0") {$msg = $usmes["message"];}
else if ($smset=="2") {$msg = $usmes["message"]; $msg=getsmilies1($msg, $usid);}
else{$msg = $usmes["message"]; $msg=getsmilies1($msg, $usid);}
}else{
$msg = $usmes["message"];
}

$msg=zamena($msg);
if($rm=="6"){
$duzina=strlen($msg);
$stst=mysql_fetch_array(mysql_query("SELECT level FROM users WHERE id='".$usid."'"));
if($duzina>18 && $stst[0]<7){
$msg = substr($msg,0,18);
}
$msg = str_replace("<b>", "", $msg);
$msg = str_replace("</b>", "", $msg);
$msg = str_replace("<i>", "", $msg);
$msg = str_replace("</i>", "", $msg);
$msg = str_replace("<u>", "", $msg);
$msg = str_replace("</u>", "", $msg);
}

$time = $usmes["id"];
$th = $usmes["towhom"];
@mysql_query ("Select * from ignor where usid='".$usid."' and id='".$id."'");
if (mysql_affected_rows() == false){
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$name."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$name = EdykaColor($name,$zs1["color"],$zs1["specolor"]);
if ($th == ""){
if (!empty($komu)) {
if ($us==$komu) $komu = "-<b>".$komu."</b>";
else $komu = "-".$komu."";
}
//$cvetn = $zs1["color"];
//$name = EdykaColor($name,$zs1["color"],$zs1["specolor"]);

//$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$name."'");
//$zs1 = @mysql_fetch_array ($pols);
//$sex = $zs1["sex"];
//$cvetn = $zs1["color"];
//$name = EdykaColor($name,$zs1["color"],$zs1["specolor"]);


if ($row["level"]<6){
if ($ver=="wml"){
echo "<br/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")\n".$msg.""; $mread++;
}else{
if ($sex=="M") {echo "<br/><img src=\"smile/pol_m.gif\" alt=\"&#1052;\"/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")\n".$msg.""; $mread++;}
else {echo "<br/><img src=\"smile/pol_j.gif\" alt=\"Z\"/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")\n".$msg.""; $mread++;}
}
}else{
if ($ver=="wml"){
echo "<br/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a>".$komu."</b>(".$date.")";
}else{
if ($sex=="M") {echo "<br/><img src=\"smile/pol_m.gif\" alt=\"&#1052;\"/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")";}
else {echo "<br/><img src=\"smile/pol_j.gif\" alt=\"Z\"/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")";}
}
echo "<a href=\"delmess.php?$ses&amp;rm=$rm&amp;klu4$takep\">[X]</a>\n".$msg.""; $mread++;
}
}
else if (($th == $id)||($id == $usid)||($row["level"]>9 && $pwtread[0]==1)){
if (!empty($komu)) {
if ($us==$komu) $komu = "-<b>".$komu."</b>";
else $komu = "-".$komu."";
}

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$name."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$name = EdykaColor($name,$zs1["color"],$zs1["specolor"]);


if ($row["level"]<5){
if ($ver=="wml"){
echo "<br/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")<b>[P!]</b></u>\n".$msg.""; $mread++;
}else{
if ($sex=="M") {echo "<br/><img src=\"smile/pol_m.gif\" alt=\"&#1052;\"/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")<b>[P!]</b></u>\n".$msg.""; $mread++;}
else {echo "<br/><img src=\"smile/pol_j.gif\" alt=\"Z\"/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")<b>[P!]</b>$zvukpwt\n".$msg.""; $mread++;}
}
}else{
if ($ver=="wml"){
echo "<br/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep&amp;modlog=6\">".$name."</a>".$komu."</b>(".$date.")<b>[P!]</b></u>$zvukpwt";
}else{
if ($sex=="M") {echo "<br/><img src=\"smile/pol_m.gif\" alt=\"&#1052;\"/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a>".$komu."</b>(".$date.")<b>[P!]</b></u>$zvukpwt";}
else {echo "<br/><img src=\"smile/pol_j.gif\" alt=\"Z\"/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a>".$komu."</b>(".$date.")<b>[P!]</b></u>$zvukpwt";}
}
echo "<a href=\"delmess.php?$ses&amp;rm=$rm&amp;klu4=$klu4$takep\">[X]</a>\n".$msg.""; $mread++;
}
}
}
}
while ($mread < $max){
$lines = @mysql_fetch_array ($res);
if($lines===false)break;
$komu = $lines["komu"];
$date = $lines["time"];
$klu4 = $lines["klu4"];
$name = $lines["who"];
$usid = $lines["usid"];
if($rm!="6"){
if ($smset=="0") {$msg = $lines["message"];}
else if ($smset=="2") {$msg = $lines["message"]; $msg=getsmilies1($msg, $usid);}
else{$msg = $lines["message"]; $msg=getsmilies1($msg, $usid);}
}else{
$msg = $lines["message"];
}

$msg=zamena($msg);
if($rm=="6"){
$duzina=strlen($msg);
$stst=mysql_fetch_array(mysql_query("SELECT level FROM users WHERE id='".$usid."'"));
if($duzina>18 && $stst[0]<7){
$msg = substr($msg,0,18);
}
$msg = str_replace("<b>", "", $msg);
$msg = str_replace("</b>", "", $msg);
$msg = str_replace("<i>", "", $msg);
$msg = str_replace("</i>", "", $msg);
$msg = str_replace("<u>", "", $msg);
$msg = str_replace("</u>", "", $msg);
}
$time = $lines["id"];
$th = $lines["towhom"];
$hid = $lines["hid"];
@mysql_query ("Select * from ignor where usid='".$usid."' and id='".$id."'");
if ((mysql_affected_rows() == false)&&(($hid != 2)||($id == $usid)||($row["level"]>9 && $pwtread[0]==1))){
$pols = @mysql_query ("SELECT sex,color,specolor FROM users where user='".$name."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
if ($th == ""){
if (!empty($komu)) {
if ($us==$komu) $komu = "-<b>".$komu."</b>";
else $komu = "-".$komu."";
}
//$cvetn = $zs1["color"];
//$name = EdykaColor($name,$zs1["color"],$zs1["specolor"]);

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$name."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$name = EdykaColor($name,$zs1["color"],$zs1["specolor"]);


if ($row["level"]<5){
if ($ver=="wml"){
echo "<br/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")\n".$msg."";$mread++;
}else{
if ($sex=="M") {echo "<br/><img src=\"smile/pol_m.gif\" alt=\"&#1052;\"/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")\n".$msg.""; $mread++;}
else {echo "<br/><img src=\"smile/pol_j.gif\" alt=\"Z\"/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")\n".$msg.""; $mread++;}
}
}else{
if ($ver=="wml"){
echo "<br/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")";
}else{
if ($sex=="M") {echo "<br/><img src=\"smile/pol_m.gif\" alt=\"&#1052;\"/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")";}
else {echo "<br/><img src=\"smile/pol_j.gif\" alt=\"Z\"/><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")";}
}
echo "<a href=\"delmess.php?$ses&amp;rm=$rm&amp;klu4=$klu4$takep\">[X]</a>\n".$msg."";$mread++;
}
} else {
if (($th == $id)||($id == $usid)||($row["level"]>9 && $pwtread[0]==1)){
if (!empty($komu)) {
if ($us==$komu) $komu = "-<b>".$komu."</b>";
else $komu = "-".$komu."";
}

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$name."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$name = EdykaColor($name,$zs1["color"],$zs1["specolor"]);

if ($row["level"]<5){
if ($ver=="wml"){
echo "<br/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a>".$komu."</b>(".$date.")<b>[P!]</b></u>$zvukpwt\n"
.$msg."";$mread++;
}else{
if ($sex=="M") {echo "<br/><img src=\"smile/pol_m.gif\" alt=\"&#1052;\"/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")<b>[P!]</b></u>$zvukpwt\n".$msg.""; $mread++;}
else {echo "<br/><img src=\"smile/pol_j.gif\" alt=\"Z\"/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a></b>".$komu."(".$date.")<b>[P!]</b></u>$zvukpwt\n".$msg.""; $mread++;}
}
}else{
if ($ver=="wml"){
echo "<br/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a>".$komu."</b>(".$date.")<b>[P!]</b></u>$zvukpwt";
}else{
if ($sex=="M") {echo "<br/><img src=\"smile/pol_m.gif\" alt=\"&#1052;\"/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a>".$komu."</b>(".$date.")<b>[P!]</b></u>$zvukpwt";}
else {echo "<br/><img src=\"smile/pol_j.gif\" alt=\"Z\"/><u><b><a href=\"info.php?$ses&amp;rm=$rm&amp;nk=$usid$takep\">".$name."</a>".$komu."</b>(".$date.")<b>[P!]</b></u>$zvukpwt";}
}
echo "<a href=\"delmess.php?$ses&amp;rm=$rm&amp;klu4=$klu4$takep\">[X]</a>\n".$msg."";$mread++;
}
}
}
}
}
$page_next = $max;
if ($ver=="wml") echo "<br/>---";
else echo "<br/><br/>";
if ($max < $total){
if ($ver=="wml") {echo "<br/><a href=\"history.php?$ses&amp;rm=$rm&amp;num=$page_next$takep\" accesskey=\"$bind3\">Arhiva</a><br/>";}
else {
echo $fsize2;

?>
<div class="altertekst">
<div class=d11>
<div class=d121>
    <?
echo $fsize1;
echo "<a href=\"history.php?$ses&amp;rm=$rm&amp;num=$page_next$takep\" accesskey=\"$bind3\">Arhiva</a>";
echo $fsize2;

echo $fsize1;
?>
</b><br/></div></div>
	<div class=clear></div>
</div>
<?
}
}//echo 'Test';
if($rm!=10){
$smiliesss = mysql_fetch_array(mysql_query ("SELECT COUNT(*) FROM smilies"));
if ($ver=="wml") {echo "<a href=\"smilies.php?$ses&amp;rm=$rm$takep\">Smajliji ($smiliesss[0])</a>|<a href=\"whoroom.php?$ses&amp;rm=$rm$takep\"> Ko je tu</a>";
$tm = time()-8800;
$sobe = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime>'".$tm."' AND gde='".$room."'"));
echo "<b><a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">$roomname ($sobe[0])</a></b><br/>";}
else {
echo $fsize2;

echo $fsize1;
$smiliesss = mysql_fetch_array(mysql_query ("SELECT COUNT(*) FROM smilies"));
?>
<div class="altertekst">
<div class=d11>
<div class=d121>
    <?
echo "<a href=\"smilies.php?$ses&amp;rm=$rm$takep\">Smajliji ($smiliesss[0])</a>|<a href=\"color.php?$ses&amp;ref=$ref\"> Boja nika </a>|<a href=\"statistik.php?$ses&amp;rm=$rm$takep\">Statistika </a>|<a href=\"enter.php?$ses&amp;ref=$ref\" accesskey=\"$bind4\"> Hodnik </a>|<a href=\"whoroom.php?$ses&amp;rm=$rm$takep\"> Ko je tu</a>";
$tm = time()-8800;
$sobe = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime>'".$tm."' AND gde='".$room."'"));
echo "<b><a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">$roomname ($sobe[0])</a></b><br/></div></div>
	<div class=clear></div>
</div>";
///////////////////////////////////////////////////////////////////////Online u sobi///////////////////////////////
echo "<b>Prisutni chateri :</b></a></p>";
$clanovi = mysql_query("SELECT id, user, inv, level, gde, gdetime FROM users WHERE gdetime>'".$tm."' AND gde='".$room."'");
if ($rm!=10 && $rm!=7 && $rm!=8){
for ($k = 0; $k < $sobe[0]; $k++){
$lines = mysql_fetch_array ($clanovi);

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$lines[1]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$lines[1] = EdykaColor($lines[1],$zs1["color"],$zs1["specolor"]);

if ($lines[2] != 1) echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
else if ($row["level"]==8) echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1](i)</a>";
if (($k+1) != $sobe[0]) print ', ';
}
if($sobe[0]>0)echo "<br/><br/>";
else echo "Ova soba je trenutno prazna!<br/>";
unset($lines);
}else if($rm==10){
if ($row["level"]==8){
for ($k = 0; $k < $sobe[0]; $k++){
$lines = mysql_fetch_array ($clanovi);
if ($lines[2] != 1)echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
else echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
if (($k+1) != $sobe[0]) print ', ';
}
if($sobe[0]>0)echo "<br/><br/>";
else echo "Ova soba je trenutno prazna!<br/>";
unset($lines);
}
}else if($rm==7){
if ($row["level"]>6){
for ($k = 0; $k < $sobe[0]; $k++){
$lines = mysql_fetch_array ($clanovi);

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$lines[1]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$lines[1] = EdykaColor($lines[1],$zs1["color"],$zs1["specolor"]);

if ($lines[2] != 1)echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
else echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
if (($k+1) != $sobe[0]) print ', ';
}
if($sobe[0]>0)echo "<br/><br/>";
else echo "Ova soba je trenutno prazna!<br/>";
unset($lines);
}
}else if($rm==8){
if ($row["level"]>3){
for ($k = 0; $k < $sobe[0]; $k++){
$lines = mysql_fetch_array ($clanovi);

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$lines[1]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$lines[1] = EdykaColor($lines[1],$zs1["color"],$zs1["specolor"]);

if ($lines[2] != 1)echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
else echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$lines[0]&amp;ref=$ref\">$lines[1]</a>";
if (($k+1) != $sobe[0]) print ', ';
}
if($sobe[0]>0)echo "<br/><br/>";
else echo "Ova soba je trenutno prazna!<br/>";
unset($lines);
}
}
echo $divide;
///////////////////////////////////////////////////////////kraj online u sobi////////////////////////////
////////////////////////
echo $fsize1;
$tm = time()-300;
if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$tm."' AND `gde` NOT LIKE CONVERT(_utf8 '%room%' USING latin1) AND `gde` NOT LIKE CONVERT(_utf8 '%*#*#*#*%' USING latin1) AND gde!='Inbox' AND gde!='Salje Pismo' AND gde!='Poslata Pisma' AND gde!='Cita Pismo'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 20;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
echo  "<b>Skitare u hodniku: $noi[0] </b>";
$sql = "SELECT id, user, inv, level, gde, gdetime, color, specolor  FROM users WHERE gdetime> '".$tm."' AND `gde` NOT LIKE CONVERT(_utf8 '%room%' USING latin1) AND `gde` NOT LIKE CONVERT(_utf8 '%*#*#*#*%' USING latin1) AND gde!='Inbox' AND gde!='Salje Pismo' AND gde!='Poslata Pisma' AND gde!='Cita Pismo' ORDER BY latuser ASC LIMIT $limit_start, $items_per_page";

$item = mysql_fetch_array ($sql);


    $items = mysql_query($sql);
      echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
{ 
$item[1] =EdykaColor($item[1],$item['color'],$item['specolor']);
if ($item[2] != 1) echo "<b><a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$item[1]</a></b>-$item[4]";
//
//           echo "<b><a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$item[1]</a></b>-$item[4]<br/>"; 
    }
    }else{
echo "<br/>Trenutno nema clanova u Hodniku!<br/>";
}   
if($num_pages>1){echo "<br/>";}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"prwho.php?page=$ppage&amp;$ses&amp;ref=$ref\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"prwho.php?page=$npage&amp;$ses&amp;ref=$ref\">Napred&#187;</a>";
    }
    echo "<br/><br/>";
////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$time = getmicrotime();                     ///
$tm = time()-300;                           ///
$tm111 = time()-300;                        ///
////////////////////////////////////////////////////////////

//////////kraj online hodnik

echo $fsize2;
echo "</div>";
echo "<div class=\"d1\">";
echo $fsize2;

echo $fsize2;
echo $fsize1;
}
}else{
echo "<div class=\"d1\"><a href=\"enter.php?$ses&amp;ref=$ref\" accesskey=\"$bind4\">Hodnik(".$bind4.")</a></div>";	
echo "<br/>";
}
if ($ver=="wml") echo "<br/><a href=\"enter.php?$ses&amp;ref=$ref\" accesskey=\"$bind4\">Hodnik(".$bind4.")</a><br/>";
//else echo "<div class=\"d1\"><a href=\"enter.php?$ses&amp;ref=$ref\" accesskey=\"$bind4\">Hodnik(".$bind4.")</a></div>";
if ($ver=="wml") echo $divide;
$pagesize=round((ob_get_length()+200)/1024,1);
//echo "&#1042;&#1077;&#1089; &#1089;&#1090;&#1088;&#1072;&#1085;&#1080;&#1094;&#1099;: ".$pagesize." &#1050;&#1073;<br/>";
//if ($ver=="wml") echo "<a href=\"smilies.php?$ses&amp;rm=$rm$takep\">Smajliji</a><br/>";
//else echo "<div class=\"d1\"><a href=\"smilies.php?$ses&amp;rm=$rm$takep\">Smajliji</a></div>";
echo $fsize2;
//include("gzip.php");
if ($ver=="wml")echo "</p></card>";
else echo "</div></body></html>";
if ($ver=="wml"){
echo "<card id=\"add\" title=\"Napisi\">";
echo "<p>";
echo $fsize1;
echo "Tekst:<br/>\n";
echo $fsize2;
echo "<input name=\"msg$ref\" maxlength=\"300\" title=\"Text\"/><br/>";
if ($row["level"]>=4){
echo $fsize1;
echo "Opcije:<br/>\n";
echo $fsize2;
echo "<select name=\"shrift\">\n";
echo "<option value=\"0\">Normalno</option>\n";
echo "<option value=\"1\">Iskoseno</option>\n";
}
if ($row["level"]>=4) {echo "<option value=\"2\">Podvuceno</option>\n";}
if ($row["level"]>=4) {echo "<option value=\"3\">Iskoseno/Podvuceno</option>\n";}
if ($row["level"]>=7) {echo "<option value=\"4\">Podebljano</option>\n";}
if ($row["level"]>=7) {echo "<option value=\"5\">Podebljano/Podvuceno</option>\n";}
if ($row["level"]>=7) {echo "<option value=\"6\">Veliko</option>\n";}
if ($row["level"]>=4) {echo "</select><br/>\n";}
echo $fsize1;
echo "<anchor title=\"send\">Napisi<go href=\"chat.php?$ses&amp;rm=$rm$takep\" method=\"post\">";
echo "<postfield name=\"msg\" value=\"$(msg$ref)\"/>";
echo "<postfield name=\"shrift\" value=\"$(shrift)\"/>\n";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
echo $fsize1;
echo $divide;
echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\">Chat Soba</a>";
echo $fsize2;
include("gzip.php");
echo "</p></card>";
echo "</wml>";
}
}else{
## &#1060;&#1072;&#1081;&#1083; &#1052;&#1072;&#1092;&#1080;&#1103;
## &#1052;&#1086;&#1076;&#1091;&#1083;&#1100; &#1079;&#1072;&#1076;&#1072;&#1105;&#1090; &#1080;&#1084;&#1103; &#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;&#1080; ##
$maf = @mysql_query ("Select user,id from users where id='5' LIMIT 1;");
$x = @mysql_fetch_array ($maf);
$mafiozi = $x["user"];
$mafid = $x["id"];
$rmafaction = "mafaction".$rm;
$rscores = "scores".$rm;
$ringame = "ingame".$rm;

## &#1042; &#1080;&#1075;&#1088;&#1077; &#1095;&#1077;&#1083;&#1086;&#1074;&#1077;&#1082; &#1080;&#1083;&#1080; &#1085;&#1077;&#1090;: ##
mysql_query ("select * from $ringame WHERE gamer_id = '".$id."'");
if (mysql_affected_rows()!=0) $gmes = 1;
else $gmes = 0;

## &#1055;&#1088;&#1086;&#1074;&#1077;&#1088;&#1082;&#1072;, &#1085;&#1072; &#1089;&#1074;&#1103;&#1079;&#1080; &#1083;&#1080; &#1095;&#1077;&#1083;&#1086;&#1074;&#1077;&#1082;: ##
$tm = time()-81800;
$tm111 = time()-81800;
$r = mysql_query ("select * from $ringame WHERE (onl<'".$tm."')");
if (mysql_affected_rows() != 0){
$mmsg = "";

while (($a = mysql_fetch_array($r))!==false){
$grole = get_role_by_id($a["id_in_game"], $rm);
$gname = get_name_by_id($a["id_in_game"], $rm);
$gid = $a["gamer_id"];
$mmsg = $mmsg."$grole $gname prekida igru (vreme za odgovor je isteklo)!";

## &#1042;&#1099;&#1095;&#1080;&#1090;&#1072;&#1077;&#1084; &#1086;&#1095;&#1082;&#1080;: ##
mysql_query("update users set creditsingame = creditsingame - 100 WHERE id = '".$gid."'");
$r = mysql_query("select creditsingame from users WHERE id = '".$gid."'");
$a = mysql_fetch_array($r);
$cring = $a["creditsingame"];
## &#1047;&#1072;&#1087;&#1080;&#1089;&#1099;&#1074;&#1072;&#1077;&#1084; &#1076;&#1083;&#1103; &#1076;&#1072;&#1083;&#1100;&#1085;&#1077;&#1081;&#1096;&#1077;&#1075;&#1086; &#1074;&#1099;&#1074;&#1086;&#1076;&#1072;, &#1082;&#1090;&#1086; &#1089;&#1082;&#1086;&#1083;&#1100;&#1082;&#1086; &#1086;&#1095;&#1082;&#1086;&#1074; &#1085;&#1072;&#1073;&#1088;&#1072;&#1083; ##
mysql_query("insert into $rscores set gamer_id = '".$gid."', score = '".$cring."'");
mysql_query("delete from $ringame WHERE gamer_id = '".$gid."'");
}
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$vktr = false;

$r = mysql_query("select count(*) as sm from $ringame");
$a = mysql_fetch_array($r);
$sm = $a["sm"];

mysql_query ("select * from $ringame WHERE role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;'");
if (mysql_affected_rows()==0&&$sm!=0){
$r = mysql_query ("select * from $ringame WHERE role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;'");
if (mysql_affected_rows()==0){
$vktr = true;
mysql_query ("update $rmafaction set action = 'nogame'");

$r = mysql_query("select role, gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$role = $a["role"];
$gamer_id = $a["gamer_id"];
if ($role == "&#1086;&#1073;&#1099;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;") mysql_query("update users set creditsingame = creditsingame + 100 WHERE id = '".$gamer_id."'");
else mysql_query("update users set creditsingame = creditsingame + 50 WHERE id = '".$gamer_id."'");
}
$mmsg = "Igra je zavrsena pobedom mirnih zitelja! Uloge su sledece: ";
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query ("delete from $ringame");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''"); mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}else{
$a = mysql_fetch_array($r);
$id_in_game = $a["id_in_game"];
$gamer_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$gamer_id."' LIMIT 1;"));
mysql_query ("update $ringame set role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;' WHERE id_in_game = '".$id_in_game."'");
$mmsg = "Vi ste glavni mafijas! Vas zadatak je da nadjete gradjane i ubijete ih! Nadjite ostale mafijase i dogovorite se sa njima, ukoliko ih ima u ovoj igri!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$gamer_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

if ($vktr!==true){

$r = mysql_query ("select count(*) as sm from $ringame");
$a = mysql_fetch_array($r);

if ($a["sm"]==2){
mysql_query("select * from $ringame WHERE (role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;')or(role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')");

if (mysql_affected_rows()==2) $vk = "maf";
if (mysql_affected_rows()==1){
mysql_query("select * from $ringame WHERE (role = '&#1076;&#1086;&#1082;&#1090;&#1086;&#1088;')or(role = '&#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088; &#1082;&#1072;&#1090;&#1072;&#1085;&#1080;')or(role = '&#1087;&#1091;&#1090;&#1072;&#1085;&#1072;')or(role = '&#1084;&#1072;&#1085;&#1100;&#1103;&#1082;')");
if (mysql_affected_rows() != 0) $vk = "ni4"; else $vk = "maf";
}
}
if ($a["sm"]==1){
mysql_query ("select * from $ringame WHERE (role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;')or(role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')");
if (mysql_affected_rows() != 0) $vk = "maf";
}
if ($a["sm"]==0) $vk = "ni4";

mysql_query("select * from $ringame");
$nm = round(mysql_affected_rows()/2-0.5);
$r = mysql_query("Select count(*) as sm from $ringame WHERE (role='&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')or(role='&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;')");
$a = mysql_fetch_array($r);
$sm = $a["sm"];
if ($sm>$nm) $vk = "maf";

if (isset($vk)){
$vktr = true;
if ($vk == "ni4"){
$vktr = true;
mysql_query ("update $rmafaction set action = 'nogame'");
$r = mysql_query("select gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gamer_id = $a["gamer_id"];
mysql_query("update users set creditsingame = creditsingame + 25 WHERE id = '".$gamer_id."'");
}
$mmsg = "Igra je zavrsena bez pobednika! Uloge su bile sledece: ";
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query ("delete from $ringame");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
if ($vk == "maf"){
$vktr = true;
mysql_query ("update $rmafaction set action = 'nogame'");
$r = mysql_query("select role, gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$role = $a["role"];
$gamer_id = $a["gamer_id"];
if ($role == "&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;"||$role == "&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;")
mysql_query("update users set creditsingame = creditsingame + 50 WHERE id = '".$gamer_id."'");
}
$mmsg = "Igra je zavrsena pobedom mafije! Uloge su bile sledece: ";
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query ("delete from $ringame");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}
}
}
$tm = time();
mysql_query ("update users set onl = '".$tm."' WHERE id = '".$id."'");
if ($gmes == 1) mysql_query ("update $ringame set onl = '".$tm."' WHERE gamer_id = '".$id."'");
$r = mysql_query ("select * from $rmafaction");
$a = mysql_fetch_array($r);
$action = $a["action"];
$nexttime = $a["nexttime"];

if (($action == "game_night"&&$tm>$nexttime)||($action == "dvote"&&$tm>$nexttime)){
$tm = time()+120;
mysql_query ("update $rmafaction set action = 'game_day', nexttime = '".$tm."', kiked = '0', cround = cround + 1");
$kiked = $a["kiked"];
if ($kiked==1) $mmsg = "Dolazi noc, svi zitelji spavaju, sem nekih...";
else $mmsg = "Dan je lepo prosao... Nista jos nije reseno! Dolazi noc...";

mysql_query("update $ringame set dvote = '0', wholin = '0'");

$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");

mysql_query("select gamer_id from $ringame WHERE role = '&#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088; &#1082;&#1072;&#1090;&#1072;&#1085;&#1080;'");
if(mysql_affected_rows()==0){
$r = mysql_query("select state from $ringame WHERE role = '&#1078;&#1077;&#1085;&#1072; &#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088;&#1072;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
if ($a["state"]==0) mysql_query ("update $ringame set state = '1' WHERE role = '&#1078;&#1077;&#1085;&#1072; &#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088;&#1072;'");
}
}

mysql_query("update $ringame set gamer_act = ''");
$r = mysql_query("select * from $ringame WHERE role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;'");
if (mysql_affected_rows()!=0){
while (($a = mysql_fetch_array($r))!==false){
$thg = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$thg."' LIMIT 1;"));
$re = mysql_query("select * from $ringame WHERE ((role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')or(role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;'))and(gamer_id != '".$thg."')");
$so = "";
while (($b = mysql_fetch_array($re))!==false){
$sname = get_name_by_id($b["id_in_game"], $rm);
if (get_role_by_id($b["id_in_game"], $rm)!="&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;") $so = $so."$sname, "; else $so = $so."$sname(glavni), ";
}
$so = substr($so,0,strlen($so)-2);
$mmsg = "Odgovor: $so";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$thg."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

$r = mysql_query("select * from $ringame WHERE role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;'");
$a = mysql_fetch_array($r);
$glmaf_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$glmaf_id."' LIMIT 1;"));
$mmsg = "Izaberite koga imenujete(!broj, na pwt Mafija Botu): ";
$r = mysql_query("select * from $ringame");
$kol = mysql_affected_rows();
for ($i=1;$i<=$kol;$i++){
$a = mysql_fetch_array($r);
$gamer_id = $a["gamer_id"];
$r2 = mysql_query ("select * from users where id = '".$gamer_id."'");
$b = mysql_fetch_array($r2);
$gname = $b["user"];
$id_in_game = $a["id_in_game"];
$s = $s."$id_in_game - $gname, ";
}
$mmsg = $mmsg.$s;
$mmsg = substr($mmsg,0,strlen($mmsg)-2);

$r = mysql_query ("select * from $ringame WHERE role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;'");
if (mysql_affected_rows()!=0){
$sg = "";
while (($a = mysql_fetch_array($r))!==false){
$sname = get_name_by_id($a["id_in_game"], $rm);
$sg = $sg."$sname, ";
}
$sg = substr($sg,0,strlen($sg)-2);
$mmsg = $mmsg."<br/>"."(vas odgovor: $sg)";
}

$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$glmaf_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");

$r = mysql_query("select * from $ringame WHERE role = '&#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088; &#1082;&#1072;&#1090;&#1072;&#1085;&#1080;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$kom_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$kom_id."' LIMIT 1;"));
$mmsg = "Izberite koga cete proveriti (!broj na pwt Mafija Botu) ili ubiti (!!broj): ".$s;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$kom_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

$r = mysql_query("select * from $ringame WHERE role = '&#1084;&#1072;&#1085;&#1100;&#1103;&#1082;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$man_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$man_id."' LIMIT 1;"));
$mmsg = "Ko moze biti zrtva manijaka? (!broj na pwt Mafija Botu): ".$s;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$man_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

$r = mysql_query("select * from $ringame WHERE role = '&#1087;&#1091;&#1090;&#1072;&#1085;&#1072;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$put_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$put_id."' LIMIT 1;"));
$mmsg = "Gde kurva ide danas? (!broj na pwt Mafija Botu): ".$s;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$put_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

$r = mysql_query("select * from $ringame WHERE role = '&#1073;&#1086;&#1084;&#1078;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$bomj_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$bomj_id."' LIMIT 1;"));
$mmsg = "Ko pretura po dzepovima? (!broj na pwt Mafija Botu): ".$s;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$bomj_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

$r = mysql_query("select * from $ringame WHERE role = '&#1076;&#1086;&#1082;&#1090;&#1086;&#1088;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$dok_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$dok_id."' LIMIT 1;"));
$mmsg = "Koga leci doktor? (!broj na pwt Mafija Botu): ".$s;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$dok_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

$r = mysql_query("select * from $ringame WHERE role = '&#1082;&#1083;&#1086;&#1091;&#1085;'");
$a = mysql_fetch_array($r);
$state = $a["state"];
if (mysql_affected_rows()!=0&&$state==0){
$kloun_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$kloun_id."' LIMIT 1;"));
$mmsg = "Ko menja mesta? (''!broj !broj'', na pwt Mafija Botu): ".$s;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$kloun_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

$r = mysql_query("select * from $ringame WHERE role = '&#1078;&#1077;&#1085;&#1072; &#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088;&#1072;'");
$a = mysql_fetch_array($r);
$state = $a["state"];
if (mysql_affected_rows()!=0&&$state==1){
$jena_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$jena_id."' LIMIT 1;"));
$mmsg = "Kome da se osveti zena inspektora? (!broj, na pwt Mafija Botu): ".$s;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$jena_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

if (($action=="game_day"&&$tm>$nexttime)||$action == "allvoted"){
$tm = time()+180;
mysql_query ("update $rmafaction set action = 'game_night', nexttime = '".$tm."'");
$kom_kil = 0;
$maf_kil = 0;
$man_kil = 0;
$jena_kil = 0;
$mmsg = "Taj dan je dosao. Da li ce svi ostati zivi da bi videli to?";
$r = mysql_query("select * from $ringame WHERE role = '&#1087;&#1091;&#1090;&#1072;&#1085;&#1072;'");
$a = mysql_fetch_array($r);
$put_act = 0;
$put_act = $a["gamer_act"];
$put_id = $a["gamer_id"];

$r = mysql_query("select * from $ringame WHERE role = '&#1075;&#1086;&#1088;&#1077;&#1094;'");
$a = mysql_fetch_array($r);
$gor_id_in_game = $a["id_in_game"];

if ($put_act != 0) mysql_query("update users set creditsingame = creditsingame + 5 WHERE id = '".$put_id."'");

$r = mysql_query("select * from $ringame WHERE role = '&#1076;&#1086;&#1082;&#1090;&#1086;&#1088;'");
$a = mysql_fetch_array($r);
$doknotact = false;
$dok_act = 0;
if ($put_act != $a["id_in_game"]) $dok_act = $a["gamer_act"];

$r = mysql_query("select * from $ringame WHERE role = '&#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088; &#1082;&#1072;&#1090;&#1072;&#1085;&#1080;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$kom_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$kom_id."' LIMIT 1;"));
if ($a["gamer_act"]!=""){
$wh = get_name_by_id($a["gamer_act"], $rm);
if ($put_act==$a["id_in_game"]) $mmsg = $mmsg." Inspektor je celu noc bio sa kurvom i nije uspeo da otkrije bandite!";
else if (strpos($a["gamer_act"],"!")===false){
mysql_query("update users set creditsingame = creditsingame + 5 WHERE id = '".$kom_id."'");
$mmsg = $mmsg." Inspektor je bio vredan i otkrio ko je $wh!";
if (get_role_by_id($a["gamer_act"], $rm)=="&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;"||get_role_by_id($a["gamer_act"], $rm)=="&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;")$tokom = "$wh - mafija";
else $tokom = "$wh - miran zitelj";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$tokom."', id='".$tm."', towhom='".$kom_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}else{
$a["gamer_act"] = str_replace("!","",$a["gamer_act"]);
$wh = get_name_by_id($a["gamer_act"], $rm);
$kto = role_to_rpadej(get_role_by_id($a["gamer_act"], $rm));
if ($gor_id_in_game!=$a["gamer_act"]){
if ($a["gamer_act"] != $dok_act){
if (get_role_by_id($a["gamer_act"], $rm)=="&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;"||get_role_by_id($a["gamer_act"], $rm)=="&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;") {$mmsg = $mmsg." Nakon slozene operacije Inspektor je ubio $kto $wh!!!"; mysql_query("update users set creditsingame = creditsingame + 20 WHERE id = '".$kom_id."'");}
else {$mmsg = $mmsg." Inspektor je pogresio i stradali su neduzni $kto $wh!"; mysql_query("update users set creditsingame = creditsingame - 20 WHERE id = '".$kom_id."'");}
$kom_kil = $a["gamer_act"];
}else {
$mmsg = $mmsg." Inspektor je skoro ubio $wh, ali ga je doktor oziveo!";
$doknotact = true;
}
}else {
$mmsg = $mmsg." Inspektor je celu noc pucao i bio poprilicno iznenadjen!";
}                                                                                                                                      }
}
}

$r = mysql_query("select * from $ringame WHERE role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;'");
$a = mysql_fetch_array($r);
$maf_id = $a["gamer_id"];
if ($a["gamer_act"]!=""){
$wh = get_name_by_id($a["gamer_act"], $rm);
if ($put_act==$a["id_in_game"]) $mmsg = $mmsg." Kurva je celu noc provela sa glavnim u mafijaskom sklonistu i zagovarala Glavnog Mafijasa!";
else{
if ($gor_id_in_game != $a["gamer_act"]){
mysql_query("update users set creditsingame = creditsingame + 10 WHERE id = '".$maf_id."'");
$kto = role_to_tpadej(get_role_by_id($a["gamer_act"], $rm));
if ($dok_act != $a["gamer_act"]){
$mmsg = $mmsg." Mafija je brutalno ubila $kto $wh!";
$maf_kil = $a["gamer_act"];
}else{
$mmsg = $mmsg." Mafija je skoro ubila $wh, ali ga je doktor oziveo!";
$doknotact = true;
}
}else{
$mmsg = $mmsg." Mafija se nocima skriva po planinama!";
}
}
}

$r = mysql_query("select * from $ringame WHERE role = '&#1084;&#1072;&#1085;&#1100;&#1103;&#1082;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$man_id = $a["gamer_id"];
$man_act = $a["gamer_act"];
if ($a["gamer_act"]!=""){
$wh = get_name_by_id($a["gamer_act"], $rm);
if ($put_act==$a["id_in_game"]) $mmsg = $mmsg." Manijak je pokusao podmetnuti crevo, ali ga je kurva zagovorila i...";
else{
$kto = get_role_by_id($a["gamer_act"], $rm);
if ($dok_act != $a["gamer_act"]){
mysql_query("select * from $ringame WHERE (id_in_game = '".$man_act."')and((role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')or(role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;'))");
if (mysql_affected_rows()!=0) mysql_query("update users set creditsingame = creditsingame + 20 WHERE id = '".$man_id."'");
else mysql_query("update users set creditsingame = creditsingame - 5 WHERE id = '".$man_id."'");
$mmsg = $mmsg." $kto $wh nadjen je u smecu sa sekirom! Manijak je uvek tu...";
$man_kil = $a["gamer_act"];
}else{
$mmsg = $mmsg." Manijak je stavio sekiru u korpu $wh, operacija je bila uspesna i izvukao se!";
$doknotact = true;
}
}
}
}

$r = mysql_query("select * from $ringame WHERE role = '&#1073;&#1086;&#1084;&#1078;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$bomj_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$bomj_id."' LIMIT 1;"));
if ($a["gamer_act"]!=""){
$wh = get_name_by_id($a["gamer_act"], $rm);
if ($put_act==$a["id_in_game"]) $mmsg = $mmsg." Skitnica je pucao i sakrio se u podrumu...";
else{
mysql_query("update users set creditsingame = creditsingame + 5 WHERE id = '".$bomj_id."'");
$mmsg = $mmsg." Skitnice su u akciji i preturaju po dzepovima $wh!";
$kto = get_role_by_id($a["gamer_act"], $rm);
$mmsgtob = "$wh to $kto!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsgtob."', id='".$tm."', towhom='".$bomj_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}
}

$r = mysql_query("select * from $ringame WHERE role = '&#1078;&#1077;&#1085;&#1072; &#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088;&#1072;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$jena_id = $a["gamer_id"];
$state = $a["state"];
if ($a["gamer_act"]!=""){
$wh = get_name_by_id($a["gamer_act"], $rm);
if ($put_act==$a["id_in_game"]) $mmsg = $mmsg." Kurva je otisla zbunjena do zene inspektora!";
else{
if ($gor_id_in_game != $a["gamer_act"]){
mysql_query("update users set creditsingame = creditsingame + 50 WHERE id = '".$jena_id."'");
$kto = role_to_rpadej(get_role_by_id($a["gamer_act"], $rm));
if ($dok_act != $a["gamer_act"]){
$mmsg = $mmsg." Zena inspektora je ubila $kto $wh! Osveta za muza!";
$jena_kil = $a["gamer_act"];
}else{
$mmsg = $mmsg." Zena inspektora je zamalo ubila $wh, ali sve je dobro za sada!";
$doknotact = true;
}
}else{
$mmsg = $mmsg." Zena inspektora je napravila gresku! Sakrila je noz...";
}
}
}
}

$r = mysql_query("select * from $ringame WHERE role = '&#1076;&#1086;&#1082;&#1090;&#1086;&#1088;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$dok_id = $a["gamer_id"];
if ($doknoact==true) mysql_query("update users set creditsingame = creditsingame + 20 WHERE id = '".$dok_id."'");
else if ($put_act!=$a["id_in_game"]) mysql_query("update users set creditsingame = creditsingame + 5 WHERE id = '".$dok_id."'");

if ($a["gamer_act"]!=""&&$doknotact===false){
$wh = get_name_by_id($a["gamer_act"], $rm);
if ($put_act==$a["id_in_game"]) $mmsg = $mmsg." Doktor je celu noc proveo sa kurvom i nikome nije dao lek!";
else{
if ($a["gamer_id"]==$a["gamer_act"]) $mmsg = $mmsg." Doktor je lecio sam sebe!";
else $mmsg = $mmsg." Doktor daje drogu $wh!";
}
}
}

$r = mysql_query("select * from $ringame WHERE role = '&#1082;&#1083;&#1086;&#1091;&#1085;'");
if (mysql_affected_rows()!=0){
$a = mysql_fetch_array($r);
$state = $a["state"];
$kloun_id = $a["gamer_id"];
if ($a["gamer_act"]!=""){
list($g1,$g2) = explode (" ",$a["gamer_act"]);
mysql_query("select gamer_id from $ringame WHERE (id_in_game = '".$g1."')or(id_in_game = '".$g2."')");
if (mysql_affected_rows()==2){
$r = mysql_query("select gamer_id, role, state from $ringame WHERE id_in_game = '".$g1."'");
$b = mysql_fetch_array($r);
$gid1 = $b["gamer_id"];
$igrok1 = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$gid1."' LIMIT 1;"));
$role1 = $b["role"];
$state1 = $b["state"];
$r = mysql_query("select gamer_id, role, state from $ringame WHERE id_in_game = '".$g2."'");
$b = mysql_fetch_array($r);
$gid2 = $b["gamer_id"];
$igrok2 = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$gid2."' LIMIT 1;"));
$role2 = $b["role"];
$state2 = $b["state"];
$mmsg1 = "Vasa nova uloga: $role2!";
$mmsg2 = "Vasa nova uloga: $role1!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg1."', id='".$tm."', towhom='".$gid1."', gamemes='1', komu='".$igrok1[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg2."', id='".$tm."', towhom='".$gid2."', gamemes='1', komu='".$igrok2[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
mysql_query("update $ringame set role = '".$role2."', state = '".$state2."' WHERE id_in_game = '".$g1."'");
mysql_query("update $ringame set role = '".$role1."', state = '".$state1."' WHERE id_in_game = '".$g2."'");
$mmsg = $mmsg." Klovn je stigao i promenio uloge nekima!!!";
$r = mysql_query("select cround from $rmafaction");
$a = mysql_fetch_array($r);
$sc = $a["cround"]*30;
mysql_query("update users set creditsingame = creditsingame + '".$sc."' WHERE id = '".$kloun_id."'");
mysql_query("update $ringame set state = '1' WHERE role = '&#1082;&#1083;&#1086;&#1091;&#1085;'");
}
}
}

$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE ((id_in_game = '".$kom_kil."')or(id_in_game = '".$maf_kil."')or(id_in_game = '".$man_kil."')or(id_in_game = '".$jena_kil."'))and(users.id = $ringame.gamer_id)");
mysql_query ("delete from $ringame WHERE (id_in_game = '".$kom_kil."')or(id_in_game = '".$maf_kil."')or(id_in_game = '".$man_kil."')or(id_in_game='".$jena_kil."')");
$vktr = false;
$r = mysql_query("select count(*) as sm from $ringame");
$a = mysql_fetch_array($r);
$sm = $a["sm"];
$r = mysql_query("select current,prev,prevprev from $rmafaction");
$a = mysql_fetch_array($r);
$current = $a["current"];
$prev = $a["prev"];
## $prevprev = $a["prevprev"];
$prevprev = $prev;
$prev = $current;
$current = $sm;
mysql_query("update $rmafaction set prevprev = '".$prevprev."', prev = '".$prev."', current = '".$current."'");
if ($current == $prevprev){

mysql_query ("update $rmafaction set action = 'nogame'");
$vktr = true;
$mmsg = "Dva kruga niko nije umro! Mirni zitelji slave... Uloge su bile: ";
$r = mysql_query("select gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gamer_id = $a["gamer_id"];
mysql_query("update users set creditsingame = creditsingame + 25 WHERE id = '".$gamer_id."'");
}
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query("delete from $ringame");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''"); mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
mysql_query ("select * from $ringame WHERE role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;'");
if (mysql_affected_rows()==0&&$sm!=0&&$vktr!==true){
$r = mysql_query ("select * from $ringame WHERE role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;'");
if (mysql_affected_rows()==0){
$vktr = true;
mysql_query ("update $rmafaction set action = 'nogame'");
$r = mysql_query("select role, gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$role = $a["role"];
$gamer_id = $a["gamer_id"];
if ($role == "&#1086;&#1073;&#1099;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;") mysql_query("update users set creditsingame = creditsingame + 100 WHERE id = '".$gamer_id."'");
else mysql_query("update users set creditsingame = creditsingame + 50 WHERE id = '".$gamer_id."'");
}
$mmsg = "Igra je zavrsena pobedom mirnih zitelja! Uloge su bile sledece: ";
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query ("delete from $ringame");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}else{
$a = mysql_fetch_array($r);
$id_in_game = $a["id_in_game"];
$gamer_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$gamer_id."' LIMIT 1;"));
mysql_query ("update $ringame set role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;' WHERE id_in_game = '".$id_in_game."'");
$mmsg = "Sada ste glavni u mafiji!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$gamer_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

if ($vktr!==true){
$r = mysql_query ("select count(*) as sm from $ringame");
$a = mysql_fetch_array($r);

if ($a["sm"]==2){
mysql_query("select * from $ringame WHERE (role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;')or(role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')");

if (mysql_affected_rows()==2) $vk = "maf";
if (mysql_affected_rows()==1){
mysql_query("select * from $ringame WHERE (role = '&#1076;&#1086;&#1082;&#1090;&#1086;&#1088;')or(role = '&#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088; &#1082;&#1072;&#1090;&#1072;&#1085;&#1080;')or(role = '&#1087;&#1091;&#1090;&#1072;&#1085;&#1072;')or(role = '&#1084;&#1072;&#1085;&#1100;&#1103;&#1082;')");
if (mysql_affected_rows() != 0) $vk = "ni4";
else $vk = "maf";
}
}
if ($a["sm"]==1){
mysql_query ("select * from $ringame WHERE (role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;')or(role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')");
if (mysql_affected_rows() != 0) $vk = "maf";
}
if ($a["sm"]==0) $vk = "ni4";
mysql_query("select * from $ringame");
$nm = round(mysql_affected_rows()/2-0.5);
$r = mysql_query("Select count(*) as sm from $ringame WHERE (role='&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')or(role='&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;')");
$a = mysql_fetch_array($r);
$sm = $a["sm"];
if ($sm>$nm) $vk = "maf";

if (isset($vk)){
$vktr = true;
if ($vk == "ni4"){
$vktr = true;
mysql_query ("update $rmafaction set action = 'nogame'");

$r = mysql_query("select gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gamer_id = $a["gamer_id"];
mysql_query("update users set creditsingame = creditsingame + 25 WHERE id = '".$gamer_id."'");
}
$mmsg = "Igra je zavrsena bez pobednika! Uloge su bile: ";
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query ("delete from $ringame");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

if ($vk == "maf"){
$vktr = true;
mysql_query ("update $rmafaction set action = 'nogame'");
$r = mysql_query("select role, gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$role = $a["role"];
$gamer_id = $a["gamer_id"];
if ($role == "&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;"||$role == "&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;") mysql_query("update users set creditsingame = creditsingame + 50 WHERE id = '".$gamer_id."'");
}

$mmsg = "Igra je zavrsena pobedom mafije! Uloge su bile sledece: ";
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query ("delete from $ringame");

$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}
}

mysql_query ("update $ringame set gamer_act=''");
if ($vktr===false){
$mmsg = "Koga lecim danas posle podne? Dan traje 3 minuta! Glasajte(!broj)... ";
$r = mysql_query("select * from $ringame");
$kol = mysql_affected_rows();
for ($i=1;$i<=$kol;$i++){
$a = mysql_fetch_array($r);
$gamer_id = $a["gamer_id"];
$r2 = mysql_query ("select * from users where id = '".$gamer_id."'");
$b = mysql_fetch_array($r2);
$gname = $b["user"];
$id_in_game = $a["id_in_game"];
$s = $s."<b>$id_in_game</b> - $gname, ";
}
$mmsg = $mmsg.$s;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

if ($action=="registration"&&$tm>$nexttime){
mysql_query("select * from $ringame");
if (mysql_affected_rows()<3){
mysql_query ("update $rmafaction set action = 'nogame'");
$mmsg = "Igra nije pocela! Potrebna su najmanje 3 igraca!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
mysql_query ("delete from $ringame");
}else{
mysql_query("delete from $rscores");
$tm = time()+25;
mysql_query ("update $rmafaction set action = 'game_night', nexttime = '".$tm."', kiked = '1', cround = '0'");
$r = mysql_query ("select * from $ringame");
$roles = array("&#1086;&#1073;&#1099;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;","&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;","&#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088; &#1082;&#1072;&#1090;&#1072;&#1085;&#1080;");
if (mysql_affected_rows()>3) array_push ($roles,"&#1076;&#1086;&#1082;&#1090;&#1086;&#1088;");
if (mysql_affected_rows()>4) array_push ($roles,"&#1086;&#1073;&#1099;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;");
if (mysql_affected_rows()>5) array_push ($roles,"&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;");
if (mysql_affected_rows()>6) array_push ($roles,"&#1084;&#1072;&#1085;&#1100;&#1103;&#1082;");
if (mysql_affected_rows()>7) array_push ($roles,"&#1087;&#1091;&#1090;&#1072;&#1085;&#1072;");
if (mysql_affected_rows()>8) array_push ($roles,"&#1086;&#1073;&#1099;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;");
if (mysql_affected_rows()>9) array_push ($roles,"&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;");
if (mysql_affected_rows()>10) array_push ($roles,"&#1073;&#1086;&#1084;&#1078;");
if (mysql_affected_rows()>11) array_push ($roles,"&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;");
if (mysql_affected_rows()>12) array_push ($roles,"&#1075;&#1086;&#1088;&#1077;&#1094;");
if (mysql_affected_rows()>13) array_push ($roles,"&#1082;&#1083;&#1086;&#1091;&#1085;");
if (mysql_affected_rows()>14) array_push ($roles,"&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;");
if (mysql_affected_rows()>15) array_push ($roles,"&#1078;&#1077;&#1085;&#1072; &#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088;&#1072;");

for ($i=1;$i<=((mysql_affected_rows()-15)/3);$i++) array_push ($roles,"&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;");
$j = count ($roles);
for ($i=1;$i<=mysql_affected_rows()-$j;$i++) array_push ($roles,"&#1086;&#1073;&#1099;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;");

mt_srand(time()*100000);
shuffle($roles);
$i = 0;
while (($a = mysql_fetch_array($r))!==false){
$gamer_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$gamer_id."' LIMIT 1;"));
mysql_query("update users set creditsingame = '0' WHERE id = '".$gamer_id."'");
$id_in_game = $i+1;
$role = $roles[$i];
$mmsg = "&#1042;&#1099; $role!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$gamer_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");

mysql_query("update $ringame set role = '".$role."', id_in_game = '".$id_in_game."' WHERE gamer_id = '".$gamer_id."'");
$i++;
}
$mmsg = "Uloge su podeljene! Noc pocinje za 20 sekundi!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
mysql_query ("update $rmafaction set prevprev = '199', prev = '199', current = '200'");
}
}

$smthwr = 0;
$res = mysql_query ("Select * from $room order by id desc LIMIT 100");
$kol = mysql_affected_rows();
if($ver=="xhtml"){
$msg=$_POST["$ssseee"];
}
if(@$msg){
$msg = trim(" $msg ");
$msg = ereg_replace(" +"," ",$msg);
$msg = substr($msg,0,400);
$msg = str_replace("", " ", $msg);
$msg = str_replace("$", "$$", $msg);
$msg = strtr($msg,array(chr("0")=>"",chr("1")=>"",chr("2")=>"",chr("3")=>"",chr("4")=>"",chr("5")=>"",chr("6")=>"",chr("7")=>"",chr("8")=>"",chr("9")=>"",chr("10")=>"",chr("11")=>"",chr("12")=>"",chr("13")=>"",chr("14")=>"",chr("15")=>"",chr("16")=>"",chr("17")=>"",chr("18")=>"",chr("19")=>"",chr("20")=>"",chr("21")=>"",chr("22")=>"",chr("23")=>"",chr("24")=>"",chr("25")=>"",chr("26")=>"",chr("27")=>"",chr("28")=>"",chr("29")=>"",chr("30")=>"",chr("31")=>""));
//$msg = str_replace("&#1082;","&#1057;?",$msg);
$msg = htmlspecialchars($msg);
$msg = str_replace("\"", "&quot;", $msg);
$msg = str_replace("|", "&#0166;", $msg);
$msg = str_replace("'", "&#8216;", $msg);
$msg = str_replace("\\", "", $msg);
$msg = addslashes($msg);

if (!isset($prvt)) $prvt = 0;

$str1="";
$str2=$msg;

if ($prvt == 0) $towhom = "";
if (!isset($towhom)) $towhom = "";

if ($row["level"]<5) {require("antirekl.php");}

//require("smile.php");
//unset($smiles);
//unset($replaces);
if(($row["translit"]==0)&&($row["level"]>6)) {
$msg = eregi_replace("((http://))((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z;]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((/|\?)[a-z0-9~#%&'_\+=:;\?\.-]*)*)", "<a href=\"\\0\">\\3</a>", $msg);
}

$msg = $str1.$msg;
if ($msg_wosm!="") $msg_wosm = $str1.$msg_wosm;
if ($msg_woasm!="") $msg_woasm = $str1.$msg_woasm;
$komu = check($komu);
if(!empty($shrift)){
if (($row["level"]>=4) && ($shrift==1)) $msg = '<i>'.$msg.'</i>';
else if (($row["level"]>=5) && ($shrift==2)) $msg = '<u>'.$msg.'</u>';
else if (($row["level"]>=6) && ($shrift==3)) $msg = '<i><u>'.$msg.'</u></i>';
else if (($row["level"]>=6) && ($shrift==4)) $msg = '<b>'.$msg.'</b>';
else if (($row["level"]>=7) && ($shrift==5)) $msg = '<u><b>'.$msg.'</b></u>';
else if (($row["level"]>=7) && ($shrift==6)) $msg = '<i><u><b>'.$msg.'</b></u></i>';
}

$r = mysql_query("SELECT * FROM $room WHERE usid = '".$id."' order by id desc LIMIT 1");
$a = mysql_fetch_array($r);
if ($a["message"] !== $msg)
{
$time = getmicrotime();
$today=date ("H:i");
$posts =  $row["posts"];
$posts++;
if($ver=="wml") mysql_query ("Update users set posts='".$posts."', onl='".$time."', room='".$rm."', version='1' where id ='".$id."'");
else mysql_query ("Update users set posts='".$posts."', onl='".$time."', room='".$rm."', version='2' where id ='".$id."'");
$hid = $row["inv"];
$kol++;
$rnd = rand(0,99999999);

$msg = $nastr.$msg;
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$us."', message='".$msg."', messagewosm = '".$msg_wosm."', messagewoasm = '".$msg_woasm."', id='".$time."', towhom='".$towhom."', hid='".$hid."', usid='".$id."', gamemes = '".$gmes."', komu='".$komu."'");
$usmes["komu"] = $komu;
$usmes["time"] = $today;
$usmes["who"] = $us;
$usmes["usid"] = $id;
$usmes["message"] = $msg;
$usmes["messagewosm"] = $msg_wosm;
$usmes["messagewoasm"] = $msg_woasm;
$usmes["id"] = $time;
$usmes["towhom"] = $towhom;
$usmes["gamemes"] = $gmes;
$smthwr = 1;

$r = mysql_query ("select * from $rmafaction");
$a = mysql_fetch_array($r);
$action = $a["action"];

if ($action == "game_night"&&$gmes==1){
$s = str_replace("!","",$msg);
$r = mysql_query("select * from $ringame WHERE id_in_game = '".$s."'");
if (mysql_affected_rows()!==0){
$a = mysql_fetch_array($r);
$id_in_game = $a["id_in_game"];
mysql_query ("update $ringame set gamer_act = '".$s."' WHERE gamer_id = '".$id."'");
$wh = get_name_by_id($id_in_game, $rm);

mysql_query("select * from $ringame WHERE gamer_act = '".$s."'");
$sm = mysql_affected_rows();
$mmsg = "$us, Vi glasate za $wh!(<b>$sm</b>)";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

mysql_query ("select * from $ringame");
$nm = round(mysql_affected_rows()/3);
$r = mysql_query ("select *,count(gamer_act) from $ringame WHERE gamer_act != '' group by gamer_act having count(gamer_act)>'".$nm."'");
$a = mysql_fetch_array($r);
if (mysql_affected_rows() != 0){
$w = $a["gamer_act"];
mysql_query ("update $rmafaction set action = 'dvote'");
mysql_query ("update $ringame set dvote = '1' WHERE id_in_game = '".$w."'");
$whk = get_name_by_id($w, $rm);
$mmsg = "Sigurni ste da hocete da kaznite $whk?(!da ili !ne) $whk, jos ima vremena.";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

if ($gmes==1&&$action == "dvote"&&($msg == "!da"||$msg == "!ne"||$msg == "!&#1076;&#1072;"||$msg == "!&#1085;&#1077;&#1090;")){
$r = mysql_query("select * from $ringame WHERE dvote = '1'");
$a = mysql_fetch_array($r);
$w = $a["id_in_game"];
$whk = get_name_by_id($w, $rm);
if ($msg=="!da"||$msg == "!&#1076;&#1072;"){
mysql_query("update $ringame set wholin = '1' WHERE gamer_id = '".$id."'");
$mmsg = "$us glasao za kaznu $whk!";
}else{
mysql_query("update $ringame set wholin = '-1' WHERE gamer_id = '".$id."'");
$mmsg = "$us glasao protiv kazne $whk!";
}
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
mysql_query ("select * from $ringame");
$nm = round(mysql_affected_rows()/2-0.5);

mysql_query("select * from $ringame WHERE wholin = '1'");
if (mysql_affected_rows()>$nm){
$tm = time();
mysql_query("update $rmafaction set action = 'game_night', nexttime = '".$tm."', kiked = '1'");
$krole = get_role_by_id($w, $rm);
if ($krole=="&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;"||$krole=="&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;"){
$krole = role_to_tpadej($krole);
$mmsg = "Konacno je stradao miran zitelj $krole $whk!!!";
}else{
$krole = role_to_rpadej($krole);
$mmsg = "Narod ima pretezak zadatak, koji ne odgovara $krole $whk!";
}
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE (users.id = $ringame.gamer_id)and(id_in_game = '".$w."')");
mysql_query ("delete from $ringame WHERE id_in_game = '".$w."'");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$vktr = false;

$r = mysql_query("select count(*) as sm from $ringame");
$a = mysql_fetch_array($r);
$sm = $a["sm"];

mysql_query ("select * from $ringame WHERE role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;'");
if (mysql_affected_rows()==0&&$sm!=0){
$r = mysql_query ("select * from $ringame WHERE role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;'");
if (mysql_affected_rows()==0){
$vktr = true;
mysql_query ("update $rmafaction set action = 'nogame'");
$r = mysql_query("select role, gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$role = $a["role"];
$gamer_id = $a["gamer_id"];
if ($role == "&#1086;&#1073;&#1099;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;") mysql_query("update users set creditsingame = creditsingame + 100 WHERE id = '".$gamer_id."'");
else mysql_query("update users set creditsingame = creditsingame + 50 WHERE id = '".$gamer_id."'");
}
$mmsg = "Igra je zavrsen pobedom mirnih zitelja! Uloge su bile: ";
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query ("delete from $ringame");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}else{
$a = mysql_fetch_array($r);
$id_in_game = $a["id_in_game"];
$gamer_id = $a["gamer_id"];
$igrok = @mysql_fetch_array(@mysql_query ("Select user from users where id='".$gamer_id."' LIMIT 1;"));
mysql_query ("update $ringame set role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;' WHERE id_in_game = '".$id_in_game."'");
$mmsg = "Sada ste glavni u mafiji!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$gamer_id."', gamemes='1', komu='".$igrok[0]."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

if ($vktr!==true){
$r = mysql_query ("select count(*) as sm from $ringame");
$a = mysql_fetch_array($r);

if ($a["sm"]==2){
mysql_query("select * from $ringame WHERE (role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;')or(role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')");
if (mysql_affected_rows()==2) $vk = "maf";
if (mysql_affected_rows()==1){
mysql_query("select * from $ringame WHERE (role = '&#1076;&#1086;&#1082;&#1090;&#1086;&#1088;')or(role = '&#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088; &#1082;&#1072;&#1090;&#1072;&#1085;&#1080;')or(role = '&#1087;&#1091;&#1090;&#1072;&#1085;&#1072;')or(role = '&#1084;&#1072;&#1085;&#1100;&#1103;&#1082;')");
if (mysql_affected_rows() != 0) $vk = "ni4";
else $vk = "maf";
}
}
if ($a["sm"]==1){
mysql_query ("select * from $ringame WHERE (role = '&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;')or(role = '&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')");
if (mysql_affected_rows() != 0) $vk = "maf";
}
if ($a["sm"]==0) $vk = "ni4";

mysql_query("select * from $ringame");
$nm = round(mysql_affected_rows()/2-0.5);
$r = mysql_query("Select count(*) as sm from $ringame WHERE (role='&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;')or(role='&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;')");
$a = mysql_fetch_array($r);
$sm = $a["sm"];
if ($sm>$nm) $vk = "maf";

if (isset($vk)){
if ($vk == "ni4"){
$vktr = true;
mysql_query ("update $rmafaction set action = 'nogame'");
$r = mysql_query("select gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gamer_id = $a["gamer_id"];
mysql_query("update users set creditsingame = creditsingame + 25 WHERE id = '".$gamer_id."'");
}
$mmsg = "Igra je zavrsena bez pobednika! Uloge su bile sledece: ";
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query ("delete from $ringame");
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
if ($vk == "maf"){
$vktr = true;
mysql_query ("update $rmafaction set action = 'nogame'");
$r = mysql_query("select role, gamer_id from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$role = $a["role"];
$gamer_id = $a["gamer_id"];
if ($role == "&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;"||$role == "&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;") mysql_query("update users set creditsingame = creditsingame + 50 WHERE id = '".$gamer_id."'");
}
$mmsg = "Igra je zavrsena pobedom mafije! Uloge su bile sledece: ";
$r = mysql_query("Select * from $ringame");
while (($a = mysql_fetch_array($r))!==false){
$gnick = get_name_by_id($a["id_in_game"], $rm);
$grole = get_role_by_id($a["id_in_game"], $rm);
$mmsg = $mmsg."<b>$gnick</b> - $grole, ";
}
$mmsg = substr($mmsg,0,strlen($mmsg)-2);
mysql_query("insert into $rscores select gamer_id, creditsingame from $ringame, users WHERE users.id = $ringame.gamer_id");
mysql_query ("delete from $ringame");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$mmsg = "Poeni za ovu igru: ";
$mmes = scores($rm);
$mmsg = $mmsg.$mmes;
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}
}
}

mysql_query("select * from $ringame WHERE wholin = '-1'");
if (mysql_affected_rows()>$nm){
mysql_query("update $rmafaction set action = 'game_night'");
mysql_query("update $ringame set dvote = '0', wholin = '0', gamer_act = ''");
$mmsg = "$whk opravdan!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid = '".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

if ($gmes==1&&$action == "game_day"&&$towhom == "".$mafid.""){
$r = mysql_query("select * from $ringame WHERE gamer_id = '".$id."'");
$a = mysql_fetch_array($r);
$role = $a ["role"];
$gamer_act = $a["gamer_act"];
$state = $a["state"];
if ($role!="&#1086;&#1073;&#1099;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;"&&$role!="&#1084;&#1072;&#1092;&#1080;&#1086;&#1079;&#1080;"&&$role!="&#1082;&#1083;&#1086;&#1091;&#1085;"&&$role!="&#1078;&#1077;&#1085;&#1072; &#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088;&#1072;"){
$s = str_replace("!","",$msg);
$r2 = mysql_query ("select * from $ringame WHERE id_in_game = '".$s."'");
if (mysql_affected_rows()==0){
$mmsg = "Zasto ste napisali za mene!?!?";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$id."', gamemes='1', komu='".$us."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}else{
if ($gamer_act==""){
$b = mysql_fetch_array($r2);
$hid = $b["gamer_id"];
$r3 = mysql_query("select * from users WHERE id = '".$hid."'");
$c = mysql_fetch_array($r3);
$gname = $c ["user"];
unset ($c);
unset ($r3);
if ($role == "&#1075;&#1083;&#1072;&#1074;&#1072;&#1088;&#1100; &#1084;&#1072;&#1092;&#1080;&#1080;") {
$mmsg = "Naruceno ubistvo za $gname je prihvaceno!";
$rnd = rand(1,3);
$re = mysql_query("select night_act from mafia WHERE klu4 = '".$rnd."'");
$b = mysql_fetch_array($re);
$mmsg1=$b["night_act"];
}
if ($role == "&#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088; &#1082;&#1072;&#1090;&#1072;&#1085;&#1080;"&&strpos($msg,"!!")!==false) {
$mmsg = "Naruceno ubistvo za $gname je prihvaceno!";
$s="!".$s;
$rnd = rand(1,3);
$re = mysql_query("select night_act from komissar WHERE klu4 = '".$rnd."'");
$b = mysql_fetch_array($re);
$mmsg1=$b["night_act"];
}
if ($role == "&#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088; &#1082;&#1072;&#1090;&#1072;&#1085;&#1080;"&&strpos($msg,"!!")===false) {
$mmsg = "Sastanak sa $gname je prihvacen!";
$rnd = rand(1,3);
$re = mysql_query("select night_act from komissar WHERE klu4 = '".$rnd."'");
$b = mysql_fetch_array($re);
$mmsg1=$b["night_act"];
}
if ($role == "&#1076;&#1086;&#1082;&#1090;&#1086;&#1088;") {
$mmsg = "Preihvacen je sertifikat koji ima $gname!";
$rnd = rand(1,3);
$re = mysql_query("select night_act from doktor WHERE klu4 = '".$rnd."'");
$b = mysql_fetch_array($re);
$mmsg1=$b["night_act"];
}
if ($role == "&#1084;&#1072;&#1085;&#1100;&#1103;&#1082;") {
$mmsg = "Nasilje vrsi $gname =)";
$rnd = rand(1,3);
$re = mysql_query("select night_act from maniac WHERE klu4 = '".$rnd."'");
$b = mysql_fetch_array($re);
$mmsg1=$b["night_act"];
}
if ($role == "&#1087;&#1091;&#1090;&#1072;&#1085;&#1072;") {
$mmsg = "$gname ce biti zauzeta veceras!";
$rnd = rand(1,3);
$re = mysql_query("select night_act from wluha WHERE klu4 = '".$rnd."'");
$b = mysql_fetch_array($re);
$mmsg1=$b["night_act"];
}
if ($role == "&#1073;&#1086;&#1084;&#1078;") {
$mmsg = "Kopanje po dzepovima $gname!";
$rnd = rand(1,3);
$re = mysql_query("select night_act from bomj WHERE klu4 = '".$rnd."'");
$b = mysql_fetch_array($re);
$mmsg1=$b["night_act"];
}
mysql_query ("update $ringame set gamer_act='".$s."' WHERE gamer_id = '".$id."'");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$id."', gamemes='1', komu='".$us."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");

$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg1."', id='".$tm."', towhom='', gamemes='1'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}else {
$mmsg = "Odabrali ste zrtvu!!!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$id."', gamemes='1', komu='".$us."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

}else if ($role=="&#1082;&#1083;&#1086;&#1091;&#1085;"&&$state==0){
$s = str_replace("!","",$msg);
list($g1,$g2) = explode(" ",$s);
mysql_query("select gamer_id from $ringame WHERE (id_in_game='".$g1."')or(id_in_game='".$g2."')");
if (mysql_affected_rows()==2){
mysql_query("update $ringame set gamer_act='".$s."' WHERE gamer_id = '".$id."'");
$r = mysql_query("select id_in_game from $ringame WHERE id_in_game = '".$g1."'");
$a = mysql_fetch_array($r);
$gn1 = get_name_by_id($a["id_in_game"], $rm);
$r = mysql_query("select id_in_game from $ringame WHERE id_in_game = '".$g2."'");
$a = mysql_fetch_array($r);
$gn2 = get_name_by_id($a["id_in_game"], $rm);
$mmsg = "$gn1 i $gn2 su promenili uloge!";
$mmsg1 = "Klovn luta nocu i zbunjuje sve ostale...";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$id."', gamemes='1', komu='".$us."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg1."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}else{
$mmsg = "Zasto ste napisali za mene!?!?!?";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$id."', gamemes='1', komu='".$us."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

}else if ($role=="&#1078;&#1077;&#1085;&#1072; &#1082;&#1086;&#1084;&#1080;&#1089;&#1089;&#1072;&#1088;&#1072;"&&$state==1){
$s = str_replace("!","",$msg);
$r = mysql_query("select * from $ringame WHERE id_in_game = '".$s."'");
if (mysql_affected_rows()!=0){
mysql_query("update $ringame set state = '2', gamer_act = '".$s."' WHERE gamer_id = '".$id."'");
$a = mysql_fetch_array($r);
$gn = get_name_by_id($a["id_in_game"], $rm);
$mmsg = "$gn ce platiti za smrt inspektora!";
$mmsg1 = "Zena inspektora ostavlja otkljucanu kucu kako bi opravdala smrt muza...";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$id."', gamemes='1', komu='".$us."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg1."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}else{
$mmsg = "Zasto ste napisali za mene!?!?!?";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='".$id."', gamemes='1', komu='".$us."'");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

$r = mysql_query ("select count(*) as nv from $ringame WHERE (role != '&#1086;&#1073;&#1099;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;')and(gamer_act='')");
$a = mysql_fetch_array($r);
if ($a["nv"]==0){
mysql_query("update $rmafaction set action = 'allvoted'");
$mmsg = "Sve sto se moglo dogoditi preko noci, dogodilo se!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}

if ($action == "nogame"&&($msg=="!start"||$msg=="!&#1089;&#1090;&#1072;&#1088;&#1090;")){
$tm = time()+180;
mysql_query ("update $rmafaction set action = 'registration', nexttime = '".$tm."'");
$mmsg = "Igra pocinje za 3 minuta! Za ucesce unesite !reg .";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}

if ($action == "registration"&&($msg=="!reg"||$msg=="!&#1088;&#1077;&#1075;")){
mysql_query ("select * from $ringame WHERE gamer_id = '".$id."'");
if (mysql_affected_rows()==0){
$mmsg = "$us ulazi u igru!";
$rnd = rand(10000,99999999);
$tm = time();
mysql_query("insert into $ringame set gamer_id = '".$id."', onl = '".$tm."'");
}else{
$mmsg = "$us izlazi iz igre!";
mysql_query("delete from $ringame WHERE gamer_id = '".$id."'");
}
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='1', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
}
}

if ($msg == "!stats"||$msg == "!&#1089;&#1090;&#1072;&#1090;&#1089;"){
$r = mysql_query("select mafcredits from users WHERE id = '".$id."'");
$a = mysql_fetch_array($r);
$cr = $a["mafcredits"];
$mmsg = "$us, imate $cr poena!";
$tm = getmicrotime();
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$mafiozi."', usid='".$mafid."', message='".$mmsg."', id='".$tm."', towhom='', gamemes='".$gmes."', komu=''");
mysql_query ("Update users set posts = posts + 1 WHERE id = '".$mafid."'");
}
unset($msg);

$bind1=$row['bind1'];
$bind2=$row['bind2'];
$bind3=$row['bind3'];
$bind4=$row['bind4'];
$max = $row["max"];
$avr = $row["avr"];
$time=date ("H:i");
$avr2 = $avr/10;

$r = mysql_query ("select count(readd) as num from zapiski WHERE (idtowhom = '".$id."')and(readd = '0')and(ininc = '1')");
$a = mysql_fetch_array($r);
$inb = $a["num"];

$takep="&amp;ref=$ref";

$rem = mysql_query("SELECT topic FROM rooms where rm = '".$rm."'");
$iname = mysql_fetch_array ($rem);
$topic = $iname["topic"];


if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
if ($avr!==0) echo "<card id=\"maf\" title=\"$topic-$time\" ontimer=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\"><timer value=\"$avr\"/>\n";
else echo "<card id=\"maf\" title=\"$topic-$time\" >\n";
//if ($row["kn_update"]==0) echo "<do type=\"options\" name=\"refresh\" label=\"Refresh\"><go href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\"/></do>\n";
//echo "<do type=\"options\" name=\"add\" label=\"Napisi\"><go href=\"#add\"/></do>";
if ($row["level"]>5) echo "<do type=\"options\" name=\"topic\" label=\"Naslov\"><go href=\"topic.php?$ses&amp;rm=$rm&amp;ref=$ref\"/></do>\n";
//echo "<do type=\"options\" name=\"help\" label=\"Pravila\"><go href=\"mafrules.php?$ses&amp;rm=$rm&amp;mod=1&amp;ref=$ref\"/></do>\n";
//echo "<do type=\"options\" name=\"help\" label=\"TOP 10\"><go href=\"statistik.php?$ses&amp;mod=mafia&amp;rm=$rm&amp;ref=$ref\"/></do>\n";
//echo "<do type=\"options\" name=\"help\" label=\"Pomoc\"><go href=\"help.php?$ses&amp;rm=$rm&amp;ref=$ref\"/></do>\n";
//if ($row["kn_whochat"]==0) echo "<do type=\"options\" name=\"who\" label=\"Online\"><go href=\"who.php?$ses&amp;rm=$rm&amp;ref=$ref\"/></do>\n";
$tm = time()-600;
$tm111 = time()-300;
$inr=mysql_query("SELECT id FROM room23 WHERE id > '".$tm."' AND usid>'8' OR id > '".$tm111."' AND usid='1' group by who order by id desc");
$kola = mysql_affected_rows();
if($row["level"]>9){
if($pwtread[0]==1){
echo "<do type=\"options\" name=\"pwtread\" label=\"Iskljuci PWT\"><go href=\"apanel.php?$ses&amp;go=pwtread$takep&amp;read=0\"/></do>";
}else{
echo "<do type=\"options\" name=\"pwtread\" label=\"Ukljuci PWT\"><go href=\"apanel.php?$ses&amp;go=pwtread$takep&amp;read=1\"/></do>";
}
}
//if ($row["kn_whoroom"]==0) echo "<do type=\"options\" name=\"who_room\" label=\"Online(".($kola).")\"><go href=\"whoroom.php?$ses&amp;rm=$rm&amp;ref=$ref\"/></do>\n";
if (($row["kn_clroom"]==0)&&($row["level"]>5)){
echo "<do type=\"options\" name=\"clear\" label=\"Ocisti Sve Sobe\"><go href=\"apanel.php?$ses&amp;go=clroom&amp;rm=$rm$takep\"/></do>";
echo "<do type=\"options\" name=\"clear\" label=\"Obrisi Sobu\"><go href=\"manel.php?$ses&amp;do=clrm&amp;rm=$rm$takep\"/></do>";
}
echo "<do type=\"options\" name=\"nastr\" label=\"Licni Kabinet\"><go href=\"cabinet.php?$ses&amp;rm=$rm&amp;ref=$ref\"/></do>\n";
echo "<p mode=\"wrap\">\n";
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
echo "<title>".$topic."-(".$time.")</title>";
if ($avr==0) echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>";
else echo "<meta http-equiv=\"Refresh\" content=\"".$avr2."; url=chat.php?$ses&amp;rm=$rm$takep\"/>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">";
}
echo $fsize1;
if($inb != "0") echo "<img src=\"smile/new.gif\" alt=\"NEW\"/><b>Inbox<a href=\"inbox.php?$ses&amp;ref=$ref&amp;pwd=$pwd\">($inb)</a></b><br/>\n";
if ($ver=="wml"){
if (((strpos ($agent,"M3Gate") !== false)||(strpos ($agent,"Opera") !== false)||(strpos ($agent,"emulator") !== false)||(strpos ($agent,"WinWAP") !== false)||(strpos ($agent,"Wapsilon") !== false)||(strpos ($agent,"M3GATE") !== false))){
echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep#add\" accesskey=\"$bind1\">Napisi</a>|";
echo "<a href=\"who.php?$ses&amp;rm=$rm&amp;ref=$ref\" >Ko je gde?</a><br/>";
}else{
echo "<a href=\"#add\" accesskey=\"$bind1\">Napisi</a>|";
echo "<a href=\"who.php?$ses&amp;rm=$rm&amp;ref=$ref\" >Ko je gde?</a><br/>";
}
}else{
echo $fsize2;
echo "<div class=\"d1\">";
echo $fsize1;
echo "<a href=\"add.php?$ses&amp;rm=$rm$takep\" accesskey=\"$bind1\">Napisi</a>|<a href=\"who.php?$ses&amp;rm=$rm&amp;ref=$ref\">Ko je gde?</a>";
echo $fsize2;
echo "</div>";
echo $fsize1;
}
if ($ver=="wml"){
echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\" accesskey=\"$bind2\">Osvezi</a>|";
echo "[<a href=\"mafrules.php?$ses&amp;rm=$rm$takep&amp;mod=1\">Pravila</a>]<br/>";
}else{
echo $fsize2;
echo "<div class=\"d1\">";
echo $fsize1;
echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\" accesskey=\"$bind2\">Osvezi</a>|[<a href=\"mafrules.php?$ses&amp;rm=$rm$takep&amp;mod=1\" accesskey=\"3\">Pravila</a>]";
echo $fsize2;
echo "</div>";
echo $fsize1;
}
@$total=$kol;
$mread = 0;
$i = 0;

if ($smthwr != 0){
$time = time()-30;
mysql_query("select * from $room WHERE (usid = '".$id."')and(id>'".$time."')");
if (mysql_affected_rows()>5&&$row["level"]<4){
$kik = time()+60;
$whokik = "[Sistem]";
$whykik = "Flood";
mysql_query("update users set kik = '".$kik."', whokik = '".$whokik."', whykik = '".$whykik."' WHERE id = '".$id."'");
}

$i++;
$komu = $usmes["komu"];
$date = $usmes["time"];
$name = $usmes["who"];
$usid = $usmes["usid"];
if($rm!="6"){
if ($smset=="0") {$msg = $usmes["message"];}
else if ($smset=="2") {$msg = $usmes["message"]; $msg=getsmilies1($msg, $usid);}
else{$msg = $usmes["message"]; $msg=getsmilies1($msg, $usid);}
}else{
$msg = $usmes["message"];
}

$msg=zamena($msg);
if($rm=="6"){
$duzina=strlen($msg);
$stst=mysql_fetch_array(mysql_query("SELECT level FROM users WHERE id='".$usid."'"));
if($duzina>10  && $stst[0]<7){
$msg = substr($msg,0,10);
}
$msg = str_replace("<b>", "", $msg);
$msg = str_replace("</b>", "", $msg);
$msg = str_replace("<i>", "", $msg);
$msg = str_replace("</i>", "", $msg);
$msg = str_replace("<u>", "", $msg);
$msg = str_replace("</u>", "", $msg);
}

$time = $usmes["id"];
$th = $usmes["towhom"];
$gm = $usmes["gamemes"];
@mysql_query ("Select * from ignor where usid='".$usid."' and id='".$id."'");
if ((mysql_affected_rows() == false)&&($gmes==0||($gmes==1&&$gm==1))){
if ($th == "") {
if (!empty($komu)) {
if ($us==$komu) $komu = "-<b>".$komu."</b>";
else $komu = "-".$komu."";
}
echo "<br/><b><a href=\"info.php?$ses&amp;nk=$usid&amp;rm=$rm&amp;ref=$ref\">".$name."</a></b>".$komu."(".$date.")\n".$msg.""; $mread++;}
else if (($th == $id)||($id == $usid)){
if (!empty($komu)) {
if ($us==$komu) $komu = "-<b>".$komu."</b>";
else $komu = "-".$komu."";
}
echo "<br/><b><a href=\"info.php?$ses&amp;nk=$usid&amp;rm=$rm&amp;ref=$ref\">".$name."</a></b>".$komu."(".$date.")<b>[P!]</b>$zvukpwt\n".$msg."";$mread++;
}
}
}
while (($mread < $max)&&($i<$total)){
$lines = mysql_fetch_array ($res);
$komu = $lines["komu"];
$date = $lines["time"];
$name = $lines["who"];
$usid = $lines["usid"];
$gm = $lines["gamemes"];
if($rm!="6"){
if ($smset=="0") {$msg = $lines["message"];}
else if ($smset=="2") {$msg = $lines["message"]; $msg=getsmilies1($msg, $usid);}
else{$msg = $lines["message"]; $msg=getsmilies1($msg, $usid);}
}else{
$msg = $lines["message"];
}

$msg=zamena($msg);
if($rm=="6"){
$duzina=strlen($msg);
$stst=mysql_fetch_array(mysql_query("SELECT level FROM users WHERE id='".$usid."'"));
if($duzina>10  && $stst[0]<7){
$msg = substr($msg,0,10);
}
$msg = str_replace("<b>", "", $msg);
$msg = str_replace("</b>", "", $msg);
$msg = str_replace("<i>", "", $msg);
$msg = str_replace("</i>", "", $msg);
$msg = str_replace("<u>", "", $msg);
$msg = str_replace("</u>", "", $msg);
}

$time = $lines["id"];
$th = $lines["towhom"];
$hid = $lines["hid"];
$i++;
@mysql_query ("Select * from ignor where usid='".$usid."' and id='".$id."'");
if ((mysql_affected_rows() == false)&&(($hid != 2)||($id == $usid))&&($gmes==0||($gmes==1&&$gm==1))){
if ($th == "") {
if (!empty($komu)) {
if ($us==$komu) $komu = "-<b>".$komu."</b>";
else $komu = "-".$komu."";
}
echo "<br/><b><a href=\"info.php?$ses&amp;nk=$usid&amp;rm=$rm&amp;ref=$ref\">".$name."</a></b>".$komu."(".$date.")\n".$msg.""; $mread++;}
else if (($th == $id)||($id == $usid)){
if (!empty($komu)) {
if ($us==$komu) $komu = "-<b>".$komu."</b>";
else $komu = "-".$komu."";
}
echo "<br/><b><a href=\"info.php?$ses&amp;nk=$usid&amp;rm=$rm&amp;ref=$ref\">".$name."</a></b>".$komu."(".$date.")<b>[P!]</b>$zvukpwt\n".$msg."";$mread++;}
}
}
$page_next = $max;
if ($ver=="wml") echo "<br/>---";
else echo "<br/><br/>";
if ($ver=="xhtml"){
echo $fsize2;
echo "<div class=\"d1\">";
echo $fsize1;
echo "<a href=\"enter.php?$ses&amp;rm=$rm&amp;ref=$ref\">Izlaz</a>|<a href=\"whoroom.php?$ses&amp;rm=$rm&amp;ref=$ref\">Ko je tu?</a>";
echo $fsize2;
echo "</div>";
echo "<div class=\"d1\">";
echo $fsize1;
echo "<a href=\"statistik.php?$ses&amp;mod=mafia&amp;rm=$rm&amp;ref=$ref\">TOP 10</a>";
if ($max < $total){
echo "|<a href=\"history.php?$ses&amp;rm=$rm&amp;num=$page_next$takep\" accesskey=\"$bind3\">Arhiva</a>";
}
echo $fsize2;
echo "</div>";
echo $fsize1;
}else{
echo "<br/><a href=\"enter.php?$ses&amp;rm=$rm&amp;ref=$ref\">Izlaz</a>|<a href=\"whoroom.php?$ses&amp;rm=$rm&amp;ref=$ref\">Ko je tu?</a>";
echo "<br/><a href=\"statistik.php?$ses&amp;mod=mafia&amp;rm=$rm&amp;ref=$ref\">TOP 10</a>";
if ($max < $total){
echo "|<a href=\"history.php?$ses&amp;rm=$rm&amp;num=$page_next$takep\">Arhiva</a>";
}
echo "<br/>";
}
//if ($ver=="wml") echo "<br/><a href=\"enter.php?$ses&amp;ref=$ref\" accesskey=\"$bind4\">Hodnik(".$bind4.")</a><br/>";
//else echo "<div class=\"d1\"><a href=\"enter.php?$ses&amp;ref=$ref\" accesskey=\"$bind4\">Hodnik(".$bind4.")</a></div>";
if ($ver=="wml") echo $divide;
$pagesize=round((ob_get_length()+200)/1024,1);
//echo "&#1042;&#1077;&#1089; &#1089;&#1090;&#1088;&#1072;&#1085;&#1080;&#1094;&#1099;: ".$pagesize." &#1050;&#1073;<br/>";
//if ($ver=="wml") echo "<a href=\"trafik.php?$ses&amp;rm=$rm$takep\">&#1058;&#1088;&#1072;&#1092;&#1092;&#1080;&#1082;</a><br/>";
//else echo "<div class=\"d1\"><a href=\"trafik.php?$ses&amp;rm=$rm$takep\">&#1058;&#1088;&#1072;&#1092;&#1092;&#1080;&#1082;</a></div>";
echo $fsize2;
//include("gzip.php");
if ($ver=="wml")echo "</p></card>";
else echo "</div></body></html>";
if ($ver=="wml"){
echo "<card id=\"add\" title=\"Napisi\">\n";
echo "<p mode=\"wrap\">\n";
echo $fsize1;
echo "Tekst:<br/>\n";
echo $fsize2;
echo "<input name=\"msg$ref\" maxlength=\"200\" title=\"Text\"/><br/>\n";
if ($row["level"]>=4){
echo $fsize1;
echo "Opcije:<br/>\n";
echo $fsize2;
echo "<select name=\"shrift$ref\">\n";
echo "<option value=\"0\">Normalno</option>\n";
echo "<option value=\"1\">Iskoseno</option>\n";
}
if ($row["level"]>=4) {echo "<option value=\"2\">Podvuceno</option>\n";}
if ($row["level"]>=4) {echo "<option value=\"3\">Iskoseno/Podvuceno</option>\n";}
if ($row["level"]>=7) {echo "<option value=\"4\">Podebljano</option>\n";}
if ($row["level"]>=7) {echo "<option value=\"5\">Podebljano/Podvuceno</option>\n";}
if ($row["level"]>=7) {echo "<option value=\"6\">Veliko</option>\n";}
if ($row["level"]>=4) {echo "</select><br/>\n";}
echo $fsize1;
echo "<anchor title=\"send\">Napisi<go href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\" method=\"post\">\n";
echo "<postfield name=\"msg\" value=\"$(msg$ref)\"/>\n";
echo "<postfield name=\"shrift\" value=\"$(shrift$ref)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
echo $fsize1;
echo "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Igra Mafija</a>\n";
echo $fsize2;
//include("gzip.php");
echo "</p></card>";
echo "</wml>";
}
}
mysql_close ($link);
ob_end_flush();
?>