<?php

$um = mysql_query ("Select user from users where id='6' LIMIT 1;");
$y = mysql_fetch_array ($um);
$umnik = $y["user"];
$uid = "6";
$uus = "".$umnik."";

$a = mysql_query ("Select * from vopros where klu4 = '3'");
$b = mysql_fetch_array ($a);
$nom = $b["number"];
$vr = $b["time"];
$answ = $b["answer"];

if (time()>=$vr){
if ($nom == 5){
$st = time();
$st = $st + 240;
mysql_query ("Update vopros set time = '".$st."' WHERE klu4 = '3'");
$r = mysql_query ("Select count(*) as num from anagram");
$a = mysql_fetch_array($r);
$num = $a["num"];
$rnd = rand(1,$num);

$qu = mysql_query ("Select * from anagram where number='".$rnd."'");
$re = mysql_fetch_array ($qu);
$answ = $re["answer"];
$tran = $re["tran"];
$nom = 0;
$vr = $st;

$i = strlen($tran);
$vp = $re["vopros"]." (<b>$i slova</b>)";
$rs = "<b>Anagram:</b>";

mysql_query ("Update vopros set number = '".$nom."', question = '".$vp."', answer = '".$answ."', tran = '".$tran."' WHERE klu4 ='3'");
$a = mysql_query ("Select posts from users where id='".$uid."'");
$b = mysql_fetch_array ($a);
$p = $b["posts"];
$p++;
$st = getmicrotime();
mysql_query ("Update users set posts='".$p."', onl='".$st."', room='3' where id ='".$uid."'");
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$rs."".$vp."', id='".$st."', towhom='', hid='0', usid='".$uid."', komu=''");
} else {
$victint = $set["victint"];
$st = time();
$st = $st + $victint;
if ($victint=="5") $interval="5 sekundi";
else if ($victint=="30") $interval="30 sekundi";
else if ($victint=="60") $interval="1 minut";
else $interval="2 minuta";
mysql_query ("Update vopros set time = '".$st."' WHERE klu4 = '3'");
$r = mysql_query ("Select count(*) as num from anagram");
$a = mysql_fetch_array($r);
$num = $a["num"];
$rnd = rand(1,$num);
$qu = mysql_query ("Select * from anagram where number='".$rnd."'");
$re = mysql_fetch_array ($qu);
$answ = " ";
$tran = " ";
$nom = 5;
$vr = $st;
mysql_query ("Update vopros set number = '".$nom."', answer = '".$answ."', tran = '".$tran."' WHERE klu4 ='3'");

$a = mysql_query ("Select posts from users where id='".$uid."'");
$b = mysql_fetch_array ($a);
$p = $b["posts"];
$p++;
$st = getmicrotime();
mysql_query ("Update users set posts='".$p."', onl='".$st."', room='3' where id ='".$uid."'");
$vp = "Nema odgovora na zadati anagram! Naredni anagram za ".$interval."!";
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$vp."', id='".$st."', towhom='', hid='0', usid='".$uid."', komu=''");
}
}else
if ((($vr-time())<180)&&($nom == 0)){
$nom = 1;
mysql_query ("Update vopros set number = '".$nom."', answer = '".$answ."' WHERE klu4 ='3'");

$a = mysql_query ("Select posts from users where id='".$uid."'");
$b = mysql_fetch_array ($a);
$p = $b["posts"];
$p++;
$st = getmicrotime();
mysql_query ("Update users set posts='".$p."', onl='".$st."', room='3' where id ='".$uid."'");

$v = substr($answ,0,1);

$vp = "Znate li anagram? Pomoc: <b>$v...</b>";
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$vp."', id='".$st."', towhom='', hid='0', usid='".$uid."', komu=''");
} else
if ((($vr-time())<90)&&($nom < 2)){
$nom = 2;
mysql_query ("Update vopros set number = '".$nom."', answer = '".$answ."' WHERE klu4 ='3'");
$a = mysql_query ("Select posts from users where id='".$uid."'");
$b = mysql_fetch_array ($a);
$p = $b["posts"];
$p++;
$st = getmicrotime();
mysql_query ("Update users set posts='".$p."', onl='".$st."', room='3' where id ='".$uid."'");

$i = strlen($answ)/3;
if ($i<2) $i=2;
$v = substr($answ,0,$i);

$vp = "Aj dajte odgovor, dobicete ali sta neznam ni ja...Ma dobicete nesto :).. Pomoc: <b>$v...</b>";
$today=date ("H:i");
$rnd = rand(0,99999999);
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$vp."', id='".$st."', towhom='', hid='0', usid='".$uid."', komu=''");
}
?>
