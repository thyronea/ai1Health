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


  $id = htmlspecialchars($_POST['hepB_ID']);
  $vaccine = htmlspecialchars($_POST['vaccine']);
  $lot = htmlspecialchars($_POST['lot']);
  $ndc = htmlspecialchars($_POST['ndc']);
  $exp = htmlspecialchars($_POST['exp']);
  $site = htmlspecialchars($_POST['site']);
  $route = htmlspecialchars($_POST['route']);
  $vis_given = htmlspecialchars($_POST['vis_given']);
  $vis = htmlspecialchars($_POST['vis']);
  $funding_source = htmlspecialchars($_POST['funding_source']);
  $administered_by = htmlspecialchars($_POST['administered_by']);
  $comment = htmlspecialchars($_POST['comment']);
  

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

  $encrypt_vaccine = encryptthis($vaccine, $key);
  $encrypt_lot = encryptthis($lot, $key);
  $encrypt_ndc = encryptthis($ndc, $key);
  $encrypt_exp = encryptthis($exp, $key);
  $encrypt_site = encryptthis($site, $key);
  $encrypt_route = encryptthis($route, $key);
  $encrypt_vis_given = encryptthis($vis_given, $key);
  $encrypt_vis = encryptthis($vis, $key);
  $encrypt_funding_source = encryptthis($funding_source, $key);
  $encrypt_administered_by = encryptthis($administered_by, $key);
  $encrypt_comment = encryptthis($comment, $key);
  $update  = "UPDATE immunization SET vaccine=?, lot=?, ndc=?, exp=?, site=?, route=?, vis_given=?, vis=?, funding_source=?, administered_by=?, comment=? 
  WHERE id='$id' AND patientID='$patientID' ";
  $stmt = $con->prepare($update);
  $stmt->bind_param("sssssssssss", $encrypt_vaccine, $encrypt_lot, $encrypt_ndc, $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_funding_source,  $encrypt_administered_by, $encrypt_comment);
  $stmt->execute();

  if($stmt = $con->prepare($update))
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