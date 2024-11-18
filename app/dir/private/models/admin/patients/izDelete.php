<?php
// Patient's information
$patientID = htmlspecialchars($_POST['patientID']);
$engineID = htmlspecialchars($_POST['engineID']);
$patient_fname = htmlspecialchars($_POST['patient_fname']);
$patient_lname = htmlspecialchars($_POST['patient_lname']);

// Vaccine information
$uniqueID = htmlspecialchars($_POST['uniqueID']);
$vaccine = htmlspecialchars($_POST['vaccine']);
$lot = htmlspecialchars($_POST['lot']);

$fullname = "$fname $lname";
$encrypt_fullname = encryptthis($fullname, $key);
$patientFullname = "$patient_fname $patient_lname";
$deleted = "Deleted";
$deletedMessage = "$deleted $patientFullname's admininstered $vaccine ($lot)";
$encrypted_deletedMessage = encryptthis($deletedMessage, $key);

$activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activities);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $deleted, $encrypted_deletedMessage);
$stmt->execute();

$delete_patientLog = "DELETE FROM patientlog WHERE patientID=? AND uniqueID=?";
$stmt = $con->prepare($delete_patientLog);
$stmt->bind_param("ss", $patientID, $uniqueID);
$stmt->execute();

$delete_data_iz = "DELETE FROM data_iz WHERE patientID=? AND uniqueID=?";
$stmt = $con->prepare($delete_data_iz);
$stmt->bind_param("ss", $patientID, $uniqueID);
$stmt->execute();

$delete = "DELETE FROM immunization WHERE patientID=? AND uniqueID=?";
$stmt = $con->prepare($delete);
$stmt->bind_param("ss", $patientID, $uniqueID);
$stmt->execute();
?>