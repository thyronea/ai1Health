<?php
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$email = mysqli_real_escape_string($con, $_SESSION['email']);
$fname = mysqli_real_escape_string($con, $_SESSION["fname"]);
$lname = mysqli_real_escape_string($con, $_SESSION["lname"]);
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$token = md5(rand());

// Retrieves user's password to verify entered password
$user_query = "SELECT * FROM admin WHERE userID='$userID' ";
$user_query_run = mysqli_query($con, $user_query);
$user = mysqli_fetch_assoc($user_query_run);

$subject = htmlspecialchars("Reset Password");
$message = htmlspecialchars_decode("
Hello $fname,

TO RESET YOUR PASSWORD, PLEASE CLICK ON THE LINK BELOW:
https://ai1system.net/system/view/reset-pw/deelos.php?userID=$userID&token=$token

If you did not make this request, please contact admin.

Thank you!
");
?>