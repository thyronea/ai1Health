<?php
$patientID = mysqli_real_escape_string($con, $_POST['patientID']);
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
$patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
$address1 = mysqli_real_escape_string($con, $_POST['address1']);
$address2 = mysqli_real_escape_string($con, $_POST['address2']);
$city = mysqli_real_escape_string($con, $_POST['city']);
$state = mysqli_real_escape_string($con, $_POST['state']);
$zip = mysqli_real_escape_string($con, $_POST['zip']);
$type = mysqli_real_escape_string($con, "Updated");
$message = mysqli_real_escape_string($con, "Address");

// Encrypt Activities Data and insert
$fullname = "$patient_fname $patient_lname";
$act_message = "$type $fullname's $message";
$encrypted_fullname = encryptthis($fullname, $key);
$encrypted_message = encryptthis($act_message, $key);
$activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activities);
$stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
$stmt->execute();

// Encrypt Patient's diversity Data and update
$encrypt_address1 = encryptthis($address1, $key);
$encrypt_address2 = encryptthis($address2, $key);
$encrypt_city = encryptthis($city, $key);
$encrypt_state = encryptthis($state, $key);
$encrypt_zip = encryptthis($zip, $key);

$address  = "UPDATE address SET address1=?, address2=?, city=?, state=?, zip=? WHERE userID='$patientID' ";
$stmt = $con->prepare($address);
$stmt->bind_param("sssss", $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
$stmt->execute();
?>