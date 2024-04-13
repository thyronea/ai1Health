<?php
session_start();
include('../../../../../security/dbcon.php');
include('../../../../../security/encrypt_decrypt.php');
require '../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

if(isset($_POST['administer_hepB']))
{
 
  // Shot giver's information
  $key = mysqli_real_escape_string($con, $_SESSION["dk_token"]);
  $groupID = mysqli_real_escape_string($con, $_SESSION['groupID']);
  $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);
  $fname = mysqli_real_escape_string($con, $_SESSION['fname']);
  $lname = mysqli_real_escape_string($con, $_SESSION['lname']);

  // Patient's information
  $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
  $engineID = mysqli_real_escape_string($con, $_POST['engineID']);
  $patient_fname = mysqli_real_escape_string($con, $_POST['patient_fname']);
  $patient_lname = mysqli_real_escape_string($con, $_POST['patient_lname']);
  $patient_dob = mysqli_real_escape_string($con, $_POST['patient_dob']);

  // Vaccine's information
  $vaccine = mysqli_real_escape_string($con, $_POST['vaccine']);
  $lot = mysqli_real_escape_string($con, $_POST['lot']);
  $ndc = mysqli_real_escape_string($con, $_POST['ndc']);
  $exp = mysqli_real_escape_string($con, $_POST['exp']);
  $site = mysqli_real_escape_string($con, $_POST['site']);
  $route = mysqli_real_escape_string($con, $_POST['route']);
  $vis_given = mysqli_real_escape_string($con, $_POST['vis_given']);
  $vis = mysqli_real_escape_string($con, $_POST['vis']);
  $funding_source = mysqli_real_escape_string($con, $_POST['funding_source']);
  $administered_by = mysqli_real_escape_string($con, $_POST['administered_by']);
  $comment = mysqli_real_escape_string($con, $_POST['comment']);
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $time = mysqli_real_escape_string($con, $_POST['time']);
  
  // Patient Log
  $received = htmlspecialchars("Received");
  $type = htmlspecialchars("Hepatitis B");
  $patient_log = mysqli_real_escape_string($con, "$received $type");

    // store activity data in activity table
    $fullname = "$fname $lname";
    $action = htmlspecialchars("Administered");
    $message = "$action $vaccine to $patient_fname $patient_fname";

    // encrypt data and insert to admin_log table
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_message = encryptthis($message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, engineID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $engineID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // insert to data_iz table (data visualization)
    $data = "INSERT INTO data_iz (patientID, groupID, vaccine) VALUES (?, ?, ?)";
    $stmt = $con->prepare($data);
    $stmt->bind_param("sss", $patientID, $groupID, $vaccine);
    $stmt->execute();

    // encrypt data and insert to immunizaton table
    $patient_fullname = "$patient_fname $patient_lname";
    $encrypt_patient_name = encryptthis($patient_fullname, $key);
    $encrypt_dob = encryptthis($patient_dob, $key);
    $encrypt_type = encryptthis($type, $key);
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

    $administer_iz = "INSERT INTO immunization (patientID,groupID,name,dob,type,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,date,time) 
    VALUES (?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("ssssssssssssssssss", $patientID, $groupID, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_funding_source, $encrypt_administered_by, $encrypt_comment, $date, $time);
    $stmt->execute();

    // update inventory
    $deduct = "UPDATE inventory SET doses=doses-1 WHERE groupID='$groupID' AND name='$vaccine' "; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);
    $delete = "DELETE FROM inventory WHERE groupID='$groupID' AND doses='0' "; // Delete entire row when 0
    $delete_run = mysqli_query($con, $delete);

    if($stmt = $con->prepare($administer_iz))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Administered!";
      header("Location: ../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Administer $vaccine!";
      header("Location: ../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
}

?>