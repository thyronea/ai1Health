<?php
// Admin password token update
$update_token  = "UPDATE token SET token=? WHERE userID='$userID' ";
$stmt = $con->prepare($update_token);
$stmt->bind_param("s", $token);
$stmt->execute();
?>