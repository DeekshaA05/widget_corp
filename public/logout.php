<?php require_once("../includes/session.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php
// v1: simple logout
// session_start();
$_SESSION["admin_id"]=null;
$_SESSION["username"]=null;
redirect_to("login.php");
?>
<?php
/*        this is the alternate method for logout but this is very heavy which will completely erradicate the session so we will use the simpler one that is the first one
// v2: destroy session
// assumes nothing else in session to keep
//session_start();
//$_SESSION=array();
//if(isset($_COOKIE[session_name()]))
//{
//    setcookie(session_name(),' ',time()-42000,'/');
//}
//session_destroy();
//redirect_to("login.php");
*/
?>