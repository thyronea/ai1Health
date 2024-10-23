<?php
// insert data to activities table
$query1 = "INSERT INTO admin_log (userID, groupID, user, type, activity)
VALUES ('$userID', '$groupID', '$encrypted_fullname', '$type', '$encrypted_user_log')";
$query_run1 = mysqli_query($con, $query1);

// updates login status
$status = mysqli_real_escape_string($con, "0");
$update_status = "UPDATE profile SET online='$status' WHERE userID='$userID' ";
$update_status_run = mysqli_query($con, $update_status);
?>