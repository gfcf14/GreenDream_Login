<div class='popup' id='signup' style='width: 30%; max-width: 30%;'>
  <button class='close' onclick="fadeOut('signup');">X</button>
  <div class='center'>
    <div class='tablecenter' style='width: 90%;'>
      <h2><?php echo $poptitle; ?></h2>
      <div class='center' style='font-size: 15px;'>
        <?php echo $popinfo; ?>
      </div>
    </div>
    <div id='mainformerror' class='bgwhite red' style='display: block; width: 100%; height: 20px; border: 2px solid #ff0000; border-radius: 10px; opacity: 0;'></div>
  </div>
  <form id='signupform' enctype="multipart/form-data">
    <table class='poptable white'>
      <tr>
        <td class='formtext'>
          Name:
        </td>
        <td>
          <input id='name' class='signupinput' type='text' name='name' placeholder='Full or just First Name' onkeyup="checkComplete('signup');" size=25 maxlength=25 value='<?php echo $name; ?>' />
        </td>
      </tr>
     <tr>
        <td class='formtext'>
          E-mail:
        </td>
        <td>
          <input id='email' class='signupinput' type='text' name='email' placeholder='Email' size=25 maxlength=25 value='<?php echo $email; ?>' />
        </td>
        <td class='statscol'>
          <img id='emailstats' style='vertical-align: middle; <?php if (!$email) echo "display: none;"; ?>' src='fieldsuccess.png' />
        </td>
      </tr>
      <tr>
        <td class='formtext'>
          I am:
        </td>
        <td>
          <input type='radio' name='sex' value='m' onchange="checkComplete('signup');" <?php if ($sex == 'm') echo "checked"; ?> />Male&nbsp;<input type='radio' name='sex' value='f' onchange="checkComplete('signup');" <?php if ($sex == 'f') echo "checked"; ?> />Female
        </td>
      </tr>
      <tr>
        <td colspan='2' class='center'>
          <input id='usrimg' type='file' accept='image/*' name='userimage' style='display: none;' />
          <button id='bimg' type='button' class='popbtn' onclick='browseImage();' <?php if ($img == 'no') echo "disabled='disabled'"; ?>>PROFILE PIC (use a 150x150 image)</button>
          <div style='width: 100%; text-align: left;'>
            <input type='checkbox' id='imgdef' <?php if ($img == 'no') echo "checked"; ?> /><div class='white' style='display: inline; cursor: pointer;' onclick="$('#imgdef').click();">Use a default image for now</div>
          </div>
        </td>
        <td class='statscol' style='vertical-align: top;'>
          <img id='imgstats' style='vertical-align: middle; display: none;' src='imgsuccess.png' />
        </td>
      </tr>
      <tr>
        <td class='formtext'>
          Username:
        </td>
        <td>
          <input id='username' class='signupinput' type='text' name='uid' placeholder='Username' onfocusout="checkUID(this.value);" onkeyup="checkComplete('signup');" size=25 maxlength=25 value=<?php echo "'" . $uid . "'" . $popdisabled; ?> />
        </td>
        <td class='statscol'>
          <img id='usrnmstats' style='vertical-align: middle; display: none;' src='fieldsuccess.png' />
        </td>
      </tr>
      <tr>
        <td class='formtext'>
          Password:
        </td>
        <td>
	        <input id='password' class='signupinput' type='password' name='pwd' placeholder='Password' onkeyup="checkPassword('signup');" size=25 maxlength=25 />
        </td>
        <td class='statscol'>
          <img id='pwdstats1' style='vertical-align: middle; display: none;' src='fieldsuccess.png' />
        </td>
      </tr>
      <tr>
        <td class='formtext'>
          Repeat:
        </td>
        <td>
          <input id='password2' class='signupinput' type='password' name='pwd2' placeholder='Repeat Password' onkeyup="checkPassword('signup');" size=25 maxlength=25 />
        </td>
        <td class='statscol'>
          <img id='pwdstats2' style='vertical-align: middle; display: none;' src='fieldsuccess.png' />
        </td>
      </tr>
      <tr>
        <td class='formtext' style='vertical-align: top;'>
          About You:
        </td>
        <td>
          <textarea id='about' class='signupinput' name='about' style='width: 100%;' rows=3 placeholder='A bit about yourself'><?php echo $about; ?></textarea>
        </td>
      </tr>
      <tr>
        <td colspan='3'  style='text-align: center;'>
          <button type='button' id='formbtn' class='popbtn' disabled='disabled' name=<?php echo "'" . $popbtnname . "'>" . $popbtntitle; ?></button>
        </td>
      </tr>
    </table>
  </form>
</div>
