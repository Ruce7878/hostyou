<?php

function getnick_uid($uid) {
  $not = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$uid."'"));
  return $not[0];
}

$uid = $row['id'];

$nopop = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM bockanje WHERE touid='".$uid."' AND unread='1'"));
if($nopop[0]>0)
{
$sql ="SELECT * FROM bockanje where touid='".$uid."' AND unread = '1' ORDER BY id LIMIT 0, 1";
$pd = mysql_query($sql);
while ($pop = mysql_fetch_array($pd))
{
$bid = mysql_fetch_array(mysql_query("SELECT touid FROM bockanje WHERE touid='".$uid."'"));
if($uid==$bid[0])
{
$chread = mysql_query("UPDATE bockanje SET unread='0' WHERE id='".$pop[0]."'");
}
$novo2 = $pop[5];
$dtop = date("d.m.y - H:i:s",$novo2);
$by = getnick_uid($pop[2]);
$msg = htmlspecialchars($pop[1]);
$msg=getsmilies($msg,$_GET["id"]);

echo "<b>$by vas je bocnuo/la </b><img src=\"images/poke.gif\" alt=\"boc-boc\"/><br/>";
echo "<a href=\"bocni.php?action=send&amp;$ses&amp;ref=$ref&amp;who=$pop[2]\">Uzvrati bockanje</a> | <a href=\"bocni.php?action=ukloni&amp;$ses&amp;ref=$ref&amp;who=$pop[2]\">Ukloni</a><br/>";  

}
}
?>