<?php  include("gz.php");

///////////////////////////////////////////////////////////////////////////////////////////////
header('Cache-Control: no-store, no-cache, must-revalidate');                                //
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");                     //
else header("Content-Type:text/html; charset=UTF-8");                                        //
                                                                                             //
require("inc.php");                                                                          //
$link = connect_db();                                                                        //
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);                                 //
require("version.php");                                                                      //
                                                                                             //
if ($ver=="wml"){                                                                            //
print $xml;                                                                                  //
print $dtd;                                                                                  //
print "<wml>";                                                                               //
print "<card id=\"index\" title=\"Foto Albumi\">";                                           //
print "<p align=\"center\">";                                                                //
}else{                                                                                       //
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"";                    //
print "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";                        //
print "<html xmlns=\"http://www.w3.org/1999/xhtml\">";                                       //
echo "<head>";
if($row["css"]!=""){
$csss=$row["css"];
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$csss\"/>";
}else{
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
}
print "<title>Foto Albumi</title>";                                                          //
print"<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";//
print "<div align=\"center\">";                                                              //
}                                                                                            //
$config_bookpost = 5;                                                                        //
///////////////////////////////////////////////////////////////////////////////////////////////

$day=date("d.m.y");
$timer=date("H:i");

$idsd = $_GET['id'];

$rs=mysql_query("SELECT `level` FROM `users` WHERE `id`='".$idsd."';");
$rowds = mysql_fetch_array($rs);
$lev = $rowds[0];
///////////////////////////////////////////
$gde="Foto Albumi";
include("gde.php");
///////////////////////////////////////////
if($action=="") {
echo $fsize1;
echo'<b>Foto Albumi</b><br/>';
echo $divide;
echo $fsize2;
//echo $fsize1;
//echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo&amp;list=10">[TOP fotografije po pregledima]</a><br/>';
//echo '<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_rat&amp;list=10">[TOP fotografije po reitingu]</a><br/>';
//echo '<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_vote&amp;list=10">[TOP fotografije po ocenama]</a><br/>';
//echo $fsize2;
echo $fsize1;
echo'<b>Najnoviji Album:</b><br/>';
$resultx=mysql_query("SELECT `name`,`about`,`type_album`,`date`,`id`,`nick`,`vote`,`vote_col` FROM `album` WHERE `type`='r' order by id DESC LIMIT 1;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$names = $row[0];
$opis = $row[1];
$types = $row[2];
$dt = $row[3];
$uid = $row[4];
$nick = $row[5];
$vote = $row[6];
$vote_col = $row[7];

$dats = date("d.m.y / H:i",$dt);

if($types==0){$ttp="Javni...";}
if($types==1){$ttp="Za prijatelje";}
if($types==2){$ttp="Privatni";}

$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `refid`='".$uid."' AND `type`='f';");
$cntDataxd = mysql_fetch_row($resultxd);
$count_usersxd = $cntDataxd[0];

$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$nick."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];


$tit=round($vote/$vote_col/2,1);

echo'<a href="album.php?action=view_album&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$nick.'">'.$names.'('.$count_usersxd.')</a><br/>';
echo''.$opis.'<br/>';
//echo 'Reiting: <b>'.$tit.'</b><br/>['.$ttp.']<br/>';
echo 'Autor: <a href="info.php?'.$ses.'&amp;nk='.$nick.'&amp;ref='.$ref.'">'.$avtor.'</a><br/>'.$dats.'<br/><br/>';

}
echo $fsize2;
echo $fsize1;
$dates=date("d.m.y");
//echo"<br/><b>Statistika:</b><br/>";
$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='r';");
$cntDataxd = mysql_fetch_row($resultxd);
$count_usersxd = $cntDataxd[0];
echo"Ukupno Albuma: <b>$count_usersxd</b><br/>";
//$result = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='r' AND `new_date`='".$dates."';");
//$cntData = mysql_fetch_row($result);
//$count_users = $cntData[0];
//echo"Albumi od danas: <b>$count_users</b><br/>";
$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='f';");
$cntDataxd = mysql_fetch_row($resultxd);
$count_usersxd = $cntDataxd[0];
echo"Ukupno Slika: <b>$count_usersxd</b><br/>";
//$result = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='f' AND `new_date`='".$dates."';");
//$cntData = mysql_fetch_row($result);
//$count_users = $cntData[0];
//echo"Fotografija od danas: <b>$count_users</b><br/>";
//$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='c';");
//$cntDataxd = mysql_fetch_row($resultxd);
//$count_usersxd = $cntDataxd[0];
//echo"Pregleda: <b>$count_usersxd</b><br/>";
//$resultxd = mysql_query("SELECT sum(`vote_col`) FROM `album`;");
//$cntDataxd = mysql_fetch_row($resultxd);
//$count_usersxd = $cntDataxd[0];
//echo"Komentara: <b>$count_usersxd</b><br/>";
//$resultxd = mysql_query("SELECT sum(`count`) FROM `album`;");
//$cntDataxd = mysql_fetch_row($resultxd);
//$count_usersxd = $cntDataxd[0];
//echo"Pregledanih: <b>$count_usersxd</b><br/>";
//$resultxd = mysql_query("SELECT sum(`rating`) FROM `album`;");
//$cntDataxd = mysql_fetch_row($resultxd);
//$count_usersxd = $cntDataxd[0];
//echo"Ukupan reiting: <b>$count_usersxd</b><br/><br/>";
echo '<br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_album&amp;list=10">TOP Albumi</a><br/>';
echo $fsize2;
}

if($action=="top_photo") {

if (empty($_POST['list'])) $list = 10;
	else $list=$_POST['list'];

$list= intval(check($list));

if (eregi("[^0-9]", $list))
{echo"G R E S K A!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
exit;}

echo'<b>TOP fotografije po pregledima</b><br/><br/>';

echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo&amp;list=10">[Osvezi]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'">[Na glavnu]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_rat&amp;list=10">[TOP fotografije po reitingu]</a><br/>[TOP fotografije po komentarima ]<br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_vote&amp;list=10">[TOP fotografije po ocenama]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_album&amp;list=10">[TOP albumi]</a><br/><br/>';
echo'<b>TOP '.$list.' fotografija:</b><br/><br/>';
$resultx=mysql_query("SELECT `name`,`about`,`attach`,`date`,`id`,`nick`,`vote`,`vote_col`,`count` FROM `album` WHERE `type`='f' order by count DESC LIMIT $list;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$names = $row[0];
$opis = $row[1];
$attach = $row[2];
$dt = $row[3];
$uid = $row[4];
$nick = $row[5];
$vote = $row[6];
$vote_col = $row[7];
$counter = $row[8];

$dats = date("d.m.y / H:i",$dt);

if($types==0){$ttp="Javni...";}
if($types==1){$ttp="Prijatelji";}
if($types==2){$ttp="Privatni";}

$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `refid`='".$uid."' AND `type`='f';");
$cntDataxd = mysql_fetch_row($resultxd);
$count_usersxd = $cntDataxd[0];

$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$nick."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
echo'<img src="resize.php?act='.$attach.'&amp;gname='.$uid.'&amp;maxsize=60" alt=""/><br/>';
echo'<a href="album.php?action=view_photo&amp;fid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$nick.'">'.$names.'</a> ('.$counter.')<br/><small>'.$opis.'</small><br/>Autor: <a href="../info.php?'.$ses.'&amp;nk='.$nick.'&amp;ref='.$ref.'">'.$avtor.'</a><br/>'.$dats.'<br/><br/>';
}
if($ver=="wml"){
echo '<br/>Stranica: <input type="text" name="list" emptyok="false" maxlength="2" size="2" />';
echo "<anchor>\n";
echo "[&gt;]\n";
echo '<go href="album.php?action=top_photo&amp;'.$ses.'&amp;ref='.$ref.'" method="post">\n';
echo "<postfield name=\"list\" value=\"\$(list)\"/>\n";
echo "</go>\n";
echo "</anchor>\n";
}else{
echo '<form action="album.php?action=top_photo&amp;'.$ses.'&amp;ref='.$ref.'" method="post">Prikazi top: ';
echo '<input type="text" name="list" maxlength="2" size="2" />';
echo '<input type="submit" value="фоток" />';
echo '</form>';
}
}

if($action=="top_photo_rat") {

if (empty($_POST['list'])) $list = 10;
	else $list=$_POST['list'];

$list= intval(check($list));

if (eregi("[^0-9]", $list))
{echo"G R E S K A!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Glavni meni...</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}

echo'<b>TOP fotografije po reitingu</b><br/><br/>';

echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_rat&amp;list=10">[Osvezi]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'">[Na glavnu]</a><br/>[TOP foto po reitingu]<br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo&amp;list=10">[TOP foto po pregledu]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_vote&amp;list=10">[TOP foto po ocenama]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_album&amp;list=10">[TOP albumi]</a><br/><br/>';
echo'<b>ТОП '.$list.' фоток:</b><br/><br/>';
$resultx=mysql_query("SELECT `name`,`about`,`attach`,`date`,`id`,`nick`,`vote`,`vote_col`,`rating` FROM `album` WHERE `type`='f' order by count DESC LIMIT $list;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$names = $row[0];
$opis = $row[1];
$attach = $row[2];
$dt = $row[3];
$uid = $row[4];
$nick = $row[5];
$vote = $row[6];
$vote_col = $row[7];
$counter = $row[8];

$dats = date("d.m.y / H:i",$dt);

if($types==0){$ttp="Javni";}
if($types==1){$ttp="Za prijatelje";}
if($types==2){$ttp="Privatni";}

$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `refid`='".$uid."' AND `type`='f';");
$cntDataxd = mysql_fetch_row($resultxd);
$count_usersxd = $cntDataxd[0];

$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$nick."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
echo'<img src="resize.php?act='.$attach.'&amp;gname='.$uid.'&amp;maxsize=60" alt=""/><br/>';
echo'<a href="album.php?action=view_photo&amp;fid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$nick.'">'.$names.'</a> ('.$counter.')<br/><small>'.$opis.'</small><br/>Autor: <a href="../info.php?'.$ses.'&amp;nk='.$nick.'&amp;ref='.$ref.'">'.$avtor.'</a><br/>'.$dats.'<br/><br/>';
}
if($ver=="wml"){
echo '<br/>Stranica: <input type="text" name="list" emptyok="false" maxlength="2" size="2" />';
echo "<anchor>\n";
echo "[&gt;]\n";
echo '<go href="album.php?action=top_photo_rat&amp;'.$ses.'&amp;ref='.$ref.'" method="post">\n';
echo "<postfield name=\"list\" value=\"\$(list)\"/>\n";
echo "</go>\n";
echo "</anchor>\n";
}else{
echo '<form action="album.php?action=top_photo_rat&amp;'.$ses.'&amp;ref='.$ref.'" method="post">Prikaz top: ';
echo '<input type="text" name="list" maxlength="2" size="2" />';
echo '<input type="submit" value="foto" />';
echo '</form>';
}
}

if($action=="top_album") {

if (empty($_POST['list'])) $list = 10;
	else $list=$_POST['list'];

$list= intval(check($list));

if (eregi("[^0-9]", $list))
{$list = 10;}
echo $fsize1;
echo'<b>TOP Albumi</b><br/>';
echo $divide;
echo $fsize2;
//echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_album&amp;list=10">[Osvezi]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'">[Na glavnu]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_rat&amp;list=10">[TOP foto po reitingu]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo&amp;list=10">[TOP foto po pregledu]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_vote&amp;list=10">[TOP foto po ocenama]</a><br/>[TOp albumi]<br/><br/>';
//echo'<b>TOP '.$list.' albumi:</b><br/><br/>';
echo $fsize1;
$resultx=mysql_query("SELECT `name`,`about`,`type_album`,`date`,`id`,`nick`,`vote`,`vote_col`,`count` FROM `album` WHERE `type`='r' order by `vote_col` DESC LIMIT $list;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$names = $row[0];
$opis = $row[1];
$types = $row[2];
$dt = $row[3];
$uid = $row[4];
$nick = $row[5];
$vote = $row[6];
$vote_col = $row[7];
$counter = $row[8];

$dats = date("d.m.y / H:i",$dt);

if($types==0){$ttp="Javni";}
if($types==1){$ttp="Za prijatelje";}
if($types==2){$ttp="Privatni";}

$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `refid`='".$uid."' AND `type`='f';");
$cntDataxd = mysql_fetch_row($resultxd);
$count_usersxd = $cntDataxd[0];

$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$nick."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];



echo'<a href="album.php?action=view_album&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$nick.'">'.$names.'</a><br/>';
//echo '['.$ttp.']<br/>';
echo ''.$opis.'<br/>';
echo 'Autor: <a href="info.php?'.$ses.'&amp;nk='.$nick.'&amp;ref='.$ref.'">'.$avtor.'</a><br/>'.$dats.'<br/><br/>';
}
echo $fsize2;
//if($ver=="wml"){
//echo '<br/>Stranica: <input type="text" name="list" emptyok="false" maxlength="2" size="2" />';
//echo "<anchor>\n";
//echo "[&gt;]\n";
//echo '<go href="album.php?action=top_album&amp;'.$ses.'&amp;ref='.$ref.'" method="post">\n';
//echo "<postfield name=\"list\" value=\"\$(list)\"/>\n";
//echo "</go>\n";
//echo "</anchor>\n";
//}else{
//echo '<form action="album.php?action=top_album&amp;'.$ses.'&amp;ref='.$ref.'" method="post">Prikaz Top: ';
//echo '<input type="text" name="list" maxlength="2" size="2" />';
//echo '<input type="submit" value="album" />';
//echo '</form>';
}
//}

if($action=="top_photo_vote") {

if (empty($_POST['list'])) $list = 10;
	else $list=$_POST['list'];

$list= intval(check($list));

if (eregi("[^0-9]", $list))
{echo"G R E S K A!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}

echo'<b>TOP fotografije po ocenama</b><br/><br/>';

echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_vote&amp;list=10">[Osvezi]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'">[Na glavnu]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo_rat&amp;list=10">[TOP foto po reitingu]</a><br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_photo&amp;list=10">[TOP foto po pregledu]</a><br/>[TOP foto po ocenama]<br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=top_album&amp;list=10">[Top Albumi]</a><br/><br/>';
echo'<b>TOP '.$list.' foto:</b><br/><br/>';
$resultx=mysql_query("SELECT `name`,`about`,`attach`,`date`,`id`,`nick`,`vote`,`vote_col`,`count` FROM `album` WHERE `type`='f' order by `vote_col` DESC LIMIT $list;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$names = $row[0];
$opis = $row[1];
$attach = $row[2];
$dt = $row[3];
$uid = $row[4];
$nick = $row[5];
$vote = $row[6];
$vote_col = $row[7];
$counter = $row[8];

$dats = date("d.m.y / H:i",$dt);

if($types==0){$ttp="Javni";}
if($types==1){$ttp="Za prijatelje";}
if($types==2){$ttp="Provatni";}

$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `refid`='".$uid."' AND `type`='f';");
$cntDataxd = mysql_fetch_row($resultxd);
$count_usersxd = $cntDataxd[0];

$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$nick."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];


echo'<img src="resize.php?act='.$attach.'&amp;gname='.$uid.'&amp;maxsize=60" alt=""/><br/>';
echo'<a href="album.php?action=view_photo&amp;fid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$nick.'">'.$names.'</a> ('.$vote_col.')<br/><small>'.$opis.'</small><br/>Autor: <a href="../info.php?'.$ses.'&amp;nk='.$nick.'&amp;ref='.$ref.'">'.$avtor.'</a><br/>'.$dats.'<br/><br/>';
}
if($ver=="wml"){
echo 'Izbor kolicine fotografija je samo za html verziju chata!';
}else{
echo '<form action="album.php?action=top_photo_vote&amp;'.$ses.'&amp;ref='.$ref.'" method="post">Показать топ: ';
echo '<input type="text" name="list" maxlength="2" size="2" />';
echo '<input type="submit" value="foto" />';
echo '</form>';
}
}

if($action=="myalbum") {
echo $fsize1;
echo'<b>Moji Albumi</b><br/>';
echo $divide;
//echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'">[Osvezi]</a><br/>';
//echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=add_album">[Dodaj album]</a><br/><br/>';

$resultx=mysql_query("SELECT `name`,`about`,`type_album`,`date`,`id` FROM `album` WHERE `type`='r' AND `nick`='".$id."' order by id DESC;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$names = $row[0];
$opis = $row[1];
$types = $row[2];
$dt = $row[3];
$uid = $row[4];

if($types==0){$ttp="Javni";}
if($types==1){$ttp="Za projatelje";}
if($types==2){$ttp="Privatni";}

$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `refid`='".$uid."' AND `type`='f' AND `nick`='".$id."';");
$cntDataxd = mysql_fetch_row($resultxd);
$count_usersxd = $cntDataxd[0];

echo'<a href="album.php?action=view_album&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$id.'">'.$names.'('.$count_usersxd.')</a><br/>';
echo''.$opis.'<br/>';
//echo '['.$ttp.']<br/>';
echo '<a href="album.php?action=edit_album&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'">Izmeni</a>  ';
echo '<a href="album.php?action=del_album&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'">Obrisi</a><br/><br/>';


}
echo"Vasih Albuma: <b>$count_users_on_pagex</b><br/>";


echo $fsize2;
}

if($action=="useralbum") {

$user = intval(check($_GET['user']));
if (eregi("[^0-9]", $user))
{
echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
if (empty($_GET['user'])){
echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if(empty($avtor)){
echo $fsize1;
echo"Korisnik nije pronadjen!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
echo $fsize1;
echo''.$avtor.' Foto Album<br/>';
echo $divide;
//echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">[Osvezi]</a><br/><br/>';

$resultx=mysql_query("SELECT `name`,`about`,`type_album`,`date`,`id`,`vote`,`vote_col` FROM `album` WHERE `type`='r' AND `nick`='".$user."' order by id DESC;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$names = $row[0];
$opis = $row[1];
$types = $row[2];
$dt = $row[3];
$uid = $row[4];
$vote = $row[5];
$vote_col = $row[6];

if($types==0){$ttp="Javni";}
if($types==1){$ttp="Za prijatelje";}
if($types==2){$ttp="Proivatni";}

$resultxd = mysql_query("SELECT count(`id`) FROM `album` WHERE `refid`='".$uid."' AND `type`='f' AND `nick`='".$user."';");
$cntDataxd = mysql_fetch_row($resultxd);
$count_usersxd = $cntDataxd[0];

$tit=round($vote/$vote_col/2,1);

echo '<a href="album.php?action=view_album&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$names.' ('.$count_usersxd.')</a><br/>';
//echo '<br/>Reiting: <b>'.$tit.'/'.$vote_col.'</b><br/>';
echo ''.$opis.'<br/>';
//echo '['.$ttp.']<br/>';
if($lev>7){
echo '<a href="album.php?action=edit_album&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'">Izmeni</a>  ';
echo '<a href="album.php?action=del_album&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'">Obrisi</a>';
}
echo"<br/>";
}
echo"<br/>Albuma: $count_users_on_pagex<br/>";
//echo'<br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'&amp;action=useralbum">Na foto album clana</a><br/>';

echo $fsize2;
}

if($action=="view_album") {

$user = intval(check($_GET['user']));
if (eregi("[^0-9]", $user))
{echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
if (empty($_GET['user'])){echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if(empty($avtor)){echo $fsize1;
echo"Korisnik nije pronadjen!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
echo $fsize1;
if($id == $user){echo"Vas Foto Album<br/>";}
else{
echo''.$avtor.' Foto Album<br/>';
}
echo $divide;
echo $fsize2;
if (empty($_GET['p'])) $page = 1;
	else $page=$_GET['p'];

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $uid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "r")
{echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
//echo'<a href="album.php?action=view_album&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">[Osvezi spisak]</a>';
$resultxdd=mysql_query("SELECT `type_album` FROM `album` WHERE `id`='".$uid."' AND `nick`='".$user."';");
$rowdxd = mysql_fetch_array($resultxdd);
$typesx = $rowdxd[0];

if($typesx=="1" && $user!=$id){
echo $fsize1;
$resultxd=mysql_query("SELECT `usid` FROM `friends` WHERE id='".$user."' AND usid='".$id."' AND ok='1' OR id='".$id."' AND usid='".$user."' AND ok='1'");
$rowdx = mysql_fetch_array($resultxd);
$usid = $rowdx[0];
if(!empty($usid) && $user!=$id){
////////////////////////////////////////////////////////////////////////////////////////////////
echo"<br/>";
// получаем кол во участников
			$result = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='f' AND `refid`='".$uid."' AND `nick`='".$user."';");
			$cntData = mysql_fetch_row($result);
			$count_users = $cntData[0];
			$max_page = ceil ($count_users / 5);

			$page	= ($page > $max_page) ? (($max_page == 0)? $page : $max_page) : $page;

			$start  = 5*($page-1);
			$end	= 5;




$resultx=mysql_query("SELECT `id`,`name`,`attach`,`date` FROM `album` WHERE `type`='f' AND `refid`='".$uid."' AND `nick`='".$user."' ORDER BY id DESC LIMIT $start,$end;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$fid = $row[0];
$name = $row[1];
$attach = $row[2];
$dates = $row[3];
echo'<a href="album.php?action=view_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$name.'</a><br/>';

echo'<img src="resize.php?act='.$attach.'&amp;gname='.$fid.'&amp;maxsize=60" alt=""/><br/><br/>';

}

			if($i==0)
			{
			echo "<br/><b>Foto album je prazan!</b><br/>";
			}

if ($max_page > 1)
{
$ba=ceil($count_users/5);
$ba2=$ba*5-5;

echo "Stranica:";
$asd2=$start+(5*5);

if($asd<$count_users && $asd>0){echo ' <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p=1&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">1</a> ... ';}

for($i=$asd; $i<$asd2;)
{
if($i<$count_users && $i>=0){
$ii=floor(1+$i/5);

if ($start==$i) {
echo ' <b>('.$ii.')</b>';
               }
                else {
echo ' <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p='.$ii.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ii.'</a>';
                     }}


$i=$i+5;}
if($asd2<$count_users){echo ' ... <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p='.$ba.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ba.'</a>';}
echo"<br/>Slika: $count_users<br/>";}

}else{echo"<br/><br/><b>Album nije dostupan za pregled!</b><br/>";}
echo $fsize2;
}
////////////////////////////////////////////////////////////////////////////////////////////////
if($typesx=="0" && $user!=$id){
echo $fsize1;
////////////////////////////////////////////////////////////////////////////////////////////////
echo"<br/>";
// получаем кол во участников
			$result = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='f' AND `refid`='".$uid."' AND `nick`='".$user."';");
			$cntData = mysql_fetch_row($result);
			$count_users = $cntData[0];
			$max_page = ceil ($count_users / 5);

			$page	= ($page > $max_page) ? (($max_page == 0)? $page : $max_page) : $page;

			$start  = 5*($page-1);
			$end	= 5;




$resultx=mysql_query("SELECT `id`,`name`,`attach`,`date` FROM `album` WHERE `type`='f' AND `refid`='".$uid."' AND `nick`='".$user."' ORDER BY id DESC LIMIT $start,$end;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$fid = $row[0];
$name = $row[1];
$attach = $row[2];
$dates = $row[3];
echo'<a href="album.php?action=view_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$name.'</a><br/>';

echo'<img src="resize.php?act='.$attach.'&amp;gname='.$fid.'&amp;maxsize=60" alt=""/><br/>';

if($lev>7){
echo'<a href="album.php?action=del_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'">Obrisi</a>';
}
echo"<br/>";
}

			if($i==0)
			{
			echo "<br/><b>Album je prazan!</b><br/>";
			}

if ($max_page > 1)
{
$ba=ceil($count_users/5);
$ba2=$ba*5-5;

echo "Stranica:";
$asd2=$start+(5*5);

if($asd<$count_users && $asd>0){echo ' <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p=1&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">1</a> ... ';}

for($i=$asd; $i<$asd2;)
{
if($i<$count_users && $i>=0){
$ii=floor(1+$i/5);

if ($start==$i) {
echo ' <b>('.$ii.')</b>';
               }
                else {
echo ' <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p='.$ii.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ii.'</a>';
                     }}


$i=$i+5;}
if($asd2<$count_users){echo ' ... <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p='.$ba.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ba.'</a>';}
echo"<br/>Slika: $count_users<br/>";}
echo $fsize2;
}
////////////////////////////////////////////////////////////////////////////////////////////////

if($typesx=="2" && $user!=$id){
echo $fsize1;
$resultxd=mysql_query("SELECT `uid_user` FROM `album_dostup` WHERE `uid_user`='".$id."' AND `user`='".$user."' AND `uid_album`='".$uid."';");
$rowdx = mysql_fetch_array($resultxd);
$usid = $rowdx[0];
if(!empty($usid) && $user!=$id){
////////////////////////////////////////////////////////////////////////////////////////////////
echo"<br/>";
// получаем кол во участников
			$result = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='f' AND `refid`='".$uid."' AND `nick`='".$user."';");
			$cntData = mysql_fetch_row($result);
			$count_users = $cntData[0];
			$max_page = ceil ($count_users / 5);

			$page	= ($page > $max_page) ? (($max_page == 0)? $page : $max_page) : $page;

			$start  = 5*($page-1);
			$end	= 5;




$resultx=mysql_query("SELECT `id`,`name`,`attach`,`date` FROM `album` WHERE `type`='f' AND `refid`='".$uid."' AND `nick`='".$user."' ORDER BY id DESC LIMIT $start,$end;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$fid = $row[0];
$name = $row[1];
$attach = $row[2];
$dates = $row[3];
echo'<a href="album.php?action=view_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$name.'</a><br/>';

echo'<img src="resize.php?act='.$attach.'&amp;gname='.$fid.'&amp;maxsize=60" alt=""/><br/><br/>';

}

			if($i==0)
			{
			echo "<br/><b>Album je prazan!</b><br/>";
			}

if ($max_page > 1)
{
$ba=ceil($count_users/5);
$ba2=$ba*5-5;

echo "Stranica:";
$asd2=$start+(5*5);

if($asd<$count_users && $asd>0){echo ' <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p=1&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">1</a> ... ';}

for($i=$asd; $i<$asd2;)
{
if($i<$count_users && $i>=0){
$ii=floor(1+$i/5);

if ($start==$i) {
echo ' <b>('.$ii.')</b>';
               }
                else {
echo ' <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p='.$ii.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ii.'</a>';
                     }}


$i=$i+5;}
if($asd2<$count_users){echo ' ... <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p='.$ba.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ba.'</a>';}
echo"<br/>Slika: $count_users<br/>";}

}else{echo"<br/><br/><b>Prikaz albuma je zabranjen!</b><br/>";}
echo $fsize2;
}
/////////////////////////////////////////////////////USER///////////////////////////////
if($user==$id){
////////////////////////////////////////////////////////////////////////////////////////////////
echo $fsize1;
// получаем кол во участников
			$result = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='f' AND `refid`='".$uid."' AND `nick`='".$user."';");
			$cntData = mysql_fetch_row($result);
			$count_users = $cntData[0];
			$max_page = ceil ($count_users / 5);

			$page	= ($page > $max_page) ? (($max_page == 0)? $page : $max_page) : $page;

			$start  = 5*($page-1);
			$end	= 5;




$resultx=mysql_query("SELECT `id`,`name`,`attach`,`date` FROM `album` WHERE `type`='f' AND `refid`='".$uid."' AND `nick`='".$user."' ORDER BY id DESC LIMIT $start,$end;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$fid = $row[0];
$name = $row[1];
$attach = $row[2];
$dates = $row[3];
echo'<a href="album.php?action=view_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$name.'</a><br/>';

echo'<img src="resize.php?act='.$attach.'&amp;gname='.$fid.'&amp;maxsize=60" alt=""/><br/><br/>';

}

			if($i==0)
			{
			echo "<br/><b>Album je prazan!</b><br/>";
			}

if ($max_page > 1)
{
$ba=ceil($count_users/5);
$ba2=$ba*5-5;

echo "Stranica:";
$asd2=$start+(5*5);

if($asd<$count_users && $asd>0){echo ' <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p=1&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">1</a> ... ';}

for($i=$asd; $i<$asd2;)
{
if($i<$count_users && $i>=0){
$ii=floor(1+$i/5);

if ($start==$i) {
echo ' <b>('.$ii.')</b>';
               }
                else {
echo ' <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p='.$ii.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ii.'</a>';
                     }}


$i=$i+5;}
if($asd2<$count_users){echo ' ... <a href="album.php?action=view_album&amp;uid='.$uid.'&amp;p='.$ba.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ba.'</a>';}
echo"<br/>Slika: $count_users<br/>";}
echo $fsize2;
}
echo $fsize1;
echo "<br/>";
if($id == $user){
echo'<a href="album.php?action=view_dostup&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">Dozvole Pregleda</a><br/>';
echo'<a href="album.php?action=add_photo&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'">Dodaj Sliku</a><br/>';
}
echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'&amp;action=useralbum">Albumi Clana</a><br/>';
echo $fsize2;
}

if($action=="view_photo") {

$user = intval(check($_GET['user']));
if (eregi("[^0-9]", $user))
{echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
if (empty($_GET['user'])){echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if(empty($avtor)){echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
echo $fsize1;
echo''.$avtor.' Foto Album<br/>';
echo $divide;
$fid = intval(check($_GET['fid']));
if (eregi("[^0-9]", $fid))
{echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
if (empty($_GET['fid'])){echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $fid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "f")
{echo $fsize1;
echo"Greska!!!";
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush(); exit;}

$resultx=mysql_query("SELECT `id`,`name`,`about`,`nick`,`vote`,`vote_col`,`count`,`date`,`attach`,`refid`,`rating` FROM `album` WHERE `type`='f' AND `id`='".$fid."' AND `nick`='".$user."';");
$count_users_on_pagex = mysql_num_rows($resultx);
$row = mysql_fetch_array($resultx);
$fid = $row[0];
$name = $row[1];
$about = $row[2];
$nick = $row[3];
$vote = $row[4];
$vote_col = $row[5];
$count = $row[6];
$date = $row[7];
$attach = $row[8];
$refid = $row[9];
$rating = $row[10];

$libcount = intval($count) + 1;
mysql_query("update `album` set  `count`='" . $libcount . "' where id='" . $fid . "' AND `nick`='".$user."';");

$ratingx = intval($rating) + 1;
mysql_query("update `album` set  `rating`='" . $ratingx . "' where id='" . $fid . "' AND `nick`='".$user."';");

echo'<b>'.$name.'</b><br/>'.$about.'<br/>';

echo'<br/><img src="../album_date/'.$fid.'.'.$attach.'" alt=""/><br/><a href="../album_date/'.$fid.'.'.$attach.'">Download</a><br/><br/>';

$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$nick."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];

$resultxdd=mysql_query("SELECT `name` FROM `album` WHERE `id`='".$refid."' AND `nick`='".$user."';");
$rowdxd = mysql_fetch_array($resultxdd);
$namecat = $rowdxd[0];

$dats = date("d.m.y / H:i",$date);

echo'Dodato: '.$dats.'<br/>Album: <a href="album.php?action=view_album&amp;uid='.$refid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$namecat.'</a>';

$tit=round($vote/$vote_col/2,1);
echo '<br/>Polularnost: <b>'.$rating.'</b><br/>';
echo 'Ocena: <b>'.$vote_col.'</b><br/>';
echo 'Pregledan: <b>'.$count.'</b><br/>';

echo'<br/>';

if($ms[nick]!="".$_GET['id'].""){
echo'<a href="album.php?action=vote&amp;fid='.$ms[id].'&amp;'.$ses.'&amp;ref='.$ref.'">Glasaj!</a><br/>';
}

if($lev==8 || $ms[nick]=="".$_GET['id'].""){
echo'<br/><a href="album.php?action=edit_photo&amp;fid='.$ms[id].'&amp;'.$ses.'&amp;ref='.$ref.'">Izmeniti</a><br/><br/>';
}


$result = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='c' AND `refid`='".$fid."';");
$cntData = mysql_fetch_row($result);
$count_users = $cntData[0];
echo'<a href="album.php?action=comment&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">Upisi komentar</a> ['.$count_users.']<br/>';
echo'<br/><a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'&amp;action=useralbum">U album chatera</a>';
echo"<br/>";
echo $fsize2;
}

if($action=="add_album") {


if($ver!="wml"){
echo'<form action="album.php?action=add_album_go&amp;'.$ses.'&amp;ref='.$ref.'" method="post">';
echo'<b>Naziv:</b> <br/><input type="text" name="name"/><br/>';
echo'<b>Opis:</b><br/>';
echo'<textarea cols="25" rows="3" name="msg"></textarea><br/>';
echo 'Tip albuma:<br/><select name="trans"><option value="0">Javni *</option>';
echo '<option value="1">Za prijatelje **</option><option value="2">Privatni ***</option></select><br/>';
echo'<br/><input type="submit" value="Aktiviraj!" /></form><hr/>';}else{

echo 'Naziv:<br/>';
echo '<input name="name"/><br/>';

echo 'Opis:<br/>';
echo '<input name="msg"/><br/>';


echo 'Tip albuma:<br/><select name="trans"><option value="0">Javni</option>';
echo '<option value="1">Za prijatelje</option><option value="2">Provatni</option></select><br/>';

echo '<anchor>Dodaj!';
echo '<go href="album.php?action=add_album_go&amp;'.$ses.'&amp;ref='.$ref.'" method="post">';
echo '<postfield name="msg" value="$(msg)"/>';
echo '<postfield name="name" value="$(name)"/>';
echo '<postfield name="trans" value="$(trans)"/>';
echo '</go></anchor><br/>--------------------<br/>';
}
echo"* Dostupno svima<br/>** Dostupno samo za prijatelje<br/>*** Dostupan samo za ljude koji vi odredite!<br/>";

}

if($action=="add_album_go") {


$dates=date("d.m.y");
$times=date("H:i");
$time=time();

$name = $_POST['name'];
$msg = $_POST['msg'];
$id = $_GET['id'];
$name = check ($name);
$msg = check ($msg);

if (empty($msg)){echo"G R E S K A!!!";
echo'<br/><br/><a href="admin.php?'.$ses.'&amp;ref='.$ref.'">Nazad</a><br/>';
echo'<a href="../apanel.php?'.$ses.'&amp;ref='.$ref.'">Admin panel///</a><br/>';
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($name)){echo"G R E S K A!!!";
echo'<br/><br/><a href="admin.php?'.$ses.'&amp;ref='.$ref.'">Nazad</a><br/>';
echo'<a href="../apanel.php?'.$ses.'&amp;ref='.$ref.'">Admin panel///</a><br/>';
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}


if($trans=="0"){$type=0;}
if($trans=="1"){$type=1;}
if($trans=="2"){$type=2;}


$r = mysql_query ("select id,user from users where id='$id';");
$arr = mysql_fetch_array($r);
$login=$arr['user'];
$usid=$arr['id'];

$realdate = date("d.m.y");
$realtime = time();
mysql_query("insert into `album` values(0,'0','".$name."','" . $msg . "','".$id."','r','".$type."','0','0','0','".$realtime."','".$realdate."','0','0');");
$xid = mysql_insert_id();
echo"Album uspesno kreiran!<br/><br/>";

if($type==1){echo"Izabrali ste album za prijatelje i samo oni koji su u vasoj frend listi mogu videti album!<br/><br/>";}
if($type==0){echo"Izabrali ste javni album i njega mogu svi videti!<br/><br/>";}
if($type==2){echo"Izabrali ste privatni album i njega moze videti samo korisnik koga vi odaberete!<br/><br/>";}

echo"<a href='album.php?action=view_album&amp;uid=".$xid."&amp;".$ses."&amp;ref=".$ref."&amp;user=".$id."'>U album!</a><br/>";

}
if($action=="add_photo") {

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"GRESKA!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "GRESKA!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $uid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "r")
{echo "GRESKA!"; include_once"../foot3.php"; ob_end_flush(); exit;}

if($ver!="wml"){

echo "<form action='album.php?action=add_photo_go&amp;uid=".$uid."&amp;".$ses."&amp;ref=".$ref."' method='post' enctype='multipart/form-data'>
Izaberite foto(max 200 кb. - 640x640):<br/>
<input type='file' name='fail'/><br/>Naziv foto:<br/>
<input type='text' name='name'/><br/>Opis foto:<br/>
<input type='text' name='about'/><br/><input type='submit' value='Uploduj'/><br/></form>";

}else{
echo 'Download je moguc samo u html verziji chata!<br/>';
}



}

if($action=="add_photo_go") {

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"G R E S K A!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "GRESKA!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $uid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "r")
{echo "GRESKA!"; include_once"../foot3.php"; ob_end_flush(); exit;}


$name = check(trim($_POST['name']));
$about = check(trim($_POST['about']));

if (empty($about)){echo"G R E S K A! Niste naveli opis!!";
echo'<br/><br/><a href="album.php?action=add_photo&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'">Nazad...</a><br/>';
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($name)){echo"Niste naveli naziv!!!";
echo'<br/><br/><a href="album.php?action=add_photo&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'">Nazad...</a><br/>';
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($fail)){echo"Prevelik fajl!?!";
echo'<br/><br/><a href="album.php?action=add_photo&amp;uid='.$uid.'&amp;'.$ses.'&amp;ref='.$ref.'">Nazad...</a><br/>';
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}


function format($name)
{
    $f1 = strrpos($name, ".");
    $f2 = substr($name, $f1 + 1, 999);
    $fname = strtolower($f2);
    return $fname;
}

$fname = $_FILES['fail']['name'];
$fsize = $_FILES['fail']['size'];
$ftip = format($fname);
$newfotorazmer = GetImageSize($_FILES['fail']['tmp_name']);
$width = $newfotorazmer[0];
$height = $newfotorazmer[1];

        if ($fsize >= 1024 * 200)
        {
           echo"Vas fajl je veci od 200 кb";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;
        }
        if (eregi("[^a-z0-9.()+_-]", $fname))
        {
            echo"Nepravilan naziv!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;
        }
        if (eregi("[^a-z0-9.()+_-]", $newname))
        {
            echo"Koristite nedozvoljene simbole!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;
        }
        if ((preg_match("/.php/i", $fname)) or (preg_match("/.pl/i", $fname)) or ($fname == ".htaccess") or (preg_match("/php/i", $newname)) or (preg_match("/.pl/i", $newname)) or ($newname == ".htaccess"))
        {
            echo"GRESKA!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;
        }
        if($width<=640 && $height<=640 && $height>10 && $width>10) {
        $realdate = date("d.m.y");
        $realtime = time();

$sdf = mysql_query("SELECT `type_album` FROM `album` WHERE `type`='r' AND `id`='".$uid."';");
$c123 = mysql_fetch_row($sdf);
$typer = $c123[0];


        mysql_query("insert into `album` values(0,'".$uid."','" . $name . "','" . $about . "','".$id."','f','".$typer."','0','0','0','".$realtime."','".$realdate."','".$ftip."','0');");
        $xid = mysql_insert_id();

        $newname = "$xid.$ftip";
        if ((move_uploaded_file($_FILES["fail"]["tmp_name"], "../album_date/$newname")) == true)
        {
            $ch = $newname;
            @chmod("$ch", 0777);
            @chmod("../album_date/$ch", 0777);
            echo'<br/><img src="resize.php?act='.$ftip.'&amp;gname='.$xid.'&amp;maxsize=60" alt=""/><br/>';
            echo"<br/><b>Foto uspesno dodat!</b><br/><br/><a href='album.php?action=view_photo&amp;fid=".$xid."&amp;".$ses."&amp;ref=".$ref."&amp;user=".$id."'>Pregled...</a><br/><a href='album.php?action=view_album&amp;uid=".$uid."&amp;".$ses."&amp;ref=".$ref."&amp;user=".$id."'>U album</a><br/><br/>";
        } else
        {
            echo "Greska pri uploadu!<br/>";
        }
        }else{
            echo "Preveliki razmer fotografije.Dоzvoljen je od 640x640 !<br/>";
        }



}
//---------------------------------------- РЕДАКТИРОВАНИЕ -------------------------------------------//
if($action=="edit_album") {

$rs=mysql_fetch_array(mysql_query("SELECT `nick` FROM `album` WHERE `id`='".$uid."';"));
$idx = $rs[0];

if($idx==$id || $lev>7){
$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"GRESKA!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "GRESKA!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_fetch_array(mysql_query("select * from `album` where id='" . $uid . "';"));
if ($typ[type] != "r")
{echo "GRESKA!"; include_once"../foot3.php"; ob_end_flush(); exit;}

echo "Izmeniti naziv:<br/><form action='album.php?action=edit_album_go&amp;uid=".$uid."&amp;".$ses."&amp;ref=".$ref."' method='post'><input type='text' name='nf' value='" . $typ[name] . "'/><br/>Izmeniti opis:<br/><input type='text' name='ab' value='" . $typ[about] . "'/><br/><input type='submit' name='submit' value='Ok!'/><br/></form>";

}else { echo"To nije vas album!!!<br/><br/>"; }
}
//---------------------------------------- ИЗМЕНЕНИЕ СООБЩЕНИЯ -------------------------------------------//
if($action=="edit_album_go") {

$rs=mysql_fetch_array(mysql_query("SELECT `nick` FROM `album` WHERE `id`='".$uid."';"));
$idx = $rs[0];

if($idx==$id || $lev>7){

$nf = check(trim($_POST['nf']));
$ab = check(trim($_POST['ab']));

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"GRESKA!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "GRESKA!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_fetch_array(mysql_query("select * from `album` where id='" . $uid . "';"));
if ($typ[type] != "r")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

mysql_query("update `album` set  name='" . $nf . "', about='" . $ab . "' where id='" . $uid . "';");

echo"Album izmenjen!<br/><br/>";
}else { echo"To nije vas album!!!<br/><br/>"; }
}

//---------------------------------------- РЕДАКТИРОВАНИЕ -------------------------------------------//
if($action=="edit_photo") {

$rs=mysql_fetch_array(mysql_query("SELECT `nick` FROM `album` WHERE `id`='".$fid."';"));
$idx = $rs[0];

if($idx==$id || $lev>7){
$fid = intval(check($_GET['fid']));
if (eregi("[^0-9]", $fid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['fid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_fetch_array(mysql_query("select * from `album` where id='" . $fid . "';"));
if ($typ[type] != "f")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

echo "Izmeniti naziv:<br/><form action='album.php?action=edit_photo_go&amp;uid=".$fid."&amp;".$ses."&amp;ref=".$ref."' method='post'><input type='text' name='nf' value='" . $typ[name] . "'/><br/>Izmeniti opis:<br/><input type='text' name='ab' value='" . $typ[about] . "'/><br/><input type='submit' name='submit' value='Ok!'/><br/></form>";

}else { echo"Ovo nije vas album!!!<br/><br/>"; }
}
//---------------------------------------- ИЗМЕНЕНИЕ СООБЩЕНИЯ -------------------------------------------//
if($action=="edit_photo_go") {

$rs=mysql_fetch_array(mysql_query("SELECT `nick` FROM `album` WHERE `id`='".$uid."';"));
$idx = $rs[0];

if($idx==$id || $lev>7){

$nf = check(trim($_POST['nf']));
$ab = check(trim($_POST['ab']));

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_fetch_array(mysql_query("select * from `album` where id='" . $uid . "';"));
if ($typ[type] != "f")
{echo "greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

mysql_query("update `album` set  name='" . $nf . "', about='" . $ab . "' where id='" . $uid . "';");

echo"Foto izmenjen!<br/><br/>";
}else { echo"Ovo nije vas album!!!<br/><br/>"; }
}

//---------------------------------------- УДАЛЕНИЕ СООБЩЕНИЯ -------------------------------------------//
if($action=="del_album") {

$rs=mysql_fetch_array(mysql_query("SELECT `nick` FROM `album` WHERE `id`='".$uid."';"));
$idx = $rs[0];
if($idx==$id || $lev>7){

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"GRESKA!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_fetch_array(mysql_query("select * from `album` where id='" . $uid . "';"));
if ($typ[type] != "r")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

$raz = mysql_query("select * from `album` where id='" . $uid . "';");
                        while ($raz1 = mysql_fetch_array($raz))
                        {
                            $tem = mysql_query("select * from `album` where refid='" . $raz1[id] . "' and type='f';");
                            while ($tem1 = mysql_fetch_array($tem))
                            {
                            mysql_query("delete from `album` where `id`='" . $tem1[id] . "';");
                            unlink ("../album_date/".$tem1[id].".".$tem1[attach]."");
                            }
                            mysql_query("delete from `album` where `id`='" . $raz1[id] . "';");
                            unlink ("../album_date/".$raz1[refid].".".$raz1[attach]."");
                            mysql_query("delete from `album` where `refid`='" . $raz1[id] . "';");
                        }
mysql_query("delete from `album` where `id`='" . $uid . "';");


echo "Album i fotografije su udaljene!"; include_once"../foot3.php"; ob_end_flush(); exit;

}else { echo"Ovo nije vas album!!!<br/><br/>"; }
}

//---------------------------------------- УДАЛЕНИЕ СООБЩЕНИЯ -------------------------------------------//
if($action=="del_photo") {

$rs=mysql_fetch_array(mysql_query("SELECT `nick` FROM `album` WHERE `id`='".$fid."';"));
$idx = $rs[0];
if($idx==$id || $lev>7){

$fid = intval(check($_GET['fid']));
if (eregi("[^0-9]", $fid))
{echo"GRESKA!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['fid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_fetch_array(mysql_query("select * from `album` where id='" . $fid . "';"));
if ($typ[type] != "f")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

echo '<a href="album.php?action=del_photo_go&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'">Da,zelim da udaljim!</a>'; include_once"../foot3.php"; ob_end_flush(); exit;

}else { echo"Ovo nije vas album!!!<br/><br/>"; }

}

if($action=="del_comment") {

if($lev>7){

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_fetch_array(mysql_query("select * from `album` where id='" . $uid . "';"));
if ($typ[type] != "c")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}
mysql_query("delete from `album` where `id`='" . $uid . "';");
echo "Komentar uspesno udaljen!"; include_once"../foot3.php"; ob_end_flush(); exit;
}else { echo"Greska!!!<br/><br/>"; }

}

if($action=="del_photo_go") {

$rs=mysql_fetch_array(mysql_query("SELECT `nick` FROM `album` WHERE `id`='".$fid."';"));
$idx = $rs[0];
if($idx==$id || $lev>7){

$fid = intval(check($_GET['fid']));
if (eregi("[^0-9]", $fid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['fid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_fetch_array(mysql_query("select * from `album` where id='" . $fid . "';"));
if ($typ[type] != "f")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

unlink ("../album_date/".$fid.".".$typ[attach]."");
mysql_query("delete from `album` where `id`='" . $fid . "';");

echo "Uspesno udaljeno!"; include_once"../foot3.php"; ob_end_flush(); exit;

}else { echo"Ovo nije vas album!!!<br/><br/>"; }

}

if($action=="vote") {

echo'Album chatera: <b><a href="../info.php?'.$ses.'&amp;nk='.$user.'&amp;ref='.$ref.'">'.$avtor.'</a></b><br/><br/>';

$fid = intval(check($_GET['fid']));
if (eregi("[^0-9]", $fid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['fid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $fid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "f" || $ms[nick] == "".$_GET['id']."")
{echo "Greska!!!"; include_once"../foot3.php"; ob_end_flush(); exit;}

$typ = mysql_query("select * from `album` where id='" . $fid . "' AND `type`='f';");
$ms = mysql_fetch_array($typ);

echo '<b>Oceni fotografiju</b><br/><br/>';


if($ms['count']!="0"){



$filex=file("../album_vote/$fid.dat");
$countx=count($filex);
$switchx=0;
$wordx="$id";
for ($ix=0;$ix<$countx;$ix++){
if (trim($filex[$ix])==$wordx){$switchx=1;}}
if($switchx==1)
{
echo'Vec ste glasali za ovu fotografiju,dupli glasovi se ne vaze!<br/><br/><a href="album.php?action=view_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">..nazad</a><br/><br/>';
}else{

$fp=fopen("../album_vote/".$fid.".dat","a+");
flock ($fp,LOCK_EX);
fputs($fp,"$id\r\n");
flock ($fp,LOCK_UN);
fclose($fp);

$refid = $ms['refid'];
$typx = mysql_query("select * from `album` where id='" . $refid . "' AND `type`='r' AND `nick`='".$user."';");
$msx = mysql_fetch_array($typx);
$new_votex = $msx[vote_col]+1;
$golosx=round($msx[vote]+10);
mysql_query("update `album` set  `vote_col`='" . $new_votex . "' where id='" . $refid . "';");

$new_vote = $ms[vote_col]+1;
$rat=round($ms[rating]+5);
mysql_query("update `album` set  `vote_col`='" . $new_vote . "', `rating`='" . $rat . "' where id='" . $fid . "';");

echo'<br/>Vas glas je priznat! Fotografija je dobila 10 poena,a album 5 bodova!<br/><br/>';

$typ = mysql_query("select * from `album` where id='" . $fid . "';");
$ms = mysql_fetch_array($typ);

echo 'Glasova: '.$ms[vote_col].'<br/>';

echo '<a href="album.php?action=view_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">...nazad</a><br/>';
}
} else { echo '<br/>Greska,ne mozete glasati<br/><br/><a href="album.php?action=view_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'">...nazad</a><br/>';}
echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'&amp;action=useralbum">К альбомам юзера</a><br/>';
}

if($action=="comment") {

$user = intval(check($_GET['user']));
if (eregi("[^0-9]", $user))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['user'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if(empty($avtor)){echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}
echo'Album chatera: <b><a href="../info.php?'.$ses.'&amp;nk='.$user.'&amp;ref='.$ref.'">'.$avtor.'</a></b><br/><br/>';

if (empty($_GET['p'])) $page = 1;
	else $page=$_GET['p'];

$fid = intval(check($_GET['fid']));
if (eregi("[^0-9]", $fid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['fid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $fid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "f")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

echo'<a href="album.php?action=komm&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">Osvezi</a>';
echo'<br/>';

if($ver!="wml"){
echo'<form action="album.php?action=add_comment&amp;'.$ses.'&amp;ref='.$ref.'&amp;fid='.$fid.'&amp;user='.$user.'" method="post"><br/>';
echo'<b>Vas text:</b><br/>';
echo'<textarea cols="25" rows="3" name="msg"></textarea><br/>';
echo'<br/><input type="submit" value="ОК!" /></form>';}else{
echo 'Vas tekst:<br/>';
echo '<input name="msg"/><br/>';
echo '<anchor>ОК!';
echo '<go href="album.php?action=add_comment&amp;'.$ses.'&amp;ref='.$ref.'&amp;fid='.$fid.'&amp;user='.$user.'" method="post">';
echo '<postfield name="msg" value="$(msg)"/>';
echo '</go></anchor><br/>--------------------<br/>';
}

// получаем кол во участников
			$result = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='c' AND `refid`='".$fid."';");
			$cntData = mysql_fetch_row($result);
			$count_users = $cntData[0];
			$max_page = ceil ($count_users / 5);

			$page	= ($page > $max_page) ? (($max_page == 0)? $page : $max_page) : $page;

			$start  = 5*($page-1);
			$end	= 5;

$resultx=mysql_query("SELECT `name`,`about`,`nick`,`date`,`id` FROM `album` WHERE `type`='c' AND `refid`='".$fid."' ORDER BY date DESC LIMIT $start,$end;");
$count_users_on_pagex = mysql_num_rows($resultx);


for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$name = $row[0];
$text = $row[1];
$nick = $row[2];
$dats = $row[3];
$id_c = $row[4];

$dats = date("d.m.y / H:i",$dats);

$rs=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$nick."';");
$rowx = mysql_fetch_array($rs);
$uz = $rowx[0];


if($lev>=7){echo '<a href="album.php?'.$ses.'&amp;action=del_comment&amp;uid='.$id_c.'&amp;ref='.$ref.'">[X]</a> | ';}

echo'<a href="../info.php?'.$ses.'&amp;nk='.$nick.'&amp;ref='.$ref.'">'.$uz.'</a> ('.$dats.')<br/><small>'.$text.'</small><br/><br/>';


}
echo"<br/>";
			if($i==0)
			{
			echo "<br/><center><b>Nema komentara!</b></center><br/>";
			}

if ($max_page > 1)
{
$ba=ceil($count_users/5);
$ba2=$ba*5-5;

echo "Stranica:";
$asd=$start-(5*4);
$asd2=$start+(5*5);

if($asd<$count_users && $asd>0){echo ' <a href="album.php?action=comment&amp;fid='.$fid.'&amp;p=1&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">1</a> ... ';}

for($i=$asd; $i<$asd2;)
{
if($i<$count_users && $i>=0){
$ii=floor(1+$i/5);

if ($start==$i) {
echo ' <b>('.$ii.')</b>';
               }
                else {
echo ' <a href="album.php?action=comment&amp;fid='.$fid.'&amp;p='.$ii.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ii.'</a>';
                     }}


$i=$i+5;}
if($asd2<$count_users){echo ' ... <a href="album.php?action=comment&amp;fid='.$fid.'&amp;p='.$ba.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">'.$ba.'</a>';}

				}
echo"<br/><br/>";
echo '<a href="album.php?action=view_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'">Na fotografiju</a><br/>';
echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'&amp;action=useralbum">Na album chatera</a><br/>';
}

if($action=="add_comment") {

$user = intval(check($_GET['user']));
if (eregi("[^0-9]", $user))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['user'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if(empty($avtor)){echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}
echo'Album chatera: <b><a href="../info.php?'.$ses.'&amp;nk='.$user.'&amp;ref='.$ref.'">'.$avtor.'</a></b><br/><br/>';

$fid = intval(check($_GET['fid']));
if (eregi("[^0-9]", $fid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['fid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $fid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "f")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}
$time=time();

$msg = $_POST['msg'];
$msg = check ($msg);

if (empty($msg)){echo"Greska!?!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}

$r = mysql_query ("select id,user from users where id='$id';");
$arr = mysql_fetch_array($r);
$login=$arr['user'];
$usid=$arr['id'];

mysql_query("insert into `album` values(0,'".$fid."','0','".$msg."','" . $id . "','c','0','0','0','0','" . $time . "','0','0','0');");

$rat=round($ms[rating]+2);
mysql_query("update `album` set `rating`='" . $rat . "' where id='" . $fid . "' AND `nick`='".$user."';");


echo"Komentar uspesno upisan!<br/><br/>";
echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;user='.$user.'&amp;action=useralbum">U album chatera</a><br/>';
}

if($action=="view_dostup") {

$user = intval(check($_GET['user']));
if (eregi("[^0-9]", $user))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['user'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if(empty($avtor)){echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}
echo'Album chatera: <b><a href="../info.php?'.$ses.'&amp;nk='.$user.'&amp;ref='.$ref.'">'.$avtor.'</a></b><br/><br/><a href="album.php?action=add_user&amp;'.$ses.'&amp;ref='.$ref.'&amp;uid='.$uid.'&amp;user='.$user.'">[Dodaj clana]</a><br/><br/>';

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $uid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "r")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

$resultxd=mysql_query("SELECT `nick` FROM `album` WHERE `id`='".$uid."' AND `type`='r' AND `nick`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if($avtor==$id){

if (empty($_GET['p'])) $page = 1;
	else $page=$_GET['p'];

	// получаем кол во участников
			$result = mysql_query("SELECT count(`id`) FROM `album_dostup` WHERE `user`='".$id."' AND `uid_album`='".$uid."';");
			$cntData = mysql_fetch_row($result);
			$count_users = $cntData[0];
			$max_page = ceil ($count_users / 5);

			$page	= ($page > $max_page) ? (($max_page == 0)? $page : $max_page) : $page;

			$start  = 5*($page-1);
			$end	= 5;
			$resultx=mysql_query("SELECT * FROM `album_dostup` WHERE `user`='".$id."' AND `uid_album`='".$uid."' ORDER BY `id` DESC LIMIT $start,$end;");
$count_users_on_pagex = mysql_num_rows($resultx);


for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$idx = $row['id'];
$userx = $row['uid_user'];

$rs=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$userx."';");
$rowx = mysql_fetch_array($rs);
$uz = $rowx[0];

echo'<a href="../info.php?'.$ses.'&amp;nk='.$userx.'&amp;ref='.$ref.'">'.$uz.'</a> | <a href="album.php?action=del_user&amp;rid='.$idx.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;uid='.$uid.'&amp;user='.$user.'">[Udaljiti]</a><br/>';

}
echo"<br/>";
			if($i==0)
			{
			echo "<center><b>Nemate prava dostupa!</b></center>";
			}

if ($max_page > 1)
{
$ba=ceil($count_users/5);
$ba2=$ba*5-5;

echo "Strana:";
$asd=$start-(5*4);
$asd2=$start+(5*5);

if($asd<$count_users && $asd>0){echo ' <a href="album.php?action=view_dostup&amp;uid='.$uid.'&amp;user='.$user.'&amp;p=1&amp;'.$ses.'&amp;ref='.$ref.'">1</a> ... ';}

for($i=$asd; $i<$asd2;)
{
if($i<$count_users && $i>=0){
$ii=floor(1+$i/5);

if ($start==$i) {
echo ' <b>('.$ii.')</b>';
               }
                else {
echo ' <a href="album.php?action=view_dostup&amp;uid='.$uid.'&amp;user='.$user.'&amp;p='.$ii.'&amp;'.$ses.'&amp;ref='.$ref.'">'.$ii.'</a>';
                     }}


$i=$i+5;}
if($asd2<$count_users){echo ' ... <a href="album.php?action=view_dostup&amp;uid='.$uid.'&amp;user='.$user.'&amp;p='.$ba.'&amp;'.$ses.'&amp;ref='.$ref.'">'.$ba.'</a>';}

				}
echo"<br/><br/>";

}else{echo "Greska!!!"; include_once"../foot3.php"; ob_end_flush(); exit;}
}

if($action=="add_user") {

$user = intval(check($_GET['user']));
if (eregi("[^0-9]", $user))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['user'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if(empty($avtor)){echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}
echo'Album chatera: <b><a href="../info.php?'.$ses.'&amp;nk='.$user.'&amp;ref='.$ref.'">'.$avtor.'</a></b><br/><br/>';

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $uid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "r")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

$resultxd=mysql_query("SELECT `nick` FROM `album` WHERE `id`='".$uid."' AND `type`='r' AND `nick`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if($avtor==$id){


if($ver!="wml"){
echo'<form action="album.php?action=add_user_go&amp;'.$ses.'&amp;ref='.$ref.'&amp;uid='.$uid.'&amp;user='.$user.'" method="post">';
echo'<b>Navedite ID chatera:</b> <br/><input type="text" name="idx"/><br/>';
echo'<br/><input type="submit" value="Dodaj!" /></form><hr/>';}else{
echo 'Navedite ID chatera:<br/>';
echo '<input name="idx"/><br/>';
echo '<anchor>Dodaj!';
echo '<go href="album.php?action=add_user_go&amp;'.$ses.'&amp;ref='.$ref.'&amp;uid='.$uid.'&amp;user='.$user.'" method="post">';
echo '<postfield name="idx" value="$(idx)"/>';
echo '</go></anchor><br/>--------------------<br/>';
}
echo"* ID chatera mora biti tacan!<br/><br/>";

}else{echo "Greska!!!"; include_once"../foot3.php"; ob_end_flush(); exit;}
}

if($action=="add_user_go") {

$idx = intval(check($_POST['idx']));
if (eregi("[^0-9]", $idx))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_POST['idx'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}

$r = mysql_query ("select id,user from users where id='".$idx."';");
$arr = mysql_fetch_array($r);
$login=$arr['user'];
$usid=$arr['id'];

if (empty($login))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}

if ($idx == $id)
{echo"Greska!!!<br/><br/>";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}

$rsx=mysql_fetch_array(mysql_query("SELECT `uid_user` FROM `album_dostup` WHERE `uid_album`='".$uid."' AND `user`='".$id."' AND `uid_user`='".$idx."';"));
$idxx = $rsx[0];
if($idxx==$idx){
echo "Chater uspesno dodat!"; echo"<br/><a href='album.php?action=view_album&amp;uid=".$uid."&amp;".$ses."&amp;ref=".$ref."&amp;user=".$id."'>U album</a><br/><br/>"; include_once"../foot3.php"; ob_end_flush(); exit;
}

mysql_query("insert into `album_dostup` values(0,'".$id."','".$uid."','".$idx."');");
echo"Chater: <b>$login</b> uspesno dadat u album prijatelja!<br/><br/>";

echo"<a href='album.php?action=view_album&amp;uid=".$uid."&amp;".$ses."&amp;ref=".$ref."&amp;user=".$id."'>...u album</a><br/>";

}

if($action=="del_user") {

$user = intval(check($_GET['user']));
if (eregi("[^0-9]", $user))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['user'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$resultxd=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$user."';");
$rowdx = mysql_fetch_array($resultxd);
$avtor = $rowdx[0];
if(empty($avtor)){echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}
echo'Album chatera: <b><a href="../info.php?'.$ses.'&amp;nk='.$user.'&amp;ref='.$ref.'">'.$avtor.'</a></b><br/><br/>';

$uid = intval(check($_GET['uid']));
if (eregi("[^0-9]", $uid))
{echo"Greska!!!";
echo'<a href="../enter.php?'.$ses.'&amp;ref='.$ref.'">Chat meni</a><br/>';
include_once"../foot3.php"; ob_end_flush(); exit;}
if (empty($_GET['uid'])){echo "Greska!";include_once"../foot3.php"; ob_end_flush(); exit;}
$typ = mysql_query("select * from `album` where id='" . $uid . "';");
$ms = mysql_fetch_array($typ);
if ($ms[type] != "r")
{echo "Greska!"; include_once"../foot3.php"; ob_end_flush(); exit;}

$rs=mysql_fetch_array(mysql_query("SELECT `user` FROM `album_dostup` WHERE `user`='".$id."';"));
$idx = $rs[0];
if($idx==$id){

mysql_query("delete from `album_dostup` where `id`='" . $rid . "' AND `uid_album`='".$uid."' AND `user`='".$id."';");

echo "Chater uspesno udaljen!"; echo"<br/><a href='album.php?action=view_album&amp;uid=".$uid."&amp;".$ses."&amp;ref=".$ref."&amp;user=".$id."'>U album</a><br/><br/>"; include_once"../foot3.php"; ob_end_flush(); exit;

}else { echo"Ovo nije vas album!!!<br/><br/>"; }
}

if($action=="gallery") {

echo'Vase fotografije iz albuma:<br/><br/>';

if (empty($_GET['p'])) $page = 1;
	else $page=$_GET['p'];


echo'<a href="album.php?action=gallery&amp;'.$ses.'&amp;ref='.$ref.'">[Osvezi]</a><br/>';

////////////////////////////////////////////////////////////////////////////////////////////////
echo"<br/>";
// получаем кол во участников
			$result = mysql_query("SELECT count(`id`) FROM `album` WHERE `type`='f';");
			$cntData = mysql_fetch_row($result);
			$count_users = $cntData[0];
			$max_page = ceil ($count_users / 5);

			$page	= ($page > $max_page) ? (($max_page == 0)? $page : $max_page) : $page;

			$start  = 5*($page-1);
			$end	= 5;




$resultx=mysql_query("SELECT `id`,`name`,`attach`,`date`,`nick`,`vote`,`vote_col`,`rating` FROM `album` WHERE `type`='f' AND `type_album`='0' ORDER BY `rating` DESC LIMIT $start,$end;");
$count_users_on_pagex = mysql_num_rows($resultx);

for($i = 0; $i < $count_users_on_pagex; $i++)
{
$row = mysql_fetch_array($resultx);
$fid = $row[0];
$name = $row[1];
$attach = $row[2];
$dates = $row[3];
$nick = $row[4];
$vote = $row[5];
$vote_col = $row[6];
$rating = $row[7];

$rs=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$nick."';");
$rowx = mysql_fetch_array($rs);
$uz = $rowx[0];
$tit=round($vote/$vote_col/2,1);
echo'<a href="album.php?action=view_photo&amp;fid='.$fid.'&amp;'.$ses.'&amp;ref='.$ref.'&amp;user='.$nick.'">'.$name.'</a><br/>';

echo'<img src="resize.php?act='.$attach.'&amp;gname='.$fid.'&amp;maxsize=60" alt=""/><br/>Autor: <a href="../info.php?'.$ses.'&amp;nk='.$nick.'&amp;ref='.$ref.'">'.$uz.'</a><br/>Reiting: '.$rating.'<br/>Ocena: '.$tit.'/'.$vote_col.'<br/><br/>';

}

			if($i==0)
			{
			echo "<br/><center><b>Prazno...</b></center><br/>";
			}

if ($max_page > 1)
{
$ba=ceil($count_users/5);
$ba2=$ba*5-5;

echo "Strana:";
$asd2=$start+(5*5);

if($asd<$count_users && $asd>0){echo ' <a href="album.php?action=gallery&amp;p=1&amp;'.$ses.'&amp;ref='.$ref.'">1</a> ... ';}

for($i=$asd; $i<$asd2;)
{
if($i<$count_users && $i>=0){
$ii=floor(1+$i/5);

if ($start==$i) {
echo ' <b>('.$ii.')</b>';
               }
                else {
echo ' <a href="album.php?action=gallery&amp;p='.$ii.'&amp;'.$ses.'&amp;ref='.$ref.'">'.$ii.'</a>';
                     }}


$i=$i+5;}
if($asd2<$count_users){echo ' ... <a href="album.php?action=gallery&amp;p='.$ba.'&amp;'.$ses.'&amp;ref='.$ref.'">'.$ba.'</a>';}
echo"<br/><br/>Fotografija u bazi: $count_users<br/>";}
}

echo $fsize1;
echo $divide;
if($action=="" || $action=="myalbum"){
echo '<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=add_album">Dodaj Album</a><br/>';
}
if($action==""){
echo '<a href="album.php?'.$ses.'&amp;ref='.$ref.'&amp;action=myalbum">Moji Albumi</a><br/>';
}else{
echo'<a href="album.php?'.$ses.'&amp;ref='.$ref.'">Foto Albumi</a><br/>';
}
echo'<a href="enter.php?'.$ses.'&amp;ref='.$ref.'">Hodnik</a><br/>';
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
ob_end_flush();
exit;
?>
