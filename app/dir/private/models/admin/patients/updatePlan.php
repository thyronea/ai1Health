<?php
// Admin Log
$type = mysqli_real_escape_string($con, "Updated");
$message = mysqli_real_escape_string($con, "Health Plan");
$fullname = "$fname $lname";
$act_message = "$type $patient_fname $patient_lname's $message";
$encrypted_fullname = encryptthis($fullname, $key);
$encrypted_message = encryptthis($act_message, $key);
$activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activities);
$stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
$stmt->execute();

// Encrypt Patient's health plan Data
$encrypt_health_plan = encryptthis($health_plan, $key);
$encrypt_policy_number = encryptthis($policy_number, $key);
$encrypt_status = encryptthis($status, $key);
$healthplan  = "UPDATE healthplan SET health_plan=?, policy_number=?, status=? WHERE patientID='$patientID' ";
$stmt = $con->prepare($healthplan);
$stmt->bind_param("sss", $encrypt_health_plan, $encrypt_policy_number, $encrypt_status);
$stmt->execute();
?>