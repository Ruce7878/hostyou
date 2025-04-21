<?
##################################################################################################
##	                Script name  :  WapChat                                                                                                 ##
##	                    Version  :  chatwml                                                                             ##
##                      Made by  :  uNrEaL                                                                                            ##
##	                     E-mail  :  haoschat1@gmail.com	                                                           ##
##                         Site  :  http://haoswap.net                                                             ##
## Ova skripa je zashticena zakonom,svaka zloupotreba podlozna je tuzbi!  ##
##Da bi ste je koristili,morate imati dozvolu vlasnike skripte!!!                ##
##################################################################################################
header("Cache-Control: no-cache");
header("Content-type:text/vnd.wap.wml");
require("inc.php");
$link = connect_db();
$tema = mysql_fetch_array(mysql_query("SELECT tema FROM users WHERE id='".$id."'"));
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
$user = $row["user"];

echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"cabinet\" title=\"Avatri\">";
echo "<p>";
switch($go) {

default:
$path = "avatars"; // Папка с файлами
$col = 6; 
$ras1 = ".gif"; 
$ras2 = "";
$ras3 = "";
$d=opendir("$path");
if(!$list) $list = "1";
$n = "1";
while(($k=readdir($d))!==false){ 
if ($k=='.'||$k=='..'||$k=="index.php") continue; 
$n++;
}
closedir($d);
$num=($n/$col);if ($num!==(int)$num){$foo = (int) $num;$fo = ($foo + 1);}else{$fo=$num;}
for ($i="1"; $i<=$fo; $i++) {/*echo "<a href=\"1.php?list=$i\">$i</a>|";*/}
if ($list == "") {$c="0";}else{$c=($col*($list-1));}
$d=opendir("$path");
$la = "-1";
echo $fsize1; 
echo "Avatar od <b>".$user."</b><br/>";
echo $divide;
echo "Vi mozete dodati avatar u svom profilu,prostim klikon na zeljenu sliku.<br/>";
echo $divide;
echo $fsize2; 
while(($e=readdir($d))!==false){ 
if ($e=='.'||$e=='..') continue;
$la = $la + 1;
if($la>$c-1 and $la<$c+$col){
$e1 = str_replace("$ras1","",$e);
$e1 = str_replace("$ras2","",$e1);
$e1 = str_replace("$ras3","",$e1);
//if($par[2]==1)$foto="$id.gif"; //Загрузка фото в формате gif
//if($par[2]==2)$foto="$id.jpg"; //Загрузка фото в формате jpg
//if($par[2]==3)$foto="$id.png"; //Загрузка фото в формате png
if ($mode == "1"){$ee = strtr($e1,$tran);}else{$ee = $e1;}
$laa = $la + 1; // Номер файла
print "<a href=\"avatars.php?go=addavatars&amp;id=$id&amp;ps=$ps&amp;num=$e1\"><img src=\"fr3.php?a=$e1\" alt=\"$e1\"/></a><br/> ";
}
}
for ($i="0"; $i<=$fo; $i++) 
if ($list == "$path") {
$c="0";
}else{
$c=($col*($list-1));
}
$lis = $list + 1;
$lis1 = $list - 1;
print "<br/>";
if ($lis1 < "1"){
print $fsize1; 
print "&lt;&lt;Nazad";
print $fsize2; 
}else{
print $fsize1; 
print "<a href=\"avatars.php?list=$lis1&amp;id=$id&amp;ps=$ps&amp;mod=$mod\">&lt;&lt;Nazad </a>";
print $fsize2; 
}
if ($lis == "$i"){
print $fsize1; 
print "| Napred&gt;&gt;<br/>";
print $fsize2; 
}else{
print $fsize1;
print "| <a href=\"avatars.php?list=$lis&amp;id=$id&amp;ps=$ps&amp;mod=$mod\">Napred&gt;&gt;</a><br/>";
print $fsize2;
}
print $fsize1;
print "Idi na:<br/>";
print $fsize2;
print "<input name=\"p\" format=\"*N\" size=\"3\"/><br/>";
print $fsize1;
print "stranicu<br/>";
print "<a href=\"avatars.php?list=$(p)&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">IDI</a>";
print $fsize2;
$allpage = $i - 1;
print "<br/>";
print $fsize1; 
print $divide;
print "Avatri:<b> $n</b><br/>Strenice:<b> $list/$allpage</b><br/>";
print $fsize2; 
closedir($d);
break;

case 'addavatars':
if (($num>=0)&&($num<=270)&&($num!="")){
$foto="$id.gif";
if (file_exists ("avatars/$foto")){unlink ("avatars/$foto");}
@Copy("avatars/$num.gif", "photos/$foto"); 
@mysql_query ("Update users set img='".$foto."' where id ='".$id."'");
echo $fsize1; 
echo "<b>Vas avatar je uspesno dodat!</b><br/>";
echo $fsize2; 
echo "<img src=\"fr.php?usid=$id\" alt=\"avatar\"/><br/>";
} else {
echo $fsize1; 
echo "<b>Greska pri odabiru avatra!</b><br/>";
echo $fsize2; 
}
break;

}
echo $fsize1; 
echo $divide;
if($go) {
echo "<a href=\"avatars.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Avatri</a><br/>\n";
}
if (isset ($rm))echo "<a href=\"chat.php?id=$id&amp;ps=$ps&amp;rm=$rm\">Na chat</a><br/>\n"; 
echo "<a href=\"cabinet.php?id=$id&amp;ps=$ps&amp;ref=$ref\">Licni Kabinet</a><br/>";
echo "<a href=\"enter.php?id=$id&amp;ps=$ps\">Predsoblje</a><br/>\n"; 
echo $fsize2; 
echo "</p></card></wml>";
mysql_close($link); 
?>