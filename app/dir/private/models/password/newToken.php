<?php
$update_token = "UPDATE token SET token='$new_token' WHERE userID='$userID' LIMIT 1";
$update_token_run = mysqli_query($con, $update_token);
?>