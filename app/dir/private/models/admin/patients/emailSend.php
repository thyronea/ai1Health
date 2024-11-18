<?php
// Encrypt Activity Data
$fullname = "$fname $lname";
$act_message = "$type $email";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_type = encryptthis($type, $key);
$encrypt_act_message = encryptthis($act_message, $key);

/// Insert to activity table
$fullname = "$fname $lname";
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
$stmt->execute();

// Encrypt Email Data
$encrypted_admin_email = encryptthis($userEmail, $key);
$encrypted_email = encryptthis($patient_email, $key);
$encrypted_subject = encryptthis($subject, $key);
$encrypted_message = encryptthis($message, $key);

// Insert to email table
$sql = "INSERT INTO email (userID, groupID, fromEmail, toEmail, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssss", $userID, $groupID, $encrypted_admin_email, $encrypted_email, $encrypted_subject, $encrypted_message);
$stmt->execute();
?>