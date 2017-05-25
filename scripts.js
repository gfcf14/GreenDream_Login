var imgReady = false;
var invalidUID = false;
var maxPasswordLength = 20;
var passwordTooLong = false;
var passwordsMatch = false;
var invalidEmail = false;
var cannotRecover = false;
var cannotChangePassword = false;
var msgMax = 200;

var days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
var months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

function displayTime() {
  var rightnow = new Date();
  var dateSuffix = 'th';

  var currDate = rightnow.getDate();
  if (currDate == '1' || currDate == '21' || currDate == '31') dateSuffix = 'st';
  else if (currDate == '2' || currDate == '22') dateSuffix = 'nd';
  else if (currDate == '3' || currDate == '23') dateSuffix = 'rd';

  $('#currdate').html(days[rightnow.getDay()] + ', ' + months[rightnow.getMonth()] + ' ' + currDate + dateSuffix + ' ' + rightnow.getFullYear());

  var h = rightnow.getHours();
  var meridiem = 'AM';

  if (h > 12) {
    h -= 12;
    meridiem = 'PM';
  }
  else if (h == 12) meridiem = 'PM';
  else if (h == 0) {
    h = 12;
    meridiem = 'AM';
  }

  var m = rightnow.getMinutes();
  m = (m < 10) ? '0' + m : m;

  var s = rightnow.getSeconds();
  s = (s < 10) ? '0' + s : s;

  $('#currtime').html(h + ':' + m + ':' + s + ' ' + meridiem);
}

$(document).keyup(function(e) {
  if (e.which == 27) { //Esc key was pressed
    goBack();
  }
});

$(function() {
  displayTime();
  setInterval(displayTime, 500);

  $('.signupinput').on('change keyup', function(e) {
    checkComplete('signup');
  });

  $('.signupinput').keyup(function(e) {
    if (e.which == 13) { //Enter key was pressed
      if (!$('#formbtn').is(':disabled')) hideAndClick('#formbtn');
    }
  });

  $('.signininput').keyup(function(e) {
    if (e.which == 13) { //Enter key was pressed
      if (!$('#signinbtn').is(':disabled')) hideAndClick('#signinbtn');
    }
  });

  $('#msg').keyup(function(e) {
    if (e.which == 13) { //Enter key was pressed
      if (!$('#msgbtn').is(':disabled')) hideAndClick('#msgbtn');
    }
  });

  $('#formbtn').click(function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    var filextension;

    if (!(document.getElementById('imgdef').checked)) filextension = $('#usrimg').val().substr($('#usrimg').val().lastIndexOf('.') + 1);
    else filextension = 'no';

    var fdata = new FormData();
    fdata.append('name', $('#name').val());
    fdata.append('email', $('#email').val());
    fdata.append('sex', $("#signupform input[type='radio']:checked").val());
    fdata.append('userimage', $('#usrimg').prop("files")[0]);
    fdata.append('uid', $('#username').val());
    fdata.append('pwd', $('#password').val());
    fdata.append('about', $('#about').val());
    fdata.append('filextension', filextension);

    var phpFile = '';
    if ($('#formbtn').attr("name") == 'edit') phpFile = "update.php";
    else phpFile = "signup.php";

    $.ajax({
      type: "POST",
      url: phpFile,
      data: fdata,
      processData: false,
      contentType: false,
      success: function(response){
        if (response == 'pass') {
          if ($('#formbtn').attr("name") != 'edit') document.getElementById('signupform').reset();
          $('#bimg').prop('disabled', false);
          $('#imgstats').hide();
          $('#emailstats').hide();
          $('#usrnmstats').hide();
          $('#pwdstats1').hide();
          $('#pwdstats2').hide();
          $('#formbtn').prop('disabled', true);

          fadeOut('signup');

          $('#statsbar').css({background: '#00b456'});
          if ($('#formbtn').attr("name") == 'edit') $('#statsbar').text('SUCCESS! USER HAS BEEN UPDATED');
          else $('#statsbar').text('SUCCESS! USER HAS BEEN ADDED');
          $('#statsbar').css({width: '90%'});
        }
        else {
          console.log(response);
          fadeOut('signup');

          $('#statsbar').css({background: '#ff0000'});
          if ($('#formbtn').attr("name") == 'edit') $('#statsbar').text('ERROR: UNABLE TO UPDATE USER');
          else $('#statsbar').text('ERROR: UNABLE TO ADD USER');
          $('#statsbar').css({width: '90%'});
        }
      }
    });
    return false;
  });

  $('#signinbtn').click(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "checksignin.php",
      data: {username: $('#signinusrnm').val(), password: $('#signinpwd').val()},
      success: function(response){
        if (response == 'wrong' || response == 'notfound') {
          $('#signinerror').html('Incorrect username or password!');
          $('#signinerror').css({opacity: 1});
        }
        else if (response == 'notactive') {
          $('#signinerror').html('Check your email and activate first');
          $('#signinerror').css({opacity: 1});
        }
        else if (response == 'pass') {
          $('#signinerror').css({opacity: 0});
          fadeOut('signin');

          $('#statsbar').css({background: '#00b456'});
          $('#statsbar').text('YOU HAVE SUCCESSFULLY SIGNED IN!');
          $('#statsbar').css({width: '90%'});
        }
        else {
          $('#signinerror').html(response);
          $('#signinerror').css({opacity: 1});
        }
      }
    });
  });

  $('#usrimg').change(function() {
    var filename = $('#usrimg').val();
    var fileext = filename.substr(filename.lastIndexOf('.') + 1);

    if (fileext == 'png' || fileext == 'PNG' || fileext == 'jpg' || fileext == 'jpeg' || fileext == 'JPG' || fileext == 'JPEG' || fileext == 'gif' || fileext == 'GIF' || fileext == 'bmp' || fileext == 'BMP') {
      var file, img;
      if ((file = this.files[0])) {
        img = new Image();
        img.onload = function() {
          if (this.width == 150 && this.height == 150) {
            imgReady = true;
            $('#imgstats').show();
            $('#imgstats').attr('src', 'imgsuccess.png');
            $('#imgstats').attr('title', 'Image is valid!');
          }
          else {
            imgReady = false;
            $('#imgstats').show();
            $('#imgstats').attr('src', 'imgsizefail.png');
            $('#imgstats').attr('title', 'Please use a 150x150 image');
          }
        };
        img.src = window.URL.createObjectURL(file);
      }
    }
    else {
      imgReady = false;
      $('#imgstats').show();
      $('#imgstats').attr('src', 'imgtypefail.png');
      $('#imgstats').attr('title', 'Please use jpg, png, gif, or bmp');
    }

    checkComplete('signup');
  });

  $('#imgdef').change(function() {
    if (document.getElementById('imgdef').checked) {
      $('#imgstats').hide();
      $('#bimg').prop('disabled', true);
    }
    else {
      if ($('#usrimg').val() != '') $('#imgstats').show();
      $('#bimg').prop('disabled', false);
    }

    checkComplete('signup');
  });

  $('#statsbar').on('transitionend', function() {
    if (parseInt($('#statsbar').width()) == parseInt(($(window).width() * 0.9)) && $('#statsbar').css('opacity') == '1') {
      if ($('#statsbar').text() == 'YOU HAVE SUCCESSFULLY SIGNED IN!') $('#signinform').submit();
      else if ($('#statsbar').text() == 'YOU HAVE SIGNED OUT SUCCESSFULLY') $('#signoutform').submit();
      else if ($('#statsbar').text() == 'SUCCESS! USER HAS BEEN UPDATED') location.reload();
      else $('#statsbar').css({opacity: 0});
    }
    else if (parseInt($('#statsbar').width()) == parseInt(($(window).width() * 0.9)) && $('#statsbar').css('opacity') == '0') {
      $('#statsbar').css({width: '0px'});
    }
    else if (parseInt($('#statsbar').width()) == '0' && $('#statsbar').css('opacity') == '0') {
      $('#statsbar').css({opacity: 1});
    }
  });

  $('#signoutform').click(function(e) {
    e.preventDefault();
    $('#statsbar').css({background: '#00b456'});
    $('#statsbar').text('YOU HAVE SIGNED OUT SUCCESSFULLY');
    $('#statsbar').css({width: '90%'});
  });

  $('#recbutton').click(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "recover.php",
      data: {type: $("#recoverform input[type='radio']:checked").val(), email: $('#recemail').val()},
      success: function(response) {
        if (response) {
          cannotRecover = true;
          $('#recbutton').prop('disabled', true);
          $('#recoverymsg').show();
          $('#recoverymsg').html(response);
        }
      }
    });
    return false;
  });

  $('#email').focusout(function(e) {
    if ($('#email').val() == '') {
      $('#emailstats').hide();
      $('#mainformerror').css({opacity: 0});
    }
    else {
      $.post('checkemail.php', {email: $('#email').val()}, function(data) {
        if (data == 'notvalid') {
          invalidEmail = true;
          $('#mainformerror').html('Please enter a valid email');
          $('#mainformerror').css({opacity: 1});

          $('#emailstats').attr('src', 'fieldfail.png');
          $('#emailstats').show();
        }
        else if (data == 'used') {
          invalidEmail = true;
          $('#mainformerror').html('Email belongs to existing user');
          $('#mainformerror').css({opacity: 1});

          $('#emailstats').attr('src', 'fieldfail.png');
          $('#emailstats').show();
        }
        else if (data == 'valid') {
          invalidEmail = false;
          $('#emailstats').attr('src', 'fieldsuccess.png');
          $('#emailstats').show();
          $('#mainformerror').css({opacity: 0});
        }
        else console.log(data);
      });
    }

    checkComplete('signup');
  });

  $('#changepwdbtn').click(function(e) {
    e.preventDefault();
    $.post('passwordchange.php', {newpass: $('#newpwd1').val(), token: $('#ptoken').val()}, function(data) {
      if (data != '') {
        cannotChangePassword = true;
        $('#changepwdbtn').prop('disabled', true);
        $('#changepwdmsg').show();
        $('#changepwdmsg').html(data);
      }
    });
    return false;
  });

  $('#msgbtn').click(function(e) {
    e.preventDefault();
    $.post('sendmessage.php', {msg: $('#msg').val()}, function(data) {
      if (data == 'sent') {
        document.getElementById('msgform').reset();
        $('#msgbtn').prop('disabled', true);
        $('#charrem').html('Characters remaining: 200');
        $('#charrem').css({background: '#00b456'});

        fadeOut('message');

        $('#statsbar').css({background: '#00b456'});
        $('#statsbar').text('SUCCESS! MESSAGE HAS BEEN SENT');
        $('#statsbar').css({width: '90%'});
      }
      else {
        console.log(data);
        fadeOut('message');

        $('#statsbar').css({background: '#ff0000'});
        $('#statsbar').text('ERROR: COULD NOT SEND MESSAGE');
        $('#statsbar').css({width: '90%'});
      }
    });
    return false;
  });
});


function fadeIn(id) {
  document.getElementById(id).style.zIndex = 100;
  document.getElementById(id).style.opacity = 1;
  document.getElementById('cover').style.visibility = 'visible';

  if (id == 'signup') $('#name').focus();
  else if (id == 'signin') $('#signinusrnm').focus();
  else if (id == 'message') $('#msg').focus();
}

function fadeOut(id) {
  document.getElementById(id).style.opacity = 0;
  document.getElementById('cover').style.visibility = 'hidden';
  document.getElementById(id).style.zIndex = -1;
}

function goBack() {
  if ($('#signup').length && document.getElementById('signup').style.opacity == 1) fadeOut('signup');
  else {
    if ($('#message').length && document.getElementById('message').style.opacity == 1) fadeOut('message');
    else {
      if ($('#signin').length && document.getElementById('signin').style.opacity == 1) fadeOut('signin');
    }
  }
}

function hideAndClick(id) {
  $(document.activeElement).blur();
  $(id).click();
}

function checkUID(uid) {
  if ($('#username').val() == '') {
    $('#usrnmstats').hide();
  }
  else {
    $.post('checkuid.php', {username: $('#username').val()}, function(data) {
      if (!data) {
        invalidUID = true;
        $('#mainformerror').html('Username is taken!');
        $('#formbtn').prop('disabled', true);
        $('#mainformerror').css({opacity: 1});

        $('#usrnmstats').attr('src', 'fieldfail.png');
        $('#usrnmstats').show();
      }
      else {
        invalidUID = false;

        $('#usrnmstats').attr('src', 'fieldsuccess.png');
        $('#usrnmstats').show();

        checkComplete('signup');
        $('#mainformerror').css({opacity: 0});
      }
    });
  }
}

function checkComplete(type) {
  if (type == 'signup') {
    if ($('#fname').val() == '' || $('#lname').val() == '' || ($('#email').val() == '' || invalidEmail) || !$("input[name='sex']:checked").val() ||($('#formbtn').attr("name") != 'edit' && !imgReady && !(document.getElementById('imgdef').checked)) || ($('#username').val() == '' || invalidUID) || ($('#password').val() == '' || $('#password2').val() == '' || passwordTooLong || !passwordsMatch) || $('#about').val() == '') {
      $('#formbtn').prop('disabled', true);
    }
    else $('#formbtn').prop('disabled', false);
  }
  else if (type == 'signin') {
    if ($('#signinusrnm').val() == '' || $('#signinpwd').val() == '') $('#signinbtn').prop('disabled', true);
    else $('#signinbtn').prop('disabled', false);
  }
  else if (type == 'recover') {
    if (!$("input[name='forgot']:checked").val() || $('#recemail').val() == '' || cannotRecover) $('#recbutton').prop('disabled', true);
    else $('#recbutton').prop('disabled', false);
  }
  else if (type == 'password') {
    if ($('#newpwd1').val() == '' || $('#newpwd2').val() == '' || cannotChangePassword || passwordTooLong || !passwordsMatch) $('#changepwdbtn').prop('disabled', true);
    else $('#changepwdbtn').prop('disabled', false);
  }
  else if (type == 'message') {
    var charrem = msgMax - $('#msg').val().length;

    if (charrem < 0 || charrem == 200) $('#msgbtn').prop('disabled', true);
    else {
      $('#msgbtn').prop('disabled', false);

      if (charrem >= 50) $('#charrem').css({background: '#00b456'});
      else if (charrem >= 20 && charrem < 50) $('#charrem').css({background: '#cece0e'});
      else if (charrem < 20) $('#charrem').css({background: '#ff0000'});
    }
    if (charrem >= 0) $('#charrem').html('Characters remaining: ' + charrem);
    else $('#charrem').html('Characters remaining: 0');
  }
}

function browseImage() {
  $('#usrimg').click();
}

function checkPassword(type) {
  var checkCompleteType = '';

  var p1 = '';
  var p2 = '';
  var ps1 = '';
  var ps2 = '';
  var err = '';

  if (type == 'signup') {
    p1 = '#password';
    p2 = '#password2';
    ps1 = '#pwdstats1';
    ps2 = '#pwdstats2';
    err = '#mainformerror';
    checkCompleteType = 'signup';
  }
  else if (type == 'password') {
    p1 = '#newpwd1';
    p2 = '#newpwd2';
    ps1 = '#npwdstats1';
    ps2 = '#npwdstats2';
    err = '#changepwderror';
    checkCompleteType = 'password';
  }

  if ($(p1).val() == '') {
    $(ps1).hide();
    $(ps2).hide();
    $(err).css({opacity: 0});
  }
  else {
    var pval = $(p1).val();

    if ($(p2).val() == '') {
      if (pval.length > maxPasswordLength) {
        passwordTooLong = true;
        $(err).html('Password can\'t exceed ' + maxPasswordLength + ' characters');
        $(err).css({opacity: 1});

        $(ps1).attr('src', 'fieldfail.png');
        $(ps1).show();
      }
      else {
        passwordTooLong = false;
        $(err).css({opacity: 0});

        $(ps1).attr('src', 'fieldsuccess.png');
        $(ps1).show();
      }
    }
    else {
      var rval = $(p2).val();
      if (pval != rval) {
        passwordsMatch = false;
        $(err).html('Passwords don\'t match!');
        $(err).css({opacity: 1});

        $(ps1).attr('src', 'fieldfail.png');
        $(ps1).show();
        $(ps2).attr('src', 'fieldfail.png');
        $(ps2).show();
      }
      else {
        passwordsMatch = true;

        if (pval.length > maxPasswordLength) {
          passwordTooLong = true;
          $(err).html('Passwords can\'t exceed ' + maxPasswordLength + ' characters');
          $(err).css({opacity: 1});

          $(ps1).attr('src', 'fieldfail.png');
          $(ps1).show();
          $(ps2).attr('src', 'fieldfail.png');
          $(ps2).show();
        }
        else {
          passwordTooLong = false;
          $(err).css({opacity: 0});

          $(ps1).attr('src', 'fieldsuccess.png');
          $(ps1).show();
          $(ps2).attr('src', 'fieldsuccess.png');
          $(ps2).show();
        }
      }
    }
  }

  checkComplete(checkCompleteType);
}
