<?php
  session_start();

  $title = "GreenDream: Login";

  include('header.php');

  if ($_SESSION['id']) include('loggedin.php');
  else include('notloggedin.php');
?>

<div style='text-align: center;'>
  <h1>Welcome to GreenDream</h1>
  <table style='width: 90%; margin: 0px auto;'>
    <tr>
      <td style='width: 35%;'>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut pulvinar felis. Morbi neque mauris, tempus et feugiat a, dictum quis lorem. Nullam fermentum semper nisl, at congue nulla mattis vel. Integer nec egestas lacus. Mauris ac diam lacus. Sed gravida id enim ac vestibulum. Cras sodales accumsan lectus eget feugiat. Suspendisse congue egestas velit blandit tempor. Duis sed lacinia lorem. Vestibulum tellus justo, sollicitudin in aliquam eget, rhoncus eu lacus. Quisque et turpis sed lorem pretium condimentum eget nec mauris. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque ipsum metus, laoreet ac eros ut, dapibus placerat purus. Vivamus risus felis, mattis id erat vel, tincidunt eleifend nibh. Integer nec gravida tellus. Nulla at lectus tellus.
        Duis non feugiat magna, nec condimentum magna. Nunc commodo libero ac lacinia malesuada. Donec varius semper ante, eget egestas enim rutrum ut. Vivamus sodales erat in ultrices semper. Donec ut egestas quam.
      </td>
      <td style='width: 65%;'>
        <img src="yoursite.com/someimage.png" style='width: 100%; ' />
      </td>
    </tr>
  </table>
</div>

<?php
  include('footer.php');
?>
