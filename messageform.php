<div class='popup' id='message' style='width: 50%;'>
  <button class='close' onclick="fadeOut('message');">X</button>
  <form id='msgform'>
    <table class='poptable white' style='width: 90%;'>
      <tr>
        <th colspan='2'>
          <h2>MESSAGE TO: <?php echo $uid; ?></h2>
        </th>
      </tr>
      <tr>
        <td colspan=2>
          Your message: <textarea id='msg' onkeyup="checkComplete('message');" name='about' style='width: 100%;' rows=5 placeholder='Write something (max 200 chars)'></textarea>
        </td>
      </tr>
      <tr>
        <td colspan=2 class='formtext white'>
          <div id='charrem' class='bgnaturalgreen' style='display: inline-block; padding: 5px;'>
            Characters remaining: 200
          </div>
        </td>
      </tr>
      <tr>
        <td colspan='2'  class='center'>
          <button type='button' id='msgbtn' class='popbtn' disabled='disabled'>SEND MESSAGE</button>
        </td>
      </tr>
    </table>
  </form>
</div>
