<?php
  session_start();

  $title = "GreenDream: User Profile";

  include('header.php');

  if ($_SESSION['id']) include('loggedin.php');
  else include('notloggedin.php');
?>

<div style='text-align: center;'>
  <?php
    if (isset($_GET['user'])) {
      $user = $_GET['user'];

      $sex = '';
      $id = '';
      $img = '';
      $uid = '';
      $name = '';
      $about = '';
      $email = '';
      $aboutuser = '';
      $buttonid = '';
      $buttontitle = '';

      if ($_SESSION['id'] && $_SESSION['uid'] == $user) {
        $sex = $_SESSION['sex'];
        $id = $_SESSION['id'];
        $img = $_SESSION['img'];
        $uid = $_SESSION['uid'];
        $name = $_SESSION['name'];
        $about = stripslashes($_SESSION['about']);
        $email = $_SESSION['email'];
        $aboutuser = 'you';
        $buttonid = 'editbutton';
        $buttontitle = 'EDIT INFO';
        $onclick = "fadeIn('signup');";
      }
      else {
        include('connect.php');

        if ($stmt = mysqli_prepare($connect, "select * from Users where uid=?")) {
          mysqli_stmt_bind_param($stmt, "s", $user);
          mysqli_stmt_execute($stmt);
          $res = mysqli_stmt_get_result($stmt);

          if ($row = mysqli_fetch_assoc($res)) {
            $_SESSION['mailto'] = $user;

            $sex = $row['sex'];
            $id = $row['id'];
            $img = $row['img'];
            $uid = $row['uid'];
            $name = $row['name'];
            $about = stripslashes($row['about']);
            $email = $row['email'];
            $aboutuser = $sex == 'm'? 'him': 'her';
            $buttonid = 'mailbutton';
            if ($_SESSION['id']) $buttontitle = 'SEND MESSAGE';
            else $buttontitle = '';
            $onclick = "fadeIn('message');";
          }
          else {
            echo "The user provided does not exist...";
            return;
          }
        }

        mysqli_close($connect);
      }

      include('userinfo.php');
    }
    else echo "A user must be specified to view this page";
  ?>
</div>

<?php
  include('footer.php');
?>
