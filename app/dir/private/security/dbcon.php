<?php

// Create connection
  $servername = "localhost"; // mariadb / localhost
  $username = "mkpnktxrxw"; // root / mkpnktxrxw
  $password = "p3GNsFe44G"; // Grayson2019! / p3GNsFe44G
  $database = "mkpnktxrxw"; // ai1health / mkpnktxrxw

  $con = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
  }

?>
