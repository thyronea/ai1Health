<?php
// store activity data in activity table
$fullname = "$fname $lname";
$action = htmlspecialchars("Added");
$message = "$action Emergency Contact: $emergency_fname $emergency_fname";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_message = encryptthis($message, $key);
$activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activities);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
$stmt->execute();

$encrypt_emergency_fname = encryptthis($emergency_fname, $key);
$encrypt_emergency_lname = encryptthis($emergency_lname, $key);
$encrypt_emergency_phone = encryptthis($emergency_phone, $key);
$encrypt_emergency_email = encryptthis($emergency_email, $key);

$addEmergency = "INSERT INTO emergency_contact (patientID, engineID, groupID, fname, lname, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($addEmergency);
$stmt->bind_param("sssssss", $patientID, $engineID, $groupID, $encrypt_emergency_fname, $encrypt_emergency_lname, $encrypt_emergency_phone, $encrypt_emergency_email);
$stmt->execute();
?>