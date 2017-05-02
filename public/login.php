<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php require_once("../includes/validation_functions_in_cms.php");?>
<?php
$username="";
if(isset($_POST['submit']))
{
           //process the form
           // validations
           $required_fields=array("username","password");
           validate_presences($required_fields);

    if(empty($errors))
    {
          //Attempt Login
          $username=$_POST["username"];
          $password=$_POST["password"];
          $found_admin=attempt_login($username,$password);
          if($found_admin)
          {
            //success
            //Mark user as logged
            $_SESSION["admin_id"]=$found_admin["id"];
            $_SESSION["username"]=$found_admin["username"];
            redirect_to("admin.php");
          }
           else
           {
              //failure
              $_SESSION["message"]="Username/Password not found.";
           }
    }
}
else
{
    //this is probably a GET request
}//end:if(isset($_POST['submit']))
?>
<?php $layout_context="Admin";?>
<?php include("C:\wamp64\www\widget_corp\includes\layouts\header.php");?>
<div id="main">
    <div id="navigation">
       &nbsp;
    </div>
    <div id="page">
        <?php echo message(); ?>
        <?php echo form_errors($errors); ?>
       <h2>Login </h2>
       <form action="login.php" method="post">
        <p>UserName: <input type="text" name="username" value="<?php echo htmlentities($username);?>"/>
        </p>
        <p>Password:
        <input type="password" name="password" value=""/>
      </p>
        <input type="submit" name="submit" value="Submit"/>
    </form>
    </div>
</div>
<?php include("C:/wamp64/www/widget_corp/includes/layouts/dooter.php");?>