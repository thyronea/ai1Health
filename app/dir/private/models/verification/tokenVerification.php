<?php
$token = htmlspecialchars($_GET['token']);
$token_query = "SELECT token, status FROM token WHERE token='$token' LIMIT 1";
$token_query_run = mysqli_query($con, $token_query);    
?>