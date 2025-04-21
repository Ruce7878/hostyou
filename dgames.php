<?
header("Cache-Control: no-cache");
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
if ($ver=="wml"){
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">\n";
echo "<wml>\n<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/>\n";
echo "<meta http-equiv=\"Pragma\" content=\"no-cache\"/></head>\n";
echo "<card id=\"x\" title=\"Download \">\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Download </title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
//////////////////////////////////////////////////////////////////
$page=$_GET["page"];
$type=$_GET["type"];
  echo $fsize1;
  if($type=="sis"){$naslov="Symbian Aplikacje";}
  else if($type=="jar"){$naslov="Java Aplikacje";}
  if($type=="mp3"){$naslov="Mp3 Download";}
  else {$naslov="Download ";}
  echo "<b>$naslov</b><br/>";
  echo $divide;
  echo $fsize2;
///////////////////////////////////////////////////////////////////
if($type=="sis" || $type=="jar" || $type=="mp3"){
if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ugames WHERE type='".$type."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 10;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    $sql = "SELECT id, url, code FROM ugames WHERE type='".$type."' ORDER BY code ASC LIMIT $limit_start, $items_per_page ";
    print $fsize1;
    $items = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($items)>0)
    {
    while ($item = mysql_fetch_array($items))
   	{
	$size = filesize($item[1]);
	if($size<1024){$size1="$size B";}
	else if($size>=1024 && $size<1048576){$vel=$size/1024; $size2=round($vel, 2); $size1="$size2 KB";}
	else if($size>=1048576){$vel=$size/1048576; $size2=round($vel, 2); $size1="$size2 MB";}
    echo "<a href=\"$item[1]\">$item[2]($size1)</a> ";
    if($row["level"]==8){echo "<a href=\"apanel.php?$ses&amp;go=delgames&amp;kod=$item[0]&amp;rm=$rm\">[X]</a>";}
	echo "<br/>";
    }
    }
    print $fsize2;
    echo "</p>";
    echo "<p align=\"center\">";
    print $fsize1;
    if($page>1)
    {
      $ppage = $page-1;
      echo "<a href=\"dgames.php?type=$type&amp;page=$ppage&amp;$ses&amp;ref=$ref\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"dgames.php?type=$type&amp;page=$npage&amp;$ses&amp;ref=$ref\">Napred&#187;</a>";
    }
    echo "<br/>$noi[0] <br/>";
    print $fsize2;
	}else{
	print $fsize1;
	$noi1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ugames WHERE type='sis'"));
	echo "<a href=\"dgames.php?$ses&amp;rm=$rm&amp;ref=$ref&amp;type=sis\">Symbian Aplikacje($noi1[0])</a><br/>";
	$noi2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ugames WHERE type='jar'"));
	echo "<a href=\"dgames.php?$ses&amp;rm=$rm&amp;ref=$ref&amp;type=jar\">Java Aplikacje($noi2[0])</a><br/>";
	$noi3 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ugames WHERE type='mp3'"));
	echo "<a href=\"dgames.php?$ses&amp;rm=$rm&amp;ref=$ref&amp;type=mp3\">Mp3 Download($noi3[0])</a><br/>";
	print $fsize2;
	}
//////////////////////////////////////////////////////////////////
echo $fsize1;
echo $divide;
if($row["level"]>4){
echo "<a href=\"ugames.php?action=uploader&amp;$ses&amp;ref=$ref\">Uploaduj Fajl</a><br/>";
}
if(isset($rm) && $rm!=""){
echo "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>";
}
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>