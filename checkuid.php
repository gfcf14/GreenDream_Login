<?php
  session_start();

  include('connect.php');

  $username = $_POST['username'];

  if ($stmt = mysqli_prepare($connect, "select * from Users where uid=?")) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (!$row = mysqli_fetch_assoc($res)) echo true;
    else echo false;
  }

  mysqli_close($connect);
?>
