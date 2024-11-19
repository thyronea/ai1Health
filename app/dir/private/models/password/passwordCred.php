<?php
$new_token = md5(rand());
$email = mysqli_real_escape_string($con, $_POST['email']);

$check_email = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
$check_email_run = mysqli_query($con, $check_email);
$row = mysqli_fetch_assoc($check_email_run);
$userID = mysqli_real_escape_string($con, $row['userID']);
$engineID = mysqli_real_escape_string($con, $row['engineID']);
$groupID = mysqli_real_escape_string($con, $row['groupID']);

$get_token = "SELECT * FROM token WHERE userID=$userID LIMIT 1";
$get_token_run = mysqli_query($con, $get_token);
$token = mysqli_fetch_assoc($get_token_run);
$key = mysqli_real_escape_string($con, $token["dk_token"]);

$get_profile = "SELECT * FROM profile WHERE userID=$userID LIMIT 1";
$get_profile_run = mysqli_query($con, $get_profile);
$profile = mysqli_fetch_assoc($get_profile_run);
$fname = htmlspecialchars(decryptthis($profile["fname"], $key));
$lname = htmlspecialchars(decryptthis($profile["lname"], $key));

$subject = htmlspecialchars("Reset Password");
$message = htmlspecialchars_decode("
Hello $fname,

TO RESET YOUR PASSWORD, PLEASE CLICK ON THE LINK BELOW:
https://ai1system.net/system/view/reset-pw/deelos.php?userID=$userID&token=$new_token

If you did not make this request, please contact admin.

Thank you!
");
?>