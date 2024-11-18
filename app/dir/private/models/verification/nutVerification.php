<?php
// Verification to register new user created by admin (nut: new user token)
$nut = htmlspecialchars($_GET['nut']);
$nut_query = "SELECT token, status FROM token WHERE token='$nut' LIMIT 1";
$nut_query_run = mysqli_query($con, $nut_query);
?>