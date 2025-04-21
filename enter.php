<head>
  <title>Znak Ljubavi</title>
  <!-- ostali meta tagovi i CSS linkovi -->
</head>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
if (($ver!="wml")&&($ver!="xhtml")){
$ver="xhtml";
}

if ($ver=="wml") header ("Content-type:text/vnd.wap.wml; charset=UTF-8");
else if ($ver=="xhtml") header("Content-Type:text/html; charset=UTF-8");
else header ("Content-type:text/vnd.wap.wml; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
$us=$row["user"];
$sex=$row["sex"];
$level=$row["level"];
$ggggg=$row["gzip"];
if($ggggg=="1"){
include("gz.php");
}


/////////////////////////////////////////////////////
$tren=time();
$tren1=$tren-(60*60*24*5);
$brisi=mysql_query("DELETE FROM zapiski WHERE time<'".$tren1."' AND readd='1'");
/////////////////////////////////////////////////////
$setting = mysql_query ("Select * from setting where klu4='1'");
$set = mysql_fetch_array ($setting);

$nopop = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM bockanje WHERE touid='".$id."' AND unread='1'"));
//------------------------------------------

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title><?=$nazivsajta?></title>
<?php if ($row["css"]==""){?>
<link rel="stylesheet" type="text/css" href="css_enter/stile2.css?k=<?=mt_rand(111111,999999)?>">
<?php 
}else{
?><link rel="stylesheet" type="text/css" href="css_enter/stile2.css?k=<?=mt_rand(111111,999999)?>">
<?php
}
?>

<body onLoad="clock_form()" style="font-size: <?=$row['fsize']?>px">
<?php 
if($nopop[0]>0)
{
?><div id=wrap>
<div align="center">
<?php

include("bockanje.php");
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
?>
</div></body></html>
<?php
mysql_close($link);
exit;
}

$ulaz = mysql_fetch_array(mysql_query("SELECT id, posts FROM `users` WHERE id='".$id."'"));
if($ulaz[1]<'100'){
?>
<div align="center">
<?php
echo $fsize1;
?>
Dok ne sakupite 100 postova mozete pristupiti samo u 
 <a href="chat.php?ver=<?=$ver?>&amp;id=<?=$id?>amp;ps=<?=$ps?>&amp;ref=<?=$ref?>&amp;rm=11\"> <b><u>Welcome Sobica!!!</u></b></a>
</div>
<?php
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
mysql_close($link);
exit;
}
?>
<div align="center">
<?php
///////////////////////////////////////////
$gde="Hodnik";
include("gde.php");
///////////////////////////////////////////
echo $fsize1;
$gornji=$set["gornji"];
$gornjilink=$set["gornjilink"];
$linklink=$set["linklink"];
if($linklink=="1"){
$naslov=htmlspecialchars("$gornji");
?>
<a href="<?=$gornjilink?>"><?=$fsize1.$naslov.$fsize2?></a><br/>
<?php
}
?>
<div class="altertekst">
<div class="d1">
    <?
require("birthday.php");
require("calendar.php");
echo $fsize2;

?>
</div></div>



<div class="d100">
<?php

if($row['sex'] == "M") {
  $dobrodosa = "<span style='color:{$row['color']}'>" .$us. "</span>, Dobro dosao na </br> <img src='css_enter/m.gif' alt='Dobro dosli'>";
}

else
	 $dobrodosa =  "<span style='color:{$row['color']}'>" .$us. "</span>, Dobro dosla na <img src='css_enter/z.gif' alt='Dobro dosli'>";
echo $fsize1.$dobrodosa.$fsize2;

?>
</div>
<?php

if ($row["level"]>6){
//----------------- Blokirani ----------------------------//
$nb = mysql_fetch_array(mysql_query("Select count(id) From users Where blokada=1"));
if(isset($nb) && $nb[0] > 0){
?>
<div class=padding>
<a href="statistik.php?<?=$ses?>&amp;mod=blokada&amp;ref=<?=$ref?>"><?=$fsize1?>Blokiranih
	<?=$nb[0]?><?=$fsize2?></a>
</div>
<?php
}
//--------- 26.121.2017 Tihiokean ------------------------//
?>
<div class="altertekst">
<div class="d1">
<img src="smile/admins.gif" alt="*"> <a href="panel.php?<?=$ses?>&amp;ref=<?=$ref?>"><?=$fsize1?>Vlasnicki Panel<?=$fsize2?></a> |

<img src="smile/admin.gif" alt="*"> <a href="apanel.php?<?=$ses?>&amp;ref=<?=$ref?>"><?=$fsize1?>Admin CP<?=$fsize2?></a> |

	<img src="smile/vicoteka.png" alt="*"> <a href="potpisi2.php?ver=<?=$ver?>&amp;id=<?=$id?>&amp;ps=<?=$ps?>&amp;ref=<?=$ref?>"><?=$fsize1?>Razglas Na Pocetnoj<?=$fsize2?></a> |
	
	<img src="smile/vicoteka.png" alt="*"> <a href="potpisi4.php?ver=<?=$ver?>&amp;id=<?=$id?>&amp;ps=<?=$ps?>&amp;ref=<?=$ref?>"><?=$fsize1?>Razglas Na Pocetnoj2<?=$fsize2?></a><br></div></div>
<?php
//echo $divide;
}
if ($row["level"]>3){
?><div style="text-align: left"><ul class=opcije><?php
if($set["superpanel"] == 0){ ?><li> Nocna zastita je ukljucena</li>
<?php }	
if($set["sigurnareg"] == 1){?><li>Uzastopna registracija je zabranjena</li>
<?php }
if($set["reg"] == 0){?><li>Registracija je u potpunosti zabranjena</li>
<?php }
if($set["valid"] == 1){?><li>Validacija registracije je ukljucena</li>
<?php }
if($set["banban"] == 0){?><li>Anonymous Browseri Zabranjeni</li>
<?php }	
	?></ul></div>
<div class="altertekst">
    <div class="d1">
<img src="smile/moderator.png" alt="*"> <a href="mpanel.php?<?=$ses?>&amp;ref=<?=$ref?>"><?=$fsize1?>Mod CP<?=$fsize2?></a>
<br></div></div>
<?php
echo $divide;
}
if($set["logo2"]!=""){
?>
 <div class=d100r>
<img src="logo/<?=$set["logo2"]?>" alt="Loading...">
</div>
<?php 
}
$cmc = mysql_query ("select count(id) as num from obavestenja");
$cmac = mysql_fetch_array($cmc);
$cmtot = $cmac["num"];
/////////////////////////////////////////////////////////////
?>
<div class="altertekst" style="padding: 5px 0px"><b><?=$fsize1?>Statusi<?=$fsize2?> <?=$nazivsajta?></b></div>
<p align="">
<?php
if($page=="" || $page<=0)$page=1;
$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM stihovi90"));
$num_items = $noi[0]; //changable
$items_per_page= 2;
$num_pages = ceil($num_items/$items_per_page);
if(($page>$num_pages)&&$page!=1)$page= $num_pages;
$limit_start = ($page-1)*$items_per_page;

$sql = "SELECT id, uid, text, time FROM stihovi90 ORDER BY id DESC LIMIT $limit_start, $items_per_page";

$items = mysql_query($sql);
echo mysql_error();
if(mysql_num_rows($items)>0)
{
while ($item = mysql_fetch_array($items))
{
?><!--<p align="">-->
<?php
$naslov=htmlspecialchars("$item[2]");
$naslov=getsmilies($naslov, $item[1]);
$naslov=zamena($naslov);
$korisnik = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[1]."'"));
$galleryses = mysql_fetch_array(mysql_query ("SELECT COUNT(*) FROM gallery WHERE user='".$item[1]."'"));
if($galleryses[0]>0){
$slicica = mysql_fetch_array(mysql_query ("SELECT id, file, upload FROM gallery WHERE user='".$item[1]."' ORDER BY RAND() LIMIT 1"));
if($slicica[2]=='1'){$filenamess = "gallery/$randm[2]";}
else{$filenamess = "$slicica[1]";}
?>
<a href="galery.php?mod=viewuser&amp;who=<?=$nk?>&amp;<?=$ses?>&amp;ref=<?=$ref?>"><img src="gallery/<?=$slicica[1]?>" width="35" height="35" alt="<?=$slicica[0]?>"></a>

<?php
} 
?>
<b><a href="info.php?ver=<?=$ver?>&amp;id=<?=$id?>&amp;ps=<?=$ps?>&amp;nk=<?=$item[1]?>&amp;ref=<?=$ref?>"> <?=$fsize1.$korisnik[0]?>:<?=$fsize2?></a></b> 
<?php
$naslov = eregi_replace('https://www\.youtube\.com/watch\?v=([a-zA-Z0-9_-]+)[^ ]*',
'<iframe src="https://www.youtube.com/embed/\1" width="150" height="100" frameborder="0" allowfullscreen></iframe>',
$naslov);
echo "$fsize1.$naslov.$fsize2 ";
if($id==$item[1] || $row["level"]>="8"){
?>
	<a href="stihovi90.php?ver=<?=$ver?>&amp;id=<?=$id?>&amp;ps=<?=$ps?>&amp;action=delete&amp;ref=<?=$ref?>&amp;stih=<?=$item[0]?>"><?=$fsize1?><span class=red>[X]</span><?=$fsize2?></a>
<?php
if($id==$item[1]){
}
}
$glasovi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM stihovi90_vote WHERE sid='".$item[0]."'"));
$glasno = mysql_fetch_array(mysql_query("SELECT SUM(vote) FROM stihovi90_vote WHERE sid='".$item[0]."'"));
$ocena = $glasno[0];
$ocena = $glasovi[0];
$ocena=round($ocena, 2);
?><br><b><span style='color:<?= $row['color'] ?>'><?= $us ?></span>:</b> <?= $fsize1 ?><?= $ocena ?> 

<?php
if ($ocena == 1) {
    $cater = 'Chater voli';
} else {
    $cater = 'Chatera vole';
}

 if($id==$item[1]){	 
?>
<a href="stihovi90.php?ver=<?=$ver?>&amp;id=<?=$id?>&amp;ps=<?=$ps?>&amp;action=glasovi&amp;ref=<?=$ref?>&amp;stih=<?=$item[0]?>"><?=$cater?>  ovaj status?<?=$fsize2?></a><br/>
<?php
 }else{
?><?=$cater?>  ovaj status?<?=$fsize2;	
} 
//}
$uploadsss = mysql_query("UPDATE stihovi1 SET vote='".$ocena."' WHERE id='".$item[0]."'");
$glasao = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM stihovi90_vote WHERE sid='".$item[0]."' AND uid='".$id."'"));
if($glasao[0]==0 && $id!=$item[1]){
?>
<form method="post" action="stihovi90.php?ver=<?=$ver?>&amp;id=<?=$id?>&amp;ps=<?=$ps?>&amp;action=vote&amp;ref=<?=$ref?>" name="auth">
<p align="">
<input type="hidden" name="stih" value="<?=$item[0]?>">
<input type="submit" value="Svidja mi se!" name="enter"></form>
<?php
}
}  
}else{
?>
<br><?=$fsize1?>Trenutno nema statusa!<?=$fsize2?><br>
<?php
}
echo $fsize1;
?><!--<p align="center">--><?php
$vec=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM stihovi90 WHERE user='".$who."' AND who='".$id."'"));
if($vec[1]==0 && $row["posts"]>=500){
?>
<form method="post" action="stihovi90.php?ver=<?=$ver?>&amp;id=<?=$id?>&amp;ps=<?=$ps?>&amp;action=new1&amp;ref=<?=$ref?>" name="auth">
<br><input name="naziv" maxlength="600"><br>
<input class="button" type="submit" value="Dodaj" name="enter"></form>

<?php
}else{
?>
<b>Za objavu statusa na zidu potrbno vam je 500 postica!</b><br/>
<?php
	}
	if($page>1)
    {
      $ppage = $page-1;
      ?><br/><a href="enter.php?ver=<?=$ver?>&amp;id=<?=$id?>&amp;ps=<?=$ps?>&amp;page=<?=$ppage?>&amp;ref=<?=$ref?>">Nazad</a>
	<?php
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      ?><br/><a href="enter.php?ver=<?=$ver?>&amp;id=<?=$id?>&amp;ps=<?=$ps?>&amp;page=<?=$npage?>&amp;ref=<?=$ref?>">Predhodni status</a>
	<?php
    }
        echo $rets;

echo $divide;
$news=mysql_fetch_array(mysql_query("SELECT date FROM news ORDER BY id DESC LIMIT 0,1"));
if (isset($news[0])){ 
?>
<div class='paddin_g'>
<img src="smile/novosti.png" alt="*"> <a href="news.php?<?=$ses?>&amp;ref=<?=$ref?>">Novosti(<?=$news[0]?>)</a>
</div>
<?php
}
///////////////////////////////RAZGLAS
$q = mysql_query("select id,title from obiav order by id desc;");
$y = 0;$title_t = array();
while($arr=mysql_fetch_array($q)) {
$titlet=$arr['title'];
$titlet=zamena($titlet);
$title_t[$y] = $titlet;
$y++;
}

?><div class=obiv2><div class=obiv style=""><marquee direction="left" behavior="SCROLL|SLIDE|ALTERNATE"><font class=hillock><a href="/info.php?&amp;nk=12"><font color="#7197d1">ภ</font><font color="#7197d1">є</font><font color="#7197d1">ภ</font><font color="#7197d1">ค</font><font color="#7197d1">๔ </font></a></font><img src="smilies/365-73535.gif">"U životu nije važno ono što vam se dogodi, nego ono čega se sećate i način na koji to pamtite" <img src="" alt=""/><img src="smilies/365-73535.gif"><br/><br/></marquee>
<?php
$nb = count($title_t);$wid = 100/$nb;
for($i = 0; $i < $nb; $i++){
?><div style="width: <?=$wid?>%; float:left;">
<a href="view_obiav.php?<?=$ses?>&amp;mid=<?=$arr['id']?>&amp;ref=<?=$ref?>"><?=$title_t[$i]?></a>
</div>

<?php
}

	?><div class-clear></div></div></div>
<?php
//////////////////////////////////////////////////////////////////////ramdom slika iz galerije//////////////////////////////////////
////////////////////////////////////////////////////ramdom slika iz galerije//////////////////////////////////////
echo "<b><u>Slika korisnika:</u></b><br/>";
$eeee=mysql_fetch_array(mysql_query("SELECT id FROM gallery ORDER BY RAND() LIMIT 1"));
$rmg=mysql_fetch_array(mysql_query("SELECT file, user FROM gallery WHERE id='".$eeee[0]."'"));
$pos4 = mysql_fetch_array(mysql_query("SELECT user, color FROM users WHERE id='".$rmg[1]."'"));
echo "<img src=\"gallery/$rmg[0]\" width=\"100\" height=\"100\" alt=\"Chat\"/>";
echo "<br/><a href=\"info.php?$ses&amp;ref=$ref&amp;nk=$rmg[1]\"style=\"color:".$pos4['color'].";\">".$pos4['user']."</a><br/>";
?>
<br>
<div style="border-top: 2px solid black;"></div>
<br>
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$raz=$set["razglas"];
$raz1=$set["razglas1"];
if($raz==1){
include("razglas1.php");
}
?><?php
if($raz1==1){
include("razglas2.php");
}
?>


<!--<p align="center">-->	
<?=$fsize2?><?=$fsize1?>

<div class="altertekst">
<div class="d1">
<img src="smile/opcije.png" alt="*"> <a href="opcije.php?<?=$ses?>&amp;ref=<?=$ref?>">Opcije Chata</a> |

<img src="smile/teme.png" alt="*"> <a href="teme.php?<?=$ses?>&amp;ref=<?=$ref?>">Promena tema</a> |

    
<?php
/**/
/* $aktivno1=$set["gallery"];
$aktivno3=$set["gtitle"];
if($aktivno1==1){
$foto1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM newgallery"));
echo "<a href=\"newgalery.php?$ses&amp;ref=$ref\">$aktivno3($foto1[0])</a>kk<br/>";
} */
$gallery = mysql_query ("SELECT COUNT(*) FROM gallery");
$foto = mysql_fetch_array($gallery);
?>
<img src="smile/galerija.png" alt="*"> <a href="galery.php?<?=$ses?>&amp;ref=<?=$ref?>">Galerija(<?=$foto[0]?>) </a> |

	
<img src="smile/obavestenja.png" alt="*"> <a href="obavestenja.php?<?=$ses?>&amp;ref=<?=$ref?>">Obavestenja(<?=$cmtot?>)</a><br></div></div>

<a href="forum.php?<?=$ses?>&amp;ref=<?=$ref?>"><img src="smile/forum.gif" alt="*"></a> <br>
<?php
$lpts =mysql_query("SELECT id, uid, name FROM topics ORDER BY last DESC LIMIT 0,3");
 ?><div style="text-align: left"><ul style="list-style-type: none; padding-left: 10px;"><?php
while ($lpt = mysql_fetch_array($lpts))
{
$nops =mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM posts WHERE tid='".$lpt[0]."'"));
if($lpt[0]==0)
{
$pinfo = mysql_fetch_array(mysql_query("SELECT user,color,specolor FROM users WHERE id='".$lpt[1]."'"));
$tluid = $pinfo[0];
}else{
$pinfo = mysql_fetch_array(mysql_query("SELECT uid FROM posts WHERE tid='".$lpt[0]."' ORDER BY id DESC LIMIT 0,1"));
$tluid = $pinfo[0];
}
$pos4 = mysql_fetch_array(mysql_query("SELECT user,color,specolor FROM users WHERE id='".$tluid."'"));
$pos4[0] = EdykaColor($pos4[0],$pos4[1],$pos4[2]);
$items_per_page= 10;
$num_pages = ceil($nops[0]/$items_per_page);
$imeime=htmlspecialchars("$pos1[2]");
?>
<li>
<div align="center"><a href="forum.php?<?=$ses?>&amp;ref=<?=$ref?>&amp;action=topic&amp;tid=<?=$lpt[0]?>&amp;page=<?=$num_pages?>"><b>&#187;</b><?=$lpt[2]?></a>
<?php
if(!empty($pos4[1])) $pos4[0] = '<font color="#'.$pos4[1].'">'.$pos4[0].'</font>';
	?>, od <a href="info.php?<?=$ses?>&amp;ref=<?=$ref?>&amp;nk=<?=$tluid?>"><?=$pos4[0]?></a></li>
<?php
}?></ul><?php
$tema = mysql_fetch_array(mysql_query("SELECT id, name FROM topics ORDER BY RAND() LIMIT 1"));
?><ul style="list-style: none; padding-left: 10px">
	<li><b><div align="center">Slucajan Izbor Teme:</b></li>
	<li>
<div align="center"><a href="forum.php?<?=$ses?>&amp;ref=<?=$ref?>&amp;action=topic&amp;tid=<?=$tema[0]?>"><?=$tema[1]?></a><br>
		</li></ul></div>
<?php
$r = mysql_query ("select count(readd) as num from zapiski WHERE (idtowhom = '".$id."')and(readd = '0')and(ininc = '1');");
$a = mysql_fetch_array($r);
$inb = $a["num"];
if($inb != "0") {?>
<img src="smile/new6.gif" alt=""/><b>Vase pismo<a href="inbox.php?<?=$ses?>&amp;ref=<?=$ref?>">(<?=$inb?>)</a></b><?=$zvukinbox?><hr><?php
}
//////////////////////////////////////////////////////////////
 $daj = mysql_query("SELECT * FROM maticar WHERE uid = '".$id."' AND ascept ='0';");
$zahtev = mysql_fetch_array($daj);
$ascept = $zahtev['ascept'];
$aid  = $zahtev['aid'];
$uid = $zahtev['uid'];

if($ascept == '0')
{
$vadi = mysql_query("SELECT user FROM users WHERE id = '".$aid."';");
while($data = mysql_fetch_array($vadi))
{
$mnick = $data['user'];
}
echo "<b><img src=\"smile/new.gif\" alt=\"photo\"> $mnick Vas Obozava</b><br/>\n";
echo "<b><img src=\"smile/new.gif\" alt=\"photo\" /> $mnick Vas Obozava </b> <a href=\"maticar.php?$ses&amp;ref=$ref&amp;mod=add&amp;uid=$aid\"> Prihvati Vezu Ili Brak</a> <br/>\n";
}
if($row["level"]>7)
{
$newtod=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE valid=0 AND id>'8'"));
if ($newtod[0]>0){
echo "<img src=\"smile/new2.gif\" alt=\"\"/><a href=\"statistik.php?$ses&amp;mod=valid&amp;ref=$ref\">Validacija(".$newtod[0].")</a><img src=\"smile/new2.gif\" alt=\"\"/><br/>";
}
}  
////////////////////////////////////////////////////////////
?>
<div class="altertekst">
    <div class="d1">
<img src="smile/flert.png" alt="*"> <a href="upoznavanja.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>"> Upoznavanja</a> |

<img src="smile/ppo.gif" alt="*"> <a href="pokloni.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>">Pokloni</a> |
	
<?php
$anketa=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ankete"));
$anket=$anketa[0]-1;
if($anket<0)$anket=0;
?>
<img src="smile/anketa.png" alt="*"> <a href="kutak.php?<?=$ses?>&amp;ref=<?=$ref?>"> Anketni Kutak (<?=$anket?>)</a> |
<?php
$glasackak=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM kutija"));
$glas=$glasackak[0]-1;
if($glas<0)$glas=0;
$panel=$set["superpanel"];
/* if($panel==1){ */
?>
<img src="smile/kutija.png" alt="*"> <a href="kutija.php?<?=$ses?>&amp;ref=<?=$ref?>"> Glasacka Kutija (<?=$glas?>)</a><br></div></div>

<?php
/* } */
?></div><div class=clear></div>
</div>
<?php
echo $divide;
$aktivno1=$set["gallery"];
$aktivno3=$set["gtitle"];
if($aktivno1==1){
$foto1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM newgallery"));
?><div style="text-align: center;">
<img src="smile/usne.jpg" alt="*"> <a href="newgalery.php?<?=$ses?>&amp;ref=<?=$ref?>"><?=$aktivno3?>(<?=$foto1[0]?>)</a><br>
<?php
}	
?>

<div class="altertekst">
    <div class="d1">
<?php

$utisaka=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM knjiga"));
$knjiga=$set["superpanel"];
if($knjiga==1){
?>
<img src="smile/knjiga22.gif" alt="*"> <a href="knjiga.php?<?=$ses?>&amp;ref=<?=$ref?>"> Knjiga Utisaka (<?=$utisaka[0]?>)</a> |
	
<?php
}
//----- Vicoteka == Knjiga utisaka -- Stihoteka -- Download --//
$viceva=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM vicoteka"));
$vic=$set["superpanel"];
$albumssss = mysql_fetch_array(mysql_query ("SELECT COUNT(*) FROM stihovi"));
?>

<img src="smile/stihovi.png" alt="*"> <a href="stihovi.php?<?=$ses?>&amp;ref=<?=$ref?>"> Stihoteka(<?=$albumssss[0]?>)</a> |
	
	<img src="smile/vicoteka.png" alt="*"> <a href="vicoteka.php?<?=$ses?>&amp;ref=<?=$ref?>">Vicoteka (<?=$viceva[0]?>)</a> |
	
	<img src="smile/igrice.png" alt="*"> <a href="igrice.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>">Igrice </a><br></div>
</div>
<?php
/* } */
?></div><div class=clear></div>
</div>

<?php
//----------- YUtube ----------------------
$tube = mysql_fetch_array(mysql_query ("SELECT COUNT(*) FROM tuboteka"));
?>
<div style="text-align: center;">
<img src="smile/youtube.jpg" alt="*"> <a href="tuboteka.php?<?=$ses?>&amp;ref=<?=$ref?>"> You Tube(<?=$tube[0]?>)</a><br>
<?

$manje = time()-180000;
$gdeko = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$manje."'"));
	?>

</br>
<div style="border-top: 2px solid black;"></div>

<img src="smile/online.png" alt="*">
<a href="who.php?<?=$ses?>&amp;ref=<?$ref?>">
    Ko je gde: <span class="badge"><?=$gdeko[0]?></span>
</a>

<div style="border-top: 2px solid black;"></div>


	
<?php
$down = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM downs "));
?>
	</div></div>
	<div class=clear></div>
</div>
<?php
/* //----- Upoznavanja, Pokloni, Igrice, Flash igrice ---------//
?>
<hr><div><div class=d11>
<div class=d121>
<img src="smile/flert.png" alt="*"/><a href="upoznavanja.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>"> Upoznavanja</a>
</div><div class=d131>
<img src="smile/ppo.gif" alt="*"/><a href="pokloni.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>">Pokloni</a>
	</div></div><div class=d22>
<div class=d121>
<img src="smile/sd.gif" alt="*"/><a href="igrice.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>">Igrice </a>
</div><div class=d131>
<img src="smile/sd.gif" alt="*"/><a href="flesh.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>">Flash igrice (za pc novo) </a>
	</div></div><div class=clear></div></div>
<?php */
//echo "<a href=\"who.php?$ses&amp;rm=$rm&amp;ref=$ref\"><b><i>**Glavne Sobe**</big></i></b></a><br/>";

//////////////////////SOBE SOBE SOBE SOBE SOBE///////////////////////////////
echo $divide;
$dopu = mysql_fetch_array(mysql_query("SELECT dopustanje, dopustanjet FROM users WHERE id='".$id."'"));
$roomselect = mysql_query ("SELECT name,rm FROM rooms ORDER BY pozicija, rm LIMIT 0,23;");
?><div align="center"><ul class=room><?php
while($rooms = mysql_fetch_array($roomselect)) {
$roomname=$rooms["name"];
$rm=$rooms["rm"];
$room="room".$rm;
$tm = time()-1800;
$tm111 = time()-1800;
$r = mysql_query("SELECT id FROM users WHERE gdetime>'".$tm111."' AND gde='room".$rm."'");
$asnum = mysql_affected_rows();
$siz[$rm] = $asnum;
if ($rm==11) {
?><li><img src="css_enter/005.gif" alt="*"> <a href="chat.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>"><?=$roomname.'('.$siz[$rm].')'?></a>
</li><?php
} else if ($rm==10) {
?><li><img src="css_enter/005.gif" alt="*"> <b><a href="intim.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>"><?=$roomname?>(<?=$siz[$rm]?>)</a></b>
</li><?php
} else if ($rm==7) {
if($row["level"]>=7 ||(($dopu[0]==1)&&($row["level"]>3))){
?><li><img src="css_enter/005.gif" alt="*"> <b><a href="chat.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=$ref&amp;modlog=1"><?=$roomname?>(<?=$siz[$rm]?>)</a></b>
</li><?php
}
} else if ($rm==8) {
if($row["level"]>3){
?><li><img src="css_enter/005.gif" alt="*"> <b><a href="chat.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>&amp;modlog=1"><?=$roomname?>(<?=$siz[$rm]?>)</a></b>
</li><?php
}
} else {
?><li><img src="css_enter/005.gif" alt="*"> <a href="chat.php?<?=$ses?>&amp;rm=<?=$rm?>&amp;ref=<?=$ref?>"><?=$roomname?>(<?=$siz[$rm]?>)</a>
	</li><?php
}
}
//----- Upoznavanja, Pokloni, Igrice, Flash igrice ---------//
?>
<div class="altertekst">
    <div class="d1">

<img src="smile/maticar1.gif" alt="*"> <a href="maticar.php?<?=$ses?>&amp;ref=<?=$ref?>">Maticni Ured</a> |

<img src="smile/linkovi.png" alt="*"> <a href="linkovi.php?<?=$ses?>&amp;ref=<?=$ref?>">Linkovi</a> |

<?php if($row['posts'] >= 1000){?>
<img src="smile/statistika.png" alt="*"><a href="statistik.php?<?=$ses?>&amp;ref=<?=$ref?>"> Statistika</a>	
	<?php }else{?>&nbsp;<?php }?>
	

<br></div></div>

<?php
//----------- kraj ------------------
/* echo $divide; */
?>

<div style="text-align: center">
<img src="smile/ffg.gif" alt="*"> <a href="statistik.php?<?=$ses?>&amp;mod=danas&amp;ref=<?=$ref?>"> Aktivni Chateri Danas</a>
</div>

<!--------------- Rodjendani, novi cateri --------->
<div class=rodjendan>
<ul style="list-style: none; padding-left: 10px;">
<?php
$d=date("d-m-");
$birth = mysql_fetch_array(mysql_query ("Select count(id) from users where birth LIKE '%$d%'"));
if ($birth[0]==1) {
?><li>
Rodjendan:<a href="statistik.php?<?=$ses?>&amp;mod=birthday&amp;ref=<?=$ref?>">(<?=$birth[0]?>)</a>
</li>
<?php 
}else if($birth[0]>1){
?><li>Rodjendani:<a href="statistik.php?<?=$ses?>&amp;mod=birthday&amp;ref=<?=$ref?>">(<?=$birth[0]?>)</a>
</li>
<?php }
$curdate=date("d-m-Y");
$newtoday=mysql_fetch_array(mysql_query("SELECT COUNT(id) from users WHERE date = '".$curdate."'"));
if ($newtoday[0]>0){
?><li><div align="center"><img src="smile/new6.gif" >Novi Chateri:<a href="statistik.php?<?=$ses?>&amp;mod=newtoday&amp;ref=<?=$ref?>">(<?=$newtoday[0]?>)</a>
</li>
<?php
}
?></ul></div>
<!------ Kraj Rodjendani, novi cateri-->
<?php
/*$tm = time()-1800;
 $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$tm."' AND `gde` NOT LIKE CONVERT(_utf8 '%room%' USING latin1) AND gde!='Inbox' AND gde!='Salje Pismo' AND gde!='Poslata Pisma' AND gde!='Cita Pismo' AND gde!='Tuboteka'")); */
/* echo " Hodnik: <b><a href=\"prwho.php?$ses&amp;ref=$ref\">(".$noi[0].")</a></b><br/><br/>"; */
?>

<div align="center"><a href=exit.php>
    Izloguj se</a><br/></div></body></html>
<div class=verzija>	
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$time = getmicrotime();                     ///
$tm = time()-1800;                           ///
$tm111 = time()-1800;                        ///
////////////////////////////////////////////////////////////
echo $fsize2;
include("gzip.php");
echo $fsize1;
/* if ($ver=="wml"){
echo "<br/>";
}else{
echo "<br/><br/>";
} */
$link1=$set["link1"];
$link1_name=$set["link1_name"];
$link2=$set["link2"];
$link2_name=$set["link2_name"];
$link3=$set["link3"];
$link3_name=$set["link3_name"];
if($link1!="" && $link1_name!=""){
if ($ver=="wml"){
$naslov1=htmlspecialchars("$link1_name");
echo "<a href=\"$link1\">$naslov1</a><br/>";
}else{
$naslov1=htmlspecialchars("$link1_name");
echo $fsize2;
echo "<div class=\"d1\">";
echo $fsize1;
echo "<a href=\"$link1\">$naslov1</a>";
echo $fsize2;
echo "</div>";
echo $fsize1;
}
}
if($link2!="" && $link2_name!=""){
/* if ($ver=="wml"){
$naslov2=htmlspecialchars("$link2_name");
echo "<a href=\"$link2\">$naslov2</a><br/>";
}else{ */
$naslov2=htmlspecialchars("$link2_name");
echo $fsize2;
echo "<div class=\"d1\">";
echo $fsize1;
echo "<a href=\"$link2\">$naslov2</a>";
echo $fsize2;
echo "</div>";
echo $fsize1;
//}
}
if($link3!="" && $link3_name!=""){
/* if ($ver=="wml"){
$naslov3=htmlspecialchars("$link3_name");
echo "<a href=\"$link3\">$naslov3</a><br/>";
}else{ */
$naslov3=htmlspecialchars("$link3_name");
echo $fsize2;
echo "<div class=\"d1\">";
echo $fsize1;
echo "<a href=\"$link3\">$naslov3</a>";
echo $fsize2;
echo "</div><br/>";
echo $fsize1;
//}
}
?><div class="altertekst">
    <div class="d1">
<div style="text-align: center; font-size: 100%; border: 0px solid black; padding: 5px;">
    Created By *NeNaD* 2023
</div></div>
<?php
//echo $fsize2;
//link
//echo $fsize2;
?></div><?=$fsize2?>
</div></body></html><?php
mysql_close ($link);
ob_end_flush();

	?>