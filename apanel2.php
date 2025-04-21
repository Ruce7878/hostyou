<?php

header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");

if (isset($rm)) $takep="&amp;rm=$rm&amp;ref=$ref";
else $takep="&amp;ref=$ref";

$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
$ggggg=$row["gzip"];
if($ggggg=="1"){
include("gz.php");
}
//////////////////////////////////////////////////
$nocna = mysql_fetch_array(mysql_query("SELECT lockpanel FROM setting"));
if ($nocna[0]==0){
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
echo "<b>Forum je privremeno zatvoren! </b><br/>\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
exit;
}

if(isset ($rm)) $takep="&amp;rm=$rm&amp;ref=$ref";
else $takep="&amp;ref=$ref";

if($row["level"] < 7) {
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
echo "Nemate prava pristupa!\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
exit;
}
$sex=$row["sex"];
$us=$row["user"];
$login=$row["user"];
$adm = mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = mysql_fetch_array ($adm);
$administration = $z["user"];

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
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"apanel\" title=\"Admin Panel\">\n";
echo "<p align=\"left\" mode=\"wrap\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Admin Panel</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
$time=date ("H:i");
switch($go) {
default:
if ($passw != chempax_admin2) {
echo "<form method=\"post\" action=\"panel.php?$ses&amp;ref=$ref\">
      Password panela*:<br/>
      <input name=\"passw\" type=\"password\" maxlength=\"15\" title=\"passw\"/><br/>
      <input type=\"submit\" class=\"ibutton\" value=\"OK\"/></form>
	  <br/><a href=\"enter.php?$ses&amp;ref=$ref\">Chat meni</a>";
	  if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
exit;
}
}
}
$time=date ("H:i");
switch($go) {

default:
if ($ver=="wml"){
echo "</p>\n";
echo "<p align=\"left\" mode=\"wrap\">\n";
}else{
echo "</div>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<div class=\"d1\">";
echo "$time   Dobro Dosli u vas Admin Panel <br/>\n";
if ($sex=="M")echo "<b>Pozdrav Uvazeni Gospodine:</b> $us!<br/>\n";
else if ($sex=="Z")echo "<b>Pozdrav Gospodjice:</b> $us!<br/>\n";
echo "</div>";
echo $fsize2;
echo $fsize1;
if($row["level"]>6){
echo "<b><a href=\"apanel.php?$ses&amp;go=view&amp;nick=$id\">Izmena svopstvenog nika</a></b><br/>\n";
echo "&#9679; <a href=\"browser.php?$ses&amp;ref=$ref\"><b>Pretraga browser-a</b></a><br/>\n";    
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=objave$takep\">Podesavanje Obavestenja,Objave,Info,novosti</a><br/>\n";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=objavebrisi$takep\">Brisi Obavestenja,Objave,Info,novosti</a><br/>\n";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=kvizpitanja$takep\">Dodaj Pitanja Za Kviz</a><br/>\n";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=gallery$takep\">Opcije Galerije</a><br/>\n";
echo "&#9679; <a href=\"forum.php?$ses&amp;action=admincp$takep\">Podesavanje Foruma</a><br/>\n";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=razglas$takep\">Podesavanje Razglasa</a><br/>\n";
echo "&#9679; <a href=\"potpisi2.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">Razglas Na Pocetnoj</a><br/>";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=pisma$takep\">Slanje Pisama</a><br/>\n";
}
if($row["level"]>7){    
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=sobe$takep\">Podesavanje Soba</a><br/>\n";    
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=zamena$takep\">Dodaj Zamenu</a><br/>\n"; 
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=brisizamenu$takep\">Brisi Zamenu</a><br/>\n";   
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=clbanip$takep\">Lista Browser+IP</a><br/>\n";
$obrisani = mysql_fetch_array(mysql_query("SELECT COUNT(id) from obrisani"));
echo "&#9679; <a href=\"statistik.php?$ses&amp;mod=obrisani&amp;ref=$ref\"><b>Obrisani chateri(".$obrisani[0].")</b></a><br/>";
}
if($row["level"]>8){    
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=bots$takep\">Izmeni Botove/Registraciju</a><br/>\n";        
echo "&#9679; <a href=\"potpisi3.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">Text U Hodniku</a><br/>";    
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=ciscenje$takep\">Cisti Sobe/Razglas/Pisma/listu Bockanja</a><br/>\n";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=linkovi$takep\">Podesavanje Linkova</a><br/>\n";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;page=1\">Mod Log</a><br/>\n";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=superpanel$takep\">Nocna Zastita</a><br/>";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=dopustanje1$takep\">Dopustanja Za Admin Sobu</a><br/>\n";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=editlevels$takep\">Izmeni Statuse</a><br/>\n";
echo "&#9679; <a href=\"ulogo.php?$ses&amp;$takep\">Logo Upload</a><br/>\n";
}    
//echo "<a href=\"apanel.php?$ses&amp;go=import_vopros$takep\">UBACI GOTOVA PITANJA ZA KVIZZ</a><br/>\n";
echo $divide;
echo $fsize2;
break;

case 'sobe';
echo "<b>Podesavaje Soba</b><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=natpisus$takep\">Tekst u sobama (ZASEBNO ZA SVAKU SOBU)</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editrooms$takep\">Izmeni/Obrisi Sobe</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editposroom$takep\">Izmeni Poziciju Soba</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=addroom$takep\">Dodaj Sobu</a><br/>\n";
break;

case 'pisma';
echo "<b>Slanje Pisama Moderaciji/Clanovima</b><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=pp2all&amp;model=1$takep\">Salji Pisma Svima</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=pp2all&amp;model=2$takep\">Salji Pisma Moderaciji</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=pp2all&amp;model=3$takep\">Salji Pisma Muskim Clanovima</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=pp2all&amp;model=4$takep\">Salji Pisma Zenskim Clanovima</a><br/>\n";
break;

case 'ciscenje';
echo "<b>.::Brisanje::.</b><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=bockanje$takep\">Ocisti Listu Bockanja</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=clearlogs$takep\">Ciscenje Logova</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=delpp2$takep\">Ciscenje Inboxa(SVE)</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=delfotopp$takep\">Ciscenje Foto pisama(SVE)</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=delpp$takep\">Ciscenje Inboxa</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=dshout$takep\">Ocisti Oba Razglasa</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=dshout2$takep\">Ocisti Pocetni Razglas</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=dshout3$takep\">Obrisi Text U Hodniku</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=clroomtime$takep\">Ciscenje Svih Soba (Pocetak Ciscenja Soba Posle Objave 3 minute) </a><br/>\n";
break;

case 'linkovi';
echo "<b>Podesavanje Linkova</b><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=gornji$takep\">Gornji Link</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=link$takep\">Linkovi</a><br/>";
break;

case 'kvizpitanja';
echo "<b>Kviz Pitanja</b><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=addvopr$takep\">Dodaj kviz pitanje</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=anagram$takep\">Dodaj Anagram Pitanje</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=addrec$takep\">Dodaj Rec Za Vesalicu</a><br/>\n";
echo "&#9679; <a href=\"apanel.php?$ses&amp;go=vesala$takep\">Pregled Odgovora / Brisi Vesalica Pitanja</a><br/>\n";
break;

case 'objave';
echo "<b>Objavljivanje</b><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=tell$takep\">Objava(Sve Sobe)</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=mnews$takep\">Dodaj Novost</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=mmeet$takep\">Dodaj Info</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=mobav$takep\">Dodaj Obavestenje</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=mobi$takep\">Dodaj Objavu</a><br/>";
break;

case 'objavebrisi';
echo "<b>Objave,obavestenja,info,novosti Brisanje</b><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=dnews$takep\">Obrisi Novosti</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dmeet$takep\">Obrisi Info</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dobav$takep\">Obrisi Obavestenje</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dobi$takep\">Obrisi Objavu</a><br/>";
break;

case 'bockanje':
if($row["level"]>8){
mysql_query("truncate table `bockanje`");
echo $fsize1;
echo "Lista Bockanja je obrisana!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao listu bockanja!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete obrisati listu bockanja!<br/>";
echo $fsize2;
}
break;

case 'addrec':
echo $fsize1;
echo "Vrsta reci:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=goaddrec&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"vrsta\" maxlength=\"255\" title=\"pojam\"/><br/>\n";
echo $fsize1;
echo "Rec:<br/>\n";
echo $fsize2;
echo "<input name=\"rec\" maxlength=\"60\" title=\"rec\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=goaddrec&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"vrsta\" value=\"$(vrsta)\"/>\n";
echo "<postfield name=\"rec\" value=\"$(rec)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;

case 'goaddrec':
$vrsta=strtolower($vrsta);
$vrsta=ucfirst($vrsta);
$rec=strtoupper($rec);
$resenje=$rec;
if ($row["translit"]==1){

}
$tran=strtr($rec,array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","Z"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ш"=>"w","щ"=>"w","ц"=>"c","ч"=>"4","ь"=>".","ъ"=>".","ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Z"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ш"=>"W","Щ"=>"W","Ц"=>"C","Ч"=>"4","Ь"=>".","Ъ"=>".","Ы"=>"Y","Э"=>"E","Ю"=>"Yu","Я"=>"Ya"));
@mysql_query ("Select * from vesala");
$k = @mysql_affected_rows()+2;
mysql_query ("Insert into vesala set number= '".$k."', vrsta='".$vrsta."', rec='".$rec."', resenje='".$resenje."', tran='".$tran."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao Rec za Vesalica kviz!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Rec je dodata!<br/>\n";
echo "Ukupno reci: $k !!!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()." ";
}
break;

case 'vesala':
print "<b>Klikni na broj za brisanje:</b><br/>"; 
echo $divide;
if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(number) FROM vesala"));
    $num_items = $noi[0]; //changable
    $items_per_page= 15;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    $sql = "SELECT number,vrsta,resenje FROM vesala ORDER BY number DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
	 while ($item = mysql_fetch_array($items))
    {
	echo "<a href=\"apanel.php?go=delvesala&amp;$ses&amp;mid=".$item['number']."$takep\">(".$item['number'].")</a> ".$item['vrsta']." / ".$item['resenje']." <br/>";
	}
    }
	
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<br/><a href=\"apanel.php?go=$go&amp;$ses&amp;page=$npage\">Napred&#187;</a>";
    }
    if($page>1)
    {
      $ppage = $page-1;
      echo "<br/><a href=\"apanel.php?go=$go&amp;$ses&amp;page=$ppage\">&#171;Nazad</a> ";
    }
	
    echo "<br/>$page/$num_pages<br/>";
	
		if ($ver=="wml"){
    if($num_pages>2)
    {
        $rets = "Idi na stranicu<input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[idi]";
        $rets .= "<go href=\"apanel.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
		$rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"go\" value=\"$go\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
        $rets .= "</go></anchor><br/>";

        echo $rets;
    }
	} else {
	 if($num_pages>2)
    {
	 
	    $rets = "<form action=\"apanel.php\" method=\"get\">";
        $rets .= "Idi na stranicu<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"go\" value=\"$go\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
		$rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
		$rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
		$rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "</form>"; 
		
	 echo $rets;
    }
	}
break;

case 'delvesala':
$mid = intval($_GET["mid"]);
if(mysql_query("delete from vesala where number='".$mid."' limit 1;")){
echo $fsize1;
echo "<b>Uspešno obrisano!</b><br/>";
echo $fsize2;
} else echo "<b>Greška pri brisanju!</b><br/>";
break;

case 'brisizamenu':
print "<b>Klikni na broj za brisanje:</b><br/>"; 
echo $divide;
if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM zamena"));
    $num_items = $noi[0]; //changable
    $items_per_page= 15;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    $sql = "SELECT id,zabrana,zamena FROM zamena ORDER BY id DESC LIMIT $limit_start, $items_per_page";

    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
	 while ($item = mysql_fetch_array($items))
    {
	echo "<a href=\"apanel.php?go=dellzamena&amp;$ses&amp;mid=".$item['id']."$takep\">(".$item['id'].")</a> ".$item['zabrana']." / ".$item['zamena']."<br/>";
	}
    }
	
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<br/><a href=\"apanel.php?go=$go&amp;$ses&amp;page=$npage\">Napred&#187;</a>";
    }
    if($page>1)
    {
      $ppage = $page-1;
      echo "<br/><a href=\"apanel.php?go=$go&amp;$ses&amp;page=$ppage\">&#171;Nazad</a> ";
    }
	
    echo "<br/>$page/$num_pages<br/>";
	
		if ($ver=="wml"){
    if($num_pages>2)
    {
        $rets = "Idi na stranicu<input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[idi]";
        $rets .= "<go href=\"apanel.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
		$rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"go\" value=\"$go\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
        $rets .= "</go></anchor><br/>";

        echo $rets;
    }
	} else {
	 if($num_pages>2)
    {
	 
	    $rets = "<form action=\"apanel.php\" method=\"get\">";
        $rets .= "Idi na stranicu<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"go\" value=\"$go\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
		$rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
		$rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
		$rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "</form>"; 
		
	 echo $rets;
    }
	}
break;

case 'dellzamena':
$mid = intval($_GET["mid"]);
if(mysql_query("delete from zamena where id='".$mid."' limit 1;")){
echo $fsize1;
echo "<b>Uspešno obrisano!</b><br/>";
echo $fsize2;
} else echo "<b>Greška pri brisanju!</b><br/>";
break;

case 'superpanel':
$super = mysql_fetch_array(mysql_query("SELECT superpanel FROM setting"));
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=superpanel1&amp;$ses$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Zabrani Nocni Ulaz u forum,Stihoteku,Knjigu Utisaka,Vicoteku,Komentare,Glasacku Kutiju:<br/>\n";
echo $fsize2;
echo "<select name=\"superpanel\">\n";
if($super[0]==0){
echo "<option value=\"0\">Ukljuci Zastitu</option>\n";
echo "<option value=\"1\">Iskljuci Zastitu</option>\n";
}else{
echo "<option value=\"1\">Iskljuci Zastitu</option>\n";
echo "<option value=\"0\">Ukljuci Zastitu</option>\n";
}
echo "</select><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=superpanel1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"superpanel\" value=\"$(superpanel)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;

case 'superpanel1':
$superpanel=$_POST["superpanel"];
if($row["level"]>7){
mysql_query ("UPDATE setting SET superpanel='".$superpanel."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio podesavanja Nocnog Ulaza!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Podesavanja su izmenjena!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati podesavanja za ovu namenu!<br/>\n";
echo $fsize2;
}
break;

case 'natpisus':
if(empty($act)) {
echo $fsize1;
echo "Teskt u sobi:<br/>(ako necete da bude teksta u sobi, ostavite prazno polje i kliknite na izmeni)<br/>";
echo $fsize2;
if ($ver=="xhtml") {
echo "<form method=\"POST\" action=\"apanel.php?act=update&amp;$ses&amp;go=natpisus$takep\" name=\"auth\">\n";
echo "<input name=\"pos\" format=\"text\"/><br/>";
} else echo "<input name=\"pos$ref\" format=\"text\"/><br/>";
echo $fsize1;
echo "Soba:<br/>";
echo $fsize2;
echo "<select name=\"name\">";
$q = mysql_query("select rm, name from rooms");
while ($dbdata = mysql_fetch_array($q)) {
$rm=$dbdata["rm"];
$val1=$dbdata["name"];
echo "<option value=\"".$rm."\">".$val1."</option>";
}
echo "</select><br/>";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor>*Izmeni*<go href=\"apanel.php?act=update&amp;$ses&amp;go=natpisus$takep\" method=\"post\">";
echo "<postfield name=\"name\" value=\"$(name)\"/>";
echo "<postfield name=\"pos\" value=\"$(pos$ref)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"*Izmeni*\" name=\"enter\"><br/>\n";
}
} else {

if(mysql_query("update rooms set text='".$pos."' where rm='".$name."';")){
echo $fsize1;
echo "<b>*Naslov u sobi izmenjen*</b><br/>";
$fsize2;
}
}
break;

case 'mnews':
$content=trim(htmlspecialchars(stripslashes($content)));
$date=date("j.m.Y");
if(empty($content)) $error=$error."<u>Unesite novost!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
print $fsize1;
print "Novost:<br/>";
print $fsize2;
print "<input name=\"content\"/><br/>";
print $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mnews$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"content\" value=\"$(content)\"/>";
print "<postfield name=\"date\" value=\"$date\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mnews$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Novost:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\"/><br/>\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"hidden\" name=\"date\" value=\"$date\"/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else {
if(empty($error)) {
if($content!=$last_news['content']) {
if(mysql_query("insert into news values(0,'$login','$content','$date');")) {
print $fsize1;
print "Novost je dodata!<br/>";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao novost!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else {
print $fsize1;
print "Greska!!!<br/>";
print $fsize2;
}
} else {
print $fsize1;
print "Takva novost vec postoji!<br/>";
}
print $fsize2;
} else {
print $fsize1;
print $error;
print $fsize2;
}
}
break;

case 'zamena':
if($row["level"]>6){
if(empty($zamena)) $error=$error."<u>Unesite zamenu!</u><br/>";
if(empty($zabrana)) $error=$error."<u>Unesite zabrana!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
print $fsize1;
print "Zabrana:<br/>";
print $fsize2;
print "<input name=\"zabrana\"/><br/>";
print $fsize1;
print "Zamena:<br/>";
print $fsize2;
print "<input name=\"zamena\"/><br/>";
print $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=zamena$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"zabrana\" value=\"$(zabrana)\"/>";
print "<postfield name=\"zamena\" value=\"$(zamena)\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=zamena$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
print $fsize1;
print "Zabrana:<br/>";
print $fsize2;
print "<input name=\"zabrana\"/><br/>";
print $fsize1;
print "Zamena:<br/>";
print $fsize2;
print "<input name=\"zamena\"/><br/>";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else {
if(empty($error)) {
if(mysql_query("INSERT INTO zamena SET zabrana='".$zabrana."', zamena='".$zamena."'")) {
print $fsize1;
print "Zabrana je dodata!<br/>";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao zabranu reci!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else {
print $fsize1;
print "Greska!!!<br/>";
print $fsize2;
}
print $fsize2;
} else {
print $fsize1;
print $error;
print $fsize2;
}
}
}else{
print $fsize1;
print "Ne mozete dodavati zabranu!<br/>";
print $fsize2;
}
break;

case 'addroom':
if($row["level"]>7){
if(empty($naziv)) $error=$error."<u>Unesite naziv sobe!</u><br/>";
if(empty($naslov)) $error=$error."<u>Unesite naslov sobe!</u><br/>";
if($broj<0) $error=$error."<u>Unesite broj sobe!</u><br/>";
if(empty($pozicija) || ($pozicija<0 || $pozicija>16) || !ctype_digit($pozicija)) $error=$error."<u>Unesite poziciju sobe!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
print $fsize1;
print "Naziv Sobe:<br/>";
print $fsize2;
print "<input name=\"naziv\"/><br/>";
print $fsize1;
print "Naslov Sobe:<br/>";
print $fsize2;
print "<input name=\"naslov\"/><br/>";
print $fsize1;
print "Pozicija Sobe:<br/>";
print $fsize2;
print "<input name=\"pozicija\"/><br/>";
print $fsize1;
print "Broj Sobe:<br/>";
print $fsize2;
print "<select name=\"broj\">";
for($i = 0; $i <= 23; $i++) {
$so = mysql_fetch_array(mysql_query("SELECT * FROM rooms WHERE rm='".$i."'"));
if(!$so){
print "<option value=\"$i\">$i</option>\n";
}
}
print "</select><br/>";
print $fsize1;
print "0-Kviz, 7-Admin, 8-Mod, 10-Intima, 11-Soba Bez Bana, 13-Vesalica Kviz, 9-Prijemna Sobica, 23-Mafija<br/><br/>";
print $fsize2;
print $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=addroom$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"naziv\" value=\"$(naziv)\"/>";
print "<postfield name=\"naslov\" value=\"$(naslov)\"/>";
print "<postfield name=\"broj\" value=\"$(broj)\"/>";
print "<postfield name=\"pozicija\" value=\"$(pozicija)\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=addroom$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
print $fsize1;
print "Naziv Sobe:<br/>";
print $fsize2;
print "<input name=\"naziv\"/><br/>";
print $fsize1;
print "Naslov Sobe:<br/>";
print $fsize2;
print "<input name=\"naslov\"/><br/>";
print $fsize1;
print "Pozicija Sobe:<br/>";
print $fsize2;
print "<input name=\"pozicija\"/><br/>";
print $fsize1;
print "Broj Sobe:<br/>";
print $fsize2;
print "<select name=\"broj\">";
for($i = 0; $i <= 23; $i++) {
$so = mysql_fetch_array(mysql_query("SELECT * FROM rooms WHERE rm='".$i."'"));
if(!$so){
print "<option value=\"$i\">$i</option>\n";
}
}
print "</select><br/>";
print $fsize1;
print "0-Kviz, 7-Admin, 8-Mod, 10-Intima, 11-Soba Bez Bana, 13-Vesalica Kviz, 9-Prijemna Sobica, 23-Mafija<br/><br/>";
print $fsize2;
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else {
if(empty($error)) {
if(mysql_query("INSERT INTO rooms SET rm='".$broj."', name='".$naziv."', topic='".$naslov."', pozicija='".$pozicija."'")) {
print $fsize1;
print "Soba je dodata!<br/>";
print $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao sobu <b>$naziv!</b><br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else {
print $fsize1;
print "Greska!!!<br/>";
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
print "Ne mozete dodavati sobu!<br/>";
print $fsize2;
}
break;

case 'dnews':
$q = mysql_query("select id,content from news order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema novosti!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<b>".$arr['id'].".</b> ".$arr['content']."<a href=\"apanel.php?action=del&amp;$ses&amp;go=dnews&amp;mid=".$arr['id']."$takep\">[X]</a><br/>";
echo $fsize2;
}
} else {
if(mysql_query("delete from news where id='".$mid."' limit 1;")){
echo $fsize1;
echo "Novost je obrisana!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao novost!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}
}
}
break;

case 'dshout':
if(mysql_query("TRUNCATE table `shoutbox`")){
echo $fsize1;
echo "Razglas je obrisan!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao novi razglas!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}
break;

case 'dshout2':
if(mysql_query("TRUNCATE table `shoutbox2`")){
echo $fsize1;
echo "Razglas je obrisan!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao razglas na pocetnoj stranici!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}
break;

case 'dshout3':
if(mysql_query("TRUNCATE table `shoutbox3`")){
echo $fsize1;
echo "Text u Hodniku Obrisan!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao text u hodniku!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}
break;

case 'mmeet':
$title=trim(htmlspecialchars(stripslashes($title)));
$content=trim(htmlspecialchars(stripslashes($content)));
$organizatory=trim(htmlspecialchars(stripslashes($organizatory)));
if(empty($title)) $error=$error."<u>Naziv nije naveden!</u><br/>";
if(empty($content)) $error=$error."<u>Sadrzaj nije naveden!</u><br/>";
if(empty($organizatory)) $error=$error."<u>Organizator nije naveden!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input name=\"title\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input name=\"content\" maxlength=\"1000\"/><br/>";
echo $fsize1;
echo "Organizator:<br/>";
echo $fsize2;
echo "<input name=\"organizatory\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mmeet$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"title\" value=\"$(title)\"/>";
echo "<postfield name=\"content\" value=\"$(content)\"/>";
echo "<postfield name=\"organizatory\" value=\"$(organizatory)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mmeet$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"title\" maxlength=\"100\"/><br/>\n";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\" maxlength=\"1000\"/><br/>\n";
echo $fsize1;
echo "Odganizator:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"organizatory\" maxlength=\"100\"/><br/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
}else{
if(empty($error)) {
if($title!=$last_meet['title']) {
if(mysql_query("insert into vstrechi values(0,'".$login."','".$title."','".$content."','".$organizatory."');")) {
echo $fsize1;
echo "Objava je dodata!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao objavu <b>$title</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else {
echo $fsize1;
echo "Greska!!!<br/>";
echo $fsize2;
}
} else {
echo $fsize1;
echo "Takva objava vec postoji!<br/>";
echo $fsize2;
}
} else {
echo $fsize1;
echo $error;
echo $fsize2;
}
}
break;

case 'dmeet':
$q = mysql_query("select id,title from vstrechi order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema objava!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dmeet&amp;mid=".$arr['id']."$takep\">".$arr['title']."</a><br/>";
echo $fsize2;
}
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT title FROM vstrechi WHERE id='".$mid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao objavu <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("delete from vstrechi where id='".$mid."' limit 1;")){
echo $fsize1;
echo "Objava je obrisana!<br/>";
echo $fsize2;
}
}
}
break;

case 'mobav':
$title=trim(htmlspecialchars(stripslashes($title)));
$content=trim(htmlspecialchars(stripslashes($content)));
$organizatory=trim(htmlspecialchars(stripslashes($organizatory)));
if(empty($title)) $error=$error."<u>Naziv nije naveden!</u><br/>";
if(empty($content)) $error=$error."<u>Sadrzaj nije naveden!</u><br/>";
if(empty($organizatory)) $error=$error."<u>Organizator nije naveden!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input name=\"title\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input name=\"content\" maxlength=\"1000\"/><br/>";
echo $fsize1;
echo "Organizator:<br/>";
echo $fsize2;
echo "<input name=\"organizatory\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mobav$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"title\" value=\"$(title)\"/>";
echo "<postfield name=\"content\" value=\"$(content)\"/>";
echo "<postfield name=\"organizatory\" value=\"$(organizatory)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mobav$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"title\" maxlength=\"100\"><br/>\n";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\" maxlength=\"1000\"/><br/>\n";
echo $fsize1;
echo "Odganizator:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"organizatory\" maxlength=\"100\"/><br/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
}else{
if(empty($error)) {
if($title!=$last_meet['title']) {
if(mysql_query("insert into obavestenja values(0,'".$login."','".$title."','".$content."','".$organizatory."');")) {
echo $fsize1;
echo "Obavestenje je dodato!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao obavestenje <b>$title</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else {
echo $fsize1;
echo "Greska!!!<br/>";
echo $fsize2;
}
} else {
echo $fsize1;
echo "Takvo obavestenje vec postoji!<br/>";
echo $fsize2;
}
} else {
echo $fsize1;
echo $error;
echo $fsize2;
}
}
break;

case 'dobav':
$q = mysql_query("select id,title from obavestenja order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema obavestenja!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dobav&amp;mid=".$arr['id']."$takep\">".$arr['title']."</a><br/>";
echo $fsize2;
}
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT title FROM vstrechi WHERE id='".$mid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao obavestenje <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("delete from obavestenja where id='".$mid."' limit 1;")){
echo $fsize1;
echo "Obavestenje je obrisano!<br/>";
echo $fsize2;
}
}
}
break;

case 'mobi':
$title=trim(htmlspecialchars(stripslashes($title)));
$content=trim(htmlspecialchars(stripslashes($content)));
$login=trim(htmlspecialchars(stripslashes($login)));
if(empty($title)) $error=$error."<u>Naziv nije naveden!</u><br/>";
if(empty($content)) $error=$error."<u>Sadrzaj nije naveden!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input name=\"title\" maxlength=\"100\"/><br/>";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input name=\"content\" maxlength=\"1000\"/><br/>";
echo $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mobi$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"title\" value=\"$(title)\"/>";
echo "<postfield name=\"content\" value=\"$(content)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mobi$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"title\" maxlength=\"100\"/><br/>\n";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\" maxlength=\"1000\"/><br/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else {
if(empty($error)) {
if($title!=$last_obiav['title']) {
if(mysql_query("insert into obiav values(0,'".$login."','".$title."','".$content."');")) {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao razglas <b>$title</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Objava je dodata!<br/>";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!</b><br/>";
echo $fsize2;
}
} else {
echo $fsize1;
echo "Takva objava vec postoji!<br/>";
echo $fsize2;
}
} else {
echo $fsize1;
echo $error;
echo $fsize2;
}
}
break;

case 'dobi':
$q = mysql_query("select * from obiav order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema objave!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dobi&amp;mid=".$arr['id']."$takep\">".$arr['title']."</a><br/>";
echo $fsize2;
}
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT title FROM obiav WHERE id='".$mid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao razglas <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("delete from obiav where id='".$mid."' limit 1;")){
echo $fsize1;
echo "Objava je obrisana!<br/>";
echo $fsize2;
}
}
}
break;

case 'view':
if (!ctype_digit($nick)) {
$nick = mysql_escape_string($nick);
$nick=trim($nick);
if($nick=="")$nick=0;
$latuser=strtolower($nick);
$ruser = rus_to_k($nick);
if($ruser==$nick){
$select = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,valid,user_ip,user_soft,img from users where latuser = '".$latuser."'");
} else {
$select = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,valid,user_ip,user_soft,img from users where ruser = '".$ruser."'");
}
} else {
if (!ctype_digit($nick)) {header("Location: index.php"); die;}
$select = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,valid,user_ip,user_soft,img from users where id = '".$nick."'");
}
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Chater nije pronadjen!<br/>\n";
echo $fsize2;
break;
}
$inf = mysql_fetch_array ($select);
$usid = $inf["id"];
$us_ip = $inf["user_ip"];
$us_soft = $inf["user_soft"];
$level2=$inf["level"];
if($level2 > $row["level"] || $row["level"]==9){
echo $fsize1;
echo "Pristup dozvoljen samo vlasniku!<br/>\n";
echo $fsize2;
break;
}
echo $fsize1;
echo "<b>Nick: </b>\n";
echo "$inf[user]<br/>\n";
echo "<b>ID: </b>\n";
echo "$usid<br/>\n";
echo "<b>Browser: </b>\n";
echo "$us_soft<br/>\n";
echo "<b>IP: </b>\n";
echo "$us_ip<br/><br/>\n";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?go=upd&amp;$ses$takep\" name=\"auth\">\n";
echo $fsize1;
echo "<b>Novi Nick:</b><br/>\n";
echo $fsize2;
echo "<input name=\"upnick\" maxlength=\"12\" value=\"$inf[user]\" title=\"nick\"/><br/>\n";
if($row["level"]>9){
echo $fsize1;
echo "<b>Password:</b><br/>\n";
echo $fsize2;
echo "<input name=\"upass\" maxlength=\"20\" value=\"$inf[pass]\" title=\"upass\"/><br/>\n";
}else{
echo "<input type=\"hidden\" name=\"upass\" value=\"$inf[pass]\"/>\n";
}
echo $fsize1;
echo "<b>Postovi:</b><br/>\n";
echo $fsize2;
echo "<input name=\"posts\" value=\"$inf[posts]\" title=\"posts\"/><br/>\n";
echo $fsize1;
echo "<b>Balans Igre:</b><br/>\n";
echo $fsize2;
echo "<input name=\"gposts\" value=\"$inf[gposts]\" title=\"posts\"/><br/>\n";
echo $fsize1;
echo "<b>Kviz Odgovora:</b><br/>\n";
echo $fsize2;
echo "<input name=\"credits\" value=\"$inf[credits]\" title=\"posts\"/><br/>\n";
echo $fsize1;
echo "<b>Kupljenih Odgovora:</b><br/>\n";
echo $fsize2;
echo "<input name=\"byeotv\" value=\"$inf[byeotv]\" title=\"posts\"/><br/>\n";
echo $fsize1;
echo "<b>Kredit Mafije:</b><br/>\n";
echo $fsize2;
echo "<input name=\"mafcredits\" value=\"$inf[mafcredits]\" title=\"posts\"/><br/>\n";
echo $fsize1;
echo "<b>Glasova za FOTO:</b><br/>\n";
echo $fsize2;
echo "<input name=\"votefoto\" value=\"$inf[votefoto]\" title=\"votefoto\"/><br/>\n";
echo $fsize1;
echo "<b>Status:</b><br/>\n";
echo $fsize2;
echo "<input name=\"status\" maxlength=\"12\" value=\"$inf[status]\" title=\"status\"/><br/>\n";
echo $fsize1;
echo "<b>Nevidljivost:</b><br/>\n";
echo $fsize2;
echo "<select name=\"inv\">\n";
if ($inf["inv"] == 0)echo "<option value=\"0\">Iskljucena</option>\n";
elseif ($inf["inv"] == 1)echo "<option value=\"1\">Ukljucena</option>\n";
elseif ($inf["inv"] == 2)echo "<option value=\"2\">Potpuni Ignor</option>\n";
if ($inf["inv"]!=0) echo "<option value=\"0\">Iskljucena</option>\n";
if ($inf["inv"]!=1) echo "<option value=\"1\">Ukljucena</option>\n";
if ($inf["inv"]!=2) echo "<option value=\"2\">Potpuni Ignor</option>\n";
echo "</select><br/>\n";
echo $fsize1;
echo "<b>Validacija:</b><br/>\n";
echo $fsize2;
echo "<select name=\"valid\">\n";
if ($inf["valid"] == 1)echo "<option value=\"1\">Ukljucena</option>\n";
elseif ($inf["valid"] == 1)echo "<option value=\"1\">Ukljucena</option>\n";
elseif ($inf["valid"] == 0)echo "<option value=\"2\">Iskljucena</option>\n";
if ($inf["valid"]!=0) echo "<option value=\"0\">Iskljucena</option>\n";
if ($inf["valid"]!=1) echo "<option value=\"1\">Ukljucena</option>\n";
echo "</select><br/>\n";
echo $fsize1;
echo "<b>Level:</b><br/>\n";
echo $fsize2;
echo "<select name=\"level\">\n";
if($inf["level"] != 0) {
$i = $inf["level"];
$levelselect = mysql_query ("Select name from levels where level='".$i."'");
$levels = mysql_fetch_array($levelselect);
$levelname=$levels["name"];;
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
if (($inf["level"]!=11)&&($row["level"]==11)){
for($i = 0; $i <= 11; $i++) {
$levelselect = mysql_query ("Select name from levels where level='".$i."'");
$levels = mysql_fetch_array($levelselect);
$levelname=$levels["name"];;
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}

} else if($row["level"]>7){
for($i = 0; $i <= 7; $i++) {
$levelselect = mysql_query ("Select name from levels where level='".$i."'");
$levels = mysql_fetch_array($levelselect);
$levelname=$levels["name"];;
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
}else if(($row["level"]>7) && ($inf["level"]==7)){
}else{
for($i = 0; $i <= 6; $i++) {
$levelselect = mysql_query ("Select name from levels where level='".$i."'");
$levels = mysql_fetch_array($levelselect);
$levelname=$levels["name"];;
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
}
echo "</select><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=upd&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"upid\" value=\"$usid\"/>\n";
echo "<postfield name=\"upnick\" value=\"$(upnick)\"/>\n";
echo "<postfield name=\"upass\" value=\"$(upass)\"/>\n";
echo "<postfield name=\"posts\" value=\"$(posts)\"/>\n";
echo "<postfield name=\"gposts\" value=\"$(gposts)\"/>\n";
echo "<postfield name=\"credits\" value=\"$(credits)\"/>\n";
echo "<postfield name=\"mafcredits\" value=\"$(mafcredits)\"/>\n";
echo "<postfield name=\"votefoto\" value=\"$(votefoto)\"/>\n";
echo "<postfield name=\"byeotv\" value=\"$(byeotv)\"/>\n";
echo "<postfield name=\"status\" value=\"$(status)\"/>\n";
echo "<postfield name=\"inv\" value=\"$(inv)\"/>\n";
echo "<postfield name=\"valid\" value=\"$(valid)\"/>\n";
echo "<postfield name=\"level\" value=\"$(level)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"hidden\" name=\"upid\" value=\"$usid\"/>\n";
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;

case 'upd':
$upnick=trim($upnick);
if($upnick==""){
echo $fsize1;
echo "error<br/>\n";
echo $fsize2;
break;
}
if (!ctype_digit($upid)) {header("Location: index.php"); die;}
$a = mysql_query("SELECT user,level FROM users WHERE id ='".$upid."'");
$b = mysql_fetch_array ($a);
$prl = $b["level"];
$nick = $b["user"];
$latuser=strtolower($upnick);
$ruser = rus_to_k($upnick);
if($ruser==$upnick){
mysql_query ("Select id from users where (latuser = '".$latuser."')and(user != '".$nick."')");
} else {
mysql_query ("select id from users where (ruser = '".$ruser."')and(user != '".$nick."')");
}
if (mysql_affected_rows() != 0) {
echo $fsize1;
echo "Chater nije pronadjen!<br/>\n";
echo $fsize2;
break;
}
$upnick = check($upnick);
$upass = check($upass);
$ruser = check($ruser);
$latuser = check($latuser);
$status = check($status);
$credits = check($credits);
$mafcredits = check($mafcredits);
$gposts = check($gposts);
$upnick = mysql_escape_string($upnick);
$upass = mysql_escape_string($upass);
$ruser = mysql_escape_string($ruser);
$latuser = mysql_escape_string($latuser);
$status = mysql_escape_string($status);
$credits = mysql_escape_string($credits);
$mafcredits = mysql_escape_string($mafcredits);
$gposts = mysql_escape_string($gposts);
if (!ctype_digit($posts)) {header("Location: index.php"); die;}
if (!ctype_digit($votefoto)) {header("Location: index.php"); die;}
if (!ctype_digit($byeotv)) {header("Location: index.php"); die;}
if (!ctype_digit($inv)) {header("Location: index.php"); die;}
if (!ctype_digit($valid)) {header("Location: index.php"); die;}
if (!ctype_digit($level)) {header("Location: index.php"); die;}
if (!ctype_digit($upid)) {header("Location: index.php"); die;}
if ($ruser==$upnick) $ins_str = "Update users set user='".$upnick."', pass='".$upass."', posts='".$posts."', gposts='".$gposts."', credits='".$credits."', mafcredits='".$mafcredits."', votefoto='".$votefoto."', byeotv='".$byeotv."', status='".$status."', inv='".$inv."', valid='".$valid."', level='".$level."', ruser = '', latuser = '".$latuser."' where id ='".$upid."'";
else $ins_str = "Update users set user='".$upnick."', pass='".$upass."', posts='".$posts."',gposts='".$gposts."',credits='".$credits."',mafcredits='".$mafcredits."',  votefoto='".$votefoto."', byeotv='".$byeotv."', status='".$status."', inv='".$inv."', valid='".$valid."', level='".$level."', ruser = '".$ruser."', latuser = '' where id ='".$upid."'";
if (mysql_query ($ins_str)) {
if ($prl != $level){
$levelselect = mysql_query ("Select name from levels where level='".$level."'");
$levels = mysql_fetch_array($levelselect);
$ur=$levels["name"];
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$upid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio status clana <b>".$objava[0]."</b> u <b>$ur</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////

for ($i=0; $i<=23; $i++){
$room = "room".$i;
if($i=="8"){
$st = time();
$today=date ("H:i");
$levelselect = mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = mysql_fetch_array($levelselect);
$lev=$levels["name"];
$mes = "<b>$lev $us dodelio je chateru $upnick status $ur!</b>";
$rnd = rand(0,99999999);
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$administration."', message='".$mes."', id='".$st."', towhom='', hid='0', usid='1', komu=''");
}
}
$levelselect = mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = mysql_fetch_array($levelselect);
$lev=$levels["name"];
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Pozz!!!";
$message = "Pozz <b>".$upnick."</b>!!! Zasluzili ste da Vam ".$lev." <b>".$us."</b> poveca status! Sada ste <b>".$ur."!</b>.";
mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$upnick."', idtowhom = '".$upid."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
}else{
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$upid."'"));
$text="$levelnamesa[0] <b>$namenski</b> je izmenio clana <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
}
echo $fsize1;
echo "Profil je izmenjen!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo " ".mysql_error()." ";
}
break;

case 'dopustanje':
if($row["level"]>7){
$dopu=$_GET["dopu"];
$nk=$_GET["nk"];
mysql_query ("UPDATE users SET dopustanje= '".$dopu."', dopustanjet='".time()."' WHERE id='".$nk."'");
if (mysql_error() == false){
echo $fsize1;
echo "Dopustanje je dodato!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
}else{
echo $fsize1;
echo "Ne mozete davati dopustanja!<br/>";
echo $fsize2;
}
break;

case 'dopustanje1':
if($row["level"]>7){
if($ver=="xhtml"){
echo "<form action=\"apanel.php?$ses&amp;go=dopustanje2$takep&amp;dopu=1\" method=\"post\">\n";
echo $fsize1;
$r = mysql_query("SELECT id,user FROM users WHERE level>'3' AND level<'7' AND dopustanje!=1 ORDER BY user ASC");
if (mysql_affected_rows() == 0) {
echo "Nema moderatora!<br/>\n";
}else{
$a = mysql_fetch_array($r);
while ($a !== false){
$nk = $a["id"];
$nick = $a["user"];
echo "<input type=\"checkbox\" name=\"chkboxarray[]\" value=\"$nk\"/> ";
echo "<a href=\"info.php?$ses&amp;nk=$nk&amp;ref=$ref\">".$nick."</a><br/>\n";
$a = mysql_fetch_array($r);
}
}
echo $fsize2;
echo "<input type=\"submit\" value=\"Dodaj\"/></form>\n";
echo $fsize1;
echo "<br/><a href=\"apanel.php?$ses&amp;go=dopustanjedel$takep\">Obrisi Dopustanja</a><br/>\n";
echo $fsize2;
}else{
echo $fsize1;
echo "Ova opcija nije dostupna u WML verziji!<br/>";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete davati dopustanja!<br/>";
echo $fsize2;
}
break;

case 'dopustanje2':
if($row["level"]>7){
$dopu=$_GET["dopu"];
$chkboxarray=$_POST["chkboxarray"];
foreach($chkboxarray as $checkbox){
mysql_query("UPDATE users SET dopustanje= '1', dopustanjet='".time()."' WHERE id='".$checkbox."'");
}
echo $fsize1;
echo "Dopustanja su uspesno dodata!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete davati dopustanja!<br/>";
echo $fsize2;
}
break;

case 'dopustanjedel':
if($row["level"]>7){
mysql_query("UPDATE users SET dopustanje= '0' WHERE dopustanje='1'");
echo $fsize1;
echo "Dopustanja su uspesno obrisana!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete davati dopustanja!<br/>";
echo $fsize2;
}
break;

case 'zastita':
$r = mysql_query("SELECT user FROM users WHERE id='".$nk."'");
$k = mysql_affected_rows();
if($row["level"]>=7 && $level<$row["level"]){
if($k>0){
mysql_query ("UPDATE users SET safe= '0' WHERE id='".$nk."'");
if (mysql_error() == false){
echo $fsize1;
echo "Zastita je skinuta!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Korisnik nije pronadjen!<br/>";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete skidati zastitu!<br/>";
echo $fsize2;
}
break;

case 'modmod':
$nicker = mysql_fetch_array(mysql_query("SELECT user, level FROM users WHERE id='".$nk."'"));
if($row["level"]==10){$max=10;}
if($row["level"]==9){$max=9;}
if($row["level"]==8){$max=8;}
if($row["level"]==7){$max=7;}
if($lev<=$row["level"] && $lev>$nicker[1] && $max>$lev){
mysql_query ("UPDATE users SET level='".$lev."' WHERE id='".$nk."'");
if (mysql_error() == false){
echo $fsize1;
echo "Status je uspesno promenjen!";
echo $fsize2;
/////////////////////////////////////////////////////////////////////////
$nickers = mysql_fetch_array(mysql_query("SELECT id, user, level FROM users WHERE id='".$nk."'"));
$levelselect = mysql_query ("Select name from levels where level='".$lev."'");
$adminss =mysql_fetch_array(mysql_query ("Select user from users where id='1'"));
$levels = mysql_fetch_array($levelselect);
$ur=$levels["name"];
for ($sobica=0; $i<=23; $sobica++){
$sobe = "room".$sobica;
if($sobica=="7" || $sobica=="8"){    
$st = time();
$today=date ("H:i");
$levelselect = mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = mysql_fetch_array($levelselect);
$lev=$levels["name"];
$mes = "<b>$lev $us dodelio je $nickers[1] status $ur!</b>";
$rnd = rand(0,99999999);
mysql_query ("Insert into $sobe set klu4= '".$rnd."', time='".$today."', who='".$adminss[0]."', message='".$mes."', id='".$st."', towhom='', hid='0', usid='1', komu=''");
}
}
$levelselect = mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = mysql_fetch_array($levelselect);
$lev=$levels["name"];
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Pozz!!!";
$message = "Pozz <b>".$nickers[1]."</b>!!! Zasluzili ste da Vam ".$lev." <b>".$us."</b> poveca status! Sada ste <b>".$ur."!</b>.";
mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$adminss[0]."', idwho ='1', message = '".$message."', towhom = '".$nickers[1]."', idtowhom = '".$nickers[0]."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je izmenio status clana <b>".$objava[0]."</b> u <b>$ur</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo " ".mysql_error()."";
}
}else{
echo "Ne mozete menjati status!";
}
break;

case 'addvopr':
echo $fsize1;
echo "Pitanje:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=goaddvopr&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"vopros\" maxlength=\"255\" title=\"quest\"/><br/>\n";
echo $fsize1;
echo "Odgovor:<br/>\n";
echo $fsize2;
echo "<input name=\"answ\" maxlength=\"60\" title=\"answ\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=goaddvopr&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"vopros\" value=\"$(vopros)\"/>\n";
echo "<postfield name=\"answ\" value=\"$(answ)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;

case 'anagram':
echo $fsize1;
echo "Anagram Pitanje:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=anagram1&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"vopros\" maxlength=\"255\" title=\"quest\"/><br/>\n";
echo $fsize1;
echo "Anagram Odgovor:<br/>\n";
echo $fsize2;
echo "<input name=\"answ\" maxlength=\"60\" title=\"answ\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=anagram1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"vopros\" value=\"$(vopros)\"/>\n";
echo "<postfield name=\"answ\" value=\"$(answ)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;

case 'anagram1':
if ($row["translit"]==1){

}
$tran=strtr($answ,array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","Z"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ш"=>"w","щ"=>"w","ц"=>"c","ч"=>"4","ь"=>".","ъ"=>".","ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Z"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ш"=>"W","Щ"=>"W","Ц"=>"C","Ч"=>"4","Ь"=>".","Ъ"=>".","Ы"=>"Y","Э"=>"E","Ю"=>"Yu","Я"=>"Ya"));
$counterss = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM anagram"));
mysql_query ("Insert into anagram set vopros='".$vopros."', answer='".$answ."',  tran='".$tran."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao pitanje za anagram!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Pitanje za anagram je dodato!<br/>\n";
echo "Ukupno Anagram pitanja: $counterss[0] !!!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()." ";
}
break;

case 'valid':
$to=$_GET["to"];
if($row["level"]>7){
if($to!=""){
mysql_query ("UPDATE users SET valid='1' WHERE id='".$to."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je potvrdio registraciju clana sa ID: $to!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Registracija je potvrdjena!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti id!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete potvrdjivati registraciju!<br/>\n";
echo $fsize2;
}
break;

case 'valid1':
$to=$_GET["to"];
if($row["level"]>7){
if($to!=""){
mysql_query ("DELETE FROM users WHERE id='".$to."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je odbio registraciju clana sa ID: $to!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Registracija je odbijena!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti id!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete potvrdjivati registraciju!<br/>\n";
echo $fsize2;
}
break;

case 'valid2':
$to=$_GET["to"];
if($row["level"]>7){
if($to!=""){
mysql_query ("UPDATE users SET valid='0' WHERE id='".$to."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je ponovo postavio na proveru clana sa ID: $to!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Nik Vracen Na Proveru!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti id!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete postavljati proveru!<br/>\n";
echo $fsize2;
}
break;

case 'editlogo1':
$logo=$_POST["logo"];
if($row["level"]>6){
if($logo || $logo!=""){
mysql_query ("UPDATE setting SET logo='".$logo."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio logo!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Logo je izmenjen!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Novi Logo!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati logo!<br/>\n";
echo $fsize2;
}
break;

case 'gallery':
$gallery = mysql_fetch_array(mysql_query("SELECT gallery, gtext, gtitle FROM setting"));
$naslov=htmlspecialchars("$gallery[2]");
$tekst=htmlspecialchars("$gallery[1]");
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=gallery1&amp;$ses$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Naslov:<br/>\n";
echo $fsize2;
echo "<input name=\"naslov\" maxlength=\"255\" title=\"naslov\" value=\"$gallery[2]\"/><br/>\n";
echo $fsize1;
echo "Tekst:<br/>\n";
echo $fsize2;
echo "<input name=\"tekst\" maxlength=\"255\" title=\"tekst\" value=\"$gallery[1]\"/><br/>\n";
echo $fsize1;
echo "Ukljucena:<br/>\n";
echo $fsize2;
echo "<select name=\"ukljucena\">\n";
if($gallery[0]==0){
echo "<option value=\"0\">Ne</option>\n";
echo "<option value=\"1\">Da</option>\n";
}else{
echo "<option value=\"1\">Da</option>\n";
echo "<option value=\"0\">Ne</option>\n";
}
echo "</select><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=gallery1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"naslov\" value=\"$(naslov)\"/>\n";
echo "<postfield name=\"tekst\" value=\"$(tekst)\"/>\n";
echo "<postfield name=\"ukljucena\" value=\"$(ukljucena)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;

case 'gallery1':
$naslov=$_POST["naslov"];
$tekst=$_POST["tekst"];
$ukljucena=$_POST["ukljucena"];
if($row["level"]>6){
if($naslov || $naslov!=""){
if($tekst || $tekst!=""){
mysql_query ("UPDATE setting SET gallery='".$ukljucena."', gtext='".$tekst."', gtitle='".$naslov."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio podesavanja galerije!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Podesavanja Galerije su izmenjena!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Tekst!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Naslov!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati podesavanje galerije!<br/>\n";
echo $fsize2;
}
break;

case 'razglas':
$razglasic = mysql_fetch_array(mysql_query("SELECT razglas,razglas1,razglas2,razglas3 FROM setting"));
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=razglas1&amp;$ses$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Chat Razglas:<br/>\n";
echo $fsize2;
echo "<select name=\"razglas\">\n";
if($razglasic[0]==0){
echo "<option value=\"0\">Iskljucen</option>\n";
echo "<option value=\"1\">Ukljucen</option>\n";
}else{
echo "<option value=\"1\">Ukljucen</option>\n";
echo "<option value=\"0\">Iskljucen</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Bilbord za Vas:<br/>\n";
echo $fsize2;
echo "<select name=\"razglas1\">\n";
if($razglasic[1]==0){
echo "<option value=\"0\">Iskljucen</option>\n";
echo "<option value=\"1\">Ukljucen</option>\n";
}else{
echo "<option value=\"1\">Ukljucen</option>\n";
echo "<option value=\"0\">Iskljucen</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Pocetni Razglas:<br/>\n";
echo $fsize2;
echo "<select name=\"razglas2\">\n";
if($razglasic[2]==0){
echo "<option value=\"0\">Iskljucen</option>\n";
echo "<option value=\"1\">Ukljucen</option>\n";
}else{
echo "<option value=\"1\">Ukljucen</option>\n";
echo "<option value=\"0\">Iskljucen</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "text u Hodniku:<br/>\n";
echo $fsize2;
echo "<select name=\"razglas3\">\n";
if($razglasic[3]==0){
echo "<option value=\"0\">Iskljucen</option>\n";
echo "<option value=\"1\">Ukljucen</option>\n";
}else{
echo "<option value=\"1\">Ukljucen</option>\n";
echo "<option value=\"0\">Iskljucen</option>\n";
}
echo "</select><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=razglas1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"razglas\" value=\"$(razglas)\"/>\n";
echo "<postfield name=\"razglas1\" value=\"$(razglas1)\"/>\n";
echo "<postfield name=\"razglas2\" value=\"$(razglas2)\"/>\n";
echo "<postfield name=\"razglas3\" value=\"$(razglas3)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;

case 'razglas1':
$razglas=$_POST["razglas"];
$razglas1=$_POST["razglas1"];
$razglas2=$_POST["razglas2"];
$razglas3=$_POST["razglas3"];
if($row["level"]>7){
mysql_query ("UPDATE setting SET razglas='".$razglas."', razglas1='".$razglas1."', razglas2='".$razglas2."', razglas3='".$razglas3."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio podesavanja razglasa!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Podesavanja razglasa su izmenjena!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati podesavanje razglasa!<br/>\n";
echo $fsize2;
}
break;

case 'gornji':
$glink = mysql_fetch_array(mysql_query("SELECT gornji, gornjilink, linklink FROM setting"));
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=gornji1&amp;$ses$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Naslov:<br/>\n";
echo $fsize2;
echo "<input name=\"naslov\" maxlength=\"255\" title=\"naslov\" value=\"$glink[0]\"/><br/>\n";
echo $fsize1;
echo "Link:<br/>\n";
echo $fsize2;
echo "<input name=\"link\" maxlength=\"255\" title=\"link\" value=\"$glink[1]\"/><br/>\n";
echo $fsize1;
echo "Ukljucena:<br/>\n";
echo $fsize2;
echo "<select name=\"ukljucena\">\n";
if($glink[2]==0){
echo "<option value=\"0\">Ne</option>\n";
echo "<option value=\"1\">Da</option>\n";
}else{
echo "<option value=\"1\">Da</option>\n";
echo "<option value=\"0\">Ne</option>\n";
}
echo "</select><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=gornji1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"naslov\" value=\"$(naslov)\"/>\n";
echo "<postfield name=\"link\" value=\"$(link)\"/>\n";
echo "<postfield name=\"ukljucena\" value=\"$(ukljucena)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;

case 'gornji1':
$naslov=$_POST["naslov"];
$link=$_POST["link"];
$ukljucena=$_POST["ukljucena"];
if($row["level"]>6){
if($naslov || $naslov!=""){
if($link || $link!=""){
mysql_query ("UPDATE setting SET gornji='".$naslov."', gornjilink='".$link."', linklink='".$ukljucena."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio podesavanja gornjeg linka!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Podesavanja gornjeg linka su izmenjena!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Link!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Morate uneti Naslov!<br/>\n";
echo $fsize2;
}
}else{
echo $fsize1;
echo "Ne mozete menjati podesavanje linkova!<br/>\n";
echo $fsize2;
}
break;

case 'goaddvopr':
if ($row["translit"]==1){

}
$tran=strtr($answ,array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","Z"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ш"=>"w","щ"=>"w","ц"=>"c","ч"=>"4","ь"=>".","ъ"=>".","ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Z"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ш"=>"W","Щ"=>"W","Ц"=>"C","Ч"=>"4","Ь"=>".","Ъ"=>".","Ы"=>"Y","Э"=>"E","Ю"=>"Yu","Я"=>"Ya"));
$counterss = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM bots"));
mysql_query ("Insert into bots set vopros='".$vopros."', answer='".$answ."',  tran='".$tran."'");
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je dodao pitanje za kviz!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Pitanje je dodato!<br/>\n";
echo "Ukupno pitanja: $counterss[0] !!!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()." ";
}
break;

case 'tell':
echo $fsize1;
echo "Objava(Sve Sobe):<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=gotell&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"txt\" maxlength=\"1255\" title=\"text\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Napisi<go href=\"apanel.php?go=gotell&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"txt\" value=\"$(txt)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Napisi\" name=\"enter\"><br/>\n";
}
break;

case 'gotell':
if ($row["translit"]==1)$txt = trun_to_rus($txt);
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = time();
for ($num = 0; $num <= 22; $num++){
$room = "room".$num;
$txt = "<b>$txt</b>";
if (!ctype_digit($id)) {header("Location: index.php"); die;}
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$us."', message='".$txt."', id='".$time."', towhom='', hid='0', usid='".$id."', komu=''");           }
if (mysql_error() == false){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je napisao objavu u svim sobama!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Objava je napisana u svim sobama!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
break;

case 'fullign':
$r = mysql_query ("SELECT * from users WHERE inv = '2' ");
$a = mysql_fetch_array($r);
while ($a !== false){
$pid = $a["id"];
if (!ctype_digit($pid)) {header("Location: index.php"); die;}
mysql_query("UPDATE users set inv = '0' WHERE id = '".$pid."'");
$a = mysql_fetch_array($r);
}
echo $fsize1;
echo "Ignor Lista je ociscena!<br/>\n";
echo $fsize2;
break;

case 'clearzap':
$time = time()-604800;
mysql_query ("DELETE from zapiski WHERE time<$time");
echo $fsize1;
echo "Lista Zapisa je ociscena!<br/>\n";
echo $fsize2;
break;

case 'clbanip':
if($row["level"]>7){
$q = mysql_query("select klu4,ip,soft, user, tip, hostname from bannlist order by klu4 desc;");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
if($arr[4]=='1' || $arr[4]=='3'){
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, Browser: ".$arr['soft']."</a><br/>";
}else if($arr[4]=='0'){
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, Browser: ".$arr['soft'].", IP: ".$arr['ip']."</a><br/>";
}else if($arr[4]=='4'){
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, Operater: ".$arr['hostname'].", IP: ".$arr['ip']."</a><br/>";
}else{
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, IP: ".$arr['ip']."</a><br/>";
}
echo $divide;
echo $fsize2;
}
if (mysql_affected_rows() != 0){
echo $fsize1;
echo "<a href=\"apanel.php?$ses&amp;go=clbanip&amp;act=unbannall$takep\">Skini Sve Banove</a><br/>";
echo $fsize2;
} else {
echo $fsize1;
echo "Browser+IP Lista je prazna!<br/>";
echo $fsize2;
}
} else if ($act=="unbannall") {
mysql_query ("DELETE from bannlist");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo sve Browser+IP banove!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Svi Browser+IP banovi su skinuti!<br/>\n";
echo $fsize2;
} else {
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM bannlist WHERE klu4='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo IP+Browser Ban clanu <b>".$objava[0]."</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("delete from bannlist where klu4='".$nk."'")){
echo $fsize1;
echo "Browser+IP ban je skinut!<br/>";
echo $divide;
echo " <a href=\"apanel.php?$ses&amp;go=clbanip$takep\">Skini Jos Banova</a><br/>";
echo $fsize2;
}
}
}else{
echo $fsize1;
echo "Ne mozete skidati IP+Browser Banove!<br/>";
echo $fsize2;
}
break;

case 'clroomtime':
echo $fsize1;
echo "Sobe ce biti ociscene za 3 minuta!<br/>\n";
echo $fsize2;
if(isset($rm)) echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
$fp=fopen("log/clear.dat", "w");
fclose($fp);
$f=fopen("log/clear.dat","a+");
flock($f,LOCK_EX);
$cleardata = time() + 180;
fwrite($f,$cleardata);
fflush($f);
flock($f,LOCK_UN);
fclose($f);
$rnd = rand(0,99999999);
$mes = "<b>Obavestenje! Sve sobe ce biti ociscene za 3 minuta!</b>";
$today=date("H:i");
$time = getmicrotime();
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je najavljeno ocistio sve sobe!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
for ($num = 0; $num <= 23; $num++){
$ranec = "room".$num;
mysql_query ("Insert into $ranec set klu4= '".$rnd."', time='".$today."', who='".$row["user"]."', message='".$mes."', id='".$time."', towhom='', hid='".$row["id"]."', usid='".$row["id"]."', komu=''");
mysql_query("ANALYZE TABLE $ranec");
}
break;

case 'delpp':
if($row["level"]>=7){
echo $fsize1;
echo "Sva procitana pisma su obrisana!<br/>\n";
echo $fsize2;
if(isset($rm)){
echo $fsize1;
echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
echo $fsize2;
}
mysql_query ("DELETE FROM zapiski WHERE readd='1'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao sva procitana pisma!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete brisati pisma!<br/>\n";
echo $fsize2;
}
break;

case 'delpp2':
if($row["level"]>7){
echo $fsize1;
echo "Sva pisma su obrisana!<br/>\n";
echo $fsize2;
if(isset($rm)){
echo $fsize1;
echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
echo $fsize2;
}
mysql_query ("TRUNCATE TABLE zapiski");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao sva pisma!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete brisati sva pisma!<br/>\n";
echo $fsize2;
}
break;

case 'delfotopp':
if($row["level"]>7){
echo $fsize1;
echo "Sva foto pisma su obrisana!<br/>\n";
echo $fsize2;
if(isset($rm)){
echo $fsize1;
echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
echo $fsize2;
}
mysql_query ("TRUNCATE TABLE fotopp");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao sva foto pisma!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete brisati sva foto pisma!<br/>\n";
echo $fsize2;
}
break;

case 'pp2all':
if($row["level"]>6){

echo $fsize1;
echo "Tema:<br/>\n";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?go=pp2allsent&amp;$ses$takep&amp;model=$model\" name=\"auth\">\n";
echo "<input name=\"tema\" maxlength=\"30\" value=\"$name\" title=\"tema\"/><br/>\n";
$tema=time();
echo $fsize1;
echo "Text Pisma:<br/>\n";
echo $fsize2;
echo "<input name=\"text\" maxlength=\"1000\" value=\"$name\" title=\"text\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Posalji PP2ALL<go href=\"apanel.php?go=pp2allsent&amp;$ses$takep&amp;model=$model\" method=\"post\">\n";
echo "<postfield name=\"tema\" value=\"Poruku Poslao Admin\"/>\n";
echo "<postfield name=\"text\" value=\"$(text)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"hidden\" value=\"Pruku Poslao Admin\" name=\"tema\">\n";
echo "<input type=\"submit\" value=\"Posalji PP2ALL\" name=\"enter\"><br/>\n";
}
}else{
echo $fsize1;
echo "Ne mozete slati PP2ALL!<br/>\n";
echo $fsize2;
}
break;

case 'pp2allsent':
if($row["level"]>6){
$model=$_GET["model"];
if($tema==""){$tema= time();}
else if($text==""){$msg= "Unesite Text Pisma!<br/>";}
else{$msg="Pisma su poslata!<br/>";
$maximalno = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM users"));
$i=0;
for($i; $i<$maximalno[0]; $i++)
{
if($model==1){
$naziv = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$i."'"));
}else if($model==2){
$naziv = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$i."' AND level>3"));
}else if($model==3){
$naziv = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$i."' AND sex='M'"));
}else if($model==4){
$naziv = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$i."' AND sex='Z'"));
}
if($naziv[0]){
$kol = rand(0,99999999);
$time = time();
$adm = mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = mysql_fetch_array ($adm);
$administration = $z["user"];
$administration = check($administration);
$data = date("H:i(d-M)");
$napisao=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$id."'"));
$levelni=$row["level"];
$levelcic = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text2 = "PS: Ovo je automatska poruka i poslao je $levelcic[0] $napisao[0].Ne treba odgovarati na nju.";
$message = "$text <br/><b><i> $text2 </i></b>";
mysql_query("INSERT INTO zapiski SET klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$naziv[0]."', idtowhom = '".$i."', time = '".$time."', readd = '0', topic = '".$tema."', date='".$data."'");
}
}
}
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je poslao PP2ALL!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo $msg;
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete slati PP2ALL!<br/>\n";
echo $fsize2;
}
break;

case 'clrm':
$room = "room".$rm;
$res = mysql_query ("Select id from $room order by id desc");
$lines = mysql_fetch_array ($res);
$kl = $lines["id"];
if (mysql_query ("Delete from $room where id = '".$kl."'")){
echo $fsize1;
echo "Soba je ociscena!<br/>\n";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT name FROM rooms WHERE rm='".$rm."'"));
$text="$levelnamesa[0] <b>$namenski</b> je ocistio sobu <b>$objava[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
}
break;

case 'fullignmake':
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
$select = mysql_query ("Select * from users where id='".$nk."'");
$inf = mysql_fetch_array ($select);
$level = $inf["level"];
$fignik = $inf["user"];
$figid = $inf["id"];
if (($level>3)){
echo $fsize1;
echo "Ne mozete staviti Moderatore ili Administratore u potpuni Ignor!<br/>\n";
echo $fsize2;
break;
}
if (!ctype_digit($figid)) {header("Location: index.php"); die;}
mysql_query ("UPDATE users SET inv = '2' WHERE id = '".$figid."'");
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = time();
$room = "room".$rm;
$txt = "".$us." je stavio clana <b>".$fignik."</b> u Potpuni Ignor, zbog krsenja pravila!";
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$administration."', message='".$txt."', id='".$time."', towhom='', hid='0', usid='1', komu=''");
echo $fsize1;
echo "$fignik je stavljen u Potpuni Ignor!<br/>\n";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je stavio <b>".$fignik."</b> u potpuni ignor!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
break;

case 'modlog':
if ($row["level"]>8){
$tip=$_GET["tip"];
if($tip>0){
echo $fsize1;
if($tip==1){$naslov="Mod Log";}
else if($tip==2){$naslov="Admin Log";}
else if($tip==3){$naslov="Mod Soba";}
else if($tip==4){$naslov="Admin Soba";}
else if($tip==5){$naslov="Intimna Soba";}
else if($tip==6){$naslov="Clanovi Log";}
else if($tip==7){$naslov="Brisanje postova";}
else if($tip==8){$naslov="Upload Smajlica";}
else if($tip==9){$naslov="Browser Pretraga";}
else if($tip==10){$naslov="Logovanja";}
echo "<b>$naslov</b><br/>";
echo $divide;
echo $fsize2;
$brojcano = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='".$tip."'"));
$start=(($page-1)*5);
if($brojcano[0]<=5){$page=1;}
if($start>$brojcano[0]){$start=$brojcano[0]-1;}
$vreme=time();
$stranice=$brojcano[0]/5;
$q = mysql_query("SELECT text, time FROM modlog WHERE type='".$tip."' ORDER BY id DESC LIMIT $start, 5");
echo $fsize1;
$st5=$start+5;
if($st5>$brojcano[0]){$st5=$brojcano[0];}
$star=$start+1;
echo "Prikazuje $star-$st5 od $brojcano[0]<br/>";
echo $divide;
while($arr=mysql_fetch_array($q)) {

echo "$arr[0]<br/>Vreme: ".date("d-m-Y H:i",$arr[1])."<br/>";
echo $divide;

}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"apanel.php?$ses&amp;go=modlog&amp;page=$ppage$takep&amp;tip=$tip\">&#171;Nazad</a> ";
    }
    if($page<$stranice)
    {
      $npage = $page+1;
      echo "<a href=\"apanel.php?$ses&amp;go=modlog&amp;page=$npage$takep&amp;tip=$tip\">Napred&#187;</a>";
    }
    echo "<br/>";
	if ($row["level"]>9){
	echo "<a href=\"apanel.php?$ses&amp;go=delmodlog$takep\">Obrisi Sve Logove</a><br/>";
	}
	echo $fsize2;
	}else{
	echo $fsize1;
	echo "<b>Mod Log</b><br/>";
	echo $divide;
	$soba6 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='6'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=6&amp;page=1\">Clanovi Log($soba6[0])</a><br/>";
	$soba1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='1'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=1&amp;page=1\">Mod Log($soba1[0])</a><br/>";
	$soba2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='2'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=2&amp;page=1\">Admin Log($soba2[0])</a><br/>";
	$soba3 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='3'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=3&amp;page=1\">Mod Soba($soba3[0])</a><br/>";
	$soba4 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='4'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=4&amp;page=1\">Admin Soba($soba4[0])</a><br/>";
	if ($row["level"]>8){
	$soba5 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='5'"));
	echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=5&amp;page=1\">Intimna Soba($soba5[0])</a><br/>";
	$soba5 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='7'"));
    echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=7&amp;page=1\">Brisanje postova($soba5[0])</a><br/>";
    $upsm = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='8'"));
    echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=8&amp;page=1\">Upload Smajlica($upsm[0])</a><br/>";
    $prbrws = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='9'"));
    echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=9&amp;page=1\">Browser Pretraga($prbrws[0])</a><br/>";
    $logovanja = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM modlog WHERE type='10'"));
    echo "<a href=\"apanel.php?$ses&amp;go=modlog$takep&amp;tip=10&amp;page=1\">Logovanja($logovanja[0])</a><br/>";
    }
	echo $fsize2;
	}
}else{
echo $fsize1;
echo "Ne mozete videti Mod Log!<br/>";
echo $fsize2;
}
break;

case 'citajpp':
if ($row["level"]>9){
echo $fsize1;
$kojeje = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
echo "<b>$kojeje[0] Pisma</b><br/>";
echo $divide;
echo $fsize2;
$brojcano = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM zapiski WHERE idwho='".$nk."' OR idtowhom='".$nk."'"));
$start=(($page-1)*5);
if($brojcano[0]<=5){$page=1;}
if($start>$brojcano[0]){$start=$brojcano[0]-1;}
$vreme=time();
$stranice=$brojcano[0]/5;
$q = mysql_query("SELECT * FROM zapiski WHERE idwho='".$nk."' OR idtowhom='".$nk."' ORDER BY time DESC LIMIT $start, 5");
echo $fsize1;
$st5=$start+5;
if($st5>$brojcano[0]){$st5=$brojcano[0];}
$star=$start+1;
echo "Prikazuje $star-$st5 od $brojcano[0]<br/>";
echo $divide;
while($arr=mysql_fetch_array($q)) {
$who = $arr ["who"];
$idwho = $arr ["idwho"];
$message = $arr ["message"];
$towhom = $arr ["towhom"];
$idtowhom = $arr ["idtowhom"];
$topic = $arr ["topic"];
$date = $arr ["date"];
$read = $arr ["readd"];
$kojeje1 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$idwho."'"));
$kojeje2 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$idtowhom."'"));
echo "Za <b>$kojeje2[0]</b>,\n";
echo "od <b>$kojeje1[0]</b><br/>\n";
echo "Tema: $topic<br/>\n";
echo "Datum: $date<br/>\n";
echo "Poruka: $message<br/>\n";
echo $divide;

}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"apanel.php?$ses&amp;go=citajpp&amp;page=$ppage$takep&amp;nk=$nk\">&#171;Nazad</a> ";
    }
    if($page<$stranice)
    {
      $npage = $page+1;
      echo "<a href=\"apanel.php?$ses&amp;go=citajpp&amp;page=$npage$takep&amp;nk=$nk\">Napred&#187;</a>";
    }
    echo "<br/>";
	echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete citati tudja pisma!<br/>";
echo $fsize2;
}
break;

case 'friends':
if ($row["level"]>7){
echo $fsize1;
$nk=$_GET["nk"];
$kojeje = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
echo "<b>$kojeje[0] Prijatelji</b><br/>";
echo $divide;
echo $fsize2;
	if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM friends WHERE id='".$nk."' AND ok='1' OR usid='".$nk."' AND ok='1'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    $sql = "SELECT id, usid FROM friends WHERE id='".$nk."' AND ok='1' OR usid='".$nk."' AND ok='1' ORDER BY klu4 DESC LIMIT $limit_start, $items_per_page ";
    print $fsize2;
	echo "</p>";
    echo "<p>";
    print $fsize1;
    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
if($item[0]==$nk){
$kojeje1 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[1]."'"));
$isis=$item[1];
}else{
$kojeje1 = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$item[0]."'"));
$isis=$item[0];
}
echo "<a href=\"info.php?$ses&amp;nk=$isis&amp;ref=$ref\">$kojeje1[0]</a><br/>";
    }
    }
    print $fsize2;
    echo "</p>";
    echo "<p align=\"center\">";
    print $fsize1;
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"apanel.php?$ses&amp;go=friends&amp;nk=$nk$takep&amp;page=$ppage&amp;rm=$rm\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"apanel.php?$ses&amp;go=friends&amp;nk=$nk$takep&amp;page=$npage&amp;rm=$rm\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
	//echo "$noi[0] prijatelja<br/>";
	echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete videti tudje prijatelje!<br/>";
echo $fsize2;
}
break;

case 'delmodlog':
if($row["level"]>8){
mysql_query("truncate table `modlog`");
echo $fsize1;
echo "Mod Log je obrisan!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao Mod Log!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}else{
echo $fsize1;
echo "Ne mozete obrisati Mod Log!<br/>";
echo $fsize2;
}
break;

case 'clbanniks':
$fp=fopen("log/bannlist.dat", "w");
fclose($fp);
mysql_query ("update users set banned = '0' where banned = '1' ");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo sve banove!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Svi Banovi su skinuti!<br/>\n";
echo $fsize2;
break;

case 'clpinniks':
$fp=fopen("log/pinlist.dat", "w");
fclose($fp);
mysql_query ("UPDATE users SET kik = '0', whokik = '', whykik = ''  where kik!='0'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo sve kickove!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Svi Kickovi su skinuti!<br/>\n";
echo $fsize2;
break;

case 'clearlogs':
fclose($fp);
$fp=fopen("log/bannlist.dat", "w");
fclose($fp);
$fp=fopen("log/banniplist.dat", "w");
fclose($fp);
$fp=fopen("log/pinlist.dat", "w");
fclose($fp);
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je ocistio logove!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Svi logovi su ocisceni!<br/>\n";
echo $fsize2;
break;

case 'unban':
$q = mysql_query("select id,user from users where banned='1' order by id desc;");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=unbann&amp;$ses&amp;go=unban&amp;nk=".$arr['id']."$takep\">".$arr['user']."</a><br/>";
echo $fsize2;
}
if (mysql_affected_rows() != 0){
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=clbanniks$takep\">Skini Sve Banove</a><br/>";
echo $fsize2;
} else {
echo $fsize1;
echo "Lista Banovanih clanova je prazna!<br/>";
echo $fsize2;
}
} else {
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
if(mysql_query("update users set banned = '0' where id='".$nk."'")){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$clanclan = mysql_fetch_array(mysql_query("SELECT name FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo ban clanu<b>$clanclan[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Ban je skinut!<br/>";
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=unban$takep\">Skini Jos Banova</a><br/>";
echo $fsize2;
}
}
break;

case 'unpin':
$q = mysql_query("select id,user from users where kik!='0' order by id desc;");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=unbann&amp;$ses&amp;go=unpin&amp;nk=".$arr['id']."$takep\">".$arr['user']."</a><br/>";
echo $fsize2;
}
if (mysql_affected_rows() == 0){
echo $fsize1;
echo "Lista Kickovanih je prazna!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=clpinniks$takep\">Skini Sve Kickove</a><br/>";
echo $fsize2;
}
} else {
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
if(mysql_query("UPDATE users SET kik = '0', whokik = '', whykik = ''  where id='".$nk."'")){
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$clanclan = mysql_fetch_array(mysql_query("SELECT name FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b> je skinuo kick clanu<b>$clanclan[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
print $fsize1;
echo "Kick je skinut!<br/>";
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=unpin$takep\">Skini Jos Kickova</a><br/>";
echo $fsize2;
}
}
break;

case 'delrooms':
if($row["level"]>7){
$q = mysql_query("SELECT name FROM rooms WHERE rm='".$rms."'");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Ova soba ne postoji!<br/>\n";
echo $fsize2;
} else {
$nazivni=mysql_fetch_array($q);
if(mysql_query("DELETE FROM rooms WHERE rm='".$rms."'")){
echo $fsize1;
echo "Soba je obrisana!<br/>";
echo $fsize2;
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao sobu <b>$nazivni[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
}
}
}else{
echo $fsize1;
echo "Ne mozete brisati sobu!";
echo $fsize2;
}
break;

case 'editrooms':
$q = mysql_query("select rm,name from rooms");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=rnm&amp;$ses&amp;go=editrooms&amp;rms=".$arr['rm']."$takep\">".$arr['rm'].". ".$arr['name']."</a><br/>";
if($row["level"]>7){
echo "<small><a href=\"apanel.php?$ses&amp;go=delrooms&amp;rms=".$arr['rm']."$takep\">[Obrisi]</a></small><br/><br/>";
}
echo $fsize2;
}
} elseif ($act=="dornm") {
if (!ctype_digit($rms)) {header("Location: index.php"); die;}
$q = mysql_query("select name from rooms where rm='".$rms."'");
$arrrr=mysql_fetch_array($q);
$namerrr=$arrrr["name"];
$roomname = check($roomname);
$roomname = mysql_escape_string($roomname);
mysql_query ("update rooms set name='".$roomname."' where rm='".$rms."'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je izmenio naziv sobe <b>$namerrr</b> u <b>$roomname</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Soba je uspesno izmenjena!<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editrooms$takep\">Lista Soba</a><br/>";
echo $fsize2;
} else {
if (!ctype_digit($rms)) {header("Location: index.php"); die;}
$q = mysql_query("select name from rooms where rm='".$rms."'");
$arr=mysql_fetch_array($q);
$name=$arr["name"];
echo $fsize1;
echo "Naziv Sobe:<br/>\n";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?act=dornm&amp;$ses&amp;go=editrooms&amp;rms=$rms$takep\" name=\"auth\">\n";
echo "<input name=\"roomname\" maxlength=\"200\" value=\"$name\" title=\"roomname\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?act=dornm&amp;$ses&amp;go=editrooms&amp;rms=$rms$takep\" method=\"post\">\n";
echo "<postfield name=\"roomname\" value=\"$(roomname)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=editrooms$takep\">Lista Soba</a><br/>";
echo $fsize2;
}
break;

case 'editposroom':
if(empty($act)) {
echo $fsize1;
echo "Soba:<br/>";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?act=update&amp;$ses&amp;go=editposroom$takep\" name=\"auth\">\n";
echo "<select name=\"name\">";
$q = mysql_query("select * from rooms;");
while ($dbdata = mysql_fetch_array($q)) {
$rm=$dbdata["rm"];
$val1=$dbdata["name"];
echo "<option value=\"".$rm."\">".$val1."</option>";
}
echo "</select><br/>";
echo $fsize1;
echo "Pozicija:<br/>";
echo $fsize2;
echo "<input size=\"4\" name=\"pos\" format=\"*N\"/><br/>";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor>Izmeni<go href=\"apanel.php?act=update&amp;$ses&amp;go=editposroom$takep\" method=\"post\">";
echo "<postfield name=\"name\" value=\"$(name)\"/>";
echo "<postfield name=\"pos\" value=\"$(pos)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
} else {
if (!ctype_digit($pos)) {header("Location: index.php"); die;}
if (!ctype_digit($name)) {header("Location: index.php"); die;}
if(mysql_query("update rooms set pozicija='".$pos."' where rm='".$name."';")){
$q = mysql_query("select name from rooms where rm='".$name."'");
$arrrr=mysql_fetch_array($q);
$namerrr=$arrrr["name"];
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio poziciju sobe <b>$namerrr</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Pozicija sobe je izmenjena!<br/>";
echo $fsize2;
}
}
break;

case 'bots':
$setting = mysql_query ("Select * from setting where klu4=1");
$set = mysql_fetch_array ($setting);
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updbots$takep\" name=\"auth\">\n";
echo $fsize1;
echo "<b>Opcije Registracije</b><br/>\n";
echo "Registracija:<br/>\n";
echo $fsize2;
echo "<select name=\"reg\">\n";
if($set["reg"] == 0){
echo "<option value=\"0\">Zakljucana</option>\n";
echo "<option value=\"1\">Otkljucana</option>\n";
} else {
echo "<option value=\"1\">Otkljucana</option>\n";
echo "<option value=\"0\">Zakljucana</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Zabrana Ulaza Sa Kompa:<br/>\n";
echo $fsize2;
echo "<select name=\"banban\">\n";
if($set["banban"] == 0){
echo "<option value=\"0\">Zatvorena reg.</option>\n";
echo "<option value=\"1\">Otvorena Reg.</option>\n";
} else {
echo "<option value=\"1\">Otvorena Reg.</option>\n";
echo "<option value=\"0\">Zatvorena reg.</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo $divide;
echo "*Zabrana uzastopne registracije (nagomilavanja nickova)*:<br/>\n";
echo $fsize2;
echo "<select name=\"sigurnareg\">\n";
if($set["sigurnareg"] == 0){
echo "<option value=\"0\">Iskljucena</option>\n";
echo "<option value=\"1\">Ukljucena</option>\n";
} else {
echo "<option value=\"1\">Ukljucena</option>\n";
echo "<option value=\"0\">Iskljucena</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "<b>Br. sekundi potrebnih za registrovanje (1min=60sek)</b><br/>Vise istih ip adresa: \n";
echo $fsize2;
echo "<input name=\"iptime\" format=\"*N\" size=\"5\" value=\"$set[iptime]\" title=\"iptime\"/><br/>\n";
echo $fsize1;
echo "Vise istih browsera:\n";
echo $fsize2;
echo "<input name=\"softtime\" format=\"*N\" size=\"5\" value=\"$set[softtime]\" title=\"softtime\"/><br/>\n";
echo $fsize1;
echo $fsize1;
echo "<b>Bonus Postovi Za Nove Korisnike:</b>\n";
echo $fsize2;
echo "<input name=\"regposts\" format=\"*N\" size=\"3\" value=\"$set[regposts]\" title=\"regposts\"/><br/>\n";
echo $divide;
echo $fsize1;
echo "Validacija Registracije:<br/>\n";
echo $fsize2;
echo "<select name=\"valid\">\n";
if($set["valid"] == 0){
echo "<option value=\"0\">Iskljuceno</option>\n";
echo "<option value=\"1\">Ukljuceno</option>\n";
} else {
echo "<option value=\"1\">Ukljuceno</option>\n";
echo "<option value=\"0\">Iskljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo $divide;
echo "<b>Opcije Botova</b><br/>\n";
echo "Gledati Odgovor:<br/>\n";
echo $fsize2;
echo "<select name=\"vict\">\n";
if($set["vict"] == 0){
echo "<option value=\"0\">Ne</option>\n";
echo "<option value=\"1\">Da</option>\n";
} else {
echo "<option value=\"1\">Da</option>\n";
echo "<option value=\"0\">Ne</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Interval Profesora(sec):<br/>\n";
echo $fsize2;
echo "<select name=\"victint\">\n";
if($set["victint"] === "5"){
echo "<option value=\"5\">5</option>\n";
}
elseif($set["victint"] === "30"){
echo "<option value=\"30\">30</option>\n";
}
elseif($set["victint"] === "60"){
echo "<option value=\"60\">60</option>\n";
}
elseif($set["victint"] === "120"){
echo "<option value=\"120\">120</option>\n";
}
echo "<option value=\"5\">5</option>\n";
echo "<option value=\"30\">30</option>\n";
echo "<option value=\"60\">60</option>\n";
echo "<option value=\"120\">120</option>\n";
echo "</select><br/>\n";
echo $fsize1;
echo "Zajebant:<br/>\n";
echo $fsize2;
echo "<select name=\"shut\">\n";
if($set["shut"] == 0){
echo "<option value=\"0\">Zakljucan</option>\n";
echo "<option value=\"1\">Otkljucan</option>\n";
} else {
echo "<option value=\"1\">Otkljucan</option>\n";
echo "<option value=\"0\">Zakljucan</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Interval Zajebanta (min):<br/>\n";
echo $fsize2;
echo "<select name=\"shutint\">\n";
if($set["shutint"] === "600"){
echo "<option value=\"600\">10</option>\n";
}
elseif($set["shutint"] === "1800"){
echo "<option value=\"1800\">30</option>\n";
}
elseif($set["shutint"] === "3600"){
echo "<option value=\"3600\">60</option>\n";
}
elseif($set["shutint"] === "7200"){
echo "<option value=\"7200\">120</option>\n";
}
echo "<option value=\"600\">10</option>\n";
echo "<option value=\"1800\">30</option>\n";
echo "<option value=\"3600\">60</option>\n";
echo "<option value=\"7200\">120</option>\n";
echo "</select><br/>\n";
echo $fsize1;
echo "Soba drugog zajebnta:<br/>\n";
echo "С\n";
echo $fsize2;
echo "<input size=\"2\" name=\"roomon\" maxlength=\"2\" value=\"$set[roomon]\" title=\"rmstart\"/>\n";
echo $fsize1;
echo "do:\n";
echo $fsize2;
echo "<input size=\"2\" name=\"roomoff\" maxlength=\"2\" value=\"$set[roomoff]\" title=\"rmfinish\"/><br/>\n";
echo $fsize1;
echo "Prodavac:<br/>\n";
echo $fsize2;
echo "<select name=\"prod\">\n";
if($set["prod"] == 0){
echo "<option value=\"0\">zakljucan</option>\n";
echo "<option value=\"1\">Otkljucan</option>\n";
} else {
echo "<option value=\"1\">Otkljucan</option>\n";
echo "<option value=\"0\">zakljucan</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo $divide;
echo "<b>Imena Botova</b><br/>\n";
echo $fsize2;
$system = mysql_fetch_array(mysql_query ("Select user from users where id='1' LIMIT 1;"));
echo $fsize1;
echo "ID-1:\n";
echo $fsize2;
echo "<input name=\"system\" maxlength=\"23\" value=\"$system[0]\" title=\"System\"/><br/>\n";
$umnik = mysql_fetch_array(mysql_query ("Select user from users where id='2' LIMIT 1;"));
echo $fsize1;
echo "ID-2:\n";
echo $fsize2;
echo "<input name=\"umnik\" maxlength=\"23\" value=\"$umnik[0]\" title=\"Umnik\"/><br/>\n";
$shutnik = mysql_fetch_array(mysql_query ("Select user from users where id='3' LIMIT 1;"));
echo $fsize1;
echo "ID-3:\n";
echo $fsize2;
echo "<input name=\"shutnik\" maxlength=\"23\" value=\"$shutnik[0]\" title=\"Shutnik\"/><br/>\n";
$prodavec = mysql_fetch_array(mysql_query ("Select user from users where id='4' LIMIT 1;"));
echo $fsize1;
echo "ID-4:\n";
echo $fsize2;
echo "<input name=\"prodavec\" maxlength=\"23\" value=\"$prodavec[0]\" title=\"Prodavec\"/><br/>\n";
$mafia = mysql_fetch_array(mysql_query ("Select user from users where id='5' LIMIT 1;"));
echo $fsize1;
echo "ID-5:\n";
echo $fsize2;
echo "<input name=\"mafia\" maxlength=\"23\" value=\"$mafia[0]\" title=\"Mafia\"/><br/>\n";
$trahtenberg = mysql_fetch_array(mysql_query ("Select user from users where id='6' LIMIT 1;"));
echo $fsize1;
echo "ID-6:\n";
echo $fsize2;
echo "<input name=\"trahtenberg\" maxlength=\"23\" value=\"$trahtenberg[0]\" title=\"Trahtenberg\"/><br/>\n";
$robokop = mysql_fetch_array(mysql_query ("Select user from users where id='7' LIMIT 1;"));
echo $fsize1;
echo "ID-7:\n";
echo $fsize2;
echo "<input name=\"robokop\" maxlength=\"23\" value=\"$robokop[0]\" title=\"Robokop\"/><br/>\n";
$mat = mysql_fetch_array(mysql_query ("Select user from users where id='8' LIMIT 1;"));
echo $fsize1;
echo "ID-8:\n";
echo $fsize2;
echo "<input name=\"mat\" maxlength=\"23\" value=\"$mat[0]\" title=\"Mat\"/><br/>\n";
echo $fsize1;
echo $divide;
echo $fsize2;
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Sacuvaj<go href=\"apanel.php?$ses&amp;go=updbots$takep\" method=\"post\">\n";
echo "<postfield name=\"reg\" value=\"$(reg)\"/>\n";
echo "<postfield name=\"banban\" value=\"$(banban)\"/>\n";
echo "<postfield name=\"sigurnareg\" value=\"$(sigurnareg)\"/>\n";
echo "<postfield name=\"iptime\" value=\"$(iptime)\"/>\n";
echo "<postfield name=\"softtime\" value=\"$(softtime)\"/>\n";
echo "<postfield name=\"regposts\" value=\"$(regposts)\"/>\n";
echo "<postfield name=\"vict\" value=\"$(vict)\"/>\n";
echo "<postfield name=\"shut\" value=\"$(shut)\"/>\n";
echo "<postfield name=\"valid\" value=\"$(valid)\"/>\n";
echo "<postfield name=\"prod\" value=\"$(prod)\"/>\n";
echo "<postfield name=\"victint\" value=\"$(victint)\"/>\n";
echo "<postfield name=\"shutint\" value=\"$(shutint)\"/>\n";
echo "<postfield name=\"roomon\" value=\"1000\"/>\n";
echo "<postfield name=\"roomoff\" value=\"1001\"/>\n";
echo "<postfield name=\"system\" value=\"$(system)\"/>\n";
echo "<postfield name=\"umnik\" value=\"$(umnik)\"/>\n";
echo "<postfield name=\"shutnik\" value=\"$(shutnik)\"/>\n";
echo "<postfield name=\"prodavec\" value=\"$(prodavec)\"/>\n";
echo "<postfield name=\"mafia\" value=\"$(mafia)\"/>\n";
echo "<postfield name=\"trahtenberg\" value=\"$(trahtenberg)\"/>\n";
echo "<postfield name=\"robokop\" value=\"$(robokop)\"/>\n";
echo "<postfield name=\"mat\" value=\"$(mat)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Sacuvaj\" name=\"enter\"><br/>\n";
echo "<input type=\"hidden\" name=\"roomon\" value=\"1000\"/>\n";
echo "<input type=\"hidden\" name=\"roomoff\" value=\"1001\"/>\n";
}
break;

case 'updbots':
if (!ctype_digit($reg)) {header("Location: index.php"); die;}
if (!ctype_digit($banban)) {header("Location: index.php"); die;}
if (!ctype_digit($sigurnareg)) {header("Location: index.php"); die;}
if (!ctype_digit($valid)) {header("Location: index.php"); die;}
if (!ctype_digit($vict)) {header("Location: index.php"); die;}
if (!ctype_digit($shut)) {header("Location: index.php"); die;}
if (!ctype_digit($prod)) {header("Location: index.php"); die;}
if (!ctype_digit($victint)) {header("Location: index.php"); die;}
if (!ctype_digit($shutint)) {header("Location: index.php"); die;}
if (!ctype_digit($roomon)) {header("Location: index.php"); die;}
if (!ctype_digit($roomoff)) {header("Location: index.php"); die;}
$iptime = check($iptime);
$softtime = check($softtime);
$regposts = check($regposts);
$system = check($system);
$umnik = check($umnik);
$shutnik = check($shutnik);
$prodavec = check($prodavec);
$mafia = check($mafia);
$trahtenberg = check($trahtenberg);
$robokop = check($robokop);
$mat = check($mat);
$iptime = mysql_escape_string($iptime);
$softtime = mysql_escape_string($softtime);
$system = mysql_escape_string($system);
$umnik = mysql_escape_string($umnik);
$shutnik = mysql_escape_string($shutnik);
$prodavec = mysql_escape_string($prodavec);
$mafia = mysql_escape_string($mafia);
$trahtenberg = mysql_escape_string($trahtenberg);
$robokop = mysql_escape_string($robokop);
$mat = mysql_escape_string($mat);
if (!isset($error)) {
$result = mysql_query ("Select * setting where klu4 = '1'");
if (mysql_affected_rows() == 0) {
$error = "Greska na bazi!";
} else {
if (mysql_query ("Update setting set reg='".$reg."', banban='".$banban."', valid='".$valid."', vict='".$vict."', shut='".$shut."', prod='".$prod."', victint='".$victint."', shutint='".$shutint."', roomon='".$roomon."', roomoff='".$roomoff."', sigurnareg='".$sigurnareg."', iptime='".$iptime."', softtime='".$softtime."', regposts='".$regposts."' where klu4 ='1'")&&
mysql_query ("Update users set user='".$system."' where id = '1'")&&
mysql_query ("Update users set user='".$umnik."' where id = '2'")&&
mysql_query ("Update users set user='".$shutnik."' where id = '3'")&&
mysql_query ("Update users set user='".$prodavec."' where id = '4'")&&
mysql_query ("Update users set user='".$mafia."' where id = '5'")&&
mysql_query ("Update users set user='".$trahtenberg."' where id = '6'")&&
mysql_query ("Update users set user='".$robokop."' where id = '7'")&&
mysql_query ("Update users set user='".$mat."' where id = '8'")){
$msg = "Podesavanja registracije i botova izmenjeni!";
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je promenio podesavanja botova i registracije!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
} else {
$msg = "Greska!!!";
}
}
} else {
$error = " ".mysql_error()." ";
}
if (isset($error)) {
echo $fsize1;
echo "$error\n";
echo $fsize2;
}
echo $fsize1;
echo "$msg<br/>\n";
echo $fsize2;
break;

case 'link':
$setting = mysql_query ("Select * from setting where klu4=1");
$set = mysql_fetch_array ($setting);
if($set["link1"]==""){$link1="http://";}else{$link1=$set["link1"];}
if($set["link2"]==""){$link2="http://";}else{$link2=$set["link2"];}
if($set["link3"]==""){$link3="http://";}else{$link3=$set["link3"];}
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updlink$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Link 1:<br/>";
echo $fsize2;
echo "<input name=\"link1\" maxlength=\"120\" value=\"".$link1."\" title=\"link1\"/><br/>\n";
echo $fsize1;
echo "Naziv 1:<br/>";
echo $fsize2;
echo "<input name=\"link1_name\" maxlength=\"40\" value=\"".$set["link1_name"]."\" title=\"link1_name\"/><br/>\n";
echo $fsize1;
echo "Link 2:<br/>";
echo $fsize2;
echo "<input name=\"link2\" maxlength=\"120\" value=\"".$link2."\" title=\"link2\"/><br/>\n";
echo $fsize1;
echo "Naziv 2:<br/>";
echo $fsize2;
echo "<input name=\"link2_name\" maxlength=\"40\" value=\"".$set["link2_name"]."\" title=\"link2_name\"/><br/>\n";
echo $fsize1;
echo "Link 3:<br/>";
echo $fsize2;
echo "<input name=\"link3\" maxlength=\"120\" value=\"".$link3."\" title=\"link3\"/><br/>\n";
echo $fsize1;
echo "Naziv 3:<br/>";
echo $fsize2;
echo "<input name=\"link3_name\" maxlength=\"40\" value=\"".$set["link3_name"]."\" title=\"link3_name\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?$ses&amp;go=updlink$takep\" method=\"post\">\n";
echo "<postfield name=\"link1\" value=\"$(link1)\"/>\n";
echo "<postfield name=\"link1_name\" value=\"$(link1_name)\"/>\n";
echo "<postfield name=\"link2\" value=\"$(link2)\"/>\n";
echo "<postfield name=\"link2_name\" value=\"$(link2_name)\"/>\n";
echo "<postfield name=\"link3\" value=\"$(link3)\"/>\n";
echo "<postfield name=\"link3_name\" value=\"$(link3_name)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;

case 'updlink':
if($row["level"]>6){
$link1_name = check($link1_name);
$link2_name = check($link2_name);
$link3_name = check($link3_name);
$link1_name = mysql_escape_string($link1_name);
$link2_name = mysql_escape_string($link2_name);
$link3_name = mysql_escape_string($link3_name);
if (!isset($error)) {
$result = mysql_query ("Select * setting where klu4 = '1'");
if (mysql_affected_rows() == 0) {
$error = "Greska!!!";
} else {
mysql_query ("Update setting set link1='".$link1."', link2='".$link2."', link3='".$link3."', link1_name='".$link1_name."', link2_name='".$link2_name."', link3_name='".$link3_name."' where klu4 = '1'");
$msg = "Linkovi su uspesno izmenjeni!";
}
} else {
$error = " ".mysql_error()." ";
}
if (isset($error)) {
echo $fsize1;
echo "$error\n";
echo $fsize2;
}
echo $fsize1;
echo "$msg<br/>\n";
echo $fsize2;
}else{
echo $fsize1;
echo "Nemate pravo pristupa!<br/>\n";
echo $fsize2;
}
break;

case 'editlevels':
$lev = mysql_query("select level,name from levels");
if(empty($act)) {
while($arr=mysql_fetch_array($lev)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=rnm&amp;$ses&amp;go=editlevels&amp;level=".$arr['level']."$takep\">".$arr['level'].". ".$arr['name']."</a><br/>";
echo $fsize2;
}
} elseif ($act=="dornm") {
if (!ctype_digit($level)) {header("Location: index.php"); die;}
$levelname = check($levelname);
$levelname = mysql_escape_string($levelname);
settype($level, 'integer');
$clanclan = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$level."'"));
mysql_query ("update levels set name='".$levelname."' where level='".$level."'");
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$text="$levelnamesa[0] <b>$namenski</b> je izmeni status <b>$clanclan[0]</b> u <b>$levelname</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='6'");
/////////////////////////////////////////////////////////////////////
echo $fsize1;
echo "Status je izmenjen!<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">Lista Statusa</a><br/>";
echo $fsize2;
} else {
$lev = mysql_query("select name from levels where level=$level");
$arr=mysql_fetch_array($lev);
$name=$arr["name"];
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?act=dornm&amp;$ses&amp;go=editlevels&amp;level=$level$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Status:<br/>\n";
echo $fsize2;
echo "<input name=\"levelname\" maxlength=\"200\" value=\"$arr[0]\" title=\"levelname\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?act=dornm&amp;$ses&amp;go=editlevels&amp;level=$level$takep\" method=\"post\">\n";
echo "<postfield name=\"levelname\" value=\"$(levelname)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo $fsize1;
echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">Lista Statusa</a><br/>";
echo $fsize2;
}
break;

case 'import_vopros':
$file=file("import/vopros.txt");
for($i=0;$i<count($file);$i++) {
$ex=explode("::",$file[$i]);
$tran=strtr(trim($ex[1]),array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","Z"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ш"=>"w","щ"=>"w","ц"=>"c","ч"=>"4","ь"=>".","ъ"=>".","ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Z"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ш"=>"W","Щ"=>"W","Ц"=>"C","Ч"=>"4","Ь"=>".","Ъ"=>".","Ы"=>"Y","Э"=>"E","Ю"=>"Yu","Я"=>"Ya"));
mysql_query ("Select * from bots");
$k = mysql_affected_rows()+1;
mysql_query ("Insert into bots set number= '".$k."', vopros='".trim($ex[0])."', answer='".trim($ex[1])."',  tran='".$tran."'");
$count = count($file);
}
echo $fsize1;
echo "U bazi $count Pitanja!";
echo $fsize2;
break;

case 'delsmiles':
if($row["level"]>6){
$q = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM smilies WHERE id='".$kod."'"));
if ($q[0]==0) {
echo $fsize1;
echo "Ovaj smajli ne postoji!<br/>\n";
echo $fsize2;
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$clanclan = mysql_fetch_array(mysql_query("SELECT url, code FROM smilies WHERE id='".$kod."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao smajli <b>$clanclan[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("DELETE FROM smilies WHERE id='".$kod."'")){
echo $fsize1;
unlink($clanclan[0]);
echo "Smajli je obrisan!<br/>";
echo $fsize2;
}
}
}else{
echo $fsize1;
echo "Ne mozete brisati smajli!";
echo $fsize2;
}
break;

case 'pwtread':
$read=$_GET["read"];
if($row["level"]>8){
mysql_query("UPDATE setting SET pwtread='".$read."'");
echo $fsize1;
if($read==1){
$kom="ukljuceno";
}else{
$kom="iskljuceno";
}
echo "Citanje PWT je $kom!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete koristiti ovu opciju!<br/>";
echo $fsize2;
}
break;

case 'brisidown':
if($row["level"]>6){
$q = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM downs WHERE id='".$kod."'"));
if ($q[0]==0) {
echo $fsize1;
echo "Ovaj fajl ne postoji!<br/>\n";
echo $fsize2;
} else {
/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$clanclan = mysql_fetch_array(mysql_query("SELECT url, code FROM downs WHERE id='".$kod."'"));
$text="$levelnamesa[0] <b>$namenski</b> je obrisao fajl iz extra download sekcije <b>$clanclan[0]</b>!<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='2'");
/////////////////////////////////////////////////////////////////////
if(mysql_query("DELETE FROM downs WHERE id='".$kod."'")){
echo $fsize1;
unlink($clanclan[0]);
echo "Fajla iz download sekcije uspesno obrisana!<br/>";
echo $fsize2;
}
}
}else{
echo $fsize1;
echo "Ne mozete brisati fajl!";
echo $fsize2;
}
break;

}
echo $fsize1;
echo "<div class=\"d1\">";
if($go) echo "<a href=\"apanel.php?$ses$takep\">Admin CP</a><br/>\n";
if (isset ($rm) && $rm!="") echo "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>\n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo "</div>";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush();
?>
