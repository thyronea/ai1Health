<?php

// Create connection
  $servername = "localhost"; // mariadb
  $username = "aqfusshsmb"; // root
  $password = "MEMrQhJxm7"; // Grayson2019!
  $database = "aqfusshsmb"; // ai1health

  $con = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
  }

?>
