<?php
  $title = "GreenDream: Recovery";
  include('header.php');
?>

<br />
<form id='recoverform'>
  <table class='poptable'>
    <tr>
      <th>Select which information you wish to recover:</th>
    </tr>
    <tr>
      <td colspan='3'>
        I forgot my: <input type='radio' name='forgot' value='username' onchange="checkComplete('recover');" />Username <input type='radio' name='forgot' value='password' onchange="checkComplete('recover');" />Password
      </td>
    </tr>
    <tr>
      <td colspan='3'>Your email: <input id='recemail' type='text' name='email' onkeyup="checkComplete('recover');"/></td>
    </tr>
    <tr>
      <td colspan='3'>
        <div class='center'>
          <button id='recbutton' type='button' class='popbtn' disabled='disabled'>RECOVER</button>
        </div>
      </td>
    </tr>
  </table>
</form>
<br />

<div id='recoverymsg' class='tablecenter center bgdreamgreen white' style='width: 50%; border-radius: 10px; padding: 10px 10px; display: none;'></div>

<?php
  include('footer.php');
?>
