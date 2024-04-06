<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['add_patient_addressbtn']))
{
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $engineID = htmlspecialchars($_POST['engineID']);
  $patientID = htmlspecialchars($_POST['patientID']);
  $type = htmlspecialchars("Added");
  $patient_fname = htmlspecialchars($_POST['fname']);
  $patient_lname = htmlspecialchars($_POST['lname']);
  $address1 = htmlspecialchars($_POST['address1']);
  $address2 = htmlspecialchars($_POST['address2']);
  $city = htmlspecialchars($_POST['city']);
  $state = htmlspecialchars($_POST['state']);
  $zip = htmlspecialchars($_POST['zip']);

  // Check if address exist
  $checkaddress = "SELECT * FROM address WHERE userID='$patientID'";
  $checkaddress_run = mysqli_query($con, $checkaddress);
  if(mysqli_num_rows($checkaddress_run) > 0)
  {
    $_SESSION['warning'] = "Patient's Address Already Exist!";
    header("Location: ../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {
    // store activity data in activity table
    $fullname = "$fname $lname";
    $full_address = "$address1 $address2 $city $state $zip";
    $encrypt_fullname = encryptthis($fullname, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $type, $full_address);
    $stmt->execute();

    // Encrypt Patient's address Data
    $encrypt_address1 = encryptthis($address1, $key);
    $encrypt_address2 = encryptthis($address2, $key);
    $encrypt_city = encryptthis($city, $key);
    $encrypt_state = encryptthis($state, $key);
    $encrypt_zip = encryptthis($zip, $key);

    //Insert to address table//
    $address = "INSERT INTO address (userID, engineID, groupID, address1, address2, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($address);
    $stmt->bind_param("ssssssss", $patientID, $engineID, $groupID, $encrypt_address1, $encrypt_address2, $encrypt_city, $encrypt_state, $encrypt_zip);
    $stmt->execute();

    if($stmt = $con->prepare($address))
    {
      $_SESSION['success'] = "Patient's Address was Successfully Added!";
      header("Location: ../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Add Patient's Address!";
      header("Location: ../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
  }
}

?>