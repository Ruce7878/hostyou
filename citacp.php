<?
header("Cache-Control: no-cache");
if ($ver=="wml")header ("Content-type:text/vnd.wap.wml; charset=utf-8");
else header("Content-Type:text/html; charset=UTF-8");

require("inc.php");

if (isset($rm)) $takep="&amp;rm=$rm&amp;ref=$ref";
else $takep="&amp;ref=$ref";

$link = connect_db();
list($row, $id, $ps, $fsize1, $fsize2) = check_login($link);
require("version.php");

if($row["level"] < 8) {
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<card id=\"error\" title=\"Ошибка доступа\" ontimer=\"enter.php?$ses&amp;ref=$ref\"><timer value=\"15\"/>";
echo "<p align=\"center\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
echo "<title>*Greshka pri pristupu*</title>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=enter.php?$ses$takep\">";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"center\">";
}
echo $fsize1;
echo "*Wi nemate prawo pristupa owde*!!!\n";
echo $fsize1;
if ($ver=="wml")echo "</p></card></wml>";
else echo "</div></body></html>";
mysql_close ($link);
exit;
}

ob_start();
if ($ver=="wml"){
echo $xml;
echo $dtd;
echo "<wml>\n";
echo "<head><meta http-equiv=\"Cache-Control\" content=\"no-cache\" forua=\"true\"/></head>\n";
echo "<card id=\"apanel\" title=\"*Admin CP*\">\n";
echo "<p mode=\"wrap\">\n";
}else{
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/css.css\"/>";
echo "<title>*Admin CP*</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/></head><body>";
echo "<div align=\"left\">";
}

switch($mod) {
case 'pwt':

echo $fsize1;
echo "<b>Vide se PWT postovi</b><br/>";
echo $divide;
echo "<a href=\"citacp.php?mod=go&amp;$ses&amp;rms=".$rms."$takep\">Vidi SVE poruke</a><br/>";
echo $divide;

$roomg = intval($_GET['rms']);
if (empty($_GET['rms'])){ $roomg = 0; }
$roomg = check($roomg);


    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT count(`klu4`) FROM `room".$roomg."` WHERE towhom!=''"));
    $num_items = $noi[0]; //changable
    $items_per_page= 15;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;


$resultx=mysql_query("SELECT `time`,`message`,`id`,`towhom`,`usid`,`komu`,`who` FROM `room".$roomg."` WHERE towhom!='' ORDER BY id DESC LIMIT $limit_start, $items_per_page;");

echo mysql_error();
if(mysql_num_rows($resultx)>0)
{
    while ($row = mysql_fetch_array($resultx))
    {
		$time = $row[0];
		$message = $row[1];
		//$id = $row[2];
		$towhom = $row[3];
		$usid= $row[4];
		$komu = $row[5];
		$who = $row[6];
		
		$rs=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$towhom."';");
		$rowx = mysql_fetch_array($rs);
		$komu = $rowx[0];

		if($towhom!=""){$privat = "[!!!]";}
		if($towhom==""){$privat = "";}

		echo'['.$time .']<b>'.$who.'</b><small>-('.$komu.')- <b>'.$privat.'</b>'.$message.'</small><br/><br/>';
	}
} else 	echo "<br/><b>Trenutno nema postova!</b><br/>";

   if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<br/><a href=\"citacp.php?mod=pwt&amp;rms=$roomg&amp;$ses&amp;page=$npage\">Napred&#187;</a>";
    }
    if($page>1)
    {
      $ppage = $page-1;
      echo "<br/><a href=\"citacp.php?mod=pwt&amp;rms=$roomg&amp;$ses&amp;page=$ppage\">&#171;Nazad</a> ";
    }
	
    echo "<br/>$page/$num_pages<br/>";
	
		if ($ver==wml){
    if($num_pages>2)
    {
        $rets = "Idi na stranicu<input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[idi]";
        $rets .= "<go href=\"citacp.php\" method=\"get\">";
		$rets .= "<postfield name=\"mod\" value=\"$mod\"/>";
		$rets .= "<postfield name=\"rms\" value=\"$rms\"/>";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
		$rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
        $rets .= "</go></anchor><br/>";

        echo $rets;
    }
	} else {
	 if($num_pages>2)
    {
	 
	    $rets = "<form action=\"citacp.php\" method=\"get\">";
        $rets .= "Idi na stranicu<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
		$rets .= "<input type=\"hidden\" name=\"mod\" value=\"$mod\"/>";
		$rets .= "<input type=\"hidden\" name=\"rms\" value=\"$rms\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
		$rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
		$rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
		$rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "</form>"; 
		
	 echo $rets;
    }
	}

break;
#############################################################################


case 'go':

echo $fsize1;
echo "<b>Vide se svi postovi</b><br/>";
echo $divide;
echo "<a href=\"citacp.php?mod=pwt&amp;$ses&amp;rms=".$rms."$takep\">Vidi samo PWT poruke</a><br/>";
echo $divide;

$roomg = intval($_GET['rms']);
if (empty($_GET['rms'])){ $roomg = 0; }
$roomg = check($roomg);

    if($page=="" || $page<=0)$page=1;
    $noi = mysql_fetch_array(mysql_query("SELECT count(`klu4`) FROM `room".$roomg."`"));
    $num_items = $noi[0]; //changable
    $items_per_page= 15;
    $num_pages = ceil($num_items/$items_per_page);
    if(($page>$num_pages)&&$page!=1)$page= $num_pages;
    $limit_start = ($page-1)*$items_per_page;


$resultx=mysql_query("SELECT `time`,`message`,`id`,`towhom`,`usid`,`komu`,`who` FROM `room".$roomg."` ORDER BY id DESC LIMIT $limit_start, $items_per_page;");



echo mysql_error();
if(mysql_num_rows($resultx)>0)
{
    while ($row = mysql_fetch_array($resultx))
    {
		$time = $row[0];
		$message = $row[1];
		//$id = $row[2];
		$towhom = $row[3];
		$usid= $row[4];
		$komu = $row[5];
		$who = $row[6];
		
		$rs=mysql_query("SELECT `user` FROM `users` WHERE `id`='".$towhom."';");
		$rowx = mysql_fetch_array($rs);
		$komu = $rowx[0];

		if($towhom!=""){$privat = "[!!!]";}
		if($towhom==""){$privat = "";}

		echo'['.$time .']<b>'.$who.'</b><small>('.$komu.') <b>'.$privat.'</b>'.$message.'</small><br/><br/>';
	}
} else 	echo "<br/><b>Trenutno nema postova!</b><br/>";

   if($page<$num_pages)
    {
      $npage = $page+1;
      echo "<br/><a href=\"citacp.php?mod=go&amp;rms=$roomg&amp;$ses&amp;page=$npage\">Napred&#187;</a>";
    }
    if($page>1)
    {
      $ppage = $page-1;
      echo "<br/><a href=\"citacp.php?mod=go&amp;rms=$roomg&amp;$ses&amp;page=$ppage\">&#171;Nazad</a> ";
    }
	
    echo "<br/>$page/$num_pages<br/>";
	
		if ($ver==wml){
    if($num_pages>2)
    {
        $rets = "Idi na stranicu<input name=\"pg\" format=\"*N\" size=\"3\"/>";
        $rets .= "<anchor>[idi]";
        $rets .= "<go href=\"citacp.php\" method=\"get\">";
		$rets .= "<postfield name=\"rms\" value=\"$rms\"/>";
        $rets .= "<postfield name=\"ver\" value=\"$ver\"/>";
        $rets .= "<postfield name=\"id\" value=\"$id\"/>";
		$rets .= "<postfield name=\"ps\" value=\"$ps\"/>";
		$rets .= "<postfield name=\"ref\" value=\"$ref\"/>";
		$rets .= "<postfield name=\"mod\" value=\"$mod\"/>";
        $rets .= "<postfield name=\"page\" value=\"$(pg)\"/>";
        $rets .= "</go></anchor><br/>";

        echo $rets;
    }
	} else {
	 if($num_pages>2)
    {
	 
	    $rets = "<form action=\"citacp.php\" method=\"get\">";
        $rets .= "Idi na stranicu<input name=\"page\" format=\"*N\" size=\"3\"/>";
        $rets .= "<input type=\"submit\" value=\"GO\"/>";
		$rets .= "<input type=\"hidden\" name=\"rms\" value=\"$rms\"/>";
        $rets .= "<input type=\"hidden\" name=\"mod\" value=\"$mod\"/>";
        $rets .= "<input type=\"hidden\" name=\"ver\" value=\"$ver\"/>";
		$rets .= "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
		$rets .= "<input type=\"hidden\" name=\"ps\" value=\"$ps\"/>";
		$rets .= "<input type=\"hidden\" name=\"ref\" value=\"$ref\"/>";
        $rets .= "</form>"; 
		
	 echo $rets;
    }
	}

break;


default:

$q = mysql_query("select rm,name from rooms WHERE rm!='10';");

echo"Izaberi sobu za shpijunazu:<br/>";

while($arr=mysql_fetch_array($q)) {
echo $fsize1;
//if(($arr['rm']==5)&&($id==11)) echo "<a href=\"citacp.php?mod=go&amp;$ses&amp;rms=".$arr['rm']."$takep\">".$arr['rm'].". ".$arr['name']."</a><br/>";
//elseif ($arr['rm']!=5) echo "<a href=\"citacp.php?mod=go&amp;$ses&amp;rms=".$arr['rm']."$takep\">".$arr['rm'].". ".$arr['name']."</a><br/>";
echo "<a href=\"citacp.php?mod=go&amp;$ses&amp;rms=".$arr['rm']."$takep\">".$arr['rm'].". ".$arr['name']."</a><br/>";
echo $fsize2;
}

break;
}
echo "<br/>\n";
echo $divide;
echo "<a href=\"citacp.php?$ses&amp;ref=$ref\">Listing Soba</a><br/>\n";
echo "<a href=\"apanel.php?$ses&amp;ref=$ref\">Admin CP</a><br/>\n";
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>\n";
echo $fsize2;
if ($ver=="wml")echo "</p></card></wml>";
else if ($ver=="xhtml") echo "</div></body></html>";
?>