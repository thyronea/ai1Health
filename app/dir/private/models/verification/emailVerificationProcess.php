<?php
// User's email from the login form:
$email = mysqli_real_escape_string($con, $_POST['email']);

// Use email to retrieve userID and passes to status_query to verify password
$login_query = "SELECT * FROM admin WHERE email='$email' ";
$login_query_run = mysqli_query($con, $login_query);
$user = mysqli_fetch_assoc($login_query_run);
$userID = htmlspecialchars($user["userID"]);

// Use userID to retrieve account status for login verification
$status_query = "SELECT * FROM token WHERE userID='$userID' ";
$status_query_run = mysqli_query($con, $status_query);
$status_token = mysqli_fetch_assoc($status_query_run);
$key = htmlspecialchars($status_token["dk_token"]); // Used for data encryption and decryption

// Use userID to retrieve profile; to identify email receiver
$profile_query = "SELECT * FROM profile WHERE userID='$userID' ";
$profile_query_run = mysqli_query($con, $profile_query);
$profile = mysqli_fetch_assoc($profile_query_run);
$fname = htmlspecialchars(decryptthis($profile["fname"], $key));
?>