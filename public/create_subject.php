<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php require_once("C:\wamp64\www\widget_corp\includes/validation_functions_in_cms.php");?>
<?php
if(isset($_POST['submit']))
{
//Process the form
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int) $_POST["position"];
$visible=(int) $_POST["visible"];

// validations
$required_fields=array("menu_name","position","visible");
validate_presences($required_fields);

$fields_with_max_length=array("menu_name"=>30);
validate_max_length($fields_with_max_length);

if(!empty($errors))
{
    $_SESSION["errors"]=$errors;
    redirect_to("new_subject.php");
}
$query  = "INSERT INTO subjects(menu_name,position,visible)";
$query .= "VALUES('{$menu_name}',{$position},{$visible})";
$result=mysqli_query($connection,$query);
if($result)
{
    //success
    $_SESSION["message"]="Subject created.";
    redirect_to("manage_content.php");
}
else
{
    //failure
    $_SESSION["message"]="Subject creation failed.";
    redirect_to("new_subject.php");
}
}
else
{
    //this is probably a GET request
    redirect_to("new_subject.php");
}
?>
<?php
if(isset($connection))
{
    mysqli_close($connection);
}
?>