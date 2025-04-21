<?php  include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");

if (isset($rm)) $takep="&amp;rm=$rm&amp;ref=$ref";
else $takep="&amp;ref=$ref";

$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

$fi = fopen("log/admlog.dat", "a+");
$dat = date ("~d F в H:i~");
$dat = str_replace("January","Januar",$dat);
$dat = str_replace("February","Februar",$dat);
$dat = str_replace("March","Mart",$dat);
$dat= str_replace("April","April",$dat);
$dat = str_replace("May","Maj",$dat);
$dat = str_replace("June","Jun",$dat);
$dat = str_replace("July","Jul",$dat);
$dat = str_replace("August","Avgust",$dat);
$dat = str_replace("September","Septembar",$dat);
$dat = str_replace("October","Oktobar",$dat);
$dat = str_replace("November","Novembar",$dat);
$dat = str_replace("December","Decembar",$dat);
$lst = "<b><u>".$row["user"]."</u></b> posetio/la Admin CP $dat, IP: $REMOTE_ADDR, Browser: $HTTP_USER_AGENT<br/>";
fwrite($fi, "$divide");
fwrite($fi, "$lst\n");
fflush($fi);
fclose($fi);

if(isset ($rm)) $takep="&amp;rm=$rm&amp;ref=$ref";
else $takep="&amp;ref=$ref";

if($row["level"] < 7) {
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"15\"/>";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
echo "<title>Greska!!!</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=enter.php?$ses$takep\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "Nemate prava pristupa!\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
exit;
}

$us=$row["user"];   
$login=$row["user"]; 
                

$adm = @mysql_query ("Select user from users where id='1' LIMIT 1;");
$z = @mysql_fetch_array ($adm);
$administration = $z["user"];


if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"apanel\" title=\"Admin Panel\">\n";
echo "<p align=\"center\" mode=\"wrap\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
echo "<title>Admin Panel</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}

$time=date ("H:i"); 
switch($go) {

default:
echo $fsize1;
echo "($time) Pozdrav, $us!<br/><br/>\n";
//echo "Nick ili ID chatera:<br/>\n"; 
echo $fsize2;
//if ($ver=="wml"){
//echo "<input name=\"nick$ref\" title=\"nick\" maxlength=\"12\" emptyok=\"true\"/><br/>\n";
//echo $fsize1;
//echo "<anchor title=\"go\">Pogledaj<go href=\"apanel.php?go=view&amp;$ses$takep\" method=\"post\">\n";
//echo "<postfield name=\"nick\" value=\"$(nick$ref)\"/>\n";
//echo "</go></anchor>\n"; 
//echo $fsize2;
//echo "<br/>\n"; 
//}else{
//echo "<form method=\"POST\" action=\"apanel.php?go=view&amp;$ses$takep\" name=\"auth\">\n";
//echo "<input name=\"nick\" title=\"nick\" maxlength=\"12\" emptyok=\"true\"/><br/>\n";
//echo "<input type=\"submit\" value=\"Pogledaj\" name=\"enter\"><br/>\n";
//}  
//if ($ver=="wml"){
//echo $fsize1;
//echo $divide;
//echo "<b>Kik</b><br/>\n";
//echo "Na koliko (min)<br/>\n";
//echo $fsize2;
//echo "<input name=\"wtime$ref\" maxlength=\"3\" title=\"vremya\" format=\"*N\" emptyok=\"true\"/><br/>\n";
//echo $fsize1;
//echo "Razlog<br/>\n";
//echo $fsize2;
//echo "<input name=\"whykik$ref\" maxlength=\"200\" title=\"whykik\" emptyok=\"true\"/><br/>\n";
//echo $fsize1;
//echo "<anchor title=\"go\">Kikuj<go href=\"kick.php?go=pni&amp;$ses$takep\" method=\"post\">\n";
//echo "<postfield name=\"nick\" value=\"$(nick$ref)\"/>\n";  
//echo "<postfield name=\"wtime\" value=\"$(wtime$ref)\"/>\n";  
//echo "<postfield name=\"whykik\" value=\"$(whykik$ref)\"/>\n";
//echo "</go></anchor>\n";
//echo $fsize2;
//echo "<br/>\n";
//echo $fsize1;
//echo $divide;
//echo $fsize2;
//echo $fsize1;
//echo "<anchor title=\"go\">Zabraniti nik<go href=\"bann.php?$ses$takep\" method=\"post\">\n";
//echo "<postfield name=\"nick\" value=\"$(nick$ref)\"/>\n";
//echo "</go></anchor>\n";
//echo $fsize2;
//echo "<br/>\n";
//echo $fsize1;
//echo "<anchor title=\"go\">Banuj IP+SOFT<go href=\"bannaip.php?$ses$takep\" method=\"post\">\n";
//echo "<postfield name=\"nick\" value=\"$(nick$ref)\"/>\n";
//echo "</go></anchor>\n";
//echo $fsize2;
//echo "<br/>\n";    
//echo $fsize1;
//echo "<anchor title=\"go\">Udaljiti chatera<go href=\"deluser.php?$ses$takep\" method=\"post\">\n";
//echo "<postfield name=\"nick\" value=\"$(nick$ref)\"/>\n";
//echo "</go></anchor>\n";
//echo $fsize2;
//echo "<br/>\n";
//}
echo $fsize1;
echo "<a href=\"apanel.php?$ses&amp;go=editrooms$takep\">Izmeni Naziv Soba</a><br/>\n";    
echo "<a href=\"apanel.php?$ses&amp;go=editposroom$takep\">Izmeni Poziciju Soba</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">NOVA SOBA</a><br/>\n";
//if($row["level"]==8){
//echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">OBRISI SOBE</a><br/>\n";
//}
echo "<a href=\"apanel.php?$ses&amp;go=bots$takep\">Izmeni Botove/Registraciju</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">Izmeni Statuse</a><br/><br/>\n";

//if($row["level"]==8){
//echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">SKINI ZASTITU</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">VIDI PASS</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">DODAJ ADMINA</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">OBRISI ADMINA</a><br/><br/>\n";
//}
//echo "<a href=\"openlog.php?$ses$takep&amp;n=1\">Aktivnost Admina</a><br/>\n"; 
//echo "<a href=\"openlogm.php?$ses$takep&amp;n=1\">Aktivnost Moda</a><br/>\n"; 
//echo "<a href=\"openlogr.php?$ses$takep&amp;n=1\">Aktivnost Kancelarije</a><br/>\n"; 
//echo "<a href=\"openlogi.php?$ses$takep&amp;n=1\">Aktivnost Intimne</a><br/>\n"; 
//echo $divide;
//echo "<a href=\"anekuslist.php?$ses&amp;ref=$ref\">Proveriti Stih</a><br/>";
//echo "<a href=\"apanel.php?$ses&amp;go=addanekdot1$takep\">Dodaj Stih</a><br/>\n";   
//echo "<a href=\"apanel.php?$ses&amp;go=addshutki$takep\">Dodaj Anegdotu</a><br/>\n";    
echo "<a href=\"apanel.php?$ses&amp;go=addvopr$takep\">Dodaj Pitanje</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=tell$takep\">Objava(Sve Sobe)</a><br/>\n";  
echo "<a href=\"apanel.php?$ses&amp;go=mnews$takep\">Dodaj Novost</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dnews$takep\">Obrisi Novosti</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=mmeet$takep\">Dodaj Objavu</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dmeet$takep\">Obrisi Objavu</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=mobi$takep\">Dodaj Razglas</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dobi$takep\">Obrisi Razglas</a><br/><br/>"; 
//if($row["level"]==8){
//echo $divide; 
//echo "<a href=\"apanel.php?$ses&amp;go=import_fraz$takep\">Brisanje Podatka</a><br/>\n"; 
//echo "<a href=\"apanel.php?$ses&amp;go=import_frazi$takep\">Brisanje Fraza</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=import_vopros$takep\">Brisanje Pitanja</a><br/>\n"; 
//echo "<a href=\"apanel.php?$ses&amp;go=import_anekdot$takep\">Brisanje Anegdote</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=import_shutki$takep\">Brisanje Zezalice</a><br/>\n";
//}

//echo "<a href=\"apanel.php?$ses&amp;go=unban$takep\">LISTA BANOVANIH</a><br/>\n";
if($row["level"]==8){
echo "<a href=\"apanel.php?$ses&amp;go=clbanip$takep\">Lista Browser+IP</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=clbanip$takep\">MOD LOG</a><br/>\n";
}
//echo "<a href=\"apanel.php?$ses&amp;go=unpin$takep\">Lista Kickovanih</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=fullign$takep\">Ciscenje Ignora</a><br/>\n";    
//echo "<a href=\"apanel.php?$ses&amp;go=clearzap$takep\">Ocisti Zapise</a><br/>\n";
//echo "<a href=\"apanel.php?$ses&amp;go=clroom$takep\">Čišćenje soba(nenajavljeno)</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=clroomtime$takep\">Ciscenje Svih Soba</a><br/>\n";
if($row["level"]==8){
echo "<a href=\"apanel.php?$ses&amp;go=clearlogs$takep\">Ciscenje Logova</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=delpp$takep\">Ciscenje Inboxa</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=pp2all$takep\">PP2ALL</a><br/>\n";
}
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=msvadbi$takep\">Dodaj svadbu</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=dsvadbi$takep\">Udalji svadbu</a><br/>";
echo "<a href=\"apanel.php?$ses&amp;go=razvod$takep\">Razvesti</a><br/>";
if($row["level"]==8){
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=link$takep\">Na glavnu</a><br/>";
}
echo $fsize2;
break;


case 'mnews':
$content=trim(htmlspecialchars(stripslashes($content)));
$date=date("j.m.Y");
if(empty($content)) $error=$error."<u>Unesite novost!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
print $fsize1;
print "Novost:<br/>";
print $fsize2;
print "<input name=\"content\"/><br/>";
print $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mnews$takep\" method=\"post\">";
print "<postfield name=\"action\" value=\"add\"/>";
print "<postfield name=\"content\" value=\"$(content)\"/>";
print "<postfield name=\"date\" value=\"$date\"/>";
print "</go></anchor><br/>";
print $fsize2;
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mnews$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Novost:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\"/><br/>\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo "<input type=\"hidden\" name=\"date\" value=\"$date\"/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else { 
if(empty($error)) {
if($content!=$last_news['content']) {
if(mysql_query("insert into news values(0,'$login','$content','$date');")) { 
print $fsize1;
print "Novost je dodata!<br/>"; 
} else { 
print $fsize1;
print "Greska!!!<br/>"; 
print $fsize2;
} 
} else {
print $fsize1;
print "Takva novost vec postoji!<br/>"; 
}
print $fsize2;
} else { 
print $fsize1;
print $error; 
print $fsize2;
} 
}
break;

case 'dnews':
$q = mysql_query("select id,content from news order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema novosti!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<b>".$arr['id'].".</b> ".$arr['content']."<a href=\"apanel.php?action=del&amp;$ses&amp;go=dnews&amp;mid=".$arr['id']."$takep\">[X]</a><br/>";  
echo $fsize2;
}
} else {
if(mysql_query("delete from news where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "Novost je obrisana!<br/>";
echo $fsize2;
}
}
}
break;

case 'dshout':
if(mysql_query("TRUNCATE table `shoutbox`")){ 
echo $fsize1;
echo "Razglas je obrisan!<br/>";
echo $fsize2;
}
break;

case 'mmeet':
$title=trim(htmlspecialchars(stripslashes($title)));
$content=trim(htmlspecialchars(stripslashes($content)));
$organizatory=trim(htmlspecialchars(stripslashes($organizatory)));
if(empty($title)) $error=$error."<u>Naziv nije naveden!</u><br/>";
if(empty($content)) $error=$error."<u>Sadrzaj nije naveden!</u><br/>";
if(empty($organizatory)) $error=$error."<u>Organizator nije naveden!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input name=\"title\"/><br/>";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input name=\"content\"/><br/>";
echo $fsize1;
echo "Organizator:<br/>";
echo $fsize2;
echo "<input name=\"organizatory\"/><br/>";
echo $fsize1;				
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mmeet$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"title\" value=\"$(title)\"/>";
echo "<postfield name=\"content\" value=\"$(content)\"/>";
echo "<postfield name=\"organizatory\" value=\"$(organizatory)\"/>";
echo "</go></anchor>";
echo $fsize2;	
echo "<br/>";
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mmeet$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"title\" value=\"$title\"/><br/>\n";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\" value=\"$content\"/><br/>\n";
echo $fsize1;
echo "Odganizator:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"organizatory\" value=\"$organizatory\"/><br/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
}else{ 
if(empty($error)) {
if($title!=$last_meet['title']) {
if(mysql_query("insert into vstrechi values(0,'".$login."','".$title."','".$content."','".$organizatory."');")) { 
echo $fsize1;
echo "Objava je dodata!<br/>"; 
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>"; 
echo $fsize2;
} 
} else { 
echo $fsize1;
echo "Takva objava vec postoji!<br/>"; 
echo $fsize2;
}
} else { 
echo $fsize1;
echo $error; 
echo $fsize2;
} 
}
break;

case 'dmeet':
$q = mysql_query("select id,title from vstrechi order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema objava!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dmeet&amp;mid=".$arr['id']."$takep\">".$arr['title']."</a><br/>";  
echo $fsize2;
}
} else {
if(mysql_query("delete from vstrechi where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "Objava je obrisana!<br/>";
echo $fsize2;
}
}
}
break;

case 'mobi':
$title=trim(htmlspecialchars(stripslashes($title)));
$content=trim(htmlspecialchars(stripslashes($content)));
$login=trim(htmlspecialchars(stripslashes($login)));
if(empty($title)) $error=$error."<u>Naziv nije naveden!</u><br/>";
if(empty($content)) $error=$error."<u>Sadrzaj nije naveden!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input name=\"title\"/><br/>";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input name=\"content\"/><br/>";
echo $fsize1;
echo "<anchor>Dodaj<go href=\"apanel.php?$ses&amp;go=mobi$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"title\" value=\"$(title)\"/>";
echo "<postfield name=\"content\" value=\"$(content)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=mobi$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";
echo $fsize1;
echo "Naziv:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"title\"/><br/>\n";
echo $fsize1;
echo "Sadrzaj:<br/>";
echo $fsize2;
echo "<input type=\"text\" name=\"content\"/><br/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
} else { 
if(empty($error)) {
if($title!=$last_obiav['title']) {
if(mysql_query("insert into obiav values(0,'".$login."','".$title."','".$content."');")) { 
echo $fsize1;
echo "Razglas je dodat!<br/>"; 
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!</b><br/>"; 
echo $fsize2;
} 
} else { 
echo $fsize1;
echo "Takav razglas vec postoji!<br/>";
echo $fsize2;
}
} else { 
echo $fsize1;
echo $error; 
echo $fsize2;
} 
}
break;

case 'dobi':
$q = mysql_query("select * from obiav order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nema razglasa!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dobi&amp;mid=".$arr['id']."$takep\">".$arr['title']."</a><br/>"; 
echo $fsize2;
}
} else {
if(mysql_query("delete from obiav where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "Razglas je obrisan!<br/>";
echo $fsize2;
}
}
}
break;

case 'view':
if (!ctype_digit($nick)) {
$nick = mysql_escape_string($nick);
$nick=trim($nick);    
if($nick=="")$nick=0;
$latuser=strtolower($nick);
$ruser = rus_to_k($nick);
if($ruser==$nick){
$select = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,img from users where latuser = '".$latuser."'"); 
} else {
$select = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,img from users where ruser = '".$ruser."'");
}
} else {
if (!ctype_digit($nick)) {header("Location: index.php"); die;}
$select = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,img from users where id = '".$nick."'"); 
}
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Chater nije pronadjen!<br/>\n"; 
echo $fsize2;
break;
}
$inf = mysql_fetch_array ($select);
$usid = $inf["id"];  
$us_ip = $inf["user_ip"];
$us_soft = $inf["user_soft"];
$level2=$inf["level"];
if($level2 > $row["level"]){
echo $fsize1;
echo "Pristup dozvoljen samo Super Administratorima!<br/>\n";
echo $fsize2;
break;
}
echo $fsize1;
echo "<b>ID:</b><br/>\n"; 
echo "$usid<br/>\n";
if($row["level"]==8) {
echo "<b>Browser:</b><br/>\n";
echo "$us_soft<br/>\n";
echo "<b>IP Clana:</b><br/>\n"; 
echo "$us_ip<br/>\n";
}
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?go=upd&amp;$ses$takep\" name=\"auth\">\n";
echo "<b>Nick:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"upnick\" maxlength=\"12\" value=\"$inf[user]\" title=\"nick\"/><br/>\n"; 
echo $fsize1;
echo "<b>Password:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"upass\" maxlength=\"20\" value=\"$inf[pass]\" title=\"upass\"/><br/>\n"; 
echo $fsize1;
echo "<b>Postovi:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"posts\" value=\"$inf[posts]\" title=\"posts\"/><br/>\n";
echo $fsize1;
echo "<b>Balans Igre:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"gposts\" value=\"$inf[gposts]\" title=\"posts\"/><br/>\n"; 
echo $fsize1;
echo "<b>Kviz Odgovora:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"credits\" value=\"$inf[credits]\" title=\"posts\"/><br/>\n"; 
echo $fsize1;
echo "<b>Kupljenih Odgovora:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"byeotv\" value=\"$inf[byeotv]\" title=\"posts\"/><br/>\n";
echo $fsize1;
echo "<b>Kredit Mafije:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"mafcredits\" value=\"$inf[mafcredits]\" title=\"posts\"/><br/>\n";  
echo $fsize1;
echo "<b>Glasova za FOTO:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"votefoto\" value=\"$inf[votefoto]\" title=\"votefoto\"/><br/>\n"; 
echo $fsize1;
echo "<b>Status:</b><br/>\n"; 
echo $fsize2;
echo "<input name=\"status\" maxlength=\"12\" value=\"$inf[status]\" title=\"status\"/><br/>\n";
echo $fsize1;
echo "<b>Nevidljivost:</b><br/>\n"; 
echo $fsize2;
echo "<select name=\"inv\">\n";
if ($inf["inv"] == 0)echo "<option value=\"0\">Iskljucena</option>\n";
elseif ($inf["inv"] == 1)echo "<option value=\"1\">Ukljucena</option>\n";
elseif ($inf["inv"] == 2)echo "<option value=\"2\">Potpuni Ignor</option>\n";
if ($inf["inv"]!=0) echo "<option value=\"0\">Iskljucena</option>\n";
if ($inf["inv"]!=1) echo "<option value=\"1\">Ukljucena</option>\n";
if ($inf["inv"]!=2) echo "<option value=\"2\">Potpuni Ignor</option>\n";
echo "</select><br/>\n";
echo $fsize1;
echo "<b>Level:</b><br/>\n"; 
echo $fsize2;
echo "<select name=\"level\">\n";
if($inf["level"] != 0) {
$i = $inf["level"];
$levelselect = @mysql_query ("Select name from levels where level='".$i."'");
$levels = @mysql_fetch_array($levelselect);
$levelname=$levels["name"];;     
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
if (($inf["level"]!=8)&&($row["level"]==8)){
for($i = 0; $i <= 8; $i++) {
$levelselect = @mysql_query ("Select name from levels where level='".$i."'");
$levels = @mysql_fetch_array($levelselect);
$levelname=$levels["name"];;     
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
} else {
for($i = 0; $i <= 7; $i++) {
$levelselect = @mysql_query ("Select name from levels where level='".$i."'");
$levels = @mysql_fetch_array($levelselect);
$levelname=$levels["name"];;     
echo "<option value=\"".$i."\">".$i."-".$levelname."</option>\n";
}
}
echo "</select><br/>\n";
if ($ver=="wml"){ 
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?go=upd&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"upid\" value=\"$usid\"/>\n";
echo "<postfield name=\"upnick\" value=\"$(upnick)\"/>\n";
echo "<postfield name=\"upass\" value=\"$(upass)\"/>\n";
echo "<postfield name=\"posts\" value=\"$(posts)\"/>\n";
echo "<postfield name=\"gposts\" value=\"$(gposts)\"/>\n";
echo "<postfield name=\"credits\" value=\"$(credits)\"/>\n";
echo "<postfield name=\"mafcredits\" value=\"$(mafcredits)\"/>\n";
echo "<postfield name=\"votefoto\" value=\"$(votefoto)\"/>\n";
echo "<postfield name=\"byeotv\" value=\"$(byeotv)\"/>\n";
echo "<postfield name=\"status\" value=\"$(status)\"/>\n"; 
echo "<postfield name=\"inv\" value=\"$(inv)\"/>\n";
echo "<postfield name=\"level\" value=\"$(level)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";   
}else{
echo "<input type=\"hidden\" name=\"upid\" value=\"$usid\"/>\n";
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
if ($inf["img"]!=""){
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?go=delfoto&amp;$ses&amp;usid=$usid$takep\">Obrisi Sliku</a><br/>";
echo $fsize2;
}
break;

case 'delfoto':
echo $fsize1; 
if (!ctype_digit($usid)) {header("Location: index.php"); die;}
$select2 = mysql_query ("Select img from users where id = '".$usid."'"); 
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Chater nije pronadjen!<br/>\n"; 
echo $fsize2;
break;
}
$inf2 = mysql_fetch_array ($select);
$myfotos = $inf2["img"];
$ras=explode(".", $myfotos);
$types=$ras[1];
if (!file_exists("photos/".$usid.".".$types."")){
echo "Chater nema sliku!<br/>\n";
}else{
if (!ctype_digit($usid)) { header("Location: index.php"); die; }
if(@mysql_query ("Update users set img ='' where id ='".$usid."';")){
unlink ("photos/".$usid.".".$types."");
echo "Slika je obrisana!<br/>";
}else{
echo "Greska!!!<br/>";
}
}
echo $fsize2;
break;

case 'upd':
$upnick=trim($upnick); 
if($upnick==""){          
echo $fsize1;
echo "error<br/>\n";
echo $fsize2;
break;
} 
if (!ctype_digit($upid)) {header("Location: index.php"); die;}
$a = mysql_query("SELECT user,level FROM users WHERE id ='".$upid."'");
$b = mysql_fetch_array ($a);
$prl = $b["level"];   
$nick = $b["user"];
$latuser=strtolower($upnick);
$ruser = rus_to_k($upnick);
if($ruser==$upnick){
mysql_query ("Select id from users where (latuser = '".$latuser."')and(user != '".$nick."')"); 
} else {
mysql_query ("select id from users where (ruser = '".$ruser."')and(user != '".$nick."')");
}
if (mysql_affected_rows() != 0) {
echo $fsize1;
echo "Chater nije pronadjen!<br/>\n";
echo $fsize2;
break;    
}
$upnick = check($upnick); 
$upass = check($upass); 
$ruser = check($ruser); 
$latuser = check($latuser); 
$status = check($status); 
$credits = check($credits); 
$mafcredits = check($mafcredits); 
$gposts = check($gposts);
$upnick = mysql_escape_string($upnick);
$upass = mysql_escape_string($upass);
$ruser = mysql_escape_string($ruser);
$latuser = mysql_escape_string($latuser);
$status = mysql_escape_string($status);
$credits = mysql_escape_string($credits);
$mafcredits = mysql_escape_string($mafcredits);
$gposts = mysql_escape_string($gposts);
if (!ctype_digit($posts)) {header("Location: index.php"); die;}
if (!ctype_digit($votefoto)) {header("Location: index.php"); die;}
if (!ctype_digit($byeotv)) {header("Location: index.php"); die;}
if (!ctype_digit($inv)) {header("Location: index.php"); die;}
if (!ctype_digit($level)) {header("Location: index.php"); die;}
if (!ctype_digit($upid)) {header("Location: index.php"); die;}
if ($ruser==$upnick) $ins_str = "Update users set user='".$upnick."', pass='".$upass."', posts='".$posts."', gposts='".$gposts."', credits='".$credits."', mafcredits='".$mafcredits."', votefoto='".$votefoto."', byeotv='".$byeotv."', status='".$status."', inv='".$inv."', level='".$level."', ruser = '', latuser = '".$latuser."' where id ='".$upid."'";
else $ins_str = "Update users set user='".$upnick."', pass='".$upass."', posts='".$posts."',gposts='".$gposts."',credits='".$credits."',mafcredits='".$mafcredits."',  votefoto='".$votefoto."', byeotv='".$byeotv."', status='".$status."', inv='".$inv."', level='".$level."', ruser = '".$ruser."', latuser = '' where id ='".$upid."'";
if (mysql_query ($ins_str)) {
if ($prl != $level){ 
$levelselect = @mysql_query ("Select name from levels where level='".$level."'");
$levels = @mysql_fetch_array($levelselect);
$ur=$levels["name"];
for ($i=0; $i<=23; $i++){
$st = time();           
$today=date ("H:i");
$levelselect = @mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = @mysql_fetch_array($levelselect);
$lev=$levels["name"];
$mes = "<b>$lev $us dodelio je $nick status $ur!</b>";     
$rnd = rand(0,99999999);
@mysql_query ("Insert into room{$i} set klu4= '".$rnd."', time='".$today."', who='".$administration."', message='".$mes."', id='".$st."', towhom='', hid='0', usid='1', komu=''");
}
$levelselect = @mysql_query ("Select name from levels where level='".$row["level"]."'");
$levels = @mysql_fetch_array($levelselect);
$lev=$levels["name"];
$data = date("d-M-Y [H:i]");
$kol = rand(0,99999999);
$time = time();
$topic = "Pozz!!!";
$message = "Pozz <b>".$nick."</b>!!! Zaslizili ste da Vam ".$lev." <b>".$us."</b> poveca status! Sada ste <b>".$ur."!</b>.";
@mysql_query("Insert into zapiski set klu4='".$kol."', who ='".$administration."', idwho ='1', message = '".$message."', towhom = '".$nick."', idtowhom = '".$upid."', time = '".$time."', readd = '0', topic = '".$topic."', date='".$data."'");
}
echo $fsize1;
echo "Profil je izmenjen!<br/>\n";
echo $fsize2;
} else {
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo " ".mysql_error()." ";
}
break;

case 'addanekdot1':
echo $fsize1;
echo "Translit stiha<br/>\n";
echo "Ne zaboravite autora (autor NIK)<br/>\n";
echo "Stih<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=goaddanekdot1&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"anek\" maxlength=\"2500\" title=\"quest\"/><br/>\n";  
echo $fsize1;
echo $divide;
echo $fsize2;
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=goaddanekdot1&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"anek\" value=\"$(anek)\"/>\n";  
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;


case 'addshutki':
echo $fsize1;
echo "Anegdota:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=goaddshutki&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"anek\" maxlength=\"255\" title=\"quest\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=goaddshutki&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"anek\" value=\"$(anek)\"/>\n";  
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;


case 'goaddanekdot1':
if ($row["translit"]==1)$anek = trun_to_rus($anek);
$anek = str_replace(chr("13"), " ", $anek);
$anek = str_replace(chr("10"), " ", $anek);
$anek = trim(" $anek ");
$anek = ereg_replace(" +"," ",$anek);
$anek=substr($anek,0,10000);
$anek = str_replace("\n", " ", $anek);  
$anek = str_replace("$", "$$", $anek);     
$anek = str_replace("", "", $anek);
$anek = str_replace("", "", $anek); 
$anek = str_replace("", "", $anek); 
$anek = str_replace("", "", $anek); 
$anek = str_replace("", "", $anek); 
$anek = str_replace("", "", $anek); 
$anek = HtmlSpecialChars($anek); 
$anek=addslashes($anek); 
$r = mysql_query("select * from anekdot1");
$k = mysql_affected_rows()+1;
mysql_query ("Insert into anekdot1 set klu4= '".$k."', message='".$anek."'");
if (mysql_error() == false){
echo $fsize1;
echo "Stih je dodat!<br/>\n";
echo "Ukupno stihova: $k !!!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
break;

case 'goaddshutki':
if ($row["translit"]==1)$anek = trun_to_rus($anek);
$anek = str_replace(chr("13"), " ", $anek);
$anek = str_replace(chr("10"), " ", $anek);
$anek = trim(" $anek ");
$anek = ereg_replace(" +"," ",$anek);
$anek=substr($anek,0,400);
$anek = str_replace("\n", " ", $anek);  
$anek = str_replace("$", "$$", $anek);     
$anek = str_replace("", "", $anek);
$anek = str_replace("", "", $anek); 
$anek = str_replace("", "", $anek); 
$anek = str_replace("", "", $anek); 
$anek = str_replace("", "", $anek); 
$anek = str_replace("", "", $anek); 
$anek = HtmlSpecialChars($anek); 
$anek=addslashes($anek); 
$r = mysql_query("select * from shutki");
$k = mysql_affected_rows()+1;
mysql_query ("Insert into shutki set klu4= '".$k."', message='".$anek."'");
if (mysql_error() == false){
echo $fsize1;
echo "Anegdota je dodata!<br/>\n";
echo "Broj anegdota: $k !!!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo " ".mysql_error()."";
}
break;


case 'addvopr':
echo $fsize1;
echo "Pitanje:<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=goaddvopr&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"vopros\" maxlength=\"255\" title=\"quest\"/><br/>\n";  
echo $fsize1;
echo "Odgovor:<br/>\n";
echo $fsize2;
echo "<input name=\"answ\" maxlength=\"60\" title=\"answ\"/><br/>\n";
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Dodaj<go href=\"apanel.php?go=goaddvopr&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"vopros\" value=\"$(vopros)\"/>\n";  
echo "<postfield name=\"answ\" value=\"$(answ)\"/>\n";  
echo "</go></anchor>\n"; 
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
break;


case 'goaddvopr':
if ($row["translit"]==1){

}
$tran=strtr($answ,array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","Z"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ш"=>"w","щ"=>"w","ц"=>"c","ч"=>"4","ь"=>".","ъ"=>".","ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Z"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ш"=>"W","Щ"=>"W","Ц"=>"C","Ч"=>"4","Ь"=>".","Ъ"=>".","Ы"=>"Y","Э"=>"E","Ю"=>"Yu","Я"=>"Ya"));
@mysql_query ("Select * from bots");
$k = @mysql_affected_rows()+2;
mysql_query ("Insert into bots set number= '".$k."', vopros='".$vopros."', answer='".$answ."',  tran='".$tran."'");
if (mysql_error() == false){
echo $fsize1;
echo "Pitanje je dodato!<br/>\n";
echo "Ukupno pitanja: $k !!!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()." ";
}
break;


case 'tell':
echo $fsize1;
echo "Objava(Sve Sobe):<br/>\n";
echo $fsize2;
if ($ver=="xhtml")echo "<form method=\"POST\" action=\"apanel.php?go=gotell&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"txt\" maxlength=\"1255\" title=\"text\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Napisi<go href=\"apanel.php?go=gotell&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"txt\" value=\"$(txt)\"/>\n";   
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Napisi\" name=\"enter\"><br/>\n";
}
break;


case 'gotell':
if ($row["translit"]==1)$txt = trun_to_rus($txt);
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = time();
for ($num = 0; $num <= 22; $num++){  
$room = "room".$num; 
$txt = "<b>$txt</b>";
if (!ctype_digit($id)) {header("Location: index.php"); die;}
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$us."', message='".$txt."', id='".$time."', towhom='', hid='0', usid='".$id."', komu=''");           }
if (mysql_error() == false){
echo $fsize1;
echo "Objava je napisana u svim sobama!<br/>\n";
echo $fsize2;
} else { 
echo $fsize1;
echo "Greska!!!<br/>\n";
echo $fsize2;
echo "".mysql_error()."";
}
break;

case 'fullign':
$r = mysql_query ("SELECT * from users WHERE inv = '2' ");
$a = mysql_fetch_array($r);
while ($a !== false){
$pid = $a["id"];
if (!ctype_digit($pid)) {header("Location: index.php"); die;}
mysql_query("UPDATE users set inv = '0' WHERE id = '".$pid."'");
$a = mysql_fetch_array($r);
}
echo $fsize1;
echo "Ignor Lista je ociscena!<br/>\n";
echo $fsize2;
break;

case 'clearzap':
$time = time()-604800;                                                  
mysql_query ("DELETE from zapiski WHERE time<$time");
echo $fsize1;
echo "Lista Zapisa je ociscena!<br/>\n";
echo $fsize2;
break;

case 'clbanip':
if($row["level"]==8){
$q = mysql_query("select klu4,ip,soft, user, tip from bannlist order by klu4 desc;");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
if($arr[4]=='1'){
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, Browser: ".$arr['soft']."</a><br/>";
}else{
echo "<a href=\"apanel.php?act=cl&amp;$ses&amp;go=clbanip&amp;nk=".$arr['klu4']."$takep\"><b>".$arr['user']."</b>, Browser: ".$arr['soft'].", IP: ".$arr['ip']."</a><br/>";	
}
echo $divide;
echo $fsize2;
}
if (mysql_affected_rows() != 0){
echo $fsize1;
echo "<a href=\"apanel.php?$ses&amp;go=clbanip&amp;act=unbannall$takep\">Skini Sve Banove</a><br/>";
echo $fsize2;
} else { 
echo $fsize1;
echo "Browser+IP Lista je prazna!<br/>";
echo $fsize2;
}
} else if ($act=="unbannall") {
mysql_query ("DELETE from bannlist");
echo $fsize1;
echo "Svi Browser+IP banovi su skinuti!<br/>\n";
echo $fsize2;
} else {
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
if(mysql_query("delete from bannlist where klu4='".$nk."'")){ 
echo $fsize1;
echo "Browser+IP ban je skinut!<br/>";
echo $divide;
echo " <a href=\"apanel.php?$ses&amp;go=clbanip$takep\">Skini Jos Banova</a><br/>";
echo $fsize2;
}
}
}else{
echo $fsize1;
echo "Ne mozete skidati IP+Browser Banove!<br/>";
echo $fsize2;
}
break;

case 'clroomtime':
echo $fsize1;
echo "Sobe ce biti ociscene za 3 minuta!<br/>\n";
echo $fsize2;
if(isset($rm)) echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
$fp=fopen("log/clear.dat", "w");
fclose($fp);
$f=fopen("log/clear.dat","a+");
flock($f,LOCK_EX);
$cleardata = time() + 180;
fwrite($f,$cleardata);
fflush($f);
flock($f,LOCK_UN);
fclose($f);
$rnd = rand(0,99999999);
$mes = "<b>Obavestenje! Sve sobe ce biti ociscene za 3 minuta!</b>";
$today=date("H:i");
$time = getmicrotime();
for ($num = 0; $num <= 23; $num++){
$ranec = "room".$num;
mysql_query ("Insert into $ranec set klu4= '".$rnd."', time='".$today."', who='".$row["user"]."', message='".$mes."', id='".$time."', towhom='', hid='".$row["id"]."', usid='".$row["id"]."', komu=''");
mysql_query("ANALYZE TABLE $ranec");
}
break;

case 'delpp':
if($row["level"]==8){
echo $fsize1;
echo "Sva procitana pisma su obrisana!<br/>\n";
echo $fsize2;
if(isset($rm)){
echo $fsize1;
echo "<a href=\"chat.php?$ses$takep\">Chat Soba</a><br/>";
echo $fsize2;
}
mysql_query ("DELETE FROM zapiski WHERE readd='1'");
}else{
echo $fsize1;
echo "Ne mozete brisati pisma!<br/>\n";
echo $fsize2;
}
break;

case 'pp2all':
if($row["level"]==8){
echo $fsize1;
echo "Tema:<br/>\n";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?go=pp2allsent&amp;$ses$takep\" name=\"auth\">\n";
echo "<input name=\"tema\" maxlength=\"30\" value=\"$name\" title=\"tema\"/><br/>\n";
echo $fsize1;
echo "Text Pisma:<br/>\n";
echo $fsize2;
echo "<input name=\"text\" maxlength=\"1000\" value=\"$name\" title=\"text\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Posalji PP2ALL<go href=\"apanel.php?go=pp2allsent&amp;$ses$takep\" method=\"post\">\n";
echo "<postfield name=\"tema\" value=\"$(tema)\"/>\n";   
echo "<postfield name=\"text\" value=\"$(text)\"/>\n";   
echo "</go></anchor>\n";  
echo $fsize2;
echo "<br/>\n";	
}else{
echo "<input type=\"submit\" value=\"Posalji PP2ALL\" name=\"enter\"><br/>\n";
}
}else{
echo $fsize1;
echo "Ne mozete slati PP2ALL!<br/>\n";
echo $fsize2;
}
break;

case 'pp2allsent':
if($row["level"]==8){
if($tema==""){$msg= "Unesite Temu!<br/>";}
else if($text==""){$msg= "Unesite Text Pisma!<br/>";}
else{$msg="Pismo je poslato svim clanovima!<br/>";
$maximalno = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM users"));
$i=0;
for($i; $i<$maximalno[0]; $i++)
{
$naziv = mysql_fetch_array(mysql_query("SELECT user FROM users WHERE id='".$i."'"));
if($naziv[0]){
$kol = rand(0,99999999);
$time = time();
$data = date("H:i(d-M)"); 	
mysql_query("INSERT INTO zapiski SET klu4='".$kol."', who ='".$us."', idwho ='".$id."', message = '".$text."', towhom = '".$naziv[0]."', idtowhom = '".$i."', time = '".$time."', readd = '0', topic = '".$tema."', date='".$data."'");
}
}
}
echo $fsize1;
echo $msg;
echo $fsize2;
}else{
echo $fsize1;
echo "Ne mozete slati PP2ALL!<br/>\n";
echo $fsize2;
}
break;

case 'clrm':
$room = "room".$rm;
$res = @mysql_query ("Select id from $room order by id desc");
$lines = mysql_fetch_array ($res);
$kl = $lines["id"];
if (@mysql_query ("Delete from $room where id = '".$kl."'")){
echo $fsize1;
echo "Tablica sa sobama ociscena!<br/>\n";
echo $fsize2;
}else{
echo $fsize1;
echo "Ошибка очистки комнаты!<br/>\n";
echo $fsize2;
}
if(isset($rm)){
echo $fsize1;
echo "<a href=\"chat.php?$ses$takep\">NA chat</a><br/>";
echo $fsize2;
}
break;

case 'fullignmake':
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
$select = @mysql_query ("Select * from users where id='".$nk."'");
$inf = mysql_fetch_array ($select); 
$level = $inf["level"];
$fignik = $inf["user"];
$figid = $inf["id"];
if (($level == 7)||($level == 8)){
echo $fsize1;
echo "Admin podesavanja ПИ!!!<br/>\n";
echo $fsize2;
break;
}        
if (!ctype_digit($figid)) {header("Location: index.php"); die;}
mysql_query ("UPDATE users SET inv = '2' WHERE id = '".$figid."'");
$rnd = rand(0,99999999);
$today=date ("H:i");
$time = time();
$room = "room".$rm;
$txt = "".$us." Nik chatera <b>".$fignik."</b> Zbog pravila chata stavljanje u ignor.";
mysql_query ("Insert into $room set klu4= '".$rnd."', time='".$today."', who='".$administration."', message='".$txt."', id='".$time."', towhom='', hid='0', usid='1', komu=''");
echo $fsize1;
echo "$fignik u ignor!!!<br/>\n";
echo $fsize2;
break;

case 'clbanniks':
$fp=fopen("log/bannlist.dat", "w");
fclose($fp);
@mysql_query ("update users set banned = '0' where banned = '1' "); 
echo $fsize1;
echo "Svi Banovi su skinuti!<br/>\n";
echo $fsize2;
break;

case 'clpinniks':
$fp=fopen("log/pinlist.dat", "w");
fclose($fp);
@mysql_query ("UPDATE users SET kik = '0', whokik = '', whykik = ''  where kik!='0'"); 
echo $fsize1;
echo "Svi Kickovi su skinuti!<br/>\n";
echo $fsize2;
break;

case 'clearlogs':
$fp=fopen("log/intim.dat", "w");
fclose($fp);
$fp=fopen("log/admroom.dat", "w");
fclose($fp);
$fp=fopen("log/admlog.dat", "w");
fclose($fp);
$fp=fopen("log/stlog.dat", "w");
fclose($fp);
$fp=fopen("log/bannlist.dat", "w");
fclose($fp);
$fp=fopen("log/banniplist.dat", "w");
fclose($fp);
$fp=fopen("log/pinlist.dat", "w");
fclose($fp);
echo $fsize1;
echo "Svi logovi su ocisceni!<br/>\n";
echo $fsize2;
break;

case 'unban':
$q = mysql_query("select id,user from users where banned='1' order by id desc;");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=unbann&amp;$ses&amp;go=unban&amp;nk=".$arr['id']."$takep\">".$arr['user']."</a><br/>";
echo $fsize2;
}
if (mysql_affected_rows() != 0){
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=clbanniks$takep\">Skini Sve Banove</a><br/>";
echo $fsize2;
} else { 
echo $fsize1;
echo "Lista Banovanih clanova je prazna!<br/>";
echo $fsize2;
}
} else {
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
if(mysql_query("update users set banned = '0' where id='".$nk."'")){
echo $fsize1;
echo "Ban je skinut!<br/>";
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=unban$takep\">Skini Jos Banova</a><br/>";
echo $fsize2;
}
}
break;

case 'unpin':
$q = mysql_query("select id,user from users where kik!='0' order by id desc;");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=unbann&amp;$ses&amp;go=unpin&amp;nk=".$arr['id']."$takep\">".$arr['user']."</a><br/>";
echo $fsize2;
}
if (mysql_affected_rows() == 0){
echo $fsize1;
echo "Lista Kickovanih je prazna!<br/>";
echo $fsize2;
}else{
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=clpinniks$takep\">Skini Sve Kickove</a><br/>";
echo $fsize2;
}
} else {
if (!ctype_digit($nk)) {header("Location: index.php"); die;}
if(mysql_query("UPDATE users SET kik = '0', whokik = '', whykik = ''  where id='".$nk."'")){
print $fsize1;
echo "Kick je skinut!<br/>";
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=unpin$takep\">Skini Jos Kickova</a><br/>";
echo $fsize2;
}
}
break;

case 'editrooms':
$q = mysql_query("select rm,name from rooms");
if(empty($act)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=rnm&amp;$ses&amp;go=editrooms&amp;rms=".$arr['rm']."$takep\">".$arr['rm'].". ".$arr['name']."</a><br/>";
echo $fsize2;
}
} elseif ($act=="dornm") {
if (!ctype_digit($rms)) {header("Location: index.php"); die;}
$roomname = check($roomname);
$roomname = mysql_escape_string($roomname);
mysql_query ("update rooms set name='".$roomname."' where rm='".$rms."'");
echo $fsize1;
echo "Soba je uspesno izmenjena!<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editrooms$takep\">Lista Soba</a><br/>";
echo $fsize2;
} else {
if (!ctype_digit($rms)) {header("Location: index.php"); die;}
$q = mysql_query("select name from rooms where rm='".$rms."'");
$arr=mysql_fetch_array($q);
$name=$arr["name"];
echo $fsize1;
echo "Naziv Sobe:<br/>\n";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?act=dornm&amp;$ses&amp;go=editrooms&amp;rms=$rms$takep\" name=\"auth\">\n";
echo "<input name=\"roomname\" maxlength=\"200\" value=\"$name\" title=\"roomname\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?act=dornm&amp;$ses&amp;go=editrooms&amp;rms=$rms$takep\" method=\"post\">\n";
echo "<postfield name=\"roomname\" value=\"$(roomname)\"/>\n";   
echo "</go></anchor>\n";  
echo $fsize2;
echo "<br/>\n";	
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo $fsize1;
echo $divide;
echo "<a href=\"apanel.php?$ses&amp;go=editrooms$takep\">Lista Soba</a><br/>";
echo $fsize2;
}
break;

case 'editposroom':
if(empty($act)) {
echo $fsize1;
echo "Soba:<br/>";
echo $fsize2;
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?act=update&amp;$ses&amp;go=editposroom$takep\" name=\"auth\">\n";
echo "<select name=\"name\">";
$q = @mysql_query("select * from rooms;");
while ($dbdata = @mysql_fetch_array($q)) {
$rm=$dbdata["rm"];
$val1=$dbdata["name"];
echo "<option value=\"".$rm."\">".$val1."</option>"; 
}
echo "</select><br/>";
echo $fsize1;
echo "Pozicija:<br/>";
echo $fsize2;
echo "<input size=\"4\" name=\"pos\" format=\"*N\"/><br/>";
if ($ver=="wml"){ 
echo $fsize1;
echo "<anchor>Izmeni<go href=\"apanel.php?act=update&amp;$ses&amp;go=editposroom$takep\" method=\"post\">";
echo "<postfield name=\"name\" value=\"$(name)\"/>";
echo "<postfield name=\"pos\" value=\"$(pos)\"/>";
echo "</go></anchor>";
echo $fsize2;
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
} else {
if (!ctype_digit($pos)) {header("Location: index.php"); die;}
if (!ctype_digit($name)) {header("Location: index.php"); die;}
if(@mysql_query("update rooms set pozicija='".$pos."' where rm='".$name."';")){ 
echo $fsize1;
echo "Pozicija sobe je izmenjena!<br/>";
echo $fsize2;
}
}
break;

case 'bots':
$setting = @mysql_query ("Select * from setting where klu4=1");
$set = mysql_fetch_array ($setting);
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updbots$takep\" name=\"auth\">\n";
echo $fsize1;
echo "<b>Opcije Registracije</b><br/>\n";
echo "Registracija:<br/>\n";
echo $fsize2;
echo "<select name=\"reg\">\n";
if($set["reg"] == 0){
echo "<option value=\"0\">Zakljucana</option>\n";
echo "<option value=\"1\">Otkljucana</option>\n";
} else {
echo "<option value=\"1\">Otkljucana</option>\n";
echo "<option value=\"0\">Zakljucana</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo "Registracija na ruskom:<br/>\n";
echo $fsize2;
echo "<select name=\"rus\">\n";
if($set["rus"] == 0){
echo "<option value=\"0\">Zakljucana</option>\n";
echo "<option value=\"1\">Otkljucana</option>\n";
} else {
echo "<option value=\"1\">Otkljucana</option>\n";
echo "<option value=\"0\">Zakljucana</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo $divide;
echo "<b>Opcije Botova</b><br/>\n";
echo "Gledati Odgovor:<br/>\n";
echo $fsize2;
echo "<select name=\"vict\">\n";
if($set["vict"] == 0){
echo "<option value=\"0\">Ne</option>\n";
echo "<option value=\"1\">Da</option>\n";
} else {
echo "<option value=\"1\">Da</option>\n";
echo "<option value=\"0\">Ne</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo "Interval Profesora(sec):<br/>\n";
echo $fsize2;
echo "<select name=\"victint\">\n";
if($set["victint"] === "5"){
echo "<option value=\"5\">5</option>\n";
}
elseif($set["victint"] === "30"){
echo "<option value=\"30\">30</option>\n";
}
elseif($set["victint"] === "60"){
echo "<option value=\"60\">60</option>\n";
}
elseif($set["victint"] === "120"){
echo "<option value=\"120\">120</option>\n";
}
echo "<option value=\"5\">5</option>\n";
echo "<option value=\"30\">30</option>\n";
echo "<option value=\"60\">60</option>\n";
echo "<option value=\"120\">120</option>\n";
echo "</select><br/>\n";
echo $fsize1;
echo "Zajebant:<br/>\n";
echo $fsize2;
echo "<select name=\"shut\">\n";
if($set["shut"] == 0){
echo "<option value=\"0\">Zakljucan</option>\n";
echo "<option value=\"1\">Otkljucan</option>\n";
} else {
echo "<option value=\"1\">Otkljucan</option>\n";
echo "<option value=\"0\">Zakljucan</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo "Interval Zajebanta (min):<br/>\n";
echo $fsize2;
echo "<select name=\"shutint\">\n";
if($set["shutint"] === "600"){
echo "<option value=\"600\">10</option>\n";
}
elseif($set["shutint"] === "1800"){
echo "<option value=\"1800\">30</option>\n";
}
elseif($set["shutint"] === "3600"){
echo "<option value=\"3600\">60</option>\n";
}
elseif($set["shutint"] === "7200"){
echo "<option value=\"7200\">120</option>\n";
}
echo "<option value=\"600\">10</option>\n";
echo "<option value=\"1800\">30</option>\n";
echo "<option value=\"3600\">60</option>\n";
echo "<option value=\"7200\">120</option>\n";
echo "</select><br/>\n";
echo $fsize1;
//echo "Soba drugog zajebnta:<br/>\n";
//echo "С\n"; 
//echo $fsize2;
//echo "<input size=\"2\" name=\"roomon\" maxlength=\"2\" value=\"$set[roomon]\" title=\"rmstart\"/>\n";  
//echo $fsize1;
//echo "do:\n"; 
//echo $fsize2;
//echo "<input size=\"2\" name=\"roomoff\" maxlength=\"2\" value=\"$set[roomoff]\" title=\"rmfinish\"/><br/>\n"; 
//echo $fsize1;
echo "Prodavac:<br/>\n";
echo $fsize2;
echo "<select name=\"prod\">\n";
if($set["prod"] == 0){
echo "<option value=\"0\">zakljucan</option>\n";
echo "<option value=\"1\">Otkljucan</option>\n";
} else {
echo "<option value=\"1\">Otkljucan</option>\n";
echo "<option value=\"0\">zakljucan</option>\n";
}           
echo "</select><br/>\n";
echo $fsize1;
echo $divide;
echo "<b>Imena Botova</b><br/>\n";
echo $fsize2;
$system = @mysql_fetch_array(@mysql_query ("Select user from users where id='1' LIMIT 1;"));
echo $fsize1;
echo "ID-1:\n"; 
echo $fsize2;
echo "<input name=\"system\" maxlength=\"13\" value=\"$system[0]\" title=\"System\"/><br/>\n";
$umnik = @mysql_fetch_array(@mysql_query ("Select user from users where id='2' LIMIT 1;"));
echo $fsize1;
echo "ID-2:\n";
echo $fsize2;
echo "<input name=\"umnik\" maxlength=\"13\" value=\"$umnik[0]\" title=\"Umnik\"/><br/>\n";
$shutnik = @mysql_fetch_array(@mysql_query ("Select user from users where id='3' LIMIT 1;"));
echo $fsize1;
echo "ID-3:\n"; 
echo $fsize2;
echo "<input name=\"shutnik\" maxlength=\"13\" value=\"$shutnik[0]\" title=\"Shutnik\"/><br/>\n";
$prodavec = @mysql_fetch_array(@mysql_query ("Select user from users where id='4' LIMIT 1;"));
echo $fsize1;
echo "ID-4:\n"; 
echo $fsize2;
echo "<input name=\"prodavec\" maxlength=\"13\" value=\"$prodavec[0]\" title=\"Prodavec\"/><br/>\n";
$mafia = @mysql_fetch_array(@mysql_query ("Select user from users where id='5' LIMIT 1;"));
echo $fsize1;
echo "ID-5:\n";
echo $fsize2;
echo "<input name=\"mafia\" maxlength=\"13\" value=\"$mafia[0]\" title=\"Mafia\"/><br/>\n";
$trahtenberg = @mysql_fetch_array(@mysql_query ("Select user from users where id='6' LIMIT 1;"));
echo $fsize1;
echo "ID-6:\n";
echo $fsize2;
echo "<input name=\"trahtenberg\" maxlength=\"13\" value=\"$trahtenberg[0]\" title=\"Trahtenberg\"/><br/>\n";
$robokop = @mysql_fetch_array(@mysql_query ("Select user from users where id='7' LIMIT 1;"));
echo $fsize1;
echo "ID-7:\n";
echo $fsize2;
echo "<input name=\"robokop\" maxlength=\"13\" value=\"$robokop[0]\" title=\"Robokop\"/><br/>\n";
$mat = @mysql_fetch_array(@mysql_query ("Select user from users where id='8' LIMIT 1;"));
echo $fsize1;
echo "ID-8:\n";
echo $fsize2;
echo "<input name=\"mat\" maxlength=\"13\" value=\"$mat[0]\" title=\"Mat\"/><br/>\n";
echo $fsize1;
echo $divide;
echo $fsize2;
if ($ver=="wml"){ 
echo $fsize1;
echo "<anchor title=\"go\">Sacuvaj<go href=\"apanel.php?$ses&amp;go=updbots$takep\" method=\"post\">\n";
echo "<postfield name=\"reg\" value=\"$(reg)\"/>\n";
echo "<postfield name=\"rus\" value=\"$(rus)\"/>\n";
echo "<postfield name=\"vict\" value=\"$(vict)\"/>\n";
echo "<postfield name=\"shut\" value=\"$(shut)\"/>\n";
echo "<postfield name=\"prod\" value=\"$(prod)\"/>\n";
echo "<postfield name=\"victint\" value=\"$(victint)\"/>\n";
echo "<postfield name=\"shutint\" value=\"$(shutint)\"/>\n";
echo "<postfield name=\"roomon\" value=\"1000\"/>\n";
echo "<postfield name=\"roomoff\" value=\"1001\"/>\n";
echo "<postfield name=\"system\" value=\"$(system)\"/>\n";
echo "<postfield name=\"umnik\" value=\"$(umnik)\"/>\n";
echo "<postfield name=\"shutnik\" value=\"$(shutnik)\"/>\n";
echo "<postfield name=\"prodavec\" value=\"$(prodavec)\"/>\n";
echo "<postfield name=\"mafia\" value=\"$(mafia)\"/>\n";
echo "<postfield name=\"trahtenberg\" value=\"$(trahtenberg)\"/>\n";
echo "<postfield name=\"robokop\" value=\"$(robokop)\"/>\n";
echo "<postfield name=\"mat\" value=\"$(mat)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Sacuvaj\" name=\"enter\"><br/>\n";
echo "<input type=\"hidden\" name=\"roomon\" value=\"1000\"/>\n";
echo "<input type=\"hidden\" name=\"roomoff\" value=\"1001\"/>\n";
}
break;

case 'updbots':
if (!ctype_digit($reg)) {header("Location: index.php"); die;}
if (!ctype_digit($rus)) {header("Location: index.php"); die;}
if (!ctype_digit($vict)) {header("Location: index.php"); die;}
if (!ctype_digit($shut)) {header("Location: index.php"); die;}
if (!ctype_digit($prod)) {header("Location: index.php"); die;}
if (!ctype_digit($victint)) {header("Location: index.php"); die;}
if (!ctype_digit($shutint)) {header("Location: index.php"); die;}
if (!ctype_digit($roomon)) {header("Location: index.php"); die;}
if (!ctype_digit($roomoff)) {header("Location: index.php"); die;}
$system = check($system); 
$umnik = check($umnik);
$shutnik = check($shutnik);
$prodavec = check($prodavec);
$mafia = check($mafia);
$trahtenberg = check($trahtenberg);
$robokop = check($robokop);
$mat = check($mat);
$system = mysql_escape_string($system);
$umnik = mysql_escape_string($umnik);
$shutnik = mysql_escape_string($shutnik);
$prodavec = mysql_escape_string($prodavec);
$mafia = mysql_escape_string($mafia);
$trahtenberg = mysql_escape_string($trahtenberg);
$robokop = mysql_escape_string($robokop);
$mat = mysql_escape_string($mat);
if (!isset($error)) {
$result = mysql_query ("Select * setting where klu4 = '1'");
if (mysql_affected_rows() == 0) {
$error = "Greska na bazi!";
} else {
if (mysql_query ("Update setting set reg='".$reg."', rus='".$rus."', vict='".$vict."', shut='".$shut."', prod='".$prod."', victint='".$victint."', shutint='".$shutint."', roomon='".$roomon."', roomoff='".$roomoff."' where klu4 ='1'")&&
mysql_query ("Update users set user='".$system."' where id = '1'")&&
mysql_query ("Update users set user='".$umnik."' where id = '2'")&&
mysql_query ("Update users set user='".$shutnik."' where id = '3'")&&
mysql_query ("Update users set user='".$prodavec."' where id = '4'")&&
mysql_query ("Update users set user='".$mafia."' where id = '5'")&&
mysql_query ("Update users set user='".$trahtenberg."' where id = '6'")&&
mysql_query ("Update users set user='".$robokop."' where id = '7'")&&
mysql_query ("Update users set user='".$mat."' where id = '8'")){
$msg = "Podesavanja registracije i botova izmenjeni!";
} else {
$msg = "Greska!!!";
}
}
} else {
$error = " ".mysql_error()." ";
}
if (isset($error)) {
echo $fsize1;
echo "$error\n";
echo $fsize2;
} 
echo $fsize1;
echo "$msg<br/>\n";
echo $fsize2;
break;

case 'link':
$setting = @mysql_query ("Select * from setting where klu4=1");
$set = mysql_fetch_array ($setting);
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updlink$takep\" name=\"auth\">\n";
echo $fsize1;
echo "<b>Podesavanja</b><br/>";
echo $divide;
echo "<b>Slika 1</b><br/>http://";
echo $fsize2;
echo "<input name=\"link1\" maxlength=\"120\" value=\"".$set["link1"]."\" title=\"link1\"/><br/>\n";  
echo $fsize1;
echo "<b>Naziv 1</b><br/>";
echo $fsize2;
echo "<input name=\"link1_name\" maxlength=\"40\" value=\"".$set["link1_name"]."\" title=\"link1_name\"/><br/>\n";  
echo $fsize1;
echo "<b>Slika 2</b><br/>http://";
echo $fsize2;
echo "<input name=\"link2\" maxlength=\"120\" value=\"".$set["link2"]."\" title=\"link2\"/><br/>\n";  
echo $fsize1;
echo "<b>Naziv 2</b><br/>";
echo $fsize2;
echo "<input name=\"link2_name\" maxlength=\"40\" value=\"".$set["link2_name"]."\" title=\"link2_name\"/><br/>\n";  
echo $fsize1;
echo "<b>Slika 3</b><br/>http://";
echo $fsize2;
echo "<input name=\"link3\" maxlength=\"120\" value=\"".$set["link3"]."\" title=\"link3\"/><br/>\n";  
echo $fsize1;
echo "<b>Naziv 3</b><br/>";
echo $fsize2;
echo "<input name=\"link3_name\" maxlength=\"40\" value=\"".$set["link3_name"]."\" title=\"link3_name\"/><br/>\n"; 
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeniti<go href=\"apanel.php?$ses&amp;go=updlink$takep\" method=\"post\">\n";
echo "<postfield name=\"link1\" value=\"$(link)\"/>\n";
echo "<postfield name=\"link1_name\" value=\"$(link1_name)\"/>\n";
echo "<postfield name=\"link2\" value=\"$(link2)\"/>\n";
echo "<postfield name=\"link2_name\" value=\"$(link2_name)\"/>\n";
echo "<postfield name=\"link3\" value=\"$(link3)\"/>\n";
echo "<postfield name=\"link3_name\" value=\"$(link3_name)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
break;

case 'updlink':
if(!eregi("^((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z;]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((/|\?)[a-z0-9~#%&'_\+=:;\?\.-]*)*)\$", $link1))$link1="";
if(!eregi("^((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z;]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((/|\?)[a-z0-9~#%&'_\+=:;\?\.-]*)*)\$", $link2))$link2="";
if(!eregi("^((([a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z;]{2,3}))|(([0-9]{1,3}\.){3}([0-9]{1,3})))((/|\?)[a-z0-9~#%&'_\+=:;\?\.-]*)*)\$", $link3))$link3="";
$link1_name = check($link1_name); 
$link2_name = check($link2_name);
$link3_name = check($link3_name);
$link1_name = mysql_escape_string($link1_name);
$link2_name = mysql_escape_string($link2_name);
$link3_name = mysql_escape_string($link3_name);
if (!isset($error)) {
$result = mysql_query ("Select * setting where klu4 = '1'");
if (mysql_affected_rows() == 0) {
$error = "database error...";
} else {
mysql_query ("Update setting set link1='".$link1."', link2='".$link2."', link3='".$link3."', link1_name='".$link1_name."', link2_name='".$link2_name."', link3_name='".$link3_name."' where klu4 = '1'");
$msg = "Sacuvano";
}
} else {
$error = " ".mysql_error()." ";
}
if (isset($error)) {
echo $fsize1;
echo "$error\n";
echo $fsize2;
} 
echo $fsize1;
echo "<b>$msg</b><br/>\n";
echo $fsize2;
break;

case 'editlevels':
$lev = mysql_query("select level,name from levels");
if(empty($act)) {
while($arr=mysql_fetch_array($lev)) {
echo $fsize1;
echo "<a href=\"apanel.php?act=rnm&amp;$ses&amp;go=editlevels&amp;level=".$arr['level']."$takep\">".$arr['level'].". ".$arr['name']."</a><br/>";
echo $fsize2;
}
} elseif ($act=="dornm") {
if (!ctype_digit($level)) {header("Location: index.php"); die;}
$levelname = check($levelname);
$levelname = mysql_escape_string($levelname);
settype($level, 'integer');
mysql_query ("update levels set name='".$levelname."' where level='".$level."'");
echo $fsize1;
echo "Status je izmenjen!<br/>\n";
echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">Lista Statusa</a><br/>";
echo $fsize2;
} else {
$lev = mysql_query("select name from levels where level=$level");
$arr=mysql_fetch_array($lev);
$name=$arr["name"];
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?act=dornm&amp;$ses&amp;go=editlevels&amp;level=$level$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Status:<br/>\n";
echo $fsize2;
echo "<input name=\"levelname\" maxlength=\"200\" value=\"$arr[0]\" title=\"levelname\"/><br/>\n";  
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"apanel.php?act=dornm&amp;$ses&amp;go=editlevels&amp;level=$level$takep\" method=\"post\">\n";
echo "<postfield name=\"levelname\" value=\"$(levelname)\"/>\n";   
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo $fsize1;
echo "<a href=\"apanel.php?$ses&amp;go=editlevels$takep\">Lista Statusa</a><br/>";
echo $fsize2;
}
break;

case 'razvod':
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updrazvod$takep\" method=\"post\">\n";
echo $fsize1;
echo "Nik Muza:<br/>";
echo $fsize2;
echo "<input name=\"zhenih\" maxlength=\"12\"/><br/>";
echo $fsize1;
echo "Nik Zene:<br/>";
echo $fsize2;
echo "<input name=\"nevesta\" maxlength=\"12\"/><br/>";
if ($ver=="wml"){
echo $fsize1;				
echo "<anchor>Razvesti<go href=\"apanel.php?$ses&amp;go=updrazvod$takep\" method=\"post\">";
echo "<postfield name=\"zhenih\" value=\"$(zhenih)\"/>";
echo "<postfield name=\"nevesta\" value=\"$(nevesta)\"/>";
echo "</go></anchor>";
echo $fsize2;	
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"Razvesti\" name=\"enter\"><br/>\n";
}
break;

case 'updrazvod':
$zhenih=trim(htmlspecialchars(stripslashes($zhenih)));
$nevesta=trim(htmlspecialchars(stripslashes($nevesta)));
if(empty($zhenih)) $error=$error."<u>Не заполнено поле Zених!</u><br/>";
if(empty($nevesta)) $error=$error."<u>Не заполнено поле Невеста!</u><br/>";
$latuser=strtolower($zhenih);
$ruser = rus_to_k($zhenih);
if($ruser==$zhenih){
$latuser = mysql_escape_string($latuser);
$result = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,para from users where latuser = '".$latuser."' and sex='М'"); 
} else {
$ruser = mysql_escape_string($ruser);
$result = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,para from users where ruser = '".$ruser."'  and sex='М'");
}
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "<u>Парня с ником <b>".$zhenih."</b> не сущетвует.</u><br/>";
echo $fsize2;
break;
}
$raz=mysql_fetch_array($result);
$zhena=$raz['para'];
if ($zhena!=$nevesta){
echo $fsize1;
echo "<b>".$nevesta."</b> не является Zеной для <b>".$zhenih."</b>.<br/>";
echo $fsize2;
break;
}

$latuser2=strtolower($nevesta);
$ruser2 = rus_to_k($nevesta);
if($ruser2==$nevesta){
$latuser2 = mysql_escape_string($latruser2);
$result = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,para from users where latuser = '".$latuser2."' and sex='Z'"); 
} else {
$ruser2 = mysql_escape_string($ruser2);
$result = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft,para from users where ruser = '".$ruser2."' and sex='Z'");
}
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "<u>Devojka sa nikom <b>".$nevesta."</b> ne postoji.</u><br/>";
echo $fsize2;
break;
}
$raz=mysql_fetch_array($result);
$muj=$raz['para'];
if ($muj!=$zhenih){
echo $fsize1;
echo "<b>".$zhenih."</b> Navalila na muza <b>".$nevesta."</b>.<br/>";
echo $fsize2;
break;
}
if(empty($error)) {
if($zhenih!=$last_svadbi['zhenih']) {
if(mysql_query("Update users set para='' where user ='".$zhenih."'")&&mysql_query("Update users set para='' where user ='".$nevesta."'")) { 
echo $fsize1;
echo "<b>Razvod usmesno obavljen!</b><br/>"; 
echo $fsize2;
} else { 
echo $fsize1;
echo "<b>Problemi sa razvodom</b><br/>"; 
echo $fsize2;
} 
} else { 
echo $fsize1;
echo "<b>Odavno su se razveli!</b><br/>"; 
echo $fsize2;
}
} else { 
echo $fsize1;
echo $error; 
echo $fsize2;
}
break;

case 'msvadbi':
if ($ver=="xhtml") echo "<form method=\"POST\" action=\"apanel.php?$ses&amp;go=updsvadbi$takep\" name=\"auth\">\n";
echo $fsize1;
echo "Nik Zene:<br/>";
echo $fsize2;
echo "<input name=\"zhenih\" maxlength=\"12\"/><br/>";
echo $fsize1;
echo "Nik Muza:<br/>";
echo $fsize2;
echo "<input name=\"nevesta\" maxlength=\"12\"/><br/>";
echo $fsize1;
echo "Nesto o nevesti:<br/>";
echo $fsize2;
echo "<input name=\"frzhenih\"/><br/>";
echo $fsize1;
echo "Kuma neveste:<br/>";
echo $fsize2;
echo "<input name=\"frnevesta\"/><br/>";
echo $fsize1;
echo "Dan svadbe:<br/>";
echo $fsize2;
echo "<input size=\"2\" name=\"day\" maxlength=\"2\" format=\"*N\"/>.<input size=\"2\" name=\"month\" maxlength=\"2\" format=\"*N\"/>.<input size=\"4\" name=\"year\" maxlength=\"4\" format=\"*N\"/><br/>"; 
echo $fsize1;
echo "Vreme svadbe:<br/>";
echo $fsize2;
echo "<input size=\"2\" name=\"chs\" maxlength=\"2\" format=\"*N\"/>:<input size=\"2\" name=\"min\" maxlength=\"2\" format=\"*N\"/><br/>";
if ($ver=="wml"){ 
echo $fsize1;				
echo "<anchor>Sacuvaj<go href=\"apanel.php?$ses&amp;go=updsvadbi$takep\" method=\"post\">";
echo "<postfield name=\"zhenih\" value=\"$(zhenih)\"/>";
echo "<postfield name=\"nevesta\" value=\"$(nevesta)\"/>";
echo "<postfield name=\"frzhenih\" value=\"$(frzhenih)\"/>";
echo "<postfield name=\"frnevesta\" value=\"$(frnevesta)\"/>";
echo "<postfield name=\"day\" value=\"$(day)\"/>";
echo "<postfield name=\"month\" value=\"$(month)\"/>";
echo "<postfield name=\"year\" value=\"$(year)\"/>";
echo "<postfield name=\"chs\" value=\"$(chs)\"/>";
echo "<postfield name=\"min\" value=\"$(min)\"/>";
echo "<postfield name=\"organizatory\" value=\"$us\"/>";
echo "</go></anchor>";
echo $fsize2;	
echo "<br/>";
}else{
echo "<input type=\"submit\" value=\"Sacuvaj\" name=\"enter\"><br/>\n";
}
break;

case 'updsvadbi':
$zhenih=trim(htmlspecialchars(stripslashes($zhenih)));
$nevesta=trim(htmlspecialchars(stripslashes($nevesta)));
$frzhenih=trim(htmlspecialchars(stripslashes($frzhenih)));
$frnevesta=trim(htmlspecialchars(stripslashes($frnevesta)));
$day=trim(htmlspecialchars(stripslashes($day)));
$month=trim(htmlspecialchars(stripslashes($month)));
$year=trim(htmlspecialchars(stripslashes($year)));
$chs=trim(htmlspecialchars(stripslashes($chs)));
$min=trim(htmlspecialchars(stripslashes($min)));
if(empty($zhenih)) $error=$error."<u>Не заполнено поле Zених!</u><br/>";
if(empty($nevesta)) $error=$error."<u>Не заполнено поле Невеста!</u><br/>";
if(empty($frzhenih)) $error=$error."<u>Не заполнено поле свидетель Zениха!</u><br/>";
if(empty($frnevesta)) $error=$error."<u>Не заполнено поле свидетельница Zевесты!</u><br/>";
if(empty($day)) $error=$error."<u>Не заполнено поле число!</u><br/>";
if(empty($month)) $error=$error."<u>Не заполнено поле месяц!</u><br/>";
if(empty($year)) $error=$error."<u>Не заполнено поле год!</u><br/>";
if(empty($chs)) $error=$error."<u>Не заполнено поле часов!</u><br/>";
if(empty($min)) $error=$error."<u>Не заполнено поле минут!</u><br/>";

$latuser=strtolower($zhenih);
$ruser = rus_to_k($zhenih);
if($ruser==$zhenih){
$latuser = mysql_escape_string($latuser);
$result = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft from users where latuser = '".$latuser."' and sex='М'"); 
} else {
$ruser = mysql_escape_string($ruser);
$result = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft from users where ruser = '".$ruser."'  and sex='М'");
}
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "<u>Par sa nikom <b>".$zhenih."</b> ne postoji.</u><br/>";
echo $fsize2;
break;
}

$latuser2=strtolower($nevesta);
$ruser2 = rus_to_k($nevesta);
if($ruser2==$nevesta){
$latuser2 = mysql_escape_string($latruser2);
$result = mysql_query ("Select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft from users where latuser = '".$latuser2."' and sex='Z'"); 
} else {
$ruser2 = mysql_escape_string($ruser2);
$result = mysql_query ("select id,user,pass,posts,status,level,credits,gposts,mafcredits,votefoto,byeotv,inv,user_ip,user_soft from users where ruser = '".$ruser2."' and sex='Z'");
}
if (mysql_affected_rows() == 0) {
echo  $fsize1;
echo  "<u>Malada sa nikom <b>".$nevesta."</b> ne postoji.</u><br/>";
echo  $fsize2;
break;
}

if(empty($error)) {
if($zhenih!=$last_svadbi['zhenih']) {
$days="$day.$month.$year";
$times="$chs:$min";
if(mysql_query("insert into svadbi values(0,'".$zhenih."','".$nevesta."','".$frzhenih."','".$frnevesta."','".$days."','".$times."','".$organizatory."');")&&
mysql_query("Update users set para='".$nevesta."' where user ='".$zhenih."'")&&mysql_query("Update users set para='".$zhenih."' where user ='".$nevesta."'")) { 
 $fsize1;
echo  "<b>Svadba dodata!</b><br/>"; 
echo  $fsize2;
} else { 
echo  $fsize1;
echo  $fsize2;
} 
} else { 
echo  $fsize1;
echo  "<b>Svadba ne moze biti udaljena!</b><br/>"; 
echo  $fsize2;
}
} else { 
echo  $fsize1;
echo  $error; 
echo  $fsize2;
}
break;

case 'dsvadbi':
$q = mysql_query("select id,zhenih,nevesta,date from svadbi order by id desc;");
if (mysql_affected_rows() == 0) {
echo $fsize1;
echo "Nije naznacena svadba!!!<br/>\n";
echo $fsize2;
} else {
if(empty($action)) {
while($arr=mysql_fetch_array($q)) {
echo $fsize1;
echo "<a href=\"apanel.php?action=del&amp;$ses&amp;go=dsvadbi&amp;mid=".$arr['id']."$takep\">Svadba ".$arr['zhenih']." &amp; ".$arr['nevesta'].". (".$arr['date'].")</a><br/>";  
echo $fsize2;
}
} else {
settype($mid, 'integer');
if(mysql_query("delete from svadbi where id='".$mid."' limit 1;")){ 
echo $fsize1;
echo "<b>Svadva obrisana!</b><br/>";
echo $fsize2;
}
}
}
break;


case 'import_fraz':
mysql_query("truncate table `bot_dialog`");
$file=file("import/bot_dialog.txt");
for($i=0;$i<count($file);$i++) {
mysql_query("insert into `bot_dialog` values(0,'".$file[$i]."');");
$count = count($file);
}
echo $fsize1;
echo "В базу залито $count Фраз для Клазнета знатоков!";
echo $fsize2;
break;

case 'import_frazi':
mysql_query("truncate table `frazi`");
$file=file("import/frazi.txt");
for($i=0;$i<count($file);$i++) {
mysql_query("insert into `frazi` values(0,'".$file[$i]."');");
$count = count($file);
}
echo $fsize1;
echo "В базу залито $count Фраз для Клазнета знатоков!";
echo $fsize2;
break;

case 'import_shutki':
mysql_query("truncate table `shutki`");
$file=file("import/shutki.txt");
for($i=0;$i<count($file);$i++) {
mysql_query("insert into `shutki` values(0,'".trim($file[$i])."');");
$count = count($file);
}
echo $fsize1;
echo "U bazi $count zezalica!";
echo $fsize2;
break;

case 'import_vopros':
//IZMENI OVO// mysql_query("truncate table `bots`");
$file=file("import/vopros.txt");
for($i=0;$i<count($file);$i++) {
$ex=explode("::",$file[$i]);
$tran=strtr(trim($ex[1]),array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","Z"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ш"=>"w","щ"=>"w","ц"=>"c","ч"=>"4","ь"=>".","ъ"=>".","ы"=>"y","э"=>"e","ю"=>"yu","я"=>"ya","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E","Ё"=>"E","Z"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"H","Ш"=>"W","Щ"=>"W","Ц"=>"C","Ч"=>"4","Ь"=>".","Ъ"=>".","Ы"=>"Y","Э"=>"E","Ю"=>"Yu","Я"=>"Ya"));
@mysql_query ("Select * from bots");
$k = mysql_affected_rows()+1;
mysql_query ("Insert into bots set number= '".$k."', vopros='".trim($ex[0])."', answer='".trim($ex[1])."',  tran='".$tran."'");
$count = count($file);
}
echo $fsize1;
echo "U bazi $count Pitanja!";
echo $fsize2;
break;

case 'import_anekdot':
mysql_query("truncate table `anekdot`");
$file=file("import/anekdot.txt");
for($i=0;$i<count($file);$i++) {
mysql_query("insert into `anekdot` values(0,'".trim($file[$i])."','6');");
$count = count($file);
}
echo $fsize1;
echo "Ukupnо $count аnegdota!";
echo $fsize2;
break;

case 'delsmiles':
if($row["level"]==6){
$q = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM smilies WHERE id='".$kod."'"));
if ($q[0]==0) {
echo $fsize1;
echo "Ovaj smajli ne postoji!<br/>\n";
echo $fsize2;
} else {
if(mysql_query("DELETE FROM smilies WHERE id='".$kod."'")){ 
echo $fsize1;
echo "Smajli je obrisan!<br/>";
echo $fsize2;
}
}
}else{
echo "Ne mozete brisati smajli!";
}
break;

}
echo $fsize1;
echo $divide;
if($go) echo "<a href=\"apanel.php?$ses$takep\">Admin CP</a><br/>\n"; 
if (isset ($rm)) echo "<a href=\"chat.php?$ses&amp;rm=$rm&amp;ref=$ref\">Chat Soba</a><br/>\n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";



mysql_close ($link);
ob_end_flush();
?>
