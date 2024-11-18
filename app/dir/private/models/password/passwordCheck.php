<?php
include(PRIVATE_MODELS_PATH . '/admin/sessions.php'); 

// Fetch salt and entered password for validation
$sql = "SELECT * FROM token WHERE userID='$userID' ";
$sql_run = mysqli_query($con, $sql);
$token_row = mysqli_fetch_assoc($sql_run);
$currentSalt = mysqli_real_escape_string($con, $token_row['salt']);
$enteredPassword = mysqli_real_escape_string($con, $_POST['password']);
$password_salt = "$enteredPassword$currentSalt";

// Retrieves password to verify entered password
$user_query = "SELECT * FROM admin WHERE userID='$userID' ";
$user_query_run = mysqli_query($con, $user_query);
$user = mysqli_fetch_assoc($user_query_run);
$currentPassword = mysqli_real_escape_string($con, $user['password']);
?>