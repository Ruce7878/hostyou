<?
header('Cache-Control: no-store, no-cache, must-revalidate');
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
$ggggg=$row["gzip"];
if($ggggg=="1"){
include("gz.php");
}
///////////////////////////////////////////
$gde="Download/Upload";
include("gde.php");
///////////////////////////////////////////
$user=$row["user"];
$level=$row["level"];
if(isset($who) && $who>0){$user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who."'"));
$naslov="Download/Upload";
}else{
$naslov="Download/Upload";
}
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
echo "Uploadujte Muziku, Video, Slike!<br/>";
  $video = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM download WHERE type='video'"));
  $image = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM download WHERE type='image'"));
  $music = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM download WHERE type='music'"));
echo $divide;
  echo "Video: <b><a href=\"download.php?mod=video&amp;$ses&amp;ref=$ref\">$video[0]</a></b><br/>";
  echo "Slike: <b><a href=\"download.php?mod=image&amp;$ses&amp;ref=$ref\">$image[0]</a></b><br/>";
  echo "Muzika: <b><a href=\"download.php?mod=music&amp;$ses&amp;ref=$ref\">$music[0]</a></b><br/>";
  echo $divide;
  echo "<a href=\"uploader1.php?$ses&amp;ref=$ref\">Uploaduj fajl(xhtml)</a><br/>";
  //echo "<a href=\"download.php?mod=dodajurl&amp;$ses&amp;ref=$ref\">Dodaj fajl</a><br/>";
echo $fsize2;
break;

case 'video':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
echo "Video Fajlovi<br/>";
echo $divide;


    //////ALL gallery SCRIPT <<

    if($page=="" || $page<=0)$page=1;


    if($who!="")
    {
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM download WHERE type='video'"));
    }else{
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM download WHERE type='video'"));
    }

    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT id, uid, name, type, file FROM download WHERE type='video' ORDER BY name ASC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
	$i=($page-1)*10;
    while ($item = mysql_fetch_array($items))
    {
	$i=$i+1;
$who11 = $item[1];
$user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who11."'"));

//$countpics = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gallery WHERE user='".$who."'"));
      echo "<a href=\"$item[4]\">$item[2]</a> od ";
	  echo "<a href=\"info.php?nk=$item[1]&amp;$ses&amp;ref=$ref\">$user[0]</a>";
	  if($row["level"]==8 || $id==$item[1])
	  {
		echo " <a href=\"download.php?mod=brisi&amp;$ses&amp;ref=$ref&amp;idi=$item[0]\">[X]</a><br/>";
	  }else{
	  echo "<br/>";
	  }
    }
    echo "<br/>";
    }else{
echo "<br/>Nema video fajlova!<br/>";
}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"download.php?mod=$mod&amp;page=$ppage&amp;$ses&amp;ref=$ref\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"download.php?mod=$mod&amp;page=$npage&amp;$ses&amp;ref=$ref\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"download.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"mod\" value=\"$mod\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"download.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"mod\" value=\"$mod\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }

echo $fsize2;
break;

case 'music':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
echo "Muzika Fajlovi<br/>";
echo $divide;


    //////ALL gallery SCRIPT <<

    if($page=="" || $page<=0)$page=1;


    if($who!="")
    {
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM download WHERE type='music'"));
    }else{
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM download WHERE type='music'"));
    }

    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT id, uid, name, type, file FROM download WHERE type='music' ORDER BY name ASC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
	$i=($page-1)*10;
    while ($item = mysql_fetch_array($items))
    {
	$i=$i+1;
$who11 = $item[1];
$user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who11."'"));

//$countpics = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gallery WHERE user='".$who."'"));
      echo "<a href=\"$item[4]\">$item[2]</a> od ";
	  echo "<a href=\"info.php?nk=$item[1]&amp;$ses&amp;ref=$ref\">$user[0]</a>";
	  if($row["level"]==8 || $id==$item[1])
	  {
		echo " <a href=\"download.php?mod=brisi&amp;$ses&amp;ref=$ref&amp;idi=$item[0]\">[X]</a><br/>";
	  }else{
	  echo "<br/>";
	  }
    }
    echo "<br/>";
    }else{
echo "<br/>Nema muzika fajlova!<br/>";
}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"download.php?mod=$mod&amp;page=$ppage&amp;$ses&amp;ref=$ref\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"download.php?mod=$mod&amp;page=$npage&amp;$ses&amp;ref=$ref\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"download.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"mod\" value=\"$mod\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"download.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"mod\" value=\"$mod\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }

echo $fsize2;
break;

case 'image':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
echo "Slike Fajlovi<br/>";
echo $divide;


    //////ALL gallery SCRIPT <<

    if($page=="" || $page<=0)$page=1;


    if($who!="")
    {
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM download WHERE type='image'"));
    }else{
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM download WHERE type='image'"));
    }

    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

$sql = "SELECT id, uid, name, type, file FROM download WHERE type='image' ORDER BY name ASC LIMIT $limit_start, $items_per_page";


    $items = mysql_query($sql);
    echo mysql_error();
    
    if(mysql_num_rows($items)>0)
    {
	$i=($page-1)*10;
    while ($item = mysql_fetch_array($items))
    {
	$i=$i+1;
$who11 = $item[1];
$user=mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$who11."'"));

//$countpics = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM gallery WHERE user='".$who."'"));
      echo "<a href=\"$item[4]\">$item[2]</a> od ";
	  echo "<a href=\"info.php?nk=$item[1]&amp;$ses&amp;ref=$ref\">$user[0]</a>";
	  if($row["level"]==8 || $id==$item[1])
	  {
		echo " <a href=\"download.php?mod=brisi&amp;$ses&amp;ref=$ref&amp;idi=$item[0]\">[X]</a><br/>";
	  }else{
	  echo "<br/>";
	  }
    }
    echo "<br/>";
    }else{
echo "<br/>Nema slika fajlova!<br/>";
}
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"download.php?mod=$mod&amp;page=$ppage&amp;$ses&amp;ref=$ref\">«Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"download.php?mod=$mod&amp;page=$npage&amp;$ses&amp;ref=$ref\">Napred»</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>2)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"download.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"mod\" value=\"$mod\"/>";
        $rets .= "</go></anchor><br/>";
        }else{
        $rets = "<form align=\"center\" action=\"download.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"mod\" value=\"$mod\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }

echo $fsize2;
break;

case 'brisi':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";
echo $fsize1;
  $idi = $_GET["idi"];
    $vlasnik = mysql_fetch_array(mysql_query("SELECT uid, name, file FROM download WHERE id='".$idi."'"));
	//$clanski = mysql_fetch_array(mysql_query("SELECT moder, admin FROM chat_users WHERE id='".$id."'"));
    if($id==$vlasnik[0] || $row["level"]==8)
	{
        $res = mysql_query("DELETE FROM download WHERE id ='".$idi."'");
        if($res)
        {
		unlink("$vlasnik[2]");
            echo "Fajl je uspesno obrisan!";
        }else{
            echo "Greska na bazi!";
        }
    }else{
        echo "Ne mozete obrisati ovaj fajl!";
    }
    echo $fsize2;
break;
}
echo $fsize1;
echo $divide;

if($mod) echo "<a href=\"download.php?$ses&amp;ref=$ref\">Download</a><br/>\n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>
