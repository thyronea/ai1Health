<?php
$update_password  = "UPDATE admin SET password=? WHERE userID='$userID' ";
$stmt = $con->prepare($update_password);
$stmt->bind_param("s", $new_password);
$stmt->execute();
?>