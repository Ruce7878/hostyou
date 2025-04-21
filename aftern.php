<?
require("inc.php");
$link = connect_db();
for ($num = 0; $num <= 22; $num++){
$ranec = "room".$num;
mysql_query (" ALTER TABLE $ranec CHANGE who who VARCHAR( 40 ) NOT NULL ");
echo "ok$num ";
}
mysql_close($link);
?>