<?php

list($msec,$sec)=explode(chr(32),microtime());
$HeadTime=$sec+$msec;

header ("Content-type:text/vnd.wap.wml; charset=utf-8");
print "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
print '<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN"
"http://www.wapforum.org/DTD/wml_1.1.xml">
<wml><head><meta http-equiv="Cache-Control" content="no-cache" forua="true"/></head>
<card id="index" title="Кalkulator Braka">
<p align="center">
<small>Каlkulator Braka</small><br/>
Izracunajte koliko izmedju vas i partnera bi imali uspesan brak
Vase ime:<br/>
<input name="name" title="Имя"/><br/>
Ime partnera:<br/>
<input name="partner" title="Имя"/><br/>
<a href="rez.php">Izracunaj</a><br/>
<a href="http://zamakljubavi.com">Pocetna</a><br/>';

list($msec,$sec)=explode(chr(32),microtime());
echo "[".round(($sec+$msec)-$HeadTime,4)."]";

print '
</small></p>
</card>
</wml>';

?>
