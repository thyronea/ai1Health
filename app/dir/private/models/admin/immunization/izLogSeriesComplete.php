<?php
// Insert Admin Log Data
$activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activities);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $administered, $encrypted_administeredMessage);
$stmt->execute();

$received = htmlspecialchars("Received");
$patient_log = mysqli_real_escape_string($con, "$received $type");
$encrypted_patient_log = encryptthis($patient_log, $iz_key); // Encrypt Patient Log

$patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
$stmt = $con->prepare($patientlog);
$stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
$stmt->execute();

$complete = htmlspecialchars("$type Series is Complete");
$complete_patient_log = mysqli_real_escape_string($con, "$complete");
$encrypted_complete_patient_log = encryptthis($complete_patient_log, $iz_key); // Encrypt Patient Log

$patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
$stmt = $con->prepare($patientlog);
$stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_complete_patient_log);
$stmt->execute();

// insert to data_iz table (data visualization)
$data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($data);
$stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
$stmt->execute();
?>