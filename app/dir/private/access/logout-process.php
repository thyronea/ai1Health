<?php
session_start();
require_once('../../private/initialize.php');
include(PRIVATE_SECURITY_PATH . '/dbcon.php');
include(PRIVATE_SECURITY_PATH . '/encrypt_decrypt.php');

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

// insert data to activities table
$query1 = "INSERT INTO admin_log (userID, groupID, user, type, activity)
VALUES ('$userID', '$groupID', '$encrypted_fullname', '$type', '$encrypted_user_log')";
$query_run1 = mysqli_query($con, $query1);

// updates vcode
$new_vcode = rand(1000,9999); // Generates random verification token
$update_vcode = "UPDATE token SET v_code='$new_vcode' WHERE userID='$userID' ";
$update_vcode_run = mysqli_query($con, $update_vcode);

// updates login status
$status = mysqli_real_escape_string($con, "0");
$update_status = "UPDATE profile SET online='$status' WHERE userID='$userID' ";
$update_status_run = mysqli_query($con, $update_status);

session_unset();
session_destroy();
header("Location: ../../logout/");
exit(0);

?>
