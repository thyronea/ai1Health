<?php
// Encrypt Activities Data and insert
$fullname = "$fname $lname";
$act_message = "$type $patient_fname $patient_lname's $message";
$encrypted_fullname = encryptthis($fullname, $key);
$encrypted_message = encryptthis($act_message, $key);
$activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activities);
$stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
$stmt->execute();

// Encrypt Patient's contact Data and insert
$encrypt_phone = encryptthis($phone, $key);
$encrypt_mobile = encryptthis($mobile, $key);
$encrypt_patient_email = encryptthis($patient_email, $key);
$contact = "INSERT INTO contact (userID, engineID, groupID, phone, mobile, email) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($contact);
$stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $encrypt_phone, $encrypt_mobile, $encrypt_patient_email);
$stmt->execute();
?>