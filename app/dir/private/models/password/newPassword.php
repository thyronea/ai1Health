<?php
$userID = mysqli_real_escape_string($con, $_POST['userID']);
$new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
$token = mysqli_real_escape_string($con, $_POST['token']);
?>