<?php
  $title = "GreenDream: Change Password";
  include('header.php');
?>

<div>
  <?php
    echo "<div style='text-align: center;'>";
    if (!isset($_GET['token'])) echo "You must click on the link provided on your email to change your password. Click <a href='forgot.php'>here</a> if you need to send a password change message to your email again";
    else {
      include('connect.php');

      $token = $_GET['token'];
      $sql = "select * from Users where token='$token'";
      $res = mysqli_query($connect, $sql);

      if (($row =  mysqli_fetch_assoc($res))) {
        $datelimit = $row['datelimit'];
        $datenow = idate(U);

        if ($datenow - $datelimit > 300) {
          echo "This password token has expired. Click <a href='forgot.php'>here</a> to send a password change message to your email again";
        }
        else {
          echo "<form id='passchangeform'>
                  <table class='poptable'>
                    <tr>
                      <th>Enter the information to change:</th>
                    </tr>
                    <tr>
                      <td colspan='2'>
                        <div id='changepwderror' class='bgred white center' style='display: block; width: 100%; height: 20px; border: 2px solid #ffffff; border-radius: 10px; opacity: 0;'></div>
                      </td>
                    </tr>
                    <tr>
                      <td class='formtext'>New password:</td>
                      <td><input id='newpwd1' type='password' placeholder='New Password' name='npwd' size=22 maxlength=25 onkeyup=\"checkPassword('password');\"/>&nbsp;<div style='display: inline-block; width: 25px;'><img id='npwdstats1' style='vertical-align: middle; display: none;' src='fieldsuccess.png' /></div></td>
                    </tr>
                    <tr>
                      <td class='formtext'>Repeat:</td>
                      <td><input id='newpwd2' type='password' placeholder='Repeat New Password' name='npwd2' size=22 maxlength=25 onkeyup=\"checkPassword('password');\"/>&nbsp;<div style='display: inline-block; width: 25px;'><img id='npwdstats2' style='vertical-align: middle; display: none;' src='fieldsuccess.png' /></div></td>
                    </tr>
                    <tr>
                      <td colspan='3'>
                        <div class='center'>
                          <input id='ptoken' type='hidden' name='token' value='$token' />
                          <button id='changepwdbtn' type='button' class='popbtn' disabled='disabled'>CHANGE PASSWORD</button>
                        </div>
                      </td>
                    </tr>
                  </table>
                </form>
                <br />
                <div id='changepwdmsg' class='tablecenter center bgdreamgreen white' style='width: 50%; border-radius: 10px; padding: 10px 10px; display: none;'></div>";
        }
      }
      else echo "The token provided is not valid. Your password will not be changed unless you provide a valid one";

      mysqli_close($connect);
    }

    echo "</div>";
  ?>
</div>
