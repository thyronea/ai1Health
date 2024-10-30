<?php
session_start();
include('../../../../../../security/dbcon.php');
include('../../../../../../security/encrypt_decrypt.php');
require '../../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['add_patient_diversity']))
{  
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $dob = mysqli_real_escape_string($con, $_POST['dob']);
  $gender = mysqli_real_escape_string($con, $_POST['gender']);
  $race = mysqli_real_escape_string($con, $_POST['race']);
  $ethnicity = mysqli_real_escape_string($con, $_POST['ethnicity']);
  $type = mysqli_real_escape_string($con, "Added");
  $message = mysqli_real_escape_string($con, "Diversity");

  // Check if diversity exist
  $checkdiversity = "SELECT * FROM diversity WHERE userID='$patientID'";
  $checkdiversity_run = mysqli_query($con, $checkdiversity);

  if(mysqli_num_rows($checkdiversity_run) > 0)
  {
    $_SESSION['warning'] = "Patient's Diversity Already Exist!";
    header("Location: ../../../patient-chart/index.php?patientID=$patientID");
    exit(0);
  }
  else
  {

    // Insert to data_dob for count
    $data_dob = "INSERT INTO data_dob (patientID, groupID, dob) VALUES (?, ?, ?)";
    $stmt = $con->prepare($data_dob);
    $stmt->bind_param("sss", $patientID, $groupID, $dob);
    $stmt->execute();

    // Insert to data_gender for count
    $data_gender = "INSERT INTO data_gender (patientID, groupID, gender) VALUES (?, ?, ?)";
    $stmt = $con->prepare($data_gender);
    $stmt->bind_param("sss", $patientID, $groupID, $gender);
    $stmt->execute();

    // Insert to data_race for count
    $data_race = "INSERT INTO data_race (patientID, groupID, race) VALUES (?, ?, ?)";
    $stmt = $con->prepare($data_race);
    $stmt->bind_param("sss", $patientID, $groupID, $race);
    $stmt->execute();

    // Insert to data_gender for count
    $data_ethnicity = "INSERT INTO data_ethnicity (patientID, groupID, ethnicity) VALUES (?, ?, ?)";
    $stmt = $con->prepare($data_ethnicity);
    $stmt->bind_param("sss", $patientID, $groupID, $ethnicity);
    $stmt->execute();

    // Encrypt Activities Data and insert
    $fullname = "$fname $lname";
    $act_message = "$type $fullname's $message";
    $encrypted_fullname = encryptthis($fullname, $key);
    $encrypted_office = encryptthis($office, $key);
    $encrypted_message = encryptthis($act_message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypted_fullname, $type, $encrypted_message);
    $stmt->execute();

    // Encrypt Data and insert in diversity table
    $encrypt_dob = encryptthis($dob, $key);
    $encrypt_gender = encryptthis($gender, $key);
    $encrypt_race = encryptthis($race, $key);
    $encrypt_ethnicity = encryptthis($ethnicity, $key);
    $diversity = "INSERT INTO diversity (userID, engineID, groupID, dob, gender, race, ethnicity) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($diversity);
    $stmt->bind_param("sssssss", $patientID, $engineID, $groupID, $encrypt_dob, $encrypt_gender, $encrypt_race, $encrypt_ethnicity);
    $stmt->execute();

    // Update patient's dob in patient's table
    $update_dob  = "UPDATE patients SET dob=? WHERE patientID='$patientID' ";
    $stmt = $con->prepare($update_dob);
    $stmt->bind_param("s", $encrypt_dob);
    $stmt->execute();

    if($stmt = $con->prepare($update_dob))
    {
      $_SESSION['success'] = "Patient's Diversity was Successfully Added!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Add Patient's Diversity!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
  }
}

?>