<?php
$id = htmlspecialchars($_POST['id']);
$engineID = htmlspecialchars($_POST['engineID']);
$storage_location = htmlspecialchars($_POST['delete_storage_location']);
$storage_name = htmlspecialchars($_POST['delete_storage_name']);
$type = mysqli_real_escape_string($con, "Deleted");
$from = mysqli_real_escape_string($con, "from");

// Encrypt Activity Data and insert
$fullname = htmlspecialchars("$fname $lname");
$org_message = htmlspecialchars("$type $storage_name $from $storage_location");
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_org_message = encryptthis($org_message, $key);
$org_activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($org_activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
$stmt->execute();

// Delete from storage table
$storage = "DELETE FROM storage WHERE engineID=? ";
$stmt = $con->prepare($storage);
$stmt->bind_param("s", $engineID);
$stmt->execute();

// Delete from engine table
$engine = "DELETE FROM engine WHERE engineID=? ";
$stmt = $con->prepare($engine);
$stmt->bind_param("s", $engineID);
$stmt->execute();
?>