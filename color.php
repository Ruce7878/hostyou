<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");


$ulaz = mysql_fetch_array(mysql_query("SELECT id, posts FROM `users` WHERE id='".$id."'"));
if($ulaz[1]<'100'){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>";
echo "<card id=\"vypnut\" title=\"Upozorenje\" ontimer=\"index.php?ref=$ref\"><timer value=\"300\"/>";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Upozorenje</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;

echo "Dok ne sakupite 100 postova mozete pristupiti samo u ";
echo "<a href=\"chat.php?ver=$ver&amp;id=$id&amp;ps=$ps&amp;ref=$ref&amp;rm=11\"> <b><u>Welcome Sobica!!!</u></b></a>";
echo $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close($link);
exit;
}

///////////////////////////////////////////
$gde="Boja Nika";
include("gde.php");
///////////////////////////////////////////

$user=$row["user"];
$level=$row["level"];
$id=$row["id"];

if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>";
echo "<card id=\"color\" title=\"Boja nika\">";
echo "<p>";
}else{
echo "<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
if($row["css"]!=""){
$csss=$row["css"];
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$csss\"/>";
}else{
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
}
echo "<title>Boja nika</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">\n";
}

$user=$row["user"];
if ($ver=="xhtml"){echo"<div class='d1'>";}
$pols = @mysql_query ("SELECT sex, color,specolor FROM users where user='".$user."'");
$zs1 = @mysql_fetch_array ($pols);
$sex = $zs1["sex"];
$cvetn = $zs1["color"];
$user = EdykaColor($user,$zs1["color"],$zs1["specolor"]);

echo"Poz $user<br />";
if ($ver=="xhtml"){echo"</div>";}
switch($s) {

default:
if (isset($rm)) $takep2="&amp;rm=$rm&amp;ref=$ref";
else $takep2="&amp;ref=$ref";
if($rm==10) $takep="&amp;pwd=$pwd&amp;ref=$ref";
else if($mod=="privat") $takep="&amp;mod=$mod&amp;ref=$ref";
else $takep="&amp;ref=$ref";
if ($ver=="xhtml"){echo"<div class='d1'>";}
echo"Odaberite boju nika:<br/>";
if ($ver=="xhtml"){echo"</div>";}
if ($ver=="xhtml"){echo"<div class='post'>";}


//---------------------------------------------------------------------
$nick = $row['user'];
$boja = $_POST['color'];
//if ($_SERVER['REQUEST_METHOD'] == 'GET'){

?>
<div class="d1">
Izaberi Boju Nicka
</div>
<ul>
<li>
Kliknite na crni pravougaonik
</li>
<li>
Kliknite na zeljenu boju
</li>
<li>
Kliknite van kvadrata sa bojama
</li>
<li>
Kliknite na Promeni
</li>
<li style="list-style: none"><br>
<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>?<?php echo $ses.$takep2?>&amp;s=setclr&amp;rm=<?php echo $rm ?>&amp;ref=<?php echo $ref?>" method="post">
<input type="color" name="colors" value="" style="color: #fff; max-width: 100px; background: #<?=$row['color']?>">
	<label style="color: #<?=$row['color']?>"> <?=$row['user']?></label><br><input type = "submit" value = "Promeni" title = "Promeni Boju" />
</form>
</li>
</ul>
<?php 
//---------------------------------------------------------------------
if ($row["level"]>6){
echo '<b>POSEBNE BOJE:</b><BR/>';
$sqls=mysql_query("SELECT id FROM edyka_special");
while($boje=mysql_fetch_array($sqls)) {
echo '<a href="color.php?'.$ses.$takep2.'&amp;s=setspclr&amp;spcl='.$boje['id'].'">'.EdykaColor($row['user'],'',$boje['id']).'</a><br />';
}
if ($ver=="xhtml"){echo"</div>";}
}

break;
case 'setspclr':
$spc=intval($_GET['spcl']);
if(@mysql_query("update `users` set `specolor`='$spc'  WHERE `id` = '".$id."';") && @mysql_query("update `users` set `color`=''  WHERE `id` = '".$id."';")) {
if ($ver=="xhtml"){echo"<div class='d1'>";}
print "Boja nika izmenjena!<br/>";
if ($ver=="xhtml"){echo"</div>";}
}
break;
case'setclr':
echo 'color= '.$colors.'<br>spcolor= '.$specolor;
$colors=htmlspecialchars(stripslashes(trim($colors)));
$colors=eregi_replace("[[,{}+'!@#$%)(^&*%:;./\-_]","",$colors);
//if(@mysql_query("update `users` set `color`='$colors'  WHERE `id` = '".$id."';"))
if(@mysql_query("update `users` set `specolor`=''  WHERE `id` = '".$id."';") && @mysql_query("update `users` set `color`='$colors'  WHERE `id` = '".$id."';"))

{
if ($ver=="xhtml"){echo"<div class='d1'>";}
print "Boja nika izmenjena!<br/>";
if ($ver=="xhtml"){echo"</div>";}
}
break;
}
echo $fsize1;
if ($ver=="wml"){echo $divide;}
if ($ver=="xhtml"){echo"<div class='d1'>";}
if(isset($rm) && $rm!=""){
print "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>";
}
print "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";
print $fsize2;
if($ggggg=="1"){
include("gzip.php");
}
if ($ver=="xhtml"){echo"</div>";}
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
$alltraf=$row["alltraf"];
$pagesize=round((ob_get_length())/1024,1);
$alltraf=$alltraf+$pagesize;
mysql_query ("Update users set alltraf='".$alltraf."', lasttraf='".$pagesize."' where id='".$id."'");
mysql_close ($link);
ob_end_flush();
?>