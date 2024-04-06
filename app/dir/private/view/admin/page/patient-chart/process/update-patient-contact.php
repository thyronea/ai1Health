<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['patient_contactbtn']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);  
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);  
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['lname']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
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
  $encrypted_email = encryptthis($email, $key);
  $contact  = "UPDATE contact SET phone=?, mobile=?, email=? WHERE userID='$patientID' ";
  $stmt = $con->prepare($contact);
  $stmt->bind_param("sss", $encrypted_phone, $encrypted_mobile, $encrypted_email);
  $stmt->execute();

  $update_email  = "UPDATE patients SET email=? WHERE patientID='$patientID' ";
  $stmt = $con->prepare($update_email);
  $stmt->bind_param("s", $encrypted_email);
  $stmt->execute();

  if($stmt = $con->prepare($contact))
  {
    $_SESSION['success'] = "Patient's Contact Information was Successfully Updated!";
    header("Location: ../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {
    $_SESSION['warning'] = "Unable to Update Patient's Contact Information";
    header("Location: ../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
}

?>