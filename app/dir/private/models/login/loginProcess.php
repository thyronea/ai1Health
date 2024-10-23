<?php
// Retreive key for immunization encryption and decryption
$iz = "SELECT * FROM immunization_key";
$iz_run =  mysqli_query($con, $iz);
$iz_key = mysqli_fetch_assoc($iz_run);
$_SESSION["iz_key"] = htmlspecialchars($iz_key["key"]);

// Encrypt Activities Data
$fullname = "$fname $lname"; // Combines first and last name for encryption
$encrypted_fullname = encryptthis($fullname, $key); // Full name encryption
$encrypted_user_log = encryptthis($log, $key); // User Log encryption

// Insert encrypted data in activities table
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_user_log);
$stmt->execute();

// updates vcode
$new_vcode = rand(1000,9999); // Generates random verification token
$update_vcode = "UPDATE token SET v_code='$new_vcode' WHERE userID='$userID' ";
$update_vcode_run = mysqli_query($con, $update_vcode);

// updates login status
$status = mysqli_real_escape_string($con, "1");
$update_status = "UPDATE profile SET online='$status' WHERE userID='$userID' ";
$update_status_run = mysqli_query($con, $update_status);
?>