<?php

$engDay = date("l");

switch($engDay){
case "Monday": $rusDay = "Ponedeljak"; break;
case "Tuesday": $rusDay = "Utorak"; break;
case "Wednesday": $rusDay = "Sreda"; break;
case "Thursday": $rusDay = "Cetvrtak"; break;
case "Friday": $rusDay = "Petak"; break;
case "Saturday": $rusDay = "Subota"; break;
default: $rusDay = "Nedelja"; break;
}

$t=date("H:i:s", mktime(date ("H")+0));
$d=date("d. F Y.", time());
$d = str_replace("January","Januar",$d);
$d = str_replace("February","Februar",$d);
$d = str_replace("March","Mart",$d);
$d = str_replace("April","April",$d);
$d = str_replace("May","Maj",$d);
$d = str_replace("June","Jun",$d);
$d = str_replace("July","Jul" ,$d);
$d = str_replace("August","Avgust",$d);
$d = str_replace("September","Septembar",$d);
$d = str_replace("October","Oktobar",$d);
$d = str_replace("November","Novembar",$d);
$d = str_replace("December","Decembar",$d);

$datep = date("d.m");
$m=date("d-m-");
$select = mysql_query ("Select id from users where id = '".$id."' and birth LIKE '%$m%' ");
$inf = mysql_fetch_array ($select);
$usid=$inf["id"];
?>
<?=$fsize1.$rusDay?> | <?=$d.$fsize2?>

<div class=d19>
<div class="d12">
<?=$fsize1?><?=$nazivsajta?><?=$fsize2?>
</div><div class="d13">
<form name=form metod="get"> 
 <?=$fsize2?>
<input name=f_clock maxlength=8 size=3 style=" font-size:1.3em; border:solid #0F0 0px; font-weight:bold; text-align:center; width: 100px" id=clock>
</form>	 <?=$fsize1?>
</div><div style="clear: both"></div>
</div>



<?php

if (($usid==$id)&&($sex=="Z")&&($level<7)){
echo "<b>".$us."</b>, Srecan rodjendan!<br/>";
}
if (($usid==$id)&&($sex=="M")&&($level<7)){
echo "<b>".$us."</b>, Srecan rodjendan!<br/>";
}
if ($datep=="31.12"){
echo "Srecna Nova Godina!<br/>";
}
if ($datep=="01.01"){
echo "Srecna Nova Godina!<br/>";
}
if ($datep=="07.01"){
echo "Hristos se rodi!<br/>";
}

if (($datep=="14.02")&&($row["sex"]=="Z")){
echo "<b>".$us."</b>, Srecan Dan Zaljubljenih!<br/>";
}
if (($datep=="14.02")&&($row["sex"]=="M")){
echo "<b>".$us."</b>, Srecan Dan Zaljubljenih!<br/>";
}
if (($datep=="08.03")&&($row["sex"]=="Z")){
echo "<b>".$us."</b>, , Srecan Dan Zena!";
}
if ($datep=="01.08"){
echo "Srecan 1. Maj!<br/>";
}

?>