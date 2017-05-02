<?php
       if(!isset($layout_context))
       {
        $layout_context="public";
       }
?>
<!DOCTYPE html>
<html>
<head>
<title>Widget Corp <?php echo $layout_context;?></title>
<link href="stylesheet/public.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div id="header">
        <h1>Widget Crop<?php if($layout_context=="admin") {echo "Admin";}?>
        </h1>
    </div>