<?php
  include('connect.php');

  $newpass = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
  $token = $_POST['token'];

  $query = "select * from Users where token='$token'";
  $res = mysqli_query($connect, $query);

  if ($row = mysqli_fetch_assoc($res)) {
    $id = $row['id'];

    $updatepwd = "update Users set pwd='$newpass', token='none', datelimit=0 where id='$id'";
    mysqli_query($connect, $updatepwd);

    echo "Your password has been changed. Click <a href='index.php' style='color: #ffffff;'>here</a> to login";
  }

  mysqli_close($connect);
?>
