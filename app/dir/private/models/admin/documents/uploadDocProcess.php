<?php
// Encrypt Activity Data and insert
$fullname = "$fname $lname";
$act_message = "$status $type $message";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_type = encryptthis($type, $key);
$encrypt_act_message = encryptthis($act_message, $key);

$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $status, $encrypt_act_message);
$stmt->execute();

// Upload document
$upload_doc = "INSERT INTO docs (userID, groupID, docname, type) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($upload_doc);
$stmt->bind_param("ssss", $userID, $groupID, $docname, $type);
$stmt->execute();
?>