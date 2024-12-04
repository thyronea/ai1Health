<?php
session_start();
include('../../../../../../security/dbcon.php');
include('../../../../../../security/encrypt_decrypt.php');
require '../../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['add_patient_emergencybtn']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $patientID = htmlspecialchars($_POST['patientID']);
  $patient_fname = htmlspecialchars($_POST['fname']);
  $patient_lname = htmlspecialchars($_POST['lname']);
  $emergency_fname = htmlspecialchars($_POST['emergency_fname']);
  $emergency_lname = htmlspecialchars($_POST['emergency_lname']);
  $emergency_phone = htmlspecialchars($_POST['emergency_phone']);
  $emergency_email = htmlspecialchars($_POST['emergency_email']);

  // Check if emergency contact exist
  $checkcontact = "SELECT * FROM emergency_contact WHERE patientID='$patientID' AND phone='$emergency_phone' OR patientID='$patientID' AND email='$emergency_email' ";
  $checkcontact_run = mysqli_query($con, $checkcontact);
  if(mysqli_num_rows($checkcontact_run) > 0)
  {
    $_SESSION['warning'] = "Emergency Contact Already Exist!";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {
    // store activity data in activity table
    $fullname = "$fname $lname";
    $action = htmlspecialchars("Added");
    $message = "$action Emergency Contact: $emergency_fname $emergency_fname";
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_message = encryptthis($message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
    $stmt->execute();

    $encrypt_emergency_fname = encryptthis($emergency_fname, $key);
    $encrypt_emergency_lname = encryptthis($emergency_lname, $key);
    $encrypt_emergency_phone = encryptthis($emergency_phone, $key);
    $encrypt_emergency_email = encryptthis($emergency_email, $key);
    $emergency = "INSERT INTO emergency_contact (patientID, engineID, groupID, fname, lname, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($emergency);
    $stmt->bind_param("sssssss", $patientID, $engineID, $groupID, $encrypt_emergency_fname, $encrypt_emergency_lname, $encrypt_emergency_phone, $encrypt_emergency_email);
    $stmt->execute();

    if($stmt = $con->prepare($emergency))
    {
      $_SESSION['success'] = "Emergency Contact Was Successfully Added!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Add Patient's Emergency Contact!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
  }
}

?>