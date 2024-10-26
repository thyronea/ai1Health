<?php
// Update token status after registration email confirmation
$clicked_token = mysqli_real_escape_string($con, $row['token']);
$status = mysqli_real_escape_string($con, "1");
$update_status = "UPDATE token SET status =? WHERE token='$clicked_token' LIMIT 1";
$stmt = $con->prepare($update_status);
$stmt->bind_param("s", $status);
$stmt->execute();

// Updates vcode after login & logout for security
$vcode = rand(1000,9999); // Generates random verification token
$update_vcode = "UPDATE token SET v_code=? WHERE userID='$userID' ";
$stmt = $con->prepare($update_vcode);
$stmt->bind_param("s", $vcode);
$stmt->execute();
?>