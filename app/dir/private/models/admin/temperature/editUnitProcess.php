<?php
$storageID = mysqli_real_escape_string($con, $_POST['id']);
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$location = mysqli_real_escape_string($con, $_POST['location']);
$unit_position = mysqli_real_escape_string($con, $_POST['position']);
$unit_type = mysqli_real_escape_string($con, $_POST['unit_type']);
$unit_grade = mysqli_real_escape_string($con, $_POST['unit_grade']);
$unit_name = mysqli_real_escape_string($con, $_POST['unit_name']);
$type = mysqli_real_escape_string($con, "Updated");
$for = mysqli_real_escape_string($con, "for");

// Encrypt Activity Data and insert
$fullname = mysqli_real_escape_string($con, "$fname $lname");
$org_message = "$type $unit_position: $unit_name $for $location";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_org_message = encryptthis($org_message, $key);
$org_activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($org_activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_org_message);
$stmt->execute();

// Update engine table
$location_unit_grade = "$location - $unit_type - $unit_grade";
$engine  = "UPDATE engine SET keyword1=?, keyword2=?, keyword3=? WHERE engineID='$engineID' ";
$stmt = $con->prepare($engine);
$stmt->bind_param("sss", $unit_name, $location_unit_grade, $unit_type);
$stmt->execute();

// Encrypt and update storage table
$encrypt_position = encryptthis($unit_position, $key);
$encrypt_grade = encryptthis($unit_grade, $key);
$encrypt_name = encryptthis($unit_name, $key);
$storage  = "UPDATE storage SET location=?, position=?, type=?, grade=?, name=? WHERE engineID='$engineID' ";
$stmt = $con->prepare($storage);
$stmt->bind_param("sssss", $location, $encrypt_position, $unit_type, $encrypt_grade, $encrypt_name);
$stmt->execute();
?>