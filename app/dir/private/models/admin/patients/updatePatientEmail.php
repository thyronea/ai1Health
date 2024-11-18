<?php
$patientID = mysqli_real_escape_string($con, $_POST['patientID']);
$engineID = mysqli_real_escape_string($con, $_POST['engineID']);
$patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
$patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
$patient_email = mysqli_real_escape_string($con, $_POST['email']);

// Check if emergency contact exist
$sql = "SELECT email FROM admin WHERE email='$patient_email' AND groupID='$groupID' ";
$sql_run = mysqli_query($con, $sql);

if(mysqli_num_rows($sql_run) > 0){
    $_SESSION['warning'] = "Unable to Update Patient's email. $patient_email is already used!";
    header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
    exit(0);
}
else{
    $sql = "SELECT * FROM admin WHERE groupID='$groupID' ";
    $sql_run = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($sql_run);
    $oldEmail = htmlspecialchars($row['email']);

    // Encrypt Activities Data and insert
    $type = mysqli_real_escape_string($con, "Updated");
    $message = mysqli_real_escape_string($con, "email from $oldEmail to $patient_email");

    $userName = "$fname $lname";
    $fullname = "$patient_fname $patient_lname";
    $act_message = "$type $fullname's $message";
    $encrypted_userName = encryptthis($userName, $key);
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_message = encryptthis($act_message, $key);

    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypted_userName, $type, $encrypted_message);
    $stmt->execute();

    // Encrypt Contact Data and update
    $encrypted_email = encryptthis($patient_email, $key);

    $contact  = "UPDATE contact SET email=? WHERE userID='$patientID' ";
    $stmt = $con->prepare($contact);
    $stmt->bind_param("s", $encrypted_email);
    $stmt->execute();

    $update_email  = "UPDATE patients SET email=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_email);
    $stmt->bind_param("s", $encrypted_email);
    $stmt->execute();

    $update_admin  = "UPDATE admin SET email=? WHERE userID='$patientID' ";
    $stmt = $con->prepare($update_admin);
    $stmt->bind_param("s", $patient_email);
    $stmt->execute(); 

    if($stmt = $con->prepare($update_admin)){
        $_SESSION['success'] = "Patient's Email Successfully Updated from $oldEmail to $patient_email!";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
    else{
        $_SESSION['warning'] = "Unable to Update $patient_fname's email";
        header("Location: /private/view/admin/patient-chart/?patientID=$patientID");
        exit(0);
    }
}
?>