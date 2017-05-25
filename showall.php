<?php
  session_start();

  $title = "GreenDream: All Users";

  include('header.php');

  if ($_SESSION['id']) include('loggedin.php');
  else include('notloggedin.php');
?>

<div style='text-align: center; font-size: 30px; color: #007146;'>USERS</div>
<table style='margin: 0px auto;'>
  <?php
    include('connect.php');

    $query = "select * from Users";
    $res = mysqli_query($connect, $query);

    if ($res) {
      $maxInRow = 10;
      $colCount = 0;

      while ($row = mysqli_fetch_array($res)) {
        if ($colCount == 0) echo "<tr>";
        $src = "";
        if ($row['img'] == 'no') $src = "Users/" . $row['sex'] . "def.png";
        else $src = "Users/user" . $row['id'] . "." . $row['img'];

        echo "<td style='max-width: 100px; width: 100px;'>" .
               "<a href='profile.php?user=" . $row['uid'] . "'>" .
                 "<img src='" . $src . "' alt='' style='width: 100px; height: 100px;' />" .
               "</a>" .
               "<br />" .
               "<div style='max-width: 100px; text-align: center;'>" .
                 "<a href='profile.php?user=" . $row['uid'] . "' style='color: #007146;'>" .
                   $row['uid'] .
                 "</a>" .
               "</div>" .
             "</td>";
         $colCount++;
         if ($colCount == $maxInRow) {
           echo "</tr>";
           $colCount = 0;
         }
      }
    }

    mysqli_close($connect);
  ?>
</table>

<?php
  include('footer.php');
?>
