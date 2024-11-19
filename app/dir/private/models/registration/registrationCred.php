<?php
$key = md5(rand()); // Generate key for data decryption. IF THIS KEY IS SOME HOW BROKEN OR COMPROMISED, ALL DATA WILL BE LOST
$token = md5(rand()); // Generates random token

$salt = md5(rand()); // Code to be added after user's password
$password = mysqli_real_escape_string($con, $_POST["password"]); // User's password
$salt_hash = "$password$salt"; // User's password + salt code
$password_hash = password_hash($salt_hash, PASSWORD_DEFAULT); // Hashed salted password

$userID = mysqli_real_escape_string($con, $_POST['userID']); // Randomly Generated userID
$engineID = mysqli_real_escape_string($con, $_POST['engineID']); // Randomly Generated engineID for search engine
$groupID = mysqli_real_escape_string($con, $_POST['groupID']); // Randomly Generated groupID 

$email = mysqli_real_escape_string($con, $_POST['email']);
$role = mysqli_real_escape_string($con, $_POST['role']);
$fname = mysqli_real_escape_string($con, $_POST['fname']);
$lname = mysqli_real_escape_string($con, $_POST['lname']);

$filename = mysqli_real_escape_string($con, "default-profile-pic.jpeg");
$background_filename = mysqli_real_escape_string($con, "default-background.jpg");
$type = mysqli_real_escape_string($con, "Registered");
$as = mysqli_real_escape_string($con, "as");
$admin = mysqli_real_escape_string($con, "Admin");
$subject = mysqli_real_escape_string($con, "Registration Confirmation");
$message = htmlspecialchars("
Hello $fname,

Your Group ID is $groupID.

Please only share your Group ID to members who will be given access to the account.

If you did not create this account, please contact admin.

TO COMPLETE YOUR REGISTRATION, PLEASE CLICK ON THE LINK BELOW:

http://localhost:8002/private/controllers/auth/registrationController.php?token=$token

Thank you!
"); 
?>