<?php
$id = htmlspecialchars($_POST['id']);
$engineID = htmlspecialchars($_POST['engineID']);
$thermometer_location = htmlspecialchars($_POST['delete_thermometer_location']);
$thermometer_name = htmlspecialchars($_POST['delete_thermometer_name']);
$type = htmlspecialchars("Deleted");
$from = htmlspecialchars("from");

// Encrypt Activity Data
$fullname = htmlspecialchars("$fname $lname");
$org_message = htmlspecialchars("$type $thermometer_name $from $thermometer_location");
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_org_message = encryptthis($org_message, $key);

// Insert to activity table
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
$stmt->execute();

// Delete from thermometers table
$thermometers = "DELETE FROM thermometers WHERE id=? ";
$stmt = $con->prepare($thermometers);
$stmt->bind_param("s", $id);
$stmt->execute();

// Delete from engine table
$engine = "DELETE FROM engine WHERE engineID=? ";
$stmt = $con->prepare($engine);
$stmt->bind_param("s", $engineID);
$stmt->execute();
?>