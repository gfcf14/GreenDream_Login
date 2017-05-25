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
  include('hackcheck.php');

  if ($hack != 'pass') echo $hack;
  else {
    $key = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $code = '';
    for ($i = 0; $i < 60; $i++) {
      $code .= $key[random_int(0, mb_strlen($key, '8bit') - 1)];
    }

    if ($stmt = mysqli_prepare($connect, "insert into Users (name, email, sex, img, uid, pwd, about, active, token, datelimit) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
      $none = 'none';
      $zero = 0;
      mysqli_stmt_bind_param($stmt, "sssssssssi", $name, $email, $sex, $imgext, $uid, $pwd, $about, $code, $none, $zero);
      $res = mysqli_stmt_execute($stmt);

      if ($res) {
        $subject = "GreenDream: Confirm your account";
        $to = $email;

        $headers = "MIME-Version: 1.0" ."\r\n" .
      			 "Content-Type: text/html; charset=iso-8859-1" . "\r\n" .
      			 "From: admin@yoursite.com" . "\r\n" .
      			 "Reply-To: admin@yoursite.com" . "\r\n" .
      			 "X-Mailer: PHP/" . phpversion();

        $ref = "http://yoursite.com/confirm.php?code=" . $code;

        $message = "<img src='http://yoursite.com/someimage.png'>" .
            			 "<br /><br />" .
            			 "<div style='display: block; width: 100%; background: linear-gradient(to right, #007146 15%, #00b456 100%); color: #ffffff; font-size: 30px;'>&nbsp;Account Confirmation:</div>" .
            			 "<div>Dear $name:</div>" .
                   "<br />" .
                   "<div>This e-mail is to confirm your account registration on our site. Please click on the following link to complete account verification:</div>" .
                   "<br>" .
                   "<a href='$ref'>$ref</a>" .
                   "<br><br>" .
                   "Thank you," .
                   "<br><br>" .
                   "gfcf14" .
                   "<br>" .
                   "GreenDream Admin" .
                   "</div>";

        @mail($to, $subject, $message, $headers);

        include('uploadimage.php');

        echo 'pass';
      }
    }
    echo mysqli_error($connect);
  }

  mysqli_close($connect);
?>
