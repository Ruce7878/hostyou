<?
if ($ver=="wml"){

echo"<a href=\"http://$url\">$url</a>";

$Contents = ob_get_contents();
$gzib_file = strlen($Contents);


if ($support_deflate) {
$gzib_file_out = strlen(gzdeflate($Contents,9));
} else{
if($support_gzip){
$gzib_file_out = strlen(gzencode($Contents,9));
} else {
if($support_x_gzip){
$gzib_file_out = strlen(gzcompress($Contents,9));
}else {
$gzib_file_out = strlen($Contents);
}}}

$gzib_pro=round(100-(100/($gzib_file/$gzib_file_out)),1);
if($gzib_pro > 0 && $gzib_pro < 100){
echo '<br/><small>Ucitano: '.$gzib_pro.'% </small>';}
/*
echo"<br/><small>Verzija:<br/>";
echo "<a href=\"?id=$id&amp;ps=$ps&amp;ref=$ref&amp;ver=wml&amp;url=$url\">WML</a>\n|\n";
echo "<a href=\"?id=$id&amp;ps=$ps&amp;ref=$ref&amp;ver=xhtml&amp;url=$url\">XHTML</a><br/>";
echo "$url";
echo "</small>\n";*/
} else {

$Contents = ob_get_contents();
$gzib_file = strlen($Contents);


if ($support_deflate) {
$gzib_file_out = strlen(gzdeflate($Contents,9));
} else{
if($support_gzip){
$gzib_file_out = strlen(gzencode($Contents,9));
} else {
if($support_x_gzip){
$gzib_file_out = strlen(gzcompress($Contents,9));
}else {
$gzib_file_out = strlen($Contents);
}}}

$gzib_pro=round(100-(100/($gzib_file/$gzib_file_out)),1);
if($gzib_pro > 0 && $gzib_pro < 100){
echo '<br/><small>Ucitano: '.$gzib_pro.'% </small>';}


/*
echo"<br/><a href=\"http://$url\">$url</a></div><div class='foot'>";
echo"<a href=\"mailadmin.php?$ses&amp;ref=$ref&amp;url=$url\">[Kontakt]</a><br/><small>Verzija:<br/>";
echo "<a href=\"?id=$id&amp;ps=$ps&amp;ref=$ref&amp;ver=wml&amp;url=$url\">WML</a>\n|\n";
echo "<a href=\"?id=$id&amp;ps=$ps&amp;ref=$ref&amp;ver=xhtml&amp;url=$url\">XHTML</a><br/>";
echo "$url";
echo "</small></div>\n";
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";*/
}
mysql_close ($link);
?>