<?
include("gz.php");
header('Cache-Control: no-store, no-cache, must-revalidate');
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

$user=$row["user"];
$level=$row["level"];
$user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$naslov="$user[0] Flert";
$naslov1="$user[0] Voli/Ne Voli";
$naslov2="$user[0] poljubci!";
$naslov3="$user[0] zagrljaji!";
$naslov4="$user[0] udarci!";
$naslov5="$user[0] sutiranja!";
///////////////////////////////////////////
$gde="Flert";
include("gde.php");
///////////////////////////////////////////
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card title=\"$naslov\">\n";
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
echo "<title>$naslov</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
}
///////////////////////////////////////////
if($row["level"]>1)
{
///////////////////////////////////////////

switch($mod) {

case 'kafa':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
if($row["posts"]>=300 && $who!=""){
echo "Poruka uspesno poslata!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Voli";
 
$message = "Hajde na kafu <img src=\"/flertt/pozivzakafu.gif\" alt=\"icon\" /> znam da nije sladja od tebe, cekam te!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$napisao[0]."', idwho ='".$id."', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
echo $fsize2;
break;

case 'klopa':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
if($row["posts"]>=300 && $who!=""){
echo "Poruka uspesno poslata!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Voli";
 
$message = "Dodji na klopu <img src=\"/flertt/pozivzaklopu.jpg\" alt=\"icon\" /> ovo se ne odbija!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$napisao[0]."', idwho ='".$id."', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
echo $fsize2;
break;

case 'poljubac':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
if($row["posts"]>=300 && $who!=""){
echo "Poruka uspesno poslata!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Voli";
 
$message = "Saljem ti nasladji poljubac <img src=\"/flertt/kiss.gif\" alt=\"icon\" /> na svetu!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$napisao[0]."', idwho ='".$id."', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
echo $fsize2;
break;

case 'ljubav':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
if($row["posts"]>=300 && $who!=""){
echo "Poruka uspesno poslata!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Voli";
 
$message = "Ljubav koju dajemo je jedina ljubav koja ostaje u nama. <img src=\"/flertt/ljubav.gif\" alt=\"icon\" /><br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$napisao[0]."', idwho ='".$id."', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
echo $fsize2;
break;

case 'sex':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
if($row["posts"]>=300 && $who!=""){
echo "Poruka uspesno poslata!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Voli";
 
$message = "Ja upravo zelim sex sa tobom! <img src=\"flertt/jebb.gif\" alt=\"icon\" /><br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$napisao[0]."', idwho ='".$id."', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
echo $fsize2;
break;

case 'pivo':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
if($row["posts"]>=300 && $who!=""){
echo "Poruka uspesno poslata!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Voli";
 
$message = "Brate ajde na <img src=\"/flertt/pice.jpg\" alt=\"icon\" /><br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$napisao[0]."', idwho ='".$id."', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
echo $fsize2;
break;

case 'ban':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
if($row["posts"]>=300 && $who!=""){
echo "Poruka uspesno poslata!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Voli";
 
$message = "Upravo si dobio/la <img src=\"/flertt/ban.png\" alt=\"icon\" /> zato sto mi se tako moze!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$napisao[0]."', idwho ='".$id."', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
echo $fsize2;
break;

case 'shok':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
if($row["posts"]>=300 && $who!=""){
echo "Poruka uspesno poslata!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Voli";
 
$message = "Slusaj ti, ne mozes ovde tako da se ponasas. Ovo ti nije tata kupio. Sada sam razocaran/a tvojim ponasanjem. Bez pljuvanja i prozivanja da ja ne razvezem jezik! Ovo je fora, nema ljutis hahaha. <img src=\"/flertt/shok.png\" alt=\"icon\" /><br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$napisao[0]."', idwho ='".$id."', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
echo $fsize2;
break;


}
echo $fsize1;
echo $divide;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM comments WHERE user='".$who."' AND who='".$id."'"));
if($vec[0]==0 && $row["posts"]>=300){
if(!$mod) echo "<a href=\"comments.php?$ses&amp;ref=$ref&amp;who=$who&amp;mod=pisi\">Dodaj Komentar</a><br/>\n";
}
if(isset($who) && $who>0){
$sexer = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
if($mod) //echo "<a href=\"comments.php?$ses&amp;ref=$ref&amp;who=$who\">$sexer[0] Komentari</a><br/>\n";
echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$who&amp;ref=$ref\">$sexer[0] Profil</a><br/>";
}
}
if (isset ($rm))echo "<a href=\"chat.php?$ses&amp;rm=$rm\">Chat Soba</a><br/>\n"; 
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>