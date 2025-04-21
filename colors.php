<?
header('Cache-Control: no-store, no-cache, must-revalidate');
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

$user=$row["user"];
$level=$row["level"];
$id=$row["id"];

if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"color\" title=\"Boje\">";
echo "<p>";
}else{
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Boje</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
$user=$row["user"];
if ($ver=="xhtml"){echo"<div class='d1'>";}
echo"Pozdrav $user<br />";
if ($ver=="xhtml"){echo"</div>";}
switch($s) {

default:
if (isset($rm)) $takep2="&amp;rm=$rm&amp;ref=$ref";
else $takep2="&amp;ref=$ref";
if($rm==10) $takep="&amp;pwd=$pwd&amp;ref=$ref";
else if($mod=="privat") $takep="&amp;mod=$mod&amp;ref=$ref";
else $takep="&amp;ref=$ref";
if ($ver=="xhtml"){echo"<div class='d1'>";}
echo"Izaberite Boju Za Vas Nick:<br/><br/>";
if ($ver=="xhtml"){echo"</div>";}
if ($ver=="xhtml"){echo"<div class=''>";}
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=0'><font color = ''><b>*Bez Boje*</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=1'><font color = '#Aerosol'><b>$user</b></font 21px></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=2'><font color = '#6D7B8D'><b>$user</b></font></a><br/>";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=3'><font color = '#2B60DE'><b>$user</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=4'><font color = '#00FFFF'><b>$user</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=5'><font color = '#F660AB'><b>$user</b></font></a><br/>";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=6'><font color = '#FF0000'><b>$user</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=7'><font color = '#151B8D'><b>$user</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;&#xbb;'><font color = '&#xbb;'><b>$user</b></font></a><br/>";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=9'><font color = '#8D38C9'><b>$user</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=10'><font color = '#F6358A'><b>$user</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=11'><font color = '#FFFF00'><b>$user</b></font></a><br/>";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=12'><font color = '#F88017'><b>$user</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=13'><font color = '#00FF00'><b>$user</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=14'><font color = '#FAAFBE'><b>$user</b></font></a><br/>";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=15'><font color = '#F5DEB3'><b>$user</b></font></a> |";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=16'><font color = '#BC8F8F'><b>$user</b></font></a><br/>";
echo"Specijalne Boje Za Vas Nik<br/>";
echo"<a href='color.php?$ses$takep2&amp;s=set&amp;colors=17'>".GradientLetter($user, 'Aerosol', 'Aerosol')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=18'>".GradientLetter($user, '000000', '00FF00')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=19'>".GradientLetter($user, '000000', 'FFFFFF')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=20'>".GradientLetter($user, '000000', '0000FF')."</a><br/>
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=21'>".GradientLetter($user, 'FF0000', 'A80AEA')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=22'>".GradientLetter($user, '0000FF', '0ADFEC')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=23'>".GradientLetter($user, 'FCD05B', 'E665F9')."</a><br/>
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=24'>".GradientLetter($user, 'C3C3C3', '2020EF')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=25'>".GradientLetter($user, 'FFFF00', 'B40404')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=26'>".GradientLetter($user, 'FF00FF', '4C0B5F')."</a><br/>
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=27'>".GradientLetter($user, 'FFFFFF', '1C1C1C')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=28'>".GradientLetter($user, 'F5D0A9', 'FE2E2E')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=29'>".GradientLetter($user, '190707', 'FA5858')."</a><br/>
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=30'>".GradientLetter($user, 'DA81F5', 'FE2E64')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=31'>".GradientLetter($user, '00FFFF', '08298A')."</a> |
<a href='color.php?$ses$takep2&amp;s=set&amp;colors=32'>".GradientLetter($user, 'FF0000', 'FFFFFF')."</a><br/>";
break;

case'set':
 $colors=htmlspecialchars(stripslashes(trim($colors)));
 $colors=eregi_replace("[[,{}+'!@#$%)(^&*%:;./\-_]","",$colors);
 if(mysql_query("update `users` set `color`='$colors'  WHERE `id` = '".$id."';"))
 {
 print "Uspesno Ste Izmenili Boju Vaseg Nika!<br/>";
}
break;
}
echo $fsize1;
if ($ver=="xhtml"){echo"<div class='d1'>";}
if(isset($rm) && $rm!=""){
print "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>";
}
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>";
if ($ver=="xhtml"){echo"</div>";}
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
?>
