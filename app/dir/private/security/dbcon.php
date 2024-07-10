<?php

// Create connection
  $servername = "localhost"; // mariadb / localhost
  $username = "aqfusshsmb"; // root / aqfusshsmb
  $password = "MEMrQhJxm7"; // Grayson2019! / MEMrQhJxm7
  $database = "aqfusshsmb"; // ai1health / aqfusshsmb

  $con = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
  }

?>
