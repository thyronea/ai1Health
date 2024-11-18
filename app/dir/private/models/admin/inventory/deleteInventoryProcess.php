<?php
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$name = mysqli_real_escape_string($con, $_POST['delete_vaccine_name']);
$lot = mysqli_real_escape_string($con, $_POST['delete_vaccine_lot']);

// Encrypt Activity Data
$fullname = "$fname $lname";
$type = htmlspecialchars("Deleted");
$org_message = "$type $name - $lot";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_org_message = encryptthis($org_message, $key);

// Insert to activity table
$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
$stmt->execute();

// Delete from engine table
$engine = "DELETE FROM engine WHERE engineID=? ";
$stmt = $con->prepare($engine);
$stmt->bind_param("s", $engineID);
$stmt->execute();

// Delete from vaccines table
$vaccines = "DELETE FROM inventory WHERE engineID=? ";
$stmt = $con->prepare($vaccines);
$stmt->bind_param("s", $engineID);
$stmt->execute();
?>