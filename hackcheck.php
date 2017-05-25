<?php
  if ($name != '') { //if name is empty
    if ($name == strip_tags($name)) { //if name contains HTML tags
      if ($email != '') { //if email is empty
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //if email is not valid
          if ($stmt = mysqli_prepare($connect, "select * from Users where email=?")) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $checkres = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($checkres);

            if (!$row || ($_SESSION['id'] && $_SESSION['email'] == $row['email'])) { //if email belongs to another user
              if ($sex != 'undefined') { //if sex is empty
                $imgok = true;

                if ($_SESSION['id']) {
                  if ($imgext != '') {
                    $imageset = true;

                    if ($imgext == 'png' || $imgext == 'PNG' || $imgext == 'jpg' || $imgext == 'jpeg' || $imgext == 'JPG' || $imgext == 'JPEG' || $imgext == 'gif' || $imgext == 'GIF' || $imgext == 'bmp' || $imgext == 'BMP' || $imgext == 'no') { //if imgext is valid
                      if ($imgext != 'no') { //an image must have been loaded
                        $imgtype = pathinfo($_FILES["userimage"]["name"], PATHINFO_EXTENSION);

                        if ($imgtype == 'png' || $imgtype == 'PNG' || $imgtype == 'jpg' || $imgtype == 'jpeg' || $imgtype == 'JPG' || $imgtype == 'JPEG' || $imgtype == 'gif' || $imgtype == 'GIF' || $imgtype == 'bmp' || $imgtype == 'BMP') { //if actual image extension is valid
                          $imgwidth = getimagesize($_FILES['userimage']['tmp_name'])[0];
                          $imgheight = getimagesize($_FILES['userimage']['tmp_name'])[1];

                          if ($imgwidth != 150 || $imgheight != 150) { //if userimage is not 150x150
                            $hack = 'Image is not 150x150';
                            $imgok = false;
                          }
                        }
                        else {
                          $hack = 'Image does not have right extension';
                          $imgok = false;
                        }
                      }
                    }
                    else {
                      $hack = 'Image text does not have right extension';
                      $imgok = false;
                    }
                  }
                }

                if ($imgok) {
                  if ($uid != '') { //if uid is empty
                    $uidok = true;

                    if ($_SESSION['id']) {
                      if ($uid != $_SESSION['uid']) {
                        $hack = 'Cannot modify another user\'s info from your account';
                        $uidok = false;
                      }
                    }
                    else {
                      if ($stmt = mysqli_prepare($connect, "select * from Users where uid=?")) {
                        mysqli_stmt_bind_param($stmt, "s", $uid);
                        mysqli_stmt_execute($stmt);
                        $ures = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($ures);

                        if ($row) { //if username doesn't exist
                          $hack = 'User already exists';
                          $uidok = false;
                        }
                      }
                    }

                    if ($uidok) {
                      if ($pwd != '') { //if pwd is empty
                        if ($pwd == strip_tags($pwd)) { //if pwd contains HTML tags
                          if ($about != '') { //if about is empty
                            if ($about == strip_tags($about)) { //if about contains HTML tags
                              $hack = 'pass';
                            }
                            else $hack = 'About contains HTML tags';
                          }
                          else $hack = 'About is empty';
                        }
                        else $hack = 'Password contains HTML tags';
                      }
                      else $hack = 'Password is empty';
                    }
                  }
                  else $hack = 'Username is empty';
                }
              }
              else $hack = 'Sex has not been set';
            }
            else $hack = "Email already belongs to another user";
          }
        }
        else $hack = 'Email is not valid';
      }
      else $hack = 'Email is empty';
    }
    else $hack = 'Name contains HTML tags';
  }
  else $hack = 'Name is empty';
?>
