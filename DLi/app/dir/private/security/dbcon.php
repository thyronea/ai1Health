<?php

// Create connection
  $servername = "mariadb";
  $username = "root";
  $password = "Grayson2019!";
  $database = "dli";

  $con = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
  }

?>
