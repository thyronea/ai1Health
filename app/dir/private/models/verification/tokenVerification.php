<?php
// Verification to register new user
$token = mysqli_escape_string($con, $_GET['token']);
$token_query = "SELECT token, status FROM token WHERE token='$token' LIMIT 1";
$token_query_run = mysqli_query($con, $token_query);

// Verification to reset password; Retrieves patientID to update_password for update
$check_token = "SELECT * FROM token WHERE token='$token' LIMIT 1";
$check_token_run = mysqli_query($con, $check_token);
$getID = mysqli_fetch_assoc($check_token_run);
$userID = mysqli_real_escape_string($con, $getID['userID']); 
$salt = mysqli_real_escape_string($con, $getID['salt']); 
?>