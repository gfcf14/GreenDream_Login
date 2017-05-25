<div style=' border-bottom: 1px solid black; width: 100%; max-height: 25px; height: 25px;'>
  <div class='tablecenter' style='width: calc(100% - 10px); padding-bottom: 3px;'>
    <div class='barelem'>
      <a href='index.php'><img src='home.png' alt='' /></a>
    </div>
    <div class='barelem'>
      <?php echo "Welcome, <a href='profile.php?user=" . $_SESSION['uid'] . "' class='dreamgreen'>" . $_SESSION['uid'] . "</a>"; ?>
    </div>
    <div class='barelem'>
      <form id='signoutform' method='POST' action='signout.php'>
        <button id='signoutbutton' type='button' class='popbtn barbtn'>SIGN OUT</button>
      </form>
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
