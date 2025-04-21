<?
include("gz.php");
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");
$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

$us=$row["user"];
///////////////////////////////////////////
$gde="Podesavanja";
include("gde.php");
///////////////////////////////////////////
if(!isset($go)){
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"buttoms\" title=\"Dodatna Dugmad\">\n";
echo "<p>\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Dodatna Dugmad</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">";
echo "<form method=\"POST\" action=\"buttons.php?$ses&amp;go=rew&amp;ref=$ref\" name=\"auth\">\n";
}
echo "Dodatna Dugmad:<br/>\n";
echo $fsize1;
echo $divide;
echo "Refresh:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_update\">\n";
if($row["kn_update"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Napisi:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_say\">\n";
if($row["kn_say"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Pisma:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_letters\">\n";
if($row["kn_letters"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Online:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_whochat\">\n";
if($row["kn_whochat"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Online(soba):<br/>\n";
echo $fsize2;
echo "<select name=\"kn_whoroom\">\n";
if($row["kn_whoroom"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Filter(Privatne):<br/>\n";
echo $fsize2;
echo "<select name=\"kn_privat\">\n";
if($row["kn_whoroom"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Hodnik:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_holl\">\n";
if($row["kn_holl"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Statistika:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_stats\">\n";
if($row["kn_stats"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Timovi:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_kommands\">\n";
if($row["kn_kommands"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
echo $fsize1;
echo "Kupi Odgovor:<br/>\n";
echo $fsize2;
echo "<select name=\"trade\">\n";
if($row["trade"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
if($row["level"]>3) {
echo $fsize1;
echo "Topik:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_topic\">\n";
if($row["kn_topic"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
}
echo $fsize1;
echo "Raspolozenje:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_nood\">\n";
if($row["kn_nood"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
if($row["level"]<4) {
echo $fsize1;
echo "Poziv Moda:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_sos\">\n";
if($row["kn_sos"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
}
echo $fsize1;
echo "Licni Kabinet:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_cabinet\">\n";
if($row["kn_cabinet"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
if($row["level"]>3) {
echo $fsize1;
echo "Ciscenje Soba:<br/>\n";
echo $fsize2;
echo "<select name=\"kn_clroom\">\n";
if($row["kn_clroom"] == 0){
echo "<option value=\"0\">Ukljuceno</option>\n";
echo "<option value=\"1\">Iskljuceno</option>\n";
} else {
echo "<option value=\"1\">Iskljuceno</option>\n";
echo "<option value=\"0\">Ukljuceno</option>\n";
}
echo "</select><br/>\n";
}
if ($ver=="wml"){
echo $fsize1;
echo "<anchor title=\"go\">Izmeni<go href=\"buttons.php?$ses&amp;go=rew&amp;ref=$ref\" method=\"post\">\n";
echo "<postfield name=\"kn_say\" value=\"$(kn_say)\"/>\n";
echo "<postfield name=\"kn_update\" value=\"$(kn_update)\"/>\n";
echo "<postfield name=\"kn_letters\" value=\"$(kn_letters)\"/>\n";
echo "<postfield name=\"kn_whochat\" value=\"$(kn_whochat)\"/>\n";
echo "<postfield name=\"kn_whoroom\" value=\"$(kn_whoroom)\"/>\n";
echo "<postfield name=\"kn_holl\" value=\"$(kn_holl)\"/>\n";
echo "<postfield name=\"kn_stats\" value=\"$(kn_stats)\"/>\n";
echo "<postfield name=\"kn_kommands\" value=\"$(kn_kommands)\"/>\n";
echo "<postfield name=\"trade\" value=\"$(trade)\"/>\n";
if($row["level"]>3)echo "<postfield name=\"kn_topic\" value=\"$(kn_topic)\"/>\n";
echo "<postfield name=\"kn_nood\" value=\"$(kn_nood)\"/>\n";
if($row["level"]<4)echo "<postfield name=\"kn_sos\" value=\"$(kn_sos)\"/>\n";
echo "<postfield name=\"kn_cabinet\" value=\"$(kn_cabinet)\"/>\n";
if($row["level"]>3)echo "<postfield name=\"kn_clroom\" value=\"$(kn_clroom)\"/>\n";
echo "<postfield name=\"kn_privat\" value=\"$(kn_privat)\"/>\n";
echo "</go></anchor>\n";
echo $fsize2;
echo "<br/>\n";
}else{
echo "<input type=\"submit\" value=\"Izmeni\" name=\"enter\"><br/>\n";
}
echo $fsize1;
echo $divide;
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a>\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
mysql_close ($link);
exit;
}
        if($row["level"]<4) $kn_topic = $row["kn_topic"];
        if($row["level"]>3) $kn_sos = $row["kn_sos"];
		if($row["level"]<4) $kn_clroom = $row["kn_clroom"];
	    $emp="Greska!!!";
        if(!preg_match("!^[0-9]+$!i",$kn_say)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_update)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_letters)){$error = $emp;}
        elseif(!preg_match("!^[0-9]+$!i",$kn_whochat)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_whoroom)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_holl)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_stats)){$error = $emp;}
        elseif(!preg_match("!^[0-9]+$!i",$kn_kommands)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$trade)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_cabinet)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_clroom)){$error = $emp;}
        elseif(!preg_match("!^[0-9]+$!i",$kn_privat)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_nood)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_topic)){$error = $emp;}
		elseif(!preg_match("!^[0-9]+$!i",$kn_sos )){$error = $emp;}

			 if (!isset($error)) {
            $result = mysql_query ("Select * users where id = '".$id."'");
            if (mysql_affected_rows() == 0) {
                $error = "database error...";
            } else {
   $ins_str = "Update users set kn_say ='".$kn_say."', kn_update='".$kn_update."', kn_letters='".$kn_letters."', kn_whochat='".$kn_whochat."', kn_whoroom='".$kn_whoroom."', kn_holl='".$kn_holl."', kn_stats='".$kn_stats."', kn_kommands='".$kn_kommands."', trade='".$trade."', kn_topic='".$kn_topic."', kn_nood='".$kn_nood."', kn_sos='".$kn_sos."', kn_cabinet='".$kn_cabinet."', kn_clroom='".$kn_clroom."', kn_privat='".$kn_privat."' where id ='".$id."'";
            }
    if (mysql_query ($ins_str)) {
     $msg = "Podesavanja su uspesno izmenjena!";

                } else {
                    $error = " ".mysql_error()." ";
                }
                }

mysql_close($link);

if (isset($error)) {
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Greska!!!\" ontimer=\"buttons.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<do type=\"prev\" label=\"Back\"><prev/></do>\n";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Greska!!!</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=buttons.php?$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<b>$error</b>\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
exit;
}
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"ok\" title=\"Dodatna Dugmad\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"10\"/>\n";
echo "<p align=\"center\">";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"".$row["css"]."\">";
echo "<title>Dodatna Dugmad</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=enter.php?$ses&amp;ref=$ref\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "<b>$msg</b><br/>\n";
echo $fsize2;
include("gzip.php");
if ($ver=="wml")echo "</p></card></wml>\n";
else echo "</div></body></html>\n";
?>