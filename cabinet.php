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
if (isset($rm)) $takep2="&amp;rm=$rm&amp;ref=$ref";
else $takep2="&amp;ref=$ref";

if($rm==10) $takep="&amp;pwd=$pwd&amp;ref=$ref";
else if($mod=="privat") $takep="&amp;mod=$mod&amp;ref=$ref";
else $takep="&amp;ref=$ref";
///////////////////////////////////////////
$gde="Licni Kabinet";
include("gde.php");
///////////////////////////////////////////
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"cabinet\" title=\"Licni Kabinet\">";
echo "<p>";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Licni Kabinet</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">\n";
}
switch($go) {

default:
echo $fsize1;
echo "Pozdrav <b>".$row["user"]."</b>!<br/>";
echo $divide;
$r = mysql_query ("select count(readd) as num from zapiski WHERE (idtowhom = '".$id."')and(readd = '0')and(ininc = '1')");
$a = mysql_fetch_array($r);
$inb = $a["num"];
$r2 = mysql_query ("select count(klu4) as num from zapiski WHERE (idtowhom = '".$id."')and(ininc = '1')");
$a2 = mysql_fetch_array($r2);
$inball = $a2["num"];
echo "<a href=\"chatmail.php?$ses$takep2\">Vasa Pisma</a>(".$inb."/".$inball.")<br/>";
echo $divide;
echo "<a href=\"cabinet.php?go=foto&amp;$ses$takep2\">Slika u proflu</a><br/>";
echo "<a href=\"cabinet.php?go=avatars&amp;$ses$takep2\">Licni Avatar</a><br/>";
echo "<a href=\"cabinet.php?go=smiles&amp;$ses$takep2\">Licni Smajli</a>
<br/>";
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">Foto Albumi</a><br/>";
echo "<a href=\"albums.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=new&amp;ref=$ref\">Dodaj Album</a><br/>";
echo "<a href=\"stihovi.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref\">Stihovi</a><br/>";
echo "<a href=\"stihovi.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;action=new&amp;ref=$ref\">Dodaj Stih</a><br/>";
$imalibre = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM gallery WHERE user='".$id."'"));
if($imalibre[0]>0){
echo "<a href=\"galery.php?mod=glasovi&amp;$ses&amp;ref=$ref\">Glasovi Za Sliku</a><br/>";
}
echo $divide;
echo "<a href=\"nood.php?$ses&amp;mod=select$takep2\">Raspolozenje</a><br/>";
echo "<a href=\"emo.php?$ses$takep2\">Emocije</a><br/>";
echo "<a href=\"profile.php?$ses$takep2\">Licna Podesavanja</a><br/>";
echo "<a href=\"change.php?$ses$takep2\">Chat Podesavanja</a><br/>";
echo "<a href=\"buttons.php?$ses$takep2\">Precice Podesavanja</a><br/>";
echo "<a href=\"bind.php?$ses$takep2\">Precice(Dugmad)</a><br/>";
echo "<a href=\"time.php?$ses$takep2\">Kalendar</a><br/>";
echo $divide;
$usms = mysql_fetch_array(mysql_query ("SELECT COUNT(klu4) as num FROM friends WHERE id ='".$id."' AND ok='1' OR usid ='".$id."' AND ok='1'"));
$kol_friend = $usms["num"];
echo "<a href=\"friends.php?$ses$takep2\">Lista Prijatelja</a>(".$kol_friend.")<br/>";
$usm = mysql_fetch_array(mysql_query ("select count(klu4) as num from ignor where id ='".$id."';"));
$kol_ignor = $usm["num"];
echo "<a href=\"ignor.php?$ses$takep2\">Ignor Lista</a>(".$kol_ignor.")<br/>";
echo $fsize2;
break;

case 'foto':
echo $fsize1;
echo "Postavite sliku:<br/>";
echo $divide;
echo "<a href=\"foto.php?$ses&amp;mod=photo$takep2\">Uploduj Sliku(Komp)</a><br/>";
echo "<a href=\"import.php?$ses&amp;mod=photo$takep2\">Ubaci Sliku</a><br/>";
if($row["img"]!='')echo "<a href=\"cabinet.php?go=delfoto&amp;$ses$takep2\">Obrisi Sliku</a><br/>";
echo $fsize2;
break;

case 'delfoto':
echo $fsize1;
$myfotos = $row["img"];
$ras=explode(".", $myfotos);
$types=$ras[1];
if (!file_exists("photos/".$id.".".$types."")){
echo "Nemate slika!<br/>\n";
}else{
if (!ctype_digit($id)) { header("Location: index.php"); die; }
if(mysql_query ("Update users set img ='' where id ='".$id."';")){
unlink ("photos/".$id.".".$types."");
echo "Vasa slika je uspesno obrisana!<br/>";
}else{
echo "Greska!<br/>";
}
}
echo $fsize2;
break;

case 'smiles':
echo $fsize1;
if(isset($del) && strlen($del)){
$ob = mysql_fetch_array(mysql_query("Select url From smilies Where id='".$sid."'"));
if($del==0){

?>Sigurni ste da hocete da obrisete vas Licni smajli <img src="<?=$ob[0]?>" alt="slika smajlija"><br>
<a href="cabinet.php?go=smiles&amp;<?=$ses?>&amp;ref=<?=$ref?>">Ne</a> | <a href="cabinet.php?go=smiles&amp;<?=$ses?>&amp;del=1&amp;sid=<?=$sid?>&amp;ref=<?=$ref?>">Da</a><br>
<?php

exit;
}else if($del==1){
if(mysql_query("Delete From smilies Where id='".$sid."'")){
unlink($url);	
};	
}
}
//------------------- 19.06.2021. Tihiokean ----------------------
$licni2 = mysql_query("Select * From smilies Where lid='".$row['id']."'");
?>Vasi Licni smajliji<br>
<?php

while($licni = mysql_fetch_array($licni2)){
	
?><img src="<?=$licni['url']?>" alt="smile"><a href="cabinet.php?go=smiles&amp;<?=$ses?>&amp;sid=<?=$licni['id']?>&amp;del=0&amp;ref=<?=mt_rand(111111,999999)?>">Obrisi</a><br>
<?php
}
?>
<a href="uploads.php?<?=$ses?>&amp;mod=licni">Ubaci smajli</a>
<?php
//---------------------------------------------------------------
/* echo "Izaberite Licni Smajli<br/>";
echo $divide;
echo "&#8226; <a href=\"foto.php?$ses&amp;mod=smiles$takep2\">Uploaduj Smajli(Komp)</a><br/>";
echo "&#8226; <a href=\"import.php?$ses&amp;mod=smile$takep2\">Ubaci Smajli</a><br/>";
echo "&#8226; <a href=\"select.php?$ses&amp;mod=smile$takep2\">Izaberi sa liste</a><br/>";
if($row["mysmile"]!='')echo "&#8226; <a href=\"cabinet.php?go=delsmiles&amp;$ses$takep2\">Obrisi Smajli</a><br/>"; */
echo $fsize2;
break;

case 'delsmiles':
echo $fsize1;
$mysmile = $row["mysmile"];
$ras=explode(".", $mysmile);
$types=$ras[1];
if (!file_exists("loadsmile/".$id.".".$types."")){
echo "Nemate smajlija!<br/>\n";
}else{
if (!ctype_digit($id)) { header("Location: index.php"); die; }
if(mysql_query ("Update users set mysmile ='' where id ='".$id."';")){
unlink ("loadsmile/".$id.".".$types."");
echo "Vas smajli je uspesno obrisan!<br/>";
} else {
echo "Greska!<br/>";
}
}
echo $fsize2;
break;

case 'avatars':
echo $fsize1;
echo "Izaberite avatar po Vasoj meri!<br/>";
echo $divide;
echo "&#8226; <a href=\"foto.php?$ses&amp;mod=avatars$takep2\">Uploaduj Avatar(Komp)</a><br/>";
echo "&#8226; <a href=\"import.php?$ses&amp;mod=avatars$takep2\">Ubaci Avatar</a><br/>";
echo "&#8226; <a href=\"select.php?$ses&amp;mod=avatars$takep2\">Izaberi sa liste</a><br/>";
if($row["myavatar"]!='')echo "&#8226; <a href=\"cabinet.php?go=delavatars&amp;$ses$takep2\">Obrisi Avatar</a><br/>";
echo $fsize2;
break;

case 'delavatars':
echo $fsize1;
$myavatar = $row["myavatar"];
$ras=explode(".", $myavatar);
$types=$ras[1];
if (!file_exists("loadavatars/".$id.".".$types."")){
echo "Nemate avatara!<br/>\n";
}else{
if (!ctype_digit($id)) { header("Location: index.php"); die; }
if(mysql_query ("Update users set myavatar ='' where id ='".$id."';")){
unlink ("loadavatars/".$id.".".$types."");
echo "Vas avatar je uspesno obrisan!<br/>";
} else {
echo "Greska!<br/>";
}
}
echo $fsize2;
break;

case 'golos':
echo $fsize1;
echo "<b>Ko je sve dao glas za Vasu sliku?</b><br/>";
echo $divide;
echo $fsize2;
if(empty($page)) $page=0;
$query = mysql_query("select * from golos where user='".$id."';");
$num_of_rows=mysql_num_rows($query);
$total_mat_number=$num_of_rows;
$max = 10;
$total_pages=ceil($total_mat_number/$max);
$print = mysql_query("select * from golos where user='".$id."' order by who desc limit ".$page.",".($max).";");
$i = 1+$page;
while($arr = mysql_fetch_array($print)) {
$usid=$arr["who"];
$whogolos = mysql_query("select user from users where id=".$usid.";");
$idatas = mysql_fetch_array($whogolos);
$login=$idatas["user"];
echo $fsize1;
echo ($i++).") <a href=\"search.php?go=view&amp;$ses&amp;nick=$usid$takep2\">".$login."</a><br/>";
echo $fsize2;
}
echo $fsize1;
echo $divide;
echo $fsize2;
for ($num=0; $num<$total_pages; $num++){
$page_number=$num*$max;
echo $fsize1;
if ($page_number!=$page) {
echo "<a href=\"cabinet.php?go=golos&amp;$ses&amp;page=$page_number$takep2\">".($num+1)."</a>|";
} else {
echo "".($num+1)."|";
}
echo $fsize2;
}
echo $fsize1;
echo "<br/>";
echo $divide;
echo "<a href=\"galery.php?$ses$takep2\">Galerija</a><br/>";
echo $fsize2;
break;
//---------------- 20.06.2021. Tihiokean -----------------------
	case 'ikonica':
//echo $fsize1;
if(isset($sid) && strlen ($sid)){
if(mysql_query("Update users Set xlevel='".$sid."' Where id='".$id."'")){
$ikonica = mysql_fetch_array(mysql_query("Select url From ikonice Where id='".$sid."'"));
?><div>Izabrali ste ovu ikonicu <img src="smile/<?=$ikonica[0]?>" alt="Ikonica"></div>
<div><a href="cabinet.php?<?=$ses.$takep2?>&amp;ref=<?=$ref?>">Licni Kabinet</a> | <a href="enter.php?<?=$ses?>&amp;ref=<?=$ref?>">Hodnik</a></div>
<?php
exit;
}
}
$iko2 = mysql_query("Select id,url From ikonice Where pol='".$row['sex']."'");

?><div style="text-align: center; padding: 5px">Izaberite ikonicu za svoj Nick</div>

<?php
while($ico = mysql_fetch_array($iko2)){
?><div style="padding: 5px;margin-bottom: 0px;">
<img src="smile/<?=$ico[1]?>" alt="Ikonica"> <a href="cabinet.php?<?=$ses?>&amp;go=ikonica&amp;sid=<?=$ico[0]?>&amp;ref=<?=$ref?>">Dodaj</a>
</div>
<?php
}
//echo $fsize1;	
break;
//---------------------------------------------------
}
//echo $fsize1;
//echo $divide;
if($go) echo "<a href=\"cabinet.php?$ses$takep2\">Licni Kabinet</a>\n";
if (isset ($rm))echo " | <a href=\"chat.php?$ses&amp;rm=$rm$takep\">Chat Soba</a>\n";
echo " | <a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
//echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
?>