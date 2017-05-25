<?php
  $type = $_POST['type'];
  $email = $_POST['email'];

  include('connect.php');
  $query = "select * from Users where email='$email'";
  $res = mysqli_query($connect, $query);

  if ($stmt = mysqli_prepare($connect, "Select * from Users where email=?")) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($res)) {
        $headers = "MIME-Version: 1.0" ."\r\n" .
                   "Content-Type: text/html; charset=iso-8859-1" . "\r\n" .
                   "From: admin@yoursite.com" . "\r\n" .
                   "Reply-To: admin@yoursite.com" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();
        $to = $email;

      if ($type == 'username') {
        $subject = "GreenDream: Username recovery";
        $usrnm = $row['uid'];

        $message = "<img src='http://yoursite.com/someimage.png'>" .
            			 "<br /><br />" .
            			 "<div style='display: block; width: 100%; background: linear-gradient(to right, #007146 15%, #00b456 100%); color: #ffffff; font-size: 30px;'>&nbsp;Username Recovery:</div>" .
                   "<br />" .
                   "<div>You have received this email because you requested your username. It is:</div>" .
                   "<br>" .
                    $usrnm .
                   "<br><br>" .
                   "<div>Click <a href='http://yoursite.com/index.php'>here</a> to login now</div>" .
                   "<br><br>" .
                   "Thank you," .
                   "<br><br>" .
                   "gfcf14" .
                   "<br>" .
                   "GreenDream Admin" .
                   "</div>";

        @mail($to, $subject, $message, $headers);

        echo "If the e-mail you provided exists in the database, you will receive a message with your username";
      }
      else if ($type == 'password') {
        $subject = "GreenDream: Password recovery";
        $id = $row['id'];

        $key = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $token = '';
        for ($i = 0; $i < 60; $i++) {
          $token .= $key[random_int(0, mb_strlen($key, '8bit') - 1)];
        }
        $updatetoken = "update Users set token='$token' where id='$id'";
        mysqli_query($connect, $updatetoken);

        $datelimit = idate(U);
        $updatelimit = "update Users set datelimit='$datelimit' where id='$id'";
        mysqli_query($connect, $updatelimit);

        $passlink = "http://yoursite.com/change.php?token=" . $token;

        $message = "<img src='http://yoursite.com/someimage.png'>" .
      			 "<br /><br />" .
      			 "<div style='display: block; width: 100%; background: linear-gradient(to right, #007146 15%, #00b456 100%); color: #ffffff; font-size: 30px;'>&nbsp;Password Recovery:</div>" .
             "<br />" .
             "<div>Click on the following link to change your password:</div>" .
             "<br>" .
              "<a href='$passlink'>$passlink</a>" .
             "<br><br>" .
             "<div>Due to security measures, this password change token will expire in <b>5 minutes</b> from the delivery of this message. Please change your password soon.</div>" .
             "<br><br>" .
             "Thank you," .
             "<br><br>" .
             "gfcf14" .
             "<br>" .
             "GreenDream Admin" .
             "</div>";

        @mail($to, $subject, $message, $headers);

        echo "If the e-mail you provided exists in the database, you will receive a message with instructions to change your password";
      }
    }
  }

  mysqli_close($connect);
?>
