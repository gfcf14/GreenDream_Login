<?php
  $getid = "select * from Users where uid='$uid'";
  $gres = mysqli_query($connect, $getid);
  $row = mysqli_fetch_assoc($gres);

  $imgid = $row['id'];

  $dir = 'Users/';
  $file = $dir . 'user' . $imgid . '.' . $imgext;

  $upload = move_uploaded_file($_FILES['userimage']['tmp_name'], $file);
?>
