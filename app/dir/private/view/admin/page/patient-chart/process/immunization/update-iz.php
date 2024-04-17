<?php
session_start();
include('../../../../../../security/dbcon.php');
include('../../../../../../security/encrypt_decrypt.php');
require '../../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['update_hepB']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);  
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);

  $patientID = htmlspecialchars($_POST['patientID']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $patient_fname = htmlspecialchars($_POST['patient_fname']);
  $patient_lname = htmlspecialchars($_POST['patient_lname']);
  $vaccine = htmlspecialchars($_POST['vaccine']);

  // Encrypt Activities Data and insert
  $fullname = "$fname $lname";
  $type = "Updated";
  $p_fullname = "$patient_fname $patient_lname";
  $message = "Administered $vaccine";
  $act_message = "$type $p_fullname's $message";
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_message = encryptthis($act_message, $key);
  $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();


  if($stmt = $con->prepare($activities))
  {
    $_SESSION['success'] = "Administered $vaccine Successfully Updated!";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Administered $vaccine";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
}

?>