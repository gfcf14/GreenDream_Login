<div style=' border-bottom: 1px solid black; width: 100%; max-height: 25px; height: 25px;'>
  <div class='tablecenter' style='width: calc(100% - 10px); padding-bottom: 3px;'>
    <div class='barelem'>
      <a href='index.php'><img src='home.png' alt='' /></a>
    </div>
    <div class='barelem'>
      Access the site with your account:
    </div>
    <div class='barelem'>
      <button type='button' class='popbtn barbtn' onclick="fadeIn('signup');">SIGN UP</button>
    </div>
    <div class='barelem'>
      <button type='button' class='popbtn barbtn' onclick="fadeIn('signin');">SIGN IN</button>
    </div>
    <div class='barelem' style='float: right;'>
      <div class='barelem'>
        <img src='date.png' alt='' />
      </div>
      <div id='currdate' class='barelem' style='width: 15em;'>
        Wednesday, September 30th 2017
      </div>
      <div class='barelem'>
        <img src='time.png' alt='' />
      </div>
      <div id='currtime' class='barelem' style='width: 7em;'>
        12:59:59 AM
      </div>
    </div>
  </div>
</div>

<?php
  $poptitle = 'SIGN UP';
  $popinfo = 'Please fill out ALL the fields. A confirmation e-mail will be sent upon account creation';
  $popbtnname = 'signup';
  $popbtntitle = 'SIGN UP';

  include('popform.php');
?>

<div class='popup' id='signin'>
  <button class='close' onclick="fadeOut('signin');">X</button>
  <form id='signinform' method='POST' action='signin.php'>
    <table class='poptable white'>
      <tr>
        <th colspan='2'>
          <h2>SIGN IN</h2>
        </th>
      </tr>
      <tr>
        <td colspan='2'>
          <div id='signinerror' class='bgwhite red center' style='display: block; width: 100%; height: 20px; border: 2px solid #ff0000; border-radius: 10px; opacity: 0;'></div>
        </td>
      </tr>
      <tr>
        <td class='formtext'>
          Username:
        </td>
        <td>
          <input id='signinusrnm' class='signininput' type='text' name='signinuid' placeholder='Username' onkeyup="checkComplete('signin');" />
        </td>
      </tr>
      <tr>
        <td class='formtext'>
          Password:
        </td>
        <td>
          <input id='signinpwd' class='signininput' type='password' name='signinpwd' placeholder='Password' onkeyup="checkComplete('signin');" />
        </td>
      </tr>
      <tr>
        <td colspan='2'  class='center'>
          <a href='forgot.php' style='color: white;'>Forgot Username/Password?</a>
        </td>
      </tr>
      <tr>
        <td colspan='2'  class='center'>
          <button type='button' id='signinbtn' class='popbtn' disabled='disabled'>SIGN IN</button>
        </td>
      </tr>
    </table>
  </form>
</div>
