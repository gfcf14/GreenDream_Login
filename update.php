<?php
  session_start();

  include('connect.php');

  $name = $_POST['name'];
  $email = $_POST['email'];
  $sex = $_POST['sex'];
  $imgext = $_POST['filextension'];
  $uid = $_POST['uid'];
  $pwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
  $about = addslashes($_POST['about']);

  $hack = '';
  $imageset = false;
  include('hackcheck.php');
  if ($hack != 'pass') echo $hack;
  else {
    if (!$imageset) $imgext = $_SESSION['img'];

    $id = $_SESSION['id'];

    if ($stmt = mysqli_prepare($connect, "update Users set name=?, email=?, sex=?, img=?, pwd=?, about=? where id=?")) {
      mysqli_stmt_bind_param($stmt, "ssssssi", $name, $email, $sex, $imgext, $pwd, $about, $id);
      $res = mysqli_stmt_execute($stmt);

      if ($res) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['sex'] = $sex;
        $_SESSION['img'] = $imgext;
        $_SESSION['about'] = $about;

        if ($imageset) {
          $uid = $_SESSION['uid'];
          include('uploadimage.php');
        }

        echo 'pass';
      }
    }

    echo mysqli_error($connect);
  }

  mysqli_close($connect);
?>
