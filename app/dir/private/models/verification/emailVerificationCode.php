<?php
// stores vcode in token table for login verification
$vcode = rand(1000,9999); // Generates random verification token
$update_vcode = "UPDATE token SET v_code=? WHERE userID='$userID' ";
$stmt = $con->prepare($update_vcode);
$stmt->bind_param("s", $vcode);
$stmt->execute();
?>