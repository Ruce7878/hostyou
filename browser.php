<?php

header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php"); 
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);

require("version.php");

$browser = $_POST["browser"];
$user = $row['user'];
$uposts = $row['posts'];
$id = $row['id']; 

///////////////////////////////////////////
$gde="Admin CP - browser";
include("gde.php");
///////////////////////////////////////////
if($row["level"] < 5) {
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

if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"apanel\" title=\"Pretraga Browsera\">\n";
echo "<p align=\"left\" mode=\"wrap\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Pretraga Browsera</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">";
}

$s = isset($_GET['s']) ? $_GET['s'] : NULL;
switch($s) {
default:

/////////////////////////////////////////////////////////////////////
$levelni=$row["level"];
$namenski=$row["user"];
$levelnamesa = mysql_fetch_array(mysql_query("SELECT name FROM levels WHERE level='".$levelni."'"));
$objava = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$nk."'"));
$text="$levelnamesa[0] <b>$namenski</b>je posetio browser pretragu<br/>IP:".$_SERVER["REMOTE_ADDR"]." ,Browser:".$_SERVER["HTTP_USER_AGENT"]."";
$adm = mysql_query("INSERT INTO modlog SET user='".$id."', text='".$text."', time='".time()."', type='9'");
/////////////////////////////////////////////////////////////////////
if ($ver=="xhtml"){
echo "<form method=\"post\" action=\"browser.php?$ses$takep2&amp;s=set\" name=\"auth\">\n";
}
echo "<b>Pretraga browsera:</b><br/>\n";
echo "Identicni:<br/>\n";     
echo "<input name=\"browser\" maxlength=\"100\" title=\"browser\"/><br/>\n"; 
if ($ver=="wml"){
echo "<anchor title=\"go\">Trazi<go href=\"browser.php?$ses$takep2&amp;s=set\" method=\"post\">\n";
echo "<postfield name=\"browser\" value=\"$(browser)\"/>\n";
echo "</go></anchor>\n";
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Trazi\" name=\"enter\"/><br/>\n";
echo "</form>";
}
echo "---<br/>";
if ($ver=="xhtml"){
echo "<form method=\"post\" action=\"browser2.php?$ses$takep2&amp;s=set\" name=\"auth\">\n";
}
echo "Detaljni:<br/>\n";     
echo "<input name=\"browser\" maxlength=\"100\" title=\"browser\"/><br/>\n"; 
if ($ver=="wml"){
echo "<anchor title=\"go\">Trazi<go href=\"browser2.php?$ses$takep2&amp;s=set\" method=\"post\">\n";
echo "<postfield name=\"browser\" value=\"$(browser)\"/>\n";
echo "</go></anchor>\n";
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Trazi\" name=\"enter\"/><br/>\n";
echo "</form>";
}
echo "---<br/>";
if ($ver=="xhtml"){
echo "<form method=\"post\" action=\"browser2.php?$ses$takep2&amp;s=set2\" name=\"auth\">\n";
}
echo "IP logovanja:<br/>\n";     
echo "<input name=\"browser\" maxlength=\"100\" title=\"browser\"/><br/>\n"; 
if ($ver=="wml"){
echo "<anchor title=\"go\">Trazi<go href=\"browser2.php?$ses$takep2&amp;s=se2t\" method=\"post\">\n";
echo "<postfield name=\"browser\" value=\"$(browser)\"/>\n";
echo "</go></anchor>\n";
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Trazi\" name=\"enter\"/><br/>\n";
echo "</form>";
}
break;

case 'set':

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE user_soft='".$browser."'"));
    $num_items = $noi[0]; 
    $items_per_page= 1000;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;
    $sql = "SELECT id, user, user_ip, user_soft FROM users WHERE user_soft LIKE '%".$browser."%' ORDER BY user  LIMIT $limit_start, $items_per_page";
    $items = mysql_query($sql);
    if(mysql_num_rows($items)>0)
    {
   while ($item = mysql_fetch_array($items))
    {
     $lnk = "<a href=\"info.php?$ses&amp;ref=$ref&amp;nk=$item[0]\">$item[1]</a> browser:$item[3]";
      echo "&#187;| $lnk<br/>";
    }
    }
break;
}
print "<br/><a href=\"apanel.php?$ses&amp;ref=$ref\">Admin Cp</a><br/>";
print "<br/>---<br/><a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
exit();
?>