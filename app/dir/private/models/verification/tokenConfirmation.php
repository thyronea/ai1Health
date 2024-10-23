<?php
$clicked_token = mysqli_real_escape_string($con, $row['token']);
$update_query = "UPDATE token SET status ='1' WHERE token='$clicked_token' LIMIT 1";
$update_query_run = mysqli_query($con, $update_query);
?>