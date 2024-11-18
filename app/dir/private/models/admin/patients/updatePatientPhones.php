<?php
$patientID = mysqli_real_escape_string($con, $_POST['patientID']);
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
$patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);
$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
$type = mysqli_real_escape_string($con, "Updated");
$message = mysqli_real_escape_string($con, "Contact Information");

// Encrypt Activities Data and insert
$fullname = "$patient_fname $patient_lname";
$act_message = "$type $fullname's $message";
$encrypted_fullname = encryptthis($fullname, $key);
$encrypted_message = encryptthis($act_message, $key);
$activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($activities);
$stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
$stmt->execute();

// Encrypt Contact Data and update
$encrypted_phone = encryptthis($phone, $key);
$encrypted_mobile = encryptthis($mobile, $key);

$contact  = "UPDATE contact SET phone=?, mobile=?  WHERE userID='$patientID' ";
$stmt = $con->prepare($contact);
$stmt->bind_param("ss", $encrypted_phone, $encrypted_mobile);
$stmt->execute();

if($stmt = $con->prepare($contact)){
    $_SESSION['success'] = "$patient_fname's Contact Number Successfully!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
}
else{
    $_SESSION['warning'] = "Unable to Update Patient's Contact Information";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
}
?>