<?php
  session_start();

  include('connect.php');

  $uid = $_POST['username'];
  $pwd = $_POST['password'];

  $sql = "select * from Users where uid='$uid'";
  $res = mysqli_query($connect, $sql);

  if ($row = mysqli_fetch_assoc($res)) {
    $hashedpwd = $row['pwd'];

    if (password_verify($pwd, $hashedpwd)) {
      if (password_needs_rehash($hashedpwd, PASSWORD_BCRYPT)) {
        $newhashedpw = password_hash($pwd, PASSWORD_BCRYPT);

        $updatesql = "update Users set pwd='$newhashedpw' where uid='$uid'";
        mysqli_query($connect, $updatesql);
      }

      $isactive = $row['active'] == 'yes' ? true : false;
      if ($isactive) echo "pass";
      else echo "notactive";
    }
    else echo "wrong";
  }
  else echo "notfound";

  mysqli_close($connect);
?>
