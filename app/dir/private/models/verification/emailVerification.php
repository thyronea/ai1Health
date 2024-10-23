<?php
$email = mysqli_real_escape_string($con, $_POST['email']);
$subject = htmlspecialchars("Login Verification");
$message = htmlspecialchars("
Hello $fname,

Your login verification code is: $vcode

If you did not attempt to login, please contact admin.

");

// Send email confirmation
include(PRIVATE_CONTROLLERS_PATH . '/auth/emailController.php');
?>