<?php
/* --------------------------------------  /
/          Do not delete this              /
/         EdykaChat script v1.0            /  
/  --------------------------------------- /  
/              CODING IS ART!              /  
/      This chat  script was made by       /  
/        Edyka (dizajner.tk)               /  
/    IT IS A REMAKE OF THE region-56       /  
/             CHAT SCRIPT                  /  
/ --------------------------------------  */
define('_IN_EDYCHAT',1); 

/* START THE FUN! */
require("inc.php");

 /* and so we go... */

list($userData, $id, $ps, $fsize1, $fsize2) = check_login($link);

///////////////////////////////////////////
$gde="Download";
updgdeuser($gde,$id); // update user place
///////////////////////////////////////////
echo edyka_head("Download",$userData);
$nocna = mysql_fetch_array(mysql_query("SELECT lockvic FROM ".TABLE_PREFIX."setting"));
if($nocna[0]==0){

echo "Greska!<br/>";
echo $divide;
echo "Nocni ulasci na ovu opciju chata nisu dozvoljeni!<br/>";
echo $divide;
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>\n";

echo edyka_foot($divide);
exit;
}
if($topid<=0) $topid=0;
else $topid=(int) $topid;
switch($go) {
case 'newcat':
if(!isset($_POST['submit'])) {
echo '<b>Napravi folder:</b><br /><form method="post" action="downloads.php?go=newcat&amp;topid='.$topid.'&amp;$ses&amp;ref=$ref">';
echo 'Naziv foldera:<br/><input type="text" name="naziv" value=""  /><br/><input type="submit" name="submit" value="Dodaj" /></form>';
} else if($userData['level']>=6) {
 mysql_query("INSERT INTO ".TABLE_PREFIX."downcat SET name='".$naziv."',topid='".$topid."',time='".time()."' ");
 echo "Folder dodat!<br/>";
 echo "<a href=\"downloads.php?$ses&amp;pogledaj=$topid\">Nazad</a><br/>";

} else echo "Nemas prava pristupa!";
break;
case 'delcat':
if($userData['level']>=6) {
 mysql_query("DELETE FROM ".TABLE_PREFIX."downcat WHERE id='".$topid."'");
 echo "Folder  je izbrisan!<br/>";
 echo "<a href=\"downloads.php?$ses&amp;pogledaj=$topid\">Nazad</a><br/>";

} else echo "Nemas prava pristupa!";

break;
default:

echo "<b>Download zona - za svakoga po nešto</b><br/>";
echo $divide;
     $req=mysql_query("SELECT * FROM ".TABLE_PREFIX."downcat WHERE topid='0' ");
	 while($res=mysql_fetch_array($req)) {
	echo "
	<img src=\"images/icons/folder.gif\" alt=\"\"/> <a href=\"downloads.php?go=pogledaj&amp;topid=".$res['id']."&amp;$ses&amp;ref=$ref\">".$res['name']."</a><br/>";
	}
	echo '<br/>';
	//<a href=\"downloads.php?go=pretraga&amp;$ses&amp;ref=$ref\">Pretraga Fajlova</a>
	if($userData["level"]>=6) echo "<a href=\"downloads.php?go=newcat&amp;topid=0&amp;$ses&amp;ref=$ref\">Napravi folder</a><br/>";
	if($userData["level"]>=6) echo "<a href=\"uploadf.php?$ses&amp;katid=0\">Dodaj fajl!</a><br/>";

break;

case 'pogledaj':
  	$limit = 7;
    if(empty($page))$page = 1;
    $limitvalue = $page * $limit - ($limit);
	$about= mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_PREFIX."downcat  WHERE id='".$topid."'"));
	$req  = mysql_query("SELECT * FROM ".TABLE_PREFIX."downcat WHERE topid='".$topid."'");
	       echo"<b>$about[name]</b><br/>$divide";
if(mysql_num_rows($req)>0) {
	while($res=mysql_fetch_array($req)) {
	echo "
	<img src=\"images/icons/folder.gif\" alt=\"\"/> <a href=\"downloads.php?go=pogledaj&amp;topid=".$res['id']."&amp;$ses&amp;ref=$ref\">".$res['name']."</a><br/>";
	}}
	echo '<br/>';

	
	$query  = "SELECT id, filename, description,  uid, dcount FROM ".TABLE_PREFIX."cupload WHERE mime='".$topid."' ORDER BY id DESC LIMIT $limitvalue, $limit";
	$query1  = "SELECT filename, description,  uid FROM ".TABLE_PREFIX."cupload WHERE mime='".$topid."'";
	$iml = "<img src=\"images/video.gif\" alt=\"\"/>";
	
	
	   $result = mysql_query($query) or die("Greska...<br/>");
	   $totalrows = mysql_num_rows(mysql_query($query1));
       echo $divide;
	   if($totalrows == 0) echo "Nema fajlova u ovom folderu!<br/>";

		while($fdat = mysql_fetch_array($result)){
		if ($userData["level"]>=4) $del= "[<a href=\"downloads.php?go=brisi&amp;filename=".$fdat['filename']."&amp;$ses&amp;ref=$ref\">x</a>]";
		echo " - <a href=\"downloads.php?go=detalji&amp;file=".$fdat['id']."&amp;$ses&amp;ref=$ref\">".$fdat['filename']."</a> $del<br/>";
		//echo "Dodao: <a href=\"info.php?nk=".$userData['uid']."&amp;$ses&amp;ref=$ref\">$usr</a><br/>";
		echo "&#187;Preuzeto: ".$fdat['dcount']." puta<br/>";
		}

		echo "<br/>";
		if($page != 1){
		$pageprev = $page-1;
		echo("<a href=\"downloads.php?$ses&amp;go=$go&amp;type=$type&amp;page=$pageprev&amp;ref=$ref\">&#171; Nazad</a> ");
		}
		$pagenext = $page+1;
		$numofpages = ceil($totalrows / $limit);
		if($page<$numofpages){
		echo("<a href=\"downloads.php?$ses&amp;go=$go&amp;type=$type&amp;page=$pagenext&amp;ref=$ref\">Napred &#187;</a>");
		}

		mysql_free_result($result);

	echo "<br/><b>Fajlova u kategoriji: </b>$totalrows<br/>";
	echo "<b>$page</b> / <b>$numofpages</b><br/>";

	if ($ver=="wml"){
    if($numofpages>2)
    {
        $rets = "Idi na stranicu<input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[idi]";
        $rets .= "<go href=\"downloads.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
		$rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"type1\" value=\"$type\"/>";
		$rets .= "<postfield name=\"go\" value=\"$go\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
        $rets .= "</go></anchor><br/>";

        echo $rets;
    }
	} else {
	 if($numofpages>2)
    {

	    $rets = "<form action=\"downloads.php\" method=\"get\">";
        $rets .= "Idi na stranicu<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
		$rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
		$rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
		$rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
		$rets .= "<input type=\"hidden\" name=\"type1\" value=\"$type\"/>";
		$rets .= "<input type=\"hidden\" name=\"go\" value=\"$go\"/>";
        $rets .= "</form>";

	 echo $rets;
    }
	}
	if($userData["level"]>=6) echo "<a href=\"downloads.php?go=delcat&amp;topid=$topid&amp;$ses&amp;ref=$ref\">Obrisi folder $about[name]</a><br/>";
	if($userData["level"]>=6) echo "<a href=\"downloads.php?go=newcat&amp;topid=0&amp;$ses&amp;ref=$ref\">Napravi folder </a><br/>";
	if($userData["level"]>=6) echo "<a href=\"uploadf.php?$ses&amp;ref=$ref&amp;katid=$topid\">Dodaj fajl!</a><br/>";
break;

case 'detalji':

$file=intval($_GET['file']);
$details = mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_PREFIX."cupload  WHERE id = '".$file."'"));
echo "<a href=\"downloads.php?go=uzmi&amp;downid=$details[0]&amp;$ses&amp;ref=$ref\">Preuzmi fajl</a><br/>$divide";
if ($userData["level"]>=4) echo "<b>Fajl ID:</b> $details[0]<br/>";
if(($details[1]==$id) || $userData["level"]>=4) $blah="[<a href=\"downloads.php?go=menjaj&amp;$ses&amp;ref=$ref&amp;file=$file\">Izmeni</a>]";
echo "<b>Ime:</b> $details[filename]<br/>";
echo "<b>Opis fajla:</b> ".htmlspecialchars($details[10])." $blah<br/>";
echo "<b>Veličina:</b> $details[4]<br/>";
echo "<b>Kategorija:</b> $details[8]<br/>";
echo "<b>Dodato:</b> $details[3]<br/>";
if ($userData["level"]>=4){
echo "<b>Browser:</b> $details[6]<br/>";
echo "<b>IP:</b> $details[5]<br/>";
//echo "<b>Br tel:</b> $details[7]<br/>";
}
echo "<b>Preuzeto:</b> $details[9] puta<br/>";
echo "<a href=\"downloads.php?go=uzmi&amp;downid=$details[0]&amp;$ses&amp;ref=$ref\">Preuzmi fajl</a><br/>";
if ($userData["level"]>=4) echo "[<a href=\"downloads.php?go=brisi&amp;filename=$details[2]&amp;$ses&amp;ref=$ref\">Brisi fajl</a>]<br/>";

break;

case 'uzmi':
 $downid= intval($_GET['downid']);
 $downloads = mysql_fetch_array(mysql_query("SELECT dcount FROM ".TABLE_PREFIX."cupload  WHERE id='".$downid."'"));
 $incresedownload = $downloads[0] + 1;
 mysql_query("UPDATE ".TABLE_PREFIX."cupload  SET dcount='".$incresedownload."' WHERE id='".$downid."'");
 $link = mysql_fetch_array(mysql_query("SELECT filename FROM ".TABLE_PREFIX."cupload  WHERE id='".$downid."'"));
 $adresa="files/download/$link[0]";
 //Header("Location: " . $adresa);
 echo "<b>Sačejakte par sekundi za preuzimanje, ako ne počne automatski kliknite <a href=\"$adresa\">OVDE</a></b><br/>";
if($ver!="wml")echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=$adresa\">";
break;

case 'brisi':
    if($userData["level"]>=6)
    {

		$blah1=unlink("files/download/$filename");
		$blah2=mysql_query("DELETE FROM ".TABLE_PREFIX."cupload  WHERE filename='".$filename."'");

		mysql_query("INSERT INTO log__chat SET action='BrisanjeFajla', details='<b>$deleter</b> je obrisao fajl ".$filename." iz download a', actdt='".time()."'");
		if($blah1&&$blah2){
			echo "Fajl je uspesno obrisan.<br/>";
		}
		else {
		echo "Greska pri brisanju fajla.<br/>";
		}
	}else echo "Ne mozete obrisati ovu poruku.<br/>";

break;

case 'menjaj':
  $file = intval($_GET["file"]);
  $detail = mysql_fetch_array(mysql_query("SELECT uid, description FROM ".TABLE_PREFIX."cupload  WHERE id='".$file."'"));
  if(($detail[0]==$id) || $userData["level"]>=4){

  echo "Izmenite opis fajla ID: $file<br/>";
  if($ver!="wml") {
  echo "<form action=\"downloads.php?go=izmeni&amp;file=$file&amp;$ses&amp;ref=$ref\" method=\"post\">
  <input id=\"inputText\" type=\"text\" name=\"comment$ref\" value=\"$detail[1]\" maxlength=\"255\"/>";
    echo "<br/><input id=\"inputButton\" type=\"submit\" name=\"Izmeni\"/></form><br/>";
	} else {
	echo "<input name=\"comment$ref\" value=\"$detail[1]\" maxlength=\"255\"/><br/>";
	echo "<anchor>Dodaj<go href=\"downloads.php?go=izmeni&amp;file=$file&amp;$ses&amp;ref=$ref\" method=\"post\">";
	echo "<postfield name=\"comment\" value=\"$(comment$ref)\"/>";
	echo "</go></anchor><br/>";
	}
  }else{
      echo "Nemate pravo pristupa ovde <br/>";
  }
break;

case 'izmeni':
$file = intval($_GET["file"]);
$comment=mysql_escape_string(trim($_POST['comment']));
  $detail = mysql_fetch_array(mysql_query("SELECT uid FROM ".TABLE_PREFIX."cupload  WHERE id='".$file."'"));
  if(($detail[0]==$id) || $userData["level"]>=4){
  $blah = mysql_query("UPDATE ".TABLE_PREFIX."cupload  SET description='".$comment."' WHERE id='".$file."'");

  $blah1 = mysql_query("INSERT INTO chat__log SET action='fajlovi', details='<b>$doer</b> je menjao opis fajla ID: ".$file." u download u', actdt='".time()."'");
  if($blah){
	  echo "Uspesno izmenjeno!<br/>";
  }
  else{
	  echo "Nije moguce menjati opis.<br/>";
  }
  }
  else{
    echo "Nemate pravo pristupa ovde!<br/>";
  }
break;

case 'pretraga':

  if($ver!="wml")echo "<form action=\"downloads.php?go=trazi&amp;$ses&amp;ref=$ref\" method=\"post\">";
  echo "Ime fajla:<br/> <input id=\"inputText\" name=\"sname\" maxlength=\"30\"/><br/>";
  echo "Dodat od:<br/> <input id=\"inputText\" name=\"sby\" maxlength=\"30\"/><br/>";
  echo "Opis:<br/> <input id=\"inputText\" name=\"sdec\" maxlength=\"30\"/><br/>";
  echo "Tip fajla:<br/> <select id=\"inputText\" name=\"stype\">";
  echo "<option value=\"7\">Svi fajlovi</option>";
  echo "<option value=\"1\">Video</option>";
  echo "<option value=\"2\">Slika</option>";
  echo "<option value=\"3\">Melodija</option>";
  echo "<option value=\"4\">Dokument</option>";
  echo "<option value=\"5\">Arhiva</option>";
  echo "<option value=\"6\">Igrica/Aplikacija</option>";
  echo "</select><br/>";
if($ver!="wml")echo "<input id=\"inputButton\" type=\"submit\" value=\"Trazi\"/>";
else {
	echo "<anchor>Trazi";
	echo "<go href=\"downloads.php?go=trazi&amp;$ses&amp;ref=$ref\" method=\"post\">
	<postfield name=\"sname\" value=\"$(sname)\"/>
	<postfield name=\"sby\" value=\"$(sby)\"/>
	<postfield name=\"sdec\" value=\"$(sdec)\"/>
	<postfield name=\"stype\" value=\"$(stype)\"/>
	</go></anchor><br/>";
}

break;

case'trazi':
	
	 $fname = mysql_escape_string(trim($_POST["sname"]));
	 $fby = mysql_escape_string(trim($_POST["sby"]));
	 $ftype = intval($_POST["stype"]);
	 $fdec = mysql_escape_string(trim($_POST["sdec"]));
	 $uid = getuid_nick($fby);
	if ($uid!="") $part="uid = '".$uid."' AND";
	else $part="";
	  switch($ftype){
	  case 1:
	$noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='video'"));
		if($page=="" || $page<1)$page=1;
		$num_items = $noi[0];
		$items_per_page = 10;
		$num_pages = ceil($num_items/$items_per_page);
		if(($page>$num_pages)&&$page!=1)$page= $num_pages;
		$limit_start = ($page-1)*$items_per_page;
	$sql = "SELECT filename FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='video' LIMIT $limit_start, $items_per_page";
	   break;
	   case 2:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='image'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page;
     $sql = "SELECT filename FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='image' LIMIT $limit_start, $items_per_page";
	       break;
	   case 3:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='audio'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page;
      $sql = "SELECT filename FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='audio' LIMIT $limit_start, $items_per_page";
	       break;
	   case 4:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='document'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page;
      $sql = "SELECT filename FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='document' LIMIT $limit_start, $items_per_page";
	       break;
	   case 5:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='archive'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page;
      $sql = "SELECT filename FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='archive' LIMIT $limit_start, $items_per_page";
	       break;
	   case 6:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='apps'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page;
      $sql = "SELECT filename FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' AND mime='apps' LIMIT $limit_start, $items_per_page";
	       break;
	   case 7:
      $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%'"));
          if($page=="" || $page<1)$page=1;
          $num_items = $noi[0];
          $items_per_page = 10;
          $num_pages = ceil($num_items/$items_per_page);
          if(($page>$num_pages)&&$page!=1)$page= $num_pages;
          $limit_start = ($page-1)*$items_per_page;
      $sql = "SELECT filename FROM ".TABLE_PREFIX."cupload  WHERE $part filename LIKE '%".$fname."%' AND description LIKE '%".$fdec."%' LIMIT $limit_start, $items_per_page";
	       break;
	  }


             echo "<center><b><u>Rezultati pretrage</u></b></center><br/>";
             echo "<center>$noi[0] rezultata pronadjeno!</center><br/>";
             echo $divide;

if($noi[0]=='0') echo "<br/><center>Nema razultata, promenite zahtev za pretragu.</center><br/>";
else
{

     $items = mysql_query($sql);
     while($item=mysql_fetch_array($items))
     {
		$tlink = "<a href=\"downloads.php?go=detalji&amp;$ses&amp;file=$item[0]&amp;ref=$ref\">".$item[0]."</a><br/>";
		echo "$tlink";
     }
  echo $divide;
  if($page>1)
  {
    $ppage = $page-1;
	if ($ver=="wml"){
	$rets .= "<anchor>&#171;Nazad";
	$rets .= "<go href=\"downloads.php?go=$go&amp;$ses&amp;ref=$ref&amp;page=$ppage\" method=\"get\">";
	$rets .= "<postfield name=\"sname\" value=\"$fname\"/>";
	$rets .= "<postfield name=\"stype\" value=\"$ftype\"/>";
	$rets .= "<postfield name=\"sdec\" value=\"$fdec\"/>";
	$rets .= "<postfield name=\"sby\" value=\"$fby\"/>";
	$rets .= "</go></anchor><br/>";
	echo $rets;
	} else {
    $rets = "<form action=\"downloads.php?go=$go&amp;$ses&amp;ref=$ref&amp;page=$ppage\" method=\"post\">";
    $rets .= "<input type=\"hidden\" name=\"sname\" value=\"$fname\"/>";
    $rets .= "<input type=\"hidden\" name=\"stype\" value=\"$ftype\"/>";
    $rets .= "<input type=\"hidden\" name=\"sdec\" value=\"$fdec\"/>";
    $rets .= "<input type=\"hidden\" name=\"sby\" value=\"$fby\"/>";
    $rets .= "<input id=\"inputButton\" type=\"submit\" value=\"&#171;Nazad\"/></form> ";
    echo $rets; }

  }
  if($page<$num_pages)
  {
	$npage = $page+1;
	if ($ver=="wml"){
	$rets .= "<anchor>Napred&#187;";
	$rets .= "<go href=\"downloads.php?go=$go&amp;$ses&amp;ref=$ref&amp;page=$npage\" method=\"get\">";
	$rets .= "<postfield name=\"sname\" value=\"$fname\"/>";
	$rets .= "<postfield name=\"stype\" value=\"$ftype\"/>";
	$rets .= "<postfield name=\"sdec\" value=\"$fdec\"/>";
	$rets .= "<postfield name=\"sby\" value=\"$fby\"/>";
	$rets .= "</go></anchor><br/>";
	echo $rets;
	} else {
    $rets = "<form action=\"downloads.php?go=$go&amp;$ses&amp;ref=$ref&amp;page=$npage\" method=\"post\">";
    $rets .= "<input type=\"hidden\" name=\"sname\" value=\"$fname\"/>";
    $rets .= "<input type=\"hidden\" name=\"stype\" value=\"$ftype\"/>";
    $rets .= "<input type=\"hidden\" name=\"sdec\" value=\"$fdec\"/>";
    $rets .= "<input type=\"hidden\" name=\"sby\" value=\"$fby\"/>";
    $rets .= "<input id=\"inputButton\" type=\"submit\" value=\"Napred&#187;\"/></form> ";
    echo $rets; }

  }
  echo "<br/>$page/$num_pages<br/>";

 	if ($ver=="wml"){
    if($num_pages>2)
    {
        $rets = "Idi na stranicu<input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[idi]";
        $rets .= "<go href=\"anketa.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
		$rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
        $rets .= "<postfield name=\"sname\" value=\"$fname\"/>";
		$rets .= "<postfield name=\"stype\" value=\"$ftype\"/>";
		$rets .= "<postfield name=\"sdec\" value=\"$fdec\"/>";
		$rets .= "<postfield name=\"sby\" value=\"$fby\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
        $rets .= "</go></anchor><br/>";
        echo $rets;
    }
	} else {
	 if($num_pages>2)
    {

	    $rets = "<form action=\"anketa.php\" method=\"get\">";
        $rets .= "Idi na stranicu<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
		$rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
		$rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
		$rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
		$rets .= "<input type=\"hidden\" name=\"sname\" value=\"$fname\"/>";
		$rets .= "<input type=\"hidden\" name=\"stype\" value=\"$ftype\"/>";
		$rets .= "<input type=\"hidden\" name=\"sdec\" value=\"$fdec\"/>";
		$rets .= "<input type=\"hidden\" name=\"sby\" value=\"$fby\"/>";
        $rets .= "</form>";

	 echo $rets;
    }
	}

}
 
break;
}

echo $divide;
if($go) echo "<a href=\"downloads.php?$ses&amp;rm=$rm&amp;ref=$ref\">Download</a><br/>";
echo "<a href=\"enter.php?$ses&amp;rm=$rm&amp;ref=$ref\">Predsoblje</a><br/>";

echo edyka_foot($divide);
 
exit();
?>