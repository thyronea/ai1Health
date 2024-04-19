<?php
session_start();
include('../../../../../../security/dbcon.php');
include('../../../../../../security/encrypt_decrypt.php');
require '../../../../../../../vendor/mailer/PHPMailer/src/Exception.php'; 
require '../../../../../../../vendor/mailer/PHPMailer/src/PHPMailer.php';
require '../../../../../../../vendor/mailer/PHPMailer/src/SMTP.php';

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
$vaccineID = mysqli_real_escape_string($con, $_POST['id']);
$uniqueID = mysqli_real_escape_string($con, $_POST['uniqueID']);
$type = mysqli_real_escape_string($con, $_POST['type']);
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
$patient_log = mysqli_real_escape_string($con, "$received $type");

if(isset($_POST['administer_hepB']))
{
  $verify_completion = "SELECT * FROM immunization WHERE patientID='$patientID' AND type='$type' ";
  $sql_run =  mysqli_query($con, $verify_completion);
  if(mysqli_num_rows($sql_run)  >= 3){
    $_SESSION['warning'] = "3 Dose Series for $type is already complete!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
  }
  else{
    // store activity data in activity table
    $fullname = "$fname $lname";
    $action = htmlspecialchars("Administered");
    $message = "$action $vaccine ($lot) to $patient_fname $patient_lname";

    // encrypt data and insert to admin_log table
    $encrypt_fullname = encryptthis($fullname, $key);
    $encrypt_message = encryptthis($message, $key);
    $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($activities);
    $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action, $encrypt_message);
    $stmt->execute();

    // Insert Patient Log Data
    $encrypted_patient_log = encryptthis($patient_log, $key); // Encrypt Patient Log
    $patientlog = "INSERT INTO patientlog (patientID, uniqueID, groupID, date, time, activity) VALUES (?, ?, ?, ?, ?, ?)"; // Insert data to patientlog table
    $stmt = $con->prepare($patientlog);
    $stmt->bind_param("ssssss", $patientID, $uniqueID, $groupID, $date, $time, $encrypted_patient_log);
    $stmt->execute();

    // insert to data_iz table (data visualization)
    $data = "INSERT INTO data_iz (uniqueID, patientID, groupID, vaccine) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($data);
    $stmt->bind_param("ssss", $uniqueID, $patientID, $groupID, $vaccine);
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

    $administer_iz = "INSERT INTO immunization (uniqueID,patientID,groupID,name,dob,type,vaccine,lot,ndc,exp,site,route,vis_given,vis,funding_source,administered_by,comment,date,time) 
    VALUES (?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($administer_iz);
    $stmt->bind_param("sssssssssssssssssss", $uniqueID, $patientID, $groupID, $encrypt_patient_name, $encrypt_dob, $type, $encrypt_vaccine, $encrypt_lot, $encrypt_ndc,
    $exp, $encrypt_site, $encrypt_route, $encrypt_vis_given, $encrypt_vis, $encrypt_funding_source, $encrypt_administered_by, $encrypt_comment, $date, $time);
    $stmt->execute();

    // update inventory
    $deduct = "UPDATE inventory SET doses=doses-1 WHERE id='$vaccineID' AND groupID='$groupID'"; // deduct 1 dose
    $deduct_run = mysqli_query($con, $deduct);

    $verify_inventory = "SELECT * FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
    $verify_run = mysqli_query($con, $verify_inventory);
    $row = mysqli_fetch_array($verify_run);
    $zero = $row['doses'];

    if($zero == 0){
      // delete inventory
      $delete = "DELETE FROM inventory WHERE id='$vaccineID' AND groupID='$groupID' ";
      $delete_run = mysqli_query($con, $delete);

      // delete inventory from engine
      $delete = "DELETE FROM engine WHERE engineID='$uniqueID' AND groupID='$groupID' ";
      $delete_run = mysqli_query($con, $delete);

      // encrypt data and insert to admin_log table
      $action_ = htmlspecialchars("Archived");
      $message_ = "The last dose of $vaccine ($lot) was administered and archived";
      $encrypt_message_ = encryptthis($message_, $key);
      $activities = "INSERT INTO admin_log (userID, groupID, user, type, activity) VALUES (?, ?, ?, ?, ?)";
      $stmt = $con->prepare($activities);
      $stmt->bind_param("sssss", $userID, $groupID, $encrypt_fullname, $action_, $encrypt_message_);
      $stmt->execute();

      $archive = "INSERT INTO archive (uniqueID,groupID,vaccine,lot,exp,manufacturer,ndc,funding_source) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $con->prepare($archive);
      $stmt->bind_param("ssssssss", $uniqueID, $patientID, $groupID, $encrypt_vaccine, $encrypt_lot, $exp, $encrypt_ndc, $encrypt_funding_source);
      $stmt->execute();
    }

    if($stmt = $con->prepare($administer_iz))
    {
      $_SESSION['success'] = "$vaccine Was Successfully Administered!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
    else
    {
      $_SESSION['warning'] = "Unable to Administer $vaccine!";
      header("Location: ../../../patient-chart/index.php?patientID=$patientID");
      exit(0);
    }
  }
}

?>