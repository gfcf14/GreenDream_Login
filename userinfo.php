<table class='tablecenter' style='width: 100%; border-spacing: 0px; max-height: 150px;'>
  <tr>
    <td style='max-width: 150px; width: 150px; max-height: 150px; height: 150px;' rowspan=3>
      <?php
        if ($img == 'no') {
              echo "<img src='Users/" . $sex . "def.png' alt=''>";
        }
        else echo "<img src='Users/user" . $id . "." . $img . "' alt=''>";
      ?>
    </td>
    <td>
      <table style='width: 100%; border-spacing: 0px;'>
        <tr>
          <td style='vertical-align: top; height: 35px; display: block; background: linear-gradient(to right, #007146 15%, #00b456 100%); color: #ffffff; font-size: 30px; text-align: left;'>
            <?php
              echo "&nbsp;" . $uid . "(" . $name . ")";
            ?>
          </td>
        </tr>
        <tr>
          <td style='max-height: 95px; height: 90px; vertical-align: top; color: #007146; font-size: 20px; padding-left: 5px;'>
            About <?php
                    echo $aboutuser . ": " . $about;
                    if ($aboutuser == 'you') echo "<br />Your email: " . $email;
                  ?>
          </td>
        </tr>
        <tr>
          <td style='max-height: 25px; height: 25px; padding-left: 5px;'>
            <div style='width: 20%;'>
              <?php if ($buttontitle != '') echo "<button id='" . $buttonid . "' type='button' class='popbtn' onclick=\"" . $onclick . "\">" . $buttontitle . "</button>"; ?>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<?php
  if ($aboutuser == 'you') {
    $poptitle = 'EDIT YOUR INFO';
    $popinfo = 'Rewrite what you want to change. Unless you have a new image, it is not required to submit one';
    $popdisabled = 'disabled';
    $popbtnname = 'edit';
    $popbtntitle = 'SAVE CHANGES';

    include('popform.php');
  }
  else {
    if ($_SESSION['id']) {
      include('messageform.php');
    }
  }
?>
