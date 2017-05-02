<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php require_once("../includes/validation_functions_in_cms.php");?>
<?php find_selected_page(); ?>
<?php
    //can't add a new page unless we have a subject as a parent!
     if(!$current_subject)
     {
        //subject Id was missing or invalid or subject couldn't be found in database
        redirect_to("manage_content.php");
     }
?>

<?php
if(isset($_POST['submit']))
{
           //process the form
           // validations
           $required_fields=array("menu_name","position","visible","content");
           validate_presences($required_fields);

           $fields_with_max_length=array("menu_name"=>30);
           validate_max_length($fields_with_max_length);

    if(empty($errors))
    {
          //Perform Create
          //make sure you add the subject_id!
          $subject_id=$current_subject["id"];
          $menu_name=mysql_prep($_POST["menu_name"]);
          $position=(int)$_POST["position"];
          $visible=(int)$_POST["visible"];
          //be sure to escape the content
          $content=mysql_prep($_POST["content"]);
          $query="INSERT INTO pages (subject_id,menu_name,position,visible,content) VALUES({$subject_id},'{$menu_name}',{$position},{$visible},'{$content}')";
          $result=mysqli_query($connection,$query);
          if($result)
          {
            //success
             $_SESSION["message"]="Page Created.";
             redirect_to("manage_content.php?subject=".urlencode($current_subject["id"]));
          }
           else
           {
              //failure
              $_SESSION["message"]="Page creation failed.";
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
        <?php echo message(); ?>
        <?php $errors=errors();?>
        <?php echo form_errors($errors); ?>
       <h2>Create Page </h2>
       <form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]);?>" method="post">
        <p>Menu Name: <input type="text" name="menu_name" value=""/>
        </p>
        <p>Position:
            <select name="position">
                <?php
                $page_set=find_pages_for_subject($current_subject["id"],false);
                $page_count=mysqli_num_rows($page_set);
                for($count=1;$count<=($page_count + 1);$count++)
                  {
                        echo "<option value=\"{$count}\">{$count}</option>";
                  }
                ?>
            </select>
        </p>
        <p>Visible:
            <input type="radio" name="visible" value="0"/> No
            &nbsp;
            <input type="radio" name="visible" value="1"/> Yes
        </p>
        <p>Content:<br>
            <textarea name="content" rows="20" cols="80"></textarea>
        </p>
        <input type="submit" name="submit" value="Create Page"/>
    </form>
    </br>
    <a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]);?>">Cancle</a>
    </div>
</div>
<?php include("C:/wamp64/www/widget_corp/includes/layouts/dooter.php");?>