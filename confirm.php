<?php
  $title = "GreenDream: Confirmation";

  include('header.php');
?>
<div>
  <?php
    ob_start();

    echo "<div style='text-align: center;'>";
    if (!isset($_GET['code'])) echo "Cannot confirm account with insufficient info. Check the email you provided and click on the link inside";
    else {
      include('connect.php');

      $code = $_GET['code'];

      if ($stmt = mysqli_prepare($connect, "select * from Users where active=?")) {
        mysqli_stmt_bind_param($stmt, "s", $code);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if ($row =  mysqli_fetch_assoc($res)) {
          $id = $row['id'];
          $update = "update Users set active='yes' where id='$id'";
          mysqli_query($connect, $update);

          echo "Your account has been confirmed. Please click <a href='yoursite.com/index.php'>here</a> to sign in";
        }
        else {
          echo "Your account may already be active. If you have not registered, please register first before account confirmation";
          echo "<br />Please click <a href='yoursite.com/index.php'>here</a> to sign up or sign in";
        }
      }

      mysqli_close($connect);
    }

    echo "</div>";
  ?>
</div>

<?php
  include('footer.php');
?>
