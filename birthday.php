<?
## Cestitka ##
$ffa=fopen("log/birthsend.dat","a+");
flock($ffa,LOCK_EX);
$andatafa=file("log/birthsend.dat");
if ($andatafa[0]<time())
{
ftruncate($ffa,0);
$andatafa = time() + 86400;
fwrite($ffa,$andatafa);
fflush($ffa);
$printansfa=1;
}
flock($ffa,LOCK_UN);
fclose($ffa);
if($printansfa==1){
$d=date("d-m-");
$y=date("Y");
$select = mysql_query ("Select id,user,birth,sex from users where birth LIKE '%$d%'");
if (mysql_affected_rows()!=0){
$systs = mysql_fetch_array(mysql_query ("Select user from users where id='1' LIMIT 1;"));
while ($inf = mysql_fetch_array ($select)){
$userbirth=$inf["user"];
$usidm=$inf["id"];
$pol=$inf["sex"];
$today=date ("H:i");
$data = date("d-M-Y [H:i]");
$rand = rand(0,99999999);
$rand2 = rand(0,99999999);
$time = time();
$tema = "Srecan Rodjendan!!!";
$sajt = "OazaRaja.Tk";
$messages = "Srecan rodjendan, puno srece i zdravlja zeli Vam administracija OazaRaja !";
mysql_query("Insert into zapiski set klu4='".$rand."', who ='".$systs[0]."', idwho ='1', message = '".$messages."', towhom = '".$userbirth."', idtowhom = '".$usidm."', time = '".$time."', readd = '0', topic = '".$tema."', date='".$data."'");
}
}
}
?>
