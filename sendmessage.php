<?php
  session_start();

  if (isset($_POST['msg'])) {
    $msg = $_POST['msg'];

    if (strlen($smg) > 200) echo "Message cannot exceed 200 characters";
    else {
      include('connect.php');
      $mailto = $_SESSION['mailto'];
      $sql = "select * from Users where uid='$mailto'";
      $mres = mysqli_query($connect, $sql);

      $row = mysqli_fetch_assoc($mres);

      $headers = "MIME-Version: 1.0" ."\r\n" .
                 "Content-Type: text/html; charset=iso-8859-1" . "\r\n" .
                 "From: admin@yoursite.com" . "\r\n" .
                 "Reply-To: admin@yoursite.com" . "\r\n" .
                 "X-Mailer: PHP/" . phpversion();
      $to = $row['email'];

      $uid = $_SESSION['uid'];
      $subject = "GreenDream: New message from " . $uid;

      $message = "<img src='http://yoursite.com/someimage.png'>" .
          			 "<br /><br />" .
          			 "<div style='display: block; width: 100%; background: linear-gradient(to right, #007146 15%, #00b456 100%); color: #ffffff; font-size: 30px;'>&nbsp;New Message:</div>" .
                 "<br />" .
                 "<div>" . $uid . " has sent you a message:</div>" .
                 "<br>" .
                  $msg .
                 "<br><br>" .
                 "<div>To view " . $uid . "'s profile, Click <a href='http://yoursite.com/profile.php?user=" . $uid . "'>here</a></div>";

      @mail($to, $subject, $message, $headers);
      echo "sent";

      mysqli_close($connect);
    }
  }
  else  echo "You must provide a message";
?>
