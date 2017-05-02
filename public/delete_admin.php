<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php
     $admin=find_admin_by_id($_GET["id"]);
     if(!$admin)
     {
        //admin Id was missing or invalid or admin couldn't be found in database
        redirect_to("manage_admin.php");
     }
     $id=$admin["id"];
     $query="DELETE FROM admins WHERE id={$id} LIMIT 1";
     $result=mysqli_query($connection,$query);
     if($result && mysqli_affected_rows($connection)==1)
       {
    //success
          $_SESSION["message"]="Admin Deleted.";
          redirect_to("manage_admin.php");
       }
else
{
    //failure
         $_SESSION["message"]="Admin deletion failed.";
         redirect_to("manage_admin.php");
}
?>