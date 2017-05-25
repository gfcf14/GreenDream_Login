<?php
  session_start();

  include('connect.php');

  $uid = $_POST['signinuid'];
  $pwd = $_POST['signinpwd'];

  $sql = "select * from Users where uid='$uid'";

  $res = mysqli_query($connect, $sql);

  $row = mysqli_fetch_assoc($res);

  $_SESSION['id'] = $row['id'];
  $_SESSION['name'] = $row['name'];
  $_SESSION['email'] = $row['email'];
  $_SESSION['sex'] = $row['sex'];
  $_SESSION['img'] = $row['img'];
  $_SESSION['uid'] = $row['uid'];
  $_SESSION['about'] = $row['about'];

  mysqli_close($connect);
  header("Location: " . $_SERVER['HTTP_REFERER']);
?>
