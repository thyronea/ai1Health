<?php
$id = mysqli_real_escape_string($con, $_POST['delete_locationid']);
$engineID = mysqli_real_escape_string($con, $_POST['delete_location_engineid']);
$location_name = mysqli_real_escape_string($con, $_POST['delete_location_name']);
$type = mysqli_real_escape_string($con, "Deleted");

// Encrypt Activity Data
$fullname = htmlspecialchars("$fname $lname");
$org_message = htmlspecialchars("$type $location_name");
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_org_message = encryptthis($org_message, $key);

// insert activity timestamp
$fullname = "$fname $lname";
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
$stmt->execute();

// Delete from engine table
$engine = "DELETE FROM engine WHERE engineID=? ";
$stmt = $con->prepare($engine);
$stmt->bind_param("s", $engineID);
$stmt->execute();

// Delete from offices table
$location = "DELETE FROM location WHERE id=? ";
$stmt = $con->prepare($location);
$stmt->bind_param("s", $id);
$stmt->execute();
?>