<?php

// Create connection
  $servername = "db";
  $username = "aqfusshsmb";
  $password = "C4AB02C04ADCACFEDB1362859F03B4E03EE59F36!";
  $database = "aqfusshsmb";

  $con = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
  }

?>
