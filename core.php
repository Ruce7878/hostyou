<?php  include("gz.php");
include("inc.php");

/////////////////////////////////Protect against SQL-injections///////////////
if(!get_magic_quotes_gpc())
{
$_GET = array_map('trim', $_GET);
$_POST = array_map('trim', $_POST);
$_COOKIE = array_map('trim', $_COOKIE);

$_GET = array_map('addslashes', $_GET);
$_POST = array_map('addslashes', $_POST);
$_COOKIE = array_map('addslashes', $_COOKIE);
}
//////////////////////////////////////////////////////////////////////////////

?>