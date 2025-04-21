<?php
/* --------------------------------------  /
/          Do not delete this              / 
/         EdykaChat script v1.0            /  
/  --------------------------------------- /  
/              CODING IS ART!              /  
/      This chat  script was made by       /  
/        Edyka (dizajner.tk)               /  
/    IT IS A REMAKE OF THE region-56       /  
/             CHAT SCRIPT                  /  
/ --------------------------------------  */
define('_IN_EDYCHAT',1); 

/* START THE FUN! */
require("inc.php");

 /* and so we go... */
 
list($userData, $id, $ps, $fsize1, $fsize2) = check_login($link);
/* connected and logged in! */


 switch($do) {

 default:
 echo edyka_head("Shout Arhiva",$userData);
 /* the head */

list($userData, $id, $ps, $fsize1, $fsize2) = check_login($link);
$us=$userData["user"];
if($userData["level"] < 5) {
echo edyka_head("Greska",$userData,"",true);
echo "Nemate prava pristupa!\n";

echo edyka_foot($divide);
mysql_close ($link);
exit;
}

 $mod=$_GET['mod'];
 /* a few sql statements :) */
 $cnts=mysql_result(mysql_query("SELECT COUNT(*) FROM ".TABLE_PREFIX."shoutbox  ".($mod=="adm" ? " WHERE  admin='1' " : " WHERE  admin='0' ")." LIMIT 100"),0);
 if($cnts>0) {
 if($ver=="xhtml") echo '<div class="d1">Arhiva Shouta</div><br/>';
 else echo '<p align="center">Arhiva Shouta</p><hr />';

 $page= (int) trim($_GET['p']);
 if(empty($page) || $page<=0) $page=1;
 
 $start=($page-1)*10;
 $ends=$page*10;
 $maxpage=ceil($cnts/10);
 
 $req=mysql_query("SELECT * FROM ".TABLE_PREFIX."shoutbox  ".($mod=="adm" ? " WHERE  admin='1' " : " WHERE  admin='0' ")." ORDER BY time DESC LIMIT $start,$ends");
while($sh=mysql_fetch_array($req)) {
$q1 = mysql_fetch_array(mysql_query("SELECT user, color, specolor, id FROM ".TABLE_PREFIX."users WHERE id='".$sh['username']."' LIMIT 1"));

$msgtxt=getsmilies($sh['message'], $q1['id']);
echo "<b><a href=\"info.php?$ses&amp;nk=".$sh['username']."&amp;ref=$ref\">".EdykaColor($q1[0],$q1[1],$q1[2])."</a>:</b> ".$msgtxt."<br />";
}
echo $divide;
echo '<p><b>';
 if($page>1) echo '<a href="arhiva.php?'.$ses.'&amp;p='.($page-1).'">Nazad</a>';
 if($page>1 && $page<$maxpage) echo ' | ';
 if($page<$maxpage) echo '<a href="arhiva.php?'.$ses.'&amp;p='.($page+1).'">Dalje</a>';
echo '</b></p>';
 } else echo "<p><b>Shout je prazan!</b></p>";
 
 }
 echo $divide;
 echo '<a href="enter.php?'.$ses.'">Hodnik</a><br/>';
echo edyka_foot($divide);
  /* the foot */
  
mysql_close ($link);
/* and DONE */
exit;

?>