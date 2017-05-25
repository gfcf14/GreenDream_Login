<?php
  session_start();

  $title = "GreenDream: Login";

  include('header.php');

  if ($_SESSION['id']) include('loggedin.php');
  else include('notloggedin.php');
?>

<div>
  
</div>

<?php
  include('footer.php');
?>
