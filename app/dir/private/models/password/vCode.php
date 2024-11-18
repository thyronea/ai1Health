<?php
// Updates vcode after login & logout for security
$vcode = rand(1000,9999); // Generates random verification token
$update_vcode = "UPDATE token SET v_code=? WHERE userID='$userID' ";
$stmt = $con->prepare($update_vcode);
$stmt->bind_param("s", $vcode);
$stmt->execute();

// Updates vcode every page load
if(isset($_SESSION['userID'])){
    $new_vcode = rand(1000,9999); // Generates random verification token
    $update_vcode = "UPDATE token SET v_code='$new_vcode' WHERE userID='$userID' ";
    $update_vcode_run = mysqli_query($con, $update_vcode);
  }
?>