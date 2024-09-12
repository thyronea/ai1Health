<?php

// Create connection
  $servername = "mariadb"; // mariadb / localhost
  $username = "root"; // root / mkpnktxrxw
  $password = "Grayson2019!"; // Grayson2019! / p3GNsFe44G
  $database = "ai1health"; // ai1health / mkpnktxrxw

  $con = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
  }

?>
