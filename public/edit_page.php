<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php require_once("C:\wamp64\www\widget_corp\includes/validation_functions_in_cms.php");?>
<?php find_selected_page(); ?>
<?php
     //Unlike new_page.php, we don't need a subject_id to be sent
     //We already have it stored in pages.subject_id.
     if(!$current_page)
     {
        //page Id was missing or invalid or page couldn't be found in database
        redirect_to("manage_content.php");
     }
?>

<?php
if(isset($_POST['submit']))
{
    //Process the form
$id=$current_page["id"];
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int) $_POST["position"];
$visible=(int) $_POST["visible"];
$content=mysql_prep($_POST["content"]);

// validations
$required_fields=array("menu_name","position","visible","content");
validate_presences($required_fields);

$fields_with_max_length=array("menu_name"=>30);
validate_max_length($fields_with_max_length);
if(empty($errors))
{
    //Perform Update

$query="UPDATE pages SET menu_name='{$menu_name}',position={$position},visible={$visible},content='{$content}' WHERE id={$id} LIMIT 1";
$result=mysqli_query($connection,$query);
if($result && mysqli_affected_rows($connection)>=0)
{
    //success
    $_SESSION["message"]="Page Updated.";
    redirect_to("manage_content.php");
}
else
{
    //failure
    $message="Page Updated failed.";
}
}
}
else
{
    //this is probably a GET request
}
?>
<?php $layout_context="Admin";?>
<?php include("C:\wamp64\www\widget_corp\includes\layouts\header.php");?>

<div id="main">
    <div id="navigation">
        <?php
        echo navigation($current_subject,$current_page);
        ?>
    </div>
    <div id="page">
        <?php echo message();?>
        <?php echo form_errors($errors); ?>
       <h2>Edit Page: <?php echo htmlentities($current_page["menu_name"]);?> </h2>
       <form action="edit_page.php?page=<?php echo urlencode($current_page["id"]);?>" method="post">
        <p>Menu Name: <input type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]);?>"/>
        </p>
        <p>Position:
            <select name="position">
                <?php
                $page_set=find_pages_for_subject($current_page["subject_id"],false);
                $page_count=mysqli_num_rows($page_set);
                for($count=1;$count<=($page_count);$count++)
                  {
                        echo "<option value=\"{$count}\"";
                        if($current_page["position"]==$count)
                            {
                                echo " selected";
                            }
                            echo ">{$count}</option>";
                  }
                ?>
            </select>
        </p>
        <p>Visible:
            <input type="radio" name="visible" value="0" <?php if($current_page["visible"]==0) {echo "checked";} ?>/> No
            &nbsp;
            <input type="radio" name="visible" value="1" <?php if($current_page["visible"]==1) {echo "checked";} ?>/> Yes
        </p>
        <p>Content:
            <br>
            <textarea name="content" rows="20" cols="80"><?php echo htmlentities($current_page["content"]);?>
            </textarea>
        </p>
        <input type="submit" name="submit" value="Edit Page"/>
    </form>
    </br>
    <a href="manage_content.php?page=<?php echo urlencode($current_page["id"]);?>">Cancle</a>
    &nbsp;
    &nbsp;
    <a href="delete_page.php?page=<?php echo urlencode($current_page["id"])?>" onclick="return confirm('Are You Sure?');">Delete Page</a>
    </div>
</div>
<?php include("C:/wamp64/www/widget_corp/includes/layouts/dooter.php");?>