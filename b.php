<?php  include("gz.php");

header("Content-type:text/vnd.wap.wml");
print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
print "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.2//EN\" \"http://www.wapforum.org/DTD/wml12.dtd\">";
print"<wml><card id=\"err1\" title=\"Znak Chat\" ontimer=\"index.php\">
<timer value=\"30\"/><p align=\"center\">
<b>Banovani ste!</b><br/>
<br/><br/><a href=\"index.php\">Pocetna</a><br/>
</p></card></wml>";
?>
