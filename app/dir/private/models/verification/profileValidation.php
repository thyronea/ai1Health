<?php
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$diversity = "SELECT * FROM diversity WHERE userID='$userID'";
$diversity_run = mysqli_query($con, $diversity);
$diversity_check = mysqli_fetch_assoc($diversity_run);
?>