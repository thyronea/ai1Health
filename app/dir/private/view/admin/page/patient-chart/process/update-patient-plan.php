<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['patient_planbtn']))
{ 
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]); 
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $health_plan = mysqli_real_escape_string($con, $_POST['health_plan']);
  $policy_number = mysqli_real_escape_string($con, $_POST['policy_number']);
  $status = mysqli_real_escape_string($con, $_POST['status']);

  // Check if healthplan exist
  $checkhealthplan = "SELECT * FROM healthplan WHERE patientID='$patientID'";
  $checkhealthplan_run = mysqli_query($con, $checkhealthplan);
  if(mysqli_num_rows($checkhealthplan_run) == 0)
  {
    $_SESSION['warning'] = "Unable to update. Patient's healthplan doesn't exist!";
    header("Location: ../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {
    // Admin Log
    $type = mysqli_real_escape_string($con, "Updated");
    $message = mysqli_real_escape_string($con, "Health Plan");
    $fullname = "$fname $lname";
    $act_message = "$type $patient_fname $patient_lname's $message";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_message = encryptthis($act_message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Encrypt Patient's health plan Data
    $encrypt_health_plan = encryptthis($health_plan, $key);
    $encrypt_policy_number = encryptthis($policy_number, $key);
    $encrypt_status = encryptthis($status, $key);
    $healthplan  = "UPDATE healthplan SET health_plan=?, policy_number=?, status=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($healthplan);
    $stmt->bind_param("sss", $encrypt_health_plan, $encrypt_policy_number, $encrypt_status);
    $stmt->execute();

    if($stmt = $con->prepare($healthplan))
    {
      $_SESSION['success'] = "Patient Successfully Updated!";
      header("Location: ../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Update Patient Information";
      header("Location: ../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
  }
}

?>