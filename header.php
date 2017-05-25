<html>
  <head>
    <meta charset='UTF-8' />
    <title><?php echo $title;?></title>
    <link rel=StyleSheet type="text/css" href="styles.css" />
    <link rel="SHORTCUT ICON" href="http://yoursite.com/icon.ico">
    <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type='text/javascript' src="scripts.js"></script>
  </head>
  <body style='margin: 0px; position: relative;'>
    <div id='cover' style='background-color: #000000; opacity: 0.5; position: absolute; width: 100%; height: 100vh; z-index: 99; visibility: hidden;' onclick="goBack();"></div>
    <div style="position: absolute; width: 100%; height: 101px; background: linear-gradient(#007146, #ffffff, #007146); z-index: -99;"></div>
    <div style="position: absolute; top: 101px; width: 100%; height: 25px; background: #00663f; z-index: -98;"></div>
    <div style='width: 100%; text-align: center;'>
      <a href='index.php'><img id="logo" src="yoursite.com/images/greendream.png" alt="" ></a>
    </div>
    <div id='statsbar'></div>
