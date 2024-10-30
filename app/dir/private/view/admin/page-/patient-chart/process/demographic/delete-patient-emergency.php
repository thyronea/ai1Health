<?php
session_start();
include('../../../../../../security/dbcon.php');
include('../../../../../../security/encrypt_decrypt.php');
require '../../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['emergencydeletebtn']))
{   
  // User's information  
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);  
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  
  // Patient's information
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['patient_fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['patient_lname']);
  
  // Emergency contact's information
  $emergencyID = mysqli_real_escape_string($con, $_POST['emergencyID']);
  $emergency_fname = mysqli_real_escape_string($con, $_POST['emergency_fname']);
  $emergency_lname = mysqli_real_escape_string($con, $_POST['emergency_lname']);

  // Encrypt Activities Data and insert
  $fullname = "$fname $lname";
  $action = mysqli_real_escape_string($con, "Deleted");
  $message = mysqli_real_escape_string($con, "$action from $patient_fname $patient_lname Emergeny Contact List: $emergency_fname $emergency_lname");
  $encrypted_fullname = encryptthis($fullname, $key);
  $encrypted_message = encryptthis($message, $key);
  $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
  $stmt = $con->prepare($activities);
  $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $action, $encrypted_message);
  $stmt->execute();

  // Delete from token table
  $delete = "DELETE FROM emergency_contact WHERE id=? AND patientID=? ";
  $stmt = $con->prepare($delete);
  $stmt->bind_param("ss", $emergencyID, $patientID);
  $stmt->execute();

  if($stmt = $con->prepare($delete))
  {
    $_SESSION['success'] = "Successfully Deleted Emergency Contact!";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Delete Patient's Emergency Contact";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
}

?>