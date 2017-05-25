<?php
  session_start();

  $email = $_POST['email'];

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    include('connect.php');

    if ($stmt = mysqli_prepare($connect, "select * from Users where email=?")) {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $res = mysqli_stmt_get_result($stmt);

      if (!$row = mysqli_fetch_assoc($res)) echo 'valid';
      else {
        if ($row['uid'] == $_SESSION['uid']) echo 'valid';
        else echo 'used';
      }
    }
  }
  else echo 'notvalid';

  mysqli_close($connect);
?>
