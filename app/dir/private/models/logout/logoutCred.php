<?php
$key = mysqli_real_escape_string($con, $_SESSION['dk_token']);
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$fname = mysqli_real_escape_string($con, $_SESSION['fname']);
$lname = mysqli_real_escape_string($con, $_SESSION['lname']);
$type = htmlspecialchars("Signed out");
$log = htmlspecialchars("Logged out");

// Encrypt Activities Data
$fullname = "$fname $lname";
$encrypted_fullname = encryptthis($fullname, $key);
$encrypted_fname = encryptthis($fname, $key);
$encrypted_lname = encryptthis($lname, $key);
$encrypted_user_log = encryptthis($log, $key);
?>