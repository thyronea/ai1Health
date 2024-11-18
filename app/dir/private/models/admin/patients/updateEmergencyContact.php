<?php
$patientID = mysqli_real_escape_string($con, $_POST['patientID']);
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
$patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
$emergencyID = mysqli_real_escape_string($con, $_POST['id']); 
$emergency_fname = mysqli_real_escape_string($con, $_POST['emergency_fname']);
$emergency_lname = mysqli_real_escape_string($con, $_POST['emergency_lname']);
$emergency_phone = mysqli_real_escape_string($con, $_POST['emergency_phone']);
$emergency_email = mysqli_real_escape_string($con, $_POST['emergency_email']);

// Check if emergency contact exist
$checkcontact = "SELECT * FROM emergency_contact WHERE patientID='$patientID' ";
$checkcontact_run = mysqli_query($con, $checkcontact);
$row = mysqli_fetch_array($checkcontact_run);

// Decrypt existing emergency contact
$checkPhone = htmlspecialchars(decryptthis($row['phone'], $key));
$checkEmail = htmlspecialchars(decryptthis($row['email'], $key));

// If emergency contact exist, check for information match. Error message if there's match
if($emergency_email === $checkEmail || $emergency_phone === $checkPhone):{
    $_SESSION['warning'] = "$emergency_fname $emergency_lname already exist as an emergency contact!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
}
else:{
    // Update emergency contact if no match
    $user_fullname= "$fname $lname";
    $action = mysqli_real_escape_string($con, "Updated");
    $message = mysqli_real_escape_string($con, "$action Emergency Contact: $emergency_fname $emergency_lname");
    $encrypted_user_fullname = encryptthis($user_fullname, $key);
    $encrypted_message = encryptthis($message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypted_user_fullname, $action, $encrypted_message);
    $stmt->execute();

    // Encrypt Patient's diversity Data and update
    $encrypt_e_fname = encryptthis($emergency_fname, $key);
    $encrypt_e_lname = encryptthis($emergency_lname, $key);
    $encrypt_e_phone = encryptthis($emergency_phone, $key);
    $encrypt_e_email = encryptthis($emergency_email, $key);

    $emergency  = "UPDATE emergency_contact SET fname=?, lname=?, phone=?, email=? WHERE id='$emergencyID' AND patientID='$patientID' ";
    $stmt = $con->prepare($emergency);
    $stmt->bind_param("ssss", $encrypt_e_fname, $encrypt_e_lname, $encrypt_e_phone, $encrypt_e_email);
    $stmt->execute();

    if($stmt = $con->prepare($emergency)){
        $_SESSION['success'] = "$patient_fname's Emergency Contact Successfully Updated!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Update $patient_fname's Emergency Contact";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
}endif;
?>