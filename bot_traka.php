<?php 
if($rm < 4 || $rm == 13){
if($rm ==0){
$uid = 2;$klu4 = 1;
}elseif($rm == 1){
$uid = 2;$klu4 = 2;	
}else if($rm == 3){
$uid = 6;$klu4 = 3;	
}else if($rm == 13){
$uid = 7;$klu4 = 1;	
}
$vopros = $rm==13 ?	'rec' : 'vopros';
$pitanj_e = @mysql_fetch_array(mysql_query("Select * From $vopros Where klu4='".$klu4."'")); 
$res2 = mysql_query ("Select klu4,time,who,message,messagewosm,messagewoasm,id,towhom,hid,usid,komu from $room WHERE usid='".$uid."' order by id desc LIMIT 1");
$lines2 = @mysql_fetch_array ($res2);$t = $pitanj_e["time"];
$t = strftime('%T',$t);
if($lines2===false)break;
$komu2 = $lines2["komu"];
$date2 = $lines2["time"];
$klu42 = $lines2["klu4"];
$name2 = $lines2["who"];
$usid2 = $lines2["usid"];
if ($smset=="0") {$msg2 = $lines2["message"];}
else if ($smset=="2") {$msg2 = $lines2["message"]; $msg2=getsmilies($msg2, $usid2);}
else{$msg2 = $lines2["message"]; $msg2=getsmilies($msg2, $usid2);}
$msg2=zamena($msg2);
$time2 = $lines2["id"];
//------------- Traka za botove
//if($usid2 == 9){
?>
<div style="background: #000; color: #fff; padding: 5px">
<?php 
echo 'Pitanje: ( '.$t.' ) '.$pitanj_e[3].'<br>';	
if($pitanj_e[1] != 0){
echo "<b><a href=\"info.php?$ses&amp;rm=$rm&amp;rm=$rm&amp;nk=$usid$takep\">".$name2."</a></b>".$komu2."(".$date2.")\n".$msg2."";?>

<?php
}
	?></div><?php
//}			 
}
?>