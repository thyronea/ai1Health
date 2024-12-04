<?php
session_start();
include('../../../../../../security/dbcon.php');
include('../../../../../../security/encrypt_decrypt.php');
require '../../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['add_patient_contactbtn']))
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
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $patient_email = mysqli_real_escape_string($con, $_POST['email']);
  $type = mysqli_real_escape_string($con, "Added");
  $message = mysqli_real_escape_string($con, "Contact information");

  // Check if address exist
  $checkaddress = "SELECT * FROM address WHERE userID='$patientID'";
  $checkaddress_run = mysqli_query($con, $checkaddress);

  if(mysqli_num_rows($checkaddress_run) > 0)
  {
    $_SESSION['warning'] = "Patient's Address Already Exist!";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else{
    // Encrypt Activities Data and insert
    $fullname = "$fname $lname";
    $act_message = "$type $patient_fname $patient_lname's $message";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_message = encryptthis($act_message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Encrypt Patient's contact Data and insert
    $encrypt_phone = encryptthis($phone, $key);
    $encrypt_mobile = encryptthis($mobile, $key);
    $encrypt_patient_email = encryptthis($patient_email, $key);
    $contact = "INSERT INTO contact (userID, engineID, groupID, phone, mobile, email) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($contact);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $encrypt_phone, $encrypt_mobile, $encrypt_patient_email);
    $stmt->execute();

    if($stmt = $con->prepare($contact))
    {
        $_SESSION['success'] = "Patient's Contact Information was Successfully Added!";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
    else
    {
        $_SESSION['warning'] = "Unable to Add Patient's Contact Information";
        header("Location: ../../../patient-chart/index.php?patientID=$patientID");
        exit(0);
    }
  }
}

?>