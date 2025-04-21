<?
///////////////////////////////////////////////////////////////
$manesu = time()-1800;
$datumaa1=date("d-m-Y");
$trenutni = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE gdetime> '".$manesu."'"));
$najveci = mysql_fetch_array(mysql_query("SELECT maxxx FROM maximalno WHERE date='".$datumaa1."'"));
if($najveci){
if($najveci[0]<$trenutni[0]){
$maximalno1 = mysql_query("UPDATE maximalno SET time='".time()."', maxxx='".$trenutni[0]."' WHERE date='".$datumaa1."'");
}
}else{
$maximalno2 = mysql_query("INSERT INTO maximalno SET date='".$datumaa1."', time='".time()."', maxxx='".$trenutni[0]."'");
}
////////////////////////////////////////////////////////////////
$counter = mysql_fetch_array(mysql_query("SELECT brojac FROM setting"));
$daycounter = mysql_fetch_array(mysql_query("SELECT dnevnibrojac FROM setting"));
$dater = mysql_fetch_array(mysql_query("SELECT brojacdatum FROM setting"));
$counter1=$counter[0]+1;
$update = mysql_query("UPDATE setting SET brojac='".$counter1."'");
$dnevni=date("d-m-Y");
if($dnevni!=$dater[0]){
$update1 = mysql_query("UPDATE setting SET dnevnibrojac='0'");
$update2 = mysql_query("UPDATE setting SET brojacdatum='".$dnevni."'");
}else{
$counter2=$daycounter[0]+1;
$update3 = mysql_query("UPDATE setting SET dnevnibrojac='".$counter2."'");
}
/////////////////////////////////////////////////////////////////
?>