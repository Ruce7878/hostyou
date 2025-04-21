<?

if ($msg=="!вопрос"||$msg=="!vopros"){
$r = mysql_query ("select * from vopros where klu4 = '3'");
$a = mysql_fetch_array($r);
$vp = $a ["question"];
$i = $a ["number"];
if ($i!=5){
$st = getmicrotime();
$today=date ("H:i");
$a = mysql_query ("Select posts from users where id='".$uid."'");
$b = mysql_fetch_array ($a);
$p = $b["posts"];
$p++;
mysql_query ("Update users set posts='".$p."', onl='".$st."', room='room3' where id ='".$uid."'");
$rnd = rand(0,99999999);
$rs = "<b>Pitanje:</b> ";
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$rs."".$vp."', id='".$st."', towhom='', hid='0', usid='".$uid."', komu=''");
}
}
$s = substr ($msg,0,5);
if (($s == "stats")&&(strlen($msg) > 6)){
$stsus = substr ($msg,6,strlen($msg)-6);
$a = mysql_query ("Select anagrams from users where user='".$stsus."'");
if (mysql_affected_rows() != 0){
$st = getmicrotime();
$today=date ("H:i");
$b = mysql_fetch_array($a);
$i = $b["anagrams"];
$a = mysql_query ("Select user from users order by anagrams desc LIMIT 101");
$j = 1;
$b = mysql_fetch_array($a);

while (($b["user"] != $stsus)&&($j <= 100)) {$b = mysql_fetch_array($a); $j++;}
if ($j<=100) $s= "i zauzima <b>$j</b> mesto!";
else $s = "i  nije u prvih 100!";
$mes = "Chater <b>$stsus</b> ima <b>$i</b> tacnih anagram odgovora $s";
$rnd = rand(0,99999999);
if($towhom == $uid) $th = $id; else $th ="";
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$mes."', id='".$st."', towhom='".$th."', hid='0', usid='".$uid."', komu=''");

$a = mysql_query ("Select posts from users where id='".$uid."'");
$b = mysql_fetch_array ($a);
$p = $b["posts"];
$p++;
mysql_query ("Update users set posts='".$p."', onl='".$st."', room='room3' where id ='".$uid."'");
               } else {
$st = getmicrotime();
$today=date ("H:i");
$mes = "Chater $stsus nije u bazi!";
$rnd = rand(0,99999999);
if($towhom == $uid) $th = $id; else $th ="";
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$mes."', id='".$st."', towhom='".$th."', hid='0', usid='".$uid."', komu=''");

$a = mysql_query ("Select posts from users where id='".$uid."'");
$b = mysql_fetch_array ($a);
$p = $b["posts"];
$p++;
mysql_query ("Update users set posts='".$p."', onl='".$st."', room='room3' where id ='".$uid."'");
}
}
$agent = htmlentities(addslashes($HTTP_USER_AGENT));
if (((strpos ($agent,"M3Gate") !== false)||(strpos ($agent,"Opera") !== false)||(strpos ($agent,"emulator") !== false)||(strpos ($agent,"WinWAP") !== false)||(strpos ($agent,"Wapsilon") !== false)||(strpos ($agent,"Mozilla") !== false)||(strpos ($agent,"M3GATE") !== false))&&($rm==3)&&($set["vict"] == 0)){
$latumnik=mysql_fetch_array(mysql_query("Select latuser from users where id='6' LIMIT 1;"));
$amsg = strtolower($amsg);
$kansw = strtolower($kansw);
$tran = strtolower($tran);
if (($amsg == $kansw||$amsg == $tran)&&$nom!=5){
$st = time();
$today=date ("H:i");
$mes = "Bravo, <b>".$us."</b>! Tacan odgovor, ali ne priznajemo pitanja data sa kompjutera!";
$rnd = rand(0,99999999);
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$mes."', id='".$st."', towhom='".$id."', hid='0', usid='".$uid."', komu='".$us."'");
}
}else{
$amsg = strtolower($amsg);
$kansw = strtolower($kansw);
$tran = strtolower($tran);
if (($amsg == $kansw||$amsg == $tran)&&$nom!=5){{
$st = time();
$victint = $set["victint"];
$st = $st + $victint;
if ($victint=="5") $interval="5 sekundi";
else if ($victint=="30") $interval="30 sekundi";
else if ($victint=="60") $interval="1 minut";
else $interval="2 minuta";
mysql_query ("Update vopros set number = '5', time = '".$st."', answer = ' ', tran = ' ' WHERE klu4 ='3'");
$a = mysql_query ("Select posts from users where id='".$uid."'");
$b = mysql_fetch_array ($a);
$p = $b["posts"];
$p++;
mysql_query ("Update users set posts='".$p."', onl='".$st."', room='room3' where id ='".$uid."'");
$a = mysql_query ("Select posts from users where id='".$uid."'");
$b = mysql_fetch_array ($a);
$p = $b["posts"];
$p++;
mysql_query ("Update users set posts='".$p."', onl='".$st."', room='room3' where id ='".$uid."'");

$p = $row["anagrams"];
$p++;
 mysql_query ("Update users set anagrams='".$p."' where id ='".$id."'");
$st = getmicrotime();
$today=date ("H:i");
$mes = "Cestitamo, <b>".$us."</b>, imate <b>$p</b> tacnih odgovora! Naredno pitanje za ".$interval."!";
$rnd = rand(0,99999999);
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$mes."', id='".$st."', towhom='".$towhom."', hid='0', usid='".$uid."', komu=''");
}
$st = time();
$today=date ("H:i");
$mes = "Cestitamo, .jeje. imate <b>$p</b> tacnih anagram odgovora!";
$rnd = rand(0,99999999);
mysql_query ("Insert into room3 set klu4= '".$rnd."', time='".$today."', who='".$uus."', message='".$mes."', id='".$st."', towhom='".$id."', hid='0', usid='".$uid."', komu='".$us."'");
}
}
?>