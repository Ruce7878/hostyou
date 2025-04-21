<?
include("gz.php");
header('Cache-Control: no-store, no-cache, must-revalidate');
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

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

$user=$row["user"];
$level=$row["level"];
$user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$naslov="$user[0] Komentari";
$naslov1="$user[0] Voli/Ne voli";
$naslov2="$user[0] poljubci <img src=\"smilies/cem.gif\" alt=\"icon\"/>";
$naslov3="$user[0] piva <img src=\"smilies/alc.gif\" alt=\"icon\"/>";
$naslov4="$user[0] ruze <img src=\"smilies/ruza.jpg\" alt=\"icon\"/>";
$naslov5="$user[0] <img src=\"smilies/bockanje.gif\" alt=\"icon\"/> Bockanja <img src=\"smilies/bockanje.gif\" alt=\"icon\"/>";
/////////////////////////////////////////////////////////////////////////
$nocna = mysql_fetch_array(mysql_query("SELECT lockcomm FROM setting"));
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
///////////////////////////////////////////
$gde="Komentari";
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

switch($mod) {

default:
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
echo "$naslov<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM comments WHERE user='".$who."'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT id, who, text, time FROM comments WHERE user='".$who."' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[1]."'"));
$timesss=date("d-m-Y H:i", $item[3]);
$msg=$item[2];
$msg=getsmilies($msg, $item[1]);

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);


       echo "<b><a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[1]&amp;ref=$ref\">$napisao[0]:</a></b> "; 
	   $msg=zamena($msg);
	   echo "$msg";
	   if($row["level"]>10 || $who==$id){
	   echo "<a href=\"comments.php?mod=brisi&amp;$ses&amp;ref=$ref&amp;who=$who&amp;cid=$item[0]\">[X]</a> ";
	   }
	   echo "<br/>$timesss<br/>$divide";
    }
    }else{
echo "<br/>Nema komentara za clana $user[0]!<br/>";
}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"comments.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"who\" value=\"$who\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"comments.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
		$rets .= "<input type=\"hidden\" name=\"who\" value=\"$who\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }

echo $fsize2;
break;
//------------------------------ LIKE1 ---------------------------
case 'like1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov1<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM likes WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Niko ne voli clana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=like1\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=like1\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;
//------------------------- EDITPOSTS ---------------------------------
		
case 'editposts':
$korisnik=trim(htmlspecialchars(stripslashes($korisnik)));
$novi=trim(htmlspecialchars(stripslashes($novi)));
if(empty($korisnik)) $error=$error."<u>Unesite Nick!</u><br/>";
if(empty($novi)) $error=$error."<u>Unesite Broj Postova!</u><br/>";
$nicknick = mysql_fetch_array(mysql_query("SELECT id, user, posts FROM users WHERE id='".$nk."'"));
if($row["level"]>3){
if(empty($action)) {
if ($ver=="wml"){
print $fsize1;
print "Nick:<br/>";
print $fsize2;
print "<input name=\"korisnik\" value=\"$nicknick[1]\"/><br/>";
print $fsize1;
print "Postovi: <b>$nicknick[2]</b><br/>";
print $fsize2;
print $fsize1;
print "Dodaj Postova:<br/>";
print $fsize2;
print "<input name=\"novi\"/><br/>";
print $fsize1;
echo "<anchor>Izmeni<go href=\"mpanel.php?$ses&amp;do=editposts$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"korisnik\" value=\"$(korisnik)\"/>";
print "<postfield name=\"novi\" value=\"$(novi)\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"mpanel.php?$ses&amp;do=editposts$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Nick:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"korisnik\" value=\"$nicknick[1]\"/><br/>\n";
print $fsize1;
print "Postovi: <b>$nicknick[2]</b><br/>";
print $fsize2;
echo $fsize1;
echo "Dodaj Postova:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"novi\"/><br/>\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
} else {
if(empty($error)) {
$result = mysql_fetch_array(mysql_query("SELECT id, user, level, posts FROM users WHERE user='".$korisnik."'"));
if($result) {
if($result[2]<=$row["level"]){
$kolicina=$result[3]+$novi;
if($kolicina<0){$kolicina=0;}
if(mysql_query("UPDATE users SET posts='".$kolicina."' WHERE id='".$result[0]."'")) {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$stststat = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$result[0]."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dao postove clanu <b>$stststat[0]</b> od <b>$result[3]</b> do <b>$kolicina</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='1'");
/////////////////////////////////////////////////////////////////////
print $fsize1;
print "Postovi su dodati!<br/>";
print $fsize2;
} else {
print $fsize1;
print "Greska!!!<br/>";
print $fsize2;
}
}else{
print $fsize1;
print "Ne mozete davati postove!<br/>";
print $fsize2;
}
} else {
print $fsize1;
print "Chater nije pronadjen!<br/>";
print $fsize2;
}
} else {
print $fsize1;
print $error;
print $fsize2;
}
}
}else{
print $fsize1;
print "Ne mozete davati postove!<br/>";
print $fsize2;
}
break;

case 'kis1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov2<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes1 WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM likes1 WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Jos uvek niko nije poljubio chlana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=kis1\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=kis1\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;

case 'alc1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov3<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes2 WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM likes2 WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Jos uvek niko nije poklonio pivo clanu $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=alc1\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=alc1\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;

case 'bockanje1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov5<br/>";

echo $fsize2;
break;
//---------------------------- RUZA1 -------------------------------
		
case 'ruza1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov4<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes3 WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM likes3 WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Jos uvek niko nije poklonio ruza clanu $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=ruza1\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=ruza1\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;
//------------------------ UNLIKE1 ----------------------------------------

case 'unlike1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov1<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes WHERE uid='".$who."' AND likes='0'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM likes WHERE uid='".$who."' AND likes='0' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Niko ne voli clana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=unlike1\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=unlike1\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;

case 'pisi':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM comments WHERE user='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0){
if($ver=="xhtml"){
echo "<form method=\"POST\" action=\"comments.php?mod=napisi&amp;$ses&amp;ref=$ref&amp;who=$who\" name=\"auth\">\n";
}
	echo "Komentar:<br/>";
    echo "<input name=\"text\" maxlength=\"300\"/><br/>";
    if ($ver=="wml"){
	echo "<anchor>Dodaj";
	echo "<go href=\"comments.php?mod=napisi&amp;$ses&amp;ref=$ref&amp;who=$who\" method=\"post\">";
	echo "<postfield name=\"text\" value=\"$(text)\"/>";
	echo "</go></anchor><br/><br/>";
	}else{
	echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/><br/>\n";
	echo "</form>";
	}
	}else{
	echo "Ne mozete pisati komentare, nemate 300 postova ili ste vec napisali komentar!<br/>\n";
	}
echo $fsize2;
break;
//------------------------------- NAPISI -----------------------------
case 'napisi':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM comments WHERE user='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0){
$text = $_POST["text"];
    $crdate = time();
	$text = htmlspecialchars($text);
	if($text!=""){
    $res = mysql_query("INSERT INTO comments SET user='".$who."', who='".$id."', text='".$text."', time='".$crdate."'");
    if($res)
    {
    echo "Komentar je uspesno dodat!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Komentar $napisao[0]";
 
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);


$message = "Clan <b>$napisao[0]</b> dodao je komentar u Vas Profil!<br/><b>Komentar:</b>$text";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Morate uneti neki komentar!<br/>";
	}
	}else{
	echo "Ne mozete pisati komentare, nemate 300 postova ili ste vec napisali komentar!<br/>\n";
	}
echo $fsize2;
break;
//--------------------- LIKE -------------------------------------
		
case 'like':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO likes SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Like je uspesno dodat!<br/>";
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

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);


$message = "Clan <b>$napisao[0]</b> Vas voli!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete voleti ovog clana!<br/>\n";
	}
echo $fsize2;
break;
//------------------------------ KIS -----------------------------------
		
case 'kis':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes1 WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO likes1 SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Poljubac uspesno dodat!<br/>";
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

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Vam je poslao poljubac <img src=\"smilies/cem.gif\" alt=\"icon\"/>!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete poljubiti ovog clana!<br/>\n";
	}
echo $fsize2;
break;
//------------------------- ALC ----------------------------------------
		
case 'alc':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes2 WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO likes2 SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Pivo uspesno poslato!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Pivo";
 
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Vam je poklonio pivo <img src=\"smilies/alc.gif\" alt=\"icon\"/>!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete pokloniti pivo ovom chlanu!<br/>\n";
	}
echo $fsize2;
break;
//---------------------------- BOCKANJE ------------------------------
case 'bockanje':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO likes5 SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Uspesno ste bocnuli clana!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Bockanje";
////////////////////////////////////

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Vas je bocnuo <img src=\"smilies/bockanje.gif\" alt=\"icon\"/>!!!";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete bocnuti ovog clana!<br/>\n";
	}
echo $fsize2;
break;
//----------------------- RUZA -------------------------------

case 'ruza':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes2 WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO likes3 SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Ruza uspesno poslata!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Ruza";
 
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);


$message = "Clan <b>$napisao[0]</b> Vam je poklonio ruzu <img src=\"smilies/ruza.jpg\" alt=\"icon\"/>!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete pokloniti ruzu ovom chlanu!<br/>\n";
	}
echo $fsize2;
break;
//---------------------- UNLIKE -----------------------------------

case 'unlike':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO likes SET uid='".$who."', who='".$id."', likes='0'");
    if($res)
    {
    echo "Unlike je uspesno dodat!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Ne voli";
 
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Vas ne voli!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete ne voleti ovog clana!<br/>\n";
	}
	echo "$who $id";
echo $fsize2;
break;

case 'brisi':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$cid = $_GET["cid"];
	if($row["level"]>10 || $who==$id){
    $res = mysql_query("DELETE FROM comments WHERE id='".$cid."'");
    if($res)
    {
    echo "Komentar je uspesno obrisan!<br/>";
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete brisati komentar!<br/>";
	}
echo $fsize2;
break;

//----------------------- LIKE1 --------------------------------
case 'like1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov1<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM likes WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Nema procene za clana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=like1\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=like1\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;
//-------------------- LIKE2 -------------------------------------

case 'like2':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov7<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes2 WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM likes2 WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Nema procene za clana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=like2\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=like2\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;
//------------------ KIS1 -----------------------------------------

case 'like2':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov7<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes2 WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM likes2 WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Nema procene za clana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=like2\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=like2\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;
//------------------------ LOS ------------------------------------

case 'prosecan':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov7<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM prosecan WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM prosecan WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Jos uvek niko nije oceni chlana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=prosecan\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=prosecan\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;

case 'dobar':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov8<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM dobar WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM dobar WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Jos uvek niko nije oceni chlana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=dobar\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=dobar\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;
//------------------ IZUZETAN --------------------------------------
		
case 'izuzetan':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov9<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM izu WHERE uid='".$who."' AND likes='1'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM izu WHERE uid='".$who."' AND likes='1' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Jos uvek niko nije oceni chlana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=izuzetan\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=izuzetan\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;
//---------------------- UNLIK2 -----------------------------------

case 'unlike2':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$who = $_GET["who"];
echo "$naslov8<br/>";
echo $divide;

    if($page=="" || $page<=0)$page=1;

    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes2 WHERE uid='".$who."' AND likes='0'"));
    $user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT who FROM likes2 WHERE uid='".$who."' AND likes='0' ORDER BY id DESC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
    {
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

       echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$item[0]&amp;ref=$ref\">$napisao[0]</a>"; 
	   echo "<br/>";
    }
    }else{
	echo "<br/>Nema procene za clana $user[0]!<br/>";
	}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"comments.php?page=$ppage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=unlike2\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"comments.php?page=$npage&amp;$ses&amp;ref=$ref&amp;who=$who&amp;mod=unlike2\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
echo $fsize2;
break;
//------------------------ LOS1 -----------------------------------
case 'los1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM los WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO los SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Uspesno ste ocenili chatera kao loseg!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Ocena";

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Vas je ocenio kao loseg chatera <img src=\"smilies/cem.gif\" alt=\"icon\"/>!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Niko nije dao losu ocenu clanu!<br/>\n";
	}
echo $fsize2;
break;
//------------------------- PROSECAN1 ------------------------------------

case 'prosecan1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM prosecan WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO prosecan SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Uspesno ste ocenili chatera kao prosecnog!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Ocena";

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Vas je ocenio kao prosecnog chatera <img src=\"smilies/cem.gif\" alt=\"icon\"/>!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Niko nije dao prosecnu ocenu clanu!<br/>\n";
	}
echo $fsize2;
break;
//-------------------------------- DOBAR1 -------------------------------
		
case 'dobar1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM dobar WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO dobar SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Uspesno ste ocenili chatera kao prosecnog!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Ocena";

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Vas je ocenio kao dobrog chatera <img src=\"smilies/cem.gif\" alt=\"icon\"/>!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Niko nije dao dobru ocenu clanu!<br/>\n";
	}
echo $fsize2;
break;
//--------------------------- IZUZETAN1 --------------------------------
		
case 'izuzetan1':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM izu WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO izu SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Uspesno ste ocenili chatera kao izuzetnog!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Ocena";

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Vas je ocenio kao izuzetnog chatera <img src=\"smilies/cem.gif\" alt=\"icon\"/>!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Niko nije dao izuzetnu ocenu clanu!<br/>\n";
	}
echo $fsize2;
break;
//----------------------- ALC ---------------------------------
		
case 'alc':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes2 WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO likes2 SET uid='".$who."', who='".$id."', likes='1'");
    if($res)
    {
    echo "Pivo uspesno poslato!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Pivo";
 
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Vam je poklonio pivo <img src=\"smilies/alc.gif\" alt=\"icon\"/>!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete pokloniti pivo ovom chlanu!<br/>\n";
	}
echo $fsize2;
break;
//----------------------- UNLIKEE ---------------------------------
		
case 'unlikee':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
$who=$_GET["who"];
echo $fsize1;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM likes2 WHERE uid='".$who."' AND who='".$id."'"));
if($row["posts"]>=300 && $vec[0]==0 && $who!=""){
    $res = mysql_query("INSERT INTO likes2 SET uid='".$who."', who='".$id."', likes='0'");
    if($res)
    {
    echo "Procena je uspesno dodat!<br/>";
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$kome=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];		
$administration = check($administration);		
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Ne voli";
 
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$napisao[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$napisao[0] = EdykaColor($napisao[0],$zs1["color"],$zs1["specolor"]);

$message = "Clan <b>$napisao[0]</b> Ocenio vas je kao izuzetnog chatera!!<br/>";
$upusupus=mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$kome[0]."', idtowhom = '".$who."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete ne voleti ovog clana!<br/>\n";
	}
	echo "$who $id";
echo $fsize2;
break;
//--------------------------- BRISI --------------------------------
		
case 'brisi':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
$cid = $_GET["cid"];
	if($row["level"]>10 || $who==$id){
    $res = mysql_query("DELETE FROM comments WHERE id='".$cid."'");
    if($res)
    {
    echo "Komentar je uspesno obrisan!<br/>";
    }else{
    echo "Greska na bazi!<br/>";
    }
	}else{
	echo "Ne mozete brisati komentar!<br/>";
	}
echo $fsize2;
break;
//-----------------------------------------------------------------
}
echo $fsize1;
echo $divide;
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM comments WHERE user='".$who."' AND who='".$id."'"));
if($vec[0]==0 && $row["posts"]>=300){
if(!$mod) echo "<a href=\"comments.php?$ses&amp;ref=$ref&amp;who=$who&amp;mod=pisi\">Dodaj Komentar</a><br/>\n";
}
if(isset($who) && $who>0){
$sexer = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));

$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$sexer[0]."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$sexer[0] = EdykaColor($sexer[0],$zs1["color"],$zs1["specolor"]);


if($mod) echo "<a href=\"comments.php?$ses&amp;ref=$ref&amp;who=$who\">$sexer[0] Komentari</a><br/>\n";
echo "<a href=\"info.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;nk=$who&amp;ref=$ref\">$sexer[0] Profil</a><br/>";
}
if (isset ($rm))echo "<a href=\"chat.php?$ses&amp;rm=$rm\">Chat Soba</a><br/>\n"; 
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>