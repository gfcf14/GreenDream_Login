<?php
  $host_name  = "xxxxx";
  $database   = "xxxxx";
  $user_name  = "xxxxx";
  $password   = "xxxxx";


  $connect = mysqli_connect($host_name, $user_name, $password, $database);
  $db_selected = mysqli_select_db($connect, $database);

  if ($db_selected) {
    $userTableName = 'Users';

    $userTableExists = mysqli_query($connect, "select * from $userTableName");
    if (!$userTableExists) {
      $sqlCreateTable = "create table " . $userTableName . "( id int(10) not null PRIMARY KEY AUTO_INCREMENT,
                                                              name varchar(25) not null,
                                                              email varchar(25) not null,
                                                              sex varchar(1) not null,
                                                              img varchar(5) not null,
                                                              uid varchar(25) not null,
                                                              pwd varchar(60) not null,
                                                              about varchar(100) not null,
                                                              active varchar(60),
                                                              token varchar(60),
                                                              datelimit int(10))";
      $result = mysqli_query($connect, $sqlCreateTable);
    }
  }
?>
