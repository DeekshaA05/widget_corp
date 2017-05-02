<?php $layout_context="Public";?>
<?php include("C:\wamp64\www\widget_corp\includes\layouts\header.php");?>
<?php require_once("../includes/session.php");?>
<?php require_once("../includes/database/db_connection.php");?>
<?php require_once("../includes/function/functions.php");?>
<?php find_selected_page(true) ?>
<div id="main">
    <div id="navigation">
        <?php
        echo public_navigation($current_subject,$current_page);
        ?>
    </div>
    <div id="page">
        <?php if($current_page) {?>
        <h2><?php echo htmlentities($current_page["menu_name"]);?></h2>
          <?php echo nl2br(htmlentities($current_page["content"]));?>
        <?php } else { ?>
        <p>WELCOME</p>
        <?php } ?>
    </div>
</div>
<?php include("C:/wamp64/www/widget_corp/includes/layouts/dooter.php");?>
