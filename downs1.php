<?php
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
///////////////////////////////////////////
$gde="Download Kategorije";
include("gde.php");
///////////////////////////////////////////
$tip=$_GET["tip"];
$ver=$_GET["ver"];
$id=$_GET["id"];
$ps=$_GET["ps"];
$ref=$_GET["ref"];

if($tip=='1'){$naslov="Java Aplikacije";}
else if($tip=='2'){$naslov="Symbian Aplikacije";}
else if($tip=='3'){$naslov="Mp3 Muzika";}
else if($tip=='4'){$naslov="3gp Video";}
else if($tip=='5'){$naslov="Slicice";}

if ($ver=="wml"){
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">\n";
echo "<wml>\n<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/>\n";
echo "<meta http-equiv=\"Pragma\" content=\"no-cache\"/></head>\n";
echo "<card id=\"x\" title=\"$naslov\">\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>$naslov</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
print $fsize1;
echo"<div class = 'd1'><b>$naslov</b></div><br/>";
//echo "<b>$naslov</b><br/><br/>";
////////////////////////////////////////////////////////////////////////////////////
	if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM downs WHERE tip='".$tip."'"));
    $num_items = $noi[0]; //changable
    $items_per_page= 5;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;

    $sql = "SELECT id, url, code, tip FROM downs WHERE tip='".$tip."' ORDER BY id DESC LIMIT $limit_start, $items_per_page ";
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
   	$size = filesize($item[1]);
	if($size<1024){$size1="$size B";}
	else if($size>=1024 && $size<1048576){$vel=$size/1024; $size2=round($vel, 2); $size1="$size2 KB";}
	else if($size>=1048576){$vel=$size/1048576; $size2=round($vel, 2); $size1="$size2 MB";}
        echo "$item[2] &#187; ";
        echo "<img src=\"$item[1]\" width=\"60\" height=\"60\" alt=\"$item[2]\"/> ($size1)<br/>";
        //echo "<img src=\"$item[1]\">$item[2]</a><br/>";
        echo "<a href=\"$item[1]\"> <b>Download</b></a> ";
if($row["level"]>7){echo "<a href=\"apanel.php?$ses&amp;go=brisidown&amp;kod=$item[0]&amp;rm=$rm\"> [X]</a>";}
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
      echo "<a href=\"downs1.php?$ses&amp;ref=$ref&amp;tip=$tip&amp;page=$ppage&amp;rm=$rm\">&#171;Nazad</a> ";
    }
    if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<a href=\"downs1.php?$ses&amp;ref=$ref&amp;tip=$tip&amp;page=$npage&amp;rm=$rm\">Napred&#187;</a>";
    }
    echo "<br/>$page/$num_pages<br/>";
    if($num_pages>1)
    {
    	if($ver=="wml"){
    	$rets = "Skoci na stranu:<br/> <input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[IDI]";
        $rets .= "<go href=\"downs1.php\" method=\"get\">";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
        $rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"tip\" value=\"$tip\"/>";
		$rets .= "<postfield name=\"rm\" value=\"$rm\"/>";
        $rets .= "</go></anchor>";
        }else{
        $rets = "<form align=\"center\" action=\"downs1.php\" method=\"get\">";
        $rets .= "Skoci na stranu:<br/> <input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= " <input type=\"submit\" value=\"[IDI]\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
        $rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
        $rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
        $rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "<input type=\"hidden\" name=\"tip\" value=\"$tip\"/>";
		$rets .= "<input type=\"hidden\" name=\"rm\" value=\"$rm\"/>";
        $rets .= "</form>";
        }
        echo $rets;

    }
    print $fsize2;
    echo "</p>";
  ////// UNTILL HERE >>
    echo "<p align=\"center\">";
    print $fsize1;
 ///////////////////////////////////////////////////////////////////////////////////
print $fsize2;
echo "<div class=\"d1\">";
print $fsize1;
print "<br/>";

if(isset($rm) && $rm!=""){
print "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>";
}
print $fsize2;

echo $fsize1;
print "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
print $fsize2;
echo "</div>";
print $fsize1;
print $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
echo "<i>$nazivsajta<i><br/>";
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>