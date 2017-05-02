<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php require_once("../includes/validation_functions_in_cms.php");?>
<?php
if(isset($_POST['submit']))
{
           //process the form
           // validations
           $required_fields=array("username","password");
           validate_presences($required_fields);

           $fields_with_max_length=array("username"=>30);
           validate_max_length($fields_with_max_length);

    if(empty($errors))
    {
          //Perform Create
          //make sure you add the subject_id!
          $username=mysql_prep($_POST["username"]);
          $hashed_password=password_encrypt($_POST["password"]);

          $query="INSERT INTO admins (username,hashed_password) VALUES('{$username}','{$hashed_password}')";
          $result=mysqli_query($connection,$query);
          if($result)
          {
            //success
             $_SESSION["message"]="Admin Created.";
             redirect_to("manage_admin.php");
          }
           else
           {
              //failure
              $_SESSION["message"]="Admin creation failed.";
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
       <h2>Create Admin </h2>
       <form action="new_admin.php" method="post">
        <p>UserName: <input type="text" name="username" value=""/>
        </p>
        <p>Password:
        <input type="password" name="password" value=""/>
      </p>
        <input type="submit" name="submit" value="Create Admin"/>
    </form>
    </br>
    <a href="manage_admin.php">Cancle</a>
    </div>
</div>
<?php include("C:/wamp64/www/widget_corp/includes/layouts/dooter.php");?>