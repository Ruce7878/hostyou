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

///////////////////////////////////////////
$gde="Blog";
updgdeuser($gde,$id); // update user place
///////////////////////////////////////////
echo edyka_head("Blog",$userData);

$nocna = mysql_fetch_array(mysql_query("SELECT lockvic FROM ".TABLE_PREFIX."setting"));
if($nocna[0]==0){

echo "Greska!<br/>";
echo $divide;
echo "Nocni ulasci na ovu opciju chata nisu dozvoljeni!<br/>";
echo $divide;
echo "<a href=\"enter.php?$ses&amp;ref=$ref\">Hodnik</a><br/>\n";

echo edyka_foot($divide);
exit;
}
switch($mod) {

case 'meet':
$q=@mysql_query("select id, title,content,organizatory,login FROM  ".TABLE_PREFIX."blog where id='$mid';");
$arr=@mysql_fetch_array($q);
		
		$titlet=zamena($arr['title']);
		$sedrz=zamena($arr['content']);
		$org=zamena($arr['organizatory']);
		echo "<u>Naziv:</u> $titlet";
		echo "<br/><u>Sadrzaj:</u> $sedrz";
		//echo "<br/><u>Organizator:</u> $org";
		echo "<br/><u>Postavio:</u> ".$arr['login'];
		echo "<br/>";
		if($userData["level"]==8)
		{
		echo "<a href=\"blog.php?$ses&amp;mid=".$arr['id']."&amp;mod=delete&amp;ref=$ref\">Obrisi</a><br/>"; 
		}
        
break;

case 'delete':
if ($ver=="wml")echo "<p align=\"center\">\n";
else echo "<div align=\"center\">\n";

  $mid = $_GET["mid"];
    if($userData["level"]==8)
	{
        $res = mysql_query("DELETE FROM  ".TABLE_PREFIX."blog WHERE id ='".$mid."'");
        if($res)
        {
            echo "Blog je uspesno obrisan!";
        }else{
            echo "Greska na bazi!";
        }
    }else{
        echo "Ne mozete obrisati ovaj blog!";
    }
    
break;

case 'add1':
$title=trim(htmlspecialchars(stripslashes($title)));
$content=trim(htmlspecialchars(stripslashes($content)));
$organizatory=trim(htmlspecialchars(stripslashes($organizatory)));
if(empty($title)) $error=$error."<u>Naziv nije naveden!</u><br/>";
if(empty($content)) $error=$error."<u>Sadrzaj nije naveden!</u><br/>";
if(empty($organizatory)) $error=$error."<u>Organizator nije naveden!</u><br/>";
if(empty($action)) {
if ($ver=="wml"){

echo "Naziv:<br/>";

echo "<input name=\"title\" maxlength=\"1000\"/><br/>";

echo "Sadrzaj:<br/>";

echo "<input name=\"content\" maxlength=\"10000\"/><br/>";

echo "Organizator:<br/>";

echo "<input name=\"organizatory\" maxlength=\"100\"/><br/>";
				
echo "<anchor>Dodaj<go href=\"blog.php?$ses&amp;mod=add1$takep\" method=\"post\">";
echo "<postfield name=\"action\" value=\"add\"/>";
echo "<postfield name=\"title\" value=\"$(title)\"/>";
echo "<postfield name=\"content\" value=\"$(content)\"/>";
echo "<postfield name=\"organizatory\" value=\"$(organizatory)\"/>";
echo "</go></anchor>";
	
echo "<br/>";
}else{
echo "<form method=\"POST\" action=\"blog.php?$ses&amp;mod=add1$takep\" name=\"auth\">\n";
echo "<input type=\"hidden\" name=\"action\" value=\"add\"/>\n";

echo "Naziv:<br/>";

echo "<input type=\"text\" name=\"title\" maxlength=\"100\"><br/>\n";

echo "Sadrzaj:<br/>";

echo "<input type=\"text\" name=\"content\" maxlength=\"10000\"/><br/>\n";

echo "Organizator:<br/>";

echo "<input type=\"text\" name=\"organizatory\" maxlength=\"100\"/><br/>\n";
echo "<input type=\"submit\" value=\"Dodaj\" name=\"enter\"><br/>\n";
}
}else{ 
if(empty($error)) {
if($title!=$last_meet['title']) {
if(mysql_query("insert into  ".TABLE_PREFIX."blog values(0,'".$userData["user"]."','".$title."','".$content."','".$organizatory."');")) { 

echo "Blog je dodat!<br/>"; 

} else { 

echo "Greska!!!<br/>".mysql_error(); 

} 
} else { 

echo "Takav Blog vec postoji!<br/>"; 

}
} else { 

echo $error; 

} 
}
break;

default:

echo "<img src=\"images/blog.jpg\" alt=\"Blog\"/><br/>\n";
echo $divide;
$q=mysql_query("select id,title from  ".TABLE_PREFIX."blog order by id desc;");
if (mysql_affected_rows() == 0) {
echo "Nema Blogova!<br/>";
}
while($arr=mysql_fetch_array($q)) {
$titlet=zamena($arr['title']);
echo "<a href=\"blog.php?$ses&amp;mid=".$arr['id']."&amp;mod=meet&amp;ref=$ref\">".$titlet."</a><br/>"; 
}

break;
}

echo $divide;
if($mod) {
echo "<a href=\"blog.php?$ses&amp;ref=$ref\">Blog</a><br/>";
}else{
echo "<a href=\"blog.php?$ses&amp;ref=$ref&amp;mod=add1\">Napravi Blog</a><br/>";
}


echo "<a href=\"enter.php?$ses&amp;ref=$rand\">Hodnik</a>";


echo edyka_foot($divide);
mysql_close($link);
?>