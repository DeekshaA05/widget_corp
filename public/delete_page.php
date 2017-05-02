<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php
     $current_page=find_page_by_id($_GET["page"],false);
     if(!$current_page)
     {
        //page Id was missing or invalid or page couldn't be found in database
        redirect_to("manage_content.php");
     }
     $id=$current_page["id"];
     $query="DELETE FROM pages WHERE id={$id} LIMIT 1";
     $result=mysqli_query($connection,$query);
     if($result && mysqli_affected_rows($connection)==1)
       {
    //success
          $_SESSION["message"]="Page Deleted.";
          redirect_to("manage_content.php");
       }
else
{
    //failure
         $_SESSION["message"]="Page deletion failed.";
         redirect_to("manage_content.php?page={$id}");
}
?>