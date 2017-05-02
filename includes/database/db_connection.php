<?php
define("DB_SERVER","localhost");//since these values are static so we are defining them as constants by using "define"
define("DB_USER","widget_cms");
define("DB_PASS","secretpassword");
define("DB_NAME","widget_corp");
/*
$dbhost="localhost";
$dbuser="widget_cms";
$dbpassword="secretpassword";
$dbname="widget_corp";
*/
$connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if(mysqli_connect_errno())
{
    die("database connection is unsuccessful"." ".mysqli_connect_error()."(".mysqli_connect_errno().")");
}
?>