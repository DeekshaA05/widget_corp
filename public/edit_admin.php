<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php require_once("C:\wamp64\www\widget_corp\includes/validation_functions_in_cms.php");?>
<?php $layout_context="Admin";?>
<?php include("C:\wamp64\www\widget_corp\includes\layouts\header.php");?>
<?php
$admin=find_admin_by_id($_GET["id"]);
     if(!$admin)
     {
        //admin Id was missing or invalid or admin couldn't be found in database
        redirect_to("manage_admin.php");
     }
?>

<?php
if(isset($_POST['submit']))
{
    //Process the form
// validations
$required_fields=array("username","password");
validate_presences($required_fields);

$fields_with_max_length=array("username"=>30);
validate_max_length($fields_with_max_length);
if(empty($errors))
{
    //Perform Update
          $id=$admin["id"];
          $username=mysql_prep($_POST["username"]);
          $hashed_password=password_encrypt($_POST["password"]);
$query="UPDATE admins SET username='{$username}',hashed_password='{$hashed_password}' WHERE id={$id} LIMIT 1";
$result=mysqli_query($connection,$query);
if($result && mysqli_affected_rows($connection)==1)
{
    //success
    $_SESSION["message"]="Admin Updated.";
    redirect_to("manage_admin.php");
}
else
{
    //failure
    $_SESSION["message"]="Admin Update failed.";
}
}
}
else
{
    //this is probably a GET request
}
?>

<div id="main">
    <div id="navigation">
        &nbsp;
    </div>
    <div id="page">
        <?php echo message();?>
        <?php echo form_errors($errors); ?>
       <h2>Edit Admin: <?php echo htmlentities($admin["username"]);?> </h2>
       <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]);?>" method="post">
        <p>Username: <input type="text" name="username" value="<?php echo htmlentities($admin["username"]);?>"/>
        </p>
        <p>Password:

            <input type="password" name="password" value=""/>
    <p>
        <input type="submit" name="submit" value="Edit Admin"/>
    </form>
    </br>
    <a href="manage_admin.php">Cancle</a>
    </div>
</div>
<?php include("C:/wamp64/www/widget_corp/includes/layouts/dooter.php");?>