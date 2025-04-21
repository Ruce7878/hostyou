<?
include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");
///////////////////////////////////////////
$gde="Igrice";
include("gde.php");
///////////////////////////////////////////
if ($ver=="wml"){
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">\n";
echo "<wml>\n<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/>\n";
echo "<meta http-equiv=\"Pragma\" content=\"no-cache\"/></head>\n";
echo "<card id=\"x\" title=\"Online Igrice\">\n";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Online Igrice</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
//////////////////////////////////////////////////////////////////
  $ime = $_POST["ime"];
  $partner = $_POST["partner"];
  print $fsize1;
  echo "<b>Ljubavni Digitron</b><br/>";
  print $fsize2;
  echo $divide;
  if(($ime=="" || $partner=="") || $ime==$partner){
  print $fsize1;
  if($ime==$partner){echo "Vase ime i ime Vaseg partnera se moraju razlikovati!!!<br/><br/>";}
  else if($ime==""){echo "Morate uneti Vase ime!!!<br/><br/>";}
  else if($partner==""){echo "Morate uneti ime Vaseg partnera!!!<br/><br/>";}
  print $fsize2;
  if($ver=="wml"){
  print $fsize1;
  echo "Unesite Vase ime:<br/><input name=\"ime\" maxlength=\"30\" value=\"$ime\"/><br/>";
  echo "Unesite ime partnera:<br/><input name=\"partner\" maxlength=\"30\" value=\"$partner\"/><br/>";
  echo "<anchor>Nastavi!";
  echo "<go href=\"digitron.php?$ses&amp;ref=$ref&amp;rm=$rm\" method=\"post\">";
  echo "<postfield name=\"ime\" value=\"$(ime)\"/>";
  echo "<postfield name=\"partner\" value=\"$(partner)\"/>";
  echo "</go></anchor><br/>";
  print $fsize2;
  }else{
  print $fsize1;
  echo "<form method=\"post\" action=\"digitron.php?$ses&amp;ref=$ref&amp;rm=$rm\" name=\"auth\">\n";
  echo "Unesite Vase ime:<br/><input name=\"ime\" maxlength=\"30\" value=\"$ime\"/><br/>";
  echo "Unesite ime partnera:<br/><input name=\"partner\" maxlength=\"30\" value=\"$partner\"/><br/>";
echo "<input type=\"submit\" value=\"Nastavi!\" name=\"enter\"></form>";
  print $fsize2;
  }
  }else{
  print $fsize1;
  echo "<b>$ime</b><br/>i<br/><b>$partner</b><br/><br/>";
$sex = mysql_fetch_array(mysql_query("SELECT sex FROM users WHERE id='".$id."'"));

if($sex[0]=='M'){echo"Ti je volis:";}
else{echo"Ti ga volis:";}
$xfile1 = file("ljubav/tinju.txt");
$random_num1 = rand (0,count($xfile1)-1);
$udata1 = explode(":: ",$xfile1[$random_num1]);
echo "<b>$udata1[1]</b><br/>";

if($sex[0]=='M'){echo"Ona te voli:";}
else{echo"On te voli:";}
$xfile2 = file("ljubav/onatebe.txt");
$random_num2 = rand (0,count($xfile2)-1);
$udata2 = explode(":: ",$xfile2[$random_num2]);
echo "<b>$udata2[1]</b><br/>";

if($sex[0]=='M'){echo"Iskren si:";}
else{echo"Iskrena si:";}
$xfile3 = file("ljubav/iskren1.txt");
$random_num3 = rand (0,count($xfile3)-1);
$udata3 = explode(":: ",$xfile3[$random_num3]);
echo "<b>$udata3[1]</b><br/>";

if($sex[0]=='M'){echo"Iskrena je:";}
else{echo"Iskren je:";}
$xfile4 = file("ljubav/iskren2.txt");
$random_num4 = rand (0,count($xfile4)-1);
$udata4 = explode(":: ",$xfile4[$random_num4]);
echo "<b>$udata4[1]</b><br/>";

if($sex[0]=='M'){echo"Tvoja paznja:";}
else{echo"Tvoja paznja:";}
$xfile5 = file("ljubav/paznja1.txt");
$random_num5 = rand (0,count($xfile5)-1);
$udata5 = explode(":: ",$xfile5[$random_num5]);
echo "<b>$udata5[1]</b><br/>";


if($sex[0]=='M'){echo"Njena paznja:";}
else{echo"Njegova paznja:";}
$xfile6 = file("ljubav/paznja2.txt");
$random_num6 = rand (0,count($xfile6)-1);
$udata6 = explode(":: ",$xfile6[$random_num6]);
echo "<b>$udata6[1]</b><br/>";


echo"<b>Ocena Vase Veze(1-10):";
$konacno=floor(($udata1[1]+$udata2[1]+$udata3[1]+$udata4[1]+$udata5[1]+$udata6[1])/60);
echo "$konacno</b><br/>";

echo "<br/><a href=\"digitron.php?$ses&amp;ref=$ref&amp;rm=$rm\">Racunaj Opet</a><br/><br/>";
echo "Ljubavni Digitron je samo zabavnog karaktera!<br/>";
print $fsize2;
  }
//////////////////////////////////////////////////////////////////
print $fsize1;
print $divide;
echo "<a href=\"igrice.php?$ses&amp;ref=$ref\">[Zabava|Igrice]</a><br/>";
if(isset($rm) && $rm!=""){
print "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>";
}
print "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
print $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
?>