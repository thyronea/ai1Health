<?php
// Encrypt Activity Data and insert
$fullname = "$fname $lname";
$act_message = "$type $message";
$encrypt_fullname = encryptthis($fullname, $key);
$encrypt_type = encryptthis($type, $key);
$encrypt_act_message = encryptthis($act_message, $key);

$activity = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activity);
$stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $encrypt_act_message);
$stmt->execute();

// Delete from admin table
$check_file = "SELECT * FROM docs WHERE id='$delete_ID' ";
$check_file_run = mysqli_query($con, $check_file);
$doc = mysqli_fetch_assoc($check_file_run);
unlink('../../../uploads/'.$doc['docname']);
$file = "DELETE FROM docs WHERE id=? ";
$stmt = $con->prepare($file);
$stmt->bind_param("s", $delete_ID);
$stmt->execute();
?>