<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['update_patient_emergencybtn']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);  
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $emergencyID = mysqli_real_escape_string($con, $_POST['id']); 
  $emergency_fname = mysqli_real_escape_string($con, $_POST['emergency_fname']);
  $emergency_lname = mysqli_real_escape_string($con, $_POST['emergency_lname']);
  $emergency_phone = mysqli_real_escape_string($con, $_POST['emergency_phone']);
  $emergency_email = mysqli_real_escape_string($con, $_POST['emergency_email']);

  // Encrypt Activities Data and insert
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

  if($stmt = $con->prepare($emergency))
  {
    $_SESSION['success'] = "Patient's Emergency Contact Successfully Updated!";
    header("Location: ../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Patient's Emergency Contact";
    header("Location: ../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
}

?>