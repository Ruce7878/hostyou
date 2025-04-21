<?
$a = mysql_query ("Select * from vopros where klu4 = '3'");
$b = mysql_fetch_array ($a);
$nom = $b["number"];
$vr = $b["time"];
$answ = $b["answer"];
$tran = $b["tran"];
$amsg = rus_to_k($msg);
$kansw = rus_to_k($answ);
?>