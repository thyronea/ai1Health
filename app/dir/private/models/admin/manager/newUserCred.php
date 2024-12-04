<?php
$salt = md5(rand());
$token = md5(rand());
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$admin_fname = mysqli_real_escape_string($con, $_SESSION['fname']);
$admin_lname = mysqli_real_escape_string($con, $_SESSION['lname']);
$fromName = mysqli_real_escape_string($con, $_SESSION['fname']);

$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$newID = mysqli_real_escape_string($con, $_POST['newID']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$fname = mysqli_real_escape_string($con, $_POST['fname']);
$lname = mysqli_real_escape_string($con, $_POST['lname']);
$filename = mysqli_real_escape_string($con, "default-profile-pic.jpeg");
$background_filename = mysqli_real_escape_string($con, "default-background.jpg");
$role = mysqli_real_escape_string($con, $_POST['role']);
$location = mysqli_real_escape_string($con, $_POST['location']);
$type = mysqli_real_escape_string($con, "Registered");
$as = mysqli_real_escape_string($con, "as");
$admin = mysqli_real_escape_string($con, "Admin");
$register = mysqli_real_escape_string($con, "Registered");
$subject = mysqli_real_escape_string($con, "Registration Confirmation");
$message = htmlspecialchars("
Hello $fname,

Your Group ID is $groupID ($location).

Please only share your Group ID to members who will be given access to the account.

If you did not create this account, please contact admin.

TO COMPLETE YOUR REGISTRATION, PLEASE CLICK ON THE LINK BELOW:
http://localhost/private/controllers/auth/registrationController.php?nut=$token

Thank you!
"); 
?>