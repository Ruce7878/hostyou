<?

include("gz.php");

header("Cache-Control: no-cache");

if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");

else header("Content-Type:text/html; charset=UTF-8");



require("inc.php");

$link = connect_db();

list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);

require("version.php");



if ($ver=="wml"){

echo $xml;

echo $dtd;

echo "<wml>\n";

}else{

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";

echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

echo "<head>";

if($row["css"]!=""){

$csss=$row["css"];

echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$csss\"/>";

}else{

echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";

}

}



switch($mod) {



default:

if ($ver=="wml"){

echo "<card id=\"trader\" title=\"Bockanje\" >\n";

echo "<p mode=\"wrap\" align=\"center\">\n";

}else{

echo "<title>BAN</title>\n";

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>\n";

echo "<div align=\"center\">\n";

}

echo $fsize1;

 $pr_count = @mysql_query("SELECT id,user FROM users WHERE onl> '".$tm."' AND room='holl' AND id>'8' OR onl> '".$tm111."' AND room='holl' AND id='1' group by user order by onl desc;");

$kolpr = mysql_affected_rows();

$kols = $kol + $kolpr;

$manje = time()-600;

$vece = time()-3600;

$manje1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$manje."'"));

$vece1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$vece."'"));



//////////////////////

echo "Klikni na nick i BANUJ chatera!<br/>---<br/>";

$roomselect = @mysql_query ("Select name,rm from rooms WHERE uklj='0' order by pozicija,rm LIMIT 0,24;");

while($rooms23 = @mysql_fetch_array($roomselect23)) {

$roomname23=$rooms23["name"];

$rms23=$rooms23["rm"];

$room23="room".$rms23;

$tm23 = time()-1200;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sobe23 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime>'".$tm23."' AND gde='".$room23."'"));

	if($sobe23[0]>0){

	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms23&amp;ref=$ref\">$roomname23</a></b>]";

	echo "[<b><a href=\"whoroom.php?$ses&amp;rm=$rms23&amp;ref=$ref\">$sobe23[0] clanova</a></b>]<br/>";

	}else{

	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms23&amp;ref=$ref\">$roomname23($sobe23[0])</a></b>]<br/>";

	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$clanovi23 = mysql_query("SELECT id, user, inv, level, gde, gdetime FROM users WHERE gdetime>'".$tm23."' AND gde='".$room23."'");

for ($k = 0; $k < $sobe23[0]; $k++){

$lines23 = mysql_fetch_array ($clanovi23);

if ($lines23[2] != 1) echo "<b><a href=\"boc.php?$ses&amp;mod=yes&amp;rm=$rm&amp;ref=$ref&amp;nk=$lines23[0]\">$lines23[1]</a></b>";

else if ($row["level"]==8) echo "$lines23[1](i)";

if (($k+1) != $sobe23[0]) print ', ';

}

if($sobe23[0]>0)echo "<br/><br/>";

unset($lines23);

}

echo $divide;

//////////////////////////////////////////////////////////////////////////////////

$inbox = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$vece."' AND gde='Inbox' OR gdetime> '".$vece."' AND gde='Salje Pismo' OR gdetime> '".$vece."' AND gde='Poslata Pisma' OR gdetime> '".$vece."' AND gde='Cita Pismo'"));

if($inbox[0]>0){

echo"[<b><a href=\"chatmail.php?$ses&amp;ref=$ref\">Inbox</a></b>]";

echo "[<b><a href=\"inwho.php?$ses&amp;ref=$ref\">$inbox[0] chatera</a></b>]<br/>";

$inbox1 = mysql_query("SELECT id, user, inv, level, gde, gdetime FROM users WHERE gdetime> '".$vece."' AND gde='Inbox' OR gdetime> '".$vece."' AND gde='Salje Pismo' OR gdetime> '".$vece."' AND gde='Poslata Pisma' OR gdetime> '".$vece."' AND gde='Cita Pismo' ORDER BY latuser ASC");

$kolpr = mysql_affected_rows();

for ($k = 0; $k < $kolpr; $k++)

{

$pdc = @mysql_fetch_array($inbox1);

$user = $pdc["user"];

$inv = $pdc["inv"];

$nk = $pdc["id"];

if ($inv != 1) echo "<b><a href=\"aban.php?$ses&amp;mod=yes&amp;rm=$rm&amp;ref=$ref&amp;nk=$nk\">$user</a></b>"; 

else if ($row["level"] >6 )  echo "$user(i)";

if (($k+1) != $kolpr) print ', ';

}

if($kolpr>0) echo "<br/>";

unset($pdc);

echo $divide;

}else{

echo"[<b><a href=\"chatmail.php?$ses&amp;ref=$ref\">Inbox ($inbox[0])</a></b>]<br/>";

echo $divide;

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$roomselect = @mysql_query ("Select name,rm from rooms WHERE uklj='0' order by pozicija,rm LIMIT 0,24;");

while($rooms = @mysql_fetch_array($roomselect)) {

$roomname=$rooms["name"];

$rms=$rooms["rm"];

$room="room".$rms;

$tm = time()-1200;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sobe = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime>'".$tm."' AND gde='".$room."'"));

if ($rms==11){

	if($sobe[0]>0){

	echo "[<b><a href=\"klaznet.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname</a></b>]";

	echo "[<b><a href=\"whoroom.php?$ses&amp;rm=$rms&amp;ref=$ref\">$sobe[0] clanova</a></b>]<br/>";

	}else{

	echo "[<b><a href=\"klaznet.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname ($sobe[0])</a></b>]<br/>";

	}

}else if ($rms==10){

	if($sobe[0]>0){

	if ($row["level"]==8){

	echo "[<b><a href=\"intim.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname</a></b>]";

	echo "[<b><a href=\"whoroom.php?$ses&amp;rm=$rms&amp;ref=$ref\">$sobe[0] clanova</a></b>]<br/>";

	}

	}else{

	if ($row["level"]==8){

	echo "[<b><a href=\"intim.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname ($sobe[0])</a></b>]<br/>";

	}

	}

}else if ($rms==7){

	if($sobe[0]>0){

	if ($row["level"]>6){

	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref&amp;modlog=1\">$roomname</a></b>]";

	echo "[<b><a href=\"whoroom.php?$ses&amp;rm=$rms&amp;ref=$ref\">$sobe[0] clanova</a></b>]<br/>";

	}

	}else{

	if ($row["level"]>6){

	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref&amp;modlog=1\">$roomname ($sobe[0])</a></b>]<br/>";

	}

	}

}else if ($rms==8){

	if($sobe[0]>0){

	if ($row["level"]>3){

	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref&amp;modlog=1\">$roomname</a></b>]";

	echo "[<b><a href=\"whoroom.php?$ses&amp;rm=$rms&amp;ref=$ref\">$sobe[0] clanova</a></b>]<br/>";

	}

	}else{

	if ($row["level"]>3){

	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref&amp;modlog=1\">$roomname ($sobe[0])</a></b>]<br/>";

	}

	}

}else{

	if($sobe[0]>0){

	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname</a></b>]";

	echo "[<b><a href=\"whoroom.php?$ses&amp;rm=$rms&amp;ref=$ref\">$sobe[0] clanova</a></b>]<br/>";

	}else{

	echo "[<b><a href=\"chat.php?$ses&amp;rm=$rms&amp;ref=$ref\">$roomname ($sobe[0])</a></b>]<br/>";

	}

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$clanovi = mysql_query("SELECT id, user, inv, level, gde, gdetime FROM users WHERE gdetime>'".$tm."' AND gde='".$room."'");

if ($rms!=10 && $rms!=7 && $rms!=8){

for ($k = 0; $k < $sobe[0]; $k++){

$lines = mysql_fetch_array ($clanovi);

if ($lines[2] != 1) echo "<b><a href=\"shok.php?$ses&amp;mod=yes&amp;rm=$rm&amp;ref=$ref&amp;nk=$lines[0]\">$lines[1]</a></b>";

else if ($row["level"]==8) echo "$lines[1](i)";

if (($k+1) != $sobe[0]) print ', ';

}

if($sobe[0]>0)echo "<br/><br/>";

unset($lines);

}else if($rms==10){

if ($row["level"]==8){

for ($k = 0; $k < $sobe[0]; $k++){

$lines = mysql_fetch_array ($clanovi);

if ($lines[2] != 1)echo "$lines[1]";

else echo "$lines[1]";

if (($k+1) != $sobe[0]) print ', ';

}

if($sobe[0]>0)echo "<br/><br/>";

unset($lines);

}

}else if($rms==7){

if ($row["level"]>6){

for ($k = 0; $k < $sobe[0]; $k++){

$lines = mysql_fetch_array ($clanovi);

if ($lines[2] != 1)echo "$lines[1]";

else echo "$lines[1]";

if (($k+1) != $sobe[0]) print ', ';

}

if($sobe[0]>0)echo "<br/><br/>";

unset($lines);

}

}else if($rms==8){

if ($row["level"]>3){

for ($k = 0; $k < $sobe[0]; $k++){

$lines = mysql_fetch_array ($clanovi);

if ($lines[2] != 1)echo "$lines[1]";

else echo "$lines[1]";

if (($k+1) != $sobe[0]) print ', ';

}

if($sobe[0]>0)echo "<br/><br/>";

unset($lines);

}

}

}

echo $divide;

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$tm = time()-1200;

///////////////////////////////////////////////////////////////

$forumce = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$tm."' AND `gde` LIKE CONVERT(_utf8 '%*#*#*#*%' USING latin1)"));

if($forumce[0]>0){

echo"[<b><a href=\"forum.php?$ses&amp;ref=$ref\">Forum</a></b>]";

echo "[<b><a href=\"infor.php?$ses&amp;ref=$ref\">$forumce[0] chatera</a></b>]<br/>";

$forumce1 = mysql_query("SELECT id, user, inv, level, gde, gdetime FROM users WHERE gdetime> '".$tm."' AND `gde` LIKE CONVERT(_utf8 '%*#*#*#*%' USING latin1) ORDER BY latuser ASC");

$kolpr2222 = mysql_affected_rows();

for ($k = 0; $k < $kolpr2222; $k++)

{

$pdc2222 = @mysql_fetch_array($forumce1);

$user2222 = $pdc2222["user"];

$inv2222 = $pdc2222["inv"];

$nk2222 = $pdc2222["id"];

if ($inv2222 != 1) echo "<b><a href=\"samar.php?$ses&amp;mod=yes&amp;rm=$rm&amp;ref=$ref&amp;nk=$nk2222\">$user2222</a></b>";

else if ($row["level"] >6 )  echo "$user2222(i)";

if (($k+1) != $kolpr2222) print ', ';

}

if($kolpr2222>0) echo "<br/>";

unset($pdc2222);

echo $divide;

}else{

echo"[<b><a href=\"forum.php?$ses&amp;ref=$ref\">Forum ($forumce[0])</a></b>]<br/>";

echo $divide;

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$tm = time()-1800;

///////////////////////////////////////////////////////////////

$tuboteka = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$tm."' AND `gde` LIKE CONVERT(_utf8 'Tuboteka' USING latin1)"));

if($tuboteka[0]>0){

echo"[<b><a href=\"tuboteka.php?$ses&amp;ref=$ref\">Tuboteka</a></b>]";

echo "[<b><a href=\"infotub.php?$ses&amp;ref=$ref\">$tuboteka[0] chatera</a></b>]<br/>";

$tuboteka1 = mysql_query("SELECT id, user, inv, level, gde, gdetime FROM users WHERE gdetime> '".$tm."' AND `gde` LIKE CONVERT(_utf8 'Tuboteka' USING latin1) ORDER BY latuser ASC");

$kolpr11 = mysql_affected_rows();

for ($k = 0; $k < $kolpr11; $k++)

{

$pdc11 = mysql_fetch_array($tuboteka1);

$user11 = $pdc11["user"];

$inv11 = $pdc11["inv"];

$nk11 = $pdc11["id"];

if ($inv11 != 1) echo "<b><a href=\"info.php?$ses&amp;ref=$ref&amp;nk=$nk11\">$user11</a></b>";

else if ($row["level"] >6 )  echo "<b><a href=\"info.php?$ses&amp;ref=$ref&amp;nk=$nk11\">$user11(i)</a></b>";

if (($k+1) != $kolpr11) print ', ';

}

if($kolpr11>0) echo "<br/>";

unset($pdc11);

echo $divide;

}else{

echo"[<b><a href=\"tuboteka.php?$ses&amp;ref=$ref\">Tuboteka ($tuboteka[0])</a></b>]<br/>";

echo $divide;

}

////////////////////////////////////////////////////////////////////////////////////////

$hodnik = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$tm."' AND `gde` NOT LIKE CONVERT(_utf8 '%room%' USING latin1) AND `gde` NOT LIKE CONVERT(_utf8 '%*#*#*#*%' USING latin1) AND gde!='Inbox' AND gde!='Salje Pismo' AND gde!='Poslata Pisma' AND gde!='Cita Pismo'"));

if($hodnik[0]>0){

echo"[<b><a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a></b>]";

echo "[<b><a href=\"prwho.php?$ses&amp;ref=$ref\">$hodnik[0] chatera</a></b>]<br/>";

$hodnik1 = mysql_query("SELECT id, user, inv, level, gde, gdetime FROM users WHERE gdetime> '".$tm."' AND `gde` NOT LIKE CONVERT(_utf8 '%room%' USING latin1) AND `gde` NOT LIKE CONVERT(_utf8 '%*#*#*#*%' USING latin1) AND gde!='Inbox' AND gde!='Salje Pismo' AND gde!='Poslata Pisma' AND gde!='Cita Pismo' ORDER BY latuser ASC");

$kolpr1 = mysql_affected_rows();

for ($k = 0; $k < $kolpr1; $k++)

{

$pdc1 = @mysql_fetch_array($hodnik1);

$user = $pdc1["user"];

$inv = $pdc1["inv"];

$nk = $pdc1["id"];

if ($inv != 1) echo "<b><a href=\"boc.php?$ses&amp;mod=yes&amp;rm=$rm&amp;ref=$ref&amp;nk=$nk\">$user</a></b>";

else if ($row["level"] >6 )  echo "$user(i)";

if (($k+1) != $kolpr1) print ', ';

}

if($kolpr1>0) echo "<br/>";

unset($pdc1);

}else{

echo"[<b><a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik ($hodnik[0])</a></b>]";

}





///////////////////////

break;



case 'yes':

$nk = $_GET["nk"];

$id = $_GET["id"];

$rm = $_GET["rm"];

if($row["posts"]>1){

if(mysql_query("update help set who='".$id."', var='1' where rm='".$rm."';")){

$rnd = rand(0,99999999);

$today=date ("H:i");

$time = time();

$us = $row["user"];

$help = mysql_query("select rm from help where var='1'");

$h = mysql_fetch_array ($help);

$sos = $h["rm"];

$roomselect = @mysql_query ("Select name from rooms where rm='".$rm."'");

$rooms = @mysql_fetch_array($roomselect);

$roomname=$rooms["name"];

///$pass = mysql_fetch_array(mysql_query("SELECT user,pass FROM users WHERE id='".$nk."'"));

$txt = "<b>Neko te je upravo BANOVAO <img src=\"smile/ban.png\" alt=\"\"/> Vrati mu istom merom <img src=\"smile/D.gif\" alt=\"\"/></b>";

///for ($num = 0; $num <= 22; $num++){  

$room = "room".$num;

//if($num!="5" && $num!="6" && $num!="8" && $num!="10"){

//mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$us."', message='".$txt."', id='".$time."', towhom='', hid='0', usid='".$id."', komu=''");//                        

//mysql_query("update help set who='".$id."', var='0' where rm='".$rm."';");

//}

$pos4 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));

$pos5 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));

$data = date("d-M-Y [H:i]");

$kol = rand(0,99999999);

$time = time();

$topic = "BAN od $pos4[0]";

$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$id."', idwho ='".$id."', message = '".$txt."', towhom = '".$pos4[0]."', idtowhom = '".$nk."', time = '".$time."', readd = '0', topic = 'Samarcina :)', date='".$data."'");

///}

if ($ver=="wml"){

echo "<card id=\"ok\" title=\"BAN\" ontimer=\"who.php?$ses&amp;rm=$rm&amp;ref=$ref\"><timer value=\"15\"/>\n";

echo "<p align=\"center\">";

}else{

echo "<title>BAN</title>\n";

echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=who.php?$ses&amp;rm=$rm&amp;ref=$ref\">";

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>\n";

echo "<div align=\"center\">\n";

}

echo $fsize1; 





echo "$pos5[0], chateru $pos4[0] je upravo BANOVAO<img src=\"smile/ban.png\" alt=\"\"/> <br/>";

}else{

if ($ver=="wml"){

echo "<card id=\"ok\" title=\"BAN\" ontimer=\"who.php?$ses&amp;rm=$rm&amp;ref=$ref\"><timer value=\"15\"/>\n";

echo "<p align=\"center\">";

}else{

echo "<title>BANOVANJE</title>\n";

echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=who.php?$ses&amp;rm=$rm&amp;ref=$ref\">";

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>\n";

echo "<div align=\"center\">\n";

}

echo "Greska!!! Obratite se adminsitratoru!<br/>";

}

}else{

if ($ver=="wml"){

echo "<card id=\"ok\" title=\"BAN\" ontimer=\"who.php?$ses&amp;rm=$rm&amp;ref=$ref\"><timer value=\"15\"/>\n";

echo "<p align=\"center\">";

}else{

echo "<title>Shok</title>\n";

echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=who.php?$ses&amp;rm=$rm&amp;ref=$ref\">";

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>\n";

echo "<div align=\"center\">\n";

}

echo "Nemate dovoljno postova!<br/>";

}

break;

}

echo $divide;

//echo "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a>";

echo $fsize2; 

include("gzip.php");

if ($ver=="wml")echo "</p></card></wml>";

else echo "</div></body></html>";

mysql_close ($link);

?>