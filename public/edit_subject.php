<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php require_once("C:\wamp64\www\widget_corp\includes/validation_functions_in_cms.php");?>
<?php find_selected_page(); ?>
<?php
     if(!$current_subject)
     {
        //subject Id was missing or invalid or subject couldn't be found in database
        redirect_to("manage_content.php");
     }
?>
<?php $layout_context="Admin";?>
<?php include("C:\wamp64\www\widget_corp\includes\layouts\header.php");?>

<?php
if(isset($_POST['submit']))
{

// validations
$required_fields=array("menu_name","position","visible");
validate_presences($required_fields);

$fields_with_max_length=array("menu_name"=>30);
validate_max_length($fields_with_max_length);

if(empty($errors))
{
    //Perform Update
$id=$current_subject["id"];
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int) $_POST["position"];
$visible=(int) $_POST["visible"];

$query="UPDATE subjects SET menu_name='{$menu_name}',position={$position},visible={$visible} WHERE id={$id} LIMIT 1";
$result=mysqli_query($connection,$query);
if($result && mysqli_affected_rows($connection)>=0)
{
    //success
    $_SESSION["message"]="Subject Updated.";
    redirect_to("manage_content.php");
}
else
{
    //failure
    $message="Subject Updated failed.";
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
        <?php
        echo navigation($current_subject,$current_page);
        ?>
    </div>
    <div id="page">
        <?php //$message is just a variable, doesnt use the SESSION
        if(!empty($message))
        {
            echo "<div class=\"message\">" . htmlentities($message) . "</div>";
        }
        ?>
        <?php echo form_errors($errors); ?>
       <h2>Edit Subject: <?php echo htmlentities($current_subject["menu_name"]);?> </h2>
       <form action="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]);?>" method="post">
        <p>Menu Name: <input type="text" name="menu_name" value="<?php echo htmlentities($current_subject["menu_name"]);?>"/>
        </p>
        <p>Position:
            <select name="position">
                <?php
                $subject_set=find_all_subjects(false);
                $subject_count=mysqli_num_rows($subject_set);
                for($count=1;$count<=($subject_count);$count++)
                  {
                        echo "<option value=\"{$count}\"";
                        if($current_subject["position"]==$count)
                            {
                                echo " selected";
                            }
                            echo ">{$count}</option>";
                  }
                ?>
            </select>
        </p>
        <p>Visible:
            <input type="radio" name="visible" value="0" <?php if($current_subject["visible"]==0) {echo "checked";} ?>/> No
            &nbsp;
            <input type="radio" name="visible" value="1" <?php if($current_subject["visible"]==1) {echo "checked";} ?>/> Yes
        </p>
        <input type="submit" name="submit" value="Edit Subject"/>
    </form>
    </br>
    <a href="manage_content.php">Cancle</a>
    &nbsp;
    &nbsp;
    <a href="delete_subject.php?subject=<?php echo urlencode($current_subject["id"])?>" onclick="return confirm('Are You Sure?');">Delete Subject</a>
    </div>
</div>
<?php include("C:/wamp64/www/widget_corp/includes/layouts/dooter.php");?>