<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php confirm_logged_in();?>
<?php
      $admin_set=find_all_admins();
?>

<?php $layout_context="Admin";?>
<?php include("C:\wamp64\www\widget_corp\includes\layouts\header.php");?>
<?php find_selected_page() ?>
<div id="main">
    <div id="navigation">
        <br>
        <a href="admin.php"> Main Menu</a><br>
    </div>
    <div id="page">
    <?php echo message(); ?>
        <h2>Manage Admins</h2>
         <table>
                <tr>
                    <th style="text-align: left; width: 200px;">Username</th>
                    <th colspan="2" style="text-align: left;">Actions</th>
                </tr>
                <?php while($admin=mysqli_fetch_assoc($admin_set)) { ?>
               <tr>
                <td><?php echo htmlentities($admin["username"]);?>
                    <br>
                 <?php //echo htmlentities($admin["hashed_password"]);?>
                </td>
                <td> <a href="edit_admin.php?id=<?php echo urlencode($admin["id"]);?>"Edit</a></td>
                <td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]);?>"onclick="return confirm('Are you sure?');">Delete</a></td>
                <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]);?>">Edit</a></td>
                </tr>
                <?php } ?>
         </table>
         <br>
         <a href="new_admin.php">Add New Admin</a>
         </div>
     </div>
<?php include("C:/wamp64/www/widget_corp/includes/layouts/dooter.php");?>