<?php  
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php"); 
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

///////////////////////////////////////////
$gde="Need For Speed";
include("gde.php");
////////////////////////////////////////////
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"enter\" title=\"Need For Speed\">";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"../".$row["css"]."\">";
echo "<title>Need For Speed</title>";
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
function getuid_nick($nick)
{
  $uid = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE user='".$nick."'"));
  return $uid[0];
}
function getplusses($uid)
{
    $plus = mysql_fetch_array(mysql_query("SELECT posts FROM users WHERE id='".$uid."'"));
    return $plus[0];
}

if($action=="cursa"){
$who = $_GET["who"];
$cine = getnick_uid($who);
$uid = $row['id'];    
echo $fsize1;
$r = mysql_query ("select count(readd) as num from zapiski WHERE (idtowhom = '".$id."')and(readd = '0')and(ininc = '1');");
$a = mysql_fetch_array($r);
$inb = $a["num"];
if($inb != "0") {echo "<img src=\"smile/new.gif\" alt=\"\"/><b>Vase pismo<a href=\"inbox.php?$ses&amp;ref=$ref\">(".$inb.")</a></b><br/>\n";
}
$data = time();
    $cursa = mysql_fetch_array(mysql_query("SELECT data FROM lorin_nfs WHERE uid='".$uid."'"));
    $pauza = $cursa[0] + (3*20);
    if(time()<$pauza){
    $ramas = $pauza - $data;
echo "<img src=\"nfs/notok.gif\" alt=\"X\"/>NE NE NE ne mozes tako brzo da ucestvujes ,sledeca trka moze tek za $ramas sek<br/><br/>";
echo $fsize2;
echo $fsize1;
}else{
        $numele = getnick_uid($who);
    if(strlen($numele)<1)
        {
    echo "<img src=\"nfs/stop.gif\" alt=\"X\"/>Chater ne postoji!<br/><br/>";
        }else{
        if($uid==$who)
        {
    echo "<img src=\"nfs/stop.gif\" alt=\"X\"/>Kako mislis da se trkas sam sa sobom?:))<br/><br/>";
        }else{
        $vitje = mysql_fetch_array(mysql_query("SELECT viteza, cid FROM lorin_nfs WHERE uid='".$uid."'"));
        $vitezamea = $vitje[0];
        $vitezamea1 = $vitje[0]-70;

        $vitezamea2 = $vitezamea-150;
        $vitel = mysql_fetch_array(mysql_query("SELECT viteza FROM lorin_nfs WHERE uid='".$who."'"));
    $vitezalui = $vitel[0];
        $vitezalui1 = $vitel[0]-70;
        $vmeaf = rand($vitezamea1,$vitezamea);
        $vituf = rand($vitezalui1,$vitezalui);
        if ($vitezamea2 > $vitezalui){
echo "<img src=\"nfs/stop.gif\" alt=\"X\"/>Malo hoces da izigravas baju i da izazivas na trku nekoga ciji auto nije u tvom rangu?Mozes se takmiciti sa nekim ciji auto moze da razvije najmanje $vitezamea2! ;)<br/><br/>";
echo $fsize2;                    
}else{
if ($vmeaf > $vituf){
        $win = mysql_fetch_array(mysql_query("SELECT win, cp FROM lorin_nfs WHERE uid='".$uid."'"));
        $win1 = $win[0]+1;
        $win2 = $win[1]+1;
        mysql_query("UPDATE lorin_nfs SET win='".$win1."', cp='".$win2."', data='".$data."' WHERE uid='".$uid."'");
        $plusuri = mysql_fetch_array(mysql_query("SELECT posts FROM users WHERE id='".$uid."'"));
    $upl = $plusuri[0]+200;
    mysql_query("UPDATE users SET posts='".$upl."' WHERE id='".$uid."'");
        $lose = mysql_fetch_array(mysql_query("SELECT lose, cp FROM lorin_nfs WHERE uid='".$who."'"));
        $lose1 = $lose[0]+1;
    $lose2 = $lose[1]+2;
    mysql_query("UPDATE nfs SET lose='".$lose1."', cp='".$lose2."', data='".$data."' WHERE uid='".$who."'");
        $plusuri = mysql_fetch_array(mysql_query("SELECT posts FROM users WHERE id='".$who."'"));
    $upl = $plusuri[0]-50;
        if($plusuri[0]>50)
    {
    mysql_query("UPDATE users SET posts='".$upl."' WHERE id='".$who."'");
    }
         echo $fsize1; 
        echo "<img src=\"nfs/castiga.gif\" alt=\".\"/>Cestitke!<br/>";
        echo "Ti si pobedio u trci i osvojio 200++ a protivnik 50 ++:<br/>";
        echo "<br/>";
        echo "Vasa brzina: <b>$vmeaf <i>Km/h</i></b>";
        echo "<br/>";
        echo "Brzina protivnika: <b>$vituf <i>Km/h</i></b><br/>";
        echo $fsize2;
        }
if ($vmeaf < $vituf){
        $win = mysql_fetch_array(mysql_query("SELECT win, cp FROM lorin_nfs WHERE uid='".$who."'"));
        $win1 = $win[0]+1;
        $win2 = $win[1]+1;
    mysql_query("UPDATE lorin_nfs SET win='".$win1."', cp='".$win2."', data='".$data."' WHERE uid='".$who."'");
        $plusuri = mysql_fetch_array(mysql_query("SELECT posts FROM users WHERE id='".$who."'"));
    $upl = $plusuri[0]+100;
    mysql_query("UPDATE users SET posts='".$upl."' WHERE id='".$who."'");
        $lose = mysql_fetch_array(mysql_query("SELECT lose, cp FROM lorin_nfs WHERE uid='".$uid."'"));
        $lose1 = $lose[0]+1;
    $lose2 = $lose[1]+2;
    mysql_query("UPDATE lorin_nfs SET lose='".$lose1."', cp='".$lose2."', data='".$data."' WHERE uid='".$uid."'");
        $plusuri = mysql_fetch_array(mysql_query("SELECT posts FROM users WHERE id='".$uid."'"));
    $upl = $plusuri[0]-50;
        if($plusuri[0]>50)
    {
    mysql_query("UPDATE users SET posts='".$upl."' WHERE id='".$uid."'");
        }
        echo $fsize1;
        echo "Zao nam je!<br/>";
        echo "Izgubili ste u trci 50 ++ a protivnik je pobedio i osvojio 100 ++<br/>";
        echo "<br/>";
        echo "Brzina protivnika: <b>$vituf <i>Km/h</i></b><br/>";
        echo "<br/>";
        echo "Vasa brzina: <b>$vmeaf <i>Km/h</i></b><br/>";
        echo $fsize2;
        } 
        if ($vmeaf == $vituf){
    $win = mt_rand(1, 2);
        if ($win == 1)
    {
        $win = mysql_fetch_array(mysql_query("SELECT win, cp FROM lorin_nfs WHERE uid='".$uid."'"));
        $win1 = $win[0]+1;
        $win2 = $win[1]+1;
    mysql_query("UPDATE lorin_nfs SET win='".$win1."', cp='".$win2."', data='".$data."' WHERE uid='".$uid."'");
        $plusuri = mysql_fetch_array(mysql_query("SELECT posts FROM users WHERE id='".$uid."'"));
    $upl = $plusuri[0]+2000;
    mysql_query("UPDATE users SET posts='".$upl."' WHERE id='".$uid."'");
        $lose = mysql_fetch_array(mysql_query("SELECT lose, cp FROM lorin_nfs WHERE uid='".$who."'"));
        $lose1 = $lose[0]+1;
    $lose2 = $lose[1]+2;
    mysql_query("UPDATE lorin_nfs SET lose='".$lose1."', cp='".$lose2."', data='".$data."' WHERE uid='".$who."'");
        echo $fsize1;
        echo "Nereseno!<br/>";
        echo "Osvojeni poeni 2000 ++:";
        echo "<br/>";
        echo "Vasa brzina: <b>$vmeaf <i>Km/h</i></b><br/>";
        echo "<br/>";
        echo "Brzina protivnika: <b>$vituf <i>Km/h</i></b><br/>";
        echo $fsize2;
        } 
  if ($win == 2)
    {
        $win = mysql_fetch_array(mysql_query("SELECT win, cp FROM lorin_nfs WHERE uid='".$who."'"));
        $win1 = $win[0]+1;
        $win2 = $win[1]+1;
    mysql_query("UPDATE lorin_nfs SET win='".$win1."', cp='".$win2."', data='".$data."' WHERE uid='".$who."'");
        $plusuri = mysql_fetch_array(mysql_query("SELECT plusses FROM iwbf_users WHERE id='".$who."'"));
    $upl = $plusuri[0]+1000;
    mysql_query("UPDATE ibwf_users SET plusses='".$upl."' WHERE id='".$who."'");
        $lose = mysql_fetch_array(mysql_query("SELECT lose, cp FROM lorin_nfs WHERE uid='".$uid."'"));
        $lose1 = $lose[0]+1;
    $lose2 = $lose[1]+2;
    mysql_query("UPDATE lorin_nfs SET lose='".$lose1."', cp='".$lose2."', data='".$data."' WHERE uid='".$uid."'");
        echo $fsize1;
        echo "Nereseno!<br/>";
        echo "Ali ste izgubili trku na crtama:";
        echo "<br/>";
        echo "Brzina protivnika: <b>$vituf <i>Km/h</i></b><br/>";
        echo "<br/>";
        echo "Vasa brzina: <b>$vmeaf <i>Km/h</i></b><br/>";
        echo $fsize2;
        }
        } 
        }           
    } 
    } 
    }
    }  
if($action!="")echo "<a href=\"nfs.php?action=meni&amp;$ses&amp;ref=$ref\">Nfs Meni</a><br/>";
echo "<a href=\"../enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
echo $fsize1;
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>