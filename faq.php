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


$level=$userData['level'];
$posts=$userData['posts'];

$bot1=mysql_fetch_array(mysql_query("Select user from ".TABLE_PREFIX."users where id='1' LIMIT 1;"));
$bot2=mysql_fetch_array(mysql_query("Select user from ".TABLE_PREFIX."users where id='2' LIMIT 1;"));
$bot3=mysql_fetch_array(mysql_query("Select user from ".TABLE_PREFIX."users where id='3' LIMIT 1;"));
$bot4=mysql_fetch_array(mysql_query("Select user from ".TABLE_PREFIX."users where id='4' LIMIT 1;"));
$bot5=mysql_fetch_array(mysql_query("Select user from ".TABLE_PREFIX."users where id='5' LIMIT 1;"));
$bot6=mysql_fetch_array(mysql_query("Select user from ".TABLE_PREFIX."users where id='6' LIMIT 1;"));
$bot7=mysql_fetch_array(mysql_query("Select user from ".TABLE_PREFIX."users where id='7' LIMIT 1;"));
$bot8=mysql_fetch_array(mysql_query("Select user from ".TABLE_PREFIX."users where id='8' LIMIT 1;"));

echo edyka_head("FAQ",$userData);
switch($mod) {

default:

echo "F.A.Q.:<br/>";
echo $divide;
echo "1. <a href=\"faq.php?$ses&amp;mod=1\">[Opsta Pravila]</a><br/>"; 
//echo "2. <a href=\"faq.php?$ses&amp;mod=2\">[Smajliji]</a><br/>";
//echo "3. <a href=\"faq.php?$ses&amp;mod=3\">[ Pravila translita ]</a><br/>"; 
echo "3. <a href=\"faq.php?$ses&amp;mod=4\">[Ignor Lista]</a><br/>"; 
echo "4. <a href=\"faq.php?$ses&amp;mod=5\">[Lista Prijatelja]</a><br/>"; 
echo "5. <a href=\"faq.php?$ses&amp;mod=6\">[Pisma/Inbox]</a><br/>"; 
echo "6. <a href=\"faq.php?$ses&amp;mod=7\">[Statusi]</a><br/>"; 
echo "7. <a href=\"faq.php?$ses&amp;mod=8\">[Link Chata]</a><br/>"; 
echo "8. <a href=\"faq.php?$ses&amp;mod=9\">[Moderator?]</a><br/>"; 
echo "9. <a href=\"faq.php?$ses&amp;mod=10\">[Kviz]</a><br/>";
echo "10. <a href=\"faq.php?$ses&amp;mod=11\">[Intimna Soba]</a><br/>";  
echo $divide;
echo "<a href=\"faq.php?$ses&amp;s=$next&amp;mod=def2\">&gt;&gt;&gt;</a><br/>\n";
break;

case 'def2':


echo "F.A.Q.:<br/>";
echo $divide;
echo "11. <a href=\"faq.php?$ses&amp;mod=12\">[Ludnica]</a><br/>"; 
echo "12а. <a href=\"faq.php?$ses&amp;mod=13-1\">[Kako ubaciti sliku?]</a><br/>"; 
echo "12б. <a href=\"faq.php?$ses&amp;mod=13-2\">[Kako ubaciti smajli?]</a><br/>"; 
echo "13. <a href=\"faq.php?$ses&amp;mod=14\">[Kako uci sa kompjutera?]</a><br/>"; 
echo "14. <a href=\"faq.php?$ses&amp;mod=15\">[Linkovi]</a><br/>"; 
echo "15. <a href=\"faq.php?$ses&amp;mod=16\">[Precice na chatu]</a><br/>"; 
echo "16. <a href=\"faq.php?$ses&amp;mod=17\">[Filter Poruka]</a><br/>"; 
echo "17. <a href=\"faq.php?$ses&amp;mod=18\">[Podesavanja]</a><br/>"; 
echo "18. <a href=\"faq.php?$ses&amp;mod=19\">[Sistem]</a><br/>"; 
echo "19. <a href=\"faq.php?$ses&amp;mod=20\">[Najcesce Greske]</a><br/>"; 
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=def3\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=def1\">&lt;&lt;&lt;</a><br/>\n";
break;

case 'def3':


echo "F.A.Q.:<br/>";
echo $divide;
echo "20. <a href=\"faq.php?$ses&amp;mod=21\">[Bookmark]</a><br/>"; 
echo "21. <a href=\"faq.php?$ses&amp;mod=22\">[Online]</a><br/>"; 
echo "22. <a href=\"faq.php?$ses&amp;mod=23\">[Greske Chata???]</a><br/>"; 
echo "23. <a href=\"faq.php?$ses&amp;mod=24\">[Kontakt sa Adminom]</a><br/>"; 
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=def2\">&lt;&lt;&lt;</a><br/>\n";
break;

case '1':


echo "<b>Najcesci razlozi za kaznu:</b><br/>";
echo $divide;
echo "1. Ukoliko se budete glupirali i pisali gluposti!. Ukoliko to stvarno zelite da radite predjite u Ludnicu!<br/>";
echo "2. Ometanje drugih chatera!<br/>";
echo "3. Medjunacionalne rasprave (fasizam, nacionalizam, sovinizam...)!<br/>";
echo "4. Fludovanje (ucestalo kucanje bezpotrebnog teksta )!<br/>";
echo "5. &quot;Organizovanje&quot; nepotrebnih rasprava na chatu!<br/>";
echo "6. Nepostovanje Admina i modera!<br/>";
echo "7. Dejstvo Moderatora koje se ne poklapa sa odlukom Administracije!<br/>";
echo "8. Reklama drugih linkova!<br/>";
echo "9. Neprestano kucanje VELIKIH  slova bez razloga!<br/>";
echo "10. Zabranjeno je samostalno trazenje funkcije, jer time sticete manje sansi za unapredjenje!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=4\">&gt;&gt;&gt;</a><br/>\n";
break;

case '4':


echo "<b>Ignor:</b><br/>";
echo $divide;
echo "Ova funcija sluzi za blokadu nika koji vam smeta! Ako vam neko dosadjuje najbolje resenje je da ga stavite na Ignor Listu i samim tim od njega vise necete dobijati poruke, a ni pisma! Kroz neko vreme mu mozete ponovo vratiti pristup!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=5\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=1\">&lt;&lt;&lt;</a><br/>\n";
break;

case '5':


echo "<b>Drugari:</b><br/>";
echo $divide;
echo "Ova funkcija je idealna za sakuplanje drugara! Nick koji zelite mozete lako staviti u vasu Listu Prijatelja! U svakom trenutku u hodniku mozete videti njihovo kretanje u Trazi Prijatelje, a imate i mogucnost slanja pisama svima od jednom!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=6\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=4\">&lt;&lt;&lt;</a><br/>\n";
break;

case '6':


echo "<b>Pisma:</b><br/>";
echo $divide;
echo "Pisma predstavlaju vasu razmenu poruka! Glavna prednost je sto vi u svako trenutku mozete biti obavesteni da vam je stiglo novo pismo! Nova pisma ce vam biti markirana! U pismima mozete koristiti i smajlije! Mozete poslati i vise pisama od jednom kada kliknete na slanje svim drugarima! Prilikom slanja umesto nika mozete staviti ID korisnika!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=7\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=5\">&lt;&lt;&lt;</a><br/>\n";
break;

case '7':


echo "<b>Statusi:</b><br/>";
echo $divide;
echo "Prilikom kuckanja u chat sobi doci ce i do povecanja vasih postova, a samim tim i do menjanja vaseg statusa! Sto vise postova ostvarite dobice te bolji status! Kada ostvarite odredjeni broj postova imacete mogucnost da u svom kabinetu birate status po zelji i da aktivirate nevidljivost!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=8\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=6\">&lt;&lt;&lt;</a><br/>\n";
break;

case '8':

$adresasajta=chatSet("cadres");
echo "<b>Link Chata:</b><br/>";
echo $divide;
echo "Adresa Chata je: http://$adresasajta<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=9\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=7\">&lt;&lt;&lt;</a><br/>\n";
break;

case '9':


echo "<b>Kako postati moderator?</b><br/>";
echo $divide;
echo "Nikako... To vam je najlakse objasnjenje i ne trazite od Admina da vam daju funkciju jer oni bas i ne vole kad i neko trazi i lako vas mogu staviti na ignor! Admini dele funkcije po sopstvenoj zelji i ponekada nije presudna dobra statistika odredjenog chatera!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=10\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=8\">&lt;&lt;&lt;</a><br/>\n";
break;

case '10':


echo "<b>Kviz:</b><br/>";
echo $divide;
echo "U ovoj sobi uvek kada imate vremena mozete testirati vase znanje! Tu ce vas uvek cekati ljubazna osoba koja ce vam postavljati pitanja! Ukoliko ponekad ne mozete odgovoriti ona ce vam pruziti pomoc u vidu ponudjenih slova! Odgovore pisite malim slovima, ali pazite da je prvo slovo uvek veliko! Top-10 najpametnijih mozete pogledati u statistici! Mozete koristiti i sifru <b>stats nick</b> gde cete videti statistiku odredjenog chatera, ali i ubrzati pitanje kad upisete <b>!pitanje</b> !<br/>\n";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=11\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=9\">&lt;&lt;&lt;</a><br/>\n";
break;

case '11':


echo "<b>Intimna Soba:</b><br/>";
echo $divide;
echo "Intimna soba predstavlja specijalnu sobu za dopisivanje u 4 oka! Ukoliko zelite da vam niko ne smeta u dopisivanju sa odredjenom osobom, onda je ovo pravo mesto za vas! Dogovorite se sa osobom kojom zelite da se dopisujete ili sa vise njih, odredite kljuc za logovanje i upadajte! Svaki put kada ulazite odaberite zeljeni kljuc za logovanje! Kljuc mozete menjati po zelji!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=12\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=10\">&lt;&lt;&lt;</a><br/>\n";
break;

case '12':


echo "<b>Ludnica:</b><br/>";
echo $divide;
echo "Ovo je specijalna soba za osobe koje malo vise zele da se glupiraju! Ovde Administracija nema mogucnost kikovanja i banovanja. Jedino ste tu sigurni da vas niko nece kikovati ili banovati! Osobama koje se lako nerviraju predlazemo da ovu sobu izbegavaju!<br/>";  
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=13-1\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=11\">&lt;&lt;&lt;</a><br/>\n";
break;

case '13-1':


echo "<b>Kako ubaciti sliku?</b><br/>";
echo $divide;
echo "Iz hodnika mozete uci u Licni Kabinet gde cete naci opciju Uploaduj Sliku! Ukoliko ste sliku vec negde ubaciti i imate njenu adresu, mozete je prekopirati preko opcije Ubaci Sliku! Imate mogucnost ubacivanja slike direktno sa vaseg telefona! Vodite racuna da slika bude primerna i da bude licna slika!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=13-2\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=12\">&lt;&lt;&lt;</a><br/>\n";
break;

case '13-2':


echo "<b>Licni smajli</b><br/>";
echo $divide;
echo "Smajli mozete ubaciti u Licnom Kabinetu! Smajli mozete ubaciti, ako znate njegovu adresu! A mozete ga i uploadovati ili izabrati sa datog spiska!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=14\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=13-1\">&lt;&lt;&lt;</a><br/>\n";
break;

case '14':


echo "<b>Kako chatovati sa kompjutera?</b><br/>";
echo $divide;
$adresasajta=chatSet("cadres");
$nazivsajta=chatSet("ctitle");
echo "Na internetu postoje mnogobrojni browseri preko kojih se moze uci na $nazivsajta Chat. Preko Internet Explorera koristite html verziju chata! A takodje mozete koristiti i browser OPERA koji je idealan za obe verzije, a mozete je skinuti na adresi http://www.opera.com i kad to uradite i instalirate ukucajte adresu http://$adresasajta i uzivajte!!!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=15\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=13-2\">&lt;&lt;&lt;</a><br/>\n";
break;

case '15':


echo "<b>Linkovi:</b><br/>";
echo $divide;
echo "Reklamiranje ostalih WAP ili WEB adresa je strogo zabranjeno i najstroze kaznjeno! Reklamiranje vas moze kostati trajnog izbacivanja sa chata!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=16\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=14\">&lt;&lt;&lt;</a><br/>\n";
break;

case '16':


echo "<b>Chat-precice:</b><br/>";
echo $divide;
echo "U Licnom Kabinetu imate stranu pod nazivom Precice(Dugmad) gde mozete menjati vase precice na chatu! One Vam olaksavaju pristup nekim opcijama!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=17\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=15\">&lt;&lt;&lt;</a><br/>\n";
break;

case '17':


echo "<b>Filter poruka</b><br/>";
echo $divide;
echo "Filter sluzi za menjanje prikaza poruka u sobama, ako je ukljucen vidite samo vase poruke, a ako je iskljucen vidite sve poruke!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=18\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=16\">&lt;&lt;&lt;</a><br/>\n";
break;

case '18':


echo "<b>Podesavanja:</b><br/>";
echo $divide;
echo "U Licnom kabinetu imate mogucnost izmene vaseg profila, Liste Prijatelja, Ignor Liste i mnogo drugog...<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=19\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=17\">&lt;&lt;&lt;</a><br/>\n";
break;

case '19':


echo "<b>Sistem:</b><br/>";
echo $divide;
echo "Na chatu postoji nekoliko sistemskih nikova -Sistem-, -Profesorka-, -Konobarica-, -Policajac-. Svako od njih ima svoju funkciju sto cete se i sami uveriti na chatu!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=20\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=18\">&lt;&lt;&lt;</a><br/>\n";
break;

case '20':


echo "<b>Greske:</b><br/>";
echo $divide;
echo "a) Ne mogu uci u sobu? Resenje: Najverovatnije ste stavili preveliki broj postova po strani, preporucujemo 8 ili 10 , a to menjate u Licnom Kabinetu! b) Vidim samo svoje poruke? Resenje: Ukljucen vam je filter! Iskljucite ga!<br/>"; 
echo $divide;
echo "Ukoliko imate dodatnih problema obratite se administraciji!"; 
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=21\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=19\">&lt;&lt;&lt;</a><br/>\n";
break;

case '21':


echo "<b>Bookmark:</b><br/>";
echo $divide;
echo "Kada se logujete u Chat Sobu i odete u Hodnik ili bilo gde na chatu mozete sacuvati adresu u vas bookmark da se ne bi non-stop logovali!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=22\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=20\">&lt;&lt;&lt;</a><br/>\n";
break;

case '22':


echo "<b>Online</b><br/>";
echo $divide;
echo "Ove opcije sluze da vidite ko se trenuno nalazi na chatu! Opcija Online(soba) sluzi za prikaz korisnika u sobi, a opcija Online prikazuje sve chatere koji su online!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=23\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=21\">&lt;&lt;&lt;</a><br/>\n";
break;

case '23':


echo "<b>Sta nedostaje chatu?</b><br/>";
echo $divide;
echo "Ukoliko imate neki dobar predlog za izmenu chata ili vasu pomoc mozete nam se obratiti preko pisama!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=24\">&gt;&gt;&gt;</a><br/>\n";
echo "<a href=\"faq.php?$ses&amp;mod=22\">&lt;&lt;&lt;</a><br/>\n";
break;

case '24':


echo "<b>Kontakt sa adminom?</b><br/>";
echo $divide;
echo "Ukoliko zelite kontaktirati Administraciju mozete se obrathti preko pisama  nekome od administracije, ali imajte dobar razlog!<br/>";
echo $divide;
echo "<a href=\"faq.php?$ses&amp;mod=23\">&lt;&lt;&lt;</a><br/>\n";
break;

case 'vict_kom':
if ($ver=="wml") echo "<p align=\"center\">";
else echo "<div align=\"center\">";

echo "<b>Komande:</b><br/>";
echo "<b>1)</b><u>!vopros</u> - Postavljanje pitanja.</b><br/>";
echo "<b>2)</b><u>stats nick</u> - Status u kvizu.</b><br/>";
break;
}
echo $divide;
if($mod) echo "<a href=\"faq.php?$ses&amp;ref=$ref\">F.A.Q.</a><br/>";
if(isset ($rm))echo "<a href=\"chat.php?$ses&amp;rm=$rm$takep\">Chat Soba</a><br/>"; 
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>";


echo edyka_foot($divide);
mysql_close ($link);
?>