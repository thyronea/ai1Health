<?php
$vcode1 = mysqli_real_escape_string($con, $_POST['vcode1']);
$vcode2 = mysqli_real_escape_string($con, $_POST['vcode2']);
$vcode3 = mysqli_real_escape_string($con, $_POST['vcode3']);
$vcode4 = mysqli_real_escape_string($con, $_POST['vcode4']);
$vcode = "$vcode1$vcode2$vcode3$vcode4";
$type = mysqli_real_escape_string($con, "Signed in");
$log = mysqli_real_escape_string($con, "Logged in");

// Retrieves userID for verification
$login_query = "SELECT * FROM token WHERE v_code='$vcode'";
$login_query_run = mysqli_query($con, $login_query);
$verification = mysqli_fetch_assoc($login_query_run);
$userID = mysqli_real_escape_string($con, $verification["userID"]);
$groupID = mysqli_real_escape_string($con, $verification["groupID"]);
$key = mysqli_real_escape_string($con, $verification["dk_token"]); // Used for data encryption and decryption

// Retrieves userID and passes to user_query
$email_query = "SELECT * FROM profile WHERE userID='$userID' ";
$email_query_run = mysqli_query($con, $email_query);
$get_email = mysqli_fetch_assoc($email_query_run);
$email = htmlspecialchars(decryptthis($get_email["email"], $key));

// Retrieves password to verify entered password
$user_query = "SELECT * FROM admin WHERE userID='$userID' ";
$user_query_run = mysqli_query($con, $user_query);
$user = mysqli_fetch_assoc($user_query_run);
?>