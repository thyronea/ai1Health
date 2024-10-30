<?php
// Update token status after registration email confirmation
$clicked_token = mysqli_real_escape_string($con, $row['token']);
$status = mysqli_real_escape_string($con, "1");
$update_status = "UPDATE token SET status =? WHERE token='$clicked_token' LIMIT 1";
$stmt = $con->prepare($update_status);
$stmt->bind_param("s", $status);
$stmt->execute();
?>