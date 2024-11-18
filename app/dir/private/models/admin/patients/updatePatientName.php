<?php
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$patientID = mysqli_real_escape_string($con, $_POST['patientID']);
$patient_email = mysqli_real_escape_string($con, $_POST['email']);
$patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
$patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
$suffix = mysqli_real_escape_string($con, $_POST['suffix']);
$dob = mysqli_real_escape_string($con, $_POST['dob']);
$gender = mysqli_real_escape_string($con, $_POST['gender']);
$race = mysqli_real_escape_string($con, $_POST['race']);
$ethnicity = mysqli_real_escape_string($con, $_POST['ethnicity']);
$message = mysqli_real_escape_string($con, "profile");
$type = mysqli_real_escape_string($con, "Updated");

// Update data tables
$data_dob  = "UPDATE data_dob SET dob=? WHERE patientID='$patientID' ";
$stmt = $con->prepare($data_dob);
$stmt->bind_param("s", $dob);
$stmt->execute();

$data_ethnicity  = "UPDATE data_ethnicity SET ethnicity=? WHERE patientID='$patientID' ";
$stmt = $con->prepare($data_ethnicity);
$stmt->bind_param("s", $ethnicity);
$stmt->execute();

$data_gender  = "UPDATE data_gender SET gender=? WHERE patientID='$patientID' ";
$stmt = $con->prepare($data_gender);
$stmt->bind_param("s", $gender);
$stmt->execute();

$data_race  = "UPDATE data_race SET race=? WHERE patientID='$patientID' ";
$stmt = $con->prepare($data_race);
$stmt->bind_param("s", $race);
$stmt->execute();

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
$encrypt_dob = encryptthis($dob, $key);
$encrypt_gender = encryptthis($gender, $key);
$encrypt_race = encryptthis($race, $key);
$encrypt_ethnicity = encryptthis($ethnicity, $key);
$diversity  = "UPDATE diversity SET dob=?, gender=?, race=?, ethnicity=? WHERE userID='$patientID' ";
$stmt = $con->prepare($diversity);
$stmt->bind_param("ssss", $encrypt_dob, $encrypt_gender, $encrypt_race, $encrypt_ethnicity);
$stmt->execute();

// Encrypt Patient Data and update
$encrypt_fname = encryptthis($patient_fname, $key);
$encrypt_lname = encryptthis($patient_lname, $key);
$encrypt_suffix = encryptthis($suffix, $key);
$encrypt_dob = encryptthis($dob, $key);
$patients  = "UPDATE patients SET fname=?, lname=?, suffix=?, dob=? WHERE patientID='$patientID' ";
$stmt = $con->prepare($patients);
$stmt->bind_param("ssss", $encrypt_fname, $encrypt_lname, $encrypt_suffix, $encrypt_dob);
$stmt->execute();
?>