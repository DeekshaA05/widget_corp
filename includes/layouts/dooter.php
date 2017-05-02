<div id="dooter">Copyright <?php echo date("Y");?>, Widget Corp</div>
</body>
</html>
<?php
// CLOSE DATABASE CONNECTION
if(isset($connection))
{
  mysqli_close($connection);
}
?>