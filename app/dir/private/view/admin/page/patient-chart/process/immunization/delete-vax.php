<?php
session_start();
include('../../../../../../security/dbcon.php');
include('../../../../../../security/encrypt_decrypt.php');
require '../../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

// User's information
$key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
$iz_key = mysqli_real_escape_string($con, $_SESSION["iz_key"]);  
$userID = mysqli_real_escape_string($con, $_SESSION['userID']);
$groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
$email = mysqli_real_escape_string($con, $_SESSION['email']);
$fname = mysqli_real_escape_string($con, $_SESSION['fname']);
$lname = mysqli_real_escape_string($con, $_SESSION['lname']);

// Patient's information
$patientID = htmlspecialchars($_POST['patientID']);
$engineID = htmlspecialchars($_POST['engineID']);
$patient_fname = htmlspecialchars($_POST['patient_fname']);
$patient_lname = htmlspecialchars($_POST['patient_lname']);

// Vaccine information
$uniqueID = htmlspecialchars($_POST['uniqueID']);
$vaccine = htmlspecialchars($_POST['vaccine']);

// Admin Log
$fullname = "$fname $lname";
$type = "Deleted";
$p_fullname = "$patient_fname $patient_lname";
$message = "Administered $vaccine";
$act_message = "$type $p_fullname's $message";
$encrypted_fullname = encryptthis($fullname, $key);
$encrypted_message = encryptthis($act_message, $key);

if(isset($_POST['delete_administered_vax']))
{
  $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
  $stmt->execute();

  $delete_patientLog = "DELETE FROM patientlog WHERE patientID=? AND uniqueID=?";
  $stmt = $con->prepare($delete_patientLog);
  $stmt->bind_param("ss", $patientID, $uniqueID);
  $stmt->execute();

  $delete_data_iz = "DELETE FROM data_iz WHERE patientID=? AND uniqueID=?";
  $stmt = $con->prepare($delete_data_iz);
  $stmt->bind_param("ss", $patientID, $uniqueID);
  $stmt->execute();

  $delete = "DELETE FROM immunization WHERE patientID=? AND uniqueID=?";
  $stmt = $con->prepare($delete);
  $stmt->bind_param("ss", $patientID, $uniqueID);
  $stmt->execute();

  if($stmt = $con->prepare($delete))
  {
    $_SESSION['success'] = "Administered $vaccine Successfully Deleted!";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Deleted Administered $vaccine";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
}
?>